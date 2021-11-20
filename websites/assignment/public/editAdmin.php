<?php
$title = "Edit Admin";
require '../header.php';

if(isset($_SESSION['isAdmin'])){
    if(isset($_POST['submit'])){
        $editLogin = $pdo -> prepare('UPDATE login SET username = :username, password = :password, email = :email, admin = :admin WHERE loginId = :id');
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $values = [
            'username' => $_POST['username'],
            'password' => $hashedPassword,
            'email' => $_POST['email'],
            'admin' => $_POST['admin'],
            'id' => $_POST['id']
        ];

        $editLogin -> execute($values);
    }
}
else{
    echo 'you are not an Admin';
}

$logins = $pdo -> prepare('SELECT * FROM login WHERE loginId = :id');
if(isset($_GET['loginId'])){
    $values =[
    'id' => $_GET['loginId']
    ];
    $logins -> execute($values);
    $login = $logins -> fetch();
}
else{
    $values =[
        'id' => $_POST['id']
    ];
    $logins -> execute($values);
    $login = $logins -> fetch();
}



?>

<h1>Edit Article</h1>
<form action='editAdmin.php' method="POST">
    <input type="hidden" name="id" value="<?php echo $login['loginId']; ?>">
    <label>Username:</label>
    <input type="text" name="username" value="<?php echo $login['username']; ?>">
    <label>Password:</label>
    <input type="text" name="password">
    <label>Email:</label>
    <input type="text" name="email" value="<?php echo $login['email']; ?>">
    <label>Admin:</label>
    <select name="admin">
        <?php
            if($login['admin'] == 0){
                echo '<option value="0" selected>user</option>';
                echo '<option value="1">administrator</option>';
            }
            else if($login['admin'] == 1){
                echo '<option value="0">user</option>';
                echo '<option value="1" selected>administrator</option>';
            }
        ?>
        
    </select>
    <input type="submit" name="submit" value="submit">
</form>

<?php
require '../footer.php';
?>