<script>
    //========================================== Sanksi ========================================================
    $(document).ready(function() {
        function resetedit() {
            $("#editSanksiKode").val('');
            $("#editSanksi").val('');
            $('#editMasaBerlaku').val();
            $("#editSanksiKet").val('');
            $("#editSanksiStatus").val('');
            $("#error1esk").html('');
            $("#error2esk").html('');
            $("#error3esk").html('');
            $("#error4esk").html('');
        }

        $('#btnupdateSanksi').click(function() {
            let kode = $('#editSanksiKode').val();
            let sanksi = $('#editSanksi').val();
            let jml_hari = $('#editMasaBerlaku').val();
            let status = $('#editSanksiStatus').val();
            let ket = $('#editSanksiKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('sanksi/edit_sanksi'); ?>",
                data: {
                    kode: kode,
                    sanksi: sanksi,
                    jml_hari: jml_hari,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmSanksi.draw();
                        $("#editSanksimdl").modal("hide");
                        $(".err_psn_sanksi").removeClass('d-none');
                        $(".err_psn_sanksi").removeClass('alert-danger');
                        $(".err_psn_sanksi").addClass('alert-info');
                        $(".err_psn_sanksi").html(data.pesan);
                        resetedit();
                        $(".err_psn_sanksi").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_sanksi").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_sanksi").removeClass('d-none');
                        $(".err_psn_edit_sanksi").removeClass('alert-info');
                        $(".err_psn_edit_sanksi").addClass('alert-danger');
                        $(".err_psn_edit_sanksi").html(data.pesan);
                        $(".err_psn_edit_sanksi").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_sanksi").slideUp(500);
                        });
                        $("#error1esk").html('');
                        $("#error2esk").html('');
                        $("#error3esk").html('');
                        $("#error4esk").html('');
                    } else if (data.statusCode == 202) {
                        $("#error1esk").html(data.kode);
                        $("#error2esk").html(data.sanksi);
                        $("#error3esk").html(data.status);
                        $("#error4esk").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_sanksi").removeClass("alert-primary");
                    $(".err_psn_sanksi").addClass("alert-danger");
                    $(".err_psn_sanksi").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_sanksi").html("Sanksi gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_sanksi").html("Sanksi gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_sanksi").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }

                    $("#editSanksimdl").modal("hide");
                    $(".err_psn_sanksi ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_sanksi ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        function resettambah() {
            $("#kodeSanksi").val('');
            $("#Sanksi").val('');
            $("#masaBerlakuSanksi").val('');
            $("#ketSanksi").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
            $(".error4").html('');
        }

        $("#btnBatalSanksi").click(function() {
            resettambah();
        });

        $("#btnTambahSanksi").click(function() {
            var kode = $("#kodeSanksi").val();
            var sanksi = $("#Sanksi").val();
            var jml_hari = $("#masaBerlakuSanksi").val();
            var ket = $("#ketSanksi").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url("sanksi/input_sanksi") ?>",
                data: {
                    kode: kode,
                    sanksi: sanksi,
                    jml_hari: jml_hari,
                    ket: ket
                },
                timeout: 20000,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $(".err_psn_sanksi").removeClass('d-none');
                        $(".err_psn_sanksi").removeClass('alert-danger');
                        $(".err_psn_sanksi").addClass('alert-info');
                        $(".err_psn_sanksi").html(data.pesan);
                        resettambah();
                    } else if (data.statusCode == 201) {
                        $(".err_psn_sanksi").removeClass('d-none');
                        $(".err_psn_sanksi").removeClass('alert-info');
                        $(".err_psn_sanksi").addClass('alert-danger');
                        $(".err_psn_sanksi").html(data.pesan);
                    } else if (data.statusCode == 202) {
                        $(".error1").html(data.kode);
                        $(".error2").html(data.sanksi);
                        $(".error3").html(data.jml_hari);
                        $(".error4").html(data.ket);
                    }

                    $(".err_psn_sanksi").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_sanksi").slideUp(500);
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_sanksi").removeClass('d-none');
                    $(".err_psn_sanksi").removeClass("alert-primary");
                    $(".err_psn_sanksi").addClass("alert-danger");
                    if (xhr.status == 404) {
                        $(".err_psn_sanksi").html("Sanksi gagal disimpan, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_sanksi").html("Sanksi gagal disimpan, Waktu koneksi habis");
                    } else {
                        $(".err_psn_sanksi").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                    }

                    $(".err_psn_sanksi ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_sanksi ").slideUp(500);
                    });
                }
            })
        });

        $(document).on('click', '.hpssanksi', function() {
            let auth_sanksi = $(this).attr('id');
            let namaSanksi = $(this).attr('value');

            if (auth_sanksi == "") {
                $(".err_psn_sanksi").removeClass("alert-primary");
                $(".err_psn_sanksi").addClass("alert-danger");
                $(".err_psn_sanksi").removeClass('d-none');
                $(".err_psn_sanksi").html("Sanksi tidak ditemukan");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin " + namaSanksi + " akan dihapus?",
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
                            url: "<?= base_url('sanksi/hapus_sanksi'); ?>",
                            data: {
                                auth_sanksi: auth_sanksi
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmSanksi.draw();
                                    $(".err_psn_sanksi").removeClass("alert-danger");
                                    $(".err_psn_sanksi").addClass("alert-primary");
                                    $(".err_psn_sanksi").removeClass('d-none');
                                    $(".err_psn_sanksi").html(data.pesan);
                                } else {
                                    $(".err_psn_sanksi").removeClass("alert-primary");
                                    $(".err_psn_sanksi").addClass("alert-danger");
                                    $(".err_psn_sanksi").removeClass('d-none');
                                    $(".err_psn_sanksi").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_sanksi").removeClass("alert-primary");
                                $(".err_psn_sanksi").addClass("alert-danger");
                                $(".err_psn_sanksi").removeClass('d-none');
                                if (xhr.status == 404) {
                                    $(".err_psn_sanksi").html("Sanksi gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_sanksi").html("Sanksi gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_sanksi").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_sanksi").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_psn_sanksi").slideUp(500);
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'Sanksi ' + namaSanksi + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtlsanksi', function() {
            let auth_sanksi = $(this).attr('id');
            let namaSanksi = $(this).attr('value');

            if (auth_sanksi == "") {
                $(".err_psn_sanksi").removeClass("alert-primary");
                $(".err_psn_sanksi").addClass("alert-danger");
                $(".err_psn_sanksi").removeClass('d-none');
                $(".err_psn_sanksi").html("Sanksi tidak ditemukan");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('sanksi/detail_sanksi'); ?>",
                    data: {
                        auth_sanksi: auth_sanksi
                    },
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#detailSanksiKode").val(data.kode);
                            $("#detailSanksi").val(data.sanksi);
                            $("#detailMasaBerlaku").val(data.jml_hari_berlaku + " Hari");
                            $("#detailSanksiStatus").val(data.status);
                            $("#detailSanksiKet").val(data.ket);
                            $("#detailSanksiBuat").val(data.pembuat);
                            $("#detailSanksiTglBuat").val(data.tgl_buat);
                            $("#detailSanksimdl").modal("show");
                        } else {
                            $(".err_psn_sanksi").removeClass('d-none');
                            $(".err_psn_sanksi").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_sanksi").removeClass("alert-primary");
                        $(".err_psn_sanksi").addClass("alert-danger");
                        $(".err_psn_sanksi").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_sanksi").html("Sanksi gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_sanksi").html("Sanksi gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_sanksi").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_sanksi ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_sanksi ").slideUp(500);
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edttsanksi', function() {
            let auth_sanksi = $(this).attr('id');
            let namaSanksi = $(this).attr('value');

            if (auth_sanksi == "") {
                swal("Error", "Sanksi tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('sanksi/detail_sanksi'); ?>",
                    data: {
                        auth_sanksi: auth_sanksi
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataSanksi = JSON.parse(data);
                        if (dataSanksi.statusCode == 200) {
                            resetedit();
                            $("#editSanksiKode").val(dataSanksi.kode);
                            $("#editSanksi").val(dataSanksi.sanksi);
                            $("#editMasaBerlaku").val(dataSanksi.jml_hari_berlaku);
                            $("#editSanksiStatus").val(dataSanksi.status);
                            $("#editSanksiKet").val(dataSanksi.ket);
                            $("#editSanksimdl").modal("show");
                            $("#error1esk").html('');
                            $("#error2esk").html('');
                            $("#error3esk").html('');
                            $("#error4esk").html('');
                            $("#error5esk").html('');
                        } else {
                            $(".err_psn_sanksi").removeClass('d-none');
                            $(".err_psn_sanksi").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_sanksi").removeClass("alert-primary");
                        $(".err_psn_sanksi").addClass("alert-danger");
                        $(".err_psn_sanksi").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_sanksi").html("Sanksi gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_sanksi").html("Sanksi gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_sanksi").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_sanksi ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_sanksi ").slideUp(500);
                        });
                    }
                });
            }
        });

        $("#btnrefreshSanksi").click(function() {
            $('#tbmSanksi').LoadingOverlay("show");
            tbmSanksi.draw()
            $('#tbmSanksi').LoadingOverlay("hide");
        });

        tbmSanksi = $('#tbmSanksi').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [0, 'asc'],
            ],
            "ajax": {
                "url": "<?= base_url('sanksi/ajax_list'); ?>",
                "type": "POST",
                "error": function(xhr, error, code) {
                    if (code != "") {
                        $(".err_psn_sanksi").removeClass("d-none");
                        $(".err_psn_sanksi").removeClass('d-none');
                        $(".err_psn_sanksi").html("terjadi kesalahan saat melakukan load data Sanksi, hubungi administrator");
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
                    name: 'id_sanksi',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "className": "text-center align-middle",
                    "width": "1%"
                },
                {
                    "data": 'kd_sanksi',
                    "className": "text-nowrap align-middle",
                    "width": "10%"
                },
                {
                    "data": 'sanksi',
                    "className": "text-nowrap align-middle",
                    "width": "60%"
                },
                {
                    "data": 'jml_hari_berlaku',
                    "className": "text-nowrap align-middle",
                    "width": "1%"
                },
                {
                    "data": 'stat_sanksi',
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