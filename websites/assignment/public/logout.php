<?php
$title = "Logout";
require '../header.php';

if(isset($_SESSION['loggedIn'])){
    $user = $pdo -> prepare('SELECT * FROM login WHERE loginId = :id');
    $values = [
        'id' => $_SESSION['loggedIn']
    ];
    $user -> execute($values);
    $user_id = $user -> fetch();

    if($user -> rowCount() > 0){
        echo 'you have been logged out ' . $user_id['username'];
        unset($_SESSION['loggedIn']);
        unset($_SESSION['isAdmin']);
    }
}

else{
    echo 'you are not logged in';
}

$sidebarNeeded = true;
require '../footer.php';
?>