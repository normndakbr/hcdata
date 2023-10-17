$(document).ready(function () {

    $('#btnupdatePosisi').click(function () {
        let posisi = $('#editPosisi').val();
        let depart = $('#editPosisiDepart').val();
        let status = $('#editPosisiStatus').val();
        let ket = $('#editPosisiKet').val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "posisi/edit_posisi",
            data: {
                posisi: posisi,
                depart: depart,
                status: status,
                ket: ket,
                token: token,
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    tbmPosisi.draw();
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#editPosisi").val('');
                    $("#editPosisiKet").val('');
                    $("#editPosisiStatus").val('');
                    $("#error2ep").html('');
                    $("#error3ep").html('');
                    $("#error4ep").html('');
                    $("#error5ep").html('');
                    $("#editPosisimdl").modal("hide");
                } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                } else if (data.statusCode == 202) {
                    $("#error2ep").html(data.posisi);
                    $("#error3ep").html(data.depart);
                    $("#error4ep").html(data.status);
                    $("#error5ep").html(data.ket);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Posisi gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat meng-update data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        })
    });

    $.LoadingOverlay("hide");

    $("#btnBatalPosisi").click(function () {
        $("#perPosisi").val('').trigger('change');
        $("#depPosisi").val('').trigger('change');
        $("#kodSPosisi").val('');
        $("#Posisi").val('');
        $("#ketPosisi").val('');
        $(".error1").html('');
        $(".error2").html('');
        $(".error3").html('');
        $(".error4").html('');
        $(".error5").html('');
    });

    $('#depPosisi').select2({
        theme: 'bootstrap4'
    });
    $('#perPosisi').select2({
        theme: 'bootstrap4'
    });
    $('#perPosisiData').select2({
        theme: 'bootstrap4'
    });
    $('#editPosisiDepart').select2({
        theme: 'bootstrap4',
        dropdownParent: $('#editPosisimdl')
    });

    window.addEventListener('resize', function (event) {
        $('#depPosisi').select2({
            theme: 'bootstrap4'
        });
        $('#perPosisi').select2({
            theme: 'bootstrap4'
        });
        $('#perPosisiData').select2({
            theme: 'bootstrap4'
        });
        $('#editPosisiDepart').select2({
            theme: 'bootstrap4',
            dropdownParent: $('#editPosisimdl')
        });
    }, true);

    $("#perPosisiData").change(function () {
        let prs = $("#perPosisiData").val();

        $('#tbmPosisi').LoadingOverlay('show');
        $('#tbmPosisi').DataTable().destroy();

        tbPosisi();
    });

    $.ajax({
        type: "POST",
        url: site_url + "perusahaan/getidperusahaan",
        data: {},
        success: function (data) {
            var data = JSON.parse(data);
            if (data.statusCode == 200) {
                $("#perPosisiData").val(data.prs).trigger('change');
            } else {
                $("#perPosisiData").val('').trigger('change');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            if (thrownError != "") {
                pesan = "Terjadi kesalahan saat load data perusahaan, hubungi administrator";
                $("#btnTambahPosisi").remove()
            }

            swal("Error", pesan, 'error');
        }
    })

    $('#perPosisi').change(function () {
        let auth_per = $("#perPosisi").val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "departemen/get_by_authper",
            data: {
                auth_per: auth_per,
                token: token,
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    $('#depPosisi').removeAttr('disabled');
                    $("#depPosisi").html(data.dprt);
                } else {
                    $("#depPosisi").html('<option value="">-- DEPARTEMEN TIDAK DITEMUKAN --</option>');
                    $("#depPosisi").attr('disabled', true);
                }
            }
        })
    });

    $("#btnTambahPosisi").click(function () {
        var prs = $("#perPosisi").val();
        var depart = $("#depPosisi").val();
        var posisi = $("#Posisi").val();
        var ket = $("#ketPosisi").val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "Posisi/input_posisi",
            data: {
                prs: prs,
                posisi: posisi,
                depart: depart,
                ket: ket,
                token: token,
            },
            timeout: 20000,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#Posisi").val('');
                    $("#ketPosisi").val('');
                    $(".error1").html('');
                    $(".error2").html('');
                    $(".error4").html('');
                    $(".error5").html('');
                } else if (data.statusCode == 201) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                } else if (data.statusCode == 202) {
                    $(".error1").html(data.prs);
                    $(".error2").html(data.depart);
                    $(".error4").html(data.posisi);
                    $(".error5").html(data.ket);
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Posisi gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat membuat data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        })
    });

    $(document).on('click', '.hpsposisi', function () {
        let authposisi = $(this).attr('id');
        let namaPosisi = $(this).attr('value');
        var token = $("#token").val();

        if (authposisi == "") {
            swal("Error", "Posisi tidak ditemukan", "error");
        } else {
            swal({
                title: "Hapus",
                text: "Yakin Posisi " + namaPosisi + " akan dihapus?",
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
                        url: site_url + "Posisi/hapus_Posisi",
                        data: {
                            authposisi: authposisi,
                            token: token,
                        },
                        timeout: 20000,
                        success: function (data, textStatus, xhr) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                tbmPosisi.draw();
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            } else {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            }

                            $.LoadingOverlay("hide");
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");

                            if (xhr.status == 404) {
                                pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
                            } else if (xhr.status == 0) {
                                pesan = "Posisi gagal diupdate, Waktu koneksi habis";
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

    $(document).on('click', '.dtlposisi', function () {
        let authposisi = $(this).attr('id');
        var token = $("#token").val();

        if (authposisi == "") {
            swal("Error", "Posisi tidak ditemukan", "error");
        } else {
            $.ajax({
                type: "post",
                url: site_url + "posisi/detail_posisi",
                data: {
                    authposisi: authposisi,
                    token: token,
                },
                timeout: 15000,
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#detailPosisiPerusahaan").val(data.nama_perusahaan);
                        $("#detailPosisiDepart").val(data.depart);
                        $("#detailPosisi").val(data.posisi);
                        $("#detailPosisiStatus").val(data.status);
                        $("#detailPosisiKet").val(data.ket);
                        $("#detailPosisiBuat").val(data.pembuat);
                        $("#detailPosisiTglBuat").val(data.tgl_buat);
                        $("#detailPosisimdl").modal("show");
                    } else {
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");

                    if (xhr.status == 404) {
                        pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
                    } else if (xhr.status == 0) {
                        pesan = "Posisi gagal diupdate, Waktu koneksi habis";
                    } else {
                        pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                    }

                    swal("Error", pesan, 'error');
                }
            });
        }
    });

    $(document).on('click', '.edttposisi', function () {
        let authposisi = $(this).attr('id');
        var token = $("#token").val();

        if (authposisi == "") {
            swal("Error", "Posisi tidak ditemukan", "error");
        } else {
            $.ajax({
                type: "post",
                url: site_url + "posisi/detail_posisi",
                data: {
                    authposisi: authposisi,
                    token: token,
                },
                timeout: 15000,
                success: function (data) {
                    var dataPosisi = JSON.parse(data);
                    if (dataPosisi.statusCode == 200) {
                        $.ajax({
                            type: "POST",
                            url: site_url + "Posisi/get_by_idper",
                            data: {
                                token: token,
                            },
                            success: function (data) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    $("#editPosisiDepart").html(data.depart);
                                    $.LoadingOverlay("hide");
                                } else {
                                    $("#editPosisiDepart").html(data.depart);
                                    $.LoadingOverlay("hide");
                                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                }
                                $("#editPosisiDepart").val(dataPosisi.auth_depart);
                                $("#editPosisi").val(dataPosisi.posisi);
                                $("#editPosisiStatus").val(dataPosisi.status);
                                $("#editPosisiKet").val(dataPosisi.ket);
                                $("#editPosisimdl").modal("show");
                                $("#error2ep").html('');
                                $("#error3ep").html('');
                                $("#error4ep").html('');
                                $("#error5ep").html('');
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                if (xhr.status == 404) {
                                    pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
                                } else if (xhr.status == 0) {
                                    pesan = "Posisi gagal diupdate, Waktu koneksi habis";
                                } else {
                                    pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                                }

                                swal("Error", pesan, 'error');
                            }
                        });
                    } else {
                        swal(dataPosisi.kode_pesan, dataPosisi.pesan, dataPosisi.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (xhr.status == 404) {
                        pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
                    } else if (xhr.status == 0) {
                        pesan = "Posisi gagal diupdate, Waktu koneksi habis";
                    } else {
                        pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                    }

                    swal("Error", pesan, 'error');
                }
            });
        }
    });

    $("#btnrefreshPosisi").click(function () {
        $('#tbmPosisi').LoadingOverlay("show");
        tbmPosisi.draw()
        $('#tbmPosisi').LoadingOverlay("hide");
    });

    function tbPosisi() {
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
                    tbmPosisi = $('#tbmPosisi').DataTable({
                        "processing": true,
                        "responsive": true,
                        "serverSide": true,
                        "ordering": true,
                        "order": [
                            [2, 'asc'],
                        ],
                        "ajax": {
                            "url": site_url + "posisi/ajax_list?auth_per=" + $("#perPosisiData").val() + "&authtoken=" + $("#token").val(),
                            "type": "POST",
                            "error": function (xhr, error, code) {
                                if (code != "") {
                                    pesan = "terjadi kesalahan saat melakukan load data posisi, hubungi administrator";
                                    $("#secadd").remove();
                                    swal("Error", pesan, 'error');
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
                            name: 'id_posisi',
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                            "className": "text-center align-middle",
                            "width": "1%"
                        },
                        {
                            "data": 'posisi',
                            "className": "text-nowrap align-middle",
                            "width": "25%"
                        },
                        {
                            "data": 'depart',
                            "className": "text-nowrap align-middle",
                            "width": "42%"
                        },
                        {
                            "data": 'stat_posisi',
                            "className": "text-center text-nowrap align-middle",
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

                    $("#tbmPosisi").LoadingOverlay("hide");
                } else {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");

                if (xhr.status == 404) {
                    pesan = "Posisi gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Posisi gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        });
    }

});