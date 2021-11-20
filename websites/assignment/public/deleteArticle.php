<?php
$title = "Delete Article";
require '../header.php';


?>
<h1>Delete Article</h1>

<?php
$deleteArticles = $pdo -> prepare('DELETE FROM article WHERE articleId = :id');

if(isset($_GET['articleId'])){
    $values = [
        'id' => $_GET['articleId']
    ];
    $deleteArticles -> execute($values);
    echo 'article has been deleted';
}


require '../footer.php';
?>