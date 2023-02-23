<?php include "inc/header.php";
include "inc/menubar.php" ;
include 'core/insert.php';
include 'core/update.php';


?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Category</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
  <div class="row">
  <div class="col-lg-5">
        <!-- add user -->
        <div class="card">
            <div class="card-body">
              <?php
                if(isset($_GET['editID'])){
                  $editId =  $_GET['editID'];
                  $readSubSql = "SELECT * FROM mart_category WHERE ID = '$editId' ";
                  $readSubResult = mysqli_query($db, $readSubSql);

                  $row = mysqli_fetch_assoc($readSubResult);
                    $e_c_ID     =   $row['ID'];
                    $e_c_name     =   $row['c_name'];
                    $e_c_image    =   $row['c_image'];
                    $e_is_parent    =   $row['is_parent'];
                    $e_c_status   =   $row['c_status'];
                  ?>
                  <h5 class="card-title">Edit Category</h5>
                  <!-- No Labels Form -->
                  <form class="row g-3" action='core/update.php' method="post" enctype="multipart/form-data" >
                  <div class="col-md-12">
                  <input type="text" class="form-control" value="<?php echo $e_c_name; ?>" name="catName" >
                  </div>
                  <div class="col-md-12">
                    <small> Choose your parent catagory If any </small>
                    <select id="inputState" class="form-select"  name="isParent"> 
                    <option value="0" >Choose category...</option>
                      
                  <?php
                    $radCatSql = "SELECT * FROM mart_category WHERE is_parent = 0 ORDER BY c_name ASC";
                    $readCatResult = mysqli_query($db, $radCatSql);
                    $serial = 0;

                    while($row = mysqli_fetch_assoc($readCatResult)){
                      $cat_id     =   $row['ID'];
                      $c_name     =   $row['c_name'];
                      $c_image    =   $row['c_image'];
                      $is_parent    =   $row['is_parent'];
                      $c_status   =   $row['c_status'];
                  ?>

                      <option value="<?php echo $cat_id;?>" <?php if($e_is_parent  == $cat_id ) echo "selected" ?> > <?php echo $c_name;?> </option>
                  <?php
                    }
                  ?>
                    </select>
                  </div>
                  <div class="col-md-12">
                    <small>Choose your category status</small>
                    <select class="form-select" name="c_status">
                      <option value="1" <?php if($e_c_status == 1) echo 'selected'?> >Active</option>
                      <option value="0" <?php if($e_c_status == 0) echo 'selected'?> >Inactive</option>
                    </select>
                  </div>
                  <div class="col-md-12 codepen-img">
                    <?php
                      if(empty($e_c_image)){
                        echo '<p class="alert alert-danger"> No image found </p>';
                      }else{
                        ?>
                        <img class="w-50 d-block" src="assets/img/product/category/<?php echo $e_c_image; ?>" alt="" >
                        <?php
                      }
                    ?>
                    <small> Choose your catagory image </small>
                  <div class="box">
                      <div class="js--image-preview"></div>
                          <div class="upload-options">
                          <label>
                              <input type="file" class="image-upload" accept="image/*" name="catImage"/>
                          </label>
                          
                          </div>
                      </div>
                  </div>
                  <div class="text-start">
                    <input type="hidden" value="<?php echo $editId; ?>" name="editId">
                    <button type="submit" class="btn btn-primary" name="catUpdate">Update</button>
                  </div>
                </form><!-- End No Labels Form -->
                  <?php
                }else{
                  ?>
                  <h5 class="card-title">Add New Category</h5>
                    <!-- No Labels Form -->
              <form class="row g-3" action='core/insert.php' method="post" enctype="multipart/form-data" >
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Category Name" name="catName" >
                </div>
                <div class="col-md-12">
                  <small> Choose your parent catagory If any </small>
                  <select id="inputState" class="form-select"  name="isParent">
                    <option value="0" >Choose category...</option>
                    
                <?php
                  $radCatSql = "SELECT * FROM mart_category WHERE is_parent = 0 ORDER BY c_name ASC";
                  $readCatResult = mysqli_query($db, $radCatSql);
                  $serial = 0;

                  while($row = mysqli_fetch_assoc($readCatResult)){
                    $cat_id     =   $row['ID'];
                    $c_name     =   $row['c_name'];
                ?>

                    <option value="<?php echo $cat_id; ?>"> <?php echo $c_name; ?></option>
                <?php
                  }
                ?>
                  </select>
                </div>
                <div class="col-md-12 codepen-img">
				          <small> Choose your catagory image </small>
                <div class="box">
                    <div class="js--image-preview"></div>
                        <div class="upload-options">
                        <label>
                            <input type="file" class="image-upload" accept="image/*" name="catImage"/>
                        </label>
                        
                        </div>
                    </div>
                </div>
                <div class="text-start">
                  <button type="submit" class="btn btn-primary" name="catSubmit">Submit</button>
                </div>
              </form><!-- End No Labels Form -->
                  <?php
                }
              ?>

             

            </div>
          </div>
      </div>

    <div class="col-lg-7">
        <!-- Veiw all user -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">View All Categories</h5>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  $radCatSql = "SELECT * FROM mart_category WHERE is_parent = 0 ";
                  $readCatResult = mysqli_query($db, $radCatSql);
                  $serial = 0;

                  while($row = mysqli_fetch_assoc($readCatResult)){
                    $cat_id     =   $row['ID'];
                    $c_name     =   $row['c_name'];
                    $c_image    =   $row['c_image'];
                    $is_parent  =   $row['is_parent'];
                    $c_status   =   $row['c_status'];
                    $serial++;
                ?>
                    <tr>
                    <th scope="row"><?php echo $serial; ?></th>
                    <td>
                      <img src="assets/img/product/category/<?php echo $c_image; ?>" width="60" alt="">
                    </td>
                    <td><?php echo $c_name; ?></td>
                    <td><?php if($c_status == 0) echo '<span class="badge bg-danger"> In-active <span>'; else echo "<span class='badge bg-success'> Active <span>" ?> </td>
                    <td>
                      <a href="category.php?editID=<?php echo $cat_id ; ?>"><i class="bi bi-pen-fill text-black"></i></a>
                      <a href="#" data-bs-toggle="modal" data-bs-target="#deleteId<?php echo $cat_id; ?>" ><i class="bi bi-trash3-fill text-danger"></i></a>
                       <!-- Modal -->
                       <div class="modal fade" id="deleteId<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Category</h1>
                              </div>
                              <div class="modal-body">
                                Are You Sure! Delete <span class="text-danger fw-bold "><?php echo $c_name; ?> </span> category.
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a type="button" class="btn btn-primary" href="category.php?catDelete=<?php echo $cat_id; ?>"> Confirm </a>
                              </div>
                            </div>
                          </div>
                        </div>  
                    </td>
                    </tr>
                <?php
                  //find sub category
                  $readSubSql = "SELECT * FROM mart_category WHERE is_parent = '$cat_id' ";
                  $readSubResult = mysqli_query($db, $readSubSql);
                  $serial = 0;

                  while($row = mysqli_fetch_assoc($readSubResult)){
                    $cat_id     =   $row['ID'];
                    $c_name     =   $row['c_name'];
                    $c_image    =   $row['c_image'];
                    $c_status   =   $row['c_status'];
                    $serial++;
                    ?>
                    <tr>
                    <th scope="row"><?php echo "<span class='fw-normal'>$serial </span>" ; ?></th>
                    <td>
                      <img src="assets/img/product/category/<?php echo $c_image; ?>" width="60" alt="">
                    </td>
                    <td><?php echo '<i class="bi bi-arrow-90deg-up"></i>'.$c_name; ?></td>
                    <td><?php if($c_status == 0) echo '<span class="badge bg-danger"> In-active <span>'; else echo "<span class='badge bg-success'> Active <span>" ?> </td>
                    <td>
                      <a href="category.php?editID=<?php echo $cat_id ; ?>"><i class="bi bi-pen-fill text-black"></i></a>
                      <a href="" data-bs-toggle="modal" data-bs-target="#deleteId<?php echo $cat_id; ?>" ><i class="bi bi-trash3-fill text-danger"></i></a>
                      <!-- Modal -->
                      <div class="modal fade" id="deleteId<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                Are You Sure! Delete <span class="text-danger fw-bold "><?php echo $c_name; ?> </span> category.
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a class="btn btn-primary"  href="category.php?catDelete=<?php echo $cat_id; ?>"> Confirm </a>
                              </div>
                            </div>
                          </div>
                        </div>  
                    </td>
                    </tr>
                  <?php
                  }
                }
                ?>  
                </tbody>
                </table>
                <!-- End Table with stripped rows -->

                <!--  Delete category php code -->
                <?php
                  if(isset($_GET['catDelete'])){
                    $delID  = $_GET['catDelete'];
                    
                    deleteFile('c_image','mart_category','ID',$delID,'assets/img/product/category/');
                    deleteDbVal('mart_category','ID',$delID,'category.php');

                  }
                ?>

            </div>
        </div>
    </div>
  </div>
    </section>

  </main><!-- End #main -->

 <?php include 'inc/footer.php'?>