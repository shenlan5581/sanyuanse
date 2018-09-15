<?php
/* Smarty version 3.1.32, created on 2018-09-12 18:08:27
  from '/home/ki/https/www/framework/mvc/view/Manage/Case/caselist.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b99561b03cb72_79807443',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f2989fb812b84cf82fe06cdb18ed596857d82638' => 
    array (
      0 => '/home/ki/https/www/framework/mvc/view/Manage/Case/caselist.html',
      1 => 1536757496,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b99561b03cb72_79807443 (Smarty_Internal_Template $_smarty_tpl) {
?> <div class="alert alert-secondary"  style="background-color: rgb(255, 255, 255)"="alert"> 
    <span> 案例列表：</span><br>
    <span style="font-size: 10px;">管理案例信息相关</span> 
 </div>
 
 <div class="container-fluid ">
    <div class="row ">
        <div class="col-sm-3 column">
        <!-- 类型 -->
                <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend ">
                          <label class="input-group-text">类型</label>
                        </div>
                       <select onchange=search() id = 'type' class="custom-select custom-select-sm" >
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['type']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                                  <?php if ($_smarty_tpl->tpl_vars['curr_type']->value == $_smarty_tpl->tpl_vars['k']->value) {?>
                                    <option selected =<?php echo $_smarty_tpl->tpl_vars['curr_type']->value;?>
 value =<?php echo $_smarty_tpl->tpl_vars['curr_type']->value;?>
><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</option>
                              <?php } else { ?>
                                   <option  value =<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</option>
                              <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                      </select>
                      </div>
        </div>
  
        <div class="col-sm-3 column">
        <!-- style-->
                <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text">风格</label>
                        </div> 
                       <select onchange=search() id = 'style' class="custom-select custom-select-sm" >
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['style']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                                <?php if ($_smarty_tpl->tpl_vars['curr_style']->value == $_smarty_tpl->tpl_vars['k']->value) {?>
                                  <option selected   ="<?php echo $_smarty_tpl->tpl_vars['curr_type']->value;?>
" value =<?php echo $_smarty_tpl->tpl_vars['curr_style']->value;?>
><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</option>
                            <?php } else { ?>
                                 <option  value =<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</option>
                            <?php }?>
                          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                      </select>
                      </div>
        </div>
    </div>
</div>

<table class="table">
    <thead>
      <tr>
        <th scope="col">微缩图</th>
        <th scope="col">标题</th>
        <th scope="col">分类</th>
        <th scope="col">风格 </th>
        <th scope="col">简介</th>
        <th scope="col">日期</th>
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
        <td><img  style="height:50px;width:auto" src="<?php echo $_smarty_tpl->tpl_vars['row']->value['c_title_img'];?>
"></td>
        <td><?php echo $_smarty_tpl->tpl_vars['row']->value['c_title'];?>
 </td>
        <td><?php echo $_smarty_tpl->tpl_vars['row']->value['c_type'];?>
 </td>
        <td><?php echo $_smarty_tpl->tpl_vars['row']->value['c_style'];?>
 </td>
        <td><?php echo $_smarty_tpl->tpl_vars['row']->value['c_biref'];?>
  </td>
        <td><?php echo $_smarty_tpl->tpl_vars['row']->value['c_date'];?>
  </td>
        <td>
                    <a href="/Manage/Case/CaseEdit?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['c_id'];?>
" class="btn btn-sm btn-light"> 编辑 </a>
                    <a href="/Manage/Case/CaseDelete?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['c_id'];?>
" class="btn  btn-sm btn-secondary"> 删除 </a>
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
      if(index><?php echo $_smarty_tpl->tpl_vars['count']->value;?>
 || index < 0){
          return;
      }
      var style=$('#style').val();
      var type=$('#type').val();
      window.location.href='<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
?style='+style+'&type='+type+'&index='+index; 
    }
    function search() {
      var style=$('#style').val();
      var type=$('#type').val();
      window.location.href='<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
?style='+style+'&type='+type; 
    }
      <?php echo '</script'; ?>
>







<?php }
}
