<?php 
session_start();

require_once("/app/Utils/utils.php");

checkAdmin();

require_once("/app/Requests/articles.php");

if (!empty($_POST['title'])
&& !empty($_POST['description'])){
    $title = strip_tags($_POST['title']);
    $description = strip_tags($_POST['description']);

    if (findOneByTitle($title)) {
        $errorMessage = "Cet article existe deja";
    }else{
        if (createArticle($title, $description)){

            $_SESSION['messages']['success'] = "L'article a bien été crée";
        }else{
            $errorMessage = "Un probleme est survenu lors de la publication de l'article";
        };
        

}}

// Creer un article
// TODO Récuperer les données d'un formulaire pour le titre
// TODO Récuperer les données d'un formulaire pour le contenu
// TODO Nettoyer les données du titre et du contenu
// Verifier que le titre est unique 
// faire une requete pour envoyer l'article en BDD
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Create | My first App PHP</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>
<body>
<?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
    <?php require_once '/app/public/Layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="title text-center">S'inscrire</h1>
            <form action="/admin/articles/create.php" method ="POST" class="card mt-4">
            <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?= $errorMessage ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title"id="title" required placeholder="Mon super article"> 
                </div>
                <div class="form-group">
                    <label for="description">Contenu de l'article</label>
                    <textarea name="description" id="description" required placeholder="Once upon a time..."></textarea>
                </div>
                <button type="submit"class="btn btn-primary">Creer article</button>
                

            </form>

        </section>
    </main>
</body>
</html>