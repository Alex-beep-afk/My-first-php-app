<?php 
session_start();
require_once '/app/Utils/utils.php';
checkAdmin();

// Récuperer le user 
require_once '/app/Requests/users.php';

$user = !empty($_GET['id']) && preg_match('/^[0-9]+$/',$_GET['id'] ?? '') ? findOneUserById($_GET['id']): null;

if (!$user) {
    $_SESSION['messages']['danger'] = "User introuvable";
    header('Location: /admin/users/index.php');
    exit(302);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My first App PHP</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
        <?php require_once '/app/public/Layout/_messages.php'; ?>
        
    </main>
</body>

</html>