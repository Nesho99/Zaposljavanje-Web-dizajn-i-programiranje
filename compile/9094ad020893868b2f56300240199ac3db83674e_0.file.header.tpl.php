<?php
/* Smarty version 4.3.1, created on 2023-06-19 16:10:23
  from 'C:\xampp\htdocs\templates\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_649061cf95c4e4_25194541',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9094ad020893868b2f56300240199ac3db83674e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\header.tpl',
      1 => 1687183720,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_649061cf95c4e4_25194541 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="stilovi.css">
  <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../js/glavna.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../js/tablica.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://www.google.com/recaptcha/api.js" async defer><?php echo '</script'; ?>
>
  <title><?php echo $_smarty_tpl->tpl_vars['naslov']->value;?>
</title>
</head>

<body>
  <div id="menu">
    <ul>
      <li><a class="naslovna" href="index.php">Naslovna</a></li>

      <?php if (empty($_smarty_tpl->tpl_vars['korisnik']->value)) {?>
        <li><a class="registracija" href="registracija.php">Registracija</a></li>
        <li><a class="prijava" href="prijava.php">Prijava</a></li>
      <?php } else { ?>

        <li style="float:right"><a class="aktivna" href="/api/odjava.php">Odjava</a></li>
        <li id="logiran" style="float: right; color: white; font-size: 30px; padding: 0; margin: 0; margin-right: 5px;">
          <?php echo $_smarty_tpl->tpl_vars['korisnik']->value["korisnik"];?>
</li>

        <?php if ($_smarty_tpl->tpl_vars['korisnik']->value["uloga"] == "admin") {?>
          <li><a class="poduzeca" href="poduzeca.php">Poduzeća</a></li>


        <?php }?>


      <?php }?>








    </ul>
</div><?php }
}
