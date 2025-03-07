<?php
session_start();

require_once '/app/Utils/utils.php';

checkAdmin();

require_once '/app/Requests/users.php';
// Recuperer le user grace à $_POST
// On gére les cas d'erreurs si l'id n'est pas un nombre ou si l'utilisateur n'existe pas 
$user = preg_match('/^[0-9]+$/', $_POST['id'] ?? '') ? findOneUserById($_POST['id']) : null;

// Si l'utilisateur n'existe pas on redirige
if (!$user) {
    $_SESSION['messages']['danger'] = "User introuvable";
    header('Location: /admin/users');
    exit(302);
}
if (deleteUser($user['id'])) {
    header('Location: /admin/users');
    $_SESSION['messages']['success'] = "Utilisateur supprimé";
    
    exit(302);

} else {
    header('Location: /admin/users');
    $_SESSION["messages"]["error"] = "un probléme est survenu";
    
    exit(302);
}
?>