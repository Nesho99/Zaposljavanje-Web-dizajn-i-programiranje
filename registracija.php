<?php
require_once("pomocne/smarty.php");

$smarty->assign('naslov', 'Registrcija');


$smarty->display('header.tpl');
$smarty->display('registracija.tpl');
$smarty->display('footer.tpl');
?>