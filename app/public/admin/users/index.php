<?php session_start(); 
// Utilisation de la session 
// Verifier si l'utilisateur n'est pas admin on redirige

if(empty($_SESSION['user'])
|| !in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) 
{
    // On définit un message d'erreur
    $_SESSION['messages']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";

    // On redirige vers la page de login
    header("Location: /login.php");
    exit(302);
}
?>
<?php require_once '/app/Requests/users.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des users | My first app PHP</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
        <?php require_once '/app/public/Layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="text-center">Administration des users</h1>
        </section>
        <table class ="card mt-4">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom Complet</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (findAllUsers() as $user) : ?>
                    <tr>
                        <td><?= $user['id']; ?></td>
                        <td><?= "$user[first_name] $user[last_name]";?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['roles']; ?></td>
                        <td>
                            <div class = "table-btn">
                            <a href="#" class="btn btn-secondary">Modifier</a>
                            <a href="#" class="btn btn-danger">Supprimer</a>
                            </div>
                            
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>

        </table>
    </main>
</body>

</html>