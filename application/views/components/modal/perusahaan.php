<!-- Detail -->
<div class="modal fade" id="detailPerusahaanmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:90%;">
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
                                <input id='detailPerusahaanKode' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-10 col-md-8 col-sm-12">
                                <label for="detailPerusahaan">Nama Perusahaan :</label><br>
                                <input id='detailPerusahaan' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-10 col-md-9 col-sm-12">
                                <label for="detailPerusahaanAlamat">Alamat : </label><br>
                                <input id='detailPerusahaanAlamat' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-12">
                                <label for="detailPerusahaanKodepos">Kodepos :</label><br>
                                <input id='detailPerusahaanKodepos' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="detailPerusahaanKet">Keterangan :</label><br>
                                <textarea id='detailPerusahaanKet' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly></textarea><br>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <label for="detailPerusahaanStatus">Status :</label><br>
                                <input id='detailPerusahaanStatus' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="detailPerusahaanBuat">Pembuat :</label><br>
                                <input id='detailPerusahaanBuat' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="detailPerusahaanTglBuat">Tanggal Buat :</label><br>
                                <input id='detailPerusahaanTglBuat' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="detailPerusahaanTglEdit">Tanggal Edit :</label><br>
                                <input id='detailPerusahaanTglEdit' type="text" autocomplete="off" spellcheck="false"
                                    class="form-control form-control-user bg-white" value="" readonly><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Update/Edit -->
<div class="modal fade" id="editPerusahaanmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="jdleditPerusahaan">Edit Perusahaan</h5>
                <button type="button" class="close" title="Selesai" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="updatePerusahaan" method="post" data-parsley-validate>
                <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <div class="form-group fill">
                                        <label for="editPerusahaanKode" class="form-label">Kode
                                            Perusahaan <span class="text-danger">*</span></label>
                                        <input id='editPerusahaanKode' type="text" autocomplete="off"
                                            placeholder="Kode Perusahaan" data-parsley-kode-perusahaan-max-length="8"
                                            spellcheck="false" class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-8 col-sm-12">
                                    <div class="form-group fill">
                                        <label for="editPerusahaan" class="form-label">Nama Perusahaan
                                            <span class="text-danger">*</span></label>
                                        <input id='editPerusahaan' type="text" autocomplete="off"
                                            placeholder="Nama Perusahaan" spellcheck="false" class="form-control"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-12">
                                    <div class="form-group fill">
                                        <label for="editPerusahaanAlamat" class="form-label">Alamat <span
                                                class="text-danger">*</span> </label>
                                        <input id='editPerusahaanAlamat' type="text" autocomplete="off"
                                            placeholder="Alamat Perusahaan" spellcheck="false" class="form-control"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="editPerusahaanProv" class="form-label">Provinsi <span class="text-danger">*</span>
                                        </label><br>
                                        <div class="input-group">
                                            <select id='editPerusahaanProv' autocomplete="off" spellcheck="false"
                                                class="form-control form-control-user" required>
                                                <option value="">-- PILIH PROVINSI --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="editPerusahaanKab" class="form-label">Kabupaten <span class="text-danger">*</span>
                                        </label><br>
                                        <div class="input-group">
                                            <select id='editPerusahaanKab' type="text" autocomplete="off"
                                                spellcheck="false" class="form-control" value="" required>
                                                <option value="">-- KABUPATEN TIDAK DITEMUKAN --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="editPerusahaanKec" class="form-label">Kecamatan <span class="text-danger">*</span>
                                        </label><br>
                                        <div class="input-group">
                                            <select id='editPerusahaanKec' type="text" autocomplete="off"
                                                spellcheck="false" class="form-control" value="" required>
                                                <option value="">-- KECAMATAN TIDAK DITEMUKAN --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="editPerusahaanKel" class="form-label">Kelurahan <span
                                                class="text-danger">*</span></label><br>
                                        <div class="input-group">
                                            <select id='editPerusahaanKel' type="text" autocomplete="off"
                                                spellcheck="false" class="form-control" value="" required>
                                                <option value="">-- KELURAHAN TIDAK DITEMUKAN --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                    <label for="editPerusahaanKet" class="floating-label">Keterangan </label>
                                    <textarea id='editPerusahaanKet' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control" value=""></textarea>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 mt-3">
                                    <div class="form-group">
                                    <label for="editPerusahaanStatus" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select id='editPerusahaanStatus' type="text" autocomplete="off" spellcheck="false"
                                        class="form-control" value="" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="AKTIF">AKTIF</option>
                                        <option value="NONAKTIF">NONAKTIF</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button type="submit" class="btn font-weight-bold btn-primary">Update</button>
                                    <button type="button" data-dismiss="modal"
                                        class="btn font-weight-bold btn-danger">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>