<?php $page = 'Teams'; ?>
<?php require('header.php'); ?>
<?php require('navbar.php'); ?>
<?php require('db.php'); ?>
<?php if (isset($_SESSION['loggedIn'])) {
  $teams = getTeamsByUserId($_SESSION['userId']);
}
?>

<div class="banner"></div>
<div class="button1">
  <a href="index.php">Back to Home</a>
</div>
 <h1>Teams</h1>
 <div class="button">
   <a href="create-team.php">Add Team</a>
 </div>
 <br>
 <br>
<?php if (isset($_SESSION['loggedIn'])) { ?>
  <?php foreach ($teams as $team) { ?>
    <div class="card">
      <img src="<?php echo $team['picture'] ?>">
      <div class="container">
        <h2><b><?php echo $team['name'] ?></b></h2>
        <h4><?php echo $team['location'] ?></h4>
        <div class="link">
          <a href="team-stats.php?id=<?php echo $team['id'] ?>">Players</a>
        </div>
        <div class="link">
          <a href="delete-team.php?id=<?php echo $team['id'] ?>">Delete</a>
        </div>
        <div class="link">
          <a href="create-team.php?id=<?php echo $team['id'] ?>">Update</a>
        </div>
      </div>
    </div>
<?php } }?>
<?php require('footer.php'); ?>
