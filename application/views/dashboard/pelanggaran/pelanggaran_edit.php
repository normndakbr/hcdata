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
                                             Edit Pelanggaran
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
                              <h5>Edit Pelanggaran</h5>
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
                         <form action="<?= base_url('pelanggaran/update') ?>" method="POST">
                              <div class="card-body">
                                   <div class="row">
                                        <div class="col-lg-12">
                                             <?= $this->session->flashdata('msg'); ?>
                                             <?= $this->session->unset_userdata('msg'); ?>
                                             <div class="row">
                                                  <?php

                                                  if (!$this->session->csrf_token) {
                                                       $this->session->csrf_token = hash("sha1", time());
                                                  }

                                                  ?>

                                                  <input type="hidden" id="token" name="token" value="<?= $this->session->csrf_token ?>">

                                                  <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                       <label for="">Perusahaan :</label><br>
                                                       <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['kode_perusahaan'] . " | " . $langgar['nama_perusahaan']; ?>" readonly></small><br>
                                                  </div>
                                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                                       <hr>
                                                  </div>
                                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                                       <label for="txtCariKaryLgrEdit"><span class="text-danger font-weight-bold font-italic">* </span> Cari Karyawan (Ketikkan No. KTP/ NIK / Nama Karyawan) :</label>
                                                       <input id='txtCariKaryLgrEdit' name='txtCariKaryLgrEdit' type="text" autocomplete="off" spellcheck="false" class="form-control" placeholder="Ketikkan No. KTP/ NIK / Nama Karyawan" value="">
                                                       <input type="hidden" id="authprsLgrEdit" name="authprsLgrEdit" value="<?= $langgar['auth_m_per']; ?>"></small>
                                                       <input type="hidden" id="authLgrEdit" name="authLgrEdit" value="<?= $langgar['auth_langgar']; ?>"></small>
                                                       <input type="hidden" id="authkary" name="authkary" value="<?= $langgar['auth_kary']; ?>"></small>
                                                       <?= form_error('authkary', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                                  </div>
                                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                                       <label for="">No. KTP :</label><br>
                                                       <input id="txtKTPKaryLgrEdit" name="txtKTPKaryLgrEdit" type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $langgar['no_nik']; ?>" readonly><br>
                                                  </div>
                                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                                       <label for="">NIK :</label><br>
                                                       <input id="txtNIKKaryLgrEdit" name="txtNIKKaryLgrEdit" type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $langgar['no_nik']; ?>" readonly><br>
                                                  </div>
                                                  <div class="col-lg-6 col-md-6 col-sm-12">
                                                       <label for="">Nama Karyawan :</label><br>
                                                       <input id="txtNamaKaryLgrEdit" name="txtNamaKaryLgrEdit" type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $langgar['nama_lengkap']; ?>" readonly><br>
                                                  </div>
                                                  <div class="col-lg-6 col-md-6 col-sm-12">
                                                       <label for="">Departemen :</label><br>
                                                       <input id="txtDepartKaryLgrEdit" name="txtDepartKaryLgrEdit" type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $langgar['depart']; ?>" readonly><br>
                                                  </div>
                                                  <div class="col-lg-6 col-md-6 col-sm-12">
                                                       <label for="">Posisi :</label><br>
                                                       <input id="txtPosisiKaryLgrEdit" name="txtPosisiKaryLgrEdit" type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $langgar['posisi']; ?>" readonly><br>
                                                  </div>
                                                  <div class="col-lg-3 col-md-6 col-sm-12">
                                                       <label for="tglLgrEdit">Tgl Pelanggaran :</label><br>
                                                       <input type="date" id="tglLgrEdit" name="tglLgrEdit" autocomplete="off" spellcheck="false" class="form-control" value="<?= $langgar['tgl_langgar']; ?>">
                                                       <?= form_error('tglLgrEdit', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                                  </div>
                                                  <div class="col-lg-3 col-md-6 col-sm-12">
                                                       <label for="tglPunishLgrEdit">Tgl. Punishment :</label><br>
                                                       <input type="date" id="tglPunishLgrEdit" name="tglPunishLgrEdit" autocomplete="off" spellcheck="false" class="form-control" value="<?= $langgar['tgl_punishment']; ?>">
                                                       <?= form_error('tglPunishLgrEdit', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                                  </div>
                                                  <div class="col-lg-3 col-md-6 col-sm-12">
                                                       <label for="jenisLgrEdit" style="margin-bottom:15px;">Jenis Punishment :</label><br>
                                                       <select type="text" id="jenisLgrEdit" name="jenisLgrEdit" autocomplete="off" spellcheck="false" class="form-control" value="">
                                                            <?php
                                                            echo "<option value=''>-- PILIH PUNISHMENT --</option>";

                                                            if (!empty($langgar_jenis)) {
                                                                 foreach ($langgar_jenis as $list) { ?>
                                                                      <option value='<?= $list->auth_langgar_jenis; ?>' <?= $langgar['auth_langgar_jenis'] == $list->auth_langgar_jenis ? 'selected' : ''  ?>><?= $list->langgar_jenis; ?></option>";
                                                            <?php }
                                                            } else {
                                                                 echo "<option value=''>-- PUNISHMENT TIDAK ADA --</option>";
                                                            }

                                                            ?>
                                                       </select>
                                                       <?= form_error('jenisLgrEdit', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                                  </div>
                                                  <div class="col-lg-3 col-md-6 col-sm-12">
                                                       <label for="tglAkhirPunishLgrEdit">Tgl. Akhir Punishment :</label><br>
                                                       <input type="date" id="tglAkhirPunishLgrEdit" name="tglAkhirPunishLgrEdit" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['tgl_akhir_langgar']; ?>">
                                                       <?= form_error('tglAkhirPunishLgrEdit', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                                  </div>
                                                  <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                                       <label for="ketLgrEdit">Keterangan :</label><br>
                                                       <textarea id="ketLgrEdit" name="ketLgrEdit" autocomplete="off" spellcheck="false" class="form-control bg-white"><?= $langgar['ket_langgar']; ?></textarea>
                                                       <?= form_error('ketLgrEdit', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                                  </div>
                                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                                       <a href="<?= $langgar['url_langgar'] ?>" target="_blank" id="btnBerkasTampil" name="btnBerkasTampil" type="button" class="btn font-weight-bold btn-primary">Berkas Punishment</a>
                                                       <button id="btnGantiBerkas" name="btnGantiBerkas" type="button" class="btn font-weight-bold btn-success">Ganti Berkas Punishment</button>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="modal-footer d-flex justify-align-content-end p-2" style="margin-top:5px;">
                                   <button type="submit" type="button" class="btn font-weight-bold btn-primary">Update</button>
                                   <button id="btnSelesai" name="btnSelesai" type="button" class="btn font-weight-bold btn-danger">Selesai</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>
<div class="modal fade" id="editBerkasPunishment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:60%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Ganti Berkas Punishment</h5>
               </div>
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="alert alert-danger err_psn_edit_berkas animate__animated animate__bounce d-none"></div>
                         <input id='authlanggarberkas' name='authlanggarberkas' type="hidden" value="">
                         <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                              <label for="">Perusahaan :</label><br>
                              <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['kode_perusahaan'] . " | " . $langgar['nama_perusahaan']; ?>" readonly></small><br>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <hr>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-12">
                              <label for="">No. KTP :</label><br>
                              <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['no_nik']; ?>" readonly></small><br>
                              <small id="erroredit1" class="text-danger font-italic font-weight-bold"></small><br>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-12">
                              <label for="">NIK :</label><br>
                              <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['no_nik']; ?>" readonly></small><br>
                         </div>
                         <div class="col-lg-6 col-md-6 col-sm-12">
                              <label for="">Nama Karyawan :</label><br>
                              <input type="text" autocomplete="off" spellcheck="false" class="form-control bg-white" value="<?= $langgar['nama_lengkap']; ?>" readonly></small><br>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <label for=""><span class="text-danger font-weight-bold font-italic">* </span>Berkas Punishment <span class="text-danger font-weight-bold font-italic">(Berkas dengan format pdf, ukuran maksimal 100 kb)</span> :</label>
                              <input id='berkasPunishEdit' name='berkasPunishEdit' type="file" class="form-control-file">
                              <small id="erroredit2" class="text-danger font-italic font-weight-bold"></small><br>
                         </div>
                    </div>
               </div>
               <div class="modal-footer d-flex justify-content-end p-2" style="margin-top:10px;">
                    <button type="button" id="btnUploadBerkas" id="btnUploadBerkas" class="btn font-weight-bold btn-primary">Upload Berkas</button>
                    <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
               </div>
          </div>
     </div>
</div>