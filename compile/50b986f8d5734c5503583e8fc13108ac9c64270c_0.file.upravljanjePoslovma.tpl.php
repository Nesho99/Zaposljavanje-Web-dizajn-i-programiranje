<?php
/* Smarty version 4.3.1, created on 2023-07-12 21:28:37
  from 'C:\xampp\htdocs\templates\upravljanjePoslovma.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_64aefee5ef22c4_15337780',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50b986f8d5734c5503583e8fc13108ac9c64270c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\upravljanjePoslovma.tpl',
      1 => 1689099562,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64aefee5ef22c4_15337780 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="tablicaNatjecaji">
</div>
<form id="formaUpavljanjeNatjecajima">
<label for="id">ID:</label><br>
<input type="text" id="id" name="id"><br>
<label for="naziv">Naziv:</label><br>
<input type="text" id="naziv" name="naziv"><br>
<label for="opis">Opis:</label><br>
<input type="text" id="ops" name="opis"><br>
<label for="od">Početak natečaja:</label><br>
<input type="datetime-local" id="od" name="od"><br>
<select name="poduzece" id="poduzece">
</select>
<button type="button" id="posalji"> Pošalji </button>
</form>

<?php }
}
