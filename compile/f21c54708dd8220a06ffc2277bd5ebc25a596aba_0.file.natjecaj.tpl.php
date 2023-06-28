<?php
/* Smarty version 4.3.1, created on 2023-06-28 22:48:29
  from 'C:\xampp\htdocs\templates\natjecaj.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_649c9c9d4a23c2_54281396',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f21c54708dd8220a06ffc2277bd5ebc25a596aba' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\natjecaj.tpl',
      1 => 1687985307,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_649c9c9d4a23c2_54281396 (Smarty_Internal_Template $_smarty_tpl) {
?>
<style>
ul {
    list-style-type: none;
}
img {
    height: 300px; 
}
</style>

<div id="kontenjer">
    <h1><?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->naziv;?>
</h1><br>
    <i>Trajanje od: <?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->datumVrijemePocetak;?>
 do <?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->datumVrijemeKraj;?>
</i><br/>
    <h3><?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->poduzece;?>
</h3>
    <p>OPIS: <?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->opis;?>
</p>
    <form action="api/natjecaji/prijava.php" method="post" enctype="multipart/form-data">
        <label for="slika">Izaberite sliku:</label>
        <input type="file" id="slika" name="slika" accept="image/jpeg">
        <input type="hidden" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['natjecaj']->value->id;?>
">
        <?php if ($_smarty_tpl->tpl_vars['status']->value == null) {?>
            <button name="Posalji" id="Posalji">Pošalji</button>
            <?php } elseif ($_smarty_tpl->tpl_vars['status']->value != $_smarty_tpl->tpl_vars['natjecaj']->value->id) {?>
            <button name="Posalji" id="Posalji" disabled>Pošalji</button>
            <?php } elseif ($_smarty_tpl->tpl_vars['status']->value == $_smarty_tpl->tpl_vars['natjecaj']->value->id) {?>
                <button name="Azuriraj" id="Azuriraj">Ažuriraj</button>
                <button name="Obrisi" id="Obrisi">Obriši</button>
       
            

                
        <?php }?>
        
    </form>

    <ul>
<?php if (!empty($_smarty_tpl->tpl_vars['kandidati']->value)) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kandidati']->value, 'k');
$_smarty_tpl->tpl_vars['k']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value) {
$_smarty_tpl->tpl_vars['k']->do_else = false;
?>
        <li>
        <img src="data:image/jpeg;base64,<?php echo $_smarty_tpl->tpl_vars['k']->value->slika;?>
"/>/ <br/>
        <p><?php echo $_smarty_tpl->tpl_vars['k']->value->korisnickoIme;?>
</p>
       </li>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>
   
    </ul>
</div>
<?php }
}
