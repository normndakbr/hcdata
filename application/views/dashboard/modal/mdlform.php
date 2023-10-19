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
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailStatJanji">Status Perjanjian :</label><br>
                                        <input id='detailStatJanji' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="jenisWaktu">Status Perjanjian :</label><br>
                                        <input id='jenisWaktu' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editStatJanji">Status Perjanjian :</label><br>
                                        <input id='editStatJanji' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2est" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editJenisWaktu">Jenis Waktu :</label><br>
                                        <select id='editJenisWaktu' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- PILIH JENIS WAKTU --</option>
                                             <option value="F">TANPA BATAS WAKTU</option>
                                             <option value="T">DENGAN BATAS WAKTU</option>
                                        </select>
                                        <small id="error1est" class="text-danger font-italic font-weight-bold"></small><br>
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
<div class="modal fade" id="detailSimmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail SIM</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailSim">SIM :</label><br>
                                        <input id='detailSim' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailSimKet">Keterangan :</label><br>
                                        <textarea id='detailSimKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailSimStatus">Status :</label><br>
                                        <input id='detailSimStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailSimBuat">Pembuat :</label><br>
                                        <input id='detailSimBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailSimTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailSimTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="detailUnitmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Unit</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="detailKodeUnit">Kode Unit :</label><br>
                                        <input id='detailKodeUnit' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-9 col-md-8 col-sm-12">
                                        <label for="detailUnit">Unit :</label><br>
                                        <input id='detailUnit' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailUnitKet">Keterangan :</label><br>
                                        <textarea id='detailUnitKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailUnitStatus">Status :</label><br>
                                        <input id='detailUnitStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="detailUnitBuat">Pembuat :</label><br>
                                        <input id='detailUnitBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailUnitTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailUnitTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
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
<div class="modal fade" id="editSimmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit SIM</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_sim animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label for="editSim">SIM :</label><br>
                                        <input id='editSim' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2esim" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="editSimStatus">Status :</label><br>
                                        <select id='editSimStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error3esim" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editSimKet">Keterangan :</label><br>
                                        <textarea id='editSimKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                        <small id="error4esim" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateSim" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="editUnitmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Unit</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert alert-danger err_psn_edit_unit animate__animated animate__bounce d-none"></div>
                              <div class="row">
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label for="editKodeUnit">Kode Unit :</label><br>
                                        <input id='editKodeUnit' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2eunt" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editUnit">Unit :</label><br>
                                        <input id='editUnit' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                        <small id="error2eunt" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-2 col-sm-12">
                                        <label for="editUnitStatus">Status :</label><br>
                                        <select id='editUnitStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error3eunt" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="editUnitKet">Keterangan :</label><br>
                                        <textarea id='editUnitKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value=""></textarea>
                                        <small id="error4eunt" class="text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                                        <button type="button" id="btnupdateUnit" class="btn font-weight-bold btn-primary">Update</button>
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