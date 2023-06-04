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
                                        <a id="btnRefreshStruktur" href="<?= base_url('struktur'); ?>" class="btn btn-primary font-weight-bold">Refresh / Data</a>
                                        <a id="btnNewStruktur" href="<?= base_url('struktur/new'); ?>" class="btn btn-success font-weight-bold">Tambah Data</a>
                                   </div>
                                   <div class="alert alert-danger err_psn_struktur animate__animated animate__bounce d-none"></div>
                              </div>
                              <div class="row">
                                   <div class="col-lg-12">
                                        <div class="table-responsive">
                                             <table id="tbmStruktur" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                                  <thead>
                                                       <tr class="font-weight-boldtext-white">
                                                            <th style="text-align:center;width:1%;">No.</th>
                                                            <th>PERUSAHAAN</th>
                                                            <th>JENIS</th>
                                                            <th>UIJP</th>
                                                            <th>SIO</th>
                                                            <th>KONTRAK</th>
                                                            <th>PJO</th>
                                                            <th>TGL. DIBUAT</th>
                                                            <th style="text-align:center;">Proses</th>
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
                                                       $sql = "SELECT * from vw_m_perusahaan WHERE id_m_perusahaan=" . $idperusahaan . " ORDER BY id_m_perusahaan ASC";
                                                       $result = mysqli_query($conn, $sql);
                                                       if ($result) {
                                                            if (mysqli_num_rows($result) > 0) {
                                                                 $row = mysqli_fetch_assoc($result);
                                                                 $id = $row["id_m_perusahaan"];
                                                                 $nama_per = $row["nama_perusahaan"];
                                                                 $jenis_per = $row["jenis_perusahaan"];
                                                                 $no_jenis_per = $row["no_jenis_perusahaan"];
                                                                 $no_izin = $row["no_izin_perusahaan"];
                                                                 $no_sio = $row["no_sio_perusahaan"];
                                                                 $kode_per = $row["kode_perusahaan"];
                                                                 $nama_m_per = $row["nama_m_perusahaan"];
                                                                 $tgl_buat = date('d-M-Y', strtotime($row["tgl_buat"]));

                                                                 $no++;
                                                                 echo "<tr class='rataTengah'>";
                                                                 echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $no . "</td>";
                                                                 echo "<td class='align-middle' title='" . $nama_per . "' style='color:red;width:27%;'><b>" . $nama_m_per . "</b></td>";
                                                                 echo "<td class='align-middle' style='width: 8px;'>" . $jenis_per . "</td>";
                                                                 if ($no_izin == null) {
                                                                      echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                 } else {
                                                                      echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-success'>A</span></td>";
                                                                 }
                                                                 if ($no_sio == null) {
                                                                      echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                 } else {
                                                                      echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-success'>A</span></td>";
                                                                 }
                                                                 echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                 echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                 echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $tgl_buat . "</td>";
                                                                 echo "<td class='align-middle' style='width:1%;text-align:center'>";
                                                                 echo "<button class='btn btn-primary btn-sm' title='Detail'><i class='fas fa-asterisk'></i></button> ";
                                                                 echo "<button class='btn btn-warning btn-sm' title='Edit'><i class='fas fa-edit'></i></button> ";
                                                                 echo "<button class='btn btn-danger btn-sm' title='Hapus'><i class='fas fa-trash'></i></button> ";
                                                                 echo "</td>";
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
                                                            $sql = "SELECT * from vw_m_perusahaan WHERE id_parent=" . $idparent . " ORDER BY id_m_perusahaan ASC";

                                                            $result = mysqli_query($conn, $sql);
                                                            $no = 1;
                                                            $id = 0;
                                                            if (mysqli_num_rows($result) > 0) {
                                                                 $space .= "&roarr;";

                                                                 while ($row = mysqli_fetch_assoc($result)) {

                                                                      $id = $row["id_m_perusahaan"];
                                                                      $nama_per = $row["nama_perusahaan"];
                                                                      $jenis_per = $row["jenis_perusahaan"];
                                                                      $no_izin = $row["no_izin_perusahaan"];
                                                                      $no_sio = $row["no_sio_perusahaan"];
                                                                      $nama_m_per = $row["nama_m_perusahaan"];
                                                                      $tgl_buat = date('d-M-Y', strtotime($row["tgl_buat"]));

                                                                      echo "<tr >";

                                                                      if ($idparent == 0) {
                                                                           $no++;
                                                                           echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $no . "</td>";
                                                                           echo "<td class='align-middle' title='" . $nama_per . "' style='color:red;width:27%;'><b>" . $nama_m_per . "</b></td>";
                                                                           echo "<td class='align-middle' style='width:8%;'>" . $jenis_per . "</td>";
                                                                           if ($no_izin == null) {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                           } else {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-success'>A</span></td>";
                                                                           }
                                                                           if ($no_sio == null) {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                           } else {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-success'>A</span></td>";
                                                                           }
                                                                           echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                           echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                      } else {
                                                                           $no = "";
                                                                           echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $no . "</td>";
                                                                           if ($jenis_per == "CONTRACTOR") {
                                                                                echo "<td class='align-middle text-primary' title='" . $nama_m_per . "' style='width:27%;'><b>" . $space . " " . $nama_m_per . "</b></td>";
                                                                           } else {
                                                                                echo "<td class='align-middle' title='" . $nama_m_per . "' style='width:27%;'><b>" . $space . " " . $nama_m_per . "</b></td>";
                                                                           }
                                                                           echo "<td class='align-middle' style='width:8%;'>" . $jenis_per . "</td>";
                                                                           if ($no_izin == null) {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                           } else {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-success'>A</span></td>";
                                                                           }
                                                                           if ($no_sio == null) {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                           } else {
                                                                                echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-success'>A</span></td>";
                                                                           }
                                                                           echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                           echo "<td class='align-middle' style='text-align:center;width:1%;'><span class='btn btn-sm btn-danger'>TA</span></td>";
                                                                      }
                                                                      echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $tgl_buat . "</td>";
                                                                      echo "<td class='align-middle' style='width:1%;text-align:center'>";
                                                                      echo "<button class='btn btn-primary btn-sm' title='Detail'><i class='fas fa-asterisk'></i></button> ";
                                                                      echo "<button class='btn btn-warning btn-sm' title='Edit'><i class='fas fa-edit'></i></button> ";
                                                                      echo "<button class='btn btn-danger btn-sm' title='Hapus'><i class='fas fa-trash'></i></button> ";
                                                                      echo "</td>";
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