<div class="pcoded-main-container">
     <div class="pcoded-content">
          <div class="page-header">
               <div class="page-block">
                    <div class="row align-items-center">
                         <div class="col-md-12">
                              <div class="page-header-title">
                                   <h5 class="font-italic font-weight-bold text-white">Selamat Datang,</h5>
                                   <h2 class="font-weight-bold text-white" style="margin-top:-10px;"><?= $nama; ?></h2>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-lg-12 col-md-12" style="margin-top:-20px;">
                    <div class="row">
                         <div class="col-sm-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="row align-items-center">
                                             <div class="col-8">
                                                  <h4 class="text-c-yellow jmlusr"><?= $jml_karyawan ?></h4>
                                                  <h6 class="text-muted m-b-0">Karyawan</h6>
                                             </div>
                                             <div class="col-4 text-right">
                                                  <i class="feather icon-user f-28"></i>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="card-footer bg-c-yellow">
                                        <div class="row align-items-center">
                                             <div class="col-9">
                                                  <a href="#" onclick="tabelUser()" class="text-white m-b-0">Detail</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-sm-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="row align-items-center">
                                             <div class="col-8">
                                                  <h4 class="text-c-green jmlmap"><?= $jml_user ?></h4>
                                                  <h6 class="text-muted m-b-0">Pelanggaran</h6>
                                             </div>
                                             <div class="col-4 text-right">
                                                  <i class="feather icon-map f-28"></i>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="card-footer bg-c-green">
                                        <div class="row align-items-center">
                                             <div class="col-9">
                                                  <a href="#" onclick="tableMap()" class="text-white m-b-0">Detail</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-sm-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="row align-items-center">
                                             <div class="col-8">
                                                  <h4 class="text-c-red">145</h4>
                                                  <h6 class="text-muted m-b-0">Akses eEmployee</h6>
                                             </div>
                                             <div class="col-4 text-right">
                                                  <i class="feather icon-upload-cloud f-28"></i>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="card-footer bg-c-red">
                                        <div class="row align-items-center">
                                             <div class="col-9">
                                                  <a href="#" class="text-white m-b-0">Detail</a>
                                             </div>

                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-sm-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="row align-items-center">
                                             <div class="col-8">
                                                  <h4 class="text-c-blue">4</h4>
                                                  <h6 class="text-muted m-b-0">Data Terbaru</h6>
                                             </div>
                                             <div class="col-4 text-right">
                                                  <i class="feather icon-file-plus f-28"></i>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="card-footer bg-c-blue">
                                        <div class="row align-items-center">
                                             <div class="col-9">
                                                  <a href="#" class="text-white m-b-0">Detail</a>
                                             </div>

                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-xl-12 col-md-12">
                    <div class="card latest-update-card">
                         <div class="card-header">
                              <h5>Perbandingan Jumlah Karywan per-tanggal : <?= date("d-M-Y"); ?></h5>
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
                              <div id="bar-chart-1"></div>
                         </div>
                    </div>
               </div>
          </div>
     </div>