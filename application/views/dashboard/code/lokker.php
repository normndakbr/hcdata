<script>
    //========================================== Lokker ========================================================
    $(document).ready(function() {
        $('#perLokker').select2({
            theme: 'bootstrap4'
        });

        $.ajax({
            type: "POST",
            url: "<?= base_url("perusahaan/get_all") ?>",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#perLokker").html(data.prs);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".err_psn_lokker").removeClass('d-none');
                $(".err_psn_lokker").removeClass('alert-info');
                $(".err_psn_lokker").addClass('alert-danger');
                if (thrownError != "") {
                    $(".err_psn_lokker").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                    $("#btnTambahLokker").attr("disabled", true);
                }
            }
        })

        function reseteditlokker() {
            $("#editLokkerKode").val('');
            $("#editLokker").val('');
            $("#editLokkerKet").val('');
            $("#editLokkerStatus").val('');
            $("#error1elkr").html('');
            $("#error2elkr").html('');
            $("#error3elkr").html('');
            $("#error4elkr").html('');
        }

        $('#btnupdateLokker').click(function() {
            let kode = $('#editLokkerKode').val();
            let lokker = $('#editLokker').val();
            let status = $('#editLokkerStatus').val();
            let ket = $('#editLokkerKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('lokasikerja/edit_lokker'); ?>",
                data: {
                    kode: kode,
                    lokker: lokker,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmLokker.draw();
                        $("#editLokkermdl").modal("hide");
                        $(".err_psn_lokker").removeClass('d-none');
                        $(".err_psn_lokker").removeClass('alert-danger');
                        $(".err_psn_lokker").addClass('alert-info');
                        $(".err_psn_lokker").html(data.pesan);
                        reseteditlokker();
                        $(".err_psn_lokker").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_lokker").slideUp(500);
                            $(".err_psn_lokker").addClass('d-none');
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_lokker").removeClass('d-none');
                        $(".err_psn_edit_lokker").removeClass('alert-info');
                        $(".err_psn_edit_lokker").addClass('alert-danger');
                        $(".err_psn_edit_lokker").html(data.pesan);
                        $(".err_psn_edit_lokker").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_lokker").slideUp(500);
                            $(".err_psn_lokker").addClass('d-none');
                        });
                        $("#error1elkr").html('');
                        $("#error2elkr").html('');
                        $("#error3elkr").html('');
                        $("#error4elkr").html('');
                    } else if (data.statusCode == 202) {
                        $("#error1elkr").html(data.kode);
                        $("#error2elkr").html(data.lokker);
                        $("#error3elkr").html(data.status);
                        $("#error4elkr").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_lokker").removeClass("alert-primary");
                    $(".err_psn_lokker").addClass("alert-danger");
                    $(".err_psn_lokker").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_lokker").html("Lokasi kerja gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_lokker").html("Lokasi kerja gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_lokker").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }
                    $("#editLokkermdl").modal("hide");
                    $(".err_psn_lokker ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_lokker ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        function resetaddlokker() {
            $("#kodeLokker").val('');
            $("#Lokker").val('');
            $("#ketLokker").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
        }

        $("#btnBatalLokker").click(function() {
            resetaddlokker();
        });

        $("#btnTambahLokker").click(function() {
            var kode = $("#kodeLokker").val();
            var lokker = $("#Lokker").val();
            var ket = $("#ketLokker").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url("lokasikerja/input_lokker") ?>",
                data: {
                    kode: kode,
                    lokker: lokker,
                    ket: ket
                },
                timeout: 20000,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $(".err_psn_lokker").removeClass('d-none');
                        $(".err_psn_lokker").removeClass('alert-danger');
                        $(".err_psn_lokker").addClass('alert-info');
                        $(".err_psn_lokker").html(data.pesan);
                        resetaddlokker();
                    } else if (data.statusCode == 201) {
                        $(".err_psn_lokker").removeClass('d-none');
                        $(".err_psn_lokker").removeClass('alert-info');
                        $(".err_psn_lokker").addClass('alert-danger');
                        $(".err_psn_lokker").html(data.pesan);
                    } else if (data.statusCode == 202) {
                        $(".error1").html(data.kode);
                        $(".error2").html(data.lokker);
                        $(".error3").html(data.ket);
                    }

                    $(".err_psn_lokker").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_lokker").slideUp(500);
                        $(".err_psn_lokker").addClass('d-none');
                    });


                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_lokker").removeClass("alert-primary");
                    $(".err_psn_lokker").addClass("alert-danger");
                    $(".err_psn_lokker").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_lokker").html("Lokasi kerja gagal disimpan, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_lokker").html("Lokasi kerja kerjakker gagal disimpan, Waktu koneksi habis");
                    } else {
                        $(".err_psn_lokker").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                    }

                    $(".err_psn_lokker ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_lokker ").slideUp(500);
                        $(".err_psn_lokker").addClass('d-none');
                    });
                }
            })
        });

        $(document).on('click', '.hpslokker', function() {
            let auth_lokker = $(this).attr('id');
            let namaLokker = $(this).attr('value');

            if (auth_lokker == "") {
                swal("Error", "Lokasi kerja tidak ditemukan", "error");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin Lokasi kerja " + namaLokker + " akan dihapus?",
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
                            url: "<?= base_url('lokasikerja/hapus_lokker'); ?>",
                            data: {
                                auth_lokker: auth_lokker
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmLokker.draw();
                                    $(".err_psn_lokker").removeClass("alert-danger");
                                    $(".err_psn_lokker").addClass("alert-primary");
                                    $(".err_psn_lokker").removeClass("d-none");
                                    $(".err_psn_lokker").html(data.pesan);
                                } else {
                                    $(".err_psn_lokker").removeClass("alert-primary");
                                    $(".err_psn_lokker").addClass("alert-danger");
                                    $(".err_psn_lokker").removeClass("d-none");
                                    $(".err_psn_lokker").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_lokker").removeClass("alert-primary");
                                $(".err_psn_lokker").addClass("alert-danger");
                                $(".err_psn_lokker").removeClass("d-none");
                                if (xhr.status == 404) {
                                    $(".err_psn_lokker").html("Lokasi kerja gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_lokker").html("Lokasi kerja gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_lokker").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_lokker").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_psn_lokker").slideUp(500);
                            $(".err_psn_lokker").addClass('d-none');
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'Lokasi kerja ' + namaLokker + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtllokker', function() {
            let auth_lokker = $(this).attr('id');
            let namaLokker = $(this).attr('value');

            if (auth_lokker == "") {
                swal("Error", "Lokasi kerja tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('lokasikerja/detail_lokker'); ?>",
                    data: {
                        auth_lokker: auth_lokker
                    },
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#detailLokkerKode").val(data.kode);
                            $("#detailLokker").val(data.lokker);
                            $("#detailLokkerStatus").val(data.status);
                            $("#detailLokkerKet").val(data.ket);
                            $("#detailLokkerBuat").val(data.pembuat);
                            $("#detailLokkerTglBuat").val(data.tgl_buat);
                            $("#detailLokkermdl").modal("show");
                        } else {
                            $(".err_psn_lokker").removeClass("d-none");
                            $(".err_psn_lokker").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_lokker").removeClass("alert-primary");
                        $(".err_psn_lokker").addClass("alert-danger");
                        $(".err_psn_lokker").removeClass("d-none");
                        if (xhr.status == 404) {
                            $(".err_psn_lokker").html("Lokasi kerja gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_lokker").html("Lokasi kerja gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_lokker").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_lokker ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_lokker ").slideUp(500);
                            $(".err_psn_lokker").addClass('d-none');
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edttlokker', function() {
            let auth_lokker = $(this).attr('id');
            let namaLokker = $(this).attr('value');

            if (auth_lokker == "") {
                swal("Error", "Lokasi kerja tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('lokasikerja/detail_lokker'); ?>",
                    data: {
                        auth_lokker: auth_lokker
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataLokker = JSON.parse(data);
                        if (dataLokker.statusCode == 200) {
                            reseteditlokker();
                            $("#editLokkerKode").val(dataLokker.kode);
                            $("#editLokker").val(dataLokker.lokker);
                            $("#editLokkerStatus").val(dataLokker.status);
                            $("#editLokkerKet").val(dataLokker.ket);
                            $("#editLokkermdl").modal("show");
                        } else {
                            $(".err_psn_lokker").removeClass("d-none");
                            $(".err_psn_lokker").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_lokker").removeClass("alert-primary");
                        $(".err_psn_lokker").addClass("alert-danger");
                        $(".err_psn_lokker").removeClass("d-none");
                        if (xhr.status == 404) {
                            $(".err_psn_lokker").html("Lokasi kerja gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_lokker").html("Lokasi kerja gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_lokker").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_lokker ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_lokker ").slideUp(500);
                            $(".err_psn_lokker").addClass('d-none');
                        });
                    }
                });
            }
        });

        $("#btnrefreshLokker").click(function() {
            $('#tbmLokker').LoadingOverlay("show");
            tbmLokker.draw()
            $('#tbmLokker').LoadingOverlay("hide");
        });

        tbmLokker = $('#tbmLokker').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [1, 'asc'],
            ],
            "ajax": {
                "url": "<?= base_url('lokasikerja/ajax_list'); ?>",
                "type": "POST",
                "error": function(xhr, error, code) {
                    if (code != "") {
                        $(".err_psn_lokker").removeClass("d-none");
                        $(".err_psn_lokker").html("terjadi kesalahan saat melakukan load data lokasi kerja, hubungi administrator");
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
                    name: 'id_lokker',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "className": "text-center align-middle",
                    "width": "1%"
                },
                {
                    "data": 'kd_lokker',
                    "className": "text-nowrap align-middle",
                    "width": "10%"
                },
                {
                    "data": 'lokker',
                    "className": "text-nowrap  align-middle",
                    "width": "25%"
                },
                {
                    "data": 'stat_lokker',
                    "className": "text-center  align-middle",
                    "width": "1%"
                },
                {
                    "data": 'tgl_buat',
                    "className": "text-center text-nowrap",
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