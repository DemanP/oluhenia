<?php

echo("At least tried connecting");

function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "test";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

    return $conn;
}
 
function CloseCon($conn)
{
    $conn -> close();
}

$conn = OpenCon();

if (isset($_POST['email'])) {
	$random = rand(5, 15);
	$conn->query("INSERT INTO users (first_name, last_name, father_name, gender, dob, email, pass) VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}', '{$_POST['father_name']}', {$_POST['gender']}, '{$_POST['birthday']}', '{$_POST['email']}', '{$_POST['pass']}')");
}

$sql = "SELECT * FROM users";
$line = '';


if ($result = $conn->query($sql)) {

    while($obj = $result->fetch_object()){

        $line .= $obj->email. ' ' . $obj->pass . '<br />';

    }

}

CloseCon($conn);

header("Location: index.html");

?>
