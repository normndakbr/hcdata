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
                                        <a id="bc1" href="#">
                                             Pelanggaran
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Tabel Pelanggaran
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
                                   <div class="mb-2">
                                        <a href="<?= base_url('Pelanggaran'); ?>" class="btn btn-primary font-weight-bold">Refresh / Data</a>
                                        <a id="addbtn" href="<?= base_url('Pelanggaran/new'); ?>" class="btn btn-success font-weight-bold">Tambah Data</a>
                                   </div>
                                   <?= $this->session->flashdata('msg'); ?>
                                   <?= $this->session->unset_userdata('msg'); ?>
                              </div>
                              <div class="row">
                                   <?php

                                   if (!$this->session->csrf_token) {
                                        $this->session->csrf_token = hash("sha1", time());
                                   }

                                   ?>

                                   <input type="hidden" id="token" name="token" value="<?= $this->session->csrf_token ?>">
                                   <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
                                        <label for="perLanggarData">Pilih Perusahaan :</label><br>
                                        <select id='perLanggarData' name='perLanggarData' class="form-control form-control-user">
                                             <option value="">-- PILIH PERUSAHAAN --</option>
                                             <?= $permst . $perstr; ?>
                                        </select>
                                        <small class="error1 text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12">
                                        <div class="table-responsive">
                                             <table id="tbmLanggar" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                  <thead>
                                                       <tr class="font-weight-boldtext-white">
                                                            <th style="text-align:center;width:1%;">No.</th>
                                                            <th>NIK</th>
                                                            <th>Nama Karyawan</th>
                                                            <th>Departemen</th>
                                                            <th>Punishment</th>
                                                            <th>Tgl. Akhir Punish</th>
                                                            <th>Status</th>
                                                            <th style="text-align:center;">Perusahaan</th>
                                                            <th style="text-align:center;">Proses</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                  </tbody>
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