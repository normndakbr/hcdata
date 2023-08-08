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
                                             Non-Aktif Karyawan
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Tabel Non-Aktif Karyawan
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
                              <h5>Non-Aktif Karyawan</h5>
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
                                        <a href="<?= base_url('NonaktifKary'); ?>" class="btn btn-primary font-weight-bold"><i class="fas fa-sync-alt"></i> Refresh / Data</a>
                                        <a id="secadd" href="<?= base_url('NonaktifKary/new'); ?>" class="btn btn-success font-weight-bold"><i class="fas fa-plus"></i> Tambah Data</a>
                                   </div>
                                   <div class="alert alert-danger err_psn_nonaktifKary animate__animated animate__bounce d-none"></div>
                              </div>
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <label for="perNonaktifData">Pilih Perusahaan :</label><br>
                                        <select id='perNonaktifData' name='perNonaktif' class="form-control form-control-user">
                                             <option value="">-- PILIH PERUSAHAAN --</option>
                                             <?= $permst . $perstr; ?>
                                        </select>
                                        <small class="error1 text-danger font-italic font-weight-bold"></small><br>
                                   </div>

                                   <div class="col-lg-12">
                                        <div class="table-responsive">
                                             <table id="tbmNonaktif" class="table text-nowrap table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                  <thead>
                                                       <tr class="font-weight-boldtext-white">
                                                            <th style="text-align:center;width:1%;">No.</th>
                                                            <th style="width:15%;">No. KTP</th>
                                                            <th style="width:20%;">Nama</th>
                                                            <th style="width:20%;">Departemen</th>
                                                            <th style="width:9%;">Tgl. Nonaktif</th>
                                                            <th style="width:15%;">Alasan Nonatif</th>
                                                            <th style="text-align:center;width:10%;">Perusahaan</th>
                                                            <th style="text-align:center;width:10%;">Proses</th>
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
<div class="modal fade" id="detailnonaktifkary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:80%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Nonaktif Karyawan</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-8 col-md-8 col-sm-12">
                                        <label for="detailNonaktifPerusahaan">Perusahaan :</label><br>
                                        <input id='detailNonaktifPerusahaan' name='detailNonaktifPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="detailNonaktifDepart">No. KTP :</label><br>
                                        <input id='detailNonaktifDepart' name='detailNonaktifDepart' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-5 col-md-5 col-sm-12">
                                        <label for="detailNonaktifDepart">Nama Lengkap :</label><br>
                                        <input id='detailNonaktifDepart' name='detailNonaktifDepart' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-7 col-md-7 col-sm-12">
                                        <label for="detailNonaktifDepart">Departemen :</label><br>
                                        <input id='detailNonaktifDepart' name='detailNonaktifDepart' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="detailNonaktif">Tanggal Nonaktif :</label><br>
                                        <input id='detailNonaktif' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-8 col-md-6 col-sm-12">
                                        <label for="detailNonaktif">Alasan Nonaktif :</label><br>
                                        <input id='detailNonaktif' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailNonaktifKet">Keterangan :</label><br>
                                        <textarea id='detailNonaktifKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>

                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailNonaktifBuat">Pembuat :</label><br>
                                        <input id='detailNonaktifBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailNonaktifTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailNonaktifTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Selesai</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="editNonaktifmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Nonaktif</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_Nonaktif animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editNonaktifDepart">Departemen :</label><br>
                                        <select id='editNonaktifDepart' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white">
                                             <option value="">-- Departemen tidak ditemukan --</option>
                                        </select>
                                        <small id="error3ep" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-8 col-md-8 col-sm-12">
                                        <label for="editNonaktif">Nonaktif :</label><br>
                                        <input id='editNonaktif' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2ep" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="editNonaktifStatus">Status :</label><br>
                                        <select id='editNonaktifStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error4ep" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editNonaktifKet">Keterangan :</label><br>
                                        <textarea id='editNonaktifKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                        <small id="error5ep" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateNonaktif" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>