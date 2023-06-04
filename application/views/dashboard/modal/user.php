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
<div class="modal fade" id="detailUsermdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:80%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail User</h5>
                    <button type="button" class="close" title="Selesai" data-dismiss="modal" aria-label="Close">
                         <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailUserNama">Nama User :</label><br>
                                        <input id='detailUserNama' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailUserEmail">Email User :</label><br>
                                        <input id='detailUserEmail' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-104 col-md-4 col-sm-12">
                                        <label for="detailUserTglAktif">Tanggal Aktif : </label><br>
                                        <input id='detailUserTglAktif' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="detailUserTglExp">Tanggal Expired :</label><br>
                                        <input id='detailUserTglExp' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="detailUserAksesMenu">Akses Menu :</label><br>
                                        <input id='detailUserAksesMenu' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-2 col-md-3 col-sm-12">
                                        <label for="detailUserStatus">Status :</label><br>
                                        <input id='detailUserStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-3 col-sm-12">
                                        <label for="detailUserPembuat">Pembuat :</label><br>
                                        <input id='detailUserPembuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-2 col-md-3 col-sm-12">
                                        <label for="detailUserTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailUserTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-2 col-md-3 col-sm-12">
                                        <label for="detailUserTglEdit">Tanggal Edit :</label><br>
                                        <input id='detailUserTglEdit' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="editUsermdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:80%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="jdleditUser">Edit User</h5>
                    <button type="button" class="close" title="Selesai" data-dismiss="modal" aria-label="Close">
                         <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editUserNama">Nama User :</label>
                                        <input id='editUserNama' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user">
                                        <small class="error1eusr text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editUserEmail">Email User :</label>
                                        <input id='editUserEmail' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user">
                                        <small class="error2eusr text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-104 col-md-4 col-sm-12">
                                        <label for="editUserTglAktif">Tanggal Aktif : </label>
                                        <input id='editUserTglAktif' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user">
                                        <small class="error3eusr text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="editUserTglExp">Tanggal Expired :</label>
                                        <input id='editUserTglExp' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user">
                                        <small class="error4eusr text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="editUserAksesMenu">Akses Menu :</label><br>
                                        <select id='editUserAksesMenu' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user">
                                             <option value="">-- Pilih Akses Menu --</option>
                                             <option value="0">Admin</option>
                                             <option value="1">Supervisor</option>
                                        </select>
                                        <small class="error5eusr text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-2 col-md-3 col-sm-12">
                                        <label for="editUserStatus">Status :</label><br>
                                        <select id='editUserStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small class="error6eusr text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                              </div>
                         </div>
                         <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                              <button type="button" id="btnupdateUser" class="btn font-weight-bold btn-primary">Update</button>
                              <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>