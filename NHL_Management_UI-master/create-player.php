<?php
session_start();
// Defaults
$page = 'Player';
$action = 'Create';

$player = [
  'name' => '',
  'number' => '',
  'age' => ''
];

if (!isset($_SESSION['userId'])) {
  header('Location: login.php');
} else {
  require('db.php');
  $teamId = $_GET['team_id'];
}


if (isset($_GET['update'])) {
  $action = 'Update';
  $player = getPlayerById($_GET['id']);
} else {
  $action = 'Create';
}

if (isset($_POST['name'])) {
  if($action == 'Create') createPlayer($_POST, $teamId);
  else {
    updatePlayerById($_GET['id'], $_POST['name'], $_POST['age'], $_POST['number'], $teamId);
  }
  header('Location: team-stats.php?id='.$teamId);
}

require('header.php');
require('navbar.php');
?>

<div class="banner3"></div>
<div class="button1">
  <a href="team-stats.php?id=<?php echo $teamId ?>">Back to Team</a>
</div>

  <form method="post" class="create">
    <h2><?php echo $action ?> Player</h2>
    <hr>
    <label for="name"><b>Name: </b></label>
    <input type="text" name="name" value="<?php echo $player['name'] ?>">
    <br>
    <label for="number"><b>Number: </b></label>
    <input type="text" name="number" value="<?php echo $player['number'] ?>">
    <br>
    <label for="age"><b>Age: </b></label>
    <input type="text" name="age" value="<?php echo $player['age'] ?>">
    <br>
    <button class="button2"><?php echo $action ?></button>
  </form>

  <?php require('footer.php'); ?>
