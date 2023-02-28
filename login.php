<?php

$email = $_POST["email"];
$password = $_POST["pass"];

header("Content-Type: application/json");

function OpenCon()
{
    // $dbhost = "192.168.0.1";
    // $dbuser = "oluhenia_users";
    // $dbpass = "2304Py1984";
    // $db = "oluhenia_users";
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "oluhenia_users";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

    return $conn;
}
 
function CloseCon($conn)
{
    $conn -> close();
}

$conn = OpenCon();

$sql = "SELECT pass FROM users WHERE email = '{$email}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $real_pass = $row['pass'];

    $ciphering_value = "AES-128-CTR";
    $encryption_key = "Oluhenia";
    $real_pass = openssl_decrypt($real_pass, $ciphering_value, $encryption_key, iv: 1010101010101010);
    
    if($real_pass == $password) {
        $data = $_POST;
    } else {
        echo json_encode(['error' => "Wrong password"]);
        exit();
    }
} else {
    echo json_encode(['error' => "Wrong email"]);
    exit();
}

CloseCon($conn);

$exp_days = 7;
setcookie("logged_in", true, time() + 86400 * $exp_days, "/");
setcookie("email", $email, time() + 86400 * $exp_days, "/");

echo json_encode($data);
exit();

?>