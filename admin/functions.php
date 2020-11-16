<?php
function escape($string){
    global $connection;
return mysqli_real_escape_string($connection,trim($string));
}
function currentUser(){
    if (isset($_SESSION['username'])) {
        return $_SESSION['username'];
    }else{
        return false;
    }
}
function ifItIsMethod($method=null){
if ($_SERVER['REQUEST_METHOD']==strtoupper($method)) {
    return true;
}
return false;
}
function isLoggedIn(){
    if (isset($_SESSION['role'])) {
        return true;
    }
    return false;
}
function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    if (isLoggedIn()) {
        return header("Location: ".$redirectLocation);
    }
}
function confirmQuery($result){
    global $connection;
    if (!$result) {
        die("Query Failed .".mysqli_error($connection));
    }
    return ;
  
}
function users_online(){
    if(isset($_GET['online_users']))
    {
    global $connection;
    if (!$connection) {
        session_start();
        include("../includes/db.php");

        $session=session_id();//id of session
        $time=time();
        $time_out_in_second=5;//marked offline
        $time_out=$time-$time_out_in_second;
        //count users
        $query="select * from users_online where session='$session'";
        $send_query=mysqli_query($connection,$query);
        $count=mysqli_num_rows($send_query);
        if($count==NULL){
           mysqli_query($connection,"insert into users_online(session,time) values('$session',$time)");
        }else{
           mysqli_query($connection,"update users_online set time=$time where session='$session'");
           
        }
        $user_online_query=mysqli_query($connection,"select * from users_online where time > $time_out");
        $count_user=mysqli_num_rows($user_online_query);
    
        echo $count_user;
    


    }
    }
    
}
users_online();
function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){

        $cat_title=$_POST['cat_title'];
        if ($cat_title ==""||empty($cat_title)) {
           echo "This field should not be empty";
        }else {
            $stmt=mysqli_prepare($connection,"insert into categories(cat_title) values(?)");
            mysqli_stmt_bind_param($stmt,'s',$cat_title);
            mysqli_stmt_execute($stmt);

           // $create_category_query=mysqli_query($connection,$query);
            if (!$stmt) {
                die('Query Failed'.mysqli_error($create_category_query));
            }
            mysqli_stmt_close($stmt);
                            
        }
      }
}
function update_categories(){
    global $connection;
    if (isset($_GET['edit'])) {
        $cat_id=$_GET['edit'];
        $query="select * from categories where cat_id={$cat_id}";
        $select_categories_id=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_categories_id)){
            $cat_title=$row['cat_title'];
            $cat_id=$row['cat_id']; 
            ?>
<input class="form-control" type="text" name="cat_title" value="<?php if(isset($cat_title)){ echo $cat_title;}  ?>">
            <?php

        }
        
    }
}
function findAllCategories(){
    global $connection;
    $query="select * from categories";
    $select_categories_sidebar=mysqli_query($connection,$query);
    while ($row=mysqli_fetch_assoc($select_categories_sidebar)) {
        $cat_title=  $row['cat_title'];
        $cat_id=$row['cat_id'];
        echo "<tr><td>{$cat_id}</td><td>{$cat_title}</td><td><a href='categories.php?delete={$cat_id}'>Delete</a></td><td><a href='categories.php?edit={$cat_id}'>Update</a></td><tr>";
      }
    
}
function deleteCategories(){
    global $connection;
    if (isset($_GET['delete'])) {
        $the_cat_id=$_GET['delete'];
        $query="delete from categories where cat_id={$the_cat_id}";
        $delete_query=mysqli_query($connection,$query);
        header("Location: categories.php");
    }
}

function get_all_user_post(){
    global $connection;
    
    $query="select * from posts where user_id =  ".$_SESSION['user_id'];
    
    $select_all_post=mysqli_query($connection,$query);
    $result=mysqli_num_rows($select_all_post);
    confirmQuery($select_all_post);
    return $result;
  

}
function get_all_user_categories(){
    global $connection;
    
    $query="select * from categories where user_id =  ".$_SESSION['user_id'];
    
    $select_all_category=mysqli_query($connection,$query);
    $result=mysqli_num_rows($select_all_category);
    confirmQuery($select_all_category);
    return $result;
  
}
function get_all_posts_user_comments(){
    global $connection;
    
    $query="select * from posts inner join comments on posts.post_id=comments.comment_post_id where posts.user_id=".$_SESSION['user_id'];
    
    $select_all_post=mysqli_query($connection,$query);
    $result=mysqli_num_rows($select_all_post);
    confirmQuery($select_all_post);
    return $result;
  

}
function record_count($table){
    global $connection;
    $query="select * from ".$table;
    $select_all_post=mysqli_query($connection,$query);
    $result=mysqli_num_rows($select_all_post);
    confirmQuery($result);
    return $result;
  

}
function checkStatus($table,$column,$staus){
    global $connection;
    $query="select * from $table where $column ='$staus' ";
    
    $select_all_draft_post=mysqli_query($connection,$query);
     $result=mysqli_num_rows($select_all_draft_post);
   // confirmQuery($result);
    return $result;

}
function checkUserRole($table,$column,$staus){
    global $connection;
    $query="select * from $table where $column ='$staus' ";
    
    $select_user=mysqli_query($connection,$query);
     $result=mysqli_num_rows($select_user);
   // confirmQuery($result);
    return $result;

}
function get_user_name(){
    
        return isset($_SESSION['username'])?$_SESSION['username']:null;
    
}
// function fetchRecords($records){
//     return mysqli_fetch_array($result);
// }
function isAdmin(){
   global $connection;
   if(isLoggedIn()){
        $query ="select user_role from users where user_id='{$_SESSION['user_id']}'";
        $result=mysqli_query($connection,$query);
        confirmQuery($result);
        $row=mysqli_fetch_array($result);
        if ($row['user_role']=='admin') {
           return true;
        }else{
       return false;
        }
    }
    return false;
  
}



?>