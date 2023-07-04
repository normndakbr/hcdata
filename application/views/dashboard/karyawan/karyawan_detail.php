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
                              <h5>Detail Data Karyawan - <?= "No. KTP : " . $data_kary->no_ktp . " | " . $data_kary->nama_lengkap ?></h5>
                              <div class="card-header-right">
                                   <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i style="font-size: 32;" class="feather icon-menu"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                             <li class="dropdown-item reload-card">
                                                  <a href="#!"><i class="feather icon-edit"></i> Edit Data</a>
                                             </li>
                                             <li class="dropdown-item full-card">
                                                  <a href="#!"><span><i class="feather icon-maximize"></i>
                                                            FullScreen</span><span style="display: none"><i class="feather icon-minimize"></i> Restore</span></a>
                                             </li>
                                             <!-- <li class="dropdown-item minimize-card">
                                                  <a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display: none"><i class="feather icon-plus"></i> expand</span></a>
                                             </li> -->
                                             <li class="dropdown-item reload-card">
                                                  <a id="btnrefDetailKary" href="#!"><i class="feather icon-refresh-cw"></i>Reload</a>
                                             </li>
                                        </ul>
                                   </div>
                              </div>
                         </div>
                         <div class="card-body pt-4">
                              <div class="row">
                                   <!-- <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                        <a id="btnrefDetailKary" href="#!" class="btn btn-primary">Refresh</a>
                                   </div> -->
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                             <li><a class="nav-link text-left has-ripple active" id="v-pills-dtPersonal-tab" data-toggle="pill" href="#v-pills-dtPersonal" role="tab" aria-controls="v-pills-dtPersonal" aria-selected="true">Data Personal<span class="ripple ripple-animate" style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -152.188px; left: -96.625px;"></span></a></li>
                                             <li><a class="nav-link text-left has-ripple" id="v-pills-dtKaryawan-tab" data-toggle="pill" href="#v-pills-dtKaryawan" role="tab" aria-controls="v-pills-dtKaryawan" aria-selected="false">Data Karyawan<span class="ripple ripple-animate" style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -162.188px; left: -102.625px;"></span></a></li>
                                             <li><a class="nav-link text-left has-ripple" id="v-pills-dtSIMPER-tab" data-toggle="pill" href="#v-pills-dtSIMPER" role="tab" aria-controls="v-pills-dtSIMPER" aria-selected="false">SIMPER/Mine Permit<span class="ripple ripple-animate" style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -174.188px; left: -108.625px;"></span></a></li>
                                             <li><a class="nav-link text-left has-ripple" id="v-pills-dtSertifikasi-tab" data-toggle="pill" href="#v-pills-dtSertifikasi" role="tab" aria-controls="v-pills-dtSertifikasi" aria-selected="false">Sertifikasi<span class="ripple ripple-animate" style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -168.188px; left: -119.625px;"></span></a></li>
                                             <li><a class="nav-link text-left has-ripple" id="v-pills-dtMCU-tab" data-toggle="pill" href="#v-pills-dtMCU" role="tab" aria-controls="v-pills-dtMCU" aria-selected="false">Medical Check Up (MCU)<span class="ripple ripple-animate" style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -168.188px; left: -119.625px;"></span></a></li>
                                             <li><a class="nav-link text-left has-ripple" id="v-pills-dtVaksin-tab" data-toggle="pill" href="#v-pills-dtVaksin" role="tab" aria-controls="v-pills-dtVaksin" aria-selected="false">Vaksin<span class="ripple ripple-animate" style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -168.188px; left: -119.625px;"></span></a></li>
                                             <li><a class="nav-link text-left has-ripple" id="v-pills-dtFilePendukung-tab" data-toggle="pill" href="#v-pills-dtFilePendukung" role="tab" aria-controls="v-pills-dtFilePendukung" aria-selected="false">File Pendukung<span class="ripple ripple-animate" style="height: 373.25px; width: 373.25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -168.188px; left: -119.625px;"></span></a></li>
                                        </ul>
                                   </div>
                                   <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="tab-content" id="v-pills-tabContent">
                                             <div class="tab-pane fade active show" id="v-pills-dtPersonal" role="tabpanel" aria-labelledby="v-pills-dtPersonal-tab">
                                                  <div class="card-body row">
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. KTP</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->no_ktp) ? $data_kary->no_ktp : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Nama Lengkap</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->nama_lengkap) ? $data_kary->nama_lengkap : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Alamat</h6>
                                                                 <textarea type="text" class="form-control" style="background-color:transparent;margin-top:-10px;" disabled><?= $data_alamat ?></textarea>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Agama</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->agama) ? $data_kary->agama : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Jenis Kelamin</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->jk) ? (($data_kary->jk == 'LK') ? "LAKI-LAKI" : "PEREMPUAN") : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Status Pernikahan</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->kode_stat_nikah) ? $data_kary->kode_stat_nikah : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Kewarganegaraan</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->warga_negara) ? $data_kary->warga_negara : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Tempat & Tanggal Lahir</h6>
                                                                 <input type="text" class="form-control" value="<?= (isset($data_kary->tmp_lahir) ? $data_kary->tmp_lahir : '-') . ", " . ($data_kary->tgl_lahir == "1970-01-01" ? '' : date('d-M-Y', strtotime($data_kary->tgl_lahir))) ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. KK</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->no_kk) ? $data_kary->no_kk : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. BPJS Tenaga Kerja</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->no_bpjstk) ?  $data_kary->no_bpjstk : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. BPJS Kesehatan</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->no_bpjskes) ?  $data_kary->no_bpjstk : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. NPWP</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->no_npwp) ? $data_kary->no_npwp : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="tab-pane fade" id="v-pills-dtKaryawan" role="tabpanel" aria-labelledby="v-pills-dtKaryawan-tab">
                                                  <div class="card-body row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Nama Perusahaan</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->nama_perusahaan) ? $data_kary->nama_perusahaan : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>NIK</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->no_nik) ? $data_kary->no_nik : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Departemen</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->depart) ? $data_kary->depart : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Posisi</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->posisi) ? $data_kary->posisi : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Klasifikasi</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->klasifikasi) ? $data_kary->klasifikasi : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-2 col-md-2 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Tipe</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->tipe) ? $data_kary->tipe : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Level</h6>
                                                                 <input type="text" class="form-control" value="<?= (isset($data_kary->level) ? $data_kary->level : '-') ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Point of Hire</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->poh) ? $data_kary->poh : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Lokasi Penerimaan</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->lokterima) ? $data_kary->lokterima : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Lokasi Kerja</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->lokker) ? $data_kary->lokker : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Email Perusahaan</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->email_kantor) ? $data_kary->email_kantor : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Date of Hire</h6>
                                                                 <input type="text" class="form-control" value="<?= date('d-M-Y', strtotime($data_kary->doh)) ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Tgl. Aktif</h6>
                                                                 <input type="text" class="form-control" value="<?= date('d-M-Y', strtotime($data_kary->tgl_aktif)) ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Status Residence</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kary->stat_tinggal) ? ($data_kary->stat_tinggal == "R" ? "Residence" : "Non Residence") : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Status Karyawan</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_kontrak->stat_perjanjian) ? $data_kontrak->stat_perjanjian : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <?php if ($data_kontrak->stat_waktu == "T") { ?>
                                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                                 <div class="form-group">
                                                                      <h6>Tanggal Awal</h6>
                                                                      <input type="text" class="form-control" value="<?= date('d-M-Y', strtotime($data_kontrak->tgl_mulai)) ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                                 </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                                 <div class="form-group">
                                                                      <h6>Tanggal Akhir</h6>
                                                                      <input type="text" class="form-control" value="<?= date('d-M-Y', strtotime($data_kontrak->tgl_akhir)) ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                                 </div>
                                                            </div>
                                                       <?php } else { ?>
                                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                                 <div class="form-group">
                                                                      <h6>Tanggal <?php echo $data_kontrak->stat_perjanjian ?></h6>
                                                                      <input type="text" class="form-control" value="<?= date('d-M-Y', strtotime($data_kontrak->tgl_mulai)) ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                                 </div>
                                                            </div>
                                                       <?php }  ?>
                                                  </div>
                                             </div>
                                             <div class="tab-pane fade" id="v-pills-dtSIMPER" role="tabpanel" aria-labelledby="v-pills-dtSIMPER-tab">
                                                  <div class="card-body row">
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Jenis Izin</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_izin->jenis_izin) ? $data_izin->jenis_izin : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. Registrasi</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_izin->no_reg) ? $data_izin->no_reg : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-2 col-md-2 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Tgl. Akhir</h6>
                                                                 <input type="text" class="form-control" value="<?= isset($data_izin->tgl_expired) ? date('d-M-Y', strtotime($data_izin->tgl_expired)) : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>

                                                       <?php if (isset($data_izin->jenis_izin_tambang) == "SP") { ?>
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                 <div class="form-group">
                                                                      <h6>Jenis SIM</h6>
                                                                      <input type="text" class="form-control" value="<?= isset($data_izin->sim) ? $data_izin->sim : '-' ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                                 </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-sm-12">
                                                                 <div class="form-group">
                                                                      <h6>Tgl. Expired SIM</h6>
                                                                      <input type="text" class="form-control" value="<?= date('d-M-Y', strtotime($data_izin->tgl_exp_sim)) ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                                 </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                 <div class="form-group">
                                                                      <h6>Unit yang diizinkan</h6>
                                                                      <table id="tbmUnitDetail" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                                           <thead>
                                                                                <tr>
                                                                                     <th style="text-align:center;width: 1%;">NO.</th>
                                                                                     <th style="width: 80%;">UNIT</th>
                                                                                     <th style="width: 19%;">AKSES</th>
                                                                                </tr>
                                                                           </thead>
                                                                           <tbody>
                                                                                <?php
                                                                                $no = 1;
                                                                                if (!empty($data_unit)) {
                                                                                     foreach ($data_unit as $list) {
                                                                                          echo '<tr>';
                                                                                          echo '<td class="align-middle" style="text-align:center;width: 1%;">' . $no++ . '</td>';
                                                                                          echo '<td class="align-middle" style="width: 80%;">' . $list->unit . '</td>';
                                                                                          echo '<td class="align-middle" style="width: 19%;">' . $list->tipe_akses_unit . '</td>';
                                                                                          echo '</tr>';
                                                                                     }
                                                                                } else {
                                                                                     echo '<tr>';
                                                                                     echo '<td colspan=3 class=" align-middle text-center">Data tidak ada</td>';
                                                                                     echo '</tr>';
                                                                                }
                                                                                ?>
                                                                           </tbody>
                                                                      </table>
                                                                 </div>
                                                            </div>
                                                       <?php } ?>
                                                  </div>
                                             </div>
                                             <div class="tab-pane fade" id="v-pills-dtSertifikasi" role="tabpanel" aria-labelledby="v-pills-dtSertifikasi-tab">
                                                  <div class="card-body row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <table id="tbmSertifikasiDetail" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                                      <thead>
                                                                           <tr>
                                                                                <th style="text-align:center;width: 1%;">NO.</th>
                                                                                <th style="width: 55%;">JENIS SERTIFIKASI</th>
                                                                                <th style="width: 19%;">NO. SERTIFIKASI</th>
                                                                                <th style="width: 10%;">TGL. SERTIFIKASI</th>
                                                                                <th style="width: 10%;">TGL. EXPIRED</th>
                                                                                <th style="width: 5%;">PROSES</th>
                                                                           </tr>
                                                                      </thead>
                                                                      <tbody>
                                                                           <?php
                                                                           $no = 1;
                                                                           if (!empty($data_sertifikasi)) {
                                                                                foreach ($data_sertifikasi as $list) {
                                                                                     echo '<tr>';
                                                                                     echo '<td class="align-middle" style="text-align:center;width: 1%;">' . $no++ . '</td>';
                                                                                     echo '<td class="align-middle" style="width: 60%;">' . $list->jenis_sertifikasi . '</td>';
                                                                                     echo '<td class="align-middle" style="width: 19%;">' . $list->no_sertifikasi . '</td>';
                                                                                     echo '<td class="align-middle" style="width: 10%;">' . date('d-M-Y', strtotime($list->tgl_sertifikasi)) . '</td>';
                                                                                     echo '<td class="align-middle" style="width: 10%;">' . date('d-M-Y', strtotime($list->tgl_berakhir_sertifikasi)) . '</td>';
                                                                                     echo '<td style="text-align:center;">';
                                                                                     if ($list->file_sertifikasi != "") {
                                                                                          echo '<a href ="' . base_url('karyawan/sertifikat/') . $list->auth_sertifikat . '" target="-blank" class="btn btn-primary btn-sm" title="Tampilkan Sertifikasi"><i class="far fa-file-pdf"></i></a>';
                                                                                     } else {
                                                                                          echo '<a class="btn btn-danger btn-sm" title="File sertifikasi tidak ada"><i class="fas fa-ban"></i></a>';
                                                                                     }
                                                                                     echo '</td>';
                                                                                     echo '</tr>';
                                                                                }
                                                                           } else {
                                                                                echo '<tr>';
                                                                                echo '<td colspan=6 class=" align-middle text-center">Data tidak ada</td>';
                                                                                echo '</tr>';
                                                                           }
                                                                           ?>
                                                                      </tbody>
                                                                 </table>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="tab-pane fade" id="v-pills-dtMCU" role="tabpanel" aria-labelledby="v-pills-dtMCU-tab">
                                                  <div class="card-body row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <table id="tbmSertifikasiDetail" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                                 <thead>
                                                                      <tr>
                                                                           <th style="text-align:center;width: 1%;">NO.</th>
                                                                           <th style="width: 15%;">TGL. MCU</th>
                                                                           <th style="width: 25%;">HASIL MCU</th>
                                                                           <th style="width: 59%;">KETERANGAN</th>
                                                                           <th style="width: 59%;">PROSES</th>
                                                                      </tr>
                                                                 </thead>
                                                                 <tbody>

                                                                      <?php
                                                                      $no = 1;
                                                                      if (!empty($data_mcu)) {
                                                                           foreach ($data_mcu as $list) {
                                                                                echo '<tr>';
                                                                                echo '<td class="align-middle" style="text-align:center;width: 1%;">' . $no++ . '</td>';
                                                                                echo '<td class="align-middle" style="width: 15%;">' .  date('d-M-Y', strtotime($list->tgl_mcu)) . '</td>';
                                                                                echo '<td class="align-middle" style="width: 25%;">' . $list->mcu_jenis . '</td>';
                                                                                echo '<td class="align-middle" style="width: 54%;">' . $list->ket_mcu . '</td>';
                                                                                echo '<td style="text-align:center;">';

                                                                                if ($list->url_file != "") {
                                                                                     echo '<a href ="' . base_url('karyawan/mcu/') . $list->auth_mcu . '" target="-blank" class="btn btn-primary btn-sm" title="Tampilkan Hasil MCU"><i class="far fa-file-pdf"></i></a>';
                                                                                } else {
                                                                                     echo '<a class="btn btn-danger btn-sm" title="File MCU tidak ada"><i class="fas fa-ban"></i></a>';
                                                                                }
                                                                                echo '</td>';
                                                                                echo '</tr>';
                                                                           }
                                                                      } else {
                                                                           echo '<tr>';
                                                                           echo '<td colspan=4 class=" align-middle text-center">Data tidak ada</td>';
                                                                           echo '</tr>';
                                                                      }
                                                                      ?>
                                                                 </tbody>
                                                            </table>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="tab-pane fade" id="v-pills-dtVaksin" role="tabpanel" aria-labelledby="v-pills-dtVaksin-tab">
                                                  <div class="card-body row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <table id="tbmSertifikasiDetail" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                                 <thead>
                                                                      <tr>
                                                                           <th style="text-align:center;width: 1%;">NO.</th>
                                                                           <th style="width: 30%;">VAKSIN</th>
                                                                           <th style="width: 39%;">NAMA VAKSIN</th>
                                                                           <th style="width: 30%;">TGL. VAKSIN</th>
                                                                      </tr>
                                                                 </thead>
                                                                 <tbody>

                                                                      <?php
                                                                      $no = 1;
                                                                      if (!empty($data_vaksin)) {
                                                                           foreach ($data_vaksin as $list) {
                                                                                echo '<tr>';
                                                                                echo '<td class="align-middle" style="text-align:center;width: 1%;">' . $no++ . '</td>';
                                                                                echo '<td class="align-middle" style="width: 30%;">' . $list->vaksin_jenis . '</td>';
                                                                                echo '<td class="align-middle" style="width: 39%;">' . $list->vaksin_nama . '</td>';
                                                                                echo '<td class="align-middle" style="width: 30%;">' . date('d-M-Y', strtotime($list->tgl_vaksin)) . '</td>';
                                                                                echo '</tr>';
                                                                           }
                                                                      } else {
                                                                           echo '<tr>';
                                                                           echo '<td colspan=4 class=" align-middle text-center">Data tidak ada</td>';
                                                                           echo '</tr>';
                                                                      }
                                                                      ?>
                                                                 </tbody>
                                                            </table>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="tab-pane fade" id="v-pills-dtFilePendukung" role="tabpanel" aria-labelledby="v-pills-dtFilePendukung-tab">
                                                  <div class="card-body row">
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>No. KTP</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->no_ktp ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>Nama Lengkap</h6>
                                                                 <input type="text" class="form-control" value="<?= $data_kary->nama_lengkap ?>" style="background-color:transparent;margin-top:-10px;" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <h6>File Pendukung</h6>
                                                                 <?php

                                                                 if ($data_kary->url_pendukung != "") {
                                                                      echo '<a href ="' . base_url('karyawan/support/') . $data_kary->auth_personal . '" target="_blank" class="btn btn-primary">Tampilkan File Pendukung</a>';
                                                                 } else {
                                                                      echo '<a target="_blank" class="btn btn-danger">File Tidak Ada</a>';
                                                                 }

                                                                 ?>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <!-- <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                        <a id="btnCetak" name="btnCetak" class="btn btn-primary font-weight-bold text-white">Cetak</a>
                                        <a href="#!" id="btnSelesai" name="btnSelesai" class="btn btn-warning ml-1 font-weight-bold text-white">Selesai</a>
                                   </div> -->
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