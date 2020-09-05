<?php session_start();

$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['user_role'] = null;
$_SESSION['email'] = null;
$_SESSION['password'] = null;
$_SESSION['user_id'] = null;

header("Location: ./index.php");


?>