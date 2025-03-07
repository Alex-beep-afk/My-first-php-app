<?php
require_once '/app/config/mysql.php';
/**
 * Récupérer tous les utilisateurs en BDD
 * @return array
 */
function findAllUsers(): array
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
 * Summary of findOneUserById
 * @param int $id
 * @return bool|array
 */
function findOneUserById(int $id): bool|array
{

    global $db;

    $query = "SELECT * FROM users WHERE id = :id";
    $sql = $db->prepare($query);
    $sql->execute([
        'id' => $id,
    ]);
    return $sql->fetch();


}
/**
 * Récuperer un utilisateur en BDD en filtrant par son email
 * @param string $email Email de l'utilisateur à rechercher
 * @return bool|array
 */
function findOneUserByEmail(string $email): bool|array
{
    global $db;
    // $sql = $db->query("SELECT * FROM users WHERE email = '$email'"); Interdit risque d'injection SQL
    // On prepare la requete SQL pour eviter l'injection
    $sql = $db->prepare("SELECT * FROM users WHERE email = :email");
    // On execute la requete en passant en paramétre le email qui est un parametre dynamique
    $sql->execute([
        // tableau associatif des parametres à verifier
        'email' => $email
    ]);

    return $sql->fetch();

}

function createUser(string $firstName, string $lastName, string $email, string $password): bool
{
    global $db;
    try {
        $query = "INSERT INTO users( first_name, last_name, email, password ) VALUES (:firstName, :lastName, :email , :password)";
        $sql = $db->prepare("$query");
        $sql->execute([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_ARGON2I),
        ]);
    } catch (PDOException $e) {
        return false;
    }

    return true;


}
/**
 * Mets à jour un user en BDD
 * @param int $id
 * @param string $firstname
 * @param string $lastname
 * @param string $email
 * @param null|string $password
 *  
 * @return bool Retourne true si la mise à jour a fonctionné
 */
function updateUser(int $id, string $firstname, string $lastname, string $email, ?string $password): bool
{   // La requete SQL que l'on doit executer
    // UPDATE users SET first_name = :firstName, last_name = :lastName, email = :email WHERE id = :id
    // On importe notre connection à la base de données 
    global $db;
    // Debut de la query qui ne changeras pas 
    $query = 'UPDATE users SET first_name = :firstName, last_name = :lastName, email = :email';
    // Tableau de parametres dynamiques
    $params = [
        'firstName' => $firstname,
        'lastName' => $lastname,
        'email' => $email,
    ];
    if (!empty($password)) {
        $query .= ', password = :password';
        $params['password'] = password_hash($password, PASSWORD_ARGON2I);
    }

    $query .= ' WHERE id = :id';
    $params['id'] = $id;

    try {
        $sql = $db->prepare($query);
        $sql->execute($params);
    } catch (PDOException $e) {
        return false;
    }
    
    return true;
}
function deleteUser(int $id): bool
{
    global $db;
    try {
        $query = "DELETE FROM users WHERE id = :id";
        $sql = $db->prepare($query);
        $sql->execute([
            'id' => $id,
        ]);
        return true;

    } catch (PDOException $e) {
        return false;


    }

}



?>