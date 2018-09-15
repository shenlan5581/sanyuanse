<?php
/*
*   静态类 DB
*/
 
class  DB{
    public static $db;
    public static function init($config) {
        self::$db = new Mysql_Driver();
        self::$db->set_config($config);
        self::$db->connect();
    }
    public static function table($table) {
        return self::$db->table_name($table);
    }
    //删
    public static function delete($table, $condition, $limit = 0, $unbuffered = true) {
        if (empty($condition)) {
            return false;
        } elseif (is_array($condition)) {
            if (count($condition) == 2 && isset($condition['where']) && isset($condition['arg'])) {
                $where = self::format($condition['where'], $condition['arg']);
            } else {
                $where = self::implode_field_value($condition, ' AND ');
            }
        } else {
            $where = $condition;
        }
        $limit = intval($limit);
        $sql = "DELETE FROM " . self::table($table) . " WHERE $where " . ($limit > 0 ? "LIMIT $limit" : '');
        return self::query($sql, ($unbuffered ? 'UNBUFFERED' : ''));
    }
    //增
    public static function insert($table, $data, $return_insert_id = false, $replace = false, $silent = false) {

        $sql = self::implode($data);
        $cmd = $replace ? 'REPLACE INTO' : 'INSERT INTO';
        $table = self::table($table);
        $silent = $silent ? 'SILENT' : '';
        //if(isset($_REQUEST['test'])){
//            plum_msg_dump("$cmd $table SET $sql",1);
//        }
        return self::query("$cmd $table SET $sql", null, $silent, !$return_insert_id);
    }
    //改
    public static function update($table, $data, $condition, $unbuffered = false, $low_priority = false) {
        $sql = self::implode($data);
        if(empty($sql)) {
            return false;
        }
        $cmd = "UPDATE " . ($low_priority ? 'LOW_PRIORITY' : '');
        $table = self::table($table);
        $where = '';
        if (empty($condition)) {
            $where = '1';
        } elseif (is_array($condition)) {
            $where = self::implode($condition, ' AND ');
        } else {
            $where = $condition;
        }
        $res = self::query("$cmd $table SET $sql WHERE $where", $unbuffered ? 'UNBUFFERED' : '');
        return $res;
    }
    //增
    public static function insert_id() {
        return self::$db->insert_id();
    }
    //改、删
    public static function affected_rows() {
        return self::$db->affected_rows();
    }
    //获取结果集第一行
    public static function fetch_first($sql, $arg = array(), $silent = false) {
        $res = self::query($sql, $arg, $silent, false);
        $ret = self::$db->fetch_array($res);
        self::$db->free_result($res);
        return $ret ? $ret : array();
    }
    //获取结果集所有行
    public static function fetch_all($sql, $arg = array(), $keyfield = '', $silent = false) {
        $data = array();
        $query = self::query($sql, $arg, $silent, false);
        while ($row = self::$db->fetch_array($query)) {
            if ($keyfield && isset($row[$keyfield])) {
                $data[$row[$keyfield]] = $row;
            } else {
                $data[] = $row;
            }
        }
        self::$db->free_result($query);
        return $data;
    }
    //从结果集中获取一行
    public static function fetch($result, $type = 'MYSQL_ASSOC') {
        return self::$db->fetch_array($result, $type);
    }
    //从结果集某一行获取第一个字段值
    public static function result($result, $row = 0) {
        return self::$db->result($result, $row);
    }
    //获取结果集第一行的第一个字段值
    public static function result_first($sql, $arg = array(), $silent = false) {
        $res = self::query($sql, $arg, $silent, false);
        $ret = self::$db->result($res, 0);
        self::$db->free_result($res);
        return $ret;
    }

    public static function query($sql, $arg = array(), $silent = false, $unbuffered = false,$isinsert = false) {

        if (!empty($arg)) {
            if (is_array($arg)) {
                $sql = self::format($sql, $arg);
            } elseif ($arg === 'SILENT') {
                $silent = true;

            } elseif ($arg === 'UNBUFFERED') {
                $unbuffered = true;
            }
        }

        $ret = self::$db->query($sql, $silent, $unbuffered);

        if (!$unbuffered && $ret) {

            $cmd = trim(strtoupper(substr($sql, 0, strpos($sql, ' '))));
//            plum_msg_dump('---'.$cmd);

            if ($cmd === 'SELECT') {

            } elseif ($cmd === 'UPDATE' || $cmd === 'DELETE') {
                $ret = self::$db->affected_rows();
            } elseif ($cmd === 'INSERT') {

                $ret = self::$db->insert_id();
            }
        }

        if($isinsert){
            $ret = self::$db->insert_id();
        }

        return $ret;
    }

    public static function num_rows($resourceid) {
        return self::$db->num_rows($resourceid);
    }

    public static function free_result($query) {
        return self::$db->free_result($query);
    }

    public static function error() {
        return self::$db->error();
    }

    public static function errno() {
        return self::$db->errno();
    }

    //对值进行转义加引号
    public static function quote($str, $noarray = false) {
        if (is_string($str))
            return '\'' . self::$db->escape($str) . '\'';

        if (is_int($str) or is_float($str))
            return '\'' . $str . '\'';

        if (is_array($str)) {
            if($noarray === false) {
                foreach ($str as &$v) {
                    $v = self::quote($v, true);
                }
                return $str;
            } else {
                return '\'\'';
            }
        }

        if (is_bool($str))
            return $str ? '1' : '0';

        return '\'\'';
    }
    //对字段加引号
    public static function quote_field($field) {
        if (is_array($field)) {
            foreach ($field as $k => $v) {
                $field[$k] = self::quote_field($v);
            }
        } else {
            if (strpos($field, '`') !== false)
                $field = str_replace('`', '', $field);
            $field = '`' . $field . '`';
        }
        return $field;
    }

    public static function limit($start, $limit = 0) {
        $limit = intval($limit > 0 ? $limit : 0);
        $start = intval($start > 0 ? $start : 0);
        if ($start > 0 && $limit > 0) {
            return " LIMIT $start, $limit";
        } elseif ($limit) {
            return " LIMIT $limit";
        } elseif ($start) {
            return " LIMIT $start";
        } else {
            return '';
        }
    }
    public static function order($field, $order = 'ASC') {
        if(empty($field)) {
            return '';
        }
        $order = strtoupper($order) == 'ASC' || empty($order) ? 'ASC' : 'DESC';
        return self::quote_field($field) . ' ' . $order;
    }
    //对单个字段进行拼合
    public static function field($field, $val, $glue = '=') {

        $field = self::quote_field($field);

        if (is_array($val)) {
            $glue = $glue == 'notin' ? 'notin' : 'in';
        } elseif ($glue == 'in') {
            $glue = '=';
        }

        switch ($glue) {
            case '=':
                return $field . $glue . self::quote($val);
                break;
            case '-':
            case '+':
                return $field . '=' . $field . $glue . self::quote((string) $val);
                break;
            case '|':
            case '&':
            case '^':
                return $field . '=' . $field . $glue . self::quote($val);
                break;
            case '>':
            case '<':
            case '<>':
            case '<=':
            case '>=':
                return $field . $glue . self::quote($val);
                break;

            case 'like':
                return $field . ' LIKE(' . self::quote($val) . ')';
                break;

            case 'in':
            case 'notin':
                $val = $val ? implode(',', self::quote($val)) : '\'\'';
                return $field . ($glue == 'notin' ? ' NOT' : '') . ' IN(' . $val . ')';
                break;

            default:
                self::halt("not allow this glue between field and value: {$glue}");
        }
    }

    public static function implode($array, $glue = ',') {
        $sql = $comma = '';
        $glue = ' ' . trim($glue) . ' ';
        foreach ($array as $k => $v) {
            $sql .= $comma . self::quote_field($k) . '=' . self::quote($v);
            $comma = $glue;
        }
        return $sql;
    }

    public static function implode_field_value($array, $glue = ',') {
        return self::implode($array, $glue);
    }

    public static function format($sql, $arg) {
        $count = substr_count($sql, '%');
        if (!$count) {
            return $sql;
        } elseif ($count > count($arg)) {
            self::halt("sql string format error! this sql need {$count} vars to replace into.", 0, $sql);
        }

        $len = strlen($sql);
        $i = $find = 0;
        $ret = '';
        while ($i <= $len && $find < $count) {
            if ($sql{$i} == '%') {
                $next = $sql{$i + 1};
                if ($next == 't') {
                    $ret .= self::table($arg[$find]);
                } elseif ($next == 's') {
                    $ret .= self::quote(is_array($arg[$find]) ? serialize($arg[$find]) : (string) $arg[$find]);
                } elseif ($next == 'f') {
                    $ret .= sprintf('%F', $arg[$find]);
                } elseif ($next == 'd') {
                    $ret .= intval($arg[$find]);
                } elseif ($next == 'i') {
                    $ret .= $arg[$find];
                } elseif ($next == 'n') {
                    if (!empty($arg[$find])) {
                        $ret .= is_array($arg[$find]) ? implode(',', self::quote($arg[$find])) : self::quote($arg[$find]);
                    } else {
                        $ret .= '0';
                    }
                } else {
                    $ret .= self::quote($arg[$find]);
                }
                $i++;
                $find++;
            } else {
                $ret .= $sql{$i};
            }
            $i++;
        }
        if ($i < $len) {
            $ret .= substr($sql, $i);
        }
        return $ret;
    }
    public static function halt($message = '', $code = 0, $sql = '') {
        self::$db->halt($message, $code, $sql);
    }
}

 