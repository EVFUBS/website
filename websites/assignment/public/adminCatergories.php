<?php
$title = "Admin Catergories";
require '../header.php';
if(isset($_SESSION['isAdmin'])){
    

    $catergories = $pdo -> prepare('SELECT * FROM catergory');
    $catergories -> execute();

    echo '<a href="addCatergory.php">Add Catergory</a>';
    echo '<ul>';
    while($catergory = $catergories -> fetch()){
        echo '<li>';
        echo '<p>' . $catergory['name'] . '</p>';
        echo '<a href="editCatergory.php?catergoryId=' . $catergory['catergoryId'] . '">Edit</a>';
        echo ' ';
        echo '<a href="deleteCatergory.php?catergoryId=' . $catergory['catergoryId'] .'">Delete</a>';
        echo '</li>';
    };
    echo '</ul>';
}
require '../footer.php';
?>