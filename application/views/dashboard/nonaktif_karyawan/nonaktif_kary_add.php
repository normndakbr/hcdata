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
                                        <a href="<?= base_url('NonaktifKary'); ?>">
                                             Non-Aktif Karyawan
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Tambah Data
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
                              <h5> Non-Aktif Karyawan</h5>
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
                              <div class="mb-4 mt-3">
                                   <a href="<?= base_url('NonaktifKary'); ?>" class="btn btn-primary font-weight-bold"><i class="fas fa-sync-alt"></i> Refresh / Data</a>
                              </div>
                              <div class="alert alert-danger err_psn_nonaktifkary animate__animated animate__bounce d-none"></div>
                              <div class="row mt-3">
                                   <div class="col-lg-5 col-md-12 col-sm-12">
                                        <label for="perNonkatifKary" class="mb-3">Perusahaan <span class="text-danger">*</span></label><br>
                                        <select id='perNonkatifKary' name='perNonkatifKary' class="form-control">
                                             <option value="">-- PILIH PERUSAHAAN --</option>
                                             <?= $permst . $perstr; ?>
                                        </select>
                                        <small class="error1 text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-7 col-md-12 col-sm-12">
                                        <label for="cariKaryNonaktif">Cari Karyawan <span class="text-danger"> (No. KTP/NIK/Nama Karyawan) *</span></label><br>
                                        <div class="input-group">
                                             <input id='cariKaryNonaktif' name='cariKaryNonaktif' type="text" autocomplete="off" spellcheck="false" class="form-control" placeholder="Ketikkan No. KTP/NIK/Nama Karyawan" value="" required>
                                             <button id="btnResetKaryNonaktif" class="btn btn-primary btn-sm">Reset</button>
                                        </div>
                                        <small class="error2 text-danger font-italic font-weight-bold"></small><br>
                                        <span class="h3kd8sak4 aj48ajg j34k234n ad3ekl234 d-none"></span>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="noKTPNonaktif">No. KTP</label>
                                        <input type="text" id='noKTPNonaktif' name='noKTPNonaktif' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="namaKarytglNonaktif">Nama Karyawan</label>
                                        <input type="text" id='namaKarytglNonaktif' name='namaKarytglNonaktif' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                   </div>
                                   <div class="col-lg-2 col-md-6 col-sm-12">
                                        <label for="noNIKNonaktif">NIK</label>
                                        <input type="text" id='noNIKNonaktif' name='noNIKNonaktif' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                   </div>
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="DepttglNonaktif">Departemen</label>
                                        <input type="text" id='DepttglNonaktif' name='DepttglNonaktif' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="tglNonaktif">Tanggal Nonaktif <span class="text-danger">*</span></label>
                                        <input type="date" id='tglNonaktif' name='tglNonaktif' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                        <small class="error3 text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-8 col-md-6 col-sm-12">
                                        <label for="alasanNonaktif" class="mb-3">Alasan Nonaktif <span class="text-danger">*</span></label>
                                        <select id='alasanNonaktif' name='alasanNonaktif' class="form-control">
                                             <option value="">-- TIDAK ADA DATA --</option>
                                        </select>
                                        <small class="error4 text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="ketalasanNonaktif">Keterangan </label><br>
                                        <textarea id='ketalasanNonaktif' name='ketalasanNonaktif' type="text" autocomplete="off" spellcheck="false" class="form-control"></textarea>
                                        <small class="error5 text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-9 col-md-12 col-sm-12 mt-3" id="btnberkas">
                                        <div>
                                             <h6 class="text-danger font-italic">Catatan : Upload berkas karyawan dalam format pdf, ukuran berkas maksimal 100 kb.</h6>
                                        </div>
                                        <div class="form-group">
                                             <label for="fileberkasalasan"><b>Upload Berkas</b> <span class="text-danger">*</span></label>
                                             <input type="file" class="form-control-file" id="fileberkasalasan">
                                             <small class="error6 text-danger font-italic font-weight-bold"></small>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                        <button type="button" name="btnNonaktifkanKary" id="btnNonaktifkanKary" class="btn font-weight-bold btn-primary">Simpan</button>
                                        <button type="button" name="btnBatalNonaktifkanKary" id="btnBatalNonaktifkanKary" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>
<!-- Modal -->
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
                    <a href="<?= base_url(); ?>dash/logout" type="button" class="btn btn-primary">Keluar</a>
               </div>
          </div>
     </div>
</div>