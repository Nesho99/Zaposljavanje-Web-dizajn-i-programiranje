<?php
/* Smarty version 4.3.1, created on 2023-06-27 18:30:50
  from 'C:\xampp\htdocs\templates\listaPoslova.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_649b0eba7093e5_73800215',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b975a9cd95e54fcbef71c7d1d1747fc27350853' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\listaPoslova.tpl',
      1 => 1687883021,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_649b0eba7093e5_73800215 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
h2{
    margin: 0;
    padding: 0;
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
