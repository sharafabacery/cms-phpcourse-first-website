<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 <?php
 require 'vendor/autoload.php';
 require './classes/config.php';
 $config=new Config();

 $options = array(
    'cluster' => $config->cluster,
    'useTLS' => true
  );

  $pusher = new Pusher\Pusher(
    $config->key,
    $config->secret,
    $config->app_id,
    $options
  );
  if (isset($_GET['lang']) &&!empty($_GET['lang'])) {
      $_SESSION['lang']=$_GET['lang'];

      if (isset($_SESSION['lang'])&&$_SESSION['lang']!=$_GET['lang']) {
          echo "<script type='text/javascript'>
          location.reload()
          </script>";
      }
    }
      if (isset($_SESSION['lang'])) {

          include "includes/languages/".$_SESSION['lang'].".php";
      }else{
         
        include "includes/languages/en.php";
          
      }
  
 if ($_SERVER['REQUEST_METHOD']=="POST") {
    $username=trim($_POST['username']);
    $email=trim($_POST['email']);
    $password=trim($_POST['password']);

    $error=['username'=>'','email'=>'','password'=>''];
    if(strlen($username)<5)
    $error['username']='Username needs to longer';

    if($username=='')
    $error['username']='Username cannot be empty';

    if(usernameExists($username))
    $error['username']='Username already exists, pick another  ';
    
    if($email=='')
    $error['email']='email cannot be empty';

    if(emaileExists($email))
    $error['email']='email already exists, pick another,<a href="index.html">please login</a>  ';
    
    if($password=='')
    $error['password']='password cannot be empty';

    foreach($error as $key => $value){
        if (empty($value)) {
            unset($error[$key]);
        }
    }
    if (empty($error)) {
        registerUser($username,$email,$password); 
        //pass event and channel and js recive it
        $data=['message'=>$username];
        $pusher->trigger('notification','new User',$data);//channel + event+ data 
        loginUser($username,$password);
    }
   
    
 }
 ?>
    <!-- Page Content -->
    <div class="container">

    <form method="get" class="navbar-form navbar-right" id="language_form">
    <div class='form-group' >
    <select name="lang"  onchange="changeLanguage()">
    <option value="en" <?php  if (isset($_SESSION['lang'])&&$_SESSION['lang']='en') {echo "selected";}?>>English</option>
    <option value="es" <?php  if (isset($_SESSION['lang'])&&$_SESSION['lang']='es') {echo "selected";}?>>Spanish</option>
    </select>
    </div>
    </form>
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1><?php echo _REGISTER;?></h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only"><?php echo  _USERNAME;?></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo  _USERNAME;?>" autocomplete='on' value="<?php echo isset($username)?$username:'';?>" required>
                            <p><?php echo isset($error['username'])?$error['username']:"";?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only"><?php echo _EMAIL;?></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL;?>" autocomplete='on' value="<?php echo isset($email)?$email:'';?>" required>
                            <p><?php echo isset($error['email'])?$error['email']:"";?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only"><?php echo _PASSWORD?></label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD?>" required>
                            <p><?php echo isset($error['password'])?$error['password']:"";?></p>
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

<script>
function changeLanguage(){
   document.getElementById('language_form').submit()


}
</script>

<?php include "includes/footer.php";?>
