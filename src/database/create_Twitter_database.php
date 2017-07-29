<?php

$servername = "localhost";
$username = "root";
$password = 'coderslab';

//łacze sie z baza danych
$connect = new mysqli($servername, $username, $password);

//sprawdzam czy polaczenie sie udalo
if ($connect->connect_error){
    die('połączenie z bazą danych nie udało się');
}
else {
    echo "połącznie z bazą danych udane";
}

$sql = 'CREATE DATABASE Twitter';
$result = $connect ->query($sql);

if ($result != FALSE) {
    echo "Baza danych Twitter została stwrzona";
}
 else {
    echo "Błąd podaczas tworzenia bazy danych";
}

