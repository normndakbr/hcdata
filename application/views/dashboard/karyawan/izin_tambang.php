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

                    if (!empty($unit_izin)) {
                         if ($unit_izin != 0) {

                              $n = 1;
                              foreach ($unit_izin as $list) {
                                   $id_unit = $list->id_izin_tambang_unit;
                                   $jenis_unit = $list->unit;
                                   $tipe_akses = $list->tipe_akses_unit;

                                   echo  "<tr>";
                                   echo "<td style='text-align:center;width:1%;'>" . $n++ . "</td>";
                                   echo "<td style=width:45%;'>" . $jenis_unit . "</td>";
                                   echo "<td style=width:45%;'>" . $tipe_akses . "</td>";
                                   echo "<td style='text-align:center;width:9%;'>";
                                   echo "<button id='" . $id_unit . "' class='btn btn-danger btn-sm hapus_unit' title='Hapus data unit' value='" . $jenis_unit . "'> <i class='fa fa-trash'></i> </button>";
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