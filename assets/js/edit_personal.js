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
        console.log("refresh_kelurahan jalan!");
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
                    $("#addSimpanPersonal").remove();
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
                    $("#addSimpanPersonal").remove();
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

    $("#editSimpanPersonal").click(function () {
        // let auth_per = $("#editPerKary").val();
        // tb_personal
        let no_ktp_old = $("#valueNoKTPOld").val();
        let no_kk_old = $("#valueNoKKOld").val();
        let id_personal = $("#editIdPersonal").val();
        let new_no_ktp = $("#editNoKTP").val();
        let new_no_kk = $("#editNoKK").val();
        let new_nama_lengkap = $("#editNamaLengkap").val();
        let new_jk = $("#editJenisKelamin").val();
        let new_tmp_lahir = $("#editTempatLahir").val();
        let new_tgl_lahir = $("#editTanggalLahir").val();
        let new_id_stat_nikah = $("#editStatPernikahan").val();
        let new_id_agama = $("#editAgama").val();
        let new_warga_negara = $("#editKewarganegaraan").val();
        let new_email_pribadi = $('#editEmail').val();
        let new_hp1 = $('#editNoTelp').val();
        let new_no_bpjstk = $("#editNoBPJSTK").val();
        let new_no_bpjskes = $("#editNoBPJSKES").val();
        let new_no_npwp = $('#editNoNPWP').val();
        let new_id_pendidikan = $('#editPendidikanTerakhir').val();
        let tgl_buat = $("#editTglBuat").val();
        let new_tgl_edit = $("#editTglEdit").val();
        let id_user = $("#idUser").val();

        // tb_alamat_ktp
        let alamat = $("#editAlamatKTP").val();
        let rt = $("#editRtKTP").val();
        let rw = $("#editRwKTP").val();
        let id_prov = $("#editProvData").val();
        let id_kab = $("#editKotaData").val();
        let id_kec = $("#editKecData").val();
        let id_kel = $("#editKelData").val();

        // console.log("auth per = " + auth_per);
        // console.log("id_personal = " + id_personal);
        // console.log("no_ktp = " + new_no_ktp);
        // console.log("no_kk = " + new_no_kk);
        // console.log("nama_lengkap = " + new_nama_lengkap);
        // console.log("jk  = " + new_jk);
        // console.log("tmp_lahir = " + new_tmp_lahir);
        // console.log("tgl_lahir = " + new_tgl_lahir);
        // console.log("id_stat_nikah = " + new_id_stat_nikah);
        // console.log("id_agama = " + new_id_agama);
        // console.log("warga_negara = " + new_warga_negara);
        // console.log("email_pribadi = " + new_email_pribadi);
        // console.log("hp_1 = " + new_hp1);
        // console.log("no_bpjstk = " + new_no_bpjstk);
        // console.log("no_bpjskes = " + new_no_bpjskes);
        // console.log("no_npwp = " + new_no_npwp);
        // console.log("id_pendidikan = " + new_id_pendidikan);
        // console.log("tgl_buat = " + tgl_buat);
        // console.log("tgl_edit = " + new_tgl_edit);
        // console.log("id_user = " + id_user);
        // console.log("id_alamat_ktp = " + id_alamat_ktp);
        // console.log("alamat_ktp = " + alamat);
        // console.log("rt_ktp = " + rt);
        // console.log("rw_ktp = " + rw);
        // console.log("kel_ktp = " + id_kel);
        // console.log("kec_ktp = " + id_kec);
        // console.log("kab_ktp = " + id_kab);
        // console.log("prov_ktp = " + id_prov);
        // console.log("Cek Log = " + cek_log);

        $.ajax({
            type: "POST",
            url: site_url + "karyawan/edit_personal",
            data: {
                no_ktp_old: no_ktp_old,
                no_kk_old: no_kk_old,
                id_personal: id_personal,
                no_ktp: new_no_ktp,
                no_kk: new_no_kk,
                nama_lengkap: new_nama_lengkap,
                nama_alias: "",
                jk: new_jk,
                tmp_lahir: new_tmp_lahir,
                tgl_lahir: new_tgl_lahir,
                id_stat_nikah: new_id_stat_nikah,
                id_agama: new_id_agama,
                warga_negara: new_warga_negara,
                email_pribadi: new_email_pribadi,
                hp_1: new_hp1,
                hp_2: "",
                nama_ibu: "",
                stat_ibu: "",
                nama_ayah: "",
                stat_ayah: "",
                no_bpjstk: new_no_bpjstk,
                no_bpjskes: new_no_bpjskes,
                no_bpjspensiun: "",
                no_equity: "",
                no_npwp: new_no_npwp,
                id_pendidikan: new_id_pendidikan,
                nama_sekolah: "",
                fakultas: "",
                jurusan: "",
                url_pendukung: "",
                tgl_buat: tgl_buat,
                tgl_edit: new_tgl_edit,
                id_user: id_user,
            },
            success: function (res) {
                $.LoadingOverlay("show");
                console.log(res);
                var data = JSON.parse(res);
                if (data.statusCode == 204) {
                    swal("Sukses", data.pesan, "success");
                    $.LoadingOverlay("hide");
                } else if (data.statusCode == 403) {
                    swal("Gagal", data.pesan, "error");
                    window.scrollTo(0, 0);
                    $.LoadingOverlay("hide");
                }
                //     // $('#colKaryawan').collapse("show");
                //     // $('#colPersonal').collapse("hide");
                //     // $('#imgPersonal').removeClass("d-none");
                //     $('.noktpshow').val(noktp);
                //     $('.namalengkapshow').val(nama);
                //     $(".89kjm78ujki782m4x787909h3").text(cek_log);
                //     aktifKaryawan();
                // } else if (data.statusCode == 201) {
                //     swal("Error", data.pesan, "error");
                // } else {
                //     $(".errorNoKTP").html(data.noktp);
                //     $(".errorNamaLengkap").html(data.nama);
                //     $(".errorAlamatKTP").html(data.alamat);
                //     $(".errorRtKTP").html(data.rt);
                //     $(".errorRwKTP").html(data.rw);
                //     $(".errorProvData").html(data.id_prov);
                //     $(".errorKotaData").html(data.id_kab);
                //     $(".errorKecData").html(data.id_kec);
                //     $(".errorKelData").html(data.id_kel);
                //     $(".errorTempatLahir").html(data.tmp_lahir);
                //     $(".errorTanggalLahir").html(data.tgl_lahir);
                //     $(".errorStatPernikahan").html(data.stat_nikah);
                //     $(".errorAddAgama").html(data.id_agama);
                //     $(".erroremail").html(data.email);
                //     $(".errornoTelp").html(data.notelp);
                //     $(".errorKewarganegaraan").html(data.warga);
                //     $(".errorJenisKelamin").html(data.jk);
                //     $(".errorNoBPJSTK").html(data.bpjs_tk);
                //     $(".errorNoBPJSKES").html(data.bpjs_kes);
                //     $(".errorNoNPWP").html(data.npwp);
                //     $(".errorNoKK").html(data.nokk);
                //     swal("Error", "Tidak dapat melanjutkan, lengkapi data personal.", "error");
                //     window.scrollTo(0, 0);
                // }
                $.LoadingOverlay("hide");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                console.log(xhr);
                console.log(ajaxOptions);
                $(".errormsg").removeClass('d-none');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    console.log(thrownError);
                    $(".errormsg").html("Terjadi kesalahan saat menyimpan data personal, hubungi administrator");
                }
                swal("Error", "Terjadi kesalahan saat menyimpan data personal.", "error");
            }
        });

        // $(".errormsg").fadeTo(3000, 500).slideUp(500, function () {
        //     $(".errormsg").slideUp(500);
        //     $(".errormsg").addClass("d-none");
        // });
    });
});