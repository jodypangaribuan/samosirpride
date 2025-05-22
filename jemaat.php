<?php
include "php/koneksi.php";
$result = mysqli_query($conn, "SELECT * FROM jemaat ORDER BY id DESC");
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
  $id = $_GET['id'];

  $stmt = $conn->prepare("DELETE FROM jemaat WHERE id = ?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    header("Location: jemaat.php?status=deleted");
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
  <title>HKBP TIberias </title>

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
  <link href="assets/pages/css/animate.css" rel="stylesheet">
  <link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <link href="assets/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="assets/pages/css/components.css" rel="stylesheet">
  <link href="assets/pages/css/slider.css" rel="stylesheet">
  <link href="assets/corporate/css/style.css" rel="stylesheet">
  <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="assets/corporate/css/custom.css" rel="stylesheet">
  <link href="oke.css" rel="stylesheet">
  <!-- Theme styles END -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

</head>
<style>
   .table-warning{
      background-color:rgb(224, 107, 10);
      color: white;
    }
</style>
<!-- Head END -->


<!-- JavaScript -->


<!-- Body BEGIN -->

<body class="corporate">
  <?php include "templates/navigation.php"; ?>
  <!-- BEGIN SLIDER -->
  <div class="page-slider margin-bottom-40">
    <div id="carousel-example-generic" class="carousel slide carousel-slider">
      <!-- Indicators -->
      <ol class="carousel-indicators carousel-indicators-frontend">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <!-- First slide -->
        <div class="item carousel-item-eight active">
          <div class="container">
            <div class="carousel-position-six text-uppercase text-center">
              <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInDown">
                HKBP TIBERIAS <br />
                <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
              </h2>
              <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">
                "SEGALA KEMULIAAN HANYA BAGI ALLAH" </p>
            </div>
          </div>
        </div>

        <!-- Second slide -->
        <div class="item carousel-item-nine">
          <div class="container">
            <div class="carousel-position-six text-center">
              <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInDown">
                HKBP TIBERIAS <br />
                <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
              </h2>
              <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">
                "SEGALA KEMULIAAN HANYA BAGI ALLAH" </p>
            </div>
          </div>
        </div>

        <!-- Third slide -->
        <div class="item carousel-item-ten">
          <div class="container">
            <div class="carousel-position-six text-center">
              <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInDown">
                HKBP TIBERIAS <br />
                <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
              </h2>
              <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">
                "SEGALA KEMULIAAN HANYA BAGI ALLAH" </p>
            </div>
          </div>
        </div>
      </div>

      <a class="left carousel-control carousel-control-shop carousel-control-frontend" href="#carousel-example-generic"
        role="button" data-slide="prev">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
      </a>
      <a class="right carousel-control carousel-control-shop carousel-control-frontend" href="#carousel-example-generic"
        role="button" data-slide="next">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
      </a>
    </div>
  </div>

  <!-- isi -->
  <div class="container mt-4">
    <h2 class="text-primary">
      <center><b>Daftar Jemaat</b></center>
    </h2>
    <div class="text-center">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-warning">
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Nama</th>
              <th class="text-center">Jenis-Kelamin</th>
              <th class="text-center">Tempat Lahir</th>
              <th class="text-center">Tanggal Lahir</th>
              <th class="text-center">Alamat</th>
              <th class="text-center">Nomor-Telepon</th>
            </tr>
          <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
              <?php $id = 1; ?>
              <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?php echo $id++; ?></td>
                  <td><?php echo htmlspecialchars($row['nama']); ?></td>
                  <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                  <td><?php echo htmlspecialchars($row['tempat_lahir']); ?></td>
                  <td><?php echo htmlspecialchars($row['tanggal_lahir']); ?></td>
                  <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                  <td><?php echo htmlspecialchars($row['nomor_telepon']); ?></td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" style="text-align: center;">Belum ada data jemaat</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>








  <!--Membuat jarah antara footer dengan yang di atas-->
  <div style="height: 50px;"></div>
  <!-- BEGIN PRE-FOOTER -->
  <?php include "templates/footer.php"; ?>
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