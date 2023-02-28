<?php

if(isset($_COOKIE['logged_in']) && ($_COOKIE['email'] == "n1dearnold@gmail.com" || $_COOKIE['email'] == "ofpythoncoder@gmail.com")) {
    echo $_COOKIE['email'];
}
else {
    echo false;
}

?>