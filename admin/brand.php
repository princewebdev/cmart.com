<?php 
include "inc/header.php";
include "inc/menubar.php";
include "core/insert.php";
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li cl1ass="breadcrumb-item active">Brand</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-5">
          <!-- add form for brand -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Brand</h5>
              <form action="core/insert.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3 form-control">
                  <label for="bName" class="form-label">Please enter a brand name</label>
                  <input type="text" class="form-control" name="bName" id="bName" required>
                </div>
                <div class="form-control mb-3">
                  <h6 class="m-0"> Select your category </h6>
                  <?php
                     $radCatSql = "SELECT * FROM mart_category WHERE is_parent = '0' ";
                     $readCatResult = mysqli_query($db, $radCatSql);
   
                     while($row = mysqli_fetch_assoc($readCatResult)){
                       $cat_id     =   $row['ID'];
                       $c_name     =   $row['c_name'];
                  ?>
                  
                  <div class="" id="showSubCat">

                  <!-- show sub category with ajax -->
                  </div>
                  <input type="checkbox" value="<?php echo $cat_id ?>" class="catSelect" onchange="showSubCat(this.value)">
                  <label > <?php echo $c_name;?></label>
                  <?php 
                     }
                  ?>
                </div>
                <div class="codepen-img">
				          <small> Choose your Brand logo </small>
                <div class="box">
                    <div class="js--image-preview"></div>
                        <div class="upload-options">
                        <label>
                            <input type="file" class="image-upload" accept="image/*" name="bLogo"/>
                        </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 form-control">
                  <input type="submit" value="Add a new Brnad" name="addBrand" class="form-control bg-warning">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <!-- view all brand  -->
          <div class="card">
  <div class="card-body">
    <h5 class="card-title">Table with hoverable rows</h5>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">SL</th>
          <th scope="col">Brand Name</th>
          <th scope="col">Brand Logo</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $brandRead = "SELECT * FROM mart_brand ";
          $brandRes = mysqli_query($db,$brandRead);
          $sl = 0;

          while($row = mysqli_fetch_assoc($brandRes)){
            $bId  = $row['ID'];
            $bName  = $row['b_name'];
            $bLogo  = $row['b_logo'];
            $bStatus  = $row['b_status'];
            $sl++;
        ?>
        <tr>
          <th scope="row"><?php echo $sl; ?> </th>
          <td><?php echo $bName; ?></td>
          <td>
           <?php
            if(!empty($bLogo)){
              ?>
              <img width="80" src="assets/img/product/brand/<?php echo $bLogo; ?>" alt="">
              <?php
            }else{
              ?>
              <h2 class="bg-warning text-light rounded w-25 text-center fw-bold"> <?php echo substr($bName,0,1); ?> </h2>
              <?php
            }
            ?>
          </td>
          <td><?php 
          if($bStatus == 0) echo '<span class="badge bg-danger"> Inactive </span>';
          if($bStatus == 1) echo '<span class="badge bg-success"> Active </span>';
          ?></td>
          <td>
            <a href="#" data-bs-toggle="modal" data-bs-target="#brandDel<?php echo $bId;?>" ><i class="bi bi-trash3-fill text-danger" aria-hidden="true"></i></a>
            <a href=""><i class="bi bi-pen-fill text-black" aria-hidden="true"></i></a>
          </td>
        </tr>
           <!--  Modal code is start -->
        <!-- Modal -->
        <div class="modal fade" id="brandDel<?php echo $bId;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Brand </h1>
              </div>
              <div class="modal-body">
                Are You Sure! Delete <span class="text-danger fw-bold "><?php echo $bName; ?> </span> brand.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a type="button" class="btn btn-primary" href="brand.php?deleteId=<?php echo $bId; ?>">Confirm</a>
              </div>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </tbody>
    </table>
     
    <!-- Delete Brand -->
    <?php 
     if(isset($_GET['deleteId'])){
      $deleteId  = $_GET['deleteId'];

      
      $table = 'mart_brand' ;
      $dbId = 'ID';
      $delId = $deleteId ;
      $redirect = 'brand.php' ;
      deleteFile('b_logo',$table,$dbId,$deleteId,'assets/img/product/brand/');
      deleteDbVal($table,$dbId,$delId,$redirect);

     }
    ?>
    
  </div>
</div>
          
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script>
    // brand ajax function
function showSubCat(str) {
  if (str == "") {
    document.getElementById("showSubCat").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("showSubCat").innerHTML += this.responseText;
      }
    };
    xmlhttp.open("GET","assets/ajax/getCategory.php?q="+str,true);
    xmlhttp.send();
  }
}
  </script>

 <?php include 'inc/footer.php'?>