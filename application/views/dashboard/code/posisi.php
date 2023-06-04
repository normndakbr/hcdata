<script>
    //========================================== Posisi ========================================================
    $(document).ready(function() {
        $('#btnupdatePosisi').click(function() {
            let posisi = $('#editPosisi').val();
            let depart = $('#editPosisiDepart').val();
            let status = $('#editPosisiStatus').val();
            let ket = $('#editPosisiKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('posisi/edit_posisi'); ?>",
                data: {
                    posisi: posisi,
                    depart: depart,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmPosisi.draw();
                        $("#editPosisimdl").modal("hide");
                        $(".err_psn_posisi").removeClass('d-none');
                        $(".err_psn_posisi").removeClass('alert-danger');
                        $(".err_psn_posisi").addClass('alert-info');
                        $(".err_psn_posisi").html(data.pesan);
                        $("#editPosisi").val('');
                        $("#editPosisiKet").val('');
                        $("#editPosisiStatus").val('');
                        $("#error2ep").html('');
                        $("#error3ep").html('');
                        $("#error4ep").html('');
                        $("#error5ep").html('');
                        $(".err_psn_posisi").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_posisi").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_posisi").removeClass('d-none');
                        $(".err_psn_edit_posisi").removeClass('alert-info');
                        $(".err_psn_edit_posisi").addClass('alert-danger');
                        $(".err_psn_edit_posisi").html(data.pesan);
                        $(".err_psn_edit_posisi").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_posisi").slideUp(500);
                        });
                    } else if (data.statusCode == 202) {
                        $("#error2ep").html(data.posisi);
                        $("#error3ep").html(data.depart);
                        $("#error4ep").html(data.status);
                        $("#error5ep").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_posisi").removeClass("alert-primary");
                    $(".err_psn_posisi").addClass("alert-danger");
                    $(".err_psn_posisi").css("display", "block");
                    if (xhr.status == 404) {
                        $(".err_psn_posisi").html("Posisi gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_posisi").html("Posisi gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_posisi").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }
                    $("#editPosisimdl").modal("hide");
                    $(".err_psn_posisi ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_posisi ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        $("#btnBatalPosisi").click(function() {
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

        $(document).ready(function() {
            $('#depPosisi').select2({
                theme: 'bootstrap4'
            });
            $('#perPosisi').select2({
                theme: 'bootstrap4'
            });
            $('#editPosisiDepart').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#editPosisimdl')
            });
            $.ajax({
                type: "POST",
                url: "<?= base_url("perusahaan/get_all") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#perPosisi").html(data.prs);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_posisi").removeClass('d-none');
                    $(".err_psn_posisi").removeClass('alert-info');
                    $(".err_psn_posisi").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".err_psn_posisi").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                        $("#btnTambahPosisi").attr("disabled", true);
                    }
                }
            })

            $('#perPosisi').change(function() {
                let auth_per = $("#perPosisi").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("departemen/get_by_authper") ?>",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#depPosisi").html(data.dprt);
                    }
                })
            });
            $("#btnTambahPosisi").click(function() {
                var prs = $("#perPosisi").val();
                var depart = $("#depPosisi").val();
                var posisi = $("#Posisi").val();
                var ket = $("#ketPosisi").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("Posisi/input_Posisi") ?>",
                    data: {
                        prs: prs,
                        posisi: posisi,
                        depart: depart,
                        ket: ket
                    },
                    timeout: 20000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $(".err_psn_posisi").removeClass('d-none');
                            $(".err_psn_posisi").removeClass('alert-danger');
                            $(".err_psn_posisi").addClass('alert-info');
                            $(".err_psn_posisi").html(data.pesan);
                            $("#perPosisi").val('').trigger('change');
                            $("#depPosisi").val('').trigger('change');
                            $("#Posisi").val('');
                            $("#ketPosisi").val('');
                            $(".error1").html('');
                            $(".error2").html('');
                            $(".error4").html('');
                            $(".error5").html('');
                        } else if (data.statusCode == 201) {
                            $(".err_psn_posisi").removeClass('d-none');
                            $(".err_psn_posisi").removeClass('alert-info');
                            $(".err_psn_posisi").addClass('alert-danger');
                            $(".err_psn_posisi").html(data.pesan);
                        } else if (data.statusCode == 202) {
                            $(".error1").html(data.prs);
                            $(".error2").html(data.depart);
                            $(".error4").html(data.posisi);
                            $(".error5").html(data.ket);
                        }

                        $(".err_psn_posisi").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_posisi").slideUp(500);
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_posisi").removeClass("alert-primary");
                        $(".err_psn_posisi").addClass("alert-danger");
                        $(".err_psn_posisi").css("display", "block");
                        if (xhr.status == 404) {
                            $(".err_psn_posisi").html("Posisi gagal disimpan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_posisi").html("Posisi gagal disimpan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_posisi").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                        }

                        $(".err_psn_posisi ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_posisi ").slideUp(500);
                        });
                    }
                })
            });

            $(document).on('click', '.hpsposisi', function() {
                let authposisi = $(this).attr('id');
                let namaPosisi = $(this).attr('value');

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
                    }).then(function(result) {
                        if (result.value) {
                            $.LoadingOverlay("show");
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url('Posisi/hapus_Posisi'); ?>",
                                data: {
                                    authposisi: authposisi
                                },
                                timeout: 20000,
                                success: function(data, textStatus, xhr) {
                                    var data = JSON.parse(data);
                                    if (data.statusCode == 200) {
                                        tbmPosisi.draw();
                                        $(".err_psn_posisi").removeClass("d-none");
                                        $(".err_psn_posisi").removeClass("alert-danger");
                                        $(".err_psn_posisi").addClass("alert-primary");
                                        $(".err_psn_posisi").html(data.pesan);
                                    } else {
                                        $(".err_psn_posisi").removeClass("d-none");
                                        $(".err_psn_posisi").removeClass("alert-primary");
                                        $(".err_psn_posisi").addClass("alert-danger");
                                        $(".err_psn_posisi").html(data.pesan);
                                    }

                                    $.LoadingOverlay("hide");
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    $.LoadingOverlay("hide");
                                    $(".err_psn_posisi").removeClass("d-none");
                                    $(".err_psn_posisi").removeClass("alert-primary");
                                    $(".err_psn_posisi").addClass("alert-danger");

                                    if (xhr.status == 404) {
                                        $(".err_psn_posisi").html("Posisi gagal dihapus, , Link data tidak ditemukan");
                                    } else if (xhr.status == 0) {
                                        $(".err_psn_posisi").html("Posisi gagal dihapus, Waktu koneksi habis");
                                    } else {
                                        $(".err_psn_posisi").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                    }
                                }
                            });

                            $(".err_psn_posisi").fadeTo(4000, 500).slideUp(500, function() {
                                $(".err_psn_posisi").slideUp(500);
                            });
                        } else if (result.dismiss == 'cancel') {
                            swal('Batal', 'Posisi ' + namaPosisi + ' batal dihapus', 'error');
                            return false;
                        }
                    });
                }
            });

            $(document).on('click', '.dtlposisi', function() {
                let authposisi = $(this).attr('id');
                let namaposisi = $(this).attr('value');

                if (authposisi == "") {
                    swal("Error", "Posisi tidak ditemukan", "error");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('posisi/detail_posisi'); ?>",
                        data: {
                            authposisi: authposisi
                        },
                        timeout: 15000,
                        success: function(data) {
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
                                $(".err_psn_posisi").css("display", "block");
                                $(".err_psn_posisi").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_psn_posisi").removeClass("alert-primary");
                            $(".err_psn_posisi").addClass("alert-danger");
                            $(".err_psn_posisi").css("display", "block");
                            if (xhr.status == 404) {
                                $(".err_psn_posisi").html("Posisi gagal ditampilkan, Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_psn_posisi").html("Posisi gagal ditampilkan, Waktu koneksi habis");
                            } else {
                                $(".err_psn_posisi").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                            }
                            $(".err_psn_posisi ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_posisi ").slideUp(500);
                            });
                        }
                    });
                }
            });

            $(document).on('click', '.edttposisi', function() {
                let authposisi = $(this).attr('id');
                let namaposisi = $(this).attr('value');

                if (authposisi == "") {
                    swal("Error", "Posisi tidak ditemukan", "error");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('posisi/detail_posisi'); ?>",
                        data: {
                            authposisi: authposisi
                        },
                        timeout: 15000,
                        success: function(data) {
                            var dataPosisi = JSON.parse(data);
                            if (dataPosisi.statusCode == 200) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= base_url('Posisi/get_by_idper'); ?>",
                                    success: function(data) {
                                        var data = JSON.parse(data);
                                        if (data.statusCode == 200) {
                                            $("#editPosisiDepart").html(data.depart);
                                            $.LoadingOverlay("hide");
                                        } else {
                                            $("#editPosisiDepart").html(data.depart);
                                            $.LoadingOverlay("hide");
                                            $(".err_psn_edit_dprt").removeClass("alert-primary");
                                            $(".err_psn_edit_dprt").addClass("alert-danger");
                                            $(".err_psn_edit_dprt").css("display", "block");
                                            $(".err_psn_edit_dprt").html(data.pesan);
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
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        $.LoadingOverlay("hide");
                                        $(".err_psn_edit_dprt").removeClass("alert-primary");
                                        $(".err_psn_edit_dprt").addClass("alert-danger");
                                        $(".err_psn_edit_dprt").css("display", "block");
                                        if (xhr.status == 404) {
                                            $(".err_psn_edit_dprt").html("Departemen gagal ditampilkan, Link data tidak ditemukan");
                                        } else if (xhr.status == 0) {
                                            $(".err_psn_edit_dprt").html("Departemen gagal ditampilkan, Waktu koneksi habis");
                                        } else {
                                            $(".err_psn_edit_dprt").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                                        }
                                        $(".err_psn_edit_dprt ").fadeTo(3000, 500).slideUp(500, function() {
                                            $(".err_psn_edit_dprt ").slideUp(500);
                                        });
                                    }
                                });
                            } else {
                                $(".err_psn_posisi").css("display", "block");
                                $(".err_psn_posisi").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_psn_posisi").removeClass("alert-primary");
                            $(".err_psn_posisi").addClass("alert-danger");
                            $(".err_psn_posisi").css("display", "block");
                            if (xhr.status == 404) {
                                $(".err_psn_posisi").html("Posisi gagal ditampilkan, Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_psn_posisi").html("Posisi gagal ditampilkan, Waktu koneksi habis");
                            } else {
                                $(".err_psn_posisi").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                            }

                            $(".err_psn_posisi ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_posisi ").slideUp(500);
                            });
                        }
                    });
                }
            });

            $("#btnrefreshPosisi").click(function() {
                $('#tbmPosisi').LoadingOverlay("show");
                tbmPosisi.draw()
                $('#tbmPosisi').LoadingOverlay("hide");
            });

            tbmPosisi = $('#tbmPosisi').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [2, 'asc'],
                ],
                "ajax": {
                    "url": "<?= base_url('posisi/ajax_list'); ?>",
                    "type": "POST",
                    "error": function(xhr, error, code) {
                        if (code != "") {
                            $(".err_psn_posisi").removeClass("d-none");
                            $(".err_psn_posisi").css("display", "block");
                            $(".err_psn_posisi").html("terjadi kesalahan saat melakukan load data posisi, hubungi administrator");
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
                        name: 'id_posisi',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center",
                        "width": "1%"
                    },
                    {
                        "data": 'posisi',
                        "className": "text-nowrap",
                        "width": "25%"
                    },
                    {
                        "data": 'depart',
                        "className": "text-nowrap",
                        "width": "42%"
                    },
                    {
                        "data": 'stat_posisi',
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