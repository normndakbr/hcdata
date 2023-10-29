$(document).ready(function () {
    let token = $("#token").val();
    let authKary = $("#valueAuthKaryawan").val();
    let initial_id_sim = $("#valueIDSim").val();
    let editAuthSIM = "";
    let editJenisSIM = "";
    let jenisIzinTambang = $("#valueJenisIzinTambang").val();
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

    $(document).on('click', '.btnDetailIzinKaryawan', function () {
        $("#mdlDetailIzinKaryawan").modal("show");
    });

    $("#editJenisSIM").change(() => {
        editAuthSIM = $("#editJenisSIM").val();
        $.ajax({
            type: "POST",
            url: site_url + "sim/get_id_sim_by_auth",
            data: { auth_sim: editAuthSIM },
            success: function (res) {
                console.log("Success POST on " + site_url + "sim/get_id_sim_by_auth");
                let data = JSON.parse(res);
                editJenisSIM = data.id_sim;
                console.log("Edit jenis SIM = " + editJenisSIM);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("Error POST on " + site_url + "sim/get_id_sim_by_auth");
                console.log(thrownError);
            }
        });
    });

    $("#editSimpanIzin").click(() => {
        let auth_sim = editAuthSIM;
        let jenisIzin = jenisIzinTambang;
        let noRegistrasiIzin = $("#editNoReg").val();
        let tglExpiredIzin = $("#editTglExp").val();
        let idJenisSIM = "";
        let tglExpiredSIM = "";

        if (jenisIzin == 'SIMPER') {
            idJenisSIM = editJenisSIM;
            tglExpiredSIM = editTglExpSIM;
        }
        let formData = new FormData();

        if (!auth_sim) {
            swal("Perhatian", "Jenis SIM wajib dipilih!", "error");
        } else if (!editNoReg) {
            swal("Perhatian", "No. Registrasi tidak boleh kosong!", "error");
        } else if (!editTglExp) {
            swal("Perhatian", "Tanggal Expired Simper/Mine Permit tidak boleh kosong!", "error");
        } else if (!editTglExpSim) {
            swal("Perhatian", "Tanggal Expired SIM tidak boleh kosong!", "error");
        } else {
            $.ajax({
                type: "POST",
                url: site_url + "sim/get_id_sim_by_auth",
                data: { auth_sim: auth_sim },
                success: function (res) {
                    console.log("Success POST on " + site_url + "sim/get_id_sim_by_auth");
                    let data = JSON.parse(res);
                    editJenisSim = data.id_sim;

                    console.log("authKary => " + authKary);
                    console.log("jenisIzin => " + jenisIzin);
                    console.log("editNoReg => " + noRegistrasiIzin);
                    console.log("editTglExp => " + tglExpiredIzin);
                    console.log("idJenisSIM => " + idJenisSIM);
                    console.log("editTglExpSIM => " + tglExpiredSIM);

                    formData.append("token", token);
                    formData.append("authKary", authKary);
                    formData.append("jenisIzin", jenisIzin);
                    formData.append("editNoReg", editNoReg);
                    formData.append("editTglExp", editTglExp);
                    formData.append("editJenisSIM", idJenisSIM);
                    formData.append("editTglExpSIM", tglExpiredSIM);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log("Error POST on " + site_url + "sim/get_id_sim_by_auth");
                    console.log(thrownError);
                }
            });
            // $.ajax({
            //     type: "POST",
            //     url: site_url + "karyawan/editSimper",
            //     data: formData,
            //     success: function (res) {
            //         console.log("Success POST on " + site_url + "sim/editSimper");
            //         let data = JSON.parse(res);
            //         console.log(data);
            //     },
            //     error: function (xhr, ajaxOptions, thrownError) {
            //         console.log("Error POST on " + site_url + "sim/editSimper");
            //         console.log(thrownError);
            //     }
            // });
        }
    });
});