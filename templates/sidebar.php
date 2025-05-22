<?php
if (!isset($current_page)) {
    $current_page = basename($_SERVER['PHP_SELF']);
}
?>
<nav class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-church fa-2x"></i>
        <h3>Admin Gereja</h3>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="dashboard.php" class="<?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="ayat_harian_admin.php" class="<?= ($current_page == 'ayat_harian_admin.php') ? 'active' : '' ?>">
                <i class="fas fa-bible"></i> Ayat Harian
            </a>
        </li>
        <li>
            <a href="jadwal_ibadah.php" class="<?= ($current_page == 'jadwal_ibadah.php') ? 'active' : '' ?>">
                <i class="fas fa-calendar-alt"></i> Jadwal Ibadah
            </a>
        </li>
        <li>
            <a href="program_pelayanan.php" class="<?= ($current_page == 'program_pelayanan.php') ? 'active' : '' ?>">
                <i class="fas fa-folder"></i> Program Pelayanan
            </a>
        </li>
        <li>
            <a href="galeri.php" class="<?= ($current_page == 'galeri.php') ? 'active' : '' ?>">
                <i class="fas fa-images"></i> Galeri
            </a>
        </li>
        <li>
            <a href="jemaat.php" class="<?= ($current_page == 'jemaat.php') ? 'active' : '' ?>">
                <i class="fas fa-users"></i> Jemaat
            </a>
        </li>
        <li>
            <a href="warta_jemaat.php" class="<?= ($current_page == 'warta_jemaat.php') ? 'active' : '' ?>">
                <i class="fas fa-address-book"></i> Warta Jemaat
            </a>
        </li>
        <li class="dropdown <?= ($current_page == 'struktur_gereja.php' || $current_page == 'kategori_struktur_gereja.php') ? 'active' : '' ?>">
            <a href="javascript:void(0);" class="dropdown-toggle">
                <i class="fas fa-landmark"></i> Struktur Gereja <i class="fas fa-chevron-down toggle-icon"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="struktur_gereja.php" class="<?= ($current_page == 'struktur_gereja.php') ? 'active' : '' ?>">
                        Struktur Gereja
                    </a>
                </li>
                <li>
                    <a href="kategori_struktur_gereja.php" class="<?= ($current_page == 'kategori_struktur_gereja.php') ? 'active' : '' ?>">
                        Kategori
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown <?= ($current_page == 'koor.php' || $current_page == 'acara_koor.php') ? 'active' : '' ?>">
            <a href="javascript:void(0);" class="dropdown-toggle">
                <i class="fas fa-folder"></i> Koor <i class="fas fa-chevron-down toggle-icon"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="koor.php" class="<?= ($current_page == 'koor.php') ? 'active' : '' ?>">
                        Koor
                    </a>
                </li>
                <li>
                    <a href="acara_koor.php" class="<?= ($current_page == 'acara_koor.php') ? 'active' : '' ?>">
                        Acara Koor
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="event_galeri.php" class="<?= ($current_page == 'event_galeri.php') ? 'active' : '' ?>">
                <i class="fas fa-images"></i> Event Galeri
            </a>
        </li>
        <li>
            <a href="remaja_naposo.php" class="<?= ($current_page == 'remaja_naposo.php') ? 'active' : '' ?>">
                <i class="fas fa-users"></i> Remaja Naposo
            </a>
        </li>
        <li>
            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </li>
    </ul>
</nav>
<style>
    .dropdown-menu {
        display: none;
        list-style: none;
        padding-left: 20px;
        margin: 5px 0;
        transition: all 0.3s ease;
    }
    .dropdown.active .dropdown-menu {
        display: block;
    }
    .toggle-icon {
        float: right;
        transition: transform 0.3s ease;
    }
    .dropdown.active .toggle-icon {
        transform: rotate(180deg);
    }
</style>
<script>
    document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function () {
            const parent = this.parentElement;
            parent.classList.toggle('active');
        });
    });
</script>