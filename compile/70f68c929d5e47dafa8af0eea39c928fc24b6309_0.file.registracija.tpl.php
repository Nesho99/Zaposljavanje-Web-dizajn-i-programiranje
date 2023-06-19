<?php
/* Smarty version 4.3.1, created on 2023-06-19 16:01:22
  from 'C:\xampp\htdocs\templates\registracija.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_64905fb208fb80_36699938',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70f68c929d5e47dafa8af0eea39c928fc24b6309' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\registracija.tpl',
      1 => 1687183003,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64905fb208fb80_36699938 (Smarty_Internal_Template $_smarty_tpl) {
?><h1> Registracija </h1>
<div id="glavni">
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
