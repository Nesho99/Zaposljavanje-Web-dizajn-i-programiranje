<?php
/* Smarty version 4.3.1, created on 2023-06-25 00:14:10
  from 'C:\xampp\htdocs\templates\dnevnik.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_64976ab2c21140_17104636',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1f7d542fa6fdb11157f61a02782f69c2e845b17' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\dnevnik.tpl',
      1 => 1687644848,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64976ab2c21140_17104636 (Smarty_Internal_Template $_smarty_tpl) {
?><form id="formaDnevnik">
<label for="od">od:</label><br>
<input type="datetime-local" id="od" name="od"><br>
<label for="do">do:</label><br>
<input type="datetime-local" id="do" name="do"><br>
<button type="button" id="pretrazi"> Pretrazi </button>
</form>
<div id="tablicaDnevnik">
</div>
<?php }
}
