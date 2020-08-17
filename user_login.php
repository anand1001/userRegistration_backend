<?php

include 'db_config.php';
$conn = OpenCon();

$postData = json_decode(file_get_contents('php://input'));
$postData = (array) $postData;

$sql = "SELECT * FROM users_details where username = '".$postData['username']."' and password='".$postData['password']."' limit 1 ";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    $i=0;
    while($row = $result->fetch_assoc()) {
        $data[$i]['id'] = $row['id'];
        $data[$i]['name'] = $row['name'];
        $data[$i]['username'] = $row['username'];
        $data[$i]['file_path'] = $row['file_path'];
        $i++;
    }
} else {
    echo json_encode(0);exit;
}

CloseCon($conn);
echo json_encode($data);exit;
?>