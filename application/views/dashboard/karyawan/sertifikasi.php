<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
          <table id="tbmSertifikasi" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
               <thead>
                    <tr>
                         <td style="text-align:center;width:1%;">NO.</td>
                         <td style="text-align:center;width:35%;">JENIS SERTIFIKASI</td>
                         <td style="text-align:center;width:35%;">NO. SERTIFIKAT</td>
                         <td style="text-align:center;width:10%;">TGL. SERTIFIKASI</td>
                         <td style="text-align:center;width:10%;">TGL. EXPIRED</td>
                         <td style="text-align:center;width:9%;">PROSES</td>
                    </tr>
               </thead>
               <tbody>
                    <?php

                    if (!empty($sert)) {
                         $n = 1;
                         foreach ($sert as $list) {
                              echo "<tr>";
                              echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $n++ . "</td>";
                              echo "<td class='align-middle' style='width:35%;'>" . $list->jenis_sertifikasi . "</td>";
                              echo "<td class='align-middle' style='width:35%;'>" . $list->no_sertifikasi . "</td>";
                              echo "<td class='align-middle' style='width:10%;'>" . date("d-M-Y", strtotime($list->tgl_sertifikasi)) . "</td>";
                              echo "<td class='align-middle' style='width:10%;'>" . date("d-M-Y", strtotime($list->tgl_berakhir_sertifikasi)) . "</td>";
                              echo "<td class='align-middle' style='width:9%;'>";
                              echo "<button id=" . $list->auth_sertifikat . " class='btn btn-primary btn-sm detail_sertifikasi' value='" . $list->no_sertifikasi . "'><i class='fas fa-asterisk'></i></button> ";
                              echo "<a id=" . $list->auth_sertifikat . " class='btn btn-success btn-sm ' href ='" . base_url('karyawan/sertifikat/') . $list->auth_sertifikat . "' target='_blank' title='Tampilkan file sertifikat' value='" . $list->no_sertifikasi . "'> <i class='fas fa-file-alt'></i> </a> ";
                              echo "<button id=" . $list->auth_sertifikat . " class='btn btn-primary btn-sm upload_sertifikasi' value='" . $list->no_sertifikasi . "'><i class='fas fa-file-upload'></i></button> ";
                              echo "<button id=" . $list->auth_sertifikat . " class='btn btn-warning btn-sm edit_sertifikasi' value='" . $list->no_sertifikasi . "'><i class='fas fa-edit'></i></button> ";
                              echo "<button id=" . $list->auth_sertifikat . " class='btn btn-danger btn-sm hapus_sertifikasi' value='" . $list->no_sertifikasi . "'><i class='fas fa-trash'></i></button> ";
                              echo "</td>";
                              echo "<tr>";
                         }
                    } else {
                         echo  "<tr>";
                         echo "<td colspan='6' style='text-align:center;'> Tidak ada data</td>";
                         echo "</tr>";
                    }

                    echo '<script>$("#idsertifikat").LoadingOverlay("hide");</script>';

                    ?>
               </tbody>
          </table>
          <hr>
     </div>
</div>