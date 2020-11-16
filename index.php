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
               $per_page=2;
              if (isset($_GET['page'])) {
                 
                  $page=$_GET['page'];
              }else{
                  $page="";
              }
              if ($page==""||$page==1) {
                  $page_1=0;
              }else{
                  $page_1=($page*$per_page)-$per_page;
              }
              if (isset($_SESSION['role'])&&$_SESSION['role']=='admin') {
                $post_query_count="select * from posts ";
                $query="select * from posts ";
            }else{
                $post_query_count="select * from posts where  post_status='published'";
                $query="select * from posts where post_status='published'";
            }
              //$post_query_count="select * from posts  where post_status='published'";
              $find_count=mysqli_query($connection,$post_query_count);
              $count=mysqli_num_rows($find_count);
            //pre page
              $count=ceil($count/$per_page);
              
              $query=$query."limit $page_1,$per_page";
              $select_all_posts_query=mysqli_query($connection,$query);
              if ($select_all_posts_query->num_rows==0) {
            echo "<h1 class='text-center'>No POSTS SORRY</h1>";
        }
              while ($row=mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title=  $row['post_title'];
                $post_author=  $row['post_author'];
                $post_user=  $row['post_user'];
                $post_date=  $row['post_date'];
                $post_image=  $row['post_image'];
                
                $post_content=substr(  $row['post_content'],0,50);
               ?>
                  

                <!-- First Blog Post -->
                <h2>
                    <a href="post/<?php echo $row['post_id']?>"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
              
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $row['post_id']; ?>"><?php echo $post_author ; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
                <hr>
                <a href="post/<?php echo $row['post_id']?>"><img class="img-responsive" src="images/<?php echo imagePlaceHolder($post_image)?>" alt=""></a>
                
                <hr>
                <p><?php echo $post_content;?></p>
                <a class="btn btn-primary" href="post/<?php echo $row['post_id']?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php  
            
        
        }
              ?>
              
         

           

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include 'includes/sidebar.php'?>
        </div>
        
        <!-- /.row -->

        <ul class="pager">
        
        
        <?php
        for ($i=1; $i <=$count ; $i++) {
            if ($i==$page) {
                echo "<li > <a href='index.php?page=$i' class='active_link'>$i</a></li>";
            }else{
                echo "<li > <a href='index.php?page=$i'>$i</a></li>";
            } 
            
        }
        ?>
        </ul>
        <hr>

     <?php include 'includes/footer.php';?>