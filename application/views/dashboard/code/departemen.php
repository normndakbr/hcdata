<script>
    //========================================== depart ========================================================
    $(document).ready(function() {

        $("#logout").click(function() {
            $("#logoutmdl").modal("show");
        });

        $('#btnupdatedepart').click(function() {
            let kode = $('#editDepartKode').val();
            let depart = $('#editDepart').val();
            let status = $('#editDepartStatus').val();
            let ket = $('#editDepartKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('departemen/edit_depart'); ?>",
                data: {
                    kode: kode,
                    depart: depart,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmdepart.draw();
                        $("#editdepartmdl").modal("hide");
                        $(".err_psn_depart").removeClass('d-none');
                        $(".err_psn_depart").removeClass('alert-danger');
                        $(".err_psn_depart").addClass('alert-info');
                        $(".err_psn_depart").html(data.pesan);
                        $("#editDepartKode").val('');
                        $("#editDepart").val('');
                        $("#editDepartKet").val('');
                        $("#editDepartStatus").val('');
                        $("#error1ed").html('');
                        $("#error2ed").html('');
                        $("#error3ed").html('');
                        $(".err_psn_depart").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_depart").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_dprt").removeClass('d-none');
                        $(".err_psn_edit_dprt").removeClass('alert-info');
                        $(".err_psn_edit_dprt").addClass('alert-danger');
                        $(".err_psn_edit_dprt").html(data.pesan);
                        $(".err_psn_edit_dprt").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_dprt").slideUp(500);
                        });
                    } else if (data.statusCode == 202) {
                        $("#error1ed").html(data.kode);
                        $("#error2ed").html(data.depart);
                        $("#error3ed").html(data.status);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_depart").removeClass("alert-primary");
                    $(".err_psn_depart").addClass("alert-danger");
                    $(".err_psn_depart").css("display", "block");
                    if (xhr.status == 404) {
                        $(".err_psn_depart").html("Departemen gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_depart").html("Departemen gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_depart").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }
                    $("#editdepartmdl").modal("hide");
                    $(".err_psn_depart ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_depart ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        $("#btnBatalDepart").click(function() {
            $("#perDepart").val('').trigger('change');
            $("#kodeDepart").val('');
            $("#Depart").val('');
            $("#ketDepart").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
        });

        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url("perusahaan/get_all") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#perDepart").html(data.prs);
                    $('#perDepart').select2({
                        theme: 'bootstrap4'
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                        $("#btnTambahDepart").attr("disabled", true);
                    }
                }
            })

            $("#btnTambahDepart").click(function() {
                var prs = $("#perDepart").val();
                var kode = $("#kodeDepart").val();
                var depart = $("#Depart").val();
                var ket = $("#ketDepart").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("departemen/input_depart") ?>",
                    data: {
                        prs: prs,
                        kode: kode,
                        depart: depart,
                        ket: ket
                    },
                    timeout: 20000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $(".err_psn_depart").removeClass('d-none');
                            $(".err_psn_depart").removeClass('alert-danger');
                            $(".err_psn_depart").addClass('alert-info');
                            $(".err_psn_depart").html(data.pesan);
                            $("#perDepart").val('').trigger('change');
                            $("#kodeDepart").val('');
                            $("#Depart").val('');
                            $("#ketDepart").val('');
                            $(".error1").html('');
                            $(".error2").html('');
                            $(".error3").html('');
                        } else if (data.statusCode == 201) {
                            $(".err_psn_depart").removeClass('d-none');
                            $(".err_psn_depart").removeClass('alert-info');
                            $(".err_psn_depart").addClass('alert-danger');
                            $(".err_psn_depart").html(data.pesan);
                        } else if (data.statusCode == 202) {
                            $(".error1").html(data.prs);
                            $(".error2").html(data.kode);
                            $(".error3").html(data.depart);
                        }

                        $(".err_psn_depart").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_depart").slideUp(500);
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_depart").removeClass("alert-primary");
                        $(".err_psn_depart").addClass("alert-danger");
                        $(".err_psn_depart").css("display", "block");
                        if (xhr.status == 404) {
                            $(".err_psn_depart").html("Departemen gagal disimpan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_depart").html("Departemen gagal disimpan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_depart").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                        }

                        $(".err_psn_depart ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_depart ").slideUp(500);
                        });
                    }
                })
            });

            $(document).on('click', '.hpsdepart', function() {
                let authdepart = $(this).attr('id');
                let namadepart = $(this).attr('value');

                if (authdepart == "") {
                    swal("Error", "Departemen tidak ditemukan", "error");
                } else {
                    swal({
                        title: "Hapus",
                        text: "Yakin departemen " + namadepart + " akan dihapus?",
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
                                url: "<?= base_url('departemen/hapus_depart'); ?>",
                                data: {
                                    authdepart: authdepart
                                },
                                timeout: 20000,
                                success: function(data, textStatus, xhr) {
                                    var data = JSON.parse(data);
                                    if (data.statusCode == 200) {
                                        tbmdepart.draw();
                                        $(".err_psn_depart").removeClass("alert-danger");
                                        $(".err_psn_depart").addClass("alert-primary");
                                        $(".err_psn_depart").css("display", "block");
                                        $(".err_psn_depart").html(data.pesan);
                                    } else {
                                        $(".err_psn_depart").removeClass("alert-primary");
                                        $(".err_psn_depart").addClass("alert-danger");
                                        $(".err_psn_depart").css("display", "block");
                                        $(".err_psn_depart").html(data.pesan);
                                    }

                                    $.LoadingOverlay("hide");
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    $.LoadingOverlay("hide");
                                    $(".err_psn_depart").removeClass("alert-primary");
                                    $(".err_psn_depart").addClass("alert-danger");
                                    $(".err_psn_depart").css("display", "block");
                                    if (xhr.status == 404) {
                                        $(".err_psn_depart").html("Departemen gagal dihapus, , Link data tidak ditemukan");
                                    } else if (xhr.status == 0) {
                                        $(".err_psn_depart").html("Departemen gagal dihapus, Waktu koneksi habis");
                                    } else {
                                        $(".err_psn_depart").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                    }
                                }
                            });

                            $(".err_psn_depart").fadeTo(4000, 500).slideUp(500, function() {
                                $(".err_psn_depart").slideUp(500);
                            });
                        } else if (result.dismiss == 'cancel') {
                            swal('Batal', 'Departemen ' + namadepart + ' batal dihapus', 'error');
                            return false;
                        }
                    });
                }
            });

            $(document).on('click', '.dtldepart', function() {
                let authdepart = $(this).attr('id');
                let namadepart = $(this).attr('value');

                if (authdepart == "") {
                    swal("Error", "Departemen tidak ditemukan", "error");
                } else {

                    $.ajax({
                        type: "post",
                        url: "<?= base_url('departemen/detail_depart'); ?>",
                        data: {
                            authdepart: authdepart
                        },
                        timeout: 15000,
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#detailDepartPerusahaan").val(data.nama_perusahaan);
                                $("#detailDepartKode").val(data.kode);
                                $("#detailDepart").val(data.depart);
                                $("#detailDepartStatus").val(data.status);
                                $("#detailDepartKet").val(data.ket);
                                $("#detailDepartBuat").val(data.pembuat);
                                $("#detailDepartTglBuat").val(data.tgl_buat);
                                $("#detaildepartmdl").modal("show");
                            } else {
                                $(".err_psn_depart").css("display", "block");
                                $(".err_psn_depart").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_psn_depart").removeClass("alert-primary");
                            $(".err_psn_depart").addClass("alert-danger");
                            $(".err_psn_depart").css("display", "block");
                            if (xhr.status == 404) {
                                $(".err_psn_depart").html("Departemen gagal ditampilkan, Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_psn_depart").html("Departemen gagal ditampilkan, Waktu koneksi habis");
                            } else {
                                $(".err_psn_depart").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                            }
                            $(".err_psn_depart ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_depart ").slideUp(500);
                            });
                        }
                    });
                }
            });

            $(document).on('click', '.edttdepart', function() {
                let authdepart = $(this).attr('id');
                let namadepart = $(this).attr('value');

                if (authdepart == "") {
                    swal("Error", "Departemen tidak ditemukan", "error");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('departemen/detail_depart'); ?>",
                        data: {
                            authdepart: authdepart
                        },
                        timeout: 15000,
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#editDepartKode").val(data.kode);
                                $("#editDepart").val(data.depart);
                                $("#editDepartStatus").val(data.status);
                                $("#editDepartKet").val(data.ket);
                                $("#editdepartmdl").modal("show");
                                $("#error1ed").html('');
                                $("#error2ed").html('');
                                $("#error3ed").html('');
                            } else {
                                $(".err_psn_depart").css("display", "block");
                                $(".err_psn_depart").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_psn_depart").removeClass("alert-primary");
                            $(".err_psn_depart").addClass("alert-danger");
                            $(".err_psn_depart").css("display", "block");
                            if (xhr.status == 404) {
                                $(".err_psn_depart").html("Departemen gagal ditampilkan, Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_psn_depart").html("Departemen gagal ditampilkan, Waktu koneksi habis");
                            } else {
                                $(".err_psn_depart").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                            }

                            $(".err_psn_depart ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_depart ").slideUp(500);
                            });
                        }
                    });
                }
            });

            $("#btnrefreshdepart").click(function() {
                $('#tbmdepart').LoadingOverlay("show");
                tbmdepart.draw()
                $('#tbmdepart').LoadingOverlay("hide");
            });

            tbmdepart = $('#tbmdepart').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [1, 'desc']
                ],
                "ajax": {
                    "url": "<?= base_url('departemen/ajax_list'); ?>",
                    "type": "POST",
                    "error": function(xhr, error, code) {
                        if (code != "") {
                            $(".err_psn_depart").removeClass("d-none");
                            $(".err_psn_depart").css("display", "block");
                            $(".err_psn_depart").html("terjadi kesalahan saat melakukan load data departemen, hubungi administrator");
                            $("#addbtn").addClass("disabled");
                            $(".err_psn_depart ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_depart ").slideUp(500);
                            });
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
                        name: 'id_kary',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center",
                        "width": "1%"
                    },
                    {
                        "data": 'kd_depart',
                        "width": "10%"
                    },
                    {
                        "data": 'depart',
                        "className": "text-nowrap",
                        "width": "67%"
                    },
                    {
                        "data": 'stat_depart',
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