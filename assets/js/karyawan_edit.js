$(document).ready(function () {
    let idProvinsi = $("#valueProvinsi").val();
    let idKabupaten = $("#valueKabupaten").val();
    let idKecamatan = $("#valueKecamatan").val();
    let idKelurahan = $("#valueKelurahan").val();
    let wargaNegara = $("#valueWargaNegara").val();
    let agama = $("#valueAgama").val();
    let jenisKelamin = $("#valueJenisKelamin").val();
    let statPernikahan = $("#valueStatNikah").val();
    let statPendidikan = $("#valueStatPendidikan").val();

    $.ajax({
        type: "POST",
        url: site_url + "daerah/get_prov",
        data: {},
        success: function (data) {
            var data = JSON.parse(data);
            $("#editProvData").html(data.prov);
            $("#editProvData").val(idProvinsi).trigger('change');
            $.ajax({
                type: "POST",
                url: site_url + "daerah/get_kab",
                data: {
                    id_prov: idProvinsi
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    $("#editKotaData").html(data.kab);
                    $("#editKotaData").val(idKabupaten).trigger('change');
                    $.ajax({
                        type: "POST",
                        url: site_url + "daerah/get_kec",
                        data: {
                            id_kab: idKabupaten
                        },
                        success: function (data) {
                            var data = JSON.parse(data);
                            $("#editKecData").html(data.kec);
                            $("#editKecData").val(idKecamatan).trigger('change');
                            $.ajax({
                                type: "POST",
                                url: site_url + "daerah/get_kel",
                                data: {
                                    id_kec: idKecamatan
                                },
                                success: function (data) {
                                    var data = JSON.parse(data);
                                    $("#editKelData").html(data.kel);
                                    $("#editKelData").val(idKelurahan).trigger('change');
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    $.LoadingOverlay("hide");
                                    $(".errormsg").removeClass('d-none');
                                    $(".errormsg").removeClass('alert-info');
                                    $(".errormsg").addClass('alert-danger');
                                    if (thrownError != "") {
                                        $(".errormsg").html("Terjadi kesalahan saat load data kelurahan, hubungi administrator");
                                        $("#addSimpanPersonal").remove();
                                    }
                                }
                            });
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".errormsg").removeClass('d-none');
                            $(".errormsg").removeClass('alert-info');
                            $(".errormsg").addClass('alert-danger');
                            if (thrownError != "") {
                                $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                                $("#addSimpanPersonal").remove();
                            }
                        }
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data kabupaten, hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                }
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data provinsi, hubungi administrator");
                $("#addSimpanPersonal").remove();
            }
        }
    });
    $("#editKewarganegaraan").val(wargaNegara).trigger('change');
    $.ajax({
        type: "GET",
        data: {},
        url: site_url + "karyawan/get_agama",
        success: function (res) {
            var data = JSON.parse(res);
            $("#editAgama").html(data.agama);
            $("#editAgama").val(agama).trigger("change");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data agama, hubungi administrator");
                $("#addSimpanPersonal").remove();
            }
        }
    });
    $("#editJenisKelamin").val(jenisKelamin).trigger('change');
    $.ajax({
        type: "GET",
        data: {},
        url: site_url + "karyawan/get_stat_nikah",
        success: function (res) {
            var data = JSON.parse(res);
            $("#editStatPernikahan").html(data.statnikah);
            $("#editStatPernikahan").val(statPernikahan).trigger("change");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data status pernikahan, hubungi administrator");
                $("#addSimpanPersonal").remove();
            }
        }
    });
    $.ajax({
        type: "POST",
        url: site_url + "pendidikan/get_all",
        data: {},
        success: function (data) {
            var data = JSON.parse(data);
            $("#editPendidikanTerakhir").html(data.pdk);
            $("#editPendidikanTerakhir").val(statPendidikan).trigger("change");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data pendidikan terakhir, hubungi administrator");
                $("#addSimpanPersonal").remove();
            }
        }
    });

    $("#clEditKaryawan-click").click(function () {
        if ($("#colEditKaryawan").hasClass("show")) {
            $("#colEditKaryawan").collapse("hide");
        } else {
            $("#colEditKaryawan").collapse("show");
        }
    });

    $("#clEditPersonal-click").click(function () {
        if ($("#colEditPersonal").hasClass("show")) {
            $("#colEditPersonal").collapse("hide");
        } else {
            $("#colEditPersonal").collapse("show");
        }
    });

    $("#clEditIzinTambang-click").click(function () {
        if ($("#colEditIzinTambang").hasClass("show")) {
            $("#colEditIzinTambang").collapse("hide");
        } else {
            $("#colEditIzinTambang").collapse("show");
        }
    });

    $("#clEditSertifikasi-click").click(function () {
        if ($("#colEditSertifikasi").hasClass("show")) {
            $("#colEditSertifikasi").collapse("hide");
        } else {
            $("#colEditSertifikasi").collapse("show");
        }
    });

    $("#clEditMCU-click").click(function () {
        if ($("#colEditMCU").hasClass("show")) {
            $("#colEditMCU").collapse("hide");
        } else {
            $("#colEditMCU").collapse("show");
        }
    });

    $("#clEditVaksin-click").click(function () {
        if ($("#colEditVaksin").hasClass("show")) {
            $("#colEditVaksin").collapse("hide");
        } else {
            $("#colEditVaksin").collapse("show");
        }
    });

    $("#clEditFilePendukung-click").click(function () {
        if ($("#colEditFilePendukung").hasClass("show")) {
            $("#colEditFilePendukung").collapse("hide");
        } else {
            $("#colEditFilePendukung").collapse("show");
        }
    });

});