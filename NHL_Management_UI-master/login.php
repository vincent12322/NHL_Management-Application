<?php
  session_start();
  if(isset($_POST['email'])) {

    require('db.php');

    $user = checkUserLogin($_POST['email'], $_POST['password']);

    if($user) {
      $_SESSION['loggedIn'] = true;
      $_SESSION['userId'] = $user['id'];
      header('Location: index.php'); // This will redirect you to home
    } else {
      echo "Invalid Credentials";
    }
  }
  $page = 'Login';
  require('navbar.php');
  require('header.php');
?>

<div class="banner"></div>
<form action="login.php" method="post" class="loginForm">
  <h2><b>Login</b></h2>
  <hr>
  <label for="email"><b>Email: </b></label>
  <input type="email" name="email" placeholder="email..." value="">
  <br>
  <label for="password"><b>Password: </b></label>
  <input type="password" name="password" placeholder="password..." value="">
  <br>
  <div class="button3">
    <button>Login</button>
  </div>
  <div class="button4">
    <a href="signup.php" class="button3">Sign Up</a>
  </div>
</form>
<br>


<?php require('footer.php') ?>
