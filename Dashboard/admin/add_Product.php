<?php
  include_once("Include/header.php");
  include_once("Include/navbar.php");
?>

  <main id="main" class="main">
    <div class="card mx-auto" style="width: 90%;">
      <div class="card-body">
        <h5 class="card-title text-center">Add Affiliate Product(s)</h5>

        <?php
          include("../../config/db.php");
          include("../../Config/function.php");
          // define variables and set to empty values
          $product_linkErr = $product_imgErr = $product_titleErr = $priceErr = "";
          $product_link = $product_img = $product_title = $price = "";
          if (isset($_POST["post"])) {
            if (empty($_POST["product_link"])) {
              $product_linkErr = "This Field Is Required";
            } elseif (empty($_POST["product_title"])) {
              $product_titleErr = "This Field Is Required";
            } elseif (empty($_POST["price"])) {
              $priceErr = "This Field Is Required";
            } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["product_title"])) {
              $product_titleErr = "Only letters and white space allowed";
            } else {
              $product_link = test_input($_POST["product_link"]);
              $product_title = test_input($_POST["product_title"]);
              $price = test_input($_POST["price"]);
              $product_img = $_FILES["product_img"]["name"];
              $target_dir = "uploads/affiliates/";
              $target_file = $target_dir . basename($_FILES['product_img']['name']);
              if ($_FILES['product_img']['size'] > 0) {
                move_uploaded_file($_FILES['product_img']['tmp_name'], $target_file);
                $inserting_into_db = "INSERT INTO affiliate_marketing (product_link, product_image, product_title, price) VALUES ('$product_link', '$product_img', '$product_title', '$price')";
                $querying_db = mysqli_query($connect_db, $inserting_into_db);
                if ($querying_db) {
                  echo "<script> alert('Product Added successfully'); </script>";
                }
              } else {
                $product_imgErr = "An Image Must Be Uploaded";
              }
            }
          }
        ?>

        <!-- Custom Styled Validation -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
          <div class="col-md-12">
            <label for="validationCustom01" class="form-label">Product Link:</label>
            <span class="text-danger"><?php echo $product_linkErr; ?></span>
            <input type="text" class="form-control" id="validationCustom01" name="product_link" value="<?php echo $product_link; ?>" required>
            <div class="invalid-feedback">
              This Field Must Not Be Empty
            </div>
          </div>
          <div class="col-md-12">
            <label for="validationCustom04" class="form-label">Product Image:</label>
            <span class="text-danger"><?php echo $product_imgErr; ?></span>
            <input type="file" id="validationCustom04" class="form-control" name="product_img" value="<?php echo $product_img; ?>" required>
            <div class="invalid-feedback">
              This Field Must Not Be Empty
            </div>
          </div>
          <div class="col-md-12">
            <label for="validationCustom03" class="form-label">Product Title:</label>
            <span class="text-danger"><?php echo $product_titleErr; ?></span>
            <input type="text" class="form-control" id="validationCustom03" name="product_title" value="<?php echo $product_title; ?>" required>
            <div class="invalid-feedback">
              This Field Must Not Be Empty
            </div>
          </div>
          <div class="col-md-12">
            <label for="validationCustom05" class="form-label">Price:</label>
            <span class="text-danger"><?php echo $priceErr; ?></span>
            <input type="text" class="form-control" id="validationCustom05" name="price" value="<?php echo $price; ?>" required>
            <div class="invalid-feedback">
              This Field Must Not Be Empty
            </div>
          </div>
          
          <div class="col-12">
            <input type="submit" value="POST" name="post" class="btn btn-primary">
            <a href="add_product.php"><input type="button" value="Cancel" name="cancel" class="btn btn-primary"></a>
          </div>
        </form>
        <!-- End Custom Styled Validation -->
      </div>
    </div>
  </main>
  <!-- End #main -->

<!-- ======= Footer ======= -->
<?php
  include_once("Include/footer.php");
  include_once("Include/scripts.php");
?>