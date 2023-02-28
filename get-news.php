<?php

header("Content-Type: application/json");

$img_extensions = ["png", "jpg", "gif"];

$all_news = array();
$i = 0;
while (file_exists("news/".$i.".txt")) {
    $contents = explode("\n", file_get_contents("news/".$i.".txt"));
    $title = $contents[0];
    unset($contents[0]);
    $text = implode("\n", $contents);

    foreach($img_extensions as $ext) {
        if(file_exists("news/".$i.".".$ext)) {
            $img_ext = $ext;
            break;
        }
    }

    array_push($all_news, ["title" => $title, "text" => $text, "img_path" => "news/".$i.".".$img_ext]);
    $i++;
}

echo json_encode($all_news);

?>