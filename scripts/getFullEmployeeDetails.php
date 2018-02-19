<?php
// Contributions by: Aman Dhoot
/**
 * Created by PhpStorm.
 * User: adhoot
 * Date: 03/02/2018
 * Time: 15:46
 * Gets all information for the users in the system, and outputs a json file with this information
 */
require('connect.php');

$sql = 'SELECT * FROM Users RIGHT JOIN Employees ON Users.employeeID = Employees.employeeID';

$result = $conn->query($sql);

if ($conn->error) die($conn->error);


while($row = $result->fetch_object()) {
    $rows[]=$row;
}

echo json_encode($rows);
