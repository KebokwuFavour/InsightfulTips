<?php
  include_once("Include/header.php");
  include_once("Include/navbar.php");
?>

  <main id="main" class="main">
    <div class="card mx-auto" style="width: 90%;">
      <div class="card-body">
        <h5 class="card-title text-center">Add Blog Post(s)</h5>

        <?php
          include("../../config/db.php");
          include("../../Config/function.php");
          // define variables and set to empty values
          $post_cartErr = $post_tagErr = $post_titleErr = $post_imgErr = $author_nameErr = $author_imgErr = $post_detailsErr = "";
          $post_cart = $post_tag = $post_title = $post_img = $author_name = $author_img = $post_details = "";
          if (isset($_POST["post"])) {
            if (empty($_POST["post_cart"])) {
              $post_cartErr = "This Field Is Required";
            } elseif (empty($_POST["post_tag"])) {
              $post_tagErr = "This Field Is Required";
            } elseif (empty($_POST["post_title"])) {
              $post_titleErr = "This Field Is Required";
            } elseif (empty($_POST["author_name"])) {
              $author_nameErr = "This Field Is Required";
            } elseif (empty($_POST["post_details"])) {
              $post_detailsErr = "This Field Is Required";
            } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["post_cart"])) {
              $post_cartErr = "Only letters and white space allowed";
            } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["post_tag"])) {
              $post_tagErr = "Only letters and white space allowed";
            } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["post_title"])) {
              $post_titleErr = "Only letters and white space allowed";
            } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["author_name"])) {
              $author_nameErr = "Only letters and white space allowed";
            } else {
              $post_cart = test_input($_POST["post_cart"]);
              $post_tag = test_input($_POST["post_tag"]);
              $post_title = test_input($_POST["post_title"]);
              $author_name = test_input($_POST["author_name"]);
              $post_img = $_FILES["post_img"]["name"];
              $author_img = $_FILES["author_img"]["name"];
              $post_details = test_input($_POST["post_details"]);
              $target_dir = "uploads/";
              $target_file = $target_dir . basename($_FILES['post_img']['name']);
              $target_dir2 = "uploads/author/";
              $target_file2 = $target_dir2 . basename($_FILES['author_img']['name']);
              if ($_FILES['post_img']['size'] > 0 && $_FILES['author_img']['size'] > 0) {
                move_uploaded_file($_FILES['post_img']['tmp_name'], $target_file);
                move_uploaded_file($_FILES['author_img']['tmp_name'], $target_file2);
                $inserting_into_db = "INSERT INTO displaying_insights (post_category, tags, post_title, post_image, post_details, author, author_image) VALUES ('$post_cart', '$post_tag', '$post_title', '$post_img', '$post_details', '$author_name', '$author_img')";
                $querying_db = mysqli_query($connect_db, $inserting_into_db);
                if ($querying_db) {
                  echo "<script> alert('Posted successfully'); </script>";
                }
              } else {
                $post_imgErr = "An Image Must Be Uploaded";
                $author_imgErr = "An Image Must Be Uploaded";
              }
            }
          }
        ?>

        <!-- Custom Styled Validation -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
          <div class="col-md-12">
            <label for="validationCustom01" class="form-label">Post Category:</label>
            <span class="text-danger"><?php echo $post_cartErr; ?></span>
            <input type="text" class="form-control" id="validationCustom01" name="post_cart" value="<?php echo $post_cart; ?>" required>
            <div class="invalid-feedback">
              This Field Must Not Be Empty
            </div>
          </div>
          <div class="col-md-12">
            <label for="validationCustom02" class="form-label">Tag:</label>
            <span class="text-danger"><?php echo $post_tagErr; ?></span>
            <input type="text" class="form-control" id="validationCustom02" name="post_tag" value="<?php echo $post_tag; ?>" required>
            <div class="invalid-feedback">
              This Field Must Not Be Empty
            </div>
          </div>
          <div class="col-md-12">
            <label for="validationCustom03" class="form-label">Post Title:</label>
            <span class="text-danger"><?php echo $post_titleErr; ?></span>
            <input type="text" class="form-control" id="validationCustom03" name="post_title" value="<?php echo $post_title; ?>" required>
            <div class="invalid-feedback">
              This Field Must Not Be Empty
            </div>
          </div>
          <div class="col-md-12">
            <label for="validationCustom04" class="form-label">Post Image:</label>
            <span class="text-danger"><?php echo $post_imgErr; ?></span>
            <input type="file" id="validationCustom04" class="form-control" name="post_img" value="<?php echo $post_img; ?>" required>
            <div class="invalid-feedback">
              This Field Must Not Be Empty
            </div>
          </div>
          <div class="col-md-12">
            <label for="validationCustom05" class="form-label">Author Name:</label>
            <span class="text-danger"><?php echo $author_nameErr; ?></span>
            <input type="text" class="form-control" id="validationCustom05" name="author_name" value="Favour" required>
            <div class="invalid-feedback">
              This Field Must Not Be Empty
            </div>
          </div>
          <div class="col-md-12">
            <label for="validationCustom06" class="form-label">Author Image:</label>
            <span class="text-danger"><?php echo $author_imgErr; ?></span>
            <input type="file" id="validationCustom06" class="form-control" name="author_img" value="<?php echo $author_img; ?>">
            <div class="invalid-feedback">
              This Field Must Not Be Empty
            </div>
          </div>
          <div class="col-md-12">
            <label for="validationCustom07" class="form-label">Post Details:</label>
            <span class="text-danger"><?php echo $post_detailsErr; ?></span>
            <textarea id="validationCustom07" name="post_details" cols="30" rows="4" class="form-control" required><?php echo $post_details; ?></textarea>
            <div class="invalid-feedback">
              This Field Must Not Be Empty
            </div>
          </div>
          <div class="col-12">
            <input type="submit" value="POST" name="post" class="btn btn-primary">
            <a href="add.php"><input type="button" value="Cancel" name="cancel" class="btn btn-primary"></a>
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