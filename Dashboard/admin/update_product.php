<?php
  include_once("Include/header.php");
  include_once("Include/navbar.php");
?>

  <!-- <div class="" style=""> -->
    <main id="main" class="main">
      <div class="table-responsive bg-white mx-auto">
        <table class="table table-hover text-center">
          <thead>
            <tr>
              <th class="col pt-4 border">Id</th>
              <th class="col pt-4 border">Product_links</th>
              <th class="col pt-4 border">product_image</th>
              <th class="col pt-4 border">Product_title</th>
              <th class="col pt-4 border">Price</th>
              <th class="col pt-4 border">Edit</th>
            </tr>
          </thead>
          <?php
          include("../../config/db.php");
          include("../../Config/function.php");
          $select_from_db = "SELECT * FROM affiliate_marketing";
          $query_db = mysqli_query($connect_db, $select_from_db);
          if ($query_db) {
            while ($row = mysqli_fetch_array($query_db)) {
          ?>
              <tr class="border">
                <td  class="pt-4 border">
                  <?php echo $row['id'] ?>
                </td>
                <td  class="pt-4 border">
                  <a href="#">
                    <?php echo $row['product_link'] ?>
                  </a>
                </td>
                <td  class="pt-3 border">
                  <a href="#"><img src="uploads/affiliates/<?php echo $row['product_image'] ?>" alt="" class="img-fluid" width="70" height="70" /></a>
                </td>
                <td  class="pt-4 border">
                  <a href="#" class="text-primary fw-bold"><?php echo $row['product_title'] ?></a>
                </td>
                <td  class="pt-4 border"><?php echo $row['price'] ?></td>
                <td class="pt-4 border">
                  <a href="updateProduct-modal.php?productNum=<?php echo $row["id"] ?>">
                    <input type="submit" value="Update" name="edit" class="btn btn-outline-primary">
                  </a>
                </td>
              </tr>
          <?php
            }
          }
          ?>

        </table>
      </div>
    </main>
  <!-- </div> -->
  <!-- End #main -->

<!-- ======= Footer ======= -->
<?php
  include_once("Include/footer.php");
  include_once("Include/scripts.php");
?>