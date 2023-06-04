<script>
    //========================================== Level ========================================================
    $(document).ready(function() {
        $('#btnupdateLevel').click(function() {
            let kode = $('#editLevelKode').val();
            let level = $('#editLevel').val();
            let status = $('#editLevelStatus').val();
            let ket = $('#editLevelKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('Level/edit_Level'); ?>",
                data: {
                    kode: kode,
                    level: level,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmLevel.draw();
                        $("#editLevelmdl").modal("hide");
                        $(".err_psn_level").removeClass('d-none');
                        $(".err_psn_level").removeClass('alert-danger');
                        $(".err_psn_level").addClass('alert-info');
                        $(".err_psn_level").html(data.pesan);
                        $("#editLevelKode").val('');
                        $("#editLevel").val('');
                        $("#editLevelKet").val('');
                        $("#editLevelStatus").val('');
                        $("#error1el").html('');
                        $("#error2el").html('');
                        $("#error3el").html('');
                        $("#error4el").html('');
                        $(".err_psn_level").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_level").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_Level").removeClass('d-none');
                        $(".err_psn_edit_Level").removeClass('alert-info');
                        $(".err_psn_edit_Level").addClass('alert-danger');
                        $(".err_psn_edit_Level").html(data.pesan);
                        $(".err_psn_edit_Level").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_Level").slideUp(500);
                        });
                        $("#error1el").html('');
                        $("#error2el").html('');
                        $("#error3el").html('');
                        $("#error4el").html('');
                    } else if (data.statusCode == 202) {
                        $("#error1el").html(data.kode);
                        $("#error2el").html(data.level);
                        $("#error3el").html(data.status);
                        $("#error4el").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_level").removeClass("alert-primary");
                    $(".err_psn_level").addClass("alert-danger");
                    $(".err_psn_level").css("display", "block");
                    if (xhr.status == 404) {
                        $(".err_psn_level").html("Level gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_level").html("Level gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_level").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }
                    $("#editLevelmdl").modal("hide");
                    $(".err_psn_level ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_level ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        $("#btnBatalLevel").click(function() {
            $("#perLevel").val('').trigger('change');
            $("#kodeLevel").val('');
            $("#Level").val('');
            $("#ketLevel").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
            $(".error4").html('');
            $(".error5").html('');
        });

        $(document).ready(function() {
            $('#perLevel').select2({
                theme: 'bootstrap4'
            });

            $.ajax({
                type: "POST",
                url: "<?= base_url("perusahaan/get_all") ?>",
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

            $('#perLevel').change(function() {
                let auth_per = $("#perLevel").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("departemen/get_by_authper") ?>",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#depLevel").html(data.dprt);
                    }
                })
            });
            $("#btnTambahLevel").click(function() {
                var prs = $("#perLevel").val();
                var kode = $("#kodeLevel").val();
                var level = $("#Level").val();
                var ket = $("#ketLevel").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("Level/input_Level") ?>",
                    data: {
                        prs: prs,
                        kode: kode,
                        level: level,
                        ket: ket
                    },
                    timeout: 20000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $(".err_psn_level").removeClass('d-none');
                            $(".err_psn_level").removeClass('alert-danger');
                            $(".err_psn_level").addClass('alert-info');
                            $(".err_psn_level").html(data.pesan);
                            $("#perLevel").val('').trigger('change');
                            $("#kodeLevel").val('');
                            $("#Level").val('');
                            $("#ketLevel").val('');
                            $(".error1").html('');
                            $(".error2").html('');
                            $(".error3").html('');
                            $(".error4").html('');
                        } else if (data.statusCode == 201) {
                            $(".err_psn_level").removeClass('d-none');
                            $(".err_psn_level").removeClass('alert-info');
                            $(".err_psn_level").addClass('alert-danger');
                            $(".err_psn_level").html(data.pesan);
                        } else if (data.statusCode == 202) {
                            $(".error1").html(data.prs);
                            $(".error2").html(data.kode);
                            $(".error3").html(data.level);
                            $(".error4").html(data.ket);
                        }

                        $(".err_psn_level").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_level").slideUp(500);
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_level").removeClass("alert-primary");
                        $(".err_psn_level").addClass("alert-danger");
                        $(".err_psn_level").css("display", "block");
                        if (xhr.status == 404) {
                            $(".err_psn_level").html("Level gagal disimpan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_level").html("Level gagal disimpan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_level").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                        }

                        $(".err_psn_level ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_level ").slideUp(500);
                        });
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

            $("#btnrefreshLevel").click(function() {
                $('#tbmLevel').LoadingOverlay("show");
                tbmLevel.draw()
                $('#tbmLevel').LoadingOverlay("hide");
            });

            tbmLevel = $('#tbmLevel').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [1, 'asc'],
                ],
                "ajax": {
                    "url": "<?= base_url('Level/ajax_list'); ?>",
                    "type": "POST",
                    "error": function(xhr, error, code) {
                        if (code != "") {
                            $(".err_psn_level").removeClass("d-none");
                            $(".err_psn_level").css("display", "block");
                            $(".err_psn_level").html("terjadi kesalahan saat melakukan load data Level, hubungi administrator");
                            $("#secadd").addClass("disabled");
                        }
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 25, 50],
                    [10, 25, 50]
                ],
                "columns": [{
                        data: 'no',
                        name: 'id_Level',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center",
                        "width": "1%"
                    },
                    {
                        "data": 'kd_level',
                        "width": "10%"
                    },
                    {
                        "data": 'level',
                        "className": "text-nowrap",
                        "width": "25%"
                    },
                    {
                        "data": 'stat_level',
                        "className": "text-center text-nowrap",
                        "width": "1%"
                    },
                    {
                        "data": 'kode_perusahaan',
                        "className": "text-center text-nowrap",
                        "width": "1%"
                    },
                    {
                        "data": 'tgl_buat',
                        "className": "text-center text-nowrap",
                        "width": "8%"
                    },
                    {
                        "data": 'proses',
                        "className": "text-center text-nowrap",
                        "width": "1%"
                    }
                ]
            });
        });

    });
</script>