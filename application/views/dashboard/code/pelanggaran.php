<script>
//========================================== Langgar ========================================================
$(document).ready(function() {

     $("#logout").click(function() {
          $("#logoutmdl").modal("show");
     });

     $(".err_psn_langgar_add").fadeTo(4000, 500).slideUp(500, function() {
          $(".err_psn_langgar_add").slideUp(500);
     });

     $('#jenisPunish').select2({
          theme: 'bootstrap4',
          width: '100%'
     });

     $('#perLanggarData').select2({
          theme: 'bootstrap4',
          width: '100%'
     });

     $('#perLanggar').select2({
          theme: 'bootstrap4',
          width: '100%'
     });

     window.addEventListener('resize', function(event) {
          $('#jenisPunish').select2({
               theme: 'bootstrap4',
               width: '100%'
          });

          $('#perLanggarData').select2({
               theme: 'bootstrap4',
               width: '100%'
          });

          $('#perLanggar').select2({
               theme: 'bootstrap4',
               width: '100%'
          });
     }, true);

     $('#perLanggar').change(function() {
          auth_m_prs = $('#perLanggar').val();
          $('#authKTPKaryLanggar').val('');
          $('#txtKTPKaryLanggar').text('');
          $('#txtNIKKaryLanggar').text('');
          $('#txtNamaKaryLanggar').text('');
          $('#txtDepartKaryLanggar').text('');
          $('#txtPosisiKaryLanggar').text('');
          $("#txtCariKaryLanggar").val('');

          $("#txtCariKaryLanggar").autocomplete({
               source: function(request, response) {
                    $.ajax({
                         url: "<?=base_url('karyawan/getKaryawan');?>",
                         type: 'post',
                         dataType: "json",
                         data: {
                              search: request.term,
                              auth_m_per: auth_m_prs,
                         },
                         success: function(data) {
                              response(data);
                         }
                    });
               },
               select: function(event, ui) {
                    if (ui.item.value != "") {
                         $('#authKTPKaryLanggar').val(ui.item.value);
                         $('#txtKTPKaryLanggar').val(ui.item.ktp);
                         $('#txtNIKKaryLanggar').val(ui.item.nik);
                         $('#txtNamaKaryLanggar').val(ui.item.nama);
                         $('#txtDepartKaryLanggar').val(ui.item.depart);
                         $('#txtPosisiKaryLanggar').val(ui.item.posisi);
                         $("#txtCariKaryLanggar").val('');
                    }
                    return false;
               }
          });
     });

     $("#jenisPunish").change(function() {
          authlanggarjenis = $('#jenisPunish').val();
          tgl_langgar = $('#tglLanggar').val();
          tgl_punish = $('#tglPunish').val();
          $('#tglAkhirPunish').val('');

          $.ajax({
               type: "POST",
               url: "<?=base_url('pelanggaran/tglpunish');?>",
               data: {
                    authlanggarjenis: authlanggarjenis,
                    tgl_punish: tgl_punish,
                    tgl_langgar: tgl_langgar,
               },
               success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                         $('#tglAkhirPunish').val(data.tgl_akhir);
                         $('.error4').text('');
                         $('.error5').text('');
                    } else if (data.statusCode == 202) {
                         $('.error4').html(data.tgl_punish);
                         $('.error5').html(data.authlanggarjenis);
                    } else {
                         swal("Error", data.pesan, "error");
                         $('#tglAkhirPunish').val('');
                    }
               },
               error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (xhr.status == 404) {
                         swal("Error",
                              "Tanggal akhir tidak bisa di update, Link data tidak ditemukan",
                              "error");
                    } else if (xhr.status == 0) {
                         swal("Error",
                              "Pelanggaran gagal diupdate, Waktu koneksi habis",
                              "error");
                    } else {
                         swal("Error",
                              "Terjadi kesalahan saat meng-update data, hubungi administrator",
                              "error");
                    }
               }
          })
     });

     $("#tglPunish").change(function() {
          authlanggarjenis = $('#jenisPunish').val();
          tgl_punish = $('#tglPunish').val();
          tgl_langgar = $('#tglLanggar').val();
          $('#tglAkhirPunish').val('');

          $.ajax({
               type: "POST",
               url: "<?=base_url('pelanggaran/tglpunish');?>",
               data: {
                    authlanggarjenis: authlanggarjenis,
                    tgl_punish: tgl_punish,
                    tgl_langgar: tgl_langgar
               },
               success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                         $('#tglAkhirPunish').val(data.tgl_akhir);
                         $('.error4').text('');
                    } else if (data.statusCode == 202) {
                         $('.error4').html(data.tgl_punish);
                    } else {
                         swal("Error", data.pesan, "error");
                         $('#tglPunish').val(data.tgl_punish);
                         $('#tglAkhirPunish').val('');
                    }
               },
               error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (xhr.status == 404) {
                         swal("Error",
                              "Tanggal akhir tidak bisa di update, Link data tidak ditemukan",
                              "error");
                    } else if (xhr.status == 0) {
                         swal("Error",
                              "Tanggal akhir gagal diupdate, Waktu koneksi habis",
                              "error");
                    } else {
                         swal("Error",
                              "Terjadi kesalahan saat meng-update data, hubungi administrator",
                              "error");
                    }
               }
          })
     });

     $("#tglLanggar").change(function() {
          tgl = $('#tglLanggar').val();
          tglpunish = $('#tglPunish').val();

          $.ajax({
               type: "POST",
               url: "<?=base_url('pelanggaran/cektgl');?>",
               data: {
                    tgl: tgl,
                    tglpunish: tglpunish
               },
               success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                         $('#tglLanggar').val(data.tglcek);
                         $('.error3').text('');
                    } else {
                         swal("Error", data.pesan, "error");
                         $('#tglLanggar').val('');
                    }
               },
               error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (xhr.status == 404) {
                         swal("Error",
                              "Tanggal akhir tidak bisa di update, Link data tidak ditemukan",
                              "error");
                    } else if (xhr.status == 0) {
                         swal("Error",
                              "Tanggal akhir gagal diupdate, Waktu koneksi habis",
                              "error");
                    } else {
                         swal("Error",
                              "Terjadi kesalahan saat meng-update data, hubungi administrator",
                              "error");
                    }
               }
          })
     });

     $('#btnSubLanggar').on('click', function(e) {
          e.preventDefault();

          var form = $(this).parents('form');
          swal({
               title: "Buat Data Pelanggaran",
               text: "Yakin pelanggaran akan dibuat?",
               type: 'question',
               showCancelButton: true,
               confirmButtonColor: '#36c6d3',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Ya, buat data',
               cancelButtonText: 'Batalkan'
          }).then(function(result) {
               if (result.value) {
                    form.submit();
               }
          });
     });

     $(document).on('click', '.hapuslanggar', function() {
          var id = $(this).attr("id")

          swal({
               title: "Hapus Data Pelanggaran",
               text: "Yakin data pelanggaran akan dihapus?",
               type: 'question',
               showCancelButton: true,
               confirmButtonColor: '#36c6d3',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Ya, hapus data',
               cancelButtonText: 'Batalkan'
          }).then(function(result) {
               if (result.value) {
                    $.ajax({
                         type: 'POST',
                         url: "<?=base_url('pelanggaran/hapus/')?>" + id,
                         error: function() {
                              swal('Error',
                                   'Error saat menghapus data pelanggaran',
                                   'error');
                         },
                         success: function(data) {
                              window.location.href =
                                   "http://localhost:8080/hcdata/pelanggaran";
                         }
                    });
               }
          });
     });

     $('#btnupdateLanggar').click(function() {
          let kode = $('#editLanggarKode').val();
          let Langgar = $('#editLanggar').val();
          let status = $('#editLanggarStatus').val();
          let ket = $('#editLanggarKet').val();

          $.ajax({
               type: "POST",
               url: "<?=base_url('pelanggaran/edit_Langgar');?>",
               data: {
                    kode: kode,
                    Langgar: Langgar,
                    status: status,
                    ket: ket
               },
               success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                         tbmLanggar.draw();
                         $("#editLanggarmdl").modal("hide");
                         $(".err_psn_Langgar").removeClass('d-none');
                         $(".err_psn_Langgar").removeClass('alert-danger');
                         $(".err_psn_Langgar").addClass('alert-info');
                         $(".err_psn_Langgar").html(data.pesan);
                         $("#editLanggarKode").val('');
                         $("#editLanggar").val('');
                         $("#editLanggarKet").val('');
                         $("#editLanggarStatus").val('');
                         $("#error1ed").html('');
                         $("#error2ed").html('');
                         $("#error3ed").html('');
                         $(".err_psn_Langgar").fadeTo(3000, 500).slideUp(500,
                              function() {
                                   $(".err_psn_Langgar").slideUp(500);
                              });
                    } else if (data.statusCode == 201 || data.statusCode == 203 ||
                         data.statusCode == 204 || data.statusCode == 205) {
                         $(".err_psn_edit_dprt").removeClass('d-none');
                         $(".err_psn_edit_dprt").removeClass('alert-info');
                         $(".err_psn_edit_dprt").addClass('alert-danger');
                         $(".err_psn_edit_dprt").html(data.pesan);
                         $(".err_psn_edit_dprt").fadeTo(3000, 500).slideUp(500,
                              function() {
                                   $(".err_psn_edit_dprt").slideUp(500);
                              });
                    } else if (data.statusCode == 202) {
                         $("#error1ed").html(data.kode);
                         $("#error2ed").html(data.Langgar);
                         $("#error3ed").html(data.status);
                    }
               },
               error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_Langgar").removeClass("alert-primary");
                    $(".err_psn_Langgar").addClass("alert-danger");
                    $(".err_psn_Langgar").css("display", "block");
                    if (xhr.status == 404) {
                         $(".err_psn_Langgar").html(
                              "pelanggaran gagal diupdate, Link data tidak ditemukan"
                         );
                    } else if (xhr.status == 0) {
                         $(".err_psn_Langgar").html(
                              "pelanggaran gagal diupdate, Waktu koneksi habis");
                    } else {
                         $(".err_psn_Langgar").html(
                              "Terjadi kesalahan saat meng-update data, hubungi administrator"
                         );
                    }
                    $("#editLanggarmdl").modal("hide");
                    $(".err_psn_Langgar ").fadeTo(3000, 500).slideUp(500,
                         function() {
                              $(".err_psn_Langgar ").slideUp(500);
                         });
               }
          })
     });

     $.LoadingOverlay("hide");

     $("#btnBatalLanggar").click(function() {
          $("#perLanggar").val('').trigger('change');
          $("#kodeLanggar").val('');
          $("#Langgar").val('');
          $("#ketLanggar").val('');
          $(".error1").html('');
          $(".error2").html('');
          $(".error3").html('');
     });

     $(document).ready(function() {
          $("#btnTambahLanggar").click(function() {
               var prs = $("#perLanggar").val();
               var kode = $("#kodeLanggar").val();
               var Langgar = $("#Langgar").val();
               var ket = $("#ketLanggar").val();

               $.ajax({
                    type: "POST",
                    url: "<?=base_url("pelanggaran/input_Langgar")?>",
                    data: {
                         prs: prs,
                         kode: kode,
                         Langgar: Langgar,
                         ket: ket
                    },
                    timeout: 20000,
                    success: function(data) {
                         var data = JSON.parse(data);
                         if (data.statusCode == 200) {
                              $(".err_psn_Langgar").removeClass('d-none');
                              $(".err_psn_Langgar").removeClass(
                                   'alert-danger');
                              $(".err_psn_Langgar").addClass('alert-info');
                              $(".err_psn_Langgar").html(data.pesan);
                              $("#perLanggar").val('').trigger('change');
                              $("#kodeLanggar").val('');
                              $("#Langgar").val('');
                              $("#ketLanggar").val('');
                              $(".error1").html('');
                              $(".error2").html('');
                              $(".error3").html('');
                         } else if (data.statusCode == 201) {
                              $(".err_psn_Langgar").removeClass('d-none');
                              $(".err_psn_Langgar").removeClass(
                                   'alert-info');
                              $(".err_psn_Langgar").addClass(
                                   'alert-danger');
                              $(".err_psn_Langgar").html(data.pesan);
                         } else if (data.statusCode == 202) {
                              $(".error1").html(data.prs);
                              $(".error2").html(data.kode);
                              $(".error3").html(data.Langgar);
                         }

                         $(".err_psn_Langgar").fadeTo(3000, 500).slideUp(
                              500,
                              function() {
                                   $(".err_psn_Langgar").slideUp(500);
                              });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_Langgar").removeClass(
                              "alert-primary");
                         $(".err_psn_Langgar").addClass("alert-danger");
                         $(".err_psn_Langgar").css("display", "block");
                         if (xhr.status == 404) {
                              $(".err_psn_Langgar").html(
                                   "pelanggaran gagal disimpan, Link data tidak ditemukan"
                              );
                         } else if (xhr.status == 0) {
                              $(".err_psn_Langgar").html(
                                   "pelanggaran gagal disimpan, Waktu koneksi habis"
                              );
                         } else {
                              $(".err_psn_Langgar").html(
                                   "Terjadi kesalahan saat menghapus data, hubungi administrator"
                              );
                         }

                         $(".err_psn_Langgar ").fadeTo(3000, 500).slideUp(
                              500,
                              function() {
                                   $(".err_psn_Langgar ").slideUp(
                                        500);
                              });
                    }
               })
          });

          $(document).on('click', '.hpsLanggar', function() {
               let authLanggar = $(this).attr('id');
               let namaLanggar = $(this).attr('value');

               if (authLanggar == "") {
                    swal("Error", "pelanggaran tidak ditemukan", "error");
               } else {
                    swal({
                         title: "Hapus",
                         text: "Yakin pelanggaran " + namaLanggar +
                              " akan dihapus?",
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
                                   url: "<?=base_url('pelanggaran/hapus_Langgar');?>",
                                   data: {
                                        authLanggar: authLanggar
                                   },
                                   timeout: 20000,
                                   success: function(data, textStatus,
                                        xhr) {
                                        var data = JSON.parse(
                                             data);
                                        if (data.statusCode ==
                                             200) {
                                             tbmLanggar.draw();
                                             $(".err_psn_Langgar")
                                                  .removeClass(
                                                       "alert-danger"
                                                  );
                                             $(".err_psn_Langgar")
                                                  .addClass(
                                                       "alert-primary"
                                                  );
                                             $(".err_psn_Langgar")
                                                  .css("display",
                                                       "block");
                                             $(".err_psn_Langgar")
                                                  .html(data
                                                       .pesan);
                                        } else {
                                             $(".err_psn_Langgar")
                                                  .removeClass(
                                                       "alert-primary"
                                                  );
                                             $(".err_psn_Langgar")
                                                  .addClass(
                                                       "alert-danger"
                                                  );
                                             $(".err_psn_Langgar")
                                                  .css("display",
                                                       "block");
                                             $(".err_psn_Langgar")
                                                  .html(data
                                                       .pesan);
                                        }

                                        $.LoadingOverlay("hide");
                                   },
                                   error: function(xhr, ajaxOptions,
                                        thrownError) {
                                        $.LoadingOverlay("hide");
                                        $(".err_psn_Langgar")
                                             .removeClass(
                                                  "alert-primary"
                                             );
                                        $(".err_psn_Langgar")
                                             .addClass(
                                                  "alert-danger"
                                             );
                                        $(".err_psn_Langgar")
                                             .css("display",
                                                  "block");
                                        if (xhr.status == 404) {
                                             $(".err_psn_Langgar")
                                                  .html(
                                                       "pelanggaran gagal dihapus, , Link data tidak ditemukan"
                                                  );
                                        } else if (xhr.status ==
                                             0) {
                                             $(".err_psn_Langgar")
                                                  .html(
                                                       "pelanggaran gagal dihapus, Waktu koneksi habis"
                                                  );
                                        } else {
                                             $(".err_psn_Langgar")
                                                  .html(
                                                       "Terjadi kesalahan saat menghapus data, hubungi administrator"
                                                  );
                                        }
                                   }
                              });

                              $(".err_psn_Langgar").fadeTo(4000, 500).slideUp(
                                   500,
                                   function() {
                                        $(".err_psn_Langgar").slideUp(500);
                                   });
                         } else if (result.dismiss == 'cancel') {
                              swal('Batal', 'pelanggaran ' + namaLanggar +
                                   ' batal dihapus', 'error');
                              return false;
                         }
                    });
               }
          });

          $(document).on('click', '.dtlLanggar', function() {
               let authLanggar = $(this).attr('id');
               let namaLanggar = $(this).attr('value');

               if (authLanggar == "") {
                    swal("Error", "pelanggaran tidak ditemukan", "error");
               } else {
                    $.ajax({
                         type: "post",
                         url: "<?=base_url('pelanggaran/detail_Langgar');?>",
                         data: {
                              authLanggar: authLanggar
                         },
                         timeout: 15000,
                         success: function(data) {
                              var data = JSON.parse(data);
                              if (data.statusCode == 200) {
                                   $("#detailLanggarPerusahaan").val(data
                                        .nama_perusahaan);
                                   $("#detailLanggarKode").val(data.kode);
                                   $("#detailLanggar").val(data.Langgar);
                                   $("#detailLanggarStatus").val(data
                                        .status);
                                   $("#detailLanggarKet").val(data.ket);
                                   $("#detailLanggarBuat").val(data
                                        .pembuat);
                                   $("#detailLanggarTglBuat").val(data
                                        .tgl_buat);
                                   $("#detailLanggarmdl").modal("show");
                              } else {
                                   $(".err_psn_Langgar").css("display",
                                        "block");
                                   $(".err_psn_Langgar").html(data.pesan);
                              }
                         },
                         error: function(xhr, ajaxOptions, thrownError) {
                              $.LoadingOverlay("hide");
                              $(".err_psn_Langgar").removeClass(
                                   "alert-primary");
                              $(".err_psn_Langgar").addClass(
                                   "alert-danger");
                              $(".err_psn_Langgar").css("display",
                                   "block");
                              if (xhr.status == 404) {
                                   $(".err_psn_Langgar").html(
                                        "pelanggaran gagal ditampilkan, Link data tidak ditemukan"
                                   );
                              } else if (xhr.status == 0) {
                                   $(".err_psn_Langgar").html(
                                        "pelanggaran gagal ditampilkan, Waktu koneksi habis"
                                   );
                              } else {
                                   $(".err_psn_Langgar").html(
                                        "Terjadi kesalahan saat menampilkan data, hubungi administrator"
                                   );
                              }
                              $(".err_psn_Langgar ").fadeTo(3000, 500)
                                   .slideUp(500, function() {
                                        $(".err_psn_Langgar ")
                                             .slideUp(500);
                                   });
                         }
                    });
               }
          });

          $(document).on('click', '.edttLanggar', function() {
               let authLanggar = $(this).attr('id');
               let namaLanggar = $(this).attr('value');

               if (authLanggar == "") {
                    swal("Error", "pelanggaran tidak ditemukan", "error");
               } else {
                    $.ajax({
                         type: "post",
                         url: "<?=base_url('pelanggaran/detail_Langgar');?>",
                         data: {
                              authLanggar: authLanggar
                         },
                         timeout: 15000,
                         success: function(data) {
                              var data = JSON.parse(data);
                              if (data.statusCode == 200) {
                                   $("#editLanggarKode").val(data.kode);
                                   $("#editLanggar").val(data.Langgar);
                                   $("#editLanggarStatus").val(data
                                        .status);
                                   $("#editLanggarKet").val(data.ket);
                                   $("#editLanggarmdl").modal("show");
                                   $("#error1ed").html('');
                                   $("#error2ed").html('');
                                   $("#error3ed").html('');
                              } else {
                                   $(".err_psn_Langgar").css("display",
                                        "block");
                                   $(".err_psn_Langgar").html(data.pesan);
                              }
                         },
                         error: function(xhr, ajaxOptions, thrownError) {
                              $.LoadingOverlay("hide");
                              $(".err_psn_Langgar").removeClass(
                                   "alert-primary");
                              $(".err_psn_Langgar").addClass(
                                   "alert-danger");
                              $(".err_psn_Langgar").css("display",
                                   "block");
                              if (xhr.status == 404) {
                                   $(".err_psn_Langgar").html(
                                        "pelanggaran gagal ditampilkan, Link data tidak ditemukan"
                                   );
                              } else if (xhr.status == 0) {
                                   $(".err_psn_Langgar").html(
                                        "pelanggaran gagal ditampilkan, Waktu koneksi habis"
                                   );
                              } else {
                                   $(".err_psn_Langgar").html(
                                        "Terjadi kesalahan saat menampilkan data, hubungi administrator"
                                   );
                              }

                              $(".err_psn_Langgar ").fadeTo(3000, 500)
                                   .slideUp(500, function() {
                                        $(".err_psn_Langgar ")
                                             .slideUp(500);
                                   });
                         }
                    });
               }
          });

          $("#btnrefreshLanggar").click(function() {
               $('#tbmLanggar').LoadingOverlay("show");
               tbmLanggar.draw()
               $('#tbmLanggar').LoadingOverlay("hide");
          });

          $("#perLanggarData").change(function() {
               let prs = $("#perLanggarData").val();

               $("#tbmLanggar").LoadingOverlay("show");
               $('#tbmLanggar').DataTable().destroy();
               tbLgr();
          });

          tbLgr()

          function tbLgr() {
               tbmLanggar = $('#tbmLanggar').DataTable({
                    "processing": true,
                    "responsive": true,
                    "serverSide": true,
                    "ordering": true,
                    "order": [
                         [1, 'desc']
                    ],
                    "ajax": {
                         "url": "<?=base_url('pelanggaran/ajax_list?auth_per=');?>" + $(
                                   "#perLanggarData").val() + "&authtoken=" + $("#token")
                              .val(),
                         "type": "POST",
                         "error": function(xhr, error, code) {
                              if (code != "") {
                                   $(".err_psn_Langgar").removeClass("d-none");
                                   $(".err_psn_Langgar").css("display", "block");
                                   $(".err_psn_Langgar").html(
                                        "terjadi kesalahan saat melakukan load data pelanggaran, hubungi administrator"
                                   );
                                   $("#addbtn").addClass("disabled");
                                   $(".err_psn_Langgar ").fadeTo(3000, 500).slideUp(
                                        500,
                                        function() {
                                             $(".err_psn_Langgar ").slideUp(
                                                  500);
                                        });
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
                              name: 'id_langgar',
                              render: function(data, type, row, meta) {
                                   return meta.row + meta.settings
                                        ._iDisplayStart + 1;
                              },
                              "className": "text-center  align-middle",
                              "width": "1%"
                         },
                         {
                              "data": 'no_nik',
                              "className": "align-middle",
                              "width": "10%"
                         },
                         {
                              "data": 'nama_lengkap',
                              "className": "text-nowrap  align-middle",
                              "width": "15%"
                         },
                         {
                              "data": 'depart',
                              "className": "align-middle",
                              "width": "15%"
                         },
                         {
                              "data": 'langgar_jenis',
                              "className": "text-nowrap  align-middle",
                              "width": "15%"
                         },
                         {
                              "data": 'tgl_akhir_langgar',
                              "className": "text-nowrap align-middle",
                              "width": "10%"
                         },
                         {
                              "data": 'stat_langgar',
                              "className": "text-center text-nowrap align-middle",
                              "width": "1%"
                         },
                         {
                              "data": 'kode_perusahaan',
                              "className": "text-center text-nowrap align-middle",
                              "width": "1%"
                         },
                         {
                              "data": 'proses',
                              "className": "text-center text-nowrap align-middle",
                              "width": "1%"
                         }
                    ]
               });

               $("#tbmLanggar").LoadingOverlay("hide");
          }
     });
});
</script>