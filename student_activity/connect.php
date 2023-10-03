<?php
    $conn = new mysqli('db403-mysql', 'root', 'P@ssw0rd', 'student_activity');

    if($conn->connect_error) {
    echo $conn->connect_error;
    die();
    }
