<?php

if(ifItIsMethod('post')){
    if (isset($_POST['login'])) {
         if(isset($_POST['username']) && isset($_POST['password'])){
     
        loginUser($_POST['username'], $_POST['password']);


    }else {

     
      
       return header("Location: index");
    }
    }
            
   

}

?>
<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input  type="text" class="form-control" name="search">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div></form>
    <!-- /.input-group -->
</div>

<div class="well">
<?php if(isset($_SESSION['role'])):?>
<h4>Logged in as <?php echo $_SESSION['username']?></h4>
<a href="/cms/includes/logout.php" class="btn btn-primary">logout</a>
<?php else:?>
<h4>login</h4>
    <form  method="post">
    <div class="form-group">
        <input  type="text" class="form-control" name="username" placeholder="Enter username">
       
    </div>
    <div class="input-group">
        <input  type="password" class="form-control" name="password" placeholder="Enter password">
        <span class="input-group-btn">
        <button class="btn btn-primary" name="login" type="submit">
        submit
        </button>
        </span>
    </div>
    <div class="from-group">
    <a href="/cms/forgot.php?forgot=<?php echo uniqid(true);?>">forgot password</a>
    
    </div>
    
    </form>
<?php endif;?>
    
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">

<?php
                    $query="select * from categories";
                    $select_categories_sidebar=mysqli_query($connection,$query);
                  

                    ?>
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php
              while ($row=mysqli_fetch_assoc($select_categories_sidebar)) {
                $cat_title=  $row['cat_title'];
                $cat_id=  $row['cat_id'];
                echo "<li> <a href='../category/$cat_id'>{$cat_title}</a></li>";
              }
            
            
            ?>
               
            </ul>
        </div>
        <!-- /.col-lg-6 -->
      
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include 'widget.php';?>


</div>
