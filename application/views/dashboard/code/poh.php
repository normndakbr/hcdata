<script>
    //========================================== Poh ========================================================
    $(document).ready(function() {
        function reseteditpoh() {
            $("#editPohKode").val('');
            $("#editPoh").val('');
            $("#editPohKet").val('');
            $("#editPohStatus").val('');
            $("#error1epoh").html('');
            $("#error2epoh").html('');
            $("#error3epoh").html('');
            $("#error4epoh").html('');
        }

        $('#btnupdatePoh').click(function() {
            let kode = $('#editPohKode').val();
            let poh = $('#editPoh').val();
            let status = $('#editPohStatus').val();
            let ket = $('#editPohKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('poh/edit_poh'); ?>",
                data: {
                    kode: kode,
                    poh: poh,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmPoh.draw();
                        $("#editPohmdl").modal("hide");
                        $(".err_psn_poh").removeClass('d-none');
                        $(".err_psn_poh").removeClass('alert-danger');
                        $(".err_psn_poh").addClass('alert-info');
                        $(".err_psn_poh").html(data.pesan);
                        reseteditpoh();
                        $(".err_psn_poh").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_poh").slideUp(500);
                            $(".err_psn_poh").addClass('d-none');
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_poh").removeClass('d-none');
                        $(".err_psn_edit_poh").removeClass('alert-info');
                        $(".err_psn_edit_poh").addClass('alert-danger');
                        $(".err_psn_edit_poh").html(data.pesan);
                        $(".err_psn_edit_poh").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_poh").slideUp(500);
                            $(".err_psn_edit_poh").addClass('d-none');
                        });
                        $("#error1epoh").html('');
                        $("#error2epoh").html('');
                        $("#error3epoh").html('');
                        $("#error4epoh").html('');
                    } else if (data.statusCode == 202) {
                        $("#error1epoh").html(data.kode);
                        $("#error2epoh").html(data.poh);
                        $("#error3epoh").html(data.status);
                        $("#error4epoh").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_poh").removeClass("alert-primary");
                    $(".err_psn_poh").addClass("alert-danger");
                    $(".err_psn_poh").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_poh").html("Point of hire gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_poh").html("Point of hire gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_poh").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }

                    $("#editPohmdl").modal("hide");
                    $(".err_psn_poh ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_poh").slideUp(500);
                        $(".err_psn_poh").addClass('d-none');
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        function resetaddpoh() {
            $("#kodePoh").val('');
            $("#Poh").val('');
            $("#ketPoh").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
        }
        $("#btnBatalPoh").click(function() {
            resetaddpoh();
        });

        $("#btnTambahPoh").click(function() {
            var kode = $("#kodePoh").val();
            var poh = $("#Poh").val();
            var ket = $("#ketPoh").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url("poh/input_poh") ?>",
                data: {
                    kode: kode,
                    poh: poh,
                    ket: ket
                },
                timeout: 20000,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $(".err_psn_poh").removeClass('d-none');
                        $(".err_psn_poh").removeClass('alert-danger');
                        $(".err_psn_poh").addClass('alert-info');
                        $(".err_psn_poh").html(data.pesan);
                        resetaddpoh()
                    } else if (data.statusCode == 201) {
                        $(".err_psn_poh").removeClass('d-none');
                        $(".err_psn_poh").removeClass('alert-info');
                        $(".err_psn_poh").addClass('alert-danger');
                        $(".err_psn_poh").html(data.pesan);
                    } else if (data.statusCode == 202) {
                        $(".error1").html(data.kode);
                        $(".error2").html(data.poh);
                        $(".error3").html(data.ket);
                    }

                    $(".err_psn_poh").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_poh").slideUp(500);
                        $(".err_psn_poh").addClass('d-none');
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_poh").removeClass('d-none');
                    $(".err_psn_poh").removeClass("alert-primary");
                    $(".err_psn_poh").addClass("alert-danger");
                    if (xhr.status == 404) {
                        $(".err_psn_poh").html("Point of hire gagal disimpan, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_poh").html("Point of hire gagal disimpan, Waktu koneksi habis");
                    } else {
                        $(".err_psn_poh").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                    }

                    $(".err_psn_poh ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_poh ").slideUp(500);
                        $(".err_psn_poh").addClass('d-none');
                    });
                }
            })
        });

        $(document).on('click', '.hpspoh', function() {
            let auth_poh = $(this).attr('id');
            let namaPoh = $(this).attr('value');

            if (auth_poh == "") {
                $(".err_psn_poh").removeClass("alert-primary");
                $(".err_psn_poh").addClass("alert-danger");
                $(".err_psn_poh").removeClass('d-none');
                $(".err_psn_poh").html("Point of hire tidak ditemukan");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin " + namaPoh + " akan dihapus?",
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
                            url: "<?= base_url('poh/hapus_poh'); ?>",
                            data: {
                                auth_poh: auth_poh
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmPoh.draw();
                                    $(".err_psn_poh").removeClass("alert-danger");
                                    $(".err_psn_poh").addClass("alert-primary");
                                    $(".err_psn_poh").removeClass('d-none');
                                    $(".err_psn_poh").html(data.pesan);
                                } else {
                                    $(".err_psn_poh").removeClass("alert-primary");
                                    $(".err_psn_poh").addClass("alert-danger");
                                    $(".err_psn_poh").removeClass('d-none');
                                    $(".err_psn_poh").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_poh").removeClass("alert-primary");
                                $(".err_psn_poh").addClass("alert-danger");
                                $(".err_psn_poh").removeClass('d-none');
                                if (xhr.status == 404) {
                                    $(".err_psn_poh").html("Point of hire gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_poh").html("Point of hire gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_poh").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_poh").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_psn_poh").slideUp(500);
                            $(".err_psn_poh").addClass('d-none');
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'Point of hire ' + namaPoh + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtlpoh', function() {
            let auth_poh = $(this).attr('id');
            let namaPoh = $(this).attr('value');

            if (auth_poh == "") {
                $(".err_psn_poh").removeClass("alert-primary");
                $(".err_psn_poh").addClass("alert-danger");
                $(".err_psn_poh").removeClass('d-none');
                $(".err_psn_poh").html("Point of hire tidak ditemukan");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('poh/detail_poh'); ?>",
                    data: {
                        auth_poh: auth_poh
                    },
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#detailPohKode").val(data.kode);
                            $("#detailPoh").val(data.poh);
                            $("#detailPohStatus").val(data.status);
                            $("#detailPohKet").val(data.ket);
                            $("#detailPohBuat").val(data.pembuat);
                            $("#detailPohTglBuat").val(data.tgl_buat);
                            $("#detailPohmdl").modal("show");
                        } else {
                            $(".err_psn_poh").removeClass('d-none');
                            $(".err_psn_poh").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_poh").removeClass("alert-primary");
                        $(".err_psn_poh").addClass("alert-danger");
                        $(".err_psn_poh").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_poh").html("Point of hire gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_poh").html("Point of hire gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_poh").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_poh ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_poh ").slideUp(500);
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edttpoh', function() {
            let auth_poh = $(this).attr('id');
            let namaPoh = $(this).attr('value');

            if (auth_poh == "") {
                $(".err_psn_poh").removeClass("alert-primary");
                $(".err_psn_poh").addClass("alert-danger");
                $(".err_psn_poh").removeClass('d-none');
                $(".err_psn_poh").html("Point of hire tidak ditemukan");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('poh/detail_poh'); ?>",
                    data: {
                        auth_poh: auth_poh
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataPoh = JSON.parse(data);
                        if (dataPoh.statusCode == 200) {
                            $("#editPohKode").val(dataPoh.kode);
                            $("#editPoh").val(dataPoh.poh);
                            $("#editPohStatus").val(dataPoh.status);
                            $("#editPohKet").val(dataPoh.ket);
                            $("#editPohmdl").modal("show");
                            $("#error1epoh").html('');
                            $("#error2epoh").html('');
                            $("#error3epoh").html('');
                            $("#error4epoh").html('');
                        } else {
                            $(".err_psn_poh").removeClass('d-none');
                            $(".err_psn_poh").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_poh").removeClass("alert-primary");
                        $(".err_psn_poh").addClass("alert-danger");
                        $(".err_psn_poh").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_poh").html("Poh gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_poh").html("Poh gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_poh").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_poh ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_poh ").slideUp(500);
                        });
                    }
                });
            }
        });

        $("#btnrefreshPoh").click(function() {
            $('#tbmPoh').LoadingOverlay("show");
            tbmPoh.draw()
            $('#tbmPoh').LoadingOverlay("hide");
        });

        tbmPoh = $('#tbmPoh').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [1, 'asc'],
            ],
            "ajax": {
                "url": "<?= base_url('poh/ajax_list'); ?>",
                "type": "POST",
                "error": function(xhr, error, code) {
                    if (code != "") {
                        $(".err_psn_poh").removeClass("d-none");
                        $(".err_psn_poh").removeClass('d-none');
                        $(".err_psn_poh").html("terjadi kesalahan saat melakukan load data Poh, hubungi administrator");
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
                    name: 'id_poh',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "className": "text-center align-middle",
                    "width": "1%"
                },
                {
                    "data": 'kd_poh',
                    "className": "text-nowrap align-middle",
                    "width": "10%"
                },
                {
                    "data": 'poh',
                    "className": "text-nowrap align-middle",
                    "width": "50%"
                },
                {
                    "data": 'stat_poh',
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