<?php
session_start();
require_once '../src/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $username = trim($_POST['email']);
    $password = trim($_POST['password']);
}
if (!empty($_POST['email']) && !empty($_POST['password'])) {

    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $query = $conn->query($sql);

    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $hashed_password = $row['hashed_password'];
        $checkPassword = password_verify($password, $hashed_password);
        if ($checkPassword) {
            $_SESSION['id'] = $row['id'];
            //header("Location: ../tbd");
        }
    }
} else {
    echo "wrong username or password, please try again";
}
?>

<!DOCTYPE html>
<html lang="en">
    <form>

        <label for = "email">Username:</label>

        <input type = "text" name = "email" id = "Username"

               placeholder = "Please provide your e-mail">

        <label>Password:

            <input type = "text" name = "password"

                   placeholder = "Please provide your password"></label>

        <input type = "submit" value = "Wyślij">

    </form>

