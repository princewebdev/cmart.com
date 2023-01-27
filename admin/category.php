<?php include "inc/header.php" ?>
<?php include "inc/menubar.php" ;

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
              <h5 class="card-title">Add New Category</h5>

              <!-- No Labels Form -->
              <form class="row g-3" action='core/insert.php' method="POST" enctype="multipart/form-data" >
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Category Name" name="catName" >
                </div>
                <div class="col-md-12">
                  <small> Choose your parent catagory If any </small>
                  <select id="inputState" class="form-select"  name="isParent">
                    <option selected="" >Choose category...</option>
                    
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
                            <input type="file" class="image-upload" accept="image/*" name="catImg"/>
                        </label>
                        </div>
                    </div>
                </div>
                <div class="text-start">
                  <button type="submit" class="btn btn-primary" name="catSubmit">Submit</button>
                </div>
              </form><!-- End No Labels Form -->

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
                    $cat_id         =   $row['ID'];
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
                      <a href="#"><i class="bi bi-pen-fill text-black"></i></a>
                      <a href="#"><i class="bi bi-trash3-fill text-danger"></i></a>
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
                      <a href="#"><i class="bi bi-pen-fill text-black"></i></a>
                      <a href="#"><i class="bi bi-trash3-fill text-danger"></i></a>
                    </td>
                    </tr>
                  <?php
                  }
                }
                
                ?>   
                </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>
    </div>
  </div>
    </section>

  </main><!-- End #main -->

 <?php include 'inc/footer.php'?>