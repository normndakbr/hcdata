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
<!-- MODAL TAMBAH UNIT SIMPER -->
<div class="modal fade" id="mdlunitsimper" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:50%;">
          <div class="modal-content">
               <div class="modal-header bg-c-yellow">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Unit SIMPER</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="alert errormdlsimper alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                              <div class="row p-2">
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="jenisUnitSimper">Unit :</label><br>
                                        <select id='jenisUnitSimper' class="form-control form-control-user" required>
                                             <option value="">-- WAJIB DIPILIH --</option>
                                        </select>
                                        <small class="errorjenisUnitSimper text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="tipeAksesUnit">Izin Akses Unit :</label><br>
                                        <select id='tipeAksesUnit' class="form-control form-control-user" required>
                                             <option value="">-- WAJIB DIPILIH --</option>
                                        </select>
                                        <small class="errortipeAksesUnit text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnsimpanunitsimper" id="btnsimpanunitsimper" class="btn font-weight-bold btn-primary">Simpan Data</button>
                    <button name="btnbatalunitsimper" id="btnbatalunitsimper" data-dismiss="modal" class="btn font-weight-bold btn-warning">Selesai</button>
               </div>
          </div>
     </div>
</div>
<!-- MODAL DETAIL IZIN KARYAWAN -->
<div class="modal fade" id="mdlDetailIzinKaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document" style="margin-left: auto; margin-right: auto;max-width:80%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-asterisk"></i><span id="jdlDetailStrPer"> DETAIL IZIN KARYAWAN</span></h5>
               </div>
               <div class="modal-body">
                    <div class="row mx-3">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert alert-danger errormsgdetper animate__animated animate__bounce d-none mb-3"></div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="kodeMperusahaan">Jenis Izin :</label>
                                   <h5 id="mainCon"><?= $data_izin->jenis_izin_tambang == 'MP' ? "Mine Permit" : "SIMPER" ?></h5>
                              </div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="kodeMperusahaan">Nomor Registrasi Izin :</label>
                                   <h5 id="subCon"><?= !$data_izin->no_reg ? "-" : $data_izin->no_reg ?></h5>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                              <hr>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <label for="" class="text-danger font-italic font-weight-bold">Rencana Keselamatan, Kesehatan Kerja dan Lingkungan (RK3L) :</label>
                              <div class="row">
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="NoRK3L">RK3L :</label>
                                             <h5 id="noRK3L">-</h5>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnCancelStrPer" id="btnCancelStrPer" data-dismiss="modal" class="btn font-weight-bold btn-danger">Tutup</button>
               </div>
          </div>
     </div>
</div>