$(document).ready(function () {
    let flagProv = true;
    let flagKab = true;
    let flagKec = true;
    let flagKel = true;
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
            if (idProvinsi != "" && flagProv) {
                $("#editProvData").val(idProvinsi).trigger('change');
                flagProv = !flagProv;
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data provinsi, hubungi administrator");
                $("#editSimpanPersonal").remove();
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
                $("#editSimpanPersonal").remove();
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
                $("#editSimpanPersonal").remove();
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
                $("#editSimpanPersonal").remove();
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

    function refresh_provinsi() {
        $("#txtEditProv").LoadingOverlay("show");
        $("#txtEditKota").LoadingOverlay("show");
        $("#txtEditKec").LoadingOverlay("show");
        $("#txtEditKel").LoadingOverlay("show");

        $.ajax({
            type: "POST",
            url: site_url + "daerah/get_prov",
            data: {},
            success: function (data) {
                idProvinsi = "";
                idKabupaten = "";
                var data = JSON.parse(data);
                $("#editProvData").html(data.prov);
                $("#editKotaData").html("<option value=''>-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>");
                $("#editKecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                $("#editKelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                $("#txtEditProv").LoadingOverlay("hide");
                $("#txtEditKota").LoadingOverlay("hide");
                $("#txtEditKec").LoadingOverlay("hide");
                $("#txtEditKel").LoadingOverlay("hide");
                $("#editKotaData").attr('disabled', true);
                $("#editKecData").attr('disabled', true);
                $("#editKelData").attr('disabled', true);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#editProvData").LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                $("#txtEditProv").LoadingOverlay("hide");
                $("#txtEditKota").LoadingOverlay("hide");
                $("#txtEditKec").LoadingOverlay("hide");
                $("#txtEditKel").LoadingOverlay("hide");
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data provinsi, hubungi administrator");
                    $("#editSimpanPersonal").remove();
                }
            }
        });
    }

    function change_provinsi(idProv) {
        $("#txtEditKota").LoadingOverlay("show");
        $("#txtEditKec").LoadingOverlay("show");
        $("#txtEditKel").LoadingOverlay("show");

        $.ajax({
            type: "POST",
            url: site_url + "daerah/get_kab",
            data: {
                id_prov: idProv
            },
            success: function (data) {
                // idKabupaten = "";
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    $("#editKotaData").html(data.kab);
                    if (idKabupaten != "" && flagKab) {
                        $("#editKotaData").val(idKabupaten).trigger('change');
                        flagKab = !flagKab;
                    }
                    $("#editKecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                    $("#editKelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    $("#editKotaData").removeAttr('disabled');
                    $("#txtEditKota").LoadingOverlay("hide");
                    $("#txtEditKec").LoadingOverlay("hide");
                    $("#txtEditKel").LoadingOverlay("hide");
                } else {
                    $("#editKotaData").html("<option value=''>-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>");
                    $("#editKecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                    $("#editKelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    $("#editKotaData").attr('disabled', true);
                    $("#editKecData").attr('disabled', true);
                    $("#editKelData").attr('disabled', true);
                    $("#txtEditKota").LoadingOverlay("hide");
                    $("#txtEditKec").LoadingOverlay("hide");
                    $("#txtEditKel").LoadingOverlay("hide");
                }

                if (idProvinsi != "") {
                    $(".errorEditKotaData").html("");
                } else {
                    $(".errorEditKotaData").html("<p>Provinsi wajib dipilih</p>");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                $("#txtkota").LoadingOverlay("hide");
                $("#txtkec").LoadingOverlay("hide");
                $("#txtkel").LoadingOverlay("hide");
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator");
                    $("#editSimpanPersonal").remove();
                }
            }
        });
    }

    function refresh_kabupaten() {
        if (idProvinsi != "") {
            $("#txtEditKota").LoadingOverlay("show");
            $("#txtEditKec").LoadingOverlay("show");
            $("#txtEditKel").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url + "daerah/get_kab",
                data: {
                    id_prov: idProvinsi
                },
                success: function (data) {
                    idKabupaten = "";
                    var data = JSON.parse(data);
                    $("#editKotaData").html(data.kab);
                    $("#editKecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                    $("#editKelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    $("#txtEditKota").LoadingOverlay("hide");
                    $("#txtEditKec").LoadingOverlay("hide");
                    $("#txtEditKel").LoadingOverlay("hide");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    $("#txtEditKota").LoadingOverlay("hide");
                    $("#txtEditKec").LoadingOverlay("hide");
                    $("#txtEditKel").LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator");
                        $("#editSimpanPersonal").remove();
                    }
                }
            });
        } else {
            swal("Perhatian", "Silahkan pilih provinsi terlebih dahulu.", "warning");
        }
    }

    function change_kabupaten(idKab) {
        $("#txtEditKec").LoadingOverlay("show");
        $("#txtEditKel").LoadingOverlay("show");

        $.ajax({
            type: "POST",
            url: site_url + "daerah/get_kec",
            data: {
                id_kab: idKab
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    $("#editKecData").html(data.kec);
                    if (idKecamatan != "" && flagKec) {
                        $("#editKecData").val(idKecamatan).trigger('change');
                        flagKec = !flagKec;
                    }
                    $("#editKelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    $("#editKecData").removeAttr('disabled');
                    $("#txtEditKec").LoadingOverlay("hide");
                    $("#txtEditKel").LoadingOverlay("hide");
                } else {
                    $("#editKecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                    $("#editKelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    $("#editKecData").attr('disabled', true);
                    $("#editKelData").attr('disabled', true);
                    $("#txtEditKec").LoadingOverlay("hide");
                    $("#txtEditKel").LoadingOverlay("hide");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                $("#txtEditKec").LoadingOverlay("hide");
                $("#txtEditKel").LoadingOverlay("hide");
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                    $("#editSimpanPersonal").remove();
                }
            }
        });
    }

    function refresh_kecamatan() {
        if (idKabupaten != "") {
            $("#txtEditKec").LoadingOverlay("show");
            $("#txtEditKel").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url + "daerah/get_kec",
                data: {
                    id_kab: idKabupaten
                },
                success: function (data) {
                    idKecamatan = "";
                    var data = JSON.parse(data);
                    $("#editKecData").html(data.kec);
                    $("#editKelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    $("#txtEditKec").LoadingOverlay("hide");
                    $("#txtEditKel").LoadingOverlay("hide");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    $("#txtEditKec").LoadingOverlay("hide");
                    $("#txtEditKel").LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                        $("#editSimpanPersonal").remove();
                    }
                }
            });
        } else {
            swal("Perhatian", "Silahkan pilih kabupaten terlebih dahulu.", "warning");
        }
    }

    function change_kecamatan(idKec) {
        $("#txtEditKel").LoadingOverlay("show");

        $.ajax({
            type: "POST",
            url: site_url + "daerah/get_kel",
            data: {
                id_kec: idKec
            },
            success: function (res) {
                var data = JSON.parse(res);
                if (data.statusCode == 200) {
                    $("#editKelData").html(data.kel);
                    if (idKelurahan != "" && flagKel) {
                        $("#editKelData").val(idKelurahan).trigger('change');
                        flagKel = !flagKel;
                    }
                    $("#editKelData").removeAttr('disabled');
                    $("#txtEditKel").LoadingOverlay("hide");
                } else {
                    $("#editKelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    $("#editKelData").attr('disabled', true);
                    $("#txtEditKel").LoadingOverlay("hide");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                $("#txtEditKec").LoadingOverlay("hide");
                $("#txtEditKel").LoadingOverlay("hide");
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data kelurahan, hubungi administrator");
                    $("#editSimpanPersonal").remove();
                }
            }
        });
    }

    function refresh_kelurahan() {
        if (idKecamatan != "") {
            $("#txtEditKel").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url + "daerah/get_kel",
                data: {
                    id_kec: idKecamatan
                },
                success: function (data) {
                    idKecamatan = "";
                    var data = JSON.parse(data);
                    $("#editKelData").html(data.kel);
                    $("#txtEditKel").LoadingOverlay("hide");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    $("#txtEditKel").LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data kelurahan, hubungi administrator");
                        $("#editSimpanPersonal").remove();
                    }
                }
            });
        } else {
            swal("Perhatian", "Silahkan pilih kecamatan terlebih dahulu.", "warning");
        }
    }

    function refresh_stat_nikah() {
        $("#txtEditNikah").LoadingOverlay("show");

        $.ajax({
            type: "POST",
            url: site_url + "karyawan/get_stat_nikah",
            data: {},
            success: function (data) {
                var data = JSON.parse(data);
                $("#editStatPernikahan").html(data.statnikah);
                $("#txtEditNikah").LoadingOverlay("hide");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#txtnikah").LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data status pernikahan, hubungi administrator");
                    $("#editSimpanPersonal").remove();
                }
            }
        });
    }

    function refresh_stat_pendidikan() {
        $("#txtEditDidik").LoadingOverlay("show");

        $.ajax({
            type: "POST",
            url: site_url + "pendidikan/get_all",
            data: {},
            success: function (data) {
                var data = JSON.parse(data);
                $("#editPendidikanTerakhir").html(data.pdk);
                $("#txtEditDidik").LoadingOverlay("hide");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                $("#txtEditDidik").LoadingOverlay("hide");
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data pendidikan terakhir, hubungi administrator");
                    $("#editSimpanPersonal").remove();
                }
            }
        });
    }

    $("#refreshEditProv").click(function () {
        refresh_provinsi();
    });

    $("#editProvData").change(function () {
        idProvinsi = $("#editProvData").val();
        change_provinsi(idProvinsi);
    });

    $("#refreshEditKota").click(function () {
        refresh_kabupaten();
    });

    $("#editKotaData").change(function () {
        idKabupaten = $("#editKotaData").val();
        change_kabupaten(idKabupaten);
    });

    $("#refreshEditKec").click(function () {
        refresh_kecamatan();
    });

    $("#editKecData").change(function () {
        idKecamatan = $("#editKecData").val();
        change_kecamatan(idKecamatan);
    });

    $("#refreshEditKel").click(function () {
        refresh_kelurahan();
    });

    $("#refreshEditStatNikah").click(function () {
        refresh_stat_nikah();
    });

    $("#refreshEditDidik").click(function () {
        refresh_stat_pendidikan();
    });
});