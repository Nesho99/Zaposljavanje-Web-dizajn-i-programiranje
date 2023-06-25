<?php
/* Smarty version 4.3.1, created on 2023-06-25 21:16:48
  from 'C:\xampp\htdocs\templates\upravljanjePoslovma.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_649892a002d3f6_42371453',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50b986f8d5734c5503583e8fc13108ac9c64270c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\upravljanjePoslovma.tpl',
      1 => 1687720257,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_649892a002d3f6_42371453 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="tablicaNatjecaji">
</div>
<form id="formaUpavljanjeNatjecajima">
<label for="id">ID:</label><br>
<input type="text" id="id" name="id"><br>
<label for="naziv">Naziv:</label><br>
<input type="text" id="naziv" name="naziv"><br>
<label for="opis">Opis:</label><br>
<input type="text" id="ops" name="opis"><br>
<select name="poduzece" id="poduzece">
</select>
<button type="button" id="posalji"> Pošalji </button>
</form>

<?php }
}
