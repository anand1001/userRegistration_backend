<?php

include 'db_config.php';
$conn = OpenCon();

$username = $_GET['username'];

$sql = "SELECT * FROM users_details where username = '".$username."' ";
$result = $conn->query($sql);

CloseCon($conn);

if ($result->num_rows > 0) {
    echo json_encode(0);exit;
} else {
    echo json_encode(1);exit;
}

?>