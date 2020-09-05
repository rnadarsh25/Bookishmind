
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Index</th>
                <th>Series</th>
                <th>Author</th>
                <th>Image</th>
                <th>Status</th>
                <th>Date</th>
                <th>Publish</th>
                <th>Draft</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php
            //fetching all records
            $query = "SELECT * FROM records WHERE record_category_id = 2 AND record_author_id=$user_id ORDER BY record_id DESC";
            $fetch_blogs_query = mysqli_query($connection, $query);
            if(!$fetch_blogs_query){
                die("Fetching Blogs Query Failed!".mysqli_error($connection));
            }else{
                while($row = mysqli_fetch_assoc($fetch_blogs_query)){

                    $record_id = $row['record_id'];
                    $record_title = $row['record_title'];
                    $record_index = $row['record_index'];
                    $record_series_name = $row['record_series_name'];
                    $record_author = $row['record_author'];
                    $record_image = $row['record_image'];
                    $record_date = $row['record_date'];
                    $record_status = $row['record_status'];
                    echo "<tr>";
                    echo "<td>{$record_id}</td>";
                    echo "<td>{$record_title}</td>";
                    echo "<td>{$record_index}</td>";
                    echo "<td>{$record_series_name}</td>";
                    echo "<td>{$record_author}</td>";
                    
                    echo "<td><img src='../images/{$record_image}' width='60' height='60'></td>";
                    
                    echo "<td>{$record_status}</td>";
                    echo "<td>{$record_date}</td>";       
                     
                    echo "<td><a class='btn btn-success btn-sm' href='stories.php?publish_id={$record_id}'>Publish</a></td>";
                    echo "<td><a class='btn btn-primary btn-sm' href='stories.php?draft_id={$record_id}'>Draft</a></td>";
                    echo "<td><a class='btn btn-warning btn-sm' href='stories.php?source=edit_story&edit_id={$record_id}'>Edit</a></td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are You sure want to delete?');\" class='btn btn-danger btn-sm' href='stories.php?delete={$record_id}'>Delete</a></td>";
                    echo "</tr>";

                }
            }

            ?>
        </tbody>
    </table>


<?php
    if(isset($_GET['publish_id'])){
        $the_record_id = escape($_GET['publish_id']);
        $query = "UPDATE records SET record_status='published' WHERE record_id = $the_record_id";
        $update_status = mysqli_query($connection, $query);
        confirm($update_status);
        header("Location: stories.php");
    }
    if(isset($_GET['draft_id'])){
        $the_record_id = escape($_GET['draft_id']);
        $query = "UPDATE records SET record_status='draft' WHERE record_id = $the_record_id";
        $update_status = mysqli_query($connection, $query);
        confirm($update_status);
        header("Location: stories.php");
    }

    if(isset($_GET['delete'])){
        
        $delete_record_id = escape($_GET['delete']);
        $query = "DELETE FROM records WHERE record_id = $delete_record_id";
        $delete_record_query = mysqli_query($connection, $query);
        confirm($delete_record_query);
        
        header("Location: stories.php");
        
    }
    
?>

