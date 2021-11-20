<?php
$title = "Admin Article";
require '../header.php';
if(isset($_SESSION['isAdmin'])){
    

    $articles = $pdo -> prepare('SELECT * FROM article');
    $articles -> execute();

    echo '<a href="addArticle.php">Add Article</a>';
    echo '<ul>';
    while($article = $articles -> fetch()){
        echo '<li>';
        echo '<a href="index.php?articleId=' . $article['articleId'] . '">' . $article['title'] . '</a>';
        echo ' ';
        echo '<a href="editArticle.php?articleId=' . $article['articleId'] . '">Edit</a>';
        echo ' ';
        echo '<a href="deleteArticle.php?articleId=' . $article['articleId'] .'">Delete</a>';
        echo '</li>';
    };
    echo '</ul>';
}
require '../footer.php';
?>