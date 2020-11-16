<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 <?php
 if (isset($_POST['submit'])) {
    $to="abacerysharaf@gmail.com";
    $subject=$_POST['subject'];
    $body=$_POST['body'];
    $headers="From: ".$_POST['email'];

    mail($to,$subject,$body,$headers);

 }
 
 ?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                <h6  class="text-center"><?php echo $message;?></h6>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject" required>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">subject</label>
                           <textarea name="body" id="body" cols="50" rows="10" class="form-control"></textarea>
                            </div>
                        
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
