<?php
// si l'on veut recuperer la session de l'utilisateur toujours au début de la page
session_start();

require_once '/app/Requests/users.php';


// Vérifier si le formulaire a été soumis et que les données ne sont pas vides
if (
    !empty($_POST["email"])
    && !empty($_POST["password"])
)
// Recupere les informations envoyés par le formulaire    
{
    $email = strip_tags($_POST["email"]);
    $password = $_POST["password"];
    $user = findOneUserByEmail($email);
    // Recuperer l'utilisateur en BDD

    if ($user && password_verify($password,$user['password'])) {
        // On stock l'utilisateur dans en session
        $_SESSION['user'] = [
            'id'=> $user['id'],
            'firstName'=> $user['first_name'],
            'lastName'=> $user['last_name'],
            'email'=> $user['email'],
            'roles'=> json_decode($user['roles'] ?? '')
            // Ternaire si l'objet json que je veux decoder est null ?? alors je veux lui passer une chaine de caractere vide
        ];
        header('Location: /');
        exit(302);
    } else {
        $errorMessage = "Identifiants incorrects";
    }
}








// Verifier si le mot de passe est correct

// On connecte l'utilisateur
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
        <section class="container mt4">
            <h1 class="title text-center"> Se connecter</h1>
            <form action="/login.php" method="POST" class="card mt4 mx-auto w-50">
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?= $errorMessage ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required placeholder="john@exemple.com">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="text" name="password" id="password" required placeholder="S3CR3T">
                </div>
                <button class="btn btnprimary">Se connecter</button>
            </form>
        </section>
    </main>
</body>

</html>