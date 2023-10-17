<div class="pcoded-main-container">
     <div class="pcoded-content">
          <div class="page-header">
               <div class="page-block">
                    <div class="row align-items-center">
                         <div class="col-md-12">
                              <div class="page-header-title">
                                   <h5 class="m-b-10">Data Utama</h5>
                              </div>
                              <ul class="breadcrumb">
                                   <li class="breadcrumb-item">
                                        <a href="<?= base_url('dash'); ?>">
                                             <i class="feather icon-home"></i>
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a href="<?= base_url('Bank'); ?>">
                                             Pengajuan SIMPER/MINE PERMIT
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Tambah Pengajuan SIMPER/MINE PERMIT
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-xl-12 col-md-12">
                    <div class="card latest-update-card">
                         <div class="card-header">
                              <h5>Pengajuan SIMPER/MINE PERMIT</h5>
                              <div class="card-header-right">
                                   <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                             <li class="dropdown-item full-card">
                                                  <a href="#!"><span><i class="feather icon-maximize"></i>
                                                            Perbesar</span><span style="display: none"><i class="feather icon-minimize"></i> Restore</span></a>
                                             </li>
                                             <li class="dropdown-item minimize-card">
                                                  <a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display: none"><i class="feather icon-plus"></i> expand</span></a>
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
                                   <div class="mb-4">
                                        <a href="<?= base_url('pengajuansm'); ?>" class="btn btn-primary font-weight-bold"><i class="fas fa-sync-alt"></i> Refresh / Data</a>
                                   </div>
                                   <div class="alert alert-danger err_psn_izin_add animate__animated animate__bounce d-none"></div>
                              </div>
                              <div class="row ">
                                   <?php

                                   if (!$this->session->csrf_token) {
                                        $this->session->csrf_token = hash("sha1", time());
                                   }

                                   ?>

                                   <input type="hidden" id="token" name="token" value="<?= $this->session->csrf_token ?>">
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="perIzinDataAdd" class="mb-3">Pilih Perusahaan :</label><br>
                                        <select id='perIzinDataAdd' name='perIzinData' class="form-control">
                                             <option value="">-- PILIH PERUSAHAAN --</option>
                                             <?= $permst . $perstr; ?>
                                        </select>
                                        <small class="error1izinadd text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="lstJenisIzinAdd" class="mb-3">Jenis Izin :</label>
                                        <select id='lstJenisIzinAdd' autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                             <option value="">-- PILIH JENIS IZIN --</option>
                                             <option value="1">MINE PERMIT</option>
                                             <option value="2">SIMPER</option>
                                        </select>
                                        <small class="error2izinadd text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="dtpTglPengajuanIzinAdd">Tgl. Pengajuan :</label>
                                        <input type="date" id='dtpTglPengajuanIzinAdd' class="form-control" value="<?= date('Y-m-d'); ?>">
                                        <small class="error4izinadd text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                        <label for="txtKetIzinAdd">Keterangan :</label><br>
                                        <textarea id='txtKetIzinAdd' autocomplete="off" spellcheck="false" class="form-control"></textarea>
                                        <small class="error5izinadd text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr class="mb-2">
                                        <button type="button" name="btnSimpanIzinAdd" id="btnSimpanIzinAdd" class="btn font-weight-bold btn-primary">Simpan</button>
                                        <button type="button" name="btnBatalIzinAdd" id="btnBatalIzinAdd" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>
<div class="modal fade" id="mdllstkaryizin" tabindex="-1" role="dialog" aria-labelledby="jdlmdllstkaryizin" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:85%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="jdlmdllstkaryizin"><i class="fas fa-user-plus"></i> Data Karyawan</h5>
               </div>
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                              <label for="">Proses Izin :</label>
                              <select name="lstProsesIzinAdd" id="lstProsesIzinAdd" class="form-control">
                                   <option value="">-- PILIH PROSES IZIN --</option>
                                   <option value="1">PROSES BARU</option>
                                   <option value="2">PERPANJANGAN</option>
                              </select>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 mb-3 mt-2">
                              <button type="button" name="btnRefreshKaryIzin" id="btnRefreshKaryIzin" class="btn font-weight-bold btn-primary"><i class="fas fa-sync-alt"></i> Refresh</button>
                              <button type="button" name="btnAddKaryIzin" id="btnAddKaryIzin" class="btn font-weight-bold btn-success"><i class="fas fa-user-plus"></i> Tambah Karyawan</button>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert err_list_kary_izin_add alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                              <input id="kodePengajuanIizinAdd" type="hidden" value="">
                              <input id="authPengajuanIzinAdd" type="hidden" value="">
                              <div id="tbDataKary" name="" class="data"></div>
                         </div>
                    </div>
                    <div class="modal-footer mt-3">
                         <button type="button" name="btnSelesaiAddIzinDet" id="btnSelesaiAddIzinDet" class="btn font-weight-bold btn-primary">Selesai</button>
                         <button type="button" name="btnBatalAddIzinDet" id="btnBatalAddIzinDet" class="btn font-weight-bold btn-danger">Batalkan Pengajuan</button>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdladdkaryizin" tabindex="-1" role="dialog" aria-labelledby="jdlmdlkaryizin" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document" style="margin-left: auto; margin-right: auto;max-width:85%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="jdlmdlkaryizin"><i class="fas fa-user-plus"></i> Data Karyawan</h5>
                    <button name="btnSelesaiKaryAddIzin" id="btnSelesaiKaryAddIzin" class="btn font-weight-bold btn-danger btn-sm float-right"> x </button>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert err_kary_izin_add alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                              <div class="row p-2">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="txtCariKaryIzinAdd">Cari Karyawan :</label>
                                        <input id='txtCariKaryIzinAdd' autocomplete="off" spellcheck="false" class="form-control bg-white" value="">
                                        <small class="errorkry1 text-danger font-weight-bold font-italic"></small><br>
                                   </div>
                                   <div class="col-lg-2 col-md-2 col-sm-12">
                                        <label for="txtNikKaryIzinAdd">NIK :</label>
                                        <h5 id='txtNikKaryIzinAdd' class="form-control" value=""></h5>
                                        <input id='authKaryIzinAdd' type="hidden" value=""></input><br>
                                   </div>
                                   <div class="col-lg-5 col-md-5 col-sm-12">
                                        <label for="txtNamaKaryIzinAdd">Nama Karyawan :</label>
                                        <h5 id='txtNamaKaryIzinAdd' class="form-control" value=""></h5><br>
                                   </div>
                                   <div class="col-lg-5 col-md-5 col-sm-12">
                                        <label for="txtDepartKaryIzinAdd">Departemen :</label>
                                        <h5 id='txtDepartKaryIzinAdd' class="form-control" value=""></h5><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="txtPosisiKaryIzinAdd">Posisi :</label>
                                        <h5 id='txtPosisiKaryIzinAdd' class="form-control" value=""></h5><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="txtDohKaryIzinAdd">Date of Hire :</label>
                                        <h5 id='txtDohKaryIzinAdd' class="form-control" value=""></h5><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label id='lblExpMPKaryIzinAdd' for="txtExpMPKaryIzinAdd">Tgl. Exp. :</label>
                                        <h5 id='txtExpMPKaryIzinAdd' class="form-control" value=""></h5><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="txtKetDetKaryIzinAdd">Keterangan : </label>
                                        <textarea id='txtKetDetKaryIzinAdd' class="form-control"></textarea>
                                        <small class="errorkry2 text-danger font-weight-bold font-italic"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <h4>Berkas Upload :</h4>
                                        <div class="row">
                                             <div class="col-lg-6 col-md-6 col-sm-12">
                                                  <div class="row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="">1. ID Card Internal Perusahaan/Surat Keterangan Bekerja</label>
                                                            <input type="file" id="idPrs" name="idPrs" class="form-control" accept=".pdf">
                                                            <small class="errorkry3 text-danger font-weight-bold font-italic"></small><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="">2. Surat Keterangan Sehat dari Klinik PT.IC</label>
                                                            <input type="file" id="srtSehatKlinik" name="srtSehatKlinik" class="form-control" accept=".pdf">
                                                            <small class="errorkry4 text-danger font-weight-bold font-italic"></small><br>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6 col-md-6 col-sm-12">
                                                  <div class="row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="">3. Lembar Pengenalan Umum Tambang ( Induksi )</label>
                                                            <input type="file" id="lbrInduksi" name="lbrInduksi" class="form-control" accept=".pdf">
                                                            <small class="errorkry5 text-danger font-weight-bold font-italic"></small><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="">4. Mine Permit Lama ( Untuk Perpanjangan )</label>
                                                            <input type="file" id="mpLama" name="mpLama" class="form-control" accept=".pdf">
                                                            <small class="errorkry6 text-danger font-weight-bold font-italic"></small><br>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" name="btnSimpanKaryAddIzinDet" id="btnSimpanKaryAddIzinDet" class="btn font-weight-bold btn-primary">Buat dan Upload Data</button>
                         <button type="button" name="btnBatalKaryAddIzin" id="btnBatalKaryAddIzinDet" class="btn font-weight-bold btn-danger">Batal</button>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdladdkaryizinsp" tabindex="-1" role="dialog" aria-labelledby="jdlmdladdkaryizinsp" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document" style="margin-left: auto; margin-right: auto;max-width:85%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="jdlmdladdkaryizinsp"><i class="fas fa-user-plus"></i> Data Karyawan</h5>
                    <button name="btnSelesaiKaryAddIzinsp" id="btnSelesaiKaryAddIzinsp" class="btn font-weight-bold btn-danger btn-sm float-right"> x </button>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert err_kary_izin_add_sp alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                              <div class="row p-2">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="txtCariKaryIzinAddSP">Cari Karyawan :</label>
                                        <input id='txtCariKaryIzinAddSP' autocomplete="off" spellcheck="false" class="form-control" value=""><br>
                                   </div>
                                   <div class="col-lg-2 col-md-2 col-sm-12">
                                        <label for="txtNikKaryIzinAddSP">NIK :</label>
                                        <h5 id='txtNikKaryIzinAddSP' class="form-control" value=""></h5>
                                        <input id='authKaryIzinAddSP' type="hidden" value=""></input><br>
                                   </div>
                                   <div class="col-lg-5 col-md-5 col-sm-12">
                                        <label for="txtNamaKaryIzinAddSP">Nama Karyawan :</label>
                                        <h5 id='txtNamaKaryIzinAddSP' class="form-control" value=""></h5><br>
                                   </div>
                                   <div class="col-lg-5 col-md-5 col-sm-12">
                                        <label for="txtDepartKaryIzinAddSP">Departemen :</label>
                                        <h5 id='txtDepartKaryIzinAddSP' class="form-control" value=""></h5><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="txtPosisiKaryIzinAddSP">Posisi :</label>
                                        <h5 id='txtPosisiKaryIzinAddSP' class="form-control" value=""></h5><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="txtDohKaryIzinAddSP">Date of Hire :</label>
                                        <h5 id='txtDohKaryIzinAddSP' class="form-control" value=""></h5><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label id='lblExpMPKaryIzinAddSP' for="txtExpMPKaryIzinAdd">Tgl. Exp. :</label>
                                        <h5 id='txtExpMPKaryIzinAddSP' class="form-control" value=""></h5><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="txtKetDetKaryIzinAddSP">Keterangan : </label>
                                        <textarea id='txtKetDetKaryIzinAddSP' class="form-control" value=""></textarea><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <h4>Berkas Upload :</h4>
                                        <div class="row">
                                             <div class="col-lg-6 col-md-6 col-sm-12">
                                                  <div class="row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="">1. SIM Polisi</label>
                                                            <input type="file" class="form-control"><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="">2. ID Card Internal Perusahaan/Surat Keterangan Bekerja</label>
                                                            <input type="file" class="form-control"><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="">3. Surat Keterangan Sehat dari Clinic PT.IC</label>
                                                            <input type="file" class="form-control"><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="">4. Hasil Tes Tulis</label>
                                                            <input type="file" class="form-control"><br>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6 col-md-6 col-sm-12">
                                                  <div class="row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="">5. Hasil Te Praktek (Untuk KIMPER)</label>
                                                            <input type="file" class="form-control"><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="">6. SIMPER Lama ( Untuk Perpanjangan )</label>
                                                            <input type="file" class="form-control"><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="">7. SIMPER Lama ( Untuk Perpanjangan )</label>
                                                            <input type="file" class="form-control"><br>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" name="btnSimpanKaryAddIzinDetSP" id="btnSimpanKaryAddIzinDetSP" class="btn font-weight-bold btn-primary">Buat dan Upload Data</button>
                         <button type="button" name="btnBatalKaryAddIzinSP" id="btnBatalKaryAddIzinDetSP" class="btn font-weight-bold btn-danger">Batal</button>
                    </div>
               </div>
          </div>
     </div>
</div>