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
                                        <a href="<?= base_url('karyawan'); ?>">
                                             Karyawan
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Detail Data Karyawan
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
                              <h5>Detail Data Karyawan - <?= $data_kary->nama_lengkap ?></h5>
                              <div class="card-header-right">
                                   <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                             <li class="dropdown-item full-card">
                                                  <a href="#!"><span><i class="feather icon-maximize"></i>
                                                            FullScreen</span><span style="display: none"><i class="feather icon-minimize"></i> Restore</span></a>
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
                         <div class="card-body pt-4">
                              <div class="row">
                                   <div class="col-md-2 col-sm-12">
                                        <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                             <li><a class="nav-link text-left has-ripple active" id="v-pills-dtPersonal-tab" data-toggle="pill" href="#v-pills-dtPersonal" role="tab" aria-controls="v-pills-dtPersonal" aria-selected="true">Data Personal<span class="ripple ripple-animate" style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -152.188px; left: -96.625px;"></span></a></li>
                                             <li><a class="nav-link text-left has-ripple" id="v-pills-dtKaryawan-tab" data-toggle="pill" href="#v-pills-dtKaryawan" role="tab" aria-controls="v-pills-dtKaryawan" aria-selected="false">Data Karyawan<span class="ripple ripple-animate" style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -162.188px; left: -102.625px;"></span></a></li>
                                             <li><a class="nav-link text-left has-ripple" id="v-pills-dtDomisili-tab" data-toggle="pill" href="#" role="tab" aria-controls="v-pills-dtDomisili" aria-selected="false">Domisili<span class="ripple ripple-animate" style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -174.188px; left: -108.625px;"></span></a></li>
                                             <li><a class="nav-link text-left has-ripple" id="v-pills-dtKontakDarurat-tab" data-toggle="pill" href="#" role="tab" aria-controls="v-pills-dtKontakDarurat" aria-selected="false">Kontak Darurat<span class="ripple ripple-animate" style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -168.188px; left: -119.625px;"></span></a></li>
                                        </ul>
                                   </div>
                                   <div class="col-md-10 col-sm-12">
                                        <div class="tab-content" id="v-pills-tabContent">
                                             <div class="tab-pane fade active show" id="v-pills-dtPersonal" role="tabpanel" aria-labelledby="v-pills-dtPersonal-tab">
                                                  <div class="card-body row">
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. KTP</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->no_ktp ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Nama Lengkap</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->nama_lengkap ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Alamat Email</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->email_pribadi ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. Telp</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->no_ktp ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Tempat & Tanggal Lahir</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->tmp_lahir . ", " . $data_kary->tgl_lahir ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Status Pernikahan</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->kode_stat_nikah ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Kewarganegaraan</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->warga_negara ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Agama</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->id_agama ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Jenis Kelamin</h6>
                                                                 <input type="text" class="form-control" value="<?= ($data_kary->jk == 'LK') ? "LAKI-LAKI" : "PEREMPUAN"; ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Kode Bank</h6>
                                                                 <input type="text" class="form-control" value="" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. Rekening</h6>
                                                                 <input type="text" class="form-control" value="" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. NPWP</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->no_npwp ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. BPJS Tenaga Kerja</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->no_bpjstk ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. BPJS Kesehatan</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->no_bpjskes ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. Equity</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->no_equity ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="tab-pane fade" id="v-pills-dtKaryawan" role="tabpanel" aria-labelledby="v-pills-dtKaryawan-tab">
                                                  <div class="card-body row">
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Nama Perusahaan</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->nama_perusahaan ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>NIK</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->no_nik ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Departemen</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->depart ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Section</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->section ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Posisi</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->posisi ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Jenis Karyawan</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->tipe ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Status Karyawan</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->stat_kerja ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <?php if ($data_kary->stat_kerja == "Permanen") { ?>
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                 <div class="form-group">
                                                                      <h5>Tanggal Permanen</h5>
                                                                      <input type="text" class="form-control" value="<?= $data_kary->tgl_permanen ?>" style="background-color:transparent;" disabled>
                                                                 </div>
                                                            </div>
                                                       <?php } else { ?>
                                                            <div class="col-lg-2 col-md-2 col-sm-12">
                                                                 <div class="form-group">
                                                                      <h5>Tanggal Awal</h5>
                                                                      <input type="text" class="form-control" value="<?= $data_kary->tgl_permanen ?>" style="background-color:transparent;" disabled>
                                                                 </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-sm-12">
                                                                 <div class="form-group">
                                                                      <h5>Tanggal Akhir</h5>
                                                                      <input type="text" class="form-control" value="<?= $data_kary->tgl_permanen ?>" style="background-color:transparent;" disabled>
                                                                 </div>
                                                            </div>
                                                       <?php } ?>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Tipe Roster</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->roster ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Status Residence</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->roster == "R" ? "Residence" : "Non Residence" ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Point of Hire</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->poh ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Grade</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->grade ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Level</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->level ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Lokasi Kerja</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->lokker ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h5>Lokasi Penerimaan</h5>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->lokterima ?>" style="background-color:transparent;" disabled>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="tab-pane fade" id="v-pills-dtDomisili" role="tabpanel" aria-labelledby="v-pills-dtDomisili-tab">
                                                  <p class="mb-0">Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit
                                                       nostrud magna
                                                       nulla. Velit et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                                             </div>
                                             <div class="tab-pane fade" id="v-pills-dtKontakDarurat" role="tabpanel" aria-labelledby="v-pills-dtKontakDarurat-tab">
                                                  <p class="mb-0">Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. Voluptate excepteur commodo labore nisi cillum
                                                       duis
                                                       aliqua do.
                                                       Aliqua amet qui mollit consectetur nulla mollit velit aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute tempor commodo
                                                       eiusmod.
                                                  </p>
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