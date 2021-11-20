<?php
$title = "Login";
require '../header.php';
if(isset($_SESSION['isAdmin'])){

    echo '<h1>Add Admin</h1>';

    echo '<form action="addAdmin.php" method="POST">';
    echo '<label>Enter your email:</label>';
    echo '<input type="email" name = "email">';
    echo '<label>Enter your password:</label>';
    echo '<input type="text" name = "password">';
    echo '<label>Enter your display name:</label>';
    echo '<input type="text" name = "name">';
    echo '<input type="submit" name="submit" value="submit">';
    echo '</form>';

    if(isset($_POST['submit'])){

        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $registration = $pdo -> prepare('INSERT INTO login(username, password, email, admin) VALUES(:name, :password, :email, :admin)');
        $values = [
            'name' => $_POST['name'],
            'password' => $hashed_password,
            'email' => $_POST['email'],
            'admin' => 1
        ];

        $registration -> execute($values);
    }
}



$sidebarNeeded = true;

require '../footer.php';
?>
