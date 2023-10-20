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
                                        <a href="<?=base_url('dash');?>">
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
                                                  <a href="#!"><span><i class="feather icon-minus"></i>
                                                            collapse</span><span style="display: none"><i
                                                                 class="feather icon-plus"></i> expand</span></a>
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
                                        <a href="<?=base_url('karyawan');?>" class="btn btn-warning font-weight-bold"><i
                                                  class="fas fa-eraser"></i> Reset</a>
                                        <a id="addRefreshKary" href="#!" class="btn btn-primary font-weight-bold"><i
                                                  class="fas fa-sync-alt"></i> Refresh</a>
                                        <a id="addTambahKary" href="<?=base_url('new');?>" target="_blank"
                                             class=" btn btn-success font-weight-bold"><i class="fas fa-plus"></i>
                                             Tambah Data</a>
                                   </div>
                                   <div
                                        class="alert alert-danger err_psn_kary animate__animated animate__bounce d-none">
                                   </div>
                              </div>
                              <div class="row">
                                   <?php

                                   if (!$this->session->csrf_token) {
                                        $this->session->csrf_token = hash("sha1", time());
                                   }
                                   
                                   ?>

                                   <input type="hidden" id="token" name="token" value="<?=$this->session->csrf_token?>">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div
                                             class="alert alert-danger errormsgper animate__animated animate__bounce d-none mb-3">
                                        </div>
                                        <h6 class="mt-3">Pilih Perusahaan Utama<span class="text-danger">*</span></h6>
                                        <select id='perJenisData' name='perJenisData'
                                             class="form-control form-control-user">
                                             <option value="">-- PILIH PERUSAHAAN --</option>
                                             <?=$permst . $perstr;?>
                                        </select>
                                        <small class="error1str text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label class="font-weight-bold">Struktur
                                             Perusahaan :</label><br>
                                        <label id="lblhirarkiper" for="lblhirarkiper"
                                             class="form-control font-weight-bold"></label><br>
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
                                                  <tbody></tbody>
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
                    <h5 class="modal-title text-white" id="jdlmdlnewfotokaryawan">Update Foto Karyawan</h5>
               </div>
               <form action="javascript:void(0)" id="gantiFotoKaryawan" method="post" data-parsley-validate>
                    <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                         <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                   <div class="alert errnewfotokaryawan alert-danger animate_animated animate_bounce d-none"
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
                                        <small
                                             class="errorfotoKaryawanNew text-danger font-italic font-weight-bold"></small>
                                        <span class="76235ft67gfrubf12 d-none"></span>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer m-3">
                         <button type="submit" name="btnnewfotokaryawan" class="btn font-weight-bold btn-primary">Upload
                              Data</button>
                         <button type="button" data-dismiss="modal"
                              class="btn font-weight-bold btn-warning">Batal</button>
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlnewSMP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document"
          style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-c-yellow">
                    <h5 class="modal-title text-white" id="jdlmdlnewSMP">Tambah SIMPER/MINE PERMIT</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert alert-danger errormsgizinnew animate__animated animate__bounce d-none">
                              </div>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-12">
                              <div class="form-group">
                                   <label class="font-weight-bold" for="addJenisIzinnew">Jenis Izin <span
                                             class="text-danger">*</span></label>
                                   <select id='addJenisIzinnew' name='addJenisIzinnew'
                                        class="form-control form-control-user">
                                        <option value="">-- WAJIB DIPILIH --</option>
                                        <option value="1">MINE PERMIT</option>
                                        <option value="2">SIMPER</option>
                                        <option value="3">TEMPORARY MINE PERMIT</option>
                                   </select>
                                   <small class="erroraddJenisIzinnew text-danger font-italic font-weight-bold"></small>
                                   <span class="ecb14fe704e08d9df8e343030bbb442344 d-none"></span>
                                   <span class="ecb14fe704e08d9df8e343073455ffrdfdfg d-none"></span>
                                   <span class="ecb14fe704e08d95j32k4jn98sdfvj3o45 d-none"></span>
                              </div>
                         </div>
                         <div class="col-lg-9 col-md-9 col-sm-12">
                              <div class="form-group">
                                   <label class="font-weight-bold" for="addNoRegnew">No.
                                        Register <span class="text-danger">*</span></label>
                                   <input id='addNoRegnew' name='addNoRegnew' type="text"
                                        class="form-control form-control-user">
                                   <small class="erroraddNoRegnew text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                         <div id="txtsimnew" class="col-lg-12 col-md-12 col-sm-12 mb-3 d-none">
                              <div class="row">
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                             <label class="font-weight-bold" for="addJenisSIMnew">Jenis SIM <span
                                                       class="text-danger">*</span></label>
                                             <div id="txtizinSIM" class="input-group">
                                                  <select id='addJenisSIMnew' name='addJenisSIMnew'
                                                       class="form-control form-control-user">
                                                       <option value="">-- SIM TIDAK ADA
                                                            --</option>
                                                  </select>
                                                  <div class="input-group-prepend">
                                                       <button id="refreshJenisSIMnew" name="refreshJenisSIMnew"
                                                            class="btn btn-primary btn-sm"><i
                                                                 class="fas fa-sync-alt"></i></button>
                                                  </div>
                                             </div>

                                             <small
                                                  class="erroraddJenisSIMnew text-danger font-italic font-weight-bold"></small>
                                        </div>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                             <label class="font-weight-bold" for="addTglExpSIMnew">Tanggal Expired SIM
                                                  <span class="text-danger">*</span></label>
                                             <input id='addTglExpSIMnew' name='addTglExpSIMnew' type="date"
                                                  class="form-control form-control-user">
                                             <small
                                                  class="erroraddTglExpSIMnew text-danger font-italic font-weight-bold"></small>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label class="font-weight-bold" for="addTglExpSIM"> Upload SIM Polisi dalam
                                             format pdf,
                                             ukuran file maksimal 70 kb.
                                             <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                             <div class="custom-file">
                                                  <input type="file" class="custom-file-input " id="filesimpolisinew"
                                                       accept=".pdf">
                                                  <label class="custom-file-label" id='lblsimpolisinew'
                                                       for="filesimpolisinew" aria-describedby="UploadFIleSIM">Pilih
                                                       file SIM Polisi</label>
                                             </div>
                                             <div class="input-group-append">
                                                  <a href="#!" id="btnshowsimpolnew" target="_blank"
                                                       class="btn btn-success font-weight-bold disabled"
                                                       title="Tampilkan file"><i class="fas fa-file-pdf"></i></a>
                                             </div>
                                        </div>
                                        <small
                                             class="errorFilesimpolisinew text-danger font-italic font-weight-bold"></small>
                                        <span class="h52k342 j8234234b n234b5b7 kl234nn d-none"></span>
                                        <input type="hidden" id="nmfilesimpolnew" value="">
                                        <input type="hidden" id="nmfilesimpolsvnew" value="">
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-8 col-md-12 col-sm-12">
                              <label class="font-weight-bold" for="">
                                   Upload scan SIMPER/MINE PERMIT dalam format
                                   pdf, ukuran file maksimal 70 kb.
                                   <span class="text-danger">*</span></label>
                              <div class="input-group">
                                   <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="simpermpnew" accept=".pdf"
                                             required>
                                        <label class="custom-file-label" id='lblsimpermpnew' for="simpermpnew"
                                             aria-describedby="UploadFIleSIM">Pilih
                                             file SIMPER/MINE PERMIT</label>
                                   </div>
                                   <div class="input-group-append">
                                        <a href='#!' id="btnshowsimpernew" target="_blank"
                                             class="btn btn-success font-weight-bold text-white disabled"
                                             title="Tampilkan file"><i class="fas fa-file-pdf"></i></a>
                                   </div>
                              </div>
                              <small class="errorsimpermpnew text-danger font-italic font-weight-bold"></small>
                              <span class="erroraddSpuploadnew d-none"></span>
                              <input type="hidden" id="nmfilesimpernew" value="">
                              <input type="hidden" id="nmfilesimpersvnew" value="">
                         </div>
                         <div class="col-lg-4 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label class="font-weight-bold" for="addTglExpnew">Tanggal
                                        Expired SIMPER/MINE PERMIT <span class="text-danger">*</span></label>
                                   <input id='addTglExpnew' name='addTglExpnew' type="date"
                                        class="form-control form-control-user">
                                   <small class="erroraddTglExpnew text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                         <div id="txtunitnew" class="col-lg-12 col-md-12 col-sm-12 d-none">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="collapse col-lg-12 col-md-12 col-sm-12 simperunitnew">
                                        <a id="addUnitSIMPERnew" href="#!"
                                             class="btn btn-primary font-weight-bold mb-4">Tambah Unit</a>
                                        <div id="idizintambangnew" class="data"></div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                              <a id="addSimpanIzinUnitnew" class="btn btn-primary font-weight-bold text-white"
                                   style="margin-left:30px;">Simpan Data</a>
                              <a id="addKembaliIzinUnitnew" class="btn btn-warning font-weight-bold text-white"
                                   data-dismiss="modal">Batal</a>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlnewsertifikat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document"
          style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-c-yellow">
                    <h5 class="modal-title text-white" id="jdlmdlnewsertifikat">Tambah Sertifikasi</h5>
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
                                   <small
                                        class="errorjenisSertifikasiNew text-danger font-italic font-weight-bold"></small>
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
                                   <small
                                        class="errorTanggalSertifikasiNew text-danger font-italic font-weight-bold"></small>
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
                                   <h6 class="text-danger font-italic">Catatan : Upload file Sertifikat dalam format
                                        pdf, ukuran file Sertifikat maksimal 300 kb.</h6>
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
                    <h5 class="modal-title text-white" id="jdlmdlnewvaksin">Tambah Data Vaksin</h5>
               </div>
               <form action="javascript:void(0)" id="tambahDataVaksin" method="post" data-parsley-validate>
                    <span class="t9018htg2398th259 d-none"></span>
                    <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                         <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                   <div
                                        class="alert alert-danger errornewvaksin animate__animated animate__bounce d-none">
                                   </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                   <hr>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <div id="jnsVaksin" class="form-group">
                                        <label for="jenisVaksin" class="form-label">Jenis Vaksin <span
                                                  class="text-danger">*</span></label>
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
                                        <label for="namaVaksin" class="form-label">Nama Vaksin <span
                                                  class="text-danger">*</span></label>
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
                                        <label for="tanggalVaksin" class="form-label">Tanggal Vaksin <span
                                                  class="text-danger">*</span></label>
                                        <input id='tanggalVaksin' name='tanggalVaksin' type="date" autocomplete="off"
                                             spellcheck="false" class="form-control" max="<?=date('Y-m-d')?>" value=""
                                             required>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer m-3">
                         <button type="submit" name="btnnewvaksin" class="btn font-weight-bold btn-primary">Simpan
                              Data</button>
                         <button type="button" data-dismiss="modal"
                              class="btn font-weight-bold btn-warning">Batal</button>
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
                    <h5 class="modal-title text-white" id="jdlmdlnewmcu">Tambah MCU</h5>
               </div>
               <form action="javascript:void(0)" id="tambahDataMCU" method="post" data-parsley-validate>
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert errnewmcu alert-danger animate__animated animate__bounce d-none"
                                   role="alert">
                              </div>
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-12">
                              <div class="form-group">
                                   <label for="tglMCUnew" class="form-label">Tanggal MCU <span class="text-danger">*</span></label>
                                   <input id='tglMCUnew' name='tglMCUnew' type="date" autocomplete="off"
                                        spellcheck="false" class="form-control" value="" required>
                                   <small class="errorTglMCUnew text-danger font-italic font-weight-bold"></small>
                                   <span class="890123hjn34267xcxvbj7234hh d-none"></span>
                              </div>
                         </div>
                         <div class="col-lg-8 col-md-8 col-sm-12">
                              <div class="form-group">
                                   <label for="hasilMCUnew" class="form-label">Hasil MCU <span class="text-danger">*</span></label>
                                   <select id='hasilMCUnew' name='hasilMCUnew' autocomplete="off" spellcheck="false"
                                        class="form-control" value="" required>
                                        <option value="">-- WAJID DIPILIH --</option>
                                   </select>
                                   <small class="errorHasilMCUnew text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="ketMCUnew" class="form-label">Keterangan <span class="text-danger">*</span></label>
                                   <textarea id='ketMCUnew' name='ketMCUnew' type="text" autocomplete="off"
                                        spellcheck="false" class="form-control" value="" required></textarea>
                                   <small class="errorKetMCUnew text-danger font-italic font-weight-bold"></small>
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
<div class="modal fade" id="mdlnewfilependukung" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document"
          style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-c-yellow">
                    <h5 class="modal-title text-white" id="jdlmdlnewfilependukung">Update File Pendukung</h5>
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
                                                  <li>File pendukung adalah gabungan file pdf menjadi 1 file dengan
                                                       format sebagai
                                                       berikut : <b>CV, Kartu Keluarga, KTP, Ijazah, SKCK, Surat
                                                            Pengalaman Kerja.</b></li>
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
                                        <small
                                             class="errorFilePendukungnew text-danger font-italic font-weight-bold"></small>
                                        <span class="12390lkjj4234bn12j28j4nc9 d-none"></span>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer m-3">
                         <button type="submit" name="btnnewfilependukung"
                              class="btn font-weight-bold btn-primary">Upload
                              Data</button>
                         <button type="button" data-dismiss="modal"
                              class="btn font-weight-bold btn-warning">Batal</button>
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlunitsimpernw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document"
          style="margin-left: auto; margin-right: auto;max-width:50%;">
          <div class="modal-content">
               <div class="modal-header bg-c-yellow">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Unit SIMPER</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert errormdlsimpernw alert-danger animate__animated animate__bounce d-none"
                                   role="alert"></div>
                              <div class="row p-2">
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label class="font-weight-bold" for="jenisUnitSimpernw">Unit :</label><br>
                                        <div id="txtjenisUnitSimpernw" class="input-group">
                                             <select id='jenisUnitSimpernw' class="form-control form-control-user"
                                                  required>
                                                  <option value="">-- WAJIB DIPILIH --</option>
                                             </select>
                                             <div class="input-group-prepend">
                                                  <button id="refreshjenisUnitSimpernw" name="refreshjenisUnitSimpernw"
                                                       class="btn btn-primary btn-sm" disabled><i
                                                            class="fas fa-sync-alt"></i></button>
                                             </div>
                                        </div>
                                        <small
                                             class="errorjenisUnitSimpernw text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label class="font-weight-bold" for="tipeAksesUnit">Izin Akses Unit
                                             :</label><br>
                                        <div id="txttipeAksesUnitnw" class="input-group">
                                             <select id='tipeAksesUnitnw' class="form-control form-control-user"
                                                  required>
                                                  <option value="">-- WAJIB DIPILIH --</option>
                                             </select>
                                             <div class="input-group-prepend">
                                                  <button id="refreshtipeAksesUnitnw" name="refreshtipeAksesUnitnw"
                                                       class="btn btn-primary btn-sm" disabled><i
                                                            class="fas fa-sync-alt"></i></button>
                                             </div>
                                        </div>
                                        <small
                                             class="errortipeAksesUnitnw text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnsimpanunitsimpernw" id="btnsimpanunitsimpernw"
                         class="btn font-weight-bold btn-primary">Simpan Data</button>
                    <button name="btnbatalunitsimpernw" id="btnbatalunitsimpernw" data-dismiss="modal"
                         class="btn font-weight-bold btn-warning">Selesai</button>
               </div>
          </div>
     </div>
</div>