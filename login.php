<?php include("includes/header.php")?>
<head><link type="text/css" href="css/login2.css" rel="stylesheet" /></head>

<?php

    if(isset($_POST['login_btn'])){
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        if(empty($email) || empty($password)){
            $message1 = "*Fields need to be filled";
        }else{
            $query = "SELECT * FROM users WHERE user_email='$email'";
            $select_user = mysqli_query($connection, $query);
            if(mysqli_num_rows($select_user)>0){
                
                while($row = mysqli_fetch_assoc($select_user)){
                    $user_id = $row['user_id'];
                    $user_email = $row['user_email'];
                    $user_password = $row['user_password'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_role = $row['user_role'];
                }
                if( $email===$user_email && $password===$user_password){
                    $_SESSION['firstname'] = $user_firstname;
                    $_SESSION['lastname'] = $user_lastname;
                    $_SESSION['user_role'] = $user_role;
                    $_SESSION['email'] = $user_email;
                    $_SESSION['password'] = $user_password;
                    $_SESSION['user_id'] = $user_id;

                    header("Location: admin");

                }else{
                    $message1 = "*Email or Password didn't matched!";
                }

            }else{
                $message1 = "*Email or Password didn't matched!";
            }
        }
    }


    if(isset($_POST['register_btn'])){
        $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        if(empty($firstname) || empty($lastname)||empty($email)||empty($password)){
            $message1 = "*All fields need to be filled!";
        }else{

            $query = "INSERT INTO users VALUES('', '$email', '$password', '$firstname', '$lastname', 'publisher', '')";
            $insert_user = mysqli_query($connection, $query);
            if(!$insert_user){
                die("Insert query Failed".mysqli_error($connection));
            }else{
                $message = "Registered Successfully!";
            }
        }

    }


?>

<div id="all">
    <div id="form_all">
        <div id="login">
        <h1>Login</h1>
        <?php
        if(isset($message1)){
            echo "<h3 style='color:red;font-size:14px;font-family:'Raleway', san-serif;'>$message1</h3>";
        }
        ?>
        <form action="" method="POST">
            <input type="email" class="input" name="email" placeholder="Enter Email"><br>
            <input type="password" class="input" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" class="input_btn" value="Login" name="login_btn"/>
        </form>
        <h2>New User? <input type="button" id="reg_head" value="Register here!" class="register"></h2>
        </div>

        <div id="signup">
        <h1>Register here</h1>
        <?php
        if(isset($message1)){
            echo "<h3 style='color:red;font-size:14px;font-family:'Raleway', san-serif;'>$message1</h3>";
        }else if(isset($message)){
            echo "<h3 style='color:green;font-size:14px;font-family:'Raleway', san-serif;'>$message</h3>";
        }
        ?>
        <form action="" method="POST">
            <input type="text" class="input" name="firstname" placeholder="First Name"><br>
            <input type="text" class="input" name="lastname" placeholder="Last Name"><br>
            <input type="email" class="input" name="email" placeholder="Email"><br>
            <input type="password" class="input" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" class="input_btn" value="Register" name="register_btn"/>
        </form>
        <h2>Already have account? <input type="button" id="login_head" value="Login here!" class="register"></h2>
        </div>
    </div>
</div>

<?php include("includes/footer.php")?>