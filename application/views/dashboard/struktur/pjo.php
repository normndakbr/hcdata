<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
          <table id="tbmPJO" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
               <thead>
                    <tr>
                         <td style="width:1%;text-align:center;">NO.</td>
                         <td style="width:20%;font-style:bold;">NO. PENGESAHAN</td>
                         <td style="width:20%;font-style:bold;">NIK</td>
                         <td style="width:30%;font-style:bold;">NAMA</td>
                         <td style="width:15%;font-style:bold;">LOKASI</td>
                         <td style="width:10%;font-style:bold;">TGL. BERAKHIR</td>
                    </tr>
               </thead>
               <tbody>
                    <?php

                    if (!empty($pjo)) {
                         $n = 1;
                         foreach ($pjo as $list) {

                              $lokasi_pjo = $this->str->get_lokasi_pjo_byid($list->id_lokasi);

                              echo "<tr>";
                              echo "<td style='ext-align:center;width:1%;'>" . $n++ . "</td>";
                              echo "<td style='ext-align:center;width:20%;'>" . $list->no_pengesahan_pjo . "</td>";
                              echo "<td style='ext-align:center;width:20%;'>" . $list->no_nik . "</td>";
                              echo "<td style='ext-align:center;width:30%;'>" . $list->nama_lengkap . "</td>";
                              echo "<td style='ext-align:center;width:15%;'>" . $lokasi_pjo . "</td>";
                              echo "<td style='ext-align:center;width:10%;'>" . date('d-M-Y', strtotime($list->tgl_akhir_pjo)) . "</td>";
                              echo "<tr>";
                         }
                    } else {
                         echo  "<tr>";
                         echo "<td colspan='6' style='text-align:center;'> Tidak ada data</td>";
                         echo "</tr>";
                    }

                    ?>
               </tbody>
          </table>

          <hr>
     </div>
</div>