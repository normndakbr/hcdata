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
                                             Lokasi Penerimaan
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Tabel Lokasi Penerimaan
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
                              <h5>Lokasi Penerimaan</h5>
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
                                        <a href="<?= base_url('lokasipenerimaan'); ?>" class="btn btn-primary font-weight-bold"><i class="fas fa-sync-alt"></i> Refresh / Data</a>
                                        <a id="addbtn" href="<?= base_url('lokasipenerimaan/new'); ?>" class="btn btn-success font-weight-bold"><i class="fas fa-plus"></i> Tambah Data</a>
                                   </div>
                                   <div class="alert alert-danger err_psn_lokterima animate__animated animate__bounce d-none"></div>
                              </div>
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="perLokterimaData">Perusahaan :</label><br>
                                        <select id='perLokterimaData' name='perLokterimaData' class="form-control form-control-user">
                                             <option value="">-- Pilih Perusahaan --</option>
                                        </select>
                                        <small class="error1 text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12">
                                        <div class="table-responsive">
                                             <table id="tbmLokterima" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                  <thead>
                                                       <tr class="font-weight-boldtext-white">
                                                            <th style="text-align:center;width:1%;">No.</th>
                                                            <th>Kode</th>
                                                            <th>Lokasi Penerimaan</th>
                                                            <th style="text-align:center;">Status</th>
                                                            <th style="text-align:center;">Perusahaan</th>
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
<div class="modal fade" id="detailLokterimamdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Lokasi Penerimaan</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailLokterimaPerusahaan">Perusahaan :</label><br>
                                        <input id='detailLokterimaPerusahaan' name='detailLokterimaPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailLokterimaKode">Kode :</label><br>
                                        <input id='detailLokterimaKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailLokterima">Lokasi Penerimaan :</label><br>
                                        <input id='detailLokterima' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailLokterimaKet">Keterangan :</label><br>
                                        <textarea id='detailLokterimaKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailLokterimaStatus">Status :</label><br>
                                        <input id='detailLokterimaStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailLokterimaBuat">Pembuat :</label><br>
                                        <input id='detailLokterimaBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailLokterimaTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailLokterimaTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editLokterimamdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Lokasi Penerimaan</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_lokterima animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editLokterimaKode">Kode :</label><br>
                                        <input id='editLokterimaKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error1elkt" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editLokterima">Lokasi Penerimaan :</label><br>
                                        <input id='editLokterima' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2elkt" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editLokterimaStatus">Status :</label><br>
                                        <select id='editLokterimaStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error3elkt" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editLokterimaKet">Keterangan :</label><br>
                                        <textarea id='editLokterimaKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                        <small id="error4elkt" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateLokterima" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>