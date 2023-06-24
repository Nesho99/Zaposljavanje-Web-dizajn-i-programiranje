<?php
/* Smarty version 4.3.1, created on 2023-06-24 20:29:52
  from 'C:\xampp\htdocs\templates\dnevnik.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6497362060e608_80112455',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1f7d542fa6fdb11157f61a02782f69c2e845b17' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\dnevnik.tpl',
      1 => 1687631281,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6497362060e608_80112455 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="tablicaDnevnik">
</div>
<form id="formaDnevnik">
<label for="od">od:</label><br>
<input type="datetime-local" id="od" name="od"><br>
<label for="do">do:</label><br>
<input type="datetime-local" id="do" name="do"><br>
<button type="button" id="prezrazi"> Pretrazi </button>
</form><?php }
}
