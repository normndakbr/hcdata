$(document).ready(function () {
    let token = $("#token").val();
    let authKary = $("#valueAuthKaryawan").val();
    let initial_id_sim = $("#valueIDSim").val();
    let editAuthSIM = "";
    let editJenisSIM = "";
    let jenisIzinTambang = $("#valueJenisIzinTambang").val();

    let no_reg_mine_permit = "";
    let no_reg_simper = "";
    let tgl_expired_mine_permit = "";
    let tgl_expired_simper = "";

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
        let idIzinTambang = $("#valueIDIzinTambang").val();
        let idJenisIzin = $("#valueIDJenisIzinTambang").val();
        let urlIzinTambang = $("#valueUrlIzinTambang").val();
        let urlSimKary = $("#valueUrlSimKary").val();
        let auth_sim = editAuthSIM;
        let jenisIzin = jenisIzinTambang;
        let noRegistrasiIzin = $("#editNoReg").val();
        let tglExpiredIzin = $("#editTglExp").val();
        let idJenisSIM = "";
        let tglExpiredSIM = "";
        let tglBuatIzinTambang = $("#valueTglBuatIzinTambang").val();
        let tglBuatSimKary = $("#valueTglBuatSimKary").val();

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
                    idIzinTambang: idIzinTambang,
                    idJenisIzin: idJenisIzin,
                    jenisIzin: jenisIzin,
                    editNoReg: noRegistrasiIzin,
                    editTglExp: tglExpiredIzin,
                    editJenisSIM: idJenisSIM,
                    editTglExpSIM: tglExpiredSIM,
                    tglBuatIzinTambang: tglBuatIzinTambang,
                    tglBuatSimKary: tglBuatSimKary
                },
                success: function (res) {
                    console.log("Success POST on " + site_url + "karyawan/editSimper");
                    let data = JSON.parse(res);
                    if (data.statusCode == 400) {
                        addFormValidation(data.errorNoRegistrasi, data.errorTglExpIzin, data.errorJenisSIM, data.errorTglExpSIM);
                    } else if (data.statusCode == 204) {
                        clearFormValidation();
                        swal("Berhasil", data.message, "success");
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

    $("#btnReuploadMinePermit").click(() => {
        $("#mdlUploadUlangIzinTambang").modal("show");
        $("#captionLblUploadUlangIzinTambang").text("Upload File Mine Permit");
        $("#jdlMdlUploadUlangIzinTambang").text("Upload Ulang File Mine Permit");
        $("#captionMdlUploadUlangIzinTambang").text("Catatan : Upload file Mine Permit dalam format pdf, ukuran file maksimal 1 Mb.");
        $("#btnEditReuploadMINEPERMIT").removeClass("d-none");
        $("#btnEditReuploadSIMPER").addClass("d-none");
        $("#btnEditReuploadSIM").addClass("d-none");
    });

    $("#btnReuploadSimper").click(() => {
        $("#mdlUploadUlangIzinTambang").modal("show");
        $("#captionLblUploadUlangIzinTambang").text("Upload File SIMPER");
        $("#jdlMdlUploadUlangIzinTambang").text("Upload Ulang File SIMPER");
        $("#captionMdlUploadUlangIzinTambang").text("Catatan : Upload file SIMPER dalam format pdf, ukuran file maksimal 1 Mb.");
        $("#btnEditReuploadMINEPERMIT").addClass("d-none");
        $("#btnEditReuploadSIMPER").removeClass("d-none");
        $("#btnEditReuploadSIM").addClass("d-none");
    });

    $("#btnReuploadSIM").click(() => {
        $("#mdlUploadUlangIzinTambang").modal("show");
        $("#captionLblUploadUlangIzinTambang").text("Upload File SIM");
        $("#jdlMdlUploadUlangIzinTambang").text("Upload Ulang File SIM");
        $("#captionMdlUploadUlangIzinTambang").text("Catatan : Upload file SIM dalam format pdf, ukuran file maksimal 1 Mb.");
        $("#btnEditReuploadMINEPERMIT").addClass("d-none");
        $("#btnEditReuploadSIMPER").addClass("d-none");
        $("#btnEditReuploadSIM").removeClass("d-none");
    });

    function reuploadFileIzin(jenis, data) {
        let jenisIzin = jenis;
        let newData = data;

        // newData.forEach(function (value, key) {
        //     console.log(key, value);
        // });

        swal({
            title: "Upload Ulang " + jenisIzin,
            text: "File " + jenisIzin + " yang lama akan diganti dengan file yang baru, anda yakin?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#36c6d3",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, upload",
            cancelButtonText: "Batalkan",
        }).then(function (result) {
            if (result.value) {
                $.LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: site_url + "karyawan/uploadUlangFileIzin",
                    data: newData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log("Success POST on " + site_url + "karyawan/uploadUlangFileIzin");
                        var data = JSON.parse(data);
                        // console.log(data);
                        if (data.statusCode == 200) {
                            swal("Upload File Berhasil", data.message, data.status);
                            $("#mdlUploadUlangIzinTambang").modal("hide");
                            $(".errorFileReuploadIzin").text("");
                            $("#fileReuploadIzin").val('');
                            $.LoadingOverlay("hide");
                        } else if (data.statusCode == 400) {
                            swal("Error", data.message, data.status);
                            $(".errorFileReuploadIzin").text(data.message);
                            $.LoadingOverlay("hide");
                        } else {
                            swal("Terjadi Kesalahan", data.message, data.status);
                            $(".errorFileReuploadIzin").text(data.message);
                            $.LoadingOverlay("hide");
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("Failed POST on " + site_url + "karyawan/uploadUlangFileIzin");
                        $.LoadingOverlay("hide");
                        $(".errorReuploadIzin").removeClass("d-none");
                        $(".errorReuploadIzin").addClass("alert-danger");
                        if (thrownError != "") {
                            $(".errorReuploadIzin").html(
                                "Terjadi kesalahan saat meng-upload file, hubungi administrator"
                            );
                        }
                    },
                });
            } else {
                swal.close();
            }
        });
    }

    $("#btnSaveReuploadSIM").click(function () {
        let jenisIzin = "SIM";
        let auth_sim = editAuthSIM;
        let auth_kary = $("#valueAuthKaryawan").val();
        let newFile = $("#valueUrlSIMPolisi").val();
        const fileSIM = $("#fileReuploadIzin").prop("files")[0];

        let formData = new FormData();
        formData.append("auth_kary", auth_kary);
        formData.append("jenis_izin", jenisIzin);
        formData.append("auth_izin", auth_sim);
        formData.append("fileName", newFile);
        formData.append("file", fileSIM);

        if (newFile == "") {
            $(".errorFileReuploadIzin").text("File SIM baru wajib dipilih");
            return false;
        } else {
            $(".errorFileReuploadIzin").text("");
        }

        reuploadFileIzin("SIM", formData);
    });

    $("#btnSaveReuploadSIMPER").click(function () {
        let jenisIzin = "SIMPER";
        let auth_simper = $("#valueAuthSIMPER").val();
        let auth_kary = $("#valueAuthKaryawan").val();
        let newFile = $("#valueUrlSIMPER").val();
        const fileSIMPER = $("#fileReuploadIzin").prop("files")[0];

        let formData = new FormData();
        formData.append("auth_kary", auth_kary);
        formData.append("jenis_izin", jenisIzin);
        formData.append("auth_izin", auth_simper);
        formData.append("fileName", newFile);
        formData.append("file", fileSIMPER);

        if (newFile == "") {
            $(".errorFileReuploadIzin").text("File SIMPER baru wajib dipilih");
            return false;
        } else {
            $(".errorFileReuploadIzin").text("");
        }

        reuploadFileIzin("SIMPER", formData);
    });

    $("#btnSaveReuploadMINEPERMIT").click(function () {
        let jenisIzin = "MINEPERMIT";
        let auth_mine_permit = $("#valueAuthMINEPERMIT").val();
        let auth_kary = $("#valueAuthKaryawan").val();
        let newFile = $("#valueUrlMINEPERMIT").val();
        const fileSIM = $("#fileReuploadIzin").prop("files")[0];

        let formData = new FormData();
        formData.append("auth_kary", auth_kary);
        formData.append("jenis_izin", jenisIzin);
        formData.append("auth_izin", auth_mine_permit);
        formData.append("fileName", newFile);
        formData.append("file", fileSIM);

        if (newFile == "") {
            $(".errorFileReuploadIzin").text("File MINE PERMIT baru wajib dipilih");
            return false;
        } else {
            $(".errorFileReuploadIzin").text("");
        }

        reuploadFileIzin("MINE PERMIT", formData);
    });

    $("#btnEditMinePermit").click(() => {
        no_reg_mine_permit = $("#valueNoRegMINEPERMIT").val();
        tgl_expired_mine_permit = $("#valueTglExpiredMINEPERMIT").val();
        $("#mdlEditIzinTambang").modal("show");
        $("#jdlEditIzinTambang").text("Edit Detail Mine Permit");
        $("#captionEditNoRegIzin").text("Nomor Registrasi MINE PERMIT");
        $("#captionEditTanggalExpired").text("Tanggal Expired MINE PERMIT");
        $("#editNoRegIzin").val(no_reg_mine_permit);
        $("#editTanggalExpired").val(tgl_expired_mine_permit);
        $("#fieldEditNoRegIzin").removeClass("d-none");
        $("#fieldEditJenisSIM").addClass("d-none");
        $("#btnSaveEditMINEPERMIT").removeClass("d-none");
        $("#btnSaveEditSIMPER").addClass("d-none");
        $("#btnSaveEditSIM").addClass("d-none");
    });

    $("#btnEditSimper").click(() => {
        no_reg_simper = $("#valueNoRegSIMPER").val();
        tgl_expired_simper = $("#valueTglExpiredSIMPER").val();
        $("#mdlEditIzinTambang").modal("show");
        $("#jdlEditIzinTambang").text("Edit Detail Simper");
        $("#captionEditNoRegIzin").text("Nomor Registrasi SIMPER");
        $("#captionEditTanggalExpired").text("Tanggal Expired SIMPER");
        $("#editNoRegIzin").val(no_reg_simper);
        $("#editTanggalExpired").val(tgl_expired_simper);
        $("#fieldEditNoRegIzin").removeClass("d-none");
        $("#fieldEditJenisSIM").addClass("d-none");
        $("#btnSaveEditMINEPERMIT").addClass("d-none");
        $("#btnSaveEditSIMPER").removeClass("d-none");
        $("#btnSaveEditSIM").addClass("d-none");
    });

    $("#btnEditSIM").click(() => {
        let tgl_expired = $("#valueTglExpiredSimKary").val();

        $("#mdlEditIzinTambang").modal("show");
        $("#jdlEditIzinTambang").text("Edit detail SIM Polisi");
        $("#captionEditTanggalExpired").text("Tanggal Expired SIM Polisi");
        $("#editTanggalExpired").val(tgl_expired);
        $("#fieldEditNoRegIzin").addClass("d-none");
        $("#fieldEditJenisSIM").removeClass("d-none");
        $("#btnSaveEditMINEPERMIT").addClass("d-none");
        $("#btnSaveEditSIMPER").addClass("d-none");
        $("#btnSaveEditSIM").removeClass("d-none");
    });

    $("#btnSaveEditMINEPERMIT").click(() => {
        let auth_mine_permit = $("#valueIDIzinTambang").val();
        let no_reg = $("#editNoReg").val();
        let tgl_exp = $("#editTglExp").val();

        $.ajax({
            type: "POST",
            url: site_url + "karyawan/editSimper",
            data: {
                jenisIzin: "MINEPERMIT",
                token: token,
                authKary: authKary,
                auth_izin_tambang: auth_mine_permit,
                noReg: no_reg,
                tglExp: tgl_exp,
            },
            success: function (res) {
                console.log(data);
                console.log("Success POST on " + site_url + "karyawan/editSimper");
                let data = JSON.parse(res);
                if (data.statusCode == 400) {
                    addFormValidation(data.errorNoRegistrasi, data.errorTglExpIzin, data.errorJenisSIM, data.errorTglExpSIM);
                } else if (data.statusCode == 204) {
                    clearFormValidation();
                    swal("Berhasil", data.message, "success");
                } else {
                    clearFormValidation();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("Error POST on " + site_url + "karyawan/editSimper");
                console.log(thrownError);
            }
        });
    });

    $("#btnSaveEditSIMPER").click(() => {
        console.log("Simpan Edit SIMPER");
    });

    $("#btnSaveEditSIM").click(() => {
        console.log("Simpan Edit SIM");
    });
});