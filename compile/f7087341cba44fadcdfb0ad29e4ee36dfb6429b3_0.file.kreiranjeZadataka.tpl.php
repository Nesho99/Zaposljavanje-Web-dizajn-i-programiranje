<?php
/* Smarty version 4.3.1, created on 2023-07-05 20:37:05
  from 'C:\xampp\htdocs\templates\kreiranjeZadataka.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_64a5b8510afe88_19730639',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7087341cba44fadcdfb0ad29e4ee36dfb6429b3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\kreiranjeZadataka.tpl',
      1 => 1688582203,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64a5b8510afe88_19730639 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="tablicaZadatci">
</div>
<form id="upravljanjeZadatcima">
<label for="id">ID:</label><br>
<input type="text" id="id" name="id"><br>
<label for="naziv">Naziv:</label><br>
<input type="text" id="naziv" name="naziv"><br>
<label for="opis">Opis:</label><br>
<input type="text" id="ops" name="opis"><br>
<label for="dan">Datum:</label><br>
<input type="date" id="dan" name="dan"><br>
<label for="zaposlenik">Zaposlenik:</label><br>
<select name="zaposlenik" id="zaposlenik">
</select><br/>
<label for="ocjena">Ocjena:</label><br>
<select name="ocjena" id="ocjena">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select><br>
<button type="button" id="posalji"> Pošalji </button>

</form><?php }
}
