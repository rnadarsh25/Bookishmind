
<?php
    
    if(isset($_POST['create_record'])){
        
        $record_new_title = escape($_POST['record_new_title']);
        if(empty($record_new_title)){
            $record_title = escape($_POST['record_title']);
        }else{
            $record_title = $record_new_title;
            $query = "INSERT INTO views VALUES('', '$record_title', 'Short Story', 0)";
            $insert_new_title = mysqli_query($connection, $query);
            confirm($insert_new_title);
        }
        
        $record_new_series_name = escape($_POST['record_new_series_name']);
        if(empty($record_new_series_name)){
            $record_series_name = escape($_POST['record_series_name']);
        }else{
            $record_series_name = $record_new_series_name;  
        }
        $record_index = escape($_POST['record_index']);
        $record_author = escape($_POST['record_author']);
        $record_status = escape($_POST['record_status']);
        $record_summary = escape($_POST['record_summary']);
        $record_content = escape($_POST['record_content']);
        $record_rate_star = escape($_POST['record_rate_star']);
        $record_rate_cmt = escape($_POST['record_rate_cmt']);
        $record_genre_id = escape($_POST['record_genre_id']);
        $record_date = date('d-m-y');
        
        $record_image = $_FILES['record_image']['name'];
        $record_image_temp = $_FILES['record_image']['tmp_name'];
        move_uploaded_file($record_image_temp, "../images/$record_image"); 
        //if gets errro then change permision over properties in settings in that folder
        
        
        $query = "INSERT INTO records VALUES('', 2, $record_genre_id,'$record_title', '$record_series_name', '$record_index','$record_author','$record_content','$record_image','$record_rate_star','$record_rate_cmt','$record_summary','$record_status', now(), $user_id)";
        
        $insert_record_query = mysqli_query($connection, $query);
        confirm($insert_record_query);
        
        $the_record_id = mysqli_insert_id($connection);
        
        echo "<div class=' form-group bg-success'>New record Created !  <a href='../Short Storys.php?p_id=$the_record_id'>View Short Story</a></div>";
        
        //header("Location: records.php");
        
    }

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group" id="new_title" style="display:none">
        <label for="record_new_title">New Short Story Title</label>
        <input type="text" name="record_new_title" class="form-control">
    </div>
    
    <div class="form-group" id="old_title">
        <label for="">Previous Short Story Titles</label>
        <select name="record_title" class="form-control" id="">
            <?php
                $query = "SELECT DISTINCT * FROM records WHERE record_category_id=2 GROUP BY record_title ORDER BY record_id DESC";
                $title_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($title_query)){
                    $record_title = $row['record_title'];
                    echo "<option value='{$record_title}'>{$record_title}</option>";
                }
            ?>
        </select>     
    </div>
    <div class="form-group">
        <input type="button" class="btn btn-success" value="Add New Title" id="title_btn">
    </div>

    <div class="form-group" id="new_series" style="display:none">
        <label for="record_new_series_name">New Short Story Series</label>
        <input type="text" name="record_new_series_name" class="form-control">
    </div>

    <div class="form-group" id="old_series">
        <label for="">Previous Short Story Series</label>
        <select name="record_series_name" class="form-control" id="">
            <?php
                $query = "SELECT DISTINCT * FROM records WHERE record_category_id=2 GROUP BY record_series_name ORDER BY record_id DESC";
                $series_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($series_query)){
                    $record_series_name = $row['record_series_name'];
                    echo "<option value='{$record_series_name}'>{$record_series_name}</option>";
                }
            ?>
        </select>     
    </div>
    <div class="form-group">
        <input type="button" class="btn btn-success" value="Add New Series" id="series_btn">
    </div>

    <div class="form-group" id="old_series">
        <label for="">Short Story Genre</label>
        <select name="record_genre_id" class="form-control" id="">
            <?php
                $query = "SELECT * FROM genre";
                $genre_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($genre_query)){
                    $genre_id = $row['gen_id'];
                    $genre_title = $row['gen_title'];
                    echo "<option value='{$genre_id}'>{$genre_title}</option>";
                }
            ?>
        </select>     
    </div>

    <div class="form-group">
        <label for="record_index">Short Story Index</label>
        <input type="text" name="record_index" class="form-control">
    </div>

    <div class="form-group">
        <label for="record_author">Short Story Author</label>
        <input type="text" name="record_author" class="form-control">
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
        <input type="text" name="record_rate_star" class="form-control" placeholder="Write only once">
    </div>
    <div class="form-group">
        <label for="record_rate_cmt">Short Story Comment</label>
        <input type="text" name="record_rate_cmt" class="form-control" placeholder="Write only once">
    </div>
    
    <div class="form-group">
        <label for="record_image">Short Story Image</label>
        <input type="file" name="record_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="record_summary">Short Story Summary</label><br>
        <textarea name="record_summary" placeholder="Write only once" class="form-control" rows="10"></textarea>
    </div>

    <div class="form-group">
        <label for="record_content">Short Story Content</label><br>
        <textarea name="record_content" id="body" class="form-control" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" name="create_record" value="Create New Short Story"  class="btn btn-success btn-md">
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
