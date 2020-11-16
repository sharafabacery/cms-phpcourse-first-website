<table class="table table-bordered table-hover">
                <thead>
                <tr>
                <td>Id</td>
                <td>username</td>
                <td>firstname</td>
                <td>lastname</td>
                <td>email</td>
                <td>role</td>
                <td>date</td>
                <td>change_to_admin</td>
                <td>change_to_subscriber</td>
                <td>Edit</td>
                <td>Dalete</td>
                
                </tr>
                </thead>
                <tbody>
               
                <?php
                      $query="select * from users";
                      $select_users=mysqli_query($connection,$query);
                      while ($row=mysqli_fetch_assoc($select_users)) {
                        $username=  $row['username'];
                        $user_id=$row['user_id'];
                        $user_email=$row['user_email'];
                        $user_firstname=$row['user_firstname'];
                        $user_lastname=$row['user_lastname'];
                      
                        $user_role=$row['user_role'];
                        $user_image=$row['user_image'];
                        //$user_post_id=$row['user_post_id'];
                        //$user_content=$row['user_content'];
                        $user_date=$row['date'];
                        
                         
                        echo "<tr>";
                        echo "<td>$user_id</td>";
                        echo "<td>$username</td>";
                        echo "<td>$user_firstname</td>";
                        echo "<td>$user_lastname</td>";
                        // $query="select * from categories where cat_id={$post_category_id}";
                        // $select_categories_id=mysqli_query($connection,$query);
                        // while($row=mysqli_fetch_assoc($select_categories_id)){
                        // $cat_title=$row['cat_title'];
                        // $cat_id=$row['cat_id']; }
                        // echo "<td>$cat_title</td>";
                      
                        echo "<td>$user_email</td>";
                        echo "<td>$user_role</td>";
                        echo "<td>$user_date</td>";

                         //$query_="select * from posts where post_id={$user_post_id}";
                         //$select_posts_id=mysqli_query($connection,$query_);
                         //while($row=mysqli_fetch_assoc($select_posts_id)){
                         //$post_title=$row['post_title'];
                         //$post_id=$row['post_id']; 
                       // }
                       // echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                        
                        
                        
                        //echo "<td>$comment_date</td>";
                        echo "<td><a href='users.php?change_to_admin=$user_id'>change_to_admin</a></td>";
                        echo "<td><a href='users.php?change_to_subscriber=$user_id'>change_to_subscriber</a></td>";
               
                        echo "<td><a href='users.php?source=edit_user&p_id=$user_id'>Edit</a></td>";
                        echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
               
                        echo "</tr>";
                    }
                ?>
                
                
                
                </tbody>
                
                </table>
                <?php
                 if (isset($_GET['change_to_admin'])) {
                  $the_user_id=escape($_GET['change_to_admin']);
                 
                  $query="update users set user_role='admin' where user_id={$the_user_id}";
                  $delete_query=mysqli_query($connection,$query);
                  header("Location:users.php");
                   
                }
                if (isset($_GET['change_to_subscriber'])) {
                  $the_user_id=$_GET['change_to_subscriber'];
                  $query="update users set user_role='subscriber' where user_id={$the_user_id}";
                  $delete_query=mysqli_query($connection,$query);
                  header("Location:users.php");
                }
                if (isset($_GET['delete'])) {
                  if(isset($_SESSION['role'])){
                    if ($_SESSION['role']=='admin') {
                      
                      $the_user_id=mysqli_escape_string($_GET['delete']);
                      $query="delete from users where user_id={$the_user_id}";
                      $delete_query=mysqli_query($connection,$query);
                      header("Location:users.php");
                          
                    }
                  }
                }
                ?>
               