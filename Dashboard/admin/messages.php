<?php
  include_once("Include/header.php");
  include_once("Include/navbar.php");
?>

<main id="main" class="main" style="width: 100%;">
  <div class="table-responsive bg-white">
    <table class="table table-hover text-center">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Reason</th>
        <th scope="col">Message</th>
        <th scope="col">Date - Time</th>
      </tr>
    </thead>
      <?php
      include("../../config/db.php");
      include("../../Config/function.php");
      $select_from_db = "SELECT * FROM contact";
      $query_db = mysqli_query($connect_db, $select_from_db);
      if ($query_db) {
        while ($row = mysqli_fetch_array($query_db)) {
      ?>
          <tbody>
            <tr>
              <td scope="row">
                <?php echo $row['sender_name'] ?>
              </td>
              <td class="text-primary fw-bolder">
                <?php echo $row['sender_email'] ?>
              </td>
              <td>
                <?php echo $row['sender_phone'] ?>
              </td>
              <td class="fw-bold">
                <?php echo $row['reason_for_contacting'] ?>
              </td>
              <td>
                <?php echo $row['sender_message'] ?>
              </td>
              <td>
                <?php echo $row['time'] ?>
              </td>
            </tr>
          </tbody>
      <?php
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