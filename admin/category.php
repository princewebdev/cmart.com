<?php include "inc/header.php" ?>
<?php include "inc/menubar.php" ?>

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
              <form class="row g-3">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Category Name">
                </div>
                <div class="col-md-12">
                  <select id="inputState" class="form-select">
                    <option selected="">Choose...</option>
                    <option> Electronic</option>
                    <option> Cloths</option>
                    <option> Sports</option>
                  </select>
                </div>
                <div class="col-md-12">
                <div class="box">
                    <div class="js--image-preview"></div>
                        <div class="upload-options">
                        <label>
                            <input type="file" class="image-upload" accept="image/*" />
                        </label>
                        </div>
                    </div>
                </div>
                <div class="text-start">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
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
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Age</th>
                    <th scope="col">Start Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                    <td>45</td>
                    <td>2011-08-12</td>
                    </tr>
                    <tr>
                    <th scope="row">4</th>
                    <td>Angus Grady</td>
                    <td>HR</td>
                    <td>34</td>
                    <td>2012-06-11</td>
                    </tr>
                    <tr>
                    <th scope="row">5</th>
                    <td>Raheem Lehner</td>
                    <td>Dynamic Division Officer</td>
                    <td>47</td>
                    <td>2011-04-19</td>
                    </tr>
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