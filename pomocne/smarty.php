<?php
require_once("smarty-4.3.1/libs/Smarty.class.php");
$smarty = new Smarty();
$smarty->setTemplateDir('templates');
$smarty->setConfigDir('configs');
$smarty->setCompileDir('compile');
$smarty->setCacheDir('cache');
$smarty->clearAllCache();
?>