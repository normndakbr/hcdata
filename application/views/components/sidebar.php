<nav class="pcoded-navbar menu-light position-fixed">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="<?= base_url(); ?>assets/assets/images/user/avatar-2.jpg" alt="User-Profile-Image" />
                    <div class="user-details mt-2">
                        <div id="per-detail">
                            <h5>PT. IC</h5>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('dashboard'); ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>"><span class="pcoded-micon"><i class="feather icon-globe"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Data Master</label>
                </li>
                <li class="nav-item pcoded-hasmenu 
                    <?= $this->uri->segment(1) == 'perusahaan' ||
                        $this->uri->segment(1) == 'tambah_perusahaan' ||
                        $this->uri->segment(1) == 'struktur' ||
                        $this->uri->segment(1) == 'tambah_struktur' ? 'active pcoded-trigger' : '' ?>">
                    <a href="javascript:void(0);" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Data
                            Perusahaan</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li <?= $this->uri->segment(1) == 'perusahaan' ||
                                $this->uri->segment(1) == 'tambah_perusahaan' ? 'class="active"' : '' ?>><a href="<?= base_url('perusahaan') ?>">Perusahaan</a></li>
                        <li <?= $this->uri->segment(1) == 'struktur' ||
                        $this->uri->segment(1) == 'tambah_struktur' ? 'class="active"' : '' ?>><a href="<?= base_url('struktur') ?>">Struktur Perusahaan</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-share-2"></i></span><span class="pcoded-mtext">Data
                            Pekerjaan</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="javascript:void(0);">Departemen</a></li>
                        <li><a href="javascript:void(0);">Section</a></li>
                        <li><a href="javascript:void(0);">Posisi</a></li>
                        <li><a href="javascript:void(0);">Level</a></li>
                        <li><a href="javascript:void(0);">Grade</a></li>
                        <li><a href="javascript:void(0);">Tipe</a></li>
                        <li><a href="javascript:void(0);">Status Perjanjian</a></li>
                        <li><a href="javascript:void(0);">Roster</a></li>
                        <li><a href="javascript:void(0);">Bank</a></li>
                        <li><a href="javascript:void(0);">Sanksi</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Data
                            Daerah</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="javascript:void(0);">Lokasi Kerja</a></li>
                        <li><a href="javascript:void(0);">Lokasi Penerimaan</a></li>
                        <li><a href="javascript:void(0);">Point of Hire</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-check-square"></i></span><span class="pcoded-mtext">Data
                            SIMPER</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="javascript:void(0);">Jenis SIM Polisi</a></li>
                        <li><a href="javascript:void(0);">Data Unit</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu 
                    <?= $this->uri->segment(1) == 'karyawan' ||
                        $this->uri->segment(1) == 'view_create_karyawan' ? 'active pcoded-trigger' : '' ?>">
                    <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Data
                            Karyawan</span></a>
                    <ul class="pcoded-submenu">
                        <li <?= $this->uri->segment(1) == 'karyawan' ||
                                $this->uri->segment(1) == 'view_create_karyawan' ? 'class="active"' : '' ?>><a href="<?= base_url('karyawan'); ?>">Karyawan</a></li>
                        <li><a href="#">Approval</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Data Utama</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Data</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="#">SIMPER/Mine Permit</a></li>
                        <li><a href="<?= base_url('pelanggaran'); ?>">Pelanggaran</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Laporan</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Data
                            Karyawan</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="javascript:void(0);" class="nav-link">Data Karyawan</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">SIMPER/Mine
                            Permit</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="javascript:void(0);" class="nav-link">SIMPER/MP</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Pelanggaran</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="javascript:void(0);" class="nav-link">Pelanggaran</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Sistem</label>
                </li>
                <li class="nav-item pcoded-hasmenu" style="margin-bottom:300px;">
                    <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Sistem</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="#">Audit</a></li>
                        <li><a href="#">Akses Menu</a></li>
                        <li><a href="<?= base_url('user'); ?>">User</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>