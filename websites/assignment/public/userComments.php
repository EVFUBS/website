<?php
$title = "User Comments";
require '../header.php';

$comments = $pdo -> prepare('SELECT * FROM comment WHERE loginId = :loginId ORDER BY articleId DESC');
$commentValues =[
    'loginId' => $_GET['loginId']
];
$comments -> execute($commentValues);

echo '<h2>User Comments</h2>';
echo '<ul>';
while($comment = $comments -> fetch()){
    echo '<li><em>'. $comment['date'] .'</em><p>'. $comment['content'] .'</p></li>';
}
echo '</ul>';

require '../footer.php';
?>