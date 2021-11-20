<?php
$title = "Manage Admins";
require '../header.php';
if(isset($_SESSION['isAdmin'])){
    $admins = $pdo -> prepare('SELECT * FROM login WHERE admin = 1');
    $admins -> execute();

    echo '<h1>Manage Admins</h1>';

    echo '<a href="addAdmin.php">Add Admin</a>';
    echo '<ul>';
    while($admin = $admins -> fetch()){
        echo '<li>';
        echo '<p>'. $admin['username'] .'</p>';
        echo ' ';
        echo '<a href="editAdmin.php?loginId=' . $admin['loginId'] . '">Edit</a>';
        echo ' ';
        echo '<a href="deleteAdmin.php?loginId=' . $admin['loginId'] .'">Delete</a>';
        echo '</li>';
    };
    echo '</ul>';
}
require '../footer.php';
?>