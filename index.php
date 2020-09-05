<?php include "includes/header.php";?>
<head><link type="text/css" rel="stylesheet" href="css/index.css"/></head>
<?php
    if(!isset($_GET['cat_id'])){
        header("Location: index.php?source=Novels&cat_id=1&gen_id=1");
    }
?>
        <div id="all">
            <div class="read">
            <div class="read_heading"><h1><?php echo $_GET['source']?></h1></div>
            <div class="read_book">

            <?php
                
            ?>
            <?php
            if(isset($_GET['cat_id'])){
                $the_cat_id = $_GET['cat_id'];
                $the_gen_id = $_GET['gen_id'];

                $per_page = 5;
                
                if(isset($_GET['page'])){
                    
                    $page = mysqli_real_escape_string($connection, $_GET['page']);
                }else{
                    $page = "";
                }
                
                if($page =="" || $page == 1){
                    $page_1 = 0;
                }else{
                    $page_1 = ($page*$per_page)-$per_page;
                }
                
                
                $query = "SELECT * FROM records WHERE record_category_id = $the_cat_id AND record_genre_id= $the_gen_id AND record_status='published' GROUP BY record_title";
                $count_posts = mysqli_query($connection, $query);
                $count = mysqli_num_rows($count_posts);
                
                $show_count = ceil($count/$per_page);

                $query = "SELECT * FROM records WHERE record_category_id = $the_cat_id AND record_genre_id= $the_gen_id AND record_status='published' GROUP BY record_title ORDER BY record_id DESC LIMIT $page_1, $per_page";
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
            }if(mysqli_num_rows($select_records)==0){
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
                    <h1>Categories</h1>
                    <?php
                    if(isset($_GET['cat_id'])){
                        $the_cat_id = $_GET['cat_id'];
                        $the_source = $_GET['source'];
                    }
                    $query = "SELECT * FROM genre";
                    $select_genre = mysqli_query($connection, $query);
                    confirm($select_genre);
                    while($row = mysqli_fetch_assoc($select_genre)){
                        $gen_id = $row['gen_id'];
                        $gen_title = $row['gen_title'];
                        echo "<div class='side_category'><a href='index.php?source=$the_source&cat_id=$the_cat_id&gen_id=$gen_id'><li>$gen_title</li></a></div>";
                    }
                    ?>
                </div>
            </div>
            <div class="paging">
                <hr>
                <ul class="pager">
                    
                <?php

                
                    
                    for($i=1;$i<=$show_count;$i++){
                        
                        if($i == $page){
                            
                        echo "<li><a class='active_link' href='index.php?source=$the_source&cat_id=$the_cat_id&gen_id=$the_gen_id&page={$i}'>{$i}</a></li>";  
                        
                        }else if($page=="" && $i==1){
                        
                            echo "<li><a class='active_link' href='index.php?source=$the_source&cat_id=$the_cat_id&gen_id=$the_gen_id&page={$i}'>{$i}</a></li>";
                        }else{
                            echo "<li><a href='index.php?source=$the_source&cat_id=$the_cat_id&gen_id=$the_gen_id&page={$i}'>{$i}</a></li>";
                        }
                    }
                    
                ?>
                    
                        
                </ul>
            </div>
        </div>
<?php include "includes/footer.php";?>