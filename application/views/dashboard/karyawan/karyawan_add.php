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
                                             Tambah Karyawan
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
                         <div class="card-header align-items-center">
                              <h5>Tambah Data Karyawan</h5>
                              <div class="card-header-right">
                                   <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                             <li class="dropdown-item full-card">
                                                  <a href="#!"><span><i class="feather icon-maximize"></i>
                                                            FullScreen</span><span style="display: none"><i class="feather icon-minimize"></i> Restore</span></a>
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
                                   <?= $this->session->flashdata("psn"); ?>
                                   <div class="mb-2">
                                        <a id="addbtn" href="<?= base_url('karyawan/new'); ?>" class="btn btn-warning font-weight-bold">Reset</a>
                                   </div>
                              </div>
                              <div class="alert alert-danger errormsg animate__animated animate__bounce d-none"></div>
                              <div class="row pt-2">
                                   <div id="clPersonal" class="col-md-12 col-sm-12 mb-2 clPersonal">
                                        <div id="clPersonal" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             1. Data Personal
                                             <img id="imgPersonal" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse mt-2" id="colPersonal">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="alert alert-danger errPersonal animate__animated animate__bounce d-none"></div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noKTP">No. KTP :</label>
                                                                 <input id='noKTP' name='noKTP' type="number" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorNoKTP text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namaLengkap">Nama Lengkap :</label>
                                                                 <input id='namaLengkap' name='namaLengkap' autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorNamaLengkap text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="alamatKTP">Alamat :</label>
                                                                 <input id='alamatKTP' name='alamatKTP' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorAlamatKTP text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-2 col-md-2 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="rtKTP">RT :</label>
                                                                 <input id='rtKTP' name='rtKTP' type="number" placeholder="000" autocomplete="off" spellcheck="false" class="form-control" value="">
                                                                 <small class="errorRtKTP text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-2 col-md-2 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="rwKTP">RW :</label>
                                                                 <input id='rwKTP' name='rwKTP' type="number" placeholder="000" autocomplete="off" spellcheck="false" class="form-control" value="">
                                                                 <small class="errorRwKTP text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="provData">Provinsi :</label>
                                                                 <div id="txtprov" class="input-group">
                                                                      <select id='provData' name='provData' type="number" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                           <option value="">-- PROVINSI TIDAK DITEMUKAN --</option>
                                                                      </select>
                                                                      <button id="refreshProv" name="refreshProv" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="errorProvData text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="kotaData">Kabupaten / Kota :</label>
                                                                 <div id="txtkota" class="input-group">
                                                                      <select id='kotaData' name='kotaData' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                           <option value="">-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>
                                                                      </select>
                                                                      <button id="refreshKota" name="refreshKota" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="errorKotaData text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="kecData">Kecamatan :</label>
                                                                 <div id="txtkec" class="input-group">
                                                                      <select id='kecData' name='kecData' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                           <option value="">-- KECAMATAN TIDAK DITEMUKAN --</option>
                                                                      </select>
                                                                      <button id="refreshKec" name="refreshKec" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="errorKecData text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="kelData">Kelurahan :</label>
                                                                 <div id="txtkel" class="input-group">
                                                                      <select id='kelData' name='kelData' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                           <option value="">-- KELURAHAN TIDAK DITEMUKAN --</option>
                                                                      </select>
                                                                      <button id="refreshKel" name="refreshKel" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="errorKelData text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addagama">Agama :</label>
                                                                 <select id="addagama" class="mb-3 form-control">
                                                                      <option value="">-- WAJIB DIPILIH --</option>
                                                                 </select>
                                                                 <small class="errorAddAgama text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="jenisKelamin">Jenis Kelamin :</label>
                                                                 <select id="jenisKelamin" class="mb-3 form-control">
                                                                      <option value="">-- PILIH JENIS KELAMIN --</option>
                                                                      <option value="LK">LAKI - LAKI</option>
                                                                      <option value="P">PEREMPUAN</option>
                                                                 </select>
                                                                 <small class="errorJenisKelamin text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="statPernikahan">Status Pernikahan :</label>
                                                                 <div id="txtnikah" class="input-group">
                                                                      <select id="statPernikahan" class="mb-3 form-control">
                                                                           <option value="">-- PILIH PERNIKAHAN --</option>

                                                                      </select>
                                                                      <button id="refreshStatNikah" name="refreshStatNikah" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="errorStatPernikahan text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="kewarganegaraan">Warga Negara :</label>
                                                                 <select id="kewarganegaraan" class="mb-3 form-control">
                                                                      <option value="">-- PILIH WARGA NEGARA --</option>
                                                                      <option value="WNI">WNI</option>
                                                                      <option value="WNA">WNA</option>
                                                                 </select>
                                                                 <small class="errorKewarganegaraan text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="tempatLahir">Tempat Lahir :</label>
                                                                 <input id='tempatLahir' name='tempatLahir' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorTempatLahir text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="tanggalLahir">Tanggal Lahir :</label>
                                                                 <input id='tanggalLahir' name='tanggalLahir' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorTanggalLahir text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="emailPribadi">Email Pribadi :</label>
                                                                 <input id='emailPribadi' name='emailPribadi' type="text" autocomplete="off" spellcheck="false" class="form-control" value="">
                                                                 <small class="errorEmailPribadi text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noTelp">No. Telp :</label>
                                                                 <input id='noTelp' name='noTelp' type="number" autocomplete="off" spellcheck="false" class="form-control" value="">
                                                                 <small class="errorNoTelp text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noBPJSTK">No. BPJS Tenaga Kerja :</label>
                                                                 <input id='noBPJSTK' name='noBPJSTK' type="number" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorNoBPJSTK text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noBPJSKES">No. BPJS Kesehatan :</label>
                                                                 <input id='noBPJSKES' name='noBPJSKES' type="number" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorNoBPJSKES text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noNPWP">No. NPWP :</label>
                                                                 <input id='noNPWP' name='noNPWP' autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorNoNPWP text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noKK">No. Kartu Keluarga :</label>
                                                                 <input id='noKK' name='noKK' type="number" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorNoKK text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namaIbu">Nama Ibu Kandung :</label>
                                                                 <input id='namaIbu' name='namaIbu' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorNamaIbu text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="pendidikanTerakhir">Pendidikan Terakhir :</label>
                                                                 <div id="txtDidik" name="txtDidik" class="input-group">
                                                                      <select id='pendidikanTerakhir' name='pendidikanTerakhir' type="text" autocomplete="off" spellcheck="false" class="custom-select" required value="">
                                                                           <option value="">-- PILIH PENDIDIKAN --</option>
                                                                      </select>
                                                                      <button id="refreshDidik" name="refreshDidik" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="addSimpanPersonal" data-scroll href="#clKaryawan" class="btn btn-primary font-weight-bold">Lanjutkan</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 col-sm-12">
                                        <div id="clKaryawan" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             2. Data Karyawan
                                             <img id="imgKaryawan" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse mt-2" id="colKaryawan">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label for="addPerKary">Perusahaan :</label>
                                                            <div id='txtperkary' class="input-group">
                                                                 <select id='addPerKary' name='addPerKary' class="form-control form-control-user">
                                                                      <option value="">-- WAJIB DIPILIH --</option>
                                                                 </select>
                                                                 <button id="refreshPerKary" name="refreshPerKary" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                            </div>
                                                            <small class="errorAddPerKary text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addNIKKary">Nomor Induk Karyawan :</label>
                                                                 <input id='addNIKKary' name='addNIKKary' type="number" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="erroraddNIKKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addDepartKary">Departemen :</label>
                                                                 <div id='txtdepartkary' class="input-group">
                                                                      <select id='addDepartKary' name='addDepartKary' class="form-control form-control-user" disabled>
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <button id="refreshDepart" name="refreshDepart" class="btn btn-primary btn-sm" disabled><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="errorAddDepartKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addPosisiKary">Posisi :</label>
                                                                 <div id='txtposisikary' class="input-group">
                                                                      <select id='addPosisiKary' name='addPosisiKary' class="form-control form-control-user" disabled>
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <button id="refreshPosisi" name="refreshPosisi" class="btn btn-primary btn-sm" disabled><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="errorAddPosisiKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addKlasifikasiKary">Klasifikasi :</label>
                                                                 <div id='txtklasifikasikary' class="input-group">
                                                                      <select id='addKlasifikasiKary' name='addKlasifikasiKary' class="form-control form-control-user">
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <button id="refreshKlasifikasi" name="refreshKlasifikasi" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="errorAddKlasifikasiKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addPOHKary">Point of Hire :</label>
                                                                 <div id='txtPOHKary' class="input-group">
                                                                      <select id='addPOHKary' name='addPOHKary' class="form-control form-control-user">
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <button id="refreshPOH" name="refreshPOH" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="erroraddPOHKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addLokterimaKary">Lokasi Penerimaan :</label>
                                                                 <div id='txtlokterimakary' class="input-group">
                                                                      <select id='addLokterimaKary' name='addLokterimaKary' class="form-control form-control-user" disabled>
                                                                           <option value="0">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <button id="refreshLokterima" name="refreshLokterima" class="btn btn-primary btn-sm" disabled><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="erroraddLokterimaKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addLokasiKerja">Lokasi Kerja :</label>
                                                                 <div id='txtlokkerkary' class="input-group">
                                                                      <select id='addLokasiKerja' name='addLokasiKerja' class="form-control form-control-user">
                                                                           <option value="0">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <button id="refreshLokker" name="refreshLokker" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="erroraddLokasiKerja text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addJenisKaryawan">Tipe :</label>
                                                                 <div id='txtjeniskary' class="input-group">
                                                                      <select id='addJenisKaryawan' name='addJenisKaryawan' class="form-control form-control-user">
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <button id="refreshTipe" name="refreshTipe" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="erroraddJenisKaryawan text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addGradeKary">Grade - Level :</label>
                                                                 <div id='txtgradekary' class="input-group">
                                                                      <select id='addGradeKary' name='addGradeKary' class="form-control form-control-user" disabled>
                                                                           <option value="">-- WAJIB DIPILIH --</option>
                                                                      </select>
                                                                      <button id="refreshGrade" name="refreshGrade" class="btn btn-primary btn-sm" disabled><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="erroraddGradeKary text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addStatusResidence">Status Residence :</label>
                                                                 <div id='txtstatresidence' class="input-group">
                                                                      <select id='addStatusResidence' name='addStatusResidence' class="form-control form-control-user">
                                                                           <option value="" default>-- WAJIB DIPILIH --</option>
                                                                           <option value="R" default>Residence</option>
                                                                           <option value="NR">Non Residence</option>
                                                                      </select>
                                                                      <button id="refreshResidence" name="refreshResidence" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="erroraddStatusResidence text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addDOH">Date of Hire :</label>
                                                                 <input id='addDOH' name='addDOH' type='date' class="form-control form-control-user">
                                                                 <small class="erroraddDOH text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addTanggalAktif">Tanggal Aktif :</label>
                                                                 <input id='addTanggalAktif' name='addTanggalAktif' type='date' class="form-control form-control-user">
                                                                 <small class="erroraddTanggalAktif text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addEmailKantor">Email Perusahaan :</label>
                                                                 <input id='addEmailKantor' name='addEmailKantor' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addStatusKaryawan">Status Karyawan :</label>
                                                                 <div id='txtstatkary' class="input-group">
                                                                      <select id='addStatusKaryawan' name='addStatusKaryawan' class="form-control form-control-user">
                                                                           <option value="">-- WAJIB DIISI --</option>
                                                                      </select>
                                                                      <button id="refreshstatkaryawan" name="refreshstatkaryawan" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                                                 </div>
                                                                 <small class="erroraddStatusKaryawan text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div id="addFieldPermanen" class="col-lg-4 col-md-4 col-sm-12 d-none">
                                                            <div class="form-group">
                                                                 <label for="addTanggalPermanen">Tanggal Permanen :</label>
                                                                 <input id='addTanggalPermanen' name='addTanggalPermanen' type="date" class="form-control" value="" style="background-color:transparent;">
                                                                 <small class="erroraddTanggalPermanen text-danger font-italic font-weight-bold" style="font-size:13px;"></small>
                                                            </div>
                                                       </div>
                                                       <div id="addFieldKontrakAwal" class="col-lg-4 col-md-4 col-sm-12 d-none">
                                                            <div class="form-group">
                                                                 <label for="addTanggalKontrakAwal">Tanggal Awal :</label>
                                                                 <input id='addTanggalKontrakAwal' name='addTanggalKontrakAwal' type="date" class="form-control" value="" style="background-color:transparent;">
                                                                 <small class="erroraddTanggalKontrakAwal text-danger font-italic font-weight-bold" style="font-size:13px;"></small>
                                                            </div>
                                                       </div>
                                                       <div id="addFieldKontrakAkhir" class="col-lg-4 col-md-4 col-sm-12 d-none">
                                                            <div class="form-group">
                                                                 <label for="addTanggalKontrakAkhir">Tanggal Berakhir :</label>
                                                                 <input id='addTanggalKontrakAkhir' name='addTanggalKontrakAkhir' type="date" class="form-control" value="" style="background-color:transparent;">
                                                                 <small class="erroraddTanggalKontrakAkhir text-danger font-italic font-weight-bold" style="font-size:13px;"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="addKembaliPekerjaan" data-scroll href="#clPersonal" class="btn btn-warning font-weight-bold">Kembali</a>
                                                            <a id="addSimpanPekerjaan" data-scroll href="#clIzinTambang" class="btn btn-primary font-weight-bold" style="margin-left:30px;">Simpan & Lanjutkan</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 col-sm-12 mt-2">
                                        <div id="clIzinTambang" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             3. SIMPER / Mine Permit
                                             <img id="imgIzinTambang" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse mt-2" id="colIzinTambang">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addJenisIzin">Jenis Izin :</label>
                                                                 <select id='addJenisIzin' name='addJenisIzin' class="form-control form-control-user">
                                                                      <option value="">-- WAJIB DIPILIH --</option>
                                                                      <option value="SP">SIMPER</option>
                                                                      <option value="MP">MINE PERMIT</option>
                                                                 </select>
                                                                 <small class="erroraddJenisIzin text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addNoReg">No. Register :</label>
                                                                 <input id='addNoReg' name='addNoReg' type="text" class="form-control form-control-user">
                                                                 <small class="erroraddNoReg text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="addTglExp">Tanggal Expired :</label>
                                                                 <input id='addTglExp' name='addTglExp' type="date" class="form-control form-control-user">
                                                                 <small class="erroraddTglExp text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div id="txtsim" class="col-lg-12 col-md-12 col-sm-12 mb-3 d-none">
                                                            <div class="row">
                                                                 <div class="col-lg-3 col-md-3 col-sm-12">
                                                                      <div class="form-group">
                                                                           <label for="addJenisSIM">Jenis SIM :</label>
                                                                           <select id='addJenisSIM' name='addJenisSIM' class="form-control form-control-user">
                                                                                <option value="">-- WAJIB DIPILIH --</option>
                                                                           </select>
                                                                           <small class="erroraddJenisSIM text-danger font-italic font-weight-bold"></small>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-lg-3 col-md-3 col-sm-12">
                                                                      <div class="form-group">
                                                                           <label for="addTglExpSIM">Tanggal Expired SIM:</label>
                                                                           <input id='addTglExpSIM' name='addTglExpSIM' type="date" class="form-control form-control-user">
                                                                           <small class="erroraddTglExpSIM text-danger font-italic font-weight-bold"></small>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>


                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                            <hr>
                                                       </div>
                                                       <div class="collapse col-lg-12 col-md-12 col-sm-12 mb-3 simperunit">
                                                            <a id="addUnitSIMPER" href="#" class="btn btn-primary font-weight-bold mb-4">Tambah Unit</a>
                                                            <div id="idizintambang" class="data"></div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="addKembaliIzinUnit" data-scroll href="#clKaryawan" class="btn btn-warning font-weight-bold">Kembali</a>
                                                            <a id="addSimpanIzinUnit" data-scroll href="#clSertifikasi" class="btn btn-primary font-weight-bold" style="margin-left:30px;">Lanjutkan</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 col-sm-12 mt-2">
                                        <div id="clSertifikasi" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             4. Data Sertifikasi
                                             <img id="imgSertifikasi" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse mt-2" id="colSertifikasi">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="alert alert-danger errSertifikasi animate__animated animate__bounce d-none mb-3"></div>
                                                            <div class="form-group">
                                                                 <label for="jenisSertifikasi">Jenis Sertifikasi :</label>
                                                                 <select id='jenisSertifikasi' name='jenisSertifikasi' autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                      <option value="">-- WAJIB DIPILIH --</option>
                                                                 </select>
                                                                 <small class="errorjenisSertifikasi text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="noSertifikat">No. Sertifikasi :</label>
                                                                 <input id='noSertifikat' name='noSertifikat' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorNoSertifikat text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namaLembaga">Nama Lembaga :</label>
                                                                 <input id='namaLembaga' name='namaLembaga' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorNamaLembaga text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="tanggalSertifikasi">Tanggal Sertifikasi :</label>
                                                                 <input id='tanggalSertifikasi' name='tanggalSertifikasi' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorTanggalSertifikasi text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="masaBerlakuSertifikat">Masa Berlaku (Tahun) :</label>
                                                                 <select id='masaBerlakuSertifikat' name='masaBerlakuSertifikat' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
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
                                                                 <label for="tanggalSertifikasiAkhir">Tanggal Expired :</label>
                                                                 <input id='tanggalSertifikasiAkhir' name='tanggalSertifikasiAkhir' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorTanggalSertifikasiAkhir text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                            <div>
                                                                 <h6 class="text-danger font-italic">Catatan : Upload file Sertifikat dalam format pdf, Ukuran file Sertifikat maksimal 100 kb.</h6>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="fileSertifikasi"><b>Upload file sertifikat</b> :</label>
                                                                 <input type="file" class="form-control-file" id="fileSertifikasi">
                                                                 <small class="errorFileSertifikasi text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                            <a id="addSimpanSertifikasi" data-scroll href="#clSertifikasi" class="btn btn-primary font-weight-bold">Simpan & Upload</a>
                                                            <a id="addResetSertifikasi" href="#" class="btn btn-warning font-weight-bold">Reset</a>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                            <hr>
                                                            <div id="idsertifikat" class="data"></div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="addbtnkembaliSertifikat" data-scroll href="#clIzinTambang" class="btn btn-warning font-weight-bold">Kembali</a>
                                                            <a id="addLanjutSertifikasi" data-scroll href="#clMCU" class="btn btn-primary font-weight-bold" style="margin-left:30px;">Lanjutkan</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 col-sm-12 mt-2">
                                        <div id="clMCU" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             5. Data Medical Check Up (MCU)
                                             <img id="imgMCU" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse mt-2" id="colMCU">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="alert alert-danger errMCU animate__animated animate__bounce d-none mb-3"></div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="tglMCU">Tanggal MCU :</label>
                                                                 <input id='tglMCU' name='tglMCU' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorTglMCU text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="hasilMCU">Hasil MCU :</label>
                                                                 <select id='hasilMCU' name='hasilMCU' autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                      <option value="">-- WAJID DIPILIH --</option>
                                                                 </select>
                                                                 <small class="errorHasilMCU text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="ketMCU">Keterangan :</label>
                                                                 <textarea id='ketMCU' name='ketMCU' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required></textarea>
                                                                 <small class="errorKetMCU text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div>
                                                                 <h6 class="text-danger font-italic">Catatan : Upload file Sertifikat dalam format pdf, Ukuran file Sertifikat maksimal 100 kb.</h6>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="fileMCU">Upload file MCU :</label>
                                                                 <input type="file" class="form-control-file" id="fileMCU" name="fileMCU">
                                                                 <small class="errorFileMCU text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="addbtnkembaliMCU" data-scroll href="#clSertifikasi" class="btn btn-warning font-weight-bold">Kembali</a>
                                                            <a id="addSimpanMCU" data-scroll href="#clVaksin" class="btn btn-primary font-weight-bold" style="margin-left:30px;">Lanjutkan</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 col-sm-12 mt-2">
                                        <div id="clVaksin" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             6. Data Vaksin
                                             <img id="imgVaksin" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse mt-2" id="colVaksin">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="jenisVaksin">Jenis Vaksin :</label>
                                                                 <select id='jenisVaksin' name='jenisVaksin' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                      <option value="" -- Pilih Vaksin --</option>
                                                                 </select>
                                                                 <small class="errorJenisVaksin text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namaVaksin">Nama Vaksin :</label>
                                                                 <select id='namaVaksin' name='namaVaksin' type="text" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                      <option value="">-- Pilih Vaksin --</option>
                                                                 </select>
                                                                 <small class="errorNamaVaksin text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="tanggalVaksin">Tanggal Vaksin :</label>
                                                                 <input id='tanggalVaksin' name='tanggalVaksin' type="date" autocomplete="off" spellcheck="false" class="form-control" value="" required>
                                                                 <small class="errorTanggalVaksin text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <a id="addSimpanVaksin" data-scroll href="#clVaksin" class="btn btn-primary font-weight-bold">Simpan Data</a>
                                                            <a id="addResetVaksin" href="#" class="btn btn-warning font-weight-bold ml-2">Reset</a>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                            <hr>
                                                            <div id="idvaksin" class="data"></div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="addbtnkembalivaksin" data-scroll href="#clMCU" class="btn btn-warning font-weight-bold">Kembali</a>
                                                            <a id="addLanjutkanVaksin" data-scroll href="#clFilePendukung" class="btn btn-primary font-weight-bold" style="margin-left:30px;">Lanjutkan</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 col-sm-12 mt-2">
                                        <div id="clFilePendukung" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             7. Upload File Pendukung
                                             <img id="imgFilePendukung" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse mt-2" id="colFilePendukung">
                                             <div class="card card-body">
                                                  <div class="card-body row mt-3">
                                                       <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                            <div class="alert errfilependukung alert-danger animate__animated animate__bounce d-none mb-2" role="alert"></div>
                                                            <div class='text-danger font-italic'>
                                                                 <div>
                                                                      <h6>Catatan :</h6>
                                                                 </div>
                                                                 <div>
                                                                      <ul>
                                                                           <li>File pendukung adalah gabungan file pdf menjadi 1 file dengan format sebagai berikut : <b>CV, Kartu Keluarga, KTP, Ijazah.</b></li>
                                                                           <li>Upload file pendukung dalam format pdf.</li>
                                                                           <li>Ukuran file pendukung maksimal 1 mb.</li>
                                                                      </ul>
                                                                 </div>
                                                            </div>

                                                            <div class="form-group">
                                                                 <label for="filePendukung"><b>Upload file pendukung :</b></label>
                                                                 <input type="file" class="form-control-file" id="filePendukung">
                                                                 <small class="errorFilePendukung text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                            <a id="addbtnkembaliFile" href="#" class="btn btn-warning font-weight-bold">Kembali</a>
                                                            <a id="addUploadFileSelesai" data-scroll href="#clFilePendukung" class="btn btn-primary font-weight-bold" style="margin-left:30px;">Upload File & Selesai</a>
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