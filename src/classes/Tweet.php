<?php

class Tweet {
    private $id;
    private $userId;
    private $text;
    private $creationDate;
    
    public function __construct() {
        $this->id=-1;
        $this->userId=0;
        $this->text="";
        $this->creationDate="";
               
    }
    
    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getText() {
        return $this->text;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    static public function loadTweetById($id, mysqli $connection) {
        $sql = 'SELECT * FROM Tweet WHERE id = ' . $id;
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $loadedTweet = new Tweet();
            $loadedTweet->assignValues($row['id'], $row['userId'], $row['text'], $row['CreationDate']);

            return $loadedTweet;
        } else {
            return null;
        }
    }
static public function loadAllTweetsByUserId($userId, mysqli $connection) {
        $sql = "SELECT * FROM Tweet WHERE userId = '$userId'";
        $result = $connection->query($sql);
        $tweets = [];
        if ($result == true && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];
                $tweets[] = $loadedTweet;
            }
        }
        return $tweets;
    }
    static public function loadAllTweets($connection) {
        $sql = "SELECT * FROM Tweet";
        $result = $connection->query($sql);
        $tweets = [];
        if ($result == true && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];
                $tweets[] = $loadedTweet;
            }
        }
        return $tweets;
    }
    public function saveToDB($connection) {
        if ($this->id == -1) {
            $sql = "INSERT INTO Tweet (id, userId, text, creationDate) 
                    VALUES (null, $this->userId, '$this->text', '$this->creationDate')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        }
        return false;
    }
}
