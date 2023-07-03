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
                                        <a id="bc1" href="#">
                                             Struktur Perusahaan
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Tabel Struktur Perusahaan
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
                              <h5>Struktur Perusahaan</h5>
                              <div class="card-header-right">
                                   <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                             <li class="dropdown-item full-card">
                                                  <a href="#"><span><i class="feather icon-maximize"></i>
                                                            Perbesar</span><span style="display: none"><i class="feather icon-minimize"></i> Restore</span></a>
                                             </li>
                                             <li class="dropdown-item minimize-card">
                                                  <a href="#"><span><i class="feather icon-minus"></i> collapse</span><span style="display: none"><i class="feather icon-plus"></i> expand</span></a>
                                             </li>
                                             <li class="dropdown-item reload-card">
                                                  <a href="#"><i class="feather icon-refresh-cw"></i> reload</a>
                                             </li>
                                        </ul>
                                   </div>
                              </div>
                         </div>
                         <div class="card-body">
                              <div class="mt-3">
                                   <div class="mb-2">
                                        <a id="btnRefreshStruktur" href="<?= base_url('struktur'); ?>" class="btn btn-primary font-weight-bold"><i class="fas fa-sync-alt"></i> Refresh / Data</a>
                                        <a id="btnNewStruktur" href="<?= base_url('struktur/new'); ?>" class="btn btn-success font-weight-bold"><i class="fas fa-plus"></i> Tambah Data</a>
                                   </div>
                                   <?= $this->session->flashdata("psn"); ?>
                                   <div class="alert alert-danger err_psn_struktur animate__animated animate__bounce d-none"></div>
                              </div>
                              <div class="row">
                                   <div class="col-lg-12">
                                        <div class="table-responsive">
                                             <table id="tbmStruktur" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                  <thead>
                                                       <tr class="font-weight-boldtext-white">
                                                            <th style="text-align:center;">AKSI</th>
                                                            <th style="text-align:center;width:1%;">No.</th>
                                                            <th>PERUSAHAAN</th>
                                                            <th>JENIS</th>
                                                            <th>RK3L</th>
                                                            <th>IUJP</th>
                                                            <th>SIO</th>
                                                            <th>KONTRAK</th>
                                                            <th>PJO</th>
                                                            <th>TGL. DIBUAT</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php
                                                       $servername = "localhost";
                                                       $username = "root";
                                                       $password = "";
                                                       $dbname = "db_kary";
                                                       $conn = mysqli_connect($servername, $username, $password, $dbname);

                                                       $idperusahaan = $_SESSION['id_m_perusahaan'];
                                                       $no = 0;
                                                       $sql = "SELECT * from vw_m_prs WHERE id_m_perusahaan=" . $idperusahaan . " ORDER BY id_m_perusahaan ASC";
                                                       $result = mysqli_query($conn, $sql);
                                                       if ($result) {
                                                            if (mysqli_num_rows($result) > 0) {
                                                                 $row = mysqli_fetch_assoc($result);
                                                                 $auth_m_per = $row["auth_m_perusahaan"];
                                                                 $id = $row["id_m_perusahaan"];
                                                                 $nama_per = $row["nama_perusahaan"];
                                                                 $jenis_per = $row["jenis_perusahaan"];
                                                                 $kode_per = $row["kode_perusahaan"];
                                                                 $url_rk3l = $row["url_rk3l"];
                                                                 $nama_m_per = $row["nama_m_perusahaan"];
                                                                 $tgl_buat = date('d-M-Y', strtotime($row["tgl_buat"]));

                                                                 //========================= izin terbaru ==================================

                                                                 $sql = "SELECT * from vw_izin_perusahaan WHERE id_m_perusahaan=" . $id . " ORDER BY tgl_akhir_izin DESC limit 1";
                                                                 $cekizin = mysqli_query($conn, $sql);
                                                                 $jml_izin = mysqli_num_rows($cekizin);

                                                                 if ($jml_izin > 0) {
                                                                      $rw = mysqli_fetch_assoc($cekizin);
                                                                      $now = date('Y-m-d');
                                                                      $tgl_akhir_izin = date('Y-m-d', strtotime($rw['tgl_akhir_izin']));
                                                                      if ($tgl_akhir_izin < $now) {
                                                                           $stt_izin = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-warning'>EXP</span></td>";
                                                                      } else {
                                                                           $stt_izin = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-primary'>A</span></td>";
                                                                      }
                                                                 } else {
                                                                      $stt_izin = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                 }

                                                                 //========================= sio terbaru ==================================

                                                                 $sql = "SELECT * from vw_sio_perusahaan WHERE id_m_perusahaan=" . $id . " ORDER BY tgl_akhir_sio DESC limit 1";
                                                                 $ceksio = mysqli_query($conn, $sql);
                                                                 $jml_sio = mysqli_num_rows($ceksio);

                                                                 if ($jml_sio > 0) {
                                                                      $rw = mysqli_fetch_assoc($ceksio);
                                                                      $now = date('Y-m-d');
                                                                      $tgl_akhir_sio = date('Y-m-d', strtotime($rw['tgl_akhir_sio']));
                                                                      if ($tgl_akhir_sio < $now) {
                                                                           $stt_sio = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-warning'>EXP</span></td>";
                                                                      } else {
                                                                           $stt_sio = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-primary'>A</span></td>";
                                                                      }
                                                                 } else {
                                                                      $stt_sio = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                 }

                                                                 //========================= sio terbaru ==================================

                                                                 $sql = "SELECT * from vw_kontrak_perusahaan WHERE id_m_perusahaan=" . $id . " ORDER BY tgl_akhir_kontrak DESC limit 1";
                                                                 $cekkontrak = mysqli_query($conn, $sql);
                                                                 $jml_kontrak = mysqli_num_rows($cekkontrak);

                                                                 if ($jml_kontrak > 0) {
                                                                      $rw = mysqli_fetch_assoc($cekkontrak);
                                                                      $now = date('Y-m-d');
                                                                      $tgl_akhir_kontrak = date('Y-m-d', strtotime($rw['tgl_akhir_kontrak']));
                                                                      if ($tgl_akhir_kontrak < $now) {
                                                                           $stt_kontrak = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-warning'>EXP</span></td>";
                                                                      } else {
                                                                           $stt_kontrak = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-primary'>A</span></td>";
                                                                      }
                                                                 } else {
                                                                      $stt_kontrak = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                 }

                                                                 //========================= pjo terbaru ==================================

                                                                 $sql = "SELECT * from vw_pjo_perusahaan WHERE id_m_perusahaan=" . $id . " ORDER BY tgl_akhir_pjo DESC limit 1";
                                                                 $cekpjo = mysqli_query($conn, $sql);
                                                                 $jml_pjo = mysqli_num_rows($cekpjo);

                                                                 if ($jml_pjo > 0) {
                                                                      $rw = mysqli_fetch_assoc($cekpjo);
                                                                      $now = date('Y-m-d');
                                                                      $tgl_akhir_pjo = date('Y-m-d', strtotime($rw['tgl_akhir_pjo']));
                                                                      if ($tgl_akhir_pjo < $now) {
                                                                           $stt_pjo = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-warning'>EXP</span></td>";
                                                                      } else {
                                                                           $stt_pjo = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-primary'>A</span></td>";
                                                                      }
                                                                 } else {
                                                                      $stt_pjo = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                 }

                                                                 $no++;
                                                                 echo "<tr class='rataTengah'>";
                                                                 echo "<td class='align-middle' style='width:1%;text-align:center'>";
                                                                 echo "<div class='dropdown dropleft'>";
                                                                 echo "<button type='button' class='btn btn-primary btn-sm' aria-haspopup='true' title='Aksi' data-toggle='dropdown' aria-expanded='false'> ... </button> ";
                                                                 echo "<button id='" . $auth_m_per . "' type='button' class='btn btn-danger btn-sm hpsStrPer' title='Hapus'><i class='fas fa-trash-alt'></i></button> ";
                                                                 echo "<button id='" . $auth_m_per . "' type='button' class='btn btn-success btn-sm editStrPer' title='Edit'><i class='fas fa-edit'></i></button> ";
                                                                 echo "<div class='dropdown-menu'>";
                                                                 echo "<a id='" . $auth_m_per . "' class='dropdown-item btnDetailStrPer' title ='Detail Perusahaan' href='#!'>Detail</a>";
                                                                 echo "<a id='" . $auth_m_per . "' class='dropdown-item btnRK3LStrPer' title ='Rencana Keselamatan, Kesehatan Kerja dan Lingkungan (RK3L)' href='#!'>RK3L</a>";
                                                                 echo "<a id='" . $auth_m_per . "' class='dropdown-item btnIUJPStrPer' title ='Izin Usaha Jasa Pertambangan (IUJP)' href='#!'>IUJP</a>";
                                                                 echo "<a id='" . $auth_m_per . "' class='dropdown-item btnSIOStrPer' title ='Surat Izin Operasi (SIO)' href='#!'>SIO</a>";
                                                                 echo "<a id='" . $auth_m_per . "' class='dropdown-item btnKontrakStrPer' title ='Kontrak' href='#!'>Kontrak</a>";
                                                                 echo "<a id='" . $auth_m_per . "' class='dropdown-item btnPJOStrPer' title ='Penanggung Jawab Operasional (PJO)'href='#!'>PJO</a>";
                                                                 echo "</div>";
                                                                 echo "</div>";
                                                                 echo "</td>";
                                                                 echo "<td class='align-middle' style='text-align:center;width:5%;'>" . $no . "</td>";
                                                                 echo "<td class='align-middle' title='" . $nama_per . " | " . $kode_per . "' style='color:red;width:27%;'><b>" . $nama_m_per . " | " . $kode_per . "</b></td>";
                                                                 echo "<td class='align-middle' style='width: 8px;'>" . $jenis_per . "</td>";

                                                                 if ($url_rk3l == null) {
                                                                      echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                 } else {
                                                                      echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-success'>A</span></td>";
                                                                 }

                                                                 echo $stt_izin;
                                                                 echo $stt_sio;
                                                                 echo $stt_kontrak;
                                                                 echo $stt_pjo;
                                                                 echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $tgl_buat . "</td>";
                                                                 echo "</tr>";
                                                            }
                                                       }

                                                       function GetStruktur($idparent)
                                                       {

                                                            $servername = "localhost";
                                                            $username = "root";
                                                            $password = "";
                                                            $dbname = "db_kary";
                                                            $conn = mysqli_connect($servername, $username, $password, $dbname);

                                                            static $space;
                                                            $sql = "SELECT * from vw_m_prs WHERE id_parent=" . $idparent . " ORDER BY id_m_perusahaan ASC";
                                                            $result = mysqli_query($conn, $sql);
                                                            $no = 1;
                                                            $id = 0;
                                                            if (mysqli_num_rows($result) > 0) {
                                                                 $space .= "&roarr;";

                                                                 while ($row = mysqli_fetch_assoc($result)) {
                                                                      $auth_m_per = $row["auth_m_perusahaan"];
                                                                      $id = $row["id_m_perusahaan"];
                                                                      $nama_per = $row["nama_perusahaan"];
                                                                      $kode_per = $row["kode_perusahaan"];
                                                                      $jenis_per = $row["jenis_perusahaan"];
                                                                      $nama_m_per = $row["nama_m_perusahaan"];
                                                                      $url_rk3l = $row["url_rk3l"];
                                                                      $tgl_buat = date('d-M-Y', strtotime($row["tgl_buat"]));

                                                                      //========================= izin terbaru ==================================

                                                                      $sql = "SELECT * from vw_izin_perusahaan WHERE id_m_perusahaan=" . $id . " ORDER BY tgl_akhir_izin DESC limit 1";
                                                                      $cekizin = mysqli_query($conn, $sql);
                                                                      $jml_izin = mysqli_num_rows($cekizin);

                                                                      if ($jml_izin > 0) {
                                                                           $rw = mysqli_fetch_assoc($cekizin);
                                                                           $now = date('Y-m-d');
                                                                           $tgl_akhir_izin = date('Y-m-d', strtotime($rw['tgl_akhir_izin']));
                                                                           if ($tgl_akhir_izin < $now) {
                                                                                $stt_izin = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-warning'>EXP</span></td>";
                                                                           } else {
                                                                                $stt_izin = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-primary'>A</span></td>";
                                                                           }
                                                                      } else {
                                                                           $stt_izin = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                      }

                                                                      //========================= sio terbaru ==================================

                                                                      $sql = "SELECT * from vw_sio_perusahaan WHERE id_m_perusahaan=" . $id . " ORDER BY tgl_akhir_sio DESC limit 1";
                                                                      $ceksio = mysqli_query($conn, $sql);
                                                                      $jml_sio = mysqli_num_rows($ceksio);

                                                                      if ($jml_sio > 0) {
                                                                           $rw = mysqli_fetch_assoc($ceksio);
                                                                           $now = date('Y-m-d');
                                                                           $tgl_akhir_sio = date('Y-m-d', strtotime($rw['tgl_akhir_sio']));
                                                                           if ($tgl_akhir_sio < $now) {
                                                                                $stt_sio = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-warning'>EXP</span></td>";
                                                                           } else {
                                                                                $stt_sio = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-primary'>A</span></td>";
                                                                           }
                                                                      } else {
                                                                           $stt_sio = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                      }

                                                                      //========================= sio terbaru ==================================

                                                                      $sql = "SELECT * from vw_kontrak_perusahaan WHERE id_m_perusahaan=" . $id . " ORDER BY tgl_akhir_kontrak DESC limit 1";
                                                                      $cekkontrak = mysqli_query($conn, $sql);
                                                                      $jml_kontrak = mysqli_num_rows($cekkontrak);

                                                                      if ($jml_kontrak > 0) {
                                                                           $rw = mysqli_fetch_assoc($cekkontrak);
                                                                           $now = date('Y-m-d');
                                                                           $tgl_akhir_kontrak = date('Y-m-d', strtotime($rw['tgl_akhir_kontrak']));
                                                                           if ($tgl_akhir_kontrak < $now) {
                                                                                $stt_kontrak = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-warning'>EXP</span></td>";
                                                                           } else {
                                                                                $stt_kontrak = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-primary'>A</span></td>";
                                                                           }
                                                                      } else {
                                                                           $stt_kontrak = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                      }

                                                                      //========================= pjo terbaru ==================================

                                                                      $sql = "SELECT * from vw_pjo_perusahaan WHERE id_m_perusahaan=" . $id . " ORDER BY tgl_akhir_pjo DESC limit 1";
                                                                      $cekpjo = mysqli_query($conn, $sql);
                                                                      $jml_pjo = mysqli_num_rows($cekpjo);

                                                                      if ($jml_pjo > 0) {
                                                                           $rw = mysqli_fetch_assoc($cekpjo);
                                                                           $now = date('Y-m-d');
                                                                           $tgl_akhir_pjo = date('Y-m-d', strtotime($rw['tgl_akhir_pjo']));
                                                                           if ($tgl_akhir_pjo < $now) {
                                                                                $stt_pjo = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-warning'>EXP</span></td>";
                                                                           } else {
                                                                                $stt_pjo = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-primary'>A</span></td>";
                                                                           }
                                                                      } else {
                                                                           $stt_pjo = "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                      }

                                                                      echo "<tr >";

                                                                      if ($idparent == 0) {

                                                                           echo "<td class='align-middle' style='width:5%;text-align:center'>";
                                                                           echo "<div class='dropdown dropleft'>";
                                                                           echo "<button type='button' class='btn btn-primary btn-sm' aria-haspopup='true' title='Aksi' data-toggle='dropdown' aria-expanded='false'> ... </button> ";
                                                                           echo "<button id='" . $auth_m_per . "' type='button' class='btn btn-danger btn-sm hpsStrPer' title='Hapus'><i class='fas fa-trash-alt'></i></button> ";
                                                                           echo "<button id='" . $auth_m_per . "' type='button' class='btn btn-success btn-sm editStrPer' title='Edit'><i class='fas fa-edit'></i></button> ";
                                                                           echo "<div class='dropdown-menu'>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnDetailStrPer' title ='Detail Perusahaan' href='#!'>Detail</a>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnRK3LStrPer' title ='Rencana Keselamatan, Kesehatan Kerja dan Lingkungan (RK3L)' href='#!'>RK3L</a>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnIUJPStrPer' title ='Izin Usaha Jasa Pertambangan (IUJP)' href='#!'>IUJP</a>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnSIOStrPer' title ='Surat Izin Operasi (SIO)' href='#!'>SIO</a>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnKontrakStrPer' title ='Kontrak' href='#!'>Kontrak</a>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnPJOStrPer' title ='Penanggung Jawab Operasional (PJO)'href='#!'>PJO</a>";
                                                                           echo "</div>";
                                                                           echo "</div>";
                                                                           echo "</td>";
                                                                           echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $no++ . "." . "</td>";
                                                                           echo "<td class='align-middle' title='" . $nama_per . " | " . $kode_per . "' style='color:red;width:27%;'><b>" . $nama_m_per . " | " . $kode_per . "</b></td>";
                                                                           echo "<td class='align-middle' style='width:8%;'>" . $jenis_per . "</td>";
                                                                           if ($url_rk3l == null) {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                           } else {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-success'>A</span></td>";
                                                                           }
                                                                           echo $stt_izin;
                                                                           echo $stt_sio;
                                                                           echo $stt_kontrak;
                                                                           echo $stt_pjo;
                                                                      } else {
                                                                           echo "<td class='align-middle' style='width:5%;text-align:center'>";
                                                                           echo "<div class='dropdown dropleft'>";
                                                                           echo "<button type='button' class='btn btn-primary btn-sm' aria-haspopup='true' title='Aksi' data-toggle='dropdown' aria-expanded='false'> ... </button> ";
                                                                           echo "<button id='" . $auth_m_per . "' type='button' class='btn btn-danger btn-sm hpsStrPer' title='Hapus'><i class='fas fa-trash-alt'></i></button> ";
                                                                           echo "<button id='" . $auth_m_per . "' type='button' class='btn btn-success btn-sm editStrPer' title='Edit'><i class='fas fa-edit'></i></button> ";
                                                                           echo "<div class='dropdown-menu'>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnDetailStrPer' title ='Detail Perusahaan' href='#!'>Detail</a>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnRK3LStrPer' title ='Rencana Keselamatan, Kesehatan Kerja dan Lingkungan (RK3L)' href='#!'>RK3L</a>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnIUJPStrPer' title ='Izin Usaha Jasa Pertambangan (IUJP)' href='#!'>IUJP</a>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnSIOStrPer' title ='Surat Izin Operasi (SIO)' href='#!'>SIO</a>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnKontrakStrPer' title ='Kontrak' href='#!'>Kontrak</a>";
                                                                           echo "<a id='" . $auth_m_per . "' class='dropdown-item btnPJOStrPer' title ='Penanggung Jawab Operasional (PJO)'href='#!'>PJO</a>";
                                                                           echo "</div>";
                                                                           echo "</div>";
                                                                           echo "</td>";
                                                                           echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $no++ . "</td>";
                                                                           if ($jenis_per == "CONTRACTOR") {
                                                                                echo "<td class='align-middle text-primary' title='" . $nama_m_per . " | " . $kode_per . "' style='width:27%;'><b>" . $space . " " . $nama_m_per . " | " . $kode_per . "</b></td>";
                                                                           } else {
                                                                                echo "<td class='align-middle' title='" . $nama_m_per . "' style='width:27%;'><b>" . $space . " " . $nama_m_per . " | " . $kode_per . "</b></td>";
                                                                           }
                                                                           echo "<td class='align-middle' style='width:8%;'>" . $jenis_per . "</td>";
                                                                           if ($url_rk3l == null) {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                           } else {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-success'>A</span></td>";
                                                                           }
                                                                           echo $stt_izin;
                                                                           echo $stt_sio;
                                                                           echo $stt_kontrak;
                                                                           echo $stt_pjo;
                                                                      }

                                                                      echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $tgl_buat . "</td>";
                                                                      echo "</tr>";

                                                                      GetStruktur($id);
                                                                 }

                                                                 $space = substr($space, 0, strlen($space) - 7);
                                                            }

                                                            mysqli_close($conn);
                                                       }

                                                       GetStruktur($idperusahaan);

                                                       ?>
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
<div class="modal fade" id="mdlDetailStrPer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document" style="margin-left: auto; margin-right: auto;max-width:80%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-asterisk"></i><span id="jdlDetailStrPer"> DETAIL STRUKTUR PERUSAHAAN</span></h5>
               </div>
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert alert-danger errormsgdetper animate__animated animate__bounce d-none mb-3"></div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="kodeMperusahaan">Perusahaan Utama :</label>
                                   <h5 id="mainCon">Perusahaan Utama</h5>
                              </div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="kodeMperusahaan">Perusahaan Subcontractor :</label>
                                   <h5 id="subCon">Perusahaan Subcontractor</h5>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                              <hr>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
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
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <label for="" class="text-danger font-italic font-weight-bold">Izin Usaha Jasa Pertambangan (IUJP) :</label>
                              <div class="row">
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="NoIUJP">No. IUJP :</label>
                                             <h5 id="noIUJP">-</h5>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglIUJP">Masa Aktif :</label>
                                             <h5 id="tglIUJP">-</h5>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="ketIUJP">Keterangan :</label>
                                             <h6 id="ketIUJP">-</h6>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <hr>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12 border-right">
                              <label for="" class="text-danger font-italic font-weight-bold">Surat Izin Operasional (SIO) :</label>
                              <div class="row">
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="noSIO">No. SIO :</label>
                                             <h5 id="noSIO">-</h5>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglSIO">Masa Aktif :</label>
                                             <h5 id="tglSIO">-</h5>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="ketSIO">Keterangan :</label>
                                             <h6 id="ketSIO">-</h6>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <label for="kodeMperusahaan" class="text-danger font-italic font-weight-bold">Kontrak :</label>
                              <div class="row">
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="noKontrak">No. Kontrak :</label>
                                             <h5 id="noKontrak">-</h5>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglKontrak">Masa Aktif :</label>
                                             <h5 id="tglKontrak">-</h5>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="ketKontrak">Keterangan :</label>
                                             <h6 id="ketKontrak">-</h6>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <hr>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <label for="" class="text-danger font-italic font-weight-bold">Penanggung Jawab Operasional (PJO) :</label>
                              <div id="tblPJODetail" class="data"></div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="row">
                                   <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                             <label for="statStr">Status Perusahaan :</label>
                                             <h5 id="statStr">-</h5>
                                        </div>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglBuat">Tgl. Dibuat :</label>
                                             <h5 id="tglBuat">-</h5>
                                        </div>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglBuat">Tgl. Diedit :</label>
                                             <h5 id="tglEdit">-</h5>
                                        </div>
                                   </div>
                                   <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="form-group">
                                             <label for="namaBuat">Pembuat :</label>
                                             <h5 id="namaBuat">-</h5>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnCancelStrPer" id="btnCancelStrPer" data-dismiss="modal" class="btn font-weight-bold btn-warning">Selesai</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlUploadRK3L" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:80%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Upload Rencana Keselamatan, Kesehatan Kerja dan Lingkungan (RK3L) </h5>
               </div>
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert alert-danger errormsgRK3L animate__animated animate__bounce d-none mb-3"></div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="mainConRK3L">Perusahaan Utama :</label>
                                   <h5 id="mainConRK3L">Perusahaan Utama</h5>
                                   <span class="7c7dj3hn7k2j7n8j3g7j34 d-none"></span>
                              </div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="subConRK3L">Perusahaan Subcontractor :</label>
                                   <h5 id="subConRK3L">Perusahaan Subcontractor</h5>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                              <hr>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div>
                                   <h6 class="text-danger font-italic">Catatan : Upload RK3L dalam format pdf, Ukuran maksimal 500 kb.</h6>
                              </div>
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="uploadRK3L">Upload RK3L :</label>
                                             <input type="file" class="form-control" id="uploadRK3L" name="uploadRK3L" value="">
                                             <small class="erruploadRK3L text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnUploadRK3L" id="btnUploadRK3L" class="btn font-weight-bold btn-primary">Upload</button>
                    <button type="button" name="btnCancelRK3L" id="btnCancelRK3L" data-dismiss="modal" class="btn font-weight-bold btn-success">Selesai</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlUploadIUJP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:80%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Upload Izin Usaha Jasa Pertambangan (IUJP)</h5>
               </div>
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert alert-danger errormsgIUJP animate__animated animate__bounce d-none mb-3"></div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="mainConIUJP">Perusahaan Utama :</label>
                                   <h5 id="mainConIUJP">Perusahaan Utama</h5>
                                   <span class="7k23n78j23b7l34c77s4f5h7 d-none"></span>
                              </div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="subConIUJP">Perusahaan Subcontractor :</label>
                                   <h5 id="subConIUJP">Perusahaan Subcontractor</h5>
                                   <small class="errsubcon text-danger font-italic font-weight-bold"></small><br>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                              <hr>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="alert alert-danger errormsgiujp animate__animated animate__bounce d-none mb-3"></div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="NoIUJP">No. IUJP :</label>
                                             <input type="text" class="form-control" id="noIUJPnew" name="noIUJPnew" value="">
                                             <small class="errnoIUJP text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                   </div>
                                   <div class="col-lg-3 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglIUJP">Tgl. Aktif :</label>
                                             <input type="date" class="form-control" id="tglIUJPnew" name="tglIUJPnew" value="">
                                             <small class="errtglIUJP text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                   </div>
                                   <div class="col-lg-3 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglAkhirIUJP">Tgl. Berakhir :</label>
                                             <input type="date" class="form-control" id="tglAkhirIUJPnew" name="tglAkhirIUJPnew" value="">
                                             <small class="errtglAkhirIUJP text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="ketIUJP">Keterangan :</label>
                                             <textarea id='ketIUJP' name='ketIUJP' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div>
                                             <h6 class="text-danger font-italic">Catatan : Upload IUJP dalam format pdf, Ukuran maksimal 100 kb.</h6>
                                        </div>
                                        <div class="row">
                                             <div class="col-lg-6 col-md-12 col-sm-12">
                                                  <div class="form-group">
                                                       <label for="uploadIUJP">Upload IUJP :</label>
                                                       <input type="file" class="form-control" id="uploadIUJP" name="uploadIUJP" value="">
                                                       <small class="erruploadIUJP text-danger font-italic font-weight-bold"></small><br>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnUploadIUJP" id="btnUploadIUJP" class="btn font-weight-bold btn-primary">Upload</button>
                    <button type="button" name="btnCancelIUJP" id="btnCancelIUJP" data-dismiss="modal" class="btn font-weight-bold btn-success">Selesai</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlUploadSIO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:80%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Upload Surat Izin Operasional (SIO)</h5>
               </div>
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert alert-danger errormsgSIO animate__animated animate__bounce d-none mb-3"></div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="mainConSIO">Perusahaan Utama :</label>
                                   <h5 id="mainConSIO">Perusahaan Utama</h5>
                                   <span class="9k7j8h5g4h9j0k2g3b5g3g d-none"></span>
                              </div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="subConSIO">Perusahaan Subcontractor :</label>
                                   <h5 id="subConSIO">Perusahaan Subcontractor</h5>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                              <hr>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="alert alert-danger errormsgsio animate__animated animate__bounce d-none mb-3"></div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="NoSIO">No. SIO :</label>
                                             <input type="text" class="form-control" id="noSionew" name="noSionew" value="">
                                             <small class="errnosionew text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                   </div>
                                   <div class="col-lg-3 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglSIO">Tgl. Aktif :</label>
                                             <input type="date" class="form-control" id="tglAktifSIO" name="tglAktifSIO" value="">
                                             <small class="errtglawalsionew text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                   </div>
                                   <div class="col-lg-3 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglSIO">Tgl. Berakhir :</label>
                                             <input type="date" class="form-control" id="tglAkhirSIO" name="tglAkhirSIO" value="">
                                             <small class="errtglakhirsionew text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="ketSIO">Keterangan :</label>
                                             <textarea id='ketSIO' name='ketSIO' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div>
                                             <h6 class="text-danger font-italic">Catatan : Upload SIO dalam format pdf, Ukuran maksimal 100 kb.</h6>
                                        </div>
                                        <div class="row">
                                             <div class="col-lg-6 col-md-12 col-sm-12">
                                                  <div class="form-group">
                                                       <label for="uploadSIO">Upload SIO :</label>
                                                       <input type="file" class="form-control" id="uploadSIO" name="uploadSIO" value="">
                                                       <small class="erruploadsionew text-danger font-italic font-weight-bold"></small><br>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnUploadSIO" id="btnUploadSIO" class="btn font-weight-bold btn-primary">Upload Data</button>
                    <button type="button" name="btnCancelSIO" id="btnCancelSIO" data-dismiss="modal" class="btn font-weight-bold btn-success">Selesai</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlUploadKontrak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:80%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Upload Kontrak</h5>
               </div>
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert alert-danger errormsgKontrak animate__animated animate__bounce d-none mb-3"></div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="mainConKontrak">Perusahaan Utama :</label>
                                   <h5 id="mainConKontrak">Perusahaan Utama</h5>
                                   <span class="2e3r4t5y6u7i8o0o9i8u7y6t d-none"></span>
                              </div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="subConKontrak">Perusahaan Subcontractor :</label>
                                   <h5 id="subConKontrak">Perusahaan Subcontractor</h5>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                              <hr>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="alert alert-danger errormsgkontrak animate__animated animate__bounce d-none mb-3"></div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="NoKontrak">No. Kontrak :</label>
                                             <input type="text" class="form-control" id="noKontraknew" name="noKontraknew" value="">
                                             <small class="errnokontraknew text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                   </div>
                                   <div class="col-lg-3 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglKontrak">Tgl. Aktif :</label>
                                             <input type="date" class="form-control" id="tglAktifKontrak" name="tglAktifKontrak" value="">
                                             <small class="errtglkontraknew text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                   </div>
                                   <div class="col-lg-3 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="tglKontrak">Tgl. Berakhir :</label>
                                             <input type="date" class="form-control" id="tglAkhirKontrak" name="tglAkhirKontrak" value="">
                                             <small class="errtglakhirkontraknew text-danger font-italic font-weight-bold"></small><br>
                                        </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                             <label for="ketKontrak">Keterangan :</label>
                                             <textarea id='ketKontrak' name='ketKontrak' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div>
                                             <h6 class="text-danger font-italic">Catatan : Upload Kontrak dalam format pdf, Ukuran maksimal 100 kb.</h6>
                                        </div>
                                        <div class="row">
                                             <div class="col-lg-6 col-md-12 col-sm-12">
                                                  <div class="form-group">
                                                       <label for="uploadKontrak">Upload Kontrak :</label>
                                                       <input type="file" class="form-control" id="uploadKontrak" name="uploadKontrak" value="">
                                                       <small class="erruploadkontraknew text-danger font-italic font-weight-bold"></small><br>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnUploadKontrak" id="btnUploadKontrak" class="btn font-weight-bold btn-primary">Upload</button>
                    <button type="button" name="btnCancelKontrak" id="btnCancelKontrak" data-dismiss="modal" class="btn font-weight-bold btn-success">Selesai</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlUploadPJO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document" style="margin-left: auto; margin-right: auto;max-width:80%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Penanggung Jawab Operasional (PJO)</h5>
               </div>
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="mainConPJO">Perusahaan Utama :</label>
                                   <h5 id="mainConPJO">Perusahaan Utama</h5>
                                   <span class="2d3f4g5h6j7k8j6b4vec5v d-none"></span>
                              </div>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="subConPJO">Perusahaan Subcontractor :</label>
                                   <h5 id="subConPJO">Perusahaan Subcontractor</h5>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                              <hr>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                        <div class="alert alert-danger errormsgpjo animate__animated animate__bounce d-none mb-3"></div>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                        <label for="nopjonew">No. Pengesahan :</label>
                                        <input id='nopjonew' name='nopjonew' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small class="errnopjonew text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                        <label for="tglakhifpjonew">Tanggal Aktif :</label>
                                        <input id='tglakhifpjonew' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small class="errtglaktifpjonew text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                        <label for="tglakhirpjonew">Tanggal Berakhir :</label>
                                        <input id='tglakhirpjonew' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small class="errtglakhirpjonew text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                        <label for="lokkerpjonew">Lokasi Kerja :</label>
                                        <select id='lokkerpjonew' name='lokkerpjonew' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                             <option value="">-- PILIH LOKASI KERJA --</option>
                                        </select>
                                        <small class="errlokkerpjonew text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <hr>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-3">
                                        <label for="caripjonew">Cari Data PJO :</label>
                                        <div class="input-group">
                                             <input id='caripjonew' name='caripjonew' type="text" placeholder="Ketikkan No. KTP / NIK / Nama Karyawan" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""><br>
                                        </div>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                        <label for="ktppjonew">No. KTP :</label>
                                        <input id='ktppjonew' name='ktppjonew' type="number" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small class="errktppjonew text-danger font-italic font-weight-bold"></small>
                                        <span class="ccv445bb66n7uj8ikmhg23fsdf d-none"></span><br>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                                        <label for="nikpjonew">NIK :</label>
                                        <input id='nikpjonew' name='nikpjonew' type="number" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small class="errnikpjonew text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                        <label for="namapjonew">Nama Lengkap:</label>
                                        <input id='namapjonew' name='namapjonew' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                        <small class="errnamapjonew text-danger font-italic font-weight-bold"></small><br>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12 mb-3" style="margin-top:-5px;">
                                        <a href="#!" id="btnResetKaryNew" class="btn btn-success font-weight-bold mt-3">Reset Karyawan</a>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <label for="ketpjonew">Keterangan :</label>
                                        <textarea id='ketpjonew' name='ketpjonew' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value=""></textarea><br>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-3 ">
                                        <div>
                                             <h6 class="text-danger font-italic">Catatan : Upload file pengesahan PJO dalam format pdf, Ukuran maksimal 100 kb.</h6>
                                        </div>
                                        <div class="form-group mb-3">
                                             <label for="filepjonew"><b>Upload Pengesahan PJO</b> :</label>
                                             <input type="file" class="form-control-file" id="filepjonew">
                                             <small class="errfilepjonew text-danger font-italic font-weight-bold"></small>
                                        </div>
                                        <a href="#!" id="refreshPJOnew" class='btn btn-danger font-weight-bold mt-3 ml-2'>Reset PJO</a>
                                        <a href="#!" id="addSimpanPJOnew" class="btn btn-primary font-weight-bold mt-3">Simpan PJO</a>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                        <hr>
                                        <div id="idpjonew" class="data"></div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnCancelPJO" id="btnCancelPJO" data-dismiss="modal" class="btn font-weight-bold btn-success">Selesai</button>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="mdlEditStrPer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:80%;">
          <div class="modal-content">
               <div class="modal-header bg-c-blue">
                    <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-project-diagram"></i><span id="jdlEditStrPer">Edit Struktur Perusahaan</span></h5>
               </div>
               <div style="background-color:rgba(240,240,240,1);" class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="alert alert-danger errormsgStrPerEdit animate__animated animate__bounce d-none mb-3"></div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="mainConStrPerEdit">Perusahaan Utama :</label>
                                   <h5 id="mainConStrPerEdit">Perusahaan Utama</h5>
                              </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: -20px;">
                              <hr>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="form-group">
                                   <label for="namaPerEdit">Nama Perusahaan Subcontractor :</label>
                                   <input type="text" class="form-control" id="namaPerEdit" name="namaPerEdit" value="">
                                   <small class="errornamaperedit text-danger font-italic font-weight-bold"></small><br>
                                   <span class="7uik4gsdm89okl23s6j4h3c d-none"></span>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer m-3">
                    <button type="button" name="btnUpdateStrPerEdit" id="btnUpdateStrPerEdit" class="btn font-weight-bold btn-primary">Simpan Data</button>
                    <button type="button" name="btnCancelStrPerEdit" id="btnCancelStrPerEdit" data-dismiss="modal" class="btn font-weight-bold btn-success">Selesai</button>
               </div>
          </div>
     </div>
</div>