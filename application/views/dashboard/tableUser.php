<div class="alert alert-danger err_psn_usr animate__animated animate__bounce" style="display:none;"></div>
<div class="mb-3">
     <button id="btnrefreshuser" class="btn btn-primary font-weight-bold">Refresh User</button>
</div>

<div class="table-responsive">
     <table id="tbmuser" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
          <thead>
               <tr class="font-weight-boldtext-white">
                    <th style="text-align:center;width:1%;">No.</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Akses</th>
                    <th style="text-align:center;">Status</th>
                    <th style="text-align:center;">Tgl. Aktif</th>
                    <th style="text-align:center;">Tgl. Expired</th>
                    <th style="text-align:center;">Proses</th>
               </tr>
          </thead>
          <tbody></tbody>
     </table>
</div>

<script>
     $(document).ready(function() {

          $(document).on('click', '.hapusUser', function() {
               let authuser = $(this).attr('id').trim();
               let email = $(this).attr('value').trim();

               if (authuser == "") {
                    swal("Error", "User tidak ditemukan", "error");
               } else {
                    swal({
                         title: "Hapus",
                         text: "Yakin user " + email + " akan dihapus?",
                         type: 'question',
                         showCancelButton: true,
                         confirmButtonColor: '#36c6d3',
                         cancelButtonColor: '#d33',
                         confirmButtonText: 'Ya, hapus',
                         cancelButtonText: 'Batalkan'
                    }).then(function(result) {
                         if (result.value) {
                              $.LoadingOverlay("show");
                              $.ajax({
                                   type: "POST",
                                   url: "<?= base_url('user/hapus_user'); ?>",
                                   data: {
                                        authuser: authuser
                                   },
                                   success: function(data) {
                                        var data = JSON.parse(data);
                                        if (data.statusCode == 200) {
                                             swal("Berhasil", data.pesan, "info");
                                             tbmuser.draw();
                                             $.LoadingOverlay("hide");
                                        } else {
                                             swal("Error", data.pesan, "error");
                                             $.LoadingOverlay("hide");
                                        }
                                   }
                              });
                         } else if (result.dismiss == 'cancel') {
                              swal('Batal', 'User ' + email + ' batal dihapus', 'error');
                              return false;
                         }
                    });
               }
          });

          $("#btnrefreshuser").click(function() {
               $('#tbmuser').LoadingOverlay("show");
               tbmuser.draw()
               $('#tbmuser').LoadingOverlay("hide");
          });

          tbmuser = $('#tbmuser').DataTable({
               "processing": true,
               "responsive": true,
               "serverSide": true,
               "ordering": true, // Set true agar bisa di sorting
               "order": [
                    [1, 'desc']
               ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
               "ajax": {
                    "url": "<?= base_url('user/ajax_list'); ?>", // URL file untuk proses select datanya
                    "type": "POST"
               },
               "deferRender": true,
               "aLengthMenu": [
                    [10, 25, 50],
                    [10, 25, 50]
               ], // Combobox Limit
               "columns": [
                    //untuk membuat data index
                    {
                         data: 'no',
                         name: 'id_user',
                         render: function(data, type, row, meta) {
                              return meta.row + meta.settings._iDisplayStart + 1;
                         },
                         "className": "text-center",
                         "width": "1%"
                    },
                    {
                         "data": 'Nama',
                         "width": "20%"
                    },
                    {
                         "data": 'Email',
                         "width": "40%"
                    },
                    {
                         "data": 'menu',
                         "width": "15%"
                    },
                    {
                         "data": 'stat_aktif',
                         "className": "text-center",
                         "width": "1%"
                    },
                    {
                         "data": 'tgl_aktif',
                         "className": "text-center",
                         "width": "10%"
                    },
                    {
                         "data": 'tgl_exp',
                         "className": "text-center",
                         "width": "10%"
                    },
                    {
                         "data": 'proses',
                         "className": "text-center text-nowrap",
                         "width": "1%"
                    }
               ]
          });
     });
</script>