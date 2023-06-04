<script>
    //========================================== section ========================================================
    $(document).ready(function() {
        $('#btnupdateSection').click(function() {
            let kode = $('#editSectionKode').val();
            let section = $('#editSection').val();
            let depart = $('#editSectionDepart').val();
            let status = $('#editSectionStatus').val();
            let ket = $('#editSectionKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('section/edit_section'); ?>",
                data: {
                    kode: kode,
                    section: section,
                    depart: depart,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmsection.draw();
                        $("#editSectionmdl").modal("hide");
                        $(".err_psn_section").removeClass('d-none');
                        $(".err_psn_section").removeClass('alert-danger');
                        $(".err_psn_section").addClass('alert-info');
                        $(".err_psn_section").html(data.pesan);
                        $("#editsectionKode").val('');
                        $("#editsection").val('');
                        $("#editsectionKet").val('');
                        $("#editsectionStatus").val('');
                        $("#error1es").html('');
                        $("#error2es").html('');
                        $("#error3es").html('');
                        $("#error4es").html('');
                        $("#error5es").html('');
                        $(".err_psn_section").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_section").slideUp(500);
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
                        $("#error1es").html(data.kode);
                        $("#error2es").html(data.section);
                        $("#error3es").html(data.depart);
                        $("#error4es").html(data.status);
                        $("#error5es").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_section").removeClass("alert-primary");
                    $(".err_psn_section").addClass("alert-danger");
                    $(".err_psn_section").css("display", "block");
                    if (xhr.status == 404) {
                        $(".err_psn_section").html("section gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_section").html("section gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_section").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }
                    $("#editsectionmdl").modal("hide");
                    $(".err_psn_section ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_section ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        $("#btnBatalSection").click(function() {
            $("#perSection").val('').trigger('change');
            $("#depSection").val('').trigger('change');
            $("#kodSsection").val('');
            $("#Section").val('');
            $("#ketSection").val('');
            $("#error1es").html('');
            $("#error2es").html('');
            $("#error3es").html('');
            $("#error4es").html('');
            $("#error5es").html('');
        });

        $(document).ready(function() {
            $('#depSection').select2({
                theme: 'bootstrap4'
            });
            $('#perSection').select2({
                theme: 'bootstrap4'
            });
            $('#editSectionDepart').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#editSectionmdl')
            });

            $.ajax({
                type: "POST",
                url: "<?= base_url("perusahaan/get_all") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#perSection").html(data.prs);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_section").removeClass('d-none');
                    $(".err_psn_section").removeClass('alert-info');
                    $(".err_psn_section").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".err_psn_section").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                        $("#secadd").attr("disabled", true);
                    }
                }
            })

            $('#perSection').change(function() {
                let auth_per = $("#perSection").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("departemen/get_by_authper") ?>",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#depSection").html(data.dprt);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_section").removeClass('d-none');
                        $(".err_psn_section").removeClass('alert-info');
                        $(".err_psn_section").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".err_psn_section").html("Terjadi kesalahan saat load data departemen, hubungi administrator");
                            $("#secadd").attr("disabled", true);
                        }
                    }
                })
            });
            
            $("#btnTambahSection").click(function() {
                var prs = $("#perSection").val();
                var depart = $("#depSection").val();
                var kode = $("#kodeSection").val();
                var section = $("#Section").val();
                var ket = $("#ketSection").val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url("section/input_section") ?>",
                    data: {
                        prs: prs,
                        kode: kode,
                        section: section,
                        depart: depart,
                        ket: ket
                    },
                    timeout: 20000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $(".err_psn_section").removeClass('d-none');
                            $(".err_psn_section").removeClass('alert-danger');
                            $(".err_psn_section").addClass('alert-info');
                            $(".err_psn_section").html(data.pesan);
                            $("#perSection").val('').trigger('change');
                            $("#depSection").val('').trigger('change');
                            $("#kodesection").val('');
                            $("#section").val('');
                            $("#ketsection").val('');
                            $(".error1").html('');
                            $(".error2").html('');
                            $(".error3").html('');
                            $(".error4").html('');
                            $(".error5").html('');
                        } else if (data.statusCode == 201) {
                            $(".err_psn_section").removeClass('d-none');
                            $(".err_psn_section").removeClass('alert-info');
                            $(".err_psn_section").addClass('alert-danger');
                            $(".err_psn_section").html(data.pesan);
                        } else if (data.statusCode == 202) {
                            $(".error1").html(data.prs);
                            $(".error2").html(data.depart);
                            $(".error3").html(data.kode);
                            $(".error4").html(data.section);
                            $(".error5").html(data.ket);
                        }

                        $(".err_psn_section").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_section").slideUp(500);
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_section").removeClass("alert-primary");
                        $(".err_psn_section").addClass("alert-danger");
                        $(".err_psn_section").css("display", "block");
                        if (xhr.status == 404) {
                            $(".err_psn_section").html("Section gagal disimpan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_section").html("Section gagal disimpan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_section").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                        }

                        $(".err_psn_section ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_section ").slideUp(500);
                        });
                    }
                })
            });

            $(document).on('click', '.hpssection', function() {
                let authsection = $(this).attr('id');
                let namasection = $(this).attr('value');

                if (authsection == "") {
                    swal("Error", "Section tidak ditemukan", "error");
                } else {
                    swal({
                        title: "Hapus",
                        text: "Yakin section " + namasection + " akan dihapus?",
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
                                url: "<?= base_url('section/hapus_section'); ?>",
                                data: {
                                    authsection: authsection
                                },
                                timeout: 20000,
                                success: function(data, textStatus, xhr) {
                                    var data = JSON.parse(data);
                                    if (data.statusCode == 200) {
                                        tbmsection.draw();
                                        $(".err_psn_section").removeClass("alert-danger");
                                        $(".err_psn_section").addClass("alert-primary");
                                        $(".err_psn_section").css("display", "block");
                                        $(".err_psn_section").html(data.pesan);
                                    } else {
                                        $(".err_psn_section").removeClass("alert-primary");
                                        $(".err_psn_section").addClass("alert-danger");
                                        $(".err_psn_section").css("display", "block");
                                        $(".err_psn_section").html(data.pesan);
                                    }

                                    $.LoadingOverlay("hide");
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    $.LoadingOverlay("hide");
                                    $(".err_psn_section").removeClass("alert-primary");
                                    $(".err_psn_section").addClass("alert-danger");
                                    $(".err_psn_section").css("display", "block");
                                    if (xhr.status == 404) {
                                        $(".err_psn_section").html("section gagal dihapus, , Link data tidak ditemukan");
                                    } else if (xhr.status == 0) {
                                        $(".err_psn_section").html("section gagal dihapus, Waktu koneksi habis");
                                    } else {
                                        $(".err_psn_section").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                    }
                                }
                            });

                            $(".err_psn_section").fadeTo(4000, 500).slideUp(500, function() {
                                $(".err_psn_section").slideUp(500);
                            });
                        } else if (result.dismiss == 'cancel') {
                            swal('Batal', 'Section ' + namasection + ' batal dihapus', 'error');
                            return false;
                        }
                    });
                }
            });

            $(document).on('click', '.dtlsection', function() {
                let authsection = $(this).attr('id');
                let namasection = $(this).attr('value');

                if (authsection == "") {
                    swal("Error", "Section tidak ditemukan", "error");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('section/detail_section'); ?>",
                        data: {
                            authsection: authsection
                        },
                        timeout: 15000,
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#detailSectionPerusahaan").val(data.nama_perusahaan);
                                $("#detailSectionDepart").val(data.depart);
                                $("#detailSectionKode").val(data.kode);
                                $("#detailSection").val(data.section);
                                $("#detailSectionStatus").val(data.status);
                                $("#detailSectionKet").val(data.ket);
                                $("#detailSectionBuat").val(data.pembuat);
                                $("#detailSectionTglBuat").val(data.tgl_buat);
                                $("#detailSectionmdl").modal("show");
                            } else {
                                $(".err_psn_section").css("display", "block");
                                $(".err_psn_section").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_psn_section").removeClass("alert-primary");
                            $(".err_psn_section").addClass("alert-danger");
                            $(".err_psn_section").css("display", "block");
                            if (xhr.status == 404) {
                                $(".err_psn_section").html("section gagal ditampilkan, Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_psn_section").html("section gagal ditampilkan, Waktu koneksi habis");
                            } else {
                                $(".err_psn_section").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                            }

                            $(".err_psn_section ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_section ").slideUp(500);
                            });
                        }
                    });
                }
            });

            $(document).on('click', '.edttsection', function() {
                let authsection = $(this).attr('id');
                let namasection = $(this).attr('value');

                if (authsection == "") {
                    swal("Error", "Section tidak ditemukan", "error");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('section/detail_section'); ?>",
                        data: {
                            authsection: authsection
                        },
                        timeout: 15000,
                        success: function(data) {
                            var dataSection = JSON.parse(data);
                            if (dataSection.statusCode == 200) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= base_url('section/get_by_idper'); ?>",
                                    success: function(data) {
                                        var data = JSON.parse(data);
                                        if (data.statusCode == 200) {
                                            $("#editSectionDepart").html(data.depart);
                                            $.LoadingOverlay("hide");
                                        } else {
                                            $("#editSectionDepart").html(data.depart);
                                            $.LoadingOverlay("hide");
                                            $(".err_psn_edit_dprt").removeClass("alert-primary");
                                            $(".err_psn_edit_dprt").addClass("alert-danger");
                                            $(".err_psn_edit_dprt").css("display", "block");
                                            $(".err_psn_edit_dprt").html(data.pesan);
                                        }
                                        $("#editSectionKode").val(dataSection.kode);
                                        $("#editSectionDepart").val(dataSection.auth_depart);
                                        $("#editSection").val(dataSection.section);
                                        $("#editSectionStatus").val(dataSection.status);
                                        $("#editSectionKet").val(dataSection.ket);
                                        $("#editSectionmdl").modal("show");
                                        $("#error1es").html('');
                                        $("#error2es").html('');
                                        $("#error3es").html('');
                                        $("#error4es").html('');
                                        $("#error5es").html('');
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
                                $(".err_psn_section").css("display", "block");
                                $(".err_psn_section").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_psn_section").removeClass("alert-primary");
                            $(".err_psn_section").addClass("alert-danger");
                            $(".err_psn_section").css("display", "block");
                            if (xhr.status == 404) {
                                $(".err_psn_section").html("section gagal ditampilkan, Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_psn_section").html("section gagal ditampilkan, Waktu koneksi habis");
                            } else {
                                $(".err_psn_section").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                            }

                            $(".err_psn_section ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_section ").slideUp(500);
                            });
                        }
                    });
                }
            });

            $("#btnrefreshsection").click(function() {
                $('#tbmsection').LoadingOverlay("show");
                tbmsection.draw()
                $('#tbmsection').LoadingOverlay("hide");
            });

            tbmsection = $('#tbmSection').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [5, 'asc'],
                ],
                "ajax": {
                    "url": "<?= base_url('section/ajax_list'); ?>",
                    "type": "POST",
                    "error": function(xhr, error, code) {
                        if (code != "") {
                            $(".err_psn_section").removeClass("d-none");
                            $(".err_psn_section").css("display", "block");
                            $(".err_psn_section").html("terjadi kesalahan saat melakukan load data section, hubungi administrator");
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
                        name: 'id_section',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center",
                        "width": "1%"
                    },
                    {
                        "data": 'kd_section',
                        "width": "10%"
                    },
                    {
                        "data": 'section',
                        "className": "text-nowrap",
                        "width": "25%"
                    },
                    {
                        "data": 'depart',
                        "className": "text-nowrap",
                        "width": "42%"
                    },
                    {
                        "data": 'stat_section',
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