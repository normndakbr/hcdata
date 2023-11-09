$(document).ready(function () {
    let token = $("#token").val();
    let authKary = $("#valueAuthKaryawan").val();
    let initial_id_sim = $("#valueIDSim").val();
    let editAuthSIM = "";
    let editJenisSIM = "";
    let jenisIzinTambang = $("#valueJenisIzinTambang").val();
    let idJenisIzinTambang = $("#valueIDJenisIzinTambang").val();
    let editTglExpSIM = $("#editTglExpSim").val();


    $.ajax({
        type: "POST",
        url: site_url + "izin_tambang/get_all_unit",
        data: {
            token: token
        },
        success: function (res) {
            console.log("Success POST on " + site_url + "izin_tambang/get_all_unit");
            var data = JSON.parse(res);
            $("#jenisUnitSimper").html(data.unit);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormdlsimper").removeClass('d-none');
            $(".errormdlsimper").removeClass('alert-info');
            $(".errormdlsimper").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormdlsimper").html("Terjadi kesalahan saat load data unit simper, hubungi administrator");
            }
        }
    });

    $.ajax({
        type: "POST",
        url: site_url + "izin_tambang/get_all_akses",
        data: {
            token: token,
        },
        success: function (res) {
            console.log("Success POST on " + site_url + "izin_tambang/get_all_akses");
            var data = JSON.parse(res);
            $("#tipeAksesUnit").html(data.akses);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormdlsimper").removeClass('d-none');
            $(".errormdlsimper").removeClass('alert-info');
            $(".errormdlsimper").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormdlsimper").html("Terjadi kesalahan saat load data unit simper, hubungi administrator");
                $("#btnsimpanunitsimper").remove();
            }
        }
    });

    $.ajax({
        type: "POST",
        url: site_url + "sim/get_all",
        data: {},
        success: function (res) {
            console.log("Success POST on " + site_url + "sim/get_all");
            var data = JSON.parse(res);
            $("#editJenisSIM").html(data.smm);
            $("#refreshEditJenisSIM").removeAttr('disabled');
            $("#txtEditIzinSIM").LoadingOverlay("hide");
            $.ajax({
                type: "POST",
                url: site_url + "sim/get_auth_sim_by_id",
                data: { id_sim: initial_id_sim },
                success: function (res) {
                    console.log(res);
                    console.log("Success POST on " + site_url + "sim/get_auth_sim_by_id");
                    let data = JSON.parse(res);
                    editAuthSIM = data.auth_sim;
                    $("#editJenisSIM").val(data.auth_sim).trigger('change');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#txtEditIzinSIM").LoadingOverlay("hide");
            $(".errormsg").removeClass('d-none');
            $(".errormsg").removeClass('alert-info');
            $(".errormsg").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsg").html("Terjadi kesalahan saat load data SIM, hubungi administrator");
            }
        }
    });

    function clearFormValidation() {
        $(".errorEditNoReg").html("");
        $(".errorEditTglExp").html("");
        $(".errorEditJenisSIM").html("");
        $(".errorEditTglExpSIM").html("");
        $(".errorEditJenisSIM").html("");
    }

    function addFormValidation(errorNoRegistrasi, errorTglExpIzin, errorJenisSIM, errorTglExpSIM) {
        $(".errorEditNoReg").html(errorNoRegistrasi);
        $(".errorEditTglExp").html(errorTglExpIzin);
        $(".errorEditJenisSIM").html(errorJenisSIM);
        $(".errorEditTglExpSIM").html(errorTglExpSIM);
    }

    $(document).on('click', '.btnDetailIzinKaryawan', function () {
        $("#mdlDetailIzinKaryawan").modal("show");
    });

    $("#editJenisSIM").change(() => {
        editAuthSIM = $("#editJenisSIM").val();
        if (!editAuthSIM) {
            swal({ title: "Perhatian", text: "Data jenis SIM wajib dipilih apabila jenis dokumen adalah SIMPER", type: 'warning' });
            $(".errorEditJenisSIM").html('Jenis SIM wajib dipilih');
        } else {
            $.ajax({
                type: "POST",
                url: site_url + "sim/get_id_sim_by_auth",
                data: { auth_sim: editAuthSIM },
                success: function (res) {
                    console.log("Success POST on " + site_url + "sim/get_id_sim_by_auth");
                    let data = JSON.parse(res);
                    if (data.statusCode == 200) {
                        editJenisSIM = data.id_sim;
                        $(".errorEditJenisSIM").html('');
                    } else {
                        swal({ title: "Error", text: "Terjadi kesalahan saat memlih data SIM, silahkan hubungi administrator.", type: 'error' });
                        console.log("Error POST on " + site_url + "sim/get_id_sim_by_auth");
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log("Error POST on " + site_url + "sim/get_id_sim_by_auth");
                    console.log(thrownError);
                }
            });
        }
    });

    $("#editSimpanIzin").click(() => {
        let auth_sim = editAuthSIM;
        let jenisIzin = jenisIzinTambang;
        let noRegistrasiIzin = $("#editNoReg").val();
        let tglExpiredIzin = $("#editTglExp").val();
        let idJenisSIM = "";
        let tglExpiredSIM = "";

        if (jenisIzin == 'SIMPER') {
            if (auth_sim) {
                idJenisSIM = editJenisSIM;
                tglExpiredSIM = $("#editTglExpSIM").val();
            } else {
                swal("Perhatian", "Jenis SIM wajib dipilih!", "error");
                $(".errorEditJenisSIM").html("Jenis SIM wajib dipilih");
            }
        }

        if (jenisIzin == 'SIMPER' && !auth_sim) {
            swal("Perhatian", "Jenis SIM wajib dipilih!", "error");
            $(".errorEditJenisSIM").html("Data jenis SIM wajib dipilih");
        } else {
            $.ajax({
                type: "POST",
                url: site_url + "karyawan/editSimper",
                data: {
                    token: token,
                    authKary: authKary,
                    idJenisIzin: idJenisIzinTambang,
                    jenisIzin: jenisIzin,
                    editNoReg: noRegistrasiIzin,
                    editTglExp: tglExpiredIzin,
                    editJenisSIM: idJenisSIM,
                    editTglExpSIM: tglExpiredSIM,
                },
                success: function (res) {
                    console.log("Success POST on " + site_url + "karyawan/editSimper");
                    let data = JSON.parse(res);
                    console.log(data);
                    if (data.statusCode == 400) {
                        addFormValidation(data.errorNoRegistrasi, data.errorTglExpIzin, data.errorJenisSIM, data.errorTglExpSIM);
                    } else if (data.statusCode == 204) {
                        console.log("Data has been updated successfully");
                        clearFormValidation();
                    } else {
                        clearFormValidation();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log("Error POST on " + site_url + "karyawan/editSimper");
                    console.log(thrownError);
                }
            });
        }
    });
});