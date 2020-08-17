<?php

include 'db_config.php';
$conn = OpenCon();

$postData = json_decode(file_get_contents('php://input'));
$postData = (array) $postData;

$data = array();
$data['name'] = $postData['firstName']." ".$postData['lastName'];
$data['username'] = $postData['userName'];
$data['password'] = $postData['password'];
$data['file_name'] = $postData['userName']."_".$postData['fileName'];

$sql = "INSERT INTO users_details (name,username,password,file_path) values ('".$data['name']."','".$data['username']."','".$data['password']."','".$data['file_name']."')";
$result = $conn->query($sql);

if($conn->insert_id > 0 && $result ){
    $img = str_replace('data:image/jpeg;base64,','',$postData['file']);
    $img = str_replace(' ', '+',$img);
    echo file_put_contents('./uploaded_file/'.$data['file_name'], base64_decode($img));

    CloseCon($conn);
    echo json_encode(1); exit;
}else{
    
    CloseCon($conn);
    echo json_encode(0); exit;
}

?>