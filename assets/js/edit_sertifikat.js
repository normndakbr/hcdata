$(document).ready(function () {
  var token = $("#token").val();
  let auth_person = $("#valueAuthPersonal").val();

  // Format Tanggal
  function formatDate(inputDate) {
    // Define month names
    const months = [
      'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ];
  
    // Create a Date object from the input string
    const date = new Date(inputDate);
  
    // Extract day, month, and year
    const day = date.getDate();
    const month = months[date.getMonth()];
    const year = date.getFullYear();
  
    // Create the formatted date string
    const formattedDate = day + '-' + month + '-' + year;
  
    return formattedDate;
  }
  
  $.ajax({
    type: "POST",
    url: site_url + "vaksin/get_vaksin_jenis_all",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#jenisVaksin").html(data.jvks);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".erroreditvaksin").removeClass("d-none");
      if (thrownError != "") {
        $(".erroreditvaksin").html(
          "Terjadi kesalahan saat load data jenis vaksin, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "vaksin/get_vaksin_nama_all",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#namaVaksin").html(data.nvks);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".erroreditvaksin").removeClass("d-none");
      if (thrownError != "") {
        $(".erroreditvaksin").html(
          "Terjadi kesalahan saat load data nama vaksin, hubungi administrator"
        );
      }
    },
  });

  $("#idEditSertifikat").load(
    site_url + "karyawan/sertifikasi?auth_person=" + auth_person
  );
  $("#idEditVaccine").load(
    site_url + "karyawan/vaksin?auth_person=" + auth_person + "&status=edit"
  );
  $("#dataEditMCU").load(
    site_url + "karyawan/dataMCU?auth_person=" + auth_person
  );

  $(document).on("click", ".detail_sertifikasi", function () {
    let auth_sertifikat = $(this).attr("id");

    $.ajax({
      type: "POST",
      url: site_url + "sertifikasi/get_sertifikasi",
      data: {
        auth_sertifikat: auth_sertifikat,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#mdldetailsertifikat").modal("show");
        $("#jdldetailsertifikat").text(
          data.no_sertifikat + " | " + data.jenis_sertifikasi
        );
        $("#jenisSertifikasiDetail").val(data.jenis_sertifikasi);
        $("#noSertifikatDetail").val(data.no_sertifikasi);
        $("#namaLembagaDetail").val(data.lembaga);
        $("#tanggalSertifikasiDetail").val(data.tgl_sertifikasi_show);
        $("#tanggalSertifikasiAkhirDetail").val(
          data.tgl_berakhir_sertifikasi_show
        );
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errsertifikatdetail").removeClass("d-none");
        $(".errsertifikatdetail").removeClass("alert-info");
        $(".errsertifikatdetail").addClass("alert-danger");
        if (thrownError != "") {
          $(".errsertifikatdetail").html(
            "Terjadi kesalahan saat load data sertifikasi, hubungi administrator"
          );
        }
      },
    });
  });

  $("#btnEditReuploadSertifikat").click(function () {
    let auth_ser = $(".9f7fjmuj8ik2js4n8k66g3hjl323").text();
    let auth_person = $("#valueAuthPersonal").val();
    let filesrt = $("#fileSertifikasiUlang").val();
    const flsert = $("#fileSertifikasiUlang").prop("files")[0];

    if (filesrt == "") {
      $(".errorFileSertifikasiUlang").text("File sertifikat wajib dipilih");
      return false;
    }

    swal({
      title: "Upload Ulang Sertifikat",
      text: "Yakin sertifikat akan di-upload ulang",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, upload",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        let formData = new FormData();
        formData.append("filesertifikat", flsert);
        formData.append("filesrt", filesrt);
        formData.append("auth_ser", auth_ser);
        formData.append("auth_person", auth_person);
        $.LoadingOverlay("show");
        $.ajax({
          type: "POST",
          url: site_url + "sertifikasi/upload_ulang_ser",
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          success: function (data) {
            var data = JSON.parse(data);
            if (data.statusCode == 200) {
              $("#mdluploadulangser").modal("hide");
              $("#fileSertifikasiUlang").val("");
              $(".errorFileSertifikasiUlang").text("");
              $(".9f7fjmuj8ik2js4n8k66g3hjl323").text("");
              $.LoadingOverlay("hide");
              $("#idsertifikat").LoadingOverlay("show");
              $("#idsertifikat").load(
                site_url + "karyawan/sertifikasi?auth_person=" + auth_person
              );
            } else if (data.statusCode == 201) {
              $(".erruploadulangser").removeClass("d-none");
              $(".erruploadulangser").removeClass("alert-primary");
              $(".erruploadulangser").addClass("alert-danger");
              $(".erruploadulangser").html(data.pesan);
              $.LoadingOverlay("hide");
            } else {
              $(".errorFileSertifikasiUlang").html(data.pesan);
              $.LoadingOverlay("hide");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".erruploadulangser").removeClass("d-none");
            $(".erruploadulangser").addClass("alert-danger");
            if (thrownError != "") {
              $(".erruploadulangser").html(
                "Terjadi kesalahan saat meng-upload data sertifikat, hubungi administrator"
              );
            }
          },
        });
      } else {
        swal.close();
      }
    });
  });

  $("#masaBerlakuSertifikatEdit").change(function () {
    let tglsrt = $("#tanggalSertifikasiEdit").val();
    let masa = $("#masaBerlakuSertifikatEdit").val();

    $.ajax({
      type: "post",
      url: site_url + "sertifikasi/getdateexpmasa",
      data: {
        tglsrt: tglsrt,
        masa: masa,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#tanggalSertifikasiAkhirEdit").val(data.tglexp);
        }
      },
    });
  });

  $("#btnSimpanEditSertifikat").click(function () {
    let auth_ser = $(".7u67u834hs7dg4haj231hh67ju7a2").text();
    let jenis_ser = $("#jenisSertifikasiEdit").val();
    let no_ser = $("#noSertifikatEdit").val();
    let lembaga = $("#namaLembagaEdit").val();
    let tgl_ser = $("#tanggalSertifikasiEdit").val();
    let tgl_akhir = $("#tanggalSertifikasiAkhirEdit").val();

    $.ajax({
      type: "POST",
      url: site_url + "sertifikasi/update_sertifikasi",
      data: {
        auth_ser: auth_ser,
        jenis_ser: jenis_ser,
        no_ser: no_ser,
        lembaga: lembaga,
        tgl_ser: tgl_ser,
        tgl_akhir: tgl_akhir,
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 202) {
          $(".errorjenisSertifikasiEdit").html(data.jenis_ser);
          $(".errorNoSertifikatEdit").html(data.no_ser);
          $(".errorNamaLembagaEdit").html(data.lembaga);
          $(".errorTanggalSertifikasiEdit").html(data.tgl_ser);
          $(".errorTanggalSertifikasiAkhir").html(data.tgl_akhir);
        } else {
          $("#mdleditsertifikat").modal("hide");
          $("#idEditSertifikat").LoadingOverlay("show");
          $("#idEditSertifikat").load(
            site_url + "karyawan/sertifikasi?auth_person=" + auth_person
          );
          $("#idEditSertifikat").LoadingOverlay("hide");
          swal("Berhasil", data.pesan, "success");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".erreditsertifikat").removeClass("d-none");
        $(".erreditsertifikat").removeClass("alert-info");
        $(".erreditsertifikat").addClass("alert-danger");
        if (thrownError != "") {
          $(".erreditsertifikat").html(
            "Terjadi kesalahan saat update sertifikat, hubungi administrator"
          );
        }
      },
    });
  });

  $(document).on("click", ".editVaccine", function () {
    let auth_vaksin = $(this).attr("id");
    $(".fb19rg2hrr2hr52980r2").text(auth_vaksin);
    $.ajax({
      type: "GET",
      url: site_url + "karyawan/vaksin_kary",
      data: {
        auth_vaksin: auth_vaksin,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $('#jenisVaksin option[value="0"]').remove();
        $('#namaVaksin option[value="0"]').remove();
        $("#jenisVaksin").select2({
          dropdownParent: $('#mdlEditVaksin'),
          theme: "bootstrap4"
        });
        $("#namaVaksin").select2({
          dropdownParent: $('#mdlEditVaksin'),
          theme: "bootstrap4"
        });
        $("#jenisVaksin").val(data.id_vaksin_jenis).trigger("change");
        $("#namaVaksin").val(data.id_vaksin_nama).trigger("change");
        $("#tanggalVaksin").val(data.tgl_vaksin);
        $(".b912rgh298htrnt8").text(data.id_vaksin);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".erroreditvaksin").removeClass("d-none");
        if (thrownError != "") {
          $(".erroreditvaksin").html(
            "Terjadi kesalahan saat load data vaksin karyawan, hubungi administrator"
          );
        }
      },
    });
    $("#mdlEditVaksin").modal("show");
  });

  $("#updateDataVaksin").submit(function () {
    let id_vaksin = $(".b912rgh298htrnt8").text();
    let nama_vaksin = $("#namaVaksin").val();
    let tgl_vaksin = $("#tanggalVaksin").val();
    $.ajax({
      type: "POST",
      url: site_url + "karyawan/update_vaksin",
      data: {
        token: token,
        id_vaksin: id_vaksin,
        nama_vaksin: nama_vaksin,
        tgl_vaksin: tgl_vaksin,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#idEditVaccine").LoadingOverlay("show");
          $("#idEditVaccine").load(
            site_url + "karyawan/vaksin?auth_person=" + auth_person
          );
          $("#idEditVaccine").LoadingOverlay("hide");
          swal("Berhasil", data.pesan, "success");
          $("#mdlEditVaksin").modal("hide");
        } else if (data.statusCode == 201) {
          swal("Gagal", data.pesan, "error");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".erroreditvaksin").removeClass("d-none");
        if (thrownError != "") {
          $(".erroreditvaksin").html(
            "Terjadi kesalahan saat edit data vaksin, hubungi administrator"
          );
        }
      },
    });
  });

  $(document).on("click", ".editHapusVaccine", function () {
    let auth_vaksin = $(this).attr("id");

    swal({
      title: "Validasi",
      text: "Hapus data vaksin?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: site_url + "karyawan/hapus_vaksin",
          data: {
            auth_vaksin: auth_vaksin,
            token: token,
          },
          success: function (data) {
            var data = JSON.parse(data);
            if (data.statusCode == 200) {
              $("#idEditVaccine").LoadingOverlay("show");
              $("#idEditVaccine").load(
                site_url + "karyawan/vaksin?auth_person=" + auth_person
              );
              $("#idEditVaccine").LoadingOverlay("hide");
              swal("Berhasil", data.pesan, "success");
            } else if (data.statusCode == 201) {
              swal("Error", data.pesan, "error");
            } else {
              $.LoadingOverlay("hide");
              $(".errormsgvaksin").removeClass("d-none");
              $(".errormsgvaksin").removeClass("alert-info");
              $(".errormsgvaksin").addClass("alert-danger");
              $(".errormsgvaksin").html(data.pesan);
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsgvaksin").removeClass("d-none");
            $(".errormsgvaksin").removeClass("alert-info");
            $(".errormsgvaksin").addClass("alert-danger");
            if (thrownError != "") {
              $(".errormsgvaksin").html(
                "Terjadi kesalahan saat menghapus vaksin, hubungi administrator"
              );
            }
          },
        });
      } else {
        swal.close();
      }
    });
  });

  $(document).on("click", ".detailMCU", function () {
    let auth_mcu = $(this).attr("id");

    $.ajax({
      type: "GET",
      url: site_url + "karyawan/dataMCU_by_id",
      data: {
        id: auth_mcu,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#tanggalMCU").val(formatDate(data.tgl_mcu));
        $("#hasilMCU").val(data.mcu_jenis);
        $("#keteranganMCU").val(data.ket_mcu);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errorDetailMCU").removeClass("d-none");
        if (thrownError != "") {
          $(".errorDetailMCU").html(
            "Terjadi kesalahan saat load data mcu, hubungi administrator"
          );
        }
      },
    });
    $("#mdlDetailMCU").modal("show");
  });

  $(document).on("click", ".uploadMCU ", function () {
    let auth_mcu = $(this).attr("id");
    $(".bg83t12trgr98h9").text(auth_mcu);
    $("#mdlUploadMCU").modal("show");
  });

  $("#uploadUlangMCU").submit(function () {
    let auth_mcu = $(".bg83t12trgr98h9").text();
    let file_MCU = $("#fileMCUnew").val();
    const fl_MCU = $("#fileMCUnew").prop("files")[0];

    if (auth_mcu == "") {
      errmcu = "Data mcu tidak ditemukan";
    } else {
      errmcu = "";
    }

    let fileExtension = file_MCU.split(".").pop().toLowerCase();
    let sizeFile = fl_MCU["size"];
    if (fileExtension != "pdf") {
      swal({
        title: "Informasi",
        text: "File MCU yang dipilih bukan PDF",
        type: "info",
      });
    } else if (sizeFile > 1000000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File MCU yang dipilih melebihi 100kb",
        type: "warning",
      });
    } else {
      if (errmcu == "") {
        swal({
          title: "Upload MCU",
          text: "Yakin file MCU akan di-upload ulang?",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, upload",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            $.LoadingOverlay("show");
            let formData = new FormData();
            formData.append("file_MCU", file_MCU);
            formData.append("fl_MCU", fl_MCU);
            formData.append("auth_mcu", auth_mcu);

            $.ajax({
              type: "POST",
              url: site_url + "karyawan/newMCU",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (data) {
                console.log(data);
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                  $("#mdlnewmcu").modal("hide");
                  $(".890123hjn34267xcxvbj7234hh").text("");
                  $("#hasilMCUnew").val("").trigger("change");
                  $("#ketMCUnew").val("");
                  $("#tglMCUnew").val("");
                  $("#fileMCUnew").val("");
                  swal("Berhasil", data.pesan, "success");
                  $.LoadingOverlay("hide");
                } else if (data.statusCode == 201) {
                  $.LoadingOverlay("hide");
                  $(".errnewmcu").removeClass("d-none");
                  $(".errnewmcu").removeClass("alert-primary]");
                  $(".errnewmcu").addClass("alert-danger");
                  $(".errnewmcu").html(data.pesan);
                } else {
                  $.LoadingOverlay("hide");
                  $(".errnewmcu").removeClass("d-none");
                  $(".errnewmcu").removeClass("alert-primary]");
                  $(".errnewmcu").addClass("alert-danger");
                  $(".errnewmcu").html(data.pesan);
                }
              },
            });
          } else {
            swal.close();
          }
        });
      } else {
        if (errmcu != "") {
          $(".errnewmcu").removeClass("d-none");
          $(".errnewmcu").removeClass("alert-primary]");
          $(".errnewmcu").addClass("alert-danger");
          $(".errnewmcu").html(errmcu);
        } else {
          $(".errnewmcu").addClass("d-none");
          $(".errnewmcu").html("");
        }

        $(".errnewmcu")
          .fadeTo(5000, 500)
          .slideUp(500, function () {
            $(".errnewmcu").slideUp(500);
            $(".errnewmcu").addClass("d-none");
          });
      }
    }
  });
});
