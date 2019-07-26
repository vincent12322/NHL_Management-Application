<nav>
  <ul>
    <?php if ($page == 'NHL Home'){?>
    <li class="active"><a href="index.php"><b>NHL Home</b></a></li>
    <?php } else { ?>
    <li class=""><a href="index.php"><b>NHL Home</b></a></li>
    <?php } ?>

    <?php if ($page == 'Teams'){?>
    <li class="active"><a href="teams.php"><b>Teams</b></a></li>
    <?php } else { ?>
    <li class=""><a href="teams.php"><b>Teams</b></a></li>
    <?php } ?>

    <?php if (isset($_SESSION['loggedIn'])){ ?>
    <?php if ($page == 'Profile') { ?>
    <li class="active"><a href="profile.php?id=<?php echo $_SESSION['userId'] ?>"><b>Account</b></a></li>
    <?php } else { ?>
    <li class=""><a href="profile.php?id=<?php echo $_SESSION['userId'] ?>"><b>Account</b></a></li>
    <?php } } ?>


    <?php if(isset($_SESSION['loggedIn'])){ ?>
    <li class="right"><a href="logout.php"><b>Logout</b></a></li>
    <?php } else { ?>
    <li class="right"><a href="login.php"><b>Login</b></a></li>
    <?php } ?>
  </ul>
</nav>
