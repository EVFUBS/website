<?php
$title = "Delete Catergory";
require '../header.php';
?>
<h1>Delete Catergory</h1>
<?php
$deleteCatergories = $pdo -> prepare('DELETE FROM catergory WHERE catergoryId = :id');

if(isset($_GET['catergoryId'])){
    $values = [
        'id' => $_GET['catergoryId']
    ];
    $deleteCatergories -> execute($values);
    echo 'Caterogry has been deleted';
}


require '../footer.php';
?>