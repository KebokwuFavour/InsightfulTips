<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Admin - InsightfulTips</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
  <div class="card w-50" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)">
    <div class="card-body">
    <img src="assets/img/logo.png" alt="">
      <h5 class="card-title text-center">Admin Login</h5>
      <!-- Custom Styled Validation -->
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="row g-3 needs-validation" novalidate>
        <div class="col-md-12">
          <label for="validationCustom01" class="form-label">Name</label>
          <input type="text" class="form-control" id="validationCustom01" name="admin_name" required>
          <div class="invalid-feedback">
            Name is required
          </div>
        </div>
        <div class="col-md-12">
          <label for="validationCustom02" class="form-label">Password</label>
          <input type="password" class="form-control" id="validationCustom02" name="admin_pwd" required>
          <div class="invalid-feedback">
            Invalid input
          </div>
        </div>
        <div class="col-12">
          <input type="submit" value="Submit form" name="submit" class="btn btn-primary">
        </div>
      </form>
      <!-- End Custom Styled Validation -->
    </div>
  </div>

  <?php
  include("../../config/db.php");
  include("../../config/function.php");

  if (isset($_POST['submit'])) {
    $admin_name = test_input($_POST['admin_name']);
    $admin_pwd = test_input($_POST['admin_pwd']);
    if (isset($_POST['admin_name']) and isset($_POST['admin_pwd'])) {
      $select_from_db = "SELECT * FROM admin_panel WHERE name = '$admin_name' && password = '$admin_pwd'";
      $query_db = mysqli_query($connect_db, $select_from_db);
      if (mysqli_num_rows($query_db) > 0) {
        header("location: dashboard.php");
      } else {
      }
    }
  }
  ?>

</body>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
</body>

</html>