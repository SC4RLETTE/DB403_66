<?php
  session_start();
  if (isset($_POST['submit'])) {
    require 'connect.php';
    $studentID = $_POST['student_ID'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM student WHERE studentID='{$studentID}'";
    try{
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      if($row) {
        if (password_verify ($password, $row['password'])) {
          $_SESSION['user'] = ['studentID'=>$row['studentID'],
          'studentName'=>$row['studentName']
        ];
          header('location:index.php');
          exit;
        }
        else{
          // Password ผิด
          $err = ('ว้ายยยย Password ผิดไปใส่ใหม่!!');
        }
      }
        else{
          // ID ผิด
          $err = ('ว้ายยยย ใส่ผิด นึกดีๆแล้วใส่ใหม่ !!');
      }
    }
    catch(Exception $e) {
      echo $e;
    }
    finally {
      $conn->close();
    }
  }
  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Activity signin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <style>
      html,body {
        height: 100%;
      }

      .form-signin {
        max-width: 330px;
        padding: 1rem;
      }

      .form-signin .form-floating:focus-within {
        z-index: 2;
      }

      .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }

      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }

    </style>
    
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
      <form method="post">
      <img class="mb-4" src="image\activity-logo-913-6531.png" alt="" width="300" height="250">
        <!-- <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
<?php
  if (isset($err)){
    echo "<div class='alert alert-danger'>$err</div>";
  }
?>
        
        <!-- ID -->
        <div class="form-floating">
          <input name="student_ID" type="text"  class="form-control" id="floatingEmail" placeholder="Email address">
          <label for="floatingEmail">Student ID</label>
        </div>

        <!-- Password -->
        <div class="form-floating">            
          <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>

        <!-- Button -->
        <button name="submit" class="btn btn-primary w-100 py-2"  type="submit">Sign in</button>
        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="signup.php" class="link-danger">Register</a></p>
        <!-- <p class="mt-5 mb-3 text-body-secondary">© 2017–2023</p> -->
      </form>
    </main>
    <!-- Bootstrap script --> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>