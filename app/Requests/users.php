<?php 
require_once '/app/config/mysql.php';
/**
 * Récupérer tous les utilisateurs en BDD
 * @return array
 */
function findAllUsers():array 
{
 global $db;
 
//  $query = "SELECT * FROM users";

//  $sql = $db->query($query);

//  return $sql->fetchAll();
return $db
->query('SELECT * FROM users')
->fetchAll();
}
/**
 * Récuperer un utilisateur en BDD en filtrant par son email
 * @param string $email Email de l'utilisateur à rechercher
 * @return bool|array
 */
function findOneUserByEmail(string $email):bool|array{
    global $db;
    // $sql = $db->query("SELECT * FROM users WHERE email = '$email'"); Interdit risque d'injection SQL
    // On prepare la requete SQL pour eviter l'injection
    $sql = $db->prepare("SELECT * FROM users WHERE email = :email");
    // On execute la requete en passant en paramétre le email qui est un parametre dynamique
    $sql->execute([
        // tableau associatif des parametres à verifier
        'email'=> $email
    ]);

    return $sql->fetch();

}
?>