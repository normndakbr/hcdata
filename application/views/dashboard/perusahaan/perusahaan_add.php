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
                                        <a href="<?= base_url('Perusahaan'); ?>">
                                             Perusahaan
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Tambah Perusahaan
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
                              <h5>Perusahaan</h5>
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
                                        <a href="<?= base_url('perusahaan'); ?>" class="btn btn-primary font-weight-bold">Refresh / Data</a>
                                        <a href="<?= base_url('perusahaan/new'); ?>" class="btn btn-success font-weight-bold">Tambah Data</a>
                                   </div>
                                   <div class="alert alert-danger err_psn_perusahaan animate__animated animate__bounce d-none"></div>
                              </div>
                              <div class="row">
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="form-group fill">
                                             <label for="kodePerusahaan">Kode Perusahaan :</label>
                                             <input id='kodePerusahaan' name='kodePerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                             <small class="error1 text-danger font-italic font-weight-bold"></small>
                                        </div>

                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group fill">
                                             <label for="Perusahaan">Nama Perusahaan :</label>
                                             <input id='Perusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                             <small class="error2 text-danger font-italic font-weight-bold"></small>
                                        </div>

                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group fill">
                                             <label for="alamatPerusahaan">Alamat :</label>
                                             <input id='alamatPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                             <small class="error3 text-danger font-italic font-weight-bold"></small>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="provPerusahaan">Provinsi :</label><br>
                                        <div class="input-group">
                                             <select id='provPerusahaan' name='provPerusahaan' class="form-control" required>
                                                  <option value="00">-- WAJIB DIPILIH --</option>
                                             </select>
                                             <button class="btn btn-primary btn-sm feather icon-refresh-ccw refprov" title="Reload Provinsi"></button>
                                        </div>
                                        <small class="error5 text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="kabPerusahaan">Kabupaten/Kota :</label><br>
                                        <div class="input-group">
                                             <select id='kabPerusahaan' name='kabPerusahaan' class="form-control" required>
                                                  <option value="0000">-- WAJIB DIPILIH --</option>
                                             </select>
                                             <button class="btn btn-primary btn-sm feather icon-refresh-ccw refkab" title="Reload Kabupaten"></button>
                                        </div>
                                        <small class="error6 text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label for="kecPerusahaan">Kecamatan :</label><br>
                                        <div class="input-group">
                                             <select id='kecPerusahaan' name='kecPerusahaan' class="form-control" required>
                                                  <option value="000000">-- WAJIB DIPILIH --</option>
                                             </select>
                                             <button class="btn btn-primary btn-sm feather icon-refresh-ccw refkec" title="Reload Kecamatan"></button>
                                        </div>
                                        <small class="error7 text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label for="kelPerusahaan">Kelurahan :</label><br>
                                        <div class="input-group">
                                             <select id='kelPerusahaan' name='kelPerusahaan' class="form-control" required>
                                                  <option value="00000000">-- WAJIB DIPILIH --</option>
                                             </select>
                                             <button class="btn btn-primary btn-sm feather icon-refresh-ccw refkel" title="Reload Kelurahan"></button>
                                        </div>
                                        <small class="error8 text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="kegPerusahaan">Kegiatan :</label><br>
                                        <textarea id='kegPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user"></textarea>
                                        <small class="error13 text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                        <label for="ketPerusahaan">Keterangan :</label><br>
                                        <textarea id='ketPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user"></textarea>
                                        <small class="error14 text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                        <div>
                                             <h6 class="text-danger font-italic">Catatan : Upload file RK3L dalam format pdf, Ukuran maksimal 5 mb.</h6>
                                        </div>
                                        <div class="form-group">
                                             <label for="fileSertifikasi"><b>Upload Rencana Kerja Keselamatan Dan Kesehatan Kerja Dan Lingkunghan Hidup (RK3L) </b> :</label>
                                             <input type="file" class="form-control-file" id="fileSertifikasi">
                                             <small class="errorFileSertifikasi text-danger font-italic font-weight-bold"></small>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr class="mb-2">
                                        <button type="button" name="btnTambahPerusahaan" id="btnTambahPerusahaan" class="btn font-weight-bold btn-primary">Simpan</button>
                                        <button type="button" name="btnBatalPerusahaan" id="btnBatalPerusahaan" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>