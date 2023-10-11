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
                                             Tambah Pelanggaran
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
                              <h5>Pelanggaran</h5>
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
                                        <a href="<?= base_url('pelanggaran'); ?>" class="btn btn-primary font-weight-bold">Refresh / Data</a>
                                   </div>
                                   <div class="alert alert-danger err_psn_langgar_add animate__animated animate__bounce d-none"></div>
                                   <?= $this->session->flashdata('msg'); ?>
                                   <?= $this->session->unset_userdata('msg'); ?>
                              </div>

                              <form action="<?= base_url('pelanggaran/add') ?>" method="post" enctype="multipart/form-data">
                                   <div class="row ">
                                        <?php

                                        if (!$this->session->csrf_token) {
                                             $this->session->csrf_token = hash("sha1", time());
                                        }

                                        ?>

                                        <input type="hidden" id="token" name="token" value="<?= $this->session->csrf_token ?>">

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="perLanggar"><span class="text-danger font-weight-bold font-italic">* </span> Perusahaan :</label><br>
                                             <select id='perLanggar' name='perLanggar' class="form-control form-control-user">
                                                  <option value="">-- PILIH PERUSAHAAN --</option>
                                                  <?= $permst . $perstr; ?>
                                             </select>
                                             <small class="error1 text-danger font-italic font-weight-bold"></small>
                                             <?= form_error('perLanggar', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <hr>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="txtCariKaryLanggar"><span class="text-danger font-weight-bold font-italic">* </span> Cari Karyawan (Ketikkan No. KTP/ NIK / Nama Karyawan) :</label>
                                             <input id='txtCariKaryLanggar' name='txtCariKaryLanggar' type="text" autocomplete="off" spellcheck="false" class="form-control" placeholder="Ketikkan No. KTP/ NIK / Nama Karyawan" value="">
                                             <small class="error2 text-danger font-italic font-weight-bold"></small>
                                             <?= form_error('authKTPKaryLanggar', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                             <label for=" txtKTPKaryLanggar">No. KTP :</label>
                                             <input id='txtKTPKaryLanggar' name='txtKTPKaryLanggar' class="form-control" value="<?= set_value('txtKTPKaryLanggar'); ?>" readonly>
                                             <input id='authKTPKaryLanggar' name='authKTPKaryLanggar' type="hidden" value="<?= set_value('authKTPKaryLanggar'); ?>"><br>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                             <label for="txtNIKKaryLanggar">NIK :</label>
                                             <input id='txtNIKKaryLanggar' name='txtNIKKaryLanggar' class="form-control" value="<?= set_value('txtNIKKaryLanggar'); ?>" readonly>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                             <label for="txtNamaKaryLanggar">Nama Karyawan :</label>
                                             <input id='txtNamaKaryLanggar' name='txtNamaKaryLanggar' class="form-control" value="<?= set_value('txtNamaKaryLanggar'); ?>" readonly><br>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                             <label for="txtDepartKaryLanggar">Departemen :</label>
                                             <input id='txtDepartKaryLanggar' name='txtDepartKaryLanggar' class="form-control" value="<?= set_value('txtDepartKaryLanggar'); ?>" readonly><br>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                             <label for="txtPosisiKaryLanggar">Posisi :</label>
                                             <input id='txtPosisiKaryLanggar' name='txtPosisiKaryLanggar' class="form-control" value="<?= set_value('txtPosisiKaryLanggar'); ?>" readonly><br>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                             <label for="tglLanggar"><span class="text-danger font-weight-bold font-italic">* </span>Tgl. Pelanggaran :</label>
                                             <input id='tglLanggar' name='tglLanggar' type="date" autocomplete="off" spellcheck="false" class="form-control" value="<?= set_value('tglLanggar'); ?>">
                                             <small class="error3 text-danger font-italic font-weight-bold"></small>
                                             <?= form_error('tglLanggar', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                             <label for="tglPunish"><span class="text-danger font-weight-bold font-italic">* </span>Tgl. Punishment :</label>
                                             <input id='tglPunish' name='tglPunish' type="date" autocomplete="off" spellcheck="false" class="form-control" value="<?= set_value('tglPunish'); ?>">
                                             <small class="error4 text-danger font-italic font-weight-bold"></small>
                                             <?= form_error('tglPunish', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                             <label for="jenisPunish" style="margin-bottom:15px;"><span class="text-danger font-weight-bold font-italic">* </span>Jenis Punishment :</label>
                                             <select id='jenisPunish' name='jenisPunish' type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= set_value('jenisPunish'); ?>">
                                                  <?php
                                                  echo "<option value=''>-- PILIH PUNISHMENT --</option>";

                                                  if (!empty($langgar_jenis)) {
                                                       foreach ($langgar_jenis as $list) {
                                                            echo "<option value='" . $list->auth_langgar_jenis . "' " . set_select('jenisPunish', $list->auth_langgar_jenis, False) . ">" . $list->langgar_jenis . "</option>";
                                                       }
                                                  } else {
                                                       echo "<option value=''>-- PUNISHMENT TIDAK ADA --</option>";
                                                  }

                                                  ?>
                                             </select>
                                             <small class="error5 text-danger font-italic font-weight-bold"></small>
                                             <?= form_error('jenisPunish', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                             <label for="tglAkhirPunish"><span class="text-danger font-weight-bold font-italic">* </span>Tgl. Berakhir Punishment :</label>
                                             <input id='tglAkhirPunish' name='tglAkhirPunish' type="date" autocomplete="off" spellcheck="false" class="form-control" value="<?= set_value('tglAkhirPunish'); ?>">
                                             <small class="error6 text-danger font-italic font-weight-bold"></small>
                                             <?= form_error('tglAkhirPunish', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="ketLanggar"><span class="text-danger font-weight-bold font-italic">* </span>Keterangan Pelanggaran :</label><br>
                                             <textarea id='ketLanggar' name='ketLanggar' type="text" autocomplete="off" spellcheck="false" class="form-control"><?= set_value('ketLanggar'); ?></textarea>
                                             <small id="error7" class="text-danger font-italic font-weight-bold"></small>
                                             <?= form_error('ketLanggar', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for=""><span class="text-danger font-weight-bold font-italic">* </span>Berkas Punishment <span class="text-danger font-weight-bold font-italic">(Berkas dengan format pdf, ukuran maksimal 100 kb)</span> :</label>
                                             <input id='berkasPunish' name='berkasPunish' type="file" class="form-control-file" accept=".pdf">
                                             <small id="error8" class="text-danger font-italic font-weight-bold"></small>
                                             <?= form_error('berkasPunish', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?>
                                             <?php
                                             if (!empty($err_upl)) {
                                                  echo "<small class='text-danger font-italic font-weight-bold'>" . $err_upl . "</small>";
                                             }
                                             ?><br>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <hr class="mb-2">
                                             <button type="submit" id="btnSubLanggar" name="btnSubLanggar" class="btn font-weight-bold btn-primary">Buat Data</button>
                                             <a href='<?= base_url('pelanggaran/new') ?>' class="btn font-weight-bold btn-danger">Batal</a>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>