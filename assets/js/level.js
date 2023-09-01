$(document).ready(function () {

    $("#logout").click(function () {
        $("#logoutmdl").modal("show");
    });

    $('#perLevelData').select2({
        theme: 'bootstrap4'
    });

    $('#perLevel').select2({
        theme: 'bootstrap4'
    });

    window.addEventListener('resize', function (event) {
        $('#perLevelData').select2({
            theme: 'bootstrap4'
        });

        $('#perLevel').select2({
            theme: 'bootstrap4'
        });

    }, true);

    $.ajax({
        type: "POST",
        url: site_url + "perusahaan/getidperusahaan",
        success: function (data) {
            var data = JSON.parse(data);
            if (data.statusCode == 200) {
                $("#perLevelData").val(data.prs).trigger('change');
            } else {
                $("#perLevelData").val('').trigger('change');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            if (thrownError != "") {
                pesan = "Terjadi kesalahan saat load data perusahaan, hubungi administrator";
                $("#btnTambahLevel").remove()
            } else {
                pesan = "";
            }

            swal("Error", pesan, 'error');
        }
    })

    $("#perLevelData").change(function () {
        let prs = $("#perLevelData").val();
        $("#tbmLevel").LoadingOverlay("show");
        $('#tbmLevel').DataTable().destroy();

        tbLevel();
    });

    $('#btnupdateLevel').click(function () {
        let kode = $('#editLevelKode').val();
        let level = $('#editLevel').val();
        let status = $('#editLevelStatus').val();
        let ket = $('#editLevelKet').val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "Level/edit_Level",
            data: {
                kode: kode,
                level: level,
                status: status,
                ket: ket,
                token: token
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    tbmLevel.draw();
                    $("#editLevelmdl").modal("hide");
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#editLevelKode").val('');
                    $("#editLevel").val('');
                    $("#editLevelKet").val('');
                    $("#editLevelStatus").val('');
                    $("#error1el").html('');
                    $("#error2el").html('');
                    $("#error3el").html('');
                    $("#error4el").html('');
                } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#error1el").html('');
                    $("#error2el").html('');
                    $("#error3el").html('');
                    $("#error4el").html('');
                } else if (data.statusCode == 202) {
                    $("#error1el").html(data.kode);
                    $("#error2el").html(data.level);
                    $("#error3el").html(data.status);
                    $("#error4el").html(data.ket);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");

                if (xhr.status == 404) {
                    pesan = "Level gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Level gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat meng-update data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        })
    });

    $.LoadingOverlay("hide");

    $("#btnBatalLevel").click(function () {
        $("#perLevel").val('').trigger('change');
        $("#kodeLevel").val('');
        $("#Level").val('');
        $("#ketLevel").val('');
        $(".error1").html('');
        $(".error2").html('');
        $(".error3").html('');
        $(".error4").html('');
        $(".error5").html('');
    });

    $('#perLevel').change(function () {
        let auth_per = $("#perLevel").val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "departemen/get_by_authper",
            data: {
                auth_per: auth_per,
                token: token
            },
            success: function (data) {
                var data = JSON.parse(data);
                $("#depLevel").html(data.dprt);
            }
        })
    });
    $("#btnTambahLevel").click(function () {
        var prs = $("#perLevel").val();
        var kode = $("#kodeLevel").val();
        var level = $("#Level").val();
        var ket = $("#ketLevel").val();
        var token = $("#token").val();

        $.ajax({
            type: "POST",
            url: site_url + "Level/input_Level",
            data: {
                prs: prs,
                kode: kode.toUppercase(),
                level: level.toUppercase(),
                ket: ket,
                token: token,
            },
            timeout: 20000,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    $("#kodeLevel").val('');
                    $("#Level").val('');
                    $("#ketLevel").val('');
                    $(".error1").html('');
                    $(".error2").html('');
                    $(".error3").html('');
                    $(".error4").html('');
                } else if (data.statusCode == 201) {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                } else if (data.statusCode == 202) {
                    $(".error1").html(data.prs);
                    $(".error2").html(data.kode);
                    $(".error3").html(data.level);
                    $(".error4").html(data.ket);
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");

                if (xhr.status == 404) {
                    pesan = "Level gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Level gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat membuat data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        })
    });

    $(document).on('click', '.hpslevel', function () {
        let authlevel = $(this).attr('id');
        let namaLevel = $(this).attr('value');
        var token = $("#token").val();

        if (authlevel == "") {
            swal("Error", "Level tidak ditemukan", "error");
        } else {
            swal({
                title: "Hapus",
                text: "Yakin Level " + namaLevel + " akan dihapus?",
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
                        url: site_url + "Level/hapus_Level",
                        data: {
                            authlevel: authlevel,
                            token: token,
                        },
                        timeout: 20000,
                        success: function (data, textStatus, xhr) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                tbmLevel.draw();
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            } else {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            }

                            $.LoadingOverlay("hide");
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");

                            if (xhr.status == 404) {
                                pesan = "Level gagal diupdate, Link data tidak ditemukan";
                            } else if (xhr.status == 0) {
                                pesan = "Level gagal diupdate, Waktu koneksi habis";
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

    $(document).on('click', '.dtllevel', function () {
        let authlevel = $(this).attr('id');
        let namalevel = $(this).attr('value');
        var token = $("#token").val();

        if (authlevel == "") {
            swal("Error", "Level tidak ditemukan", "error");
        } else {
            $.ajax({
                type: "post",
                url: site_url + "Level/detail_Level",
                data: {
                    authlevel: authlevel,
                    token: token,
                },
                timeout: 15000,
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#detailLevelPerusahaan").val(data.nama_perusahaan);
                        $("#detailLevelDepart").val(data.depart);
                        $("#detailLevelKode").val(data.kode);
                        $("#detailLevel").val(data.level);
                        $("#detailLevelStatus").val(data.status);
                        $("#detailLevelKet").val(data.ket);
                        $("#detailLevelBuat").val(data.pembuat);
                        $("#detailLevelTglBuat").val(data.tgl_buat);
                        $("#detailLevelmdl").modal("show");
                    } else {
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (xhr.status == 404) {
                        pesan = "Level gagal diupdate, Link data tidak ditemukan";
                    } else if (xhr.status == 0) {
                        pesan = "Level gagal diupdate, Waktu koneksi habis";
                    } else {
                        pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                    }

                    swal("Error", pesan, 'error');
                }
            });
        }
    });

    $(document).on('click', '.edttlevel', function () {
        let authlevel = $(this).attr('id');
        var token = $("#token").val();

        if (authlevel == "") {
            swal("Error", "Level tidak ditemukan", "error");
        } else {
            $.ajax({
                type: "post",
                url: site_url + "Level/detail_Level",
                data: {
                    authlevel: authlevel,
                    token: token,
                },
                timeout: 15000,
                success: function (data) {
                    var dataLevel = JSON.parse(data);
                    if (dataLevel.statusCode == 200) {
                        $("#editLevelKode").val(dataLevel.kode);
                        $("#editLevel").val(dataLevel.level);
                        $("#editLevelStatus").val(dataLevel.status);
                        $("#editLevelKet").val(dataLevel.ket);
                        $("#editLevelmdl").modal("show");
                        $("#error1el").html('');
                        $("#error2el").html('');
                        $("#error3el").html('');
                        $("#error4el").html('');
                    } else {
                        swal(dataLevel.kode_pesan, dataLevel.pesan, dataLevel.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (xhr.status == 404) {
                        pesan = "Level gagal diupdate, Link data tidak ditemukan";
                    } else if (xhr.status == 0) {
                        pesan = "Level gagal diupdate, Waktu koneksi habis";
                    } else {
                        pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                    }

                    swal("Error", pesan, 'error');
                }
            });
        }
    });

    $("#btnrefreshLevel").click(function () {
        $('#tbmLevel').LoadingOverlay("show");
        tbmLevel.draw()
        $('#tbmLevel').LoadingOverlay("hide");
    });

    function tbLevel() {
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
                    tbmLevel = $('#tbmLevel').DataTable({
                        "processing": true,
                        "responsive": true,
                        "serverSide": true,
                        "ordering": true,
                        "order": [
                            [1, 'asc'],
                        ],
                        "ajax": {
                            "url": site_url + "Level/ajax_list?auth_per=" + $("#perLevelData").val() + "&authtoken=" + $("#token").val(),
                            "type": "POST",
                            "error": function (xhr, error, code) {
                                if (code != "") {
                                    pesan = "terjadi kesalahan saat melakukan load data Level, hubungi administrator";
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
                            name: 'id_Level',
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                            "className": "text-center align-middle",
                            "width": "1%"
                        },
                        {
                            "data": 'kd_level',
                            "className": "text-nowrap align-middle",
                            "width": "10%"
                        },
                        {
                            "data": 'level',
                            "className": "text-nowrap align-middle",
                            "width": "70%"
                        },
                        {
                            "data": 'stat_level',
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
                            "width": "6%"
                        },
                        {
                            "data": 'proses',
                            "className": "text-center text-nowrap align-middle",
                            "width": "1%"
                        }
                        ]
                    });

                    $("#tbmLevel").LoadingOverlay("hide");
                } else {
                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                if (xhr.status == 404) {
                    pesan = "Departemen gagal diupdate, Link data tidak ditemukan";
                } else if (xhr.status == 0) {
                    pesan = "Departemen gagal diupdate, Waktu koneksi habis";
                } else {
                    pesan = "Terjadi kesalahan saat menampilkan data, hubungi administrator";
                }

                swal("Error", pesan, 'error');
            }
        });
    }

});