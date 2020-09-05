<?php include "includes/header.php"?>
<head><link type="text/css" rel="stylesheet" href="css/read_page.css"/></head>
<?php if(!isset($_GET['source'])){
    header("Location: index.php");    
}else{

    $the_record = $_GET['source'];
    
    $query = "SELECT * FROM views WHERE view_title = '$the_record'";
    $select_view_title = mysqli_query($connection, $query);
    confirm($select_view_title);
    $row = mysqli_fetch_assoc($select_view_title);
    $title_view_count = $row['view_count'];
    
    // $query = "UPDATE views SET view_count = $title_view_count+1 WHERE view_title = '$the_record'";
    // $update_title_view_count = mysqli_query($connection, $query);
    // confirm($update_title_view_count);

}?>
        <div id="all">
            <div class="read">
            <?php
            $query = "SELECT * FROM records WHERE record_title = '$the_record' LIMIT 1";
            $select_one_record = mysqli_query($connection, $query);
            confirm($select_one_record);
            while($row = mysqli_fetch_assoc($select_one_record)){
                $record_id = $row['record_id'];
                $record_category_id = $row['record_category_id'];
                $record_title = $row['record_title'];
                $record_series_name = $row['record_series_name'];
                $record_author = $row['record_author'];
                $record_image = $row['record_image'];
                $record_rate_star = $row['record_rate_star'];
                $record_rate_cmt = $row['record_rate_cmt'];
                $record_summary = $row['record_summary'];
                $the_record_author = $record_author;
                ?>
                <div class="book_img">
                    <img src="images/<?php echo $record_image?>" alt="">
                </div>
                <div class="detail">
                    <h1>Name: <span><?php echo $record_title?></span></h1>
                    <h1>Author: <span><?php echo $record_author?></span></h1>
                    <h1>Series: <span><?php echo $record_series_name?></span></h1>
                    <h1>Ratings: <span><?php echo $record_rate_star?></span></h1>
                    <h1>Storyline &nbsp;<i class="far fa-eye"></i>: <span><?php echo $title_view_count?></span> <br><p><?php echo $record_summary?></p></h1>
                </div>
                
            <?php
            }
            
            ?>
                
                <div class="book_index">
                <?php
            $query = "SELECT * FROM records WHERE record_title = '$the_record' AND record_status='published'";
            $select_one_record = mysqli_query($connection, $query);
            confirm($select_one_record);
            while($row = mysqli_fetch_assoc($select_one_record)){
                $record_id = $row['record_id'];
                $record_category_id = $row['record_category_id'];
                $record_title = $row['record_title'];
                $record_index = $row['record_index'];
                ?>
                <div class="chapters">
                    <div class="chapter_name">
                        <input type="button" value="<?php echo $record_index?>" class="chapter_link">
                    </div>
                    <div class="chapter_btn">
                        <a href="read.php?source=<?php echo $record_title?>&chapter_id=<?php echo $record_id?>"><input type="button" value="Read" class="chapter_read"></a>
                    </div>
                </div>
            <?php
            }
            ?>
                    
            </div>
            </div>
            <div class="sidebar">
                <div class="side1">
                    <div class="search_div">
                        <form action="search.php" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control search_input" name="search_input" placeholder="search">
                                <span class="input-group-btn">
                                    <button type="submit" name="search_btn" class="search_btn">search</button>
                                </span>
                            </div>
                            </form>
                    </div>
                    <h3>You may also like:</h3>
                    <?php
                    $query = "SELECT * FROM records WHERE record_status='published' AND record_author='$the_record_author' OR record_series_name='$record_series_name' GROUP BY record_title";
                    $select_more_records = mysqli_query($connection, $query);
                    confirm($select_more_records);
                    while($row = mysqli_fetch_assoc($select_more_records)){
                    $record_id = $row['record_id'];
                    $record_category_id = $row['record_category_id'];
                    $record_image = $row['record_image'];
                    $record_title = $row['record_title'];
                    $record_author = $row['record_author'];
                    $record_rate_star = $row['record_rate_star'];
                    ?>
                    <div class="show_book_div">
                        <div class="side_book_img">
                        <a href="read_detail.php?source=<?php echo $record_title?>"><img src="images/<?php echo $record_image?>" alt=""></a>
                        </div>
                        <div class="side_book_footer">
                            <input type="button" value="<?php echo $record_rate_star?>" class="star">
                            <a href="read_detail.php?source=<?php echo $record_title?>"><h1><?php echo $record_title?></h1></a>
                            <a href=""><h2><?php echo $record_author?></h2></a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
 <?php include "includes/footer.php"?>