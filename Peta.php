<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Peta Lokasi | HKBP Tiberias</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/pages/css/components.css" rel="stylesheet">
    <link href="assets/corporate/css/style.css" rel="stylesheet">
    <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">
    <link href="assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
    <link href="assets/corporate/css/custom.css" rel="stylesheet">
    <link href="assets/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
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
    <link href="oke.css" rel="stylesheet">
    <!-- Page level plugin styles END -->

    <!-- Theme styles START -->
    <link href="assets/pages/css/components.css" rel="stylesheet">
    <link href="assets/pages/css/slider.css" rel="stylesheet">
    <link href="assets/corporate/css/style.css" rel="stylesheet">
    <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">
    <link href="assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
    <link href="assets/corporate/css/custom.css" rel="stylesheet">

    <style>

        body { */
            text-align: center;
        }

        .container1 {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin: 40px auto;
}

.map-title {
    font-size: 2em;
    margin-bottom: 20px;
    color : #0056b3;
    font-weight: bold;
}

.map-iframe {
    width: 100%;
    max-width: 700px;
    height: 450px;
    border: none;
    border-radius: 10px;
    margin-bottom: 20px;
}

.buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}

.direction-btn,
.share-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 1em;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.direction-btn:hover,
.share-btn:hover {
    background-color: #0056b3;
}

    </style>
    
</head>

<body class="corporate">
    <?php include "templates/navigation.php"; ?>
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
                            <h2 class="margin-bottom-20 animate-delay carousel-title-v5"
                                data-animation="animated fadeInDown">
                                HKBP TIBERIAS <br />
                                <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
                            </h2>
                            <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30"
                                data-animation="animated fadeInDown">
                                "SEGALA KEMULIAAN HANYA BAGI ALLAH" </p>
                        </div>
                    </div>
                </div>

                <!-- Second slide -->
                <div class="item carousel-item-nine">
                    <div class="container">
                        <div class="carousel-position-six text-center">
                            <h2 class="margin-bottom-20 animate-delay carousel-title-v5"
                                data-animation="animated fadeInDown">
                                HKBP TIBERIAS <br />
                                <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
                            </h2>
                            <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30"
                                data-animation="animated fadeInDown">
                                "SEGALA KEMULIAAN HANYA BAGI ALLAH" </p>
                        </div>
                    </div>
                </div>

                <!-- Third slide -->
                <div class="item carousel-item-ten">
                    <div class="container">
                        <div class="carousel-position-six text-center">
                            <h2 class="margin-bottom-20 animate-delay carousel-title-v5"
                                data-animation="animated fadeInDown">
                                HKBP TIBERIAS <br />
                                <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
                            </h2>
                            <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30"
                                data-animation="animated fadeInDown">
                                "SEGALA KEMULIAAN HANYA BAGI ALLAH" </p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="left carousel-control carousel-control-shop carousel-control-frontend"
                href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="right carousel-control carousel-control-shop carousel-control-frontend"
                href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
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
    <div class="main">
    <div class="container1">
        <h1 class="map-title">Peta Lokasi</h1>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.4695667599804!2d99.07310947396199!3d2.3476483575586635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e04746e52221b%3A0x7b73d4673fe1229c!2sHKBP%20Tiberias%20Lumban%20Bulbul!5e0!3m2!1sid!2sid!4v1741341615570!5m2!1sid!2sid"
            allowfullscreen="" 
            class="map-iframe">
        </iframe>
        
        <div class="buttons">
            <button onclick="bukaGoogleMaps()" class="direction-btn">Petunjuk Arah</button>
            <button onclick="bagikanLokasi()" class="share-btn">Bagikan Lokasi</button>
        </div>
    </div>
</div>
    <?php include "templates/footer.php"; ?>
    <script>
        function bukaGoogleMaps() {
            window.open("https://www.google.com/maps/dir/?api=1&destination=HKBP+Tiberias+Lumban+Bulbul", "_blank");
        }
        function bagikanLokasi() {
            const url = "https://goo.gl/maps/d6wKj5FfyyD2";
            if (navigator.share) {
                navigator.share({
                    title: "HKBP Tiberias Lumban Bulbul",
                    text: "Lihat lokasi HKBP Tiberias Lumban Bulbul di Google Maps",
                    url: url
                }).catch(err => console.log("Gagal berbagi", err));
            } else {
                prompt("Salin link berikut untuk dibagikan:", url);
            }
        }
    </script>
    <script src="assets/plugins/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/corporate/scripts/layout.js"></script>
</body>

</html>