<?php

session_start();
require_once("/app/Utils/utils.php");
checkAdmin();
require_once("/app/Requests/articles.php");


$article = preg_match('/^[0-9]+$/', $_GET['id'] ?? '') ? findOneArticleById($_GET['id']) : null;

if (!$article) {
    header("Location: /admin/articles/index.php");
    $_SESSION['messages']['danger'] = "Article introuvable";
    exit(302);
}
// Vérification de la soumission du formulaire et que les champs obligatoires ne sont pas vides 
if (
    !empty($_POST['title'])
    && !empty($_POST['description'])
) {
    // Nettoyage des données
    $title = strip_tags($_POST['title']);
    $description = strip_tags($_POST['description']);
    $id = $article['id'];
    $titleNoExist = !findOneByTitle($title);
    var_dump($article);

    if ($title !== $article['title'] && $titleNoExist) {
        if (updateArticle($title, $description, $id)) {
            $_SESSION['message']['success'] = "L'article a bien ete modifie";
            // header("Location: /admin/articles/index.php");
            // exit(302);
        } else {
            $_SESSION["message"]["error"] = "Une erreur est survenue";
        }

    } else {
        $errorMessage = "aieaieaieaie";
    }
}
// Verfication des contraintes SQL

// si l'email qu'on veut changer est different de l'ancien (changeEmail=false)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
        <?php require_once '/app/public/Layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="title text-center">Modifier l'article <?= $article['title']; ?></h1>
            <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST" class="card mt-4">
                <!-- Je recupere la super globale Serveur et dedans je recupere l'uri (l'url dynamique de la page, donc l'url de la page actuelle + id dans les parametre GET ) -->
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?= $errorMessage ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" name="title" id="title" required placeholder="Mon super article"
                        value="<?= $article['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Nom</label>
                    <input type="text" name="description" id="description" required placeholder="Once upon a time..."
                        value="<?= $article['description']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>


            </form>

        </section>

    </main>
</body>

</html>