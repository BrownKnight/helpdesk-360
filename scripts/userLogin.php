<?php
session_start();

require('connect.php');

$userID = $_REQUEST['userid'];
$password = $_REQUEST['password'];

$sql = "SELECT * FROM Users LEFT JOIN Employees ON Users.employeeID = Employees.employeeID WHERE userID = '$userID' AND password = '$password'";

$result = $conn->query($sql);
if ($conn->error) die($conn->error);

if ($result->num_rows == 0) {
    echo 'failure';
}

else {
    $employee = $result->fetch_object();
    if ($employee->accessLevel) {
        echo 'specialist';
        $_SESSION['userid'] = $userID;
        $_SESSION['username'] = $employee->firstName." ".$employee->lastName;
        $_SESSION['acesslevel'] = $employee->accessLevel;
    }
    else {
        echo 'both';
        $_SESSION['userid'] = $userID;
        $_SESSION['username'] = $employee->firstName." ".$employee->lastName;
        $_SESSION['acesslevel'] = $employee->accessLevel;
    }
}


