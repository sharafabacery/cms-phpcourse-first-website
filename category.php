<?php include 'includes/header.php';?>
<?php include 'includes/db.php';?>
   <?php include 'includes/navigation.php';?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
              <?php 
              if (isset($_GET['category'])) {
                  
                  $post_Category_id=$_GET['category'];
                  
                  if (isset($_SESSION['username'])&&isAdmin()) {
                   
                    $st11=mysqli_prepare($connection,"select post_id,post_title,post_author,post_date,post_image,post_content from posts where post_category_id= ?");

                }else{
                    $st21=mysqli_prepare($connection,"select post_id,post_title,post_author,post_date,post_image,post_content from posts where post_category_id= ? and post_status= ?");
                    $published="published";
                }
                    
                if (isset($st11)) {
                    
                    mysqli_stmt_bind_param($st11,'i',$post_Category_id);
                    mysqli_stmt_execute($st11);
                    mysqli_stmt_bind_result($st11,$post_id,$post_title,$post_author,$post_date,$post_image,$post_content);
                    $st=$st11; 
                    
                }else{
                    
                    mysqli_stmt_bind_param($st21,'is',$post_Category_id,$published);
                    mysqli_stmt_execute($st21);
                    mysqli_stmt_bind_result($st21,$post_id,$post_title,$post_author,$post_date,$post_image,$post_content);
                    $st=$st21;
                }
                
                //print_r($st);
                //mysqli_stmt_store_result($st);
             // $query="select * from posts where post_category_id=$post_Category_id and post_status='published'";
              //$select_all_posts_query=mysqli_query($connection,$query);
              $count = mysqli_stmt_num_rows($st);
              if ($count===0) {
                  echo "<h1>Noo post found </h1>";
                 
              }else{
              while ($row=mysqli_stmt_fetch($st)) {
                $post_title=  $row['post_title'];
                $post_author=  $row['post_author'];
                $post_date=  $row['post_date'];
                $post_image=  $row['post_image'];
                $post_content=substr(  $row['post_content'],0,50);
               ?>
                  

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $row['post_id']?>"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="index"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $row['post_id']?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php  
            
        
        }}
        mysqli_stmt_close($st);
    }
              ?>
              
         

           

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include 'includes/sidebar.php'?>
        </div>
        <!-- /.row -->

        <hr>

     <?php include 'includes/footer.php';?>