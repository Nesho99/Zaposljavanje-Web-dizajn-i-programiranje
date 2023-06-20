<?php
/* Smarty version 4.3.1, created on 2023-06-20 14:33:01
  from 'C:\xampp\htdocs\templates\korisnici.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_64919c7d567bb9_10225215',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbf2414a605af9c6c91393d3a425bf4d5ffedb23' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\korisnici.tpl',
      1 => 1687264377,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64919c7d567bb9_10225215 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="tablicaKorisnici">
</div>
<form>
<select name="odblokirani" id="odblokirani">
</select>
<button id="blokiraj" type="button"> Blokiraj </button>
</form>

<form>
<select name="blokirani" id="blokirani">
</select>
<button id="odblokiraj" type="button"> Odblokiraj </button>
</form>

<?php }
}
