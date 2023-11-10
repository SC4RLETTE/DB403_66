<?php
session_start();
require 'connect.php';

$sql = "SELECT available
        FROM activity
        WHERE activityID = {$_GET['id']}
        AND available > 0";
$result = $conn->query($sql);
if($result->num_rows > 0) {
   $conn->begin_transaction();

try{
$sql= "INSERT INTO register
            (studentID,activityID)
        VALUES
            ('{$_SESSION['user']['studentID']}',
            {$_GET['id']})";
    $conn->query($sql);
    $sql = "UPDATE activity 
            SET available = available-1
            WHERE activityID = {$_GET['id']}";
    $conn->query($sql);
    $conn->commit();
    echo json_encode(
        ['status'=>"Register Completed."]
      );    
    }

catch(Exception $e){
    $conn->rollback();
    echo json_encode(
        ['status' => $e->getMessage()]
    );   
  }
}

else{
  echo json_encode(
    ['status'=>"Activity {$_GET['id']}".
               "is not available."]
  );
}







