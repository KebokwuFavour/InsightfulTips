
<?php
  include_once("Include/header.php");
  include_once("Include/navbar.php");
  
  include("../../config/db.php");
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          
          <!-- Add New Post(s) Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Add New Post(s)</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark-plus-fill"></i>
                  </div>
                  <div class="ps-3">
                    <a href="add.php">
                      <h6>Add New Post(s)</h6>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Add New Post(s) card -->

          <!-- Edit Existing Post(s) Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Edit Existing Post(s)</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-eraser-fill"></i>
                  </div>
                  <div class="ps-3">
                    <a href="update.php">
                      <h6>Update Existing Post(s)</h6>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Edit Existing Post(s) Card -->

          <!-- Delete Existing Post(s) Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Delete Existing Post(s)</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-minus-fill"></i>
                  </div>
                  <div class="ps-3">
                    <a href="delete.php">
                      <h6>Delete Existing Post(s)</h6>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Delete Existing Post(s) Card -->

          <!-- View all Post(s) Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">View all Post(s)</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-binoculars-fill"></i>
                  </div>
                  <div class="ps-3">
                    <a href="show.php">
                      <h6>View all Post(s)</h6>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End view all Post(s) Card -->

          <!-- Subscribers -->
          <div class="col-12 col-md-8 mx-auto">
            <div class="card top-selling overflow-auto">
              <div class="card-body pb-0">
                <h5 class="card-title">
                  Subscribers
                  <!-- Recently added <span>| Today</span> -->
                </h5>

                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Emails</th>
                      <th scope="col">Date subscribed</th>
                    </tr>
                  </thead>

                  <?php
                  $select_from_db = "SELECT * FROM subscribers ORDER BY id ASC";
                  $query_db = mysqli_query($connect_db, $select_from_db);
                  if (mysqli_num_rows($query_db) > 0) {
                  ?>

                    <tbody>

                      <?php
                      while ($subscribersRow = mysqli_fetch_array($query_db)) {
                      ?>

                        <tr>
                          <td>
                            <a href="#" class="text-primary fw-bold"><?php echo $subscribersRow['emails'] ?></a>
                          </td>
                          <td>
                            <?php echo $subscribersRow['date'] ?>
                          </td>
                        </tr>

                      <?php
                      }
                      ?>

                    </tbody>

                  <?php
                  }
                  ?>

                </table>
              </div>
            </div>
          </div>
          <!-- End Subscribers -->
            
          <!-- Affiliate Marketing -->
          <div class="col-12">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">
                    Affiliate Marketing <span>| Digital Products</span>
                    <!-- Recently added <span>| Today</span> -->
                  </h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Product_links</th>
                        <th scope="col">product_image</th>
                        <th scope="col">Product_title</th>
                        <th scope="col">Price</th>
                      </tr>
                    </thead>

                    <?php
                  //   include("db.php");
                    $select_from_db2 = "SELECT * FROM affiliate_marketing ORDER BY id ASC";
                    $query_db2 = mysqli_query($connect_db, $select_from_db2);
                    if (mysqli_num_rows($query_db2) > 0) {
                    ?>

                      <tbody>

                        <?php
                        while ($affiliateRows = mysqli_fetch_array($query_db2)) {
                        ?>

                          <tr>
                            <td>
                              <?php echo $affiliateRows['id'] ?>
                            </td>
                            <td>
                              <a href="#">
                                <?php echo $affiliateRows['product_link'] ?>
                              </a>
                            </td>
                            <td>
                              <a href="#"><img src="uploads/affiliates<?php echo $affiliateRows['product_image'] ?>" alt="" /></a>
                            </td>
                            <td>
                              <a href="#" class="text-primary fw-bold"><?php echo $affiliateRows['product_title'] ?></a>
                            </td>
                            <td><?php echo $affiliateRows['price'] ?></td>
                          </tr>

                        <?php
                        }
                        ?>

                      </tbody>

                    <?php
                    }
                    ?>

                  </table>
                </div>
              </div>
          </div>
          <!-- End Affiliate Marketing -->

          <!-- Contacts / Messages -->
          <div class="col-12">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">
                  Contacts <span>/ Messages</span>
                  </h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Message</th>
                        <th scope="col">Date - Time</th>
                      </tr>
                    </thead>

                    <?php
                    $select_from_db3 = "SELECT * FROM contact ORDER BY id DESC LIMIT 10";
                    $query_db3 = mysqli_query($connect_db, $select_from_db3);
                    if (mysqli_num_rows($query_db3) > 0) {
                    ?>

                      <tbody>

                        <?php
                        while ($contactRows = mysqli_fetch_array($query_db3)) {
                        ?>

                          <tr>
                            <td scope="row">
                              <?php echo $contactRows['sender_name'] ?>
                            </td>
                            <td class="text-primary fw-bolder">
                              <?php echo $contactRows['sender_email'] ?>
                            </td>
                            <td>
                              <?php echo $contactRows['sender_phone'] ?>
                            </td>
                            <td class="fw-bold">
                              <?php echo $contactRows['reason_for_contacting'] ?>
                            </td>
                            <td>
                              <?php echo $contactRows['sender_message'] ?>
                            </td>
                            <td>
                              <?php echo $contactRows['time'] ?>
                            </td>
                          </tr>

                        <?php
                        }
                        ?>

                      </tbody>

                    <?php
                    }
                    ?>

                  </table>
                </div>
              </div>
          </div>
          <!-- End Contacts / Messages -->

        </div>
      </div>
    </div>
  </section>
</main>
<!-- End #main -->

<!-- ======= Footer ======= -->
<?php
  include_once("Include/footer.php");
  include_once("Include/scripts.php");
?>