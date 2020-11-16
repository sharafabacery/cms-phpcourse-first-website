

 <!-- Navigation -->
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms/">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    $query="select * from categories";
                    $select_all_categories_query=mysqli_query($connection,$query);
                    while ($row=mysqli_fetch_assoc($select_all_categories_query)) {
                      $cat_title=  $row['cat_title'];
                      $cat_id=  $row['cat_id'];
                      $category_class="";
                      $registration_class="";
                        //name of link
                      $page_name=  basename($_SERVER['PHP_SELF']);
                      $registation="registeration.php";
                      if (isset($_GET['category'])&&$_GET['category']==$cat_id) {
                          $category_class="active";
                      }elseif($page_name==$registation){
                          $registration_class="active";
                      }
                      echo "<li class='$category_class'> <a href='/cms/category/{$cat_id}'>{$cat_title}</a></li>";
                    }

                    ?>
                    <?php if (isLoggedIn()) :?>  
                        <li>
                        <a href="/cms/admin">Admin</a>
                       </li> 
                       <li>
                        <a href="/cms/includes/logout.php">logout</a>
                       </li> 
                    <?php else:?>
                        <li>
                        <a href="/cms/login">login</a>
                    </li>
                    <li class='<?php $registration_class;?>'><a href='/cms/registration'>register</a></li>
                  
                    <?php endif;?>
                           
                   

                     <li><a href='/cms/contact'>contact</a></li>
                 <?php
                // echo $_SESSION['role'];
                      if (isset($_SESSION['role'])) {
                          if (isset($_GET['p_id'])) {
                              echo "<li><a href='/cms/admin/posts.php?source=edit_post&p_id={$_GET['p_id']}'>edit</a></li>";
                          }
                      }
                 ?>
                    




                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
