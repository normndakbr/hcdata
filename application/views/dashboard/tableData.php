<div class="alert alert-danger err_psn_map animate__animated animate__bounce" style="display:none;"></div>
<div class="mb-3">
     <button id="btnrefreshmap" class="btn btn-primary font-weight-bold">Refresh Map</button>
</div>

<div class="table-responsive">
     <table id="tbmmap" class="table table-striped table-bordered table-hover text-black" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
          <thead>
               <tr class="font-weight-boldtext-white">
                    <th style="text-align:center;width:1%;">No.</th>
                    <th>Nama Link</th>
                    <th>Label</th>
                    <th>Nama Folder</th>
                    <th>Week Ke </th>
                    <th style="text-align:center;">Status</th>
                    <th style="text-align:center;">Tgl. Dibuat</th>
                    <th style="text-align:center;">Proses</th>
               </tr>
          </thead>
          <tbody>
          </tbody>
     </table>
</div>

<script>
     $(document).ready(function() {

          $(document).on('click', '.hpslnk', function() {
               let authlink = $(this).attr('id');
               let namalink = $(this).attr('value');

               if (authlink == "") {
                    swal("Error", "Link tidak ditemukan", "error");
               } else {
                    swal({
                         title: "Hapus",
                         text: "Yakin link map " + namalink + " akan dihapus?",
                         type: 'question',
                         showCancelButton: true,
                         confirmButtonColor: '#36c6d3',
                         cancelButtonColor: '#d33',
                         confirmButtonText: 'Ya, hapus',
                         cancelButtonText: 'Batalkan'
                    }).then(function(result) {
                         if (result.value) {
                              // $.LoadingOverlay("show");
                              $.ajax({
                                   type: "POST",
                                   url: "<?= base_url('dash/hapus_link'); ?>",
                                   data: {
                                        authlink: authlink
                                   },
                                   success: function(data) {
                                        var data = JSON.parse(data);
                                        if (data.statusCode == 200) {
                                             tbmmap.draw();
                                             $(".err_psn_map").removeClass("alert-danger");
                                             $(".err_psn_map").addClass("alert-primary");
                                             $(".err_psn_map").css("display", "block");
                                             $(".err_psn_map").html(data.pesan);
                                        } else {
                                             $(".err_psn_map").removeClass("alert-primary");
                                             $(".err_psn_map").addClass("alert-danger");
                                             $(".err_psn_map").css("display", "block");
                                             $(".err_psn_map").html(data.pesan);
                                        }

                                        $(".err_psn_map").fadeTo(4000, 500).slideUp(500, function() {
                                             $(".err_psn_map").slideUp(500);
                                        });
                                   }
                              });
                         } else if (result.dismiss == 'cancel') {
                              swal('Batal', 'Link ' + namalink + ' batal dihapus', 'error');
                              return false;
                         }
                    });
               }
          });

          $(document).on('click', '.dtllnk', function() {
               let authlink = $(this).attr('id');
               let namalink = $(this).attr('value');

               if (authlink == "") {
                    swal("Error", "Link tidak ditemukan", "error");
               } else {
                    $.ajax({
                         type: "post",
                         url: "<?= base_url('dash/detail_link'); ?>",
                         data: {
                              authlink: authlink
                         },
                         success: function(data) {
                              var data = JSON.parse(data);
                              if (data.statusCode == 200) {
                                   $("#namaLinkDetail").val(data.nama_link);
                                   $("#namaFolderDetail").val(data.nama_folder);
                                   $("#namaLabelDetail").val(data.nama_label);
                                   $("#namaFileDetail").val(data.nama_file);
                                   $("#detailmapmdl").modal("show")
                              } else {
                                   $(".err_psn_map").css("display", "block");
                                   $(".err_psn_map").html(data.pesan);
                              }

                         }

                    });
               }
          });

          $(document).on('click', '.edttlnk', function() {
               let authlink = $(this).attr('id');
               let namalink = $(this).attr('value');

               if (authlink == "") {
                    swal("Error", "Link tidak ditemukan", "error");
               } else {
                    $.ajax({
                         type: "post",
                         url: "<?= base_url('dash/detail_link'); ?>",
                         data: {
                              authlink: authlink
                         },
                         success: function(data) {
                              var data = JSON.parse(data);
                              if (data.statusCode == 200) {
                                   $("#namaLinkEdit").val(data.nama_link);
                                   $("#namaFolderEdit").val(data.nama_folder);
                                   $("#namaLabelEdit").val(data.nama_label);
                                   $("#namaFileEdit").val(data.nama_file);
                                   $("#editmapmdl").modal("show");
                              } else {
                                   $(".err_psn_map").css("display", "block");
                                   $(".err_psn_map").html(data.pesan);
                              }
                         }

                    });
               }
          });

          $("#btnrefreshmap").click(function() {
               $('#tbmmap').LoadingOverlay("show");
               tbmmap.draw()
               $('#tbmmap').LoadingOverlay("hide");
          });

          tbmmap = $('#tbmmap').DataTable({
               "processing": true,
               "responsive": true,
               "serverSide": true,
               "ordering": true, // Set true agar bisa di sorting
               "order": [
                    [4, 'desc']
               ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
               "ajax": {
                    "url": "<?= base_url('dash/ajax_list'); ?>", // URL file untuk proses select datanya
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
                         name: 'id_link',
                         render: function(data, type, row, meta) {
                              return meta.row + meta.settings._iDisplayStart + 1;
                         },
                         "className": "text-center",
                         "width": "1%"
                    },
                    {
                         "data": 'nama_link',
                         "width": "20%"
                    },
                    {
                         "data": 'nama_label',
                         "width": "40%"
                    },
                    {
                         "data": 'nama_folder',
                         "width": "15%"
                    },
                    {
                         "data": 'minggu_ke',
                         "width": "1%",
                         "visible": false
                    },
                    {
                         "data": 'stat_link',
                         "className": "text-center",
                         "width": "1%"
                    },
                    {
                         "data": 'tgl_buat',
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