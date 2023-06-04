<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
          <table id="tbmIzinTambang" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
               <thead>
                    <tr>
                         <td style="width:1%;text-align:center;">NO.</td>
                         <td style="width:45%;font-style:bold;">UNIT</td>
                         <td style="width:45%;font-style:bold;">IZIN UNIT</td>
                         <td style="width:9%;text-align:center;">PROSES</td>
                    </tr>
               </thead>
               <tbody>
                    <?php

                    if ($this->session->has_userdata("unit_izin")) {
                         $unit_izin = $this->session->userdata("unit_izin_text");
                         if (!empty($unit_izin)) {
                              $n = 1;
                              $baris = explode("|", $unit_izin);
                              foreach ($baris as $data) {
                                   $item = explode("%", $data);
                                   $jenis_unit = $item[0];
                                   $tipe_akses = $item[1];

                                   echo  "<tr>";
                                   echo "<td style='text-align:center;width:1%;'>" . $n++ . "</td>";
                                   echo "<td style=width:45%;'>" . $jenis_unit . "</td>";
                                   echo "<td style=width:45%;'>" . $tipe_akses . "</td>";
                                   echo "<td style='text-align:center;width:9%;'>";
                                   echo "<button id=" . $jenis_unit . " class='btn btn-danger btn-sm' title='Hapus Sertifikasi' value='" . $jenis_unit . "'> <i class='fa fa-trash'></i> </button>";
                                   echo "</td>";
                                   echo "</tr>";
                              }
                         } else {
                              echo  "<tr>";
                              echo "<td colspan='4' style='text-align:center;'> Tidak ada unit</td>";
                              echo "</tr>";
                         }
                    } else {
                         echo  "<tr>";
                         echo "<td colspan='4' style='text-align:center;'> Tidak ada unit</td>";
                         echo "</tr>";
                    }

                    echo '<script>$("#idizintambang").LoadingOverlay("hide");</script>';
                    ?>
               </tbody>
          </table>

          <hr>
     </div>
</div>