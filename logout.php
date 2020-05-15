<?php
session_start();


$_SESSION['valid'] = false;
unset($_SESSION["id"]);
unset($_SESSION["name"]);
unset($_SESSION["phone"]);
unset($_SESSION["address"]);
unset($_SESSION["landmark"]);
unset($_SESSION["mail"]);

header("Location:profile.php");
?>