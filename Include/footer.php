<?php ?>

<footer class="footer">
  <svg class="footer-border" height="214" viewBox="0 0 2204 214" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2203 213C2136.58 157.994 1942.77 -33.1996 1633.1 53.0486C1414.13 114.038 1200.92 188.208 967.765 118.127C820.12 73.7483 263.977 -143.754 0.999958 158.899" stroke-width="2" />
  </svg>

  <div class="container-fluid ms-md-4 me-md-4">
    <div class="row justify-content-between">
      <div class="col-md-4 mb-4">
        <a class="mb-4 d-block" href="index.php">
          <img class="img-fluid" width="90px" src="Assets/images/myLogo.jpg" alt="BeInformed Logo" />
        </a>
        <?php
        $select_from_db = "SELECT * FROM author ORDER BY id DESC LIMIT 1";
        $query_db = mysqli_query($connect_db, $select_from_db);
        if (mysqli_num_rows($query_db) > 0) {

          while ($mission_row = mysqli_fetch_array($query_db)) {
        ?>
            <p>
              <?php echo $mission_row["mission"] ?>
            </p>
        <?php
          }
        }
        ?>
      </div>

      <!-- quick links -->
      <div class="col-md-2 col-6 mb-4 pt-lg-4">
        <h5 class="mb-4">Quick Links</h5>
        <ul class="list-unstyled footer-list">
          <li><a href="author.php">Author</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="shop.php">Shop</a></li>
          <li><a href="privacy-policy.php">Privacy Policy</a></li>
        </ul>
      </div>

      <!-- social links -->
      <div class="col-md-2 col-6 mb-4 pt-lg-4">
        <h5 class="mb-4">Social Links</h5>
        <ul class="list-unstyled footer-list">
        <?php
          $select_link = "SELECT * FROM socials ORDER BY id ASC";
          $query_link = mysqli_query($connect_db, $select_link);
          while ($link = mysqli_fetch_array($query_link)) {
            ?>
            <li>
              <a href="<?php echo $link["social_links"] ?>"><?php echo $link["social_handles"] ?></a>
            </li>
            <?php
          }
        ?>
        </ul>
      </div>

      <!-- Subscribe form -->
      <div class="col-md-4 mb-4 pt-lg-4">
        <h5 class="mb-4">Subscribe Newsletter</h5>
        <?php
        $emailErrs = "";
        $subscriber_email = "";
        if (isset($_POST["subscribe-btn"])) {
          if (empty($_POST["emails"])) {
            $emailErrs = "Email is required";
          } else {
            $subscriber_email = test_input($_POST["emails"]);
            // check if e-mail address is well-formed
            if (!filter_var($subscriber_email, FILTER_VALIDATE_EMAIL)) {
              $emailErrs = "Invalid email format";
            } else {
              // check if e-mail address already exist
              $select = "SELECT emails FROM subscribers WHERE emails = '$subscriber_email'";
              $query = mysqli_query($connect_db, $select);
              if (mysqli_num_rows($query) > 0) {
               //  echo "<script> alert('email already exist'); </script>";
                die ("<script> alert('You are already a subscriber, thank you.'); </script>");
              } else {
                // insert into database
                $insert_into_db = "INSERT INTO subscribers (emails) VALUES ('$subscriber_email')";
                $query_db = mysqli_query($connect_db, $insert_into_db);
                if ($query_db) {
                  $to = "".$subscriber_emails."";
                  $subject = "Welcome ". $subscriber_emails." !";
                  $txt = "You have successfully subscribed to this channel and you are sure of getting notified immediately a post is droped. Please do ensure to check the shop pages for our affiliate products. Thanks.";
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
        <form action="" method="post" class="subscription-form me-md-5">
          <span style="color: crimson;"><?php echo $emailErrs; ?></span>
          <input type="email" name="emails" class="mb-2" placeholder="Your Email Address" />
          <i class="ti-email email-icon"></i>
          <button type="submit" name="subscribe-btn" class="btn btn-outline-primary btn-block rounded">
            Subscribe now
          </button>
        </form>
      </div>
    </div>
  </div>

  <div class="container-fluid ms-md-4 me-md-4">
    <div class="row align-items-center">
      <div class="col-md-4 text-center text-md-left mb-4">
        <ul class="list-inline footer-list mb-0">
          <li class="list-inline-item">
            <a href="privacy-policy.php">Privacy Policy</a>
          </li>
        </ul>
      </div>
      <div class="col-md-4 text-center mb-4">
        <?php
        $select_links = "SELECT * FROM author";
        $query_links = mysqli_query($connect_db, $select_links);
        $links = mysqli_fetch_array($query_links);
        ?>
        <p class="content">
          &copy; 2022 - Design &amp; Develop By
          <a href="<?php echo $links["name_link"] ?>">Favour</a>
        </p>
      </div>
      <div class="col-md-4 text-md-right text-center mb-4">
        <ul class="list-inline footer-list mb-0">
        <?php
          $select_links2 = "SELECT * FROM socials ORDER BY id ASC";
          $query_links2 = mysqli_query($connect_db, $select_links2);
          while ($links2 = mysqli_fetch_array($query_links2)) {
            ?>
            <li class="list-inline-item">
              <a href="<?php echo $links2["social_links"] ?>"><i class="fa-brands fa-<?php echo $links2["social_handles"] ?>"></i></a>
            </li>
            <?php
          }
        ?>
        </ul>
      </div>
    </div>
    <div class="scroll-top me-md-5">
      <a href="" id="scrollTop"><i class="ti-angle-up"></i></a>
    </div>
  </div>
</footer>

<!-- JS script files and dependencies -->
<script src="Assets/js/jquery-3.6.0.js"></script>

<script src="Assets/js/boostrap-5.2.0 js/bootstrap.bundle.js"></script>

<script src="Assets/js/slick.min.js"></script>

<script src="Assets/js/instafeed.min.js"></script>

<!-- Main Script -->
<script src="Assets/js/script.js"></script>
</body>

</html>