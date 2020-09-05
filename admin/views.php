
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
                        Welcome to Total View Section
                    </h1>
                    
                    <?php
                    
                    if(isset($_GET['source'])){
                        $source = $_GET['source'];
                    }else{
                        $source = '';
                    }
                    
                    switch($source){
                        default: include "includes/records_view.php";
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