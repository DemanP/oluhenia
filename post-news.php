<?php

if(!(isset($_COOKIE['logged_in']) && ($_COOKIE['email'] == "n1dearnold@gmail.com" || $_COOKIE['email'] == "ofpythoncoder@gmail.com"))) {
    exit();
}

$filename = $_FILES["choosefile"]["name"];
$tempname = $_FILES["choosefile"]["tmp_name"];
$title = $_POST["title"];
$text = $_POST["text"];

$i = 0;
while (file_exists("news/".$i.".txt")) $i++;

$txt_file = fopen("news/".$i.".txt", "w");
fwrite($txt_file, $title."\n".$text);
fclose($txt_file);

$filename_parts = explode(".", $filename);

$folder = "news/".$i.".".end($filename_parts);
move_uploaded_file($tempname, $folder);

header("Location: index.html");

?>