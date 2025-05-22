<?php
include "php/koneksi.php";
$result = mysqli_query($conn, "SELECT * FROM program_pelayanan ORDER BY no DESC");
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['no'])) {
  $no = $_GET['no'];

  $stmt = $conn->prepare("DELETE FROM program_pelayanan WHERE no = ?");
  $stmt->bind_param("i", $no);

  if ($stmt->execute()) {
    header("Location: program_pelayanan.php?status=deleted");
    exit;
  } else {
    die("Error menghapus data: " . $stmt->error);
  }
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<!--
Template: Metronic Frontend Freebie - Responsive HTML Template Based On Twitter Bootstrap 3.3.4
Version: 1.0.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase Premium Metronic Admin Theme: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->

<head>
  <meta charset="utf-8">
  <title>Frequently Asked Questions | Metronic Frontend</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="favicon.ico">

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="style.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Merriweather:wght@400;700&display=swap"
    rel="stylesheet">

  <!-- Fonts START -->
  <link
    href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all"
    rel="stylesheet" type="text/css">
  <!-- Fonts END -->

  <!-- Global styles START -->
  <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END -->

  <!-- Page level plugin styles START -->
  <link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="assets/pages/css/components.css" rel="stylesheet">
  <link href="oke.css" rel="stylesheet">
  <link href="assets/corporate/css/style.css" rel="stylesheet">
  <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="assets/corporate/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->
  <style>
    .menu-search {
      position: relative;
    }

    .search-box {
      display: none;
      position: absolute;
      right: 0;
      top: 30px;
      background: white;
      padding: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      z-index: 1000;
    }

    .search-box.active {
      display: block;
    }
    .table-warning{
      background-color:rgb(224, 107, 10);
      color: white;
    }
    .search-btn {
      cursor: pointer;
    }


    .site-logo {
      flex-shrink: 0;
    }

    /* Search box styling */
    .menu-search {
      position: relative;
      margin-left: 20px;
      display: flex;
      align-items: center;
    }

    .search-box {
      display: none;
      position: absolute;
      right: 0;
      top: 100%;
      background: white;
      padding: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      z-index: 1000;
    }

    .search-box.active {
      display: block;
    }

    .search-btn {
      cursor: pointer;
      font-size: 18px;
      color: #333;
      transition: color 0.3s;
      padding: 10px 15px;
    }

    .search-btn:hover {
      color: #0066cc;
    }
  </style>

  <!-- JavaScript -->
  <script>
    document.querySelector('.search-btn').addEventListener('click', function () {
      document.querySelector('.search-box').classList.toggle('active');
    });
  </script>

</head>
<!-- Head END -->

<!-- Body BEGIN -->
<div class="corporate">
  <?php include "templates/navigation.php"; ?>


  <div class="main">
    <div class="container">
      
      <div class="row margin-bottom-40">
        <!-- BEGIN CONTENT -->
        <div class="col-md-12 col-sm-12">
          <div class="container mt-4">
            <div class="main-content" style="margin-top: 1.5rem;">
              <h2 class="text-primary">
                <center><strong>Program Pelayanan</strong></center>
              </h2>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead class="table-warning">
                    <tr>
                      <th class="text-center">No.</th>
                      <th class="text-center">Uraian</th>
                      <th class="text-center">Bentuk</th>
                      <th class="text-center">Waktu Pelaksanaan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                      <?php $no = 1; ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo htmlspecialchars($row['uraian']); ?></td>
                          <td><?php echo htmlspecialchars($row['bentuk']); ?></td>
                          <td><?php echo htmlspecialchars($row['waktu_pelaksanaan']); ?></td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="5" style="text-align: center;">Belum ada Program Pelayanan</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- END CONTENT -->

<!-- BEGIN PRE-FOOTER -->
<?php include "templates/footer.php"; ?>
<!-- END PRE-FOOTER -->

<!-- BEGIN FOOTER -->
<div class="footer">
  <div class="container">
    <div class="row">
      <!-- BEGIN COPYRIGHT -->
      <div class="col-md-4 col-sm-4 padding-top-10">
        2015 © Keenthemes. ALL Rights Reserved. <a href="javascript:;">Privacy Policy</a> | <a href="javascript:;">Terms
          of Service</a>
      </div>
      <!-- END COPYRIGHT -->
      <!-- BEGIN PAYMENTS -->
      <div class="col-md-4 col-sm-4">
        <ul class="social-footer list-unstyled list-inline pull-right">
          <li><a href="javascript:;"><i class="fa fa-facebook"></i></a></li>
          <li><a href="javascript:;"><i class="fa fa-google-plus"></i></a></li>
          <li><a href="javascript:;"><i class="fa fa-dribbble"></i></a></li>
          <li><a href="javascript:;"><i class="fa fa-linkedin"></i></a></li>
          <li><a href="javascript:;"><i class="fa fa-twitter"></i></a></li>
          <li><a href="javascript:;"><i class="fa fa-skype"></i></a></li>
          <li><a href="javascript:;"><i class="fa fa-github"></i></a></li>
          <li><a href="javascript:;"><i class="fa fa-youtube"></i></a></li>
          <li><a href="javascript:;"><i class="fa fa-dropbox"></i></a></li>
        </ul>
      </div>
      <!-- END PAYMENTS -->
      <!-- BEGIN POWERED -->

      <!-- END POWERED -->
    </div>
  </div>
</div>
<!-- END FOOTER -->

<!-- Load javascripts at bottom, this will reduce page load time -->
<!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>
    <![endif]-->
<script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/corporate/scripts/back-to-top.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
<script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->

<script src="assets/corporate/scripts/layout.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function () {
    Layout.init();
    Layout.initTwitter();
  });
</script>
<!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>