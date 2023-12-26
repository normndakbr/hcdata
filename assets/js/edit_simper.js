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
        $("#captionMdlUploadUlangIzinTambang").text("Catatan : Upload file Mine Permit dalam format pdf, ukuran file maksimal 200 kb.");
        $("#btnEditReuploadMP").removeClass("d-none");
        $("#btnEditReuploadSMPR").addClass("d-none");
        $("#btnEditReuploadSIM").addClass("d-none");
    });

    $("#btnReuploadSimper").click(() => {
        $("#mdlUploadUlangIzinTambang").modal("show");
        $("#captionLblUploadUlangIzinTambang").text("Upload File SIMPER");
        $("#jdlMdlUploadUlangIzinTambang").text("Upload Ulang File SIMPER");
        $("#captionMdlUploadUlangIzinTambang").text("Catatan : Upload file SIMPER dalam format pdf, ukuran file maksimal 200 kb.");
        $("#btnEditReuploadMP").addClass("d-none");
        $("#btnEditReuploadSMPR").removeClass("d-none");
        $("#btnEditReuploadSIM").addClass("d-none");
    });

    $("#btnReuploadSIM").click(() => {
        $("#mdlUploadUlangIzinTambang").modal("show");
        $("#captionLblUploadUlangIzinTambang").text("Upload File SIM");
        $("#jdlMdlUploadUlangIzinTambang").text("Upload Ulang File SIM");
        $("#captionMdlUploadUlangIzinTambang").text("Catatan : Upload file SIM dalam format pdf, ukuran file maksimal 200 kb.");
        $("#btnEditReuploadMP").addClass("d-none");
        $("#btnEditReuploadSMPR").addClass("d-none");
        $("#btnEditReuploadSIM").removeClass("d-none");
    });

    function reuploadFileIzin(jenis, data) {
        let jenisIzin = jenis;
        let newData = data;

        newData.forEach(function (value, key) {
            console.log(key, value);
        });

        if (jenisIzin == "SIM") {
            swal({
                title: "Upload Ulang Surat Izin Mengemudi",
                text: "File SIM yang lama akan diganti dengan file yang baru, anda yakin?",
                type: "question",
                showCancelButton: true,
                confirmButtonColor: "#36c6d3",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, upload",
                cancelButtonText: "Batalkan",
            }).then(function (result) {
                console.log(result);
                if (result.value) {
                    // $.LoadingOverlay("show");
                    // $.ajax({
                    //     type: "POST",
                    //     url: site_url + "karyawan/uploadUlangFileIzin",
                    //     data: formData,
                    //     cache: false,
                    //     processData: false,
                    //     contentType: false,
                    //     success: function (data) {
                    //         var data = JSON.parse(data);
                    //         if (data.statusCode == 200) {
                    //             $("#mdluploadulangser").modal("hide");
                    //             $("#fileSertifikasiUlang").val("");
                    //             $(".errorFileSertifikasiUlang").text("");
                    //             $(".9f7fjmuj8ik2js4n8k66g3hjl323").text("");
                    //             $.LoadingOverlay("hide");
                    //             $("#idsertifikat").LoadingOverlay("show");
                    //             $("#idsertifikat").load(
                    //                 site_url + "karyawan/sertifikasi?auth_person=" + auth_person
                    //             );
                    //         } else if (data.statusCode == 201) {
                    //             $(".erruploadulangser").removeClass("d-none");
                    //             $(".erruploadulangser").removeClass("alert-primary");
                    //             $(".erruploadulangser").addClass("alert-danger");
                    //             $(".erruploadulangser").html(data.pesan);
                    //             $.LoadingOverlay("hide");
                    //         } else {
                    //             $(".errorFileSertifikasiUlang").html(data.pesan);
                    //             $.LoadingOverlay("hide");
                    //         }
                    //     },
                    //     error: function (xhr, ajaxOptions, thrownError) {
                    //         $.LoadingOverlay("hide");
                    //         $(".erruploadulangser").removeClass("d-none");
                    //         $(".erruploadulangser").addClass("alert-danger");
                    //         if (thrownError != "") {
                    //             $(".erruploadulangser").html(
                    //                 "Terjadi kesalahan saat meng-upload data sertifikat, hubungi administrator"
                    //             );
                    //         }
                    //     },
                    // });
                } else {
                    swal.close();
                }
            });
        } else if (jenisIzin == "SIMPER" || jenisIzin == "MINEPERMIT") {
            console.log("SIMPER / MINE PERMIT");
        }
    }

    $("#btnEditReuploadSIM").click(function () {
        let jenisIzin = "SIM";
        let auth_sim = editAuthSIM;
        let auth_kary = $("#valueAuthKaryawan").val();
        let auth_person = $("#valueAuthPersonal").val();
        let newFile = $("#fileReuploadIzin").val();
        const fileSIM = $("#fileReuploadIzin").prop("files")[0];

        let formData = new FormData();
        formData.append("jenisIzin", jenisIzin);
        formData.append("auth_sim", auth_sim);
        formData.append("auth_kary", auth_kary);
        formData.append("auth_person", auth_person);
        formData.append("newFile", newFile);
        formData.append("fileSIM", fileSIM);

        if (newFile == "") {
            $(".errorFileReuploadIzin").text("File baru wajib dipilih");
            return false;
        } else {
            $(".errorFileReuploadIzin").text("");
        }

        reuploadFileIzin("SIM", formData);
    });
});