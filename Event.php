<?php
include "php/koneksi.php";
$result = mysqli_query($conn, "SELECT * FROM event_galeri ORDER BY id DESC");

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // First get the image filename to delete it from server
    $query = "SELECT gambar FROM event_galeri WHERE id = $id";
    $img_result = mysqli_query($conn, $query);
    $img_data = mysqli_fetch_assoc($img_result);
    
    $stmt = $conn->prepare("DELETE FROM event_galeri WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Delete the image file if it exists
        if (!empty($img_data['gambar']) && file_exists("uploads/" . $img_data['gambar'])) {
            unlink("uploads/" . $img_data['gambar']);
        }
        header("Location: event_galeri.php?status=success&message=" . urlencode("Event Galeri berhasil dihapus"));
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
  <style>
     .gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-top: 20px;
}

.gallery-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.gallery-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.image-placeholder {
    width: 100%;
    height: 250px;
    background: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.gallery-caption {
    padding: 10px 15px;
}

.gallery-title {
    font-size: 16px;
    font-weight: bold;
    margin: 8px 0 5px;
}

.gallery-description {
    font-size: 14px;
    color: #555;
    margin-bottom: 10px;
}

.gallery-actions {
    margin-bottom: 15px;
}

.btn-edit, .btn-delete {
    background: #007bff;
    border: none;
    padding: 8px 12px;
    color: white;
    font-size: 14px;
    margin: 3px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-delete {
    background: #dc3545;
}

.btn-edit:hover, .btn-delete:hover {
    opacity: 0.8;
}

/* Responsive */
@media (max-width: 768px) {
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .gallery-grid {
        grid-template-columns: 1fr;
    }
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
  box-shadow: 0 5px 10px rgba(0,0,0,0.1);
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s;
  z-index: 1000;
}

.dropdown:hover .dropdown-menu {
  opacity: 1;
  visibility: visible;
}

/* Search box styling */
.menu-search {
  position: relative;
}

.search-box {
  position: absolute;
  right: 0;
  top: 100%;
  background: white;
  padding: 10px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.1);
  display: none;
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
document.querySelector('.search-btn').addEventListener('click', function() {
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
                              HKBP TIBERIAS <br/>
                              <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
                          </h2>
                          <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">"SEGALA KEMULIAAN HANYA BAGI ALLAH" </p>
                      </div>
                  </div>
              </div>
              
              <!-- Second slide -->
              <div class="item carousel-item-nine">
                  <div class="container">
                      <div class="carousel-position-six text-center">
                           <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInDown">
                              HKBP TIBERIAS <br/>
                              <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
                          </h2>
                          <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">"SEGALA KEMULIAAN HANYA BAGI ALLAH" </p>
                      </div>
                  </div>
              </div>

              <!-- Third slide -->
              <div class="item carousel-item-ten">
                  <div class="container">
                      <div class="carousel-position-six text-center">
                        <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInDown">
                          HKBP TIBERIAS <br/>
                          <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
                      </h2>
                      <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">"SEGALA KEMULIAAN HANYA BAGI ALLAH" </p>
                      </div>
                  </div>
              </div>
          </div>
          <a class="left carousel-control carousel-control-shop carousel-control-frontend" href="#carousel-example-generic" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>
        <a class="right carousel-control carousel-control-shop carousel-control-frontend" href="#carousel-example-generic" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </a>
    </div>
</div>

    <!-- isi -->
    

    <div class="container mt-4">
      <h1 style="color: #007bff"><center><strong>Event di HKBP Tiberias</strong></center></h1>
      <div class="gallery-grid">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="gallery-card">
                    <?php
                    $imagePath = "php/uploads/" . htmlspecialchars($row['gambar']);
                    if (!empty($row['gambar']) && file_exists($imagePath)) {
                        echo '<img src="'.$imagePath.'" alt="'.htmlspecialchars($row['nama']).'" class="gallery-image">';
                    } else {
                        echo '<div class="image-placeholder">
                            <i class="fas fa-image fa-3x"></i>
                            <p>Gambar tidak ditemukan</p>
                        </div>';
                    }
                    ?>
                    <div class="gallery-caption">
                        <h3 class="gallery-title"><?php echo htmlspecialchars($row['nama']); ?></h3>
                        <p class="gallery-description"><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Belum ada foto ditambahkan.</p>
        <?php endif; ?>
    </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <div style="padding-bottom: 20px;" style="margin-bottom: 20px;"></div>
    
    


<!-- BEGIN PRE-FOOTER -->
<?php include "templates/footer.php"; ?><!-- END FOOTER -->

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
    jQuery(document).ready(function() {
        Layout.init();    
        Layout.initTwitter();
    });
</script>
<!-- END PAGE LEVEL JAVASCRIPTS -->
  <!-- search -->
   <script>
  document.querySelector('.search-btn').addEventListener('click', function(e) {
  e.preventDefault();
  document.querySelector('.search-box').classList.toggle('active');
}); 
</script>
</body>
<!-- END BODY -->
</html>