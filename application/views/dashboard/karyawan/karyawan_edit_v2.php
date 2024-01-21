<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Data Master</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('dash'); ?>">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">
                                    Karyawan
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Edit Data Karyawan
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12" style="overflow-x:auto;">
                <div id="addkry" class="card latest-update-card">
                    <div class="card-header align-items-center">
                        <h5>Edit Data Karyawan</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card">
                                        <a href="#!"><span><i class="feather icon-maximize"></i>
                                                Fullscreen</span><span style="display: none"><i class="feather icon-minimize"></i> Restore</span></a>
                                    </li>
                                    <li class="dropdown-item minimize-card">
                                        <a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display: none"><i class="feather icon-plus"></i>
                                                expand</span></a>
                                    </li>
                                    <li class="dropdown-item reload-card">
                                        <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger errormsg animate__animated animate__bounce d-none mb-2"></div>
                        <input id="idUser" class="d-none" value="<?= $this->session->userdata("id_menu") ?>"></input>
                        <input id="editTglEdit" class="d-none" value="<?= date("Y-m-d H:i:s"); ?>"></input>
                        <input id="editTglBuat" class="d-none" value="<?= isset($data_kary->tgl_buat) ? $data_kary->tgl_buat : '-' ?>"></input>
                        <input id="valueIDKaryawan" class="d-none" value="<?= isset($data_kary->id_kary) ? $data_kary->id_kary : '-' ?>"></input>

                        <!-- Auth -->
                        <input id="valueAuthPerusahaan" class="d-none" value="<?= isset($data_kary->auth_perusahaan) ? $data_kary->auth_perusahaan : '-' ?>"></input>
                        <input id="valueAuthMasterPerusahaan" class="d-none" value="<?= isset($data_kary->auth_m_perusahaan) ? $data_kary->auth_m_perusahaan : '-' ?>"></input>
                        <input id="valueAuthPersonal" class="d-none" value="<?= isset($data_kary->auth_personal) ? $data_kary->auth_personal : '-' ?>"></input>
                        <input id="valueAuthKaryawan" class="d-none" value="<?= isset($data_kary->auth_karyawan) ? $data_kary->auth_karyawan : '-' ?>"></input>
                        <input id="valueAuthMINEPERMIT" class="d-none" value="<?= isset($data_mine_permit->auth_izin_tambang) ? $data_mine_permit->auth_izin_tambang : '-' ?>"></input>
                        <input id="valueAuthSIMPER" class="d-none" value="<?= isset($data_simper->auth_izin_tambang) ? $data_simper->auth_izin_tambang : '-' ?>"></input>
                        <input id="valueAuthSIM" class="d-none" value="<?= isset($data_sim_kary->auth_sim_kary) ? $data_sim_kary->auth_sim_kary : '-' ?>"></input>

                        <!-- Data Personal -->
                        <input id="editIdPersonal" class="d-none" value="<?= isset($data_kary->id_personal) ? $data_kary->id_personal : '-' ?>"></input>
                        <input id="valueNoKTPOld" class="d-none" value="<?= isset($data_kary->no_ktp) ? $data_kary->no_ktp : '-' ?>"></input>
                        <input id="valueNoKKOld" class="d-none" value="<?= isset($data_kary->no_kk) ? $data_kary->no_kk : '-' ?>"></input>
                        <input id="valueJenisKelamin" class="d-none" value="<?= isset($data_kary->jk) ? $data_kary->jk : '-' ?>"></input>
                        <input id="valueWargaNegara" class="d-none" value="<?= isset($data_kary->warga_negara) ? $data_kary->warga_negara : '-' ?>"></input>
                        <input id="valueAgama" class="d-none" value="<?= isset($data_kary->id_agama) ? $data_kary->id_agama : '-' ?>"></input>
                        <input id="valueStatNikah" class="d-none" value="<?= isset($data_kary->id_stat_nikah) ? $data_kary->id_stat_nikah : '-' ?>"></input>
                        <input id="valueStatPendidikan" class="d-none" value="<?= isset($data_kary->id_pendidikan) ? $data_kary->id_pendidikan : ''  ?>"></input>

                        <!-- Data Alamat -->
                        <input id="valueIdAlamatKTP" class="d-none" value="<?= isset($data_alamat->id_alamat_ktp) ? $data_alamat->id_alamat_ktp : '-' ?>"></input>
                        <input id="alamat_ktp" class="d-none" value="<?= isset($data_alamat->alamat_ktp) ? $data_alamat->alamat_ktp : '-' ?>"></input>
                        <input id="valueProvinsi" class="d-none" value="<?= isset($data_alamat->prov_ktp) ? $data_alamat->prov_ktp : '' ?>"></input>
                        <input id="valueKabupaten" class="d-none" value="<?= isset($data_alamat->kab_ktp) ? $data_alamat->kab_ktp : '-' ?>"></input>
                        <input id="valueKecamatan" class="d-none" value="<?= isset($data_alamat->kec_ktp) ? $data_alamat->kec_ktp : '-' ?>"></input>
                        <input id="valueKelurahan" class="d-none" value="<?= isset($data_alamat->kel_ktp) ? $data_alamat->kel_ktp : '-' ?>"></input>

                        <!-- Data Karyawan -->
                        <input id="valuePerusahaan" class="d-none" value="<?= isset($data_kary->auth_m_perusahaan) ? $data_kary->auth_m_perusahaan : '-' ?>"></input>
                        <input id="valueDepart" class="d-none" value="<?= isset($data_kary->id_depart) ? $data_kary->id_depart : '-' ?>"></input>
                        <input id="valuePosisi" class="d-none" value="<?= isset($data_kary->id_posisi) ? $data_kary->id_posisi : '-' ?>"></input>
                        <input id="valueKlasifikasi" class="d-none" value="<?= isset($data_kary->id_klasifikasi) ? $data_kary->id_klasifikasi : '' ?>"></input>
                        <input id="valueTipe" class="d-none" value="<?= isset($data_kary->id_tipe) ? $data_kary->id_tipe : '-' ?>"></input>
                        <input id="valueLevel" class="d-none" value="<?= isset($data_kary->id_level) ? $data_kary->id_level : '-' ?>"></input>
                        <input id="valuePOH" class="d-none" value="<?= isset($data_kary->id_poh) ? $data_kary->id_poh : '-' ?>"></input>
                        <input id="valueLokterima" class="d-none" value="<?= isset($data_kary->id_lokterima) ? $data_kary->id_lokterima : '-' ?>"></input>
                        <input id="valueLokker" class="d-none" value="<?= isset($data_kary->id_lokker) ? $data_kary->id_lokker : '-' ?>"></input>
                        <input id="valueStatTinggal" class="d-none" value="<?= isset($data_kary->stat_tinggal) ? $data_kary->stat_tinggal : '-' ?>"></input>
                        <input id="valueIDStatTinggal" class="d-none" value="<?= isset($data_kary->id_stat_tinggal) ? $data_kary->id_stat_tinggal : '' ?>"></input>
                        <input id="valueStatPerjanjian" class="d-none" value="<?= isset($data_kontrak->id_stat_perjanjian) ? $data_kontrak->id_stat_perjanjian : '' ?>"></input>
                        <input id="valueKontrakKary" class="d-none" value="<?= isset($data_kontrak->auth_kontrak_kary) ? $data_kontrak->auth_kontrak_kary : '-' ?>"></input>

                        <!-- data SIMPER/Mine Permit -->
                        <input id="valueIDIzinTambang" class="d-none" value="<?= isset($data_izin->id_izin_tambang) ? $data_izin->id_izin_tambang : '-' ?>"></input>
                        <input id="valueIDJenisIzinTambang" class="d-none" value="<?= isset($data_izin->id_jenis_izin_tambang) ? $data_izin->id_jenis_izin_tambang : '-' ?>"></input>
                        <input id="valueJenisIzinTambang" class="d-none" value="<?= isset($data_izin->jenis_izin_tambang) ? $data_izin->jenis_izin_tambang : '-' ?>"></input>
                        <input id="valueNoRegMINEPERMIT" class="d-none" value="<?= isset($data_mine_permit->no_reg) ? $data_mine_permit->no_reg : '-' ?>"></input>
                        <input id="valueTglExpiredMINEPERMIT" class="d-none" value="<?= isset($data_mine_permit->tgl_expired) ? $data_mine_permit->tgl_expired : '-' ?>"></input>
                        <input id="valueUrlMINEPERMIT" class="d-none" value="<?= isset($data_mine_permit) ? $data_mine_permit->url_izin_tambang : '-' ?>"></input>
                        <input id="valueNoRegSIMPER" class="d-none" value="<?= isset($data_simper->no_reg) ? $data_simper->no_reg : '-' ?>"></input>
                        <input id="valueTglExpiredSIMPER" class="d-none" value="<?= isset($data_simper->tgl_expired) ? $data_simper->tgl_expired : '-' ?>"></input>
                        <input id="valueUrlSIMPER" class="d-none" value="<?= isset($data_simper) ? $data_simper->url_izin_tambang : '-' ?>"></input>
                        <input id="valueTglExpired" class="d-none" value="<?= isset($data_izin->tgl_expired) ? $data_izin->tgl_expired : '-' ?>"></input>
                        <input id="valueIDSim" class="d-none" value="<?= isset($data_sim_kary->id_sim) ? $data_sim_kary->id_sim : '-' ?>"></input>
                        <input id="valueSim" class="d-none" value="<?= isset($data_izin->sim) ? $data_izin->sim : '-' ?>"></input>
                        <input id="valueUrlSIMPolisi" class="d-none" value="<?= isset($data_sim_kary) ? $data_sim_kary->url_file : '-' ?>"></input>
                        <input id="valueTglExpiredSimKary" class="d-none" value="<?= isset($data_sim_kary) ? $data_sim_kary->tgl_exp_sim : '-' ?>"></input>

                        <div class="row p-3">
                            <?php
                            if (!$this->session->csrf_token) {
                                $this->session->csrf_token = hash("sha1", time());
                            }
                            ?>

                            <input type="hidden" id="token" name="token" value="<?= $this->session->csrf_token ?>">

                            <div class="container-fluid">
                                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-uppercase" id="personal-tab" data-toggle="tab" href="#personalTab" role="tab" aria-controls="personal" aria-selected="true">Data Personal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="employee-tab" data-toggle="tab" href="#employeeTab" role="tab" aria-controls="employee" aria-selected="false">Data Karyawan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="license-tab" data-toggle="tab" href="#licenseTab" role="tab" aria-controls="license" aria-selected="false">Data Izin Tambang</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="certificate-tab" data-toggle="tab" href="#certificateTab" role="tab" aria-controls="certificate" aria-selected="false">Sertifikasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="mcu-tab" data-toggle="tab" href="#mcuTab" role="tab" aria-controls="mcu" aria-selected="false">MCU</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="vaccine-tab" data-toggle="tab" href="#vaccineTab" role="tab" aria-controls="vaccine" aria-selected="false">Vaksin</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content px-5 py-3 container-fluid" id="myTabContent">
                                <div class="tab-pane fade show active" id="personalTab" role="tabpanel">
                                    <div class="card-body row">
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <div class="alert alert-danger errPersonal animate__animated animate__bounce d-none">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editNoKTP"> No. KTP <span class="text-danger">*</span></label>
                                                <input id='editNoKTP' name='editNoKTP' type="text" autocomplete=" off" spellcheck="false" class="form-control" value="<?= $data_kary->no_ktp ?>" required>
                                                <small class="errorEditNoKTP text-danger font-italic font-weight-bold"></small>
                                                <span class="0c09efa8ccb5e0114e97df31736ce2e3"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editNamaLengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                                <input id='editNamaLengkap' name='editNamaLengkap' autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->nama_lengkap ?>" required>
                                                <small class="errorEditNamaLengkap text-danger font-italic font-weight-bold"></small>
                                                <span class="9d56835ae6e4d20993874daf592f6aca d-none"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-10 col-md-10 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editAlamatKTP">Alamat <span class="text-danger">*</span></label>
                                                <input id='editAlamatKTP' name='editAlamatKTP' type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_alamat->alamat_ktp ?>" required>
                                                <small class="errorEditAlamatKTP text-danger font-italic font-weight-bold"></small>
                                                <span class="150b3427b97bb43ac2fb3e5c687e384c d-none"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editRtKTP">RT </label>
                                                <input id='editRtKTP' name='editRtKTP' type="number" placeholder="000" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_alamat->rt_ktp ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;">
                                                <small class="erroreditRtKTP text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editRwKTP">RW </label>
                                                <input id='editRwKTP' name='editRwKTP' type="number" placeholder="000" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_alamat->rw_ktp ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;">
                                                <small class="errorEditRwKTP text-danger font-italic font-weight-bold"></small>
                                                <span class="9100fd1e98da52ac823c5fdc6d3e4ff1 d-none"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editProvData">Provinsi <span class="text-danger">*</span></label>
                                                <div id="txtEditProv" class="input-group">
                                                    <select id='editProvData' name='editProvData' type="number" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                        <option value="">-- TIDAK ADA DATA --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditProv" name="refreshEditProv" class="btn btn-primary btn-sm" title="Refresh Provinsi"><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditProvData text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editKotaData">Kabupaten / Kota
                                                    <span class="text-danger">*</span></label>
                                                <div id="txtEditKota" class="input-group">
                                                    <select id='editKotaData' name='editKotaData' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                        <option value="">-- TIDAK ADA DATA --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditKota" name="refreshEditKota" class="btn btn-primary btn-sm" title="Refresh Kabupaten/Kota"><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditKotaData text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editKecData">Kecamatan <span class="text-danger">*</span></label>
                                                <div id="txtEditKec" class="input-group">
                                                    <select id='editKecData' name='editKecData' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                        <option value="">-- TIDAK ADA DATA --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditKec" name="refreshEditKec" class="btn btn-primary btn-sm" title="Refresh Kecamatan"><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditKecData text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editKelData">Kelurahan <span class="text-danger">*</span></label>
                                                <div id="txtEditKel" class="input-group">
                                                    <select id='editKelData' name='editKelData' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                        <option value="">-- TIDAK ADA DATA --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditKel" name="refreshEditKel" class="btn btn-primary btn-sm" title="Refresh Kelurahan"><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditKelData text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editKewarganegaraan">Warga Negara
                                                    <span class="text-danger">*</span></label>
                                                <select id="editKewarganegaraan" class="mb-3 form-control">
                                                    <option value="">-- PILIH WARGA NEGARA --</option>
                                                    <option value="WNI">WNI</option>
                                                    <option value="WNA">WNA</option>
                                                </select>
                                                <small class="errorEditKewarganegaraan text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editAgama">Agama <span class="text-danger">*</span></label>
                                                <select id="editAgama" class="mb-3 form-control">
                                                    <option value="">-- WAJIB DIPILIH --</option>
                                                </select>
                                                <small class="errorEditAgama text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editJenisKelamin">Jenis Kelamin
                                                    <span class="text-danger">*</span></label>
                                                <select id="editJenisKelamin" class="mb-3 form-control">
                                                    <option value="">-- PILIH JENIS KELAMIN --</option>
                                                    <option value="LK">LAKI - LAKI</option>
                                                    <option value="P">PEREMPUAN</option>
                                                </select>
                                                <small class="errorEditJenisKelamin text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-3 col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editStatPernikahan">Status
                                                    Pernikahan <span class="text-danger">*</span></label>
                                                <div id="txtEditNikah" class="input-group">
                                                    <select id="editStatPernikahan" class="form-control">
                                                        <option value="">-- PILIH PERNIKAHAN --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditStatNikah" name="refreshStatNikah" class="btn btn-primary btn-sm" title="Refresh Status Pernikahan"><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditStatPernikahan text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-3 col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editPendidikanTerakhir">Pendidikan
                                                    Terakhir </label>
                                                <div id="txtEditDidik" name="txtEditDidik" class="input-group">
                                                    <select id='editPendidikanTerakhir' name='editPendidikanTerakhir' type="text" autocomplete="off" spellcheck="false" class="custom-select" title="Refresh Pendidikan" required>
                                                        <option value="">-- PILIH PENDIDIKAN --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditDidik" name="refreshDidik" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editTempatLahir">Tempat Lahir <span class="text-danger">*</span></label>
                                                <input id='editTempatLahir' name='editTempatLahir' type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= isset($data_kary->tmp_lahir) ? $data_kary->tmp_lahir : '' ?>" required>
                                                <small class="errorEditTempatLahir text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editTanggalLahir">Tanggal Lahir
                                                    <span class="text-danger">*</span></label>
                                                <input id='editTanggalLahir' name='editTanggalLahir' type="date" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->tgl_lahir ?>" required>
                                                <small class="errorEditTanggalLahir text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-3 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editNoBPJSTK">No. BPJS Tenaga Kerja
                                                </label>
                                                <input id='editNoBPJSTK' name='editNoBPJSTK' type="number" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->no_bpjstk ?>" required>
                                                <small class="errorEditNoBPJSTK text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-3 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editNoBPJSKES">No. BPJS Kesehatan
                                                </label>
                                                <input id='editNoBPJSKES' name='editNoBPJSKES' type="number" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->no_bpjskes ?>" required>
                                                <small class="erroreditNoBPJSKES text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-3 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editNoNPWP">No. NPWP </label>
                                                <input id='editNoNPWP' name='editNoNPWP' autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->no_npwp ?>" required>
                                                <small class="errorEditNoNPWP text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-3 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editNoKK">No. Kartu Keluarga <span class="text-danger">*</span></label>
                                                <input id='editNoKK' name='editNoKK' type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->no_kk ?>" required>
                                                <small class="errorEditNoKK text-danger font-italic font-weight-bold"></small>
                                                <span class="89kjm78ujki782m4x787909h3 d-none"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-8 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editEmail">Email Pribadi </label>
                                                <input id='editEmail' name='editEmail' type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->email_pribadi ?>" required>
                                                <small class="errorEditEmail text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editNoTelp">Nomor Telepon / Handphone </label>
                                                <input id='editNoTelp' name='editNoTelp' type="number" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->hp_1 ?>" required>
                                                <small class="errorEditNoTelp text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mt-3 col-lg-12 col-md-12 col-sm-12 text-right">
                                            <a id="editSimpanPersonal" data-scroll href="#clKaryawan" class="btn btn-primary font-weight-bold">Simpan Data</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="employeeTab" role="tabpanel">
                                    <div class="card-body row">
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <div class="alert alert-danger errmsgKary animate__animated animate__bounce d-none">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12 mb-3">
                                            <h6 class="font-weight-bold" for="editPerKary">
                                                <span><?= $data_kary->nama_perusahaan ?></span> - <span class="namalengkapshow text-uppercase"><?= $data_kary->nama_lengkap ?></span>
                                            </h6>
                                            <h6 class="text-uppercase font-weight-bold" for="editPerKary">Data Karyawan
                                            </h6>
                                            <span class="jkj234asdf u7i8o9h6u8s34 lk3kjdff3 n3m8h6x6 d-none"><?= $data_kary->auth_perusahaan ?></span>
                                            <hr style="height: 3px; background: #404443;">
                                        </div>
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editNIKKary">Nomor Register Pokok
                                                    (NRP) <span class="text-danger">*</span></label>
                                                <input id="editNIKKary" name="editNIK" type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="<?= $data_kary->no_nik ?>">
                                                <small class="errorEditNIKKary text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editDepartKary">Departemen <span class="text-danger">*</span></label>
                                                <div id='txtEditDepartKary' class="input-group">
                                                    <select id='editDepartKary' name='editDepartKary' class="form-control form-control-user" disabled>
                                                        <option value="">-- WAJIB DIPILIH --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditDepart" name="refreshEditDepart" class="btn btn-primary btn-sm" title="Refresh Departemen" disabled><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditDepartKary text-danger font-italic font-weight-bold"></small>
                                                <span class="c1492f38214db699dfd3574b2644271d d-none"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editPosisiKary">Posisi <span class="text-danger">*</span></label>
                                                <div id='txtEditPosisiKary' class="input-group">
                                                    <select id='editPosisiKary' name='editPosisiKary' class="form-control form-control-user" disabled>
                                                        <option value="">-- WAJIB DIPILIH --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditPosisi" name="refreshEditPosisi" class="btn btn-primary btn-sm" title="Refresh Posisi" disabled><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditPosisiKary text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editKlasifikasiKary">Klasifikasi
                                                    <span class="text-danger">*</span></label>
                                                <div id="txtEditKlasifikasiKary" class="input-group">
                                                    <select id="editKlasifikasiKary" name="editKlasifikasiKary" class="form-control form-control-user">
                                                        <option value="">-- WAJIB DIPILIH --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button on id="refreshEditKlasifikasi" name="refreshEditKlasifikasi" class="btn btn-primary btn-sm" title="Refresh Klasifikasi" disabled><i class="fas fa-sync-alt"></i></button>
                                                        <button on id="infoEditKlasifikasi" name="infoEditKlasifikasi" class="btn btn-warning btn-sm" title="Informasi" disabled><i class="fas fa-info-circle"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditKlasifikasiKary text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="addTipeKaryawan">Golongan <span class="text-danger">*</span></label>
                                                <div id='txtEditJeniskary' class="input-group">
                                                    <select id='editTipeKary' name='editTipeKary' class="form-control form-control-user">
                                                        <option value="">-- WAJIB DIPILIH --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditTipe" name="refreshEditTipe" class="btn btn-primary btn-sm" title="Refresh Golongan" disabled><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditTipeKary text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editLevelKary">Level <span class="text-danger">*</span></label>
                                                <div id='txtEditLevelKary' class="input-group">
                                                    <select id='editLevelKary' name='editLevelKary' class="form-control form-control-user">
                                                        <option value="">-- WAJIB DIPILIH --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditLevel" name="refreshEditLevel" class="btn btn-primary btn-sm" title="Refresh Level" disabled><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditLevelKary text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editPOHKary">Point of Hire <span class="text-danger">*</span></label>
                                                <div id='txtEditPOHKary' class="input-group">
                                                    <select id='editPOHKary' name='editPOHKary' class="form-control form-control-user">
                                                        <option value="">-- WAJIB DIPILIH --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditPOH" name="refreshEditPOH" class="btn btn-primary btn-sm" title="Refresh Point of Hire" disabled><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="erroreEditPOHKary text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editLokterimaKary">Lokasi
                                                    Penerimaan <span class="text-danger">*</span></label>
                                                <div id='txtEditLokterimaKary' class="input-group">
                                                    <select id='editLokterimaKary' name='editLokterimaKary' class="form-control form-control-user">
                                                        <option value="0">-- WAJIB DIPILIH --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditLokterima" name="refreshEditLokterima" class="btn btn-primary btn-sm" title="Refresh Lokasi Penerimaan" disabled><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditLokterimaKary text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editLokkerKary">Lokasi Kerja <span class="text-danger">*</span></label>
                                                <div id='txtEditLokkerKary' class="input-group">
                                                    <select id='editLokkerKary' name='editLokkerKary' class="form-control form-control-user">
                                                        <option value="0">-- WAJIB DIPILIH --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditLokker" name="refreshEditLokker" class="btn btn-primary btn-sm" title="Refresh Lokasi Kerja" disabled><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditLokkerKary text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editStatusResidence">Status
                                                    Residence <span class="text-danger">*</span></label>
                                                <div id='txtEditStatResidence' class="input-group">
                                                    <select id='editStatusResidence' name='editStatusResidence' class="form-control form-control-user">
                                                        <option value="" default>-- WAJIB DIPILIH --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditResidence" name="refreshEditResidence" class="btn btn-primary btn-sm" title="Refresh Status Residence"><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditStatusResidence text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editDOH">Date of Hire <span class="text-danger">*</span></label>
                                                <input id='editDOH' name='editDOH' type='date' class="form-control form-control-user" value="<?= $data_kary->doh ?>">
                                                <small class="errorEditDOH text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editTanggalAktif">Tanggal Aktif
                                                    <span class="text-danger">*</span></label>
                                                <input id='editTanggalAktif' name='editTanggalAktif' type='date' class="form-control form-control-user" value="<?= $data_kary->tgl_aktif ?>">
                                                <small class="errorEditTanggalAktif text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editEmailKantor">Email Perusahaan
                                                </label>
                                                <input id='editEmailKantor' name='editEmailKantor' type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->email_kantor ?>" required>
                                                <small class="errorEditEmailKantor text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editStatusKerjaKary">Status
                                                    Karyawan <span class="text-danger">*</span></label>
                                                <div id='txtEditStatKerjaKary' class="input-group mt-2">
                                                    <select id='editStatusKerjaKary' name='editStatusKerjaKary' class="form-control form-control-user">
                                                        <option value="">-- WAJIB DIISI --</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button id="refreshEditStatKaryawan" name="refreshEditStatKaryawan" title="Refresh Status Karyawan" class="btn btn-primary btn-sm" disabled><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                                <small class="errorEditStatusKerjaKary text-danger font-italic font-weight-bold"></small>
                                            </div>
                                        </div>
                                        <div id="editFieldPermanen" class="mb-3 col-lg-6 col-md-6 col-sm-12 d-none">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editTanggalPermanen">Tanggal
                                                    Permanen <span class="text-danger">*</span></label>
                                                <input id='editTanggalPermanen' name='editTanggalPermanen' type="date" class="form-control" value="<?= isset($data_kontrak->tgl_mulai) ? $data_kontrak->tgl_mulai : '' ?>" style="background-color:transparent;">
                                                <small class="errorEditTanggalPermanen text-danger font-italic font-weight-bold" style="font-size:13px;"></small>
                                            </div>
                                        </div>
                                        <div id="editFieldKontrakAwal" class="mb-3 col-lg-3 col-md-3 col-sm-12 d-none">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editTanggalKontrakAwal">Tanggal
                                                    Awal <span class="text-danger">*</span></label>
                                                <input id='editTanggalKontrakAwal' name='editTanggalKontrakAwal' type="date" class="form-control" value="<?= isset($data_kontrak->tgl_mulai) ? $data_kontrak->tgl_mulai : '' ?>" style="background-color:transparent;">
                                                <small class="errorEditTanggalKontrakAwal text-danger font-italic font-weight-bold" style="font-size:13px;"></small>
                                            </div>
                                        </div>
                                        <div id="editFieldKontrakAkhir" class="mb-3 col-lg-3 col-md-3 col-sm-12 d-none">
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editTanggalKontrakAkhir">Tanggal
                                                    Berakhir <span class="text-danger">*</span></label>
                                                <input id='editTanggalKontrakAkhir' name='editTanggalKontrakAkhir' type="date" class="form-control" value="<?= isset($data_kontrak->tgl_akhir) ? $data_kontrak->tgl_akhir : '' ?>" style="background-color:transparent;">
                                                <small class="errorEditTanggalKontrakAkhir text-danger font-italic font-weight-bold" style="font-size:13px;"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                            <a id="editSimpanPekerjaan" class="btn btn-primary font-weight-bold text-white" style="margin-left:30px;">Simpan Data</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="licenseTab" role="tabpanel">
                                    <div class="card-body row">
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <div class="alert alert-danger errorMsgEditIzin animate__animated animate__bounce d-none"></div>
                                        </div>
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12 mb-3">
                                            <h6 class="font-weight-bold" for="editPerKary">
                                                <span><?= $data_kary->nama_perusahaan ?></span> - <span class="namalengkapshow text-uppercase"><?= $data_kary->nama_lengkap ?></span>
                                            </h6>
                                            <span class="jkj234asdf u7i8o9h6u8s34 lk3kjdff3 n3m8h6x6 d-none"><?= $data_kary->auth_perusahaan ?></span>
                                            <h6 class="text-uppercase font-weight-bold" for="editPerKary">Data Izin Tambang</h6>
                                            <hr style="height: 3px; background: #404443;">
                                        </div>

                                        <?php if (isset($data_izin->jenis_izin_tambang)) { ?>
                                            <div class="card-body row">
                                                <?php if (isset($data_mine_permit)) { ?>
                                                    <div class=" mb-3 col-lg-12 col-md-12 col-sm-12">
                                                        <table id="tbmMINEPERMITDetail" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                            <tr>
                                                                <th style="width: 50%;">No. Registrasi Mine Permit</th>
                                                                <th style="text-align:center; width: 30%;">Tanggal Expired</th>
                                                                <th style="text-align:center; width: 10%;">Aksi</th>
                                                            </tr>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="d-none">
                                                                        <input style="background-color: none;" id='noSertifikatDetail' name='noSertifikatDetail' type="text" class="form-control" value="<?= $data_mine_permit->no_reg ?>">
                                                                    </td>
                                                                    <td id="valueNoRegMinePermit" class=""><?= $data_mine_permit->no_reg ?></td>
                                                                    <td id="valueTglExpMinePermit" class="align-middle text-center"><?= $data_mine_permit->tgl_expired ?></td>
                                                                    <td style="text-align:center;" style="width: 10%;">
                                                                        <button id="btnEditMinePermit" class="btn btn-success btn-sm text-white" title="Edit detail MINE PERMIT"><i class="fas fa-edit"></i></button>
                                                                        <a href="<?= base_url('karyawan/berkasizin/') . $data_mine_permit->auth_izin_tambang ?>" target="_blank" class="btn btn-primary btn-sm text-white" title="Tampilkan MINE PERMIT"><i class="fas fa-file-alt"></i></a>
                                                                        <button id="btnReuploadMinePermit" class="btn btn-warning btn-sm text-white" title="Upload ulang MINE PERMIT"><i class="fas fa-file-upload"></i></button>
                                                                        <button id="btnDeleteMinePermit" class="btn btn-danger btn-sm text-white" title="Hapus data MINE PERMIT"><i class="fas fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            <tbody>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($data_simper)) { ?>
                                                    <div class=" mb-3 col-lg-12 col-md-12 col-sm-12">
                                                        <table id="tbmSIMPERDetail" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                            <tr>
                                                                <th style="width: 50%;">No. Registrasi SIMPER</th>
                                                                <th style="text-align:center; width: 30%;">Tanggal Expired</th>
                                                                <th style="text-align:center; width: 10%;">Aksi</th>
                                                            </tr>
                                                            <tbody>
                                                                <tr>
                                                                    <td id="valueNoRegSimper"><?= $data_simper->no_reg ?> </td>
                                                                    <td id="valueTglExpSimper" class="align-middle text-center"><?= $data_simper->tgl_expired ?></td>
                                                                    <td style="text-align:center;" style="width: 10%;">
                                                                        <button id="btnEditSimper" class="btn btn-success btn-sm text-white" title="Edit detail SIMPER"><i class="fas fa-edit"></i></button>
                                                                        <a href="<?= base_url('karyawan/berkasizin/') . $data_simper->auth_izin_tambang ?>" target="_blank" class="btn btn-primary btn-sm text-white" title="Tampilkan SIMPER"><i class="fas fa-file-alt"></i></a>
                                                                        <button id="btnReuploadSimper" class="btn btn-warning btn-sm text-white" title="Upload ulang SIMPER"><i class="fas fa-file-upload"></i></button>
                                                                        <button id="btnDeleteSimper" class="btn btn-danger btn-sm text-white" title="Hapus data SIMPER"><i class="fas fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            <tbody>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($data_sim_kary)) { ?>
                                                    <div class=" mb-3 col-lg-12 col-md-12 col-sm-12">
                                                        <table id="tbmSIMDetail" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                            <tr>
                                                                <th style="width: 50%;">Jenis SIM</th>
                                                                <th style="text-align:center; width: 30%;">Tanggal Expired</th>
                                                                <th style="text-align:center; width: 10%;">Aksi</th>
                                                            </tr>
                                                            <tbody>
                                                                <tr>
                                                                    <td id="valueJenisSim"><?= $data_sim_kary->sim ?></td>
                                                                    <td id="valueTglExpSim" class="align-middle text-center"><?= $data_sim_kary->tgl_exp_sim ?></td>
                                                                    <td style="text-align:center;" style="width: 10%;">
                                                                        <button id="btnEditSIM" class="btn btn-success btn-sm text-white" title="Edit detail sim"><i class="fas fa-edit"></i></button>
                                                                        <a href="<?= base_url('karyawan/berkassim/') . $data_sim_kary->auth_sim_kary ?>" target="_blank" class="btn btn-primary btn-sm text-white" title="Tampilkan SIM"><i class="fas fa-file-alt"></i></a>
                                                                        <button id="btnReuploadSIM" class="btn btn-warning btn-sm text-white" title="Upload ulang SIM"><i class="fas fa-file-upload"></i></button>
                                                                        <button id="btnDeleteSIM" class="btn btn-danger btn-sm text-white" title="Hapus data SIM"><i class="fas fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            <tbody>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <div class="card-body row justify-content-center">
                                                    <h5 style='text-align:center;'>Data Izin Tambang Tidak Ditemukan.</h5>
                                                </div>
                                            <?php } ?>
                                            </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="certificateTab" role="tabpanel">
                                    <div class="card-body row">
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <div class="alert alert-danger errorMsgEditIzin animate__animated animate__bounce d-none">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12 mb-3">
                                            <h6 class="font-weight-bold" for="editPerKary">
                                                <span><?= $data_kary->nama_perusahaan ?></span> - <span class="namalengkapshow text-uppercase"><?= $data_kary->nama_lengkap ?></span>
                                            </h6>
                                            <h6 class="text-uppercase font-weight-bold" for="editPerKary">Data Sertifikasi</h6>
                                            <span class="jkj234asdf u7i8o9h6u8s34 lk3kjdff3 n3m8h6x6 d-none"><?= $data_kary->auth_perusahaan ?></span>
                                            <hr style="height: 3px; background: #404443;">
                                        </div>

                                        <div id="idEditSertifikat" class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="mcuTab" role="tabpanel">
                                    <div class="card-body row">
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <div class="alert alert-danger errorMsgEditIzin animate__animated animate__bounce d-none">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12 mb-3">
                                            <h6 class="font-weight-bold" for="editPerKary">
                                                <span><?= $data_kary->nama_perusahaan ?></span> - <span class="namalengkapshow text-uppercase"><?= $data_kary->nama_lengkap ?></span>
                                            </h6>
                                            <h6 class="text-uppercase font-weight-bold" for="editPerKary">Data Medical
                                                Check Up</h6>
                                            <span class="jkj234asdf u7i8o9h6u8s34 lk3kjdff3 n3m8h6x6 d-none"><?= $data_kary->auth_perusahaan ?></span>
                                            <hr style="height: 3px; background: #404443;">
                                        </div>

                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12" id="dataEditMCU">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="vaccineTab" role="tabpanel">
                                    <div class="card-body row">
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <div class="alert alert-danger errorMsgEditIzin animate__animated animate__bounce d-none">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12 mb-3">
                                            <h6 class="font-weight-bold" for="editPerKary">
                                                <span><?= $data_kary->nama_perusahaan ?></span> - <span class="namalengkapshow text-uppercase"><?= $data_kary->nama_lengkap ?></span>
                                            </h6>
                                            <h6 class="text-uppercase font-weight-bold" for="editPerKary">Data Vaksinasi
                                            </h6>
                                            <span class="jkj234asdf u7i8o9h6u8s34 lk3kjdff3 n3m8h6x6 d-none"><?= $data_kary->auth_perusahaan ?></span>
                                            <hr style="height: 3px; background: #404443;">
                                        </div>

                                        <div id="idEditVaccine" class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdldetailsertifikat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow align-middle d-flex align-items-center">
                <h5 class="modal-title text-white align-middle" id="jdldetailsertifikat">Detail Sertifikat</h5>
                <button data-dismiss="modal" class="btn btn-sm btn-icon btn-danger"><i class="feather icon-x"></i></button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="jenisSertifikasiDetail">Jenis Sertifikasi :</label>
                            <input style="background-color: none;" id='jenisSertifikasiDetail' name='jenisSertifikasiDetail' class="form-control" value="" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="noSertifikatDetail">No. Sertifikasi :</label>
                            <input style="background-color: none;" id='noSertifikatDetail' name='noSertifikatDetail' type="text" class="form-control" value="" disabled>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="namaLembagaDetail">Nama Lembaga :</label>
                            <input style="background-color: none;" id='namaLembagaDetail' name='namaLembagaDetail' type="text" class="form-control" value="" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="tanggalSertifikasiDetail">Tanggal Sertifikasi :</label>
                            <input style="background-color: none;" id='tanggalSertifikasiDetail' name='tanggalSertifikasiDetail' type="text" class="form-control" value="" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="tanggalSertifikasiAkhirDetail">Tanggal Expired
                                :</label>
                            <input style="background-color: none;" id='tanggalSertifikasiAkhirDetail' name='tanggalSertifikasiAkhirEdit' type="text" class="form-control" value="" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlEditIzinTambang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow d-flex align-items-center align-middle">
                <h5 class="modal-title text-white align-middle font-weight-bold" id="jdlEditIzinTambang"></h5>
                <button data-dismiss="modal" class="btn btn-sm btn-icon btn-danger"><i class="feather icon-x"></i></button>
            </div>

            <div class="modal-body">
                <div class="row px-3">
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                        <div class="alert errEditIzinTambang alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                    </div>
                    <div id="fieldEditJenisSIM" class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="editJenisSIM">Jenis SIM :</label>
                            <div id="txtEditJenisSIM" class="input-group">
                                <select id='editJenisSIM' name='editJenisSIM' autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                    <option value="">-- WAJIB DIPILIH --</option>
                                </select>
                                <!-- <div class="input-group-prepend">
                                    <button id="refreshEditJenisSIM" name="refreshEditJenisSIM" class="btn btn-primary btn-sm" disabled><i class="fas fa-sync-alt"></i></button>
                                </div> -->
                            </div>
                            <small class="errorEditJenisSIM text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <!-- No Registrasi -->
                    <div id="fieldEditNoRegIzin" class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" id="captionEditNoRegIzin" for="editNoRegIzin">No. Registrasi :</label>
                            <input id='editNoRegIzin' name='editNoRegIzin' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                            <small class="errorEditNoRegIzin text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <!-- Tanggal Expired -->
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" id="captionEditTanggalExpired" for="editTanggalExpired">Tanggal Expired :</label>
                            <input id='editTanggalExpired' name='editTanggalExpired' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                            <small class="errorEditTanggalExpired text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-3">
                <button type="button" name="btnSimpanEdit" id="btnSaveEditMINEPERMIT" class="d-none btn font-weight-bold btn-primary mr-3">Simpan Data</button>
                <button type="button" name="btnSimpanEdit" id="btnSaveEditSIMPER" class="d-none btn font-weight-bold btn-primary mr-3">Simpan Data</button>
                <button type="button" name="btnSimpanEdit" id="btnSaveEditSIM" class="d-none btn font-weight-bold btn-primary mr-3">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlUploadUlangIzinTambang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:50%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="jdlMdlUploadUlangIzinTambang"></h5>
            </div>

            <div class="modal-body">
                <div class="d-flex-row justify-content-between">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="alert errorReuploadIzin alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                        <div>
                            <h6 class="text-danger font-italic" id="captionMdlUploadUlangIzinTambang"></h6>
                        </div>
                        <div class="form-group">
                            <label for="fileReuploadIzin" class="d-none font-weight-bold" id="captionLblUploadUlangIzinTambang">Upload file sertifikat :</label>
                            <input type="file" class="form-control-file" id="fileReuploadIzin">
                            <small class="errorFileReuploadIzin text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-3">
                <button type="button" name="btnEditReupload" id="btnSaveReuploadMINEPERMIT" class="d-none btn font-weight-bold btn-primary mr-3">Upload File</button>
                <button type="button" name="btnEditReupload" id="btnSaveReuploadSIMPER" class="d-none btn font-weight-bold btn-primary mr-3">Upload File</button>
                <button type="button" name="btnEditReupload" id="btnSaveReuploadSIM" class="d-none btn font-weight-bold btn-primary mr-3">Upload File</button>
                <button name="btnbataluploadulangser" id="btnBatalReupload" data-dismiss="modal" class="btn font-weight-bold btn-warning">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdluploadulangser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:50%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="jdluploadulangser">Upload Ulang Sertifikat</h5>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="alert erruploadulangser alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                        <div>
                            <h6 class="text-danger font-italic">Catatan : Upload file Sertifikat dalam format pdf,
                                ukuran file Sertifikat maksimal 300 kb.</h6>
                        </div>
                        <div class="form-group">
                            <label for="fileSertifikasiUlang"><b>Upload file sertifikat</b> :</label>
                            <input type="file" class="form-control-file" id="fileSertifikasiUlang">
                            <small class="errorFileSertifikasiUlang text-danger font-italic font-weight-bold"></small>
                            <span class="9f7fjmuj8ik2js4n8k66g3hjl323 d-none"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-3">
                <button type="button" name="btnEditReuploadSertifikat" id="btnEditReuploadSertifikat" class="btn font-weight-bold btn-primary mr-3">Upload File</button>
                <button name="btnbataluploadulangser" id="btnbataluploadulangser" data-dismiss="modal" class="btn font-weight-bold btn-warning">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdleditsertifikat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow d-flex align-items-center align-middle">
                <h5 class="modal-title text-white align-middle font-weight-bold" id="jdlEditSertifikat">Edit Sertifikat
                </h5>
                <button data-dismiss="modal" class="btn btn-sm btn-icon btn-danger"><i class="feather icon-x"></i></button>
            </div>

            <div class="modal-body">
                <div class="row px-3">
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                        <div class="alert erreditsertifikat alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                    </div>
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="jenisSertifikasiEdit">Jenis Sertifikasi :</label>
                            <div id="txtjenisSertifikasiEdit" class="input-group">
                                <select id='jenisSertifikasiEdit' name='jenisSertifikasiEdit' autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                    <option value="">-- WAJIB DIPILIH --</option>
                                </select>
                                <div class="input-group-prepend">
                                    <button id="refreshjenisSertifikasiEdit" name="refreshjenisSertifikasiEdit" class="btn btn-primary btn-sm" disabled><i class="fas fa-sync-alt"></i></button>
                                </div>
                            </div>
                            <small class="errorjenisSertifikasiEdit text-danger font-italic font-weight-bold"></small>
                            <span class="7u67u834hs7dg4haj231hh67ju7a2 d-none"></span>
                        </div>
                    </div>
                    <div class="mb-3 col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="noSertifikatEdit">No. Sertifikasi :</label>
                            <input id='noSertifikatEdit' name='noSertifikatEdit' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                            <small class="errorNoSertifikatEdit text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="mb-3 col-lg-8 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="namaLembagaEdit">Nama Lembaga :</label>
                            <input id='namaLembagaEdit' name='namaLembagaEdit' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                            <small class="errorNamaLembagaEdit text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="tanggalSertifikasiEdit">Tanggal Sertifikasi :</label>
                            <input id='tanggalSertifikasiEdit' name='tanggalSertifikasiEdit' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                            <small class="errorTanggalSertifikasiEdit text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="masaBerlakuSertifikatEdit">Masa Berlaku (Tahun)
                                :</label>
                            <select id='masaBerlakuSertifikatEdit' name='masaBerlakuSertifikatEdit' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                <option value="">-- PILIH MASA BERLAKU --</option>
                                <option value="1">1 TAHUN</option>
                                <option value="2">2 TAHUN</option>
                                <option value="3">3 TAHUN</option>
                                <option value="4">4 TAHUN</option>
                                <option value="5">5 TAHUN</option>
                                <option value="6">6 TAHUN</option>
                                <option value="7">7 TAHUN</option>
                                <option value="8">8 TAHUN</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="tanggalSertifikasiAkhirEdit">Tanggal Expired :</label>
                            <input id='tanggalSertifikasiAkhirEdit' name='tanggalSertifikasiAkhirEdit' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                            <small class="errorTanggalSertifikasiAkhir text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-3">
                <button type="button" name="btnSimpanEditSertifikat" id="btnSimpanEditSertifikat" class="btn font-weight-bold btn-primary">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlDetailMCU" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow align-middle d-flex align-items-center">
                <h5 class="modal-title text-white align-middle">Detail Medical Check Up</h5>
                <button data-dismiss="modal" class="btn btn-sm btn-icon btn-danger"><i class="feather icon-x"></i></button>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="alert alert-danger errorDetailMCU animate__animated animate__bounce d-none">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="tanggalMCU">Tanggal Medical Check Up
                                :</label>
                            <input style="background-color: none;" type="text" id='tanggalMCU' class="form-control" value="" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="hasilMCU">Hasil Medical Check Up :</label>
                            <input style="background-color: none;" id='hasilMCU' type="text" class="form-control" value="" disabled>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="keteranganMCU">Keterangan :</label>
                            <textarea class="form-control" id="keteranganMCU" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlUploadMCU" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white">Upload Ulang File MCU</h5>
            </div>
            <form action="javascript:void(0)" id="uploadUlangMCU" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="alert errUploadMCU alert-danger animate__animated animate__bounce d-none" role="alert">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div>
                                <h6 class="text-danger font-italic">Catatan : Upload file MCU dalam format pdf,
                                    ukuran file MCU maksimal 200 kb.</h6>
                            </div>
                            <div class="form-group">
                                <label for="fileMCUnew" class="form-label">File MCU <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="fileMCUnew" name="fileMCUnew" accept=".pdf" required>
                                <small class="errorFileMCUnew text-danger font-italic font-weight-bold"></small>
                            </div>
                            <span class="bg83t12trgr98h9 d-none"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" class="btn font-weight-bold btn-primary">Upload
                        Data</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-warning">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlEditMCU" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white">Edit MCU</h5>
            </div>
            <form action="javascript:void(0)" id="editMCU" method="post" data-parsley-validate>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="alert errEditMCU alert-danger animate__animated animate__bounce d-none" role="alert">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="editTanggalMCU" class="form-label">Tanggal MCU <span class="text-danger">*</span></label>
                                <input id='editTanggalMCU' type="date" autocomplete="off" spellcheck="false" class="form-control" max="<?= date('Y-m-d') ?>" value="" required>
                                <span class="89621y398thnr8 d-none"></span>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="form-group">
                                <label for="editHasilMCU" class="form-label">Hasil MCU <span class="text-danger">*</span></label>
                                <select id='editHasilMCU' autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="editKeteranganMCU" class="form-label">Keterangan <span class="text-danger">*</span></label>
                                <textarea id='editKeteranganMCU' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" class="btn font-weight-bold btn-primary">Upload
                        Data</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-warning">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlEditVaksin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow align-middle d-flex align-items-center">
                <h5 class="modal-title text-white align-middle">Edit Data Vaksin</h5>
            </div>
            <form action="javascript:void(0)" id="updateDataVaksin" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="alert alert-danger erroreditvaksin animate__animated animate__bounce d-none">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="font-weight-bold form-label" for="jenisVaksin">Jenis Vaksin</label>
                                <select id='jenisVaksin' autocomplete="off" spellcheck="false" class="form-control" value="" disabled>
                                    <option value="">-- PILIH JENIS VAKSIN --</option>
                                </select>
                                <span class="fb19rg2hrr2hr52980r2 d-none"></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="font-weight-bold form-label" for="namaVaksin">Nama Vaksin <span class="text-danger">*</span></label>
                                <select id='namaVaksin' autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                    <option value="">-- PILIH VAKSIN --</option>
                                </select>
                                <span class="b912rgh298htrnt8 d-none"></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="font-weight-bold form-label" for="tanggalVaksin">Tanggal Vaksin <span class="text-danger">*</span></label>
                                <input style="background-color: none;" id='tanggalVaksin' type="date" autocomplete="off" spellcheck="false" max="<?= date('Y-m-d') ?>" class="form-control" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-3">
                    <button type="submit" class="btn font-weight-bold btn-primary">Simpan Data</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <script>
    // Access the data in JavaScript
    var myData = "<?php echo $jsonData; ?>";
    console.log(myData);
</script> -->