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
                                        <a href="<?= base_url('struktur'); ?>">
                                             Struktur Perusahaan
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
                                   <div class="mb-3">
                                        <a id="btnTabelStr" class="btn btn-primary font-weight-bold text-white"><i class="fas fa-sync-alt"></i> Refresh / Data</a>
                                        <a id="btnNewStr" href="#" class="btn btn-success font-weight-bold"><i class="fas fa-plus"></i> Buat Data</a>
                                   </div>
                                   <?= $this->session->flashdata("psn"); ?>
                              </div>
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div id="clPerusahaan" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             Data perusahaan
                                             <img id="imgPerusahaan" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="" id="colPerusahaan">
                                             <div class="card card-body mt-2">
                                                  <div class="row mt-2">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group mt-3">
                                                                 <h5>Perusahaan Utama :</h5>
                                                                 <h4 id='txtPerusahaanUtama' name='txtPerusahaanUtama' class=" font-weight-bold text-lg-left bg-white mb-3"></h4>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                            <h5>Perusahaan Subcontractor :</h5>
                                                       </div>
                                                       <div class="col-lg-3 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="txtkodeMperusahaan">Kode Perusahaan </label><br>
                                                                 <h4 id='txtkodeMperusahaan' name='txtkodeMperusahaan' class=" font-weight-bold text-lg-left bg-white"></h4>
                                                            </div>
                                                            <span class="8ih3js7h3k8kj42b5n1m5n3 d-none"></span>
                                                       </div>
                                                       <div class="col-lg-9 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="txtnamaMperusahaan">Nama Perusahaan</label><br>
                                                                 <h4 id='txtnamaMperusahaan' name='txtnamaMperusahaan' class=" font-weight-bold text-lg-left bg-white"></h4>
                                                                 <span class="b8f9s7sd7f7asj3h4j3k2j d-none"></span>
                                                                 <span class="a67z34ssdh53b45jfasda4 d-none"></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="row">
                                                                 <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                                      <button id="clRK3L-click" class="btn btn-primary w-100" style="text-align:left;">
                                                                           <a class="text-white" data-toggle="collapse" href="#!" role="button" aria-expanded="false" aria-controls="colRK3L">
                                                                                1. Rencana Keselamatan, Kesehatan Kerja dan Lingkungan (RK3L)
                                                                           </a>
                                                                           <img id="imgRK3L" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                                                      </button>
                                                                      <div class="collapse" id="colRK3L">
                                                                           <div class="card card-body mt-2">
                                                                                <div class="row mt-2">
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                          <div class="row">
                                                                                               <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                                                                    <div class="alert alert-danger errormsgrk3l animate__animated animate__bounce d-none mb-3"></div>
                                                                                               </div>
                                                                                               <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div>
                                                                                                         <h6 class="text-danger font-italic">Catatan : Upload Rencana Keselamatan, Kesehatan Kerja Dan Lingkungan (RK3L) dalam format pdf, ukuran maksimal 1 mb.</h6>
                                                                                                    </div>
                                                                                                    <div class="form-group mb-3">
                                                                                                         <label for="filerk3l"><b>Rencana Keselamatan, Kesehatan Kerja Dan Lingkungan (RK3L) </b> :</label>
                                                                                                         <div class="input-group">
                                                                                                              <input type="file" class="form-control-file" id="filerk3l" disabled>
                                                                                                         </div>
                                                                                                         <small class="error6rk3l text-danger font-italic font-weight-bold mb-3"></small>
                                                                                                    </div>
                                                                                               </div>
                                                                                               <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                                    <a href="#!" id="addBukaFile" target="_blank" class="btn btn-success font-weight-bold mt-3" disabled>Tampilkan RK3L</a>
                                                                                                    <button id="addResetFileRK3L" class="btn btn-danger font-weight-bold mt-3 ml-2" disabled>Reset RK3L</button>
                                                                                                    <button id="btnUploadFileRK3L" class="btn btn-primary font-weight-bold mt-3 ml-2" disabled>Upload RK3L</button>
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                                      <button id="clIUJP-click" class="btn btn-primary w-100" style="text-align:left;">
                                                                           <a class="text-white" data-toggle="collapse" href="#!" role="button" aria-expanded="false" aria-controls="colIUJP">
                                                                                2. Izin Usaha Jasa Penambangan (IUJP) / Perizinan Lainnya
                                                                           </a>
                                                                           <img id="imgIUJP" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                                                      </button>
                                                                      <div class="collapse" id="colIUJP">
                                                                           <div class="card card-body mt-2">
                                                                                <div class="row">
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                                                          <div class="alert alert-danger errormsgiujp animate__animated animate__bounce d-none mb-3"></div>
                                                                                     </div>
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                          <div class="row">
                                                                                               <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                                                                                    <label for="noiujp">No. IUJP / No. Perizinan </label>
                                                                                                    <input id='noiujp' name='noiujp' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                                    <small class="error2iujp text-danger font-italic font-weight-bold"></small><br>
                                                                                                    <span class="o8s9l3l8n34m7834m22n4w3a d-none"></span>
                                                                                               </div>
                                                                                               <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                                                                    <label for="tglAktifiujp">Tanggal Aktif :</label>
                                                                                                    <input id='tglAktifiujp' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                                    <small class="error3iujp text-danger font-italic font-weight-bold"></small><br>
                                                                                               </div>
                                                                                               <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                                                                    <label for="tglakhiriujp">Tanggal Berakhir :</label>
                                                                                                    <input id='tglakhiriujp' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                                    <small class="error4iujp text-danger font-italic font-weight-bold"></small><br>
                                                                                               </div>
                                                                                               <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                                                                    <label for="ketiujp">Keterangan : </label>
                                                                                                    <textarea id='ketiujp' name='ketiujp' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled></textarea>
                                                                                                    <small class="error5iujp text-danger font-italic font-weight-bold"></small><br>
                                                                                               </div>
                                                                                               <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                                                                    <div>
                                                                                                         <h6 class="text-danger font-italic">Catatan : Upload Izin Usaha Jasa Penambangan (IUJP) dalam format pdf, Ukuran maksimal 500 kb.</h6>
                                                                                                    </div>
                                                                                                    <div class="form-group mb-3">
                                                                                                         <label for="fileiujp"><b>Upload Izin Usaha Jasa Penambangan (IUJP)</b> :</label>
                                                                                                         <div class="input-group">
                                                                                                              <input type="file" class="form-control-file" id="fileiujp" disabled>
                                                                                                         </div>
                                                                                                         <small class="error6iujp text-danger font-italic font-weight-bold mb-3"></small>
                                                                                                    </div>
                                                                                                    <a id="addBukaFileIUJP" href="#!" target="_blank" class="btn btn-success font-weight-bold mt-3" disabled>Tampilkan IUJP</a>
                                                                                                    <button id="addResetFileIUJP" class="btn btn-danger font-weight-bold mt-3 ml-2" disabled>Reset IUJP</button>
                                                                                                    <button id="btnUploadFileIUJP" class="btn btn-primary font-weight-bold mt-3 ml-2" disabled> Simpan & Upload IUJP</button>
                                                                                               </div>
                                                                                               <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                                                                    <span class="text-danger font-italic font-weight-bold">* Tambahkan jenis perizinan pada keterangan jika bukan IUJP</span>
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                                      <button id="clSIO-click" class="btn btn-primary w-100" style="text-align:left;">
                                                                           <a class="text-white" data-toggle="collapse" href="#!" role="button" aria-expanded="false" aria-controls="colSIO">
                                                                                3. Surat Izin Operasional (SIO)
                                                                           </a>
                                                                           <img id="imgSIO" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                                                      </button>
                                                                      <div class="collapse" id="colSIO">
                                                                           <div class="card card-body mt-2">
                                                                                <div class="row">
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                                                          <div class="alert alert-danger errormsgsio animate__animated animate__bounce d-none mb-3"></div>
                                                                                     </div>
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                          <div class="row">
                                                                                               <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                                                                                    <label for="noSIO">No. SIO :</label>
                                                                                                    <input id='noSIO' name='noSIO' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                                    <small class="error2SIO text-danger font-italic font-weight-bold"></small><br>
                                                                                                    <span class="2l7k6h9m1v9j3b8k3h8d5d0 d-none"></span>
                                                                                               </div>
                                                                                               <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                                                                    <label for="tglaktifSIO">Tanggal Aktif :</label>
                                                                                                    <input id='tglaktifSIO' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                                    <small class="error3SIO text-danger font-italic font-weight-bold"></small><br>
                                                                                               </div>
                                                                                               <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                                                                    <label for="tglakhirSIO">Tanggal Berakhir :</label>
                                                                                                    <input id='tglakhirSIO' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                                    <small class="error4SIO text-danger font-italic font-weight-bold"></small><br>
                                                                                               </div>
                                                                                               <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                                                                    <label for="ketSIO">Kegiatan :</label>
                                                                                                    <textarea id='ketSIO' name='ketSIO' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled></textarea>
                                                                                                    <small class="error5SIO text-danger font-italic font-weight-bold"></small><br>
                                                                                               </div>
                                                                                               <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                                                                    <div>
                                                                                                         <h6 class="text-danger font-italic">Catatan : Upload Surat Izin Operasi dalam format pdf, Ukuran maksimal 100 kb.</h6>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                         <label for="fileSIO"><b>Upload Surat Izin Operasi (SIO)</b> :</label>
                                                                                                         <input type="file" class="form-control-file" id="fileSIO" disabled>
                                                                                                         <small class="error6fileSIO text-danger font-italic font-weight-bold"></small>
                                                                                                    </div>
                                                                                                    <a id="addBukaFileSIO" href="#!" target="_blank" class="btn btn-success font-weight-bold mt-3" disabled>Tampilkan SIO</a>
                                                                                                    <button id="addResetFileSIO" class="btn btn-danger font-weight-bold mt-3 ml-2" disabled>Reset SIO</button>
                                                                                                    <button id="btnUploadFileSIO" class="btn btn-primary font-weight-bold mt-3 ml-2" disabled> Simpan & Upload SIO</button>
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                                      <button id="clKontrak-click" class="btn btn-primary w-100" style="text-align:left;">
                                                                           <a class="text-white" data-toggle="collapse" href="#!" role="button" aria-expanded="false" aria-controls="colKontrak">
                                                                                4. Kontrak
                                                                           </a>
                                                                           <img id="imgKontrak" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                                                      </button>
                                                                      <div class="collapse" id="colKontrak">
                                                                           <div class="card card-body mt-2">
                                                                                <div class="row">
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                                                          <div class="alert alert-danger errormsgkontrak animate__animated animate__bounce d-none mb-3"></div>
                                                                                     </div>
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                          <div class="row">
                                                                                               <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                                                                                    <label for="nokontrak">No. Kontrak :</label>
                                                                                                    <input id='nokontrak' name='nokontrak' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                                    <small class="error3kontrak text-danger font-italic font-weight-bold"></small><br>
                                                                                                    <span class="8jl23m67jsd9lasd0m2n34bn344 d-none"></span>
                                                                                               </div>
                                                                                               <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                                                                    <label for="tglaktifkontrak">Tanggal Aktif :</label>
                                                                                                    <input id='tglaktifkontrak' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                                    <small class="error4kontrak text-danger font-italic font-weight-bold"></small><br>
                                                                                               </div>
                                                                                               <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                                                                    <label for="tglakhirkontrak">Tanggal Akhir :</label>
                                                                                                    <input id='tglakhirkontrak' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                                    <small class="error5kontrak text-danger font-italic font-weight-bold"></small><br>
                                                                                               </div>
                                                                                               <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                                                                    <label for="ketkontrak">Keterangan :</label>
                                                                                                    <textarea id='ketkontrak' name='ketkontrak' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled></textarea>
                                                                                                    <small class="error6kontrak text-danger font-italic font-weight-bold"></small><br>
                                                                                               </div>
                                                                                               <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                                                                    <div>
                                                                                                         <h6 class="text-danger font-italic">Catatan : Upload Kontrak dalam format pdf, Ukuran maksimal 100 kb.</h6>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                         <label for="fileKontrak"><b>Upload Kontrak</b> :</label>
                                                                                                         <input type="file" class="form-control-file" id="fileKontrak" disabled>
                                                                                                         <small class="error7kontrak text-danger font-italic font-weight-bold"></small>
                                                                                                    </div>
                                                                                                    <a id="addBukaFileKontrak" href="#!" target="_blank" class="btn btn-success font-weight-bold mt-3" disabled>Tampilkan Kontrak</a>
                                                                                                    <button id="addResetFileKontrak" class="btn btn-danger font-weight-bold mt-3 ml-2" disabled>Reset Kontrak</button>
                                                                                                    <button id="btnUploadFileKontrak" class="btn btn-primary font-weight-bold mt-3 ml-2" disabled> Simpan & Upload Kontrak</button>
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                                      <button id="clPJO-click" class="btn btn-primary w-100" style="text-align:left;">
                                                                           <a class="text-white" data-toggle="collapse" href="#!" role="button" aria-expanded="false" aria-controls="colPJO">
                                                                                5. Penanggung Jawab Operasional (PJO)
                                                                           </a>
                                                                           <img id="imgPJO" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                                                      </button>
                                                                      <div class="collapse" id="colPJO">
                                                                           <div class="card card-body mt-2">
                                                                                <div class="row">
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                                                          <div class="alert alert-danger errormsgpjo animate__animated animate__bounce d-none mb-3"></div>
                                                                                     </div>
                                                                                     <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                                                                          <label for="nopjo">No. Pengesahan :</label>
                                                                                          <input id='nopjo' name='nopjo' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                          <small class="error2pjo text-danger font-italic font-weight-bold"></small><br>
                                                                                     </div>
                                                                                     <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                                                          <label for="tglaktifpjo">Tanggal Aktif :</label>
                                                                                          <input id='tglaktifpjo' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                          <small class="error4pjo text-danger font-italic font-weight-bold"></small><br>
                                                                                     </div>
                                                                                     <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                                                          <label for="tglakhirpjo">Tanggal Berakhir :</label>
                                                                                          <input id='tglakhirpjo' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                          <small class="error5pjo text-danger font-italic font-weight-bold"></small><br>
                                                                                     </div>
                                                                                     <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                                                          <label for="lokkerpjo">Lokasi Kerja :</label>
                                                                                          <select id='lokkerpjo' name='lokkerpjo' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                               <option value="">-- PILIH LOKASI KERJA --</option>
                                                                                          </select>
                                                                                          <small class="error3pjo text-danger font-italic font-weight-bold"></small><br>
                                                                                     </div>
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                                                          <hr>
                                                                                     </div>
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-3">
                                                                                          <label for="caripjo">Cari Data PJO :</label>
                                                                                          <div class="input-group">
                                                                                               <input id='caripjo' name='caripjo' type="text" placeholder="Ketikkan No. KTP / NIK / Nama Karyawan" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled><br>
                                                                                          </div>
                                                                                     </div>
                                                                                     <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                                                          <label for="ktppjo">No. KTP :</label>
                                                                                          <input id='ktppjo' name='ktppjo' type="number" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                          <small class="error6pjo text-danger font-italic font-weight-bold"></small>
                                                                                          <span class="8c9l1k4n9d09vm3mn43k8s834kk45 d-none"></span><br>
                                                                                     </div>
                                                                                     <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                                                          <label for="nikpjo">NIK :</label>
                                                                                          <input id='nikpjo' name='nikpjo' type="number" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                          <small class="error7pjo text-danger font-italic font-weight-bold"></small><br>
                                                                                     </div>
                                                                                     <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                                                                          <label for="namapjo">Nama Lengkap:</label>
                                                                                          <input id='namapjo' name='namapjo' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                                                                          <small class="error8pjo text-danger font-italic font-weight-bold"></small><br>
                                                                                     </div>
                                                                                     <div class="col-lg-6 col-md-6 col-sm-12 mb-3" style="margin-top:-5px;">
                                                                                          <a href="#!" id="btnResetKary" class="btn btn-success font-weight-bold mt-3">Reset Karyawan</a>
                                                                                     </div>
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                                                          <label for="ketpjo">Keterangan :</label>
                                                                                          <textarea id='ketpjo' name='ketIujb' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea><br>
                                                                                     </div>
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12 mt-3 ">
                                                                                          <div>
                                                                                               <h6 class="text-danger font-italic">Catatan : Upload file pengesahan PJO dalam format pdf, Ukuran maksimal 100 kb.</h6>
                                                                                          </div>
                                                                                          <div class="form-group mb-3">
                                                                                               <label for="filePJO"><b>Upload Pengesahan PJO</b> :</label>
                                                                                               <input type="file" class="form-control-file" id="filePJO" disabled>
                                                                                               <small class="error10pjo text-danger font-italic font-weight-bold"></small>
                                                                                          </div>
                                                                                          <button id="refreshPjo" class='btn btn-danger font-weight-bold mt-3 ml-2' disabled>Reset PJO</button>
                                                                                          <button id="addSimpanPJO" class="btn btn-success font-weight-bold mt-3" disabled>Simpan PJO</button>
                                                                                     </div>
                                                                                     <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                                                          <hr>
                                                                                          <div id="idpjo" class="data"></div>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-lg-12 col-md-12 col-sm-12 text-right mt-3 btnselesai"></div>
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
     </div>
</div>
<div class="modal fade" id="mdlstrperusahaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:60%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Struktur Perusahaan Baru</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert alert-danger errormsgper animate__animated animate__bounce d-none mb-3"></div>
                              <h6 class="font-italic">Pilih Perusahaan Utama<span class="text-danger">*</span></h6>
                              <select id='perJenis' name='perJenis' class="form-control form-control-user">
                                   <option value="">-- PERUSAHAAN UTAMA --</option>
                                   <?= $permst . $perstr; ?>
                              </select>
                              <small class="error1str text-danger font-italic font-weight-bold"></small><br>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="cariMPerusahaan">Cari Perusahaan Subcontractor :</label>
                                   <input id='cariMPerusahaan' name='cariMPerusahaan' type="text" placeholder="Ketikkan Kode Perusahaan / Nama Perusahaan" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2">
                              <h5>Perusahaan Subcontractor :</h5>
                         </div>
                         <div class="col-lg-3 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="kodeMperusahaan">Kode Perusahaan <span class="text-danger">*</span> </label>
                                   <input id='kodeMperusahaan' name='kodeMperusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" disabled>
                                   <small class="error2str text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                         <div class="col-lg-9 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="namaMperusahaan">Nama Perusahaan <span class="text-danger">*</span></label>
                                   <input id='namaMperusahaan' name='namaMperusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                   <small class="error3str text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnSaveStrPer" id="btnSaveStrPer" class="btn font-weight-bold btn-primary">Simpan Data</button>
                    <button type="button" name="btnCancelStrPer" id="btnCancelStrPer" data-dismiss="modal" class="btn font-weight-bold btn-warning">Selesai</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlEditPJO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document" style="margin-left: auto; margin-right: auto;max-width:60%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit PJO</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                              <div class="alert alert-danger errormsgpjo animate__animated animate__bounce d-none mb-3"></div>
                         </div>
                         <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                              <label for="noPJOEdit">No. Pengesahan :</label>
                              <input id='noPJOEdit' name='noPJOEdit' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                              <small class="error2PJOEdit text-danger font-italic font-weight-bold"></small><br>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                              <label for="tglaktifPJOEdit">Tanggal Aktif :</label>
                              <input id='tglaktifPJOEdit' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                              <small class="error4PJOEdit text-danger font-italic font-weight-bold"></small><br>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                              <label for="tglakhirPJOEdit">Tanggal Berakhir :</label>
                              <input id='tglakhirPJOEdit' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                              <small class="error5PJOEdit text-danger font-italic font-weight-bold"></small><br>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                              <label for="lokkerPJOEdit">Lokasi Kerja :</label>
                              <select id='lokkerPJOEdit' name='lokkerPJOEdit' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                                   <option value="">-- PILIH LOKASI KERJA --</option>
                              </select>
                              <small class="error3PJOEdit text-danger font-italic font-weight-bold"></small><br>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                              <hr>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-3">
                              <label for="cariPJOEdit">Cari Data PJO :</label>
                              <div class="input-group">
                                   <input id='cariPJOEdit' name='cariPJOEdit' type="text" placeholder="Ketikkan No. KTP / NIK / Nama Karyawan" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled><br>
                              </div>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                              <label for="ktpPJOEdit">No. KTP :</label>
                              <input id='ktpPJOEdit' name='ktpPJOEdit' type="number" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                              <small class="error6PJOEdit text-danger font-italic font-weight-bold"></small>
                              <span class="8c9l1k4n9d09vm3mn43k8s834kk d-none"></span><br>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                              <label for="nikPJOEdit">NIK :</label>
                              <input id='nikPJOEdit' name='nikPJOEdit' type="number" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                              <small class="error7PJOEdit text-danger font-italic font-weight-bold"></small><br>
                         </div>
                         <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                              <label for="namaPJOEdit">Nama Lengkap:</label>
                              <input id='namaPJOEdit' name='namaPJOEdit' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" disabled>
                              <small class="error8PJOEdit text-danger font-italic font-weight-bold"></small><br>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                              <label for="ketPJOEdit">Keterangan :</label>
                              <textarea id='ketPJOEdit' name='ketIujb' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea><br>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 mt-3 ">
                              <div>
                                   <h6 class="text-danger font-italic">Catatan : Upload file pengesahan PJO dalam format pdf, ukuran maksimal 1 mb.</h6>
                              </div>
                              <div class="form-group mb-3">
                                   <label for="filePJOEdit"><b>Upload Pengesahan PJO</b> :</label>
                                   <input type="file" class="form-control-file" id="filePJOEdit" disabled>
                                   <small class="error10PJOEdit text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnUpdatePJO" id="btnUpdatePJO" class="btn font-weight-bold btn-primary">Update Data</button>
                    <button type="button" name="btnCancelStrPer" id="btnCancelStrPer" data-dismiss="modal" class="btn font-weight-bold btn-warning">Batal</button>
               </div>
          </div>
     </div>
</div>