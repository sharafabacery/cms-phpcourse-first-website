<?php
if (isset($_GET['p_id'])) {
    $the_user_id= escape($_GET['p_id']);
    
    $query="select * from users where user_id ={$the_user_id}";
      $select_user_by_id=mysqli_query($connection,$query);
      while ($row=mysqli_fetch_assoc($select_user_by_id)) {
      $username=  $row['username'];
      $user_id=$row['user_id'];
      //$user_password=$row['user_password'];

      $user_firstname=$row['user_firstname'];
      $user_lastname=$row['user_lastname'];
      $user_role=$row['user_role'];
      $user_email=$row['user_email'];
     }
    }
if (isset($_POST["update_user"])) {
    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $email=$_POST['user_email'];
    $role=$_POST['role'];
    $username=$_POST['username'];
   // $post_image=$post_image_temp="";
   // if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
    //      $post_image=$_FILES['post_image']['name'];
    //$post_image_temp=$_FILES['post_image']['tmp_name'];

    //}
  
    
    $password=$_POST['password'];
   if (!empty($password)) {
    $query_password="select user_password from users where user_id ={$the_user_id}";
      $select_password_by_id=mysqli_query($connection,$query_password);
      $row=mysqli_fetch_array($select_password_by_id);
      $db_user_password=$row['user_password'];
if ($db_user_password!=$password) {
    $password=password_hash($password,PASSWORD_BCRYPT,['cost'=>12]);
}
 $query="update users set ";
   $query.="user_firstname = '{$user_firstname}', ";
   $query.="user_lastname = '{$user_lastname}', ";
   $query.="date = now(), ";
   $query.="user_role = '{$role}', ";
    $query.="user_password= '{$password}',";
   $query.="username = '{$username}' ";
   //$query.="post_tags = '{$post_tags}', ";
  // $query.="post_content = '{$post_content}', ";
   //$query.="post_image = '{$post_image}'  ";
   $query.="where user_id = {$the_user_id} ";

   $update_query=mysqli_query($connection,$query);
   
   confirmQuery($update_query);
}


   
   
    //$user_date=date('d-m-y');
   // $post_comment_count=4;
    
   // move_uploaded_file($post_image_temp,"../../images/${post_image}");
  

   }

?>

<form action="" method="post" enctype="mulipart/form-data">

<div class="form-group">
<label for="firtname">firtname</label>
<input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
</div>
<div class="form-group">
<label for="lastname">lastname</label>
<input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
</div>
<div class="form-group">
<label for="role">role</label>
<select name="role" id="" value="<?php echo $user_role; ?>">

    <option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>        
    <?php
        if ($user_role=='admin') {
            echo "<option value='subscriber'>subscriber</option>";
        }else{
            echo "<option value='admin'>admin</option>";        
   
        }
    ?>
           
          

</select>
</div>
<div class="form-group">
<label for="username">username</label>
<input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
</div>
<div class="form-group">
<label for="email">email</label>
<input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
</div>
<!--
<div class="form-group">
<label for="post_image">Post Image</label>
<input type="file"  name="post_image"/>
</div>
-->

<div class="form-group">
<label for="password">password</label>
<input type="password" class="form-control" name="password" autocomplete="off">
</div>

<div class="form-group">
<input  value="update user" type="submit" class="btn btn-primary" name="update_user"/>
</div>

</form>