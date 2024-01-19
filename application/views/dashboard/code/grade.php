<script>
    //========================================== Grade ========================================================
    $(document).ready(function() {
        $('#btnupdateGrade').click(function() {
            let grade = $('#editGrade').val();
            let level = $('#editGradeLevel').val();
            let status = $('#editGradeStatus').val();
            let ket = $('#editGradeKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('grade/edit_grade'); ?>",
                data: {
                    grade: grade,
                    level: level,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmGrade.draw();
                        $("#editGrademdl").modal("hide");
                        $(".err_psn_grade").removeClass('d-none');
                        $(".err_psn_grade").removeClass('alert-danger');
                        $(".err_psn_grade").addClass('alert-info');
                        $(".err_psn_grade").html(data.pesan);
                        $("#editGrade").val('');
                        $("#editGradeKet").val('');
                        $("#editGradeStatus").val('');
                        $("#error1eg").html('');
                        $("#error2eg").html('');
                        $("#error3eg").html('');
                        $("#error4eg").html('');
                        $("#error5eg").html('');
                        $(".err_psn_grade").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_grade").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_grade").removeClass('d-none');
                        $(".err_psn_edit_grade").removeClass('alert-info');
                        $(".err_psn_edit_grade").addClass('alert-danger');
                        $(".err_psn_edit_grade").html(data.pesan);
                        $(".err_psn_edit_grade").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_grade").slideUp(500);
                        });
                        $("#error2eg").html('');
                        $("#error3eg").html('');
                        $("#error4eg").html('');
                        $("#error5eg").html('');
                    } else if (data.statusCode == 202) {
                        $("#error2eg").html(data.grade);
                        $("#error3eg").html(data.level);
                        $("#error4eg").html(data.status);
                        $("#error5eg").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    alert(xhr.status);
                    $(".err_psn_grade").removeClass("alert-primary");
                    $(".err_psn_grade").addClass("alert-danger");
                    $(".err_psn_grade").css("display", "block");
                    if (xhr.status == 404) {
                        $(".err_psn_grade").html("Grade gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_grade").html("Grade gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_grade").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }
                    $("#editGrademdl").modal("hide");
                    $(".err_psn_grade ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_grade ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        $("#btnBatalGrade").click(function() {
            $("#perGrade").val('').trigger('change');
            $("#lvlGrade").val('').trigger('change');
            $("#kodSGrade").val('');
            $("#Grade").val('');
            $("#ketGrade").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
            $(".error4").html('');
            $(".error5").html('');
        });

        $(document).ready(function() {
            $('#lvlGrade').select2({
                theme: 'bootstrap4'
            });
            $('#perGrade').select2({
                theme: 'bootstrap4'
            });
            $('#editGradeLevel').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#editGrademdl')
            });
            $.ajax({
                type: "POST",
                url: "<?= base_url("perusahaan/get_all") ?>",
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#perGrade").html(data.prs);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_grade").removeClass('d-none');
                    $(".err_psn_grade").removeClass('alert-info');
                    $(".err_psn_grade").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".err_psn_grade").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                        $("#btnTambahGrade").attr("disabled", true);
                    }
                }
            })

            $('#perGrade').change(function() {
                let auth_per = $("#perGrade").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("level/get_by_authper") ?>",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#lvlGrade").html(data.lvl);
                    }
                })
            });
            $("#btnTambahGrade").click(function() {
                let prs = $("#perGrade").val();
                let level = $("#lvlGrade").val();
                let grade = $("#Grade").val();
                let ket = $("#ketGrade").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("grade/input_grade") ?>",
                    data: {
                        prs: prs,
                        level: level,
                        grade: grade,
                        ket: ket
                    },
                    timeout: 20000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $(".err_psn_grade").removeClass('d-none');
                            $(".err_psn_grade").removeClass('alert-danger');
                            $(".err_psn_grade").addClass('alert-info');
                            $(".err_psn_grade").html(data.pesan);
                            $("#perGrade").val('').trigger('change');
                            $("#depGrade").val('').trigger('change');
                            $("#Grade").val('');
                            $("#ketGrade").val('');
                            $(".error1").html('');
                            $(".error2").html('');
                            $(".error4").html('');
                            $(".error5").html('');
                        } else if (data.statusCode == 201) {
                            $(".err_psn_grade").removeClass('d-none');
                            $(".err_psn_grade").removeClass('alert-info');
                            $(".err_psn_grade").addClass('alert-danger');
                            $(".err_psn_grade").html(data.pesan);
                        } else if (data.statusCode == 202) {
                            $(".error1").html(data.prs);
                            $(".error2").html(data.level);
                            $(".error4").html(data.grade);
                            $(".error5").html(data.ket);
                        }

                        $(".err_psn_grade").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_grade").slideUp(500);
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_grade").removeClass("alert-primary");
                        $(".err_psn_grade").addClass("alert-danger");
                        $(".err_psn_grade").css("display", "block");
                        if (xhr.status == 404) {
                            $(".err_psn_grade").html("Grade gagal disimpan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_grade").html("Grade gagal disimpan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_grade").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                        }

                        $(".err_psn_grade ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_grade ").slideUp(500);
                        });
                    }
                })
            });

            $(document).on('click', '.hpsgrade', function() {
                let authgrade = $(this).attr('id');
                let namaGrade = $(this).attr('value');

                if (authgrade == "") {
                    swal("Error", "Grade tidak ditemukan", "error");
                } else {
                    swal({
                        title: "Hapus",
                        text: "Yakin Grade " + namaGrade + " akan dihapus?",
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
                                url: "<?= base_url('Grade/hapus_Grade'); ?>",
                                data: {
                                    authgrade: authgrade
                                },
                                timeout: 20000,
                                success: function(data, textStatus, xhr) {
                                    var data = JSON.parse(data);
                                    if (data.statusCode == 200) {
                                        tbmGrade.draw();
                                        $(".err_psn_grade").removeClass("alert-danger");
                                        $(".err_psn_grade").addClass("alert-primary");
                                        $(".err_psn_grade").css("display", "block");
                                        $(".err_psn_grade").html(data.pesan);
                                    } else {
                                        $(".err_psn_grade").removeClass("alert-primary");
                                        $(".err_psn_grade").addClass("alert-danger");
                                        $(".err_psn_grade").css("display", "block");
                                        $(".err_psn_grade").html(data.pesan);
                                    }

                                    $.LoadingOverlay("hide");
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    $.LoadingOverlay("hide");
                                    $(".err_psn_grade").removeClass("alert-primary");
                                    $(".err_psn_grade").addClass("alert-danger");
                                    $(".err_psn_grade").css("display", "block");
                                    if (xhr.status == 404) {
                                        $(".err_psn_grade").html("Grade gagal dihapus, , Link data tidak ditemukan");
                                    } else if (xhr.status == 0) {
                                        $(".err_psn_grade").html("Grade gagal dihapus, Waktu koneksi habis");
                                    } else {
                                        $(".err_psn_grade").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                    }
                                }
                            });

                            $(".err_psn_grade").fadeTo(4000, 500).slideUp(500, function() {
                                $(".err_psn_grade").slideUp(500);
                            });
                        } else if (result.dismiss == 'cancel') {
                            swal('Batal', 'Grade ' + namaGrade + ' batal dihapus', 'error');
                            return false;
                        }
                    });
                }
            });

            $(document).on('click', '.dtlgrade', function() {
                let authgrade = $(this).attr('id');
                let namaGrade = $(this).attr('value');

                if (authgrade == "") {
                    swal("Error", "Grade tidak ditemukan", "error");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('Grade/detail_Grade'); ?>",
                        data: {
                            authgrade: authgrade
                        },
                        timeout: 15000,
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#detailGradePerusahaan").val(data.nama_perusahaan);
                                $("#detailGradeLevel").val(data.level);
                                $("#detailGrade").val(data.grade);
                                $("#detailGradeStatus").val(data.status);
                                $("#detailGradeKet").val(data.ket);
                                $("#detailGradeBuat").val(data.pembuat);
                                $("#detailGradeTglBuat").val(data.tgl_buat);
                                $("#detailGrademdl").modal("show");
                            } else {
                                $(".err_psn_grade").css("display", "block");
                                $(".err_psn_grade").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_psn_grade").removeClass("alert-primary");
                            $(".err_psn_grade").addClass("alert-danger");
                            $(".err_psn_grade").css("display", "block");
                            if (xhr.status == 404) {
                                $(".err_psn_grade").html("Grade gagal ditampilkan, Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_psn_grade").html("Grade gagal ditampilkan, Waktu koneksi habis");
                            } else {
                                $(".err_psn_grade").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                            }
                            $(".err_psn_grade ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_grade ").slideUp(500);
                            });
                        }
                    });
                }
            });

            $(document).on('click', '.edttgrade', function() {
                let authgrade = $(this).attr('id');
                let namaGrade = $(this).attr('value');

                if (authgrade == "") {
                    swal("Error", "Grade tidak ditemukan", "error");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('grade/detail_grade'); ?>",
                        data: {
                            authgrade: authgrade
                        },
                        timeout: 15000,
                        success: function(data) {
                            var dataGrade = JSON.parse(data);
                            if (dataGrade.statusCode == 200) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= base_url('level/get_by_idper'); ?>",
                                    success: function(data) {

                                        var data = JSON.parse(data);
                                        if (data.statusCode == 200) {
                                            $("#editGradeLevel").html(data.level);
                                            $.LoadingOverlay("hide");
                                        } else {
                                            $("#editGradeLevel").html(data.level);
                                            $.LoadingOverlay("hide");
                                            $(".err_psn_edit_dprt").removeClass("alert-primary");
                                            $(".err_psn_edit_dprt").addClass("alert-danger");
                                            $(".err_psn_edit_dprt").css("display", "block");
                                            $(".err_psn_edit_dprt").html(data.pesan);
                                        }
                                        $("#editGrade").val(dataGrade.grade);
                                        $("#editGradeLevel").val(dataGrade.auth_level);
                                        $("#editGradeStatus").val(dataGrade.status);
                                        $("#editGradeKet").val(dataGrade.ket);
                                        $("#editGrademdl").modal("show");
                                        $("#error1eg").html('');
                                        $("#error2eg").html('');
                                        $("#error3eg").html('');
                                        $("#error4eg").html('');
                                        $("#error5eg").html('');
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
                                $(".err_psn_grade").css("display", "block");
                                $(".err_psn_grade").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_psn_grade").removeClass("alert-primary");
                            $(".err_psn_grade").addClass("alert-danger");
                            $(".err_psn_grade").css("display", "block");
                            if (xhr.status == 404) {
                                $(".err_psn_grade").html("Grade gagal ditampilkan, Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_psn_grade").html("Grade gagal ditampilkan, Waktu koneksi habis");
                            } else {
                                $(".err_psn_grade").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                            }

                            $(".err_psn_grade ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_grade ").slideUp(500);
                            });
                        }
                    });
                }
            });

            $("#btnrefreshGrade").click(function() {
                $('#tbmGrade').LoadingOverlay("show");
                tbmGrade.draw()
                $('#tbmGrade').LoadingOverlay("hide");
            });

            tbmGrade = $('#tbmGrade').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [1, 'asc'],
                ],
                "ajax": {
                    "url": "<?= base_url('grade/ajax_list'); ?>",
                    "type": "POST",
                    "error": function(xhr, error, code) {
                        if (code != "") {
                            $(".err_psn_grade").removeClass("d-none");
                            $(".err_psn_grade").css("display", "block");
                            $(".err_psn_grade").html("Terjadi kesalahan saat melakukan load data grade, hubungi administrator");
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
                        name: 'id_grade',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center",
                        "width": "1%"
                    },
                    {
                        "data": 'grade',
                        "className": "text-center text-nowrap",
                        "width": "1%"
                    },
                    {
                        "data": 'level',
                        "className": "text-nowrap",
                        "width": "40%"
                    },
                    {
                        "data": 'stat_grade',
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