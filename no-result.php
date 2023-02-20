<!-- header -->
<?php include_once("include/header.php"); ?>
<!-- /header -->

<?php
$get_search = $_SESSION['search'];
?>
<div class="py-3"></div>

<section class="section ms-md-4 me-md-4">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-12 mb-4">
        <h1 class="h2 mb-4">Search results for
          <mark>
            <?php echo $get_search ?>
          </mark>
        </h1>
      </div>
      <div class="col-lg-10 col-12 text-center">
        <img class="mb-5 img-fluid" src="Assets/images/no-search-found.svg" alt=" ">
        <!-- <h3>No Search Found</h3> -->
        <h3>Result Not Found</h3>
      </div>
    </div>
  </div>
</section>

<!-- footer -->
<?php include_once("include/footer.php"); ?>
<!-- /footer -->