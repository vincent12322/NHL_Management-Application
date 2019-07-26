<?php

session_start();
// Defaults
$page = 'Team';
$action = 'Create';

$team = [
  'name' => '',
  'location' => '',
  'userId' => '',
  'picture' => '',
];

if (!isset($_SESSION['userId'])) {
  header('Location: login.php');
} else {
  require('db.php');
  require('header.php');
}

if (isset($_GET['id'])) {
  $action = 'Update';
  $team = getTeamById($_GET['id']);
}
else $action = 'Create';


if (isset($_POST['name'])) {
  if($action == 'Create') createTeam($_POST, $_SESSION['userId']);
  else {
      updateTeam(
        $_POST['name'],
        $_POST['location'],
        $_POST['picture'],
        $_GET['id']
        );
      }
}
require('navbar.php');
?>

<div class="banner4"></div>
<div class="button1">
  <a href="teams.php">Back to Teams</a>
</div>



  <form method="post" class="create">
    <h2><?php echo $action ?> Team</h2>
    <hr>
    <label class="space" for="name"><b>Name: </b></label>
    <input type="text" name="name" value="<?php echo $team['name'] ?>">
    <br>
    <br>
    <label for="location"><b>Location: </b></label>
    <input type="text" name="location" value="<?php echo $team['location'] ?>">
    <br>
    <br>
    <label for="picture"><b>Logo: </b></label>
    <input type="text" name="picture" value="<?php echo $team['picture'] ?>">
    <br>
    <button class="button2">Add</button>
  </form>
  <?php require('footer.php'); ?>
