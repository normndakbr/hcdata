<div class="pcoded-main-container">
     <div class="pcoded-content">
          <div class="page-header">
               <div class="page-block">
                    <div class="row align-items-center">
                         <div class="col-md-12">
                              <div class="page-header-title">
                                   <h5 class="m-b-10">Data Utama</h5>
                              </div>
                              <ul class="breadcrumb">
                                   <li class="breadcrumb-item">
                                        <a href="<?= base_url('dash'); ?>">
                                             <i class="feather icon-home"></i>
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc1" href="#">
                                             Pengajuan SIMPER/MINE PERMIT
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Tabel Pengajuan SIMPER/MINE PERMIT
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
                              <h5>Pengajuan SIMPER/MINE PERMIT</h5>
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
                                   <div class="mb-2">
                                        <a href="<?= base_url('pengajuansm'); ?>" class="btn btn-primary font-weight-bold"><i class="fas fa-sync-alt"></i> Refresh / Data</a>
                                        <a href="<?= base_url('pengajuansm'); ?>" class="btn btn-primary font-weight-bold"><i class="fas fa-file-export"></i> Export Data</a>
                                        <a id="addbtnizin" href="<?= base_url('pengajuansm/new'); ?>" class="btn btn-success font-weight-bold"><i class="fas fa-plus"></i> Buat Pengajuan</a>
                                   </div>
                                   <div class="alert alert-danger err_pesan_izin animate__animated animate__bounce d-none"></div>
                              </div>
                              <div class="row">
                                   <?php

                                   if (!$this->session->csrf_token) {
                                        $this->session->csrf_token = hash("sha1", time());
                                   }

                                   ?>

                                   <input type="hidden" id="token" name="token" value="<?= $this->session->csrf_token ?>">
                                   <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
                                        <label for="perIzinData">Pilih Perusahaan :</label><br>
                                        <select id='perIzinData' name='perIzinData' class="form-control form-control-user">
                                             <option value="">-- PILIH PERUSAHAAN --</option>
                                             <?= $permst . $perstr; ?>
                                        </select>
                                        <small class="error1 text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-8 col-sm-12 ml-4 mb-3">
                                        <input type="checkbox" class="form-check-input" id="krycekNonaktif">
                                        <label for="krycekNonaktif" class="form-check-label">Tampilkan pengajuan dengan status Approved</label><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="table-responsive">
                                             <table id="tbmIzin" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                  <thead>
                                                       <tr class="font-weight-bold">
                                                            <th style="text-align:center;width:1%;">No.</th>
                                                            <th>Kode Pengajuan</th>
                                                            <th>Tgl. Pengajuan</th>
                                                            <th>Jenis Izin</th>
                                                            <th>Perusahaan</th>
                                                            <th style="text-align:center;">Status</th>
                                                            <th style="text-align:center;">Tgl. Dibuat</th>
                                                            <th style="text-align:center;">Proses</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody></tbody>
                                             </table>
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
<div class="modal fade" id="mdldetizindetail" tabindex="-1" role="dialog" aria-labelledby="jdlmdldetizindetail" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:85%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="jdlmdldetizindetail"><i class="fas fa-user-plus"></i> Data Karyawan</h5>
               </div>
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 mt-1">
                              <div class="alert err_list_kary_izin_add alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                              <table id="tbmKaryIzinDet" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                   <thead>
                                        <tr>
                                             <th>No.</th>
                                             <th>NIK</th>
                                             <th>Nama Karyawan</th>
                                             <th>Departemen</th>
                                             <th>Posisi</th>
                                             <th>DOH</th>
                                             <th>Proses Izin</th>
                                             <th>Proses</th>
                                        </tr>
                                   </thead>
                                   <tbody></tbody>
                              </table>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                              <label for="txtKetIzinAddDet">Keterangan :</label><br>
                              <textarea id='txtKetIzinAddDet' autocomplete="off" spellcheck="false" class="form-control" disabled></textarea>
                         </div>
                    </div>
                    <div class="modal-footer mt-3">
                         <button type="button" name="btnSelesaiIzinDet" id="btnSelesaiIzinDet" class="btn font-weight-bold btn-primary">Selesai</button>
                    </div>
               </div>
          </div>
     </div>
</div>