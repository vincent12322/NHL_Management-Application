<?php

if (isset($_POST['email'])) {
  if ($_POST['password'] != $_POST['confirm']) {
    header('Location: signup.php');
  }
  else {
      require('db.php');
      saveUser($_POST['email'], $_POST['password']);
      header('Location: login.php');
  }
}
  $page = 'Sign Up';
  require('header.php');
  require('navbar.php');
?>

<div class="banner">

</div>
  <form method="post" action="signup.php" class="loginForm">
    <h2><b>Sign Up</b></h2>
    <hr>
    <label for="email"><b>Email: </b></label>
    <input type="email" name="email" placeholder="email..." value="">
    <br>
    <label for="password"><b>Password: </b></label>
    <input type="password" name="password" placeholder="password..." value="">
    <br>
    <label for="confirm"><b>Confirm Password: </b></label>
    <input type="password" name="confirm" placeholder="confirm password..." value="">
    <br>
    <div class="button3">
        <button>Sign Up</button>
    </div>
  </form>
  <?php require('footer.php'); ?>
