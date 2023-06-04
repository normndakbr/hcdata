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
                                        <a href="<?= base_url('Posisi'); ?>">
                                             Posisi
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Tambah Posisi
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
                              <h5>Posisi</h5>
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
                                        <a href="<?= base_url('posisi'); ?>" class="btn btn-primary font-weight-bold">Refresh / Data</a>
                                        <a href="<?= base_url('posisi/new'); ?>" class="btn btn-success font-weight-bold">Tambah Data</a>
                                   </div>
                                   <div class="alert alert-danger err_psn_posisi animate__animated animate__bounce d-none"></div>
                              </div>
                              <div class="row ">
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="perPosisi">Perusahaan :</label><br>
                                        <select id='perPosisi' name='perPosisi' class="form-control form-control-user">
                                             <option value="">-- Pilih Perusahaan --</option>
                                        </select>
                                        <small class="error1 text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="depPosisi">Departemen :</label><br>
                                        <select id='depPosisi' name='depPosisi' class="form-control form-control-user">
                                             <option value="">-- Pilih Departemen --</option>
                                        </select>
                                        <small class="error2 text-danger font-italic font-weight-bold"></small><br>
                                   </div>

                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="Posisi">Posisi :</label>
                                        <input id='Posisi' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                        <small class="error4 text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="ketPosisi">Keterangan :</label><br>
                                        <textarea id='ketPosisi' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user"></textarea>
                                        <small class="error5 text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr class="mb-2">
                                        <button type="button" name="btnTambahPosisi" id="btnTambahPosisi" class="btn font-weight-bold btn-primary">Simpan</button>
                                        <button type="button" name="btnBatalPosisi" id="btnBatalPosisi" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>