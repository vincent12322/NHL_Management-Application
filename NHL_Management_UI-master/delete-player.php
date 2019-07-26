<?php
  session_start();
  $id = $_GET['id'];
  $teamId = $_GET['team_id'];

  if(!isset($_SESSION['userId'])) header('Location: login.php');

  require('db.php');

  deletePlayerById($id);

  header('Location: team-stats.php?id='.$teamId);
