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
                                        <a href="<?= base_url('pelanggaran'); ?>">
                                             Pelanggaran
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Detail Pelanggaran
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
                              <h5>Detail Pelanggaran</h5>
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
                              <div class="row">
                                   <div class="col-lg-12">
                                        <div class="row">
                                             <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                  <label for="detaillanggarKode">Perusahaan :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['kode_perusahaan'] . " | " . $langgar['nama_perusahaan']; ?>" readonly></small><br>
                                             </div>
                                             <div class="col-lg-3 col-md-3 col-sm-12">
                                                  <label for="detaillanggarKode">No. KTP :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['no_ktp']; ?>" readonly></small><br>
                                             </div>
                                             <div class="col-lg-3 col-md-3 col-sm-12">
                                                  <label for="detaillanggarKode">NIK :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['no_nik']; ?>" readonly></small><br>
                                             </div>
                                             <div class="col-lg-6 col-md-6 col-sm-12">
                                                  <label for="detaillanggarKode">Nama Karyawan :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['nama_lengkap']; ?>" readonly></small><br>
                                             </div>
                                             <div class="col-lg-6 col-md-6 col-sm-12">
                                                  <label for="detaillanggarKode">Departemen :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['depart']; ?>" readonly></small><br>
                                             </div>
                                             <div class="col-lg-6 col-md-6 col-sm-12">
                                                  <label for="detaillanggarKode">Posisi :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['posisi']; ?>" readonly></small><br>
                                             </div>
                                             <div class="col-lg-3 col-md-6 col-sm-12">
                                                  <label for="detaillanggarKode">Tgl Pelanggaran :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['tgl_langgar']; ?>" readonly><br>
                                             </div>
                                             <div class="col-lg-3 col-md-6 col-sm-12">
                                                  <label for="detaillanggar">Tgl. Punishment :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['tgl_punishment']; ?>" readonly><br>
                                             </div>
                                             <div class="col-lg-3 col-md-6 col-sm-12">
                                                  <label for="detaillanggar">Punishment :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['kode_langgar_jenis'] . " | " . $langgar['langgar_jenis']; ?>" readonly><br>
                                             </div>
                                             <div class="col-lg-3 col-md-6 col-sm-12">
                                                  <label for="detaillanggar">Tgl. Akhir Punishment :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['tgl_akhir_langgar']; ?>" readonly><br>
                                             </div>
                                             <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                                  <label for="detaillanggarKet">Keterangan :</label><br>
                                                  <textarea autocomplete="off" spellcheck="false" class="form-control bg-white" readonly><?= $langgar['ket_langgar']; ?></textarea>
                                             </div>
                                             <div class="col-lg-3 col-md-6 col-sm-12">
                                                  <label for="detaillanggarStatus">Status :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['status']; ?>" readonly><br>
                                             </div>
                                             <div class="col-lg-3 col-md-6 col-sm-12">
                                                  <label for="detaillanggarStatus">Tgl Buat :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['tgl_buat']; ?>" readonly><br>
                                             </div>
                                             <div class="col-lg-3 col-md-6 col-sm-12">
                                                  <label for="detaillanggarStatus">Tgl. Edit :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['tgl_edit']; ?>" readonly><br>
                                             </div>
                                             <div class="col-lg-3 col-md-6 col-sm-12">
                                                  <label for="detaillanggarStatus">Pembuat :</label><br>
                                                  <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['pembuat']; ?>" readonly><br>
                                             </div>
                                             <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                  <a href="<?= $langgar['url_berkas']; ?>" target="_blank" type="button" class="btn font-weight-bold btn-primary">Berkas Punishment</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="modal-footer d-flex justify-align-content-end p-2" style="margin-top:5px;">
                              <button id="btnSelesai" type="button" class="btn font-weight-bold btn-success">Selesai</button>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>