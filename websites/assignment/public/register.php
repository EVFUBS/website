<?php
$title = "Register";
require '../header.php';

if(isset($_POST['submit'])){

    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $registration = $pdo -> prepare('INSERT INTO login(username, password, email) VALUES(:name, :password, :email)');
    $values = [
        'name' => $_POST['name'],
        'password' => $hashed_password,
        'email' => $_POST['email']
    ];

    $registration -> execute($values);

    $user = $pdo -> prepare('SELECT * FROM login WHERE email = :email');
    $values = [
        'email' => $_POST['email']
    ];
    $user -> execute($values);
    $user_id = $user -> fetch();

    $_SESSION['loggedIn'] = $user_id['loginId'];
}
?>

<h1>Register</h1>

<form action="register.php" method="POST">
<label>Enter your email:</label>
<input type="email" name = 'email'>
<label>Enter your password:</label>
<input type="text" name = 'password'>
<label>Enter your display name:</label>
<input type="text" name = 'name'>
<input type="submit" name="submit" value="submit">
</form>

<?php
$sidebarNeeded = true;
require '../footer.php';
?>