$(document).ready(function () {
    let token = $("#token").val();
    let authKary = $("#valueAuthKaryawan").val();
    let authIzinTambang = $("#valueAuthIzin").val();
    let authPerson = $("#valueAuthPerson").val();
    let flag_SIM = false;
    let initial_jenis_izin = $("#valueJenisIzinTambang").val();
    let jenis_izin_tambang = $("#editJenisIzin").val();
    let flag_izin_tambang = false;
    let id_sim = $("#valueIDSim").val();
    let auth_sim = "";

    if (!flag_izin_tambang) {
        jenis_izin_tambang = $("#editJenisIzin").val();
        $("#editJenisIzin").val(initial_jenis_izin).trigger('change');
        flag_izin_tambang = !flag_izin_tambang;

        if ($("#editJenisIzin").val() == "SP") {
            fetch_sim();
            $("#fieldEditJenisSim").removeClass("d-none");
            $("#fieldEditExpiredSIM").removeClass("d-none");
            $("#fieldEditFileSimPolisi").removeClass("d-none");
            $("#tabelListUnit").removeClass("d-none");
        } else if ($("#editJenisIzin").val() == "MP") {
            $("#fieldEditJenisSim").addClass("d-none");
            $("#fieldEditExpiredSIM").addClass("d-none");
            $("#fieldEditFileSimPolisi").addClass("d-none");
            $("#tabelListUnit").addClass("d-none");
        }
    }

    $.ajax({
        type: "POST",
        url: site_url + "izin_tambang/get_all_unit",
        data: {
            token: token
        },
        success: function (res) {
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
                // $("#btnsimpanunitsimper").remove();
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

    function fetch_sim() {
        $.ajax({
            type: "POST",
            url: site_url + "sim/get_all",
            data: {},
            success: function (res) {
                var data = JSON.parse(res);
                $("#editJenisSIM").html(data.smm);
                $("#refreshEditJenisSIM").removeAttr('disabled');
                $("#txtEditIzinSIM").LoadingOverlay("hide");
                $.ajax({
                    type: "POST",
                    url: site_url + "sim/get_auth_sim_by_id",
                    data: { id_sim: id_sim },
                    success: function (res) {
                        let data = JSON.parse(res);
                        auth_sim = data.auth_sim;
                        if (!flag_SIM) {
                            $("#editJenisSIM").val(auth_sim).trigger('change');
                            flag_SIM = !flag_SIM;
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("Error get auth sim by id");
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
    }

    function add_unit_baru() {
        if ($("#editJenisIzin").val() == "SP") {
            let jenisIzin = $("#editJenisIzin").val();
            let noReg = $("#editNoReg").val();
            let tglExp = $("#editTglExp").val();
            let jenisSim = $("#editJenisSIM").val();
            let tglExpSim = $("#editTglExpSIM").val();
            let jenisUnit = $("#jenisUnitSimper").val();
            let tipeAkses = $("#tipeAksesUnit").val();

            if (authKary == "") {
                $(".errorMsgEditIzin").removeClass('d-none');
                $(".errorMsgEditIzin").removeClass('alert-info');
                $(".errorMsgEditIzin").addClass('alert-danger');
                $(".errorMsgEditIzin").html("Data karyawan tidak ditemukan");
            }

            if (jenisIzin == "") {
                errJenisIzin = "Jenis izin wajib dipilih";
            } else {
                errJenisIzin = "";
            }

            if (noReg == "") {
                errNoReg = "No. Registrasi izin wajib diisi";
            } else {
                errNoReg = "";
            }

            if (jenis_izin_tambang == "SP") {
                if (jenisSim == "") {
                    errJenisSim = "Jenis SIM wajib dipilih";
                } else {
                    errJenisSim = "";
                }
            } else {
                errJenisSim = "";
            }

            if (tglExpSim == "") {
                errTglExpSim = "Tanggal expired SIM wajib diisi";
            } else {
                errTglExpSim = "";
            }

            if (tglExp == "") {
                errTglExp = "Tanggal expired izin wajib diisi";
            } else {
                errTglExp = "";
            }

            if (errJenisIzin == "" && errNoReg == "" && errTglExp == "" && errJenisSim == "" && errTglExpSim == "") {
                $("#mdlunitsimper").modal("show");
                $("#refreshjenisUnitSimper").removeAttr('disabled');
                $("#refreshtipeAksesUnit").removeAttr('disabled');
            } else {
                $(".errorEditJenisIzin").html(errJenisIzin);
                $(".errorEditNoReg").html(errNoReg);
                $(".errorEditJenisSIM").html(errJenisSim);
                $(".errorEditTglExpSIM").html(errTglExpSim);
                $(".errorEditTglExp").html(errTglExp);
            }
        } else {
            $("#groupTbmUnitDetail").addClass("d-none");
        }
    }

    function save_unit_baru() {
        let auth_kary = authKary;
        let auth_izin = authIzinTambang;
        let auth_person = authPerson;
        // let auth_simpol = $(".j8234234b").text();
        let jenisizin = $("#addJenisIzin").val();
        let noreg = $("#addNoReg").val();
        let tglexp = $("#addTglExp").val();
        let jenissim = $("#addJenisSIM").val();
        let tglexpsim = $("#addTglExpSIM").val();
        let jenisunit = $("#jenisUnitSimper").val();
        let tipeakses = $("#tipeAksesUnit").val();
        let filesim = $("#filesimpolisi").val();
        const flsim = $('#filesimpolisi').prop('files')[0];

        // let formData = new FormData();
        // formData.append('filesimpolisi', flsim);
        // formData.append('filesim', filesim);
        // formData.append('jenisizin', jenisizin);
        // formData.append('noreg', noreg);
        // formData.append('tglexpsim', tglexpsim);
        // formData.append('tglexp', tglexp);
        // formData.append('jenissim', jenissim);
        // formData.append('jenisunit', jenisunit);
        // formData.append('auth_izin', auth_izin);
        // formData.append('auth_kary', auth_kary);
        // formData.append('auth_simpol', auth_simpol);
        // formData.append('auth_person', auth_person);
        // formData.append('tipeakses', tipeakses);
        // formData.append('token', token);

        // $.ajax({
        //     type: 'POST',
        //     url: site_url + "izin_tambang/add_unit_izin_tambang",
        //     data: formData,
        //     cache: false,
        //     processData: false,
        //     contentType: false,
        //     success: function (data) {
        //         var data = JSON.parse(data);
        //         if (data.statusCode == 200) {
        //             $("#jenisUnitSimper").val('').trigger('change');
        //             $("#tipeAksesUnit").val('').trigger('change');
        //             $(".errorjenisUnitSimper").text('');
        //             $(".errortipeAksesUnit").text('');
        //             $("#idizintambang").LoadingOverlay("show");
        //             $(".j8234234b").text(data.auth_simpol);
        //             $(".ecb14fe704e08d9df8e343030bbbafcb").text(data.auth_izin);
        //             $("#idizintambang").load(site_url + "izin_tambang/izin_tambang?auth_izin=" + data.auth_izin);
        //             swal('Berhasil', data.pesan, 'success');
        //         } else if (data.statusCode == 201) {
        //             swal('Error', data.pesan, 'error');
        //         } else {
        //             $(".errorjenisUnitSimper").html(data.jenisunit);
        //             $(".errortipeAksesUnit").html(data.tipeakses);
        //             $(".errorFilesimpolisi").html(data.tipeakses);
        //         }
        //     },
        //     error: function (xhr, ajaxOptions, thrownError) {
        //         $.LoadingOverlay("hide");
        //         $(".errormsg").removeClass('d-none');
        //         $(".errormsg").removeClass('alert-info');
        //         $(".errormsg").addClass('alert-danger');
        //         if (thrownError != "") {
        //             $(".errormsg").html("Terjadi kesalahan saat menyimpan unit hubungi administrator");
        //         }
        //     }
        // });
    }

    $("#editJenisIzin").change(function () {
        let temp = $("#editJenisIzin").val();

        if (temp == "SP") {
            $("#tabelSIMPOL").removeClass("d-none");
            $("#tabelListUnit").removeClass("d-none");
            fetch_sim();
        } else if (temp == "MP") {
            $("#tabelSIMPOL").addClass("d-none");
            $("#tabelListUnit").addClass("d-none");
        }
    });

    // if (jenis_izin_tambang != "") {
    //     $("#editJenisIzin").val(jenis_izin_tambang).trigger("change");
    // }

    $(document).on('click', '.btnDetailIzinKaryawan', function () {
        $("#mdlDetailIzinKaryawan").modal("show");
    });

    $("#editTambahUnit").click(() => {
        add_unit_baru();
    });
});