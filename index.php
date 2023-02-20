<!-- header -->
<?php include_once("include/header.php"); ?>
<!-- /header -->

<section class="section-sm mt-3 ms-md-4 me-md-4">
  <div class="container-fluid mt-4">
    <div class="row justify-content-center">
      <aside class="col-lg-4 @@sidebar border-end">
        <!-- Search -->
          <?php
          if (isset($_POST["search-btn"])) {
            if (!empty($_POST["search"])) {
              $_SESSION["search"] = test_input($_POST['search']);
              header("location: result.php");
            }
          }
          ?>
        <div class="widget d-none d-md-block">
          <h4 class="widget-title"><span>Search</span></h4>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="widget-search">
            <input class="mb-3" id="search-query" name="search" type="search" placeholder="Type &amp; Hit Enter..." required />
            <i class="ti-search"></i>
            <button type="submit" name="search-btn" class="btn btn-outline-primary btn-block">
              Search
            </button>
          </form>
        </div>
        <!-- /Search -->

        <!-- categories -->
        <?php
        if (mysqli_num_rows($query_db) > 0) {
        ?>
          <div class="widget widget-categories d-none d-md-block">
            <h4 class="widget-title"><span>Categories</span></h4>
            <ul class="list-unstyled widget-list">
              <?php
              $select_from_db = "SELECT DISTINCT post_category FROM displaying_insights";
              $query_db = mysqli_query($connect_db, $select_from_db);
              while ($cat_row = mysqli_fetch_array($query_db)) {
                $category = $cat_row["post_category"];
              ?>
                <li>
                  <a href="cart.php?category=<?php echo $category ?>" class="d-flex">
                    <?php
                    echo $category
                    ?>
                  </a>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        <?php
        }
        ?>


        <!-- recent post -->
        <?php
        $select_from_dbase = "SELECT * FROM displaying_insights ORDER BY id DESC LIMIT 3";
        $query_dbase = mysqli_query($connect_db, $select_from_dbase);
        if (mysqli_num_rows($query_dbase) > 0) {
        ?>
          <div class="widget">
            <h4 class="widget-title">Recent Posts</h4>
            <?php
            while ($recent_rows = mysqli_fetch_array($query_dbase)) {
            ?>
              <!-- post-item -->
              <article class="widget-card shadow">
                <div class="d-flex">
                  <img class="card-img-sm shadow" src="Dashboard/admin/uploads/<?php echo $recent_rows['post_image'] ?> " alt=" " />
                  <div class="ms-3">
                    <h4 style="word-break: break-word;">
                      <a class="post-title" href="details.php?postNum=<?php echo $recent_rows['id'] ?>"><?php echo $recent_rows['post_title'] ?></a>
                    </h4>
                    <ul class="card-meta list-inline mb-0">
                      <li class="list-inline-item mb-0">
                        <i class="ti-calendar"> <?php echo $recent_rows['date'] ?></i>
                      </li>
                    </ul>
                  </div>
                </div>
              </article>
            <?php
            }
            ?>
          </div>
        <?php
        }
        ?>

        <!-- Subscribe form -->
        <div class="widget">
          <h4 class="widget-title"><span>Never Miss Any Insight</span></h4>
          <p class="text-center text-small">
            Enter your email address &amp; press the subscribe now button to
            get noitified on every new posts dropped here.
          </p>
          <?php
          $emailErr = "";
          $subscriber_emails = "";
          if (isset($_POST["subscribe"])) {
            if (empty($_POST["email"])) {
              $emailErr = "Email is required";
            } else {
              $subscriber_emails = test_input($_POST["email"]);
              // check if e-mail address is well-formed
              if (!filter_var($subscriber_emails, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
              } else {
                // check if e-mail address already exist
                $select = "SELECT emails FROM subscribers WHERE emails = '$subscriber_emails'";
                $query = mysqli_query($connect_db, $select);

                if (mysqli_num_rows($query) > 0) {
                  echo "<script> alert('You are already a subscriber, thank you.'); </script>";
                } else {
                  // insert into database
                  $insert_into_db = "INSERT INTO subscribers (emails) VALUES ('$subscriber_emails')";
                  $query_db = mysqli_query($connect_db, $insert_into_db);

                  if ($query_db) {
                    $to = "".$subscriber_emails."";
                    $subject = "Welcome ". $subscriber_emails." !";
                    $txt = "You have successfully subscribed to this channel and you are sure of getting notified immediately a post is droped. Please do ensure to check the shop page for our affiliate products in the website. Thanks.";
                    $headers = "From: InsightfulTips" . "\r\n" .
                    "CC: Kebokwufavour@gmail.com";

                    mail($to,$subject,$txt,$headers);

                    if (mail($to,$subject,$txt,$headers)) {
                      echo "<script> alert('You have successfully subscribed for our newsletter and a mail has been sent to your email address.'); </script>";
                    }
                    echo "<script> alert('You have successfully subscribed to our newsletter. Congratulations'); </script>";
                  } else {
                    echo "<script> alert('Sorry, An error has occurred; contact the author for rectification'); </script>";
                  }
                }
              }
            }
          }
          ?>
          <form action="" method="post" name="mc-embedded-subscribe-form" class="widget-search">
            <span style="color: crimson;"><?php echo $emailErr; ?></span>
            <input class="mb-3" id="search-query" name="email" type="email" placeholder="Your Email Address" style="border: solid 1px #4fd675" />
            <i class="ti-email"></i>
            <button type="submit" class="btn btn-outline-primary btn-block" name="subscribe">
              Subscribe now
            </button>
          </form>
        </div>

        <!-- Social -->
        <div class="widget d-none d-md-block">
          <h4 class="widget-title"><span>Social Links</span></h4>
          <ul class="list-inline widget-social">
            <?php
            $select_links = "SELECT * FROM socials ORDER BY id ASC";
            $query_links = mysqli_query($connect_db, $select_links);
            while ($links = mysqli_fetch_array($query_links)) {
              ?>
              <li class="list-inline-item">
                <a href="<?php echo $links["social_links"] ?>"><i class="fa-brands fa-<?php echo $links["social_handles"] ?>"></i></a>
              </li>
              <?php
            }
            ?>
          </ul>
        </div>
      </aside>

      <?php
      if (isset($_GET["Page"])) {
        $Page = $_GET["Page"];
        if ($Page == 0 || $Page < 1) {
          $ShowPostFrom = 0;
        } else {

          $ShowPostFrom = ($Page * 4) - 4;
        }
        $select_from_dbase2 = "SELECT * FROM displaying_insights ORDER BY id DESC LIMIT $ShowPostFrom,4";
      } elseif (!isset($_GET["Page"])) {
        $Page = 0;
        if ($Page == 0 || $Page < 1) {
          $ShowPostFrom = 0;
        } else {

          $ShowPostFrom = ($Page * 4) - 4;
        }
        $select_from_dbase2 = "SELECT * FROM displaying_insights ORDER BY id DESC LIMIT $ShowPostFrom,4";
      } else {

        $select_from_dbase2 = "SELECT * FROM displaying_insights ORDER BY id DESC LIMIT 0,4";
      }
      $query_dbase2 = mysqli_query($connect_db, $select_from_dbase2);
      ?>
      <div class="col-lg-8 mb-0 mb-md-5 mb-lg-0 mt-5 mt-md-0">
        <?php
        if (mysqli_num_rows($query_dbase2) > 0) {
        ?>
          <!-- <h2 class="h3 section-title" style="text-transform: capitalize">
            Topics That May Intertest You
          </h2> -->
          <?php
          while ($rows = mysqli_fetch_assoc($query_dbase2)) {
          ?>
            <article>
              <div class="row card-body">
                <div class="col-md-4 mb-4 mb-md-0">
                  <div class="post-slider slider-sm">
                    <img src="Dashboard/admin/uploads/<?php echo $rows['post_image'] ?>" class="card-img" alt=" " style="height: 200px; object-fit: cover" />
                  </div>
                </div>
                <div class="col-md-8">
                  <h3 class="h4 mb-3">
                    <a class="post-title" href="details.php?postNum=<?php echo $rows['id'] ?>"><?php echo $rows['post_title'] ?></a>
                  </h3>
                  <ul class="card-meta list-inline">
                    <li class="list-inline-item">
                      <a href="author.php" class="card-meta-author">
                        <img src="Dashboard/admin/uploads/author/<?php echo $rows['author_image'] ?>" alt=" " />
                        <span><?php echo $rows['author'] ?></span>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <i class="ti-calendar"> <?php echo $rows['date'] ?></i>
                    </li>
                    <li class="list-inline-item">
                      <ul class="card-meta-tag list-inline">
                        <li class="list-inline-item">
                          <a href="cart.php?category=<?php echo $rows['post_category'] ?>"><?php echo $rows['post_category'] ?></a>
                        </li>
                        <?php
                        if (!empty($rows['tags'])) {
                          echo "<li class='list-inline-item'>
                          <a href='cart.php?tag=" . $rows['tags'] . "'>" . $rows['tags'] . "</a>
                        </li>";
                        }
                        ?>
                      </ul>
                    </li>
                  </ul>
                  <p style="word-break: break-word; word-break : break-all;">
                    <?php
                    $post = substr($rows['post_details'], 0, strrpos(substr($rows['post_details'], 0, 250), ' ')) . "...";
                    echo $post;
                    ?>
                  </p>
                  <a href="details.php?postNum=<?php echo $rows['id'] ?>" class="btn btn-outline-primary">Read More</a>
                </div>
              </div>
            </article>
        <?php
          }
        }
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

          $select_from_dbase_2a = "SELECT COUNT(*) FROM displaying_insights";
          $query_dbase_2a = mysqli_query($connect_db, $select_from_dbase_2a);
          $row_page = mysqli_fetch_array($query_dbase_2a);
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

<section class="section ms-md-4 me-md-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8 mb-5">
        <?php
        $select_from_dbase3 = "SELECT * FROM displaying_insights ORDER BY RAND() LIMIT 6";
        $query_dbase3 = mysqli_query($connect_db, $select_from_dbase3);
        ?>
        <div class="row">
          <?php
          if (mysqli_num_rows($query_dbase3) > 0) {
          ?>
            <div class="col-lg-6">
              <h2 class="h3 section-title">Headlines</h2>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
              <h2 class="h3 section-title">Insights</h2>
            </div>
            <?php
            while ($random_rows = mysqli_fetch_array($query_dbase3)) {
            ?>
              <div class="col-lg-6">
                <article class="card mb-4">
                  <div class="card-body d-flex">
                    <img class="card-img-sm" src="Dashboard/admin/uploads/<?php echo $random_rows["post_image"] ?>" />
                    <div class="ms-3">
                      <h4 style="word-break : break-word;">
                        <a href="details.php?postNum=<?php echo $random_rows['id'] ?>" class="post-title"><?php echo $random_rows["post_title"] ?></a>
                      </h4>
                      <ul class="card-meta list-inline mb-0">
                        <li class="list-inline-item mb-0">
                          <i class="ti-calendar"> <?php echo $random_rows["date"] ?></i>
                        </li>
                      </ul>
                    </div>
                  </div>
                </article>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>

      <div class="col-lg-4 mb-5">
        <?php
        $select_from_dbase4 = "SELECT * FROM displaying_insights ORDER BY date DESC LIMIT 1";
        $query_dbase4 = mysqli_query($connect_db, $select_from_dbase4);
        if (mysqli_num_rows($query_dbase4) > 0) {
        ?>
          <!-- <h2 class="h5 section-title">Popular Posts</h2> -->
          <h2 class="h3 section-title text-bold">Just In</h2>
          <?php
          while ($latest_row = mysqli_fetch_array($query_dbase4)) {
          ?>
            <article class="card">
              <div class="post-slider slider-sm">
                <img src="Dashboard/admin/uploads/<?php echo $latest_row["post_image"] ?>" class="card-img-top" alt="image" />
              </div>
              <div class="card-body">
                <h3 class="h4 mb-3">
                  <a class="post-title" href="details.php?postNum=<?php echo $latest_row['id'] ?>"><?php echo $latest_row["post_title"] ?></a>
                </h3>
                <ul class="card-meta list-inline">
                  <li class="list-inline-item">
                    <a href="author.php" class="card-meta-author">
                      <img src="Dashboard/admin/uploads/author/<?php echo $latest_row["author_image"] ?>" alt=" " />
                      <span><?php echo $latest_row["author"] ?></span>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <i class="ti-calendar"> <?php echo $latest_row["date"] ?></i>
                  </li>
                  <li class="list-inline-item">
                    <ul class="card-meta-tag list-inline">
                      <li class="list-inline-item">
                        <a href="cart.php"><?php echo $latest_row["post_category"] ?></a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <p>
                  <?php
                  $post = substr($latest_row['post_details'], 0, strrpos(substr($latest_row['post_details'], 0, 200), ' ')) . "...";
                  echo $post;
                  ?>
                </p>
                <a href="details.php?postNum=<?php echo $latest_row['id'] ?>" class="btn btn-outline-primary">Read More</a>
              </div>
            </article>
        <?php
          }
        }
        ?>
      </div>

      <div class="col-lg-4 mb-5">
        <?php
        $select_from_dbase5 = "SELECT * FROM displaying_insights WHERE post_category = 'Health' ORDER BY RAND() LIMIT 1";
        $query_dbase5 = mysqli_query($connect_db, $select_from_dbase5);
        if (mysqli_num_rows($query_dbase5) > 0) {
        ?>
          <!-- <h2 class="h5 section-title">Popular Posts</h2> -->
          <h2 class="h3 section-title">Health</h2>
          <?php
          while ($rand_cat_rows1 = mysqli_fetch_array($query_dbase5)) {
          ?>
            <article class="card">
              <div class="post-slider slider-sm">
                <img src="Dashboard/admin/uploads/<?php echo $rand_cat_rows1['post_image'] ?>" class="card-img-top" alt="content image" />
              </div>
              <div class="card-body">
                <h3 class="h4 mb-3">
                  <a class="post-title" href="details.php?postNum=<?php echo $rand_cat_rows1['id'] ?>"><?php echo $rand_cat_rows1['post_title'] ?></a>
                </h3>
                <ul class="card-meta list-inline">
                  <li class="list-inline-item">
                    <a href="author.php" class="card-meta-author">
                      <img src="Dashboard/admin/uploads/author/<?php echo $rand_cat_rows1['author_image'] ?>" alt=" " />
                      <span><?php echo $rand_cat_rows1['author'] ?></span>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <i class="ti-calendar"> <?php echo $rand_cat_rows1['date'] ?></i>
                  </li>
                  <li class="list-inline-item">
                    <ul class="card-meta-tag list-inline">
                      <li class="list-inline-item">
                        <a href="cart.php"><?php echo $rand_cat_rows1['post_category'] ?></a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <p>
                  <?php
                  $post = substr($rand_cat_rows1['post_details'], 0, strrpos(substr($rand_cat_rows1['post_details'], 0, 200), ' ')) . "...";
                  echo $post;
                  ?>
                </p>
                <a href="details.php?postNum=<?php echo $rand_cat_rows1['id'] ?>" class="btn btn-outline-primary">Read More</a>
              </div>
            </article>
        <?php
          }
        }
        ?>
      </div>

      <div class="col-lg-4 mb-5">
        <?php
        $select_from_dbase6 = "SELECT * FROM displaying_insights WHERE post_category = 'Education' ORDER BY RAND() LIMIT 1";
        $query_dbase6 = mysqli_query($connect_db, $select_from_dbase6);
        if (mysqli_num_rows($query_dbase6) > 0) {
        ?>
          <!-- <h2 class="h5 section-title">Popular Posts</h2> -->
          <h2 class="h3 section-title">Education</h2>
          <?php
          while ($rand_cat_rows2 = mysqli_fetch_array($query_dbase6)) {
          ?>
            <article class="card">
              <div class="post-slider slider-sm">
                <img src="Dashboard/admin/uploads/<?php echo $rand_cat_rows2['post_image'] ?>" class="card-img-top" alt="content image" />
              </div>
              <div class="card-body">
                <h3 class="h4 mb-3">
                  <a class="post-title" href="details.php?postNum=<?php echo $rand_cat_rows2['id'] ?>"><?php echo $rand_cat_rows2['post_title'] ?></a>
                </h3>
                <ul class="card-meta list-inline">
                  <li class="list-inline-item">
                    <a href="author.php" class="card-meta-author">
                      <img src="Dashboard/admin/uploads/author/<?php echo $rand_cat_rows2['author_image'] ?>" alt=" " />
                      <span><?php echo $rand_cat_rows2['author'] ?></span>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <i class="ti-calendar"></i><?php echo $rand_cat_rows2['date'] ?>
                  </li>
                  <li class="list-inline-item">
                    <ul class="card-meta-tag list-inline">
                      <li class="list-inline-item">
                        <a href="cart.php"><?php echo $rand_cat_rows2['post_category'] ?></a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <p>
                  <?php
                  $post = substr($rand_cat_rows2['post_details'], 0, strrpos(substr($rand_cat_rows2['post_details'], 0, 200), ' ')) . "...";
                  echo $post;
                  ?>
                </p>
                <a href="details.php?postNum=<?php echo $rand_cat_rows2['id'] ?>" class="btn btn-outline-primary">Read More</a>
              </div>
            </article>
        <?php
          }
        }
        ?>
      </div>

      <div class="col-lg-4 mb-5">
        <?php
        $select_from_dbase7 = "SELECT * FROM displaying_insights WHERE post_category = 'Politics' ORDER BY RAND() LIMIT 1";
        $query_dbase7 = mysqli_query($connect_db, $select_from_dbase7);
        if (mysqli_num_rows($query_dbase7) > 0) {
        ?>
          <h2 class="h3 section-title">Politics</h2>
          <?php
          while ($rand_cat_rows3 = mysqli_fetch_array($query_dbase7)) {
          ?>
            <article class="card">
              <div class="post-slider slider-sm">
                <img src="Dashboard/admin/uploads/<?php echo $rand_cat_rows3['post_image'] ?>" class="card-img-top" alt="content image" />
              </div>
              <div class="card-body">
                <h3 class="h4 mb-3">
                  <a class="post-title" href="details.php?postNum=<?php echo $rand_cat_rows3['id'] ?>"><?php echo $rand_cat_rows3['post_title'] ?></a>
                </h3>
                <ul class="card-meta list-inline">
                  <li class="list-inline-item">
                    <a href="author.php" class="card-meta-author">
                      <img src="Dashboard/admin/uploads/author/<?php echo $rand_cat_rows3['author_image'] ?>" alt=" " />
                      <span><?php echo $rand_cat_rows3['author'] ?></span>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <i class="ti-calendar"> <?php echo $rand_cat_rows3['date'] ?></i>
                  </li>
                  <li class="list-inline-item">
                    <ul class="card-meta-tag list-inline">
                      <li class="list-inline-item">
                        <a href="cart.php"><?php echo $rand_cat_rows3['post_category'] ?></a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <p>
                  <?php
                  $post = substr($rand_cat_rows3['post_details'], 0, strrpos(substr($rand_cat_rows3['post_details'], 0, 200), ' ')) . "...";
                  echo $post;
                  ?>
                </p>
                <a href="details.php?postNum=<?php echo $rand_cat_rows3['id'] ?>" class="btn btn-outline-primary">Read More</a>
              </div>
            </article>
        <?php
          }
        }
        ?>
      </div>

      <div class="col-12">
        <div class="border-bottom border-default"></div>
      </div>
    </div>
  </div>
</section>

<!-- footer -->
<?php include_once("include/footer.php"); ?>
<!-- /footer -->