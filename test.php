<?php
$mailto = "dpurnomo@outlook.com";
$mailsubject = $_SESSION['username'] . ' just logged in';
$mailbody = '<b>'. $_SESSION['firstname'] . ' '. $_SESSION['lastname'] . '</b> just logged in!';
$mailbodyalt = $_SESSION['firstname'] . ' '. $_SESSION['lastname'] . ' just logged in!';
include_once ('gmail.php');
?>