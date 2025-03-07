<?php
session_start();
require_once '/app/Utils/utils.php';
checkAdmin();

// Récuperer le user 
require_once '/app/Requests/users.php';

$user = preg_match('/^[0-9]+$/', $_GET['id'] ?? '') ? findOneUserById($_GET['id']) : null;

if (!$user) {
    $_SESSION['messages']['danger'] = "User introuvable";
    header('Location: /admin/users/index.php');
    exit(302);
}
// Vérification de la soumission du formulaire et que les champs obligatoires ne sont pas vides 
if (
    !empty($_POST['firstName'])
    && !empty($_POST['lastName'])
    && !empty($_POST['email'])

) {
    // Nettoyage des données
    $firstname = strip_tags($_POST['firstName']);
    $lastname = strip_tags($_POST['lastName']);
    $email = strip_tags($_POST['email']);
    $password = $_POST['password'] ?? null;

    // Verfication des contraintes SQL
    // si l'email qu'on veut changer est different de l'ancien (changeEmail=false)
    $changeEmail = $email !== $user['email'];

    if (!$changeEmail || !findOneUserByEmail($email)) {
        // Si l'utilisateur a changé d'email Verifier que l'email n'est pas deja enregistré en base de données 
        if (updateUser($user['id'], $firstname, $lastname, $email, $password)) {
            $_SESSION['messages']['success'] = "User modifié avec succés";
            // On redirige l'utilisateur vers la liste des users
            header('Location: /admin/users');
            
            exit(302);
        } else {
            $errorMessage = "Une erreur est survenue";
        }
    }else {
        $errorMessage = "Cet email est deja utilisé";
    }
    
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
        <section class="container mt-4">
            <h1 class="title text-center">Modifier l'utilisateur <?= $user['first_name']; ?></h1>
            <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST" class="card mt-4">
                <!-- Je recupere la super globale Serveur et dedans je recupere l'uri (l'url dynamique de la page, donc l'url de la page actuelle + id dans les parametre GET ) -->
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?= $errorMessage ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="firstName">Prénom</label>
                    <input type="text" name="firstName" id="firstName" required placeholder="John"
                        value="<?= $user['first_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Nom</label>
                    <input type="text" name="lastName" id="lastName" required placeholder="Doe"
                        value="<?= $user['last_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required placeholder="john@exemple.com"
                        value="<?= $user['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="S3CR3T">
                </div>

                <button type="submit" class="btn btn-primary">Modifier</button>


            </form>

        </section>

    </main>
</body>

</html>