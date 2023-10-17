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
                                <a id="bc1" href="#">
                                    Karyawan
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="bc2">
                                    Tabel Karyawan
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12" style="overflow-x:auto;">
                <div class="card latest-update-card">
                    <div class="card-header">
                        <h5>Karyawan</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item minimize-card">
                                        <a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span
                                                style="display: none"><i class="feather icon-plus"></i>
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
                        <div class="mt-3">
                            <div class="mb-2">
                                <a href="<?= base_url('karyawan'); ?>" class="btn btn-warning font-weight-bold"><i
                                        class="fas fa-eraser"></i> Reset</a>
                                <a id="addRefreshKary" href="#!" class="btn btn-primary font-weight-bold"><i
                                        class="fas fa-sync-alt"></i> Refresh</a>
                                <a id="addTambahKary" href="<?= base_url('karyawan/new'); ?>" target="_blank"
                                    class=" btn btn-success font-weight-bold"><i class="fas fa-plus"></i> Tambah
                                    Data</a>
                            </div>
                            <div class="alert alert-danger err_psn_kary animate__animated animate__bounce d-none"></div>
                        </div>
                        <div class="row">

                            <?php

                                   if (!$this->session->csrf_token) {
                                        $this->session->csrf_token = hash("sha1", time());
                                   }

                                   ?>

                            <input type="hidden" id="token" name="token" value="<?= $this->session->csrf_token ?>">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div
                                    class="alert alert-danger errormsgper animate__animated animate__bounce d-none mb-3">
                                </div>
                                <h6 class="mt-3">Pilih Perusahaan Utama<span class="text-danger">*</span></h6>
                                <select id='perJenisData' name='perJenisData' class="form-control form-control-user">
                                    <option value="">-- PILIH PERUSAHAAN --</option>
                                    <?= $permst . $perstr; ?>
                                </select>
                                <small class="error1str text-danger font-italic font-weight-bold"></small><br>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-12 ml-4 mb-3">
                                <input type="checkbox" class="form-check-input" id="krycekNonaktif">
                                <label for="krycekNonaktif" class="form-check-label">Tampilkan karyawan
                                    nonaktif</label><br>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tbmKaryawan"
                                        class="table table-striped table-bordered table-hover text-black"
                                        style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                        <thead>
                                            <tr class="font-weight-boldtext-white">
                                                <th style="text-align:center;">Aksi</th>
                                                <th style="text-align:center;width:1%;">No.</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Departemen</th>
                                                <th>Posisi</th>
                                                <th>Perusahaan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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
<div class="modal fade" id="mdlnewfotokaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="exampleModalLabel">Update Foto Karyawan</h5>
            </div>
            <form action="javascript:void(0)" id="gantiFotoKaryawan" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="alert errnewfotokaryawan alert-danger animate__animated animate__bounce d-none"
                                role="alert"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <div class='text-danger font-italic'>
                                <div>
                                    <h6>Catatan Foto Karyawan :</h6>
                                </div>
                                <div>
                                    <ul>
                                        <li>Upload foto karyawan dalam format jpg.</li>
                                        <li>Ukuran foto karyawan maksimal 100 kb.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fotoKaryawanNew" class="form-label"><b>Foto Karyawan <span
                                            class="text-danger">*</span></b></label>
                                <input type="file" class="form-control-file" id="fotoKaryawanNew" accept=".jpg"
                                    required>
                                <small class="errorfotoKaryawanNew text-danger font-italic font-weight-bold"></small>
                                <span class="76235ft67gfrubf12 d-none"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" name="btnnewfotokaryawan" class="btn font-weight-bold btn-primary">Upload
                        Data</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-warning">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlnewsertifikat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Sertifikat</h5>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="alert errnewsertifikat alert-danger animate__animated animate__bounce d-none"
                            role="alert"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="jenisSertifikasiNew">Jenis Sertifikasi :</label>
                            <select id='jenisSertifikasiNew' name='jenisSertifikasiNew' autocomplete="off"
                                spellcheck="false" class="form-control" value="" required>
                                <option value="">-- WAJIB DIPILIH --</option>
                            </select>
                            <small class="errorjenisSertifikasiNew text-danger font-italic font-weight-bold"></small>
                            <span class="8k23jnm89d56jl123mn90bv542ll d-none"></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="noSertifikatNew">No. Sertifikasi :</label>
                            <input id='noSertifikatNew' name='noSertifikatNew' type="text" autocomplete="off"
                                spellcheck="false" class="form-control" value="" required>
                            <small class="errorNoSertifikatNew text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="namaLembagaNew">Nama Lembaga :</label>
                            <input id='namaLembagaNew' name='namaLembagaNew' type="text" autocomplete="off"
                                spellcheck="false" class="form-control" value="" required>
                            <small class="errorNamaLembagaNew text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="tanggalSertifikasiNew">Tanggal Sertifikasi :</label>
                            <input id='tanggalSertifikasiNew' name='tanggalSertifikasiNew' type="date"
                                autocomplete="off" spellcheck="false" class="form-control" value="" required>
                            <small class="errorTanggalSertifikasiNew text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="masaBerlakuSertifikatNew">Masa Berlaku (Tahun) :</label>
                            <select id='masaBerlakuSertifikatNew' name='masaBerlakuSertifikatNew' type="date"
                                autocomplete="off" spellcheck="false" class="form-control" value="" required>
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
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="tanggalSertifikasiAkhirNew">Tanggal Expired :</label>
                            <input id='tanggalSertifikasiAkhirNew' name='tanggalSertifikasiAkhirNew' type="date"
                                autocomplete="off" spellcheck="false" class="form-control" value="" required>
                            <small
                                class="errorTanggalSertifikasiAkhir text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                        <div>
                            <h6 class="text-danger font-italic">Catatan : Upload file Sertifikat dalam format pdf,
                                ukuran file Sertifikat maksimal 300 kb.</h6>
                        </div>
                        <div class="form-group">
                            <label for="fileSertifikasi"><b>Upload file sertifikat</b> :</label>
                            <input type="file" class="form-control-file" id="fileSertifikasi">
                            <small class="errorFileSertifikasi text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="button" name="btnnewsertifikat" id="btnnewsertifikat"
                    class="btn font-weight-bold btn-primary">Upload Data</button>
                <button name="btnbatalsertifikat" id="btnbatalsertifikat" data-dismiss="modal"
                    class="btn font-weight-bold btn-warning">Batal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlnewvaksin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data Vaksin</h5>
            </div>
            <form action="javascript:void(0)" id="tambahDataVaksin" method="post" data-parsley-validate>
                <span class="t9018htg2398th259 d-none"></span>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="alert alert-danger errornewvaksin animate__animated animate__bounce d-none">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div id="jnsVaksin" class="form-group">
                                <label for="jenisVaksin" class="form-label">Jenis Vaksin <span class="text-danger">*</span></label>
                                <div id="txtjenisVaksin" class="input-group">
                                    <select id='jenisVaksin' name='jenisVaksin' type="text" autocomplete="off"
                                        spellcheck="false" class="form-control" value="" required>
                                        <option value="">-- PILIH JENIS VAKSIN --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div id="nmVaksin" class="form-group">
                                <label for="namaVaksin" class="form-label">Nama Vaksin <span class="text-danger">*</span></label>
                                <div id="txtnamaVaksin" class="input-group">
                                    <select id='namaVaksin' name='namaVaksin' type="text" autocomplete="off"
                                        spellcheck="false" class="form-control" value="" required>
                                        <option value="">-- PILIH VAKSIN --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div id="tglVaksin" class="form-group">
                                <label for="tanggalVaksin" class="form-label">Tanggal Vaksin <span class="text-danger">*</span></label>
                                <input id='tanggalVaksin' name='tanggalVaksin' type="date" autocomplete="off"
                                    spellcheck="false" class="form-control" max="<?= date('Y-m-d') ?>" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" name="btnnewvaksin" class="btn font-weight-bold btn-primary">Simpan
                        Data</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-warning">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlnewmcu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="exampleModalLabel">Tambah MCU</h5>
            </div>

            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="alert errnewmcu alert-danger animate__animated animate__bounce d-none" role="alert">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="tglMCUnew">Tanggal MCU <span class="text-danger">*</span></label>
                            <input id='tglMCUnew' name='tglMCUnew' type="date" autocomplete="off" spellcheck="false"
                                class="form-control" value="" required>
                            <small class="errorTglMCUnew text-danger font-italic font-weight-bold"></small>
                            <span class="890123hjn34267xcxvbj7234hh d-none"></span>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="form-group">
                            <label for="hasilMCUnew">Hasil MCU <span class="text-danger">*</span></label>
                            <select id='hasilMCUnew' name='hasilMCUnew' autocomplete="off" spellcheck="false"
                                class="form-control" value="" required>
                                <option value="">-- WAJID DIPILIH --</option>
                            </select>
                            <small class="errorHasilMCUnew text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="ketMCUnew">Keterangan <span class="text-danger">*</span></label>
                            <textarea id='ketMCUnew' name='ketMCUnew' type="text" autocomplete="off" spellcheck="false"
                                class="form-control" value="" required></textarea>
                            <small class="errorKetMCUnew text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div>
                            <h6 class="text-danger font-italic">Catatan : Upload file MCU dalam format pdf, ukuran file
                                MCU maksimal 200 kb.</h6>
                        </div>
                        <div class="form-group">
                            <label for="fileMCUnew">Upload file MCU :</label>
                            <input type="file" class="form-control-file" id="fileMCUnew" name="fileMCUnew">
                            <small class="errorFileMCUnew text-danger font-italic font-weight-bold"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="button" name="btnnewMCU" id="btnnewMCU" class="btn font-weight-bold btn-primary">Upload
                    Data</button>
                <button name="btnbatalMCU" id="btnbatalMCU" data-dismiss="modal"
                    class="btn font-weight-bold btn-warning">Batal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlnewfilependukung" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
            <div class="modal-header bg-c-yellow">
                <h5 class="modal-title text-white" id="exampleModalLabel">Update File Pendukung</h5>
            </div>
            <form action="javascript:void(0)" id="gantiFilePendukung" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="alert errnewfilependukung alert-danger animate__animated animate__bounce d-none"
                                role="alert"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <div class='text-danger font-italic'>
                                <div>
                                    <h6>Catatan File Pendukung :</h6>
                                </div>
                                <div>
                                    <ul>
                                        <li>File pendukung adalah gabungan file pdf menjadi 1 file dengan format sebagai
                                            berikut : <b>CV, Kartu Keluarga, KTP, Ijazah, SKCK, Surat Pengalaman Kerja.</b></li>
                                        <li>Upload file pendukung dalam format pdf.</li>
                                        <li>Ukuran file pendukung maksimal 500 kb.</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="filePendukungnew" class="form-label"><b>File pendukung <span
                                            class="text-danger">*</span></b></label>
                                <input type="file" class="form-control-file" id="filePendukungnew" accept=".pdf"
                                    required>
                                <small class="errorFilePendukungnew text-danger font-italic font-weight-bold"></small>
                                <span class="12390lkjj4234bn12j28j4nc9 d-none"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" name="btnnewfilependukung" class="btn font-weight-bold btn-primary">Upload
                        Data</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-warning">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    
</script>