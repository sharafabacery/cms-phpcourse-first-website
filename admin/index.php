<?php include "includes/admin_header.php";?>

    <div id="wrapper">
        <?php
        
        ?>
    <?php
    if($connection){
        echo "con";
    }
    
    
    
    ?>
       <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            welcome Admin
                           
                            <small> <?php
                           
                           echo strtoupper(get_user_name());
                           ?>
                           </small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        
                  <div class='huge'>

                    <?php echo $post_count=get_all_user_post();?>
                  </div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  
                     <div class='huge'><?php echo $comment_count=get_all_posts_user_comments();?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
 
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                   
                        <div class='huge'><?php echo $category_count=get_all_user_categories();?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
            <?php

$post_draft_count=checkStatus('posts','post_status','draft');

$comment_unapproved_count=checkStatus('comments','comment_status','unapproved');


$users_subscriber_count=checkUserRole('users','user_role','subscriber');
        


            ?>
                <!-- /.row -->
<div class="row">
<script type="text/javascript">

      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['data', 'Count'],
          <?php
          $elements_text=['all posts','Active Post','Draft post','Categories','Comments(approved)','Comments(unapproved)'];
          $elements_count=[$post_count,$post_count-$post_draft_count,$post_draft_count,$category_count,$comment_count-$comment_unapproved_count,$comment_unapproved_count];
        
          for ($i=0; $i <5 ; $i++) { 
             echo "['$elements_text[$i]'".","."'$elements_count[$i]'], ";
          }
          
          ?>
          
         
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
 <div id="columnchart_material" style="width:'auto'; height: 500px;"></div>

</div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>

$(document).ready(()=>{
    //Pusher.logToConsole = true;

    const pusher = new Pusher('e64f89dbbf74e11eaf4d', {
      cluster: 'mt1'
    });

    const channel = pusher.subscribe('notification');
    channel.bind('new User', function(data) {
     toastr.success(`${data.message} just registerd`)
    });
})
</script>