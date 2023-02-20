<?php
require("Config/db.php");
require("Config/function.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BeInformed | Favour's Blog"</title>

  <!-- Assets -->
  <link rel="stylesheet" href="Assets/css/bootstrap-5.2.0 css/bootstrap.min.css" />
  <link rel="stylesheet" href="Assets/icons/themify-icons.css" />
  <link rel="stylesheet" href="Assets/css/slick.css" />

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="Assets/css/style.css" media="screen" />

  <!--Favicon-->
  <link rel="shortcut icon" href="Assets/images/favicon.jpg" type="image/x-icon" />
  <link rel="icon" href="Assets/images/favicon.jpg" type="image/x-icon" />

  <meta property="og:title" content="BeInformed | Favour's Blog" />
  <meta property="og:description" content="This is meta description" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="" />
  <meta property="og:updated_time" content="2022-19-11T15:40:24+06:00" />


</head>

<body>

  <?php
  // define variables and set to empty values
  $R_nameErr = $R_emailErr = $R_msgErr = "";
  $R_name = $R_email = $R_msg = "";
  if (isset($_POST["reply"])) {
    $cmt_num = $_GET["cmt_id"];
    $cmt_num_id = "SELECT * FROM blog_comments WHERE id = '$cmt_num'";
    $cmt_num_query = mysqli_query($connect_db, $cmt_num_id);
    $checkRow = mysqli_fetch_array($cmt_num_query);
    $comment_id = $checkRow['id'];

    if (empty($_POST['R_name']) || empty($_POST["R_email"]) || empty($_POST['R_msg'])) {
      $R_nameErr = 'name is required';
      $R_emailErr = 'Email is required';
      $R_msgErr = 'Specify your message';
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["R_name"]) || !filter_var($_POST["R_email"], FILTER_VALIDATE_EMAIL)) {
      $R_nameErr = "Only letters and white space allowed";
      $R_emailErr = "Invalid email format";
    } else {
      $R_name = test_input($_POST['R_name']);
      // $email = test_input($_POST["email"]);
      $R_email = test_input(filter_var($_POST['R_email'], FILTER_VALIDATE_EMAIL));
      $R_msg = test_input($_POST['R_msg']);
      $insert_into_db = "INSERT INTO comments_reply (names, emails, messages, comment_id) VALUES ('$R_name', '$R_email', '$R_msg', '$comment_id')";
      $query_db = mysqli_query($connect_db, $insert_into_db);
      if ($query_db) {
        if (!empty($_POST["R_name"]) and !empty($_POST["R_email"]) and !empty($_POST["R_msg"])) {
          $postNum = $_GET['postNum'];
          $cmt_id = $_GET['cmt_id'];
          header("location: details.php?postNum=$postNum&cmt_id=$cmt_id");
        }
      }
    }
  }
  ?>

  <!-- modal for Reply -->
  <div class="modal fade" id="exampleModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Replying to <?php echo $_GET["name"] ?></h1>
          <a href="details.php?postNum=<?php echo $_GET["postNum"] ?>">
            <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </a>
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="mb-2 col-md-6">
                <label for="R_name" class="col-form-label">Name:</label>
                <span style="color: crimson;">* <?php echo $R_nameErr ?></span>
                <input type="text" name="R_name" id="" class="form-control" value="<?php echo $R_name ?>">
              </div>
              <div class="mb-2 col-md-6">
                <label for="R_email" class="col-form-label">Email:</label>
                <span style="color: crimson;">* <?php echo $R_emailErr ?></span>
                <input type="email" name="R_email" id="" class="form-control">
              </div>
            </div>
            <div class="mb-2">
              <label for="R_msg" class="col-form-label">Message:</label>
              <span style="color: crimson;">* <?php echo $R_msgErr ?></span>
              <textarea class="form-control" id="message-text" name="R_msg" style="resize: none; height: 90px;"></textarea>
            </div>
            <input type="submit" value="Reply" id="reply" class="btn-primary" name="reply" style="width: 90px;">
          </form>
        </div>
        <div class="modal-footer">
          <form action="details.php?postNum=<?php echo $_GET["postNum"] ?>" method="get">
            <a href="details.php?postNum=<?php echo $_GET["postNum"] ?>">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </a>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /modal for Reply -->

  <!-- JS script files and dependencies -->
  <script src="Assets/js/jquery-3.6.0.js"></script>

  <script src="Assets/js/boostrap-5.2.0 js/bootstrap.bundle.js"></script>

  <script>
    $(window).on('load', function() {
      $("#exampleModal").modal('show');
    });
  </script>
</body>

</html>