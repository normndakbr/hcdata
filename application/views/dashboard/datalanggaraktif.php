<div class="table-responsive">
     <table id="tbmLanggar" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
          <thead>
               <tr class="font-weight-boldtext-white">
                    <th style="text-align:center;width:1%;">No.</th>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Departemen</th>
                    <th>Tgl. Pelanggaran</th>
                    <th>Punishment</th>
                    <th>Tgl. Akhir Punish</th>
                    <th>Status</th>
                    <th style="text-align:center;">Perusahaan</th>
                    <th style="text-align:center;">Proses</th>
               </tr>
          </thead>
          <tbody>
               <?php

               $dtlanggar = $this->dsmod->data_langgar_aktif($prs);
               if (!empty($dtlanggar)) {
                    $no = 1;
                    $now = date('Y-m-d');

                    foreach ($dtlanggar as $list) {
                         if ($list->tgl_akhir_langgar > $now) {
                              $status = "<span class='btn btn-success btn-sm' style='cursor:text;'>AKTIF</span>";
                         } else {
                              $status = "<span class='btn btn-danger btn-sm' style='cursor:text;'>NONAKTIF</span>";
                         }

                         echo '<tr>';
                         echo '<td class="text-center align-middle">' . $no++ . '</td>';
                         echo '<td class="text-center align-middle">' . $list->no_nik . '</td>';
                         echo '<td class="align-middle">' . $list->nama_lengkap . '</td>';
                         echo '<td class="align-middle">' . $list->depart . '</td>';
                         echo '<td class="align-middle">' . date('d-M-Y', strtotime($list->tgl_langgar)) . '</td>';
                         echo '<td class="align-middle">' . $list->langgar_jenis . '</td>';
                         echo '<td class="align-middle">' . date('d-M-Y', strtotime($list->tgl_akhir_langgar)) . '</td>';
                         echo '<td class="align-middle">' . $status . '</td>';
                         echo '<td class="align-middle">' . $list->kode_perusahaan . '</td>';
                         echo '<td class="text-center align-middle"><a href="' . base_url('pelanggaran/detail/' . $list->auth_langgar) . '" target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-asterisk"></i></a></td>';
                         echo '</tr>';
                    }
               }


               ?>
          </tbody>
     </table>
</div>

<script>
     tbDataLanggar = $("#tbmLanggar").DataTable();

     $.LoadingOverlay('hide');
</script>