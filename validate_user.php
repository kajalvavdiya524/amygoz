
<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 

$user=$_REQUEST['username'];
$servername = "localhost";
$username = "root";
$password = "Call2016it#";
$dbname = 'ipintooc_main';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn)
{
	$sql = "SELECT * FROM users WHERE username = '".$user."'";

$result = $conn->query($sql);
//print_r($result);
if ($result->num_rows > 0) {
    // ou1tput data of each row
    $data = array();
    $data = array('status' => '1');
    echo json_encode($data);
} 
else {
    $data = array();
    $data = array('status' => '0');
    echo json_encode($data);
}
}else{
	echo "not connected";
}
$conn->close();

?>