<?php 
require_once '/app/config/mysql.php';

function findAllArticles(){
    global $db;
    $sql = $db->query("SELECT * FROM articles")->fetchAll();
    return $sql;
}
function findOneArticleById(int $id):bool|array{
    global $db;
    $query = " SELECT * FROM articles WHERE id = :id";
    $sql = $db->prepare($query);
    $sql->execute([
        'id'=>$id
    ]);
    return $sql->fetch();
}

function findOneByTitle($title):bool|array{

global $db;
$query = " SELECT * FROM articles WHERE title = :title";
$sql = $db->prepare($query);
$sql->execute([
    'title'=>$title
]);
return $sql-> fetch();

}
function createArticle(string $title, string $description){
    global $db;
    $query = " INSERT INTO articles(title, description) VALUES (:title, :description)";
    try {
        $sql = $db->prepare($query);
        $sql->execute([
        'title'=>$title,
        'description'=>$description
    ]);
    return true;
    } catch (PDOException $e) {
        return false;
    }
    
}

function updateArticle(string $title, string $description,int $id):bool{
    global $db;
    // 'UPDATE articles SET title = :title, description = :description WHERE id = :id'
    $query = 'UPDATE articles SET title = :title, description = :description WHERE id = :id';
    try {
        $sql = $db->prepare($query);
        $sql->execute([
            'title'=>$title,
            'description'=>$description,
            'id'=>$id
        ]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

?>
