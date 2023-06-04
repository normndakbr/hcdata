<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $("#logout").click(function() {
                $("#logoutmdl").modal("show");
            });
            let auth_per_old = '';
            $('#noNPWP').inputmask("99.999.999.9-999.999");
            $('#colPersonal').collapse("show");
            $("#idizintambang").load("<?= base_url('karyawan/izin_tambang'); ?>");
            $("#idsertifikat").load("<?= base_url('karyawan/sertifikasi'); ?>");
            $("#idvaksin").load("<?= base_url('karyawan/vaksin'); ?>");

            $(".suksesalrt").fadeTo(4000, 500).slideUp(500, function() {
                $(".suksesalrt").slideUp(500);
                $(".suksesalrt").addClass("d-none");
            });

            $('#provData').select2({
                theme: 'bootstrap4'
            });
            $('#kotaData').select2({
                theme: 'bootstrap4'
            });
            $('#kecData').select2({
                theme: 'bootstrap4'
            });
            $('#kelData').select2({
                theme: 'bootstrap4'
            });
            $('#addPerKary').select2({
                theme: 'bootstrap4'
            });
            $('#addDepartKary').select2({
                theme: 'bootstrap4'
            });
            $('#addPosisiKary').select2({
                theme: 'bootstrap4'
            });
            $('#addKlasifikasiKary').select2({
                theme: 'bootstrap4'
            });
            $("#addPOHKary").select2({
                theme: 'bootstrap4'
            });
            $("#addLokterimaKary").select2({
                theme: 'bootstrap4'
            });
            $("#addLokasiKerja").select2({
                theme: 'bootstrap4'
            });
            $('#addGradeKary').select2({
                theme: 'bootstrap4'
            });
            $('#addStatusResidence').select2({
                theme: 'bootstrap4'
            });
            $('#addJenisKaryawan').select2({
                theme: 'bootstrap4'
            });
            $('#statPernikahan').select2({
                theme: 'bootstrap4'
            });
            $('#addagama').select2({
                theme: 'bootstrap4'
            });
            $('#kewarganegaraan').select2({
                theme: 'bootstrap4'
            });
            $('#jenisKelamin').select2({
                theme: 'bootstrap4'
            });
            $('#addJenisSIM').select2({
                theme: 'bootstrap4'
            });
            $('#jenisUnitSimper').select2({
                dropdownParent: $('#mdlunitsimper'),
                theme: 'bootstrap4'
            });
            $('#tipeAksesUnit').select2({
                dropdownParent: $('#mdlunitsimper'),
                theme: 'bootstrap4'
            });
            $('#jenisSertifikasi').select2({
                theme: 'bootstrap4'
            });
            window.addEventListener('resize', function(event) {
                $('#provData').select2({
                    theme: 'bootstrap4'
                });
                $('#kotaData').select2({
                    theme: 'bootstrap4'
                });
                $('#kecData').select2({
                    theme: 'bootstrap4'
                });
                $('#kelData').select2({
                    theme: 'bootstrap4'
                });
                $('#addPerKary').select2({
                    theme: 'bootstrap4'
                });
                $('#addDepartKary').select2({
                    theme: 'bootstrap4'
                });
                $('#addPosisiKary').select2({
                    theme: 'bootstrap4'
                });
                $('#addKlasifikasiKary').select2({
                    theme: 'bootstrap4'
                });
                $("#addPOHKary").select2({
                    theme: 'bootstrap4'
                });
                $("#addLokterimaKary").select2({
                    theme: 'bootstrap4'
                });
                $("#addLokasiKerja").select2({
                    theme: 'bootstrap4'
                });
                $('#addGradeKary').select2({
                    theme: 'bootstrap4'
                });
                $('#addStatusResidence').select2({
                    theme: 'bootstrap4'
                });
                $('#addJenisKaryawan').select2({
                    theme: 'bootstrap4'
                });
                $('#statPernikahan').select2({
                    theme: 'bootstrap4'
                });
                $('#addagama').select2({
                    theme: 'bootstrap4'
                });
                $('#kewarganegaraan').select2({
                    theme: 'bootstrap4'
                });
                $('#jenisKelamin').select2({
                    theme: 'bootstrap4'
                });
                $('#jenisUnitSimper').select2({
                    dropdownParent: $('#mdlunitsimper'),
                    theme: 'bootstrap4'
                });
                $('#tipeAksesUnit').select2({
                    dropdownParent: $('#mdlunitsimper'),
                    theme: 'bootstrap4'
                });
                $('#jenisSertifikasi').select2({
                    theme: 'bootstrap4'
                });
            }, true);
            $("#addUnitSIMPER").click(function() {
                let jenisizin = $("#addJenisIzin").val();

                if (jenisizin == "SP") {
                    $("#mdlunitsimper").modal("show");
                }
            });
            $("#btnbatalunitsimper").click(function() {
                $("#jenisUnitSimper").val('').trigger("change");
                $("#tipeAksesUnit").val('').trigger("change");
                $("#mdlunitsimper").modal("hide");
            });
            $("#btnsimpanunitsimper").click(function() {
                let jenisunit = $("#jenisUnitSimper").val();
                let tipeakses = $("#tipeAksesUnit").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("izin_tambang/add_unit_izin_tambang") ?>",
                    data: {
                        jenisunit: jenisunit,
                        tipeakses: tipeakses
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#idizintambang").LoadingOverlay("show");
                            $("#idizintambang").load("<?= base_url('karyawan/izin_tambang'); ?>");
                            swal('Berhasil', data.pesan, 'success');
                        } else if (data.statusCode == 201) {
                            $(".errorjenisUnitSimper").html(data.pesan);
                        } else {
                            $(".errorjenisUnitSimper").html(data.jenisunit);
                            $(".errortipeAksesUnit").html(data.tipeakses);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat menyimpan unit hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    }
                });
            });
            $.ajax({
                type: "POST",
                url: "<?= base_url("karyawan/get_sim") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addJenisSIM").html(data.siim);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data SIM, hubungi administrator");
                        $("#addSimpanIzinUnit").remove();
                    }
                }
            });

            function jenistambang() {
                let jenisizin = $("#addJenisIzin").val();

                if (jenisizin == "SP") {
                    $(".simperunit").collapse("show");
                } else {
                    $(".simperunit").collapse("hide");
                }
            }
            jenistambang();

            $("#addJenisIzin").change(function() {
                let jenisizin = $("#addJenisIzin").val();

                if (jenisizin == "SP") {
                    $(".simperunit").collapse("show");
                } else {
                    $(".simperunit").collapse("hide");
                }
            });
            $("#addStatusKaryawan").change(function() {
                let stat_kary = $("#addStatusKaryawan").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("perjanjian/get_stat_waktu") ?>",
                    data: {
                        stat_kary: stat_kary
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            if (data.stat_waktu == "T") {
                                $("#addFieldPermanen").addClass("d-none");
                                $("#addFieldKontrakAwal").removeClass("d-none");
                                $("#addFieldKontrakAkhir").removeClass("d-none");
                            } else if (data.stat_waktu == "F") {
                                $("#addFieldPermanen").removeClass("d-none");
                                $("#addFieldKontrakAwal").addClass("d-none");
                                $("#addFieldKontrakAkhir").addClass("d-none");
                            }
                        } else {
                            $("#erroraddStatusKaryawan").html(data.pesan);
                            $("#addFieldPermanen").addClass("d-none");
                            $("#addFieldKontrakAwal").addClass("d-none");
                            $("#addFieldKontrakAkhir").addClass("d-none");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data status karyawan hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    }
                });
            });
            $.ajax({
                type: "POST",
                url: "<?= base_url("karyawan/get_agama") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addagama").html(data.agama);
                },
                error: function(xhr, ajaxOptions, thrownError) {
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
            $.ajax({
                type: "POST",
                url: "<?= base_url("karyawan/get_stat_nikah") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#statPernikahan").html(data.statnikah);
                },
                error: function(xhr, ajaxOptions, thrownError) {
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
                url: "<?= base_url("karyawan/get_all_jenis_mcu") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#hasilMCU").html(data.jmcu);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data hasil MCU, hubungi administrator");
                    }
                }
            });
            $.ajax({
                type: "POST",
                url: "<?= base_url("izin_tambang/get_all_unit") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#jenisUnitSimper").html(data.unit);
                },
                error: function(xhr, ajaxOptions, thrownError) {
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
                url: "<?= base_url("vaksin/get_vaksin_jenis_all") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#jenisVaksin").html(data.jvks);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data jenis vaksin, hubungi administrator");
                    }
                }
            });
            $.ajax({
                type: "POST",
                url: "<?= base_url("vaksin/get_vaksin_nama_all") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#namaVaksin").html(data.nvks);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data nama vaksin, hubungi administrator");
                    }
                }
            });
            $.ajax({
                type: "POST",
                url: "<?= base_url("izin_tambang/get_all_akses") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#tipeAksesUnit").html(data.akses);
                },
                error: function(xhr, ajaxOptions, thrownError) {
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
                url: "<?= base_url("pendidikan/get_all") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#pendidikanTerakhir").html(data.pdk);
                },
                error: function(xhr, ajaxOptions, thrownError) {
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
            $.ajax({
                type: "POST",
                url: "<?= base_url("daerah/get_prov") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#provData").html(data.prov);
                },
                error: function(xhr, ajaxOptions, thrownError) {
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
            $("#provData").change(function() {
                let id_prov = $("#provData").val();

                $("#txtkota").LoadingOverlay("show");
                $("#txtkec").LoadingOverlay("show");
                $("#txtkel").LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url("daerah/get_kab") ?>",
                    data: {
                        id_prov: id_prov
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#kotaData").html(data.kab);
                        $("#kecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                        $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                        $("#txtkota").LoadingOverlay("hide");
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");

                        if (id_prov != "") {
                            $(".errorProvData").html("");
                        } else {
                            $(".errorProvData").html("<p>Provinsi wajib diisi</p>");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        $("#txtkota").LoadingOverlay("hide");
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    }
                });
            });

            $("#kotaData").change(function() {
                let id_kab = $("#kotaData").val();

                $("#txtkec").LoadingOverlay("show");
                $("#txtkel").LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url("daerah/get_kec") ?>",
                    data: {
                        id_kab: id_kab
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#kecData").html(data.kec);
                        $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");
                        if (id_kab != "") {
                            $(".errorKotaData").html("");
                        } else {
                            $(".errorKotaData").html("<p>Kabupaten/kota wajib dipilih</p>");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    }
                });
            });
            $("#kecData").change(function() {
                let id_kec = $("#kecData").val();

                $("#txtkel").LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url("daerah/get_kel") ?>",
                    data: {
                        id_kec: id_kec
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#kelData").html(data.kel);
                        $("#txtkel").LoadingOverlay("hide");
                        if (id_kec != "") {
                            $(".errorKecData").html("");
                        } else {
                            $(".errorKecData").html("<p>Kecamatan wajib dipilih</p>");
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        $("#txtkel").LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    }
                });
            });

            $("#kelData").change(function() {
                let id_kel = $("#kelData").val();
                if (id_kel != "") {
                    $(".errorKelData").html("");
                } else {
                    $(".errorKelData").html("<p>Kelurahan wajib dipilih</p>");
                }
            });

            $("#addStatusKaryawan").change(function() {
                $("#addTanggalPermanen").val('');
                $("#addTanggalKontrakAwal").val('');
                $("#addTanggalKontrakAkhir").val('');
            });

            $("#refreshProv").click(function() {
                $("#txtprov").LoadingOverlay("show");
                $("#txtkota").LoadingOverlay("show");
                $("#txtkec").LoadingOverlay("show");
                $("#txtkel").LoadingOverlay("show");

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("daerah/get_prov") ?>",
                    data: {},
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#provData").html(data.prov);
                        $("#kotaData").html("<option value=''>-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>");
                        $("#kecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                        $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                        $("#txtprov").LoadingOverlay("hide");
                        $("#txtkota").LoadingOverlay("hide");
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#provData").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        $("#txtprov").LoadingOverlay("hide");
                        $("#txtkota").LoadingOverlay("hide");
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data provinsi, hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    }
                });
            });

            $("#refreshKota").click(function() {
                let id_prov = $("#provData").val();

                $("#txtkota").LoadingOverlay("show");
                $("#txtkec").LoadingOverlay("show");
                $("#txtkel").LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url("daerah/get_kab") ?>",
                    data: {
                        id_prov: id_prov
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#kotaData").html(data.kab);
                        $("#kecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                        $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                        $("#txtkota").LoadingOverlay("hide");
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");

                        if (id_prov != "") {
                            $(".errorProvData").html("");
                        } else {
                            $(".errorProvData").html("<p>Provinsi wajib diisi</p>");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        $("#txtkota").LoadingOverlay("hide");
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    }
                });
            });

            $("#refreshKec").click(function() {
                let id_kab = $("#kotaData").val();

                $("#txtkec").LoadingOverlay("show");
                $("#txtkota").LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url("daerah/get_kec") ?>",
                    data: {
                        id_kab: id_kab
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#kecData").html(data.kec);
                        $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkota").LoadingOverlay("hide");
                        if (id_kab != "") {
                            $(".errorKotaData").html("");
                        } else {
                            $(".errorKotaData").html("<p>Kabupaten/kota wajib dipilih</p>");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkota").LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    }
                });
            });

            $("#refreshKel").click(function() {
                let id_kec = $("#kecData").val();

                $("#txtkel").LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url("daerah/get_kel") ?>",
                    data: {
                        id_kec: id_kec
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#kelData").html(data.kel);
                        $("#txtkel").LoadingOverlay("hide");
                        if (id_kab != "") {
                            $(".errorKecData").html("");
                        } else {
                            $(".errorKecData").html("<p>Kecamatan wajib dipilih</p>");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        $("#txtkel").LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    }
                });
            });

            $("#refreshStatNikah").click(function() {
                $("#txtnikah").LoadingOverlay("show");

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("karyawan/get_stat_nikah") ?>",
                    data: {},
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#statPernikahan").html(data.statnikah);
                        $("#txtnikah").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
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
            });

            $("#refreshDidik").click(function() {
                $("#txtDidik").LoadingOverlay("show");

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("pendidikan/get_all") ?>",
                    data: {},
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#pendidikanTerakhir").html(data.pdk);
                        $("#txtDidik").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        $("#txtDidik").LoadingOverlay("hide");
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data pendidikan terakhir, hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    }
                });
            });

            $("#refreshPerKary").click(function() {
                $("#txtperkary").LoadingOverlay("show");

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("perusahaan/get_m_all") ?>",
                    data: {},
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#addPerKary").html(data.prs);
                            $("#addPerKary").val('').trigger('change');
                            $("#txtperkary").LoadingOverlay("hide");
                            $("#addDepartKary").attr('disabled', true);
                            $("#addPosisiKary").attr('disabled', true);
                        } else {
                            $("#txtperkary").LoadingOverlay("hide");
                            $(".errormsg").removeClass('d-none');
                            $(".errormsg").removeClass('alert-info');
                            $(".errormsg").addClass('alert-danger');
                            $(".errormsg").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#txtperkary").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                            $("#addSimpanPersonal").remove();
                        }
                    }
                });
            });

            $("#refreshDepart").click(function() {
                let auth_per = $("#addPerKary").val();

                if (auth_per != "") {
                    $("#txtdepartkary").LoadingOverlay("show");
                    $("#txtposisikary").LoadingOverlay("show");

                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('departemen/get_by_authper') ?>",
                        data: {
                            auth_per: auth_per
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            $("#addDepartKary").html(data.dprt);
                            $("#addDepartKary").removeAttr('disabled');
                            $("#addPosisiKary").attr('disabled', true);
                            $("#refreshPosisi").attr('disabled', true);
                            $("#addPosisiKary").html('<option value ="">-- WAJIB DIPILIH --</option>');
                            $("#txtdepartkary").LoadingOverlay("hide");
                            $("#txtposisikary").LoadingOverlay("hide");
                            if (auth_per != "") {
                                $(".errorAddPerKary").html("");
                            } else {
                                $(".errorAddPerKary").html("<p>Perusahaan wajib dipilih</p>");
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
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
                } else {
                    swal('Error', 'Pilih perusahaan', 'error');
                }
            });

            $("#refreshPosisi").click(function() {
                let auth_depart = $("#addDepartKary").val();

                $("#addPosisiKary").LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('posisi/get_by_authdepart') ?>",
                    data: {
                        auth_depart: auth_depart
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#addPosisiKary").html(data.posisi);
                        $("#addPosisiKary").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#addPosisiKary").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data posisi, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });
            });
            $("#refreshKlasifikasi").click(function() {
                $("#txtklasifikasikary").LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('klasifikasi/get_all') ?>",
                    data: {},
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#addKlasifikasiKary").html(data.kls);
                        $("#txtklasifikasikary").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#txtklasifikasikary").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data klasifikasi, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });
            });
            $("#refreshPOH").click(function() {
                $("#txtPOHKary").LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('poh/get_all') ?>",
                    data: {},
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#addPOHKary").html(data.pho);
                        $("#txtPOHKary").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#txtPOHKary").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data POH, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });
            });

            $("#refreshLokterima").click(function() {
                let auth_per = $("#addPerKary").val();
                $("#txtlokterimakary").LoadingOverlay("show");

                if (auth_per != "") {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('lokasipenerimaan/get_by_authper') ?>",
                        data: {
                            auth_per: auth_per
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            $("#txtlokterimakary").LoadingOverlay("hide");
                            $("#addLokterimaKary").removeAttr('disabled');
                            $("#addLokterimaKary").html(data.lkt);
                            $("#addLokterimaKary").removeAttr('disabled');
                            $("#refreshLokterima").removeAttr('disabled');
                        },
                        error: function() {
                            $("#txtlokterimakary").LoadingOverlay("hide");
                            $(".errormsg").removeClass('d-none');
                            $(".errormsg").removeClass('alert-info');
                            $(".errormsg").removeClass('alert-danger');
                            if (thrownError != "") {
                                $(".errormsg").html("Terjadi kesalahan saat load data lokasi penerimaan, hubungi administrator");
                                $("#addSimpanPekerjaan").remove();
                            }
                        }
                    });
                }
            });

            $("#refreshLokker").click(function() {
                $("#txtlokkerkary").LoadingOverlay("show");

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("lokasikerja/get_all") ?>",
                    data: {},
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#addLokasiKerja").html(data.lkr);
                        $("#txtlokkerkary").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#txtlokkerkary").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data lokasi kerja, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });
            });

            $("#refreshTipe").click(function() {
                $("#txtjeniskary").LoadingOverlay("show");

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("karyawan/get_all_tipe") ?>",
                    data: {},
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#addJenisKaryawan").html(data.tipe);
                        $("#txtjeniskary").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#txtjeniskary").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data tipe karyawan, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });
            });

            $("#refreshGrade").click(function() {
                let auth_per = $("#addPerKary").val();
                $("#txtgradekary").LoadingOverlay("show");

                if (auth_per != "") {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('grade/get_all') ?>",
                        data: {
                            auth_per: auth_per
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            $("#addGradeKary").html(data.grd);
                            $("#txtgradekary").LoadingOverlay("hide");
                            $("#addGradeKary").removeAttr('disabled');
                            $("#refreshGrade").removeAttr('disabled');
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $("#txtgradekary").LoadingOverlay("hide");
                            $(".errormsg").removeClass('d-none');
                            $(".errormsg").removeClass('alert-info');
                            $(".errormsg").addClass('alert-danger');
                            if (thrownError != "") {
                                $(".errormsg").html("Terjadi kesalahan saat load data grade, hubungi administrator");
                                $("#addSimpanPekerjaan").remove();
                            }
                        }
                    });
                }
            });

            $("#refreshResidence").click(function() {
                $("#txtstatresidence").LoadingOverlay("show");
                $("#addStatusResidence").val('').trigger('change');
                $("#txtstatresidence").LoadingOverlay("hide");
            });

            $("#refreshstatkaryawan").click(function() {
                $("#txtstatkary").LoadingOverlay("show");

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("perjanjian/get_all") ?>",
                    data: {},
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#addStatusKaryawan").html(data.janji);
                        $("#addFieldKontrakAwal").addClass('d-none');
                        $("#addFieldKontrakAkhir").addClass('d-none');
                        $("#addFieldPermanen").addClass('d-none');

                        $("#addTanggalPermanen").val('');
                        $("#addTanggalKontrakAwal").val('');
                        $("#addTanggalKontrakAkhir").val('');

                        $("#txtstatkary").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#txtstatkary").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data status karyawan, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });
            });

            $.ajax({
                type: "POST",
                url: "<?= base_url("perusahaan/get_m_all") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#addPerKary").html(data.prs);
                        $('#addPerKary').select2({
                            theme: 'bootstrap4'
                        });
                    } else {
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        $(".errormsg").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                }
            });
            $.ajax({
                type: "POST",
                url: "<?= base_url('klasifikasi/get_all') ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addKlasifikasiKary").html(data.kls);
                    $('#addKlasifikasiKary').select2({
                        theme: 'bootstrap4'
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data klasifikasi, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });

            $("#addagama").change(function() {
                let agama = $("#addagama").val();

                if (agama != "") {
                    $(".errorAddAgama").html("");
                } else {
                    $(".errorAddAgama").html("<p>Agama wajib dipilih</p>");
                }
            });
            $("#jenisKelamin").change(function() {
                let jk = $("#jenisKelamin").val();
                if (jk != "") {
                    $(".errorJenisKelamin").html("");
                } else {
                    $(".errorJenisKelamin").html("<p>Jenis kelamin wajib dipilih</p>");
                }
            });
            $("#statPernikahan").change(function() {
                let stkw = $("#statPernikahan").val();
                if (stkw != "") {
                    $(".errorStatPernikahan").html("");
                } else {
                    $(".errorStatPernikahan").html("<p>Kelurahan wajib dipilih</p>");
                }
            });
            $("#kewarganegaraan").change(function() {
                let warga = $("#kewarganegaraan").val();
                if (warga != "") {
                    $(".errorKewarganegaraan").html("");
                } else {
                    $(".errorKewarganegaraan").html("<p>Warga negara wajib dipilih</p>");
                }
            });

            function get_data_kary(auth_per) {
                $("#txtdepartkary").LoadingOverlay("show");
                $("#txtposisikary").LoadingOverlay("show");
                $("#txtlokterimakary").LoadingOverlay("show");
                $("#txtpohkary").LoadingOverlay("show");
                $("#txtgradekary").LoadingOverlay("show");

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('departemen/get_by_authper') ?>",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {

                        $("#addDepartKary").removeAttr('disabled');
                        $("#refreshDepart").removeAttr('disabled');
                        $("#addPosisiKary").attr('disabled', true);
                        $("#addPosisiKary").html('<option value="">-- WAJIB DIPILIH --</option>');
                        $("#refreshPosisi").attr('disabled', true);
                        var data = JSON.parse(data);
                        $("#addDepartKary").html(data.dprt);
                        $('#addDepartKary').select2({
                            theme: 'bootstrap4'
                        });
                        if (auth_per != "") {
                            $(".errorAddPerKary").html("");
                        } else {
                            $(".errorAddPerKary").html("<p>Perusahaan wajib dipilih</p>");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data departemen, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('grade/get_all') ?>",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#addGradeKary").html(data.grd);
                        $("#addGradeKary").removeAttr('disabled');
                        $("#refreshGrade").removeAttr('disabled');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data grade, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
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
                        $("#addLokterimaKary").removeAttr('disabled');
                        $("#refreshLokterima").removeAttr('disabled');
                    },
                    error: function() {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").removeClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data lokasi penerimaan, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });

                $("#txtdepartkary").LoadingOverlay("hide");
                $("#txtposisikary").LoadingOverlay("hide");
                $("#txtlokterimakary").LoadingOverlay("hide");
                $("#txtpohkary").LoadingOverlay("hide");
                $("#txtgradekary").LoadingOverlay("hide");
            }

            $("#addPerKary").change(function() {
                let auth_per = $("#addPerKary").val();

                if (auth_per != "") {
                    if (auth_per_old != "") {
                        if (auth_per != auth_per_old) {
                            swal({
                                title: "Ganti Perusahaan",
                                text: "Mengganti perusahaan akan me-reset beberapa data perusahaan, yakin akan diganti?",
                                type: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#36c6d3',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Ganti',
                                cancelButtonText: 'Batalkan'
                            }).then(function(result) {
                                if (result.value) {
                                    auth_per_old = auth_per;
                                    get_data_kary(auth_per)
                                    $("#addPerKary").val(auth_per).trigger('change')
                                    $('#addPosisiKary').html('<option value="">-- WAJIB DIPILIH --</option>');
                                    $('#addPosisiKary').attr('disabled', true)
                                    $('#refreshPosisi').attr('disabled', true)
                                } else if (result.dismiss == 'cancel') {
                                    swal('Batal', 'Perusahaan batal diganti', 'info');
                                    $("#addPerKary").val(auth_per_old).trigger('change')
                                }
                            });
                        }
                    } else {
                        get_data_kary(auth_per)
                        auth_per_old = auth_per;
                    }
                } else {
                    $('#addDepartKary').html('<option value="">-- WAJIB DIPILIH --</option>');
                    $('#addPosisiKary').html('<option value="">-- WAJIB DIPILIH --</option>');
                    $('#addGradeKary').html('<option value="">-- WAJIB DIPILIH --</option>');
                    $('#addLokterimaKary').html('<option value="">-- WAJIB DIPILIH --</option>');
                    $('#addDepartKary').attr('disabled', true)
                    $('#addPosisiKary').attr('disabled', true)
                    $('#addGradeKary').attr('disabled', true)
                    $('#addLokterimaKary').attr('disabled', true)
                    $('#refreshDepart').attr('disabled', true)
                    $('#refreshPosisi').attr('disabled', true)
                    $('#refreshGrade').attr('disabled', true)
                    $('#refreshLokterima').attr('disabled', true)
                }

            });

            $.ajax({
                type: "POST",
                url: "<?= base_url('poh/get_all') ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addPOHKary").html(data.pho);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data POH, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
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
                        $(".errormsg").html("Terjadi kesalahan saat load data lokasi kerja, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });
            $.ajax({
                type: "POST",
                url: "<?= base_url("perjanjian/get_all") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addStatusKaryawan").html(data.janji);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data status karyawan, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });

            $.ajax({
                type: "POST",
                url: "<?= base_url("karyawan/get_all_tipe") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addJenisKaryawan").html(data.tipe);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data tipe karyawan, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });

            $("#addDepartKary").change(function() {
                let auth_depart = $("#addDepartKary").val();

                if (auth_depart != "") {
                    $("#txtposisikary").LoadingOverlay("show");
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('posisi/get_by_authdepart') ?>",
                        data: {
                            auth_depart: auth_depart
                        },
                        success: function(data) {
                            $("#addPosisiKary").removeAttr('disabled');
                            $("#refreshPosisi").removeAttr('disabled');
                            var data = JSON.parse(data);
                            $("#addPosisiKary").html(data.posisi);
                            $("#txtposisikary").LoadingOverlay("hide");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $("#txtposisikary").LoadingOverlay("hide");
                            $(".errormsg").removeClass('d-none');
                            $(".errormsg").removeClass('alert-info');
                            $(".errormsg").addClass('alert-danger');
                            if (thrownError != "") {
                                $(".errormsg").html("Terjadi kesalahan saat load data posisi, hubungi administrator");
                                $("#addSimpanPekerjaan").remove();
                            }
                        }
                    });
                } else {
                    $("#addPosisiKary").html('<option value="">-- WAJIB DIPILIH --</option>');
                    $("#addPosisiKary").attr('disabled', true);
                    $("#refreshPosisi").attr('disabled', true);
                }
            });

            $("#masaBerlakuSertifikat").change(function() {
                let tglsrt = $("#tanggalSertifikasi").val();
                let masa = $("#masaBerlakuSertifikat").val();

                $.ajax({
                    type: "post",
                    url: "<?= base_url("sertifikasi/getdateexpmasa") ?>",
                    data: {
                        tglsrt: tglsrt,
                        masa: masa
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#tanggalSertifikasiAkhir").val(data.tglexp);
                        }
                    }
                })
            });
            $("#tanggalSertifikasi").change(function() {
                let tglsrt = $("#tanggalSertifikasi").val();
                let masa = $("#masaBerlakuSertifikat").val();

                $.ajax({
                    type: "post",
                    url: "<?= base_url("sertifikasi/getdateexpsrt") ?>",
                    data: {
                        tglsrt: tglsrt,
                        masa: masa
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#tanggalSertifikasiAkhir").val(data.tglexp);
                        }
                    }
                })
            });
            $.ajax({
                type: "POST",
                url: "<?= base_url("sertifikasi/get_jenis_sertifikasi") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#jenisSertifikasi").html(data.srt);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator");
                        $("#addSimpanSertifikasi").remove();
                        $("#addResetSertifikasi").remove();
                    }
                }
            });
            $('#namaLengkap').keyup(function(e) {
                let nama = $('#namaLengkap').val().trim();

                if (nama != "") {
                    $('.errorNamaLengkap').html('');
                } else {
                    $('.errorNamaLengkap').html('<p>Nama lengkap wajib diisi</p>');
                }
            });
            $('#tempatLahir').keyup(function(e) {
                let tmp_lahir = $('#tempatLahir').val().trim();

                if (tmp_lahir != "") {
                    $('.errorTempatLahir').html('');
                } else {
                    $('.errorTempatLahir').html('<p>Tempat lahir wajib diisi</p>');
                }
            });
            $('#tanggalLahir').keyup(function(e) {
                let tgl_lahir = $('#tanggalLahir').val().trim();

                if (tgl_lahir != "") {
                    $('.errorTanggalLahir').html('');
                } else {
                    $('.errorTanggalLahir').html('<p>Tanggal lahir wajib diisi</p>');
                }
            });
            $('#tanggalLahir').change(function() {
                let tgl_lahir = $('#tanggalLahir').val().trim();

                if (tgl_lahir != "") {
                    $('.errorTanggalLahir').html('');
                } else {
                    $('.errorTanggalLahir').html('<p>Tanggal lahir wajib diisi</p>');
                }
            });
            $('#namaIbu').keyup(function(e) {
                let tgl_lahir = $('#namaIbu').val().trim();

                if (tgl_lahir != "") {
                    $('.errorNamaIbu').html('');
                } else {
                    $('.errorNamaIbu').html('<p>Nama ibu kandung wajib diisi</p>');
                }
            });
            $('#noNPWP').keyup(function(e) {
                let nonpwp = $('#noNPWP').val().trim();

                if (nonpwp != "") {
                    jmlnpwp = nonpwp.replace(/['.'|_|-]/g, '');
                    jml = jmlnpwp.length;

                    if (jml < 15) {
                        $('.errorNoNPWP').html('<p>No. NPWP minimal 15 karakter</p>');
                    } else {
                        $('.errorNoNPWP').html('');
                    }
                } else {
                    $('.errorNoNPWP').html('');
                }
            });
            $('#noKTP').keyup(function(e) {
                let noktp = $('#noKTP').val().trim();
                let jmlhrf = $('#noKTP').val().length;

                if (noktp != "") {
                    if (jmlhrf > 16) {
                        $('.errorNoKTP').html('<p>No. KTP maksimal 16 karakter</p>');
                    } else if (jmlhrf < 16) {
                        $('.errorNoKTP').html('<p>No. KTP minimal 16 karakter</p>');
                    } else {
                        $('.errorNoKTP').html('');
                    }
                }
            });
            $('#noKK').keyup(function(e) {
                let noKK = $('#noKK').val().trim();
                let jmlhrf = $('#noKK').val().length;

                if (noKK != "") {
                    if (jmlhrf > 16) {
                        $('.errorNoKK').html('<p>No. KK maksimal 16 karakter</p>');
                    } else if (jmlhrf < 16) {
                        $('.errorNoKK').html('<p>No. KK minimal 16 karakter</p>');
                    } else {
                        $('.errorNoKK').html('');
                    }
                }
            });
            $('#alamatKTP').keyup(function(e) {
                let alamat = $('#alamatKTP').val().trim();

                if (alamat != "") {
                    $('.errorAlamatKTP').html('');
                } else {
                    $('.errorAlamatKTP').html('<p>Alamat wajib diisi</p>');
                }
            });

            $("#addSimpanPersonal").click(function() {
                let auth_per = $("#addPerKary").val();
                let noktp = $("#noKTP").val();
                let nama = $("#namaLengkap").val();
                let alamat = $("#alamatKTP").val();
                let rt = $("#rtKTP").val();
                let rw = $("#rwKTP").val();
                let id_prov = $("#provData").val();
                let id_kab = $("#kotaData").val();
                let id_kec = $("#kecData").val();
                let id_kel = $("#kelData").val();
                let tmp_lahir = $("#tempatLahir").val();
                let tgl_lahir = $("#tanggalLahir").val();
                let stat_nikah = $("#statPernikahan").val();
                let id_agama = $("#addagama").val();
                let warga = $("#kewarganegaraan").val();
                let jk = $("#jenisKelamin").val();
                let email = $("#emailPribadi").val();
                let telp = $("#noTelp").val();
                let bpjs_tk = $("#noBPJSTK").val();
                let bpjs_kes = $("#noBPJSKES").val();
                let nokk = $("#noKK").val();
                let namaibu = $("#namaIbu").val();
                let npwp = $('#noNPWP').val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("karyawan/addpersonal") ?>",
                    data: {
                        noktp: noktp,
                        nama: nama,
                        alamat: alamat,
                        rt: rt,
                        rw: rw,
                        id_prov: id_prov,
                        id_kab: id_kab,
                        id_kec: id_kec,
                        id_kel: id_kel,
                        tmp_lahir: tmp_lahir,
                        tgl_lahir: tgl_lahir,
                        stat_nikah: stat_nikah,
                        id_agama: id_agama,
                        warga: warga,
                        jk: jk,
                        email: email,
                        telp: telp,
                        bpjs_tk: bpjs_tk,
                        bpjs_kes: bpjs_kes,
                        npwp: npwp,
                        nokk: nokk,
                        namaibu: namaibu,
                        auth_per: auth_per
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $('#colKaryawan').collapse("show");
                            $('#colPersonal').collapse("hide");
                            $('#imgPersonal').removeClass("d-none");
                        } else if (data.statusCode == 201) {
                            swal("Error", data.pesan, "error");
                        } else {
                            $(".errorNoKTP").html(data.noktp);
                            $(".errorNamaLengkap").html(data.nama);
                            $(".errorAlamatKTP").html(data.alamat);
                            $(".errorRtKTP").html(data.rt);
                            $(".errorRwKTP").html(data.rw);
                            $(".errorProvData").html(data.id_prov);
                            $(".errorKotaData").html(data.id_kab);
                            $(".errorKecData").html(data.id_kec);
                            $(".errorKelData").html(data.id_kel);
                            $(".errorTempatLahir").html(data.tmp_lahir);
                            $(".errorTanggalLahir").html(data.tgl_lahir);
                            $(".errorStatPernikahan").html(data.stat_nikah);
                            $(".errorAddAgama").html(data.id_agama);
                            $(".errorKewarganegaraan").html(data.warga);
                            $(".errorJenisKelamin").html(data.jk);
                            $(".errorEmailPribadi").html(data.email);
                            $(".errorNoTelp").html(data.telp);
                            $(".errorNoBPJSTK").html(data.bpjs_tk);
                            $(".errorNoBPJSKES").html(data.bpjs_kes);
                            $(".errorNoNPWP").html(data.npwp);
                            $(".errorNoKK").html(data.nokk);
                            $(".errorNamaIbu").html(data.namaibu);
                            swal("Error", "Tidak dapat melanjutkan, lengkapi data personal.", "error");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat menyimpan data, hubungi administrator");
                        }
                    }
                });
                $(".errormsg").fadeTo(3000, 500).slideUp(500, function() {
                    $(".errormsg").slideUp(500);
                    $(".errormsg").addClass("d-none");
                });
            });
            $("#addKembaliPekerjaan").click(function() {
                $('#colKaryawan').collapse("hide");
                $('#colPersonal').collapse("show");
            });
            $("#addSimpanPekerjaan").click(function() {
                let noktp = $("#noKTP").val();
                let nama = $("#namaLengkap").val();
                let alamat = $("#alamatKTP").val();
                let rt = $("#rtKTP").val();
                let rw = $("#rwKTP").val();
                let id_prov = $("#provData").val();
                let id_kab = $("#kotaData").val();
                let id_kec = $("#kecData").val();
                let id_kel = $("#kelData").val();
                let tmp_lahir = $("#tempatLahir").val();
                let tgl_lahir = $("#tanggalLahir").val();
                let stat_nikah = $("#statPernikahan").val();
                let id_agama = $("#addagama").val();
                let warga = $("#kewarganegaraan").val();
                let jk = $("#jenisKelamin").val();
                let email = $("#emailPribadi").val();
                let telp = $("#noTelp").val();
                let bpjs_tk = $("#noBPJSTK").val();
                let bpjs_kes = $("#noBPJSKES").val();
                let npwp = $("#noNPWP").val();
                let nokk = $("#noKK").val();
                let namaibu = $("#namaIbu").val();
                let id_pendidikan = $("#pendidikanTerakhir").val();
                let no_nik = $("#addNIKKary").val();
                let depart = $("#addDepartKary").val();
                let posisi = $("#addPosisiKary").val();
                let doh = $("#addDOH").val();
                let tgl_aktif = $("#addTanggalAktif").val();
                let id_lokker = $("#addLokasiKerja").val();
                let id_lokterima = $("#addLokterimaKary").val();
                let id_poh = $("#addPOHKary").val();
                let id_klasifikasi = $("#addKlasifikasiKary").val();
                let id_tipe = $("#addJenisKaryawan").val();
                let id_grade = $("#addGradeKary").val();
                let stat_tinggal = $("#addStatusResidence").val();
                let stat_kerja = $("#addStatusKaryawan").val();
                let tgl_permanen = $("#addTanggalPermanen").val();
                let tgl_mulai_kontrak = $("#addTanggalKontrakAwal").val();
                let tgl_akhir_kontrak = $("#addTanggalKontrakAkhir").val();
                let id_m_perusahaan = $("#addPerKary").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("karyawan/addkaryawan") ?>",
                    data: {
                        noktp: noktp,
                        nama: nama,
                        alamat: alamat,
                        rt: rt,
                        rw: rw,
                        id_prov: id_prov,
                        id_kab: id_kab,
                        id_kec: id_kec,
                        id_kel: id_kel,
                        tmp_lahir: tmp_lahir,
                        tgl_lahir: tgl_lahir,
                        stat_nikah: stat_nikah,
                        id_agama: id_agama,
                        warga: warga,
                        jk: jk,
                        email: email,
                        telp: telp,
                        bpjs_tk: bpjs_tk,
                        bpjs_kes: bpjs_kes,
                        npwp: npwp,
                        nokk: nokk,
                        namaibu: namaibu,
                        id_pendidikan: id_pendidikan,
                        no_nik: no_nik,
                        depart: depart,
                        posisi: posisi,
                        doh: doh,
                        tgl_aktif: tgl_aktif,
                        id_lokker: id_lokker,
                        id_lokterima: id_lokterima,
                        id_poh: id_poh,
                        id_klasifikasi: id_klasifikasi,
                        id_tipe: id_tipe,
                        id_grade: id_grade,
                        stat_tinggal: stat_tinggal,
                        stat_kerja: stat_kerja,
                        tgl_permanen: tgl_permanen,
                        tgl_mulai_kontrak: tgl_mulai_kontrak,
                        tgl_akhir_kontrak: tgl_akhir_kontrak,
                        id_m_perusahaan: id_m_perusahaan,
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $('#colPersonal').collapse("hide");
                            $('#colKaryawan').collapse("hide");
                            $('#colIzinTambang').collapse("show");
                            $("#idizintambang").load("<?= base_url('karyawan/izin_tambang'); ?>");
                            $('#imgKaryawan').removeClass("d-none");
                        } else if (data.statusCode == 201) {
                            $(".errormsg").removeClass('d-none');
                            $(".errormsg").removeClass('alert-primary');
                            $(".errormsg").addClass('alert-danger');
                            $(".errormsg").html(data.pesan);
                        } else {
                            $(".erroraddNIKKary").html(data.no_nik);
                            $(".errorAddDepartKary").html(data.depart);
                            $(".errorAddPosisiKary").html(data.posisi);
                            $(".errorAddKlasifikasiKary").html(data.id_klasifikasi);
                            $(".erroraddPOHKary").html(data.id_poh);
                            $(".erroraddLokterimaKary").html(data.id_lokterima);
                            $(".erroraddLokasiKerja").html(data.id_lokker);
                            $(".erroraddJenisKaryawan").html(data.id_tipe);
                            $(".erroraddGradeKary").html(data.id_grade);
                            $(".erroraddStatusResidence").html(data.stat_tinggal);
                            $(".erroraddDOH").html(data.doh);
                            $(".erroraddTanggalAktif").html(data.tgl_aktif);
                            $(".erroraddStatusKaryawan").html(data.stat_kerja);
                            $(".erroraddTanggalPermanen").html(data.pesan);
                            $(".erroraddTanggalKontrakAwal").html(data.pesan1);
                            $(".erroraddTanggalKontrakAkhir").html(data.pesan2);
                            swal("Error", "Tidak dapat melanjutkan, lengkapi data karyawan.", "error");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat menyimpan data, hubungi administrator");
                        }
                    }
                });

                $(".errormsg").fadeTo(3000, 500).slideUp(500, function() {
                    $(".errormsg").slideUp(500);
                    $(".errormsg").addClass("d-none");
                });
            });

            $('#addJenisIzin').change(function() {
                let jenisizin = $('#addJenisIzin').val();

                if (jenisizin == "SP") {
                    $('#txtsim').removeClass('d-none');
                } else {
                    $('#txtsim').addClass('d-none');
                }
            });

            $("#addSimpanIzinUnit").click(function() {
                let jenisizin = $("#addJenisIzin").val();
                let noreg = $("#addNoReg").val();
                let tglexp = $("#addTglExp").val();
                let jenissim = $("#addJenisSIM").val();
                let tglexpsim = $("#addTglExpSIM").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("karyawan/addsimper") ?>",
                    data: {
                        jenisizin: jenisizin,
                        noreg: noreg,
                        tglexp: tglexp,
                        jenissim: jenissim,
                        tglexpsim: tglexpsim
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $('#colPersonal').collapse("hide");
                            $('#colKaryawan').collapse("hide");
                            $('#colIzinTambang').collapse("hide");
                            $('#colSertifikasi').collapse("show");
                            $('#imgIzinTambang').removeClass("d-none");
                        } else if (data.statusCode == 201) {
                            $(".errormsg").removeClass('d-none');
                            $(".errormsg").removeClass('alert-primary');
                            $(".errormsg").addClass('alert-danger');
                            $(".errormsg").html(data.pesan);
                        } else {
                            $(".erroraddJenisIzin").html(data.jenisizin);
                            $(".erroraddNoReg").html(data.noreg);
                            $(".erroraddTglExp").html(data.tglexp);
                            $(".erroraddJenisSIM").html(data.jenissim);
                            $(".erroraddTglExpSIM").html(data.tglexpsim);
                            swal("Error", "Tidak dapat melanjutkan, lengkapi data SIMPER/Mine Permit.", "error");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat menyimpan data SIMPER/Mine Permit, hubungi administrator");
                        }
                    }
                });

                $(".errormsg").fadeTo(3000, 500).slideUp(500, function() {
                    $(".errormsg").slideUp(500);
                    $(".errormsg").addClass("d-none");
                });
            });

            $("#addSimpanSertifikasi").click(function() {
                let jenissrt = $("#jenisSertifikasi").val();
                let nosrt = $("#noSertifikat").val();
                let tglsrt = $("#tanggalSertifikasi").val();
                let tglexp = $("#tanggalSertifikasiAkhir").val();
                let namalembaga = $("#namaLembaga").val();
                let filesrt = $("#fileSertifikasi").val();
                const flsert = $('#fileSertifikasi').prop('files')[0];

                let formData = new FormData();
                formData.append('filesertifikat', flsert);
                formData.append('filesrt', filesrt);
                formData.append('jenissrt', jenissrt);
                formData.append('nosrt', nosrt);
                formData.append('tglsrt', tglsrt);
                formData.append('tglexp', tglexp);
                formData.append('namalembaga', namalembaga);
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('karyawan/addsertifikasi'); ?>",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#jenisSertifikasi").val('').trigger("change");
                            $("#noSertifikat").val('');
                            $("#tanggalSertifikasi").val('');
                            $("#masaBerlakuSertifikat").val('');
                            $("#tanggalSertifikasiAkhir").val('');
                            $("#fileSertifikasi").val('');
                            $("#namaLembaga").val('');
                            $(".errorFileSertifikasi").html("");
                            $(".errorjenisSertifikasi").html('');
                            $(".errorNoSertifikat").html('');
                            $(".errorTanggalSertifikasi").html('');
                            $(".errorTanggalSertifikasiAkhir").html('');
                            $(".errorFileSertifikasi").html('');
                            $(".errorNamaLembaga").html('');
                            $("#idsertifikat").load("<?= base_url('karyawan/sertifikasi'); ?>");
                        } else if (data.statusCode == 201) {
                            $(".errSertifikasi").removeClass('d-none');
                            $(".errSertifikasi").removeClass('alert-primary');
                            $(".errSertifikasi").addClass('alert-danger');
                            $(".errSertifikasi").html(data.pesan);
                        } else {
                            $(".errorjenisSertifikasi").html(data.jenissrt);
                            $(".errorNoSertifikat").html(data.nosrt);
                            $(".errorTanggalSertifikasi").html(data.tglsrt);
                            $(".errorTanggalSertifikasiAkhir").html(data.tglexp);
                            $(".errorFileSertifikasi").html(data.filesrt);
                            $(".errorNamaLembaga").html(data.namalembaga);
                            swal("Error", "Tidak dapat melanjutkan, lengkapi data sertifikasi.", "error");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat menyimpan data sertifikat, hubungi administrator");
                        }
                    }
                });
            });

            $("#addKembaliIzinUnit").click(function() {
                $('#colKaryawan').collapse("show");
                $('#colIzinTambang').collapse("hide");
            });

            $("#addLanjutSertifikasi").click(function() {
                $('#colPersonal').collapse("hide");
                $('#colKaryawan').collapse("hide");
                $('#colIzinTambang').collapse("hide");
                $('#colSertifikasi').collapse("hide");
                $('#colMCU').collapse("show");
                $('#imgSertifikasi').removeClass("d-none");
            });

            $("#addbtnkembaliSertifikat").click(function() {
                $('#colSertifikasi').collapse("hide");
                $('#colIzinTambang').collapse("show");
            });

            $("#addbtnkembaliMCU").click(function() {
                $('#colMCU').collapse("hide");
                $('#colSertifikasi').collapse("show");
            });

            $("#addSimpanMCU").click(function() {
                let tglmcu = $("#tglMCU").val();
                let hasilmcu = $("#hasilMCU").val();
                let ketmcu = $("#ketMCU").val();
                let fileMCU = $("#fileMCU").val();
                const flMCU = $('#fileMCU').prop('files')[0];

                let formData = new FormData();
                formData.append('filemedik', flMCU);
                formData.append('ketmcu', ketmcu);
                formData.append('hasilmcu', hasilmcu);
                formData.append('tglmcu', tglmcu);
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('karyawan/addmcu'); ?>",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $(".errorTglMCU").html('');
                            $(".errorHasilMCU").html('');
                            $(".errorKetMCU").html('');
                            $(".errorFileMCU").html('');
                            $("#colVaksin").collapse("show");
                            $("#colMCU").collapse("hide");
                            $('#imgMCU').removeClass("d-none");
                        } else if (data.statusCode == 201) {
                            $(".errMCU").removeClass('d-none');
                            $(".errMCU").removeClass('alert-primary');
                            $(".errMCU").addClass('alert-danger');
                            $(".errMCU").html(data.pesan);
                        } else {
                            $(".errorTglMCU").html(data.tglmcu);
                            $(".errorHasilMCU").html(data.hasilmcu);
                            $(".errorKetMCU").html(data.ketmcu);
                            if (fileMCU == "") {
                                $(".errorFileMCU").html('File MCU wajib di-upload');
                            } else {
                                $(".errorFileMCU").html('');
                            }
                            swal("Error", "Tidak dapat melanjutkan, lengkapi data Medical Check Up (MCU).", "error");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errMCU").html("Terjadi kesalahan saat menyimpan data MCU, hubungi administrator");
                        }
                    }
                });

                $(".errormsg").fadeTo(3000, 500).slideUp(500, function() {
                    $(".errormsg").slideUp(500);
                    $(".errormsg").addClass("d-none");
                });
            });

            $("#addbtnkembalivaksin").click(function() {
                $('#colVaksin').collapse("hide");
                $('#colMCU').collapse("show");
            });

            $("#addLanjutkanVaksin").click(function() {
                $('#colVaksin').collapse("hide");
                $('#colFilePendukung').collapse("show");
                $('#imgVaksin').removeClass("d-none");
            });

            $("#addSimpanVaksin").click(function() {
                let jenisvaksin = $("#jenisVaksin").val();
                let namavaksin = $("#namaVaksin").val();
                let tglvaksin = $("#tanggalVaksin").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("karyawan/addvaksin") ?>",
                    data: {
                        jenisvaksin: jenisvaksin,
                        namavaksin: namavaksin,
                        tglvaksin: tglvaksin
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#idvaksin").LoadingOverlay("show");
                            $("#idvaksin").load("<?= base_url('karyawan/vaksin'); ?>");
                        } else if (data.statusCode == 201) {
                            $(".errormsg").removeClass('d-none');
                            $(".errormsg").removeClass('alert-primary');
                            $(".errormsg").addClass('alert-danger');
                            $(".errormsg").html(data.pesan);
                        } else {
                            $(".errorJenisVaksin").html(data.jenisvaksin);
                            $(".errorNamaVaksin").html(data.namavaksin);
                            $(".errorTanggalVaksin").html(data.tglvaksin);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat menyimpan data vaksin, hubungi administrator");
                        }
                    }
                });

                $(".errormsg").fadeTo(3000, 500).slideUp(500, function() {
                    $(".errormsg").slideUp(500);
                    $(".errormsg").addClass("d-none");
                });
            });

            $("#addbtnkembaliFile").click(function() {
                $('#colFilePendukung').collapse("hide");
                $('#colVaksin').collapse("show");
            });

            $('#addUploadFileSelesai').click(function() {
                let filepdukung = $('#filePendukung').val();
                const fldukung = $('#filePendukung').prop('files')[0];

                if (filepdukung == "") {
                    $(".errfilependukung").removeClass('d-none');
                    $(".errfilependukung").removeClass('alert-primary');
                    $(".errfilependukung").addClass('alert-danger');
                    $(".errfilependukung").html('File pendukung wajib di upload');

                    $(".errfilependukung").fadeTo(3000, 500).slideUp(500, function() {
                        $(".errfilependukung").slideUp(500);
                        $(".errfilependukung").addClass("d-none");
                        $(".errfilependukung").html('');
                    });
                    return;
                }

                swal({
                    title: "Simpan Data",
                    text: "Yakin data karyawan akan disimpan?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#36c6d3',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, simpan',
                    cancelButtonText: 'Batalkan'
                }).then(function(result) {
                    if (result.value) {
                        $.LoadingOverlay("show");
                        let formData = new FormData();
                        formData.append('filePendukung', fldukung);
                        $.ajax({
                            type: 'POST',
                            url: "<?= base_url('karyawan/addfilependukung'); ?>",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    $.LoadingOverlay("hide");
                                    $(".errorFilePendukung").html("");
                                    $("#fileUpload").val("");
                                    window.location.href = "<?= base_url('karyawan/new'); ?>";
                                } else {
                                    $.LoadingOverlay("hide");
                                    $(".errorFilePendukung").css("display", "block");
                                    $(".errorFilePendukung").removeClass("alert-primary]");
                                    $(".errorFilePendukung").addClass("alert-danger");
                                    $(".errorFilePendukung").css("display", "block");
                                    $(".errorFilePendukung").html(data.pesan);
                                }
                            }
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'Data karyawan batal disimpan', 'warning');
                        return false;
                    }
                });
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
                        "data": 'no_ktp',
                        "className": "align-middle align-middle",
                    },
                    {
                        "data": 'no_nik',
                        "className": "align-middle align-middle",
                    },
                    {
                        "data": 'nama_lengkap',
                        "className": "align-middle align-middle",
                    },
                    {
                        "data": 'depart',
                        "className": "text-wrap align-middle",
                    },
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
    });
</script>