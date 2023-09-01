
$(document).ready(function () {
    $("#logout").click(function () {
        $("#logoutmdl").modal("show");
    });

    $('#perLokker').select2({
        theme: 'bootstrap4'
    });

    window.addEventListener('resize', function (event) {
        $('#perLokker').select2({
            theme: 'bootstrap4'
        });
    }, true);

    $.ajax({
        type: "POST",
        url: site_url + "perusahaan/get_all",
        data: {},
        success: function (data) {
            var data = JSON.parse(data);
            $("#perLokker").html(data.prs);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".err_psn_lokker").removeClass('d-none');
            $(".err_psn_lokker").removeClass('alert-info');
            $(".err_psn_lokker").addClass('alert-danger');
            if (thrownError != "") {
                pesan = "Terjadi kesalahan saat load data perusahaan, hubungi administrator";
                swal("Error", pesan, 'error');
                $("#btnTambahLokker").remove();
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

    $('#btnupdateLokker').click(function () {
        let kode = $('#editLokkerKode').val();
        let lokker = $('#editLokker').val();
        let status = $('#editLokkerStatus').val();
        let ket = $('#editLokkerKet').val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "lokasikerja/edit_lokker",
            data: {
                kode: kode,
                lokker: lokker,
                status: status,
                ket: ket,
                token: token,
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    $('#editLokkermdl').modal('hide');
                    tbmLokker.draw();
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    reseteditlokker();
                } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
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
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat meng-update data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
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

    $("#btnBatalLokker").click(function () {
        resetaddlokker();
    });

    $("#btnTambahLokker").click(function () {
        var kode = $("#kodeLokker").val();
        var lokker = $("#Lokker").val();
        var ket = $("#ketLokker").val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "lokasikerja/input_lokker",
            data: {
                kode: kode.toUppercase(),
                lokker: lokker.toUppercase(),
                ket: ket,
                token: token,
            },
            timeout: 20000,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    resetaddlokker();
                } else if (data.statusCode == 201) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                } else if (data.statusCode == 202) {
                    $(".error1").html(data.kode);
                    $(".error2").html(data.lokker);
                    $(".error3").html(data.ket);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat meng-hapus data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        })
    });

    $(document).on('click', '.hpslokker', function () {
        let auth_lokker = $(this).attr('id');
        let namaLokker = $(this).attr('value');
        var token = $("#token").val();

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
            }).then(function (result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: "POST",
                        url: site_url + "lokasikerja/hapus_lokker",
                        data: {
                            auth_lokker: auth_lokker,
                            token: token,
                        },
                        timeout: 20000,
                        success: function (data, textStatus, xhr) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                tbmLokker.draw();
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            } else {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            }

                            $.LoadingOverlay("hide");
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (xhr.status == 404) {
                                pesan = "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
                            } else if (xhr.status == 0) {
                                pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
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

    $(document).on('click', '.dtllokker', function () {
        let auth_lokker = $(this).attr('id');
        var token = $("#token").val();

        if (auth_lokker == "") {
            swal("Error", "Lokasi kerja tidak ditemukan", "error");
        } else {
            $.ajax({
                type: "post",
                url: site_url + "lokasikerja/detail_lokker",
                data: {
                    auth_lokker: auth_lokker,
                    token: token,
                },
                timeout: 15000,
                success: function (data) {
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
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (xhr.status == 404) {
                        pesan = "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
                    } else if (xhr.status == 0) {
                        pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
                    } else {
                        pesan = "Terjadi kesalahan saat menampikan data, hubungi administrator";
                    }

                    swal("Error", pesan, 'error');
                }
            });
        }
    });

    $(document).on('click', '.edttlokker', function () {
        let auth_lokker = $(this).attr('id');
        var token = $("#token").val();

        if (auth_lokker == "") {
            swal("Error", "Lokasi kerja tidak ditemukan", "error");
        } else {
            $.ajax({
                type: "post",
                url: site_url + "lokasikerja/detail_lokker",
                data: {
                    auth_lokker: auth_lokker,
                    token: token,
                },
                timeout: 15000,
                success: function (data) {
                    var dataLokker = JSON.parse(data);
                    if (dataLokker.statusCode == 200) {
                        reseteditlokker();
                        $("#editLokkerKode").val(dataLokker.kode);
                        $("#editLokker").val(dataLokker.lokker);
                        $("#editLokkerStatus").val(dataLokker.status);
                        $("#editLokkerKet").val(dataLokker.ket);
                        $("#editLokkermdl").modal("show");
                    } else {
                        swal(dataLokker.kode_pesan, dataLokker.pesan, dataLokker.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (xhr.status == 404) {
                        pesan = "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
                    } else if (xhr.status == 0) {
                        pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
                    } else {
                        pesan = "Terjadi kesalahan saat menampikan data, hubungi administrator";
                    }

                    swal("Error", pesan, 'error');
                }
            });
        }
    });

    $("#btnrefreshLokker").click(function () {
        $('#tbmLokker').LoadingOverlay("show");
        tbmLokker.draw()
        $('#tbmLokker').LoadingOverlay("hide");
    });

    tbLokker()

    function tbLokker() {
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
                    tbmLokker = $('#tbmLokker').DataTable({
                        "processing": true,
                        "responsive": true,
                        "serverSide": true,
                        "ordering": true,
                        "order": [
                            [1, 'asc'],
                        ],
                        "ajax": {
                            "url": site_url + "lokasikerja/ajax_list?authtoken=" + $("#token").val(),
                            "type": "POST",
                            "error": function (xhr, error, code) {
                                if (code != "") {
                                    pesan = "terjadi kesalahan saat melakukan load data lokasi kerja, hubungi administrator";
                                    swal("Error", pesan, 'error');
                                    $("#secadd").remove();
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
                            render: function (data, type, row, meta) {
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
                            "width": "60%"
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
                } else {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");

                if (xhr.status == 404) {
                    pesan = "Lokasi kerja gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Lokasi kerja gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        });
    }

});