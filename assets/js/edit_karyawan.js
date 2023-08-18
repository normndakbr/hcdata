$(document).ready(function () {
    let auth_depart = "";
    let auth_posisi = "";
    let auth_tipe = "";
    let auth_level = "";
    let auth_lokterima = "";
    let auth_lokker = "";
    let initial_auth_per = $("#valuePerusahaan").val();
    let idPosisi = $("#valuePosisi").val();
    let idDepart = $("#valueDepart").val();
    let idTipe = $("#valueTipe").val();
    let idKlasifikasi = $("#valueKlasifikasi").val();
    let idLevel = $("#valueLevel").val();
    let idPOH = $("#valuePOH").val();
    let idLokterima = $("#valueLokterima").val();
    let idLokker = $("#valueLokker").val();
    let valueStatTinggal = $("#valueStatTinggal").val();
    let idStatPerjanjian = $("#valueStatPerjanjian").val();
    let flag_perusahaan = false;
    let flag_depart = false;
    let flag_posisi = false;
    let flag_tipe = false;
    let flag_level = false;
    let flag_poh = false;
    let flag_klasifikasi = false;
    let flag_lokterima = false;
    let flag_lokker = false;
    let flag_statResidence = false;
    let flag_statPerjanjian = false;

    if (!flag_perusahaan) {
        $("#editPerKary").val(initial_auth_per).trigger('change');
        flag_perusahaan = !flag_perusahaan;
    }

    function rollback_initial_value() {
        flag_perusahaan = false;
        flag_depart = false;
        flag_posisi = false;
        flag_tipe = false;
        flag_level = false;
        flag_poh = false;
        flag_klasifikasi = false;
        flag_lokterima = false;
        flag_lokker = false;
        flag_statResidence = false;
        flag_statPerjanjian = false;
    }

    function get_initial_value(jenis) {
        switch (jenis) {
            case "perusahaan":
                if (!flag_perusahaan) {
                    $("#editPerKary").val(initial_auth_per).trigger('change');
                    flag_perusahaan = !flag_perusahaan;
                }
                break;
            case "departemen":
                $.ajax({
                    type: "POST",
                    url: site_url + "departemen/get_auth_depart_by_id",
                    data: { id_depart: idDepart },
                    success: function (res) {
                        let data = JSON.parse(res);
                        auth_depart = data.auth_depart;
                        if (!flag_depart) {
                            $("#editDepartKary").val(auth_depart).trigger('change');
                            flag_depart = !flag_depart;
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("Error get auth depart by id");
                        console.log(thrownError);
                    }
                });
                break;
            case "posisi":
                $.ajax({
                    type: "POST",
                    url: site_url + "posisi/get_auth_posisi_by_id",
                    data: { id_posisi: idPosisi },
                    success: function (res) {
                        let data = JSON.parse(res);
                        auth_posisi = data.auth_posisi;
                        if (!flag_posisi) {
                            $("#editPosisiKary").val(auth_posisi).trigger('change');
                            flag_posisi = !flag_posisi;
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("Error get auth posisi by id");
                        console.log(thrownError);
                    }
                });
                break;
            case "klasifikasi":
                if (!flag_klasifikasi) {
                    $("#editKlasifikasiKary").val(idKlasifikasi).trigger('change');
                    flag_klasifikasi = !flag_klasifikasi;
                }
                break;
            case "tipe":
                $.ajax({
                    type: "POST",
                    url: site_url + "tipe/get_auth_tipe_by_id",
                    data: { id_tipe: idTipe },
                    success: function (res) {
                        let data = JSON.parse(res);
                        auth_tipe = data.auth_tipe;
                        if (!flag_tipe) {
                            $("#editTipeKary").val(auth_tipe).trigger('change');
                            flag_tipe = !flag_tipe;
                        }
                        // $("#editTipeKary").val(auth_tipe).trigger('change');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("Error get auth tipe by id");
                        console.log(thrownError);
                    }
                });
                break;
            case "level":
                $.ajax({
                    type: "POST",
                    url: site_url + "level/get_auth_Level_by_id",
                    data: { id_level: idLevel },
                    success: function (res) {
                        let data = JSON.parse(res);
                        auth_level = data.auth_level;
                        if (!flag_level) {
                            $("#editLevelKary").val(auth_level).trigger('change');
                            flag_level = !flag_level;
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("Error get auth level by id");
                        console.log(thrownError);
                    }
                });
                break;
            case "poh":
                $.ajax({
                    type: "POST",
                    url: site_url + "poh/get_auth_poh_by_id",
                    data: { id_poh: idPOH },
                    success: function (res) {
                        let data = JSON.parse(res);
                        auth_poh = data.auth_poh;
                        if (!flag_poh) {
                            $("#editPOHKary").val(auth_poh).trigger('change');
                            flag_poh = !flag_poh;
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("Error get auth POH by id");
                        console.log(thrownError);
                    }
                });
                break;
            case "lokterima":
                $.ajax({
                    type: "POST",
                    url: site_url + "lokasipenerimaan/get_auth_lokterima_by_id",
                    data: { id_lokterima: idLokterima },
                    success: function (res) {
                        let data = JSON.parse(res);
                        auth_lokterima = data.auth_lokterima;
                        if (!flag_lokterima) {
                            $("#editLokterimaKary").val(auth_lokterima).trigger('change');
                            flag_lokterima = !flag_lokterima;
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("Error get auth lokasi penerimaan by id");
                        console.log(thrownError);
                    }
                });
                break;
            case "lokker":
                $.ajax({
                    type: "POST",
                    url: site_url + "lokasikerja/get_auth_lokker_by_id",
                    data: { id_lokker: idLokker },
                    success: function (res) {
                        let data = JSON.parse(res);
                        auth_lokker = data.auth_lokker;
                        if (!flag_lokker) {
                            $("#editLokkerKary").val(auth_lokker).trigger('change');
                            flag_lokker = !flag_lokker;
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("Error get auth lokasi kerja by id");
                        console.log(thrownError);
                    }
                });
                break;
            case "statPerjanjian":
                if (!flag_statPerjanjian) {
                    $("#editStatusKerjaKary").val(idStatPerjanjian).trigger('change');
                    flag_statPerjanjian = !flag_statPerjanjian;
                }
                break;
            case "statResidence":
                if (!flag_statResidence) {
                    $("#editStatusResidence").val(valueStatTinggal).trigger('change');
                    flag_statResidence = !flag_statResidence;
                }
                break;
        }
    }

    function fetch_departemen() {
        $.ajax({
            type: "POST",
            url: site_url + "departemen/get_by_auth_m_per",
            data: { auth_m_per: initial_auth_per },
            success: function (res) {
                $("#txtEditDepartKary").LoadingOverlay("show");
                $("#txtEditPosisiKary").LoadingOverlay("show");
                var data = JSON.parse(res);
                $("#editDepartKary").html(data.dprt);
                $("#editDepartKary").removeAttr('disabled');
                $("#refreshEditDepart").removeAttr('disabled');
                $("#editPosisiKary").attr('disabled', true);
                $("#refreshEditPosisi").attr('disabled', true);
                $("#editPosisiKary").html('<option value ="">-- WAJIB DIPILIH --</option>');
                get_initial_value("departemen");
                if (initial_auth_per != "") {
                    $(".errorEditPerKary").html("");
                } else {
                    $(".errorEditPerKary").html("<p>Perusahaan wajib dipilih</p>");
                }
                $("#txtEditDepartKary").LoadingOverlay("hide");
                $("#txtEditPosisiKary").LoadingOverlay("hide");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#txtdepartkary").LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data departemen, hubungi administrator");
                    $("#editSimpanPekerjaan").remove();
                }
            }
        });
    }

    function fetch_posisi() {
        $.ajax({
            type: "POST",
            url: site_url + "posisi/get_by_authdepart",
            data: {
                auth_depart: auth_depart
            },
            success: function (res) {
                // $("#txtEditPosisiKary").LoadingOverlay("show");
                var data = JSON.parse(res);
                $("#editPosisiKary").removeAttr('disabled');
                $("#refreshEditPosisi").removeAttr('disabled');
                $("#editPosisiKary").html(data.posisi);
                get_initial_value("posisi");
                $("#txtEditPosisiKary").LoadingOverlay("hide");
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

    function fetch_klasifikasi() {
        $.ajax({
            type: "POST",
            url: site_url + "klasifikasi/get_all",
            data: {},
            success: function (res) {
                var data = JSON.parse(res);
                $("#editKlasifikasiKary").html(data.kls);
                $("#txtEditKlasifikasiKary").LoadingOverlay("hide");
                $("#refreshEditKlasifikasi").removeAttr('disabled');
                $("#infoEditKlasifikasi").removeAttr('disabled');
                get_initial_value("klasifikasi");
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
    }

    function fetch_tipe() {
        $.ajax({
            type: "POST",
            url: site_url + "tipe/get_all",
            data: {},
            success: function (res) {
                var data = JSON.parse(res);
                $("#editTipeKary").html(data.tpe);
                $("#refreshEditTipe").removeAttr('disabled');
                $("#txtEditTipeKary").LoadingOverlay("hide");
                get_initial_value("tipe");
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
    }

    function fetch_level() {
        $.ajax({
            type: "POST",
            url: site_url + "level/get_all",
            data: {
                auth_per: initial_auth_per
            },
            success: function (res) {
                var data = JSON.parse(res);
                $("#editLevelKary").html(data.lvl);
                $("#refreshEditLevel").removeAttr('disabled');
                $("#txtEditLevelKary").LoadingOverlay("hide");
                get_initial_value("level");
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
    }

    function fetch_poh() {
        $.ajax({
            type: "POST",
            url: site_url + "poh/get_all",
            data: {
                id_poh: idPOH
            },
            success: function (res) {
                var data = JSON.parse(res);
                $("#editPOHKary").html(data.pho);
                $("#refreshEditPOH").removeAttr('disabled');
                $("#txtEditPOHKary").LoadingOverlay("hide");
                get_initial_value("poh");
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
    }

    function fetch_lokasipenerimaan() {
        $.ajax({
            type: "POST",
            url: site_url + "lokasipenerimaan/get_all",
            data: {
                id_poh: idLokterima
            },
            success: function (res) {
                var data = JSON.parse(res);
                $("#editLokterimaKary").html(data.lkt);
                $("#refreshEditLokterima").removeAttr('disabled');
                $("#txtEditLokterimaKary").LoadingOverlay("hide");
                get_initial_value("lokterima");
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
    }

    function fetch_lokasikerja() {
        $.ajax({
            type: "POST",
            url: site_url + "lokasikerja/get_all",
            data: {
                id_poh: idLokterima
            },
            success: function (res) {
                var data = JSON.parse(res);
                $("#editLokkerKary").html(data.lkr);
                $("#refreshEditLokker").removeAttr('disabled');
                $("#txteEditLokkerKary").LoadingOverlay("hide");
                get_initial_value("lokker");
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
    }

    function fetch_statustinggal() {
        $.ajax({
            type: "POST",
            url: site_url+"karyawan/get_resident",
            success: function(data) {
                var data = JSON.parse(data);
                $("#editStatusResidence").html(data.tgl);
                $("#refreshEditResidence").removeAttr('disabled');
                $("#txtEditStatResidence").LoadingOverlay("hide");
                get_initial_value("statResidence");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data status tinggal, hubungi administrator");
                    $("#editSimpanPekerjaan").remove();
                }
            }
        });
    }

    function fetch_statPerjanjian() {
        $.ajax({
            type: "POST",
            url: site_url + "perjanjian/get_all",
            data: {},
            success: function (res) {
                var data = JSON.parse(res);
                $("#editStatusKerjaKary").html(data.janji);
                $("#refreshEditStatKaryawan").removeAttr('disabled');
                $("#editStatusKerjaKary").LoadingOverlay("hide");
                get_initial_value("statPerjanjian");
                if (idStatPerjanjian == 1) {
                    $("#editFieldPermanen").removeClass("d-none");
                    $("#editFieldKontrakAwal").addClass("d-none");
                    $("#editFieldKontrakAkhir").addClass("d-none");
                } else {
                    $("#editFieldPermanen").addClass("d-none");
                    $("#editFieldKontrakAwal").removeClass("d-none");
                    $("#editFieldKontrakAkhir").removeClass("d-none");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#editStatusKerjaKary").LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data status perjanjian, hubungi administrator");
                }
            }
        });
    }

    $("#editStatusKerjaKary").change(function () {
        let temp = $("#editStatusKerjaKary").val();
        if (temp == 1) {
            $("#editFieldPermanen").removeClass("d-none");
            $("#editFieldKontrakAwal").addClass("d-none");
            $("#editFieldKontrakAkhir").addClass("d-none");
        } else {
            $("#editFieldPermanen").addClass("d-none");
            $("#editFieldKontrakAwal").removeClass("d-none");
            $("#editFieldKontrakAkhir").removeClass("d-none");
        }
    });

    fetch_departemen();
    $("#editDepartKary").change(function () {
        if (flag_depart) {
            auth_depart = $("#editDepartKary").val();
        }

        if (auth_depart != "") {
            $("#txtEditPosisiKary").LoadingOverlay("show");
            fetch_posisi();
        } else {
            $("#editPosisiKary").html('<option value="">-- WAJIB DIPILIH --</option>');
            $("#editPosisiKary").attr('disabled', true);
            $("#refreshPosisi").attr('disabled', true);
        }
    });

    fetch_klasifikasi();
    fetch_tipe();
    fetch_level();
    fetch_poh();
    fetch_lokasipenerimaan();
    fetch_lokasikerja();
    fetch_statustinggal();
    fetch_statPerjanjian();

    $("#refreshEditDepart").click(() => {
        fetch_departemen();
    });

    $("#refreshEditPosisi").click(() => {
        fetch_posisi();
    });

    $("#refreshEditKlasifikasi").click(() => {
        fetch_klasifikasi();
    });

    $("#refreshEditTipe").click(() => {
        fetch_tipe();
    });

    $("#refreshEditLevel").click(() => {
        fetch_level();
    });

    $("#refreshEditPOH").click(() => {
        fetch_POH();
    });

    $("#refreshEditLokterima").click(() => {
        fetch_lokterima();
    });

    $("#refreshEditLokker").click(() => {
        fetch_lokker();
    });

    $("#refreshEditStatPerjanjian").click(() => {
        fetch_statPerjanjian();
    });

    $("#editSimpanPekerjaan").click(function () {
        // auth
        let auth_person = $("#valueAuthPersonal").val();
        let auth_kary = $("#valueAuthKaryawan").val();
        let id_kary = $("#valueIDKaryawan").val();
        let auth_ktr = $("#valueKontrakKary").val();

        // data karyawan
        let no_ktp = $("#editNoKTP").val();
        let no_kk = $("#editNoKK").val();
        let no_nik = $("#editNIKKary").val();
        let doh = $("#editDOH").val();
        let tgl_aktif = $("#editTanggalAktif").val();
        let auth_depart = $("#editDepartKary").val();
        let auth_posisi = $("#editPosisiKary").val();
        let auth_level = $("#editLevelKary").val();
        let auth_lokker = $("#editLokkerKary").val();
        let auth_lokterima = $("#editLokterimaKary").val();
        let auth_poh = $("#editPOHKary").val();
        let id_klasifikasi = $("#editKlasifikasiKary").val();
        let auth_tipe = $("#editTipeKary").val();
        let stat_tinggal = $("#editStatusResidence").val();
        let email_kantor = $("#editEmailKantor").val();
        let tgl_permanen = $("#editTanggalPermanen").val();
        let auth_m_perusahaan = $("#editPerKary").val();
        let stat_kerja = $("#editStatusKerjaKary").val();
        let tgl_mulai_kontrak = $("#editTanggalKontrakAwal").val();
        let tgl_akhir_kontrak = $("#editTanggalKontrakAkhir").val();
        let tgl_edit = $("#editTglEdit").val();

        swal({
            title: "Simpan Data",
            text: "Yakin data karyawan akan disimpan?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#36c6d3',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: 'Batalkan'
        }).then(function (result) {
            if (result.value) {
                $.LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: site_url + "karyawan/update_karyawan",
                    data: {
                        id_karyawan: id_kary,
                        auth_person: auth_person,
                        auth_kary: auth_kary,
                        auth_ktr: auth_ktr,
                        no_ktp: no_ktp,
                        no_kk: no_kk,
                        no_nik: no_nik,
                        auth_depart: auth_depart,
                        auth_posisi: auth_posisi,
                        auth_lokker: auth_lokker,
                        auth_lokterima: auth_lokterima,
                        auth_poh: auth_poh,
                        auth_tipe: auth_tipe,
                        auth_level: auth_level,
                        id_klasifikasi: id_klasifikasi,
                        doh: doh,
                        tgl_aktif: tgl_aktif,
                        stat_tinggal: stat_tinggal,
                        stat_kerja: stat_kerja,
                        email_kantor: email_kantor,
                        tgl_permanen: tgl_permanen,
                        tgl_mulai_kontrak: tgl_mulai_kontrak,
                        tgl_akhir_kontrak: tgl_akhir_kontrak,
                        auth_m_perusahaan: auth_m_perusahaan,
                        tgl_edit: tgl_edit,
                    },
                    success: function (res) {
                        console.log(res);
                        var data = JSON.parse(res);
                        if (data.statusCode == 204) {
                            swal("Berhasil", data.pesan, data.status);
                            $.LoadingOverlay("hide");
                            // } else if (data.statusCode == 201) {
                            //     $(".errmsgKary").removeClass('d-none');
                            //     $(".errmsgKary").removeClass('alert-primary');
                            //     $(".errmsgKary").addClass('alert-danger');
                            //     $(".errmsgKary").html(data.pesan);
                            //     $.LoadingOverlay("hide");
                        } else {
                            $(".errorEditNIKKary").html(data.no_nik);
                            $(".errorEditDepartKary").html(data.depart);
                            $(".errorEditPosisiKary").html(data.posisi);
                            $(".errorEditKlasifikasiKary").html(data.id_klasifikasi);
                            $(".errorEditPOHKary").html(data.id_poh);
                            $(".errorEditLokterimaKary").html(data.id_lokterima);
                            $(".errorEditLokasiKerja").html(data.id_lokker);
                            $(".errorEditLevelKary").html(data.id_level);
                            $(".errorEditStatusResidence").html(data.stat_tinggal);
                            $(".errorEditDOH").html(data.doh);
                            $(".errorEditTanggalAktif").html(data.tgl_aktif);
                            $(".errorEditTipeKaryawan").html(data.id_tipe);
                            $(".errorEditJenisKaryawan").html(data.stat_kerja);
                            $(".errorEditEmail").html(data.email_kantor);
                            $(".errorEditTanggalPermanen").html(data.pesan);
                            $(".errorEditTanggalKontrakAwal").html(data.pesan1);
                            $(".errorEditTanggalKontrakAkhir").html(data.pesan2);

                            swal("Error", data.pesan, data.status);
                            $.LoadingOverlay("hide");
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                        $.LoadingOverlay("hide");
                        $(".errmsgKary").removeClass('d-none');
                        $(".errmsgKary").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errmsgKary").html("Terjadi kesalahan saat memperbarui data karyawan, hubungi administrator");
                        }
                    }
                });
            }
        });
    });
});