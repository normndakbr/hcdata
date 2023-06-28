
    $(document).ready(function() {
        $("#logout").click(function() {
            $("#logoutmdl").modal("show");
       });
       
        $('#btnupdateUnit').click(function() {
            let kode_unit = $('#editKodeUnit').val();
            let unit = $('#editUnit').val();
            let status = $('#editUnitStatus').val();
            let ket = $('#editUnitKet').val();

            $.ajax({
                type: "POST",
                url: site_url+"unit/edit_unit",
                data: {
                    kode_unit: kode_unit,
                    unit: unit,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmUnit.draw();
                        $("#editUnitmdl").modal("hide");
                        $(".err_psn_unit").removeClass('d-none');
                        $(".err_psn_unit").removeClass('alert-danger');
                        $(".err_psn_unit").addClass('alert-info');
                        $(".err_psn_unit").html(data.pesan);
                        $("#editUnit").val('');
                        $("#editUnitKet").val('');
                        $("#editUnitStatus").val('');
                        $("#error1eunt").html('');
                        $("#error2eunt").html('');
                        $("#error3eunt").html('');
                        $("#error4eunt").html('');
                        $(".err_psn_unit").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_unit").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_unit").removeClass('d-none');
                        $(".err_psn_edit_unit").removeClass('alert-info');
                        $(".err_psn_edit_unit").addClass('alert-danger');
                        $(".err_psn_edit_unit").html(data.pesan);
                        $(".err_psn_edit_unit").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_unit").slideUp(500);
                        });
                        $("#error2eunt").html('');
                        $("#error3eunt").html('');
                        $("#error4eunt").html('');
                    } else if (data.statusCode == 202) {
                        $("#error2eunt").html(data.unit);
                        $("#error3eunt").html(data.status);
                        $("#error4eunt").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_unit").removeClass("alert-primary");
                    $(".err_psn_unit").addClass("alert-danger");
                    $(".err_psn_unit").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_unit").html("Unit gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_unit").html("Unit gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_unit").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }

                    $("#editUnitmdl").modal("hide");
                    $(".err_psn_unit ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_unit ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        $("#btnBatalUnit").click(function() {
            $("#KodeUnit").val('');
            $("#Unit").val('');
            $("#ketUnit").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
        });

        $("#btnTambahUnit").click(function() {
            var kode_unit = $("#KodeUnit").val();
            var unit = $("#Unit").val();
            var ket = $("#ketUnit").val();

            $.ajax({
                type: "POST",
                url: site_url+"unit/input_unit",
                data: {
                    kode_unit: kode_unit,
                    unit: unit,
                    ket: ket
                },
                timeout: 20000,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $(".err_psn_unit").removeClass('d-none');
                        $(".err_psn_unit").removeClass('alert-danger');
                        $(".err_psn_unit").addClass('alert-info');
                        $(".err_psn_unit").html(data.pesan);
                        $("#KodeUnit").val('');
                        $("#Unit").val('');
                        $("#ketUnit").val('');
                        $(".error2").html('');
                        $(".error3").html('');
                    } else if (data.statusCode == 201) {
                        $(".err_psn_unit").removeClass('d-none');
                        $(".err_psn_unit").removeClass('alert-info');
                        $(".err_psn_unit").addClass('alert-danger');
                        $(".err_psn_unit").html(data.pesan);
                    } else if (data.statusCode == 202) {
                        $(".error2").html(data.unit);
                        $(".error3").html(data.ket);
                    }

                    $(".err_psn_unit").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_unit").slideUp(500);
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_unit").removeClass('d-none');
                    $(".err_psn_unit").removeClass("alert-primary");
                    $(".err_psn_unit").addClass("alert-danger");
                    if (xhr.status == 404) {
                        $(".err_psn_unit").html("Unit gagal disimpan, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_unit").html("Unit gagal disimpan, Waktu koneksi habis");
                    } else {
                        $(".err_psn_unit").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                    }

                    $(".err_psn_unit ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_unit ").slideUp(500);
                    });
                }
            })
        });

        $(document).on('click', '.hpsunit', function() {
            let auth_unit = $(this).attr('id');
            let namaUnit = $(this).attr('value');

            if (auth_unit == "") {
                $(".err_psn_unit").removeClass("alert-primary");
                $(".err_psn_unit").addClass("alert-danger");
                $(".err_psn_unit").removeClass('d-none');
                $(".err_psn_unit").html("Unit tidak ditemukan");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin " + namaUnit + " akan dihapus?",
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
                            url: site_url+"Unit/hapus_unit",
                            data: {
                                auth_unit: auth_unit
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmUnit.draw();
                                    $(".err_psn_unit").removeClass("alert-danger");
                                    $(".err_psn_unit").addClass("alert-primary");
                                    $(".err_psn_unit").removeClass('d-none');
                                    $(".err_psn_unit").html(data.pesan);
                                } else {
                                    $(".err_psn_unit").removeClass("alert-primary");
                                    $(".err_psn_unit").addClass("alert-danger");
                                    $(".err_psn_unit").removeClass('d-none');
                                    $(".err_psn_unit").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_unit").removeClass("alert-primary");
                                $(".err_psn_unit").addClass("alert-danger");
                                $(".err_psn_unit").removeClass('d-none');
                                if (xhr.status == 404) {
                                    $(".err_psn_unit").html("Unit gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_unit").html("Unit gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_unit").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_unit").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_psn_unit").slideUp(500);
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'Unit ' + namaUnit + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtlunit', function() {
            let auth_unit = $(this).attr('id');
            let namaUnit = $(this).attr('value');

            if (auth_unit == "") {
                $(".err_psn_unit").removeClass("alert-primary");
                $(".err_psn_unit").addClass("alert-danger");
                $(".err_psn_unit").removeClass('d-none');
                $(".err_psn_unit").html("Unit tidak ditemukan");
            } else {
                $.ajax({
                    type: "post",
                    url: site_url+"unit/detail_unit",
                    data: {
                        auth_unit: auth_unit
                    },
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#detailKodeUnit").val(data.kode_unit);
                            $("#detailUnit").val(data.unit);
                            $("#detailUnitStatus").val(data.status);
                            $("#detailUnitKet").val(data.ket);
                            $("#detailUnitBuat").val(data.pembuat);
                            $("#detailUnitTglBuat").val(data.tgl_buat);
                            $("#detailUnitmdl").modal("show");
                        } else {
                            $(".err_psn_unit").removeClass('d-none');
                            $(".err_psn_unit").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_unit").removeClass("alert-primary");
                        $(".err_psn_unit").addClass("alert-danger");
                        $(".err_psn_unit").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_unit").html("Unit gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_unit").html("Unit gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_unit").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_unit ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_unit ").slideUp(500);
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edttunit', function() {
            let auth_unit = $(this).attr('id');
            let namaUnit = $(this).attr('value');

            if (auth_unit == "") {
                swal("Error", "Unit tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: site_url+"Unit/detail_unit",
                    data: {
                        auth_unit: auth_unit
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataUnit = JSON.parse(data);
                        if (dataUnit.statusCode == 200) {
                            $("#editKodeUnit").val(dataUnit.kode_unit);
                            $("#editUnit").val(dataUnit.unit);
                            $("#editUnitStatus").val(dataUnit.status);
                            $("#editUnitKet").val(dataUnit.ket);
                            $("#editUnitmdl").modal("show");
                            $("#error1et").html('');
                            $("#error2et").html('');
                            $("#error3et").html('');
                            $("#error4et").html('');
                        } else {
                            $(".err_psn_unit").removeClass('d-none');
                            $(".err_psn_unit").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_unit").removeClass("alert-primary");
                        $(".err_psn_unit").addClass("alert-danger");
                        $(".err_psn_unit").removeClass('d-none');
                        if (xhr.status == 404) {
                            $(".err_psn_unit").html("Unit gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_unit").html("Unit gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_unit").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_unit ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_unit ").slideUp(500);
                        });
                    }
                });
            }
        });

        $("#btnrefreshUnit").click(function() {
            $('#tbmUnit').LoadingOverlay("show");
            tbmUnit.draw()
            $('#tbmUnit').LoadingOverlay("hide");
        });

        tbmUnit = $('#tbmUnit').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [1, 'asc'],
            ],
            "ajax": {
                "url": site_url+"unit/ajax_list",
                "type": "POST",
                "error": function(xhr, error, code) {
                    if (code != "") {
                        $(".err_psn_unit").removeClass("d-none");
                        $(".err_psn_unit").removeClass('d-none');
                        $(".err_psn_unit").html("terjadi kesalahan saat melakukan load data Unit, hubungi administrator");
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
                    name: 'id_unit',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "className": "text-center align-middle",
                    "width": "1%"
                },
                {
                    "data": 'kode_unit',
                    "className": "text-nowrap align-middle",
                    "width": "10%"
                },
                {
                    "data": 'unit',
                    "className": "text-nowrap align-middle",
                    "width": "50%"
                },
                {
                    "data": 'stat_unit',
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