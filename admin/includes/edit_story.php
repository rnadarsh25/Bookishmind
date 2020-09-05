<?php

    if(isset($_GET['edit_id'])){
            $edit_record_id = escape($_GET['edit_id']);
            $query = "SELECT * FROM records WHERE record_id = $edit_record_id";
            $fetch_record_query = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_assoc($fetch_record_query)){

                $record_id = $row['record_id'];
                $record_title = $row['record_title'];
                $record_index = $row['record_index'];
                $record_series_name = $row['record_series_name'];
                $record_genre_id = $row['record_genre_id'];
                $record_author = $row['record_author'];
                $record_image = $row['record_image'];
                $record_date = $row['record_date'];
                $record_status = $row['record_status'];
                $record_summary = $row['record_summary'];
                $record_content = $row['record_content'];
                $record_rate_star = $row['record_rate_star'];
                $record_rate_cmt = $row['record_rate_cmt'];
            }
        
}


    if(isset($_POST['update_record'])){
        $edit_record_id = escape($_GET['edit_id']);
        $record_title = escape($_POST['record_title']);
        $record_series_name = escape($_POST['record_series_name']);
        $record_genre_id = escape($_POST['record_genre_id']);
        $record_index = escape($_POST['record_index']);
        $record_author = escape($_POST['record_author']);
        $record_status = escape($_POST['record_status']);
        $record_summary = escape($_POST['record_summary']);
        $record_content = escape($_POST['record_content']);
        $record_rate_star = escape($_POST['record_rate_star']);
        $record_rate_cmt = escape($_POST['record_rate_cmt']);
        $record_date = date('d-m-y');
        
        $record_image = $_FILES['record_image']['name'];
        $record_image_temp = $_FILES['record_image']['tmp_name'];
        move_uploaded_file($record_image_temp, "../images/$record_image"); ;
        
        if(empty($record_image)){
            $query = "SELECT * FROM records WHERE record_id = $edit_record_id";
            $select_image = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_image)){
                $record_image = $row['record_image'];
            }
        }
        
        $query = "UPDATE records SET record_title = '$record_title',record_series_name = '$record_series_name',record_index = '$record_index',record_author = '$record_author',";
        $query .="record_status = '$record_status',record_genre_id = $record_genre_id,record_summary = '$record_summary',record_date= now(),";
        $query .= "record_content = '$record_content',record_rate_star = '$record_rate_star',record_rate_cmt = '$record_rate_cmt',record_image = '$record_image'";
        $query .= " WHERE record_id = $edit_record_id";
        
        $update_record_query = mysqli_query($connection, $query);
        confirm($update_record_query);
        
        echo "<div class=' form-group bg-success'>record Updated !  <a href='../record.php?p_id=$edit_record_id'>View record</a> or <a href='records.php'>Edit more records</a></div>";
        
        //header("Location: records.php");
        
    }


?>
  
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group" id="new_title">
    <label for="record_title">Short Story Title</label>
    <input type="text" name="record_title" class="form-control" value="<?php echo $record_title?>">
</div>

<div class="form-group" id="new_series" style="display:none">
    <label for="record_series_name">Short Story Series</label>
    <input type="text" name="record_series_name" class="form-control" value="<?php echo $record_series_name?>">
</div>
<div class="form-group" id="new_series">
    <label for="record_genre_id">Short Story Genre</label><br>
    <select name="record_genre_id" id="" class="form-control">
    <?php
    $query = "SELECT * FROM genre WHERE gen_id = $record_genre_id";
    $select_genre = mysqli_query($connection, $query);
    confirm($select_genre);
    $row = mysqli_fetch_assoc($select_genre);
    $gen_id = $row['gen_id'];
    $gen_title = $row['gen_title'];
    echo "<option value='$gen_id'>$gen_title</option>";
    ?>
    <?php
    $query = "SELECT * FROM genre WHERE gen_id NOT IN($record_genre_id)";
    $select_all_genre = mysqli_query($connection, $query);
    confirm($select_all_genre);
    while($row = mysqli_fetch_assoc($select_all_genre)){
        $gen_id = $row['gen_id'];
        $gen_title = $row['gen_title'];
        echo "<option value='$gen_id'>$gen_title</option>";
    }
    ?>
    </select>
</div>

<div class="form-group">
    <label for="record_index">Short Story Index</label>
    <input type="text" name="record_index" class="form-control" value="<?php echo $record_index?>">
</div>

<div class="form-group">
    <label for="record_author">Short Story Author</label>
    <input type="text" name="record_author" class="form-control" value="<?php echo $record_author;?>">
</div>

<div class="form-group">
    <label for="">Short Story Status</label>
    <select name="record_status" class="form-control" id="">
        <option value="draft">Select Option</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
    </select>     
</div>

<div class="form-group">
    <label for="record_rate_star">Short Story Star</label>
    <input type="text" name="record_rate_star" class="form-control" placeholder="Write only one time" value="<?php echo $record_rate_star;?>">
</div>
<div class="form-group">
    <label for="record_rate_cmt">Short Story Comment</label>
    <input type="text" name="record_rate_cmt" class="form-control" placeholder="Write only one time" value="<?php echo $record_rate_cmt;?>">
</div>

<div class="form-group">
    <label for="record_image">Short Story Image</label><br>
    <img src="../images/<?php echo $record_image;?>" alt="" width="100" height="100">
</div>

<div class="form-group">
    <label for="record_image">Choose New Short Story Image</label>
    <input type="file" name="record_image" class="form-control">
</div>
<div class="form-group">
    <label for="record_summary">Short Story Summary</label><br>
    <textarea name="record_summary" placeholder="Write only one time" class="form-control" rows="10"><?php echo $record_summary;?></textarea>
</div>

<div class="form-group">
    <label for="record_content">Short Story Content</label><br>
    <textarea name="record_content" id="body" class="form-control" rows="10"><?php echo $record_content;?></textarea>
</div>

<div class="form-group">
    <input type="submit" name="update_record" value="Update Short Story"  class="btn btn-success btn-md">
</div>

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
CKEDITOR.replace( 'body' );
</script>
<script>
$(document).ready(function(){
    $("#title_btn").click(function(){
        $("#old_title").toggle(500);
        $("#new_title").toggle(500);
    });

    $("#series_btn").click(function(){
        $("#old_series").toggle(500);
        $("#new_series").toggle(500);
    });
})
</script>
