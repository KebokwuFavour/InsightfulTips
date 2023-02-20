<!-- header -->
<?php include_once("include/header.php"); ?>
<!-- /header -->

<div class="header text-center">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 mx-auto">
        <h1 class="mb-4">Author</h1>
        <ul class="list-inline">
          <li class="list-inline-item">
            <a class="text-black" href="index.php">Home &nbsp; &nbsp; /</a>
          </li>
          <li class="list-inline-item text-primary">Author</li>
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
  <div class="container-fluid pb-5">
    <div class="row align-items-center justify-content-center">
      <?php
      $select_from_dbase = "SELECT * FROM author ORDER BY id DESC LIMIT 1";
      $query_dbase = mysqli_query($connect_db, $select_from_dbase);
      if (mysqli_num_rows($query_dbase) > 0) {
      ?>
        <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
          <?php
          while ($author_row = mysqli_fetch_array($query_dbase)) {
          ?>
            <a href="<?php echo $author_row["name_link"] ?>">
              <div class="image-wrapper">
                <img class="img-fluid w-100" src="Dashboard/admin/uploads/author/<?php echo $author_row['image'] ?>" />
              </div>
            </a>
        </div>
        <div class="col-lg-5 col-md-6">
          <div class="content pl-lg-3 pl-0">
            <h2 id="">
              Hello my name is <a href="<?php echo $author_row["name_link"] ?>"><?php echo $author_row["names"] ?></a>
            </h2>
            <p>
              <?php echo $author_row["short_detail"] ?>
            </p>
          <?php
          }
          ?>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>

<section class="section wave mt-5">
  <img src="Assets/images/backgrounds/wave-bg.svg" class="wave-bg" />
  <div class="container-fluid">
    <div class="row justify-content-around align-items-center">
      <?php
      $select_from_dbase2 = "SELECT * FROM author ORDER BY id DESC LIMIT 1";
      $query_dbase2 = mysqli_query($connect_db, $select_from_dbase2);
      if (mysqli_num_rows($query_dbase2) > 0) {
      ?>
        <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
          <h2 class="mb-4">
            My Mission and Purpose
          </h2>
          <?php
          while ($mission_row = mysqli_fetch_array($query_dbase2)) {
          ?>
            <p>
              <?php echo $mission_row["mission"] ?>
            </p>
        </div>
        <div class="col-lg-4 col-md-6">
          <img src="Dashboard/admin/uploads/author/mission/<?php echo $mission_row['mission_img'] ?>" class="img-fluid" />
        </div>
    <?php
          }
        }
    ?>

    </div>
  </div>

  <svg class="wave-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306" stroke-miterlimit="10" />
    <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
    <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306" stroke-miterlimit="10" />
  </svg>

  <svg class="wave-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
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

  <svg class="wave-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306" stroke-miterlimit="10" />
    <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
    <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306" stroke-miterlimit="10" />
  </svg>

  <svg class="wave-shape-4" width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
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
</section>

<section class="section-sm">
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <?php
        $select_links = "SELECT social_links FROM socials WHERE social_handles = 'youtube'";
        $query_links = mysqli_query($connect_db, $select_links);
        $mysql = mysqli_num_rows($query_links);
        $fetch = mysqli_fetch_array($query_links);
      ?>
      <div class="col-lg-5 col-md-6 order-2 order-md-1 text-center text-md-left">
        <h2 class="mb-4">
          Don't forget to subscribe my Youtube channel “HEPInsights”
        </h2>
        <a href="<?php echo $fetch['social_links'] ?>" class="btn btn-primary">Visit Channel</a>
      </div>
      <div class="col-lg-5 col-md-6 mb-4 mb-md-0 order-1 order-md-2">
        <div class="video-wrapper">
          <img src="Assets/images/youtube.png" class="img-fluid" />
          <a class="play-btn video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/dyZcRRWiuuw" data-bs-target="#myModal" href="<?php echo $fetch['social_links'] ?>"><i class="ti-control-play"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content border-0 bg-transparent">
      <div class="modal-body">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="<?php echo $fetch['social_links'] ?>" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="section-sm ms-md-4 me-md-4">
  <div class="container-fluid">
    <div class="row">
      <?php
      $select_from_dbase3 = "SELECT * FROM affiliate_marketing ORDER BY id DESC LIMIT 4";
      $query_dbase3 = mysqli_query($connect_db, $select_from_dbase3);
      if (mysqli_num_rows($query_dbase3) > 0) {
      ?>
        <div class="col-12 text-center">
          <!-- <h2 class="mb-5">Affiliate products for Sale</h2> -->
          <h2 class="mb-5">Affiliate products</h2>
        </div>
        <?php
        while ($affiliate_rows = mysqli_fetch_array($query_dbase3)) {
        ?>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card border-0 rounded-0 text-center shadow-none overflow-hidden">
              <a href="<?php echo $affiliate_rows['product_link'] ?>">
                <div class="book-cover">
                  <img src="Dashboard/admin/uploads/affiliates/<?php echo $affiliate_rows['product_image'] ?>" alt="product" class="card-img-top rounded-0" />
                </div>
                <div class="card-body">
                  <h4 class="text-uppercase mb-3"><?php echo $affiliate_rows['product_title'] ?></h4>
                  <p class="h4"><?php echo $affiliate_rows['price'] ?></p>
                </div>
              </a>
            </div>
          </div>
        <?php
        }
        ?>
        <div class="col-12 text-center">
          <a href="shop.php" class="btn btn-outline-primary">Read more</a>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>

<!-- footer -->
<?php include_once("include/footer.php"); ?>
<!-- /footer -->