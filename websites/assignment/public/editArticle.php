<?php
$title = "Edit Article";
require '../header.php';

$articles = $pdo -> prepare('SELECT * FROM article WHERE articleId = :id');
if(isset($_GET['articleId'])){
    $values =[
    'id' => $_GET['articleId']
    ];
    $articles -> execute($values);
    $articleInfo = $articles -> fetch();
}
else{
    $values =[
        'id' => $_POST['id']
    ];
    $articles -> execute($values);
    $articleInfo = $articles -> fetch();
}


if(isset($_POST['submit'])){
    $editArticles = $pdo -> prepare('UPDATE article SET title = :title, content = :content, catergoryId = :catergory WHERE articleId = :id');
    $values = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'catergory' => $_POST['catergory'],
        'id' => $_POST['id']
    ];

    $editArticles -> execute($values);
}
?>

<h1>Edit Article</h1>
<form action='editArticle.php' method="POST">
    <input type="hidden" name="id" value="<?php echo $articleInfo['articleId']; ?>">
    <label>Title</label>
    <input type="text" name="title" value="<?php echo $articleInfo['title']; ?>">
    <label>Article Content</label>
    <textarea name="content"><?php echo $articleInfo['content']; ?></textarea>
    <label>Select Catergory</label>
    <select name="catergory">
        <?php
            $options = $pdo -> prepare('SELECT * FROM catergory');
            $options ->execute();
            while($option = $options -> fetch()){
                if($option['catergoryId'] == $articleInfo['catergoryId']){
                    echo '<option value="' . $option['catergoryId'] . '"selected>' . $option['name'] . '</option>';
                }
                else{
                    echo '<option value="' . $option['catergoryId'] . '">' . $option['name'] . '</option>';
                }
            }
        ?>
    </select>
    <input type="submit" name="submit" value="submit">
</form>

<?php
require '../footer.php';
?>