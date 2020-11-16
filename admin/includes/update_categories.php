<form action="" method="post">
                        <div class="form-Group">
                        <label for="cat_title">Edit Category</label>
                        <?php
                        update_categories()?>
                        <?php
                        if (isset($_POST['update_category'])) {
                            $the_cat_title=$_POST['cat_title'];
                            $stmt=mysqli_prepare($connection,"update categories set cat_title=? where cat_id=?");
                            mysqli_stmt_bind_param($stmt,'si',$the_cat_title,$cat_id);
                            mysqli_stmt_execute($stmt);

                            //$update_query=mysqli_query($connection,$query);
                            if (!$stmt) {
                                die("Query Failed".mysqli_error($connection));
                            }
                            mysqli_stmt_close($stmt);
                            header("Location:categories.php");
                        }
                        ?>
                       
                        
                        </div>
                        