<!DOCTYPE html>
<html lang="en">

<head>
    <title>ODBsys - Support</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->

    <link rel="icon" href="<?=base_url();?>assets/assets/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/css/select2.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link rel='stylesheet' href='<?=base_url();?>assets/assets/css/sweetalert2.min.css'>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/css/style.css" />
    <style>
    .swal2-container {
        z-index: 2000000000000 !important;
    }

    .ui-front {
        z-index: 99999999999 !important;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    a.disabled {
        pointer-events: none;
        cursor: default;
    }

    .center_img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 40%;
    }

    .parsley-error {
        color: red;
    }
    </style>
</head>

<body class=" bg-c-blue">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <nav class="pcoded-navbar menu-light position-fixed">
        <div class="navbar-wrapper">
            <div class="navbar-content scroll-div">
                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="<?=base_url();?>assets/assets/images/user/avatar-2.jpg"
                            alt="User-Profile-Image" />
                        <div class="user-details mt-2">
                            <div id="per-detail">
                                <h5><?=$nama_per;?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" class="txt_csrfname d-none" name="<?=$this->security->get_csrf_token_name();?>"
                    value="<?=$this->security->get_csrf_hash();?>"><br>
                <ul class="nav pcoded-inner-navbar mt-3">
                    <li id="mnusctambahkary" class="nav-item">
                        <a href="<?=base_url('dash');?>" class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-tablet"></i></span><span class="pcoded-mtext">Beranda</span></a>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Menu</label>
                    </li>
                    <?php

foreach ($get_menu as $lsmenu) {
    $id_parent = $lsmenu->IdParent;
    $id_modul = $lsmenu->id_modul_role;

    if ($id_parent == 0) {
        echo '<li class="nav-item pcoded-hasmenu">';
        echo '<a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather ' . $lsmenu->IconModule . '"></i></span><span class="pcoded-mtext">' . $lsmenu->LabelMenu . '</span></a>';
        echo '<ul class="pcoded-submenu">';

        foreach ($get_menu as $lsmenu) {
            $id_parent = $lsmenu->IdParent;
            if ($id_parent > 0 && $id_modul == $id_parent) {
                echo '<li id="mnuperusahaan"><a href="' . base_url($lsmenu->UrlModule) . '">' . $lsmenu->LabelMenu . '</a></li>';
            }
        }

        echo '</ul>';
        echo '</li>';
    }
}

?>
                </ul>
            </div>
        </div>
    </nav>
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                    <div class="search-bar">
                        <input type="text" class="form-control border-0 shadow-none"
                            placeholder="Ketikkan No. KTP / No. KK / NIK / Nama Karyawan" />
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="<?=base_url();?>assets/assets/images/user/avatar-2.jpg" class="img-radius"
                                    alt="User-Profile-Image" />
                                <span><?=$nama;?></span>
                            </div>
                            <ul class="pro-body">
                                <li>
                                    <a href="<?=base_url('gantisandi');?>" class="dropdown-item"><i
                                            class="feather icon-lock"> </i> Ganti Sandi</a>
                                </li>
                                <li>
                                    <a href="#" id="logout" class="dropdown-item" data-toggle="modal"
                                        data-target="#logoutmdl"><i class="feather icon-log-out"></i></i>
                                        Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>