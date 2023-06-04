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
                                        <a href="<?= base_url('struktur'); ?>">
                                             Struktur Perusahaan
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Tambah Perusahaan
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
                              <h5>Perusahaan</h5>
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
                                   <div class="mb-4">
                                        <a href="<?= base_url('struktur'); ?>" class="btn btn-primary font-weight-bold">Refresh / Data</a>
                                        <a href="<?= base_url('struktur/new'); ?>" class="btn btn-success font-weight-bold">Tambah Data</a>
                                   </div>
                                   <?= $this->session->flashdata('msg'); ?>
                              </div>
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <div id="clPerusahaan" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             1. Data perusahaan
                                             <img id="imgPerusahaan" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse" id="colPerusahaan">
                                             <div class="card card-body mt-2">
                                                  <div class="row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                            <div class="alert alert-danger errormsgper animate__animated animate__bounce d-none mb-3"></div>
                                                            <h5>Perusahaan Utama :</h5>
                                                            <select id='perJenis' name='perJenis' class="form-control form-control-user">
                                                                 <?php

                                                                 if (isset($_SESSION['id_m_perusahaan'])) {
                                                                      $id_m_perusahaan = $_SESSION['id_m_perusahaan'];

                                                                      $servername = "localhost";
                                                                      $username = "root";
                                                                      $password = "";
                                                                      $dbname = "db_kary";
                                                                      $conn = mysqli_connect($servername, $username, $password, $dbname);

                                                                      if (!$conn) {
                                                                           header("'Location: " . base_url() . "'");
                                                                      }

                                                                      static $space;
                                                                      echo "<Option value=''><b>-- PILIH PERUSAHAAN --</b></Option>";
                                                                      $sql = "SELECT * from vw_m_perusahaan where id_m_perusahaan=" . $id_m_perusahaan . " ORDER BY id_perusahaan ASC";
                                                                      $result = mysqli_query($conn, $sql);

                                                                      $id = 0;
                                                                      if (mysqli_num_rows($result) > 0) {
                                                                           $space .= "&roarr;";
                                                                           while ($row = mysqli_fetch_assoc($result)) {
                                                                                $auth_m_perusahaan = $row["auth_m_perusahaan"];
                                                                                $nama_perusahaan = $row["nama_perusahaan"];
                                                                                echo "<Option value='" . $auth_m_perusahaan . "'><b>" . $nama_perusahaan . "</b></Option>";
                                                                           }
                                                                      }

                                                                      function getPerusahaan($idparent)
                                                                      {
                                                                           $servername = "localhost";
                                                                           $username = "root";
                                                                           $password = "";
                                                                           $dbname = "db_kary";
                                                                           $conn = mysqli_connect($servername, $username, $password, $dbname);

                                                                           if (!$conn) {
                                                                                header("'Location: " . base_url() . "'");
                                                                           }

                                                                           static $space;

                                                                           $sql = "SELECT * from vw_m_perusahaan where id_parent=" . $idparent . " ORDER BY id_perusahaan ASC";
                                                                           $result = mysqli_query($conn, $sql);

                                                                           if (mysqli_num_rows($result) > 0) {
                                                                                $space .= "&roarr;";
                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                     $id_perusahaan = $row["id_m_perusahaan"];
                                                                                     $auth_m_perusahaan = $row["auth_m_perusahaan"];
                                                                                     $nama_perusahaan = $row["nama_perusahaan"];
                                                                                     $sql_per = "SELECT * from tb_perusahaan where id_perusahaan=" . $idparent . " ORDER BY id_perusahaan ASC";
                                                                                     if($sql_per){
                                                                                          $rw = mysqli_query($conn, $sql_per);
                                                                                          $
                                                                                     }
                                                                                     echo "<Option value='" . $auth_m_perusahaan . "'><b>" . $space . " " . $nama_perusahaan . "</b></Option>";
                                                                                     getPerusahaan($id_perusahaan);
                                                                                }

                                                                                $space = substr($space, 0, strlen($space) - 7);
                                                                           }

                                                                           mysqli_close($conn);
                                                                      }

                                                                      getPerusahaan($id_m_perusahaan);
                                                                 } else {
                                                                      $id_m_perusahaan = 0;
                                                                      echo "<Option value=''><b>-- PERUSAHAAN TIDAK DITEMUKAN --</b></Option>";
                                                                 }

                                                                 ?>
                                                            </select>
                                                            <small class="ss text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2">
                                                            <h5>Perusahaan Sub Contractor :</h5>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="cariMPerusahaan">Cari Perusahaan :</label>
                                                                 <input id='cariMPerusahaan' name='cariMPerusahaan' type="text" placeholder="Ketikkan Kode Perusahaan / Nama Perusahaan" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                                 <small class="error2str text-danger font-italic font-weight-bold"></small><br>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-3 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="kodeMperusahaan">Kode Perusahaan :</label>
                                                                 <input id='kodeMperusahaan' name='kodeMperusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="" disabled>
                                                                 <small class="error2str text-danger font-italic font-weight-bold"></small><br>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-9 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="namaMperusahaan">Nama Perusahaan :</label>
                                                                 <input id='namaMperusahaan' name='namaMperusahaan' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user bg-white" value="">
                                                                 <small class="error3str text-danger font-italic font-weight-bold"></small><br>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3 text-right">
                                                            <button name="AddPerusahaan" id="AddPerusahaan" class="btn font-weight-bold btn-primary">Simpan & Lanjutkan</button>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <div id="clIUJP" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             2. Izin Usaha Jasa Penambangan (IUJP)
                                             <img id="imgIUJP" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse" id="colIUJP">
                                             <div class="card card-body mt-2">
                                                  <div class="row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                            <div class="alert alert-danger errormsgiujp animate__animated animate__bounce d-none mb-3"></div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="perUtamaIUJP">Perusahaan Utama :</label>
                                                                 <input id='perUtamaIUJP' name='perUtamaIUJP' type="text" class="form-control form-control-user bg-white" value="" disabled>
                                                                 <small class="error2str text-danger font-italic font-weight-bold"></small><br>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="perSubIUJP">Perusahaan Sub Contractor :</label>
                                                                 <input id='perSubIUJP' name='perSubIUJP' type="text" class="form-control form-control-user bg-white" value="" disabled>
                                                                 <small class="error2str text-danger font-italic font-weight-bold"></small><br>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                                            <label for="noiujp">No. IUJP :</label>
                                                            <input id='noiujp' name='noiujp' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error2iujp text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                            <label for="tglAktifiujp">Tanggal Mulai :</label>
                                                            <input id='tglAktifiujp' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error3iujp text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                            <label for="tglakhiriujp">Tanggal Akhir :</label>
                                                            <input id='tglakhiriujp' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error4iujp text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                            <label for="ketiujp">Keterangan :</label>
                                                            <textarea id='ketiujp' name='ketiujp' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea>
                                                            <small class="error5iujp text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                            <div>
                                                                 <h6 class="text-danger font-italic">Catatan : Upload file Izin Usaha Jasa Penambangan (IUJP) dalam format pdf, Ukuran maksimal 1 mb.</h6>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="fileiujp"><b>Upload Izin Usaha Jasa Penambangan (IUJP)</b> :</label>
                                                                 <input type="file" class="form-control-file" id="fileiujp">
                                                                 <small class="error6iujp text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3 text-right">
                                                            <button id="addKembaliIUJP" data-scroll href="#clSIO" class="btn btn-warning font-weight-bold">Kembali</button>
                                                            <button name="addIUJP" id="addIUJP" data-scroll href="#imgSIO" class="btn btn-primary font-weight-bold" style="margin-left:30px;">Simpan & Lanjutkan</button>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <div id="clSIO" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             3. Surat Izin Operasional (SIO)
                                             <img id="imgSIO" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse" id="colSIO">
                                             <div class="card card-body mt-2">
                                                  <div class="row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                            <div class="alert alert-danger errormsgsio animate__animated animate__bounce d-none mb-3"></div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="perUtamaSIO">Perusahaan Utama :</label>
                                                                 <input id='perUtamaSIO' name='perUtamaSIO' type="text" class="form-control form-control-user bg-white" value="" disabled>
                                                                 <small class="error2str text-danger font-italic font-weight-bold"></small><br>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                 <label for="perSubSIO">Perusahaan Sub Contractor :</label>
                                                                 <input id='perSubSIO' name='perSubSIO' type="text" class="form-control form-control-user bg-white" value="" disabled>
                                                                 <small class="error2str text-danger font-italic font-weight-bold"></small><br>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                                            <label for="nosio">No. SIO :</label>
                                                            <input id='nosio' name='nosio' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error2sio text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                            <label for="tglaktifsio">Tanggal Aktif :</label>
                                                            <input id='tglaktifsio' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error3sio text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                            <label for="tglakhirsio">Tanggal Akhir :</label>
                                                            <input id='tglakhirsio' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error4sio text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                            <label for="ketsio">Keterangan :</label>
                                                            <textarea id='ketsio' name='ketsio' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea>
                                                            <small class="error5sio text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                            <div>
                                                                 <h6 class="text-danger font-italic">Catatan : Upload Surat Izin Operasi dalam format pdf, Ukuran maksimal 1 mb.</h6>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="filesio"><b>Upload Surat Izin Operasi (SIO)</b> :</label>
                                                                 <input type="file" class="form-control-file" id="filesio">
                                                                 <small class="error6filesio text-danger font-italic font-weight-bold"></small>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3 text-right">
                                                            <button id="addKembaliSIO" data-scroll href="#clSIO" class="btn btn-warning font-weight-bold">Kembali</button>
                                                            <button name="addSIO" id="addSIO" data-scroll href="#imgSIO" class="btn btn-primary font-weight-bold" style="margin-left:30px;">Simpan & Lanjutkan</button>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <div id="clKontrak" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             4. Kontrak
                                             <img id="imgKontrak" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse" id="colKontrak">
                                             <div class="card card-body mt-2">
                                                  <div class="row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                            <div class="alert alert-danger errormsgkontrak animate__animated animate__bounce d-none mb-3"></div>
                                                       </div>
                                                       <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                                            <label for="nokontrak">No. Kontrak :</label>
                                                            <input id='nokontrak' name='nokontrak' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error2kontrak text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                            <label for="tglaktifkontrak">Tanggal Aktif :</label>
                                                            <input id='tglaktifkontrak' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error3kontrak text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                            <label for="tglakhirkontrak">Tanggal Akhir :</label>
                                                            <input id='tglakhirkontrak' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error4kontrak text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                            <label for="ketkontrak">Keterangan :</label>
                                                            <textarea id='ketkontrak' name='ketkontrak' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea>
                                                            <small class="error5kontrak text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <div id="clPJO" class="btn-primary w-100" style="height:40px;padding-left:15px;padding-top:10px;">
                                             5. Penanggung Jawab Operasional (PJO)
                                             <img id="imgPJO" src="<?= base_url('assets/images/checked.png') ?>" alt="" height="25px" width="25px" class="d-none" style="margin-left:10px;margin-top:-3px;">
                                        </div>
                                        <div class="collapse" id="colPJO">
                                             <div class="card card-body mt-2">
                                                  <div class="row">
                                                       <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                                            <label for="namapjo">Nama PJO :</label>
                                                            <input id='namapjo' name='namapjo' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error2pjo text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                            <label for="tglaktifpjo">Tanggal Aktif :</label>
                                                            <input id='tglaktifpjo' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error3pjo text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                                            <label for="tglakhirpjo">Tanggal Akhir :</label>
                                                            <input id='tglakhirpjo' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                            <small class="error4pjo text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                            <label for="ketpjo">Keterangan :</label>
                                                            <textarea id='ketpjo' name='ketIujb' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea>
                                                            <small class="error5pjo text-danger font-italic font-weight-bold"></small><br>
                                                       </div>
                                                  </div>
                                                  <div class="row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <table class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                                 <thead>
                                                                      <tr>
                                                                           <td>No.</td>
                                                                           <td>Nama PJO</td>
                                                                           <td>Tgl. Aktif</td>
                                                                           <td>Tgl. Akhir</td>
                                                                           <td>Proses</td>
                                                                      </tr>
                                                                 </thead>
                                                                 <tbody>
                                                                 </tbody>
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
     </div>
</div>