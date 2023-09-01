
$(document).ready(function () {
    $('#perTipe').select2({
        theme: 'bootstrap4'
    });

    window.addEventListener('resize', function (event) {
        $('#perTipe').select2({
            theme: 'bootstrap4'
        });
    }, true);

    $("#logout").click(function () {
        $("#logoutmdl").modal("show");
    });

    $('#btnupdateTipe').click(function () {
        let tipe = $('#editTipe').val();
        let status = $('#editTipeStatus').val();
        let ket = $('#editTipeKet').val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "tipe/edit_tipe",
            data: {
                tipe: tipe,
                status: status,
                ket: ket,
                token: token,
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    tbmTipe.draw();
                    $("#editTipemdl").modal("hide");
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#editTipe").val('');
                    $("#editTipeKet").val('');
                    $("#editTipeStatus").val('');
                    $("#error1et").html('');
                    $("#error2et").html('');
                    $("#error3et").html('');
                    $("#error4et").html('');
                } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
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
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".err_psn_tipe").removeClass("alert-primary");
                $(".err_psn_tipe").addClass("alert-danger");
                $(".err_psn_tipe").css("display", "block");
                if (xhr.status == 404) {
                    $(".err_psn_tipe").html("Golongan gagal diupdate, Link data tidak ditemukan");
                } else if (xhr.status == 0) {
                    $(".err_psn_tipe").html("Golongan gagal diupdate, Waktu koneksi habis");
                } else {
                    $(".err_psn_tipe").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                }
                $("#editTipemdl").modal("hide");
                $(".err_psn_tipe ").fadeTo(3000, 500).slideUp(500, function () {
                    $(".err_psn_tipe ").slideUp(500);
                });
            }
        })
    });

    $.LoadingOverlay("hide");

    $("#btnBatalTipe").click(function () {
        $("#perTipe").val('').trigger('change');
        $("#Tipe").val('');
        $("#ketTipe").val('');
        $(".error1").html('');
        $(".error2").html('');
        $(".error3").html('');
        $(".error4").html('');
        $(".error5").html('');
    });

    $.ajax({
        type: "POST",
        url: site_url + "perusahaan/get_all",
        success: function (data) {
            var data = JSON.parse(data);
            $("#perTipe").html(data.prs);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            if (thrownError != "") {
                pesan = "Terjadi kesalahan saat load data perusahaan, hubungi administrator";
                $("#btnTambahTipe").remove();
            } else {
                pesan = "";
            }

            swal("Error", pesan, 'error');
        }
    });

    $("#btnTambahTipe").click(function () {
        var tipe = $("#Tipe").val();
        var ket = $("#ketTipe").val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "tipe/input_tipe",
            data: {
                tipe: tipe.toUppercase(),
                ket: ket,
                token: token,
            },
            timeout: 20000,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#Tipe").val('');
                    $("#ketTipe").val('');
                    $(".error1").html('');
                    $(".error2").html('');
                    $(".error3").html('');
                    $(".error4").html('');
                } else if (data.statusCode == 201) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                } else if (data.statusCode == 202) {
                    $(".error1").html(data.prs);
                    $(".error2").html(data.kode);
                    $(".error3").html(data.tipe);
                    $(".error4").html(data.ket);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Golongan gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Golongan gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat meng-hapus data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        })
    });

    $(document).on('click', '.hpstipe', function () {
        let authtipe = $(this).attr('id');
        let namaTipe = $(this).attr('value');
        var token = $("#token").val();

        if (authtipe == "") {
            swal("Error", "Golongan tidak ditemukan", "error");
        } else {
            swal({
                title: "Hapus",
                text: "Yakin Golongan " + namaTipe + " akan dihapus?",
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
                        url: site_url + "tipe/hapus_tipe",
                        data: {
                            authtipe: authtipe,
                            token: token,
                        },
                        timeout: 20000,
                        success: function (data, textStatus, xhr) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                tbmTipe.draw();
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            } else {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            }

                            $.LoadingOverlay("hide");
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (xhr.status == 404) {
                                pesan = "Golongan gagal diupdate, Link data tidak ditemukan";
                            } else if (xhr.status == 0) {
                                pesan = "Golongan gagal diupdate, Waktu koneksi habis";
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

    $(document).on('click', '.dtltipe', function () {
        let authtipe = $(this).attr('id');
        var token = $("#token").val();

        if (authtipe == "") {
            swal("Error", "Golongan tidak ditemukan", "error");
        } else {
            $.ajax({
                type: "post",
                url: site_url + "tipe/detail_tipe",
                data: {
                    authtipe: authtipe,
                    token: token,
                },
                timeout: 15000,
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#detailTipeDepart").val(data.depart);
                        $("#detailTipe").val(data.tipe);
                        $("#detailTipeStatus").val(data.status);
                        $("#detailTipeKet").val(data.ket);
                        $("#detailTipeBuat").val(data.pembuat);
                        $("#detailTipeTglBuat").val(data.tgl_buat);
                        $("#detailTipemdl").modal("show");
                    } else {
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");

                    if (xhr.status == 404) {
                        pesan = "Golongan gagal diupdate, Link data tidak ditemukan";
                    } else if (xhr.status == 0) {
                        pesan = "Golongan gagal diupdate, Waktu koneksi habis";
                    } else {
                        pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                    }

                    swal("Error", pesan, 'error');
                }
            });
        }
    });

    $(document).on('click', '.edtttipe', function () {
        let authtipe = $(this).attr('id');
        var token = $("#token").val();

        if (authtipe == "") {
            swal("Error", "Golongan tidak ditemukan", "error");
        } else {
            $.ajax({
                type: "post",
                url: site_url + "tipe/detail_Tipe",
                data: {
                    authtipe: authtipe,
                    token: token,
                },
                timeout: 15000,
                success: function (data) {
                    var dataTipe = JSON.parse(data);
                    if (dataTipe.statusCode == 200) {
                        $("#editTipe").val(dataTipe.tipe);
                        $("#editTipeStatus").val(dataTipe.status);
                        $("#editTipeKet").val(dataTipe.ket);
                        $("#editTipemdl").modal("show");
                        $("#error1et").html('');
                        $("#error2et").html('');
                        $("#error3et").html('');
                        $("#error4et").html('');
                    } else {
                        swal(dataTipe.kode_pesan, dataTipe.pesan, dataTipe.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (xhr.status == 404) {
                        pesan = "Golongan gagal diupdate, Link data tidak ditemukan";
                    } else if (xhr.status == 0) {
                        pesan = "Golongan gagal diupdate, Waktu koneksi habis";
                    } else {
                        pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                    }

                    swal("Error", pesan, 'error');
                }
            });
        }
    });

    $("#btnrefreshTipe").click(function () {
        $('#tbmTipe').LoadingOverlay("show");
        tbmTipe.draw()
        $('#tbmTipe').LoadingOverlay("hide");
    });

    tbTipe();

    function tbTipe() {
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
                    tbmTipe = $('#tbmTipe').DataTable({
                        "processing": true,
                        "responsive": true,
                        "serverSide": true,
                        "ordering": true,
                        "order": [
                            [1, 'asc'],
                        ],
                        "ajax": {
                            "url": site_url + "tipe/ajax_list?authtoken=" + $("#token").val(),
                            "type": "POST",
                            "error": function (xhr, error, code) {
                                if (code != "") {
                                    pesan = "terjadi kesalahan saat melakukan load data golongan, hubungi administrator";
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
                            name: 'id_tipe',
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                            "className": "text-center align-middle",
                            "width": "1%"
                        },
                        {
                            "data": 'tipe',
                            "className": "text-nowrap align-middle",
                            "width": "25%"
                        },
                        {
                            "data": 'stat_tipe',
                            "className": "text-center text-nowrap  align-middle",
                            "width": "1%"
                        },
                        {
                            "data": 'tgl_buat',
                            "className": "text-center text-nowrap  align-middle",
                            "width": "8%"
                        },
                        {
                            "data": 'proses',
                            "className": "text-center text-nowrap  align-middle",
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
                    pesan = "Golongan gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Golongan gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        });
    }

});