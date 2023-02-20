
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <?php echo Date("Y"); ?> <strong><span>Admin - InsightfulTips</span></strong>. All Rights Reserved
    </div>
    <?php
        $select_links = "SELECT * FROM author";
        $query_links = mysqli_query($connect_db, $select_links);
        $links = mysqli_fetch_array($query_links);
        ?>
    <div class="credits">Designed by <a href="<?php echo $links["name_link"] ?>">Favour</a></div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

