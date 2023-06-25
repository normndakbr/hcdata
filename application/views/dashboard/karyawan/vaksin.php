<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
          <table id="tbmVaksin" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
               <thead>
                    <tr>
                         <td style="width:1%;text-align:center;">NO.</td>
                         <td style="width:45%;font-style:bold;">JENIS VAKSIN</td>
                         <td style="width:45%;font-style:bold;">NAMA VAKSIN</td>
                         <td style="width:45%;font-style:bold;">TANGGAL VAKSIN</td>
                         <td style="width:9%;text-align:center;">PROSES</td>
                    </tr>
               </thead>
               <tbody>
                    <?php

                    if (!empty($vaks)) {
                         $n = 1;
                         foreach ($vaks as $list) {
                              echo "<tr>";
                              echo "<td style='ext-align:center;width:1%;'>" . $n++ . "</td>";
                              echo "<td style='ext-align:center;width:40%;'>" . $list->vaksin_jenis . "</td>";
                              echo "<td style='ext-align:center;width:40%;'>" . $list->vaksin_nama . "</td>";
                              echo "<td style='ext-align:center;width:10%;'>" . date("d-M-Y", strtotime($list->tgl_vaksin)) . "</td>";
                              echo "<td style='ext-align:center;width:9%;'>";
                              echo "<button id='" . $list->auth_vaksin . "' class='btn btn-danger btn-sm hapusvks'>Hapus</button> ";
                              echo "</td>";
                              echo "<tr>";
                         }
                    } else {
                         echo  "<tr>";
                         echo "<td colspan='5' style='text-align:center;'> Tidak ada data</td>";
                         echo "</tr>";
                    }

                    echo '<script>$("#idvaksin").LoadingOverlay("hide");</script>';

                    ?>
               </tbody>
          </table>

          <hr>
     </div>
</div>