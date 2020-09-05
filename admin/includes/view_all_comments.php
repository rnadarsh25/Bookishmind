<table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Comment On</th>
                <th>Type</th>
                <th>Date</th>
                <th>Approve</th>
                <th>UnApprove</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $count=1;
            //fetching all comments
            $query = "SELECT * FROM comments WHERE cmt_author_id=$user_id ORDER BY cmt_id DESC";
            $fetch_comments_query = mysqli_query($connection, $query);
            
            confirm($fetch_comments_query);
            
            while($row = mysqli_fetch_assoc($fetch_comments_query)){

                    $cmt_id = $row['cmt_id'];
                    $cmt_author = $row['cmt_author'];
                    $cmt_content = $row['cmt_content'];
                    $cmt_status = $row['cmt_status'];
                    $cmt_date = $row['cmt_date'];
                    $cmt_on_id = $row['cmt_on_id'];
                    $cmt_to_type = $row['cmt_to_type'];
                    
                    echo "<tr>";
                    echo "<td>{$count}</td>";
                    echo "<td>{$cmt_author}</td>";
                    echo "<td>{$cmt_content}</td>";
                    echo "<td>{$cmt_status}</td>";
                
                    $query = "SELECT * FROM records WHERE record_id = $cmt_on_id";
                    $select_record = mysqli_query($connection, $query);
                    confirm($select_record);
                    while($row=mysqli_fetch_assoc($select_record)){
                        $record_id = $row['record_id'];
                        $record_title = $row['record_title'];
                        $record_index = $row['record_index'];
                        
                         echo "<td>{$record_index}</td>";
                    }
                    
                    echo "<td>{$cmt_to_type}</td>";
                    echo "<td>{$cmt_date}</td>";
                
                    echo "<td><a class='btn btn-success btn-sm' href='comments.php?appr_id={$cmt_id}'>Approve</a></td>";
                
                    echo "<td><a class='btn btn-warning btn-sm' href='comments.php?rej_id={$cmt_id}'>Unapprove</a></td>";
                
                    echo "<td><a class='btn btn-danger btn-sm' href='comments.php?del_cmt={$cmt_id}'>Delete</a></td>";
                    echo "</tr>";

                    $count = $count+1;
                }

            ?>
        </tbody>
</table>


<?php

    if(isset($_GET['del_cmt'])){
        
        $delete_cmt_id = escape($_GET['del_cmt']);
        $query = "DELETE FROM comments WHERE cmt_id = $delete_cmt_id";
        $delete_cmt_query = mysqli_query($connection, $query);
        confirm($delete_cmt_query);
        
        header("Location: comments.php");
        
    }


    if(isset($_GET['appr_id'])){
        $check_id = escape($_GET['appr_id']);
        
        $query = "UPDATE comments SET cmt_status = 'approved' WHERE cmt_id = $check_id";
        $status_query = mysqli_query($connection, $query);
        confirm($status_query);
        
        header("Location: comments.php");
    }

    if(isset($_GET['rej_id'])){
        $check_id = escape($_GET['rej_id']);
        
        $query = "UPDATE comments SET cmt_status = 'draft' WHERE cmt_id = $check_id";
        $status_query = mysqli_query($connection, $query);
        confirm($status_query);
        
        header("Location: comments.php");
    }
    
?>

