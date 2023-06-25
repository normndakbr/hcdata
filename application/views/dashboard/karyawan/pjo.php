<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
          <table id="tbmPJO" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
               <thead>
                    <tr>
                         <td style="width:1%;text-align:center;">NO.</td>
                         <td style="width:15%;font-style:bold;">NO. PENGESAHAN</td>
                         <td style="width:20%;font-style:bold;">NIK</td>
                         <td style="width:30%;font-style:bold;">NAMA</td>
                         <td style="width:15%;font-style:bold;">LOKASI</td>
                         <td style="width:10%;font-style:bold;">TGL. BERAKHIR</td>
                         <td style="width:9%;text-align:center;">PROSES</td>
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
                              echo "<td style='ext-align:center;width:15%;'>" . $list->no_pengesahan_pjo . "</td>";
                              echo "<td style='ext-align:center;width:15%;'>" . $list->no_nik . "</td>";
                              echo "<td style='ext-align:center;width:20%;'>" . $list->nama_lengkap . "</td>";
                              echo "<td style='ext-align:center;width:15%;'>" . $lokasi_pjo . "</td>";
                              echo "<td style='ext-align:center;width:10%;'>" . date('d-M-Y', strtotime($list->tgl_akhir_pjo)) . "</td>";
                              echo "<td style='ext-align:center;width:9%;'>";
                              echo "<a id='" . $list->auth_pjo_perusahaan . "' title='Tampilkan Lembar Pengesahan' href='" . base_url('struktur/pjoview/') . $list->auth_pjo_perusahaan . "' target='_blank' class='btn btn-primary btn-sm tampilkanPJO'><i class='fas fa-file-pdf'></i></a> ";
                              echo "<button id='" . $list->auth_pjo_perusahaan . "' title='Edit' class='btn btn-success btn-sm editPJO'><i class='fas fa-edit'></i></button> ";
                              echo "<button id='" . $list->auth_pjo_perusahaan . "' title='Hapus' class='btn btn-danger btn-sm hapusPJO'><i class='fas fa-eraser'></i></button> ";
                              echo "</td>";
                              echo "<tr>";
                         }
                    } else {
                         echo  "<tr>";
                         echo "<td colspan='7' style='text-align:center;'> Tidak ada data</td>";
                         echo "</tr>";
                    }

                    echo '<script>$("#idpjo").LoadingOverlay("hide");</script>';

                    ?>
               </tbody>
          </table>

          <hr>
     </div>
</div>