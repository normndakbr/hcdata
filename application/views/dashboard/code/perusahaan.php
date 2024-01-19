<script>
     //========================================== Perusahaan ========================================================
     $(document).ready(function() {
          $("#logout").click(function() {
               $("#logoutmdl").modal("show");
          });

          $(function() {
               $("#provPerusahaan").select2({
                    theme: 'bootstrap4'
               });
               $("#kabPerusahaan").select2({
                    theme: 'bootstrap4'
               });
               $("#kecPerusahaan").select2({
                    theme: 'bootstrap4'
               });
               $("#kelPerusahaan").select2({
                    theme: 'bootstrap4'
               });
               $("#editPerusahaanProv").select2({
                    dropdownParent: $('#editPerusahaanmdl'),
                    theme: 'bootstrap4'
               });
               $("#editPerusahaanKab").select2({
                    dropdownParent: $('#editPerusahaanmdl'),
                    theme: 'bootstrap4'
               });
               $("#editPerusahaanKec").select2({
                    dropdownParent: $('#editPerusahaanmdl'),
                    theme: 'bootstrap4'
               });
               $("#editPerusahaanKel").select2({
                    dropdownParent: $('#editPerusahaanmdl'),
                    theme: 'bootstrap4'
               });

               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_prov'); ?>",
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#provPerusahaan").html(data.prov);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data provinsi, hubungi administrator");
                              $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
          });
          $("#provPerusahaan").change(function() {
               let id_prov = $("#provPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kab'); ?>",
                    data: {
                         id_prov: id_prov
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kabPerusahaan").html(data.kab);
                         $("#kecPerusahaan").html("<option value='000000'>-- WAJIB DIPILIH --</option>");
                         $("#kelPerusahaan").html("<option value='00000000'>-- WAJIB DIPILIH --</option>");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kabupaten, hubungi administrator");
                              $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
          });
          $("#kabPerusahaan").change(function() {
               let id_kab = $("#kabPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kec'); ?>",
                    data: {
                         id_kab: id_kab
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kecPerusahaan").html(data.kec);
                         $("#kelPerusahaan").html("<option value='00000000'>-- WAJIB DIPILIH --</option>");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                              $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
          });
          $("#kecPerusahaan").change(function() {
               let id_kec = $("#kecPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kel'); ?>",
                    data: {
                         id_kec: id_kec
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kelPerusahaan").html(data.kel);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kelurahan, hubungi administrator");
                              $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
          });
          $("#editPerusahaanProv").change(function() {
               let id_prov = $("#editPerusahaanProv").val();
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kab'); ?>",
                    data: {
                         id_prov: id_prov
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKab").html(data.kab);
                         $("#editPerusahaanKec").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                         $("#editPerusahaanKel").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kabupaten, hubungi administrator");
                              $("#btnupdatePerusahaan").remove();
                         }
                    }
               });
          });
          $("#editPerusahaanKab").change(function() {
               let id_kab = $("#editPerusahaanKab").val();
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kec'); ?>",
                    data: {
                         id_kab: id_kab
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKec").html(data.kec);
                         $("#editPerusahaanKel").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                              $("#btnupdatePerusahaan").remove();
                         }
                    }
               });
          });
          $("#editPerusahaanKec").change(function() {
               let id_kec = $("#editPerusahaanKec").val();
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kel'); ?>",
                    data: {
                         id_kec: id_kec
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKel").html(data.kel);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kelurahan, hubungi administrator");
                              $("#btnupdatePerusahaan").remove();
                         }
                    }
               });
          });
          $(".refprov").click(function() {
               $("#provPerusahaan").LoadingOverlay("show");
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_prov'); ?>",
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#provPerusahaan").html(data.prov);
                         $("#provPerusahaan").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         $("#provPerusahaan").attr("disabled", true);
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data provinsi, hubungi administrator");
                              $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
          });
          $(".refkab").click(function() {
               $("#kabPerusahaan").LoadingOverlay("show");
               let id_prov = $("#provPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kab'); ?>",
                    data: {
                         id_prov: id_prov
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kabPerusahaan").html(data.kab);
                         $("#kecPerusahaan").html("<option value='000000'>-- WAJIB DIPILIH --</option>");
                         $("#kelPerusahaan").html("<option value='00000000'>-- WAJIB DIPILIH --</option>");
                         $("#kabPerusahaan").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         $("#kabPerusahaan").LoadingOverlay("hide");
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kabupaten, hubungi administrator");
                              $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
          });
          $(".refkec").click(function() {
               $("#kecPerusahaan").LoadingOverlay("show");
               let id_kab = $("#kabPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kec'); ?>",
                    data: {
                         id_kab: id_kab
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kecPerusahaan").html(data.kec);
                         $("#kelPerusahaan").html("<option value='00000000'>-- WAJIB DIPILIH --</option>");
                         $("#kecPerusahaan").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         $("#kecPerusahaan").LoadingOverlay("hide");
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                              $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
          });
          $(".refkel").click(function() {
               $("#kelPerusahaan").LoadingOverlay("show");
               let id_kec = $("#kecPerusahaan").val();
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kel'); ?>",
                    data: {
                         id_kec: id_kec
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#kelPerusahaan").html(data.kel);
                         $("#kelPerusahaan").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         $("#kelPerusahaan").LoadingOverlay("hide");
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kelurahan, hubungi administrator");
                              $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
          });
          $('#btnupdatePerusahaan').click(function() {
               let kode = $('#editPerusahaanKode').val();
               let perusahaan = $('#editPerusahaan').val();
               let alamat = $('#editPerusahaanAlamat').val();
               let kodepos = $('#editPerusahaanKodepos').val();
               let kel = $('#editPerusahaanKel').val();
               let kec = $('#editPerusahaanKec').val();
               let kab = $('#editPerusahaanKab').val();
               let prov = $('#editPerusahaanProv').val();
               let telp = $('#editPerusahaanTelp').val();
               let email = $('#editPerusahaanEmail').val();
               let web = $('#editPerusahaanWeb').val();
               let npwp = $('#editPerusahaanNpwp').val();
               let kegiatan = $('#editPerusahaanKeg').val();
               let status = $('#editPerusahaanStatus').val();
               let ket = $('#editPerusahaanKet').val();

               $.ajax({
                    type: "POST",
                    url: "<?= base_url('perusahaan/edit_perusahaan'); ?>",
                    data: {
                         kode: kode,
                         perusahaan: perusahaan,
                         alamat: alamat,
                         kodepos: kodepos,
                         kel: kel,
                         kec: kec,
                         kab: kab,
                         prov: prov,
                         telp: telp,
                         email: email,
                         web: web,
                         npwp: npwp,
                         status: status,
                         keg: kegiatan,
                         ket: ket
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         if (data.statusCode == 200) {
                              tbmPerusahaan.draw();
                              $("#editPerusahaanmdl").modal("hide");
                              $(".err_psn_perusahaan").removeClass('d-none');
                              $(".err_psn_perusahaan").removeClass('alert-danger');
                              $(".err_psn_perusahaan").addClass('alert-info');
                              $(".err_psn_perusahaan").html(data.pesan);
                              $("#editPerusahaanKode").val('');
                              $("#editPerusahaan").val('');
                              $("#editPerusahaanKet").val('');
                              $("#editPerusahaanStatus").val('');
                              $("#error1el").html('');
                              $("#error2el").html('');
                              $("#error3el").html('');
                              $("#error4el").html('');
                              $(".err_psn_perusahaan").fadeTo(3000, 500).slideUp(500, function() {
                                   $(".err_psn_perusahaan").slideUp(500);
                                   $(".err_psn_perusahaan").addClass('d-none');
                              });
                         } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                              $(".err_psn_edit_perusahaan").removeClass('d-none');
                              $(".err_psn_edit_perusahaan").removeClass('alert-info');
                              $(".err_psn_edit_perusahaan").addClass('alert-danger');
                              $(".err_psn_edit_perusahaan").html(data.pesan);
                              $(".err_psn_edit_perusahaan").fadeTo(3000, 500).slideUp(500, function() {
                                   $(".err_psn_edit_perusahaan").slideUp(500);
                                   $(".err_psn_edit_perusahaan").addClass('d-none');
                              });
                              $("#error1eper").html('');
                              $("#error2eper").html('');
                              $("#error3eper").html('');
                              $("#error4eper").html('');
                              $("#error5eper").html('');
                              $("#error6eper").html('');
                              $("#error7eper").html('');
                              $("#error8eper").html('');
                              $("#error9eper").html('');
                              $("#error10eper").html('');
                              $("#error11eper").html('');
                              $("#error12eper").html('');
                              $("#error13eper").html('');
                              $("#error14eper").html('');
                              $("#error15eper").html('');
                         } else if (data.statusCode == 202) {
                              $("#error1eper").html(data.kode);
                              $("#error2eper").html(data.perusahaan);
                              $("#error3eper").html(data.alamat);
                              $("#error4eper").html(data.kodepos);
                              $("#error5eper").html(data.prov);
                              $("#error6eper").html(data.kab);
                              $("#error7eper").html(data.kec);
                              $("#error8eper").html(data.kel);
                              $("#error9eper").html(data.telp);
                              $("#error10eper").html(data.email);
                              $("#error11eper").html(data.web);
                              $("#error12eper").html(data.npwp);
                              $("#error13eper").html(data.keg);
                              $("#error14eper").html(data.ket);
                              $("#error15eper").html(data.status);
                         }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $(".err_psn_perusahaan").removeClass("alert-primary");
                         $(".err_psn_perusahaan").addClass("alert-danger");
                         $(".err_psn_perusahaan").removeClass("d-none");
                         if (xhr.status == 404) {
                              $(".err_psn_perusahaan").html("Perusahaan gagal diupdate, Link data tidak ditemukan");
                         } else if (xhr.status == 0) {
                              $(".err_psn_perusahaan").html("Perusahaan gagal diupdate, Waktu koneksi habis");
                         } else {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                         }
                         $("#editPerusahaanmdl").modal("hide");
                         $(".err_psn_perusahaan ").fadeTo(3000, 500).slideUp(500, function() {
                              $(".err_psn_perusahaan ").slideUp(500);
                              $(".err_psn_perusahaan").addClass('d-none');
                         });
                    }
               })
          });

          $.LoadingOverlay("hide");

          function resetaddperusahaan() {
               $("#kodePerusahaan").val('');
               $("#Perusahaan").val('');
               $("#alamatPerusahaan").val('');
               $("#kodeposPerusahaan").val('');
               $("#provPerusahaan").val('').trigger('change');
               $("#telpPerusahaan").val('');
               $("#emailPerusahaan").val('');
               $("#webPerusahaan").val('');
               $("#npwpPerusahaan").val('');
               $("#kegPerusahaan").val('');
               $("#ketPerusahaan").val('');
               $(".error1").html('');
               $(".error2").html('');
               $(".error3").html('');
               $(".error4").html('');
               $(".error5").html('');
               $(".error6").html('');
               $(".error7").html('');
               $(".error8").html('');
               $(".error9").html('');
               $(".error10").html('');
               $(".error11").html('');
               $(".error12").html('');
               $(".error13").html('');
               $(".error14").html('');
          }

          $("#btnBatalPerusahaan").click(function() {
               location.reload();
          });

          $("#btnTambahPerusahaan").click(function() {
               var kode = $("#kodePerusahaan").val();
               var perusahaan = $("#Perusahaan").val();
               var alamat = $("#alamatPerusahaan").val();
               var kodepos = $("#kodeposPerusahaan").val();
               var prov = $("#provPerusahaan").val();
               var kab = $("#kabPerusahaan").val();
               var kec = $("#kecPerusahaan").val();
               var kel = $("#kelPerusahaan").val();
               var telp = $("#telpPerusahaan").val();
               var email = $("#emailPerusahaan").val();
               var web = $("#webPerusahaan").val();
               var npwp = $("#npwpPerusahaan").val();
               var keg = $("#kegPerusahaan").val();
               var ket = $("#ketPerusahaan").val();

               $.ajax({
                    type: "POST",
                    url: "<?= base_url("perusahaan/input_perusahaan") ?>",
                    data: {
                         kode: kode,
                         perusahaan: perusahaan,
                         alamat: alamat,
                         kodepos: kodepos,
                         prov: prov,
                         kab: kab,
                         kec: kec,
                         kel: kel,
                         telp: telp,
                         email: email,
                         npwp: npwp,
                         web: web,
                         keg: keg,
                         ket: ket
                    },
                    timeout: 20000,
                    success: function(data) {
                         var data = JSON.parse(data);
                         if (data.statusCode == 200) {
                              $(".err_psn_perusahaan").removeClass('d-none');
                              $(".err_psn_perusahaan").removeClass('alert-danger');
                              $(".err_psn_perusahaan").addClass('alert-info');
                              $(".err_psn_perusahaan").html(data.pesan);
                              resetaddperusahaan()
                              $(".err_psn_perusahaan").fadeTo(3000, 500).slideUp(500, function() {
                                   $(".err_psn_perusahaan").slideUp(500);
                                   $(".err_psn_perusahaan").addClass('d-none');
                                   location.reload();
                              });
                         } else if (data.statusCode == 201) {
                              $(".err_psn_perusahaan").removeClass('d-none');
                              $(".err_psn_perusahaan").removeClass('alert-info');
                              $(".err_psn_perusahaan").addClass('alert-danger');
                              $(".err_psn_perusahaan").html(data.pesan);
                         } else if (data.statusCode == 202) {
                              $(".error1").html(data.kode);
                              $(".error2").html(data.perusahaan);
                              $(".error3").html(data.alamat);
                              $(".error4").html(data.kodepos);
                              $(".error5").html(data.prov);
                              $(".error6").html(data.kab);
                              $(".error7").html(data.kec);
                              $(".error8").html(data.kel);
                              $(".error9").html(data.telp);
                              $(".error10").html(data.email);
                              $(".error11").html(data.web);
                              $(".error12").html(data.npwp);
                              $(".error13").html(data.keg);
                              $(".error14").html(data.ket);
                         }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass("alert-primary");
                         $(".err_psn_perusahaan").addClass("alert-danger");
                         $(".err_psn_perusahaan").addClass("d-none");
                         if (xhr.status == 404) {
                              $(".err_psn_perusahaan").html("Perusahaan gagal disimpan, Link data tidak ditemukan");
                         } else if (xhr.status == 0) {
                              $(".err_psn_perusahaan").html("Perusahaan gagal disimpan, Waktu koneksi habis");
                         } else {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat menyimpan data, hubungi administrator");
                         }

                         $(".err_psn_perusahaan ").fadeTo(3000, 500).slideUp(500, function() {
                              $(".err_psn_perusahaan ").slideUp(500);
                              $(".err_psn_perusahaan").addClass('d-none');
                         });
                    }
               })
          });

          $(document).on('click', '.hpsperusahaan', function() {
               let auth_perusahaan = $(this).attr('id');
               let namaPerusahaan = $(this).attr('value');

               if (auth_perusahaan == "") {
                    swal("Error", "Perusahaan tidak ditemukan", "error");
               } else {
                    swal({
                         title: "Hapus",
                         text: "Yakin Perusahaan " + namaPerusahaan + " akan dihapus?",
                         type: 'question',
                         showCancelButton: true,
                         confirmButtonColor: '#36c6d3',
                         cancelButtonColor: '#d33',
                         confirmButtonText: 'Ya, hapus',
                         cancelButtonText: 'Batalkan'
                    }).then(function(result) {
                         if (result.value) {
                              $.ajax({
                                   type: "POST",
                                   url: "<?= base_url('perusahaan/hapus_perusahaan'); ?>",
                                   data: {
                                        auth_perusahaan: auth_perusahaan
                                   },
                                   timeout: 20000,
                                   success: function(data, textStatus, xhr) {
                                        var data = JSON.parse(data);
                                        if (data.statusCode == 200) {
                                             tbmPerusahaan.draw();
                                             $(".err_psn_perusahaan").removeClass("alert-danger");
                                             $(".err_psn_perusahaan").addClass("alert-primary");
                                             $(".err_psn_perusahaan").removeClass("d-none");
                                             $(".err_psn_perusahaan").html(data.pesan);
                                        } else {
                                             $(".err_psn_perusahaan").removeClass("alert-primary");
                                             $(".err_psn_perusahaan").addClass("alert-danger");
                                             $(".err_psn_perusahaan").removeClass("d-none");
                                             $(".err_psn_perusahaan").html(data.pesan);
                                        }

                                        $.LoadingOverlay("hide");
                                   },
                                   error: function(xhr, ajaxOptions, thrownError) {
                                        $.LoadingOverlay("hide");
                                        $(".err_psn_perusahaan").removeClass("alert-primary");
                                        $(".err_psn_perusahaan").addClass("alert-danger");
                                        $(".err_psn_perusahaan").removeClass("d-none");
                                        if (xhr.status == 404) {
                                             $(".err_psn_perusahaan").html("Perusahaan gagal dihapus, , Link data tidak ditemukan");
                                        } else if (xhr.status == 0) {
                                             $(".err_psn_perusahaan").html("Perusahaan gagal dihapus, Waktu koneksi habis");
                                        } else {
                                             $(".err_psn_perusahaan").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                        }
                                   }
                              });

                              $(".err_psn_perusahaan").fadeTo(4000, 500).slideUp(500, function() {
                                   $(".err_psn_perusahaan").slideUp(500);
                                   $(".err_psn_perusahaan").addClass("d-none");
                              });
                         } else if (result.dismiss == 'cancel') {
                              swal('Batal', 'Perusahaan ' + namaPerusahaan + ' batal dihapus', 'error');
                              return false;
                         }
                    });
               }
          });

          $(document).on('click', '.dtlperusahaan', function() {
               let auth_perusahaan = $(this).attr('id');
               let namaPerusahaan = $(this).attr('value');

               if (auth_perusahaan == "") {
                    swal("Error", "Perusahaan tidak ditemukan", "error");
               } else {
                    $.ajax({
                         type: "post",
                         url: "<?= base_url('perusahaan/detail_perusahaan'); ?>",
                         data: {
                              auth_perusahaan: auth_perusahaan
                         },
                         timeout: 15000,
                         success: function(data) {
                              var data = JSON.parse(data);
                              if (data.statusCode == 200) {
                                   $("#detailPerusahaanKode").val(data.kode);
                                   $("#detailPerusahaan").val(data.perusahaan);
                                   $("#detailPerusahaanAlamat").val(data.alamat);
                                   $("#detailPerusahaanKodepos").val(data.kodepos);
                                   $("#detailPerusahaanTelp").val(data.perusahaatelp);
                                   $("#detailPerusahaanEmail").val(data.email);
                                   $("#detailPerusahaanWeb").val(data.web);
                                   $("#detailPerusahaanNpwp").val(data.npwp);
                                   $("#detailPerusahaanKeg").val(data.keg);
                                   $("#detailPerusahaanStatus").val(data.status);
                                   $("#detailPerusahaanKet").val(data.ket);
                                   $("#detailPerusahaanBuat").val(data.pembuat);
                                   $("#detailPerusahaanTglBuat").val(data.tgl_buat);
                                   $("#detailPerusahaanTglEdit").val(data.tgl_edit);
                                   $("#detailPerusahaanmdl").modal("show");
                              } else {
                                   $(".err_psn_perusahaan").addClass("d-none");
                                   $(".err_psn_perusahaan").html(data.pesan);
                              }
                         },
                         error: function(xhr, ajaxOptions, thrownError) {
                              $.LoadingOverlay("hide");
                              $(".err_psn_perusahaan").removeClass("alert-primary");
                              $(".err_psn_perusahaan").addClass("alert-danger");
                              $(".err_psn_perusahaan").addClass("d-none");
                              if (xhr.status == 404) {
                                   $(".err_psn_perusahaan").html("Perusahaan gagal ditampilkan, Link data tidak ditemukan");
                              } else if (xhr.status == 0) {
                                   $(".err_psn_perusahaan").html("Perusahaan gagal ditampilkan, Waktu koneksi habis");
                              } else {
                                   $(".err_psn_perusahaan").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                              }
                              $(".err_psn_perusahaan ").fadeTo(3000, 500).slideUp(500, function() {
                                   $(".err_psn_perusahaan ").slideUp(500);
                              });
                         }
                    });
               }
          });

          function edit_alamat(id_prov, id_kab, id_kec, id_kel) {
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_prov'); ?>",
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanProv").html(data.prov);
                         $("#editPerusahaanProv").val(id_prov);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data provinsi, hubungi administrator");
                              // $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kab'); ?>",
                    data: {
                         id_prov: id_prov
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKab").html(data.kab);
                         $("#editPerusahaanKab").val(id_kab);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kabupaten, hubungi administrator");
                              // $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kec'); ?>",
                    data: {
                         id_kab: id_kab
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKec").html(data.kec);
                         $("#editPerusahaanKec").val(id_kec);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                              // $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
               $.ajax({
                    type: "post",
                    url: "<?= base_url('daerah/get_kel'); ?>",
                    data: {
                         id_kec: id_kec
                    },
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#editPerusahaanKel").html(data.kel);
                         $("#editPerusahaanKel").val(id_kel);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_perusahaan").removeClass('d-none');
                         $(".err_psn_perusahaan").removeClass('alert-info');
                         $(".err_psn_perusahaan").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat load data kelurahan, hubungi administrator");
                              // $("#btnTambahPerusahaan").remove();
                         }
                    }
               });
          }

          $(document).on('click', '.edttperusahaan', function() {
               let auth_perusahaan = $(this).attr('id');
               let namaPerusahaan = $(this).attr('value');

               if (auth_perusahaan == "") {
                    swal("Error", "Perusahaan tidak ditemukan", "error");
               } else {
                    $.ajax({
                         type: "post",
                         url: "<?= base_url('perusahaan/edit_detail_perusahaan'); ?>",
                         data: {
                              auth_perusahaan: auth_perusahaan
                         },
                         timeout: 15000,
                         success: function(data) {
                              var dataPerusahaan = JSON.parse(data);
                              if (dataPerusahaan.statusCode == 200) {
                                   $("#jdleditPerusahaan").text(dataPerusahaan.judul);
                                   $("#editPerusahaanKode").val(dataPerusahaan.kode);
                                   $("#editPerusahaan").val(dataPerusahaan.perusahaan);
                                   $("#editPerusahaanAlamat").val(dataPerusahaan.alamat);
                                   edit_alamat(dataPerusahaan.prov, dataPerusahaan.kab, dataPerusahaan.kec, dataPerusahaan.kel);
                                   $("#editPerusahaanKodepos").val(dataPerusahaan.kodepos);
                                   $("#editPerusahaanTelp").val(dataPerusahaan.perusahaatelp);
                                   $("#editPerusahaanEmail").val(dataPerusahaan.email);
                                   $("#editPerusahaanWeb").val(dataPerusahaan.web);
                                   $("#editPerusahaanNpwp").val(dataPerusahaan.npwp);
                                   $("#editPerusahaanKeg").val(dataPerusahaan.keg);
                                   $("#editPerusahaanStatus").val(dataPerusahaan.status);
                                   $("#editPerusahaanKet").val(dataPerusahaan.ket);
                                   $("#editPerusahaanmdl").modal("show");
                                   $("#error1el").html('');
                                   $("#error2el").html('');
                                   $("#error3el").html('');
                                   $("#error4el").html('');
                              } else {
                                   $(".err_psn_perusahaan").addClass("d-none");
                                   $(".err_psn_perusahaan").html(data.pesan);
                              }
                         },
                         error: function(xhr, ajaxOptions, thrownError) {
                              $.LoadingOverlay("hide");
                              $(".err_psn_perusahaan").removeClass("alert-primary");
                              $(".err_psn_perusahaan").addClass("alert-danger");
                              $(".err_psn_perusahaan").addClass("d-none");
                              if (xhr.status == 404) {
                                   $(".err_psn_perusahaan").html("Perusahaan gagal ditampilkan, Link data tidak ditemukan");
                              } else if (xhr.status == 0) {
                                   $(".err_psn_perusahaan").html("Perusahaan gagal ditampilkan, Waktu koneksi habis");
                              } else {
                                   $(".err_psn_perusahaan").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                              }

                              $(".err_psn_perusahaan ").fadeTo(3000, 500).slideUp(500, function() {
                                   $(".err_psn_perusahaan ").slideUp(500);
                              });
                         }
                    });
               }
          });

          $("#btnrefreshPerusahaan").click(function() {
               $('#tbmPerusahaan').LoadingOverlay("show");
               tbmPerusahaan.draw()
               $('#tbmPerusahaan').LoadingOverlay("hide");
          });

          tbmPerusahaan = $('#tbmPerusahaan').DataTable({
               "processing": true,
               "responsive": true,
               "serverSide": true,
               "ordering": true,
               "order": [
                    [1, 'asc'],
               ],
               "ajax": {
                    "url": "<?= base_url('perusahaan/ajax_list'); ?>",
                    "type": "POST",
                    "error": function(xhr, error, code) {
                         if (code != "") {
                              $(".err_psn_perusahaan").removeClass("d-none");
                              $(".err_psn_perusahaan").addClass("d-none");
                              $(".err_psn_perusahaan").html("Terjadi kesalahan saat melakukan load data perusahaan, hubungi administrator");
                              $("#secadd").addClass("disabled");
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
                         name: 'id_perusahaan',
                         render: function(data, type, row, meta) {
                              return meta.row + meta.settings._iDisplayStart + 1;
                         },
                         "className": "text-center align-middle",
                         "width": "1%"
                    },
                    {
                         "data": 'kode_perusahaan',
                         "className": "text-nowrap  align-middle",
                         "width": "10%"
                    },
                    {
                         "data": 'nama_perusahaan',
                         "className": "text-nowrap  align-middle",
                         "width": "20%"
                    },
                    {
                         "data": 'alamat_perusahaan',
                         "className": "text-nowrap  align-middle",
                         "width": "35%"
                    },
                    {
                         "data": 'stat_perusahaan',
                         "className": "text-center align-middle",
                         "width": "1%"
                    },
                    {
                         "data": 'tgl_buat',
                         "className": "text-center text-nowrap  align-middle",
                         "width": "8%"
                    },
                    {
                         "data": 'proses',
                         "className": "text-center text-nowrap  align-middle",
                         "width": "1%"
                    }
               ]
          });
     });
</script>