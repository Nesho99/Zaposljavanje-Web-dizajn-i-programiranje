<?php
/* Smarty version 4.3.1, created on 2023-07-01 14:04:10
  from 'C:\xampp\htdocs\templates\poduzeca.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_64a0163a4ddc62_68959465',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '975e0d8ad66d92d00a7cafdeeed38bfe574ff550' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\poduzeca.tpl',
      1 => 1688213046,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64a0163a4ddc62_68959465 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="tablicaPoduzeca">
</div>
<form id="formaPoduzeca">
<label for="id">ID:</label><br>
<input type="text" id="id" name="id"><br>
<label for="ime">Ime:</label><br>
<input type="text" id="ime" name="ime"><br>
<label for="od">Radno vrijeme od:</label><br>
<input type="text" id="od" name="od"><br>
<label for="do">Radno vrijeme do:</label><br>
<input type="text" id="do" name="do"><br>
<label for="ime">Opis:</label><br>
<input type="text" id="opis" name="opis"><br>
<label for="moderator">Moderator::</label><br>
<select name="moderator" id="moderator">
</select>
<button type="button" id="posalji"> Pošalji </button>
</form>

<form id="formaModeratora">
<label for="korisnik">Daj moredatora:</label><br>
<select name="id" id="korisnik">
</select>
<button type="button" id="posaljiModerator"> Pošalji </button>
</form>
<?php }
}
