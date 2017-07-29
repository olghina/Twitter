<?php

// connecting to Twitter database

$servername = "localhost";
$username = "root";
$basename = 'Twitter';
$password = 'coderslab';

//łacze sie z baza danych
$connect = new mysqli($servername, $username, $basename, $password);

//including all the classes written

require_once dirname(__FILE__).'/../classes/User.php';
require_once dirname(__FILE__).'/../classes/Tweet.php';
require_once dirname(__FILE__).'/../classes/Comment.php';
require_once dirname(__FILE__).'/../classes/Message.php';