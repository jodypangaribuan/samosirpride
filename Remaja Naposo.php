<?php
include "php/koneksi.php";

// Proses hapus data jika action = delete dan id tersedia
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($id > 0) {
        $query = "SELECT gambar FROM remaja_naposo WHERE id = $id";
        $img_result = mysqli_query($conn, $query);

        if ($img_data = mysqli_fetch_assoc($img_result)) {
            $stmt = $conn->prepare("DELETE FROM remaja_naposo WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $file_path = "php/uploads/" . $img_data['gambar'];
                if (!empty($img_data['gambar']) && file_exists($file_path)) {
                    unlink($file_path);
                }
                header("Location: remaja_naposo.php?status=success&message=" . urlencode("Remaja Naposo berhasil dihapus"));
                exit;
            } else {
                die("Gagal menghapus data: " . $stmt->error);
            }
        } else {
            header("Location: remaja_naposo.php?status=error&message=" . urlencode("Data tidak ditemukan"));
            exit;
        }
    } else {
        header("Location: remaja_naposo.php?status=error&message=" . urlencode("ID tidak valid"));
        exit;
    }
}

// Ambil semua data event galeri
$result = mysqli_query($conn, "SELECT * FROM remaja_naposo ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Remaja Naposo | HKBP Tiberias</title>
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
</head>
<body class="corporate">
    <?php include "templates/navigation.php"; ?>
    <div class="page-slider margin-bottom-40">
        <div id="carousel-example-generic" class="carousel slide carousel-slider">
            <ol class="carousel-indicators carousel-indicators-frontend">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item carousel-item-eight active">
                    <div class="container">
                        <div class="carousel-position-six text-uppercase text-center">
                            <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInDown">
                                HKBP TIBERIAS <br />
                                <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
                            </h2>
                            <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">
                                "SEGALA KEMULIAAN HANYA BAGI ALLAH"
                            </p>
                        </div>
                    </div>
                </div>
                <div class="item carousel-item-nine">
                    <div class="container">
                        <div class="carousel-position-six text-center">
                            <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInDown">
                                HKBP TIBERIAS <br />
                                <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
                            </h2>
                            <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">
                                "SEGALA KEMULIAAN HANYA BAGI ALLAH"
                            </p>
                        </div>
                    </div>
                </div>
                <div class="item carousel-item-ten">
                    <div class="container">
                        <div class="carousel-position-six text-center">
                            <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInDown">
                                HKBP TIBERIAS <br />
                                <span class="carousel-title-normal">LUMBAN BUL-BUL</span>
                            </h2>
                            <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">
                                "SEGALA KEMULIAAN HANYA BAGI ALLAH"
                            </p>
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
    <div class="main">
        <div class="container mt-4">
            <h1 class="text-center" style="color: #007bff"><strong>Remaja Naposo HKBP Tiberias</strong></h1>
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
    <?php include "templates/footer.php"; ?>
    <script src="assets/plugins/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/corporate/scripts/layout.js"></script>
</body>
</html>