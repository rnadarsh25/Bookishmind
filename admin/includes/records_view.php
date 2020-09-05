
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Type</th>
                <th>Total Views</th>
                <th>Reset</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $count=1;
            //fetching all data
            $query = "SELECT * FROM views WHERE view_author_id=$user_id ORDER BY view_id DESC";
            $fetch_view_records = mysqli_query($connection, $query);
            if(!$fetch_view_records){
                die("Fetching Views Query Failed!".mysqli_error($connection));
            }else{
                while($row = mysqli_fetch_assoc($fetch_view_records)){

                    $view_id = $row['view_id'];
                    $view_title = $row['view_title'];
                    $view_title_type = $row['view_title_type'];
                    $view_count = $row['view_count'];

                    echo "<tr>";
                    echo "<td>{$count}</td>";
                    echo "<td>{$view_title}</td>";
                    echo "<td>{$view_title_type}</td>";
                    echo "<td>{$view_count}</td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are You sure want to reset?');\" class='btn btn-primary btn-sm' href='views.php?reset={$view_id}'>Reset</a></td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are You sure want to delete?');\" class='btn btn-danger btn-sm' href='views.php?delete={$view_id}'>Delete</a></td>";
                    
                    echo "</tr>";
                    $count=$count+1;

                }
            }

            ?>
        </tbody>
    </table>


<?php
    if(isset($_GET['reset'])){
        
        $reset_view_id = escape($_GET['reset']);
        $query = "UPDATE views SET view_count=0 WHERE view_id = $reset_view_id";
        $reset_query = mysqli_query($connection, $query);
        confirm($reset_query);
        
        header("Location: views.php");
        
    }
    if(isset($_GET['delete'])){
        
        $delete_view_id = escape($_GET['delete']);
        $query = "DELETE FROM views WHERE view_id = $delete_view_id";
        $delete_query = mysqli_query($connection, $query);
        confirm($delete_query);
        
        header("Location: views.php");
        
    }
    
?>

