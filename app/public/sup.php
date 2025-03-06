<?php 
session_start();
$id = $_SESSION['user']['id'];
require_once '/app/Requests/users.php';
removeUser($id);
unset($_SESSION['user']);
header('Location: /login.php');
exit(302);
?>