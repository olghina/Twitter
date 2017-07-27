<?php

class Message {

    private $id;
    private $creationDate;
    private $text;
    private $messageRead;
    private $senderId;
    private $receiverId;

    public function __construct() {
        $this->id = -1;
        $this->messageRead = 0;
        $this->text = "";
        $this->creationDate = "";
        $this->senderId = "";
        $this->receiverId = "";
    }

    function getId() {
        return $this->id;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function getText() {
        return $this->text;
    }

    function getMessageRead() {
        return $this->messageRead;
    }

    function getSenderId() {
        return $this->senderId;
    }

    function getReceiverId() {
        return $this->receiverId;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setMessageRead($messageRead) {
        $this->messageRead = $messageRead;
    }

    function setSenderId($senderId) {
        $this->senderId = $senderId;
    }

    function setReceiverId($receiverId) {
        $this->receiverId = $receiverId;
    }

    public function saveToDB($connection) {
        if ($this->id == -1) {
            $sql = "INSERT INTO Message (id, text, creationDate, messageRead, senderId, receiverId) 
                    VALUES ($this->id, $this->text, '$this->creationDate, $this->messageRead, $this->senderId, $this->receiverId')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        }
        return false;
    }

    static public function loadMessageBySenderId($senderId, mysqli $connection) {
        $sql = 'SELECT * FROM Messages WHERE senderId = '.$senderId;
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $loadedMessage = new Message();
            $loadedMessage->assignValues($row['id'], $row['messageRead'], $row['text'], $row['creationDate'], $row['senderId'],$row['receiverId'] );

            return $loadedMessage;
        } else {
            return null;
        }
    }
static public function loadMessageByReceiverId($receiverId, mysqli $connection) {
        $sql = 'SELECT * FROM Messages WHERE receiverId = '.$receiverId;
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $loadedMessage = new Message();
            $loadedMessage->assignValues($row['id'], $row['messageRead'], $row['text'], $row['creationDate'], $row['senderId'],$row['receiverId'] );

            return $loadedMessage;
        } else {
            return null;
        }
    }
    
    }
    