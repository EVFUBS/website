<?php
$title = "Delete Admin";
require '../header.php';
?>
<h1>Delete Admin</h1>
<?php
if(isset($_SESSION['isAdmin'])){
    $deleteAdmins = $pdo -> prepare('DELETE FROM login WHERE loginId = :id');

    if(isset($_GET['loginId'])){
        $values = [
            'id' => $_GET['loginId']
        ];
        $deleteAdmins -> execute($values);
        echo 'Admin has been deleted';
    }
}

require '../footer.php';
?>