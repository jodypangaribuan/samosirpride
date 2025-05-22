<?php
include "php/koneksi.php";

// Proses hapus data jika action = delete dan id tersedia
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Cek apakah ID valid
    if ($id > 0) {
        // Ambil nama file gambar sebelum hapus dari database
        $query = "SELECT gambar FROM galeri WHERE id = $id";
        $img_result = mysqli_query($conn, $query);

        if ($img_data = mysqli_fetch_assoc($img_result)) {
            $stmt = $conn->prepare("DELETE FROM galeri WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Hapus file gambar dari folder uploads
                if (!empty($img_data['gambar']) && file_exists("php/uploads/" . $img_data['gambar'])) {
                    unlink("php/uploads/" . $img_data['gambar']);
                }
                header("Location: galeri.php?status=success&message=" . urlencode("Galeri berhasil dihapus"));
                exit;
            } else {
                die("Gagal menghapus data: " . $stmt->error);
            }
        } else {
            header("Location: galeri.php?status=error&message=" . urlencode("Data tidak ditemukan"));
            exit;
        }
    } else {
        header("Location: galeri.php?status=error&message=" . urlencode("ID tidak valid"));
        exit;
    }
}

// Ambil semua data event galeri
$result = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");

// Cek halaman aktif
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
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
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
<!-- Head END -->
<style>
  .gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; /* Jarak antar gambar */
    justify-content: center;
  }
  .gallery img {
    width: 300;
    height: 300;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.2s ease;
    border-radius: 10px;
  }
  .gallery img:hover {
    transform: scale(1.05); /* Efek zoom kecil saat hover */
  }
  .container {
    text-align: center;
  }
  .profile-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 200px; /* Lebar maksimum agar gambar dan teks tetap sejajar */
    margin: 0 auto; /* Pusatkan */
  }
  .rounded-image {
    border-radius: 50%;
    width: 200px;
    height: 200px;
    object-fit: cover;
  }
  .event-card {
    margin-top: -20px; /* Menyesuaikan agar teks dekat dengan gambar */
    padding: 10px;
    border: 1px solid black;
    background-color: #f0f0f0;
    display: inline-block;
    border-radius: 20px; /* Agar lebih estetis */
    max-width: 200px;
  }
      .event-card img {
          width: auto;
          height: auto; /* Sesuaikan tinggi gambar */
          object-fit: cover;
          border: 2px solid black;
          text-align: center;
      }
      .event-title {
          background-color: #dee2e6;
          padding: 10px;
          font-weight: bold;
          border: 2px solid black;
          text-align: center;
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
.galeri-container {
        max-width: 1100px;
        margin: auto;
        padding: 20px;
        text-align: center;
    }

    .galeri-container h2 {
        font-size: 28px;
        color: #2c65c8;
        margin-bottom: 20px;
    }

    .galeri-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
    }

    .galeri-item {
        width: 250px;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 10px;
        background: #fff;
        position: relative;
    }

    .galeri-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 6px;
    }

    .caption {
        margin-top: 10px;
        background: #eef4fa;
        padding: 8px;
        font-size: 14px;
        color: #1b3a57;
        font-weight: bold;
        border-radius: 6px;
    }

    .action-buttons {
        margin-top: 10px;
    }

    .action-buttons button {
        margin: 0 3px;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

 /* galeri */
 
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
   
</style>

<!-- JavaScript -->
<script>
document.querySelector('.search-btn').addEventListener('click', function() {
    document.querySelector('.search-box').classList.toggle('active');
});
</script>

<!-- Body BEGIN -->
<body class="corporate">
    <?php include "templates/navigation.php"; ?>
    <!-- Header END -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script> 
    <h1 style="color: #2c65c8;"><center><strong>Galeri Gereja HKBP TIBERIAS</strong></center></h1>
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
                        <p>Belum ada galeri ditambahkan.</p>
                    <?php endif; ?>
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
    jQuery(document).ready(function() {
        Layout.init();    
        Layout.initTwitter();
    });
</script>
<!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>