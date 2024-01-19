<script>
    //========================================== Tipe ========================================================
    $(document).ready(function() {
        $('#btnupdateTipe').click(function() {
            let kode = $('#editTipeKode').val();
            let tipe = $('#editTipe').val();
            let status = $('#editTipeStatus').val();
            let ket = $('#editTipeKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('tipe/edit_tipe'); ?>",
                data: {
                    kode: kode,
                    tipe: tipe,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmTipe.draw();
                        $("#editTipemdl").modal("hide");
                        $(".err_psn_tipe").removeClass('d-none');
                        $(".err_psn_tipe").removeClass('alert-danger');
                        $(".err_psn_tipe").addClass('alert-info');
                        $(".err_psn_tipe").html(data.pesan);
                        $("#editTipeKode").val('');
                        $("#editTipe").val('');
                        $("#editTipeKet").val('');
                        $("#editTipeStatus").val('');
                        $("#error1et").html('');
                        $("#error2et").html('');
                        $("#error3et").html('');
                        $("#error4et").html('');
                        $(".err_psn_tipe").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_tipe").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_tipe").removeClass('d-none');
                        $(".err_psn_edit_tipe").removeClass('alert-info');
                        $(".err_psn_edit_tipe").addClass('alert-danger');
                        $(".err_psn_edit_tipe").html(data.pesan);
                        $(".err_psn_edit_tipe").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_tipe").slideUp(500);
                        });
                        $("#error1et").html('');
                        $("#error2et").html('');
                        $("#error3et").html('');
                        $("#error4et").html('');
                    } else if (data.statusCode == 202) {
                        $("#error1et").html(data.kode);
                        $("#error2et").html(data.tipe);
                        $("#error3et").html(data.status);
                        $("#error4et").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_tipe").removeClass("alert-primary");
                    $(".err_psn_tipe").addClass("alert-danger");
                    $(".err_psn_tipe").css("display", "block");
                    if (xhr.status == 404) {
                        $(".err_psn_tipe").html("Tipe gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_tipe").html("Tipe gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_tipe").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }
                    $("#editTipemdl").modal("hide");
                    $(".err_psn_tipe ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_tipe ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        $("#btnBatalTipe").click(function() {
            $("#perTipe").val('').trigger('change');
            $("#kodeTipe").val('');
            $("#Tipe").val('');
            $("#ketTipe").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
            $(".error4").html('');
            $(".error5").html('');
        });

        $(document).ready(function() {
            $('#perTipe').select2({
                theme: 'bootstrap4'
            });

            $.ajax({
                type: "POST",
                url: "<?= base_url("perusahaan/get_all") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#perTipe").html(data.prs);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_tipe").removeClass('d-none');
                    $(".err_psn_tipe").removeClass('alert-info');
                    $(".err_psn_tipe").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".err_psn_tipe").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                        $("#btnTambahTipe").attr("disabled", true);
                    }
                }
            });
            $('#perTipe').change(function() {
                let auth_per = $("#perTipe").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("departemen/get_by_authper") ?>",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#depTipe").html(data.dprt);
                    }
                })
            });
            $("#btnTambahTipe").click(function() {
                var prs = $("#perTipe").val();
                var kode = $("#kodeTipe").val();
                var tipe = $("#Tipe").val();
                var ket = $("#ketTipe").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("tipe/input_tipe") ?>",
                    data: {
                        prs: prs,
                        kode: kode,
                        tipe: tipe,
                        ket: ket
                    },
                    timeout: 20000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $(".err_psn_tipe").removeClass('d-none');
                            $(".err_psn_tipe").removeClass('alert-danger');
                            $(".err_psn_tipe").addClass('alert-info');
                            $(".err_psn_tipe").html(data.pesan);
                            $("#perTipe").val('').trigger('change');
                            $("#kodeTipe").val('');
                            $("#Tipe").val('');
                            $("#ketTipe").val('');
                            $(".error1").html('');
                            $(".error2").html('');
                            $(".error3").html('');
                            $(".error4").html('');
                        } else if (data.statusCode == 201) {
                            $(".err_psn_tipe").removeClass('d-none');
                            $(".err_psn_tipe").removeClass('alert-info');
                            $(".err_psn_tipe").addClass('alert-danger');
                            $(".err_psn_tipe").html(data.pesan);
                        } else if (data.statusCode == 202) {
                            $(".error1").html(data.prs);
                            $(".error2").html(data.kode);
                            $(".error3").html(data.tipe);
                            $(".error4").html(data.ket);
                        }

                        $(".err_psn_tipe").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_tipe").slideUp(500);
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_tipe").removeClass("alert-primary");
                        $(".err_psn_tipe").addClass("alert-danger");
                        $(".err_psn_tipe").css("display", "block");
                        if (xhr.status == 404) {
                            $(".err_psn_tipe").html("Tipe gagal disimpan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_tipe").html("Tipe gagal disimpan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_tipe").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                        }

                        $(".err_psn_tipe ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_tipe ").slideUp(500);
                        });
                    }
                })
            });

            $(document).on('click', '.hpstipe', function() {
                let authtipe = $(this).attr('id');
                let namaTipe = $(this).attr('value');

                if (authtipe == "") {
                    swal("Error", "Tipe tidak ditemukan", "error");
                } else {
                    swal({
                        title: "Hapus",
                        text: "Yakin Tipe " + namaTipe + " akan dihapus?",
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
                                url: "<?= base_url('tipe/hapus_tipe'); ?>",
                                data: {
                                    authtipe: authtipe
                                },
                                timeout: 20000,
                                success: function(data, textStatus, xhr) {
                                    var data = JSON.parse(data);
                                    if (data.statusCode == 200) {
                                        tbmTipe.draw();
                                        $(".err_psn_tipe").removeClass("alert-danger");
                                        $(".err_psn_tipe").addClass("alert-primary");
                                        $(".err_psn_tipe").css("display", "block");
                                        $(".err_psn_tipe").html(data.pesan);
                                    } else {
                                        $(".err_psn_tipe").removeClass("alert-primary");
                                        $(".err_psn_tipe").addClass("alert-danger");
                                        $(".err_psn_tipe").css("display", "block");
                                        $(".err_psn_tipe").html(data.pesan);
                                    }

                                    $.LoadingOverlay("hide");
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    $.LoadingOverlay("hide");
                                    $(".err_psn_tipe").removeClass("alert-primary");
                                    $(".err_psn_tipe").addClass("alert-danger");
                                    $(".err_psn_tipe").css("display", "block");
                                    if (xhr.status == 404) {
                                        $(".err_psn_tipe").html("Tipe gagal dihapus, , Link data tidak ditemukan");
                                    } else if (xhr.status == 0) {
                                        $(".err_psn_tipe").html("Tipe gagal dihapus, Waktu koneksi habis");
                                    } else {
                                        $(".err_psn_tipe").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                    }
                                }
                            });

                            $(".err_psn_tipe").fadeTo(4000, 500).slideUp(500, function() {
                                $(".err_psn_tipe").slideUp(500);
                            });
                        } else if (result.dismiss == 'cancel') {
                            swal('Batal', 'Tipe ' + namaTipe + ' batal dihapus', 'error');
                            return false;
                        }
                    });
                }
            });

            $(document).on('click', '.dtltipe', function() {
                let authtipe = $(this).attr('id');
                let namaTipe = $(this).attr('value');

                if (authtipe == "") {
                    swal("Error", "Tipe tidak ditemukan", "error");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('tipe/detail_tipe'); ?>",
                        data: {
                            authtipe: authtipe
                        },
                        timeout: 15000,
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#detailTipePerusahaan").val(data.nama_perusahaan);
                                $("#detailTipeDepart").val(data.depart);
                                $("#detailTipeKode").val(data.kode);
                                $("#detailTipe").val(data.tipe);
                                $("#detailTipeStatus").val(data.status);
                                $("#detailTipeKet").val(data.ket);
                                $("#detailTipeBuat").val(data.pembuat);
                                $("#detailTipeTglBuat").val(data.tgl_buat);
                                $("#detailTipemdl").modal("show");
                            } else {
                                $(".err_psn_tipe").css("display", "block");
                                $(".err_psn_tipe").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_psn_tipe").removeClass("alert-primary");
                            $(".err_psn_tipe").addClass("alert-danger");
                            $(".err_psn_tipe").css("display", "block");
                            if (xhr.status == 404) {
                                $(".err_psn_tipe").html("Tipe gagal ditampilkan, Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_psn_tipe").html("Tipe gagal ditampilkan, Waktu koneksi habis");
                            } else {
                                $(".err_psn_tipe").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                            }
                            $(".err_psn_tipe ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_tipe ").slideUp(500);
                            });
                        }
                    });
                }
            });

            $(document).on('click', '.edtttipe', function() {
                let authtipe = $(this).attr('id');
                let namaTipe = $(this).attr('value');

                if (authtipe == "") {
                    swal("Error", "Tipe tidak ditemukan", "error");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('tipe/detail_Tipe'); ?>",
                        data: {
                            authtipe: authtipe
                        },
                        timeout: 15000,
                        success: function(data) {
                            var dataTipe = JSON.parse(data);
                            if (dataTipe.statusCode == 200) {
                                $("#editTipeKode").val(dataTipe.kode);
                                $("#editTipe").val(dataTipe.tipe);
                                $("#editTipeStatus").val(dataTipe.status);
                                $("#editTipeKet").val(dataTipe.ket);
                                $("#editTipemdl").modal("show");
                                $("#error1et").html('');
                                $("#error2et").html('');
                                $("#error3et").html('');
                                $("#error4et").html('');
                            } else {
                                $(".err_psn_tipe").css("display", "block");
                                $(".err_psn_tipe").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_psn_tipe").removeClass("alert-primary");
                            $(".err_psn_tipe").addClass("alert-danger");
                            $(".err_psn_tipe").css("display", "block");
                            if (xhr.status == 404) {
                                $(".err_psn_tipe").html("Tipe gagal ditampilkan, Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_psn_tipe").html("Tipe gagal ditampilkan, Waktu koneksi habis");
                            } else {
                                $(".err_psn_tipe").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                            }

                            $(".err_psn_tipe ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_tipe ").slideUp(500);
                            });
                        }
                    });
                }
            });

            $("#btnrefreshTipe").click(function() {
                $('#tbmTipe').LoadingOverlay("show");
                tbmTipe.draw()
                $('#tbmTipe').LoadingOverlay("hide");
            });

            tbmTipe = $('#tbmTipe').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [1, 'asc'],
                ],
                "ajax": {
                    "url": "<?= base_url('tipe/ajax_list'); ?>",
                    "type": "POST",
                    "error": function(xhr, error, code) {
                        if (code != "") {
                            $(".err_psn_tipe").removeClass("d-none");
                            $(".err_psn_tipe").css("display", "block");
                            $(".err_psn_tipe").html("terjadi kesalahan saat melakukan load data tipe, hubungi administrator");
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
                        name: 'id_tipe',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center",
                        "width": "1%"
                    },
                    {
                        "data": 'kd_tipe',
                        "width": "10%"
                    },
                    {
                        "data": 'tipe',
                        "className": "text-nowrap",
                        "width": "25%"
                    },
                    {
                        "data": 'stat_tipe',
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