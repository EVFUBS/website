<?php
$title = "Latest News";

require '../header.php';

if(isset($_GET['catergoryId'])){
    $sidebarNeeded = true;
    $articles = $pdo -> prepare('SELECT articleId, title, publishDate FROM article WHERE catergoryId = :catergoryId');
    $catergory = $pdo -> prepare('SELECT name FROM catergory WHERE catergoryId = :catergoryId');
    
    $values = [
        'catergoryId' => $_GET['catergoryId']
    ];
    
    $articles -> execute($values);
    $catergory -> execute($values);

    $subTitle = $catergory ->fetch();
    
    echo '<h1>' . $subTitle['name'] . '</h1>';


    echo '<ul>';
    while($x = $articles -> fetch()){
        echo '<li><a href = "index.php?articleId='. $x['articleId'] .'">Article: ' . $x['title'] . ' Publish Date: ' . $x['publishDate'] .'</a></li>';
    };
    echo '</ul>';


}

//articles are written by myself, however I took the news from the BBC:https://www.bbc.co.uk/
else if(isset($_GET['articleId']) || isset($_POST['id'])){
    $sidebarNeeded = true;
    $article = $pdo -> prepare('SELECT * FROM article WHERE articleId = :id');
    $comments = $pdo -> prepare('SELECT * FROM comment WHERE articleId = :id');

    if(isset($_GET['articleId'])){
        $values = [
                'id' => $_GET['articleId']
            ];
    }
    else{
        $values = [
            'id' => $_POST['id']
        ];
    }
    
    $article -> execute($values);
    $comments -> execute($values);

    $articleContent = $article -> fetch();

    echo '<h1>' . $articleContent['title'] . '</h1>';
    echo '<em>' . $articleContent['publishDate'] . '</em>';
    echo '<p>' . $articleContent['content'] . '</p>';
    echo '<h4>Comments</h4>';
    echo '<ul>';
    while($comment = $comments -> fetch()){
        echo '<li><h4><a href="userComments.php?loginId=' . $comment['loginId'] . '">'. $comment['username'] .'</a></h4><em>' . $comment['date'] . '</em><p>' . $comment['content'] .  '</p></li>';
    };
    echo '</ul>';

    if(isset($_SESSION['loggedIn'])){
        $addComment = $pdo -> prepare('INSERT INTO comment(username, content, date, articleId, loginId) VALUES(:username, :content, :date, :articleId, :loginId)');
        $selectUsers = $pdo -> prepare('SELECT * FROM login WHERE loginId = :loginId');
        $user =[
            'loginId' => $_SESSION['loggedIn']
        ];
        $selectUsers -> execute($user);
        $user = $selectUsers -> fetch();
        
        if(isset($_POST['submitComment'])){
            $commentVal = [
            'username' => $user['username'],
            'content' => $_POST['commentText'],
            'date' => date('Y-m-d'),
            'articleId' => $_POST['id'],
            'loginId' => $_SESSION['loggedIn']
            ];

            $addComment -> execute($commentVal);
        }

        if(isset($_GET['articleId'])){
            echo '<form action="index.php" method="POST">';
            echo '<input type="hidden" name="id" value='. $_GET['articleId'] . '>';
            echo '<label>Comment:</label>';
            echo '<textarea name="commentText"></textarea>';
            echo '<input type="submit" name="submitComment" value="submit">';
            echo '</form>';
        }

        if(isset($_POST['id'])){
            echo '<form action="index.php" method="POST">';
            echo '<input type="hidden" name="id" value='. $_POST['id'] . '>';
            echo '<label>Comment:</label>';
            echo '<textarea name="commentText"></textarea>';
            echo '<input type="submit" name="submitComment" value="submit">';
            echo '</form>';
        }
    }
}

else{
    $sidebarNeeded = true;
    $articles = $pdo -> prepare('SELECT title, publishDate FROM article ORDER BY publishDate DESC LIMIT 10');
    $articles -> execute(); 

    echo"<h1>Latest News</h1>";
    echo "<ul>";

    while($x = $articles -> fetch()){
        echo '<li><p>Article: ' . $x['title'] . ' Publish Date: ' . $x['publishDate'] .'</p></li>';
    };
    echo "</ul>";
}






require '../footer.php';
?>