<?php

function loginInUserId(){
    if (isLoggedIn()) {
        $result=query("select * from users where username='".$_SESSION['username']."'");
        confirmQuery($result);
        $user=mysqli_fetch_array($result);
        return mysqli_num_rows($result)>=1?$user['user_id']:false;
    }
}
function userLikedThisPost($post_id=''){
    $result=query("select * from likes where user_id=".loginInUserId()." and post_id=$post_id");
    confirmQuery($result);
    return mysqli_num_rows($result)>=1?true:false;
}
function getPostLikes($post_id){
    $result=query("select * from likes where post_id=$post_id");
    confirmQuery($result);
    echo mysqli_num_rows($result);
}
function query($query){
    global $connection;
    return mysqli_query($connection,$query);
}
function imagePlaceHolder($image=''){
if (!$image) {
    return 'download.jpg';
}else{
    return $image;
}
}
function confirmQuery($result){
    global $connection;
    if (!$result) {
        die("Query Failed .".mysqli_error($connection));
    }
    return ;
  
}
function ifItIsMethod($method=null){
       

    if ($_SERVER['REQUEST_METHOD']==strtoupper($method)) {
  
    
        return true;
    }else{
         return false;
    }    
   

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
function usernameExists($username){
    global $connection;
    $query ="select username from users where username='{$username}'";
   $result=mysqli_query($connection,$query);
    confirmQuery($result);
    if (mysqli_num_Rows($result)>0) {
        return true;
    }else{
        return false;
    } 
}
function emaileExists($email){
    global $connection;
    $query ="select user_email from users where user_email='{$email}'";
   $result=mysqli_query($connection,$query);
    confirmQuery($result);
    if (mysqli_num_Rows($result)>0) {
        return true;
    }else{
        return false;
    } 
}

function registerUser($username,$email,$password){
    global $connection;

    $username=mysqli_real_escape_string($connection,$username);
    $email=mysqli_real_escape_string($connection,$email);
    $password=mysqli_real_escape_string($connection,$password);
     
    $password=password_hash($password,PASSWORD_BCRYPT,['cost'=>12]);
    $query="insert into users (username,user_email,user_password,user_role) values('{$username}','{$email}','{$password}','subscriber')";
    $register_user_query=mysqli_query($connection,$query);
    confirmQuery($register_user_query);
    $message="your registration has been submitted";
    

    
}
// function login_User($username,$password){
//     global $connection;
    
//     $username=mysqli_real_escape_string($connection,trim($username));
//     $password=mysqli_real_escape_string($connection,trim($password));

//     $query="select * from users where username='{$username}' ";
//     $select_user_query=mysqli_query($connection,$query);

//     if (!$select_user_query) {
//         die('QueryFailed'.mysqli_error($connection));
//     }
    
//     while ($row=mysqli_fetch_array($select_user_query)) {
//         $db_id=$row['user_id'];
//         $db_username=$row['username'];
//         $db_firtname=$row['user_firstname'];
//         $db_lastname=$row['user_lastname'];
//         $db_password=$row['user_password'];
//         $db_role=$row['user_role'];
//     // $password=crypt($password,$db_password);//reverse
//     if (password_verify($password,$db_password)) {
//         $_SESSION['username']=$db_username;
//         $_SESSION['firstname']=$db_firtname;
//         $_SESSION['lastname']=$db_lastname;
//         $_SESSION['role']=$db_role;
//         header("Location: /cms/admin");
      

//     }else{
//         header("Location: /cms");
//     }
//     }
   
// }
function loginUser($username,$password){
        global $connection;
    $username=mysqli_real_escape_string($connection,trim($username));
    $password=mysqli_real_escape_string($connection,trim($password));

    $query="select * from users where username='{$username}' ";
    $select_user_query=mysqli_query($connection,$query);

    if (!$select_user_query) {
        die('QueryFailed'.mysqli_error($connection));
    }

    
    while ($row=mysqli_fetch_array($select_user_query)) {
        $db_id=$row['user_id'];
        $db_username=$row['username'];
        $db_firtname=$row['user_firstname'];
        $db_lastname=$row['user_lastname'];
        $db_password=$row['user_password'];
        $db_role=$row['user_role'];
        // $password=crypt($password,$db_password);//reverse
    if (password_verify($password,$db_password)) {
        $_SESSION['username']=$db_username;
        $_SESSION['firstname']=$db_firtname;
        $_SESSION['lastname']=$db_lastname;
        $_SESSION['role']=$db_role;
        $_SESSION['user_id']=$db_id;
    
       return header("Location: /cms/admin");
      

  
    }else{

      return  header("Location: /cms/login");
    }
    
    }
   
}
function isAdmin(){
    global $connection;
    $query ="select user_role from users where user_id='{$_SESSION['user_id']}'";
    $result=mysqli_query($connection,$query);
    confirmQuery($result);
    $row=mysqli_fetch_array($result);
    if (isset($row['user_role'])&&$row['user_role']=='admin') {
        return true;
    }else{
        return false;
    }
 }
?>