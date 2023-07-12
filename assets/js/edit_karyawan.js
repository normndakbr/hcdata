$(document).ready(function () {
    let auth_depart = "";
    let auth_posisi = "";
    let auth_tipe = "";
    let auth_level = "";
    let auth_lokterima = "";
    let auth_lokker = "";
    let idPosisi = $("#valuePosisi").val();
    let idDepart = $("#valueDepart").val();
    let idTipe = $("#valueTipe").val();
    let idMasterPerusahaan = $("#valuePerusahaan").val();
    let idKlasifikasi = $("#valueKlasifikasi").val();
    let idLevel = $("#valueLevel").val();
    let idPOH = $("#valuePOH").val();
    let idLokterima = $("#valueLokterima").val();
    let idLokker = $("#valueLokker").val();
    let valueStatTinggal = $("#valueStatTinggal").val();
    let idStatPerjanjian = $("#valueStatPerjanjian").val();

    $("#editPerKary").val(idMasterPerusahaan).trigger('change');

    // get depart
    $.ajax({
        type: "POST",
        url: site_url + "departemen/get_auth_depart_by_id",
        data: {
            id_depart: idDepart
        },
        success: function (res) {
            let data = JSON.parse(res);
            auth_depart = data.auth_depart;
            $.ajax({
                type: "POST",
                url: site_url + "departemen/get_by_auth_m_per",
                data: {
                    auth_m_per: idMasterPerusahaan
                },
                success: function (res) {
                    var data = JSON.parse(res);
                    $("#editDepartKary").html(data.dprt);
                    $("#editDepartKary").removeAttr('disabled');
                    $("#editPosisiKary").attr('disabled', true);
                    $("#refreshEditPosisi").attr('disabled', true);
                    $("#editPosisiKary").html('<option value ="">-- WAJIB DIPILIH --</option>');
                    $("#txtEditDepartKary").LoadingOverlay("hide");
                    $("#txtEditPosisiKary").LoadingOverlay("hide");
                    $("#editDepartKary").val(auth_depart).trigger('change');

                    if (idMasterPerusahaan != "") {
                        $(".errorEditPerKary").html("");
                    } else {
                        $(".errorEditPerKary").html("<p>Perusahaan wajib dipilih</p>");
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#txtdepartkary").LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data departemen, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("Error!! " + idDepart);
            console.log(thrownError);
        }
    });

    // get posisi
    function fetch_posisi() {
        $.ajax({
            type: "POST",
            url: site_url + "posisi/get_by_authdepart",
            data: {
                auth_depart: auth_depart
            },
            success: function (res) {
                var data = JSON.parse(res);
                $("#editPosisiKary").removeAttr('disabled');
                $("#refreshEditPosisi").removeAttr('disabled');
                $("#editPosisiKary").html(data.posisi);
                $("#txtEditPosisiKary").LoadingOverlay("hide");
                $.ajax({
                    type: "POST",
                    url: site_url + "posisi/get_auth_posisi_by_id",
                    data: {
                        id_posisi: idPosisi
                    },
                    success: function (res) {
                        let data = JSON.parse(res);
                        auth_posisi = data.auth_posisi;
                        $("#editPosisiKary").val(auth_posisi).trigger('change');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("Error!! " + idPosisi);
                        console.log(thrownError);
                    }
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#txtEditPosisiKary").LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data posisi, hubungi administrator");
                    $("#addSimpanPekerjaan").remove();
                }
            }
        });
    }

    $("#editDepartKary").change(function () {
        if (auth_depart != "") {
            $("#txtEditPosisiKary").LoadingOverlay("show");
            fetch_posisi();
        } else {
            $("#editPosisiKary").html('<option value="">-- WAJIB DIPILIH --</option>');
            $("#editPosisiKary").attr('disabled', true);
            $("#refreshPosisi").attr('disabled', true);
        }
    });

    // get all klasifikasi
    $.ajax({
        type: "POST",
        url: site_url + "klasifikasi/get_all",
        data: {},
        success: function (res) {
            var data = JSON.parse(res);
            $("#editKlasifikasiKary").html(data.kls);
            $("#txtEditKlasifikasiKary").LoadingOverlay("hide");
            $("#editKlasifikasiKary").val(idKlasifikasi).trigger('change');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#txtEditKlasifikasiKary").LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data klasifikasi, hubungi administrator");
            }
        }
    });

    // get all tipe
    $.ajax({
        type: "POST",
        url: site_url + "tipe/get_all",
        data: {},
        success: function (res) {
            var data = JSON.parse(res);
            $("#editTipeKary").html(data.tpe);
            $("#txtEditTipeKary").LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#txtEditTipeKary").LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data golongan karyawan, hubungi administrator");
            }
        }
    });

    // get auth tipe
    $.ajax({
        type: "POST",
        url: site_url + "tipe/get_auth_tipe_by_id",
        data: {
            id_tipe: idTipe
        },
        success: function (res) {
            let data = JSON.parse(res);
            auth_tipe = data.auth_tipe;
            $("#editTipeKary").val(auth_tipe).trigger('change');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("Error!! " + idTipe);
            console.log(thrownError);
        }
    });

    // get all level
    $.ajax({
        type: "POST",
        url: site_url + "level/get_all",
        data: {
            auth_per: idMasterPerusahaan
        },
        success: function (res) {
            var data = JSON.parse(res);
            $("#editLevelKary").html(data.lvl);
            $("#txtEditLevelKary").LoadingOverlay("hide");
            $("#editLevelKary").val(idLevel).trigger('change');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#txtEditLevelKary").LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data level, hubungi administrator");
            }
        }
    });

    // get auth Level
    $.ajax({
        type: "POST",
        url: site_url + "level/get_auth_Level_by_id",
        data: {
            id_level: idLevel
        },
        success: function (res) {
            let data = JSON.parse(res);
            auth_level = data.auth_level;
            $("#editLevelKary").val(auth_level).trigger('change');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("Error!! " + idLevel);
            console.log(thrownError);
        }
    });

    // get all POH
    $.ajax({
        type: "POST",
        url: site_url + "poh/get_all",
        data: {
            id_poh: idPOH
        },
        success: function (res) {
            var data = JSON.parse(res);
            $("#editPOHKary").html(data.pho);
            $("#txtEditPOHKary").LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#txtEditPOHKary").LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data Point Of Hire, hubungi administrator");
            }
        }
    });

    // get auth poh
    $.ajax({
        type: "POST",
        url: site_url + "poh/get_auth_poh_by_id",
        data: {
            id_poh: idPOH
        },
        success: function (res) {
            let data = JSON.parse(res);
            auth_poh = data.auth_poh;
            $("#editPOHKary").val(auth_poh).trigger('change');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("Error!! " + idPOH);
            console.log(thrownError);
        }
    });

    // get lokasi penerimaan
    $.ajax({
        type: "POST",
        url: site_url + "lokasipenerimaan/get_all",
        data: {
            id_poh: idLokterima
        },
        success: function (res) {
            var data = JSON.parse(res);
            $("#editLokterimaKary").html(data.lkt);
            $("#txtEditLokterimaKary").LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#txtEditLokterimaKary").LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data Lokasi Penerimaan, hubungi administrator");
            }
        }
    });

    // get auth lokasi penerimaan
    $.ajax({
        type: "POST",
        url: site_url + "lokasipenerimaan/get_auth_lokterima_by_id",
        data: {
            id_lokterima: idLokterima
        },
        success: function (res) {
            let data = JSON.parse(res);
            auth_lokterima = data.auth_lokterima;
            $("#editLokterimaKary").val(auth_lokterima).trigger('change');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("Error!! " + idlokter);
            console.log(thrownError);
        }
    });

    // get lokasi kerja
    $.ajax({
        type: "POST",
        url: site_url + "lokasikerja/get_all",
        data: {
            id_poh: idLokterima
        },
        success: function (res) {
            var data = JSON.parse(res);
            $("#editLokkerKary").html(data.lkr);
            $("#txteEditLokkerKary").LoadingOverlay("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#txtEditLokkerKary").LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data Lokasi Kerja, hubungi administrator");
            }
        }
    });

    // get auth lokasi kerja
    $.ajax({
        type: "POST",
        url: site_url + "lokasikerja/get_auth_lokker_by_id",
        data: {
            id_lokker: idLokker
        },
        success: function (res) {
            let data = JSON.parse(res);
            auth_lokker = data.auth_lokker;
            $("#editLokkerKary").val(auth_lokker).trigger('change');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("Error!! " + idlokter);
            console.log(thrownError);
        }
    });

    $("#editStatusResidence").val(valueStatTinggal).trigger('change');

    // get stat kerja
    $.ajax({
        type: "POST",
        url: site_url + "perjanjian/get_all",
        data: {},
        success: function (res) {
            var data = JSON.parse(res);
            $("#editStatusKerjaKary").html(data.janji);
            $("#txtEditLokkerKary").LoadingOverlay("hide");
            $("#editStatusKerjaKary").val(idStatPerjanjian).trigger('change');
            if (idStatPerjanjian == 1) {
                $("#editFieldPermanen").removeClass("d-none");
                $("#editFieldKontrakAwal").addClass("d-none");
                $("#editFieldKontrakAkhir").addClass("d-none");
            } else if (idStatPerjanjian == 2) {
                $("#editFieldPermanen").addClass("d-none");
                $("#editFieldKontrakAwal").removeClass("d-none");
                $("#editFieldKontrakAkhir").removeClass("d-none");
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#txtEditLokkerKary").LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data Status Perjanjian, hubungi administrator");
            }
        }
    });

    $("#editPerKary").change(function () {
        console.log("Halo :)");
    });
});