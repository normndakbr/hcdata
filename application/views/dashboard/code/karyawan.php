<script>
    //========================================== karyawan ========================================================
    $(document).ready(function() {
        $(document).ready(function() {
            $("#logout").click(function() {
                $("#logoutmdl").modal("show");
            });

            $('#addNoNPWP').inputmask("99.999.999.9-999.999");

            $('#addNoNPWP').keyup(function(e) {
                let nonpwp = $('#addNoNPWP').val().trim();

                if (nonpwp != "") {
                    jmlnpwp = nonpwp.replace(/['.'|_|-]/g, '');
                    jml = jmlnpwp.length;

                    if (jml < 15) {
                        $('.errorAddNoNPWP').html('<p>No. NPWP minimal 15 karakter</p>');
                    } else {
                        $('.errorAddNoNPWP').html('');
                    }
                } else {
                    $('.errorAddNoNPWP').html('');
                }
            });

            $("#addStatusKary").change(function() {
                let currentStatusKary = $("#addStatusKary").val();

                if (currentStatusKary == "Permanen") {
                    $("#addFieldKontrakAwal").addClass('d-none');
                    $("#addFieldKontrakAkhir").addClass('d-none');
                    $("#addFieldPermanen").removeClass('d-none');
                } else {
                    $("#addFieldKontrakAwal").removeClass('d-none');
                    $("#addFieldKontrakAkhir").removeClass('d-none');
                    $("#addFieldPermanen").addClass('d-none');
                }
            });

            $("#domStatusResidence").change(function() {
                let domStatusResidence = $("#domStatusResidence").val();

                if (domStatusResidence == "R") {
                    $("#addFieldNonResidence").addClass('d-none');
                    $("#addFieldResidence").removeClass('d-none');
                } else {
                    $("#addFieldNonResidence").removeClass('d-none');
                    $("#addFieldResidence").addClass('d-none');
                }
            });

            $.ajax({
                type: "POST",
                url: "<?= base_url("perusahaan/get_all") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addPerKary").html(data.prs);
                    $('#addPerKary').select2({
                        theme: 'bootstrap4'
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                        $("#btnTambahDepart").attr("disabled", true);
                    }
                }
            });

            $.ajax({
                type: "POST",
                url: "<?= base_url("daerah/get_prov") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#provAlmtKTP").html(data.prov);
                    $('#provAlmtKTP').select2({
                        theme: 'bootstrap4'
                    });
                    $("#provAlmtDom").html(data.prov);
                    $('#provAlmtDom').select2({
                        theme: 'bootstrap4'
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                        $("#btnTambahDepart").attr("disabled", true);
                    }
                }
            });

            $("#provAlmtKTP").change(function() {
                let id_prov = $("#provAlmtKTP").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('daerah/get_kab') ?>",
                    data: {
                        id_prov: id_prov
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#kabAlmtKTP").removeAttr('disabled');
                        $("#kabAlmtKTP").html(data.kab);
                        $('#kabAlmtKTP').select2({
                            theme: 'bootstrap4'
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data kabupaten, hubungi administrator");
                            // $("#btnTambahDepart").attr("disabled", true);
                        }
                    }
                });
            });

            $("#provAlmtDom").change(function() {
                let id_prov = $("#provAlmtDom").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('daerah/get_kab') ?>",
                    data: {
                        id_prov: id_prov
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#kabAlmtDom").removeAttr('disabled');
                        $("#kabAlmtDom").html(data.kab);
                        $('#kabAlmtDom').select2({
                            theme: 'bootstrap4'
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data kabupaten, hubungi administrator");
                            // $("#btnTambahDepart").attr("disabled", true);
                        }
                    }
                });
            });

            $("#provAlmtDom").change(function() {
                let id_prov = $("#provAlmtDom").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('daerah/get_kab') ?>",
                    data: {
                        id_prov: id_prov
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#kabAlmtDom").removeAttr('disabled');
                        $("#kabAlmtDom").html(data.kab);
                        $('#kabAlmtDom').select2({
                            theme: 'bootstrap4'
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data kabupaten, hubungi administrator");
                            // $("#btnTambahDepart").attr("disabled", true);
                        }
                    }
                });
            });

            $("#kabAlmtDom").change(function() {
                let id_kab = $("#kabAlmtDom").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('daerah/get_kec') ?>",
                    data: {
                        id_kab: id_kab
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#kecAlmtDom").removeAttr('disabled');
                        $("#kecAlmtDom").html(data.kec);
                        $('#kecAlmtDom').select2({
                            theme: 'bootstrap4'
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                            // $("#btnTambahDepart").attr("disabled", true);
                        }
                    }
                });
            });

            $("#kabAlmtKTP").change(function() {
                let id_kab = $("#kabAlmtKTP").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('daerah/get_kec') ?>",
                    data: {
                        id_kab: id_kab
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#kecAlmtKTP").removeAttr('disabled');
                        $("#kecAlmtKTP").html(data.kec);
                        $('#kecAlmtKTP').select2({
                            theme: 'bootstrap4'
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                            // $("#btnTambahDepart").attr("disabled", true);
                        }
                    }
                });
            });

            $.ajax({
                type: "POST",
                url: "<?= base_url("lokasikerja/get_all") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addLokasiKerja").html(data.lkr);
                    $('#addLokasiKerja').select2({
                        theme: 'bootstrap4'
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                        $("#btnTambahDepart").attr("disabled", true);
                    }
                }
            });

            $("#addPerKary").change(function() {
                let auth_per = $("#addPerKary").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('departemen/get_by_authper') ?>",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {
                        $("#addDepartKary").removeAttr('disabled');
                        var data = JSON.parse(data);
                        $("#addDepartKary").html(data.dprt);
                        $('#addDepartKary').select2({
                            theme: 'bootstrap4'
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data departemen, hubungi administrator");
                            // $("#btnTambahDepart").attr("disabled", true);
                        }
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('level/get_by_authper') ?>",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {
                        $("#addLevelKary").removeAttr('disabled');
                        var data = JSON.parse(data);
                        $("#addLevelKary").html(data.lvl);
                        $("#addLevelKary").select2({
                            theme: 'bootstrap4'
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data level, hubungi administrator");
                            // $("#btnTambahPosisi").attr("disabled", true);
                        }
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('lokasipenerimaan/get_by_authper') ?>",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {
                        $("#addLokterimaKary").removeAttr('disabled');
                        var data = JSON.parse(data);
                        $("#addLokterimaKary").html(data.lkt);
                        $("#addLokterimaKary").select2({
                            theme: 'bootstrap4'
                        });
                    },
                    error: function() {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").removeClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data lokasi penerimaan, hubungi administrator");
                        }
                    }
                });
            });

            $("#addDepartKary").change(function() {
                let auth_depart = $("#addDepartKary").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('section/get_by_authdepart') ?>",
                    data: {
                        auth_depart: auth_depart
                    },
                    success: function(data) {
                        $("#addSectionKary").removeAttr('disabled');
                        var data = JSON.parse(data);
                        $("#addSectionKary").html(data.section);
                        $('#addSectionKary').select2({
                            theme: 'bootstrap4'
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data section, hubungi administrator");
                            // $("#btnTambahSection").attr("disabled", true);
                        }
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('posisi/get_by_authdepart') ?>",
                    data: {
                        auth_depart: auth_depart
                    },
                    success: function(data) {
                        $("#addPosisiKary").removeAttr('disabled');
                        var data = JSON.parse(data);
                        $("#addPosisiKary").html(data.posisi);
                        $("#addPosisiKary").select2({
                            theme: 'bootstrap4'
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data posisi, hubungi administrator");
                            // $("#btnTambahPosisi").attr("disabled", true);
                        }
                    }
                });

            });

            $("#addLevelKary").change(function() {
                let auth_level = $("#addLevelKary").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('grade/get_by_authlevel') ?>",
                    data: {
                        auth_level: auth_level
                    },
                    success: function(data) {
                        $("#addGradeKary").removeAttr('disabled');
                        var data = JSON.parse(data);
                        $("#addGradeKary").html(data.grd);
                        $('#addGradeKary').select2({
                            theme: 'bootstrap4'
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data grade, hubungi administrator");
                            // $("#btnTambahSection").attr("disabled", true);
                        }
                    }
                });
            });

            $.ajax({
                type: "POST",
                url: "<?= base_url('poh/get_all') ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addPOHKary").html(data.pho);
                    $("#addPOHKary").select2({
                        theme: 'bootstrap4'
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data POH, hubungi administrator");
                        // $("#btnTambahPosisi").attr("disabled", true);
                    }
                }
            });

            tbmKaryawan = $('#tbmKaryawan').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [1, 'asc']
                ],
                "ajax": {
                    "url": "<?= base_url('karyawan/ajax_list'); ?>",
                    "type": "POST",
                    "error": function(xhr, error, code) {
                        if (code != "") {
                            $(".err_psn_depart").removeClass("d-none");
                            $(".err_psn_depart").css("display", "block");
                            $(".err_psn_depart").html("terjadi kesalahan saat melakukan load data karyawan, hubungi administrator");
                            $("#addbtn").addClass("disabled");
                            $(".err_psn_depart ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_depart ").slideUp(500);
                            });
                        }
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 25, 50],
                    [10, 25, 50]
                ],
                "columns": [{
                        "data": 'no',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center align-middle",
                        "width": "1%"
                    },
                    {
                        "data": 'nama_lengkap',
                        "className": "align-middle align-middle",
                    },
                    {
                        "data": 'depart',
                        "className": "text-wrap align-middle",
                    },
                    // {
                    //     "data": 'section',
                    //     "className": "text-nowrap align-middle",
                    // },
                    {
                        "data": 'posisi',
                        "className": "text-wrap align-middle",
                    },
                    {
                        "data": 'kode_perusahaan',
                        "className": "text-wrap align-middle text-center",
                        "width": "1%"
                    },
                    {
                        "data": 'proses',
                        "className": "text-center text-nowrap align-middle",
                        "width": "1%"
                    }
                ]
            });
        });

        $("#btnSimpanDataPersonal").click(() => {
            let addNoKTP = $("#addNoKTP").val();
            let addNamaLengkap = $("#addNamaLengkap").val();
            let addAlamatEmail = $("#addAlamatEmail").val();
            let addNoTelp = $("#addNoTelp").val();
            let addTempatLahir = $("#addTempatLahir").val();
            let addTanggalLahir = $("#addTanggalLahir").val();
            let addStatPernikahan = $("#addStatPernikahan").val();
            let addNoKK = $("#addNoKK").val();
            let addNamaIbu = $("#addNamaIbu").val();
            let addKewarganegaraan = $("#addKewarganegaraan").val();
            let addAgama = $("#addAgama").val();
            let addJenisKelamin = $("#addJenisKelamin").val();
            let addKodeBank = $("#addKodeBank").val();
            let addNoRek = $("#addNoRek").val();
            let addNoNPWP = $("#addNoNPWP").val();
            let addNoBPJSTK = $("#addNoBPJSTK").val();
            let addNoBPJSKES = $("#addNoBPJSKES").val();
            let addNoBPJSPensiun = $("#addNoBPJSPensiun").val();
            let addNoEquity = $("#addNoEquity").val();
            let addPendidikanTerakhir = $("#addPendidikanTerakhir").val();
            let addInstansiPendidikan = $("#addInstansiPendidikan").val();
            let addFakultas = $("#addFakultas").val();
            let addJurusan = $("#addJurusan").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url("karyawan/input_dtPersonal") ?>",
                data: {
                    addNoKTP: addNoKTP,
                    addNamaLengkap: addNamaLengkap,
                    addAlamatEmail: addAlamatEmail,
                    addNoTelp: addNoTelp,
                    addTempatLahir: addTempatLahir,
                    addTanggalLahir: addTanggalLahir,
                    addStatPernikahan: addStatPernikahan,
                    addNoKK: addNoKK,
                    addNamaIbu: addNamaIbu,
                    addKewarganegaraan: addKewarganegaraan,
                    addAgama: addAgama,
                    addJenisKelamin: addJenisKelamin,
                    addKodeBank: addKodeBank,
                    addNoRek: addNoRek,
                    addNoNPWP: addNoNPWP,
                    addNoBPJSTK: addNoBPJSTK,
                    addNoBPJSKES: addNoBPJSKES,
                    addNoBPJSPensiun: addNoBPJSPensiun,
                    addNoEquity: addNoEquity,
                    addPendidikanTerakhir: addPendidikanTerakhir,
                    addInstansiPendidikan: addInstansiPendidikan,
                    addFakultas: addFakultas,
                    addJurusan: addJurusan,
                },
                timeout: 2000,
                success: (response) => {
                    // console.log(response)
                    var data = JSON.parse(response);
                    // console.log(data);
                    if (data.statusCode == 201) {
                        swal('Berhasil', data.pesan, 'success');
                        $(".err_psn_dtPersonal").removeClass('d-none');
                        $(".err_psn_dtPersonal").removeClass('alert-danger');
                        $(".err_psn_dtPersonal").addClass('alert-info');
                        $(".err_psn_dtPersonal").html(data.pesan);
                        $(".errorAddNoKTP").html('');
                        $(".errorAddNamaLengkap").html('');
                        $(".errorAddAlamatEmail").html('');
                        $(".errorAddNoTelp").html('');
                        $(".errorAddTempatLahir").html('');
                        $(".errorAddTanggalLahir").html('');
                        $(".errorAddStatPernikahan").html('');
                        $(".errorAddNoKK").html('');
                        $(".errorAddNamaIbu").html('');
                        $(".errorAddKewarganegaraan").html('');
                        $(".errorAddAgama").html('');
                        $(".errorAddJenisKelamin").html('');
                        $(".errorAddKodeBank").html('');
                        $(".errorAddNoRek").html('');
                        $(".errorAddNoNPWP").html('');
                        $(".errorAddNoBPJSTK").html('');
                        $(".errorAddNoBPJSKES").html('');
                        $(".errorAddNoBPJSPensiun").html('');
                        $(".errorAddNoEquity").html('');
                        $(".errorAddPendidikanTerakhir").html('');
                        $(".errorAddInstansiPendidikan").html('');
                        $(".errorAddFakultas").html('');
                        $(".errorAddJurusan").html('');
                        $("#addNoKTP").val('');
                        $("#addNamaLengkap").val('');
                        $("#addAlamatEmail").val('');
                        $("#addNoTelp").val('');
                        $("#addTempatLahir").val('');
                        $("#addTanggalLahir").val('');
                        $("#addStatPernikahan").val('');
                        $("#addNoKK").val('');
                        $("#addNamaIbu").val('');
                        $("#addKewarganegaraan").val('');
                        $("#addAgama").val('');
                        $("#addJenisKelamin").val('');
                        $("#addKodeBank").val('');
                        $("#addNoRek").val('');
                        $("#addNoNPWP").val('');
                        $("#addNoBPJSTK").val('');
                        $("#addNoBPJSKES").val('');
                        $("#addNoBPJSPensiun").val('');
                        $("#addNoEquity").val('');
                        $("#addPendidikanTerakhir").val('');
                        $("#addInstansiPendidikan").val('');
                        $("#addFakultas").val('');
                        $("#addJurusan").val('');
                    } else if (data.statusCode == 406) {
                        $(".err_psn_dtPersonal").removeClass('d-none');
                        $(".err_psn_dtPersonal").removeClass('alert-danger');
                        $(".err_psn_dtPersonal").addClass('alert-info');
                        $(".err_psn_dtPersonal").html(data.pesan);
                    } else if (data.statusCode == 400) {
                        swal('Perhatian', data.pesan, 'warning');
                        $(".errorAddNoKTP").html(data.addNoKTP);
                        $(".errorAddNamaLengkap").html(data.addNamaLengkap);
                        $(".errorAddAlamatEmail").html(data.addAlamatEmail);
                        $(".errorAddNoTelp").html(data.addNoTelp);
                        $(".errorAddTempatLahir").html(data.addTempatLahir);
                        $(".errorAddTanggalLahir").html(data.addTanggalLahir);
                        $(".errorAddStatPernikahan").html(data.addStatPernikahan);
                        $(".errorAddNoKK").html(data.addNoKK);
                        $(".errorAddNamaIbu").html(data.addNamaIbu);
                        $(".errorAddKewarganegaraan").html(data.addKewarganegaraan);
                        $(".errorAddAgama").html(data.addAgama);
                        $(".errorAddJenisKelamin").html(data.addJenisKelamin);
                        $(".errorAddKodeBank").html(data.addKodeBank);
                        $(".errorAddNoRek").html(data.addNoRek);
                        $(".errorAddNoNPWP").html(data.addNoNPWP);
                        $(".errorAddNoBPJSTK").html(data.addNoBPJSTK);
                        $(".errorAddNoBPJSKES").html(data.addNoBPJSKES);
                        $(".errorAddNoBPJSPensiun").html(data.addNoBPJSPensiun);
                        $(".errorAddNoEquity").html(data.addNoEquity);
                        $(".errorAddPendidikanTerakhir").html(data.addPendidikanTerakhir);
                        $(".errorAddInstansiPendidikan").html(data.addInstansiPendidikan);
                        $(".errorAddFakultas").html(data.addFakultas);
                        $(".errorAddJurusan").html(data.addJurusan);
                    }
                    $(".err_psn_dtPersonal").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_dtPersonal").slideUp(500);
                    });
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    $.LoadingOverlay("hide");
                    $(".err_psn_depart").removeClass("alert-primary");
                    $(".err_psn_depart").addClass("alert-danger");
                    $(".err_psn_depart").css("display", "block");
                    if (xhr.status == 404) {
                        $(".err_psn_depart").html("Data personal karyawan gagal disimpan.");
                    } else if (xhr.status == 0) {
                        $(".err_psn_depart").html("Data personal karyawan gagal disimpan, Waktu koneksi habis");
                    } else {
                        $(".err_psn_depart").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                    }
                    $(".err_psn_depart ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_depart ").slideUp(500);
                    });
                },

            })
        });

    });
</script>