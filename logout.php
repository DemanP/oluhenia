<?php

unset($_COOKIE['logged_in']); 
setcookie('logged_in', null, -1, '/'); 

echo "Success";

header("Location: index.html");

?>