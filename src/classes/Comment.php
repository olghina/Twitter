<?php

class Comment {
    private $id;
    private $userId;
    private $postId;
    private $creationDate;
    private $text;
           
    
    public function __construct() {
        $this->id=-1;
        $this->userId=0;
        $this->text="";
        $this->creationDate="";
        $this->postId="";
               
    }
    
    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getPostId() {
        return $this->postId;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function getText() {
        return $this->text;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setPostId($postId) {
        $this->postId = $postId;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    function setText($text) {
        $this->text = $text;
    }

        static public function loadCommentById($id, mysqli $connection) {
        $sql = 'SELECT * FROM Comment WHERE id = ' . $id;
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $loadedComment = new Comment();
            $loadedComment->assignValues($row['id'], $row['userId'], $row['text'], $row['CreationDate'], $row['postId']);

            return $loadedComment;
        } else {
            return null;
        }
    }
static public function loadAllCommentsByPostId($PostId, mysqli $connection) {
        $sql = "SELECT * FROM Comments WHERE PostId = '$PostId'";
        $result = $connection->query($sql);
        $comments = [];
        if ($result == true && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->userId = $row['userId'];
                $loadedComment->text = $row['text'];
                $loadedComment->creationDate = $row['creationDate'];
                $loadedComment->userId = $row['PostId'];
                $comments[] = $loadedComment;
            }
        }
        return $comments;
  
    }
    public function saveToDB($connection) {
        if ($this->id == -1) {
            $sql = "INSERT INTO Comment (id, userId, postId, text, creationDate) 
                    VALUES ($this->id, $this->userId, $this->postId, '$this->text', '$this->creationDate')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        }
        return false;
    }
}


