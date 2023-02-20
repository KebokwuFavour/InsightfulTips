<!-- header -->
<?php include_once("include/header.php"); ?>
<!-- /header -->

    <section class="section ms-md-4 me-md-4 mt-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-9">
            <div class="col-lg-12 mb-4 mb-lg-0">

            <?php
            $post_id = $_GET["postNum"];
            $select_post = "SELECT * FROM displaying_insights WHERE id = '$post_id'";
            $query_dbase = mysqli_query($connect_db, $select_post);

            if (mysqli_num_rows($query_dbase) > 0) {
              while ($post_rows = mysqli_fetch_array($query_dbase)) {
            ?>
              <article>
                <div class="post-slider mb-4">
                  <img
                    src="Dashboard/admin/uploads/<?php echo $post_rows["post_image"] ?>"
                    class="card-img-top"
                    alt="post-thumb"
                    style="border-radius: 20px 20px 0px 0px;"
                  />
                </div>

                <h1 class="h2">
                  <?php echo $post_rows["post_title"] ?>
                </h1>
                <ul class="card-meta my-3 list-inline">
                  <li class="list-inline-item">
                    <a href="author.php" class="card-meta-author">
                      <img src="Dashboard/admin/uploads/author/<?php echo $post_rows["author_image"] ?>" />
                      <span><?php echo $post_rows["author"] ?></span>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <i class="ti-calendar"></i><?php echo $post_rows["date"] ?>
                  </li>
                  <li class="list-inline-item">
                    <ul class="card-meta-tag list-inline">
                      <?php
                      if (!empty($post_rows['tags'])) {
                        echo "<li class='list-inline-item'>
                        <a href='cart.php?tag=" . $post_rows['tags'] . "'>" . $post_rows['tags'] . "</a>
                      </li>";
                      }
                      ?>

                      <li class="list-inline-item">
                        <a href="cart.php?category=<?php echo $post_rows["post_category"] ?>"><?php echo $post_rows["post_category"] ?></a>
                      </li>
                    </ul>
                  </li>
                </ul>
                
                <div class="content">
                  <p>
                  <?php
                    $post = $post_rows['post_details'];
                    echo $post;
                  ?>
                  </p>
                </div>
              </article>
              <?php
              }
            }
            ?>
            </div>

            <div class="col-lg-12">
              <div class="mb-5 border-top mt-4 pt-5">
                <?php
                  $post_num = $_GET["postNum"];
                  $select_cmts = "SELECT * FROM blog_comments WHERE blog_id = '$post_num'";
                  $query_dbase2 = mysqli_query($connect_db, $select_cmts);
                  if (mysqli_num_rows($query_dbase2) > 0) {
                    ?>
                      <h3 class="mb-4">Comments</h3>
                      <div class="media d-block mb-4 pb-4">
                    <?php
                    while ($cmts = mysqli_fetch_array($query_dbase2)) {
                      ?>
                        <span class="d-inline-block mr-2 mb-3 mb-md-2" href="#">
                          <img
                            src="Assets/images/post/user-01.jpg"
                            class="mr-3 rounded-circle"
                            alt=""
                          />
                        </span>
                        <div class="media-body mb-3">
                          <p class="h4 d-inline-block mb-1"
                            ><?php echo $cmts["name"] ?></p
                          >
                          <p>
                            <b><?php echo $cmts["email"] ?></b>
                          </p>

                          <p class="mb-2" style="word-break: break-word;">
                            <span class="ps-2">
                              <?php echo $cmts["comments"] ?>
                            </span>
                          </p>

                          <span class="text-black-800 mr-3 font-weight-600"
                            ><?php echo $cmts["date"] ?></span
                          >
                          <a class="btn btn-outline-primary btn-sm font-weight-600" href="replymodal-1.php?cmt_id=<?php echo $cmts["id"] ?>&name=<?php echo $cmts["name"] ?>&postNum=<?php echo $post_num ?>">Reply</a>
                        </div>

                        <?php
                          $cmt_id = $cmts["id"];
                          $select_cmts_reply = "SELECT * FROM comments_reply WHERE comment_id = '$cmt_id'";
                          $query_dbase2 = mysqli_query($connect_db, $select_cmts_reply);
                          if (mysqli_num_rows($query_dbase2) > 0) {
                        ?>
                          <div class="media d-block mb-3 pb-2 ms-4">
                        <?php
                        while ($cmts_reply = mysqli_fetch_array($query_dbase2)) {
                          ?>
                            <div class="media-body mb-3 mb-md-4">
                              <p class="h4 d-inline-block mb-1">
                                <img class="mr-3" src="Assets/images/post/arrow.png" alt="" />
                                <?php echo $cmts_reply["names"] ?>
                              </p>
                              <p>
                                <b><?php echo $cmts_reply["emails"] ?></b>
                              </p>

                              <p class="mb-2" style="word-break: break-word;">
                                <b><em>@ <?php echo $cmts["email"] ?></em></b>
                                <span class="ps-2">
                                  <?php echo $cmts_reply["messages"] ?>
                                </span>
                              </p>

                              <span class="text-black-800 mr-3 font-weight-600"
                                ><?php echo $cmts_reply["dates"] ?></span
                              >
                              <a class="btn btn-outline-primary btn-sm font-weight-600" href="replymodal-2.php?cmt_id=<?php echo $cmts_reply["id"] ?>&name=<?php echo $cmts_reply["names"] ?>&postNum=<?php echo $post_num ?>">Reply</a>
                            </div>

                            <?php
                              $cmt_reply_id = $cmts_reply["id"];
                              $select_cmts_reply = "SELECT * FROM comments_reply_reply WHERE comments_reply_id = '$cmt_reply_id'";
                              $query_dbase3 = mysqli_query($connect_db, $select_cmts_reply);
                              if (mysqli_num_rows($query_dbase3) > 0) {
                            ?>
                              <div class="media d-block mb-3 pb-2 ms-4">
                            <?php
                            while ($cmts_reply_reply = mysqli_fetch_array($query_dbase3)) {
                              ?>
                                <div class="media-body mb-3 mb-md-1">
                                  <p class="h4 d-inline-block mb-1">
                                    <img class="mr-3" src="Assets/images/post/arrow.png" alt="" />
                                    <?php echo $cmts_reply_reply["name"] ?>
                                  </p>
                                  <p>
                                    <b><?php echo $cmts_reply_reply["email"] ?></b>
                                  </p>

                                  <p class="mb-2" style="word-break: break-word;">
                                    <b><em>@ <?php echo $cmts_reply["emails"] ?></em></b>
                                    <span class="ps-2">
                                      <?php echo $cmts_reply_reply["message"] ?>
                                    </span>
                                  </p>

                                  <span class="text-black-800 mr-3 font-weight-600"
                                    ><?php echo $cmts_reply_reply["date"] ?></span
                                  >
                                </div>
                              <?php
                            }
                            ?>
                              </div>
                            <?php
                          }
                        }
                        ?>
                          </div>
                        <?php
                      }
                        }
                    ?>
                      </div>
                    <?php
                  }
                ?>
              </div>

              <div>
                <?php
                  // define variables and set to empty values
                  $nameErr = $emailErr = $msgErr = $webErr = "";
                  $name = $email = $msg = $web = "";
                  if (isset($_POST["comment"])) {
                    $blog_id = $_GET["postNum"];
                    if (empty($_POST['name']) || empty($_POST["email"]) || empty($_POST['msg'])) {
                      $nameErr = 'name is required';
                      $emailErr = 'Email is required';
                      $msgErr = 'Specify your message';
                    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["name"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                      $nameErr = "Only letters and white space allowed";
                      $emailErr = "Invalid email format";
                    } elseif (!empty($_POST["web"])) {
                      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $_POST["web"])) {
                        $webErr = "Invalid URL";
                      }
                    } else {
                      $name = test_input($_POST['name']);
                      $web = test_input($_POST["web"]);
                      $email = test_input(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
                      $msg = test_input($_POST['msg']);
                      $insert_into_db = "INSERT INTO blog_comments (name, email, website, comments, blog_id) VALUES ('$name', '$email', '$web', '$msg', '$blog_id')";
                      $query_db = mysqli_query($connect_db, $insert_into_db);
                      if ($query_db) {
                        echo "<script> alert('Comment was Successful'); </script>";
                      }
                    }
                  }
                ?>
                <h3 class="mb-4">Leave a Comment</h3>
                <form action="" method="post">
                  <div class="row">
                    <div class="form-group col-md-12">
                      <textarea
                        class="form-control shadow-none"
                        name="msg"
                        rows="7"
                        required
                      ></textarea>
                      <span style="color: crimson;">* <?php echo $msgErr ?></span>
                    </div>
                    <div class="form-group col-md-4">
                      <input
                        type="text"
                        name="name"
                        class="form-control shadow-none"
                        placeholder="Name"
                        required
                      />
                      <span style="color: crimson;">* <?php echo $nameErr ?></span>
                    </div>
                    <div class="form-group col-md-4">
                      <input
                        type="email"
                        name="email"
                        class="form-control shadow-none"
                        placeholder="Email"
                        required
                      />
                      <span style="color: crimson;">* <?php echo $emailErr ?></span>
                    </div>
                    <div class="form-group col-md-4">
                      <input
                        type="url"
                        name="web"
                        class="form-control shadow-none"
                        placeholder="Website"
                      />
                      <span style="color: crimson;"><?php echo $webErr ?></span>
                      <p class="font-weight-bold valid-feedback">
                        OK! You can skip this field.
                      </p>
                    </div>
                  </div>
                  <button type="submit" name="comment" class="btn btn-primary">
                    Comment Now
                  </button>
                </form>
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-3 d-none d-lg-block">
            <?php
              $postId = $_GET["postNum"];
              $selecting_post = "SELECT * FROM displaying_insights WHERE id = '$postId'";
              $querying_dbase = mysqli_query($connect_db, $selecting_post);
              $fetching_data = mysqli_fetch_array($querying_dbase);

              $post_cart = $fetching_data["post_category"];
              $selecting_post2 = "SELECT * FROM displaying_insights WHERE post_category = '$post_cart' AND id != '$postId' ORDER BY RAND() LIMIT 8";
              $querying_dbase2 = mysqli_query($connect_db, $selecting_post2);
      
              if (mysqli_num_rows($querying_dbase2) > 0) {
                ?>
                <h4 class="h4 text-bold mb-3 mt-1">
                  Related Insights
                </h4>
                <?php
                while ($rel_rows = mysqli_fetch_array($querying_dbase2)) {
              ?>
    
                <div class="">
                  <article class="card mb-4">
                    <div class="post-slider">
                      <img src="Dashboard/admin/uploads/<?php echo $rel_rows["post_image"] ?>" class="card-img-top" alt="content image" />
                    </div>
                    <div class="card-body">
                      <h4 class="mb-3">
                        <a class="post-title" href="details.php?postNum=<?php echo $rel_rows["id"] ?>"><?php echo $rel_rows["post_title"] ?></a>
                      </h4>
                      <ul class="card-meta list-inline">
                        <li class="list-inline-item">
                          <a href="author.php" class="card-meta-author">
                            <img src="Dashboard/admin/uploads/author/<?php echo $rel_rows["author_image"] ?>" />
                            <span><?php echo $rel_rows["author"] ?></span>
                          </a>
                        </li>
                        <li class="list-inline-item">
                          <i class="ti-calendar"></i><?php echo $rel_rows["date"] ?>
                        </li>
                        <li class="list-inline-item">
                          <ul class="card-meta-tag list-inline">
    
                            <?php
                            if (!empty($rel_rows['tags'])) {
                              echo "<li class='list-inline-item'>
                              <a href='cart.php?tag=" . $rel_rows['tags'] . "'>" . $rel_rows['tags'] . "</a>
                            </li>";
                            }
                            ?>
    
                            <li class="list-inline-item">
                              <a href="cart.php?category=<?php echo $rel_rows["post_category"] ?>"><?php echo $rel_rows["post_category"] ?></a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                      <p>
    
                        <?php
                        $post = substr($rel_rows['post_details'], 0, strrpos(substr($rel_rows['post_details'], 0, 50), ' ')) . "...";
                        echo $post;
                        ?>
    
                      </p>
                      <a href="details.php?postNum=<?php echo $rel_rows["id"] ?>" class="btn btn-outline-primary">Read More</a>
                    </div>
                  </article>
                </div>
    
              <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </section>

<!-- footer -->
<?php include_once("include/footer.php"); ?>
<!-- /footer -->