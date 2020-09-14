<?php include 'inc/require_page_content/top.php'; ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include 'inc/require_page_content/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include 'inc/require_page_content/header.php'; ?>

        <?php 
        if(isset($_GET['operation'])){
          if ($_GET['operation'] == 'client') {
            include 'inc/pages/client.php'; 
          }
        }else{
          include 'inc/pages/sell_one.php'; 
        }
        ?>

      </div>
      <!-- End of Main Content -->

      <?php include 'inc/require_page_content/footer.php'; ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php include 'inc/model/logout.php'; ?>

<?php include 'inc/require_page_content/bottom.php'; ?>

<script type="text/javascript" src="js/custom/order.js"></script>