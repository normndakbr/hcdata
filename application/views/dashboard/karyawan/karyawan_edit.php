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
                                        <a href="#">
                                             Karyawan
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Edit Data Karyawan
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-xl-12 col-md-12" style="overflow-x:auto;">
                    <div id="addkry" class="card latest-update-card">
                         <div class="card-header align-items-center">
                              <h5>Edit Data Karyawan</h5>
                              <div class="card-header-right">
                                   <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                             <li class="dropdown-item full-card">
                                                  <a href="#!"><span><i class="feather icon-maximize"></i>
                                                            Fullscreen</span><span style="display: none"><i class="feather icon-minimize"></i> Restore</span></a>
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
                                        <button id="addbtn" class="btnrespage btn btn-warning font-weight-bold mb-3 d-none">Reset</button>
                                   </div>
                              </div>
                              <div class="alert alert-danger errormsg animate__animated animate__bounce d-none mb-2"></div>
                              <input id="editTglBuat" class="d-none" value="<?= $data_kary->tgl_buat ?>"></input>
                              <input id="editTglEdit" class="d-none" value="<?= date("Y-m-d H:i:s"); ?>"></input>
                              <input id="currentNoKTP" class="d-none" value=""></input>
                              <input id="currentNoKK" class="d-none" value=""></input>
                              <input id="idUser" class="d-none" value="<?= $this->session->userdata("id_menu") ?>"></input>
                              <input id="valueIDKaryawan" class="d-none" value="<?= $data_kary->id_kary ?>"></input>

                              <!-- Auth -->
                              <input id="valueAuthPersonal" class="d-none" value="<?= $data_kary->auth_personal ?>"></input>
                              <input id="valueAuthKaryawan" class="d-none" value="<?= $data_kary->auth_karyawan ?>"></input>
                              <input id="valueAuthPerusahaan" class="d-none" value="<?= $data_kary->auth_perusahaan ?>"></input>
                              <input id="valueAuthMasterPerusahaan" class="d-none" value="<?= $data_kary->auth_m_perusahaan ?>"></input>

                              <!-- Data Personal -->
                              <input id="editIdPersonal" class="d-none" value="<?= $data_kary->id_personal ?>"></input>
                              <input id="valueNoKTPOld" class="d-none" value="<?= $data_kary->no_ktp ?>"></input>
                              <input id="valueNoKKOld" class="d-none" value="<?= $data_kary->no_kk ?>"></input>
                              <input id="valueJenisKelamin" class="d-none" value="<?= $data_kary->jk ?>"></input>
                              <input id="valueWargaNegara" class="d-none" value="<?= $data_kary->warga_negara ?>"></input>
                              <input id="valueAgama" class="d-none" value="<?= $data_kary->id_agama ?>"></input>
                              <input id="valueStatNikah" class="d-none" value="<?= $data_kary->id_stat_nikah ?>"></input>
                              <input id="valueStatPendidikan" class="d-none" value="<?= $data_kary->id_pendidikan ?>"></input>

                              <!-- Data Alamat -->
                              <input id="valueIdAlamatKTP" class="d-none" value="<?= $data_alamat->id_alamat_ktp ?>"></input>
                              <input id="alamat_ktp" class="d-none" value="<?= $data_alamat->alamat_ktp ?>"></input>
                              <input id="valueProvinsi" class="d-none" value="<?= $data_alamat->prov_ktp ?>"></input>
                              <input id="valueKabupaten" class="d-none" value="<?= $data_alamat->kab_ktp ?>"></input>
                              <input id="valueKecamatan" class="d-none" value="<?= $data_alamat->kec_ktp ?>"></input>
                              <input id="valueKelurahan" class="d-none" value="<?= $data_alamat->kel_ktp ?>"></input>

                              <!-- Data Karyawan -->
                              <input id="valuePerusahaan" class="d-none" value="<?= $data_kary->auth_m_perusahaan ?>"></input>
                              <input id="valueDepart" class="d-none" value="<?= $data_kary->id_depart ?>"></input>
                              <input id="valuePosisi" class="d-none" value="<?= $data_kary->id_posisi ?>"></input>
                              <input id="valueKlasifikasi" class="d-none" value="<?= $data_kary->id_klasifikasi ?>"></input>
                              <input id="valueTipe" class="d-none" value="<?= $data_kary->id_tipe ?>"></input>
                              <input id="valueLevel" class="d-none" value="<?= $data_kary->id_level ?>"></input>
                              <input id="valuePOH" class="d-none" value="<?= $data_kary->id_poh ?>"></input>
                              <input id="valueLokterima" class="d-none" value="<?= $data_kary->id_lokterima ?>"></input>
                              <input id="valueLokker" class="d-none" value="<?= $data_kary->id_lokker ?>"></input>
                              <input id="valueStatTinggal" class="d-none" value="<?= $data_kary->stat_tinggal ?>"></input>
                              <input id="valueStatPerjanjian" class="d-none" value="<?= $data_kontrak->id_stat_perjanjian ?>"></input>
                              <input id="valueKontrakKary" class="d-none" value="<?= $data_kontrak->auth_kontrak_kary ?>"></input>

                              <!-- data SIMPER/Mine Permit -->
                              <input id="valueJenisIzinTambang" class="d-none" value="<?= !$data_izin->jenis_izin_tambang ? "" : $data_izin->jenis_izin_tambang ?>"></input>
                              <input id="valueNoRegIzin" class="d-none" value="<?= !$data_izin->no_reg ? "" : $data_izin->no_reg ?>"></input>
                              <input id="valueTglExpired" class="d-none" value="<?= !$data_izin->tgl_expired ? "" : $data_izin->tgl_expired ?>"></input>
                              <input id="valueIDSim" class="d-none" value="<?= !$data_izin->id_sim ? "" : $data_izin->id_sim ?>"></input>
                              <input id="valueSim" class="d-none" value="<?= !$data_izin->sim ? "" : $data_izin->sim ?>"></input>
                              <input id="valueTglExpiredSimKary" class="d-none" value="<?= !$data_sim_kary ? "" : $data_sim_kary->tgl_exp ?>"></input>

                              <div class="row pt-2">
                                   <?php

                                   if (!$this->session->csrf_token) {
                                        $this->session->csrf_token = hash("sha1", time());
                                   }
                                   ?>

                                   <input type="hidden" id="token" name="token" value="<?= $this->session->csrf_token ?>">

                                   <div id="clEditPersonal" class="col-md-12 col-sm-12 mb-2 clPersonal">
                                        <button id="clEditPersonal-click" class="btn btn-primary w-100" style="text-align:left;">
                                             <a class="text-white" data-toggle="collapse" href="#!" role="button" aria-expanded="false" aria-controls="colPersonal">
                                                  1. Data Personal
                                             </a>
                                             <img id="imgPersonal" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </button>
                                        <div class="collapse mt-2 show" id="colEditPersonal">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="alert alert-danger errPersonal animate__animated animate__bounce d-none"></div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editNoKTP"> No. KTP <span class="text-danger">*</span></label>
                                                                 <input id='editNoKTP' name='editNoKTP' type="text" autocomplete=" off" spellcheck="false" class="form-control" value="<?= $data_kary->no_ktp ?>" required>
                                                                 <small class="errorEditNoKTP text-danger font-italic font-weight-bold"></small>
                                                                 <span class="0c09efa8ccb5e0114e97df31736ce2e3 d-none"></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editNamaLengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                                                 <input id='editNamaLengkap' name='editNamaLengkap' autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->nama_lengkap ?>" required>
                                                                 <small class="errorEditNamaLengkap text-danger font-italic font-weight-bold"></small>
                                                                 <span class="9d56835ae6e4d20993874daf592f6aca d-none"></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editAlamatKTP">Alamat <span class="text-danger">*</span></label>
                                                                 <input id='editAlamatKTP' name='editAlamatKTP' type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_alamat->alamat_ktp ?>" required>
                                                                 <small class="errorEditAlamatKTP text-danger font-italic font-weight-bold"></small>
                                                                 <span class="150b3427b97bb43ac2fb3e5c687e384c d-none"></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-2 col-md-2 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editRtKTP">RT </label>
                                                                 <input id='editRtKTP' name='editRtKTP' type="number" placeholder="000" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_alamat->rt_ktp ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;">
                                                                 <small class="erroreditRtKTP text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-2 col-md-2 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editRwKTP">RW </label>
                                                                 <input id='editRwKTP' name='editRwKTP' type="number" placeholder="000" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_alamat->rw_ktp ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;">
                                                                 <small class="errorEditRwKTP text-danger font-italic font-weight-bold"></small>
                                                                 <span class="9100fd1e98da52ac823c5fdc6d3e4ff1 d-none"></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editProvData">Provinsi <span class="text-danger">*</span></label>
                                                                 <div id="txtEditProv" class="input-group">
                                                                      <select id='editProvData' name='editProvData' type="number" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                           <option value="">-- TIDAK ADA DATA --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditProv" name="refreshEditProv" class="btn btn-primary btn-sm" title="Refresh Provinsi"><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditProvData text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editKotaData">Kabupaten / Kota <span class="text-danger">*</span></label>
                                                                 <div id="txtEditKota" class="input-group">
                                                                      <select id='editKotaData' name='editKotaData' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                           <option value="">-- TIDAK ADA DATA --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditKota" name="refreshEditKota" class="btn btn-primary btn-sm" title="Refresh Kabupaten/Kota"><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditKotaData text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editKecData">Kecamatan <span class="text-danger">*</span></label>
                                                                 <div id="txtEditKec" class="input-group">
                                                                      <select id='editKecData' name='editKecData' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                           <option value="">-- TIDAK ADA DATA --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditKec" name="refreshEditKec" class="btn btn-primary btn-sm" title="Refresh Kecamatan"><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditKecData text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editKelData">Kelurahan <span class="text-danger">*</span></label>
                                                                 <div id="txtEditKel" class="input-group">
                                                                      <select id='editKelData' name='editKelData' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                           <option value="">-- TIDAK ADA DATA --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditKel" name="refreshEditKel" class="btn btn-primary btn-sm" title="Refresh Kelurahan"><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditKelData text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editKewarganegaraan">Warga Negara <span class="text-danger">*</span></label>
                                                                 <select id="editKewarganegaraan" class="mb-3 form-control">
                                                                      <option value="">-- PILIH WARGA NEGARA --</option>
                                                                      <option value="WNI">WNI</option>
                                                                      <option value="WNA">WNA</option>
                                                                 </select>
                                                                 <small class="errorEditKewarganegaraan text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editAgama">Agama <span class="text-danger">*</span></label>
                                                                 <select id="editAgama" class="mb-3 form-control">
                                                                      <option value="">-- WAJIB DIPILIH --</option>
                                                                 </select>
                                                                 <small class="errorEditAgama text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editJenisKelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                                                 <select id="editJenisKelamin" class="mb-3 form-control">
                                                                      <option value="">-- PILIH JENIS KELAMIN --</option>
                                                                      <option value="LK">LAKI - LAKI</option>
                                                                      <option value="P">PEREMPUAN</option>
                                                                 </select>
                                                                 <small class="errorEditJenisKelamin text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editStatPernikahan">Status Pernikahan <span class="text-danger">*</span></label>
                                                                 <div id="txtEditNikah" class="input-group">
                                                                      <select id="editStatPernikahan" class="form-control">
                                                                           <option value="">-- PILIH PERNIKAHAN --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditStatNikah" name="refreshStatNikah" class="btn btn-primary btn-sm" title="Refresh Status Pernikahan"><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditStatPernikahan text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editTempatLahir">Tempat Lahir <span class="text-danger">*</span></label>
                                                                 <input id='editTempatLahir' name='editTempatLahir' type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->tmp_lahir ?>" required>
                                                                 <small class="errorEditTempatLahir text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editTanggalLahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                                                 <input id='editTanggalLahir' name='editTanggalLahir' type="date" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->tgl_lahir ?>" required>
                                                                 <small class="errorEditTanggalLahir text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editNoBPJSTK">No. BPJS Tenaga Kerja </label>
                                                                 <input id='editNoBPJSTK' name='editNoBPJSTK' type="number" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->no_bpjstk ?>" required>
                                                                 <small class="errorEditNoBPJSTK text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editNoBPJSKES">No. BPJS Kesehatan </label>
                                                                 <input id='editNoBPJSKES' name='editNoBPJSKES' type="number" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->no_bpjskes ?>" required>
                                                                 <small class="erroreditNoBPJSKES text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editNoNPWP">No. NPWP </label>
                                                                 <input id='editNoNPWP' name='editNoNPWP' autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->no_npwp ?>" required>
                                                                 <small class="errorEditNoNPWP text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editNoKK">No. Kartu Keluarga <span class="text-danger">*</span></label>
                                                                 <input id='editNoKK' name='editNoKK' type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->no_kk ?>" required>
                                                                 <small class="errorEditNoKK text-danger font-italic font-weight-bold"></small>
                                                                 <span class="89kjm78ujki782m4x787909h3 d-none"></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editEmail">Email Pribadi </label>
                                                                 <input id='editEmail' name='editEmail' type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->email_pribadi ?>" required>
                                                                 <small class="errorEditEmail text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-7 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editNoTelp">No. Telp </label>
                                                                 <input id='editNoTelp' name='editNoTelp' type="number" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->hp_1 ?>" required>
                                                                 <small class="errorEditNoTelp text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-5 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editPendidikanTerakhir">Pendidikan Terakhir </label>
                                                                 <div id="txtEditDidik" name="txtEditDidik" class="input-group mt-2">
                                                                      <select id='editPendidikanTerakhir' name='editPendidikanTerakhir' type="text" autocomplete="off" spellcheck="false" class="custom-select" title="Refresh Pendidikan" required>
                                                                           <option value="">-- PILIH PENDIDIKAN --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditDidik" name="refreshDidik" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right mt-2">
                                                            <a id="editSimpanPersonal" data-scroll href="#clKaryawan" class="btn btn-primary font-weight-bold">Simpan Data</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div id="clEditKaryawan" class="col-md-12 col-sm-12">
                                        <button id="clEditKaryawan-click" class="btn btn-primary w-100" style="text-align:left;">
                                             <a class="text-white" data-toggle="collapse" href="#!" role="button" aria-expanded="false" aria-controls="colKaryawan">
                                                  2. Data Karyawan
                                             </a>
                                             <img id="imgKaryawan" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </button>
                                        <div class="collapse mt-2" id="colEditKaryawan">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="alert alert-danger errmsgKary animate__animated animate__bounce d-none"></div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noktpshow"> No. KTP <span class="text-danger">*</span></label>
                                                                 <input id='noktpshow' name='noktpshow' type="number" autocomplete="off" spellcheck="false" class="noktpshow form-control bg-white" value="<?= $data_kary->no_ktp ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namalengkapshow">Nama Lengkap <span class="text-danger">*</span></label>
                                                                 <input id='namalengkapshow' name='namalengkapshow' autocomplete="off" spellcheck="false" class="namalengkapshow form-control bg-white" value="<?= $data_kary->nama_lengkap ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                            <label for="editPerKary">Perusahaan</label>
                                                            <h5 id='txtPerusahaan'><?= $data_kary->nama_perusahaan ?></h5>
                                                            <span class="jkj234asdf u7i8o9h6u8s34 lk3kjdff3 n3m8h6x6 d-none"><?= $data_kary->auth_perusahaan ?></span>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editNIKKary">Nomor Register Pokok (NRP) <span class="text-danger">*</span></label>
                                                                 <input id="editNIKKary" name="editNIK" type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="<?= $data_kary->no_nik ?>">
                                                                 <small class="errorEditNIKKary text-danger font-italic font-weight-bold"></small>
                                                                 <!-- <span class="a6b73b5c154d3540919ddf46edf3b84e d-none"></span> -->
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-5 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editDepartKary">Departemen <span class="text-danger">*</span></label>
                                                                 <div id='txtEditDepartKary' class="input-group">
                                                                      <select id='editDepartKary' name='editDepartKary' class="form-control form-control-user" disabled>
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditDepart" name="refreshEditDepart" class="btn btn-primary btn-sm" title="Refresh Departemen" disabled><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditDepartKary text-danger font-italic font-weight-bold"></small>
                                                                 <span class="c1492f38214db699dfd3574b2644271d d-none"></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-7 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editPosisiKary">Posisi <span class="text-danger">*</span></label>
                                                                 <div id='txtEditPosisiKary' class="input-group">
                                                                      <select id='editPosisiKary' name='editPosisiKary' class="form-control form-control-user" disabled>
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditPosisi" name="refreshEditPosisi" class="btn btn-primary btn-sm" title="Refresh Posisi" disabled><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditPosisiKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editKlasifikasiKary">Klasifikasi <span class="text-danger">*</span></label>
                                                                 <div id="txtEditKlasifikasiKary" class="input-group">
                                                                      <select id="editKlasifikasiKary" name="editKlasifikasiKary" class="form-control form-control-user">
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button on id="refreshEditKlasifikasi" name="refreshEditKlasifikasi" class="btn btn-primary btn-sm" title="Refresh Klasifikasi" disabled><i class="fas fa-sync-alt"></i></button>
                                                                           <button on id="infoEditKlasifikasi" name="infoEditKlasifikasi" class="btn btn-warning btn-sm" title="Informasi" disabled><i class="fas fa-info-circle"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditKlasifikasiKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addTipeKaryawan">Golongan <span class="text-danger">*</span></label>
                                                                 <div id='txtEditJeniskary' class="input-group">
                                                                      <select id='editTipeKary' name='editTipeKary' class="form-control form-control-user">
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditTipe" name="refreshEditTipe" class="btn btn-primary btn-sm" title="Refresh Golongan" disabled><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditTipeKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editLevelKary">Level <span class="text-danger">*</span></label>
                                                                 <div id='txtEditLevelKary' class="input-group">
                                                                      <select id='editLevelKary' name='editLevelKary' class="form-control form-control-user">
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditLevel" name="refreshEditLevel" class="btn btn-primary btn-sm" title="Refresh Level" disabled><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditLevelKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editPOHKary">Point of Hire <span class="text-danger">*</span></label>
                                                                 <div id='txtEditPOHKary' class="input-group">
                                                                      <select id='editPOHKary' name='editPOHKary' class="form-control form-control-user">
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditPOH" name="refreshEditPOH" class="btn btn-primary btn-sm" title="Refresh Point of Hire" disabled><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="erroreEditPOHKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editLokterimaKary">Lokasi Penerimaan <span class="text-danger">*</span></label>
                                                                 <div id='txtEditLokterimaKary' class="input-group">
                                                                      <select id='editLokterimaKary' name='editLokterimaKary' class="form-control form-control-user">
                                                                           <option value="0">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditLokterima" name="refreshEditLokterima" class="btn btn-primary btn-sm" title="Refresh Lokasi Penerimaan" disabled><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditLokterimaKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editLokkerKary">Lokasi Kerja <span class="text-danger">*</span></label>
                                                                 <div id='txtEditLokkerKary' class="input-group">
                                                                      <select id='editLokkerKary' name='editLokkerKary' class="form-control form-control-user">
                                                                           <option value="0">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditLokker" name="refreshEditLokker" class="btn btn-primary btn-sm" title="Refresh Lokasi Kerja" disabled><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditLokkerKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editStatusResidence">Status Residence <span class="text-danger">*</span></label>
                                                                 <div id='txtEditStatResidence' class="input-group">
                                                                      <select id='editStatusResidence' name='editStatusResidence' class="form-control form-control-user">
                                                                           <option value="" default>-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditResidence" name="refreshEditResidence" class="btn btn-primary btn-sm" title="Refresh Status Residence"><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditStatusResidence text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editDOH">Date of Hire <span class="text-danger">*</span></label>
                                                                 <input id='editDOH' name='editDOH' type='date' class="form-control form-control-user" value="<?= $data_kary->doh ?>">
                                                                 <small class="errorEditDOH text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editTanggalAktif">Tanggal Aktif <span class="text-danger">*</span></label>
                                                                 <input id='editTanggalAktif' name='editTanggalAktif' type='date' class="form-control form-control-user" value="<?= $data_kary->tgl_aktif ?>">
                                                                 <small class="errorEditTanggalAktif text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editEmailKantor">Email Perusahaan </label>
                                                                 <input id='editEmailKantor' name='editEmailKantor' type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?= $data_kary->email_kantor ?>" required>
                                                                 <small class="errorEditEmailKantor text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editStatusKerjaKary">Status Karyawan <span class="text-danger">*</span></label>
                                                                 <div id='txtEditStatKerjaKary' class="input-group mt-2">
                                                                      <select id='editStatusKerjaKary' name='editStatusKerjaKary' class="form-control form-control-user">
                                                                           <option value="">-- WAJIB DIISI --</option>
                                                                      </select>
                                                                      <div class="input-group-prepend">
                                                                           <button id="refreshEditStatKaryawan" name="refreshEditStatKaryawan" title="Refresh Status Karyawan" class="btn btn-primary btn-sm" disabled><i class="fas fa-sync-alt"></i></button>
                                                                      </div>
                                                                 </div>
                                                                 <small class="errorEditStatusKerjaKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div id="editFieldPermanen" class="col-lg-4 col-md-4 col-sm-12 d-none">
                                                            <div class="form-group">
                                                                 <label for="editTanggalPermanen">Tanggal Permanen <span class="text-danger">*</span></label>
                                                                 <input id='editTanggalPermanen' name='editTanggalPermanen' type="date" class="form-control" value="<?= $data_kontrak->tgl_mulai ?>" style="background-color:transparent;">
                                                                 <small class="errorEditTanggalPermanen text-danger font-italic font-weight-bold" style="font-size:13px;"></small>
                                                            </div>
                                                       </div>
                                                       <div id="editFieldKontrakAwal" class="col-lg-4 col-md-4 col-sm-12 d-none">
                                                            <div class="form-group">
                                                                 <label for="editTanggalKontrakAwal">Tanggal Awal <span class="text-danger">*</span></label>
                                                                 <input id='editTanggalKontrakAwal' name='editTanggalKontrakAwal' type="date" class="form-control" value="<?= $data_kontrak->tgl_mulai ?>" style="background-color:transparent;">
                                                                 <small class="errorEditTanggalKontrakAwal text-danger font-italic font-weight-bold" style="font-size:13px;"></small>
                                                            </div>
                                                       </div>
                                                       <div id="editFieldKontrakAkhir" class="col-lg-4 col-md-4 col-sm-12 d-none">
                                                            <div class="form-group">
                                                                 <label for="editTanggalKontrakAkhir">Tanggal Berakhir <span class="text-danger">*</span></label>
                                                                 <input id='editTanggalKontrakAkhir' name='editTanggalKontrakAkhir' type="date" class="form-control" value="<?= $data_kontrak->tgl_akhir ?>" style="background-color:transparent;">
                                                                 <small class="errorEditTanggalKontrakAkhir text-danger font-italic font-weight-bold" style="font-size:13px;"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="editSimpanPekerjaan" class="btn btn-primary font-weight-bold text-white" style="margin-left:30px;">Simpan Data</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div id="clEditIzin" class="col-md-12 col-sm-12 mt-2">
                                        <button id="clEditIzinTambang-click" class="btn btn-primary w-100" style="text-align:left;">
                                             <a class="text-white" data-toggle="collapse" href="#!" role="button" aria-expanded="false">
                                                  3. SIMPER / Mine Permit
                                             </a>
                                             <img id="imgIzinTambang" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </button>
                                        <div class="collapse mt-2" id="colEditIzinTambang">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="alert alert-danger errormsgizin animate__animated animate__bounce d-none"></div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noktpshow"> No. KTP <span class="text-danger">*</span></label>
                                                                 <input id='noktpshow' name='noktpshow' type="number" autocomplete="off" spellcheck="false" class="noktpshow form-control bg-white" value="<?= $data_kary->no_ktp ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namalengkapshow">Nama Lengkap <span class="text-danger">*</span></label>
                                                                 <input id='namalengkapshow' name='namalengkapshow' autocomplete="off" spellcheck="false" class="namalengkapshow form-control bg-white" value="<?= $data_kary->nama_lengkap ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editJenisIzin">Jenis Izin <span class="text-danger">*</span></label>
                                                                 <select id="editJenisIzin" name="editJenisIzin" class="form-control form-control-user">
                                                                      <option value="">-- WAJIB DIPILIH --</option>
                                                                      <option value="SP">SIMPER</option>
                                                                      <option value="MP">MINE PERMIT</option>
                                                                 </select>
                                                                 <small class="errorEditJenisIzin text-danger font-italic font-weight-bold"></small>
                                                                 <span class="ecb14fe704e08d9df8e343030bbbafcb d-none"></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editNoReg">No. Register <span class="text-danger">*</span></label>
                                                                 <input id='editNoReg' name='editNoReg' type="text" class="form-control form-control-user" value="<?= $data_izin->no_reg ?>">
                                                                 <small class="errorEditNoReg text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div id="txtEditSIM" class="col-lg-6 col-md-6 col-sm-12 mb-3 d-none">
                                                            <div class="row">
                                                                 <div class="col-lg-6 col-md-6 col-sm-12">
                                                                      <div class="form-group">
                                                                           <label for="editJenisSIM">Jenis SIM <span class="text-danger">*</span></label>
                                                                           <div id="txtEditIzinSIM" class="input-group">
                                                                                <select id='editJenisSIM' name='editJenisSIM' class="form-control form-control-user">
                                                                                     <option value="">-- SIM TIDAK ADA --</option>
                                                                                </select>
                                                                                <div class="input-group-prepend">
                                                                                     <button id="refreshEditJenisSIM" name="refreshJenisSIM" class="btn btn-primary btn-sm" disabled><i class="fas fa-sync-alt"></i></button>
                                                                                </div>
                                                                           </div>
                                                                           <small class="errorEditJenisSIM text-danger font-italic font-weight-bold"></small>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-lg-6 col-md-6 col-sm-12">
                                                                      <div class="form-group">
                                                                           <label for="addTglExpSIM">Tanggal Expired SIM <span class="text-danger">*</span></label>
                                                                           <input id='addTglExpSIM' name='addTglExpSIM' type="date" class="form-control form-control-user" value="<?= !$data_sim_kary ? "" : $data_sim_kary->tgl_exp ?>">
                                                                           <small class="erroraddTglExpSIM text-danger font-italic font-weight-bold"></small>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="editTglExp">Tanggal Expired Izin <span class="text-danger">*</span></label>
                                                                 <input id='editTglExp' name='editTglExp' type="date" class="form-control form-control-user" value="<?= $data_izin->tgl_expired ?>">
                                                                 <small class="errorEditTglExp text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div id="txtEditunit" class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                            <div class="row">
                                                                 <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                                      <hr>
                                                                 </div>
                                                                 <div class="collapse col-lg-12 col-md-12 col-sm-12 mb-3 simperunit">
                                                                      <a id="editUnitSIMPER" href="#!" class="btn btn-primary font-weight-bold mb-4">Tambah Unit</a>
                                                                      <div id="idizintambang" class="data"></div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="editKembaliIzinUnit" data-scroll href="#clKaryawan" class="btn btn-warning font-weight-bold disabled">Kembali</a>
                                                            <a id="editSimpanIzinUnit" data-scroll href="#clSertifikasi" class="btn btn-primary font-weight-bold disabled" style="margin-left:30px;">Lanjutkan</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 col-sm-12 mt-2">
                                        <button id="clEditSertifikasi-click" class="btn btn-primary w-100" style="text-align:left;">
                                             <a class="text-white" data-toggle="collapse" href="#!" role="button" aria-expanded="false" aria-controls="colSertifikasi">
                                                  4. Data Sertifikasi
                                             </a>
                                             <img id="imgSertifikasi" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </button>
                                        <div class="collapse mt-2" id="colEditSertifikasi">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="alert alert-danger errormsgsertifikasi animate__animated animate__bounce d-none"></div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noktpshow"> No. KTP <span class="text-danger">*</span></label>
                                                                 <input id='noktpshow' name='noktpshow' type="number" autocomplete="off" spellcheck="false" class="noktpshow form-control bg-white" value="<?= $data_kary->no_ktp ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namalengkapshow">Nama Lengkap <span class="text-danger">*</span></label>
                                                                 <input id='namalengkapshow' name='namalengkapshow' autocomplete="off" spellcheck="false" class="namalengkapshow form-control bg-white" value="<?= $data_kary->nama_lengkap ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="alert alert-danger errMsgSertifikasi animate__animated animate__bounce d-none mb-3"></div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="jenisSertifikasi">Jenis Sertifikasi <span class="text-danger">*</span></label>
                                                                 <select id='jenisSertifikasi' name='jenisSertifikasi' autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                                                      <option value="">-- WAJIB DIPILIH --</option>
                                                                 </select>
                                                                 <small class="errorjenisSertifikasi text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noSertifikat">No. Sertifikasi <span class="text-danger">*</span></label>
                                                                 <input id='noSertifikat' name='noSertifikat' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                                                 <small class="errorNoSertifikat text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namaLembaga">Nama Lembaga <span class="text-danger">*</span></label>
                                                                 <input id='namaLembaga' name='namaLembaga' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                                                 <small class="errorNamaLembaga text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="tanggalSertifikasi">Tanggal Sertifikasi <span class="text-danger">*</span></label>
                                                                 <input id='tanggalSertifikasi' name='tanggalSertifikasi' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                                                 <small class="errorTanggalSertifikasi text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="masaBerlakuSertifikat">Masa Berlaku (Tahun) </label>
                                                                 <select id='masaBerlakuSertifikat' name='masaBerlakuSertifikat' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                                                      <option value="">-- PILIH MASA BERLAKU --</option>
                                                                      <option value="1">1 TAHUN</option>
                                                                      <option value="2">2 TAHUN</option>
                                                                      <option value="3">3 TAHUN</option>
                                                                      <option value="4">4 TAHUN</option>
                                                                      <option value="5">5 TAHUN</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="tanggalSertifikasiAkhir">Tanggal Expired <span class="text-danger">*</span></label>
                                                                 <input id='tanggalSertifikasiAkhir' name='tanggalSertifikasiAkhir' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                                                 <small class="errorTanggalSertifikasiAkhir text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                            <div>
                                                                 <h6 class="text-danger font-italic">Catatan : Upload file Sertifikat dalam format pdf, ukuran file Sertifikat maksimal 300 kb.</h6>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="fileSertifikasi"><b>Upload file sertifikat</b> :</label>
                                                                 <input type="file" class="form-control-file" id="fileSertifikasi" disabled>
                                                                 <small class="errorFileSertifikasi text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                            <a id="addSimpanSertifikasi" data-scroll href="#clSertifikasi" class="btn btn-primary font-weight-bold disabled">Simpan & Upload</a>
                                                            <a id="addResetSertifikasi" href="#!" class="btn btn-warning font-weight-bold disabled">Reset</a>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                            <hr>
                                                            <div id="idsertifikat" class="data"></div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="addbtnkembaliSertifikat" data-scroll href="#clIzinTambang" class="btn btn-warning font-weight-bold disabled">Kembali</a>
                                                            <a id="addLanjutSertifikasi" data-scroll href="#clMCU" class="btn btn-primary font-weight-bold disabled" style="margin-left:30px;">Lanjutkan</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 col-sm-12 mt-2">
                                        <button id="clEditMCU-click" class="btn btn-primary w-100" style="text-align:left;">
                                             <a class="text-white" data-toggle="collapse" href="#colMCU" role="button" aria-expanded="false" aria-controls="colMCU">
                                                  5. Data Medical Check Up (MCU)
                                             </a>
                                             <img id="imgMCU" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </button>
                                        <div class="collapse mt-2" id="colEditMCU">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="alert alert-danger errormsgmcu animate__animated animate__bounce d-none"></div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noktpshow"> No. KTP <span class="text-danger">*</span></label>
                                                                 <input id='noktpshow' name='noktpshow' type="number" autocomplete="off" spellcheck="false" class="noktpshow form-control bg-white" value="<?= $data_kary->no_ktp ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namalengkapshow">Nama Lengkap <span class="text-danger">*</span></label>
                                                                 <input id='namalengkapshow' name='namalengkapshow' autocomplete="off" spellcheck="false" class="namalengkapshow form-control bg-white" value="<?= $data_kary->nama_lengkap ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="alert alert-danger errMCU animate__animated animate__bounce d-none mb-3"></div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="tglMCU">Tanggal MCU <span class="text-danger">*</span></label>
                                                                 <input id='tglMCU' name='tglMCU' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                                                 <small class="errorTglMCU text-danger font-italic font-weight-bold"></small>
                                                                 <span class="90dea748042796037c02b4cf2b388b03 d-none"></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="hasilMCU">Hasil MCU <span class="text-danger">*</span></label>
                                                                 <select id='hasilMCU' name='hasilMCU' autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                                                      <option value="">-- WAJID DIPILIH --</option>
                                                                 </select>
                                                                 <small class="errorHasilMCU text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="ketMCU">Keterangan <span class="text-danger">*</span></label>
                                                                 <textarea id='ketMCU' name='ketMCU' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled></textarea>
                                                                 <small class="errorKetMCU text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div>
                                                                 <h6 class="text-danger font-italic">Catatan : Upload file MCU dalam format pdf, ukuran file MCUf maksimal 200 kb.</h6>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="fileMCU">Upload file MCU :</label>
                                                                 <input type="file" class="form-control-file" id="fileMCU" name="fileMCU" disabled>
                                                                 <small class="errorFileMCU text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <a id="addTampilkanMCU" data-scroll href="#!" target="_blank" class="btn btn-primary font-weight-bold disabled">Tampilkan File</a>
                                                            <a id="addHapusMCU" data-scroll href="#!" class="btn btn-warning font-weight-bold disabled">Hapus</a>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="addbtnkembaliMCU" data-scroll href="#clSertifikasi" class="btn btn-warning font-weight-bold disabled">Kembali</a>
                                                            <a id="addSimpanMCU" data-scroll href="#clVaksin" class="btn btn-primary font-weight-bold disabled" style="margin-left:30px;">Upload MCU & Lanjutkan</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 col-sm-12 mt-2">
                                        <button id="clEditVaksin-click" class="btn btn-primary w-100" style="text-align:left;">
                                             <a class="text-white" data-toggle="collapse" href="#colVaksin" role="button" aria-expanded="false" aria-controls="colVaksin">
                                                  6. Data Vaksin
                                             </a>
                                             <img id="imgVaksin" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </button>
                                        <div class="collapse mt-2" id="colEditVaksin">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="alert alert-danger errormsgvaksin animate__animated animate__bounce d-none"></div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noktpshow"> No. KTP <span class="text-danger">*</span></label>
                                                                 <input id='noktpshow' name='noktpshow' type="number" autocomplete="off" spellcheck="false" class="noktpshow form-control bg-white" value="<?= $data_kary->no_ktp ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namalengkapshow">Nama Lengkap <span class="text-danger">*</span></label>
                                                                 <input id='namalengkapshow' name='namalengkapshow' autocomplete="off" spellcheck="false" class="namalengkapshow form-control bg-white" value="<?= $data_kary->nama_lengkap ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div id="jnsVaksin" class="form-group">
                                                                 <label for="jenisVaksin">Jenis Vaksin <span class="text-danger">*</span></label>
                                                                 <select id='jenisVaksin' name='jenisVaksin' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                                                      <option value="-- PILIH JENIS VAKSIN --"></option>
                                                                 </select>
                                                                 <small class="errorJenisVaksin text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div id="nmVaksin" class="form-group">
                                                                 <label for="namaVaksin">Nama Vaksin <span class="text-danger">*</span></label>
                                                                 <select id='namaVaksin' name='namaVaksin' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                                                      <option value="">-- PILIH VAKSIN --</option>
                                                                 </select>
                                                                 <small class="errorNamaVaksin text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div id="tglVaksin" class="form-group">
                                                                 <label for="tanggalVaksin">Tanggal Vaksin <span class="text-danger">*</span></label>
                                                                 <input id='tanggalVaksin' name='tanggalVaksin' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required disabled>
                                                                 <small class="errorTanggalVaksin text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <a id="addSimpanVaksin" data-scroll href="#clVaksin" class="btn btn-primary font-weight-bold disabled">Simpan Data</a>
                                                            <a id="addResetVaksin" href="#!" class="btn btn-warning font-weight-bold ml-2  disabled">Reset</a>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                            <hr>
                                                            <div id="idvaksin" class="data"></div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="addbtnkembalivaksin" data-scroll href="#clMCU" class="btn btn-warning font-weight-bold disabled">Kembali</a>
                                                            <a id="addLanjutkanVaksin" data-scroll href="#clFilePendukung" class="btn btn-primary font-weight-bold disabled" style="margin-left:30px;">Lanjutkan</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 col-sm-12 mt-2">
                                        <button id="clEditFilePendukung-click" class="btn btn-primary w-100" style="text-align:left;">
                                             <a class="text-white" data-toggle="collapse" href="#colFilePendukung" role="button" aria-expanded="false" aria-controls="colFilePendukung">
                                                  7. Upload File Pendukung
                                             </a>
                                             <img id="imgFilePendukung" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </button>
                                        <div class="collapse mt-2" id="colEditFilePendukung">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noktpshow"> No. KTP <span class="text-danger">*</span></label>
                                                                 <input id='noktpshow' name='noktpshow' type="number" autocomplete="off" spellcheck="false" class="noktpshow form-control bg-white" value="<?= $data_kary->no_ktp ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namalengkapshow">Nama Lengkap <span class="text-danger">*</span></label>
                                                                 <input id='namalengkapshow' name='namalengkapshow' autocomplete="off" spellcheck="false" class="namalengkapshow form-control bg-white" value="<?= $data_kary->nama_lengkap ?>" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                            <div class="alert errmsgfilependukung alert-danger animate__animated animate__bounce d-none mb-2" role="alert"></div>
                                                            <div class='text-danger font-italic'>
                                                                 <div>
                                                                      <h6>Catatan :</h6>
                                                                 </div>
                                                                 <div>
                                                                      <ul>
                                                                           <li>File pendukung adalah gabungan file pdf menjadi 1 file dengan format sebagai berikut : <b>CV, Kartu Keluarga, KTP, Ijazah.</b></li>
                                                                           <li>Upload file pendukung dalam format pdf.</li>
                                                                           <li>Ukuran file pendukung maksimal 500 kb.</li>
                                                                      </ul>
                                                                 </div>
                                                            </div>

                                                            <div class="form-group">
                                                                 <label for="filePendukung"><b>Upload file pendukung <span class="text-danger">*</span></b></label>
                                                                 <input type="file" class="form-control-file" id="filePendukung" disabled>
                                                                 <small class="errorFilePendukung text-danger font-italic font-weight-bold"></small>
                                                                 <span class="8k79k67h5h9k73j7f0l28jf689sd7 d-none"></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <a id="addTampilkanFilePendukung" data-scroll href="#!" target="_blank" class="btn btn-success font-weight-bold disabled">Tampilkan File</a>
                                                            <a id="addHapusFilePendukung" data-scroll href="#!" class="btn btn-warning font-weight-bold disabled">Hapus</a>
                                                            <a id="addUploadFilePendukung" data-scroll href="#!" class="btn btn-primary font-weight-bold disabled">Upload File</a>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="addbtnkembaliFile" data-scroll href="#clVaksin" class="btn btn-warning font-weight-bold disabled">Kembali</a>
                                                            <a id="addUploadFileSelesai" data-scroll href="#clFilePendukung" class="btn btn-primary font-weight-bold disabled" style="margin-left:30px;">Selesai</a>
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
     </div>
</div>
</div>
</div>
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
<div class="modal fade" id="mdleditsertifikat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-c-yellow">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Sertifikat</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert erreditsertifikat alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="jenisSertifikasiEdit">Jenis Sertifikasi :</label>
                                   <select id='jenisSertifikasiEdit' name='jenisSertifikasiEdit' autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                        <option value="">-- WAJIB DIPILIH --</option>
                                   </select>
                                   <small class="errorjenisSertifikasiEdit text-danger font-italic font-weight-bold"></small>
                                   <span class="7u67u834hs7dg4haj231hh67ju7a2 d-none"></span>
                              </div>
                         </div>
                         <div class="col-lg-4 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="noSertifikatEdit">No. Sertifikasi :</label>
                                   <input id='noSertifikatEdit' name='noSertifikatEdit' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                   <small class="errorNoSertifikatEdit text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                         <div class="col-lg-8 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="namaLembagaEdit">Nama Lembaga :</label>
                                   <input id='namaLembagaEdit' name='namaLembagaEdit' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                   <small class="errorNamaLembagaEdit text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-12">
                              <div class="form-group">
                                   <label for="tanggalSertifikasiEdit">Tanggal Sertifikasi :</label>
                                   <input id='tanggalSertifikasiEdit' name='tanggalSertifikasiEdit' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                   <small class="errorTanggalSertifikasiEdit text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-12">
                              <div class="form-group">
                                   <label for="masaBerlakuSertifikatEdit">Masa Berlaku (Tahun) :</label>
                                   <select id='masaBerlakuSertifikatEdit' name='masaBerlakuSertifikatEdit' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                        <option value="">-- PILIH MASA BERLAKU --</option>
                                        <option value="1">1 TAHUN</option>
                                        <option value="2">2 TAHUN</option>
                                        <option value="3">3 TAHUN</option>
                                        <option value="4">4 TAHUN</option>
                                        <option value="5">5 TAHUN</option>
                                   </select>
                              </div>
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-12">
                              <div class="form-group">
                                   <label for="tanggalSertifikasiAkhirEdit">Tanggal Expired :</label>
                                   <input id='tanggalSertifikasiAkhirEdit' name='tanggalSertifikasiAkhirEdit' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                   <small class="errorTanggalSertifikasiAkhir text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btneditsertifikat" id="btneditsertifikat" class="btn font-weight-bold btn-primary">Update Data</button>
                    <button name="btnbatalsertifikat" id="btnbatalsertifikat" data-dismiss="modal" class="btn font-weight-bold btn-warning">Selesai</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdldetailsertifikat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
          <div class="modal-content">
               <div class="modal-header bg-c-yellow">
                    <h5 class="modal-title text-white" id="jdldetailsertifikat">Detail Sertifikat</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert errsertifikatdetail alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="jenisSertifikasiDetail">Jenis Sertifikasi :</label>
                                   <input id='jenisSertifikasiDetail' name='jenisSertifikasiDetail' autocomplete="off" spellcheck="false" class="form-control" value="" disabled>
                              </div>
                         </div>
                         <div class="col-lg-4 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="noSertifikatDetail">No. Sertifikasi :</label>
                                   <input id='noSertifikatDetail' name='noSertifikatDetail' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" disabled>
                              </div>
                         </div>
                         <div class="col-lg-8 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="namaLembagaDetail">Nama Lembaga :</label>
                                   <input id='namaLembagaDetail' name='namaLembagaDetail' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" disabled>
                              </div>
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-12">
                              <div class="form-group">
                                   <label for="tanggalSertifikasiDetail">Tanggal Sertifikasi :</label>
                                   <input id='tanggalSertifikasiDetail' name='tanggalSertifikasiDetail' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" disabled>
                              </div>
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-12">
                              <div class="form-group">
                                   <label for="tanggalSertifikasiAkhirDetail">Tanggal Expired :</label>
                                   <input id='tanggalSertifikasiAkhirDetail' name='tanggalSertifikasiAkhirEdit' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" disabled>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button name="btnselesaidetailser" id="btnselesaidetailser" data-dismiss="modal" class="btn font-weight-bold btn-warning">Selesai</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdluploadulangser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:50%;">
          <div class="modal-content">
               <div class="modal-header bg-c-yellow">
                    <h5 class="modal-title text-white" id="jdluploadulangser">Upload Ulang Sertifikat</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert erruploadulangser alert-danger animate__animated animate__bounce d-none" role="alert"></div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                              <div>
                                   <h6 class="text-danger font-italic">Catatan : Upload file Sertifikat dalam format pdf, ukuran file Sertifikat maksimal 300 kb.</h6>
                              </div>
                              <div class="form-group">
                                   <label for="fileSertifikasiUlang"><b>Upload file sertifikat</b> :</label>
                                   <input type="file" class="form-control-file" id="fileSertifikasiUlang">
                                   <small class="errorFileSertifikasiUlang text-danger font-italic font-weight-bold"></small>
                                   <span class="9f7fjmuj8ik2js4n8k66g3hjl323 d-none"></span>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnuploadulangser" id="btnuploadulangser" class="btn font-weight-bold btn-primary">Upload File</button>
                    <button name="btnbataluploadulangser" id="btnbataluploadulangser" data-dismiss="modal" class="btn font-weight-bold btn-warning">Batal</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlAddKaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:60%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Karyawan Baru</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <label for="addPerKary" class="font-weight-bold font-italic">Pilih perusahaan untuk memulai isi data karyawan<span class="text-danger"> *</span></label>
                              <div id='txtperkary' class="input-group">
                                   <select id='addPerKary' name='addPerKary' class="form-control form-control-user">
                                        <option value="">-- WAJIB DIPILIH --</option>
                                        <?= $permst . $perstr; ?>
                                   </select>
                              </div>
                              <small class="errorAddPerKary text-danger font-italic font-weight-bold"></small><br>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="cariMPerusahaan">No. KTP :</label>
                                   <input id='cariMPerusahaan' name='cariMPerusahaan' type="text" placeholder="Ketikkan Kode Perusahaan / Nama Perusahaan" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                              </div>
                         </div>
                         <div class="col-lg-3 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="kodeMperusahaan">NIK <span class="text-danger">*</span> </label>
                                   <input id='kodeMperusahaan' name='kodeMperusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" disabled>
                                   <small class="error2str text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                         <div class="col-lg-9 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="namaMperusahaan">Nama Karyawan <span class="text-danger">*</span></label>
                                   <input id='namaMperusahaan' name='namaMperusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                   <small class="error3str text-danger font-italic font-weight-bold"></small>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" name="btnSaveStrPer" id="btnSaveStrPer" class="btn font-weight-bold btn-primary">Simpan Data</button>
                    <button type="button" name="btnCancelStrPer" id="btnCancelStrPer" data-dismiss="modal" class="btn font-weight-bold btn-warning">Selesai</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlinfoklasifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:60%;">
          <div class="modal-content">
               <div class="modal-header bg-c-yellow">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Informasi Klasifikasi</h5>
               </div>

               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row p-2">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <p class="text-danger font-italic font-weight-bold">Pilih klasifikasi karyawan sesuai dengan keterangan berikut :</p>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <ul>
                                   <li><b>Manajemen</b> : Board of Director, Manager.</li>
                                   <li><b>Profesional</b> : Advisor, Specialist dan lain-lain.</li>
                                   <li><b>Teknisi</b> : Superintendent, Supervisor, Head/Chief, Foreman, Maintenance, Technician.</li>
                                   <li><b>Administrasi</b> : Accounting, Scretary, HR Staff/Officer dan lain-lain</li>
                                   <li><b>Terampil</b> : Operator</li>
                                   <li><b>Tidak terampil</b> : Tenaga informal, Pekerja harian lepas dan lain-lain</li>
                              </ul>

                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button name="btnbatalunitsimper" id="btnbatalunitsimper" data-dismiss="modal" class="btn font-weight-bold btn-warning">Selesai</button>
               </div>
          </div>
     </div>
</div>