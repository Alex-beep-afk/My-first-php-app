<?php
session_start();

require_once '/app/Utils/utils.php';
checkAdmin();

require_once("/app/Requests/articles.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des articles| My first app PHP</title>
    <link rel="stylesheet" href="/assets/styles/main.css">

</head>
<body>
<?php require_once '/app/public/Layout/_header.php'; ?>
        <main>
            <?php require_once '/app/public/Layout/_messages.php'; ?>
            <section class="container mt-4">
                <h1 class="text-center">Administration des articles</h1>
            </section>
            <table class="card mt-4">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titre</th>
                        <th>description</th>
                        <th>Date de création</th>
                        <th>En ligne</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (findAllArticles() as $article): ?>
                        <tr>
                            <td><?= $article['id']; ?></td>
                            <td><?= $article['title']; ?></td>
                            <td><?= $article['description']; ?></td>
                            <td><?= $article['created_at']; ?></td>
                            <td><?= $article['enabled']; ?></td>
                            
                            <td>
                                <div class="table-btn">
                                    <a href="/admin/articles/update.php?id=<?= $article['id']; ?>"
                                        class="btn btn-secondary">Modifier</a>
                                    <form action="#" method="GET" onsubmit="return confirm ('Etes vous sur ?')">
                                        <input type="hidden" name="id" value="<?= $article['id']; ?>">
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </main>
</body>
</html>