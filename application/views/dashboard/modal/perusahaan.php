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
<div class="modal fade" id="detailPerusahaanmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:90%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Perusahaan</h5>
                    <button type="button" class="close" title="Selesai" data-dismiss="modal" aria-label="Close">
                         <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-2 col-md-4 col-sm-12">
                                        <label for="detailPerusahaanKode">Kode Perusahaan :</label><br>
                                        <input id='detailPerusahaanKode' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-10 col-md-8 col-sm-12">
                                        <label for="detailPerusahaan">Nama Perusahaan :</label><br>
                                        <input id='detailPerusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-10 col-md-9 col-sm-12">
                                        <label for="detailPerusahaanAlamat">Alamat : </label><br>
                                        <input id='detailPerusahaanAlamat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-2 col-md-3 col-sm-12">
                                        <label for="detailPerusahaanKodepos">Kodepos :</label><br>
                                        <input id='detailPerusahaanKodepos' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="detailPerusahaanKet">Keterangan :</label><br>
                                        <textarea id='detailPerusahaanKet' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                                   </div>
                                   <div class="col-lg-2 col-md-6 col-sm-12">
                                        <label for="detailPerusahaanStatus">Status :</label><br>
                                        <input id='detailPerusahaanStatus' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="detailPerusahaanBuat">Pembuat :</label><br>
                                        <input id='detailPerusahaanBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailPerusahaanTglBuat">Tanggal Buat :</label><br>
                                        <input id='detailPerusahaanTglBuat' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                                   <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="detailPerusahaanTglEdit">Tanggal Edit :</label><br>
                                        <input id='detailPerusahaanTglEdit' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" readonly><br>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="editPerusahaanmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:90%;">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="jdleditPerusahaan">Edit Perusahaan</h5>
                    <button type="button" class="close" title="Selesai" data-dismiss="modal" aria-label="Close">
                         <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="row">
                                   <div class="col-lg-2 col-md-4 col-sm-12">
                                        <div class="form-group fill">
                                             <label for="editPerusahaanKode" class="floating-label">Kode Perusahaan <span class="text-danger">*</span></label>
                                             <input id='editPerusahaanKode' type="text" autocomplete="off" placeholder="Kode Perusahaan" spellcheck="false" class="form-control" value="">
                                             <small id="error1eper" class="text-danger font-italic font-weight-bold"></small>
                                        </div>
                                   </div>
                                   <div class="col-lg-10 col-md-8 col-sm-12">
                                        <div class="form-group fill">
                                             <label for="editPerusahaan" class="floating-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                             <input id='editPerusahaan' type="text" autocomplete="off" placeholder="Nama Perusahaan" spellcheck="false" class="form-control" value="">
                                             <small id="error2eper" class="text-danger font-italic font-weight-bold"></small>
                                        </div>

                                   </div>
                                   <div class="col-lg-10 col-md-9 col-sm-12">
                                        <div class="form-group fill">
                                             <label for="editPerusahaanAlamat" class="floating-label">Alamat <span class="text-danger">*</span> </label>
                                             <input id='editPerusahaanAlamat' type="text" autocomplete="off" placeholder="Alamat Perusahaan" spellcheck="false" class="form-control" value="">
                                        </div>
                                        <small id="error3eper" class="text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editPerusahaanProv">Provinsi <span class="text-danger">*</span> </label><br>
                                        <div class="input-group">
                                             <select id='editPerusahaanProv' autocomplete="off" spellcheck="false" class="form-control form-control-user">
                                                  <option value="">-- PILIH PROVINSI --</option>
                                             </select>
                                        </div>
                                        <small id="error5eper" class="text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="editPerusahaanKab">Kabupaten <span class="text-danger">*</span> </label><br>
                                        <div class="input-group">
                                             <select id='editPerusahaanKab' type="text" autocomplete="off" spellcheck="false" class="form-control" value="">
                                                  <option value="">-- KABUPATEN TIDAK DITEMUKAN --</option>
                                             </select>
                                        </div>
                                        <small id="error6eper" class="text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label for="editPerusahaanKec">Kecamatan <span class="text-danger">*</span> </label><br>
                                        <div class="input-group">
                                             <select id='editPerusahaanKec' type="text" autocomplete="off" spellcheck="false" class="form-control" value="">
                                                  <option value="">-- KECAMATAN TIDAK DITEMUKAN --</option>
                                             </select>
                                        </div>
                                        <small id="error7eper" class="text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label for="editPerusahaanKel">Kelurahan <span class="text-danger">*</span></label><br>
                                        <div class="input-group">
                                             <select id='editPerusahaanKel' type="text" autocomplete="off" spellcheck="false" class="form-control" value="">
                                                  <option value="">-- KELURAHAN TIDAK DITEMUKAN --</option>
                                             </select>
                                        </div>
                                        <small id="error8eper" class="text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                        <label for="editPerusahaanKet" class="floating-label">Keterangan </label>
                                        <textarea id='editPerusahaanKet' type="text" autocomplete="off" spellcheck="false" class="form-control" value=""></textarea>
                                        <small id="error14eper" class="text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-2 col-md-6 col-sm-12 mt-3">
                                        <label for="editPerusahaanStatus">Status <span class="text-danger">*</span></label>
                                        <select id='editPerusahaanStatus' type="text" autocomplete="off" spellcheck="false" class="form-control" value="">
                                             <option value="">-- Pilih Status --</option>
                                             <option value="AKTIF">AKTIF</option>
                                             <option value="NONAKTIF">NONAKTIF</option>
                                        </select>
                                        <small id="error15eper" class="text-danger font-italic font-weight-bold"></small>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button type="button" id="btnupdatePerusahaan" class="btn font-weight-bold btn-primary">Update</button>
                                        <button type="button" data-dismiss="modal" class="btn font-weight-bold btn-danger">Batal</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>