<?php include 'includes/header.php';?>
<?php include 'includes/db.php';?>
   <?php include 'includes/navigation.php';?>
   <?php
   if (isset($_POST['liked'])) {
       $post_id=$_POST['post_id'];
       $user_id=$_POST['user_id'];
       $query="select * from posts where post_id={$post_id}";
       $postres=mysqli_query($connection,$query);
       $post=mysqli_fetch_array($postres);
       $likes=$post['likes'];
      

       mysqli_query($connection,"update posts set likes=$likes+1 where post_id=$post_id");
       
       mysqli_query($connection,"insert into likes(user_id,post_id) values($user_id,$post_id)");
         
       return header("Location: /cms/post/$post_id");


    }
    if (isset($_POST['unliked'])) {
       
        $post_id=$_POST['post_id'];
        $user_id=$_POST['user_id'];
        $query="select * from posts where post_id={$post_id}";
       
        $postres=mysqli_query($connection,$query);
        $post=mysqli_fetch_array($postres);
        $likes=$post['likes'];
       
        mysqli_query($connection,"delete from likes  where post_id=$post_id and user_id=$user_id");
        
         mysqli_query($connection,"update posts set likes=$likes-1 where post_id=$post_id");
         return header("Location:/cms/post/$post_id");
        // mysqli_query($connection,"insert into likes(user_id,post_id) values($post_id,$user_id)");
 
 
     }
   ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
              <?php 
               if (isset($_GET['p_id'])) {
                $the_post_id=$_GET['p_id'];
               // $query="update posts set post_views_count=post_views_count+1 where post_id={$the_post_id}";
                //$update_query=mysqli_query($connection,$query);
            
                if (isset($_SESSION['role'])&&$_SESSION['role']=='admin') {
                    $query="select * from posts where post_id=$the_post_id";
                }else{
                    $query="select * from posts where post_id=$the_post_id and post_status='published'";
                }
              //$query="select * from posts where post_id=$the_post_id";
              $select_all_posts_query=mysqli_query($connection,$query);
              if (mysqli_num_rows($select_all_posts_query)==0) {
                echo "<h1>No posts found</h1>";
                die();
            }
              while ($row=mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title=  $row['post_title'];
                $post_id=  $row['post_id'];
                $post_author=  $row['post_author'];
                $post_user=  $row['post_user'];
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
                    <a href="post.php?p_id=<?php echo $row['post_id'] ?>"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                
                <?php
                   echo "by <a href='index.php'> $post_author </a>";
                 
                 
                ?>
                    
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
                <hr>
              
                <img class="img-responsive" src="/cms/images/<?php echo imagePlaceHolder($post_image);?>" alt="444">
                <hr>

                <p><?php echo $post_content;?></p>
                <?php
                if(isLoggedIn()){?>
                  <div class='row'>
                  <p class='pull-right'><a 
                  data-toggle='tooltip'
                  data-placement="top"
                  title="<?php echo userLikedThisPost($the_post_id)?'i liked it before':'want to like?'?>"
                  class=<?php echo userLikedThisPost($the_post_id)?'unlike':'like'?> href='#'><span class='glyphicon glyphicon-thumbs-up'></span> <?php echo userLikedThisPost($the_post_id)?'unlike':'like'?></a></p></div>

                   
                <?php }else{?>
                    <div class='row'>
                    <p class='pull-right'>you need to <a href='/cms/login.php'>login</a> to like </p>
                </div>
                    
                <?php }
                ?>
               
                <div class="row">
                <p class='pull-right'>Like: <?php getPostLikes($the_post_id)?></p>
                </div>
                <div class="clearfix">

                </div>
                <!--<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->

                <hr>

            <?php  
            
        
        }}else{
            header('Location:index.php');
        }
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
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" name="comment_author" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                        <label for="Email">Email</label>
                           <input type="email" name="comment_email" class="form-control" required> 
                        </div>
                        <div class="form-group">
                        <label for="comment">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                $query="select * from comments where comment_post_id={$the_post_id} and comment_status='approved' order by comment_id Desc";
                $select_comment_query=mysqli_query($connection,$query);
                if (!$select_comment_query) {
                    die("Query Failed .".mysqli_error($connection));
                }
                while ($row=mysqli_fetch_array($select_comment_query)) {
                   $comment_date=$row['comment_date'];
                   $comment_content=$row['comment_content'];
                   $comment_author=$row['comment_author'];
                   
              ?>

                 <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $comment_author ;?> 
                            <small><?php echo $comment_date ;?> </small>
                        </h4>
                     <?php echo $comment_content;?> 
                    </div>
                </div>
                </div>

            
                 <?php } ?>
                <!-- Comment -->
              

            <!-- Blog Sidebar Widgets Column -->
           <?php include 'includes/sidebar.php'?>
        </div>
        <!-- /.row -->

        <hr>

     <?php include 'includes/footer.php';?>
     <script>
     $(document).ready(function(){
         $("[data-toggle='tooltip']").tooltip()
        let post_id=<?php echo $the_post_id;?>;
        let user_id=<?php echo loginInUserId();?>;
       
        $('.like').click(function() {
            
            $.ajax({
                url:'/cms/post.php?p_id=<?php echo $the_post_id;?>'
                ,type:'POST'
                ,data:{
                    'liked':1,
                    'post_id':post_id,
                    'user_id':user_id

                }
            })
            
        })

        $('.unlike').click(function() {
            let post_id=<?php echo $the_post_id;?>;
            let user_id=<?php echo loginInUserId();?>;
        $.ajax({
            url:'/cms/post.php?p_id=<?php echo $the_post_id;?>'
            ,type:'POST'
            ,data:{
            'unliked':1,
            'post_id':post_id,
            'user_id':user_id

            }
            })
            })
     })
     </script>