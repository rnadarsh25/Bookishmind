<?php include "includes/header.php";?>
<head><link type="text/css" rel="stylesheet" href="css/read.css"/></head>
<?php if(!isset($_GET['chapter_id'])){
    header("Location: index.php");
}else{
    $the_chapter_id = $_GET['chapter_id'];
    $the_record_title = $_GET['source'];
}?>
<?php if(!isset($_GET['source'])){
    header("Location: index.php");    
}else{

    $the_record = $_GET['source'];
    
    $query = "SELECT * FROM views WHERE view_title = '$the_record'";
    $select_view_title = mysqli_query($connection, $query);
    confirm($select_view_title);
    $row = mysqli_fetch_assoc($select_view_title);
    $title_view_count = $row['view_count'];
    $author_id = $row['view_author_id'];
    
    $query = "UPDATE views SET view_count = $title_view_count+1 WHERE view_title = '$the_record'";
    $update_title_view_count = mysqli_query($connection, $query);
    confirm($update_title_view_count);

}?>

<?php
if(isset($_POST['cmt_submit'])){
    $cmt_author = mysqli_real_escape_string($connection, $_POST['cmt_author']);
    $cmt_content = mysqli_real_escape_string($connection, $_POST['cmt_content']);

    if(empty($cmt_author) || empty($cmt_content)){
        $message1 = "*All fields need to be filled!";
    }else{
        $query = "INSERT INTO comments VALUES('', '$the_chapter_id', '$the_record_title', '$cmt_author', '$cmt_content', 'draft', now(), $author_id)";
        $insert_cmt = mysqli_query($connection, $query);
        confirm($insert_cmt);

        $message2 = "submitted successfully! Waiting for approval. ";
    }

}
?>


        <div id="all">
            <div class="sidebar"></div>
            <?php
            $query = "SELECT * FROM records WHERE record_id=$the_chapter_id AND record_title='$the_record_title'";
            $select_record = mysqli_query($connection, $query);
            confirm($select_record);
            while($row = mysqli_fetch_assoc($select_record)){
                $record_id = $row['record_id'];
                $record_title = $row['record_title'];
                $record_index = $row['record_index'];
                $record_content = $row['record_content'];
            }
            ?>
            <div class="read">
                <div class="read_head">
                    <h1><?php echo $record_title?><br><span><?php echo $record_index?></span></h1>
                </div>
                <div class="book_reading">
                    <p><?php echo $record_content?></p>
                </div>   
            </div>
            <div class="sidebar">
                <!-- <div class="side1">
                    <div class="search_div">
                        <form action="search.php" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control search_input" name="password" placeholder="search">
                                <span class="input-group-btn">
                                    <button type="submit" name="login_btn" class="search_btn">search</button>
                                </span>
                            </div>
                            </form>
                    </div>
                </div> -->
            </div>
            
            <div class="comment">
                <div class="add_cmt">
                    <?php if(isset($message1)){
                        echo "<h1 id='cmt_head' style='color: red;'>$message1</h1>";
                    }else if(isset($message2)){
                        echo "<h1 id='cmt_head' style='color: green;'>$message2</h1>";
                    }?>
                    <h1 id="cmt_head">Add Comment</h1>
                    <form action="" method="post">
                    <input type="text" class="cmt_area" name="cmt_author" placeholder="Enter name"><br> 
                    <textarea name="cmt_content" class="cmt_area" placeholder="Write comment"></textarea><br>
                    <input type="submit" name="cmt_submit" class="cmt_btn">
                    </form>
                </div> 
            <h1 id="cmt_head">Comments</h1>   
                <div class="show_cmts">
                    <?php
                    $query = "SELECT * FROM comments WHERE cmt_on_id = $the_chapter_id AND cmt_status='approved' ORDER BY cmt_id DESC";
                    $select_cmts = mysqli_query($connection, $query);
                    confirm($select_cmts);

                    while($row=mysqli_fetch_assoc($select_cmts)){
                        $cmt_id = $row['cmt_id'];
                        $cmt_author = $row['cmt_author'];
                        $cmt_content = $row['cmt_content'];
                        $cmt_date = $row['cmt_date'];
                        ?>
                    <div class="cmt_img"><img src="images/info.jpg" alt=""></div>
                    <div class="cmt_detail"><h1><?php echo $cmt_author;?><span>commented on: <?php echo $cmt_date;?><br><span><?php echo $cmt_content;?></span></span></h1></div>    
                    <?php
                    }if(mysqli_num_rows($select_cmts)==0){
                        echo "<h1 style='font-size:13px; color:white;font-family='Raleway', sans-serif;'>No comments!</h1>";
                    }
                    ?>
                </div> 
            </div>
        </div>
<?php include "includes/footer.php";?>