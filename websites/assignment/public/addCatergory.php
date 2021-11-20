<?php
$title = 'Add Catergories';
require '../header.php';

if(isset($_POST['submit'])){
    $addCatergory = $pdo -> prepare('INSERT INTO catergory(name) VALUES(:name)');
    $values = [
        'name' => $_POST['name']
    ];
    $addCatergory -> execute($values);
}
?>
<h1>Add Catergory</h1>
<form action="addCatergory.php" method="POST">
    <label>Enter new Catergory</label>
    <input type="text" name="name"> 
    <input type="submit" name="submit" value="submit">
</form>

<?php
require '../footer.php';
?>