<?php
$title = "Login";
require '../header.php';
?>

<h1>Login</h1>

<form action="login.php" method="POST">
<label>Enter your email:</label>
<input type="email" name = 'email'>
<label>Enter your password:</label>
<input type="text" name = 'password'>
<input type="submit" name='submit' value='submit'>
</form>

<?php

if(isset($_POST['submit'])){
    $login = $pdo -> prepare('SELECT username, email, password FROM login WHERE email = :email');

    $values = [
        'email' => $_POST['email']
    ];

    $login -> execute($values);
    $userLogin = $login -> fetch();

    if($login -> rowCount() > 0){
        if($_POST['email'] === $userLogin['email'] && password_verify($_POST['password'], $userLogin['password'])){
            
                $user = $pdo -> prepare('SELECT * FROM login WHERE email = :email');
                $values = [
                    'email' => $_POST['email']
                ];
                $user -> execute($values);
                $user_id = $user -> fetch();

                $_SESSION['loggedIn'] = $user_id['loginId'];
                if($user_id['admin'] == 1){
                    $_SESSION['isAdmin'] = $user_id['admin'];
                    echo 'admin logged in ';
                }
                echo 'you have been logged in ' . $user_id['username'];
        }
        else{
            echo 'email or password is incorrect';
        }
    } 
    
}

$sidebarNeeded = true;
require '../footer.php';
?>