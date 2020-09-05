<?php include "includes/header.php";?>
<head><link type="text/css" rel="stylesheet" href="css/index.css"/></head>
<?php
    if(!isset($_POST['search_btn'])){
        header("Location: index.php?source=Novels&cat_id=1&gen_id=1");
    }else{
        $the_search = $_POST['search_input'];
        if(empty($the_search)){
            header("Location: index.php?source=Novels&cat_id=1&gen_id=1");
        }
    }
?>
        <div id="all">
            <div class="read">
            <div class="read_heading"><h1>You Searched for: <?php echo $the_search?></h1></div>
            <div class="read_book">
            <?php
                $query = "SELECT * FROM records WHERE record_status='published' AND record_title LIKE '%$the_search%' OR record_author LIKE '%$the_search%' OR record_series_name LIKE '%$the_search%' GROUP BY record_title ORDER BY record_id";
                $select_records = mysqli_query($connection, $query);
                confirm($select_records);
                while($row = mysqli_fetch_assoc($select_records)){
                    $record_id = $row['record_id'];
                    $record_category_id = $row['record_category_id'];
                    $record_image = $row['record_image'];
                    $record_title = $row['record_title'];
                    $record_author = $row['record_author'];
                    $record_rate_star = $row['record_rate_star'];
                    ?>
            <div class="book">
                <div class="book_img">
                    <a href="read_detail.php?source=<?php echo $record_title?>"><img src="images/<?php echo $record_image?>" alt=""></a>
                </div>
                <div class="book_footer">
                    <input type="button" value="<?php echo $record_rate_star?>" class="star">
                    <a href="read_detail.php?source=<?php echo $record_title?>"><h1><?php echo $record_title?></h1></a>
                    <a href=""><h2><?php echo $record_author?></h2></a>
                </div>
            </div>
            
            <?php

                }
                if(mysqli_num_rows($select_records)==0){
                    echo "<h1 style='font-size:14px; color:white;font-family='Raleway', sans-serif;'>Nothing Found!</h1>";
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
                </div>
            </div>
        </div>
<?php include "includes/footer.php";?>