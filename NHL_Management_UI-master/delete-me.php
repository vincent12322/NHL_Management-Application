<?php
  session_start();

  if(!isset($_SESSION['userId'])) header('Location: login.php');

  require('db.php');

  $teams = getTeamsByUserId($_SESSION['userId']);
  deleteUserById($_SESSION['userId']);

  foreach ($teams as $team) {
    deleteTeamById($team['id']);
  }

  header('Location: logout.php');
