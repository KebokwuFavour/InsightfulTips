<?php
session_start();
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
  <link rel="stylesheet" href="Assets/icons/fontawesome-6.1.2/css/all.css" />
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
  <!-- navigation -->
  <header class="navigation fixed-top mb-1">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-white ms-md-4 me-md-4">
        <a class="navbar-brand order-1" href="index.php">
          <!-- <img class="img-fluid" width="100px" src="Assets/images/myLogo.jpg" alt="BeInformed | Favour's Blog" /> -->
          <h3 class="text-default">InsightfulTips(I.T)</h3>
        </a>
        <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link" href="#!" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories <i class="ti-angle-down ml-1"></i>
              </a>
              <div class="dropdown-menu">
                <?php
                $select_from_db = "SELECT DISTINCT post_category FROM displaying_insights";
                $query_db = mysqli_query($connect_db, $select_from_db);
                while ($cat_row = mysqli_fetch_assoc($query_db)) {
                  $category = $cat_row["post_category"];
                ?>
                  <a class="dropdown-item" href="cart.php?category=<?php echo $category ?>"><?php echo $category ?></a>
                <?php
                }
                ?>
              </div>
            </li>

            <li class="nav-item">
              <a href="author.php" class="nav-link">Author</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="shop.php">Shop</a>
            </li>
          </ul>
        </div>

        <div class="order-2 order-lg-3 d-flex align-items-center">
          <!-- <select class="m-2 border-0 bg-transparent" id="select-language">
            <option id="en" value="" selected>En</option>
            <option id="fr" value="">Fr</option>
          </select> -->

          <!-- search -->
          <?php
          if (isset($_POST["search"])) {
            $_SESSION["search"] = test_input($_POST['search']);
            header("location: result.php");
          }
          ?>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="search-bar me-4 me-md-0">
            <input id="" name="search" type="search" placeholder="Type &amp; Hit Enter..." required />
          </form>
          <!-- /search -->

          <button class="navbar-toggler border-0 order-1" type="button" data-bs-toggle="collapse" data-bs-target="#navigation">
            <i class="ti-menu"></i>
          </button>
        </div>
      </nav>
    </div>
  </header>
  <!-- /navigation -->