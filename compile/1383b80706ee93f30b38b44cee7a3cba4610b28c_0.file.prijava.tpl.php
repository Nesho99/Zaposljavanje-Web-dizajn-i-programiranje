<?php
/* Smarty version 4.3.1, created on 2023-06-19 15:54:45
  from 'C:\xampp\htdocs\templates\prijava.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_64905e25dbc856_37776827',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1383b80706ee93f30b38b44cee7a3cba4610b28c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\prijava.tpl',
      1 => 1687182869,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64905e25dbc856_37776827 (Smarty_Internal_Template $_smarty_tpl) {
?><h1> Prijava </h1>
<div id="glavni">
<form id="prijava" action="api/prijava.php" method="post">
<label for="kime">Korisnicko ime:</label><br>
<input type="text" id="kime" name="kime"><br>
<label for="lozinka">Lozinka</label><br>
<input type="password" id="lozinka" name="lozinka"><br>
<input type="checkbox" id="zapamti" name="zapamti"><br>
<label for="myCheckbox">Zapamti me</label><br>


<input type="submit" value="Potvrdi">
<button id="zaboravljena" type="button">Zaboravljena lozinka</button> 
</form> 
</div><?php }
}
