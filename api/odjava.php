<?php
require_once("../pomocne/Sesija.class.php");

// Set the expiration date to one hour ago
setcookie("prijava_sesija", "", time() - 3600, "/");
unset($_COOKIE['prijava_sesija']);
header("Location: ../index.php");



?>