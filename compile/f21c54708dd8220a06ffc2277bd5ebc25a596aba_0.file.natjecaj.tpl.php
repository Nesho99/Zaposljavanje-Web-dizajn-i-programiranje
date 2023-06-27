<?php
/* Smarty version 4.3.1, created on 2023-06-27 20:34:00
  from 'C:\xampp\htdocs\templates\natjecaj.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_649b2b98e11f08_13886963',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f21c54708dd8220a06ffc2277bd5ebc25a596aba' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\natjecaj.tpl',
      1 => 1687890760,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_649b2b98e11f08_13886963 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="kontenjer">
<h1><?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->naziv;?>
 </h1><br>
<i>Trajanje od: <?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->datumVrijemePocetak;?>
 do <?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->datumVrijemeKraj;?>
<i>
<br/>
<h3> <?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->poduzece;?>
</h3>
<p>OPIS:<?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->opis;?>
</p>
<form action="api/natjecaji/prijava.php">
<label for="img">Izaberite sliku:</label>
  <input type="file" id="slika" name="slika" accept="image/jpeg">
  <input type="hidden" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->id;?>
">

<button id="Posalji">Pošalji</button>
</form>

</div><?php }
}
