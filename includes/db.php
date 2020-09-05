<?php

    $connection = mysqli_connect('localhost', 'root', '', 'bookreaders');
    if(!$connection){
        die("Connection Failed".mysqli_error($connection));
    }

?>