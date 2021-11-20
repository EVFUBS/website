<?php
$title = "Edit Catergory";
require '../header.php';

$catergories = $pdo -> prepare('SELECT * FROM catergory WHERE catergoryId = :id');
if(isset($_GET['catergoryId'])){
    $values =[
    'id' => $_GET['catergoryId']
    ];
    $catergories -> execute($values);
    $catergory = $catergories -> fetch();
}
else{
    $values =[
        'id' => $_POST['id']
    ];
    $catergories -> execute($values);
    $catergory = $catergories -> fetch();
}


if(isset($_POST['submit'])){
    $editCatergory = $pdo -> prepare('UPDATE catergory SET name = :name WHERE catergoryId = :id');
    $values = [
        'name' => $_POST['name'],
        'id' => $_POST['id']
    ];

    $editCatergory -> execute($values);
}
?>

<h1>Edit Article</h1>
<form action='editCatergory.php' method="POST">
    <input type="hidden" name="id" value="<?php echo $catergory['catergoryId']; ?>">
    <label>Title</label>
    <input type="text" name="name" value="<?php echo $catergory['name']; ?>">
    <input type="submit" name="submit" value="submit">
</form>

<?php
require '../footer.php';
?>