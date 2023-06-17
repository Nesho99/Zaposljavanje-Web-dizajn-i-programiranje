<?php
/* Smarty version 4.3.1, created on 2023-06-17 02:02:34
  from 'C:\xampp\htdocs\templates\registracija.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_648cf81a226a67_58790055',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70f68c929d5e47dafa8af0eea39c928fc24b6309' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\registracija.tpl',
      1 => 1686960109,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_648cf81a226a67_58790055 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="glavni">
<form id="registracija" action="api/registracija.php" method="post">
<label for="ime">Ime:</label><br>
<input type="text" id="ime" name="ime"><br>
<label for="prezime">Prezime</label><br>
<input type="text" id="prezime" name="prezime"><br>
<label for="kime">Korisnicko ime</label><br>
<input type="text" id="kime" name="kime"><br>
<label for="kime">Email</label><br>
<input type="text" id="email" name="email"><br>
<label for="lozinka">Lozinka</label><br>
<input type="password" id="lozinka" name="lozinka"><br>
<label for="plozinka">Ponovljena lozinka</label><br>
<input type="password" id="plozinka" name="plozinka"><br>
<div class="g-recaptcha" data-sitekey="6Lfp06QmAAAAADQx0Ne_sLa3joEFa0SqTVq2hx9V"></div>
<input type="submit" value="Potvrdi">
</form> 
</div><?php }
}
