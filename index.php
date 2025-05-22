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
  <!-- Theme styles END -->
  <style>
    .container1 {
      display: flex;
      border-bottom: 2px solid #ccc;
      padding: 20px;
    }

    .image {
      flex: 1;
      margin-right: 20px;
    }

    .image img {
      width: 100%;
      max-width: 300px;
      height: auto;
      right: 30px;
    }

    .content {
      flex: 2;
    }

    .tag {
      background-color: #00d1d1;
      color: white;
      padding: 5px 10px;
      display: inline-block;
      font-size: 12px;
      margin-bottom: 10px;
      font-weight: bold;
    }
    .table-warning{
      background-color:rgb(224, 107, 10);
      color: white;
    }
    .title {
      font-size: 20px;
      font-weight: bold;
    }

    .verse {
      margin: 10px 0;
    }

    .meta {
      font-size: 12px;
      color: gray;
    }

    .site-logo {
      flex-shrink: 0;
    }

    /* Dropdown styling */
    .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      background: white;
      min-width: 200px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s;
      z-index: 1000;
    }

    .dropdown:hover .dropdown-menu {
      opacity: 1;
      visibility: visible;
    }


    .ayat-container {
      max-width: 900px;
      margin: 30px auto;
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .ayat-header {
      background-color: #2c7be5;
      color: white;
      padding: 20px;
      text-align: center;
    }

    .ayat-footer {
      background-color: #2c7be5;
      color: white;
      padding: 10px;
      text-align: center;
      height: 35px;
      font: 10px;
      color: #ccc;
    }

    .ayat-footer h2 {
      font-size: 15px;

    }

    .ayat-footer a {
      color: white;

    }

    .ayat-header h2 {
      margin: 0;
      font-size: 24px;
    }

    .ayat-content {
      display: flex;
      flex-direction: row;
    }

    .ayat-image {
      flex: 1;
      min-height: 300px;
      background-size: cover;
      background-position: center;
    }

    .ayat-text {
      flex: 1;
      padding: 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .ayat-quote {
      font-size: 22px;
      line-height: 1.6;
      margin-bottom: 20px;
      font-style: italic;
      color: #555;
    }

    .ayat-reference {
      font-size: 18px;
      font-weight: bold;
      color: #2c7be5;
      margin-bottom: 15px;
    }

    .ayat-meaning {
      font-size: 16px;
      line-height: 1.5;
      color: #666;
      margin-bottom: 20px;
    }

    .ayat-date {
      font-size: 14px;
      color: #888;
      text-align: right;
      margin-top: 20px;
    }

    .divider {
      width: 80px;
      height: 3px;
      background-color: #2c7be5;
      margin: 15px 0;
    }

    @media (max-width: 768px) {
      .ayat-content {
        flex-directbon: column;
      }

      .ayat-image {
        min-height: 200px;
      }
    }
  </style>
  <link rel="stylesheet" href="php/style10.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Merriweather:wght@400;700&display=swap"
    rel="stylesheet">
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

      <!-- Controls -->
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
  </div>

  <!-- END SLIDER -->


  <div class="main">
    <?php
    include "php/koneksi.php";

    // Correct the table name in the query
    $query = "SELECT a.*, u.username 
          FROM ayat_harian a 
          JOIN users u ON a.user_id = u.id
          ORDER BY a.tanggal_dibuat DESC 
          LIMIT 1";
    $result = mysqli_query($conn, $query);

    // Check if the query executed successfully
    if (!$result) {
      die("Error dalam query: " . mysqli_error($conn));
    }

    $ayat_harian = mysqli_fetch_assoc($result);

    // If no data is found, provide default values
    if (!$ayat_harian) {
      $ayat_harian = [
        'ayat' => 'Tidak ada ayat harian untuk hari ini',
        'referensi' => 'Tidak ada referensi',
        'penjelasan' => 'Silakan tambahkan ayat harian melalui admin panel',
        'tanggal_dibuat' => date('Y-m-d')
      ];
    }
    ?>

    <div class="ayat-container">
      <div class="ayat-header">
        <h2>AYAT HARIAN</h2>
      </div>

      <div class="ayat-content">
        <!-- Gambar Ayat -->
        <div class="ayat-image">
          <img src="php/uploads/ayat/Gambar ayat harian 1.1.jpg" alt="Gambar Ayat"
            style="width: 100%; height: auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        </div>

        <!-- Teks Ayat -->
        <div class="ayat-text">
          <div class="ayat-quote">"<?php echo htmlspecialchars($ayat_harian['ayat']); ?>"</div>
          <div class="divider"></div>
          <div class="ayat-reference"><?php echo htmlspecialchars($ayat_harian['referensi']); ?></div>
          <div class="ayat-date">
            <?php echo date('l, d F Y', strtotime($ayat_harian['tanggal_dibuat'])); ?>
          </div>
        </div>
      </div>
      <div class="ayat-footer">
        <h2><b><a href="ayat_harian.php">Ayat Harian Sebelumnya</a></b></h2>
      </div>
    </div>

    <div class="container" style="padding: 30px">
      <h1 class="text-judul"><b>Syalom
          Selamat Datang di website HKBP Tiberias Lumban Bul-Bul</b></h1>

      <!-- Kata Pengantar-->
      <div class="row recent-work margin-bottom-40" style="font-size: 16px;">
        <div class="col-md-6" style="text-align: justify;">

          <p>HKBP Tiberias Lumban Bulbul adalah salah satu gereja Protestan yang menjadi bagian dari Huria Kristen Batak
            Protestan (HKBP). Terletak di Lumban Bulbul, Balige. Gereja ini berperan sebagai tempat ibadah serta pusat
            persekutuan bagi jemaat dalam bertumbuh di dalam iman kepada Kristus.</p>
          <p>Sebagai gereja yang aktif, HKBP Tiberias Lumban Bulbul menyelenggarakan berbagai kegiatan rohani seperti
            ibadah mingguan, pelayanan kasih, persekutuan doa, sekolah minggu, serta kegiatan untuk remaja dan pemuda.
            Kami percaya bahwa gereja bukan hanya tempat untuk beribadah, tetapi juga rumah bagi setiap umat untuk
            bertumbuh dalam kasih dan pengenalan akan Tuhan.</p>
          <p>Melalui website ini, Anda dapat menemukan informasi tentang jadwal ibadah, renungan harian, berita gereja,
            serta berbagai kegiatan yang dapat memperkuat iman dan kebersamaan kita sebagai umat Tuhan.</p>
          <p><em>"Hendaklah kamu berakar di dalam Dia dan dibangun di atas Dia, hendaklah kamu bertambah teguh dalam
              iman yang telah diajarkan kepadamu, dan hendaklah hatimu melimpah dengan syukur." (Kolose 2:7)</em></p>
          <p>Kami mengundang Anda untuk bergabung dalam persekutuan kami, bertumbuh bersama dalam kasih Tuhan, dan
            menjadi berkat bagi sesama.</p>
          <p><strong>✨ Tuhan Yesus memberkati! ✨</strong></p>
        </div>
        <div class="col-md-6">
          <div>
            <img alt="Gambar HKBP Tiberias Lumban Bulbul" src="assets/pages/img/frontend-slider/Gambar 7.jpg"
              class="img-fluid">
          </div>
        </div>
      </div>



      <!-- BEGIN SERVICE BOX -->
      <!-- END SERVICE BOX -->
      <!-- BEGIN BLOCKQUOTE BLOCK -->
      <!-- END BLOCKQUOTE BLOCK -->
      <!-- Kata Pengantar -->
      <!-- Jadwal Ibadah -->

      <?php
      include "php/koneksi.php";
      $result = mysqli_query($conn, "SELECT * FROM jadwal_ibadah ORDER BY id DESC");
      if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $conn->prepare("DELETE FROM jadwal_ibadah WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
          header("Location: jadwal_ibadah.php?status=deleted");
          exit;
        } else {
          die("Error menghapus data: " . $stmt->error);
        }
      }
      $current_page = basename($_SERVER['PHP_SELF']);
      ?>
      <div class="container mt-4">
        <h2 class="text-primary">
          <center><b>Jadwal Ibadah HKBP Tiberias</b></center>
        </h2>
        <div class="text-center">
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead class="table-warning">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">IBADAH</th>
                  <th class="text-center">HARI</th>
                  <th class="text-center">KETERANGAN</th>
                </tr>
              </thead>
              <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                  <?php $id = 1; ?>
                  <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                      <td><?php echo $id++; ?></td>
                      <td><?php echo htmlspecialchars($row['ibadah']); ?></td>
                      <td><?php echo htmlspecialchars($row['hari']); ?></td>
                      <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" style="text-align: center;">Belum ada data Jadwal Ibadah</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>


      <!-- Jadwal Ibadah -->

      <!-- Sejarah Gereja-->


      <!-- Sejarah Gereja-->


      <!-- BEGIN TABS AND TESTIMONIALS -->

      <!-- END TABS -->

      <!-- TESTIMONIALS -->

      <!-- Carousel nav -->
      <a class="left-btn" href="#myCarousel" data-slide="prev"></a>
      <a class="right-btn" href="#myCarousel" data-slide="next"></a>
    </div>
  </div>
  <!-- END TESTIMONIALS -->
  </div>
  <!-- END TABS AND TESTIMONIALS -->

  <!-- BEGIN STEPS -->

  <!-- END STEPS -->

  <!-- BEGIN CLIENTS -->

  <!-- END CLIENTS -->
  </div>
  </div>

  <!-- BEGIN PRE-FOOTER -->
  <?php include "templates/footer.php"; ?>
  </div>
  </div>

  <!-- END FOOTER -->

  <!-- Load javascripts at bottom, this will reduce page load time -->
  <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
  <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>
    <![endif]-->
  <script>
    function toggleBox(element) {
      element.classList.toggle('active');
    }
  </script>
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