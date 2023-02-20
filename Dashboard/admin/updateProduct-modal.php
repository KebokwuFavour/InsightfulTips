<?php
include("../../config/db.php");
include("../../Config/function.php");
?>

  <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Admin - InsightfulTips</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet" />
</head>


</head>

<body>

  <?php
  // define variables and set to empty values
  $product_linkErr = $product_imgErr = $product_titleErr = $priceErr = "";
  $product_link = $product_img = $product_title = $price = "";
  if (isset($_POST["update"])) {
    $product_id = $_GET["productNum"];
    $product_link = test_input($_POST["product_link"]);
    $product_title = test_input($_POST["product_title"]);
    $price = test_input($_POST["price"]);
    $update_db = "UPDATE affiliate_marketing SET product_link = '$product_link', product_title = '$product_title', price = '$price' WHERE id = '$product_id'";
    $query_db = mysqli_query($connect_db, $update_db);
    if ($query_db) {
      header("location: update_product.php?productNum=". $product_id);
    } else {
      echo "<script> alert('Unable To Update Product Details'); </script>";
    }
  }
  ?>

  <!-- modal for Post Update -->
  <div class="modal modal-md fade" id="exampleModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Updating ID => <?php echo $_GET["productNum"] ?></h1>
          <a href="update_product.php?productNum=<?php echo $_GET["productNum"] ?>">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </a>
        </div>
        <div class="modal-body">
          <form action="" method="post" class="row g-3 needs-validation" id="update_form" novalidate enctype="multipart/form-data">
            <?php
            $productNum = $_GET["productNum"];
            $productNumDetails = "SELECT * FROM affiliate_marketing WHERE id = '$productNum'";
            $productNumDetails_query = mysqli_query($connect_db, $productNumDetails);
            $checkRow = mysqli_fetch_array($productNumDetails_query);
            ?>
            <div class="col-md-12">
              <label for="validationCustom01" class="form-label">Product Link:</label>
              <input type="text" class="form-control" id="validationCustom01" name="product_link" value="<?php echo $checkRow['product_link'] ?>" required>
              <div class="invalid-feedback">
                This Field Must Not Be Empty
              </div>
            </div>
            <div class="col-md-12">
              <label for="validationCustom03" class="form-label">Product Title:</label>
              <input type="text" class="form-control" id="validationCustom03" name="product_title" value="<?php echo $checkRow['product_title'] ?>" required>
              <div class="invalid-feedback">
                This Field Must Not Be Empty
              </div>
            </div>
            <div class="col-md-12">
              <label for="validationCustom05" class="form-label">Price:</label>
              <input type="text" class="form-control" id="validationCustom05" name="price" value="<?php echo $checkRow['price'] ?>" required>
              <div class="invalid-feedback">
                This Field Must Not Be Empty
              </div>
            </div>
            <div class="col-12">
              <a href="?id=<?php echo $checkRow['id'] ?>">
                <input type="submit" value="Update" name="update" class="btn btn-primary">
              </a>
              <a href="update_product.php"><input type="button" value="Cancel" name="cancel" class="btn btn-primary"></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /modal for Product Update -->

  <!-- JS script files and dependencies -->
  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery-3.6.0.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    $(window).on('load', function() {
      $("#exampleModal").modal('show');
    });
  </script>
</body>

</html>