<?php

// Open the session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($page)==false) {
    $page = 'UNKNOWN';
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $page ?></title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One|Space+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  </head>
<body>
