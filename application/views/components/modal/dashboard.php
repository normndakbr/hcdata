<!-- Detail Pelanggaran -->
<div class="modal fade" id="mdlDetLanggarAktif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i>
                    Data Pelanggaran Aktif</h5>
            </div>
            <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                        <label for="">Perusahaan :</label><br>
                        <select id='perDetLgrAktif' name='perDetLgrAktif' class="form-control">
                            <option value="0">-- SEMUA PERUSAHAAN --</option>
                            <?= $permst . $perstr; ?>
                        </select><br>
                    </div>

                    <div class="col-lg-12">
                        <div id="tbLanggarAktif" class="data"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end p-2" style="margin-top:10px;">
                <button type="button" id="btnSelesaiDetLanggar" id="btnSelesaiDetLanggar" data-dismiss="modal"
                    class="btn font-weight-bold btn-primary">Selesai</button>
            </div>
        </div>
    </div>
</div>
<!-- Detail Karyawan -->
<div class="modal fade" id="detailkarysum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"
        style="margin-left: auto; margin-right: auto;max-width:60%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-info-circle"></i>
                        Jumlah
                        Karyawan Per-perusahaan +
                        subcontractor, Tanggal : <span id="txtTglKryJdl"><?=date('d-M-Y')?></span> | Total :
                        <span id="txtjmlkall"></span> Orang
                    </h5>
                </div>
                <div class="dropdown">
                    <button type="button" data-toggle="dropdown" aria-expanded="false"
                        class="btn btn-sm btn-warning font-weight-bold"><i class="fas fa-ellipsis-h"></i></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#!" id="btnFilterDOH">Filter Per Tanggal</a>
                        <a class="dropdown-item" href="#!" id="btnResetFilter">Reset Filter</a>
                        <a class="dropdown-item" href="#!" id="btnExpData">Export Data</a>
                        <a class="dropdown-item" data-dismiss="modal" href="#!">Selesai</a>
                    </div>
                </div>
            </div>
            <div style=" background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col md-12 col-sm-12">
                        <div id="tbmJmlKryPrs" class="data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Filter Detail Karyawan by DOH -->
<div class="modal fade" id="filtertglkarysum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document"
        style="margin-left: auto; margin-right: auto;max-width:30%;">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-filter"></i>
                    Filter jumlah karyawan berdasarkan Date of Hire</h5>
            </div>
            <div style=" background-color:rgba(240,240,240,1);" class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                        <label for="txtTglAktifPRs">Date of Hire :</label><br>
                        <input type="date" id="txtTglAktifPRs" class="form-control" value="<?=date('Y-m-d');?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer p-3">
                <button type="button" class="btn btn-primary font-weight-bold" id="btnFilterJmlKary">Terapkan</button>
                <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal">Selesai</button>
            </div>
        </div>
    </div>
</div>