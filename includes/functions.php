<?php

function confirm($check){
    global $connection;
    if(!$check){
        die("Query Failed!".mysqli_error($connection));
    }
}

?>