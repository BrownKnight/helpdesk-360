<?php

require('connect.php');

var result1 = ('#available-Specialists').val();
var result2 = result1.split(":");
var result3 = result2[0];
var result4 = result1.split(" ");
var result5 = result4[2];

$sql = "SELECT firstName, lastName FROM Employees WHERE employeeID = (SELECT employeeID FROM Users WHERE userID = (SELECT userID FROM Users WHERE userID = result4))";

$result = $conn->query($sql);
if ($conn->error) die ($conn->error);

echo json_encode($result->fetch_all());
