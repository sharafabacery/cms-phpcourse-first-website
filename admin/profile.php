<?php include "includes/admin_header.php";?>
    <?php
    if ($_SESSION['username']) {
        $username=$_SESSION['username'];
        $query="select * from users where username='$username'";
        $select_user_profile_query=mysqli_query($connection,$query);

        while ($row=mysqli_fetch_array($select_user_profile_query)) {
            $user_id=$row['user_id'];
            $user_username=$row['username'];
            $user_firstname=$row['user_firstname'];
            $user_lastname=$row['user_lastname'];
            $user_password=$row['user_password'];
            $user_email=$row['user_email'];
            $user_role=$row['user_role'];
        }
    }
    if (isset($_POST["update_profile"])) {
        $user_firstname=$_POST['user_firstname'];
        $user_lastname=$_POST['user_lastname'];
        $email=$_POST['user_email'];
      //  $role=$_POST['role'];
        $username=$_POST['username'];
        $user_password=$_POST['user_password'];
       // $post_image=$post_image_temp="";
       // if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        //      $post_image=$_FILES['post_image']['name'];
        //$post_image_temp=$_FILES['post_image']['tmp_name'];
    
        //}
      
        
        //$password=$_POST['password'];
        //$user_date=date('d-m-y');
       // $post_comment_count=4;
        
       // move_uploaded_file($post_image_temp,"../../images/${post_image}");
       $query="update users set ";
       $query.="user_firstname = '{$user_firstname}', ";
       $query.="user_lastname = '{$user_lastname}', ";
       $query.="user_password = '{$user_password}', ";
       $query.="date = now(), ";
      // $query.="user_role = '{$role}', ";
       $query.="username = '{$username}' ";
       //$query.="post_tags = '{$post_tags}', ";
      // $query.="post_content = '{$post_content}', ";
       //$query.="post_image = '{$post_image}'  ";
       $query.="where user_id = {$user_id} ";
    
       $update_query=mysqli_query($connection,$query);
       
       confirmQuery($update_query);
    
       }
    
    
    ?>
    <div id="wrapper">

       <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            welcome Admin
                            <small>Aruthor</small>
                    </h1>   
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
<input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
</div>

<div class="form-group">
<input  value="update user" type="submit" class="btn btn-primary" name="update_profile"/>
</div>

</form>
                       
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>