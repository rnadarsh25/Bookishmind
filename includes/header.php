<?php include "db.php"; include "functions.php";?>
<?php ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookish Mind: Read stories for free</title>
    <link type="text/css" rel="stylesheet" href="css/header.css"/>
    <link type="text/css" rel="stylesheet" href="css/footer.css"/>   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
     integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

     <link href="https://fonts.googleapis.com/css?family=Arapey|Exo|Great+Vibes|Orbitron|Play|Playfair+Display+SC|Prata|Satisfy|Tangerine&display=swap" 
     rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Be+Vietnam|Raleway|Turret+Road&display=swap"
      rel="stylesheet">

      <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" 
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  -->
</head>
<body>
    <div id="main">
        <div id="header"><a href="index.php"><h1><i class="fas fa-book-reader"></i>bookishMind<br><span>read and write your story!</span></h1></a></div>
        <div id="navbar">
        <?php 
        $query = "SELECT * FROM categories";
        $select_cats = mysqli_query($connection, $query);
        confirm($select_cats);
        while($row=mysqli_fetch_assoc($select_cats)){
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            echo "<div class='nav1'><a href='index.php?source=$category_title&cat_id=$category_id&gen_id=1'><li>$category_title</li></a></div>";
        }

        ?>
            <?php
                if(!isset($_SESSION['user_id'])){
                    ?>
                    <div class="nav1"><a href='login.php'><li>Login</li></a></div>
                    <?php
                }else{
                    ?>
                    <div class="nav1">
                    <a href='./admin'><li><?php echo "Hello, ".$_SESSION['firstname']."      <i class='fas fa-id-card'></i>";?></li></a>
                    </div>
                    <?php
                }
            ?>
        </div>