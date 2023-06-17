<?php
require_once("pomocne/smarty.php");

$smarty->assign('naslov', 'Prijava');


$smarty->display('header.tpl');
$smarty->display('prijava.tpl');
$smarty->display('footer.tpl');
?>