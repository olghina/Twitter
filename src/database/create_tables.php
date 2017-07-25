<?php
// na poczatku lacze sie z baza danych Twitter 
$servername = "localhost";
$username = "root";
$basename = 'Twitter';
$password = '';

//łacze sie z baza danych
$connect = new mysqli($servername, $username, $basename, $password);


//tworze Tabele Users

$sql = "CREATE TABLE 'Users' (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(255) NOT NULL UNIQUE,
    hashed_password VARCHAR (255) NOT NULL,
        )";

$result = $connect->query($sql);
if($result === TRUE){
    echo ("Tabela Users została stworzona");
}
else{
    ("Błąd podczas tworzenia tabeli Users!" . "<br>" . $connect->error);
}
echo "<br>";


//Tabela Tweet 

$sql = "CREATE TABLE 'Tweet'(
    id INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    text varchar(140) NOT NULL,
    creationDate DATE NOT NULL,
    PRIMARY KEY id
    FOREIGN KEY (id) REFERENCES Users(id)
    )";


// Table Comment

$sql = "CREATE TABLE 'Comment'(
    id INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    postId INT NOT NULL,
    text varchar(140) NOT NULL,
    creationDate DATE NOT NULL,
    PRIMARY KEY id,
    FOREIGN KEY (id) REFERENCES Users(id),
    FOREIGN KEY (id) REFERENCES Tweet (id),
    )";
