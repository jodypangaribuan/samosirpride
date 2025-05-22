<?php
include "php/koneksi.php";
$result = mysqli_query($conn, "SELECT a.*, u.username as admin_name 
                              FROM ayat_harian a 
                              JOIN users u ON a.user_id = u.id 
                              ORDER BY a.id DESC");

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT gambar FROM ayat_harian WHERE id = $id";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);

    $stmt = $conn->prepare("DELETE FROM ayat_harian WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ayat_harian.php?status=deleted");
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

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">

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
  <!-- Theme styles END -->
  <style>
    .table-container {
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2c7be5;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .section-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

     .container1   {
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
        .header-navigation-container {
  display: flex;
  align-items: center;
  gap: 30px;
}

.site-logo {
  flex-shrink: 0;
}

.header-navigation ul {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: 20px;
}

.header-navigation li {
  position: relative;
}

.header-navigation li a {
  display: block;
  padding: 10px 0;
  color: #333;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s;
}

.header-navigation li a:hover {
  color: #0066cc;
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

.header-navigation li a {
  border-bottom: 2px solid transparent;
  transition: all 0.3s;
}

.header-navigation li a:hover,
.header-navigation li a.active {
  border-bottom-color: #0066cc;
}
.ayat-container {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
            padding: 5px;
            text-align: center;
            height: 20px;
            font: 10px;
        }
        .ayat-footer h2 {
          font-size: 12px;
         
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
                flex-direction: column;
            }
            
            .ayat-image {
                min-height: 200px;
            }
        }
  </style>
  
  <!-- JavaScript -->
  <script>
  document.querySelector('.search-btn').addEventListener('click', function() {
      document.querySelector('.search-box').classList.toggle('active');
  });
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="php/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">
        
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate">

    <!-- BEGIN STYLE CUSTOMIZER -->
    
    <!-- END BEGIN STYLE CUSTOMIZER --> 

    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-phone"></i><span>+6282162118932</span></li>
                        <li><i class="fa fa-envelope-o"></i><span>info@keenthemes.com</span></li>
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        <li><a href="login.html">Log In</a></li>
                        <li><a href="page-reg-page.html">Registration</a></li>
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->
    <!-- BEGIN HEADER -->
    <div class="header">
  <div class="container">
    <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
    <!-- BEGIN NAVIGATION -->
    <div class="header-navigation-container">
      <div class="site-logo">
        <a href="index.html">
          <img src="assets/corporate/img/logos/LOGO HKBP.png" width="80" alt="Logo" class="logo-img">
        </a>
      </div>
      <div class="header-navigation">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li class="dropdown">
            <a href="javascript:;">Tentang</a>
            <ul class="dropdown-menu">
              <li><a href="Visi&misi.html">Visi & Misi</a></li>
              <li><a href="sejarah gereja.html">Sejarah gereja</a></li>
              <li><a href="program pelayanan.php">Program Pelayanan</a></li>
              <li><a href="Galeri.php">Galeri</a></li>
            </ul>
          </li>
          <li><a href="jemaat.php">Jemaat</a></li>
          <li><a href="Warta Jemaat.php">Warta jemaat</a></li>
          <li><a href="Struktur Gereja.php">Struktur gereja</a></li>
          <li class="dropdown">
            <a href="javascript:;">Kegiatan Gereja</a>
            <ul class="dropdown-menu">
              <li><a href="Koor.php">Koor</a></li>
              <li><a href="Event.php">Event</a></li>
              <li><a href="Remaja Naposo.php">Remaja Naposo</a></li>
            </ul>
          </li>
          <li><a href="Peta.html">Peta/Maps</a></li>
          <li class="menu-search">
            <i class="fa fa-search search-btn"></i>
            <div class="search-box">
              <form>
                <input type="text" placeholder="Search...">
                <button type="submit"><i class="fa fa-search"></i></button>
              </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!-- END NAVIGATION -->
  </div>
</div>

    <!-- Header END -->



     
  
    


            <!-- Daftar Ayat Harian -->
            <div class="main-content" style="margin-top: 1.5rem;">
                <h2 class="section-title" style="font-weight:bold;">Daftar Ayat Harian</h2>


<div class="table-container">
<table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Referensi</th>
                                <th>Ayat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo date('d M Y', strtotime($row['tanggal_dibuat'])); ?></td>
                                        <td><?php echo htmlspecialchars($row['referensi']); ?></td>
                                        <td><?php echo htmlspecialchars($row['ayat']); ?></td>
                                        
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align: center;">Belum ada data ayat</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
</div>

      

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
    <div class="pre-footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN BOTTOM ABOUT BLOCK -->
          <div class="col-md-4 col-sm-6 pre-footer-col">
            <h2>Alamat</h2>
            <p>Jl. Ujung 22351, Jl. D.I Panjaitan, Lumban Bulbul, Kec. Balige, Toba, Sumatera Utara 22312</p>

            <div class="photo-stream">
              <h2>Album Foto</h2>
              <ul class="list-unstyled">
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.10.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.11.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.12.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.13.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.14.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.15.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.16.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.6.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.7.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.3.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.4.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.5.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.1.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.2.jpg"></a></li>
                <li><a href="javascript:;"><img alt="" src="assets/pages/img/frontend-slider/Kegiatan/Gambar 1.8.jpg"></a></li>
              </ul>                    
            </div>
          </div>
          <!-- END BOTTOM ABOUT BLOCK -->

          <!-- BEGIN BOTTOM CONTACTS -->
          <div class="col-md-4 col-sm-6 pre-footer-col">
            <h2>Our Contacts</h2>
            <address class="margin-bottom-40">
              Pdt Hasannudin
              (081361589112)<br>
              St. H Siahaan
            (082162118932)<br>
            St. F Simangunsong
            (082161746898)<br>
          </div>
          <!-- END BOTTOM CONTACTS -->

          <!-- BEGIN TWITTER BLOCK --> 
          <div class="col-md-4">
            <div>
              <img alt="Gambar HKBP Tiberias Lumban Bulbul" src="assets/corporate/img/logos/LOGO HKBP.png" style="width: 330px; height: 330px;">
            </div>
          <!-- END TWITTER BLOCK -->
        </div>
      </div>
    </div>
    <!-- END PRE-FOOTER -->

    <!-- BEGIN FOOTER -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN COPYRIGHT -->
          <div class="col-md-4 col-sm-4 padding-top-10">
            2015 © Keenthemes. ALL Rights Reserved. <a href="javascript:;">Privacy Policy</a> | <a href="javascript:;">Terms of Service</a>
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
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initTwitter();
        });
    </script>
    <script>
      function searchContent() {
          var input = document.getElementById("searchInput").value.toLowerCase(); // Ambil input
          var body = document.body; // Ambil body halaman
          var content = body.innerHTML; // Ambil seluruh isi halaman
          var searchResults = document.getElementById("searchResults");
      
          if (input === "") {
              alert("Masukkan kata kunci untuk mencari.");
              return false;
          }
      
          // Reset teks yang sebelumnya disorot
          var cleanContent = content.replace(/<span class="highlight">(.*?)<\/span>/g, "$1");
          
          // Jika kata ditemukan
          if (cleanContent.toLowerCase().includes(input)) {
              var highlightedContent = cleanContent.replace(new RegExp(input, "gi"), match => {
                  return `<span class="highlight">${match}</span>`;
              });
      
              body.innerHTML = highlightedContent;
              searchResults.innerHTML = `<p>Ditemukan hasil untuk: <strong>${input}</strong></p>`;
          } else {
              searchResults.innerHTML = `<p>Tidak ada hasil ditemukan untuk: <strong>${input}</strong></p>`;
          }
      
          return false; // Mencegah reload halaman
      }
      
      // Tambahkan CSS untuk highlight
      var style = document.createElement("style");
      style.innerHTML = ".highlight { background-color: yellow; font-weight: bold; }";
      document.head.appendChild(style);
      </script>
      
      
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>