<div class="table-responsive">
     <table id="tbmkarysum" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
          <thead>
               <tr class="font-weight-boldtext-white">
                    <th style="text-align:center;width:1%;">No.</th>
                    <th style="width:20%;">Kode</th>
                    <th style="width:80%;">Perusahaan</th>
                    <th style="text-align:center;width:9%;">Jumlah Kary.
                    </th>
                    <th class="none0" style="width:80%;">Detail :</th>
               </tr>
          </thead>
          <tbody>
               <?php
               if (!empty($kary_sum['data'])) {
                    $n = 1;
                    $jml = 0;
                    foreach ($kary_sum['data'] as $list) {
                         echo '<tr>';
                         echo '<td class="text-center font-weight-bold align-middle" style="text-align:center;width:1%;">' . $n++ . '</td>';
                         echo '<td class="align-middle" style="width:20%;">' . $list['kode_per'] . '</td>';
                         echo '<td class="align-middle" style="width:80%;">' . $list['nama_per'] . '</td>';
                         echo '<td class="text-right align-middle" style="text-align:right;width:%9;">' . $list['jml'] . '</td>';
               ?>
                         <td>
                              <div class="row">
                                   <div class="col-lg-6 border-right">
                                        <h5>Jumlah Kary. Berdasarkan status tinggal :</h5>
                                        <table id="tbmkarysum" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                             <thead>
                                                  <tr class="font-weight-bold text-white bg-primary">
                                                       <th style="text-align:center;width:1%;">No.</th>
                                                       <th style="width:90%;">Keterangan</th>
                                                       <th style="text-align:center;width:9%;">Jumlah Kary. </th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <tr>
                                                       <td>1</td>
                                                       <td>Resident</td>
                                                       <td><?= $list['r'] ?></td>
                                                  </tr>
                                                  <tr>
                                                       <td>2</td>
                                                       <td>Non Resident</td>
                                                       <td><?= $list['nr'] ?></td>
                                                  </tr>
                                             </tbody>
                                        </table>
                                   </div>
                                   <div class="col-lg-6">
                                        <h5>Jumlah Kary. berdasarkan lokasi penerimaan :</h5>
                                        <table id="tbmkarysum" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                             <thead class="bg-primary">
                                                  <tr class="font-weight-bold text-white">
                                                       <th style="text-align:center;width:1%;">No.</th>
                                                       <th style="width:90%;">Keterangan</th>
                                                       <th style="text-align:center;width:9%;">Jumlah Kary. </th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <tr>
                                                       <td>1</td>
                                                       <td>Lokal</td>
                                                       <td><?= $list['lkl'] ?></td>
                                                  </tr>
                                                  <tr>
                                                       <td>2</td>
                                                       <td>Non Lokal</td>
                                                       <td><?= $list['nlkl'] ?></td>
                                                  </tr>
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                         </td>
               <?php
                         echo '</tr>';

                         $jml = $jml + $list['jml'];
                    }
               } else {
                    echo '<tr>';
                    echo '<td colspan=3 class="text-center font-weight-bold align-middle"> Data tidak ada </td>';
                    echo '</tr>';
               }

               ?>
          </tbody>
     </table>
</div>
<script>
     $(document).ready(function() {
          let jmlall = "<?= $kary_sum['jmlall'] ?>"
          let tgln = "<?= $tgln ?>"
          $('#txtjmlkall').text(jmlall);
          $('#txtTglKryJdl').text(tgln);

          tbmkarysum = $('#tbmkarysum').DataTable({
               "aLengthMenu": [
                    [6, 23, 50],
                    [6, 23, 50]
               ],
               "responsive": true
          });

          $('#tbmkarysum tbody').on('click', 'tr', function() {
               var rowData = tbmkarysum.row(this).data();
               // alert(rowData[0]);
          });

          $.LoadingOverlay('hide');
     });
</script>