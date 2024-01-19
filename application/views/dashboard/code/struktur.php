<script>
    //========================================== Level ========================================================
    $(document).ready(function() {
        $(".err_psn_prs_str ").fadeTo(3000, 500).slideUp(500, function() {
            $(".err_psn_prs_str ").slideUp(500);
            $(".err_psn_prs_str ").addClass("d-none");
        });

        $("#cariMPerusahaan").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url('perusahaan/getPerusahaan') ?>",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        var jenisper = $("#jenisPerusahaan").val();
                        var perjenis = $("#perJenis").val();

                        if (jenisper !== "" && perjenis !== "") {
                            response(data);
                        }
                    }
                });
            },
            select: function(event, ui) {
                $('#namaMperusahaan').val(ui.item.label);
                $('#kodeMperusahaan').val(ui.item.kode);
                $('#jlasd1233').val(ui.item.value);
                $("#cariMPerusahaan").val('');
                return false;
            }
        });

        $.LoadingOverlay("hide");

        $('#jenisPerusahaan').select2({
            theme: 'bootstrap4'
        });

        $('#perJenis').select2({
            theme: 'bootstrap4'
        });

        $('#perJenis').change(function() {
            let auth_per = $('#perJenis').val();

            if (auth_per === "") {
                $('#jkau092321').val('');
            } else {
                $('#jkau092321').val(auth_per);
            }
        });

        $.ajax({
            type: "POST",
            url: "<?= base_url("perusahaan/get_m_all") ?>",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#perLevel").html(data.prs);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".err_psn_level").removeClass('d-none');
                $(".err_psn_level").removeClass('alert-info');
                $(".err_psn_level").addClass('alert-danger');
                if (thrownError != "") {
                    $(".err_psn_level").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                    $("#btnTambahLevel").attr("disabled", true);
                }
            }
        })

        $('#jenisPerusahaan').change(function() {
            let id_jenis = $("#jenisPerusahaan").val();
            $('#jkau092321').val('');
            $.ajax({
                type: "POST",
                url: "<?= base_url("struktur/get_by_idjenis") ?>",
                data: {
                    id_jenis: id_jenis
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#perJenis").html(data.per);
                }
            })
        });

        $(document).on('click', '.hpslevel', function() {
            let authlevel = $(this).attr('id');
            let namaLevel = $(this).attr('value');

            if (authlevel == "") {
                swal("Error", "Level tidak ditemukan", "error");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin Level " + namaLevel + " akan dihapus?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#36c6d3',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batalkan'
                }).then(function(result) {
                    if (result.value) {
                        $.LoadingOverlay("show");
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Level/hapus_Level'); ?>",
                            data: {
                                authlevel: authlevel
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmLevel.draw();
                                    $(".err_psn_level").removeClass("alert-danger");
                                    $(".err_psn_level").addClass("alert-primary");
                                    $(".err_psn_level").css("display", "block");
                                    $(".err_psn_level").html(data.pesan);
                                } else {
                                    $(".err_psn_level").removeClass("alert-primary");
                                    $(".err_psn_level").addClass("alert-danger");
                                    $(".err_psn_level").css("display", "block");
                                    $(".err_psn_level").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_level").removeClass("alert-primary");
                                $(".err_psn_level").addClass("alert-danger");
                                $(".err_psn_level").css("display", "block");
                                if (xhr.status == 404) {
                                    $(".err_psn_level").html("Level gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_level").html("Level gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_level").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_level").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_psn_level").slideUp(500);
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'Level ' + namaLevel + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtllevel', function() {
            let authlevel = $(this).attr('id');
            let namalevel = $(this).attr('value');

            if (authlevel == "") {
                swal("Error", "Level tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('Level/detail_Level'); ?>",
                    data: {
                        authlevel: authlevel
                    },
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#detailLevelPerusahaan").val(data.nama_perusahaan);
                            $("#detailLevelDepart").val(data.depart);
                            $("#detailLevelKode").val(data.kode);
                            $("#detailLevel").val(data.level);
                            $("#detailLevelStatus").val(data.status);
                            $("#detailLevelKet").val(data.ket);
                            $("#detailLevelBuat").val(data.pembuat);
                            $("#detailLevelTglBuat").val(data.tgl_buat);
                            $("#detailLevelmdl").modal("show");
                        } else {
                            $(".err_psn_level").css("display", "block");
                            $(".err_psn_level").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_level").removeClass("alert-primary");
                        $(".err_psn_level").addClass("alert-danger");
                        $(".err_psn_level").css("display", "block");
                        if (xhr.status == 404) {
                            $(".err_psn_level").html("Level gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_level").html("Level gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_level").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_level ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_level ").slideUp(500);
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edttlevel', function() {
            let authlevel = $(this).attr('id');
            let namaLevel = $(this).attr('value');

            if (authlevel == "") {
                swal("Error", "Level tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('Level/detail_Level'); ?>",
                    data: {
                        authlevel: authlevel
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataLevel = JSON.parse(data);
                        if (dataLevel.statusCode == 200) {
                            $("#editLevelKode").val(dataLevel.kode);
                            $("#editLevel").val(dataLevel.level);
                            $("#editLevelStatus").val(dataLevel.status);
                            $("#editLevelKet").val(dataLevel.ket);
                            $("#editLevelmdl").modal("show");
                            $("#error1el").html('');
                            $("#error2el").html('');
                            $("#error3el").html('');
                            $("#error4el").html('');
                        } else {
                            $(".err_psn_level").css("display", "block");
                            $(".err_psn_level").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_level").removeClass("alert-primary");
                        $(".err_psn_level").addClass("alert-danger");
                        $(".err_psn_level").css("display", "block");
                        if (xhr.status == 404) {
                            $(".err_psn_level").html("Level gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_level").html("Level gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_level").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_level ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_level ").slideUp(500);
                        });
                    }
                });
            }
        });

    });
</script>