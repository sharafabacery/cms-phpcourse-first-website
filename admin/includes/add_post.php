<?php
if (isset($_POST["create_post"])) {
    $post_title=$_POST['title'];
    $post_user=$_POST['post_user'];
    $post_category_id=$_POST['post_category_id'];
    $post_status=$_POST['post_status'];
    $post_image=$post_image_temp="";
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
          $post_image=$_FILES['post_image']['name'];
    $post_image_temp=$_FILES['post_image']['tmp_name'];

    }
  
    
    $post_tags=$_POST['post_tags'];
    $post_content=$_POST['post_content'];
    $post_date=date('d-m-y');
   // $post_comment_count=4;
    
    move_uploaded_file($post_image_temp,"../../images/${post_image}");

    $query="insert into posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) " ;

    $query.="values({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' ); ";

    $create_post_query=mysqli_query($connection,$query);

    confirmQuery($create_post_query);
     
    $the_post_id=mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post created. <a href='../post.php?p_id={$the_post_id}'> view posts</a>or<a href='posts.php'>edit posts</a></p> ";

}

?>

<form action="" method="post" enctype="mulipart/form-data">

<div class="form-group">
<label for="title">Post Title</label>
<input type="text" class="form-control" name="title">
</div>
<div class="form-group">
<label for="post_category">Post Category ID</label>
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
<!-- <div class="form-group">
<label for="author">Post Author</label>
<input type="text" class="form-control" name="author">
</div> -->
<div class="form-group">
<label for="users">users</label>
<select name="post_user" id="">
<?php
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
<option value="draft">select option</option>
<option value="draft">draft</option>
<option value="published">published</option>

</select>
</div>
<div class="form-group">
<label for="post_image">Post Image</label>
<input type="file"  name="post_image"/>
</div>
<div class="form-group">
<label for="post_tags">Post Tags</label>
<input type="text" class="form-control" name="post_tags">
</div>
<div class="form-group">
<label for="post_content">Post Content</label>
<textarea name="post_content" id="body" cols="30" rows="10" class="form-control"></textarea>
</div>
<div class="form-group">
<input  value="Publish Post" type="submit" class="btn btn-primary" name="create_post"/>
</div>

</form>