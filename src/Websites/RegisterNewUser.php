<?php
session_start();
require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $username = trim($_POST['email']);
    $password = trim($_POST['password']);
}
if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username'])) {
    $user = new User();
    $user->setUsername(trim($_POST['username']));
    $user->setEmail(trim($_POST['email']));
    $user->setHashedPassword(trim($_POST['password']));

    if ($user->saveToDB($connect)) {
        echo ("New user registered");
    } else {
        echo ("user failed to register!");
    }
}
?>

<html lang="en">
    <form>
        <label for ="username"> username </label>
        <input type ="text" name ="username" id="username"
               placeholder ="enter your username"
               <label for = "email"> E-mail:</label>

        <input type = "text" name = "email" id = "e-mail"

               placeholder = "enter  your e-mail">

        <label>Password:

            <input type = "text" name = "password"

                   placeholder = "enter your password"></label>

        <input type = "submit" value = "Wyślij">

    </form>

