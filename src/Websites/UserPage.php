<?php
session_start();
require_once '../src./connection.php';

if (!isset($_SESSION['userId'])) {
    header('Location: Websites/LogIn.php');
}

$userSession = $_SESSION['userId'];
$Userlogged = User::loadUserById($connect, $userSession);

//Strona ma pokazać wszystkie wpisy danego użytkownika (dodatkowo pod każdym liczbę komentarzy do danego wpisu).
?>

<html lang="eng">
    <head>
    <titile> User's tweets </title>
</head>
<body>
    <h1> please see the tweets of this user </h1>
    <div>
        <?php
        echo('<h2>Użytkownik: ' . $loggedUser->getUsername() . '</h2>');
        $usersTweets = Tweet::loadAllTweetsByUserId($userId, $connection);
        foreach ($usersTweets as $tweet) {
            $user = User::loadUserById($id, $conn);
            echo $tweet->getCreationDate();
            echo $user->getUsername() . ' added tweet. <br> Content:';
            echo $tweet->getText() . '<br><br>';
        }

        //viewing comments to this tweet
        $comments = Comment::loadAllCommentsByPostId($PostId, $connection);
        $authorComment = User::loadUserById($id, $conn);


        echo ' Author of the comment:' . $authorComment->getUsername() . '<br>';
        echo ' Posted: ' . $comments->getCreationDate() . "<br>";
        echo ' Content:' . $comments->getText() . "<br><br>";
        ?>

    </div>
    </html>