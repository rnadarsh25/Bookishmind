
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
                        Welcome to Short Story Section
                    </h1>
                    
                    <?php
                    
                    if(isset($_GET['source'])){
                        $source = $_GET['source'];
                    }else{
                        $source = '';
                    }
                    
                    switch($source){
                        case 'add_story': include "includes/add_story.php";
                                 break;
                        case 'edit_story': include "includes/edit_story.php";
                                 break;
                        default: include "includes/view_all_stories.php";
                    }
                    
                    ?>
                    
                </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    </div>

<?php include "includes/admin_footer.php"?>