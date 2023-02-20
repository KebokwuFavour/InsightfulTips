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
  $post_cartErr = $post_tagErr = $post_titleErr = $post_imgErr = $author_nameErr = $author_imgErr = $post_detailsErr = "";
  $post_cart = $post_tag = $post_title = $post_img = $author_name = $author_img = $post_details = "";
  if (isset($_POST["update"])) {
      $post_id = $_GET["postNum"];
      $post_cart = test_input($_POST["post_cart"]);
      $post_tag = test_input($_POST["post_tag"]);
      $post_title = test_input($_POST["post_title"]);
      $author_name = test_input($_POST["author_name"]);
      $post_details = test_input($_POST["post_details"]);
        $update_db = "UPDATE displaying_insights SET post_category = '$post_cart', tags = '$post_tag', post_title = '$post_title', post_details = '$post_details', author = '$author_name' WHERE id = '$post_id'";
        $query_db = mysqli_query($connect_db, $update_db);
        if ($query_db) {
          header("location: update.php?postNum=". $post_id);
        }
      // }
      else {
        $post_imgErr = "An Image Must Be Uploaded";
        $author_imgErr = "An Image Must Be Uploaded";
      }
  }
  ?>

  <!-- modal for Post Update -->
  <div class="modal modal-lg fade" id="exampleModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Updating ID => <?php echo $_GET["postNum"] ?></h1>
          <a href="update.php?postNum=<?php echo $_GET["postNum"] ?>">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </a>
        </div>
        <div class="modal-body">
          <form action="" method="post" class="row g-3 needs-validation" id="update_form" novalidate enctype="multipart/form-data">
            <?php
            $postNum = $_GET["postNum"];
            $postNumDetails = "SELECT * FROM displaying_insights WHERE id = '$postNum'";
            $postNumDetails_query = mysqli_query($connect_db, $postNumDetails);
            $checkRow = mysqli_fetch_array($postNumDetails_query);
            ?>
                  <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Post Category:</label>
                    <input type="text" class="form-control" id="validationCustom01" name="post_cart" value="<?php echo $checkRow['post_category'] ?>" required>
                    <div class="invalid-feedback">
                      This Field Must Not Be Empty
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Post Tag:</label>
                    <input type="text" class="form-control" id="validationCustom02" name="post_tag" value="<?php echo $checkRow['tags'] ?>" required>
                    <div class="invalid-feedback">
                      This Field Must Not Be Empty
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="validationCustom03" class="form-label">Post Title:</label>
                    <input type="text" class="form-control" id="validationCustom03" name="post_title" value="<?php echo $checkRow['post_title'] ?>" required>
                    <div class="invalid-feedback">
                      This Field Must Not Be Empty
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="validationCustom05" class="form-label">Author Name:</label>
                    <input type="text" class="form-control" id="validationCustom05" name="author_name" value="<?php echo $checkRow['author'] ?>" required>
                    <div class="invalid-feedback">
                      This Field Must Not Be Empty
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="validationCustom05" class="form-label">Date:</label>
                    <input type="datetime-local" class="form-control" id="validationCustom05" name="" value="<?php echo $checkRow['date'] ?>" required>
                    <div class="invalid-feedback">
                      This Field Must Not Be Empty
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="validationCustom07" class="form-label">Post Details:</label>
                    <textarea name="post_details" id="validationCustom07" cols="30" rows="10" class="form-control" required><?php echo $checkRow['post_details'] ?></textarea>
                    <div class="invalid-feedback">
                      This Field Must Not Be Empty
                    </div>
                  </div>
                  <div class="col-12">
                    <a href="?id=<?php echo $checkRow['id'] ?>">
                      <input type="submit" value="Update" name="update" class="btn btn-primary">
                    </a>
                    <a href="update.php"><input type="button" value="Cancel" name="cancel" class="btn btn-primary"></a>
                  </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /modal for Post Update -->

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