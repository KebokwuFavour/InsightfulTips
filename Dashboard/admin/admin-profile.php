<?php
  include_once("Include/header.php");
  include_once("Include/navbar.php");
?>
<?php
include("../../config/db.php");
include("../../Config/function.php");
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <?php
              $select = "SELECT * FROM author";
              $sql = mysqli_query($connect_db, $select);
              $sql_data = mysqli_fetch_array($sql);
              ?>
              <img src="uploads/author/<?php echo $sql_data["image"] ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $sql_data['names'] ?></h2>
              <h3>Software Developer/Engineer</h3>
              <div class="social-links mt-2">
              <?php
              $select2 = "SELECT * FROM socials";
              $sql2 = mysqli_query($connect_db, $select2);
              if (mysqli_num_rows($sql2) > 0) {
                while ($sql_data2 = mysqli_fetch_array($sql2)) {
                  ?>
                  <a href="<?php echo $sql_data2['social_links'] ?>" class="facebook"><i class="bi bi-<?php echo $sql_data2['social_handles'] ?>"></i></a>
                  <?php
                }
              }
              ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <?php
                    $select3 = "SELECT * FROM author";
                    $sql3 = mysqli_query($connect_db, $select3);
                    $sql_data3 = mysqli_fetch_array($sql3);
                  ?>
                    <h5 class="card-title">About</h5>
                    <p class="small fst-italic">
                      <?php echo $sql_data3["short_detail"]; ?>
                    </p>

                    <h5 class="card-title">Profile Details</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Full Name</div>
                      <div class="col-lg-9 col-md-8"><?php echo $sql_data3["names"]; ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Portfolio</div>
                      <div class="col-lg-9 col-md-8">
                      <?php echo $sql_data3["name_link"]; ?>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Blog Mission/Purpose</div>
                      <div class="col-lg-9 col-md-8"><?php echo $sql_data3["mission"]; ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label pt-5">Blog Mission Image</div>
                      <div class="col-lg-9 col-md-8">
                        <img src="uploads/author/mission/<?php echo $sql_data3["mission_img"]; ?>" alt="mission_img" width="115" class="img_fluid">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Country</div>
                      <div class="col-lg-9 col-md-8">Nigeria</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Phone</div>
                      <div class="col-lg-9 col-md-8">0806-305-3291, 09129835626</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Email</div>
                      <div class="col-lg-9 col-md-8">kebokwufavour@gmail.com</div>
                    </div>
                  </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <?php
                    if (isset($_POST["update"])) {
                        $name = $_POST["name"];
                        $portfolio = $_POST["portfolio"];
                        $about = $_POST["about"];
                        $mission = $_POST["mission"];
                        
                        $update_dbase = "UPDATE author SET names='$name', name_link='$portfolio', short_detail='$about', mission='$mission'";
                        $query_dbae = mysqli_query($connect_db, $update_dbase);

                        $facebook = test_input($_POST["facebook"]);
                        $instagram = test_input($_POST["instagram"]);
                        $twitter = test_input($_POST["twitter"]);
                        $whatsapp = test_input($_POST["whatsapp"]);
                        $youtube = test_input($_POST["youtube"]);

                        $update_db = "UPDATE socials SET social_links = '$facebook' WHERE social_handles = 'facebook'";
                        $query_db = mysqli_query($connect_db, $update_db);
                        $update_db2 = "UPDATE socials SET social_links = '$instagram' WHERE social_handles = 'instagram'";
                        $query_db = mysqli_query($connect_db, $update_db2);
                        $update_db3 = "UPDATE socials SET social_links = '$twitter' WHERE social_handles = 'twitter'";
                        $query_db = mysqli_query($connect_db, $update_db3);
                        $update_db4 = "UPDATE socials SET social_links = '$whatsapp' WHERE social_handles = 'whatsapp'";
                        $query_db = mysqli_query($connect_db, $update_db4);
                        $update_db5 = "UPDATE socials SET social_links = '$youtube' WHERE social_handles = 'youtube'";
                        $query_db = mysqli_query($connect_db, $update_db5);

                        if (isset($_FILES["profile_img"]["name"])) {
                          $profile_img = $_FILES["profile_img"]["name"];
                          $target_dir = "uploads/author/";
                          $target_file = $target_dir . basename($_FILES['profile_img']['name']);
                          if (move_uploaded_file($_FILES['profile_img']['tmp_name'], $target_file)) {
                            $update_dbase2 = "UPDATE author SET image='$profile_img'";
                            $query_dbase2 = mysqli_query($connect_db, $update_dbase2);
                          }
                        }

                        if (isset($_FILES["mission_img"]["name"])) {
                          $mission_img = $_FILES["mission_img"]["name"];
                          $target_dir = "uploads/author/mission/";
                          $target_file = $target_dir . basename($_FILES['mission_img']['name']);
                          if (move_uploaded_file($_FILES['mission_img']['tmp_name'], $target_file)) {
                            $update_dbase3 = "UPDATE author SET mission_img='$mission_img'";
                            $query_dbase3 = mysqli_query($connect_db, $update_dbase3);
                          }
                        }
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                      <?php
                        $select3b = "SELECT * FROM author";
                        $sql3b = mysqli_query($connect_db, $select3b);
                        $sql_data3b = mysqli_fetch_array($sql3b);
                      ?>

                      <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                        <div class="col-md-4 col-lg-3">
                          <img src="uploads/author/<?php echo $sql_data3b["image"] ?>" alt="Profile">
                        </div>
                        <div class="col-md-4 col-lg-6">
                            <label for="profileImage" class="col-form-label">Update Profile Image</label>
                            <input type="file" name="profile_img" id="profile" class="form-control" title="Upload new profile image">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="name" type="text" class="form-control" id="fullName" value="<?php echo $sql_data3b["names"] ?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                        <div class="col-md-8 col-lg-9">
                          <textarea name="about" class="form-control" id="about" style="height: 100px"><?php echo $sql_data3b["short_detail"] ?></textarea>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="portfolio" class="col-md-4 col-lg-3 col-form-label">Portfolio</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="portfolio" type="text" class="form-control" id="portfolio" value="<?php echo $sql_data3b["name_link"] ?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Blog Mission</label>
                        <div class="col-md-8 col-lg-9">
                          <textarea name="mission" class="form-control" id="mission" style="height: 100px;"><?php echo $sql_data3b["mission"] ?></textarea>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="missionImage" class="col-md-4 col-lg-3 col-form-label">Mission Image</label>
                        <div class="col-md-4 col-lg-3">
                          <img src="uploads/author/mission/<?php echo $sql_data3b["mission_img"] ?>" alt="mission">
                        </div>
                        <div class="col-md-4 col-lg-6">
                            <label for="missionImage" class="col-form-label">Update Mission Image</label>
                            <input type="file" name="mission_img" id="" class="form-control" title="Upload new mission image">
                        </div>
                      </div>

                      <?php
                      $select4 = "SELECT * FROM socials";
                      $sql4 = mysqli_query($connect_db, $select4);
                      if (mysqli_num_rows($sql4) > 0) {
                        while ($sql_data4 = mysqli_fetch_array($sql4)) {
                          ?>
                          <div class="row mb-3">
                            <label for="<?php echo $sql_data4["social_handles"]; ?>" class="col-md-4 col-lg-3 col-form-label"><?php echo $sql_data4["social_handles"]; ?> Profile</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="<?php echo $sql_data4["social_handles"]; ?>" type="text" class="form-control" id="<?php echo $sql_data4["social_handles"]; ?>" value="<?php echo $sql_data4["social_links"]; ?>">
                            </div>
                          
                          </div>
                          <?php
                        }
                      }
                      ?>
                      <div class="text-center">
                        <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                      </div>
                    </form>
                    <!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">
                  <!-- Settings Form -->
                  <form>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
                  <!-- End settings Form -->
                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <?php
                  $currentPswd = $newPswd = $renewPswd = "";
                  $error1 = $error2 = $error3 = "";
                  if (isset($_POST['change_pswd'])) {
                    $currentPswd = $_POST["currentPassword"];
                    if (empty($currentPswd)) {
                      $error1 = "Current Password Required!";
                    } else {
                      if (empty($_POST["newPassword"])) {
                        $error2 = "New Password Required!";
                      } else {
                        if (empty($_POST["renewPassword"])) {
                          $error3 = "Confirm Your New Password!";
                        } else {
                          $newPswd = $_POST["newPassword"];
                          if (!preg_match('@[A-Z]@', $newPswd) || !preg_match('@[a-z]@', $newPswd) || !preg_match('@[0-9]@', $newPswd) || !preg_match('@[^\w]@', $newPswd) || strlen($newPswd) < 8) {
                            $error2 = "Password should be at least 8 characters and should contain upper case letter, number, and special characters.";
                          } else {
                            $newPswd = $_POST["newPassword"];
                            $renewPswd = $_POST["renewPassword"];
                            if ($renewPswd !== $newPswd) {
                              $error3 = "Password must match with the new one!";
                            }else {
                              $currentPswd = $_POST["currentPassword"];
                              $select_from_dbase = "SELECT * FROM admin_panel WHERE password = '$currentPswd'";
                              $query_datab = mysqli_query($connect_db, $select_from_dbase);
                              if (mysqli_num_rows($query_datab) > 0) {
                              // if ($currentPswd !== $real_pswd) {
                                // $newPswds = $_POST["newPassword"];
                                // $newPswd = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
                                $newPswd = $_POST["newPassword"];
                                // $newPswds = array();
                                // $newPswds[] = $_POST["newPassword"];
                                // $newPswdsstring = implode(",", $newPswds);
                                // $newPswd = password_hash($newPswdsstring, PASSWORD_DEFAULT);
                                $updating_datab = "UPDATE admin_panel SET password='$newPswd'";
                                $querying_datab = mysqli_query($connect_db, $updating_datab);
                              } else {
                                $error1 = "Valid current Password is Required";
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                  ?>
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <span class="text-danger"><?php echo $error1 ?></span>
                        <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <span class="text-danger"><?php echo $error2 ?></span>
                        <input name="newPassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <span class="text-danger"><?php echo $error3 ?></span>
                        <input name="renewPassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="change_pswd" class="btn btn-primary">Change Password</button>
                    </div>
                  </form>
                  <!-- End Change Password Form -->
                </div>
              </div>
              <!-- End Bordered Tabs -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include_once("Include/footer.php");
  include_once("Include/scripts.php");
  ?>