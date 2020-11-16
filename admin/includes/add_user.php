<?php
if (isset($_POST["create_user"])) {
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
  
    
    $password=password_hash($_POST['password'],PASSWORD_BCRYPT,['cost'=>12]);
    //$user_date=date('d-m-y');
   // $post_comment_count=4;
    
   // move_uploaded_file($post_image_temp,"../../images/${post_image}");

    $query="insert into users(username,user_password,user_firstname,user_lastname,user_role,user_email,date) " ;

    $query.="values('{$username}','{$password}','{$user_firstname}','{$user_lastname}','{$role}','{$email}',now() ); ";

    $create_user_query=mysqli_query($connection,$query);

    confirmQuery($create_user_query);
    echo "User Created:"." "."<a href='users.php'>View users</a>";
}

?>

<form action="" method="post" enctype="mulipart/form-data">

<div class="form-group">
<label for="firtname">firtname</label>
<input type="text" class="form-control" name="user_firstname">
</div>
<div class="form-group">
<label for="lastname">lastname</label>
<input type="text" class="form-control" name="user_lastname">
</div>
<div class="form-group">
<label for="role">role</label>
<select name="role" id="">

    <option value='subscriber'>select option</option>        
    <option value='admin'>admin</option>        
    <option value='subscriber'>subscriber</option>        
          

</select>
</div>
<div class="form-group">
<label for="username">username</label>
<input type="text" class="form-control" name="username">
</div>
<div class="form-group">
<label for="email">email</label>
<input type="email" class="form-control" name="user_email">
</div>
<!--
<div class="form-group">
<label for="post_image">Post Image</label>
<input type="file"  name="post_image"/>
</div>
-->
<div class="form-group">
<label for="password">password</label>
<input type="password" class="form-control" name="password">
</div>

<div class="form-group">
<input  value="create user" type="submit" class="btn btn-primary" name="create_user"/>
</div>

</form>