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
<div class="modal fade" id="uploaddepartmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:60%;">
          <div class="modal-content">
               <div class="modal-header bg-c-green">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Upload depart</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div id="upload_err" class="alert alert-danger animate__animated animate__bounce" role="alert" style="display:none;"></div>
                              <div class="row">
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="week">Week :</label><br>
                                        <select id='week' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                             <?php

                                             $n = 1;
                                             for ($n = 1; $n < 61; $n++) {
                                                  echo "<option value='" . $n . "'>" . $n . "</option>";
                                             }

                                             ?>
                                        </select><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="tahun">Tahun :</label><br>
                                        <select id='tahun' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                             <?php

                                             $n = 2010;
                                             for ($th = 2010; $th < 2101; $th++) {
                                                  echo "<option value='" . $th . "'>" . $th . "</option>";
                                             }

                                             ?>
                                        </select><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="namaLink">Nama Link :</label><br>
                                        <input id='namaLink' name='namaLink' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                        <small id="error1" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="namaLabel">Nama Label :</label><br>
                                        <input id='namaLabel' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                        <small id="error3" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="fileUpload">Pilih File depart / Scene.js :</label><br>
                                        <input type="file" class="form-control-file" id="fileUpload" required>
                                        <small id="error4" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" name="btnUploadFile" id="btnUploadFile" class="btn font-weight-bold btn-primary">Upload</button>
                                        <button type="button" name="btnBatalUploadFile" id="btnBatalUploadFile" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="modal fade" id="buatusermdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:60%;">
          <div class="modal-content">
               <div class="modal-header bg-c-yellow">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Buat User</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div id="user_err" class="alert alert-primary animate__animated animate__bounce" role="alert"></div>
                              <div class="row">
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="namaUser">Nama User :</label><br>
                                        <input id='namaUser' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                        <small id="error1u" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="emailUser">Email :</label><br>
                                        <input id='emailUser' type="email" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                        <small id="error2u" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="menuaksesUser">Menu Akses :</label><br>
                                        <select id='menuaksesUser' class="form-control form-control-user" required>
                                             <option value="">-- Pilih Akses Menu --</option>
                                             <option value="1">Admin</option>
                                             <option value="2">Supervisor</option>
                                             <option value="3">Superintendent</option>
                                             <option value="4">Manager</option>
                                             <option value="5">Direktur</option>
                                        </select>
                                        <small id="error3u" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="tglaktifUser">Tanggal Aktif :</label><br>
                                        <input id='tglaktifUser' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                        <small id="error4u" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="tglexpUser">Tanggal Expired :</label><br>
                                        <input id='tglexpUser' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                        <small id="error5u" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="sandiUser">Sandi :</label><br>
                                        <input id='sandiUser' type="password" autocomplete="off" spellcheck="false" placeholder="Minimal 6 karakter" class="form-control form-control-user" value="" required>
                                        <small id="error6u" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="ulangSandiUser">Konfirmasi Ulang Sandi :</label><br>
                                        <input id='ulangSandiUser' type="password" autocomplete="off" spellcheck="false" placeholder="Minimal 6 karakter" class="form-control form-control-user" value="" required>
                                        <small id="error7u" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" name="btnbuatUser" id="btnbuatUser" class="btn font-weight-bold btn-primary">Buat User</button>
                                        <button type="button" name="btnBatalBuatUser" id="btnBatalBuatUser" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="modal fade" id="gantisandimdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:60%;">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title text-black" id="exampleModalLabel">Ganti Sandi</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div id="gantisandi_err" class="alert alert-danger animate__animated animate__bounce" role="alert" style="display:none;"></div>
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="sandiLama">Sandi lama :</label><br>
                                        <input id='sandiLama' type="password" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                        <small id="error1s" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="sandiBaru">Sandi Baru :</label><br>
                                        <input id='sandiBaru' type="password" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                        <small id="error2s" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="ulangSandibaru">Konfirmasi Sandi Baru :</label><br>
                                        <input id='ulangSandibaru' type="password" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="" required>
                                        <small id="error3s" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" name="btngantiSandi" id="btngantiSandi" class="btn font-weight-bold btn-primary">Ganti Sandi</button>
                                        <button type="button" name="btnBatalGantiSandi" id="btnBatalGantiSandi" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="detaildepartmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Departemen</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailDepartPerusahaan">Perusahaan :</label><br>
                                        <input id='detailDepartPerusahaan' name='detailDepartPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly>
                                        <small id="error1" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailDepartKode">Kode :</label><br>
                                        <input id='detailDepartKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly>
                                        <small id="error3" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailDepart">Departemen :</label><br>
                                        <input id='detailDepart' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly>
                                        <small id="error2" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailDepartKet">Keterangan :</label><br>
                                        <textarea id='detailDepartKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea>
                                        <small id="error3" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailDepartStatus">Status :</label><br>
                                        <input id='detailDepartStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly>
                                        <small id="error2" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailDepartBuat">Pembuat :</label><br>
                                        <input id='detailDepartBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly>
                                        <small id="error2" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailDepartTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailDepartTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly>
                                        <small id="error2" class="text-danger font-italic font-weight-bold"></small><br>
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
<div class="modal fade" id="editdepartmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Departemen</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_dprt animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="editDepartKode">Kode :</label><br>
                                        <input id='editDepartKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error1ed" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-8 col-sm-12">
                                        <label for="editDepart">Departemen :</label><br>
                                        <input id='editDepart' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2ed" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="editDepartStatus">Status :</label><br>
                                        <select id='editDepartStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error3ed" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editDepartKet">Keterangan :</label><br>
                                        <textarea id='editDepartKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdatedepart" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="detailSectionmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Section</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailSectionPerusahaan">Perusahaan :</label><br>
                                        <input id='detailSectionPerusahaan' name='detailSectionPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailSectionDepart">Departemen :</label><br>
                                        <input id='detailSectionDepart' name='detailSectionDepart' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailSectionKode">Kode :</label><br>
                                        <input id='detailSectionKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailSection">Section :</label><br>
                                        <input id='detailSection' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailSectionKet">Keterangan :</label><br>
                                        <textarea id='detailSectionKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailSectionStatus">Status :</label><br>
                                        <input id='detailSectionStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailSectionBuat">Pembuat :</label><br>
                                        <input id='detailSectionBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailSectionTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailSectionTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editSectionmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Section</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_sec animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-129 col-md-12 col-sm-12">
                                        <label for="editSectionDepart">Departemen :</label><br>
                                        <select id='editSectionDepart' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user">
                                             <option value="">-- Departemen tidak ditemukan --</option>
                                        </select>
                                        <small id="error3es" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editSectionKode">Kode :</label><br>
                                        <input id='editSectionKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small id="error1es" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editSection">Section :</label><br>
                                        <input id='editSection' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small id="error2es" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editSectionStatus">Status :</label><br>
                                        <select id='editSectionStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error4es" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editSectionKet">Keterangan :</label><br>
                                        <textarea id='editSectionKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea>
                                        <small id="error5es" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateSection" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="detailPosisimdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Posisi</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailPosisiPerusahaan">Perusahaan :</label><br>
                                        <input id='detailPosisiPerusahaan' name='detailPosisiPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailPosisiDepart">Departemen :</label><br>
                                        <input id='detailPosisiDepart' name='detailPosisiDepart' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailPosisiKode">Kode :</label><br>
                                        <input id='detailPosisiKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailPosisi">Posisi :</label><br>
                                        <input id='detailPosisi' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailPosisiKet">Keterangan :</label><br>
                                        <textarea id='detailPosisiKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailPosisiStatus">Status :</label><br>
                                        <input id='detailPosisiStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailPosisiBuat">Pembuat :</label><br>
                                        <input id='detailPosisiBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailPosisiTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailPosisiTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editPosisimdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Posisi</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_posisi animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editPosisiDepart">Departemen :</label><br>
                                        <select id='editPosisiDepart' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white">
                                             <option value="">-- Departemen tidak ditemukan --</option>
                                        </select>
                                        <small id="error3ep" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editPosisi">Posisi :</label><br>
                                        <input id='editPosisi' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2ep" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editPosisiStatus">Status :</label><br>
                                        <select id='editPosisiStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error4ep" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editPosisiKet">Keterangan :</label><br>
                                        <textarea id='editPosisiKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                        <small id="error5ep" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdatePosisi" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="detailLevelmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Level</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailLevelPerusahaan">Perusahaan :</label><br>
                                        <input id='detailLevelPerusahaan' name='detailLevelPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailLevelKode">Kode :</label><br>
                                        <input id='detailLevelKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailLevel">Level :</label><br>
                                        <input id='detailLevel' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailLevelKet">Keterangan :</label><br>
                                        <textarea id='detailLevelKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailLevelStatus">Status :</label><br>
                                        <input id='detailLevelStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailLevelBuat">Pembuat :</label><br>
                                        <input id='detailLevelBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailLevelTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailLevelTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editLevelmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Level</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_Level animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editLevelKode">Kode :</label><br>
                                        <input id='editLevelKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error1el" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editLevel">Level :</label><br>
                                        <input id='editLevel' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2el" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editLevelStatus">Status :</label><br>
                                        <select id='editLevelStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error3el" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editLevelKet">Keterangan :</label><br>
                                        <textarea id='editLevelKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                        <small id="error4el" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateLevel" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="detailGrademdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Grade</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailGradePerusahaan">Perusahaan :</label><br>
                                        <input id='detailGradePerusahaan' name='detailGradePerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="detailGradeKode">Kode :</label><br>
                                        <input id='detailGradeKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-1 col-md-1 col-sm-12">
                                        <label for="detailGrade">Grade :</label><br>
                                        <input id='detailGrade' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-8 col-md-8 col-sm-12">
                                        <label for="detailGradeLevel">Level :</label><br>
                                        <input id='detailGradeLevel' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailGradeKet">Keterangan :</label><br>
                                        <textarea id='detailGradeKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailGradeStatus">Status :</label><br>
                                        <input id='detailGradeStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailGradeBuat">Pembuat :</label><br>
                                        <input id='detailGradeBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailGradeTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailGradeTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editGrademdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Grade</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_grade animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editGradeLevel">Level :</label><br>
                                        <select id='editGradeLevel' class="form-control form-control-user">
                                             <option value="">-- Pilih Level --</option>
                                        </select>
                                        <small id="error3eg" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-2 col-md-2 col-sm-12">
                                        <label for="editGrade">Grade :</label><br>
                                        <input id='editGrade' placeholder="Isi dengan angka" type="number" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small id="error2eg" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editGradeStatus">Status :</label><br>
                                        <select id='editGradeStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error4eg" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editGradeKet">Keterangan :</label><br>
                                        <textarea id='editGradeKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea>
                                        <small id="error5eg" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateGrade" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="detailTipemdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Tipe</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailTipePerusahaan">Perusahaan :</label><br>
                                        <input id='detailTipePerusahaan' name='detailTipePerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailTipeKode">Kode :</label><br>
                                        <input id='detailTipeKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailTipe">Tipe :</label><br>
                                        <input id='detailTipe' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailTipeKet">Keterangan :</label><br>
                                        <textarea id='detailTipeKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailTipeStatus">Status :</label><br>
                                        <input id='detailTipeStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailTipeBuat">Pembuat :</label><br>
                                        <input id='detailTipeBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailTipeTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailTipeTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editTipemdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Tipe</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_tipe animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editTipeKode">Kode :</label><br>
                                        <input id='editTipeKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error1et" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editTipe">Tipe :</label><br>
                                        <input id='editTipe' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2et" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editTipeStatus">Status :</label><br>
                                        <select id='editTipeStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error3et" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editTipeKet">Keterangan :</label><br>
                                        <textarea id='editTipeKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                        <small id="error4et" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateTipe" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="detailStatJanjimdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Status Perjanjian</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailStatJanjiPerusahaan">Perusahaan :</label><br>
                                        <input id='detailStatJanjiPerusahaan' name='detailStatJanjiPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailStatJanjiKode">Kode :</label><br>
                                        <input id='detailStatJanjiKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailStatJanji">Status Perjanjian :</label><br>
                                        <input id='detailStatJanji' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailStatJanjiKet">Keterangan :</label><br>
                                        <textarea id='detailStatJanjiKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailStatJanjiStatus">Status :</label><br>
                                        <input id='detailStatJanjiStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailStatJanjiBuat">Pembuat :</label><br>
                                        <input id='detailStatJanjiBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailStatJanjiTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailStatJanjiTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editStatJanjimdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Status Perjanjian</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_statjanji animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editStatJanjiKode">Kode :</label><br>
                                        <input id='editStatJanjiKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error1est" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editStatJanji">Status Perjanjian :</label><br>
                                        <input id='editStatJanji' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2est" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editStatJanjiStatus">Status :</label><br>
                                        <select id='editStatJanjiStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error3est" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editStatJanjiKet">Keterangan :</label><br>
                                        <textarea id='editStatJanjiKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                        <small id="error4est" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateStatJanji" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="detailBankmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Bank</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailBankKode">Kode :</label><br>
                                        <input id='detailBankKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailBank">Bank :</label><br>
                                        <input id='detailBank' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailBankKet">Keterangan :</label><br>
                                        <textarea id='detailBankKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailBankStatus">Status :</label><br>
                                        <input id='detailBankStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailBankBuat">Pembuat :</label><br>
                                        <input id='detailBankBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailBankTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailBankTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editBankmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Bank</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_bank animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label for="editBank">Bank :</label><br>
                                        <input id='editBank' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2ebk" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editBankStatus">Status :</label><br>
                                        <select id='editBankStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error3ebk" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editBankKet">Keterangan :</label><br>
                                        <textarea id='editBankKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                        <small id="error4ebk" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateBank" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="detailSanksimdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Sanksi</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="detailSanksiKode">Kode :</label><br>
                                        <input id='detailSanksiKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-7 col-md-7 col-sm-12">
                                        <label for="detailSanksi">Sanksi :</label><br>
                                        <input id='detailSanksi' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-2 col-md-2 col-sm-12">
                                        <label for="detailMasaBerlaku">Masa Berlaku :</label><br>
                                        <input id='detailMasaBerlaku' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly>
                                        <small id="error3esk" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailSanksiKet">Keterangan :</label><br>
                                        <textarea id='detailSanksiKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailSanksiStatus">Status :</label><br>
                                        <input id='detailSanksiStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailSanksiBuat">Pembuat :</label><br>
                                        <input id='detailSanksiBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailSanksiTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailSanksiTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editSanksimdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Sanksi</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_sanksi animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-2 col-md-3 col-sm-12">
                                        <label for="editSanksiKode">Kode :</label><br>
                                        <input id='editSanksiKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small id="error1esk" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-5 col-md-9 col-sm-12">
                                        <label for="editSanksi">Sanksi :</label><br>
                                        <input id='editSanksi' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small id="error2esk" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="editMasaBerlaku">Masa Berlaku <strong class='text-italic'>(Hari)</strong> :</label>
                                        <input id='editMasaBerlaku' type="number" placeholder="Isi dengan angka" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small id="error3esk" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-2 col-md-6 col-sm-12">
                                        <label for="editSanksiStatus">Status :</label><br>
                                        <select id='editSanksiStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error4esk" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editSanksiKet">Keterangan :</label><br>
                                        <textarea id='editSanksiKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea>
                                        <small id="error5esk" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateSanksi" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="detailRostermdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Roster</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailRosterPerusahaan">Perusahaan :</label><br>
                                        <input id='detailRosterPerusahaan' name='detailRosterPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailRosterKode">Kode :</label><br>
                                        <input id='detailRosterKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailRoster">Roster :</label><br>
                                        <input id='detailRoster' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailMasaOnsite">Masa Onsite :</label><br>
                                        <input id='detailMasaOnsite' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailMasaOffsite">Masa Offsite :</label><br>
                                        <input id='detailMasaOffsite' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailRosterKet">Keterangan :</label><br>
                                        <textarea id='detailRosterKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailRosterStatus">Status :</label><br>
                                        <input id='detailRosterStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailRosterBuat">Pembuat :</label><br>
                                        <input id='detailRosterBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailRosterTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailRosterTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editRostermdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Roster</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_Roster animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editRosterKode">Kode :</label><br>
                                        <input id='editRosterKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small id="error1ers" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label for="editRoster">Roster :</label><br>
                                        <input id='editRoster' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small id="error2ers" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="editMasaOnsite">Masa Onsite <strong>(Hari)</strong> :</label><br>
                                        <input id='editMasaOnsite' type="number" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small id="error3ers" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="editMasaOffsite">Masa Offsite <strong>(Hari)</strong> :</label><br>
                                        <input id='editMasaOffsite' type="number" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small id="error4ers" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="editRosterStatus">Status :</label><br>
                                        <select id='editRosterStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error5ers" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editRosterKet">Keterangan :</label><br>
                                        <textarea id='editRosterKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea>
                                        <small id="error6ers" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateRoster" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="detailLokkermdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Lokasi Kerja</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailLokkerKode">Kode :</label><br>
                                        <input id='detailLokkerKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailLokker">Lokasi Kerja :</label><br>
                                        <input id='detailLokker' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailLokkerKet">Keterangan :</label><br>
                                        <textarea id='detailLokkerKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailLokkerStatus">Status :</label><br>
                                        <input id='detailLokkerStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailLokkerBuat">Pembuat :</label><br>
                                        <input id='detailLokkerBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailLokkerTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailLokkerTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editLokkermdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Lokasi Kerja</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_lokker animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editLokkerKode">Kode :</label><br>
                                        <input id='editLokkerKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error1elkr" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editLokker">Lokasi Kerja :</label><br>
                                        <input id='editLokker' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2elkr" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editLokkerStatus">Status :</label><br>
                                        <select id='editLokkerStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error3elkr" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editLokkerKet">Keterangan :</label><br>
                                        <textarea id='editLokkerKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                        <small id="error4elkr" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateLokker" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
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
<div class="modal fade" id="detailPohmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail POint of Hire</h5>
               </div>
               1
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailPohKode">Kode :</label><br>
                                        <input id='detailPohKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailPoh">Point of Hire :</label><br>
                                        <input id='detailPoh' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailPohKet">Keterangan :</label><br>
                                        <textarea id='detailPohKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailPohStatus">Status :</label><br>
                                        <input id='detailPohStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailPohBuat">Pembuat :</label><br>
                                        <input id='detailPohBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailPohTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailPohTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editPohmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Point of Hire</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_poh animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editPohKode">Kode :</label><br>
                                        <input id='editPohKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error1epoh" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editPoh">Point of Hire :</label><br>
                                        <input id='editPoh' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2epoh" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editPohStatus">Status :</label><br>
                                        <select id='editPohStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error3epoh" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editPohKet">Keterangan :</label><br>
                                        <textarea id='editPohKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                        <small id="error4epoh" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdatePoh" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<script>
     $(document).ready(function() {


          // function IsEmail(email) {
          //      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          //      if (!regex.test(email)) {
          //           return false;
          //      } else {
          //           return true;
          //      }
          // }

          $("#btngantiSandi").click(function() {
               let sandilama = $('#sandiLama').val().trim();
               let sandibaru = $('#sandiBaru').val().trim();
               let ulangsandi = $("#ulangSandibaru").val().trim();
               let jmlsandi = $('#sandiBaru').val().length;

               if (sandilama == "") {
                    sandilama_err = "Isi sandi lama"
               } else {
                    sandilama_err = "";
               }

               if (sandibaru != "" && ulangsandi != "") {
                    if (jmlsandi < 6) {
                         sandibaru_err = "Sandi minimal 6 karakter";
                    } else {
                         if (sandibaru == ulangsandi) {
                              sandibaru_err = ""
                              ulangsandi_err = "";
                         } else {
                              ulangsandi_err = "Konfirmasi ulang sandi baru tidak sama";
                         }
                    }
               } else {
                    if (sandibaru == "") {
                         sandibaru_err = "Isi sandi baru"
                    } else {
                         sandibaru_err = "";
                    }

                    if (ulangsandi == "") {
                         ulangsandi_err = "Isi konfirmasi ulang sandi baru"
                    } else {
                         ulangsandi_err = "";
                    }

               }

               if (sandilama_err == "" && sandibaru_err == "" && ulangsandi_err == "") {
                    $.ajax({
                         type: "POST",
                         url: "<?= base_url('user/cek_sandi') ?>",
                         data: {
                              sesi: sandilama
                         },
                         success: function(data) {
                              data = JSON.parse(data)
                              if (data.statusCode == 200) {
                                   $.ajax({
                                        type: "POST",
                                        url: "<?= base_url('user/ganti_sandi') ?>",
                                        data: {
                                             sesi: sandibaru
                                        },
                                        success: function(data) {
                                             // alert(data);
                                             data = JSON.parse(data)
                                             if (data.statusCode == 200) {
                                                  $("#gantisandi_err").css("display", "block");
                                                  $("#gantisandi_err").removeClass("alert-danger");
                                                  $("#gantisandi_err").addClass("alert-primary");
                                                  $("#gantisandi_err").css("display", "block");
                                                  $("#gantisandi_err").html(data.pesan);
                                                  $("#error1s").html("");
                                                  $("#error2s").html("");
                                                  $("#error3s").html("");
                                                  $("#sandiLama").val("");
                                                  $("#sandiBaru").val("");
                                                  $("#ulangSandibaru").val("");
                                             } else {
                                                  $("#gantisandi_err").removeClass("alert-primary");
                                                  $("#gantisandi_err").addClass("alert-danger");
                                                  $("#gantisandi_err").css("display", "block");
                                                  $("#gantisandi_err").html(data.pesan);
                                             }


                                             $("#gantisandi_err").fadeTo(4000, 500).slideUp(500, function() {
                                                  $("#gantisandi_err").slideUp(500);
                                             });
                                        }
                                   });
                              } else {
                                   $("#gantisandi_err").removeClass("alert-primary");
                                   $("#gantisandi_err").addClass("alert-danger");
                                   $("#gantisandi_err").css("display", "block");
                                   $("#gantisandi_err").html(data.pesan);


                                   $("#gantisandi_err").fadeTo(4000, 500).slideUp(500, function() {
                                        $("#gantisandi_err").slideUp(500);
                                   });
                              }


                         }
                    });
               } else {
                    $("#error1s").html(sandilama_err);
                    $("#error2s").html(sandibaru_err);
                    $("#error3s").html(ulangsandi_err);
               }
          });

          // $("#btnupdateLink").click(function() {
          //      let namalink = $('#namaLinkEdit').val().trim();
          //      let namafolder = $('#namaFolderEdit').val().trim();
          //      let namalabel = $("#namaLabelEdit").val().trim();

          //      if (namalink == "") {
          //           namalink_err = "Isi nama link";
          //      } else {
          //           namalink_err = "";
          //      }

          //      if (namafolder == "") {
          //           namafolder_err = "Isi nama folder";
          //      } else {
          //           namafolder_err = "";
          //      }

          //      if (namalabel == "") {
          //           namalabel_err = "Isi nama label";
          //      } else {
          //           namalabel_err = "";
          //      }

          //      if (namafolder_err == "" && namalabel_err == "" && namalink_err == "") {
          //           $.ajax({
          //                type: "post",
          //                url: "<?= base_url('dash/update_link') ?>",
          //                data: {
          //                     namalink: namalink,
          //                     namafolder: namafolder,
          //                     namalabel: namalabel
          //                },
          //                success: function(data) {
          //                     var data = JSON.parse(data);
          //                     if (data.statusCode == 200) {
          //                          tbmSection.draw();
          //                          $("#error1em").html("");
          //                          $("#error2em").html("");
          //                          $("#error3em").html("");
          //                          $('#namaLinkEdit').val("");
          //                          $('#namaFolderEdit').val("");
          //                          $("#namaLabelEdit").val("");
          //                          $("#editdepartmdl").modal("hide");
          //                          $(".err_psn_depart").removeClass("alert-danger");
          //                          $(".err_psn_depart").addClass("alert-primary");
          //                          $(".err_psn_depart").css("display", "block");
          //                          $(".err_psn_depart").html(data.pesan);
          //                     } else {
          //                          $("#editdepart_err").removeClass("alert-primary");
          //                          $("#editdepart_err").addClass("alert-danger");
          //                          $("#editdepart_err").css("display", "block");
          //                          $("#editdepart_err").html(data.pesan);
          //                     }

          //                     $(".err_psn_depart").fadeTo(4000, 500).slideUp(500, function() {
          //                          $(".err_psn_depart").slideUp(500);
          //                     });

          //                     $("#editdepart_err").fadeTo(4000, 500).slideUp(500, function() {
          //                          $("#editdepart_err").slideUp(500);
          //                     });
          //                }
          //           });
          //      } else {
          //           $("#error1em").html(namalink_err);
          //           $("#error2em").html(namalabel_err);
          //           $("#error3em").html(namafolder_err);
          //      }

          // });
     });
</script>