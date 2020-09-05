
<?php include "includes/admin_header.php"?>
    
    <?php 
    
        if(isset($_SESSION['username'])){
            
            $edit_profile_id = $_SESSION['user_id'];
            $query = "SELECT * FROM users WHERE user_id = $edit_profile_id";
            $fetch_users_query = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_assoc($fetch_users_query)){
                    
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_role = $row['user_role'];
                    $username = $row['username'];
                    $user_email = $row['user_email'];
                    $user_password = $row['user_password'];
                    $user_image = $row['user_image']; 
        
        
            }
            
        }


        
        if(isset($_POST['update_profile'])){
        
        $edit_profile_id = $_SESSION['user_id'];
        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        
        
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_temp, "../images/$user_image");
        
        if(empty($user_image)){
            $query = "SELECT * FROM users";
            $select_image = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_image)){
                $user_image = $row['user_image'];
            }
        }
        
        $query = "UPDATE users SET user_firstname='$user_firstname',user_lastname='$user_lastname', ";
        $query .= "user_role='$user_role', username='$username', user_email='$user_email',";
        $query .= "user_password = '$user_password', user_image='$user_image' ";
        $query .= "WHERE user_id = $edit_profile_id";
        
        $update_user_query = mysqli_query($connection, $query);
        confirm($update_user_query);
        
        header("Location: index.php");
        
    }


    ?>

    <div id="wrapper">

        <!-- Navigation -->
        
        <?php include "includes/admin_navigation.php"?>
        
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Adarsh</small>
                        </h1>
                        
                        
                    </div>
                    
                    
                     
<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" value="<?php echo $user_firstname;?>" name="user_firstname" class="form-control">
    </div>
        
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" value="<?php echo $user_lastname;?>" name="user_lastname" class="form-control">
    </div> 
    
    <div class="form-group">
       <label for="user_role">Role</label>
        <select name="user_role" id="" class="form-control">
        <option value="admin"><?php echo $user_role;?></option>
        
        <?php 
        
            if($user_role == 'admin'){
                echo "<option value='subscriber'>subscriber</option>";
            }else{
                echo "<option value='admin'>admin</option>";
            }
                
        ?>
        
        
        </select>    
    </div>   
    
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?php echo $username;?>" name="username" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" value="<?php echo $user_email;?>" name="user_email" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" value="<?php echo $user_password;?>" name="user_password" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="user_image">Profile Pic</label><br>
        <img src="../images/<?php echo $user_image?>" alt="" width="100" height="100">
    </div>
    <div class="form-group">
        <label for="user_image">Change Profile Pic</label>
        <input type="file" name="user_image" class="form-control">
    </div>
    
    <div class="form-group">
        <input type="submit" name="update_profile" value="Update Profile" class="btn btn-success btn-md">
    </div>
</form>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        </div>

    <?php include "includes/admin_footer.php"?>