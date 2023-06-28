
    $(document).ready(function() {
        $("#logout").click(function() {
            $("#logoutmdl").modal("show");
       });
       
        $('#btnupdateSim').click(function() {
            let sim = $('#editSim').val();
            let status = $('#editSimStatus').val();
            let ket = $('#editSimKet').val();

            $.ajax({
                type: "POST",
                url: site_url+"sim/edit_sim",
                data: {
                    sim: sim,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmSim.draw();
                        $("#editSimmdl").modal("hide");
                        $(".err_psn_sim").removeClass('d-none');
                        $(".err_psn_sim").removeClass('alert-danger');
                        $(".err_psn_sim").addClass('alert-info');
                        $(".err_psn_sim").html(data.pesan);
                        $("#editSim").val('');
                        $("#editSimKet").val('');
                        $("#editSimStatus").val('');
                        $("#error1esim").html('');
                        $("#error2esim").html('');
                        $("#error3esim").html('');
                        $("#error4esim").html('');
                        $(".err_psn_sim").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_sim").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_sim").removeClass('d-none');
                        $(".err_psn_edit_sim").removeClass('alert-info');
                        $(".err_psn_edit_sim").addClass('alert-danger');
                        $(".err_psn_edit_sim").html(data.pesan);
                        $(".err_psn_edit_sim").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_sim").slideUp(500);
                        });
                        $("#error2esim").html('');
                        $("#error3esim").html('');
                        $("#error4esim").html('');
                    } else if (data.statusCode == 202) {
                        $("#error2esim").html(data.sim);
                        $("#error3esim").html(data.status);
                        $("#error4esim").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_sim").removeClass("alert-primary");
                    $(".err_psn_sim").addClass("alert-danger");
                    $(".err_psn_sim").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_sim").html("Sim gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_sim").html("Sim gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_sim").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }

                    $("#editSimmdl").modal("hide");
                    $(".err_psn_sim ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_sim ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        $("#btnBatalSim").click(function() {
            $("#Sim").val('');
            $("#ketSim").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
        });

        $("#btnTambahSim").click(function() {
            var sim = $("#Sim").val();
            var ket = $("#ketSim").val();

            $.ajax({
                type: "POST",
                url: site_url+"sim/input_sim",
                data: {
                    sim: sim,
                    ket: ket
                },
                timeout: 20000,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $(".err_psn_sim").removeClass('d-none');
                        $(".err_psn_sim").removeClass('alert-danger');
                        $(".err_psn_sim").addClass('alert-info');
                        $(".err_psn_sim").html(data.pesan);
                        $("#Sim").val('');
                        $("#ketSim").val('');
                        $(".error2").html('');
                        $(".error3").html('');
                    } else if (data.statusCode == 201) {
                        $(".err_psn_sim").removeClass('d-none');
                        $(".err_psn_sim").removeClass('alert-info');
                        $(".err_psn_sim").addClass('alert-danger');
                        $(".err_psn_sim").html(data.pesan);
                    } else if (data.statusCode == 202) {
                        $(".error2").html(data.sim);
                        $(".error3").html(data.ket);
                    }

                    $(".err_psn_sim").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_sim").slideUp(500);
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_sim").removeClass('d-none');
                    $(".err_psn_sim").removeClass("alert-primary");
                    $(".err_psn_sim").addClass("alert-danger");
                    if (xhr.status == 404) {
                        $(".err_psn_sim").html("Sim gagal disimpan, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_sim").html("Sim gagal disimpan, Waktu koneksi habis");
                    } else {
                        $(".err_psn_sim").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                    }

                    $(".err_psn_sim ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_sim ").slideUp(500);
                    });
                }
            })
        });

        $(document).on('click', '.hpssim', function() {
            let auth_sim = $(this).attr('id');
            let namaSim = $(this).attr('value');

            if (auth_sim == "") {
                $(".err_psn_sim").removeClass("alert-primary");
                $(".err_psn_sim").addClass("alert-danger");
                $(".err_psn_sim").removeClass('d-none');
                $(".err_psn_sim").html("Sim tidak ditemukan");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin " + namaSim + " akan dihapus?",
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
                            url: site_url+"Sim/hapus_sim",
                            data: {
                                auth_sim: auth_sim
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmSim.draw();
                                    $(".err_psn_sim").removeClass("alert-danger");
                                    $(".err_psn_sim").addClass("alert-primary");
                                    $(".err_psn_sim").removeClass('d-none');
                                    $(".err_psn_sim").html(data.pesan);
                                } else {
                                    $(".err_psn_sim").removeClass("alert-primary");
                                    $(".err_psn_sim").addClass("alert-danger");
                                    $(".err_psn_sim").removeClass('d-none');
                                    $(".err_psn_sim").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_sim").removeClass("alert-primary");
                                $(".err_psn_sim").addClass("alert-danger");
                                $(".err_psn_sim").removeClass('d-none');
                                if (xhr.status == 404) {
                                    $(".err_psn_sim").html("Sim gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_sim").html("Sim gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_sim").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_sim").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_psn_sim").slideUp(500);
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'Sim ' + namaSim + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtlsim', function() {
            let auth_sim = $(this).attr('id');
            let namaSim = $(this).attr('value');

            if (auth_sim == "") {
                $(".err_psn_sim").removeClass("alert-primary");
                $(".err_psn_sim").addClass("alert-danger");
                $(".err_psn_sim").removeClass('d-none');
                $(".err_psn_sim").html("Sim tidak ditemukan");
            } else {
                $.ajax({
                    type: "post",
                    url: site_url+"sim/detail_sim",
                    data: {
                        auth_sim: auth_sim
                    },
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#detailSim").val(data.sim);
                            $("#detailSimStatus").val(data.status);
                            $("#detailSimKet").val(data.ket);
                            $("#detailSimBuat").val(data.pembuat);
                            $("#detailSimTglBuat").val(data.tgl_buat);
                            $("#detailSimmdl").modal("show");
                        } else {
                            $(".err_psn_sim").removeClass('d-none');
                            $(".err_psn_sim").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_sim").removeClass("alert-primary");
                        $(".err_psn_sim").addClass("alert-danger");
                        $(".err_psn_sim").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_sim").html("Sim gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_sim").html("Sim gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_sim").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_sim ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_sim ").slideUp(500);
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edttsim', function() {
            let auth_sim = $(this).attr('id');
            let namaSim = $(this).attr('value');

            if (auth_sim == "") {
                swal("Error", "Sim tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: site_url+"Sim/detail_sim",
                    data: {
                        auth_sim: auth_sim
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataSim = JSON.parse(data);
                        if (dataSim.statusCode == 200) {
                            $("#editSim").val(dataSim.sim);
                            $("#editSimStatus").val(dataSim.status);
                            $("#editSimKet").val(dataSim.ket);
                            $("#editSimmdl").modal("show");
                            $("#error1et").html('');
                            $("#error2et").html('');
                            $("#error3et").html('');
                            $("#error4et").html('');
                        } else {
                            $(".err_psn_sim").removeClass('d-none');
                            $(".err_psn_sim").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_sim").removeClass("alert-primary");
                        $(".err_psn_sim").addClass("alert-danger");
                        $(".err_psn_sim").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_sim").html("Sim gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_sim").html("Sim gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_sim").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_sim ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_sim ").slideUp(500);
                        });
                    }
                });
            }
        });

        $("#btnrefreshSim").click(function() {
            $('#tbmSim').LoadingOverlay("show");
            tbmSim.draw()
            $('#tbmSim').LoadingOverlay("hide");
        });

        tbmSim = $('#tbmSim').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [1, 'asc'],
            ],
            "ajax": {
                "url": site_url+"sim/ajax_list",
                "type": "POST",
                "error": function(xhr, error, code) {
                    if (code != "") {
                        $(".err_psn_sim").removeClass("d-none");
                        $(".err_psn_sim").removeClass('d-none');
                        $(".err_psn_sim").html("terjadi kesalahan saat melakukan load data Sim, hubungi administrator");
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
                    name: 'id_sim',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "className": "text-center align-middle",
                    "width": "1%"
                },
                {
                    "data": 'sim',
                    "className": "text-nowrap align-middle",
                    "width": "50%"
                },
                {
                    "data": 'stat_sim',
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
