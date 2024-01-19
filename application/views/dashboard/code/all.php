<script>
$.LoadingOverlaySetup({
     background: "rgba(255, 255, 255, 1)",
});

function karysum() {
     $.LoadingOverlay('show');
     $('#detailkarysum').modal(
          'show'
     );

     let tglaktif = $('#txtTglAktifPRs').val();
     $('#tbmJmlKryPrs').load(site_url + "dash/show_jml_kary?ta=0");
}

$("#btnResetFilter").click(function() {
     $.LoadingOverlay('show');
     $('#tbmJmlKryPrs').load(site_url + "dash/show_jml_kary?ta=0");
});

$("#btnFilterJmlKary").click(function() {
     $.LoadingOverlay('show');
     $('#filtertglkarysum').modal(
          'hide'
     );

     let tglaktif = $('#txtTglAktifPRs').val();
     $('#tbmJmlKryPrs').load(site_url + "dash/show_jml_kary?ta=" + tglaktif);
});

$("#btnFilterDOH").click(function() {
     $.LoadingOverlay('show');
     $('#filtertglkarysum').modal(
          'show'
     );
     $.LoadingOverlay('hide');
});

     $(function() {
          var options = {
               chart: {
                    height: 764,
                    type: 'bar',
               },
               plotOptions: {
                    bar: {
                         horizontal: true,
                         dataLabels: {
                              position: 'top',
                         },
                    },
               },
               dataLabels: {
                    enabled: true
               },
               colors: ["#0e9e4a", "#4680ff", "#ff5252"],
               stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
               },
               series: [],
               noData: {
                    text: 'Loading...'
               },
               yaxis: {
                    title: {
                         text: 'Jumlah Karyawan'
                    }
               },
               fill: {
                    opacity: 1

               },
               tooltip: {
                    y: {
                         formatter: function(val) {
                              return val + " Orang"
                         }
                    }
               }
          }
          var chart = new ApexCharts(
               document.querySelector("#bar-chart-1"),
               options
          );
          chart.render();

          var url = '<?= base_url('dash/gt_data'); ?>';
          $.getJSON(url, function(response) {
               chart.updateSeries([{
                    name: 'Jml Karyawan : ',
                    data: response
               }])
          });
     });
</script>
<script>
     $(function() {
          var options = {
               chart: {
                    height: 230,
                    type: 'bar',
               },
               plotOptions: {
                    bar: {
                         dataLabels: {
                              position: 'top',
                         },
                    },
               },
               dataLabels: {
                    enabled: true
               },
               stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
               },
               series: [],
               noData: {
                    text: 'Loading...'
               },
               yaxis: {
                    title: {
                         text: 'Jenis Kelamin'
                    }
               },
               fill: {
                    opacity: 1

               },
               tooltip: {
                    y: {
                         formatter: function(val) {
                              return val + " Orang"
                         }
                    }
               }
          }
          var chart = new ApexCharts(
               document.querySelector("#bar-chart-2"),
               options
          );
          chart.render();

          var url = '<?= base_url('dash/gt_gender'); ?>';
          $.getJSON(url, function(response) {
               chart.updateSeries([{
                    name: 'Jml Karyawan : ',
                    data: response
               }])
          });
     });
</script>
<script>
     $(function() {
          var options = {
               chart: {
                    height: 230,
                    type: 'bar',
               },
               plotOptions: {
                    bar: {
                         dataLabels: {
                              position: 'top',
                         },
                    },
               },
               dataLabels: {
                    enabled: true
               },
               stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
               },
               series: [],
               noData: {
                    text: 'Loading...'
               },
               yaxis: {
                    title: {
                         text: 'Lokasi Terima'
                    }
               },
               fill: {
                    opacity: 1

               },
               tooltip: {
                    y: {
                         formatter: function(val) {
                              return val + " Orang"
                         }
                    }
               }
          }
          var chart = new ApexCharts(
               document.querySelector("#bar-chart-3"),
               options
          );
          chart.render();

          var url = '<?= base_url('dash/gt_jlok'); ?>';
          $.getJSON(url, function(response) {
               chart.updateSeries([{
                    name: 'Jml Karyawan : ',
                    data: response
               }])
          });
     });
</script>
<script>
     $(function() {
          var options = {
               chart: {
                    height: 300,
                    type: 'bar',
               },
               plotOptions: {
                    bar: {
                         dataLabels: {
                              position: 'top',
                         },
                    },
               },
               dataLabels: {
                    enabled: true
               },
               colors: ["#0e9e4a", "#4680ff", "#ff5252"],
               stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
               },
               series: [],
               noData: {
                    text: 'Loading...'
               },
               yaxis: {
                    title: {
                         text: 'Klasifikasi'
                    }
               },
               fill: {
                    opacity: 1

               },
               tooltip: {
                    y: {
                         formatter: function(val) {
                              return val + " Orang"
                         }
                    }
               }
          }
          var chart = new ApexCharts(
               document.querySelector("#bar-chart-4"),
               options
          );
          chart.render();

          var url = '<?= base_url('dash/gt_kls'); ?>';
          $.getJSON(url, function(response) {
               chart.updateSeries([{
                    name: 'Jml Karyawan : ',
                    data: response
               }])
          });
     });
</script>
<script>
     $(function() {
          var options = {
               chart: {
                    height: 300,
                    type: 'bar',
               },
               plotOptions: {
                    bar: {
                         dataLabels: {
                              position: 'top',
                         },
                    },
               },
               dataLabels: {
                    enabled: true
               },
               colors: ["#0e9e4a", "#4680ff", "#ff5252"],
               stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
               },
               series: [],
               noData: {
                    text: 'Loading...'
               },
               yaxis: {
                    title: {
                         text: 'Pendidikan'
                    }
               },
               fill: {
                    opacity: 1

               },
               tooltip: {
                    y: {
                         formatter: function(val) {
                              return val + " Orang"
                         }
                    }
               }
          }
          var chart = new ApexCharts(
               document.querySelector("#bar-chart-5"),
               options
          );
          chart.render();

          var url = '<?= base_url('dash/gt_didik'); ?>';
          $.getJSON(url, function(response) {
               chart.updateSeries([{
                    name: 'Jml Karyawan : ',
                    data: response
               }])
          });
     });
</script>
<script>
     $(function() {
          var options = {
               chart: {
                    height: 300,
                    type: 'bar',
               },
               plotOptions: {
                    bar: {
                         dataLabels: {
                              position: 'top',
                         },
                    },
               },
               dataLabels: {
                    enabled: true
               },
               stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
               },
               series: [],
               noData: {
                    text: 'Loading...'
               },
               yaxis: {
                    title: {
                         text: 'Status Tinggal'
                    }
               },
               fill: {
                    opacity: 1

               },
               tooltip: {
                    y: {
                         formatter: function(val) {
                              return val + " Orang"
                         }
                    }
               }
          }
          var chart = new ApexCharts(
               document.querySelector("#bar-chart-6"),
               options
          );
          chart.render();

          var url = '<?= base_url('dash/gt_stt_tinggal'); ?>';
          $.getJSON(url, function(response) {
               chart.updateSeries([{
                    name: 'Jml Karyawan : ',
                    data: response
               }])
          });
     });
</script>
<script>
     $(function() {
          var options = {
               chart: {
                    height: 300,
                    type: 'bar',
               },
               plotOptions: {
                    bar: {
                         dataLabels: {
                              position: 'top',
                         },
                    },
               },
               dataLabels: {
                    enabled: true
               },
               stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
               },
               series: [],
               noData: {
                    text: 'Loading...'
               },
               yaxis: {
                    title: {
                         text: 'Sertifikasi'
                    }
               },
               fill: {
                    opacity: 1

               },
               tooltip: {
                    y: {
                         formatter: function(val) {
                              return val + " Orang"
                         }
                    }
               }
          }
          var chart = new ApexCharts(
               document.querySelector("#bar-chart-7"),
               options
          );
          chart.render();

          var url = '<?= base_url('dash/gt_srt'); ?>';
          $.getJSON(url, function(response) {
               chart.updateSeries([{
                    name: 'Jml Karyawan : ',
                    data: response
               }])
          });
     });
</script>
<script>
     //========================================== StatJanji ========================================================
     $(document).ready(function() {

          $("#logout").click(function() {
               $("#logoutmdl").modal("show");
          });

          $('#btnupdateStatJanji').click(function() {
               let kode = $('#editStatJanjiKode').val();
               let stat_perjanjian = $('#editStatJanji').val();
               let status = $('#editStatJanjiStatus').val();
               let ket = $('#editStatJanjiKet').val();

               $.ajax({
                    type: "POST",
                    url: "<?= base_url('perjanjian/edit_stat_perjanjian'); ?>",
                    data: {
                         kode: kode,
                         stat_perjanjian: stat_perjanjian,
                         status: status,
                         ket: ket
                    },
                    success: function(data) {
                         alert(data);
                         var data = JSON.parse(data);
                         if (data.statusCode == 200) {
                              tbmStatJanji.draw();
                              $("#editStatJanjimdl").modal("hide");
                              $(".err_psn_statjanji").removeClass('d-none');
                              $(".err_psn_statjanji").removeClass('alert-danger');
                              $(".err_psn_statjanji").addClass('alert-info');
                              $(".err_psn_statjanji").html(data.pesan);
                              $("#editStatJanjiKode").val('');
                              $("#editStatJanji").val('');
                              $("#editStatJanjiKet").val('');
                              $("#editStatJanjiStatus").val('');
                              $("#error1est").html('');
                              $("#error2est").html('');
                              $("#error3est").html('');
                              $("#error4est").html('');
                              $(".err_psn_statjanji").fadeTo(3000, 500).slideUp(500, function() {
                                   $(".err_psn_statjanji").slideUp(500);
                              });
                         } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                              $(".err_psn_edit_statjanji").removeClass('d-none');
                              $(".err_psn_edit_statjanji").removeClass('alert-info');
                              $(".err_psn_edit_statjanji").addClass('alert-danger');
                              $(".err_psn_edit_statjanji").html(data.pesan);
                              $(".err_psn_edit_statjanji").fadeTo(3000, 500).slideUp(500, function() {
                                   $(".err_psn_edit_statjanji").slideUp(500);
                              });
                              $("#error1est").html('');
                              $("#error2est").html('');
                              $("#error3est").html('');
                              $("#error4est").html('');
                         } else if (data.statusCode == 202) {
                              $("#error1est").html(data.kode);
                              $("#error2est").html(data.stat_perjanjian);
                              $("#error3est").html(data.status);
                              $("#error4est").html(data.ket);
                         }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_statjanji").removeClass("alert-primary");
                         $(".err_psn_statjanji").addClass("alert-danger");
                         $(".err_psn_statjanji").css("display", "block");
                         if (xhr.status == 404) {
                              $(".err_psn_statjanji").html("StatJanji gagal diupdate, Link data tidak ditemukan");
                         } else if (xhr.status == 0) {
                              $(".err_psn_statjanji").html("StatJanji gagal diupdate, Waktu koneksi habis");
                         } else {
                              $(".err_psn_statjanji").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                         }
                         $("#editStatJanjimdl").modal("hide");
                         $(".err_psn_statjanji ").fadeTo(3000, 500).slideUp(500, function() {
                              $(".err_psn_statjanji ").slideUp(500);
                         });
                    }
               })
          });

          $.LoadingOverlay("hide");

          $("#btnBatalStatJanji").click(function() {
               $("#perStatJanji").val('').trigger('change');
               $("#kodeStatJanji").val('');
               $("#StatJanji").val('');
               $("#ketStatJanji").val('');
               $(".error1").html('');
               $(".error2").html('');
               $(".error3").html('');
               $(".error4").html('');
               $(".error5").html('');
          });

          $(document).ready(function() {
               $('#perStatJanji').select2({
                    theme: 'bootstrap4'
               });

               $.ajax({
                    type: "POST",
                    url: "<?= base_url("perusahaan/get_all") ?>",
                    data: {},
                    success: function(data) {
                         var data = JSON.parse(data);
                         $("#perStatJanji").html(data.prs);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                         $.LoadingOverlay("hide");
                         $(".err_psn_statjanji").removeClass('d-none');
                         $(".err_psn_statjanji").removeClass('alert-info');
                         $(".err_psn_statjanji").addClass('alert-danger');
                         if (thrownError != "") {
                              $(".err_psn_statjanji").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                              $("#btnTambahStatJanji").attr("disabled", true);
                         }
                    }
               });
               $("#btnTambahStatJanji").click(function() {
                    var prs = $("#perStatJanji").val();
                    var kode = $("#kodeStatJanji").val();
                    var stat_perjanjian = $("#StatJanji").val();
                    var ket = $("#ketStatJanji").val();

                    $.ajax({
                         type: "POST",
                         url: "<?= base_url("perjanjian/input_stat_perjanjian") ?>",
                         data: {
                              prs: prs,
                              kode: kode,
                              stat_perjanjian: stat_perjanjian,
                              ket: ket
                         },
                         timeout: 20000,
                         success: function(data) {
                              var data = JSON.parse(data);
                              if (data.statusCode == 200) {
                                   $(".err_psn_statjanji").removeClass('d-none');
                                   $(".err_psn_statjanji").removeClass('alert-danger');
                                   $(".err_psn_statjanji").addClass('alert-info');
                                   $(".err_psn_statjanji").html(data.pesan);
                                   $("#perStatJanji").val('').trigger('change');
                                   $("#kodeStatJanji").val('');
                                   $("#StatJanji").val('');
                                   $("#ketStatJanji").val('');
                                   $(".error1").html('');
                                   $(".error2").html('');
                                   $(".error3").html('');
                                   $(".error4").html('');
                              } else if (data.statusCode == 201) {
                                   $(".err_psn_statjanji").removeClass('d-none');
                                   $(".err_psn_statjanji").removeClass('alert-info');
                                   $(".err_psn_statjanji").addClass('alert-danger');
                                   $(".err_psn_statjanji").html(data.pesan);
                              } else if (data.statusCode == 202) {
                                   $(".error1").html(data.prs);
                                   $(".error2").html(data.kode);
                                   $(".error3").html(data.stat_perjanjian);
                                   $(".error4").html(data.ket);
                              }

                              $(".err_psn_statjanji").fadeTo(3000, 500).slideUp(500, function() {
                                   $(".err_psn_statjanji").slideUp(500);
                              });
                         },
                         error: function(xhr, ajaxOptions, thrownError) {
                              $.LoadingOverlay("hide");
                              $(".err_psn_statjanji").removeClass("alert-primary");
                              $(".err_psn_statjanji").addClass("alert-danger");
                              $(".err_psn_statjanji").css("display", "block");
                              if (xhr.status == 404) {
                                   $(".err_psn_statjanji").html("StatJanji gagal disimpan, Link data tidak ditemukan");
                              } else if (xhr.status == 0) {
                                   $(".err_psn_statjanji").html("StatJanji gagal disimpan, Waktu koneksi habis");
                              } else {
                                   $(".err_psn_statjanji").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                              }

                              $(".err_psn_statjanji ").fadeTo(3000, 500).slideUp(500, function() {
                                   $(".err_psn_statjanji ").slideUp(500);
                              });
                         }
                    })
               });

               $(document).on('click', '.hpsstat_perjanjian', function() {
                    let auth_stat_perjanjian = $(this).attr('id');
                    let namaStatJanji = $(this).attr('value');

                    if (auth_stat_perjanjian == "") {
                         swal("Error", "Status perjanjian tidak ditemukan", "error");
                    } else {
                         swal({
                              title: "Hapus",
                              text: "Yakin status perjanjian " + namaStatJanji + " akan dihapus?",
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
                                        url: "<?= base_url('perjanjian/hapus_stat_perjanjian'); ?>",
                                        data: {
                                             auth_stat_perjanjian: auth_stat_perjanjian
                                        },
                                        timeout: 20000,
                                        success: function(data, textStatus, xhr) {
                                             var data = JSON.parse(data);
                                             if (data.statusCode == 200) {
                                                  tbmStatJanji.draw();
                                                  $(".err_psn_statjanji").removeClass("d-none");
                                                  $(".err_psn_statjanji").removeClass("alert-danger");
                                                  $(".err_psn_statjanji").addClass("alert-primary");
                                                  $(".err_psn_statjanji").html(data.pesan);
                                             } else {
                                                  $(".err_psn_statjanji").removeClass("alert-primary");
                                                  $(".err_psn_statjanji").addClass("alert-danger");
                                                  $(".err_psn_statjanji").css("display", "block");
                                                  $(".err_psn_statjanji").html(data.pesan);
                                             }

                                             $.LoadingOverlay("hide");
                                        },
                                        error: function(xhr, ajaxOptions, thrownError) {
                                             $.LoadingOverlay("hide");
                                             $(".err_psn_statjanji").removeClass("d-none");
                                             $(".err_psn_statjanji").removeClass("alert-primary");
                                             $(".err_psn_statjanji").addClass("alert-danger");
                                             if (xhr.status == 404) {
                                                  $(".err_psn_statjanji").html("StatJanji gagal dihapus, , Link data tidak ditemukan");
                                             } else if (xhr.status == 0) {
                                                  $(".err_psn_statjanji").html("StatJanji gagal dihapus, Waktu koneksi habis");
                                             } else {
                                                  $(".err_psn_statjanji").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                             }
                                        }
                                   });

                                   $(".err_psn_statjanji").fadeTo(3000, 500).slideUp(500, function() {
                                        $(".err_psn_statjanji").slideUp(500);
                                   });
                              } else if (result.dismiss == 'cancel') {
                                   swal('Batal', 'Status Perjanjian ' + namaStatJanji + ' batal dihapus', 'error');
                                   return false;
                              }
                         });
                    }
               });

               $(document).on('click', '.dtlstat_perjanjian', function() {
                    let auth_stat_perjanjian = $(this).attr('id');
                    let namaStatJanji = $(this).attr('value');

                    if (auth_stat_perjanjian == "") {
                         swal("Error", "Status Perjanjian tidak ditemukan", "error");
                    } else {
                         $.ajax({
                              type: "post",
                              url: "<?= base_url('perjanjian/detail_stat_perjanjian'); ?>",
                              data: {
                                   auth_stat_perjanjian: auth_stat_perjanjian
                              },
                              timeout: 15000,
                              success: function(data) {
                                   var data = JSON.parse(data);
                                   if (data.statusCode == 200) {
                                        $("#detailStatJanjiPerusahaan").val(data.nama_perusahaan);
                                        $("#detailStatJanjiDepart").val(data.depart);
                                        $("#detailStatJanjiKode").val(data.kode);
                                        $("#detailStatJanji").val(data.stat_perjanjian);
                                        $("#detailStatJanjiStatus").val(data.status);
                                        $("#detailStatJanjiKet").val(data.ket);
                                        $("#detailStatJanjiBuat").val(data.pembuat);
                                        $("#detailStatJanjiTglBuat").val(data.tgl_buat);
                                        $("#detailStatJanjimdl").modal("show");
                                   } else {
                                        $(".err_psn_statjanji").css("display", "block");
                                        $(".err_psn_statjanji").html(data.pesan);
                                   }
                              },
                              error: function(xhr, ajaxOptions, thrownError) {
                                   $.LoadingOverlay("hide");
                                   $(".err_psn_statjanji").removeClass("alert-primary");
                                   $(".err_psn_statjanji").addClass("alert-danger");
                                   $(".err_psn_statjanji").css("display", "block");
                                   if (xhr.status == 404) {
                                        $(".err_psn_statjanji").html("Status Perjanjian gagal ditampilkan, Link data tidak ditemukan");
                                   } else if (xhr.status == 0) {
                                        $(".err_psn_statjanji").html("Status Perjanjian gagal ditampilkan, Waktu koneksi habis");
                                   } else {
                                        $(".err_psn_statjanji").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                                   }
                                   $(".err_psn_statjanji ").fadeTo(3000, 500).slideUp(500, function() {
                                        $(".err_psn_statjanji ").slideUp(500);
                                   });
                              }
                         });
                    }
               });

               $(document).on('click', '.edttstat_perjanjian', function() {
                    let auth_stat_perjanjian = $(this).attr('id');
                    let namaStatJanji = $(this).attr('value');

                    if (auth_stat_perjanjian == "") {
                         swal("Error", "Status Perjanjian tidak ditemukan", "error");
                    } else {
                         $.ajax({
                              type: "post",
                              url: "<?= base_url('perjanjian/detail_stat_perjanjian'); ?>",
                              data: {
                                   auth_stat_perjanjian: auth_stat_perjanjian
                              },
                              timeout: 15000,
                              success: function(data) {
                                   var dataStatJanji = JSON.parse(data);
                                   if (dataStatJanji.statusCode == 200) {
                                        $("#editStatJanjiKode").val(dataStatJanji.kode);
                                        $("#editStatJanji").val(dataStatJanji.stat_perjanjian);
                                        $("#editStatJanjiStatus").val(dataStatJanji.status);
                                        $("#editStatJanjiKet").val(dataStatJanji.ket);
                                        $("#editStatJanjimdl").modal("show");
                                        $("#error1et").html('');
                                        $("#error2et").html('');
                                        $("#error3et").html('');
                                        $("#error4et").html('');
                                   } else {
                                        $(".err_psn_statjanji").css("display", "block");
                                        $(".err_psn_statjanji").html(data.pesan);
                                   }
                              },
                              error: function(xhr, ajaxOptions, thrownError) {
                                   $.LoadingOverlay("hide");
                                   $(".err_psn_statjanji").removeClass("alert-primary");
                                   $(".err_psn_statjanji").addClass("alert-danger");
                                   $(".err_psn_statjanji").css("display", "block");
                                   if (xhr.status == 404) {
                                        $(".err_psn_statjanji").html("StatJanji gagal ditampilkan, Link data tidak ditemukan");
                                   } else if (xhr.status == 0) {
                                        $(".err_psn_statjanji").html("StatJanji gagal ditampilkan, Waktu koneksi habis");
                                   } else {
                                        $(".err_psn_statjanji").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                                   }

                                   $(".err_psn_statjanji ").fadeTo(3000, 500).slideUp(500, function() {
                                        $(".err_psn_statjanji ").slideUp(500);
                                   });
                              }
                         });
                    }
               });

               $("#btnrefreshStatJanji").click(function() {
                    $('#tbmStatJanji').LoadingOverlay("show");
                    tbmStatJanji.draw()
                    $('#tbmStatJanji').LoadingOverlay("hide");
               });

		 tbmkarysum = $('#tbmkarysum').DataTable({
               "aLengthMenu": [
                    [7, 23, 50, 100],
                    [7, 23, 50, 100]
               ],
          });               tbmStatJanji = $('#tbmStatJanji').DataTable({
                    "processing": true,
                    "responsive": true,
                    "serverSide": true,
                    "ordering": true,
                    "order": [
                         [1, 'asc'],
                    ],
                    "ajax": {
                         "url": "<?= base_url('perjanjian/ajax_list'); ?>",
                         "type": "POST",
                         "error": function(xhr, error, code) {
                              if (code != "") {
                                   $(".err_psn_statjanji").removeClass("d-none");
                                   $(".err_psn_statjanji").css("display", "block");
                                   $(".err_psn_statjanji").html("terjadi kesalahan saat melakukan load data perjanjian, hubungi administrator");
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
                              name: 'id_stat_perjanjian',
                              render: function(data, type, row, meta) {
                                   return meta.row + meta.settings._iDisplayStart + 1;
                              },
                              "className": "text-center",
                              "width": "1%"
                         },
                         {
                              "data": 'kd_stat_perjanjian',
                              "width": "5%"
                         },
                         {
                              "data": 'stat_perjanjian',
                              "className": "text-nowrap",
                              "width": "30%"
                         },
                         {
                              "data": 'stat_stat_perjanjian',
                              "className": "text-center text-nowrap",
                              "width": "1%"
                         },
                         {
                              "data": 'kode_perusahaan',
                              "className": "text-center text-nowrap",
                              "width": "1%"
                         },
                         {
                              "data": 'tgl_buat',
                              "className": "text-center text-nowrap",
                              "width": "1%"
                         },
                         {
                              "data": 'proses',
                              "className": "text-center text-nowrap",
                              "width": "1%"
                         }
                    ]
               });
          });

     });
</script>
<script>
     //========================================== data langgar aktif ========================================================
     $(document).ready(function() {
        $("#detLanggar").click(function() {
            let prs = $('#perDetLgrAktif').val();

            $.LoadingOverlay('show');
            $('#mdlDetLanggarAktif').modal('show');
            $('#tbLanggarAktif').load(site_url + "dash/data_langgar_aktif/" + prs);
        });
     });
</script>

</body>

</html>