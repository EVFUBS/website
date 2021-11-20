<?php
$title = "Add Article";
require '../header.php';
?>

<h1>Add Article</h1>
<form action="addArticle.php" method="POST">
    <label>Title</label>
    <input type="text" name="title">
    <label>Article Content</label>
    <textarea name="content"></textarea>
    <label>Select Catergory</label>
    <select name="catergory">
        <?php
            $options = $pdo -> prepare('SELECT * FROM catergory');
            $options ->execute();
            while($option = $options -> fetch()){
                echo '<option value="' . $option['catergoryId'] . '">' . $option['name'] . '</option>';
            }
        ?>
    </select>
    <input type="submit" name="submit" value="submit">
</form>

<?php
if(isset($_POST['submit'])){
    $insert = $pdo -> prepare('INSERT INTO article(title, content, catergoryId, publishDate) VALUES(:title, :content, :catergoryId, :date)');

    $values = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'catergoryId' => $_POST['catergory'],
        'date' => date('Y-m-d')
    ];

    $insert -> execute($values);
}

require '../footer.php'
?>