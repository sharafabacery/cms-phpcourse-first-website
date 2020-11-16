<?php
   include("delete_modal.php");
   if (isset($_POST['checkBoxArray'])) {
     foreach($_POST['checkBoxArray'] as $checkBoxValue){
       
      $bulk_options=$_POST['bulk_options'];
      switch ($bulk_options) {
        case 'published':
          $query="update posts set post_status = 'published' where post_id='{$checkBoxValue}'";
          $update_to_published_status=mysqli_query($connection,$query);
          confirmQuery($update_to_published_status);

        break;
        case 'draft':
          $query="update posts set post_status = 'draft' where post_id='{$checkBoxValue}'";
          $update_to_draft_status=mysqli_query($connection,$query);
          confirmQuery($update_to_draft_status);
        break;

        case 'Delete':
          $query="delete from posts where post_id={$checkBoxValue}";
          $delete_query_post=mysqli_query($connection,$query);
          confirmQuery($delete_query_post);
        break;

        case 'clone':
          $query="select * from posts where post_id={$checkBoxValue}";
          $select_post_query=mysqli_query($connection,$query);
          while ($row=mysqli_fetch_array($select_post_query)) {
            $post_title=$row['post_title'];
            $post_category_id=$row['post_category_id'];
            $post_date=$row['post_date'];
            $post_tags=$row['post_tags'];
            $post_author=$row['post_author'];
            $post_status=$row['post_status'];
            $post_image=$row['post_image'];
            $post_content=$row['post_content'];
          }
           $query="insert into posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) " ;

    $query.="values({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' ); ";

    $create_post_query=mysqli_query($connection,$query);

    confirmQuery($create_post_query);
    
        default:
         
        break;
      }
     }
   }
?>
<form action="" method="post">
<table class="table table-bordered table-hover">
              <div id='bulkOptionsContainer' class="col-xs-4">
              <select class="form-control" id="" name="bulk_options">
              <option value="">Select option</option>
              <option value="clone">clone</option>
              <option value="published">Publish</option>
              <option value="draft">Draft</option>
              <option value="Delete">Delete</option>
              </select>
              </div>
              <div class="col-xs-4">
              <input type="submit" value="Apply" class="btn btn-success">
              <a href="posts.php?source=add_post" class="btn btn-primary">Addnew</a>
              </div>
              <br>
              <br>
              <br>
                <thead>
                <tr>
                <td><input type="checkbox" name="" id="selectAllBoxes"></td>
                <td>Id</td>
                <td>Author</td>
                <td>Title</td>
                <td>Category</td>
                <td>Status</td>
                <td>Image</td>
                <td>Tags</td>
                <td>Comments</td>
                <td>post_views_count</td>
                <td>Date</td>
                <td>view post</td>
                <td>reset view post</td>
                <td>Edit</td>
                <td>Dalete</td>
                
                </tr>
                </thead>
                <tbody>
               
                <?php
                     $username=currentUser();
                    //  $query="select * from posts  order by post_id desc";
                     $query="select  posts.post_id,posts.post_author,posts.post_user,posts.post_title,posts.post_category_id,posts.post_status,posts.post_image,";
                     $query.="posts.post_tags,posts.post_views_count,posts.post_date,categories.cat_id,categories.cat_title ";
                     $query.="from posts ";   
                     $query.=" left join categories on posts.post_category_id= categories.cat_id and  posts.post_author='$username' order by posts.post_id desc";   
                     $select_posts=mysqli_query($connection,$query);
                      while ($row=mysqli_fetch_assoc($select_posts)) {
                        $post_author=  $row['post_author'];
                        $post_id=$row['post_id'];
                        
                        $post_user=$row['post_user'];
                        $post_title=$row['post_title'];
                        $post_category_id=$row['post_category_id'];
                        $post_status=$row['post_status'];
                        $post_image=$row['post_image'];
                        $post_views_count=$row['post_views_count'];
                        //$post_comment_count=$row['post_comment_count'];
                        $post_date=$row['post_date'];
                        $post_tags=$row['post_tags'];
                         $cat_title=$row['cat_title'];
                        $cat_id=$row['cat_id'];
                     
                         
                        echo "<tr>";
                        ?>
                        <td><input type='checkbox' name='checkBoxArray[]' class='checkBoxes' value=<?php echo $post_id;?>></td>
                        <?php
                        echo "<td>$post_id</td>";
                        if(!empty($post_author)){
                           echo "<td>$post_author</td>";
                        
                        }elseif (!empty($post_user)) {
                          echo "<td>$post_user</td>";
                        }
                       echo "<td>$post_title</td>";
                        // $query="select * from categories where cat_id={$post_category_id}";
                        // $select_categories_id=mysqli_query($connection,$query);
                        // while($row=mysqli_fetch_assoc($select_categories_id)){
                        // $cat_title=$row['cat_title'];
                       // $cat_id=$row['cat_id'];
                      // }
                        echo "<td>$cat_title</td>";
                      
                        echo "<td>$post_status</td>";
                        echo "<td><img width='100' src='../images/$post_image' alt=image></td>";
                        echo "<td>$post_tags</td>";
                        $query="select * from comments where comment_post_id=$post_id";
                        $send_comment_query=mysqli_query($connection,$query);
                        $post_comment_count=mysqli_num_rows($send_comment_query);
                        $row=mysqli_fetch_array($send_comment_query);
                        
                        
                        
                        echo "<td><a href='post_comments.php?p_id=$post_id'>$post_comment_count</a></td>";
                        echo "<td>$post_views_count</td>";
                        echo "<td>$post_date</td>";
                        echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>view post</a></td>";
                        echo "<td><a class='btn btn-info'href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                       
                      
                       
                        echo "<td><a onClick=\"javascript:return confirm('Are you sure you want to reset views') \" href='posts.php?reset=$post_id'>resetviews</a></td>";
               
                        echo "<td><a class='btn btn-danger'onClick=\"javascript:return confirm('Are you sure you want to delete') \" href='posts.php?delete=$post_id'>Delete</a></td>";
                       
                       echo "</tr>";
                      
                       
                    }
                  ?> </form>
                
                
                
                </tbody>
                
                </table>
                </form>
                <?php
                if (isset($_GET['delete'])) {

                  $the_post_id=($_GET['delete']);
                 
                  $query="delete from posts where post_id={$the_post_id}";
                  $delete_query=mysqli_query($connection,$query);
                  header("Location:posts.php");
                   
                }
                if (isset($_GET['reset'])) {
                  $the_post_id=$_GET['reset'];
                  $query="update posts set post_views_count = 0 where post_id=".mysqli_real_escape_string($connection,$the_post_id)."";
                  $reset_query=mysqli_query($connection,$query);
                  header("Location:posts.php");
                   
                }
                ?>
                <script >
                $(document).ready(function(){
                  $(".delete_link").on('click',()=>{
                    let id=$(".delete_link").attr('rel')
                    let delete_url="posts.php?delete="+id+" "
                    console.log(delete_url)
                    $('.modal_delete_link').attr("href",delete_url)
                    $('#myModal').modal('show')
                   
                  })
                })
                </script>
               