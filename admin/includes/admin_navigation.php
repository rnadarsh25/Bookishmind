<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">bookishMind Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
               <li><a href="../index.php">Visit Website</a></li>
               
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['firstname'];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                   
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Novels <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="./novels.php">View All Novels</a>
                            </li>
                            <li>
                                <a href="novels.php?source=add_novel">Add Novel</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Short Stories <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="stories.php">View All Short Stories</a>
                            </li>
                            <li>
                                <a href="stories.php?source=add_story">Add Short Story</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="views.php"><i class="fa fa-fw fa-arrows-v"></i> Check Views</a>
                    </li>
                    <li>
                        <a href="comments.php"><i class="fa fa-fw fa-arrows-v"></i> Comments</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>