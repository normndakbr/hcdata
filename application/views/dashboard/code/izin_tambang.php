<script>
    //========================================== izin_tambang ========================================================
    $(document).ready(function() {
        $('#btnupdateizin_tambang').click(function() {
            let izin_tambang = $('#editizin_tambang').val();
            let status = $('#editizin_tambangStatus').val();
            let ket = $('#editizin_tambangKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('izin_tambang/edit_izin_tambang'); ?>",
                data: {
                    izin_tambang: izin_tambang,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmizin_tambang.draw();
                        $("#editizin_tambangmdl").modal("hide");
                        $(".err_psn_izin_tambang").removeClass('d-none');
                        $(".err_psn_izin_tambang").removeClass('alert-danger');
                        $(".err_psn_izin_tambang").addClass('alert-info');
                        $(".err_psn_izin_tambang").html(data.pesan);
                        $("#editizin_tambang").val('');
                        $("#editizin_tambangKet").val('');
                        $("#editizin_tambangStatus").val('');
                        $("#error1ebk").html('');
                        $("#error2ebk").html('');
                        $("#error3ebk").html('');
                        $("#error4ebk").html('');
                        $(".err_psn_izin_tambang").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_izin_tambang").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_izin_tambang").removeClass('d-none');
                        $(".err_psn_edit_izin_tambang").removeClass('alert-info');
                        $(".err_psn_edit_izin_tambang").addClass('alert-danger');
                        $(".err_psn_edit_izin_tambang").html(data.pesan);
                        $(".err_psn_edit_izin_tambang").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_izin_tambang").slideUp(500);
                        });
                        $("#error2ebk").html('');
                        $("#error3ebk").html('');
                        $("#error4ebk").html('');
                    } else if (data.statusCode == 202) {
                        $("#error2ebk").html(data.izin_tambang);
                        $("#error3ebk").html(data.status);
                        $("#error4ebk").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_izin_tambang").removeClass("alert-primary");
                    $(".err_psn_izin_tambang").addClass("alert-danger");
                    $(".err_psn_izin_tambang").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_izin_tambang").html("izin_tambang gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_izin_tambang").html("izin_tambang gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_izin_tambang").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }

                    $("#editizin_tambangmdl").modal("hide");
                    $(".err_psn_izin_tambang ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_izin_tambang ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        $("#btnBatalizin_tambang").click(function() {
            $("#izin_tambang").val('');
            $("#ketizin_tambang").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
        });

        $("#btnTambahizin_tambang").click(function() {
            var izin_tambang = $("#izin_tambang").val();
            var ket = $("#ketizin_tambang").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url("izin_tambang/input_izin_tambang") ?>",
                data: {
                    izin_tambang: izin_tambang,
                    ket: ket
                },
                timeout: 20000,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $(".err_psn_izin_tambang").removeClass('d-none');
                        $(".err_psn_izin_tambang").removeClass('alert-danger');
                        $(".err_psn_izin_tambang").addClass('alert-info');
                        $(".err_psn_izin_tambang").html(data.pesan);
                        $("#izin_tambang").val('');
                        $("#ketizin_tambang").val('');
                        $(".error2").html('');
                        $(".error3").html('');
                    } else if (data.statusCode == 201) {
                        $(".err_psn_izin_tambang").removeClass('d-none');
                        $(".err_psn_izin_tambang").removeClass('alert-info');
                        $(".err_psn_izin_tambang").addClass('alert-danger');
                        $(".err_psn_izin_tambang").html(data.pesan);
                    } else if (data.statusCode == 202) {
                        $(".error2").html(data.izin_tambang);
                        $(".error3").html(data.ket);
                    }

                    $(".err_psn_izin_tambang").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_izin_tambang").slideUp(500);
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_izin_tambang").removeClass('d-none');
                    $(".err_psn_izin_tambang").removeClass("alert-primary");
                    $(".err_psn_izin_tambang").addClass("alert-danger");
                    if (xhr.status == 404) {
                        $(".err_psn_izin_tambang").html("izin_tambang gagal disimpan, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_izin_tambang").html("izin_tambang gagal disimpan, Waktu koneksi habis");
                    } else {
                        $(".err_psn_izin_tambang").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                    }

                    $(".err_psn_izin_tambang ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_izin_tambang ").slideUp(500);
                    });
                }
            })
        });

        $(document).on('click', '.hpsizin_tambang', function() {
            let auth_izin_tambang = $(this).attr('id');
            let namaizin_tambang = $(this).attr('value');

            if (auth_izin_tambang == "") {
                $(".err_psn_izin_tambang").removeClass("alert-primary");
                $(".err_psn_izin_tambang").addClass("alert-danger");
                $(".err_psn_izin_tambang").removeClass('d-none');
                $(".err_psn_izin_tambang").html("izin_tambang tidak ditemukan");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin " + namaizin_tambang + " akan dihapus?",
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
                            url: "<?= base_url('izin_tambang/hapus_izin_tambang'); ?>",
                            data: {
                                auth_izin_tambang: auth_izin_tambang
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmizin_tambang.draw();
                                    $(".err_psn_izin_tambang").removeClass("alert-danger");
                                    $(".err_psn_izin_tambang").addClass("alert-primary");
                                    $(".err_psn_izin_tambang").removeClass('d-none');
                                    $(".err_psn_izin_tambang").html(data.pesan);
                                } else {
                                    $(".err_psn_izin_tambang").removeClass("alert-primary");
                                    $(".err_psn_izin_tambang").addClass("alert-danger");
                                    $(".err_psn_izin_tambang").removeClass('d-none');
                                    $(".err_psn_izin_tambang").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_izin_tambang").removeClass("alert-primary");
                                $(".err_psn_izin_tambang").addClass("alert-danger");
                                $(".err_psn_izin_tambang").removeClass('d-none');
                                if (xhr.status == 404) {
                                    $(".err_psn_izin_tambang").html("izin_tambang gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_izin_tambang").html("izin_tambang gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_izin_tambang").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_izin_tambang").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_psn_izin_tambang").slideUp(500);
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'izin_tambang ' + namaizin_tambang + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtlizin_tambang', function() {
            let auth_izin_tambang = $(this).attr('id');
            let namaizin_tambang = $(this).attr('value');

            if (auth_izin_tambang == "") {
                $(".err_psn_izin_tambang").removeClass("alert-primary");
                $(".err_psn_izin_tambang").addClass("alert-danger");
                $(".err_psn_izin_tambang").removeClass('d-none');
                $(".err_psn_izin_tambang").html("izin_tambang tidak ditemukan");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('izin_tambang/detail_izin_tambang'); ?>",
                    data: {
                        auth_izin_tambang: auth_izin_tambang
                    },
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#detailizin_tambang").val(data.izin_tambang);
                            $("#detailizin_tambangStatus").val(data.status);
                            $("#detailizin_tambangKet").val(data.ket);
                            $("#detailizin_tambangBuat").val(data.pembuat);
                            $("#detailizin_tambangTglBuat").val(data.tgl_buat);
                            $("#detailizin_tambangmdl").modal("show");
                        } else {
                            $(".err_psn_izin_tambang").removeClass('d-none');
                            $(".err_psn_izin_tambang").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_izin_tambang").removeClass("alert-primary");
                        $(".err_psn_izin_tambang").addClass("alert-danger");
                        $(".err_psn_izin_tambang").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_izin_tambang").html("izin_tambang gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_izin_tambang").html("izin_tambang gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_izin_tambang").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_izin_tambang ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_izin_tambang ").slideUp(500);
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edttizin_tambang', function() {
            let auth_izin_tambang = $(this).attr('id');
            let namaizin_tambang = $(this).attr('value');

            if (auth_izin_tambang == "") {
                swal("Error", "izin_tambang tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('izin_tambang/detail_izin_tambang'); ?>",
                    data: {
                        auth_izin_tambang: auth_izin_tambang
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataizin_tambang = JSON.parse(data);
                        if (dataizin_tambang.statusCode == 200) {
                            $("#editizin_tambang").val(dataizin_tambang.izin_tambang);
                            $("#editizin_tambangStatus").val(dataizin_tambang.status);
                            $("#editizin_tambangKet").val(dataizin_tambang.ket);
                            $("#editizin_tambangmdl").modal("show");
                            $("#error1et").html('');
                            $("#error2et").html('');
                            $("#error3et").html('');
                            $("#error4et").html('');
                        } else {
                            $(".err_psn_izin_tambang").removeClass('d-none');
                            $(".err_psn_izin_tambang").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_izin_tambang").removeClass("alert-primary");
                        $(".err_psn_izin_tambang").addClass("alert-danger");
                        $(".err_psn_izin_tambang").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_izin_tambang").html("izin_tambang gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_izin_tambang").html("izin_tambang gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_izin_tambang").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_izin_tambang ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_izin_tambang ").slideUp(500);
                        });
                    }
                });
            }
        });

        $("#btnrefreshizin_tambang").click(function() {
            $('#tbmizin_tambang').LoadingOverlay("show");
            tbmizin_tambang.draw()
            $('#tbmizin_tambang').LoadingOverlay("hide");
        });

        tbmizin_tambang = $('#tbmizin_tambang').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [1, 'asc'],
            ],
            "ajax": {
                "url": "<?= base_url('izin_tambang/ajax_list'); ?>",
                "type": "POST",
                "error": function(xhr, error, code) {
                    if (code != "") {
                        $(".err_psn_izin_tambang").removeClass("d-none");
                        $(".err_psn_izin_tambang").removeClass('d-none');
                        $(".err_psn_izin_tambang").html("terjadi kesalahan saat melakukan load data izin_tambang, hubungi administrator");
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
                    name: 'id_izin_tambang',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "className": "text-center align-middle",
                    "width": "1%"
                },
                {
                    "data": 'izin_tambang',
                    "className": "text-nowrap align-middle",
                    "width": "50%"
                },
                {
                    "data": 'stat_izin_tambang',
                    "className": "text-center align-middle",
                    "width": "1%"
                },
                {
                    "data": 'tgl_buat',
                    "className": "text-center text-nowrap align-middle",
                    "width": "8%"
                },
                {
                    "data": 'proses',
                    "className": "text-center text-nowrap align-middle",
                    "width": "1%"
                }
            ]
        });
    });
</script>