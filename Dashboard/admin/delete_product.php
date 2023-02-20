<?php
  include_once("Include/header.php");
  include_once("Include/navbar.php");
?>

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
                <form action="?id=<?php echo $row["id"] ?>" method="post">
                  <input type="submit" name="delete" value="Delete" class="btn btn-danger rounded-3">
                </form>
              </td>
            </tr>
        <?php
          }
        }
        if (isset($_POST["delete"])) {
          $productNum = $_GET["id"];
          $delete_from_db2 = "DELETE FROM affiliate_marketing Where id = '$productNum'";
          $query_db2 = mysqli_query($connect_db, $delete_from_db2);
          if ($query_db2) {
            echo "<script>
            alert('Row Deleted Successfully');
            </script>";
          } else {
            echo "<script>
            alert('Unable to Delete Row');
            </script>";
          }
        }
        ?>

      </table>
    </div>
  </main>
  <!-- End #main -->

<!-- ======= Footer ======= -->
<?php
  include_once("Include/footer.php");
  include_once("Include/scripts.php");
?>