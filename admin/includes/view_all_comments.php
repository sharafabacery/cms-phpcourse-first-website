<table class="table table-bordered table-hover">
                <thead>
                <tr>
                <td>Id</td>
                <td>Author</td>
                <td>Comment</td>
                <td>Email</td>
                <td>Status</td>
                <td>In Response to</td>
                <td>Date</td>
                <td>Apporove</td>
                <td>Unapprove</td>
                <td>Edit</td>
                <td>Dalete</td>
                
                </tr>
                </thead>
                <tbody>
               
                <?php
                      $query="select * from comments";
                      $select_comments=mysqli_query($connection,$query);
                      while ($row=mysqli_fetch_assoc($select_comments)) {
                        $comment_author=  $row['comment_author'];
                        $comment_id=$row['comment_id'];
                        $comment_email=$row['comment_email'];
                      
                        $comment_status=$row['comment_status'];
                        $comment_post_id=$row['comment_post_id'];
                        $comment_content=$row['comment_content'];
                        $comment_date=$row['comment_date'];
                        
                         
                        echo "<tr>";
                        echo "<td>$comment_id</td>";
                        echo "<td>$comment_author</td>";
                        echo "<td>$comment_content</td>";
                        // $query="select * from categories where cat_id={$post_category_id}";
                        // $select_categories_id=mysqli_query($connection,$query);
                        // while($row=mysqli_fetch_assoc($select_categories_id)){
                        // $cat_title=$row['cat_title'];
                        // $cat_id=$row['cat_id']; }
                        // echo "<td>$cat_title</td>";
                      
                        echo "<td>$comment_email</td>";
                        echo "<td>$comment_status</td>";

                         $query_="select * from posts where post_id={$comment_post_id}";
                         $select_posts_id=mysqli_query($connection,$query_);
                         while($row=mysqli_fetch_assoc($select_posts_id)){
                         $post_title=$row['post_title'];
                         $post_id=$row['post_id']; 
                        }
                        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                        
                        
                        
                        echo "<td>$comment_date</td>";
                        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                        echo "<td><a href='comments.php?unapprove=$comment_id'>Disapprove</a></td>";
               
                        echo "<td><a href='comments.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
                        echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
               
                        echo "</tr>";
                    }
                ?>
                
                
                
                </tbody>
                
                </table>
                <?php
                 if (isset($_GET['approve'])) {
                  $the_comment_id=$_GET['approve'];
                  $query="update comments set comment_status='approved' where comment_id={$the_comment_id}";
                  $delete_query=mysqli_query($connection,$query);
                  header("Location:comments.php");
                   
                }
                if (isset($_GET['unapprove'])) {
                  $the_comment_id=$_GET['unapprove'];
                  $query="update comments set comment_status='unapproved' where comment_id={$the_comment_id}";
                  $delete_query=mysqli_query($connection,$query);
                  header("Location:comments.php");
                }
                if (isset($_GET['delete'])) {
                  $the_comment_id=$_GET['delete'];
                  $query="delete from comments where comment_id={$the_comment_id}";
                  $delete_query=mysqli_query($connection,$query);
                  header("Location:comments.php");
                }
                ?>
               