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
  <title>Search Results | Metronic Frontend</title>

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
  <link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="assets/pages/css/components.css" rel="stylesheet">
  <link href="assets/corporate/css/style.css" rel="stylesheet">
  <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="assets/corporate/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->
  <style>
  
    .container3 {
        max-width: 8000px;
        background: #ffffff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 10px;
        margin-bottom: 10px;
        font-size: 36px; /* Memperbesar judul */
    }
    .container3 h1 {
      font-size: 36px;
    background: linear-gradient(45deg, blue, blue, blue, blue);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    }
    
    h1 {
        color: black ;
    }
   
    .content3 {
        line-height: 1.6;
        font-size: 18px; /* Memperbesar paragraf */  
        text-align: justify;  
        text-indent: 30px; /* Mengindentasi baris pertama paragraf */
        line-height: 1.6;  /* Menjaga jarak antar baris agar lebih nyaman dibaca */
    } 
    .strong {
        color: #222222;
    }
    ul {
        padding-left: 20px;
        font-size: 15px;
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

/* Align menu and search bar with logo */
.header-navigation-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
}

.site-logo {
    flex-shrink: 0;
}

.header-navigation {
    flex-grow: 1;
    display: flex;
    justify-content: flex-end;
    align-items: center;
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
    padding: 10px 15px;
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
    <!-- BEGIN STYLE CUSTOMIZER -->
    <div class="color-panel hidden-sm">
      <div class="color-mode-icons icon-color"></div>
      <div class="color-mode-icons icon-color-close"></div>
      <div class="color-mode">
        <p>THEME COLOR</p>
        <ul class="inline">
          <li class="color-red current color-default" data-style="red"></li>
          <li class="color-blue" data-style="blue"></li>
          <li class="color-green" data-style="green"></li>
          <li class="color-orange" data-style="orange"></li>
          <li class="color-gray" data-style="gray"></li>
          <li class="color-turquoise" data-style="turquoise"></li>
        </ul>
      </div>
    </div>
    <!-- END BEGIN STYLE CUSTOMIZER --> 

    <div class="main">
      <div class="container">
        
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12">
            <div class="container3">
              <center>
                <h1><strong>Sejarah Gereja</strong></h1></center>
              
              <div class="content3">
                  <p>Songon on ma ginuritton Sejarah singkat 25 (dua puluh lima) 
                    taon huria HKBP Tiberias Lumban Bulbul Res. Balige Distrik XI Toba Hasundutan 
                    sian taon 1991 sahat tu taon 2016.</p>
                  <br><p>Manghilalahon hinaringkot ni panogunon ni Debata marhite huriaNa di Lumban Bulbul on,
                    tung dihalashon roha nami do pangaroditon ni huria Balige dohot sude Parhaladona na sai 
                    tongtong patupahon Partangiangan Lunggu siganup ari Minggu botarina di Lumban Bulbul on. 
                    Ditaon 1991 tongon di bulan Pebruari, ditutkukhi Tuhanta do roha ni sahalak Ina natuatua ima Op. 
                    Rumenta br Sibarani (+) na di Medan laho papunguhon angka ruas asa marpungu laho martangiang, 
                    siala dlibereng nasida mulai taon 1989 sahat tu taon 1990 dang adong be ruas ni Lumban Bulbul on 
                    laho marminggu tu Gareja Bolon (Balige) alani gogo nahurangan di angka natuatua mangeaahi 
                    parmigguan di Balige, alai sikkola minggu nunga mardalan dohot denggan do mardalan sebelum 
                    taon 1989 na pinatupa dibagas ni halak amanta Op.</p>
                  <br><p>Arisan Marpaung (+) dohot di bagas ni halak amanta Op. Humisar Marpaung, 
                    jala Guru Sikkola Minggu hathia i ima : Op. Arga br Siahaan, St. Rita br Marpaung 
                    dohot nai Juliper br Marpaung. Dihara nasida ma donganna manang piga halak ima : Op. 
                    Sondang br Siahaan (+), Op. Humisar Marpaung (+), dohot Op. Hisar Siahaan, 
                    papunguhon na olo martangiang dohot nasida. Maulilate ma di Tuhanta hinorhon ni ulaon i 
                    gabe adong ma parpunguan i jala dipatupa ma parmigguon di bagas ni ruas ni huria 
                    margantiangti di ganup ari Minggu botarina, jala dipatupa ma parmigguon na parjolo 
                    dibagas ni keluarga Op. Rumenta br Sibarani (+), na tongtong hinosbasan ni Parhalado 
                    sian Balige dung sidung parmigguon di Balige. Dung sae sian ganup bagas ni ruas ni huria 
                    dipatupa do parmigguon di bagasan parsikkoloan (SD Inpres Lumban Bulbul). Lam mangolu jala 
                    lam magodang do punguan i nang songon in nang angka las ni roha, alani do tubu ma sadani 
                    roha dohot tahi nami mambahen sada panghaton laho pajongjonghon Gareja songon inganan laho 
                    mamuji pasangaphon Tuhanta di Lumban Bulbul on.</p>
                  <br><p>Ala dang adong be dapot tano sahat tu Lumban Ginabean laho partapahan ni gareja, 
                    dibahen i marhite rapot ni ruas dohot pangituai ni Horja Lumban Bulbul tanggal 13 September 1992 
                    dipasahat Horja Lumban Bulbul ma tano warisan manang par sikkolaan najolo bahen parmigguon laos 
                    ima nalaho partapahan ni Pembangunan Gareja on dohot ukuran 25 x 60 Meter na marbatas :</p>
                  <p><strong>Sabola Utara : </strong> Tao Toba</p>
                  <p><strong>Sabola Timur : </strong> SD Inpres Lumban Bulbul</p>
                  <p><strong>Sabola Selatan : </strong> Tano Pangeahan (Milik Desa)</p>
                  <p><strong>Sabola Barat  : </strong> Tali Air (Bondar)</p>
                  <p>Ia pangituai ni horja hathia i (pihak I / yang menyerahkan) ima : Op. Basa Simangunsong (+), 
                    Op. Renta Simangunsong (+), Op. Marsaor Simangunsong (+), Op. Humisar Marpaung (+), W. Simangunsong 
                    /Op. Jeremy Simangunsong (+). Na di ketahui Kepala Desa Lumban Bulbul ima halak amanta Bistok Simangunsong 
                    (Op. Balata doli), jala pihak II / yang menerima hathia i ima HS Gultom (Guru Jemaat HKBP Balige), 
                    St. J. Sihotang (Parhalado Par artaon) jala ditolopi Pandita Ressrot Balige hathia i ima Pdt. A. Naiborhu 
                    (+). Jala dipahaluarma secara resmi Surat Penyerahan Tano ima ditanggal 20 September 1992.</p>
                  <p>Laos mamungka ari 13 Sepetember 1992 i di padiri ma Panitia Pembangunan sa godang ni 40 
                    (opat puluh) halak laho mangula ulaon i ima na ni ketuaan ni amanta Kondar Simangunsong 
                    (Op. Sinokman), Sekretaris Patar Marpaung/Op. Raja Doli (+) dohot bendahara St. 
                    Mangloi Simangunsong/Op. Pardaemean (+). Jala dipungka do pembangunan i parjolo sahali 
                    mambongkar parsikkoloan, tung marsitutu do nasida mangulahon ulaon i asa hatumop jongjong 
                    Garejaan on, dihusiphon nasida do rencana i jala rantib horuanta on na marhite amanta Drs. 
                    EB Simangunsong (Ama Sondang), Ir Budiman Simangunsong (Ama Rina), Robinson Simangunsong 
                    (Op. Esia) dohot Drs. Peris Marpaung (+) dohot St. Jorianus Marpaung/Op. Levy (+), 
                    Tonggo br Simangunsong, St. O.F. Pardede.</p>
                  <p>Dung adong tarpunguon dana i dijouma pande bagas ni huria laho mamande i ima amanta : 
                    Morhan Simangunsong (Op. Ruben), Parulian Simangunsong (Op. Santi), jala dipungka ma 
                    peletakan batu pertama taon 1995 na ni uluhon ni Pdt. A. Naiborhu (+).
                    Sidung ma pembangunan ni Garejanta on di taon 1997. Hir do nang hodok ni sude ruas 
                    margotong royong diparjongjong ni Bagas Joro on.</p>
                  <p>Torus do mardalan parmigguon di Lumban Bulbul di ganup ari Minggu botarina mulai taon 
                    1992 sahat tu taon 1999. Marhite amanta Pdt. Tumpak Siahaan dohot amanta Guru Huria 
                    Burhanuddin Hutaoruk, tanggal 28 Augustus 1999 dipungka ma parmigguon manogot di Gareja 
                    Lumban Bulbul laos marrapot ma disi, asa mardalan ulaon parmigguon manogotna. 
                    Dos roha nami dirapot i, mangido sahalak Guru Huria na gok tingki jala saut do sangkap i 
                    ditanggal 12 September 1999 di ojakhon ma Guru Huria na gok tingki laho mangula di huria 
                    on ima Calon Guru Huria Pontius Cristopel Siregar, laos sadari i do ro surat Haputusan sian 
                    Pareses HKBP Distrik XI Toba Hasundutan mandok huria on gabe persiapan huria, nani ketuaan 
                    Op. Leo Simangunsong (+), Sekretaris ima St. Op. Putri Simangunsong, jala bendahara ima 
                    Op. Ruben br Simanjuntak na ditolopi Pandita Ressort Balige ima Pdt. Tumpak Siahaan dohot 
                    Guru Huria Tiberias Lumban Bulbul ima Cal. Gr. Pontius Cristopel Siregar.</p>
                  <p>Dung mardalan parmigguon manogotna lam hembang ma pamerenagn ni ruas Lumban Bulbul, 
                    marhite i naeng ma nian gabe huria nagok (mandiri) hurianta on namajane sian huria Balige. 
                    Dibahen i, tanggal 27 Pebruari 2000 dipatupa ma rapot huria jala dos do roha nang tahi disi, 
                    patupaon ma panjaeon sian huria Balige ima di tanggal 9 Juli 2000 laos dos do nang roha nami 
                    disi pasahatton tu Pimpinan ni Huria HKBP laho mangaririt goar ni huria on. Jala ditanggal 
                    4 Juli 2000 sahat ma goar ni huria on na niririt ni Pimpinan, ima HKBP Tiberias Lumban Bulbul. 
                    Dengan do saluhutnai mardalan di bagasan asi ni roha ni Tuhanta dibahen i dipasahatma hurianta 
                    on tu Debata marhite ulaon pesta Peresmian dan MBO (Mameakahon Botoh OJahan) na ni uluhon ni 
                    Pimpinan HKBP marhite Pdt. WTP. Simarmata, MA, di tanggal 10 September 2000 na ni ketuaan ni 
                    amanta Op. Leo Simangunsong (Ketua I), Op. Sinokman Simangunsong (Ketua II), Op. Putri 
                    Simangunsong (Sekretaris I), Op. Nathalia Sitorus (Sekretaris II) (+), Op. Freil Tampubolon 
                    (Sekretaris III), jala Op. Ruben br Simanjuntak (Bendahara I), dohot St. R br Marpaung 
                    (Bendahara II).</p>
                  
                  
            </div>
          <!-- END CONTENT -->
        </div>
      </div>
    </div>
    </div>
    </div>
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