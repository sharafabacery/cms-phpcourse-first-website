<?php include "includes/admin_header.php";?>
    <div id="wrapper">

       <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            welcome Admin
                            <small>Aruthor</small>
                        </h1>
                        <div class="col-xs-6">
                        <?php
                        insert_categories();
                        ?>
                        <?php
                       deleteCategories()
                        
                        ?>
                        <form action="categories.php" method="post">
                        <div class="form-Group">
                        <label for="cat_title">Add Category</label>
                        <input class="form-control" type="text" name="cat_title">
                        </div>
                        <div class="form-Group">
                        <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </div>
                        </form>
                        <?php if (isset($_GET['edit'])) {
                            $cat_id=$_GET['edit'];
                            include "includes/update_categories.php";
                        } ?>
                        <div class="form-Group">
                        <input class="btn btn-primary" type="submit" name="update_category" value="update Category">
                        </div>
                        </form>
                        </div>
                        <div class="col-xs-6">
                          
                        <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                        <td>Id</td>
                        <td>Category title</td>
                        </tr>
                        </thead>
                        <tbody>
                        
                      
   
            <?php
             findAllCategories();
            
            ?>
                     
                        </tbody>
                        </table>
                        
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>