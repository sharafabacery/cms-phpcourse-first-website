<?php
if (isset($_GET['p_id'])) {
    $the_post_id= $_GET['p_id'];
    
    $query="select * from posts where post_id ={$the_post_id}";
      $select_post_by_id=mysqli_query($connection,$query);
      while ($row=mysqli_fetch_assoc($select_post_by_id)) {
      $post_author=  $row['post_author'];
      $post_id=$row['post_id'];
      $post_title=$row['post_title'];
      $post_category_id=$row['post_category_id'];
      $post_status=$row['post_status'];
      $post_content=$row['post_content'];
      $post_image=$row['post_image'];
      $post_comment_count=$row['post_comment_count'];
      $post_date=$row['post_date'];
      $post_tags=$row['post_tags'];
      }
    }
if (isset($_POST['update_post'])) {
    $post_title=escape($_POST['title']);
    $post_author=escape($_POST['post_user']);
    $post_category_id=escape($_POST['post_category_id']);
    $post_status=escape($_POST['post_status']);
    $post_image=$post_image_temp="";
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
          $post_image=$_FILES['post_image']['name'];
    $post_image_temp=$_FILES['post_image']['tmp_name'];

    }    
    $post_tags=escape($_POST['post_tags']);
    $post_content=escape($_POST['post_content']);
    move_uploaded_file($post_image_temp,"../../images/${post_image}");
    if (empty($post_image)) {
        $query="select * from posts where post_id=$the_post_id";
        $select_image=mysqli_query($connection,$query);
        while ($row=mysqli_fetch_array($select_image)) {
            $post_image=$row['post_image'];
        }
    }
    $query="update posts set ";
    $query.="post_title = '{$post_title}', ";
    $query.="post_category_id = '{$post_category_id}', ";
    $query.="post_date = now(), ";
    $query.="post_author = '{$post_author}', ";
    $query.="post_status = '{$post_status}', ";
    $query.="post_tags = '{$post_tags}', ";
    $query.="post_content = '{$post_content}', ";
    $query.="post_image = '{$post_image}'  ";
    $query.="where post_id = '{$the_post_id}' ";

    $update_query=mysqli_query($connection,$query);
    
    confirmQuery($update_query);
     
    echo "<p class='bg-success'>Post updated. <a href='../post.php?p_id={$the_post_id}'> view posts</a>or<a href='posts.php'>edit posts</a></p> ";

}
                  

?>
<form action="" method="post" enctype="mulipart/form-data">

<div class="form-group">
<label for="title">Post Title</label>
<input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
</div>
<div class="form-group">
<select name="post_category_id" id="">
<?php
        $query="select * from categories";
        $select_categories=mysqli_query($connection,$query);
        confirmQuery($select_categories);
        while($row=mysqli_fetch_assoc($select_categories)){
            $cat_title=$row['cat_title'];
            $cat_id=$row['cat_id'];
            echo "<option value='{$cat_id}'>{$cat_title}</option>";
        
        }

?>

</select>
</div>
<div class="form-group">
<div class="form-group">
<label for="users">users</label>
<select name="post_user" id="" >


        
        
<?php
echo "<option value='{$post_author}'>{$post_author}</option>";
        $query="select * from users";
        $select_users=mysqli_query($connection,$query);
        confirmQuery($select_users);
        while($row=mysqli_fetch_assoc($select_users)){
            $user_id=$row['user_id'];
            $username=$row['username'];
            echo "<option value='{$username}'>{$username}</option>";
        
        }

?>

</select>
</div>
<div class="form-group">
<label for="post_status">Post Status</label>
<select name="post_status" id="">
<option value='<?php echo $post_status;?>'><?php echo $post_status;?></option>
<?php
if ($post_status=="draft") {
    echo "<option value='published'>published</option>";
    
}else{
    echo "<option value='draft'>draft</option>";
}

?>
</select>
</div>
<!-- <div class="form-group">
<label for="post_status">Post Status</label>
<input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
</div> -->
<div class="form-group">
<img src="../../images/<?php echo $post_image;?>" alt="123" width="100">
<input type="file" name="photo" id="">
</div>
<div class="form-group">
<label for="post_tags">Post Tags</label>
<input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
</div>
<div class="form-group">
<label for="post_content">Post Content</label>
<textarea name="post_content" id="" cols="30" rows="10" class="form-control">
<?php echo str_replace("\r\n",'</br>',$post_content); ?>
</textarea>
</div>
<div class="form-group">
<input  value="update Post" type="submit" class="btn btn-primary" name="update_post"/>
</div>

</form>