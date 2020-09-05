<?php

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

function users_online(){
    
        if(isset($_GET['onlineusers'])){
    
        global $connection;
        
        if(!$connection){
            session_start();
            include "../includes/db.php";
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;


            $query = "SELECT * FROM users_online WHERE session = '$session'";   
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if($count == NULL){
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
            }else{
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session='$session'");
            }

            $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            $count_users = mysqli_num_rows($users_online);

            echo $count_users;
            }
        }    
    
}

users_online();

function confirm($checkfor){
    global $connection;
    if(!$checkfor){
            die("Insert post query failed.".mysqli_error($connection));
        }
}


function insert_categories(){
    
global $connection;    
    
if(isset($_POST['submit'])){
        $add_cat_title = $_POST['cat_title'];
        if($add_cat_title=="" || empty($add_cat_title)){
            echo "*This field should not be empty!";
        }else{
        $query = "INSERT INTO categories values('', '$add_cat_title')";
        $cat_res = mysqli_query($connection, $query);
            if(!$cat_res){
                die("Adding Category Query Failed".mysqli_error($connection));
            }  
        }
    }
    
    
}


function delete_category(){
    
    global $connection;
    
    if(isset($_GET['delete'])){
       $cat_delete_id = $_GET['delete'];
       $query = "DELETE FROM categories WHERE cat_id = $cat_delete_id";
       $delete_query = mysqli_query($connection, $query);
       if(!$delete_query){die("Delete Query Failed!".mysqli_error($connection));}

       header("Location: categories.php");
   }
    
}




?>