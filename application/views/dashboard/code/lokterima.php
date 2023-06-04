<script>
    //========================================== Lokterima ========================================================
    $(document).ready(function() {
        $('#perLokterima').select2({
            theme: 'bootstrap4'
        });

        $.ajax({
            type: "POST",
            url: "<?= base_url("perusahaan/get_all") ?>",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#perLokterima").html(data.prs);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".err_psn_lokterima").removeClass('d-none');
                $(".err_psn_lokterima").removeClass('alert-info');
                $(".err_psn_lokterima").addClass('alert-danger');
                if (thrownError != "") {
                    $(".err_psn_lokterima").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                    $("#btnTambahLokterima").attr("disabled", true);
                }
            }
        });

        function reseteditlokterima() {
            $("#editLokterimaKode").val('');
            $("#editLokterima").val('');
            $("#editLokterimaKet").val('');
            $("#editLokterimaStatus").val('');
            $("#error1elkt").html('');
            $("#error2elkt").html('');
            $("#error3elkt").html('');
            $("#error4elkt").html('');
        }

        $('#btnupdateLokterima').click(function() {
            let kode = $('#editLokterimaKode').val();
            let lokterima = $('#editLokterima').val();
            let status = $('#editLokterimaStatus').val();
            let ket = $('#editLokterimaKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('lokasipenerimaan/edit_lokterima'); ?>",
                data: {
                    kode: kode,
                    lokterima: lokterima,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmLokterima.draw();
                        $("#editLokterimamdl").modal("hide");
                        $(".err_psn_lokterima").removeClass('d-none');
                        $(".err_psn_lokterima").removeClass('alert-danger');
                        $(".err_psn_lokterima").addClass('alert-info');
                        $(".err_psn_lokterima").html(data.pesan);
                        reseteditlokterima();
                        $(".err_psn_lokterima").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_lokterima").slideUp(500);
                            $(".err_psn_lokterima").addClass('d-none');
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_lokterima").removeClass('d-none');
                        $(".err_psn_edit_lokterima").removeClass('alert-info');
                        $(".err_psn_edit_lokterima").addClass('alert-danger');
                        $(".err_psn_edit_lokterima").html(data.pesan);
                        $(".err_psn_edit_lokterima").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_lokterima").slideUp(500);
                            $(".err_psn_edit_lokterima").addClass('d-none');
                        });
                        $("#error1elkt").html('');
                        $("#error2elkt").html('');
                        $("#error3elkt").html('');
                        $("#error4elkt").html('');
                    } else if (data.statusCode == 202) {
                        $("#error1elkt").html(data.kode);
                        $("#error2elkt").html(data.lokterima);
                        $("#error3elkt").html(data.status);
                        $("#error4elkt").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_lokterima").removeClass("alert-primary");
                    $(".err_psn_lokterima").addClass("alert-danger");
                    $(".err_psn_lokterima").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_lokterima").html("Lokasi penerimaan gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_lokterima").html("Lokasi penerimaan gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_lokterima").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }
                    $("#editLokterimamdl").modal("hide");
                    $(".err_psn_lokterima ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_lokterima ").slideUp(500);
                        $(".err_psn_lokterima").addClass('d-none');
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        function resetaddlokterima() {
            $("#perLokterima").val('').trigger('change');
            $("#kodeLokterima").val('');
            $("#Lokterima").val('');
            $("#ketLokterima").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
            $(".error4").html('');
        }

        $("#btnBatalLokterima").click(function() {
            resetaddlokterima();
        });

        $("#btnTambahLokterima").click(function() {
            var prs = $("#perLokterima").val();
            var kode = $("#kodeLokterima").val();
            var lokterima = $("#Lokterima").val();
            var ket = $("#ketLokterima").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url("lokasipenerimaan/input_lokterima") ?>",
                data: {
                    prs: prs,
                    kode: kode,
                    lokterima: lokterima,
                    ket: ket
                },
                timeout: 20000,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $(".err_psn_lokterima").removeClass('d-none');
                        $(".err_psn_lokterima").removeClass('alert-danger');
                        $(".err_psn_lokterima").addClass('alert-info');
                        $(".err_psn_lokterima").html(data.pesan);
                        resetaddlokterima();
                    } else if (data.statusCode == 201) {
                        $(".err_psn_lokterima").removeClass('d-none');
                        $(".err_psn_lokterima").removeClass('alert-info');
                        $(".err_psn_lokterima").addClass('alert-danger');
                        $(".err_psn_lokterima").html(data.pesan);
                    } else if (data.statusCode == 202) {
                        $(".error1").html(data.prs);
                        $(".error2").html(data.kode);
                        $(".error3").html(data.lokterima);
                        $(".error4").html(data.ket);
                    }

                    $(".err_psn_lokterima").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_lokterima").slideUp(500);
                        $(".err_psn_lokterima").addClass('d-none');
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_lokterima").removeClass("alert-primary");
                    $(".err_psn_lokterima").addClass("alert-danger");
                    $(".err_psn_lokterima").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_lokterima").html("Lokasi penerimaan gagal disimpan, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_lokterima").html("Lokasi penerimaan gagal disimpan, Waktu koneksi habis");
                    } else {
                        $(".err_psn_lokterima").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                    }

                    $(".err_psn_lokterima ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_lokterima ").slideUp(500);
                        $(".err_psn_lokterima").addClass('d-none');
                    });
                }
            })
        });

        $(document).on('click', '.hpslokterima', function() {
            let auth_lokterima = $(this).attr('id');
            let namaLokterima = $(this).attr('value');

            if (auth_lokterima == "") {
                swal("Error", "Lokasi penerimaan tidak ditemukan", "error");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin Lokasi penerimaan " + namaLokterima + " akan dihapus?",
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
                            url: "<?= base_url('lokasipenerimaan/hapus_lokterima'); ?>",
                            data: {
                                auth_lokterima: auth_lokterima
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmLokterima.draw();
                                    $(".err_psn_lokterima").removeClass("alert-danger");
                                    $(".err_psn_lokterima").addClass("alert-primary");
                                    $(".err_psn_lokterima").removeClass("d-none");
                                    $(".err_psn_lokterima").html(data.pesan);
                                } else {
                                    $(".err_psn_lokterima").removeClass("alert-primary");
                                    $(".err_psn_lokterima").addClass("alert-danger");
                                    $(".err_psn_lokterima").removeClass("d-none");
                                    $(".err_psn_lokterima").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_lokterima").removeClass("alert-primary");
                                $(".err_psn_lokterima").addClass("alert-danger");
                                $(".err_psn_lokterima").removeClass("d-none");
                                if (xhr.status == 404) {
                                    $(".err_psn_lokterima").html("Lokasi penerimaan gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_lokterima").html("Lokasi penerimaan gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_lokterima").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_lokterima").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_psn_lokterima").slideUp(500);
                            $(".err_psn_lokterima").addClass('d-none');
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'Lokasi penerimaan ' + namaLokterima + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtllokterima', function() {
            let auth_lokterima = $(this).attr('id');
            let namaLokterima = $(this).attr('value');

            if (auth_lokterima == "") {
                swal("Error", "Lokasi penerimaan tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('lokasipenerimaan/detail_lokterima'); ?>",
                    data: {
                        auth_lokterima: auth_lokterima
                    },
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#detailLokterimaPerusahaan").val(data.nama_perusahaan);
                            $("#detailLokterimaDepart").val(data.depart);
                            $("#detailLokterimaKode").val(data.kode);
                            $("#detailLokterima").val(data.lokterima);
                            $("#detailLokterimaStatus").val(data.status);
                            $("#detailLokterimaKet").val(data.ket);
                            $("#detailLokterimaBuat").val(data.pembuat);
                            $("#detailLokterimaTglBuat").val(data.tgl_buat);
                            $("#detailLokterimamdl").modal("show");
                        } else {
                            $(".err_psn_lokterima").removeClass("d-none");
                            $(".err_psn_lokterima").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_lokterima").removeClass("alert-primary");
                        $(".err_psn_lokterima").addClass("alert-danger");
                        $(".err_psn_lokterima").removeClass("d-none");
                        if (xhr.status == 404) {
                            $(".err_psn_lokterima").html("Lokasi penerimaan gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_lokterima").html("Lokasi penerimaan gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_lokterima").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_lokterima ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_lokterima ").slideUp(500);
                            $(".err_psn_lokterima").addClass('d-none');
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edttlokterima', function() {
            let auth_lokterima = $(this).attr('id');
            let namaLokterima = $(this).attr('value');

            if (auth_lokterima == "") {
                swal("Error", "Lokasi penerimaan tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('lokasipenerimaan/detail_lokterima'); ?>",
                    data: {
                        auth_lokterima: auth_lokterima
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataLokterima = JSON.parse(data);
                        if (dataLokterima.statusCode == 200) {
                            reseteditlokterima();
                            $("#editLokterimaKode").val(dataLokterima.kode);
                            $("#editLokterima").val(dataLokterima.lokterima);
                            $("#editLokterimaStatus").val(dataLokterima.status);
                            $("#editLokterimaKet").val(dataLokterima.ket);
                            $("#editLokterimamdl").modal("show");
                            $("#error1elkt").html('');
                            $("#error2elkt").html('');
                            $("#error3elkt").html('');
                            $("#error4elkt").html('');
                        } else {
                            $(".err_psn_lokterima").removeClass("d-none");
                            $(".err_psn_lokterima").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_lokterima").removeClass("alert-primary");
                        $(".err_psn_lokterima").addClass("alert-danger");
                        $(".err_psn_lokterima").removeClass("d-none");
                        if (xhr.status == 404) {
                            $(".err_psn_lokterima").html("Lokasi penerimaan gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_lokterima").html("Lokasi penerimaan gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_lokterima").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_lokterima").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_lokterima ").slideUp(500);
                            $(".err_psn_lokterima").addClass('d-none');
                        });
                    }
                });
            }
        });

        $("#btnrefreshLokterima").click(function() {
            $('#tbmLokterima').LoadingOverlay("show");
            tbmLokterima.draw()
            $('#tbmLokterima').LoadingOverlay("hide");
        });

        tbmLokterima = $('#tbmLokterima').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [1, 'asc'],
            ],
            "ajax": {
                "url": "<?= base_url('lokasipenerimaan/ajax_list'); ?>",
                "type": "POST",
                "error": function(xhr, error, code) {
                    if (code != "") {
                        $(".err_psn_okterima").removeClass("d-none");
                        $(".err_psn_lokterima").removeClass("d-none");
                        $(".err_psn_lokterima").html("Terjadi kesalahan saat melakukan load data lokasi penerimaan, hubungi administrator");
                        $("#addbtn").addClass("disabled");
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
                    name: 'id_lokterima',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "className": "text-center align-middle",
                    "width": "1%"
                },
                {
                    "data": 'kd_lokterima',
                    "className": "align-middle",
                    "width": "10%"
                },
                {
                    "data": 'lokterima',
                    "className": "text-nowrap align-middle",
                    "width": "50%"
                },
                {
                    "data": 'stat_lokterima',
                    "className": "text-center  align-middle",
                    "width": "1%"
                },
                {
                    "data": 'kode_perusahaan',
                    "className": "text-center text-nowrap align-middle",
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