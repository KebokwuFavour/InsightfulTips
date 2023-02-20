<!-- header -->
<?php include_once("include/header.php"); ?>
<!-- /header -->

<section class="section ms-md-4 me-md-4">
  <div class="py-3"></div>
  <div class="container-fluid">
    <div class="row">

      <?php
      if (isset($_GET["category"])) {
      ?>

        <h1 class="h2 mb-4">Showing items of <mark><?php echo $_GET["category"] ?></mark></h1>

        <?php
        $cart = $_GET["category"];
        if (isset($_GET["Page"])) {
          $Page = $_GET["Page"];
          if ($Page == 0 || $Page < 1) {
            $ShowPostFrom = 0;
          } else {

            $ShowPostFrom = ($Page * 4) - 4;
          }

          $select_cart = "SELECT * FROM displaying_insights WHERE post_category = '$cart' ORDER BY id DESC LIMIT $ShowPostFrom,4";
        } elseif (!isset($_GET["Page"])) {
          $Page = 0;
          if ($Page == 0 || $Page < 1) {
            $ShowPostFrom = 0;
          } else {

            $ShowPostFrom = ($Page * 4) - 4;
          }

          $select_cart = "SELECT * FROM displaying_insights WHERE post_category = '$cart' ORDER BY id DESC LIMIT $ShowPostFrom,4";
        } else {

          $select_cart = "SELECT * FROM displaying_insights WHERE post_category = '$cart' ORDER BY id DESC LIMIT 0,4";
        }

        $query_dbase = mysqli_query($connect_db, $select_cart);

        if (mysqli_num_rows($query_dbase) > 0) {
          while ($cart_rows = mysqli_fetch_array($query_dbase)) {
        ?>

            <div class="col-md-4">
              <article class="card mb-4">
                <div class="post-slider">
                  <img src="Dashboard/admin/uploads/<?php echo $cart_rows["post_image"] ?>" class="card-img-top" alt="content image" />
                </div>
                <div class="card-body">
                  <h3 class="mb-3">
                    <a class="post-title" href="details.php?postNum=<?php echo $cart_rows["id"] ?>"><?php echo $cart_rows["post_title"] ?></a>
                  </h3>
                  <ul class="card-meta list-inline">
                    <li class="list-inline-item">
                      <a href="author.php" class="card-meta-author">
                        <img src="Dashboard/admin/uploads/author/<?php echo $cart_rows["author_image"] ?>" />
                        <span><?php echo $cart_rows["author"] ?></span>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <i class="ti-calendar"></i><?php echo $cart_rows["date"] ?>
                    </li>
                    <li class="list-inline-item">
                      <ul class="card-meta-tag list-inline">

                        <?php
                        if (!empty($cart_rows['tags'])) {
                          echo "<li class='list-inline-item'>
                          <a href='cart.php?tag=" . $cart_rows['tags'] . "'>" . $cart_rows['tags'] . "</a>
                        </li>";
                        }
                        ?>

                        <li class="list-inline-item">
                          <a href="cart.php?category=<?php echo $cart_rows["post_category"] ?>"><?php echo $cart_rows["post_category"] ?></a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <p>

                    <?php
                    $post = substr($cart_rows['post_details'], 0, strrpos(substr($cart_rows['post_details'], 0, 250), ' ')) . "...";
                    echo $post;
                    ?>

                  </p>
                  <a href="details.php?postNum=<?php echo $cart_rows["id"] ?>" class="btn btn-outline-primary">Read More</a>
                </div>
              </article>
            </div>

          <?php
          }
          ?>
          <!-- pagination -->
          <ul class="pagination justify-content-center">

            <?php
            if (isset($Page)) {
              if ($Page > 1) {
            ?>

                <li class="page-item">
                  <a href="?category=<?php echo $_GET['category'] ?>&Page=<?php echo $Page - 1; ?>" class="page-link">&laquo;</a>
                </li>

                <?php
              }
            }

            $search_db_a = "SELECT COUNT(*) FROM displaying_insights WHERE post_category = '$cart'";
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
                    <a class="page-link" href="?category=<?php echo $_GET['category'] ?>&Page=<?php echo $page_number; ?>"><?php echo $page_number; ?></a>
                  </li>

                <?php

                } else {

                ?>

                  <li class="page-item">
                    <a class="page-link" href="?category=<?php echo $_GET['category'] ?>&Page=<?php echo $page_number; ?>"><?php echo $page_number; ?></a>
                  </li>

                <?php
                }
              }
            }
            if (isset($Page)) {
              if ($Page + 1 <= $total_pages) {
                ?>
                <li class="page-item">
                  <a class="page-link" href="?category=<?php echo $_GET['category'] ?>&Page=<?php echo $Page + 1 ?>">&raquo; </a>
                </li>
            <?php
              }
            }
            ?>

          </ul>
          <!-- /pagination -->

        <?php
        }
      } elseif (isset($_GET["tag"])) {
        ?>

        <h1 class="h2 mb-4">Showing items from <mark><?php echo $_GET["tag"] ?></mark></h1>

        <?php
        $tag = $_GET["tag"];
        if (isset($_GET["Page"])) {
          $Page = $_GET["Page"];
          if ($Page == 0 || $Page < 1) {
            $ShowPostFrom = 0;
          } else {

            $ShowPostFrom = ($Page * 4) - 4;
          }

          $select_tag = "SELECT * FROM displaying_insights WHERE tags = '$tag' ORDER BY id DESC LIMIT $ShowPostFrom,4";
        } elseif (!isset($_GET["Page"])) {
          $Page = 0;
          if ($Page == 0 || $Page < 1) {
            $ShowPostFrom = 0;
          } else {
            $ShowPostFrom = ($Page * 4) - 4;
          }

          $select_tag = "SELECT * FROM displaying_insights WHERE tags = '$tag' ORDER BY id DESC LIMIT $ShowPostFrom,4";
        } else {
          $select_tag = "SELECT * FROM displaying_insights WHERE tags = '$tag' ORDER BY id DESC LIMIT 0,4";
        }

        $query_dbase = mysqli_query($connect_db, $select_tag);

        if (mysqli_num_rows($query_dbase) > 0) {
          while ($tag_rows = mysqli_fetch_array($query_dbase)) {
        ?>

            <div class="col-md-4">
              <article class="card mb-4">
                <div class="post-slider">
                  <img src="Dashboard/admin/uploads/<?php echo $tag_rows["post_image"] ?>" class="card-img-top" alt="post-thumb" />
                </div>
                <div class="card-body">
                  <h3 class="mb-3">
                    <a class="post-title" href="details.php?postNum=<?php echo $tag_rows["id"] ?>"><?php echo $tag_rows["post_title"] ?></a>
                  </h3>
                  <ul class="card-meta list-inline">
                    <li class="list-inline-item">
                      <a href="author.php" class="card-meta-author">
                        <img src="Dashboard/admin/uploads/author/<?php echo $tag_rows["author_image"] ?>" />
                        <span><?php echo $tag_rows["author"] ?></span>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <i class="ti-calendar"></i><?php echo $tag_rows["date"] ?>
                    </li>
                    <li class="list-inline-item">
                      <ul class="card-meta-tag list-inline">
                        <li class="list-inline-item">
                          <a href="cart.php?tag=<?php echo $tag_rows["tags"] ?>"><?php echo $tag_rows["tags"] ?></a>
                        </li>
                        <li class="list-inline-item">
                          <a href="cart.php?category=<?php echo $tag_rows["post_category"] ?>"><?php echo $tag_rows["post_category"] ?></a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <p>

                    <?php
                    $post = substr($tag_rows['post_details'], 0, strrpos(substr($tag_rows['post_details'], 0, 250), ' ')) . "...";
                    echo $post;
                    ?>

                  </p>
                  <a href="details.php?postNum=<?php echo $tag_rows["id"] ?>" class="btn btn-outline-primary">Read More</a>
                </div>
              </article>
            </div>

          <?php
          }
          ?>

          <!-- pagination -->
          <ul class="pagination justify-content-center">
            <?php
            if (isset($Page)) {
              if ($Page > 1) {
            ?>
                <li class="page-item">
                  <a href="?tag=<?php echo $_GET['tag'] ?>&Page=<?php echo $Page - 1; ?>" class="page-link">&laquo;</a>
                </li>
                <?php
              }
            }

            $search_db_a = "SELECT COUNT(*) FROM displaying_insights WHERE tags = '$tag'";
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
                    <a class="page-link" href="?tag=<?php echo $_GET['tag'] ?>&Page=<?php echo $page_number; ?>"><?php echo $page_number; ?></a>
                  </li>
                <?php
                } else {
                ?>
                  <li class="page-item">
                    <a class="page-link" href="?tag=<?php echo $_GET['tag'] ?>&Page=<?php echo $page_number; ?>"><?php echo $page_number; ?></a>
                  </li>
                <?php
                }
              }
            }
            if (isset($Page)) {
              if ($Page + 1 <= $total_pages) {
                ?>
                <li class="page-item">
                  <a class="page-link" href="?tag=<?php echo $_GET['tag'] ?>&Page=<?php echo $Page + 1 ?>">&raquo; </a>
                </li>
            <?php
              }
            }
            ?>
          </ul>
          <!-- /pagination -->

      <?php
        }
      }
      ?>

    </div>
  </div>
</section>

<!-- footer -->
<?php include_once("include/footer.php"); ?>
<!-- /footer -->