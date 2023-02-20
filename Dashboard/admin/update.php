<?php
  include_once("Include/header.php");
  include_once("Include/navbar.php");
?>

  <!-- <div class="" style=""> -->
    <main id="main" class="main" style="width: 100%;">
      <div class="table-responsive bg-white mx-auto">
        <table class="table table-hover text-center">
          <tr>
            <th class="p-2 border">id</th>
            <th class="p-2 border">post_category</th>
            <th class="p-2 border">tags</th>
            <th class="p-2 border">post_title</th>
            <th class="p-2 border">post_image</th>
            <th class="p-2 border">post_details</th>
            <th class="p-2 border">author</th>
            <th class="p-2 border">author_image</th>
            <th class="p-2 border">date</th>
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
                  <td class="pt-4 border">
                    <a href="update-modal.php?postNum=<?php echo $row["id"] ?>">
                      <input type="submit" value="Update" name="edit" class="btn btn-outline-primary">
                    </a>
                  </td>
              </tr>
          <?php
            }
          }
          ?>

        </table>

        <div class="w-25 mx-auto text-center">
          <a href="dashboard.php"><input type="button" value="Exit" class="btn btn-outline-primary mx-auto w-75"></a>
        </div>

      </div>
    </main>
  <!-- End #main -->

<!-- ======= Footer ======= -->
<?php
  include_once("Include/footer.php");
  include_once("Include/scripts.php");
?>