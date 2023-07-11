<?php
/* Smarty version 4.3.1, created on 2023-07-11 21:25:21
  from 'C:\xampp\htdocs\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_64adaca16180d6_85372898',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df1d40a0bf0365f1e3ef5a39dc9c4a565e75319c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\index.tpl',
      1 => 1689103388,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64adaca16180d6_85372898 (Smarty_Internal_Template $_smarty_tpl) {
?><form>
<label for="od">Početak natečaja:</label>
<input type="datetime-local" id="od" name="od">
<label for="od">Kraj natječaja:</label>
<input type="datetime-local" id="do" name="do">
<button type="button" id="filtrirajNatjecaj"> Filtriraj </button>
</form>
</form>
<div id="natjecaji">
</div>
<form>
<label for="pretrazi">Pretraži:</label>
<input type="text" id="pretrazi" name="pretrazi">
<label for="smjer">Sortiraj:</label>
<select id="smjer">
  <option value="asc">Uzlazno</option>
  <option value="desc">Silazno</option>
</select>

<button type="button" id="filtrirajZaposlenika"> Filtriraj </button>
</form>
<div id="zaposlenici">
</div><?php }
}
