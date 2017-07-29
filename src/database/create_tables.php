<?php
// na poczatku lacze sie z baza danych Twitter 
$servername = "localhost";
$username = "root";
$password = "coderslab";

//łacze sie z baza danych
$connect = new mysqli($servername, $username, $password);

//sprawdzam czy polaczenie sie udalo
if ($connect->connect_error){
    die('połączenie z bazą danych nie udało się');
}
else {
    echo "połącznie z bazą danych udane";
}

//tworze Tabele Users

$sqlUsers = "CREATE TABLE 'Users' (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(255) NOT NULL UNIQUE,
    hashed_password VARCHAR (255) NOT NULL,
        )";

$result = $connect->query($sqlUsers);
if($result === TRUE){
    echo ("Tabela Users została stworzona");
}
else{
    ("Błąd podczas tworzenia tabeli Users!" . "<br>" . $connect->error);
}
echo "<br>";


//Tabela Tweet 

$sqlTweet = "CREATE TABLE 'Tweet'(
    id INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    text varchar(140) NOT NULL,
    creationDate DATE NOT NULL,
    PRIMARY KEY id
    FOREIGN KEY (id) REFERENCES Users(id)
    )";

$result1 = $connect->query($sqlTweet);
if($result1 === TRUE){
    echo ("Tabela Tweet została stworzona");
}
else{
    ("Błąd podczas tworzenia tabeli Tweet!" . "<br>" . $connect->error);
}
echo "<br>";

// Table Comment

$sqlComment = "CREATE TABLE 'Comment'(
    id INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    postId INT NOT NULL,
    text varchar(140) NOT NULL,
    creationDate DATE NOT NULL,
    PRIMARY KEY id,
    FOREIGN KEY (id) REFERENCES Users(id),
    FOREIGN KEY (id) REFERENCES Tweet (id),
    )";
$result2 = $connect->query($sqlComment);
if($result2 === TRUE){
    echo ("Tabela Comment została stworzona");
}
else{
    ("Błąd podczas tworzenia tabeli Comment!" . "<br>" . $connect->error);
}
echo "<br>";

//Table Message

$sqlMessage = "CREATE TABLE 'Message'(
    id INT NOT NULL AUTO_INCREMENT,
    text varchar(140) NOT NULL,
    creationDate DATE NOT NULL,
    MessageRead INT NOT NULL,
    SenderId INT NOT NULL,
    ReceiverId INT NOT NULL,
    PRIMARY KEY id,
    FOREIsGN KEY (Senderid) REFERENCES Users(id),
    FOREIGN KEY (Receiverid) REFERENCES Users(id),
    )";
 
$result3 = $connect->query($sqlMessage);
if($result3 === TRUE){
    echo ("Tabela Message została stworzona");
}
else{
    ("Błąd podczas tworzenia tabeli Message!" . "<br>" . $connect->error);
}
echo "<br>";
