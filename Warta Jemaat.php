<?php
include "php/koneksi.php";

// Proses hapus data jika action = delete dan id tersedia
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
  $id = (int) $_GET['id'];

  // Cek apakah ID valid
  if ($id > 0) {
    // Ambil nama file PDF sebelum hapus dari database
    $query = "SELECT file_pdf FROM warta_jemaat WHERE id = $id";
    $file_result = mysqli_query($conn, $query);

    if ($file_data = mysqli_fetch_assoc($file_result)) {
      $stmt = $conn->prepare("DELETE FROM warta_jemaat WHERE id = ?");
      $stmt->bind_param("i", $id);

      if ($stmt->execute()) {
        // Hapus file PDF dari folder uploads
        $file_path = "php/uploads/warta_jemaat/" . $file_data['file_pdf'];
        if (!empty($file_data['file_pdf']) && file_exists($file_path)) {
          unlink($file_path);
        }
        header("Location: warta_jemaat.php?status=success&message=" . urlencode("Warta Jemaat berhasil dihapus"));
        exit;
      } else {
        die("Gagal menghapus data: " . $stmt->error);
      }
    } else {
      header("Location: warta_jemaat.php?status=error&message=" . urlencode("Data tidak ditemukan"));
      exit;
    }
  } else {
    header("Location: warta_jemaat.php?status=error&message=" . urlencode("ID tidak valid"));
    exit;
  }
}

// Ambil semua data warta jemaat tanpa filter user_id
$query = "SELECT * FROM warta_jemaat ORDER BY id DESC";
$result = mysqli_query($conn, $query);
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
  <link href="oke.css" rel="stylesheet">
  <link href="assets/pages/css/slider.css" rel="stylesheet">
  <link href="assets/corporate/css/style.css" rel="stylesheet">
  <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="assets/corporate/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->
  <style>
    .warta-container {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .warta-title {
      font-size: 24px;
      font-weight: bold;
      color: #333;
      margin-bottom: 20px;
    }

    .warta-date {
      font-size: 16px;
      color: #666;
      margin-bottom: 20px;
    }

    .warta-content {
      font-size: 14px;
      color: #444;
    }

    .warta-content ul {
      list-style-type: disc;
      padding-left: 20px;
    }

    .warta-content ul li {
      margin-bottom: 10px;
    }

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

    .search-btn {
      cursor: pointer;
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
  <div class="container">
    <div class="warta-container">
    <div class="warta-title" style="color: rgb(224, 107, 10);">Warta Jemaat HKBP Tiberias</div>
    
         <div style="font-size: 15px; line-height: 1.6; color: #333;">
        <h2 style="font-size: 20px; color: #1a3e72; border-bottom: 2px solid #1a3e72; padding-bottom: 5px; display: inline-block;">
           
        </h2>
        
        <div style="margin-top: 1px;">
            <p>Berikut adalah pengumuman dan informasi terkini:</p>
            
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Ibadah Minggu:</strong> Setiap pukul 07.00 WIB dan 10.00 WIB di Gereja.</li>
                <li style="margin-bottom: 10px;"><strong>Persekutuan Doa:</strong> Jumat pukul 18.00 WIB (Pemuda) & Sabtu pukul 17.00 WIB (Kelompok Kategorial).</li>
                <li style="margin-bottom: 10px;"><strong>Pelayanan Sosial:</strong> Kunjungan rutin ke jemaat yang membutuhkan.</li>
                <li style="margin-bottom: 10px;"><strong>Pendaftaran Katekisasi:</strong> Dibuka setiap bulan pertama.</li>
            </ul>
        </div>
    </div>
    </div>
  </div>



  <div class="col-md-12 col-sm-12">
    <div class="container mt-4">
      <h2 class="text-primary">
        <center><strong>Warta Jemaat / Tingting</strong></center>
      </h2>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-warning">
            <tr>
              <th class="text-center">No.</th>
              <th class="text-center">Judul</th>
              <th class="text-center">Keterangan</th>
              <th class="text-center">FILE PDF</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
              <?php $id = 1; ?>
              <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?= $id++; ?></td>
                  <td><?= htmlspecialchars($row['judul']); ?></td>
                  <td><?= htmlspecialchars($row['keterangan']); ?></td>
                  <td>
                    <?php if (!empty($row['file_pdf'])): ?>
                      <a href="php/uploads/warta_jemaat/<?= htmlspecialchars($row['file_pdf']); ?>" target="_blank">Lihat
                        PDF</a>
                    <?php else: ?>
                      Tidak ada
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="4">Tidak ada data warta jemaat.</td>
              </tr>
            <?php endif; ?>
          </tbody>

        </table>
      </div>
    </div>



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
      <script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
      <!-- pop up -->

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