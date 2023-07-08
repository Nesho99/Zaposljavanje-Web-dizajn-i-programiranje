<?php
/* Smarty version 4.3.1, created on 2023-07-08 21:27:11
  from 'C:\xampp\htdocs\templates\zadatciZaposlenika.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_64a9b88f0f3628_73534339',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9c4cb5296edd4f40056111862c489457b6de08e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\zadatciZaposlenika.tpl',
      1 => 1688844426,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64a9b88f0f3628_73534339 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="tablicaZadatci">
</div>
<form id="dolasci">
<label for="dolazak">Dolazak:</label><br>
<input type="datetime-local" id="datum" name="datum"><br>
<button type="button" id="posaljiDolazak"> Pošalji </button>
</form>

<form id="zadatak">
<label for="opis">ID zadataka:</label><br>
<input type="text" id="id" name="id"><br>
<label for="opis">Opis adatka:</label><br>
<input type="text" id="opsi" name="opis"><br>
<button type="button" id="posaljiZadatak"> Pošalji </button>
</form><?php }
}
