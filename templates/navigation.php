<style>
    .table-warning {
        background-color: rgb(224, 107, 10);
        color: white;
    }

    .header-navigation-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: nowrap;
        /* Pastikan tidak wrap di desktop */
    }

    .logo-toggle-wrapper {
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: space-between;
    }

    .site-logo {
        display: flex;
        align-items: center;
        margin-right: 10px;
        /* Tambahan agar logo tidak terlalu besar */
        min-width: 100px;
        align-self: flex-start;
        /* Jaga posisi vertikal sejajar */
    }

    .site-logo img.logo-img {
        display: block;
        max-height: 60px;
        width: auto;
        height: auto;
        vertical-align: middle;
        /* Pastikan logo rata tengah */
    }

    .header-navigation {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .header-navigation ul {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 8px; /* Perkecil jarak antar menu */
        align-items: center;
    }

    .header-navigation ul li {
        position: relative;
        min-width: 120px;
        /* Tambahan agar tiap menu punya ruang cukup */
        text-align: center;
    }

    .header-navigation ul li a {
        text-decoration: none;
        color: #333;
        padding: 8px 10px; /* Perkecil padding */
        display: block;
        transition: color 0.3s;
        white-space: nowrap;
        /* Tambahan agar dua kata tidak turun baris */
        text-align: center;
    }

    .header-navigation ul li a:hover {
        color: #007bff;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        list-style: none;
        padding: 10px 0;
        margin: 0;
        z-index: 1000;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu li a {
        padding: 10px 20px;
        color: #333;
        white-space: nowrap;
    }

    .dropdown-menu li a:hover {
        background-color: #f8f9fa;
        color: #007bff;
    }

    .menu-search {
        position: relative;
    }

    .search-box {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        padding: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .search-box.active {
        display: block;
    }

    .search-btn {
        cursor: pointer;
        font-size: 15px;
        color: #333;
    }

    .search-btn:hover {
        color: #007bff;
    }

    .mobi-toggler {
        display: none;
        font-size: 28px;
        cursor: pointer;
        background: none;
        border: none;
        color: #333;
        margin-left: 10px;
        /* Pastikan toggle ada di kanan logo */
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .header-navigation-container {
            flex-direction: column;
            align-items: flex-start;
            flex-wrap: wrap;
            /* Boleh wrap di mobile */
        }

        .logo-toggle-wrapper {
            width: 100%;
        }

        .header-navigation {
            width: 100%;
            display: none;
            flex-direction: column;
            margin-top: 10px;
        }

        .header-navigation.active {
            display: flex;
        }

        .header-navigation ul {
            flex-direction: column;
            gap: 0;
            width: 100%;
        }

        .header-navigation ul li {
            min-width: 0;
            /* Reset agar mobile tetap responsif */
            width: 100%;
            border-bottom: 1px solid #eee;
        }

        .header-navigation ul li:last-child {
            border-bottom: none;
        }

        .header-navigation ul li a {
            white-space: normal;
            text-align: left;
            padding-left: 25px;
        }

        .dropdown-menu {
            position: static;
            box-shadow: none;
            display: none;
            background: #fff;
        }

        .dropdown.open > .dropdown-menu {
            display: block;
        }

        .menu-search {
            margin-top: 10px;
        }

        .site-logo {
            margin-bottom: 10px;
        }

        .mobi-toggler {
            display: block;
        }
    }
</style>
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
                    <li><a href="php/login.php">Log In</a></li>
                </ul>
            </div>
            <!-- END TOP BAR MENU -->
        </div>
    </div>
</div>
<!-- END TOP BAR -->

<!-- BEGIN HEADER & NAVIGATION -->
<div class="header">
    <div class="container">
        <div class="header-navigation-container">
            <div class="logo-toggle-wrapper">
                <div class="site-logo">
                    <a href="index.php">
                        <img src="assets/corporate/img/logos/LOGO HKBP.png" width="80" alt="Logo" class="logo-img">
                    </a>
                </div>
                <button class="mobi-toggler" aria-label="Toggle Navigation"><i class="fa fa-bars"></i></button>
            </div>
            <nav class="header-navigation">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="dropdown">
                        <a href="#">Tentang <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="Visi&misi.php">Visi & Misi</a></li>
                            <li><a href="sejarah gereja.php">Sejarah Gereja</a></li>
                            <li><a href="program pelayanan.php">Program Pelayanan</a></li>
                            <li><a href="Galeri.php">Galeri</a></li>
                        </ul>
                    </li>
                    <li><a href="jemaat.php">Jemaat</a></li>
                    <li><a href="Warta Jemaat.php">Warta Jemaat</a></li>
                    <li><a href="Struktur Gereja.php">Struktur Gereja</a></li>
                    <li class="dropdown">
                        <a href="#">Kegiatan Gereja <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="Koor.php">Koor</a></li>
                            <li><a href="Event.php">Event</a></li>
                            <li><a href="Remaja Naposo.php">Remaja Naposo</a></li>
                        </ul>
                    </li>
                    <li><a href="Peta.php">Peta/Maps</a></li>
                    <li class="menu-search">
                        <a href="javascript:void(0);" class="search-btn"><i class="fa fa-search"></i></a>
                        <div class="search-box">
                            <form onsubmit="return searchContent();">
                                <input type="text" id="searchInput" placeholder="Search..." required>
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- END HEADER & NAVIGATION -->

<script>
    function searchContent() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
        let found = false;

        // Hapus highlight sebelumnya
        document.querySelectorAll(".highlight").forEach(el => {
            el.outerHTML = el.innerHTML;
        });

        // Cari dan sorot hasil
        while (walker.nextNode()) {
            const node = walker.currentNode;
            const parent = node.parentNode;

            if (node.nodeValue.toLowerCase().includes(input)) {
                const regex = new RegExp(`(${input})`, "gi");
                const highlightedHTML = node.nodeValue.replace(regex, '<span class="highlight">$1</span>');
                const tempDiv = document.createElement("div");
                tempDiv.innerHTML = highlightedHTML;

                while (tempDiv.firstChild) {
                    parent.insertBefore(tempDiv.firstChild, node);
                }
                parent.removeChild(node);
                found = true;
            }
        }

        if (found) {
            const firstResult = document.querySelector(".highlight");
            if (firstResult) {
                firstResult.scrollIntoView({ behavior: "smooth", block: "center" });
            }
            alert(`Hasil pencarian untuk: "${input}" telah disorot.`);
        } else {
            alert(`Tidak ada hasil ditemukan untuk: "${input}".`);
        }

        return false; // Mencegah reload halaman
    }

    // Tambahkan CSS untuk highlight
    const style = document.createElement("style");
    style.innerHTML = `
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
    `;
    document.head.appendChild(style);

    document.querySelector('.search-btn').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('.search-box').classList.toggle('active');
    });

    // Toggle menu for mobile
    document.querySelector('.mobi-toggler').addEventListener('click', function () {
        document.querySelector('.header-navigation').classList.toggle('active');
    });

    // Dropdown toggle for mobile
    document.querySelectorAll('.header-navigation .dropdown > a').forEach(function (el) {
        el.addEventListener('click', function (e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                var parent = this.parentElement;
                parent.classList.toggle('open');
            }
        });
    });

    document.querySelector('.search-btn').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('.search-box').classList.toggle('active');
    });
</script>