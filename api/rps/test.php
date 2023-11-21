<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = new mysqli('localhost', 'username', '', 'users');
$link->set_charset('utf8mb4'); // always set the charset
$name = $_GET["uname"];
$stmt = $link->prepare("SELECT score FROM `users` WHERE `uname` LIKE '$uname limit 1");
$stmt->bind_param('s', $name);
$stmt->execute();
$result = $stmt->get_result();
$value = $result->fetch_object();
$_SESSION['score'] = $value->score;
?>