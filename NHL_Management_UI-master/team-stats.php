<?php $page = 'Stats'; session_start();?>
<?php require('header.php'); ?>
<?php require('navbar.php'); ?>
<?php $id = $_GET['id']; ?>
<?php require('db.php'); ?>
<?php $team = getTeamId($id);
      $players = getAllPlayersFromTeam($id);
?>
<div class="banner"></div>
<h1><?php echo $team['name']; ?></h1>
</div>
<div class="logo2">
  <img src="<?php echo $team['picture'] ?>" alt="">
</div>
<div class="logo">
  <img src="<?php echo $team['picture'] ?>" alt="">
</div>
<div class="button">
  <a href="create-player.php?team_id=<?php echo $team['id'] ?>">Add Player</a>
</div>
<table>
  <tr class="mainTable">
    <th>Name</th>
    <th>Number</th>
    <th>Age</th>
  </tr>
  <?php foreach ($players as $player) { ?>
    <tr>
      <th><?php echo $player['name'] ?></th>
      <th><?php echo $player['number'] ?></th>
      <th><?php echo $player['age'] ?>
        <div class="link3">
          <a href="create-player.php?id=<?php echo $player['id'] ?>&update=true&team_id=<?php echo $id ?>">Update</a>
        </div>
        <div class="link2">
          <a href="delete-player.php?id=<?php echo $player['id'] ?>&team_id=<?php echo $id ?>">Delete</a>
        </div>
      </th>
    </tr>
  <?php } ?>
</table>
<?php require('footer.php'); ?>
