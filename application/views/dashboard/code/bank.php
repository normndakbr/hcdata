<script>
    //========================================== Bank ========================================================
    $(document).ready(function() {
        $('#btnupdateBank').click(function() {
            let bank = $('#editBank').val();
            let status = $('#editBankStatus').val();
            let ket = $('#editBankKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('bank/edit_bank'); ?>",
                data: {
                    bank: bank,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmBank.draw();
                        $("#editBankmdl").modal("hide");
                        $(".err_psn_bank").removeClass('d-none');
                        $(".err_psn_bank").removeClass('alert-danger');
                        $(".err_psn_bank").addClass('alert-info');
                        $(".err_psn_bank").html(data.pesan);
                        $("#editBank").val('');
                        $("#editBankKet").val('');
                        $("#editBankStatus").val('');
                        $("#error1ebk").html('');
                        $("#error2ebk").html('');
                        $("#error3ebk").html('');
                        $("#error4ebk").html('');
                        $(".err_psn_bank").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_bank").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_bank").removeClass('d-none');
                        $(".err_psn_edit_bank").removeClass('alert-info');
                        $(".err_psn_edit_bank").addClass('alert-danger');
                        $(".err_psn_edit_bank").html(data.pesan);
                        $(".err_psn_edit_bank").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_bank").slideUp(500);
                        });
                        $("#error2ebk").html('');
                        $("#error3ebk").html('');
                        $("#error4ebk").html('');
                    } else if (data.statusCode == 202) {
                        $("#error2ebk").html(data.bank);
                        $("#error3ebk").html(data.status);
                        $("#error4ebk").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_bank").removeClass("alert-primary");
                    $(".err_psn_bank").addClass("alert-danger");
                    $(".err_psn_bank").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_bank").html("Bank gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_bank").html("Bank gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_bank").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }

                    $("#editBankmdl").modal("hide");
                    $(".err_psn_bank ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_bank ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        $("#btnBatalBank").click(function() {
            $("#Bank").val('');
            $("#ketBank").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
        });

        $("#btnTambahBank").click(function() {
            var bank = $("#Bank").val();
            var ket = $("#ketBank").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url("bank/input_bank") ?>",
                data: {
                    bank: bank,
                    ket: ket
                },
                timeout: 20000,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $(".err_psn_bank").removeClass('d-none');
                        $(".err_psn_bank").removeClass('alert-danger');
                        $(".err_psn_bank").addClass('alert-info');
                        $(".err_psn_bank").html(data.pesan);
                        $("#Bank").val('');
                        $("#ketBank").val('');
                        $(".error2").html('');
                        $(".error3").html('');
                    } else if (data.statusCode == 201) {
                        $(".err_psn_bank").removeClass('d-none');
                        $(".err_psn_bank").removeClass('alert-info');
                        $(".err_psn_bank").addClass('alert-danger');
                        $(".err_psn_bank").html(data.pesan);
                    } else if (data.statusCode == 202) {
                        $(".error2").html(data.bank);
                        $(".error3").html(data.ket);
                    }

                    $(".err_psn_bank").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_bank").slideUp(500);
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_bank").removeClass('d-none');
                    $(".err_psn_bank").removeClass("alert-primary");
                    $(".err_psn_bank").addClass("alert-danger");
                    if (xhr.status == 404) {
                        $(".err_psn_bank").html("Bank gagal disimpan, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_bank").html("Bank gagal disimpan, Waktu koneksi habis");
                    } else {
                        $(".err_psn_bank").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                    }

                    $(".err_psn_bank ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_bank ").slideUp(500);
                    });
                }
            })
        });

        $(document).on('click', '.hpsbank', function() {
            let auth_bank = $(this).attr('id');
            let namaBank = $(this).attr('value');

            if (auth_bank == "") {
                $(".err_psn_bank").removeClass("alert-primary");
                $(".err_psn_bank").addClass("alert-danger");
                $(".err_psn_bank").removeClass('d-none');
                $(".err_psn_bank").html("Bank tidak ditemukan");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin " + namaBank + " akan dihapus?",
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
                            url: "<?= base_url('Bank/hapus_bank'); ?>",
                            data: {
                                auth_bank: auth_bank
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmBank.draw();
                                    $(".err_psn_bank").removeClass("alert-danger");
                                    $(".err_psn_bank").addClass("alert-primary");
                                    $(".err_psn_bank").removeClass('d-none');
                                    $(".err_psn_bank").html(data.pesan);
                                } else {
                                    $(".err_psn_bank").removeClass("alert-primary");
                                    $(".err_psn_bank").addClass("alert-danger");
                                    $(".err_psn_bank").removeClass('d-none');
                                    $(".err_psn_bank").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_bank").removeClass("alert-primary");
                                $(".err_psn_bank").addClass("alert-danger");
                                $(".err_psn_bank").removeClass('d-none');
                                if (xhr.status == 404) {
                                    $(".err_psn_bank").html("Bank gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_bank").html("Bank gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_bank").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_bank").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_psn_bank").slideUp(500);
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'Bank ' + namaBank + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtlbank', function() {
            let auth_bank = $(this).attr('id');
            let namaBank = $(this).attr('value');

            if (auth_bank == "") {
                $(".err_psn_bank").removeClass("alert-primary");
                $(".err_psn_bank").addClass("alert-danger");
                $(".err_psn_bank").removeClass('d-none');
                $(".err_psn_bank").html("Bank tidak ditemukan");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('bank/detail_bank'); ?>",
                    data: {
                        auth_bank: auth_bank
                    },
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#detailBank").val(data.bank);
                            $("#detailBankStatus").val(data.status);
                            $("#detailBankKet").val(data.ket);
                            $("#detailBankBuat").val(data.pembuat);
                            $("#detailBankTglBuat").val(data.tgl_buat);
                            $("#detailBankmdl").modal("show");
                        } else {
                            $(".err_psn_bank").removeClass('d-none');
                            $(".err_psn_bank").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_bank").removeClass("alert-primary");
                        $(".err_psn_bank").addClass("alert-danger");
                        $(".err_psn_bank").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_bank").html("Bank gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_bank").html("Bank gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_bank").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_bank ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_bank ").slideUp(500);
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edttbank', function() {
            let auth_bank = $(this).attr('id');
            let namaBank = $(this).attr('value');

            if (auth_bank == "") {
                swal("Error", "Bank tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('Bank/detail_bank'); ?>",
                    data: {
                        auth_bank: auth_bank
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataBank = JSON.parse(data);
                        if (dataBank.statusCode == 200) {
                            $("#editBank").val(dataBank.bank);
                            $("#editBankStatus").val(dataBank.status);
                            $("#editBankKet").val(dataBank.ket);
                            $("#editBankmdl").modal("show");
                            $("#error1et").html('');
                            $("#error2et").html('');
                            $("#error3et").html('');
                            $("#error4et").html('');
                        } else {
                            $(".err_psn_bank").removeClass('d-none');
                            $(".err_psn_bank").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_bank").removeClass("alert-primary");
                        $(".err_psn_bank").addClass("alert-danger");
                        $(".err_psn_bank").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_bank").html("Bank gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_bank").html("Bank gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_bank").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_bank ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_bank ").slideUp(500);
                        });
                    }
                });
            }
        });

        $("#btnrefreshBank").click(function() {
            $('#tbmBank').LoadingOverlay("show");
            tbmBank.draw()
            $('#tbmBank').LoadingOverlay("hide");
        });

        tbmBank = $('#tbmBank').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [1, 'asc'],
            ],
            "ajax": {
                "url": "<?= base_url('bank/ajax_list'); ?>",
                "type": "POST",
                "error": function(xhr, error, code) {
                    if (code != "") {
                        $(".err_psn_bank").removeClass("d-none");
                        $(".err_psn_bank").removeClass('d-none');
                        $(".err_psn_bank").html("terjadi kesalahan saat melakukan load data Bank, hubungi administrator");
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
                    name: 'id_bank',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "className": "text-center align-middle",
                    "width": "1%"
                },
                {
                    "data": 'bank',
                    "className": "text-nowrap align-middle",
                    "width": "50%"
                },
                {
                    "data": 'stat_bank',
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