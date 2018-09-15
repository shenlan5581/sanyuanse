<?php
/* Smarty version 3.1.32, created on 2018-09-15 09:35:40
  from '/home/ki/https/www/framework/mvc/view/Manage/Admin/AdminList.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9cd26c1a0b22_92001997',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '221a91095098533e47c5ac8c29f4b23f80caf3f6' => 
    array (
      0 => '/home/ki/https/www/framework/mvc/view/Manage/Admin/AdminList.html',
      1 => 1536757496,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b9cd26c1a0b22_92001997 (Smarty_Internal_Template $_smarty_tpl) {
?>  
 <div class="alert alert-secondary"  style="background-color: rgb(255, 255, 255)"="alert"> 
    <span> 管理员列表：</span><br>
    <span style="font-size: 10px;">该页面编辑管理员,权限等级</span> 
 </div>
    <?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
    <div class="alert alert-success" role="alert">
    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

      </div>
    <?php }?>


<div class="container-fluid ">
        <div class="row ">
            <div class="col-md-4 column">

                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="inputGroupSelect01">等级</label>
                            </div>
                            <select onchange=search() id = 'level' class="custom-select" id="inputGroupSelect01">
                            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 4+1 - (1) : 1-(4)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                              <?php if ($_smarty_tpl->tpl_vars['i']->value == $_smarty_tpl->tpl_vars['level']->value) {?>
                              <option selected><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
                              <?php } else { ?>
                              <option value=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
                              <?php }?>
                            <?php }
}
?>
                            </select>
                          </div>

            </div>
            <div class="col-md-4 column">
            </div>
            <div class="col-md-4 column">
            </div>
        </div>
    </div>


 
<table class="table">
        <thead>
          <tr>
            <th scope="col">用户名</th>
            <th scope="col">权限等级</th>
            <th scope="col">邮箱</th>
            <th scope="col">操作</th>
          </tr>
        </thead>
        <tbody>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?> 
          <tr>
            <td> <?php echo $_smarty_tpl->tpl_vars['row']->value['a_user'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['row']->value['a_level'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['row']->value['a_email'];?>
 </td>
            <td>
                        <a href="/Manage/Admin/AdminEdit?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['a_id'];?>
" class="btn btn-sm btn-light"> 编辑 </a>
                        <a href="/Manage/Admin/Admin?oper=delete&id=<?php echo $_smarty_tpl->tpl_vars['row']->value['a_id'];?>
" class="btn   btn-sm btn-secondary"> 删除 </a>
            </td>
          </tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tbody>
      </table>

<nav aria-label="Page navigation example" >
    <ul class="pagination">
      <li class="page-item"><a  style="color:rgb(31, 31, 31)"  class="page-link" onclick=page(<?php echo $_smarty_tpl->tpl_vars['curr_count']->value-1;?>
) href="#">上一个</a></li>
      <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['count']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['count']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
         <?php if ($_smarty_tpl->tpl_vars['i']->value == $_smarty_tpl->tpl_vars['curr_count']->value) {?>
        <li class="page-item"><a style="color:rgb(22, 170, 180)" class="page-link" ><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a></li>
         <?php } else { ?>
        <li class="page-item"><a style="color:rgb(167, 167, 167)"  class="page-link" onclick=page(<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
) href="#"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a></li>
        <?php }?>
      <?php }
}
?>
      <li class="page-item"><a style="color:rgb(33, 33, 33)" class="page-link" onclick=page(<?php echo $_smarty_tpl->tpl_vars['curr_count']->value+1;?>
) href="#">下一个</a></li>
    </ul>
  </nav>

  <?php echo '<script'; ?>
>
function page(index){
  var level =$('#level').val();
  window.location.href='/Manage/Admin/Admin?level='+level+'&index='+index; 
}
function search() {
   var level =$('#level').val();
 window.location.href='/Manage/Admin/Admin?level='+level; 
}
  <?php echo '</script'; ?>
><?php }
}
