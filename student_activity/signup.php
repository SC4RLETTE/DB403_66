<?php
  session_start();
  require 'connect.php';
  if (isset($_POST['submit'])) {
    $StudentID = $_POST['StudentID'];
    $StudentName = $_POST['StudentName'];
    $Major = $_POST['majorID'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    
    $sql = "insert into 
      student (studentID, studentName, majorID, password) 
      values('{$StudentID}','{$StudentName}',
             '{$Major}','{$password}')";
    try {
      $conn->query($sql);
      $_SESSION['user'] = [
        'studentID'=>$StudentID,
      'studentName'=>$StudentName
    ];
      header('location:index.php');
      exit;
      }
    catch(mysqli_sql_exception) {
      $err = "StudentID $StudentID ซ้ำฮะ.";
    }
    catch(Exception){
      $err = $e;
    }
  }     
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Activity signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
      html,body {
        height: 100%;
      }

      .form-signup {
        max-width: 330px;
        padding: 1rem;
      }

      .form-signup .form-floating:focus-within {
        z-index: 2;
      }
    </style>
    
    <script>
      function validate() {
        let p1 = document.querySelector('#password').value;
        console.log(p1);
        let p2 = document.querySelector('#re-password').value;
        console.log(p2);
        if (p1 != p2) {
          alert('Password are not identical.');
          event.preventDefault();
        }
      }  
    </script>

  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signup w-100 m-auto">

      <!-- form -->
      <form action="signup.php" method="post" onsubmit="validate()">

        <img class="mb-4" src="image\activity-logo-913-6531.png" alt="" width="300" height="250">
        <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
<?php
if(isset($err)){
  echo "<div class='alert alert-danger'>$err</div>";
}
?>
        <!-- Student ID -->
        <div class="form-floating mb-3">
          <input required name="StudentID" type="text" class="form-control" id="stuID" placeholder="">
          <label for="student-ID">Student ID</label>
        </div>

        <!-- Student Name -->
        <div class="form-floating mb-3">
          <input  name="StudentName" type="text" class="form-control" id="stuName" placeholder="">
          <label for="student Name">Student Name</label>
        </div>

        <!-- Major -->
        <div class="form-floating mb-3">

            <!-- select -->
            <select required name="majorID" class="form-select" id="major">
                <?php 
                    $sql = 'select * from major order by faculty';
                    $result= $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "<option value='{$row['majorID']}'>
                        {$row['faculty']}-{$row['majorName']} 
                        </option>";
                    }
                $conn->close(); 
                ?>
            </select>

            <!-- <input type="select" class="form-control" id="floatingEmail" placeholder=""> -->
          <label for="Major">Major</label>
        </div>

        <!-- Password -->
        <div class="form-floating mb-3">
          <input required name="password" type="password" class="form-control" id="password" placeholder="">
          <label for="password">Password</label>
        </div>

        <!-- Retype Password -->
        <div class="form-floating mb-3">
          <input required type="password" class="form-control" id="re-password" placeholder="">
          <label for="Retype Password">Retype Password</label>
        </div>

        <!-- submit -->
        <button name="submit" class="btn btn-primary w-100 py-2 mb-3" type="submit">Sign up</button>
        <!-- <p class="mt-5 mb-3 text-body-secondary">© 2017–2023</p> -->
      </form>

    </main>
    <!-- Bootstrap script --> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>