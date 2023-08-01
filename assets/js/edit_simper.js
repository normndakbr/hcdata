$(document).ready(function () {
    let flag_SIM = false;
    let jenis_izin_tambang = $("#valueJenisIzinTambang").val();
    let id_sim = $("#valueIDSim").val();
    let auth_sim = "";

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

    // Ketika permasalahan dunia bertumpu dalam perspektif masing-masing.
    $("#editJenisIzin").change(() => {
        if ($("#editJenisIzin").val() == "SP") {
            $("#txtEditSIM").removeClass("d-none");
            fetch_sim();
        } else {
            $("#txtEditSIM").addClass("d-none");
        }
    });

    if (jenis_izin_tambang != "") {
        $("#editJenisIzin").val(jenis_izin_tambang).trigger("change");
    }

    $("#refreshEditJenisSIM").click(() => {
        fetch_sim();
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