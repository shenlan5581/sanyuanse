<?php
/* 
        **操作层 常见操作的封装**
*  
* DB_Base 为上层提供了数据操作 
* 作为一个表对象提供操作接口
* 需求 BD 静态类 
*    
*/
  
class DB_Base { 
    protected $_table;                   //当前对象表名称
    protected $_pk;                      //主键字段
    protected $_delete_field;            //删除字段
    protected static $_fields = array();

    public function __construct($para = array()) {
        if(!empty($para)) {
            $this->_table  = $para['table'];
            $this->_pk     = $para['pk'];
            self::$_fields = $para['fields'];
        }
    }
/*
  table 操作层  提供数据库的增删改查
*/
    public function getRow($where) {
        if($this->_delete_field){
            $where[] = array('name'=>$this->_delete_field,'oper'=>'=','value'=>0);
        }
        $sql = $this->formatSelectOneSql($where);
        $row = DB::fetch_first($sql);
        if ($row === false) {
            trigger_error("query mysql failed.", E_USER_ERROR);
            return false;
        }
        return $row;
    }
    public function getRowUnion($where,$more_table) {
        if(empty($where && $more_table) && empty($more_table)){
            trigger_error("Update the mysql  where conditions cannot be empty");
            return false;
        }
        if($this->_delete_field){
            $where[] = array('name'=>$this->_delete_field,'oper'=>'=','value'=>0);
        }
        $sql = $this->formatSelectOneUnionSql($where,$more_table);
        $row = DB::fetch_first($sql);
        if ($row === false) {
            trigger_error("query mysql failed.", E_USER_ERROR);
            return false;
        }
        return $row;
    }

    public function getList($where = array(), $index = 0, $count = 20, $sort = array(), $field = array()) {
        if($this->_delete_field){
            $where[] = array('name'=>$this->_delete_field,'oper'=>'=','value'=>0);
        }
        $sql = $this->formatSelectSql($field, $where, $sort, $index, $count);
        if(isset($_REQUEST['test']) && $_REQUEST['test'] = 2){
            plum_msg_dump($sql,1);
        }
        $ret = DB::fetch_all($sql);
        if ($ret === false) {
            trigger_error("query mysql failed.", E_USER_ERROR);
            return false;
        }
        return $ret;
    }
    // k add 多表查询
    public function getListUnion($where = array(), $index = 0, $count = 20, $sort = array(), $field = array(),$more_table=array()) {
        if(empty($where) && empty($more_table)){
            trigger_error("Update the mysql  where conditions cannot be empty");
            return false;
        }
        if($this->_delete_field){
            $where[] = array('name'=>$this->_delete_field,'oper'=>'=','value'=>0);
        }
        $sql = $this->formatSelectUnionSql($field, $where, $sort, $index, $count,$more_table);
        $ret =DB::fetch_all($sql);
        if ($ret === false) {
            trigger_error("query mysql failed.", E_USER_ERROR);
            return false;
        }
        return $ret;
    }

    public function getCount($where = array()) {
        if($this->_delete_field){
            $where[] = array('name'=>$this->_delete_field,'oper'=>'=','value'=>0);
        }
        $sql = $this->formatCountSql($where);
        $ret = DB::result_first($sql);

        if ($ret === false) {
            trigger_error("query mysql failed.", E_USER_ERROR);
            return false;
        }
        return $ret;
    }

    public function insertValue(array $data) {
        $ret = $this->insert($data, true);
        if ($ret === false) {
            trigger_error("query mysql failed.", E_USER_ERROR);
            return false;
        }
        return $ret;
    }
//k add  多表插入
    public function insertValueUnion(array $data) {
        $retID= false;
        foreach($data as $k =>&$v){
            //插入数据
            $this->_table =$k;
            if($v['Skey'] ==null){ //主表标识
               $retID = $this->insert($v['data'],true);
            } else {  //从表
                $v['data'][$v['Skey']] = $retID;
                $retID = $this->insert($v['data'],true);
            }
            if ($retID === false) {
                trigger_error("query mysql failed.", E_USER_ERROR);
                return false;
            }
        }
        return $retID;
    }

    public function updateValue($set, $where){
        if(empty($where)){
            trigger_error("Update the mysql  where conditions cannot be empty");
            return false;
        }
        $sql = $this->formatUpdateSql($set,$where);
        $ret = DB::query($sql);

        if ($ret === false) {
            trigger_error("query mysql failed.", E_USER_ERROR);
            return false;
        }
        return $ret;
    }
// k add   多表更新
    public function updateValueUnion($info){
        foreach($info as $k =>$v){
            $this->_table =$k;
            $where =$v['where'];
            $set =$v['set'];
            if(empty($where)){
                trigger_error("Update the mysql  where conditions cannot be empty");
                return false;
            }
            $sql = $this->formatUpdateSql($set,$where);
            $ret = DB::query($sql);
        }
        if ($ret === false) {
            trigger_error("query mysql failed.", E_USER_ERROR);
            return false;
        }
        return $ret;
    }


    public function deleteValue($where) {
        if(empty($where)){
            trigger_error("Delete the mysql  where conditions cannot be empty");
            return false;
        }
        $sql = $this->formatDeleteSql($where);
        $ret = DB::query($sql);

        if ($ret === false) {
            trigger_error("query mysql failed.", E_USER_ERROR);
            return false;
        }
        return $ret;
    }

    public function getRowById($id){
        $where   = array();
        $where[] = array('name' => $this->_pk,'oper' => '=','value' =>$id);
        return $this->getRow($where);
    }

    public function updateById($set,$id){
        if($id){
            $where   = array();
            $where[] = array('name' => $this->_pk,'oper' => '=','value' =>$id);
            return $this->updateValue($set,$where);
        }
        return false;
    }

    public function deleteById($id){
        if($id){
            $where   = array();
            $where[] = array('name' => $this->_pk,'oper' => '=','value' =>$id);
            return $this->deleteValue($where);
        }
        return false;
    }


/*
  table 对象层
*/
    public function getTable() {
        return $this->_table;
    }

    public function setTable($name) {
        return $this->_table = $name;
    }

    public function count() {
        $count = (int) DB::result_first("SELECT count(*) FROM ".DB::table($this->_table));
        return $count;
    }
    //根据主键val更新数据
    public function update($val, $data, $unbuffered = false, $low_priority = false) {
        if(isset($val) && !empty($data) && is_array($data)) {
            $this->checkpk();
            $ret = DB::update($this->_table, $data, DB::field($this->_pk, $val), $unbuffered, $low_priority);
            return $ret;
        }
        return !$unbuffered ? 0 : false;
    }
    //根据主键val删除数据 unbuffered是否缓存结果集，默认缓存
    public function delete($val, $unbuffered = false) {
        $ret = false;
        if(isset($val)) {
            $this->checkpk();
            $ret = DB::delete($this->_table, DB::field($this->_pk, $val), null, $unbuffered);
        }
        return $ret;
    }

    //返回最后插入生成的主键ID
    public function insert($data, $return_insert_id = true, $replace = false, $silent = false) {
        return DB::insert($this->_table, $data, $return_insert_id, $replace, $silent);
    }

    public function checkpk() {
        if(!$this->_pk) {
            DB::halt("table {$this->_table} has not PRIMARY KEY defined");
        }
    }
    //根据主键ID获取一条记录
    public function fetch($id){
        $data = array();
        if(!empty($id)) {
            $data = DB::fetch_first('SELECT * FROM '.DB::table($this->_table).' WHERE '.DB::field($this->_pk, $id));
        }
        return $data;
    }
    //根据主键IDs获取多条记录
    public function fetch_all(array $ids) {
        $data = array();
        if(!empty($ids)) {
            $query = DB::query('SELECT * FROM '.DB::table($this->_table).' WHERE '.DB::field($this->_pk, $ids));
            while($value = DB::fetch($query)) {
                $data[$value[$this->_pk]] = $value;
            }
            DB::free_result($query);
        }
        return $data;
    }

    public function fetch_all_field(){
        $data = false;
        $query = DB::query('SHOW FIELDS FROM '.DB::table($this->_table), '', 'SILENT');
        if($query) {
            $data = array();
            while($value = DB::fetch($query)) {
                $data[$value['Field']] = $value;
            }
        }
        return $data;
    }
    //获取指定区间的记录，并可根据主键排序，根据主键形成索引
    public function range($start = 0, $limit = 0, $sort = '') {
        if($sort) {
            $this->checkpk();
        }
        return DB::fetch_all('SELECT * FROM '.DB::table($this->_table).($sort ? ' ORDER BY '.DB::order($this->_pk, $sort) : '').DB::limit($start, $limit), null, $this->_pk ? $this->_pk : '');
    }

    public function optimize() {
        DB::query('OPTIMIZE TABLE '.DB::table($this->_table), 'SILENT');
    }

    public function truncate() {
        DB::query("TRUNCATE ".DB::table($this->_table));
    }

    /**
     * 格式化形成查询SQL语句
     * @param array $fields e.g. array('id', 'count' => 'total', 'name')
     * @param array $where
     * @param array $sort e.g. array('count' => 'DESC', 'id' => 'ASC')
     * @param int $index
     * @param int $count
     * @param bool $isand
     * @return string
     */
    public function formatSelectSql($fields = '', $where = array(), $sort = array(), $index = 0, $count = 20,$isand = true) {
        $sql = "select ";
        $sql .= $this->getFieldString($fields);
        $sql .= " from `".DB::table($this->_table)."` ";
        $sql .= $this->formatWhereSql($where, $isand);
	    $sql .= $this->getSqlSort($sort);
	    $sql .= $this->formatLimitSql($index,$count);
        return $sql;
    }
    /**a  k
     * 格式化形成查询SQL语句
     * @param array $fields e.g. array('id', 'count' => 'total', 'name')
     * @param array $where
     * @param array $sort e.g. array('count' => 'DESC', 'id' => 'ASC')
     * @param int $index
     * @param int $count
     * @param bool $isand
     * @return string
     */
    public function formatSelectUnionSql($fields = '', $where = array(), $sort = array(), $index = 0, $count = 20,$more_table, $isand = true) {
        global $config;
        $pre = $config['db']['default']['tablepre']; //表前缀
        $sql = "select ";
        $sql .= $this->getFieldString($fields);
        $sql .= " from `".DB::table($this->_table)."` ";
        foreach ($more_table as $k => $v){
            $sql.=" left join `".$pre.$v[0]."` on ".$pre.$v[1]." = ".$pre.$v[2]."  ";
        }
        $sql .= $this->formatWhereSql($where, $isand);
	    $sql .= $this->getSqlSort($sort);
	    $sql .= $this->formatLimitSql($index,$count);
        return $sql;
    }

    /**
     * 格式化查询总数的SQL语句
     * @param $where
     * @return string
     */
    public function formatCountSql($where) {
        $sql = "select count(*) as total from `".DB::table($this->_table)."` ";
        $sql .= $this->formatWhereSql($where);
        return $sql;
    }
    /**
     * 获取单条数据记录
     * @param array $where @see $this->formatWhereSql
     * @param array $fields @see $this->formatSelectSql
     * @return string
     */
    public function formatSelectOneSql($where, $fields = '') {
        $sql = "select ";
        $fields = $this->getFieldString($fields);
        $sql .= $fields;
        $sql .= " from `".DB::table($this->_table)."` ";
        $sql .= $this->formatWhereSql($where);
        return $sql;
    }
    /** k add
     * 获取单条数据记录
     * @param array $where @see $this->formatWhereSql
     * @param array $fields @see $this->formatSelectSql
     * @return string
     */
    public function formatSelectOneUnionSql($where,$more_table,$fields = '') {
        global $config;
        $pre = $config['db']['default']['tablepre']; //表前缀
        $sql = "select ";
        $fields = $this->getFieldString($fields);
        $sql .= $fields;
        $sql .= " from `".DB::table($this->_table)."` ";
        foreach ($more_table as $k => $v){
            $sql.=" left join `".$pre.$v[0]."` on ".$pre.$v[1]." = ".$pre.$v[2]."  ";
        }
        $sql .= $this->formatWhereSql($where);
        return $sql;
    }

    /**
     * 格式化形成where语句
     * @param array $where e.g. array( " fileName = fileVal " ,array('name' => 'id', 'oper' => '=', 'value' => 2), array(...), ... )
     * @param bool $isand
     * @return string
     */
    public function formatWhereSql($where = array(), $isand = true,$need = '') {
        $cond = "";
        if (!empty($where)) {
            $cond .= " where ";
            $field = array();
            foreach($where as $val) {
                if(is_array($val)){
                    switch ($val['oper']) {
                        case 'in' :
                            //循环并转义
                            foreach ($val['value'] as $zkey => $zval) {
                                $val['value'][$zkey] = DB::quote($zval);
                            }
                            $field[] = "{$need} {$val['name']} {$val['oper']} (".implode(",", $val['value']).")";
                            break;
                        default :
                            //转义
                            $val['value'] = DB::quote($val['value']);
                            $field[] = "{$need} {$val['name']} {$val['oper']}  {$val['value']}";
                            break;
                    }
                }else{
                    $field[] = $val;
                }
            }
            if ($isand) {
                $cond .= implode(" and ", $field);
            } else {
                $cond .= implode(" or ", $field);
            }
        }
        return $cond;
    }

    /**
     * 格式化形成insert语句
     * @param array $values e.g. array(1, 'thomas')
     * @param array $fields e.g. array('id', 'name')
     * @return bool|string
     */
    public function formatInsertSql($values, $fields = array()) {
        //$fields = $this->formatFieldArray($fields);
        if (empty($values)) {
            return false;
        }
        if (!empty($fields) && count($fields) != count($values)) {
            return false;
        }
        $sql = "insert into `".DB::table($this->_table)."` ";
        if (!empty($fields)) {
            $sql .= " (`".implode('`,`', $fields)."`)";
        }
        //转义
        foreach ($values as $key => $val) {
            $values[$key] = DB::quote($val);
        }
        $sql .= " values (".implode(",", $values).")";
        return $sql;
    }

    /**
     * 生成ignore insert语句，防止unique index报错
     * @param array $values
     * @param array $fields
     * @return bool|string
     */
    public function formatIgnoreInsertSql($values, $fields = array()) {
        //$fields = $this->formatFieldArray($fields);
        if (empty($values)) {
            return false;
        }
        if (!empty($fields) && count($fields) != count($values)) {
            return false;
        }
        $sql = "insert ignore into `".DB::table($this->_table)."` ";
        if (!empty($fields)) {
            $sql .= " (`".implode('`,`', $fields)."`)";
        }
        //转义
        foreach ($values as $key => $val) {
            $values[$key] = DB::quote($val);
        }
        $sql .= " values (".implode(",", $values).")";
        return $sql;
    }

    public function formatReplaceSql($values, $fields = array()) {
        if (empty($values)) {
            return false;
        }
        if (!empty($fields) && count($fields) != count($values)) {
            return false;
        }
        $sql = "replace into `".DB::table($this->_table)."` ";
        if (!empty($fields)) {
            $sql .= " (`".implode('`,`', $fields)."`)";
        }
        //转义
        foreach ($values as $key => $val) {
            $values[$key] = DB::quote($val);
        }
        $sql .= " values (".implode(",", $values).")";
        return $sql;
    }

    /**
     * 格式化形成update语句
     * @param array $sets e.g. array('id' => 1, 'name' => 'thomas')
     * @param array $where
     * @return string
     */
    public function formatUpdateSql(array $sets, array $where) {
        if (empty($where)) {
            return false;
        }
        $sql = "update `".DB::table($this->_table)."` set ";
        $sql .= $this->formatUpdateField($sets);
//        plum_msg_dump($sql);
        $sql .= $this->formatWhereSql($where);

        return $sql;
    }

  //kkk add 多表更新
    public function formatUpdateSqlUnion(array $sets, array $where,array $more_table) {
        if (empty($where)&&emtpy($more_table)) {
            return false;
        }
        global $config;
        $pre = $config['db']['default']['tablepre']; //表前缀
        $sql = "update `".DB::table($this->_table);
        foreach ($more_table as $k => $v){
            $sql.=" left join `".$pre.$v[0]."` on ".$pre.$v[1]." = ".$pre.$v[2]."  ";
        }
        $sql .="` set ";
        $sql .= $this->formatUpdateField($sets);
//        plum_msg_dump($sql);
        $sql .= $this->formatWhereSql($where);

        return $sql;
    }








    /**
     * 格式化update字段
     * @param array $sets
     * @return string
     */
    public function formatUpdateField(array $sets){
        $fields = array();
        foreach ($sets as $name => $value) {
            //转义
            $value = DB::quote($value);
            $fields[] = "`{$name}` = {$value}";
        }
        return implode(', ', $fields);
    }

    /**
     * 格式化形成delete语句
     * @param array $where @see $this->formatWhereSql()
     * @return bool|string
     */
    public function formatDeleteSql(array $where) {
        if (empty($where)) {
            return false;
        }
        $sql = "delete from `".DB::table($this->_table)."` ";
        $sql .= $this->formatWhereSql($where);
        return $sql;
    }

    /**
     * 格式化生成字段数组
     * @param array $fields
     * @return array
     */
    public function formatFieldArray(array $fields) {
        if (empty($fields)) {
            return array();
        }
        if (empty(self::$_fields)) {
            $all_fields = $this->fetch_all_field();
            foreach ($all_fields as $key => $val) {
                array_push(self::$_fields, strtolower($key));
            }
        }
        if (isset($fields['field_flag']) && $fields['field_flag'] == 'exclude') {
            unset($fields['field_flag']);
            return array_diff(self::$_fields, $fields);
        }
        return array_intersect($fields, self::$_fields);
    }

    public function __toString() {
        return $this->_table;
    }

    /**
     * @param array $field
     * return sting
     */
    public function getFieldString($fields,$im_str=','){
        if (!empty($fields)&&is_array($fields)) {
            $select_fields = array();
            foreach ($fields as $key => $val) {
                if (is_numeric($key)) {
                    $select_fields[] = "`".$val."`";
                } else {
                    $select_fields[] = "`".$key."` as ".$val."";
                }
            }
            $sql_field = implode($im_str, $select_fields);
        } elseif(!empty($fields)&&is_string($fields)){
            $sql_field = " {$fields} ";
        }else{
            $sql_field = " * ";
        }

        return $sql_field;
    }

    /**
     * @param $sort
     * @return string
     */
    public function getSqlSort($sort,$im_str=','){
        $sql_sort = " ";
        if (!empty($sort)) {
            $sql_sort .= " order by ";
            $select_sort = array();
            foreach ($sort as $key => $val) {
                $select_sort[] = "`{$key}` {$val}";
            }
            $sql_sort .= implode($im_str, $select_sort);
        }
        return $sql_sort;
    }

    /**
     * 格式化生成limit SQL语句，如果$count为0，则返回空语句
     * @param int $index
     * @param int $count
     * @return string
     */
    public function formatLimitSql($index = 0, $count = 20) {
        $index  = intval($index);
        $count  = intval($count);

        $sql    = '';
        if ($count != 0) {
            $sql    .= " LIMIT {$index}, {$count} ";
        }
        return $sql;
    }


}