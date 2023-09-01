
$(document).ready(function () {
    $("#logout").click(function () {
        $("#logoutmdl").modal("show");
    });

    $('#btnupdateUnit').click(function () {
        let kode_unit = $('#editKodeUnit').val();
        let unit = $('#editUnit').val();
        let status = $('#editUnitStatus').val();
        let ket = $('#editUnitKet').val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "unit/edit_unit",
            data: {
                kode_unit: kode_unit,
                unit: unit,
                status: status,
                ket: ket,
                token: token,
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    tbmUnit.draw();
                    $("#editUnitmdl").modal("hide");
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#editUnit").val('');
                    $("#editUnitKet").val('');
                    $("#editUnitStatus").val('');
                    $("#error1eunt").html('');
                    $("#error2eunt").html('');
                    $("#error3eunt").html('');
                    $("#error4eunt").html('');
                } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#error2eunt").html('');
                    $("#error3eunt").html('');
                    $("#error4eunt").html('');
                } else if (data.statusCode == 202) {
                    $("#error2eunt").html(data.unit);
                    $("#error3eunt").html(data.status);
                    $("#error4eunt").html(data.ket);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Unit gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Unit gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat meng-update data, hubungi administrator";
                }

                swal("Error", pesan, 'error');

                $("#editUnitmdl").modal("hide");
            }
        })
    });

    $.LoadingOverlay("hide");

    $("#btnBatalUnit").click(function () {
        $("#KodeUnit").val('');
        $("#Unit").val('');
        $("#ketUnit").val('');
        $(".error1").html('');
        $(".error2").html('');
        $(".error3").html('');
    });

    $("#btnTambahUnit").click(function () {
        var kode_unit = $("#KodeUnit").val();
        var unit = $("#Unit").val();
        var ket = $("#ketUnit").val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "unit/input_unit",
            data: {
                kode_unit: kode_unit.toUppercase(),
                unit: unit.toUppercase(),
                ket: ket,
                token: token,
            },
            timeout: 20000,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#KodeUnit").val('');
                    $("#Unit").val('');
                    $("#ketUnit").val('');
                    $(".error2").html('');
                    $(".error3").html('');
                } else if (data.statusCode == 201) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                } else if (data.statusCode == 202) {
                    $(".error2").html(data.unit);
                    $(".error3").html(data.ket);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Unit gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Unit gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat meng-hapus data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        })
    });

    $(document).on('click', '.hpsunit', function () {
        let auth_unit = $(this).attr('id');
        let namaUnit = $(this).attr('value');
        var token = $("#token").val();

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
            }).then(function (result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: "POST",
                        url: site_url + "Unit/hapus_unit",
                        data: {
                            auth_unit: auth_unit,
                            token: token,
                        },
                        timeout: 20000,
                        success: function (data, textStatus, xhr) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                tbmUnit.draw();
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            } else {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            }

                            $.LoadingOverlay("hide");
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");

                            if (xhr.status == 404) {
                                pesan = "Unit gagal diupdate, Link data tidak ditemukan";
                            } else if (xhr.status == 0) {
                                pesan = "Unit gagal diupdate, Waktu koneksi habis";
                            } else {
                                pesan = "Terjadi kesalahan saat meng-hapus data, hubungi administrator";
                            }

                            swal("Error", pesan, 'error');
                        }
                    });
                }
            });
        }
    });

    $(document).on('click', '.dtlunit', function () {
        let auth_unit = $(this).attr('id');
        var token = $("#token").val();

        if (auth_unit == "") {
            swal("Error", "Unit tidak ditemukan", "error");
        } else {
            $.ajax({
                type: "post",
                url: site_url + "unit/detail_unit",
                data: {
                    auth_unit: auth_unit,
                    token: token,
                },
                timeout: 15000,
                success: function (data) {
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
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (xhr.status == 404) {
                        pesan = "Unit gagal diupdate, Link data tidak ditemukan";
                    } else if (xhr.status == 0) {
                        pesan = "Unit gagal diupdate, Waktu koneksi habis";
                    } else {
                        pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                    }

                    swal("Error", pesan, 'error');
                }
            });
        }
    });

    $(document).on('click', '.edttunit', function () {
        let auth_unit = $(this).attr('id');
        var token = $("#token").val();

        if (auth_unit == "") {
            swal("Error", "Unit tidak ditemukan", "error");
        } else {
            $.ajax({
                type: "post",
                url: site_url + "Unit/detail_unit",
                data: {
                    auth_unit: auth_unit,
                    token: token,
                },
                timeout: 15000,
                success: function (data) {
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
                        swal(dataUnit.kode_pesan, dataUnit.pesan, dataUnit.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (xhr.status == 404) {
                        pesan = "Unit gagal diupdate, Link data tidak ditemukan";
                    } else if (xhr.status == 0) {
                        pesan = "Unit gagal diupdate, Waktu koneksi habis";
                    } else {
                        pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                    }

                    swal("Error", pesan, 'error');
                }
            });
        }
    });

    $("#btnrefreshUnit").click(function () {
        $('#tbmUnit').LoadingOverlay("show");
        tbUnit();
        $('#tbmUnit').LoadingOverlay("hide");
    });

    tbUnit();

    function tbUnit() {
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "dash/Oauth",
            data: {
                token: token,
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    tbmUnit = $('#tbmUnit').DataTable({
                        "processing": true,
                        "responsive": true,
                        "serverSide": true,
                        "ordering": true,
                        "order": [
                            [1, 'asc'],
                        ],
                        "ajax": {
                            "url": site_url + "unit/ajax_list?authtoken=" + $("#token").val(),
                            "type": "POST",
                            "error": function (xhr, error, code) {
                                if (code != "") {
                                    pesan = "terjadi kesalahan saat melakukan load data Unit, hubungi administrator";
                                    $("#secadd").remove();
                                } else {
                                    pesan = "";
                                }

                                swal("Error", pesan, 'error');
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
                            render: function (data, type, row, meta) {
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
                } else {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");

                if (xhr.status == 404) {
                    pesan = "Unit gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Unit gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        });
    }
});