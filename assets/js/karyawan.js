$(document).ready(function () {
  var token = $("#token").val();

  $("#logout").click(function () {
    $("#logoutmdl").modal("show");
  });

  let auth_per_old = "";
  $("#noKTPCek").inputmask("9999999999999999", { placeholder: "" });
  $("#noKTP").inputmask("9999999999999999", { placeholder: "" });
  $("#noKK").inputmask("9999999999999999", { placeholder: "" });
  $("#noNPWP").inputmask("99.999.999.9-999.999");
  $("#idizintambang").load(site_url + "izin_tambang/izin_tambang?auth_izin=0");
  $("#idsertifikat").load(site_url + "karyawan/sertifikasi?auth_person=0");
  $("#idvaksin").load(site_url + "karyawan/vaksin?auth_person=" + 0);

  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
  }

  $(".suksesalrt")
    .fadeTo(4000, 500)
    .slideUp(500, function () {
      $(".suksesalrt").slideUp(500);
      $(".suksesalrt").addClass("d-none");
    });

  $("#perJenisData").change(function () {
    let prs = $("#perJenisData").val();
    $("#tbmKaryawan").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/hirarki",
      data: {
        prs: prs,
      },
      success: function (data) {
        $("#lblhirarkiper").text(data);
      },
    });

    $("#tbmKaryawan").DataTable().destroy();
    tbKary(prs);
  });

  $("#addRefreshKary").click(function () {
    let prs = $("#perJenisData").val();
    $("#tbmKaryawan").LoadingOverlay("show");
    $("#tbmKaryawan").DataTable().destroy();
    $("#krycekNonaktif").prop("checked", false);
    tbKary(prs);
  });

  tbKary();

  $("#perJenisData").select2({
    theme: "bootstrap4",
  });
  $("#provData").select2({
    theme: "bootstrap4",
  });
  $("#kotaData").select2({
    theme: "bootstrap4",
  });
  $("#kecData").select2({
    theme: "bootstrap4",
  });
  $("#kelData").select2({
    theme: "bootstrap4",
  });
  $("#addPerKary").select2({
    theme: "bootstrap4",
    dropdownParent: $("#addkry"),
  });
  $("#addDepartKary").select2({
    theme: "bootstrap4",
  });
  $("#addPosisiKary").select2({
    theme: "bootstrap4",
  });
  $("#addKlasifikasiKary").select2({
    theme: "bootstrap4",
  });
  $("#addPOHKary").select2({
    theme: "bootstrap4",
  });
  $("#addLokterimaKary").select2({
    theme: "bootstrap4",
  });
  $("#addLokasiKerja").select2({
    theme: "bootstrap4",
  });
  $("#addLevelKary").select2({
    theme: "bootstrap4",
  });
  $("#addStatusResidence").select2({
    theme: "bootstrap4",
  });
  $("#addTipeKaryawan").select2({
    theme: "bootstrap4",
  });
  $("#statPernikahan").select2({
    theme: "bootstrap4",
  });
  $("#addagama").select2({
    theme: "bootstrap4",
  });
  $("#kewarganegaraan").select2({
    theme: "bootstrap4",
  });
  $("#jenisKelamin").select2({
    theme: "bootstrap4",
  });
  $("#addJenisSIM").select2({
    theme: "bootstrap4",
  });
  $("#jenisUnitSimper").select2({
    dropdownParent: $("#mdlunitsimper"),
    theme: "bootstrap4",
  });
  $("#jenisUnitSimpernw").select2({
    dropdownParent: $("#mdlunitsimpernw"),
    theme: "bootstrap4",
  });
  $("#tipeAksesUnit").select2({
    dropdownParent: $("#mdlunitsimper"),
    theme: "bootstrap4",
  });
  $("#tipeAksesUnitnw").select2({
    dropdownParent: $("#mdlunitsimpernw"),
    theme: "bootstrap4",
  });
  $("#jenisSertifikasi").select2({
    theme: "bootstrap4",
  });
  $("#pendidikanTerakhir").select2({
    theme: "bootstrap4",
  });
  $("#jenisSertifikasiEdit").select2({
    theme: "bootstrap4",
    dropdownParent: $("#mdleditsertifikat"),
  });

  window.addEventListener(
    "resize",
    function (event) {
      $("#addJenisSIM").select2({
        theme: "bootstrap4",
      });
      $("#perJenisData").select2({
        theme: "bootstrap4",
      });
      $("#provData").select2({
        theme: "bootstrap4",
      });
      $("#kotaData").select2({
        theme: "bootstrap4",
      });
      $("#kecData").select2({
        theme: "bootstrap4",
      });
      $("#kelData").select2({
        theme: "bootstrap4",
      });
      $("#addPerKary").select2({
        theme: "bootstrap4",
        dropdownParent: $("#addkry"),
      });
      $("#addDepartKary").select2({
        theme: "bootstrap4",
      });
      $("#addPosisiKary").select2({
        theme: "bootstrap4",
      });
      $("#addKlasifikasiKary").select2({
        theme: "bootstrap4",
      });
      $("#addPOHKary").select2({
        theme: "bootstrap4",
      });
      $("#addLokterimaKary").select2({
        theme: "bootstrap4",
      });
      $("#addLokasiKerja").select2({
        theme: "bootstrap4",
      });
      $("#addLevelKary").select2({
        theme: "bootstrap4",
      });
      $("#addStatusResidence").select2({
        theme: "bootstrap4",
      });
      $("#addJenisKaryawan").select2({
        theme: "bootstrap4",
      });
      $("#statPernikahan").select2({
        theme: "bootstrap4",
      });
      $("#addagama").select2({
        theme: "bootstrap4",
      });
      $("#kewarganegaraan").select2({
        theme: "bootstrap4",
      });
      $("#jenisKelamin").select2({
        theme: "bootstrap4",
      });
      $("#jenisUnitSimper").select2({
        dropdownParent: $("#mdlunitsimper"),
        theme: "bootstrap4",
      });
      $("#tipeAksesUnit").select2({
        dropdownParent: $("#mdlunitsimper"),
        theme: "bootstrap4",
      });
      $("#jenisSertifikasi").select2({
        theme: "bootstrap4",
      });
      $("#pendidikanTerakhir").select2({
        theme: "bootstrap4",
      });
      $("#jenisSertifikasiEdit").select2({
        theme: "bootstrap4",
        dropdownParent: $("#mdleditsertifikat"),
      });
    },
    true
  );

  $("#addUnitSIMPER").click(function () {
    let jenisizin = $("#addJenisIzin").val();

    if (jenisizin == 2) {
      let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
      let jenisizin = $("#addJenisIzin").val();
      let noreg = $("#addNoReg").val();
      let tglexp = $("#addTglExp").val();
      let jenissim = $("#addJenisSIM").val();
      let tglexpsim = $("#addTglExpSIM").val();
      let jenisunit = $("#jenisUnitSimper").val();
      let tipeakses = $("#tipeAksesUnit").val();
      let filesim = $("#filesimpolisi").val();
      let filesmp = $("#simpermp").val();

      if (auth_kary == "") {
        $(".errormsgizin").removeClass("d-none");
        $(".errormsgizin").removeClass("alert-info");
        $(".errormsgizin").addClass("alert-danger");
        $(".errormsgizin").html("Data karyawan tidak ditemukan");
      }

      if (filesim == "" || filesim == "Pilih file SIM Polisi") {
        errfilesim = "SIM Polisi Wajib di upload";
      } else {
        errfilesim = "";
      }

      if (filesmp == "" || filesmp == "Pilih file SIMPER/MINE PERMIT") {
        errfilesmp = "SIMPER Wajib di upload";
      } else {
        errfilesmp = "";
      }

      if (jenisizin == "") {
        errjenisizin = "Jenis izin wajib dipilih";
      } else {
        errjenisizin = "";
      }

      if (noreg == "") {
        errnoreg = "No. Registrasi wajib diisi";
      } else {
        errnoreg = "";
      }

      if (jenisizin == 2) {
        if (jenissim == "") {
          errjenissim = "Jenis SIM wajib dipilih";
        } else {
          errjenissim = "";
        }
      } else {
        errjenissim = "";
      }

      if (tglexpsim == "") {
        errtglexpsim = "Tanggal expired SIM wajib diisi";
      } else {
        errtglexpsim = "";
      }

      if (tglexp == "") {
        errtglexp = "Tanggal expired izin wajib diisi";
      } else {
        errtglexp = "";
      }

      if (tglexp == "") {
        errtglexp = "Tanggal expired izin wajib diisi";
      } else {
        errtglexp = "";
      }

      if (
        errjenisizin == "" &&
        errnoreg == "" &&
        errtglexp == "" &&
        errjenissim == "" &&
        errtglexpsim == "" &&
        errfilesim == "" &&
        errfilesmp == ""
      ) {
        $("#mdlunitsimper").modal("show");
        $("#refreshjenisUnitSimper").removeAttr("disabled");
        $("#refreshtipeAksesUnit").removeAttr("disabled");
      } else {
        $(".erroraddJenisIzin").html(errjenisizin);
        $(".erroraddNoReg").html(errnoreg);
        $(".erroraddJenisSIM").html(errjenissim);
        $(".erroraddTglExpSIM").html(errtglexpsim);
        $(".erroraddTglExp").html(errtglexp);
        $(".errorsimpermp").html(errfilesmp);
        $(".errorFilesimpolisi").html(errfilesim);
      }
    }
  });

  $("#addUnitSIMPERnew").click(function () {
    let jenisizin = $("#addJenisIzinnew").val();

    if (jenisizin == 2) {
      let auth_kary = $(".ecb14fe704e08d9df8e343030bbb442344").text();
      let noreg = $("#addNoRegnew").val();
      let tglexp = $("#addTglExpnew").val();
      let jenissim = $("#addJenisSIMnew").val();
      let tglexpsim = $("#addTglExpSIMnew").val();
      let jenisunit = $("#jenisUnitSimpernew").val();
      let tipeakses = $("#tipeAksesUnitnew").val();
      let filesim = $("#filesimpolisinew").val();
      let filesmp = $("#simpermpnew").val();

      if (auth_kary == "") {
        $(".errormsgizinnew").removeClass("d-none");
        $(".errormsgizinnew").removeClass("alert-info");
        $(".errormsgizinnew").addClass("alert-danger");
        $(".errormsgizinnew").html("Data karyawan tidak ditemukan");
      }

      if (filesim == "" || filesim == "Pilih file SIM Polisi") {
        errfilesim = "SIM Polisi Wajib di upload";
      } else {
        errfilesim = "";
      }

      if (filesmp == "" || filesmp == "Pilih file SIMPER/MINE PERMIT") {
        errfilesmp = "SIMPER Wajib di upload";
      } else {
        errfilesmp = "";
      }

      if (jenisizin == "") {
        errjenisizin = "Jenis izin wajib dipilih";
      } else {
        errjenisizin = "";
      }

      if (noreg == "") {
        errnoreg = "No. Registrasi wajib diisi";
      } else {
        errnoreg = "";
      }

      if (jenisizin == 2) {
        if (jenissim == "") {
          errjenissim = "Jenis SIM wajib dipilih";
        } else {
          errjenissim = "";
        }
      } else {
        errjenissim = "";
      }

      if (tglexpsim == "") {
        errtglexpsim = "Tanggal expired SIM wajib diisi";
      } else {
        errtglexpsim = "";
      }

      if (tglexp == "") {
        errtglexp = "Tanggal expired izin wajib diisi";
      } else {
        errtglexp = "";
      }

      if (tglexp == "") {
        errtglexp = "Tanggal expired izin wajib diisi";
      } else {
        errtglexp = "";
      }

      if (
        errjenisizin == "" &&
        errnoreg == "" &&
        errtglexp == "" &&
        errjenissim == "" &&
        errtglexpsim == "" &&
        errfilesim == "" &&
        errfilesmp == ""
      ) {
        $("#mdlunitsimpernw").modal("show");
        $("#refreshjenisUnitSimpernw").removeAttr("disabled");
        $("#refreshtipeAksesUnitnw").removeAttr("disabled");
      } else {
        $(".erroraddJenisIzinnew").html(errjenisizin);
        $(".erroraddNoRegnew").html(errnoreg);
        $(".erroraddJenisSIMnew").html(errjenissim);
        $(".erroraddTglExpSIMnew").html(errtglexpsim);
        $(".erroraddTglExpnew").html(errtglexp);
        $(".errorsimpermpnew").html(errfilesmp);
        $(".errorFilesimpolisinew").html(errfilesim);
      }
    }
  });

  function aktifPersonalNoKTP() {
    $("#namaLengkap").removeAttr("disabled");
    $("#alamatKTP").removeAttr("disabled");
    $("#rtKTP").removeAttr("disabled");
    $("#rwKTP").removeAttr("disabled");
    $("#provData").removeAttr("disabled");
    $("#kotaData").removeAttr("disabled");
    $("#kecData").removeAttr("disabled");
    $("#kelData").removeAttr("disabled");
    $("#tempatLahir").removeAttr("disabled");
    $("#tanggalLahir").removeAttr("disabled");
    $("#statPernikahan").removeAttr("disabled");
    $("#addagama").removeAttr("disabled");
    $("#kewarganegaraan").removeAttr("disabled");
    $("#jenisKelamin").removeAttr("disabled");
    $("#email").removeAttr("disabled");
    $("#noTelp").removeAttr("disabled");
    $("#noBPJSTK").removeAttr("disabled");
    $("#noBPJSKES").removeAttr("disabled");
    $("#noKK").removeAttr("disabled");
    $("#namaIbu").removeAttr("disabled");
    $("#noNPWP").removeAttr("disabled");
    $("#pendidikanTerakhir").removeAttr("disabled");
    $("#pasfoto").removeAttr("disabled");
    $("#refreshProv").removeAttr("disabled");
    $("#refreshKota").removeAttr("disabled");
    $("#refreshKec").removeAttr("disabled");
    $("#refreshKel").removeAttr("disabled");
    $("#refreshStatNikah").removeAttr("disabled");
    $("#refreshDidik").removeAttr("disabled");
    $("#addSimpanPersonal").removeClass("disabled");
  }

  function aktifPersonal() {
    $("#noKTP").removeAttr("disabled");
    $("#namaLengkap").removeAttr("disabled");
    $("#alamatKTP").removeAttr("disabled");
    $("#rtKTP").removeAttr("disabled");
    $("#rwKTP").removeAttr("disabled");
    $("#provData").removeAttr("disabled");
    $("#kotaData").removeAttr("disabled");
    $("#kecData").removeAttr("disabled");
    $("#kelData").removeAttr("disabled");
    $("#tempatLahir").removeAttr("disabled");
    $("#tanggalLahir").removeAttr("disabled");
    $("#statPernikahan").removeAttr("disabled");
    $("#addagama").removeAttr("disabled");
    $("#kewarganegaraan").removeAttr("disabled");
    $("#jenisKelamin").removeAttr("disabled");
    $("#email").removeAttr("disabled");
    $("#noTelp").removeAttr("disabled");
    $("#noBPJSTK").removeAttr("disabled");
    $("#noBPJSKES").removeAttr("disabled");
    $("#noKK").removeAttr("disabled");
    $("#namaIbu").removeAttr("disabled");
    $("#noNPWP").removeAttr("disabled");
    $("#pendidikanTerakhir").removeAttr("disabled");
    $("#pasfoto").removeAttr("disabled");
    $("#refreshProv").removeAttr("disabled");
    $("#refreshKota").removeAttr("disabled");
    $("#refreshKec").removeAttr("disabled");
    $("#refreshKel").removeAttr("disabled");
    $("#refreshStatNikah").removeAttr("disabled");
    $("#refreshDidik").removeAttr("disabled");
    $("#addSimpanPersonal").removeClass("disabled");
  }

  function nonAktifPersonal() {
    $("#noKTP").attr("disabled", true);
    $("#namaLengkap").attr("disabled", true);
    $("#alamatKTP").attr("disabled", true);
    $("#rtKTP").attr("disabled", true);
    $("#rwKTP").attr("disabled", true);
    $("#provData").attr("disabled", true);
    $("#kotaData").attr("disabled", true);
    $("#kecData").attr("disabled", true);
    $("#kelData").attr("disabled", true);
    $("#tempatLahir").attr("disabled", true);
    $("#tanggalLahir").attr("disabled", true);
    $("#statPernikahan").attr("disabled", true);
    $("#addagama").attr("disabled", true);
    $("#kewarganegaraan").attr("disabled", true);
    $("#jenisKelamin").attr("disabled", true);
    $("#email").attr("disabled", true);
    $("#noTelp").attr("disabled", true);
    $("#noBPJSTK").attr("disabled", true);
    $("#noBPJSKES").attr("disabled", true);
    $("#noKK").attr("disabled", true);
    $("#namaIbu").attr("disabled", true);
    $("#noNPWP").attr("disabled", true);
    $("#pendidikanTerakhir").attr("disabled", true);
    $("#refreshProv").attr("disabled", true);
    $("#refreshKota").attr("disabled", true);
    $("#refreshKec").attr("disabled", true);
    $("#refreshKel").attr("disabled", true);
    $("#refreshStatNikah").attr("disabled", true);
    $("#refreshDidik").attr("disabled", true);
    $("#addSimpanPersonal").addClass("disabled");
  }

  function aktifKaryawan() {
    $("#addPerKary").removeAttr("disabled");
    $("#addNIKKary").removeAttr("disabled");
    $("#addDepartKary").removeAttr("disabled");
    $("#addPosisiKary").removeAttr("disabled");
    $("#addDOH").removeAttr("disabled");
    $("#addTanggalAktif").removeAttr("disabled");
    $("#addLokasiKerja").removeAttr("disabled");
    $("#addLokterimaKary").removeAttr("disabled");
    $("#addPOHKary").removeAttr("disabled");
    $("#addKlasifikasiKary").removeAttr("disabled");
    $("#addJenisKaryawan").removeAttr("disabled");
    $("#addLevelKary").removeAttr("disabled");
    $("#addStatusResidence").removeAttr("disabled");
    $("#addStatusKaryawan").removeAttr("disabled");
    $("#addTipeKaryawan").removeAttr("disabled");
    $("#addEmailKantor").removeAttr("disabled");
    $("#addTanggalPermanen").removeAttr("disabled");
    $("#addTanggalKontrakAwal").removeAttr("disabled");
    $("#addTanggalKontrakAkhir").removeAttr("disabled");
    $("#refreshDepart").removeAttr("disabled");
    $("#refreshPosisi").removeAttr("disabled");
    $("#refreshKlasifikasi").removeAttr("disabled");
    $("#refreshTipe").removeAttr("disabled");
    $("#refreshLevel").removeAttr("disabled");
    $("#refreshPOH").removeAttr("disabled");
    $("#refreshLokterima").removeAttr("disabled");
    $("#refreshLokker").removeAttr("disabled");
    $("#refreshResidence").removeAttr("disabled");
    $("#refreshstatkaryawan").removeAttr("disabled");
    $("#infoKlasifikasi").removeAttr("disabled");
    $("#addKembaliPekerjaan").removeClass("disabled");
    $("#addSimpanPekerjaan").removeClass("disabled");
  }

  function nonAktifKaryawan() {
    $("#addPerKary").attr("disabled", true);
    $("#addNIKKary").attr("disabled", true);
    $("#addDepartKary").attr("disabled", true);
    $("#addPosisiKary").attr("disabled", true);
    $("#addDOH").attr("disabled", true);
    $("#addTanggalAktif").attr("disabled", true);
    $("#addLokasiKerja").attr("disabled", true);
    $("#addLokterimaKary").attr("disabled", true);
    $("#addPOHKary").attr("disabled", true);
    $("#addKlasifikasiKary").attr("disabled", true);
    $("#addJenisKaryawan").attr("disabled", true);
    $("#addLevelKary").attr("disabled", true);
    $("#addStatusResidence").attr("disabled", true);
    $("#addStatusKaryawan").attr("disabled", true);
    $("#addTipeKaryawan").attr("disabled", true);
    $("#addEmailKantor").attr("disabled", true);
    $("#addTanggalPermanen").attr("disabled", true);
    $("#addTanggalKontrakAwal").attr("disabled", true);
    $("#addTanggalKontrakAkhir").attr("disabled", true);
    $("#refreshDepart").attr("disabled", true);
    $("#refreshPosisi").attr("disabled", true);
    $("#refreshKlasifikasi").attr("disabled", true);
    $("#refreshTipe").attr("disabled", true);
    $("#refreshLevel").attr("disabled", true);
    $("#refreshPOH").attr("disabled", true);
    $("#refreshLokterima").attr("disabled", true);
    $("#refreshLokker").attr("disabled", true);
    $("#refreshResidence").attr("disabled", true);
    $("#refreshstatkaryawan").attr("disabled", true);
    $("#infoKlasifikasi").attr("disabled", true);
    $("#addKembaliPekerjaan").addClass("disabled");
    $("#addSimpanPekerjaan").addClass("disabled");
  }

  function aktifSIMPER() {
    $("#addJenisIzin").removeAttr("disabled");
    $("#addNoReg").removeAttr("disabled");
    $("#addTglExp").removeAttr("disabled");
    $("#addJenisSIM").removeAttr("disabled");
    $("#addTglExpSIM").removeAttr("disabled");
    $("#refreshJenisSIM").removeAttr("disabled");
    $("#addKembaliIzinUnit").removeClass("disabled");
    $("#addSimpanIzinUnit").removeClass("disabled");
    $("#filesimpolisi").removeAttr("disabled");
    $("#btnshowsimpol").removeClass("disabled");
    $("#simpermp").removeAttr("disabled");
    $("#btnshowsimper").removeClass("disabled");
  }

  function nonaktifSIMPER() {
    $("#addJenisIzin").attr("disabled", true);
    $("#addNoReg").attr("disabled", true);
    $("#addTglExp").attr("disabled", true);
    $("#addJenisSIM").attr("disabled", true);
    $("#addTglExpSIM").attr("disabled", true);
    $("#addKembaliIzinUnit").addClass("disabled");
    $("#addSimpanIzinUnit").addClass("disabled");
    $("#filesimpolisi").attr("disabled", true);
    $("#btnshowsimpol").addClass("disabled");
    $("#simpermp").attr("disabled", true);
    $("#btnshowsimper").addClass("disabled");
  }

  function aktifSertifikat() {
    $("#jenisSertifikasi").removeAttr("disabled");
    $("#noSertifikat").removeAttr("disabled");
    $("#namaLembaga").removeAttr("disabled");
    $("#tanggalSertifikasi").removeAttr("disabled");
    $("#masaBerlakuSertifikat").removeAttr("disabled");
    $("#tanggalSertifikasiAkhir").removeAttr("disabled");
    $("#refreshJenisSertifikat").removeAttr("disabled");
    $("#fileSertifikasi").removeAttr("disabled");
    $("#addSimpanSertifikasi").removeClass("disabled");
    $("#addResetSertifikasi").removeClass("disabled");
    $("#addbtnkembaliSertifikat").removeClass("disabled");
    $("#addLanjutSertifikasi").removeClass("disabled");
  }

  function nonaktifSertifikat() {
    $("#jenisSertifikasi").attr("disabled", true);
    $("#noSertifikat").attr("disabled", true);
    $("#namaLembaga").attr("disabled", true);
    $("#tanggalSertifikasi").attr("disabled", true);
    $("#masaBerlakuSertifikat").attr("disabled", true);
    $("#tanggalSertifikasiAkhir").attr("disabled", true);
    $("#fileSertifikasi").attr("disabled", true);
    $("#addSimpanSertifikasi").addClass("disabled");
    $("#addResetSertifikasi").addClass("disabled");
    $("#addbtnkembaliSertifikat").addClass("disabled");
    $("#addLanjutSertifikasi").addClass("disabled");
  }

  function aktifMCU() {
    $("#tglMCU").removeAttr("disabled");
    $("#hasilMCU").removeAttr("disabled");
    $("#ketMCU").removeAttr("disabled");
    $("#refreshhasilMCU").removeAttr("disabled");
    $("#fileMCU").removeAttr("disabled");
    $("#addbtnkembaliMCU").removeClass("disabled");
    $("#addSimpanMCU").removeClass("disabled");
    $("#addLanjutMCU").removeClass("disabled");
  }

  function nonaktifMCU() {
    $("#tglMCU").attr("disabled");
    $("#hasilMCU").attr("disabled");
    $("#ketMCU").attr("disabled");
    $("#fileMCU").attr("disabled");
    $("#addbtnkembaliMCU").addClass("disabled");
    $("#addSimpanMCU").addClass("disabled");
  }

  function aktifVaksin() {
    $("#jenisVaksin").removeAttr("disabled");
    $("#namaVaksin").removeAttr("disabled");
    $("#tanggalVaksin").removeAttr("disabled");
    $("#fileMCU").removeAttr("disabled");
    $("#refreshjenisVaksin").removeAttr("disabled");
    $("#refreshnamaVaksin").removeAttr("disabled");
    $("#addSimpanVaksin").removeClass("disabled");
    $("#addResetVaksin").removeClass("disabled");
    $("#addbtnkembalivaksin").removeClass("disabled");
    $("#addLanjutkanVaksin").removeClass("disabled");
  }

  function nonaktifVaksin() {
    $("#jenisVaksin").attr("disabled");
    $("#namaVaksin").attr("disabled");
    $("#tanggalVaksin").attr("disabled");
    $("#fileMCU").attr("disabled");
    $("#addSimpanVaksin").addClass("disabled");
    $("#addResetVaksin").addClass("disabled");
    $("#addbtnkembalivaksin").addClass("disabled");
    $("#addLanjutkanVaksin").addClass("disabled");
  }

  function aktifFilePendukung() {
    $("#filePasFoto").removeAttr("disabled");
    $("#filePendukung").removeAttr("disabled");
    $("#addbtnkembaliFile").removeClass("disabled");
    $("#addUploadFileSelesai").removeClass("disabled");
    $("#addUploadFilePendukung").removeClass("disabled");
  }

  function nonaktifFilePendukung() {
    $("#filePasFoto").attr("disabled");
    $("#filePendukung").attr("disabled");
    $("#addbtnkembaliFile").addClass("disabled");
    $("#addUploadFileSelesai").addClass("disabled");
    $("#addUploadFilePendukung").addClass("disabled");
  }

  $("#clKaryawan-click").click(function () {
    if ($("#colKaryawan").hasClass("show")) {
      $("#colKaryawan").collapse("hide");
    } else {
      $("#colKaryawan").collapse("show");
    }
  });

  $("#clPersonal-click").click(function () {
    if ($("#colPersonal").hasClass("show")) {
      $("#colPersonal").collapse("hide");
    } else {
      $("#colPersonal").collapse("show");
    }
  });

  $("#clIzinTambang-click").click(function () {
    if ($("#colIzinTambang").hasClass("show")) {
      $("#colIzinTambang").collapse("hide");
    } else {
      $("#colIzinTambang").collapse("show");
    }
  });

  $("#clSertifikasi-click").click(function () {
    if ($("#colSertifikasi").hasClass("show")) {
      $("#colSertifikasi").collapse("hide");
    } else {
      $("#colSertifikasi").collapse("show");
    }
  });

  $("#clMCU-click").click(function () {
    if ($("#colMCU").hasClass("show")) {
      $("#colMCU").collapse("hide");
    } else {
      $("#colMCU").collapse("show");
    }
  });

  $("#clVaksin-click").click(function () {
    if ($("#colVaksin").hasClass("show")) {
      $("#colVaksin").collapse("hide");
    } else {
      $("#colVaksin").collapse("show");
    }
  });

  $("#clFilePendukung-click").click(function () {
    if ($("#colFilePendukung").hasClass("show")) {
      $("#colFilePendukung").collapse("hide");
    } else {
      $("#colFilePendukung").collapse("show");
    }
  });

  $("#btnverifikasiktp").click(function () {
    ver_Data();
  });

  function ver_Data() {
    let noktp = $("#noKTPCek").val();
    let errnoktp = $(".errornoKTPCek").text();

    if (noktp != "") {
      if (errnoktp == "") {
        swal({
          title: "Verifikasi No. KTP",
          text: "Yakin No. KTP : " + noktp + " sudah benar?",
          type: "question",
          showCancelButton: true,
          confirmButtonColor: "#36c6d3",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, benar",
          cancelButtonText: "Batalkan",
        }).then(function (result) {
          if (result.value) {
            $.LoadingOverlay("show");
            $.ajax({
              type: "POST",
              url: site_url + "karyawan/verifikasi_ktp",
              data: {
                noktp: noktp,
                token: token,
              },
              success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                  $("#mdlbuatdatakary").modal("hide");
                  $("#noKTP").val(noktp);
                  $(".0c09efa8ccb5e0114e97df31736ce2e3").text(
                    data.auth_personal
                  );
                  $(".150b3427b97bb43ac2fb3e5c687e384c").text(data.auth_alamat);
                  $(".h2344234jfsd").text("");
                  $("#noKTP").removeAttr("disabled");
                  $("#colPersonal").collapse("show");
                  $.ajax({
                    type: "POST",
                    url:
                      site_url +
                      "daerah/get_prov?authtoken=" +
                      $("#token").val(),
                    data: {},
                    success: function (provdata) {
                      var provdata = JSON.parse(provdata);
                      $("#provData").html(provdata.prov);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsg").removeClass("d-none");
                      $(".errormsg").removeClass("alert-info");
                      $(".errormsg").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsg").html(
                          "Terjadi kesalahan saat load data provinsi, hubungi administrator"
                        );
                        $("#addSimpanPersonal").remove();
                      }
                    },
                  });
                  aktifPersonalNoKTP();
                  daerah_ganti();
                  lanjutpersonal();
                  $.LoadingOverlay("hide");
                  swal("Berhasil", data.pesan, "success");
                } else if (data.statusCode == 201) {
                  $("#pesanDet").text(data.pesan);
                  $("#noKTPDet").text(data.no_ktp);
                  $("#namaDet").text(data.nama_lengkap);

                  if (data.tgl_nonaktif == "01-Jan-1970") {
                    $(".tglnonaktif").addClass("d-none");
                    $(".lamanonaktif").addClass("d-none");
                    $(".pelanggaran").addClass("d-none");
                  } else {
                    $(".tglnonaktif").removeClass("d-none");
                    $(".lamanonaktif").removeClass("d-none");
                    $(".pelanggaran").removeClass("d-none");
                    $("#tglNonAktifDet").text(data.tgl_nonaktif);
                    $("#lamaNonAktifDet").text(data.lama_nonaktif);
                  }

                  $("#PerusahaanDet").text(data.perusahaan);

                  if (data.status == "AKTIF") {
                    $("#StatusDet").removeClass("text-danger");
                    $("#StatusDet").addClass("text-success");
                  } else {
                    $("#StatusDet").removeClass("text-success");
                    $("#StatusDet").addClass("text-danger");
                  }

                  $("#StatusDet").text(data.status);
                  $.LoadingOverlay("hide");
                  $("#mdldetkary").modal("show");
                  // swal('Error', data.pesan, 'error');
                } else {
                  swal("Berhasil", data.pesan, "success");
                  $.ajax({
                    type: "POST",
                    url:
                      site_url +
                      "daerah/get_prov?authtoken=" +
                      $("#token").val(),
                    async: false,
                    data: {},
                    success: function (provdata) {
                      var provdata = JSON.parse(provdata);
                      $("#provData").html(provdata.prov);
                      $("#provData").val(data.prov).trigger("change");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsg").removeClass("d-none");
                      $(".errormsg").removeClass("alert-info");
                      $(".errormsg").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsg").html(
                          "Terjadi kesalahan saat load data provinsi, hubungi administrator"
                        );
                        $("#addSimpanPersonal").remove();
                      }
                    },
                  });

                  $.ajax({
                    type: "POST",
                    url:
                      site_url +
                      "daerah/get_kab?authtoken=" +
                      $("#token").val(),
                    async: false,
                    data: {
                      id_prov: data.prov,
                    },
                    success: function (kabdata) {
                      var kabdata = JSON.parse(kabdata);
                      $("#kotaData").html(kabdata.kab);
                      $("#kotaData").val(data.kab).trigger("change");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsg").removeClass("d-none");
                      $(".errormsg").removeClass("alert-info");
                      $(".errormsg").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsg").html(
                          "Terjadi kesalahan saat load data kabupaten, hubungi administrator"
                        );
                        $("#addSimpanPersonal").remove();
                      }
                    },
                  });

                  $.ajax({
                    type: "POST",
                    url:
                      site_url +
                      "daerah/get_kec?authtoken=" +
                      $("#token").val(),
                    async: false,
                    data: {
                      id_kab: data.kab,
                    },
                    success: function (kecdata) {
                      var kecdata = JSON.parse(kecdata);
                      $("#kecData").html(kecdata.kec);
                      $("#kecData").val(data.kec).trigger("change");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsg").removeClass("d-none");
                      $(".errormsg").removeClass("alert-info");
                      $(".errormsg").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsg").html(
                          "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
                        );
                        $("#addSimpanPersonal").remove();
                      }
                    },
                  });

                  $.ajax({
                    type: "POST",
                    url:
                      site_url +
                      "daerah/get_kel?authtoken=" +
                      $("#token").val(),
                    async: false,
                    data: {
                      id_kec: data.kec,
                    },
                    success: function (keldata) {
                      var keldata = JSON.parse(keldata);
                      $("#kelData").html(keldata.kel);
                      $("#kelData").val(data.kel).trigger("change");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsg").removeClass("d-none");
                      $(".errormsg").removeClass("alert-info");
                      $(".errormsg").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsg").html(
                          "Terjadi kesalahan saat load data kelurahan, hubungi administrator"
                        );
                        $("#addSimpanPersonal").remove();
                      }
                    },
                  });

                  $(".0c09efa8ccb5e0114e97df31736ce2e3").text(
                    data.auth_personal
                  );
                  $(".150b3427b97bb43ac2fb3e5c687e384c").text(data.auth_alamat);
                  $(".h2344234jfsd").text(data.auth_personal);
                  $("#noKTP").val(data.no_ktp);
                  $("#namaLengkap").val(data.nama);
                  $("#alamatKTP").val(data.alamat);
                  $("#rtKTP").val(data.rt);
                  $("#rwKTP").val(data.rw);
                  $("#kewarganegaraan")
                    .val(data.warga_negara)
                    .trigger("change");
                  $("#addagama").val(data.agama).trigger("change");
                  $("#jenisKelamin").val(data.jk).trigger("change");
                  $("#statPernikahan").val(data.stat_nikah).trigger("change");
                  $("#tempatLahir").val(data.tmp_lahir);
                  $("#tanggalLahir").val(data.tgl_lahir);
                  $("#noBPJSTK").val(data.no_bpjstk);
                  $("#noBPJSKES").val(data.no_bpjsks);
                  $("#noNPWP").val(data.no_npwp);
                  $("#noKK").val(data.no_kk);
                  $("#email").val(data.email_pribadi);
                  $("#noTelp").val(data.hp_1);
                  $("#pendidikanTerakhir")
                    .val(data.didik_terakhir)
                    .trigger("change");
                  $("#mdlbuatdatakary").modal("hide");
                  $("#colPersonal").collapse("show");
                  aktifPersonalNoKTP();
                  lanjutpersonal();
                  daerah_ganti();
                  $.LoadingOverlay("hide");
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass("d-none");
                $(".errormsg").removeClass("alert-info");
                $(".errormsg").addClass("alert-danger");
                if (thrownError != "") {
                  $(".errormsg").html(
                    "Terjadi kesalahan saat load data personal, hubungi administrator"
                  );
                }
              },
            });
          } else {
            swal.close();
          }
        });
      } else {
        swal("Error", errnoktp, "error");
      }
    } else {
      swal("Error", "No. KTP tidak boleh kosong", "error");
    }
  }

  $("#addBuatData").click(function () {
    if ($("#addSimpanPersonal").length > 0) {
      swal(
        "Error",
        "Verifikasi tidak dapat dilakukan, selesaikan isi data karyawan",
        "error"
      );
    } else {
      $("#mdlbuatdatakary").modal("show");
      $("#noKTPCek").val("");
    }
  });
  $("#btnbatalunitsimper").click(function () {
    $("#jenisUnitSimper").val("").trigger("change");
    $("#tipeAksesUnit").val("").trigger("change");
    $("#mdlunitsimper").modal("hide");
  });

  $("#btnsimpanunitsimper").click(function () {
    let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
    let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let auth_simpol = $(".j8234234b").text();
    let jenisizin = $("#addJenisIzin").val();
    let noreg = $("#addNoReg").val();
    let tglexp = $("#addTglExp").val();
    let jenissim = $("#addJenisSIM").val();
    let tglexpsim = $("#addTglExpSIM").val();
    let jenisunit = $("#jenisUnitSimper").val();
    let tipeakses = $("#tipeAksesUnit").val();
    let filesim = $("#filesimpolisi").val();
    const flsim = $("#filesimpolisi").prop("files")[0];
    let filesmp = $("#simpermp").val();
    const flsmp = $("#simpermp").prop("files")[0];
    let filesimnm = $("#nmfilesimpol").val();
    let filesimsv = $("#nmfilesimpolsv").val();
    let filesmpnm = $("#nmfilesimper").val();
    let filesmpsv = $("#nmfilesimpersv").val();

    let formData = new FormData();
    formData.append("filesimpolisi", flsim);
    formData.append("filesim", filesim);
    formData.append("filesmpkary", flsmp);
    formData.append("filesmp", filesmp);
    formData.append("jenisizin", jenisizin);
    formData.append("noreg", noreg);
    formData.append("tglexpsim", tglexpsim);
    formData.append("tglexp", tglexp);
    formData.append("jenissim", jenissim);
    formData.append("jenisunit", jenisunit);
    formData.append("auth_izin", auth_izin);
    formData.append("auth_kary", auth_kary);
    formData.append("auth_simpol", auth_simpol);
    formData.append("auth_person", auth_person);
    formData.append("tipeakses", tipeakses);
    formData.append("filesimnm", filesimnm);
    formData.append("filesimsv", filesimsv);
    formData.append("filesmpnm", filesmpnm);
    formData.append("filesmpsv", filesmpsv);

    $.ajax({
      type: "POST",
      url: site_url + "izin_tambang/add_unit_izin_tambang",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#jenisUnitSimper").val("").trigger("change");
          $("#tipeAksesUnit").val("").trigger("change");
          $("#idizintambang").LoadingOverlay("show");
          $(".j8234234b").text(data.auth_simpol);
          $(".ecb14fe704e08d9df8e343030bbbafcb").text(data.auth_izin);
          if (data.auth_unit == "j78uh5yg") {
            $("#nmfilesimpol").val(flsim.name);
            $("#nmfilesimpolsv").val(data.filesimsv);
            $("#nmfilesimper").val(flsmp.name);
            $("#nmfilesimpersv").val(data.filesmpsv);
            $("#btnshowsimper").attr("href", data.linkizin);
            $("#btnshowsimpol").attr("href", data.linksim);
          }
          $(".errorjenisUnitSimper").text("");
          $(".errortipeAksesUnit").text("");
          $(".erroraddJenisIzin").html("");
          $(".erroraddNoReg").html("");
          $(".erroraddJenisSIM").html("");
          $(".erroraddTglExpSIM").html("");
          $(".errorFilesimpolisi").html("");
          $(".erroraddTglExp").html("");
          $(".errorsimpermp").html("");
          $(".errorFilesimpolisi").html("");
          $("#idizintambang").load(
            site_url + "izin_tambang/izin_tambang?auth_izin=" + data.auth_izin
          );
          swal("Berhasil", data.pesan, "success");
        } else if (data.statusCode == 201) {
          swal("Error", data.message, "error");
        } else {
          $(".errorjenisUnitSimper").html(data.jenisunit);
          $(".errortipeAksesUnit").html(data.tipeakses);
          swal("Error", data.pesan, "error");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat menyimpan unit hubungi administrator"
          );
        }
      },
    });
  });

  $("#btnsimpanunitsimpernw").click(function () {
    let auth_izin = $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text();
    let auth_kary = $(".ecb14fe704e08d9df8e343030bbb442344").text();
    let auth_simpol = $(".ecb14fe704e08d95j32k4jn98sdfvj3o45").text();
    let jenisizin = $("#addJenisIzinnew").val();
    let noreg = $("#addNoRegnew").val();
    let tglexp = $("#addTglExpnew").val();
    let jenissim = $("#addJenisSIMnew").val();
    let tglexpsim = $("#addTglExpSIMnew").val();
    let jenisunit = $("#jenisUnitSimpernw").val();
    let tipeakses = $("#tipeAksesUnitnw").val();
    let filesim = $("#filesimpolisinew").val();
    const flsim = $("#filesimpolisinew").prop("files")[0];
    let filesmp = $("#simpermpnew").val();
    const flsmp = $("#simpermpnew").prop("files")[0];
    let filesimnm = $("#nmfilesimpolnew").val();
    let filesimsv = $("#nmfilesimpolsvnew").val();
    let filesmpnm = $("#nmfilesimpernew").val();
    let filesmpsv = $("#nmfilesimpersvnew").val();

    let formData = new FormData();
    formData.append("filesimpolisi", flsim);
    formData.append("filesim", filesim);
    formData.append("filesmpkary", flsmp);
    formData.append("filesmp", filesmp);
    formData.append("jenisizin", jenisizin);
    formData.append("noreg", noreg);
    formData.append("tglexpsim", tglexpsim);
    formData.append("tglexp", tglexp);
    formData.append("jenissim", jenissim);
    formData.append("jenisunit", jenisunit);
    formData.append("auth_izin", auth_izin);
    formData.append("auth_kary", auth_kary);
    formData.append("auth_simpol", auth_simpol);
    formData.append("tipeakses", tipeakses);
    formData.append("filesimnm", filesimnm);
    formData.append("filesimsv", filesimsv);
    formData.append("filesmpnm", filesmpnm);
    formData.append("filesmpsv", filesmpsv);
    formData.append("token", token);

    $.ajax({
      type: "POST",
      url: site_url + "izin_tambang/add_unit_izin_tambang_new",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        // console.log(data);
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#jenisUnitSimpernw").val("").trigger("change");
          $("#tipeAksesUnitnw").val("").trigger("change");
          $("#idizintambangnew").LoadingOverlay("show");
          $(".j8234234b").text(data.auth_simpol);
          $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text(data.auth_izin);
          $(".ecb14fe704e08d95j32k4jn98sdfvj3o45").text(data.auth_simpol);
          if (data.auth_unit == "j78uh5yg") {
            $("#nmfilesimpolnew").val(flsim.name);
            $("#nmfilesimpolsvnew").val(data.filesimsv);
            $("#nmfilesimpernew").val(flsmp.name);
            $("#nmfilesimpersvnew").val(data.filesmpsv);
            $("#btnshowsimpernew").attr("href", data.linkizin);
            $("#btnshowsimpolnew").attr("href", data.linksim);
            $("#btnshowsimpolnew").removeClass("disabled");
            $("#btnshowsimpernew").removeClass("disabled");
          }
          $(".errorjenisUnitSimpernw").text("");
          $(".errortipeAksesUnitnw").text("");
          $(".erroraddJenisIzinnew").html("");
          $(".erroraddNoRegnew").html("");
          $(".erroraddJenisSIMnew").html("");
          $(".erroraddTglExpSIMnew").html("");
          $(".errorFilesimpolisinew").html("");
          $(".erroraddTglExpnew").html("");
          $(".errorsimpermpnew").html("");
          $(".errorFilesimpolisinew").html("");
          $("#idizintambangnew").load(
            site_url + "izin_tambang/izin_tambang?auth_izin=" + data.auth_izin
          );
          swal("Berhasil", data.pesan, "success");
        } else if (data.statusCode == 201) {
          swal("Error", data.message, "error");
        } else {
          $(".errorjenisUnitSimpernw").html(data.jenisunit);
          $(".errortipeAksesUnitnw").html(data.tipeakses);
          swal("Error", data.pesan, "error");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormdlsimpernw").removeClass("d-none");
        $(".errormdlsimpernw").removeClass("alert-info");
        $(".errormdlsimpernw").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormdlsimpernw").html(
            "Terjadi kesalahan saat menyimpan data unit, silahkan hubungi administrator"
          );
        }
      },
    });
  });

  $("#filesimpolisi").change(function () {
    const file = $("#filesimpolisi").prop("files")[0];
    console.log(file.name);
    if (file.name == "") {
      $("#lblsimpolisi").text("Pilih file SIM Polisi");
    } else {
      $("#lblsimpolisi").text(file.name);
    }
  });

  $("#simpermp").change(function () {
    const file = $("#simpermp").prop("files")[0];
    console.log(file.name);
    if (file.name == "") {
      $("#lblsimpermp").text("Pilih SIMPER/MINE PERMIT");
    } else {
      $("#lblsimpermp").text(file.name);
    }
  });

  $("#filesimpolisinew").change(function () {
    const file = $("#filesimpolisinew").prop("files")[0];
    console.log(file.name);
    if (file.name == "") {
      $("#lblsimpolisinew").text("Pilih file SIM Polisi");
    } else {
      $("#lblsimpolisinew").text(file.name);
    }
  });

  $("#simpermpnew").change(function () {
    const filee = $("#simpermpnew").prop("files")[0];
    if (filee.name === "") {
      $("#lblsimpermpnew").text("Pilih file SIMPER/MINE PERMIT");
    } else {
      $("#lblsimpermpnew").text(filee.name);
    }
  });

  $("#filePasFoto").change(function () {
    const filee = $("#filePasFoto").prop("files")[0];
    if (filee.name === "") {
      $("#lblfilePasFoto").text("Pilih file foto karyawan");
    } else {
      $("#lblfilePasFoto").text(filee.name);
    }
  });

  $("#filePendukung").change(function () {
    const filee = $("#filePendukung").prop("files")[0];
    if (filee.name === "") {
      $("#lblfilePendukung").text("Pilih file pendukung");
    } else {
      $("#lblfilePendukung").text(filee.name);
    }
  });

  $("#addStatusKaryawan").change(function () {
    let stat_kary = $("#addStatusKaryawan").val();

    $.ajax({
      type: "POST",
      url: site_url + "perjanjian/get_stat_waktu",
      data: {
        stat_kary: stat_kary,
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          if (data.stat_waktu == "T") {
            $("#addFieldPermanen").addClass("d-none");
            $("#addFieldKontrakAwal").removeClass("d-none");
            $("#addFieldKontrakAkhir").removeClass("d-none");
          } else if (data.stat_waktu == "F") {
            $("#addFieldPermanen").removeClass("d-none");
            $("#addFieldKontrakAwal").addClass("d-none");
            $("#addFieldKontrakAkhir").addClass("d-none");
          }
        } else {
          $("#erroraddStatusKaryawan").html(data.pesan);
          $("#addFieldPermanen").addClass("d-none");
          $("#addFieldKontrakAwal").addClass("d-none");
          $("#addFieldKontrakAkhir").addClass("d-none");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data status karyawan hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $.ajax({
    type: "POST",
    url: site_url + "karyawan/get_agama",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#addagama").html(data.agama);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data agama, hubungi administrator"
        );
        $("#addSimpanPersonal").remove();
      }
    },
  });
  $.ajax({
    type: "POST",
    url: site_url + "karyawan/get_stat_nikah",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#statPernikahan").html(data.statnikah);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data status pernikahan, hubungi administrator"
        );
        $("#addSimpanPersonal").remove();
      }
    },
  });
  $.ajax({
    type: "POST",
    url: site_url + "karyawan/get_all_jenis_mcu",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#hasilMCU").html(data.jmcu);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data hasil MCU, hubungi administrator"
        );
      }
    },
  });
  $.ajax({
    type: "POST",
    url: site_url + "izin_tambang/get_all_unit",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#jenisUnitSimper").html(data.unit);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormdlsimper").removeClass("d-none");
      $(".errormdlsimper").removeClass("alert-info");
      $(".errormdlsimper").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormdlsimper").html(
          "Terjadi kesalahan saat load data unit simper, hubungi administrator"
        );
        $("#btnsimpanunitsimper").remove();
      }
    },
  });
  $.ajax({
    type: "POST",
    url: site_url + "izin_tambang/get_all_unit",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#jenisUnitSimpernw").html(data.unit);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormdlsimpernw").removeClass("d-none");
      $(".errormdlsimpernw").removeClass("alert-info");
      $(".errormdlsimpernw").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormdlsimpernw").html(
          "Terjadi kesalahan saat load data unit simper, hubungi administrator"
        );
        $("#btnsimpanunitsimpernw").remove();
      }
    },
  });
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
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
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
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data nama vaksin, hubungi administrator"
        );
      }
    },
  });
  $.ajax({
    type: "POST",
    url: site_url + "izin_tambang/get_all_akses",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#tipeAksesUnit").html(data.akses);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormdlsimper").removeClass("d-none");
      $(".errormdlsimper").removeClass("alert-info");
      $(".errormdlsimper").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormdlsimper").html(
          "Terjadi kesalahan saat load data unit simper, hubungi administrator"
        );
        $("#btnsimpanunitsimper").remove();
      }
    },
  });
  $.ajax({
    type: "POST",
    url: site_url + "izin_tambang/get_all_akses",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#tipeAksesUnitnw").html(data.akses);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormdlsimpernw").removeClass("d-none");
      $(".errormdlsimpernw").removeClass("alert-info");
      $(".errormdlsimpernw").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormdlsimper").html(
          "Terjadi kesalahan saat load data unit simper, hubungi administrator"
        );
        $("#btnsimpanunitsimper").remove();
      }
    },
  });
  $.ajax({
    type: "POST",
    url: site_url + "pendidikan/get_all",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#pendidikanTerakhir").html(data.pdk);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data pendidikan terakhir, hubungi administrator"
        );
        $("#addSimpanPersonal").remove();
      }
    },
  });
  $.ajax({
    type: "POST",
    url: site_url + "karyawan/get_resident",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#addStatusResidence").html(data.tgl);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data status tinggal, hubungi administrator"
        );
        $("#editSimpanPekerjaan").remove();
      }
    },
  });
  function daerah_ganti() {
    $("#provData").change(function () {
      let id_prov = $("#provData").val();

      $("#txtkota").LoadingOverlay("show");
      $("#txtkec").LoadingOverlay("show");
      $("#txtkel").LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "daerah/get_kab?authtoken=" + $("#token").val(),
        data: {
          id_prov: id_prov,
        },
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#kotaData").html(data.kab);
            $("#kecData").html(
              "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
            );
            $("#kelData").html(
              "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
            );
            $("#kotaData").removeAttr("disabled");
            $("#txtkota").LoadingOverlay("hide");
            $("#txtkec").LoadingOverlay("hide");
            $("#txtkel").LoadingOverlay("hide");
          } else {
            $("#kotaData").html(
              "<option value=''>-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>"
            );
            $("#kecData").html(
              "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
            );
            $("#kelData").html(
              "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
            );
            $("#kotaData").attr("disabled", true);
            $("#kecData").attr("disabled", true);
            $("#kelData").attr("disabled", true);
            $("#txtkota").LoadingOverlay("hide");
            $("#txtkec").LoadingOverlay("hide");
            $("#txtkel").LoadingOverlay("hide");
          }

          if (id_prov != "") {
            $(".errorProvData").html("");
          } else {
            $(".errorProvData").html("<p>Provinsi wajib diisi</p>");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtkota").LoadingOverlay("hide");
          $("#txtkec").LoadingOverlay("hide");
          $("#txtkel").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator"
            );
            $("#addSimpanPersonal").remove();
          }
        },
      });
    });

    $("#kotaData").change(function () {
      let id_kab = $("#kotaData").val();

      $("#txtkec").LoadingOverlay("show");
      $("#txtkel").LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "daerah/get_kec?authtoken=" + $("#token").val(),
        data: {
          id_kab: id_kab,
        },
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#kecData").html(data.kec);
            $("#kelData").html(
              "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
            );
            $("#kecData").removeAttr("disabled");
            $("#txtkec").LoadingOverlay("hide");
            $("#txtkel").LoadingOverlay("hide");
          } else {
            $("#kecData").html(
              "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
            );
            $("#kelData").html(
              "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
            );
            $("#kecData").attr("disabled", true);
            $("#kelData").attr("disabled", true);
            $("#txtkec").LoadingOverlay("hide");
            $("#txtkel").LoadingOverlay("hide");
          }

          if (id_kab != "") {
            $(".errorKotaData").html("");
          } else {
            $(".errorKotaData").html("<p>Kabupaten/kota wajib dipilih</p>");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtkec").LoadingOverlay("hide");
          $("#txtkel").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
            );
            $("#addSimpanPersonal").remove();
          }
        },
      });
    });
    $("#kecData").change(function () {
      let id_kec = $("#kecData").val();

      $("#txtkel").LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "daerah/get_kel?authtoken=" + $("#token").val(),
        data: {
          id_kec: id_kec,
        },
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#kelData").html(data.kel);
            $("#kelData").removeAttr("disabled");
            $("#txtkel").LoadingOverlay("hide");
          } else {
            $("#kelData").html(
              "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
            );
            $("#kelData").attr("disabled", true);
            $("#txtkel").LoadingOverlay("hide");
          }

          if (id_kec != "") {
            $(".errorKecData").html("");
          } else {
            $(".errorKecData").html("<p>Kecamatan wajib dipilih</p>");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          $("#txtkel").LoadingOverlay("hide");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
            );
            $("#addSimpanPersonal").remove();
          }
        },
      });
    });

    $("#kelData").change(function () {
      let id_kel = $("#kelData").val();
      if (id_kel != "") {
        $(".errorKelData").html("");
      } else {
        $(".errorKelData").html("<p>Kelurahan wajib dipilih</p>");
      }
    });

    $("#addStatusKaryawan").change(function () {
      $("#addTanggalPermanen").val("");
      $("#addTanggalKontrakAwal").val("");
      $("#addTanggalKontrakAkhir").val("");
    });
  }

  $("#refreshJenisSIM").click(function () {
    $("#txtizinSIM").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/get_sim",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#addJenisSIM").html(data.siim);
        $("#txtizinSIM").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data jenis SIM, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshJenisSIMnew").click(function () {
    $("#txtizinSIMnew").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/get_sim",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#addJenisSIMnew").html(data.siim);
        $("#txtizinSIMnew").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgizinnew").removeClass("d-none");
        $(".errormsgizinnew").removeClass("alert-info");
        $(".errormsgizinnew").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgizinnew").html(
            "Terjadi kesalahan saat load data jenis SIM, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshJenisSertifikat").click(function () {
    $("#txtjenisSertifkat").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "sertifikasi/get_jenis_sertifikasi",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#jenisSertifikasi").html(data.srt);
        $("#txtjenisSertifkat").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtjenisSertifkat").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator"
          );
          $("#addSimpanSertifikasi").remove();
          $("#addResetSertifikasi").remove();
        }
      },
    });
  });

  $("#refreshhasilMCU").click(function () {
    $("#txthasilMCU").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/get_all_jenis_mcu",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#hasilMCU").html(data.jmcu);
        $("#txthasilMCU").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txthasilMCU").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data hasil MCU, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshjenisVaksin").click(function () {
    $("#txtjenisVaksin").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "vaksin/get_vaksin_jenis_all",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#jenisVaksin").html(data.jvks);
        $("#txtjenisVaksin").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtjenisVaksin").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data jenis vaksin, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshnamaVaksin").click(function () {
    $("#txtnamaVaksin").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "vaksin/get_vaksin_nama_all",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#namaVaksin").html(data.nvks);
        $("#txtnamaVaksin").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtnamaVaksin").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data nama vaksin, hubungi administrator"
          );
        }
      },
    });
  });

  $("#refreshjenisUnitSimper").click(function () {
    $("#txtjenisUnitSimper").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "izin_tambang/get_all_unit",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#jenisUnitSimper").html(data.unit);
        $("#txtjenisUnitSimper").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtjenisUnitSimper").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormdlsimper").removeClass("d-none");
        $(".errormdlsimper").removeClass("alert-info");
        $(".errormdlsimper").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormdlsimper").html(
            "Terjadi kesalahan saat load data unit simper, hubungi administrator"
          );
          $("#btnsimpanunitsimper").remove();
        }
      },
    });
  });

  $("#refreshjenisUnitSimpernw").click(function () {
    $("#txtjenisUnitSimpernw").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "izin_tambang/get_all_unit",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#jenisUnitSimpernw").html(data.unit);
        $("#txtjenisUnitSimpernw").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtjenisUnitSimpernw").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormdlsimpernw").removeClass("d-none");
        $(".errormdlsimpernw").removeClass("alert-info");
        $(".errormdlsimpernw").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormdlsimpernw").html(
            "Terjadi kesalahan saat load data unit SIMPER, hubungi administrator"
          );
          $("#btnsimpanunitsimpernw").remove();
        }
      },
    });
  });

  $("#refreshtipeAksesUnit").click(function () {
    $("#txttipeAksesUnit").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "izin_tambang/get_all_akses",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#tipeAksesUnit").html(data.akses);
        $("#txttipeAksesUnit").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txttipeAksesUnit").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormdlsimper").removeClass("d-none");
        $(".errormdlsimper").removeClass("alert-info");
        $(".errormdlsimper").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormdlsimper").html(
            "Terjadi kesalahan saat load data unit simper, hubungi administrator"
          );
          $("#btnsimpanunitsimper").remove();
        }
      },
    });
  });

  $("#refreshtipeAksesUnitnw").click(function () {
    $("#txttipeAksesUnitnw").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "izin_tambang/get_all_akses",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#tipeAksesUnitnw").html(data.akses);
        $("#txttipeAksesUnitnw").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txttipeAksesUnitnw").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
        $(".errormdlsimpernw").removeClass("d-none");
        $(".errormdlsimpernw").removeClass("alert-info");
        $(".errormdlsimpernw").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormdlsimpernw").html(
            "Terjadi kesalahan saat load data unit simper, hubungi administrator"
          );
          $("#btnsimpanunitsimpernw").remove();
        }
      },
    });
  });

  $("#refreshProv").click(function () {
    $("#txtprov").LoadingOverlay("show");
    $("#txtkota").LoadingOverlay("show");
    $("#txtkec").LoadingOverlay("show");
    $("#txtkel").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "daerah/get_prov?authtoken=" + $("#token").val(),
      data: {},
      success: function (data) {
        var data = JSON.parse(data);
        $("#provData").html(data.prov);
        $("#kotaData").html(
          "<option value=''>-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>"
        );
        $("#kecData").html(
          "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
        );
        $("#kelData").html(
          "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
        );
        $("#txtprov").LoadingOverlay("hide");
        $("#txtkota").LoadingOverlay("hide");
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkel").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#provData").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtprov").LoadingOverlay("hide");
        $("#txtkota").LoadingOverlay("hide");
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data provinsi, hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $("#refreshKota").click(function () {
    let id_prov = $("#provData").val();

    $("#txtkota").LoadingOverlay("show");
    $("#txtkec").LoadingOverlay("show");
    $("#txtkel").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "daerah/get_kab?authtoken=" + $("#token").val(),
      data: {
        id_prov: id_prov,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#kotaData").html(data.kab);
        $("#kecData").html(
          "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>"
        );
        $("#kelData").html(
          "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
        );
        $("#txtkota").LoadingOverlay("hide");
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkel").LoadingOverlay("hide");

        if (id_prov != "") {
          $(".errorProvData").html("");
        } else {
          $(".errorProvData").html("<p>Provinsi wajib diisi</p>");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtkota").LoadingOverlay("hide");
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $("#refreshKec").click(function () {
    let id_kab = $("#kotaData").val();

    $("#txtkec").LoadingOverlay("show");
    $("#txtkota").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "daerah/get_kec?authtoken=" + $("#token").val(),
      data: {
        id_kab: id_kab,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#kecData").html(data.kec);
        $("#kelData").html(
          "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>"
        );
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkota").LoadingOverlay("hide");
        if (id_kab != "") {
          $(".errorKotaData").html("");
        } else {
          $(".errorKotaData").html("<p>Kabupaten/kota wajib dipilih</p>");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtkec").LoadingOverlay("hide");
        $("#txtkota").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $("#refreshKel").click(function () {
    let id_kec = $("#kecData").val();

    $("#txtkel").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "daerah/get_kel?authtoken=" + $("#token").val(),
      data: {
        id_kec: id_kec,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#kelData").html(data.kel);
        $("#txtkel").LoadingOverlay("hide");
        if (id_kab != "") {
          $(".errorKecData").html("");
        } else {
          $(".errorKecData").html("<p>Kecamatan wajib dipilih</p>");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtkel").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data kecamatan, hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $("#refreshDidik").click(function () {
    $("#txtDidik").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "pendidikan/get_all",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#pendidikanTerakhir").html(data.pdk);
        $("#txtDidik").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        $("#txtDidik").LoadingOverlay("hide");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data pendidikan terakhir, hubungi administrator"
          );
          $("#addSimpanPersonal").remove();
        }
      },
    });
  });

  $("#refreshDepart").click(function () {
    let auth_m_per = $("#addPerKary").val();

    if (auth_m_per != "") {
      $("#txtdepartkary").LoadingOverlay("show");
      $("#txtposisikary").LoadingOverlay("show");

      $.ajax({
        type: "POST",
        url: site_url + "departemen/get_by_auth_m_per",
        data: {
          auth_m_per: auth_m_per,
          token: token,
        },
        success: function (data) {
          var data = JSON.parse(data);
          $("#addDepartKary").html(data.dprt);
          $("#addDepartKary").removeAttr("disabled");
          $("#addPosisiKary").attr("disabled", true);
          $("#refreshPosisi").attr("disabled", true);
          $("#addPosisiKary").html(
            '<option value ="">-- WAJIB DIPILIH --</option>'
          );
          $("#txtdepartkary").LoadingOverlay("hide");
          $("#txtposisikary").LoadingOverlay("hide");

          if (auth_m_per != "") {
            $(".errorAddPerKary").html("");
          } else {
            $(".errorAddPerKary").html("<p>Perusahaan wajib dipilih</p>");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("#txtdepartkary").LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data departemen, hubungi administrator"
            );
            $("#addSimpanPekerjaan").remove();
          }
        },
      });
    } else {
      swal("Error", "Pilih perusahaan", "error");
    }
  });

  $("#refreshPosisi").click(function () {
    let auth_depart = $("#addDepartKary").val();

    $("#addPosisiKary").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "posisi/get_by_authdepart",
      data: {
        auth_depart: auth_depart,
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#addPosisiKary").html(data.posisi);
        $("#addPosisiKary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#addPosisiKary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data posisi, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });
  $("#refreshKlasifikasi").click(function () {
    $("#txtklasifikasikary").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "klasifikasi/get_all",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#addKlasifikasiKary").html(data.kls);
        $("#txtklasifikasikary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtklasifikasikary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data klasifikasi, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });
  $("#refreshPOH").click(function () {
    $("#txtPOHKary").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "poh/get_all",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#addPOHKary").html(data.pho);
        $("#txtPOHKary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtPOHKary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data POH, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshLokterima").click(function () {
    let auth_per = $("#addPerKary").val();
    $("#txtlokterimakary").LoadingOverlay("show");

    if (auth_per != "") {
      $.ajax({
        type: "POST",
        url: site_url + "lokasipenerimaan/get_by_authper",
        data: {
          token: token,
        },
        success: function (data) {
          var data = JSON.parse(data);
          $("#txtlokterimakary").LoadingOverlay("hide");
          $("#addLokterimaKary").removeAttr("disabled");
          $("#addLokterimaKary").html(data.lkt);
          $("#addLokterimaKary").removeAttr("disabled");
          $("#refreshLokterima").removeAttr("disabled");
        },
        error: function () {
          $("#txtlokterimakary").LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").removeClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data lokasi penerimaan, hubungi administrator"
            );
            $("#addSimpanPekerjaan").remove();
          }
        },
      });
    }
  });

  $("#refreshLokker").click(function () {
    $("#txtlokkerkary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "lokasikerja/get_all",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#addLokasiKerja").html(data.lkr);
        $("#txtlokkerkary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtlokkerkary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data lokasi kerja, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshTipe").click(function () {
    $("#txtjeniskary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/get_all_tipe",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#addTipeKaryawan").html(data.tipe);
        $("#txtjeniskary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtjeniskary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data tipe karyawan, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $("#refreshLevel").click(function () {
    let auth_per = $("#addPerKary").val();
    $("#txtLevelkary").LoadingOverlay("show");
    alert(auth_per);
    if (auth_per != "") {
      $.ajax({
        type: "POST",
        url: site_url + "level/get_all",
        data: {
          auth_per: auth_per,
          token: token,
        },
        success: function (data) {
          alert(data);
          var data = JSON.parse(data);
          $("#addLevelKary").html(data.lvl);
          $("#txtLevelkary").LoadingOverlay("hide");
          $("#addLevelKary").removeAttr("disabled");
          $("#refreshLevel").removeAttr("disabled");
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("#txtLevelkary").LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data level, hubungi administrator"
            );
            $("#addSimpanPekerjaan").remove();
          }
        },
      });
    }
  });

  $("#refreshResidence").click(function () {
    $("#txtstatresidence").LoadingOverlay("show");
    $("#addStatusResidence").val("").trigger("change");
    $("#txtstatresidence").LoadingOverlay("hide");
  });

  $("#refreshstatkaryawan").click(function () {
    $("#txtstatkary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "perjanjian/get_all",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#addStatusKaryawan").html(data.janji);
        $("#addFieldKontrakAwal").addClass("d-none");
        $("#addFieldKontrakAkhir").addClass("d-none");
        $("#addFieldPermanen").addClass("d-none");

        $("#addTanggalPermanen").val("");
        $("#addTanggalKontrakAwal").val("");
        $("#addTanggalKontrakAkhir").val("");

        $("#txtstatkary").LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#txtstatkary").LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data status karyawan, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });
  });

  $.ajax({
    type: "POST",
    url: site_url + "klasifikasi/get_all",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#addKlasifikasiKary").html(data.kls);
      $("#addKlasifikasiKary").select2({
        theme: "bootstrap4",
      });
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data klasifikasi, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "karyawan/get_sim",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#addJenisSIM").html(data.siim);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data SIM, hubungi administrator"
        );
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "karyawan/get_sim",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#addJenisSIMnew").html(data.siim);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsgizinnew").removeClass("d-none");
      $(".errormsgizinnew").removeClass("alert-info");
      $(".errormsgizinnew").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsgizinnew").html(
          "Terjadi kesalahan saat load data SIM, hubungi administrator"
        );
      }
    },
  });

  $("#addagama").change(function () {
    let agama = $("#addagama").val();

    if (agama != "") {
      $(".errorAddAgama").html("");
    } else {
      $(".errorAddAgama").html("<p>Agama wajib dipilih</p>");
    }
  });
  $("#jenisKelamin").change(function () {
    let jk = $("#jenisKelamin").val();
    if (jk != "") {
      $(".errorJenisKelamin").html("");
    } else {
      $(".errorJenisKelamin").html("<p>Jenis kelamin wajib dipilih</p>");
    }
  });
  $("#statPernikahan").change(function () {
    let stkw = $("#statPernikahan").val();
    if (stkw != "") {
      $(".errorStatPernikahan").html("");
    } else {
      $(".errorStatPernikahan").html("<p>Kelurahan wajib dipilih</p>");
    }
  });
  $("#kewarganegaraan").change(function () {
    let warga = $("#kewarganegaraan").val();
    if (warga != "") {
      $(".errorKewarganegaraan").html("");
    } else {
      $(".errorKewarganegaraan").html("<p>Warga negara wajib dipilih</p>");
    }
  });

  function get_data_kary(auth_per) {
    $("#txtdepartkary").LoadingOverlay("show");
    $("#txtposisikary").LoadingOverlay("show");
    $("#txtlokterimakary").LoadingOverlay("show");
    $("#txtpohkary").LoadingOverlay("show");
    $("#txtLevelkary").LoadingOverlay("show");

    $.ajax({
      type: "POST",
      url: site_url + "departemen/get_by_auth_m_per",
      data: {
        auth_m_per: auth_per,
        token: token,
      },
      success: function (data) {
        $("#addPosisiKary").attr("disabled", true);
        $("#addPosisiKary").html(
          '<option value="">-- WAJIB DIPILIH --</option>'
        );
        $("#refreshPosisi").attr("disabled", true);
        var data = JSON.parse(data);
        $("#addDepartKary").html(data.dprt);
        if (auth_per != "") {
          $(".errorAddPerKary").html("");
        } else {
          $(".errorAddPerKary").html("<p>Perusahaan wajib dipilih</p>");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data departemen, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });

    $.ajax({
      type: "POST",
      url: site_url + "level/get_all",
      data: {
        auth_per: auth_per,
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#addLevelKary").html(data.lvl);
        $("#addLevelKary").removeAttr("disabled");
        $("#refreshLevel").removeAttr("disabled");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data level, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });

    $.ajax({
      type: "POST",
      url: site_url + "lokasipenerimaan/get_by_authper",
      data: {
        token: token,
      },
      success: function (data) {
        $("#addLokterimaKary").removeAttr("disabled");
        var data = JSON.parse(data);
        $("#addLokterimaKary").html(data.lkt);
        $("#addLokterimaKary").removeAttr("disabled");
        $("#refreshLokterima").removeAttr("disabled");
      },
      error: function () {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").removeClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data lokasi penerimaan, hubungi administrator"
          );
          $("#addSimpanPekerjaan").remove();
        }
      },
    });

    $("#txtdepartkary").LoadingOverlay("hide");
    $("#txtposisikary").LoadingOverlay("hide");
    $("#txtlokterimakary").LoadingOverlay("hide");
    $("#txtpohkary").LoadingOverlay("hide");
    $("#txtLevelkary").LoadingOverlay("hide");
  }

  $("#addPerKary").change(function () {
    let auth_per = $("#addPerKary").val();
    let auth_cek = $(".89kjm78ujki782m4x787909h3").text();

    if (auth_per != "") {
      if (auth_per_old != "") {
        if (auth_per != auth_per_old) {
          swal({
            title: "Ganti Perusahaan",
            text: "Mengganti perusahaan akan me-reset beberapa data karyawan, yakin akan diganti?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#36c6d3",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Ganti perusahaan",
            cancelButtonText: "Batalkan",
          }).then(function (result) {
            if (result.value) {
              $.LoadingOverlay("show");
              auth_per_old = auth_per;
              get_data_kary(auth_per);
              $("#addPerKary").val(auth_per).trigger("change");
              $("#addPosisiKary").html(
                '<option value="">-- WAJIB DIPILIH --</option>'
              );
              $("#addPosisiKary").attr("disabled", true);
              $("#refreshPosisi").attr("disabled", true);
              aktifKaryawan();
              $.LoadingOverlay("hide");
            } else if (result.dismiss == "cancel") {
              swal("Batal", "Perusahaan batal diganti", "info");
              $("#addPerKary").val(auth_per_old).trigger("change");
              $("#addDepartKary").removeAttr("disabled");
              $("#addPosisiKary").removeAttr("disabled");
            } else {
              swal.close();
            }
          });
        }
      } else {
        $.LoadingOverlay("show");
        get_data_kary(auth_per);
        auth_per_old = auth_per;
        if (auth_cek == "") {
          $("#colPersonal").collapse("show");
          $("#colKaryawan").collapse("hide");
          $("#colIzinTambang").collapse("hide");
          $("#colSertifikasi").collapse("hide");
          $("#colMCU").collapse("hide");
          $("#colVaksin").collapse("hide");
          $("#colFilePendukung").collapse("hide");
        }
        $.LoadingOverlay("hide");
      }
    } else {
      $("#addDepartKary").html('<option value="">-- WAJIB DIPILIH --</option>');
      $("#addPosisiKary").html('<option value="">-- WAJIB DIPILIH --</option>');
      $("#addLevelKary").html('<option value="">-- WAJIB DIPILIH --</option>');
      $("#addLokterimaKary").html(
        '<option value="">-- WAJIB DIPILIH --</option>'
      );
      $("#addDepartKary").attr("disabled", true);
      $("#addPosisiKary").attr("disabled", true);
      $("#addLevelKary").attr("disabled", true);
      $("#addLokterimaKary").attr("disabled", true);
      $("#refreshDepart").attr("disabled", true);
      $("#refreshPosisi").attr("disabled", true);
      $("#refreshLevel").attr("disabled", true);
      $("#refreshLokterima").attr("disabled", true);
    }
  });

  $(document).on("click", ".hapus_unit", function () {
    let id_unit = $(this).attr("id");
    let jenis_unit = $(this).attr("value");
    let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();

    swal({
      title: "Hapus unit",
      text: "Yakin data unit " + jenis_unit + " akan dihapus?",
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
          url: site_url + "izin_tambang/hapus_unit",
          data: {
            id_unit: id_unit,
            token: token,
          },
          success: function (data) {
            var data = JSON.parse(data);
            if (data.statusCode == 200) {
              $("#idizintambang").LoadingOverlay("show");
              $("#idizintambang").load(
                site_url + "izin_tambang/izin_tambang?auth_izin=" + auth_izin
              );
              // $("#idizintambang").LoadingOverlay("hide");
            } else {
              $(".errormsgizin").removeClass("d-none");
              $(".errormsgizin").removeClass("alert-info");
              $(".errormsgizin").addClass("alert-danger");
              $(".errormsgizin").html(data.pesan);

              $(".errormsgizin")
                .fadeTo(3000, 500)
                .slideUp(500, function () {
                  $(".errormsgizin").slideUp(500);
                });
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsgizin").removeClass("d-none");
            $(".errormsgizin").removeClass("alert-info");
            $(".errormsgizin").addClass("alert-danger");
            if (thrownError != "") {
              $(".errormsgizin").html(
                "Terjadi kesalahan saat menghapus unit, hubungi administrator"
              );
            }

            $(".errormsgizin")
              .fadeTo(3000, 500)
              .slideUp(500, function () {
                $(".errormsgizin").slideUp(500);
                $(".errormsgizin").addClass("d-none");
              });
          },
        });
      } else if (result.dismiss == "cancel") {
        swal("Batal", "Data unit batal disimpan", "warning");
        return false;
      } else {
        swal.close();
      }
    });
  });

  $(document).on("click", ".hapus_sertifikasi", function () {
    let auth_Sertifikat = $(this).attr("id");
    let no_sertifikat = $(this).attr("value");
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

    swal({
      title: "Hapus Sertifikasi",
      text: "Yakin data No. Sertifikat " + no_sertifikat + " akan dihapus?",
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
          url: site_url + "sertifikasi/hapus_sertifikasi",
          data: {
            auth_Sertifikat: auth_Sertifikat,
            token: token,
          },
          success: function (data) {
            var data = JSON.parse(data);
            if (data.statusCode == 200) {
              $("#idsertifikat").LoadingOverlay("show");
              $("#idsertifikat").load(
                site_url + "karyawan/sertifikasi?auth_person=" + auth_person
              );
              // $("#idizintambang").LoadingOverlay("hide");
            } else {
              $(".errMsgSertifikasi").removeClass("d-none");
              $(".errMsgSertifikasi").removeClass("alert-info");
              $(".errMsgSertifikasi").addClass("alert-danger");
              $(".errMsgSertifikasi").html(data.pesan);
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errMsgSertifikasi").removeClass("d-none");
            $(".errMsgSertifikasi").removeClass("alert-info");
            $(".errMsgSertifikasi").addClass("alert-danger");
            if (thrownError != "") {
              $(".errMsgSertifikasi").html(
                "Terjadi kesalahan saat menghapus sertifikat, hubungi administrator"
              );
            }

            $(".errMsgSertifikasi")
              .fadeTo(3000, 500)
              .slideUp(500, function () {
                $(".errMsgSertifikasi").slideUp(500);
                $(".errMsgSertifikasi").addClass("d-none");
              });
          },
        });
      } else if (result.dismiss == "cancel") {
        swal("Batal Edit", "Update data sertifikasi dibatalkan", "warning");
        return false;
      } else {
        swal.close();
      }
    });
  });

  $(document).on("click", ".edit_sertifikasi", function () {
    let auth_sertifikat = $(this).attr("id");

    $.ajax({
      type: "POST",
      url: site_url + "sertifikasi/get_sertifikasi",
      data: {
        auth_sertifikat: auth_sertifikat,
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#mdleditsertifikat").modal("show");
        $(".7u67u834hs7dg4haj231hh67ju7a2").text(data.auth_sertifikat);
        $("#jenisSertifikasiEdit")
          .val(data.id_jenis_sertifikasi)
          .trigger("change");
        $("#noSertifikatEdit").val(data.no_sertifikasi);
        $("#namaLembagaEdit").val(data.lembaga);
        $("#tanggalSertifikasiEdit").val(data.tgl_sertifikasi);
        $("#masaBerlakuSertifikatEdit").val("");
        $("#tanggalSertifikasiAkhirEdit").val(data.tgl_berakhir_sertifikasi);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".erreditsertifikat").removeClass("d-none");
        $(".erreditsertifikat").removeClass("alert-info");
        $(".erreditsertifikat").addClass("alert-danger");
        if (thrownError != "") {
          $(".erreditsertifikat").html(
            "Terjadi kesalahan saat load data sertifikasi, hubungi administrator"
          );
        }
      },
    });
  });

  $(document).on("click", ".upload_sertifikasi", function () {
    let auth_sertifikat = $(this).attr("id");

    $.ajax({
      type: "POST",
      url: site_url + "sertifikasi/get_sertifikasi",
      data: {
        auth_sertifikat: auth_sertifikat,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#mdluploadulangser").modal("show");
        $("#jdluploadulangser").text(
          "Upload Ulang File Sertifikat - " + data.no_sertifikasi
        );
        $(".9f7fjmuj8ik2js4n8k66g3hjl323").text(data.auth_sertifikat);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".erreditsertifikat").removeClass("d-none");
        $(".erreditsertifikat").removeClass("alert-info");
        $(".erreditsertifikat").addClass("alert-danger");
        if (thrownError != "") {
          $(".erreditsertifikat").html(
            "Terjadi kesalahan saat load data sertifikasi, hubungi administrator"
          );
        }
      },
    });
  });

  $("#btnuploadulangser").click(function () {
    let auth_ser = $(".9f7fjmuj8ik2js4n8k66g3hjl323").text();
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
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
          "Detail Sertifikasi - " + data.no_sertifikasi
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

  $(document).on("click", ".hapusvks", function () {
    let auth_vaksin = $(this).attr("id");
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

    swal({
      title: "Sukses",
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
              $("#idvaksin").LoadingOverlay("show");
              $("#idvaksin").load(
                site_url + "karyawan/vaksin?auth_person=" + auth_person
              );
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

  $("#btneditsertifikat").click(function () {
    let auth_ser = $(".7u67u834hs7dg4haj231hh67ju7a2").text();
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
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
          $("#idsertifikat").LoadingOverlay("show");
          $("#idsertifikat").load(
            site_url + "karyawan/sertifikasi?auth_person=" + auth_person
          );
          swal("Berhasil", data.pesan, "success");
          $(".7u67u834hs7dg4haj231hh67ju7a2").text("");
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

  $.ajax({
    type: "POST",
    url: site_url + "poh/get_all",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#addPOHKary").html(data.pho);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data POH, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "lokasikerja/get_all",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#addLokasiKerja").html(data.lkr);
      $("#addLokasiKerja").select2({
        theme: "bootstrap4",
      });
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data lokasi kerja, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });
  $.ajax({
    type: "POST",
    url: site_url + "perjanjian/get_all",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#addStatusKaryawan").html(data.janji);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data status karyawan, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  $.ajax({
    type: "POST",
    url: site_url + "karyawan/get_all_tipe",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#addTipeKaryawan").html(data.tipe);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data tipe karyawan, hubungi administrator"
        );
        $("#addSimpanPekerjaan").remove();
      }
    },
  });

  $("#addDepartKary").change(function () {
    let auth_depart = $("#addDepartKary").val();

    if (auth_depart != "") {
      $("#txtposisikary").LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "posisi/get_by_authdepart",
        data: {
          auth_depart: auth_depart,
          token: token,
        },
        success: function (data) {
          $("#addPosisiKary").removeAttr("disabled");
          $("#refreshPosisi").removeAttr("disabled");
          var data = JSON.parse(data);
          $("#addPosisiKary").html(data.posisi);
          $("#txtposisikary").LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("#txtposisikary").LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").removeClass("alert-info");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat load data posisi, hubungi administrator"
            );
            $("#addSimpanPekerjaan").remove();
          }
        },
      });
    } else {
      $("#addPosisiKary").html('<option value="">-- WAJIB DIPILIH --</option>');
      $("#addPosisiKary").attr("disabled", true);
      $("#refreshPosisi").attr("disabled", true);
    }
  });

  $("#masaBerlakuSertifikat").change(function () {
    let tglsrt = $("#tanggalSertifikasi").val();
    let masa = $("#masaBerlakuSertifikat").val();

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
          $("#tanggalSertifikasiAkhir").val(data.tglexp);
        }
      },
    });
  });

  $("#tanggalSertifikasi").change(function () {
    let tglsrt = $("#tanggalSertifikasi").val();
    let masa = $("#masaBerlakuSertifikat").val();

    $.ajax({
      type: "post",
      url: site_url + "sertifikasi/getdateexpsrt",
      data: {
        tglsrt: tglsrt,
        masa: masa,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#tanggalSertifikasiAkhir").val(data.tglexp);
        }
      },
    });
  });
  $.ajax({
    type: "POST",
    url: site_url + "sertifikasi/get_jenis_sertifikasi",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#jenisSertifikasi").html(data.srt);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator"
        );
        $("#addSimpanSertifikasi").remove();
        $("#addResetSertifikasi").remove();
      }
    },
  });
  $.ajax({
    type: "POST",
    url: site_url + "sertifikasi/get_jenis_sertifikasi",
    data: {
      token: token,
    },
    success: function (data) {
      var data = JSON.parse(data);
      $("#jenisSertifikasiEdit").html(data.srt);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $.LoadingOverlay("hide");
      $(".errormsg").removeClass("d-none");
      $(".errormsg").removeClass("alert-info");
      $(".errormsg").addClass("alert-danger");
      if (thrownError != "") {
        $(".errormsg").html(
          "Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator"
        );
        $("#addSimpanSertifikasi").remove();
        $("#addResetSertifikasi").remove();
      }
    },
  });
  $("#namaLengkap").keyup(function (e) {
    let nama = $("#namaLengkap").val().trim();

    if (nama != "") {
      $(".errorNamaLengkap").html("");
    } else {
      $(".errorNamaLengkap").html("<p>Nama lengkap wajib diisi</p>");
    }
  });
  $("#tempatLahir").keyup(function (e) {
    let tmp_lahir = $("#tempatLahir").val().trim();

    if (tmp_lahir != "") {
      $(".errorTempatLahir").html("");
    } else {
      $(".errorTempatLahir").html("<p>Tempat lahir wajib diisi</p>");
    }
  });
  $("#tanggalLahir").keyup(function (e) {
    let tgl_lahir = $("#tanggalLahir").val().trim();

    if (tgl_lahir != "") {
      $(".errorTanggalLahir").html("");
    } else {
      $(".errorTanggalLahir").html("<p>Tanggal lahir wajib diisi</p>");
    }
  });
  $("#tanggalLahir").change(function () {
    let tgl_lahir = $("#tanggalLahir").val().trim();

    if (tgl_lahir != "") {
      $(".errorTanggalLahir").html("");
    } else {
      $(".errorTanggalLahir").html("<p>Tanggal lahir wajib diisi</p>");
    }
  });
  $("#addNIKKary").keyup(function (e) {
    let nikkary = $("#addNIKKary").val().trim();

    if (nikkary != "") {
      $(".erroraddNIKKary").html("");
    } else {
      $(".erroraddNIKKary").html("<p>NIK wajib diisi</p>");
    }
  });
  $("#noNPWP").keyup(function (e) {
    let nonpwp = $("#noNPWP").val().trim();

    if (nonpwp != "") {
      jmlnpwp = nonpwp.replace(/['.'|_|-]/g, "");
      jml = jmlnpwp.length;

      if (jml < 15) {
        $(".errorNoNPWP").html("<p>No. NPWP minimal 15 karakter</p>");
      } else {
        $(".errorNoNPWP").html("");
      }
    } else {
      $(".errorNoNPWP").html("");
    }
  });
  $("#noKTP").keyup(function (e) {
    let noktp = $("#noKTP").val().trim();

    if (noktp != "") {
      jmlktp = noktp.replace(/['.'|_|-]/g, "");
      jmlhrf = jmlktp.length;

      if (jmlhrf > 16) {
        $(".errorNoKTP").html("<p>No. KTP maksimal 16 karakter</p>");
      } else if (jmlhrf < 16) {
        $(".errorNoKTP").html("<p>No. KTP minimal 16 karakter</p>");
      } else {
        $(".errorNoKTP").html("");
      }
    }
  });
  $("#noKTPCek").keyup(function (e) {
    let noKTPCek = $("#noKTPCek").val().trim();

    if (noKTPCek != "") {
      jmlktp = noKTPCek.replace(/['.'|_|-]/g, "");
      jmlhrf = jmlktp.length;

      if (jmlhrf > 16) {
        $(".errornoKTPCek").html("<p>No. KTP maksimal 16 karakter</p>");
        $("#btnverifikasiktp").attr("disabled", true);
      } else if (jmlhrf < 16) {
        $(".errornoKTPCek").html("<p>No. KTP minimal 16 karakter</p>");
        $("#btnverifikasiktp").attr("disabled", true);
      } else {
        $(".errornoKTPCek").html("");
        $("#btnverifikasiktp").removeAttr("disabled");
      }
    } else {
      $(".errornoKTPCek").html("<p>No. KTP tidak boleh kosong</p>");
      $("#btnverifikasiktp").attr("disabled", true);
    }
  });
  $("#noKK").keyup(function (e) {
    let noKK = $("#noKK").val().trim();

    if (noKK != "") {
      jmlkk = noKK.replace(/['.'|_|-]/g, "");
      jmlhrf = jmlkk.length;

      if (jmlhrf > 16) {
        $(".errorNoKK").html("<p>No. KK maksimal 16 karakter</p>");
      } else if (jmlhrf < 16) {
        $(".errorNoKK").html("<p>No. KK minimal 16 karakter</p>");
      } else {
        $(".errorNoKK").html("");
      }
    }
  });
  $("#alamatKTP").keyup(function (e) {
    let alamat = $("#alamatKTP").val().trim();

    if (alamat != "") {
      $(".errorAlamatKTP").html("");
    } else {
      $(".errorAlamatKTP").html("<p>Alamat wajib diisi</p>");
    }
  });
  $("#noTelp").keyup(function (e) {
    let notelp = $("#noTelp").val().trim();

    if (notelp == "") {
      $(".errornoTelp").html("");
    }
  });
  $("#addEmailKantor").keyup(function (e) {
    let EmailKantor = $("#addEmailKantor").val().trim();

    if (EmailKantor == "") {
      $(".erroraddEmail").html("");
    } else {
      if (!validateEmail(EmailKantor)) {
        $(".erroraddEmail").html("<p>Format email salah</p>");
      } else {
        $(".erroraddEmail").html("");
      }
    }
  });
  $("#email").keyup(function (e) {
    let email = $("#email").val().trim();

    if (email == "") {
      $(".erroremail").html("");
    } else {
      if (!validateEmail(email)) {
        $(".erroremail").html("<p>Format email salah</p>");
      } else {
        $(".erroremail").html("");
      }
    }
  });

  function cekfilefoto() {
    let filePasFoto = $("#filePasFoto").val();
    const fl_foto = $("#filePasFoto").prop("files")[0];

    let formData = new FormData();
    formData.append("filePasFoto", filePasFoto);
    formData.append("fl_foto", fl_foto);

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/cekfoto",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        return false;
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          return true;
        } else {
          return false;
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        swal("Error", "Error saat cek foto, hubungi administrator", "error");
        return false;
      },
    });
  }

  function lanjutpersonal() {
    $(".btnlanjutpersonal").append(
      '<a id="addSimpanPersonal" data-scroll href="#clKaryawan" class="btn btn-primary font-weight-bold ml-1">Lanjutkan</a>'
    );
    $("#addSimpanPersonal").click(function () {
      //   $.LoadingOverlay("show");
      let auth_per = $("#addPerKary").val();
      let noktp_old = $(".9d56835ae6e4d20993874daf592f6aca").text();
      let nokk_old = $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text();
      let no_nik_old = $(".c1492f38214db699dfd3574b2644271d").text();
      let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
      let auth_check = $(".h2344234jfsd").text();
      let noktp = $("#noKTP").val();
      let nama = $("#namaLengkap").val();
      let alamat = $("#alamatKTP").val();
      let rt = $("#rtKTP").val();
      let rw = $("#rwKTP").val();
      let id_prov = $("#provData").val();
      let id_kab = $("#kotaData").val();
      let id_kec = $("#kecData").val();
      let id_kel = $("#kelData").val();
      let tmp_lahir = $("#tempatLahir").val();
      let tgl_lahir = $("#tanggalLahir").val();
      let stat_nikah = $("#statPernikahan").val();
      let id_agama = $("#addagama").val();
      let warga = $("#kewarganegaraan").val();
      let jk = $("#jenisKelamin").val();
      let bpjs_tk = $("#noBPJSTK").val();
      let bpjs_kes = $("#noBPJSKES").val();
      let nokk = $("#noKK").val();
      let npwp = $("#noNPWP").val();
      let email = $("#email").val();
      let notelp = $("#noTelp").val();
      let pddakhir = $("#pendidikanTerakhir").val();
      let cek_log = md5(new Date().toLocaleString());

      // cekfilefoto();

      //   let cekfoto = cekfilefoto();

      //   if (cekfoto) {
      //   } else {
      //   }

      $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "karyawan/addpersonal",
        data: {
          noktp_old: noktp_old,
          nokk_old: nokk_old,
          no_nik_old: no_nik_old,
          noktp: noktp,
          nama: nama,
          alamat: alamat,
          rt: rt,
          rw: rw,
          id_prov: id_prov,
          id_kab: id_kab,
          id_kec: id_kec,
          id_kel: id_kel,
          tmp_lahir: tmp_lahir,
          tgl_lahir: tgl_lahir,
          email: email,
          notelp: notelp,
          stat_nikah: stat_nikah,
          id_agama: id_agama,
          warga: warga,
          jk: jk,
          bpjs_tk: bpjs_tk,
          bpjs_kes: bpjs_kes,
          npwp: npwp,
          nokk: nokk,
          auth_per: auth_per,
          auth_person: auth_person,
          auth_check: auth_check,
          pddakhir: pddakhir,
          token: token,
        },
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#colKaryawan").collapse("show");
            $("#colPersonal").collapse("hide");
            $("#imgPersonal").removeClass("d-none");
            $(".noktpshow").val(noktp);
            $(".namalengkapshow").val(nama);
            $(".89kjm78ujki782m4x787909h3").text(cek_log);
            $.LoadingOverlay("hide");
            aktifKaryawan();
          } else if (data.statusCode == 201) {
            $.LoadingOverlay("hide");
            swal("Error", data.pesan, "error");
          } else {
            $(".errorNoKTP").html(data.noktp);
            $(".errorNamaLengkap").html(data.nama);
            $(".errorAlamatKTP").html(data.alamat);
            $(".errorRtKTP").html(data.rt);
            $(".errorRwKTP").html(data.rw);
            $(".errorProvData").html(data.id_prov);
            $(".errorKotaData").html(data.id_kab);
            $(".errorKecData").html(data.id_kec);
            $(".errorKelData").html(data.id_kel);
            $(".errorTempatLahir").html(data.tmp_lahir);
            $(".errorTanggalLahir").html(data.tgl_lahir);
            $(".errorStatPernikahan").html(data.stat_nikah);
            $(".errorAddAgama").html(data.id_agama);
            $(".erroremail").html(data.email);
            $(".errornoTelp").html(data.notelp);
            $(".errorKewarganegaraan").html(data.warga);
            $(".errorJenisKelamin").html(data.jk);
            $(".errorNoBPJSTK").html(data.bpjs_tk);
            $(".errorNoBPJSKES").html(data.bpjs_kes);
            $(".errorNoNPWP").html(data.npwp);
            $(".errorNoKK").html(data.nokk);
            $(".errorPendidikanAkhir").html(data.pddakhir);
            swal("Error", data.pesan, "error");
            window.scrollTo(0, 0);
            $.LoadingOverlay("hide");
          }
          $.LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsg").removeClass("d-none");
          $(".errormsg").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsg").html(
              "Terjadi kesalahan saat menyimpan data, hubungi administrator"
            );
          }
        },
      });

      $(".errormsg")
        .fadeTo(3000, 500)
        .slideUp(500, function () {
          $(".errormsg").slideUp(500);
          $(".errormsg").addClass("d-none");
        });
    });
  }

  $("#noKTP").focusout(function () {
    let noktp = $("#noKTP").val();
    let validktp = $(".9d56835ae6e4d20993874daf592f6aca d-none").val();
    let errktp = $(".errorNoKTP").text();

    if (errktp != "") {
      swal("Error", errktp, "error");
      return false;
    }

    if (validktp !== noktp) {
      $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "karyawan/cek_ktp",
        data: {
          noktp: noktp,
          token: token,
        },
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $.LoadingOverlay("hide");
            if ($("#addSimpanPersonal").length == 0) {
              lanjutpersonal();
            }
          } else {
            $.LoadingOverlay("hide");
            swal(data.kode_pesan, data.pesan, data.tipe_pesan);
            $(".errorNoKTP").text(data.pesan);
            $("#addSimpanPersonal").remove();
            $("#addSimpanPekerjaan").remove();
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");

          if (thrownError != "") {
            pesan =
              "Terjadi kesalahan saat load data personal, hubungi administrator";
          } else {
            pesan = "";
          }

          swal("Error", pesan, "error");
        },
      });
    }
  });

  $("#addKembaliPekerjaan").click(function () {
    $("#colKaryawan").collapse("hide");
    $("#colPersonal").collapse("show");
  });

  $("#addSimpanPekerjaan").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
    let auth_alamat = $(".150b3427b97bb43ac2fb3e5c687e384c").text();
    let auth_ktr = $(".asdas9asd").text();
    let no_nik_old = $(".c1492f38214db699dfd3574b2644271d").text();
    let noktp_old = $(".9d56835ae6e4d20993874daf592f6aca").text();
    let nokk_old = $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text();
    let noktp = $("#noKTP").val();
    let nama = $("#namaLengkap").val();
    let alamat = $("#alamatKTP").val();
    let rt = $("#rtKTP").val();
    let rw = $("#rwKTP").val();
    let id_prov = $("#provData").val();
    let id_kab = $("#kotaData").val();
    let id_kec = $("#kecData").val();
    let id_kel = $("#kelData").val();
    let tmp_lahir = $("#tempatLahir").val();
    let tgl_lahir = $("#tanggalLahir").val();
    let stat_nikah = $("#statPernikahan").val();
    let id_agama = $("#addagama").val();
    let warga = $("#kewarganegaraan").val();
    let jk = $("#jenisKelamin").val();
    let email = $("#email").val();
    let telp = $("#noTelp").val();
    let bpjs_tk = $("#noBPJSTK").val();
    let bpjs_kes = $("#noBPJSKES").val();
    let npwp = $("#noNPWP").val();
    let nokk = $("#noKK").val();
    let namaibu = $("#namaIbu").val();
    let id_pendidikan = $("#pendidikanTerakhir").val();
    let no_nik = $("#addNIKKary").val();
    let depart = $("#addDepartKary").val();
    let posisi = $("#addPosisiKary").val();
    let doh = $("#addDOH").val();
    let tgl_aktif = $("#addTanggalAktif").val();
    let id_lokker = $("#addLokasiKerja").val();
    let id_lokterima = $("#addLokterimaKary").val();
    let id_poh = $("#addPOHKary").val();
    let id_klasifikasi = $("#addKlasifikasiKary").val();
    let id_tipe = $("#addTipeKaryawan").val();
    let id_level = $("#addLevelKary").val();
    let stat_tinggal = $("#addStatusResidence").val();
    let stat_kerja = $("#addStatusKaryawan").val();
    let email_kantor = $("#addEmailKantor").val();
    let tgl_permanen = $("#addTanggalPermanen").val();
    let tgl_mulai_kontrak = $("#addTanggalKontrakAwal").val();
    let tgl_akhir_kontrak = $("#addTanggalKontrakAkhir").val();
    let id_m_perusahaan = $("#addPerKary").val();
    let auth_check = $(".89kjm78ujki782m4x787909h3").text();
    let auth_ver = $(".h2344234jfsd").text();

    if (auth_person != "") {
      $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: site_url + "karyawan/addkaryawan",
        data: {
          auth_ver: auth_ver,
          auth_person: auth_person,
          auth_kary: auth_kary,
          auth_alamat: auth_alamat,
          auth_ktr: auth_ktr,
          no_nik_old: no_nik_old,
          noktp_old: noktp_old,
          nokk_old: nokk_old,
          noktp: noktp,
          nama: nama,
          alamat: alamat,
          rt: rt,
          rw: rw,
          id_prov: id_prov,
          id_kab: id_kab,
          id_kec: id_kec,
          id_kel: id_kel,
          tmp_lahir: tmp_lahir,
          tgl_lahir: tgl_lahir,
          stat_nikah: stat_nikah,
          id_agama: id_agama,
          warga: warga,
          jk: jk,
          email: email,
          telp: telp,
          bpjs_tk: bpjs_tk,
          bpjs_kes: bpjs_kes,
          npwp: npwp,
          nokk: nokk,
          namaibu: namaibu,
          id_pendidikan: id_pendidikan,
          auth_kary: auth_kary,
          no_nik: no_nik,
          depart: depart,
          posisi: posisi,
          doh: doh,
          tgl_aktif: tgl_aktif,
          id_lokker: id_lokker,
          id_lokterima: id_lokterima,
          id_poh: id_poh,
          id_klasifikasi: id_klasifikasi,
          id_tipe: id_tipe,
          id_level: id_level,
          stat_tinggal: stat_tinggal,
          stat_kerja: stat_kerja,
          email_kantor: email_kantor,
          tgl_permanen: tgl_permanen,
          tgl_mulai_kontrak: tgl_mulai_kontrak,
          tgl_akhir_kontrak: tgl_akhir_kontrak,
          id_m_perusahaan: id_m_perusahaan,
          auth_check: auth_check,
          token: token,
        },
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $.LoadingOverlay("hide");
            if (auth_ver === "") {
              $(".0c09efa8ccb5e0114e97df31736ce2e3").text(data.auth_person);
              $(".150b3427b97bb43ac2fb3e5c687e384c").text(data.auth_alamat);
              $(".9d56835ae6e4d20993874daf592f6aca").text(data.no_ktp);
              $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text(data.no_kk);
            }
            $(".a6b73b5c154d3540919ddf46edf3b84e").text(data.auth_kary);
            $(".c1492f38214db699dfd3574b2644271d").text(data.nik);
            $(".asdas9asd").text(data.auth_kontrak);
            $("#colPersonal").collapse("hide");
            $("#colKaryawan").collapse("hide");
            $("#colIzinTambang").collapse("show");
            $("#idizintambang").load(
              site_url + "izin_tambang/izin_tambang?auth_izin=0"
            );
            $("#imgKaryawan").removeClass("d-none");
            $("#noktpshow").val(noktp);
            $("#namalengkapshow").val(nama);
            $("#filesimpolisi").removeAttr("disabled");
            $("#simpermp").removeAttr("disabled");
            aktifSIMPER();
            swal("Berhasil", data.pesan, "success");
            $.LoadingOverlay("hide");
          } else if (data.statusCode == 201) {
            $(".errmsgKary").removeClass("d-none");
            $(".errmsgKary").removeClass("alert-primary");
            $(".errmsgKary").addClass("alert-danger");
            $(".errmsgKary").html(data.pesan);
            $.LoadingOverlay("hide");
          } else {
            $(".erroraddNIKKary").html(data.no_nik);
            $(".errorAddDepartKary").html(data.depart);
            $(".errorAddPosisiKary").html(data.posisi);
            $(".errorAddKlasifikasiKary").html(data.id_klasifikasi);
            $(".erroraddPOHKary").html(data.id_poh);
            $(".erroraddLokterimaKary").html(data.id_lokterima);
            $(".erroraddLokasiKerja").html(data.id_lokker);
            $(".erroraddLevelKary").html(data.id_level);
            $(".erroraddStatusResidence").html(data.stat_tinggal);
            $(".erroraddDOH").html(data.doh);
            $(".erroraddTanggalAktif").html(data.tgl_aktif);
            $(".erroraddTipeKaryawan").html(data.id_tipe);
            $(".erroraddJenisKaryawan").html(data.stat_kerja);
            $(".erroraddEmail").html(data.email_kantor);
            $(".erroraddTanggalPermanen").html(data.pesan);
            $(".erroraddTanggalKontrakAwal").html(data.pesan1);
            $(".erroraddTanggalKontrakAkhir").html(data.pesan2);
            swal("Error", data.pesan3, "error");
            $.LoadingOverlay("hide");
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errmsgKary").removeClass("d-none");
          $(".errmsgKary").addClass("alert-danger");
          if (thrownError != "") {
            $(".errmsgKary").html(
              "Terjadi kesalahan saat menyimpan data karyawan, hubungi administrator"
            );
          }
        },
      });
      $.LoadingOverlay("hide");
    } else {
      swal({
        title: "Simpan Data",
        text:
          "Yakin data karyawan No. KTP : " +
          noktp +
          ", Nama : " +
          nama +
          ", akan disimpan?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, simpan",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "karyawan/addkaryawan",
            data: {
              auth_person: auth_person,
              auth_kary: auth_kary,
              auth_alamat: auth_alamat,
              auth_ktr: auth_ktr,
              no_nik_old: no_nik_old,
              noktp_old: noktp_old,
              nokk_old: nokk_old,
              noktp: noktp,
              nama: nama,
              alamat: alamat,
              rt: rt,
              rw: rw,
              id_prov: id_prov,
              id_kab: id_kab,
              id_kec: id_kec,
              id_kel: id_kel,
              tmp_lahir: tmp_lahir,
              tgl_lahir: tgl_lahir,
              stat_nikah: stat_nikah,
              id_agama: id_agama,
              warga: warga,
              jk: jk,
              email: email,
              telp: telp,
              bpjs_tk: bpjs_tk,
              bpjs_kes: bpjs_kes,
              npwp: npwp,
              nokk: nokk,
              namaibu: namaibu,
              id_pendidikan: id_pendidikan,
              auth_kary: auth_kary,
              no_nik: no_nik,
              depart: depart,
              posisi: posisi,
              doh: doh,
              tgl_aktif: tgl_aktif,
              id_lokker: id_lokker,
              id_lokterima: id_lokterima,
              id_poh: id_poh,
              id_klasifikasi: id_klasifikasi,
              id_tipe: id_tipe,
              id_level: id_level,
              stat_tinggal: stat_tinggal,
              stat_kerja: stat_kerja,
              email_kantor: email_kantor,
              tgl_permanen: tgl_permanen,
              tgl_mulai_kontrak: tgl_mulai_kontrak,
              tgl_akhir_kontrak: tgl_akhir_kontrak,
              id_m_perusahaan: id_m_perusahaan,
              auth_check: auth_check,
              token: token,
            },
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                $(".0c09efa8ccb5e0114e97df31736ce2e3").text(data.auth_person);
                $(".a6b73b5c154d3540919ddf46edf3b84e").text(data.auth_kary);
                $(".150b3427b97bb43ac2fb3e5c687e384c").text(data.auth_alamat);
                $(".9d56835ae6e4d20993874daf592f6aca").text(data.no_ktp);
                $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text(data.no_kk);
                $(".c1492f38214db699dfd3574b2644271d").text(data.nik);
                $(".asdas9asd").text(data.auth_kontrak);
                $("#colPersonal").collapse("hide");
                $("#colKaryawan").collapse("hide");
                $("#colIzinTambang").collapse("show");
                $("#idizintambang").load(
                  site_url + "izin_tambang/izin_tambang?auth_izin=0"
                );
                $("#imgKaryawan").removeClass("d-none");
                $("#noktpshow").val(noktp);
                $("#namalengkapshow").val(nama);
                aktifSIMPER();
                $("#filesimpolisi").removeAttr("disabled");
                swal("Berhasil", data.pesan, "success");
                $.LoadingOverlay("hide");
              } else if (data.statusCode == 201) {
                $(".errmsgKary").removeClass("d-none");
                $(".errmsgKary").removeClass("alert-primary");
                $(".errmsgKary").addClass("alert-danger");
                $(".errmsgKary").html(data.pesan);
                $.LoadingOverlay("hide");
              } else {
                $(".erroraddNIKKary").html(data.no_nik);
                $(".errorAddDepartKary").html(data.depart);
                $(".errorAddPosisiKary").html(data.posisi);
                $(".errorAddKlasifikasiKary").html(data.id_klasifikasi);
                $(".erroraddPOHKary").html(data.id_poh);
                $(".erroraddLokterimaKary").html(data.id_lokterima);
                $(".erroraddLokasiKerja").html(data.id_lokker);
                $(".erroraddLevelKary").html(data.id_level);
                $(".erroraddStatusResidence").html(data.stat_tinggal);
                $(".erroraddDOH").html(data.doh);
                $(".erroraddTanggalAktif").html(data.tgl_aktif);
                $(".erroraddTipeKaryawan").html(data.id_tipe);
                $(".erroraddJenisKaryawan").html(data.stat_kerja);
                $(".erroraddEmail").html(data.email_kantor);
                $(".erroraddTanggalPermanen").html(data.pesan);
                $(".erroraddTanggalKontrakAwal").html(data.pesan1);
                $(".erroraddTanggalKontrakAkhir").html(data.pesan2);
                swal("Error", data.pesan3, "error");
                $.LoadingOverlay("hide");
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              $(".errmsgKary").removeClass("d-none");
              $(".errmsgKary").addClass("alert-danger");
              if (thrownError != "") {
                $(".errmsgKary").html(
                  "Terjadi kesalahan saat menyimpan data karyawan, hubungi administrator"
                );
              }
            },
          });
          $.LoadingOverlay("hide");
        } else {
          $.LoadingOverlay("hide");
          swal.close();
        }
      });
    }

    $(".errormsg")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsg").slideUp(500);
        $(".errormsg").addClass("d-none");
      });
  });

  $("#addJenisIzin").change(function () {
    let jenisizin = $("#addJenisIzin").val();
    let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();

    if (auth_izin != "") {
      $.ajax({
        type: "POST",
        url: site_url + "izin_tambang/cek_jenisizin",
        data: {
          auth_izin: auth_izin,
          jenisizin: jenisizin,
          token: token,
        },
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            swal({
              title: "Ganti Jenis Izin",
              text: data.pesan,
              type: "question",
              showCancelButton: true,
              confirmButtonColor: "#36c6d3",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ya, ganti",
              cancelButtonText: "Batalkan",
            }).then(function (result) {
              if (result.value) {
                if (data.auth_izn == 1) {
                  $.ajax({
                    type: "POST",
                    async: "false",
                    url: site_url + "izin_tambang/hapus_unit_all",
                    data: {
                      auth_izin: auth_izin,
                      token: token,
                    },
                    success: function (rsdata) {
                      var rsdata = JSON.parse(rsdata);
                      $("#txtsim").addClass("d-none");
                      $("#txtunit").addClass("d-none");
                      $("#addTglExpSIM").val("");
                      $(".simperunit").collapse("hide");
                      $("#addJenisSIM").val("").trigger("change");
                      $("#idizintambang").LoadingOverlay("show");
                      $("#idizintambang").load(
                        site_url + "izin_tambang/izin_tambang?auth_izin=0"
                      );
                      $(".ecb14fe704e08d9df8e343030bbbafcb").text("");
                      $("#addNoReg").val("");
                      $("#addTglExp").val("");
                      $("#addTglExpSIM").val("");
                      $("#nmfilesimpol").val("");
                      $("#nmfilesimpolsv").val("");
                      $("#nmfilesimper").val("");
                      $("#nmfilesimpersv").val("");
                      $("#lblsimpolisi").text(rsdata.filesim);
                      $("#lblsimpermp").text(rsdata.filesmp);
                      $("#nmfilesimpersv").val("");
                      $("#btnshowsimpol").attr("href", "#!");
                      $("#btnshowsimpol").attr("disabled", true);
                      $("#btnshowsimper").attr("href", "#!");
                      $("#btnshowsimper").attr("disabled", true);
                      $(".j8234234b").text("");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsgizin").removeClass("d-none");
                      $(".errormsgizin").removeClass("alert-info");
                      $(".errormsgizin").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsgizin").html(
                          "Terjadi kesalahan saat load data jenis SIMPER, hubungi administrator"
                        );
                      }
                    },
                  });
                } else {
                  $.ajax({
                    type: "POST",
                    async: "false",
                    url: site_url + "izin_tambang/hapus_izin_all",
                    data: {
                      auth_izin: auth_izin,
                      token: token,
                    },
                    success: function (rsdata) {
                      var rsdata = JSON.parse(rsdata);
                      $("#txtsim").addClass("d-none");
                      $("#txtunit").addClass("d-none");
                      $("#addTglExpSIM").val("");
                      $(".simperunit").collapse("hide");
                      $("#addJenisSIM").val("").trigger("change");
                      $("#idizintambang").LoadingOverlay("show");
                      $("#idizintambang").load(
                        site_url + "izin_tambang/izin_tambang?auth_izin=0"
                      );
                      $(".ecb14fe704e08d9df8e343030bbbafcb").text("");
                      $("#addNoReg").val("");
                      $("#addTglExp").val("");
                      $("#addTglExpSIM").val("");
                      $("#nmfilesimpol").val("");
                      $("#nmfilesimpolsv").val("");
                      $("#nmfilesimper").val("");
                      $("#nmfilesimpersv").val("");
                      $("#lblsimpolisi").text(rsdata.filesim);
                      $("#lblsimpermp").text(rsdata.filesmp);
                      $("#nmfilesimpersv").val("");
                      $("#btnshowsimpol").attr("href", "#!");
                      $("#btnshowsimpol").attr("disabled", true);
                      $("#btnshowsimper").attr("href", "#!");
                      $("#btnshowsimper").attr("disabled", true);
                      $(".j8234234b").text("");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsgizin").removeClass("d-none");
                      $(".errormsgizin").removeClass("alert-info");
                      $(".errormsgizin").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsgizin").html(
                          "Terjadi kesalahan saat load data jenis SIMPER, hubungi administrator"
                        );
                      }
                    },
                  });
                }
              } else if (result.dismiss == "cancel") {
                swal("Batal", "Jenis izin batal diganti", "info");
                $("#addJenisIzin").val(rsdata.jns).trigger("change");
              }
            });
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsgizin").removeClass("d-none");
          $(".errormsgizin").removeClass("alert-info");
          $(".errormsgizin").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsgizin").html(
              "Terjadi kesalahan saat load data SIM, hubungi administrator"
            );
          }
        },
      });
    }

    if (jenisizin == 2) {
      $("#txtsim").removeClass("d-none");
      $("#txtunit").removeClass("d-none");
      $(".simperunit").collapse("show");
    } else {
      $("#txtsim").addClass("d-none");
      $("#txtunit").addClass("d-none");
      $(".simperunit").collapse("hide");
    }
  });

  $("#addJenisIzinnew").change(function () {
    let jenisizin = $("#addJenisIzinnew").val();
    let auth_izin = $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text();

    if (auth_izin != "") {
      $.ajax({
        type: "POST",
        url: site_url + "izin_tambang/cek_jenisizin",
        data: {
          auth_izin: auth_izin,
          jenisizin: jenisizin,
          token: token,
        },
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            swal({
              title: "Ganti Jenis Izin",
              text: data.pesan,
              type: "question",
              showCancelButton: true,
              confirmButtonColor: "#36c6d3",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ya, ganti",
              cancelButtonText: "Batalkan",
            }).then(function (result) {
              if (result.value) {
                if (data.auth_izn == 1) {
                  $.ajax({
                    type: "POST",
                    async: "false",
                    url: site_url + "izin_tambang/hapus_unit_all",
                    data: {
                      auth_izin: auth_izin,
                      token: token,
                    },
                    success: function (rsdata) {
                      var rsdata = JSON.parse(rsdata);
                      $("#txtsimnew").addClass("d-none");
                      $("#txtunitnew").addClass("d-none");
                      $("#addTglExpSIMnew").val("");
                      $(".simperunitnew").collapse("hide");
                      $("#addJenisSIMnew").val("").trigger("change");
                      $("#idizintambangnew").LoadingOverlay("show");
                      $("#idizintambangnew").load(
                        site_url + "izin_tambang/izin_tambang?auth_izin=0"
                      );
                      $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text("");
                      $(".ecb14fe704e08d95j32k4jn98sdfvj3o45").text("");
                      $("#addNoRegnew").val("");
                      $("#addTglExpnew").val("");
                      $("#addTglExpSIMnew").val("");
                      $("#nmfilesimpolnew").val("");
                      $("#nmfilesimpolsvnew").val("");
                      $("#nmfilesimpernew").val("");
                      $("#nmfilesimpersvnew").val("");
                      $("#lblsimpolisinew").text(rsdata.filesim);
                      $("#lblsimpermpnew").text(rsdata.filesmp);
                      $("#nmfilesimpersvnew").val("");
                      $("#btnshowsimpolnew").attr("href", "#!");
                      $("#btnshowsimpolnew").attr("disabled", true);
                      $("#btnshowsimpernew").attr("href", "#!");
                      $("#btnshowsimpernew").attr("disabled", true);
                      $(".n234b5b7").text("");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsgizinnew").removeClass("d-none");
                      $(".errormsgizinnew").removeClass("alert-info");
                      $(".errormsgizinnew").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsgizinnew").html(
                          "Terjadi kesalahan saat load data jenis SIMPER, hubungi administrator"
                        );
                      }
                    },
                  });
                } else {
                  $.ajax({
                    type: "POST",
                    async: "false",
                    url: site_url + "izin_tambang/hapus_izin_all",
                    data: {
                      auth_izin: auth_izin,
                      token: token,
                    },
                    success: function (rsdata) {
                      var rsdata = JSON.parse(rsdata);
                      $("#txtsimnew").addClass("d-none");
                      $("#txtunitnew").addClass("d-none");
                      $("#addTglExpSIMnew").val("");
                      $(".simperunitnew").collapse("hide");
                      $("#addJenisSIMnew").val("").trigger("change");
                      $("#idizintambangnew").LoadingOverlay("show");
                      $("#idizintambangnew").load(
                        site_url + "izin_tambang/izin_tambang?auth_izin=0"
                      );
                      $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text("");
                      $(".ecb14fe704e08d95j32k4jn98sdfvj3o45").text("");
                      $("#addNoRegnew").val("");
                      $("#addTglExpnew").val("");
                      $("#addTglExpSIMnew").val("");
                      $("#nmfilesimpolnew").val("");
                      $("#nmfilesimpolsvnew").val("");
                      $("#nmfilesimpernew").val("");
                      $("#nmfilesimpersvnew").val("");
                      $("#lblsimpolisinew").text(rsdata.filesim);
                      $("#lblsimpermpnew").text(rsdata.filesmp);
                      $("#nmfilesimpersvnew").val("");
                      $("#btnshowsimpolnew").attr("href", "#!");
                      $("#btnshowsimpolnew").attr("disabled", true);
                      $("#btnshowsimpernew").attr("href", "#!");
                      $("#btnshowsimpernew").attr("disabled", true);
                      $(".n234b5b7").text("");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      $.LoadingOverlay("hide");
                      $(".errormsgizinnew").removeClass("d-none");
                      $(".errormsgizinnew").removeClass("alert-info");
                      $(".errormsgizinnew").addClass("alert-danger");
                      if (thrownError != "") {
                        $(".errormsgizinnew").html(
                          "Terjadi kesalahan saat load data jenis SIMPER, hubungi administrator"
                        );
                      }
                    },
                  });
                }
              } else if (result.dismiss == "cancel") {
                swal("Batal", "Jenis izin batal diganti", "info");
                $("#addJenisIzinnew").val(rsdata.jns).trigger("change");
              }
            });
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $.LoadingOverlay("hide");
          $(".errormsgizinnew").removeClass("d-none");
          $(".errormsgizinnew").removeClass("alert-info");
          $(".errormsgizinnew").addClass("alert-danger");
          if (thrownError != "") {
            $(".errormsgizinnew").html(
              "Terjadi kesalahan saat load data SIM, hubungi administrator"
            );
          }
        },
      });
    }

    if (jenisizin == 2) {
      $("#txtsimnew").removeClass("d-none");
      $("#txtunitnew").removeClass("d-none");
      $(".simperunitnew").collapse("show");
    } else {
      $("#txtsimnew").addClass("d-none");
      $("#txtunitnew").addClass("d-none");
      $(".simperunitnew").collapse("hide");
    }
  });

  $("#addTglExpSIM").change(function () {
    let tglsim = $("#addTglExpSIM").val();

    $.ajax({
      type: "POST",
      url: site_url + "izin_tambang/tgl_exp_izin",
      data: {
        tglsim: tglsim,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#addTglExp").val(data.tglexpizin);
          $("#addTglExp").removeAttr("disabled");
          $(".errormsgizin").addClass("d-none");
        } else {
          $(".errormsgizin").removeClass("d-none");
          $(".errormsgizin").removeClass("alert-info");
          $(".errormsgizin").addClass("alert-danger");
          $(".errormsgizin").html(data.pesan);
          $("#addTglExp").val("");
          $("#addTglExp").attr("disabled", true);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgizin").removeClass("d-none");
        $(".errormsgizin").removeClass("alert-info");
        $(".errormsgizin").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgizin").html(
            "Terjadi kesalahan saat membuat tanggal izin"
          );
        }
      },
    });
  });

  $("#addTglExpSIMnew").change(function () {
    let tglsim = $("#addTglExpSIMnew").val();

    $.ajax({
      type: "POST",
      url: site_url + "izin_tambang/tgl_exp_izin",
      data: {
        tglsim: tglsim,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#addTglExpnew").val(data.tglexpizin);
          $("#addTglExpnew").removeAttr("disabled");
          $(".errormsgizinnew").addClass("d-none");
        } else {
          $(".errormsgizinnew").removeClass("d-none");
          $(".errormsgizinnew").removeClass("alert-info");
          $(".errormsgizinnew").addClass("alert-danger");
          $(".errormsgizinnew").html(data.pesan);
          $("#addTglExpnew").val("");
          $("#addTglExpnew").attr("disabled", true);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgizinnew").removeClass("d-none");
        $(".errormsgizinnew").removeClass("alert-info");
        $(".errormsgizinnew").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgizinnew").html(
            "Terjadi kesalahan saat membuat tanggal expired izin"
          );
        }
      },
    });

    $(".errormsgizinnew")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgizinnew").slideUp(500);
        $(".errormsgizinnew").addClass("d-none");
      });
  });

  $("#addSimpanIzinUnit").click(function () {
    // $.LoadingOverlay("show");
    let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
    let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();
    let auth_simpol = $(".j8234234b").text();
    let jenisizin = $("#addJenisIzin").val();
    let noreg = $("#addNoReg").val();
    let tglexp = $("#addTglExp").val();
    let jenissim = $("#addJenisSIM").val();
    let tglexpsim = $("#addTglExpSIM").val();
    let filesmp = $("#simpermp").val();
    const flsmp = $("#simpermp").prop("files")[0];
    let filesim = $("#filesimpolisi").val();
    const flsim = $("#filesimpolisi").prop("files")[0];
    let nmsimper = $("#nmfilesimper").val();
    let nmsimpol = $("#nmfilesimpol").val();
    let filesimnm = $("#nmfilesimpol").val();
    let filesimsv = $("#nmfilesimpolsv").val();
    let filesmpnm = $("#nmfilesimper").val();
    let filesmpsv = $("#nmfilesimpersv").val();

    // append form data
    let formData = new FormData();
    formData.append("filesmpkary", flsmp);
    formData.append("filesmp", filesmp);
    formData.append("filesimkary", flsim);
    formData.append("filesim", filesim);
    formData.append("jenisizin", jenisizin);
    formData.append("noreg", noreg);
    formData.append("tglexpsim", tglexpsim);
    formData.append("tglexp", tglexp);
    formData.append("jenissim", jenissim);
    formData.append("auth_izin", auth_izin);
    formData.append("auth_kary", auth_kary);
    formData.append("auth_simpol", auth_simpol);
    formData.append("token", token);
    formData.append("nmsimper", nmsimper);
    formData.append("nmsimpol", nmsimpol);
    formData.append("filesimnm", filesimnm);
    formData.append("filesimsv", filesimsv);
    formData.append("filesmpnm", filesmpnm);
    formData.append("filesmpsv", filesmpsv);

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/addsimper",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          if (auth_izin == "") {
            $(".ecb14fe704e08d9df8e343030bbbafcb").text(data.auth_izin);
          }
          aktifSertifikat();
          $("#colPersonal").collapse("hide");
          $("#colKaryawan").collapse("hide");
          $("#colIzinTambang").collapse("hide");
          $("#colSertifikasi").collapse("show");
          $("#imgIzinTambang").removeClass("d-none");
          $("#nmfilesimper").val(data.filesmp);
          $("#nmfilesimpersv").val(data.filesmpsv);
          $("#btnshowsimper").attr("href", data.linkizin);
          $(".erroraddJenisIzin").html("");
          $(".erroraddNoReg").html("");
          $(".erroraddJenisSIM").html("");
          $(".erroraddTglExpSIM").html("");
          $(".errorFilesimpolisi").html("");
          $(".erroraddTglExp").html("");
          $(".errorsimpermp").html("");
          $(".errorFilesimpolisi").html("");
          $.LoadingOverlay("hide");
        } else if (data.statusCode == 201) {
          $(".errormsgizin").removeClass("d-none");
          $(".errormsgizin").removeClass("alert-primary");
          $(".errormsgizin").addClass("alert-danger");
          $(".errormsgizin").html(data.pesan);
          $.LoadingOverlay("hide");
        } else {
          $(".erroraddJenisIzin").html(data.jenisizin);
          $(".erroraddNoReg").html(data.noreg);
          $(".erroraddTglExp").html(data.tglexp);
          $(".erroraddJenisSIM").html(data.jenissim);
          $(".erroraddTglExpSIM").html(data.tglexpsim);
          $(".errorsimpermp").html(data.filesmp);
          $(".errorFilesimpolisi").html(data.filesmp);
          $.LoadingOverlay("hide");
          swal(
            "Error",
            "Tidak dapat melanjutkan, lengkapi data SIMPER/Mine Permit.",
            "error"
          );
        }
        $.LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgizin").removeClass("d-none");
        $(".errormsgizin").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgizin").html(
            "Terjadi kesalahan saat menyimpan data SIMPER/Mine Permit, hubungi administrator"
          );
        }
      },
    });
    $.LoadingOverlay("hide");

    $(".errormsgizin")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgizin").slideUp(500);
        $(".errormsgizin").addClass("d-none");
      });
  });

  $("#addSimpanIzinUnitnew").click(function () {
    let auth_kary = $(".ecb14fe704e08d9df8e343030bbb442344").text();
    let auth_izin = $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text();
    let auth_simpol = $(".ecb14fe704e08d95j32k4jn98sdfvj3o45").text();
    let jenisizin = $("#addJenisIzinnew").val();
    let noreg = $("#addNoRegnew").val();
    let tglexp = $("#addTglExpnew").val();
    let jenissim = $("#addJenisSIMnew").val();
    let tglexpsim = $("#addTglExpSIMnew").val();
    let filesmp = $("#simpermpnew").val();
    const flsmp = $("#simpermpnew").prop("files")[0];
    let filesim = $("#filesimpolisinew").val();
    const flsim = $("#filesimpolisinew").prop("files")[0];
    let nmsimper = $("#nmfilesimpernew").val();
    let nmsimpol = $("#nmfilesimpolnew").val();
    let filesimnm = $("#nmfilesimpolnew").val();
    let filesimsv = $("#nmfilesimpolsvnew").val();
    let filesmpnm = $("#nmfilesimpernew").val();
    let filesmpsv = $("#nmfilesimpersvnew").val();

    // append form data
    let formData = new FormData();
    formData.append("filesmpkary", flsmp);
    formData.append("filesmp", filesmp);
    formData.append("filesimkary", flsim);
    formData.append("filesim", filesim);
    formData.append("jenisizin", jenisizin);
    formData.append("noreg", noreg);
    formData.append("tglexpsim", tglexpsim);
    formData.append("tglexp", tglexp);
    formData.append("jenissim", jenissim);
    formData.append("auth_kary", auth_kary);
    formData.append("auth_izin", auth_izin);
    formData.append("auth_simpol", auth_simpol);
    formData.append("token", token);
    formData.append("nmsimper", nmsimper);
    formData.append("nmsimpol", nmsimpol);
    formData.append("filesimnm", filesimnm);
    formData.append("filesimsv", filesimsv);
    formData.append("filesmpnm", filesmpnm);
    formData.append("filesmpsv", filesmpsv);

    $.LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: site_url + "karyawan/addsimpernew",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $(".ecb14fe704e08d9df8e343030bbb442344").text("");
          $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text("");
          $("#btnshowsimpolnew").addClass("disabled");
          $("#btnshowsimpernew").addClass("disabled");
          $("#addJenisIzinnew").val("").trigger("change");
          $("#addNoRegnew").val("");
          $("#addJenisSIMnew").val("");
          $("#addTglExpSIMnew").val("");
          $("#nmfilesimpolnew").val("");
          $("#nmfilesimpolsvnew").val("");
          $("#filesimpolisinew").val("");
          $("#simpermpnew").val("");
          $("#nmfilesimpernew").val("");
          $("#nmfilesimpersvnew").val("");
          $("#addTglExpnew").val("");
          $("#lblsimpermpnew").text("Pilih file SIMPER/MINE PERMIT");
          $("#lblsimpolisinew").text("Pilih file SIM Polisi");
          $(".h52k342").text("");
          $(".erroraddJenisIzinnew").text("");
          $(".erroraddNoRegnew").text("");
          $(".erroraddJenisSIMnew").text("");
          $(".erroraddTglExpSIMnew").text("");
          $(".errorFilesimpolisinew").text("");
          $(".erroraddTglExpnew").text("");
          $(".errorsimpermpnew").text("");
          $(".errorFilesimpolisinew").text("");
          $("#mdlnewSMP").modal("hide");
          swal("Sukses", data.pesan, "info");
          $.LoadingOverlay("hide");
        } else if (data.statusCode == 201) {
          $(".errormsgizinnew").removeClass("d-none");
          $(".errormsgizinnew").removeClass("alert-primary");
          $(".errormsgizinnew").addClass("alert-danger");
          $(".errormsgizinnew").html(data.pesan);
          $.LoadingOverlay("hide");
        } else {
          $(".erroraddJenisIzinnew").html(data.jenisizin);
          $(".erroraddNoRegnew").html(data.noreg);
          $(".erroraddTglExpnew").html(data.tglexp);
          $(".erroraddJenisSIMnew").html(data.jenissim);
          $(".erroraddTglExpSIMnew").html(data.tglexpsim);
          $(".errorsimpermpnew").html(data.filesmp);
          $(".errorFilesimpolisinew").html(data.filesmp);
          $.LoadingOverlay("hide");
          swal(
            "Error",
            "Tidak dapat melanjutkan, lengkapi data SIMPER/MINE PERMIT.",
            "error"
          );
        }
        $.LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgizinnew").removeClass("d-none");
        $(".errormsgizinnew").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgizinnew").html(
            "Terjadi kesalahan saat menyimpan data SIMPER/MINE PERMIT, hubungi administrator"
          );
        }
      },
    });
    $.LoadingOverlay("hide");

    $(".errormsgizinnew")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgizinnew").slideUp(500);
        $(".errormsgizinnew").addClass("d-none");
      });
  });

  $("#krycekNonaktif").click(function () {
    let ckkary = $("#krycekNonaktif");
    let prs = $("#perJenisData").val();

    // $('#tbmKaryawan').LoadingOverlay("show");
    if (prs != "") {
      if (ckkary.is(":checked")) {
        ckc = 1;
      } else {
        ckc = 0;
      }
      $("#tbmKaryawan").DataTable().destroy();
      tbKary(prs, ckc);
      // $('#tbmKaryawan').LoadingOverlay("hide");
    }
  });

  $("#addSimpanSertifikasi").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let jenissrt = $("#jenisSertifikasi").val();
    let nosrt = $("#noSertifikat").val();
    let tglsrt = $("#tanggalSertifikasi").val();
    let tglexp = $("#tanggalSertifikasiAkhir").val();
    let namalembaga = $("#namaLembaga").val();
    let filesrt = $("#fileSertifikasi").val();
    const flsert = $("#fileSertifikasi").prop("files")[0];

    let formData = new FormData();
    formData.append("filesertifikat", flsert);
    formData.append("filesrt", filesrt);
    formData.append("jenissrt", jenissrt);
    formData.append("nosrt", nosrt);
    formData.append("tglsrt", tglsrt);
    formData.append("tglexp", tglexp);
    formData.append("namalembaga", namalembaga);
    formData.append("auth_person", auth_person);
    formData.append("token", token);

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/addsertifikasi",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#jenisSertifikasi").val("").trigger("change");
          $("#noSertifikat").val("");
          $("#tanggalSertifikasi").val("");
          $("#masaBerlakuSertifikat").val("");
          $("#tanggalSertifikasiAkhir").val("");
          $("#fileSertifikasi").val("");
          $("#namaLembaga").val("");
          $(".errorFileSertifikasi").html("");
          $(".errorjenisSertifikasi").html("");
          $(".errorNoSertifikat").html("");
          $(".errorTanggalSertifikasi").html("");
          $(".errorTanggalSertifikasiAkhir").html("");
          $(".errorFileSertifikasi").html("");
          $(".errorNamaLembaga").html("");
          $("#idsertifikat").LoadingOverlay("show");
          $("#idsertifikat").load(
            site_url + "karyawan/sertifikasi?auth_person=" + auth_person
          );
          swal("Berhasil", "Data sertifikasi berhasil disimpan", "success");
        } else if (data.statusCode == 201) {
          $(".errormsgsertifikasi").removeClass("d-none");
          $(".errormsgsertifikasi").removeClass("alert-primary");
          $(".errormsgsertifikasi").addClass("alert-danger");
          $(".errormsgsertifikasi").html(data.pesan);
        } else {
          $(".errorjenisSertifikasi").html(data.jenissrt);
          $(".errorNoSertifikat").html(data.nosrt);
          $(".errorTanggalSertifikasi").html(data.tglsrt);
          $(".errorTanggalSertifikasiAkhir").html(data.tglexp);
          $(".errorFileSertifikasi").html(data.filesrt);
          $(".errorNamaLembaga").html(data.namalembaga);
          swal(
            "Error",
            "Tidak dapat melanjutkan, lengkapi data sertifikasi.",
            "error"
          );
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgsertifikasi").removeClass("d-none");
        $(".errormsgsertifikasi").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgsertifikasi").html(
            "Terjadi kesalahan saat menyimpan data sertifikat, hubungi administrator"
          );
        }
      },
    });

    $(".errormsgsertifikasi")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgsertifikasi").slideUp(500);
        $(".errormsgsertifikasi").addClass("d-none");
      });
  });

  $("#addKembaliIzinUnit").click(function () {
    $("#colKaryawan").collapse("show");
    $("#colIzinTambang").collapse("hide");
  });

  $("#addLanjutSertifikasi").click(function () {
    $.LoadingOverlay("show");
    $("#colPersonal").collapse("hide");
    $("#colKaryawan").collapse("hide");
    $("#colIzinTambang").collapse("hide");
    $("#colSertifikasi").collapse("hide");
    $("#colMCU").collapse("show");
    $("#imgSertifikasi").removeClass("d-none");
    $("#addLanjutMCU").removeClass("disabled");
    aktifMCU();
    $.LoadingOverlay("hide");
  });

  $("#addbtnkembaliSertifikat").click(function () {
    $("#colSertifikasi").collapse("hide");
    $("#colIzinTambang").collapse("show");
  });

  $("#addbtnkembaliMCU").click(function () {
    $("#colMCU").collapse("hide");
    $("#colSertifikasi").collapse("show");
  });

  $("#addUploadMCU").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let auth_mcu = $(".90dea748042796037c02b4cf2b388b03").text();
    let tglmcu = $("#tglMCU").val();
    let hasilmcu = $("#hasilMCU").val();
    let ketmcu = $("#ketMCU").val();
    let fileMCU = $("#fileMCU").val();
    const flMCU = $("#fileMCU").prop("files")[0];

    let formData = new FormData();
    formData.append("filemedik", flMCU);
    formData.append("ketmcu", ketmcu);
    formData.append("hasilmcu", hasilmcu);
    formData.append("tglmcu", tglmcu);
    formData.append("auth_person", auth_person);
    formData.append("auth_mcu", auth_mcu);
    formData.append("token", token);

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/addmcu",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $(".errorTglMCU").html("");
          $(".errorHasilMCU").html("");
          $(".errorKetMCU").html("");
          $(".errorFileMCU").html("");
          $("#imgMCU").removeClass("d-none");
          $("#addbtnkembaliMCU").removeClass("disabled");
          $("#addLanjutMCU").removeClass("disabled");
          $("#addTampilkanMCU").removeClass("disabled");
          $("#addTampilkanMCU").attr("href", data.link);
          $("#addHapusMCU").removeClass("disabled");
          $(".90dea748042796037c02b4cf2b388b03").text(data.auth_mcu);
          swal("Berhasil", data.pesan, "success");
        } else if (data.statusCode == 201) {
          $(".errormsgmcu").removeClass("d-none");
          $(".errormsgmcu").removeClass("alert-primary");
          $(".errormsgmcu").addClass("alert-danger");
          $(".errormsgmcu").html(data.pesan);
        } else {
          $(".errorTglMCU").html(data.tglmcu);
          $(".errorHasilMCU").html(data.hasilmcu);
          $(".errorKetMCU").html(data.ketmcu);

          if (fileMCU == "") {
            $(".errorFileMCU").html("File MCU wajib di-upload");
          } else {
            $(".errorFileMCU").html(data.filmcu);
          }

          swal(
            "Error",
            "Tidak dapat melanjutkan, lengkapi data Medical Check Up (MCU).",
            "error"
          );
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgmcu").removeClass("d-none");
        $(".errormsgmcu").addClass("alert-danger");
        if (thrownError != "") {
          $(".errMCU").html(
            "Terjadi kesalahan saat menyimpan data MCU, hubungi administrator"
          );
        }
      },
    });

    $(".errormsgmcu")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgmcu").slideUp(500);
        $(".errormsgmcu").addClass("d-none");
      });
  });

  $("#addLanjutMCU").click(function () {
    $.LoadingOverlay("show");
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let auth_mcu = $(".90dea748042796037c02b4cf2b388b03").text();

    let formData = new FormData();
    formData.append("auth_person", auth_person);
    formData.append("auth_mcu", auth_mcu);
    formData.append("token", token);

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/cek_mcu",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#colVaksin").collapse("show");
          $("#colMCU").collapse("hide");
          aktifVaksin();
          $.LoadingOverlay("hide");
        } else {
          $(".errormsgmcu").removeClass("d-none");
          $(".errormsgmcu").removeClass("alert-primary");
          $(".errormsgmcu").addClass("alert-danger");
          $(".errormsgmcu").html(data.pesan);
          $.LoadingOverlay("hide");
        }
        $.LoadingOverlay("hide");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgmcu").removeClass("d-none");
        $(".errormsgmcu").addClass("alert-danger");
        if (thrownError != "") {
          $(".errMCU").html(
            "Terjadi kesalahan saat load data MCU, hubungi administrator"
          );
        }
      },
    });
    $.LoadingOverlay("hide");

    $(".errormsgmcu")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgmcu").slideUp(500);
        $(".errormsgmcu").addClass("d-none");
      });
  });

  $("#addHapusMCU").click(function () {
    let auth_mcu = $(".90dea748042796037c02b4cf2b388b03").text();

    if (auth_mcu != "") {
      swal({
        title: "Hapus MCU",
        text: "Yakin data MCU akan dihapus? termasuk file yang telah di-upload",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "karyawan/hapus_mcu",
            data: {
              auth_mcu: auth_mcu,
              token: token,
            },
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                $("#tglMCU").val("");
                $("#hasilMCU").val("");
                $("#ketMCU").val("");
                $("#fileMCU").val("");
                $(".errorTglMCU").text("");
                $(".errorHasilMCU").text("");
                $(".errorKetMCU").text("");
                $(".errorFileMCU").text("");
                $("#addTampilkanMCU").attr("href", "#!");
                $("#imgMCU").addClass("d-none");
                $("#addTampilkanMCU").addClass("disabled");
                $("#addHapusMCU").addClass("disabled");
                $(".90dea748042796037c02b4cf2b388b03").text("");
                $.LoadingOverlay("hide");
                swal("Berhasil", data.pesan, "success");
              } else if (data.statusCode == 201) {
                swal("Error", data.pesan, "error");
                $.LoadingOverlay("hide");
              } else {
                $(".errormsgmcu").removeClass("d-none");
                $(".errormsgmcu").removeClass("alert-primary");
                $(".errormsgmcu").addClass("alert-danger");
                $(".errormsgmcu").html(data.pesan);
                $.LoadingOverlay("hide");
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              $(".errormsgmcu").removeClass("d-none");
              $(".errormsgmcu").addClass("alert-danger");
              if (thrownError != "") {
                $(".errormsgmcu").html(
                  "Terjadi kesalahan saat menghapus data MCU, hubungi administrator"
                );
              }
            },
          });
        } else {
          swal.close();
        }
      });
    } else {
      $(".errormsgmcu").removeClass("d-none");
      $(".errormsgmcu").removeClass("alert-primary");
      $(".errormsgmcu").addClass("alert-danger");
      $(".errormsgmcu").html("Belum ada data MCU yang disimpan");
    }

    $(".errormsgmcu")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgmcu").slideUp(500);
        $(".errormsgmcu").addClass("d-none");
      });
  });

  $("#addbtnkembalivaksin").click(function () {
    $("#colVaksin").collapse("hide");
    $("#colMCU").collapse("show");
  });

  $("#addLanjutkanVaksin").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/cek_vaksin",
      data: {
        auth_person: auth_person,
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#colVaksin").collapse("hide");
          $("#colFilePendukung").collapse("show");
          $("#imgVaksin").removeClass("d-none");
          aktifFilePendukung();
        } else if (data.statusCode == 201) {
          swal(
            "Error",
            "Tidak dapat melanjutkan, lengkapi data vaksin",
            "error"
          );
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgvaksin").removeClass("d-none");
        $(".errormsgvaksin").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgvaksin").html(
            "Terjadi kesalahan saat load data vaksin, hubungi administrator"
          );
        }
      },
    });
  });

  $("#addResetVaksin").click(function () {
    $("#jnsVaksin").LoadingOverlay("show");
    $("#nmVaksin").LoadingOverlay("show");
    $("#tglVaksin").LoadingOverlay("show");
    $("#jenisVaksin").val("").trigger("change");
    $("#namaVaksin").val("").trigger("change");
    $("#tanggalVaksin").val("");
    $("#jnsVaksin").LoadingOverlay("hide");
    $("#nmVaksin").LoadingOverlay("hide");
    $("#tglVaksin").LoadingOverlay("hide");
  });

  $("#addSimpanVaksin").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let jenisvaksin = $("#jenisVaksin").val();
    let namavaksin = $("#namaVaksin").val();
    let tglvaksin = $("#tanggalVaksin").val();

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/addvaksin",
      data: {
        jenisvaksin: jenisvaksin,
        namavaksin: namavaksin,
        tglvaksin: tglvaksin,
        auth_person: auth_person,
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#idvaksin").LoadingOverlay("show");
          $("#idvaksin").load(
            site_url + "karyawan/vaksin?auth_person=" + auth_person
          );
          $("#jenisVaksin").val("").trigger("change");
          $("#namaVaksin").val("").trigger("change");
          $("#tanggalVaksin").val("");
          swal("Berhasil", "Data vaksin berhasil disimpan", "success");
        } else if (data.statusCode == 201) {
          $(".errormsgvaksin").removeClass("d-none");
          $(".errormsgvaksin").removeClass("alert-primary");
          $(".errormsgvaksin").addClass("alert-danger");
          $(".errormsgvaksin").html(data.pesan);
        } else {
          $(".errorJenisVaksin").html(data.jenisvaksin);
          $(".errorNamaVaksin").html(data.namavaksin);
          $(".errorTanggalVaksin").html(data.tglvaksin);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsgvaksin").removeClass("d-none");
        $(".errormsgvaksin").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsgvaksin").html(
            "Terjadi kesalahan saat menyimpan data vaksin, hubungi administrator"
          );
        }
      },
    });

    $(".errormsgvaksin")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errormsgvaksin").slideUp(500);
        $(".errormsgvaksin").addClass("d-none");
      });
  });

  $("#addbtnkembaliFile").click(function () {
    $("#colFilePendukung").collapse("hide");
    $("#colVaksin").collapse("show");
  });

  $("#addUploadFileSelesai").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
    let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();
    let auth_mcu = $(".90dea748042796037c02b4cf2b388b03").text();
    var token = $("#token").val();
    let filefoto = $("#filePasFoto").val();
    const flfoto = $("#filePasFoto").prop("files")[0];
    let filepdukung = $("#filePendukung").val();
    const fldukung = $("#filePendukung").prop("files")[0];
    let extfoto = flfoto.split(".").pop().toLowerCase();

    if (extfoto != "jpg") {
      swal("Error", "Format foto karyawan harus jpg", "error");
    }

    if (filepdukung == "") {
      $errdukung = "File pendukung wajib di-upload";
    } else {
      $errdukung = "";
    }

    if (filefoto == "") {
      $errfoto = "File foto wajib di-upload";
    } else {
      $errfoto = "";
    }

    if ($errdukung == "" && $errfoto == "") {
      swal({
        title: "Simpan Data",
        text: "Yakin data karyawan telah lengkap dan benar?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          let formData = new FormData();
          formData.append("fldukung", fldukung);
          formData.append("filepdukung", filepdukung);
          formData.append("flfoto", flfoto);
          formData.append("filefoto", filefoto);
          formData.append("auth_person", auth_person);
          formData.append("auth_kary", auth_kary);
          formData.append("auth_izin", auth_izin);
          formData.append("auth_mcu", auth_mcu);
          formData.append("token", token);

          $.ajax({
            type: "POST",
            url: site_url + "karyawan/cek_file",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                $.LoadingOverlay("hide");
                swal({
                  title: "Sukses",
                  text: "Data karyawan berhasil disimpan",
                  type: "success",
                  confirmButtonColor: "#36c6d3",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Ok",
                }).then(function (result) {
                  if (result.value) {
                    $.LoadingOverlay("hide");
                    $(".errorFilePendukung").html("");
                    $("#fileUpload").val("");
                    $(".noktpshow").val("");
                    $(".namalengkapshow").val("");
                    window.location.href = site_url + "karyawan/new";
                  } else {
                    $.LoadingOverlay("hide");
                    $(".errorFilePendukung").html("");
                    $("#fileUpload").val("");
                    $(".noktpshow").val("");
                    $(".namalengkapshow").val("");
                    window.location.href = site_url + "karyawan/new";
                  }

                  $.LoadingOverlay("hide");
                });
              } else if (data.statusCode == 202) {
                $.LoadingOverlay("hide");
                $(".errorfilePasFoto").text(data.filefoto);
                $(".errorFilePendukung").text(data.filedukung);
              } else {
                $.LoadingOverlay("hide");
                swal("Error", data.pesan, "error");
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              $(".errmsgfilependukung").removeClass("d-none");
              $(".errmsgfilependukung").addClass("alert-danger");
              if (thrownError != "") {
                $(".errmsgfilependukung").html(
                  "Terjadi kesalahan saat menyimpan data vaksin, hubungi administrator"
                );
              }
            },
          });
          $.LoadingOverlay("hide");
        } else {
          swal.close();
        }
      });
    } else {
      $(".errorfilePasFoto").text($errfoto);
      $(".errorFilePendukung").text($errdukung);
    }
  });

  $("#addUploadFilePendukung").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
    let filefoto = $("#filePasFoto").val();
    const flfoto = $("#filePasFoto").prop("files")[0];
    let filepdukung = $("#filePendukung").val();
    const fldukung = $("#filePendukung").prop("files")[0];
    var token = $("#token").val();

    if (filepdukung == "") {
      $(".errmsgfilependukung").removeClass("d-none");
      $(".errmsgfilependukung").removeClass("alert-primary");
      $(".errmsgfilependukung").addClass("alert-danger");
      $(".errmsgfilependukung").html("File pendukung wajib di-upload");

      $(".errmsgfilependukung")
        .fadeTo(3000, 500)
        .slideUp(500, function () {
          $(".errmsgfilependukung").slideUp(500);
          $(".errmsgfilependukung").addClass("d-none");
          $(".errmsgfilependukung").html("");
        });
      return;
    }

    swal({
      title: "Upload File Pendukung",
      text: "Yakin file pendukung yang akan di-upload?",
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
        formData.append("filePendukung", fldukung);
        formData.append("auth_person", auth_person);
        formData.append("token", token);

        $.ajax({
          type: "POST",
          url: site_url + "karyawan/addfilependukung",
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          success: function (data) {
            var data = JSON.parse(data);
            if (data.statusCode == 200) {
              $.LoadingOverlay("hide");
              $(".8k79k67h5h9k73j7f0l28jf689sd7").text(data.auth_cek);
              $("#addTampilkanFilePendukung").attr("href", data.link);
              $("#addHapusFilePendukung").removeClass("disabled");
              $("#addTampilkanFilePendukung").removeClass("disabled");
              $("#addUploadFilePendukung").addClass("disabled");
              swal("Berhasil", data.pesan, "success");
            } else {
              $.LoadingOverlay("hide");
              $(".errmsgfilependukung").removeClass("d-none");
              $(".errmsgfilependukung").removeClass("alert-primary]");
              $(".errmsgfilependukung").addClass("alert-danger");
              $(".errmsgfilependukung").html(data.pesan);
            }
          },
        });
      } else {
        swal.close();
      }
    });
  });

  // $("#addUploadFilePendukung").click(function () {
  //   let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
  //   let filefoto = $("#filePasFoto").val();
  //   const flfoto = $("#filePasFoto").prop("files")[0];
  //   let filepdukung = $("#filePendukung").val();
  //   const fldukung = $("#filePendukung").prop("files")[0];
  //   var token = $("#token").val();

  //   if (filepdukung == "") {
  //     $(".errmsgfilependukung").removeClass("d-none");
  //     $(".errmsgfilependukung").removeClass("alert-primary");
  //     $(".errmsgfilependukung").addClass("alert-danger");
  //     $(".errmsgfilependukung").html("File pendukung wajib di-upload");

  //     $(".errmsgfilependukung")
  //       .fadeTo(3000, 500)
  //       .slideUp(500, function () {
  //         $(".errmsgfilependukung").slideUp(500);
  //         $(".errmsgfilependukung").addClass("d-none");
  //         $(".errmsgfilependukung").html("");
  //       });
  //     return;
  //   }

  //   swal({
  //     title: "Upload File Pendukung",
  //     text: "Yakin file pendukung yang akan di-upload?",
  //     type: "question",
  //     showCancelButton: true,
  //     confirmButtonColor: "#36c6d3",
  //     cancelButtonColor: "#d33",
  //     confirmButtonText: "Ya, upload",
  //     cancelButtonText: "Batalkan",
  //   }).then(function (result) {
  //     if (result.value) {
  //       $.LoadingOverlay("show");
  //       let formData = new FormData();
  //       formData.append("filePendukung", fldukung);
  //       formData.append("auth_person", auth_person);
  //       formData.append("token", token);

  //       $.ajax({
  //         type: "POST",
  //         url: site_url + "karyawan/addfilependukung",
  //         data: formData,
  //         cache: false,
  //         processData: false,
  //         contentType: false,
  //         success: function (data) {
  //           var data = JSON.parse(data);
  //           if (data.statusCode == 200) {
  //             $.LoadingOverlay("hide");
  //             $(".8k79k67h5h9k73j7f0l28jf689sd7").text(data.auth_cek);
  //             $("#addTampilkanFilePendukung").attr("href", data.link);
  //             $("#addHapusFilePendukung").removeClass("disabled");
  //             $("#addTampilkanFilePendukung").removeClass("disabled");
  //             $("#addUploadFilePendukung").addClass("disabled");
  //             swal("Berhasil", data.pesan, "success");
  //           } else {
  //             $.LoadingOverlay("hide");
  //             $(".errmsgfilependukung").removeClass("d-none");
  //             $(".errmsgfilependukung").removeClass("alert-primary]");
  //             $(".errmsgfilependukung").addClass("alert-danger");
  //             $(".errmsgfilependukung").html(data.pesan);
  //           }
  //         },
  //       });
  //     } else {
  //       swal.close();
  //     }
  //   });
  // });

  $("#addHapusFilePendukung").click(function () {
    let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

    if (auth_person != "") {
      swal({
        title: "Hapus File Pendukung",
        text: "Yakin file pendukung akan di-hapus?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#36c6d3",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batalkan",
      }).then(function (result) {
        if (result.value) {
          $.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            url: site_url + "karyawan/hapus_filependukung",
            data: {
              auth_person: auth_person,
              token: token,
            },
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                $("#filePendukung").val("");
                $("#addTampilkanFilePendukung").addClass("disabled");
                $("#addTampilkanFilePendukung").attr("href", "");
                $("#addHapusFilePendukung").addClass("disabled");
                $("#addUploadFilePendukung").removeClass("disabled");
                swal("Berhasil", data.pesan, "success");
                $.LoadingOverlay("hide");
              } else if (data.statusCode == 201) {
                $(".errmsgfilependukung").removeClass("d-none");
                $(".errmsgfilependukung").removeClass("alert-primary]");
                $(".errmsgfilependukung").addClass("alert-danger");
                $(".errmsgfilependukung").html(data.pesan);
                $.LoadingOverlay("hide");
              } else {
                $(".errorFilePendukung").html(data.errpesan);
                $.LoadingOverlay("hide");
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              $.LoadingOverlay("hide");
              $(".errmsgfilependukung").removeClass("d-none");
              $(".errmsgfilependukung").addClass("alert-danger");
              if (thrownError != "") {
                $(".errmsgfilependukung").html(
                  "Terjadi kesalahan saat menghapus file pendukung, hubungi administrator"
                );
              }
            },
          });
        } else {
          swal.close();
        }
      });
    } else {
      $.LoadingOverlay("hide");
      $(".errmsgfilependukung").removeClass("d-none");
      $(".errmsgfilependukung").removeClass("alert-primary]");
      $(".errmsgfilependukung").addClass("alert-danger");
      $(".errmsgfilependukung").html("Data personal tidak ditemukan");
    }

    $(".errmsgfilependukung")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errmsgfilependukung").slideUp(500);
        $(".errmsgfilependukung").addClass("d-none");
      });
  });

  $(document).on("click", ".btnSertifikasi ", function () {
    let auth_kary = $(this).attr("id");
    $(".8k23jnm89d56jl123mn90bv542ll").text(auth_kary);
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");

    $("#jdlmdlnewsertifikat").text(
      "Tambah Sertifikasi - " + nonik + " | " + nama + " | " + prs
    );

    $.ajax({
      type: "POST",
      url: site_url + "sertifikasi/get_jenis_sertifikasi",
      data: {
        token: token,
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#jenisSertifikasiNew").html(data.srt);

        $("#jenisSertifikasiNew").select2({
          theme: "bootstrap4",
          dropdownParent: $("#mdlnewsertifikat"),
        });
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errormsg").removeClass("d-none");
        $(".errormsg").removeClass("alert-info");
        $(".errormsg").addClass("alert-danger");
        if (thrownError != "") {
          $(".errormsg").html(
            "Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator"
          );
          $("#addSimpanSertifikasi").remove();
          $("#addResetSertifikasi").remove();
        }
      },
    });

    $("#jenisSertifikasiNew").val("").trigger("change");
    $("#noSertifikatNew").val("");
    $("#namaLembagaNew").val("");
    $("#tanggalSertifikasiNew").val("");
    $("#masaBerlakuSertifikatNew").val("").trigger("change");
    $("#tanggalSertifikasiAkhirNew").val("");
    $("#filePendukung").val("");
    $(".errorjenisSertifikasiNew").html("");
    $(".errorNoSertifikatNew").html("");
    $(".errorNamaLembagaNew").html("");
    $(".errorTanggalSertifikasiNew").html("");
    $(".errorTanggalSertifikasiAkhir").html("");
    $(".errorFileSertifikasi").html("");
    $("#mdlnewsertifikat").modal("show");
  });

  $(document).on("click", ".btnSIMPER ", function () {
    let auth_kary = $(this).attr("id");
    $(".ecb14fe704e08d9df8e343030bbb442344").text(auth_kary);
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");

    $(".ecb14fe704e08d9df8e343073455ffrdfdfg").text("");
    $("#btnshowsimpolnew").addClass("disabled");
    $("#btnshowsimpernew").addClass("disabled");
    $("#addJenisIzinnew").val("").trigger("change");
    $("#addNoRegnew").val("");
    $("#addJenisSIMnew").val("");
    $("#addTglExpSIMnew").val("");
    $("#nmfilesimpolnew").val("");
    $("#nmfilesimpolsvnew").val("");
    $("#filesimpolisinew").val("");
    $("#simpermpnew").val("");
    $("#nmfilesimpernew").val("");
    $("#nmfilesimpersvnew").val("");
    $("#addTglExpnew").val("");
    $("#lblsimpermpnew").text("Pilih file SIMPER/MINE PERMIT");
    $("#lblsimpolisinew").text("Pilih file SIM Polisi");
    $(".h52k342").text("");
    $(".erroraddJenisIzinnew").text("");
    $(".erroraddNoRegnew").text("");
    $(".erroraddJenisSIMnew").text("");
    $(".erroraddTglExpSIMnew").text("");
    $(".errorFilesimpolisinew").text("");
    $(".erroraddTglExpnew").text("");
    $(".errorsimpermpnew").text("");
    $(".errorFilesimpolisinew").text("");
    $("#jdlmdlnewSMP").text(
      "Tambah SIMPER/MINE PERMIT - " + nonik + " | " + nama + " | " + prs
    );
    $("#mdlnewSMP").modal("show");
    $("#idizintambangnew").load(
      site_url + "izin_tambang/izin_tambang?auth_izin=0"
    );
  });

  $(document).on("click", ".btnHapusKary", function () {
    let auth_kary = $(this).attr("id");
    let nama_kary = $(this).attr("value");

    swal({
      title: "Hapus Data Karyawan",
      text:
        "Yakin semua data karyawan atas nama : " +
        nama_kary +
        " akan dihapus? termasuk file yang telah diupload, data tidak dapat dikembalikan",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#36c6d3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Batalkan",
    }).then(function (result) {
      if (result.value) {
        $.LoadingOverlay("show");
        $.ajax({
          type: "POST",
          url: site_url + "karyawan/hapus_karyawan",
          data: {
            auth_kary: auth_kary,
            token: token,
          },
          success: function (data) {
            var data = JSON.parse(data);
            if (data.statusCode == 200) {
              tbmKaryawan.draw();
              $.LoadingOverlay("hide");
              swal("Berhasil", data.pesan, "success");
            } else {
              $.LoadingOverlay("hide");
              swal("Error", data.pesan, "error");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsg").removeClass("d-none");
            $(".errormsg").removeClass("alert-info");
            $(".errormsg").addClass("alert-danger");
            if (thrownError != "") {
              $(".errormsg").html(
                "Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator"
              );
              $("#addSimpanSertifikasi").remove();
              $("#addResetSertifikasi").remove();
            }
          },
        });
      } else {
        swal.close();
      }
    });
  });

  $("#masaBerlakuSertifikatNew").change(function () {
    let tglsrt = $("#tanggalSertifikasiNew").val();
    let masa = $("#masaBerlakuSertifikatNew").val();

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
          $("#tanggalSertifikasiAkhirNew").val(data.tglexp);
        }
      },
    });
  });

  $("#tanggalSertifikasiNew").change(function () {
    let tglsrt = $("#tanggalSertifikasiNew").val();
    let masa = $("#masaBerlakuSertifikatNew").val();

    $.ajax({
      type: "post",
      url: site_url + "sertifikasi/getdateexpsrt",
      data: {
        tglsrt: tglsrt,
        masa: masa,
      },
      success: function (data) {
        var data = JSON.parse(data);
        if (data.statusCode == 200) {
          $("#tanggalSertifikasiAkhirNew").val(data.tglexp);
        }
      },
    });
  });

  $("#btnnewsertifikat").click(function () {
    let auth_kary = $(".8k23jnm89d56jl123mn90bv542ll").text();
    let jenis = $("#jenisSertifikasiNew").val();
    let no_ser = $("#noSertifikatNew").val();
    let lembaga = $("#namaLembagaNew").val();
    let tgl_ser = $("#tanggalSertifikasiNew").val();
    let tgl_akhir_ser = $("#tanggalSertifikasiAkhirNew").val();
    let file_ser = $("#fileSertifikasi").val();
    const fl_ser = $("#fileSertifikasi").prop("files")[0];

    if (auth_kary == "") {
      errkary = "Data karyawan tidak ditemukan";
    } else {
      errkary = "";
    }

    if (jenis == "") {
      errjenis = "Jenis sertifikasi wajib dipilih";
    } else {
      errjenis = "";
    }
    if (no_ser == "") {
      errno_ser = "No. sertifikasi wajib diisi";
    } else {
      errno_ser = "";
    }
    if (lembaga == "") {
      errlembaga = "Lembaga wajib diisi";
    } else {
      errlembaga = "";
    }
    if (tgl_ser == "") {
      errtgl_ser = "Tanggal sertifikasi wajib diisi";
    } else {
      errtgl_ser = "";
    }
    if (tgl_akhir_ser == "") {
      errtgl_akhir_ser = "Jenis sertifikasi wajib diisi";
    } else {
      errtgl_akhir_ser = "";
    }
    if (file_ser == "") {
      errfile_ser = "File sertifikasi wajib diupload";
    } else {
      errfile_ser = "";
    }

    if (
      errkary == "" &&
      errjenis == "" &&
      errno_ser == "" &&
      errlembaga == "" &&
      errtgl_ser == "" &&
      errtgl_akhir_ser == "" &&
      errfile_ser == ""
    ) {
      swal({
        title: "Upload Sertifikasi",
        text: "Yakin data sertifikasi akan di-upload?",
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
          formData.append("jenis", jenis);
          formData.append("no_ser", no_ser);
          formData.append("lembaga", lembaga);
          formData.append("tgl_ser", tgl_ser);
          formData.append("tgl_akhir_ser", tgl_akhir_ser);
          formData.append("file_ser", file_ser);
          formData.append("fl_ser", fl_ser);
          formData.append("auth_kary", auth_kary);
          formData.append("token", token);

          $.ajax({
            type: "POST",
            url: site_url + "karyawan/newsertifikasi",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
              var data = JSON.parse(data);
              if (data.statusCode == 200) {
                $("#mdlnewsertifikat").modal("hide");
                $(".8k23jnm89d56jl123mn90bv542ll").text("");
                $("#jenisSertifikasiNew").val("").trigger("change");
                $("#noSertifikatNew").val("");
                $("#namaLembagaNew").val("");
                $("#tanggalSertifikasiNew").val("");
                $("#tanggalSertifikasiAkhirNew").val("");
                $("#masaBerlakuSertifikatNew").val("").trigger("change");
                $("#filePendukung").val("");
                swal("Berhasil", data.pesan, "success");
                $.LoadingOverlay("hide");
              } else if (data.statusCode == 201) {
                $.LoadingOverlay("hide");
                $(".errnewsertifikat").removeClass("d-none");
                $(".errnewsertifikat").removeClass("alert-primary]");
                $(".errnewsertifikat").addClass("alert-danger");
                $(".errnewsertifikat").html(data.pesan);
              } else {
                $(".errorjenisSertifikasiNew").html(data.jenis);
                $(".errorNoSertifikatNew").html(data.no_ser);
                $(".errorNamaLembagaNew").html(data.lembaga);
                $(".errorTanggalSertifikasiNew").html(data.tgl_ser);
                $(".errorTanggalSertifikasiAkhir").html(data.tgl_akhir_ser);
                $(".errorFileSertifikasi").html(data.filesrt);
                $.LoadingOverlay("hide");
              }
            },
          });
        } else {
          swal.close();
        }
      });
    } else {
      if (errkary != "") {
        $(".errnewsertifikat").removeClass("d-none");
        $(".errnewsertifikat").removeClass("alert-primary]");
        $(".errnewsertifikat").addClass("alert-danger");
        $(".errnewsertifikat").html(errkary);
      } else {
        $(".errnewsertifikat").addClass("d-none");
        $(".errnewsertifikat").html("");
      }

      $(".errorjenisSertifikasiNew").html(errjenis);
      $(".errorNoSertifikatNew").html(errno_ser);
      $(".errorNamaLembagaNew").html(errlembaga);
      $(".errorTanggalSertifikasiNew").html(errtgl_ser);
      $(".errorTanggalSertifikasiAkhir").html(errtgl_akhir_ser);
      $(".errorFileSertifikasi").html(errfile_ser);
    }

    $(".errnewsertifikat")
      .fadeTo(5000, 500)
      .slideUp(500, function () {
        $(".errnewsertifikat").slideUp(500);
        $(".errnewsertifikat").addClass("d-none");
      });
  });

  $(document).on("click", ".btnMCU ", function () {
    let auth_kary = $(this).attr("id");
    $(".890123hjn34267xcxvbj7234hh").text(auth_kary);
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");

    $("#jdlmdlnewmcu").text(
      "Tambah MCU - " + nonik + " | " + nama + " | " + prs
    );

    $.ajax({
      type: "POST",
      url: site_url + "karyawan/get_all_jenis_mcu",
      data: {},
      success: function (data) {
        var data = JSON.parse(data);
        $("#hasilMCUnew").html(data.jmcu);
        $("#hasilMCUnew").select2({
          theme: "bootstrap4",
          dropdownParent: $("#mdlnewmcu"),
        });
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $.LoadingOverlay("hide");
        $(".errnewmcu").removeClass("d-none");
        $(".errnewmcu").removeClass("alert-info");
        $(".errnewmcu").addClass("alert-danger");
        if (thrownError != "") {
          $(".errnewmcu").html(
            "Terjadi kesalahan saat load data hasil MCU, hubungi administrator"
          );
        }
      },
    });

    $("#hasilMCUnew").val("").trigger("change");
    $("#tglMCUnew").val("");
    $("#ketMCUnew").val("");
    $("#fileMCUnew").val("");
    $(".errorTglMCUnew").html("");
    $(".errorHasilMCUnew").html("");
    $(".errorKetMCUnew").html("");
    $(".errorFileMCUnew").html("");
    $("#mdlnewmcu").modal("show");
  });

  $("#tambahDataMCU").submit(function () {
    let auth_kary = $(".890123hjn34267xcxvbj7234hh").text();
    let tglMCU = $("#tglMCUnew").val();
    let hasilMCU = $("#hasilMCUnew").val();
    let ketMCU = $("#ketMCUnew").val();
    let file_MCU = $("#fileMCUnew").val();
    const fl_MCU = $("#fileMCUnew").prop("files")[0];

    if (auth_kary == "") {
      errkary = "Data karyawan tidak ditemukan";
    } else {
      errkary = "";
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
        text: "Ukuran File MCU yang dipilih melebihi 1000kb",
        type: "warning",
      });
    } else {
      if (errkary == "") {
        swal({
          title: "Upload MCU",
          text: "Yakin data MCU akan di-upload?",
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
            formData.append("tglMCU", tglMCU);
            formData.append("hasilMCU", hasilMCU);
            formData.append("ketMCU", ketMCU);
            formData.append("file_MCU", file_MCU);
            formData.append("fl_MCU", fl_MCU);
            formData.append("auth_kary", auth_kary);

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
        if (errkary != "") {
          $(".errnewmcu").removeClass("d-none");
          $(".errnewmcu").removeClass("alert-primary]");
          $(".errnewmcu").addClass("alert-danger");
          $(".errnewmcu").html(errkary);
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

  $(document).on("click", ".btnFotoKaryawan ", function () {
    let auth_kary = $(this).attr("id");
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");

    $("#jdlmdlnewfotokaryawan").text(
      "Tambah Foto Karyawan - " + nonik + " | " + nama + " | " + prs
    );

    $(".76235ft67gfrubf12").text(auth_kary);
    $("#mdlnewfotokaryawan").modal("show");
  });

  $(document).on("click", ".btnFilePendukung ", function () {
    let auth_kary = $(this).attr("id");
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");
    $(".12390lkjj4234bn12j28j4nc9").text(auth_kary);

    $("#jdlmdlnewfilependukung").text(
      "Update File Pendukung - " + nonik + " | " + nama + " | " + prs
    );
    $("#mdlnewfilependukung").modal("show");
  });

  $(document).on("click", ".btnVaksin", function () {
    let auth_kary = $(this).attr("id");
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");
    $(".t9018htg2398th259").text(auth_kary);

    $("#jdlmdlnewvaksin").text(
      "Tambah Data Vaksin - " + nonik + " | " + nama + " | " + prs
    );

    $("#mdlnewvaksin").modal("show");
    $('#jenisVaksin option[value="0"]').hide();
    $('#namaVaksin option[value="0"]').hide();
  });

  $("#gantiFotoKaryawan").submit(function () {
    let auth_kary = $(".76235ft67gfrubf12").text();
    let foto_karyawan = $("#fotoKaryawanNew").val();
    const file_foto = $("#fotoKaryawanNew").prop("files")[0];
    let fileExtension = foto_karyawan.split(".").pop().toLowerCase();
    let sizeFile = file_foto["size"];
    if (fileExtension != "jpg") {
      swal({
        title: "Informasi",
        text: "File foto yang dipilih bukan JPG",
        type: "info",
      });
    } else if (sizeFile > 100000) {
      swal({
        title: "Peringatan",
        text: "Ukuran File foto yang dipilih melebihi 100kb",
        type: "warning",
      });
    } else {
      if (auth_kary == "") {
        errkary = "Data karyawan tidak ditemukan";
      } else {
        errkary = "";
      }

      if (errkary == "") {
        swal({
          title: "Upload Foto Karyawan",
          text: "Yakin foto akan di-upload?",
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
            formData.append("foto_karyawan", foto_karyawan);
            formData.append("file_foto", file_foto);
            formData.append("auth_kary", auth_kary);
            $.ajax({
              type: "POST",
              url: site_url + "karyawan/newfotokaryawan",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                  $("#mdlnewfotokaryawan").modal("hide");
                  $(".76235ft67gfrubf12").text("");
                  $("#fotoKaryawanNew").val("");
                  $.LoadingOverlay("hide");
                  swal({
                    title: "Berhasil",
                    text: data.pesan,
                    type: "success",
                    showConfirmButton: false,
                    timer: 2000,
                  });
                } else if (data.statusCode == 201) {
                  $.LoadingOverlay("hide");
                  $(".errnewfotokaryawan").removeClass("d-none");
                  $(".errnewfotokaryawan").removeClass("alert-primary]");
                  $(".errnewfotokaryawan").addClass("alert-danger");
                  $(".errnewfotokaryawan").html(data.pesan);
                }
              },
            });
          }
        });
      } else {
        if (errkary != "") {
          $(".errnewfotokaryawan").removeClass("d-none");
          $(".errnewfotokaryawan").removeClass("alert-primary]");
          $(".errnewfotokaryawan").addClass("alert-danger");
          $(".errnewfotokaryawan").html(errkary);
        } else {
          $(".errnewfotokaryawan").addClass("d-none");
          $(".errnewfotokaryawan").html("");
        }

        $(".errnewfotokaryawan")
          .fadeTo(5000, 500)
          .slideUp(500, function () {
            $(".errnewfotokaryawan").slideUp(500);
            $(".errnewfotokaryawan").addClass("d-none");
          });
      }
    }
  });

  $("#gantiFilePendukung").submit(function () {
    let auth_kary = $(".12390lkjj4234bn12j28j4nc9").text();
    let file_pendukung = $("#filePendukungnew").val();
    const fl_pendukung = $("#filePendukungnew").prop("files")[0];
    let fileExtension = file_pendukung.split(".").pop().toLowerCase();
    let sizeFile = fl_pendukung["size"];
    let nonik = $(this).attr("dt1");
    let nama = $(this).attr("dt2");
    let prs = $(this).attr("dt3");

    if (fileExtension != "pdf") {
      swal({
        title: "Informasi",
        text: "File yang dipilih bukan PDF",
        type: "info",
      });
    } else if (sizeFile > 1000000) {
      swal({
        title: "Peringatan",
        text: "Ukuran file yang dipilih melebihi 1000kb",
        type: "warning",
      });
    } else {
      if (auth_kary == "") {
        errkary = "Data karyawan tidak ditemukan";
      } else {
        errkary = "";
      }

      if (errkary == "") {
        swal({
          title: "Upload File Pendukung",
          text: "Yakin file pendukung akan di-upload?",
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
            formData.append("file_pendukung", file_pendukung);
            formData.append("fl_pendukung", fl_pendukung);
            formData.append("auth_kary", auth_kary);
            $.ajax({
              type: "POST",
              url: site_url + "karyawan/newfilependukung",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                  $("#mdlnewfilependukung").modal("hide");
                  $(".12390lkjj4234bn12j28j4nc9").text("");
                  $("#filePendukungnew").val("");
                  $.LoadingOverlay("hide");
                  swal({
                    title: "Berhasil",
                    text: data.pesan,
                    type: "success",
                    showConfirmButton: false,
                    timer: 2000,
                  });
                } else if (data.statusCode == 201) {
                  $.LoadingOverlay("hide");
                  $(".errnewfilependukung").removeClass("d-none");
                  $(".errnewfilependukung").removeClass("alert-primary]");
                  $(".errnewfilependukung").addClass("alert-danger");
                  $(".errnewfilependukung").html(data.pesan);
                }
              },
            });
          }
        });
      } else {
        $.LoadingOverlay("hide");
        if (errkary != "") {
          $(".errnewfilependukung").removeClass("d-none");
          $(".errnewfilependukung").removeClass("alert-primary]");
          $(".errnewfilependukung").addClass("alert-danger");
          $(".errnewfilependukung").html(errkary);
        } else {
          $(".errnewfilependukung").addClass("d-none");
          $(".errnewfilependukung").html("");
        }

        $.LoadingOverlay("hide");

        $(".errnewfilependukung")
          .fadeTo(5000, 500)
          .slideUp(500, function () {
            $(".errnewfilependukung").slideUp(500);
            $(".errnewfilependukung").addClass("d-none");
          });
      }
    }
  });

  $("#tambahDataVaksin").submit(function () {
    let auth_kary = $(".t9018htg2398th259").text();
    let jenisVaksin = $("#jenisVaksin").val();
    let namaVaksin = $("#namaVaksin").val();
    let tanggalVaksin = $("#tanggalVaksin").val();
    if (auth_kary == "") {
      errkary = "Data karyawan tidak ditemukan";
    } else {
      errkary = "";
    }

    if (errkary == "") {
      $.LoadingOverlay("show");
      $.ajax({
        type: "post",
        url: site_url + "karyawan/newvaksin",
        data: {
          auth_kary: auth_kary,
          jenisVaksin: jenisVaksin,
          namaVaksin: namaVaksin,
          tanggalVaksin: tanggalVaksin,
        },
        success: function (data) {
          var data = JSON.parse(data);
          if (data.statusCode == 200) {
            $("#mdlnewvaksin").modal("hide");
            $(".t9018htg2398th259").text("");
            $("#jenisVaksin").val("").trigger("change");
            $("#namaVaksin").val("").trigger("change");
            $("#tanggalVaksin").val("");
            $.LoadingOverlay("hide");
            swal({
              title: "Berhasil",
              text: data.pesan,
              type: "success",
              showConfirmButton: false,
              timer: 2000,
            });
          } else if (data.statusCode == 201) {
            $.LoadingOverlay("hide");
            $(".errornewvaksin").removeClass("d-none");
            $(".errornewvaksin").removeClass("alert-primary]");
            $(".errornewvaksin").addClass("alert-danger");
            $(".errornewvaksin").html(data.pesan);
          }
        },
      });
    } else {
      if (errkary != "") {
        $(".errornewvaksin").removeClass("d-none");
        $(".errornewvaksin").removeClass("alert-primary]");
        $(".errornewvaksin").addClass("alert-danger");
        $(".errornewvaksin").html(errkary);
      } else {
        $(".errornewvaksin").addClass("d-none");
        $(".errornewvaksin").html("");
      }

      $.LoadingOverlay("hide");

      $(".errornewvaksin")
        .fadeTo(5000, 500)
        .slideUp(500, function () {
          $(".errornewvaksin").slideUp(500);
          $(".errornewvaksin").addClass("d-none");
        });
    }
  });

  $("#infoKlasifikasi").click(function () {
    $("#mdlinfoklasifikasi").modal("show");
  });

  function tbKary(prs, ckc = 0) {
    tbmKaryawan = $("#tbmKaryawan").DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      ordering: true,
      order: [[6, "asc"]],
      ajax: {
        url:
          site_url +
          "karyawan/ajax_list?auth_m_per=" +
          prs +
          "&authtoken=" +
          $("#token").val() +
          "&ck=" +
          ckc,
        type: "POST",
        error: function (xhr, error, code) {
          if (code != "") {
            $(".err_psn_kary").removeClass("d-none");
            $(".err_psn_kary").css("display", "block");
            $(".err_psn_kary").html(
              "terjadi kesalahan saat melakukan load data karyawan ss, hubungi administrator"
            );
            $("#addTambahKary").addClass("disabled");
            $(".err_psn_kary ")
              .fadeTo(3000, 500)
              .slideUp(500, function () {
                $(".err_psn_kary ").slideUp(500);
              });
          }
        },
      },
      deferRender: true,
      aLengthMenu: [
        [10, 25, 50],
        [10, 25, 50],
      ],
      columns: [
        {
          data: "proses",
          className: "text-center text-nowrap align-middle",
          width: "1%",
        },
        {
          data: "no",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          className: "text-center align-middle",
          width: "1%",
        },
        {
          data: "no_nik",
          className: "align-middle ",
        },
        {
          data: "nama_lengkap",
          className: " align-middle",
        },
        {
          data: "depart",
          className: "text-wrap align-middle",
        },
        {
          data: "posisi",
          className: "text-wrap align-middle",
        },
        {
          data: "kode_m_perusahaan",
          className: "text-wrap align-middle text-center",
          width: "12%",
        },
        {
          data: "stat_aktif",
          className: "text-wrap align-middle text-center",
          width: "1%",
        },
      ],
    });

    $("#tbmViolation").DataTable({
      searching: false,
      paging: false,
    });
    $("#tbmKaryawan").LoadingOverlay("hide");
  }
});
