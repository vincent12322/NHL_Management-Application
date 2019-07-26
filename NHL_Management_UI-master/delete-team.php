<?php
  $id = $_GET['id'];
  session_start();
  if(!isset($_SESSION['userId'])) header('Location: login.php');

  require('db.php');

  deleteTeamById($id);

  header('Location: teams.php');
