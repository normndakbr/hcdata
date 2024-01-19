<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input id="txtcarikary" type="text" class="form-control border-0 shadow-none"
                        placeholder="Ketikkan No. KTP / NIK / Nama Karyawan " />
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
<!-- Logout Modal -->
<div class="modal fade" id="logoutmdl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log out</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Pilih "Keluar" jika ingin mengakhir pekerjaan</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <a href="<?=base_url('logout');?>" type="button" class="btn btn-primary">Keluar</a>
            </div>
        </div>
    </div>
</div>