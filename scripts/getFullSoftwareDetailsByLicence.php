// Contributions by: Jess McCreery
<?php

require('connect.php');

$licencenumber = $_REQUEST['licencenumber'];

$sql = "SELECT * FROM Software WHERE licenceNumber = '$licencenumber'";

$result = $conn->query($sql);

if ($conn->error) die($conn->error);


echo json_encode($result->fetch_object());
