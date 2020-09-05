<?php include "includes/admin_header.php"?>

    <div id="wrapper">

        <!-- Navigation -->
        
        <?php include "includes/admin_navigation.php"?>
        
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Welcome to Dashboard
                            <small>Ast</small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                
                
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php
                        
                        $query = "SELECT * FROM records WHERE record_category_id = 1 AND record_author_id= $user_id AND record_status='published' GROUP BY record_title";
                        $select_all_novels = mysqli_query($connection, $query);
                        if(mysqli_num_rows($select_all_novels)>0){
                            $novel_counts = mysqli_num_rows($select_all_novels);
                        }else{
                            $novel_counts=0;
                        }
                        
                    ?>
                    
                  <div class='huge'><?php echo $novel_counts;?></div>
                        <div>Novels</div>
                    </div>
                </div>
            </div>
            <a href="novels.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                     <?php
                        
                        $query = "SELECT * FROM records WHERE record_category_id=2 AND record_author_id=$user_id AND record_status='published'";
                        $select_all_stories = mysqli_query($connection, $query);
                        if(mysqli_num_rows($select_all_stories)>0){
                            $story_counts = mysqli_num_rows($select_all_stories);
                        }else{
                            $story_counts=0;
                        }
                        
                    ?>
                    
                     <div class='huge'><?php echo $story_counts;?></div>
                      <div>Short Stories</div>
                    </div>
                </div>
            </div>
            <a href="stories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
                <!-- /.row -->
                

            <?php
                
                // $query = "SELECT * FROM posts WHERE post_status='publish'";
                // $select_publish_posts = mysqli_query($connection, $query);
                // $publish_posts_count = mysqli_num_rows($select_publish_posts);
            
                // $query = "SELECT * FROM posts WHERE post_status='draft'";
                // $select_draft_posts = mysqli_query($connection, $query);
                // $draft_posts_count = mysqli_num_rows($select_draft_posts);
                
                // $query = "SELECT * FROM comments WHERE comment_status='unapproved'";
                // $select_unapproved_cmts = mysqli_query($connection, $query);
                // $unapproved_cmts_count = mysqli_num_rows($select_unapproved_cmts);
                
                // $query = "SELECT * FROM users WHERE user_role ='subscriber'";
                // $select_subscribers = mysqli_query($connection, $query);
                // $subscribers_count = mysqli_num_rows($select_subscribers);
                
                
                
            ?>                    
                
                
                
<!-- <div class="row">
                  
      <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
        
            <?php
            
//  $element_text = ['Total Posts','Active Posts','Draft Posts', 'Comments','Pending Comments', 'Users','Subscribers', 'Categories'];
//  $element_count = [$posts_count,$publish_posts_count,$draft_posts_count, $comments_count,$unapproved_cmts_count ,$users_count,$subscribers_count,$categories_count];
            
//                 for($i=0;$i<8;$i++){
                    
//                     echo "['{$element_text[$i]}'" .","."$element_count[$i]],";
                    
//                 }
            
            ?>
            
//          ['Posts', 1000],
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
             
        <div id="columnchart_material" style="width: 'auto'; height: 380px;"></div>               
              
</div>   -->
                
                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


    <?php include "includes/admin_footer.php"?>