<?php include 'includes/header.php';?>
<?php include 'includes/db.php';?>
   <?php include 'includes/navigation.php';?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
              <?php 
               if (isset($_GET['p_id'])) {
                $the_post_id=$_GET['p_id'];
                $the_author_id=$_GET['author'];
            
              $query="select * from posts where post_author='$the_author_id' ";
              $select_all_posts_query=mysqli_query($connection,$query);
              while ($row=mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title=  $row['post_title'];
                $post_id=  $row['post_id'];
                $post_author=  $row['post_author'];
                $post_date=  $row['post_date'];
                $post_image=  $row['post_image'];
                $post_content=  $row['post_content'];
               ?>
                  <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    all post by <?php echo $post_author; ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>
                 
                <!--<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->

                <hr>

            <?php  
            
        
        }}
              ?>
              
                <!-- Blog Comments -->
                <?php
                    if (isset($_POST['create_comment'])) {
                        $the_post_id=$_GET['p_id'];
                         $comment_author=$_POST['comment_author'];
                        $comment_email=$_POST['comment_email'];
                        $comment_content=$_POST['comment_content'];
                        if (!empty($comment_author)&&!empty($comment_email)&&!empty($comment_content)) {
                        

                        $query="insert into comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)";
                        $query.=" values ($the_post_id,'{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())";

                        $create_comment_query=mysqli_query($connection,$query);

                        if (!$create_comment_query) {
                            die("Query Failed .".mysqli_error($connection));
                        }

                        $query="update posts set post_comment_count=post_comment_count+1 where post_id={$the_post_id}";

                        $update_count=mysqli_query($connection,$query);

                        if (!$update_count) {
                            die("Query Failed .".mysqli_error($connection));
                        }
                        }else{
                            echo "<script>alert('fields cannot be empty')</script>";
                        }
                        
                       


                    }
                ?>
                <!-- Comments Form -->
               

               
              

            <!-- Blog Sidebar Widgets Column -->
           <?php include 'includes/sidebar.php'?>
        </div>
        <!-- /.row -->

        <hr>

     <?php include 'includes/footer.php';?>