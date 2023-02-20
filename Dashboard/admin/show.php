<?php
  include_once("Include/header.php");
  include_once("Include/navbar.php");
?>

<main id="main" class="main">
  <div class="table-responsive bg-white">
    <table class="table table-hover text-center">
      <tr>
        <th class="p-2 border">id</th>
        <th class="p-2 border">Post_category</th>
        <th class="p-2 border">Tags</th>
        <th class="p-2 border">Post_title</th>
        <th class="p-2 border">Post_image</th>
        <th class="p-2 border">Post_details</th>
        <th class="p-2 border">Author</th>
        <th class="p-2 border">Author_image</th>
        <th class="p-2 border">Date</th>
        <!-- <th class="p-2 border">Edit</th> -->
      </tr>
      <?php
      include("../../config/db.php");
      include("../../Config/function.php");
      $select_from_db = "SELECT * FROM displaying_insights";
      $query_db = mysqli_query($connect_db, $select_from_db);
      if ($query_db) {
        while ($row = mysqli_fetch_array($query_db)) {
      ?>
          <tr class="border">
          <td class="pt-4 border"><?php echo $row["id"] ?></td>
            <td class="pt-4 border"><?php echo $row["post_category"] ?></td>
            <td class="pt-4 border"><?php echo $row["tags"] ?></td>
            <td class="pt-3 border">
              <div style="width: 200px; height: 75px; overflow: auto; white-space: scroll;">
                <?php echo $row["post_title"] ?>
              </div>
            </td>
            <td class="pt-4 border">
              <img src="uploads/<?php echo $row["post_image"] ?>" alt="" width="50" height="50">
              <br>
              <?php echo $row["post_image"] ?>
            </td>
            <td class="pt-3 border">
              <div style="width: 280px; height: 75px; overflow: auto; white-space: scroll;">
                <?php echo $row["post_details"] ?>
              </div>
            </td>
            <td class="pt-4 border"><?php echo $row["author"] ?></td>
            <td class="pt-4 border">
              <img src="uploads/author/<?php echo $row["author_image"] ?>" alt="" width="50" height="50">
              <br>
              <?php echo $row["author_image"] ?>
            </td>
            <td class="pt-4 border"><?php echo $row["date"] ?></td>
          </tr>
      <?php
        }
      }
      ?>

    </table>
    <div class="container">
      <div class="row">
        <div class="col-3 mb-2 text-center">
          <a href="add.php" class="text-decoration-underline text-success"><em>Add new Post(s)?</em></a>
        </div>
        <div class="col-3 text-center">
        <a href="update.php" class="text-decoration-underline text-success"><em>Update Existing Post(s)?</em></a>
        </div>
        <div class="col-3 mb-2 text-center">
          <a href="delete.php" class="text-decoration-underline text-success"><em>Delete Post(s)?</em></a>
        </div>
        <div class="col-3 text-center">
          <a href="dashboard.php"><input type="button" value="Exit" class="btn btn-outline-success mx-auto w-75"></a>
        </div>
      </div>
    </div>
  </div>
</main>
  <!-- End #main -->

<!-- ======= Footer ======= -->
<?php
  include_once("Include/footer.php");
  include_once("Include/scripts.php");
?>