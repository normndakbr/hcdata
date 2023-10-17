<?php

$authpengajuansm = htmlspecialchars($this->input->get('authpengajuansm', true));
$tabel = htmlspecialchars($this->input->get('tabel', true));

if (!empty($authpengajuansm)) {
     echo "<input type='hidden' id='authizintambang' name='authizintambang' value='" . $authpengajuansm . "'>";
     echo "<input type='hidden' id='tbldata' name='tbldata' value='" . $tabel . "'>";
} else {
     echo "<input type='hidden' id='authizintambang' name='authizintambang' value=''>";
     echo "<input type='hidden' id='tbldata' name='tbldata' value=''>";
}

?>
<table id="tbmKaryMP" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
     <thead>
          <tr>
               <th>No.</th>
               <th>NIK</th>
               <th>Nama Karyawan</th>
               <th>Departemen</th>
               <th>Posisi</th>
               <th>DOH</th>
               <th>Proses Izin</th>
               <th>Proses</th>
          </tr>
     </thead>
     <tbody></tbody>
</table>
<script>
     let authizinsm = $("#authizintambang").val();
     let tbldata = $("#authizintambang").val();

     $('#tbmKaryMP').DataTable().destroy();
     tbmKaryIzin = $('#tbmKaryMP').DataTable({
          "processing": true,
          "responsive": true,
          "serverSide": true,
          "ordering": true,
          "order": [
               [1, 'asc'],
          ],
          "ajax": {
               "url": site_url + "karyizin/ajax_list?authizinmst=" + tbldata,
               "type": "POST",
               "error": function(xhr, error, code) {
                    if (code != "") {
                         $(".err_list_kary_izin_add").removeClass("d-none");
                         $(".err_list_kary_izin_add").removeClass("d-none");
                         $(".err_list_kary_izin_add").html("Terjadi kesalahan saat melakukan load data karyawan, hubungi administrator");
                         $("#addbtnizin").remove();
                    }
               }
          },
          "deferRender": true,
          "aLengthMenu": [
               [10, 25, 50],
               [10, 25, 50]
          ],
          "columns": [{
                    data: 'no',
                    name: 'id_pengajuan_sm_detail',
                    render: function(data, type, row, meta) {
                         return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "className": "text-center align-middle",
                    "width": "1%"
               },
               {
                    "data": 'nik',
                    "className": "align-middle",
                    "width": "15%"
               },
               {
                    "data": 'nama_lengkap',
                    "className": "text-nowrap align-middle",
                    "width": "15%"
               },
               {
                    "data": 'depart',
                    "className": "text-nowrap align-middle",
                    "width": "10%"
               },
               {
                    "data": 'posisi',
                    "className": "text-center text-nowrap align-middle",
                    "width": "1%"
               },
               {
                    "data": 'dohshow',
                    "className": "text-center text-nowrap align-middle",
                    "width": "1%"
               },
               {
                    "data": 'proses_izin_tambang',
                    "className": "text-center  align-middle",
                    "width": "1%"
               },
               {
                    "data": 'proses',
                    "className": "text-center text-nowrap align-middle",
                    "width": "1%"
               }
          ]
     });

     $.LoadingOverlay("hide");
</script>