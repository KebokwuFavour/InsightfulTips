<!-- header -->
<?php include_once("include/header.php"); ?>
<!-- /header -->

<div class="header text-center">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 mx-auto">
        <h1 class="mb-4">Contact Us</h1>
        <ul class="list-inline">
          <li class="list-inline-item">
            <a class="text-default" href="index.php">Home &nbsp; &nbsp; /</a>
          </li>
          <li class="list-inline-item text-primary">Contact Us</li>
        </ul>
      </div>
    </div>
  </div>

  <svg class="header-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306" stroke-miterlimit="10" />
    <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
    <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306" stroke-miterlimit="10" />
  </svg>

  <svg class="header-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g filter="url(#filter0_d)">
      <path class="path" d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z" />
      <path d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z" stroke="#040306" stroke-miterlimit="10" />
    </g>
    <defs>
      <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
        <feFlood flood-opacity="0" result="BackgroundImageFix" />
        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
        <feOffset dy="4" />
        <feGaussianBlur stdDeviation="2" />
        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
      </filter>
    </defs>
  </svg>

  <svg class="header-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306" stroke-miterlimit="10" />
    <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
    <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306" stroke-miterlimit="10" />
  </svg>

  <svg class="header-border" height="240" viewBox="0 0 2202 240" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1" stroke-width="2" />
  </svg>
</div>

<section class="section-sm">
  <div class="container-fluid">
    <div class="row pb-5 mb-3">
      <div class="col-lg-8 mx-auto">
        <div class="content mb-5">
          <h2 id="we-would-love-to-hear-from-you">
            Would Love To Hear From You&hellip;.
          </h2>
          <p>
            Endeavour and do not hesistate to send a message across on anything of value as specified. Also, please do well to make sure that your message is clear enough for better understanding. Thank you.
          </p>
        </div>

        <?php
        // define variables and set to empty values
        $nameErr = $emailErr = $phoneErr = $reasonErr = $messageErr = "";
        $sender_name = $sender_email = $sender_reason = $sender_message = "";
        if (isset($_POST["send"])) {
          if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["reason"]) || empty($_POST["message"])) {
            $nameErr = "Name is required";
            $emailErr = "Email is required";
            $reasonErr = "Specify a reason";
            $messageErr = "Message is required";
          } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["name"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $nameErr = "Only letters and white space allowed";
            $emailErr = "Invalid email format";
          } elseif (!empty($_POST["tel"])) {
            if (preg_match("/^[a-zA-Z-' ]*$/", $_POST["tel"])) {
              $phoneErr = "Invalid format";
            }
          } else {
            $sender_name = test_input($_POST["name"]);
            $sender_email = test_input($_POST["email"]);
            $sender_phone = test_input($_POST["tel"]);
            $sender_reason = test_input($_POST["reason"]);
            $sender_message = test_input($_POST["message"]);
            $insert_into_db = "INSERT INTO contact (sender_name, sender_email, sender_phone, reason_for_contacting, sender_message) VALUES ('$sender_name', '$sender_email', '$sender_phone', '$sender_reason', '$sender_message')";
            $query_db = mysqli_query($connect_db, $insert_into_db);
            if (isset($query_db)) {
              echo "Record inserted successfully";
            } else {
              echo "Unable to insert record";
            }
          }
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
          <div class="form-group">
            <label for="name">Your Name (Required)</label><br>
            <span style="color: crimson;"><?php echo $nameErr; ?></span>
            <input type="text" name="name" id="name" class="form-control" placeholder="John Doe" />
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="email">Your Email Address (Required)</label><br>
                <span style="color: crimson;"><?php echo $emailErr; ?></span>
                <input type="email" name="email" id="email" class="form-control" placeholder="johndoe@gmail.com" />
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="tel">Your Phone Contact (Optional)</label><br>
                <span style="color: crimson;"><?php echo $phoneErr; ?></span>
                <input type="tel" name="tel" id="tel" class="form-control" placeholder="(+234) 9087654321" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="text">Reason For Contact (Required)</label><br>
            <span style="color: crimson;"><?php echo $reasonErr; ?></span>
            <!-- <input type="text" name="reason" id="reason" class="form-control" placeholder="Advertising" /> -->
            <select name="reason" id="reason" class="form-select shadow-none form-control" aria-label="Default select example">
              <option selected></option>
              <option value="adverts">Adverts</option>
              <option value="updates">Website Design</option>
              <option value="suggestion">Website Development</option>
              <option value="suggestion">Contract</option>
              <option value="suggestion">Co-project</option>
              <option value="suggestion">Updates</option>
              <option value="suggestion">Suggestions</option>
              <option value="complain">Complain</option>
              <option value="others">Others</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message">Your Message Here (Required)</label><br>
            <span style="color: crimson;"><?php echo $messageErr; ?></span>
            <textarea name="message" id="message" class="form-control" placeholder="Drop your message here..." style="resize: none"></textarea>
          </div>
          <input type="submit" value="Send Now" name="send" class="btn btn-outline-primary rounded">
        </form>
      </div>
    </div>
  </div>
</section>

<!-- footer -->
<?php include_once("include/footer.php"); ?>
<!-- /footer -->