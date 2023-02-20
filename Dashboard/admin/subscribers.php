<?php
  include_once("Include/header.php");
  include_once("Include/navbar.php");
?>

<main id="main" class="main">
  <div class="table-responsive bg-white">
    <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Emails</th>
        <th scope="col">Date subscribed</th>
      </tr>
    </thead>
      <?php
      include("../../config/db.php");
      include("../../Config/function.php");
      $select_from_db = "SELECT * FROM subscribers";
      $query_db = mysqli_query($connect_db, $select_from_db);
      if ($query_db) {
        ?>
        <tbody>
          <?php
            while ($row = mysqli_fetch_array($query_db)) {
          ?>
          <tr>
            <td>
              <?php echo $row['id'] ?>
            </td>
            <td class="text-primary fw-bold">
              <?php echo $row['emails'] ?>
            </td>
            <td>
              <?php echo $row['date'] ?>
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      <?php
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