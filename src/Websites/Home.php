<?php
session_start();
require_once '../src./connection.php';

if (!isset($_SESSION['userId'])) {
    header('Location: Websites/LogIn.php');
}

$userSession = $_SESSION['userId'];
$Userlogged = User::loadUserById($connect, $userSession);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['newTweet']) && strlen(trim($_POST['newTweet'])) > 0) {
    $tweet = new Tweet();
    $tweet->setText($_POST['newTweet']);
    $tweet->setUserId($userSession);
    $tweet->setCreationDate(date('Y-m-d H:i:s'));

    if ($tweet->saveToDB($connect)) {
        echo 'New tweet from user: ' . $Userlogged->getUsername() . '<br>' . 'Tweet content: '
        . $_POST['newTweet'] . '<br>';
    } else {
        echo 'please try again';
    }
}
?>
<html lang ="en">
    <head>
        <title> Twitter by Olghina </title>
    </head>
    <body>
        <div>
            <p> add new Tweet! </p>
            <form action method="POST">
                <label for ="newTweet"> your tweet </label>
                <input type ="text" name ="newTweet" id="newTweet"
                       placeholder ="enter your Tweet here, 140 characters only">
                <input type = "submit" value = "add">

            </form>
        </div>
        <div>
            <p> list of all tweets </p>
            <?php
            $tweets = Tweet::loadAllTweets($connection);
            foreach ($tweets as $tweet) {
                $authorTweetId = $tweet->getUserId();
                $authorTweet = User::loadUserById($id, $conn);
                echo $authorTweet->getUsername() . '<br> added tweet at time:' .
                $tweet->getCreationDate() . '<br> Content:' .
                $tweet->getText();
            }

            //viewing comments to this tweet
            $comments = Comment::loadAllCommentsByPostId($PostId, $connection);
           $authorComment = User::loadUserById($id, $conn);
                   
                   
            echo ' Author of the comment:' . $authorComment->getUsername() . '<br>';
            echo ' Posted: ' . $comments->getCreationDate() . "<br>";
            echo ' Content:' . $comments->getText() . "<br><br>";
            ?>

        </div>

    </body>
</html>
