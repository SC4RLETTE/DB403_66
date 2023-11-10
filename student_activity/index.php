<?php
include 'header.php';
require 'connect.php';
$sql = "SELECT * FROM activity A
        WHERE start >= NOW() AND available > 0
        AND NOT EXISTS (
          SELECT activityID
          FROM register
          WHERE studentID = 
            '{$_SESSION['user']['studentID']}'
          AND activityID = A.activityID
  )";
$result = $conn->query($sql);
?>
    <table class="table">
      <tr>
        <th>Activity Name</th>
        <th>Begin</th>
        <th>End</th>
        <th>Available</th>
        <th></th>
      </tr>
      
      <?php
while($row = $result->fetch_assoc()) {
  echo  "<tr>
  <td>{$row['activityName']}</td>
  <td>{$row['start']}</td>
  <td>{$row['end']}</td>
  <td>{$row['available']}</td>
  <td><button class='btn btn-success btn-sm register' 
  onclick=
    'register({$row['activityID']})'>
      Register
    </button>
  </td>
</tr>";
}
$conn->close();
?>
</table>

  </div>

  <div id="overlay" class="position-fixed top-0 start-0 w-100 h-100 d-none"></div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.getElementById('nav-activity').classList.add('active')
        function register(id) {
          document.querySelector('#overlay').classList.remove('d-none');
          fetch('register.php?id='+id).then(
            data => data.json()
          ).then(
            data => {
            alert(data.status);
            location.reload();
          }
        );
      }
     </script> 
  </body>
</html>