<?php
/* Smarty version 3.1.32, created on 2018-09-14 12:45:26
  from '/home/k/https/www/framework/mvc/view/Manage/Transaction/Transaction.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9bad66ab8a17_60227429',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c7cdbaebe52c02528e44f713eb1f32eba369a779' => 
    array (
      0 => '/home/k/https/www/framework/mvc/view/Manage/Transaction/Transaction.html',
      1 => 1536847747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b9bad66ab8a17_60227429 (Smarty_Internal_Template $_smarty_tpl) {
?>

<table class="table">
    <thead>
      <tr>
        <th scope="col">名称</th>
        <th scope="col">说明</th>
        <th scope="col">文件路径</th>
        <th scope="col">操作</th>
      </tr>
    </thead>
    <tbody>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'row', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['row']->value) {
?> 
      <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['row']->value['tr_name'];?>
</td>
        <td item-height="200xp;"><?php echo $_smarty_tpl->tpl_vars['row']->value['tr_md'];?>
  </td>
        <td><?php echo $_smarty_tpl->tpl_vars['row']->value['tr_file'];?>
</td>
        <td>
             <a href='/Manage/Transaction/delete' class="btn  btn-sm btn-secondary"> 删除 </a>
        </td>
      </tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>

 <?php }
}
