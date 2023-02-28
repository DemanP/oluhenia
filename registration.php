<?php

ob_start();
session_start();
$data = [];
if (!$_POST['first_name']) {
    $data = ['error' => 'Error, please fill all required fields'];
} else {
    $data = $_POST;
}

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

$ciphering_value = "AES-128-CTR";
$encryption_key = "Oluhenia";
$encryption_pass = openssl_encrypt($_POST['pass'], $ciphering_value, $encryption_key, iv: 1010101010101010);

if (isset($_POST['email'])) {
    $sql = "SELECT pass FROM users WHERE email = '{$_POST["email"]}'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $conn->query("INSERT INTO users (first_name, last_name, father_name, gender, dob, email, pass) VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}', '{$_POST['father_name']}', {$_POST['gender']}, '{$_POST['birthday']}', '{$_POST['email']}', '{$encryption_pass}')");
    } else {
        echo json_encode(['error' => "Email already exists"]);
        exit();
    }
}

// $sql = "SELECT * FROM users";
// $line = '';


// if ($result = $conn->query($sql)) {
    
//     while($obj = $result->fetch_object()){
        
//         $line .= $obj->email. ' ' . $obj->pass . '<br />';
        
//     }
    
// }

CloseCon($conn);

$exp_days = 7;
setcookie("logged_in", true, time() + 86400 * $exp_days, "/");
setcookie("email", $email, time() + 86400 * $exp_days, "/");

echo json_encode($data);
exit();

?>