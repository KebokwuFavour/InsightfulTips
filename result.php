<!-- header -->
<?php
include_once("include/header.php")
?>
<!-- /header -->

<?php
$get_search = $_SESSION['search'];
?>

<section class="section ms-md-4 me-md-4">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-12 mb-4">
        <h1 class="h2 mb-4">
          Search results for
          <mark><?php echo $get_search ?></mark>
        </h1>
      </div>
      <div class="col-lg-12">
        <?php
        $search = $get_search;
        if (isset($_GET["Page"])) {
          $Page = $_GET["Page"];
          if ($Page == 0 || $Page < 1) {
            $ShowPostFrom = 0;
          } else {

            $ShowPostFrom = ($Page * 4) - 4;
          }
          $search_db = "SELECT * FROM displaying_insights WHERE post_category like '%$search%' or tags like '%$search%' or post_title like '%$search%' or date like '%$search%' ORDER BY id DESC LIMIT $ShowPostFrom,4";
        } elseif (!isset($_GET["Page"])) {
          $Page = 0;
          if ($Page == 0 || $Page < 1) {
            $ShowPostFrom = 0;
          } else {

            $ShowPostFrom = ($Page * 4) - 4;
          }
          $search_db = "SELECT * FROM displaying_insights WHERE post_category like '%$search%' or tags like '%$search%' or post_title like '%$search%' or date like '%$search%' ORDER BY id DESC LIMIT $ShowPostFrom,4";
        }  elseif (!isset($get_search)) {
         // $search_db = "SELECT * FROM displaying_insights WHERE post_category like '%$search%' or tags like '%$search%' or post_title like '%$search%' or date like '%$search%' ORDER BY id DESC LIMIT $ShowPostFrom,4";
         header("location: no-result.php");
       } else {

          $search_db = "SELECT * FROM displaying_insights WHERE post_category like '%$search%' or tags like '%$search%' or post_title like '%$search%' or date like '%$search%' ORDER BY id DESC LIMIT 0,4";
        }
        $query_db = mysqli_query($connect_db, $search_db);

        if (mysqli_num_rows($query_db) > 0) {
          while ($search_result = mysqli_fetch_array($query_db)) {
          ?>
            <article class="card mb-4">
              <div class="row card-body">
                <div class="col-md-4 mb-4 mb-md-0">
                  <div class="post-slider slider-sm">
                    <img src="Dashboard/admin/uploads/<?php echo $search_result['post_image'] ?>" class="card-img" alt=" " style="height: 200px; object-fit: cover" />
                    <!-- <img src="Assets/images/post/post-1.jpg" class="card-img" alt="post-thumb" style="height: 200px; object-fit: cover" /> -->
                  </div>
                </div>
                <div class="col-md-8">
                  <h3 class="h4 mb-3">
                    <a class="post-title" href="details.php?postNum=<?php echo $search_result["id"] ?>"><?php echo $search_result['post_title'] ?></a>
                  </h3>
                  <ul class="card-meta list-inline">
                    <li class="list-inline-item">
                      <a href="author.php" class="card-meta-author">
                        <img src="Dashboard/admin/uploads/author/<?php echo $search_result['author_image'] ?>" alt=" " />
                        <span><?php echo $search_result['author'] ?></span>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <i class="ti-calendar"></i><?php echo $search_result['date'] ?>
                    </li>
                    <li class="list-inline-item">
                      <ul class="card-meta-tag list-inline">
                        <?php
                        if (!empty($search_result['tags'])) {
                          echo "<li class='list-inline-item'>
                          <a href='cart.php?tag=" . $search_result['tags'] . "'>" . $search_result['tags'] . "</a>
                        </li>";
                        }
                        ?>
                        <li class="list-inline-item">
                          <a href="cart.php?category=<?php echo $search_result['post_category'] ?>"><?php echo $search_result['post_category'] ?></a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <p>
                    <?php
                    $post = substr($search_result['post_details'], 0, strrpos(substr($search_result['post_details'], 0, 250), ' ')) . "...";
                    echo $post;
                    ?>
                  </p>
                  <a href="details.php?postNum=<?php echo $search_result['id'] ?>" class="btn btn-outline-primary">Read More</a>
                </div>
              </div>
            </article>
          <?php
          }
          ?>
        <?php
        } else {
          header("location: no-result.php");
        }
        // }
        ?>

        <!-- pagination -->
        <ul class="pagination justify-content-center">
          <?php
          if (isset($Page)) {
            if ($Page > 1) {
          ?>
              <li class="page-item">
                <a href="?Page=<?php echo $Page - 1; ?>" class="page-link">&laquo;</a>
              </li>
              <?php
            }
          }

          $search_db_a = "SELECT COUNT(*) FROM displaying_insights WHERE post_category like '%$search%' or tags like '%$search%' or post_title like '%$search%' or date like '%$search%'";
          $query_db_a = mysqli_query($connect_db, $search_db_a);
          $row_page = mysqli_fetch_array($query_db_a);
          $total_rows = array_shift($row_page);
          $limit = 4;
          $total_pages = ceil($total_rows / $limit);

          for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
            if (isset($Page)) {
              if ($page_number == $Page) {

              ?>
                <li class="page-item page-item active">
                  <a class="page-link" href="?Page=<?php echo $page_number; ?>"><?php echo $page_number; ?></a>
                </li>
              <?php
              } else {
              ?>
                <li class="page-item">
                  <a class="page-link" href="?Page=<?php echo $page_number; ?>"><?php echo $page_number; ?></a>
                </li>
              <?php
              }
            }
          }
          if (isset($Page)) {
            if ($Page + 1 <= $total_pages) {
              ?>
              <li class="page-item">
                <a class="page-link" href="?Page=<?php echo $Page + 1 ?>">&raquo; </a>
              </li>
          <?php
            }
          }
          ?>
        </ul>
        <!-- /pagination -->
      </div>
    </div>
  </div>
</section>

<!-- footer -->
<?php include_once("include/footer.php"); ?>
<!-- /footer -->