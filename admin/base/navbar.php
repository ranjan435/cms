<?php
session_start();?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid container">
    <a class="navbar-brand" href="#">MY CMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Admin</a>
        </li>
        <?php if(!$_SESSION["logged_in"]){?>
          <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
        <?php } 
          else{?>
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">Manage</a>
            </li>
      </ul>
        Welcome,<?php echo $_SESSION["user_name"]?>
      <?php } ?>
    </div>
  </div>
</nav>

