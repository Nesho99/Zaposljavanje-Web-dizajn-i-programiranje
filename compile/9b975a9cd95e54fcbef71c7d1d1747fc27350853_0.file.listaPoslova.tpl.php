<?php
/* Smarty version 4.3.1, created on 2023-06-27 00:07:49
  from 'C:\xampp\htdocs\templates\listaPoslova.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_649a0c35c4be52_34889947',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b975a9cd95e54fcbef71c7d1d1747fc27350853' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\listaPoslova.tpl',
      1 => 1687817268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_649a0c35c4be52_34889947 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
h2{
    margin: 0;
    padding: 0;
}

div#lista {
  margin-left: auto;
  margin-right: auto;
  display: block;
  clear: both;

}

</style>
<div id="lista">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['natjecaji']->value, 'n');
$_smarty_tpl->tpl_vars['n']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['n']->value) {
$_smarty_tpl->tpl_vars['n']->do_else = false;
?>
    <h2><a href="natjecaj.php?id=<?php echo $_smarty_tpl->tpl_vars['n']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['n']->value->naziv;?>
</a></h2><br>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div><?php }
}
