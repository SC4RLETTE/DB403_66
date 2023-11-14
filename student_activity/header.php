<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:signin.php');
    exit;
}
require 'connect.php';
?>
<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Activity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Icon link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  </head>

  <body>
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="./index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <img src="image\activity-logo-913-6531.png" alt="" width="150" height="50">
        <span class="ms-4 fs-4">Simple header</span>
      </a>

        <!-- Nav -->
      <ul class="nav nav-pills">
        <li class="nav-item"><a id="nav-activity" href="index.php" class="nav-link">Activity</a></li>
        <li class="nav-item"><a id="nav-report" href="report.php" class="nav-link">Report</a></li>
      </ul>

      <!-- Drop down -->
      <div class="dropdown text-end ms-3">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle show" data-bs-toggle="dropdown" aria-expanded="true">
<?php

$sql = "SELECT image 
        FROM student
        WHERE studentID=
        '{$_SESSION['user']['studentID']}'";
$result = $conn->query($sql);
$image = $result->fetch_assoc()['image'];
if($image) {
  echo "<img src='profile/$image'
        class='rounded-circle' height='42'>";
}
else {
  echo  '<span class="material-symbols-outlined"
        style="font-size:150px;">
        family_star
        </span>';
}        
?>                   

          <!-- <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle"> -->
          </a>
          <ul class="dropdown-menu text-small" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 34px);">
            <li><div class="dropdown-item text-primary"><?php echo $_SESSION['user']['studentName'];?></div></li>
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="signout.php">Sign out</a></li>
          </ul>
       </div>
    </header>












