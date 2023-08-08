    $(document).ready(function() {
        $("#logout").click(function() {
            $("#logoutmdl").modal("show");
        });

        $('#btnupdateNonaktifKary').click(function() {
            let NonaktifKary = $('#editNonaktifKary').val();
            let depart = $('#editNonaktifKaryDepart').val();
            let status = $('#editNonaktifKaryStatus').val();
            let ket = $('#editNonaktifKaryKet').val();

            $.ajax({
                type: "POST",
                url: site_url+"NonaktifKary/edit_NonaktifKary",
                data: {
                    NonaktifKary: NonaktifKary,
                    depart: depart,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmNonaktifKary.draw();
                        $("#editNonaktifKarymdl").modal("hide");
                        $(".err_psn_NonaktifKary").removeClass('d-none');
                        $(".err_psn_NonaktifKary").removeClass('alert-danger');
                        $(".err_psn_NonaktifKary").addClass('alert-info');
                        $(".err_psn_NonaktifKary").html(data.pesan);
                        $("#editNonaktifKary").val('');
                        $("#editNonaktifKaryKet").val('');
                        $("#editNonaktifKaryStatus").val('');
                        $("#error2ep").html('');
                        $("#error3ep").html('');
                        $("#error4ep").html('');
                        $("#error5ep").html('');
                        $(".err_psn_NonaktifKary").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_NonaktifKary").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_NonaktifKary").removeClass('d-none');
                        $(".err_psn_edit_NonaktifKary").removeClass('alert-info');
                        $(".err_psn_edit_NonaktifKary").addClass('alert-danger');
                        $(".err_psn_edit_NonaktifKary").html(data.pesan);
                        $(".err_psn_edit_NonaktifKary").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_NonaktifKary").slideUp(500);
                        });
                    } else if (data.statusCode == 202) {
                        $("#error2ep").html(data.NonaktifKary);
                        $("#error3ep").html(data.depart);
                        $("#error4ep").html(data.status);
                        $("#error5ep").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_NonaktifKary").removeClass("alert-primary");
                    $(".err_psn_NonaktifKary").addClass("alert-danger");
                    $(".err_psn_NonaktifKary").css("display", "block");
                    if (xhr.status == 404) {
                        $(".err_psn_NonaktifKary").html("NonaktifKary gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_NonaktifKary").html("NonaktifKary gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_NonaktifKary").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }
                    $("#editNonaktifKarymdl").modal("hide");
                    $(".err_psn_NonaktifKary ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_NonaktifKary ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        $("#btnBatalNonaktifKary").click(function() {
            $("#perNonaktifKary").val('').trigger('change');
            $("#depNonaktifKary").val('').trigger('change');
            $("#kodSNonaktifKary").val('');
            $("#NonaktifKary").val('');
            $("#ketNonaktifKary").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
            $(".error4").html('');
            $(".error5").html('');
        });

        $('#perNonkatifKary').select2({
            theme: 'bootstrap4'
        });
        $('#perNonaktifData').select2({
            theme: 'bootstrap4'
        });
        $('#alasanNonaktif').select2({
            theme: 'bootstrap4'
        });

        window.addEventListener('resize', function(event) {
            $('#perNonkatifKary').select2({
                theme: 'bootstrap4'
            });
            $('#perNonaktifData').select2({
                theme: 'bootstrap4'
            });
            $('#alasanNonaktif').select2({
                theme: 'bootstrap4'
            });

        }, true);

        // $("#perNonkatifKary").change(function(){
        //     let prs = $("#perNonkatifKary").val();

        //     if(prs !== ""){
        //         $.LoadingOverlay("show");
        //         $.ajax({
        //             type: "POST", 
        //             url: site_url+"karyawan/get_kary_by_auth_m_per",
        //             data: {
        //                 auth_m_per :prs
        //             },
        //             success: function(data) {
        //                 var data = JSON.parse(data);
        //                 $("#cariKaryNonaktif").html(data.kary);
        //                 $.LoadingOverlay("hide");
        //             },
        //             error: function(xhr, ajaxOptions, thrownError) {
        //                 $.LoadingOverlay("hide");
        //                 $(".err_psn_nonaktifkary").removeClass('d-none');
        //                 $(".err_psn_nonaktifkary").removeClass('alert-info');
        //                 $(".err_psn_nonaktifkary").addClass('alert-danger');
        //                 if (thrownError != "") {
        //                     $(".err_psn_nonaktifkary").html("Terjadi kesalahan saat load alasan nonaktif, hubungi administrator");
        //                     $("#btnNonaktifkanKary").attr("disabled", true);
        //                 }
        //             }
        //         })
        //     }

        //     $("#tbmNonaktifKary").LoadingOverlay("hide");
        // });

        $("#perNonkatifKary").change(function(){
            let prs = $("#perNonkatifKary").val();
            $('.aj48ajg').text('');
            $('#noKTPNonaktif').val('');
            $('#noNIKNonaktif').val('');
            $('#namaKarytglNonaktif').val('');
            $('#DepttglNonaktif').val('');
            $("#cariKaryNonaktif").val('');

            if(prs !== ""){
                $.ajax({
                    type: "POST", 
                    url: site_url+"karyawan/get_kary_by_auth_m_per",
                    data: {
                        auth_m_per :prs
                    },
                    success: function(data) {
                        $("#cariKaryNonaktif").autocomplete({
                            source: function(request, response) {
                                $.ajax({
                                    url: site_url+"karyawan/getKaryawan",
                                    type: 'post',
                                    dataType: "json",
                                    data: {
                                        search: request.term,
                                        auth_m_per: $("#perNonkatifKary").val(),
                                    },
                                    success: function(data) {
                                        if($("#perNonkatifKary").val() == ""){
                                            swal('Error','Pilih perusahaan','error');
                                            $("#cariKaryNonaktif").val('');
                                        } else {
                                            response(data);
                                        }
                                    }
                                });
                            },
                            select: function(event, ui) {
                                if (ui.item.value != "") {
                                    $('.aj48ajg').text(ui.item.value);
                                    $('#noKTPNonaktif').val(ui.item.ktp);
                                    $('#noNIKNonaktif').val(ui.item.nik);
                                    $('#namaKarytglNonaktif').val(ui.item.nama);
                                    $('#DepttglNonaktif').val(ui.item.depart);
                                    $("#cariKaryNonaktif").val('');
                                }
                                return false;
                            }
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $(".err_psn_nonaktifkary").removeClass('d-none');
                        $(".err_psn_nonaktifkary").removeClass('alert-info');
                        $(".err_psn_nonaktifkary").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".err_psn_nonaktifkary").html("Terjadi kesalahan saat load perusahaan, hubungi administrator");
                            $("#btnNonaktifkanKary").attr("disabled", true);
                        }
                    }
                })
            } 
        });

        $.ajax({
            type: "POST", 
            url: site_url+"NonaktifKary/gel_all_alasan",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#alasanNonaktif").html(data.alasan);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".err_psn_nonaktifkary").removeClass('d-none');
                $(".err_psn_nonaktifkary").removeClass('alert-info');
                $(".err_psn_nonaktifkary").addClass('alert-danger');
                if (thrownError != "") {
                    $(".err_psn_nonaktifkary").html("Terjadi kesalahan saat load alasan nonaktif, hubungi administrator");
                    $("#btnNonaktifkanKary").attr("disabled", true);
                }
            }
        })

        $.ajax({
            type: "POST", 
            url: site_url+"perusahaan/getidperusahaan",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                if(data.statusCode==200){
                    $("#perNonaktifKaryData").val(data.prs).trigger('change');
                } else {
                    $("#perNonaktifKaryData").val('').trigger('change');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".err_psn_depart").removeClass('d-none');
                $(".err_psn_depart").removeClass('alert-info');
                $(".err_psn_depart").addClass('alert-danger');
                if (thrownError != "") {
                    $(".err_psn_depart").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                    $("#btnTambahNonaktifKary").attr("disabled", true);
                }
            }
        })

        $('#perNonaktifKary').change(function() {
            let auth_per = $("#perNonaktifKary").val();

            $.ajax({
                type: "POST",
                url: site_url+"departemen/get_by_authper",
                data: {
                    auth_per: auth_per
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $('#depNonaktifKary').removeAttr('disabled');
                        $("#depNonaktifKary").html(data.dprt);
                    } else {
                        $("#depNonaktifKary").html('<option value="">-- DEPARTEMEN TIDAK DITEMUKAN --</option>');
                        $("#depNonaktifKary").attr('disabled', true);
                    }
                }
            })
        })

        $("#btnNonaktifkanKary").click(function() {
            var auth_m_per = $("#perNonkatifKary").val();
            var auth_kary = $(".aj48ajg").text();
            var tglnonaktif = $("#tglNonaktif").val();
            var auth_alasan = $("#alasanNonaktif").val();
            var ket_alasan = $("#ketalasanNonaktif").val();
            let file_nonaktif = $("#fileberkasalasan").val();
            const fl_nonaktif = $('#fileberkasalasan').prop('files')[0];

            let formData = new FormData();
            formData.append('file_nonaktif', file_nonaktif);
            formData.append('fl_nonaktif', fl_nonaktif);
            formData.append('auth_m_per', auth_m_per);
            formData.append('auth_alasan', auth_alasan);
            formData.append('tglnonaktif', tglnonaktif);
            formData.append('ket_alasan', ket_alasan);
            formData.append('auth_kary', auth_kary);

            $.ajax({
                type: 'POST',
                url: site_url+"NonaktifKary/input_NonaktifKary",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $(".aj48ajg").text('');
                        $("#perNonkatifKary").val('').trigger('change');
                        $("#cariKaryNonaktif").val('');
                        $("#noKTPNonaktif").val('');
                        $("#namaKarytglNonaktif").val('');
                        $("#DepttglNonaktif").val('');
                        $("#tglNonaktif").val('');
                        $("#alasanNonaktif").val('').trigger('change');
                        $("#ketNonaktif").val('');
                        $("#fileberkasalasan").val('');
                        swal('Berhasil',data.pesan,'success');
                    } else if (data.statusCode == 201) {
                        $(".err_psn_nonaktifkary").removeClass('d-none');
                        $(".err_psn_nonaktifkary").removeClass('alert-primary');
                        $(".err_psn_nonaktifkary").addClass('alert-danger');
                        $(".err_psn_nonaktifkary").html(data.pesan);
                    } else {
                        $(".error1").html(data.prs);
                        $(".error2").html(data.kary);
                        $(".error3").html(data.tglnonaktif);
                        $(".error4").html(data.alasan);
                        $(".error5").html(data.ket);
                        $(".error6").html(data.fileup);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_nonaktifkary").removeClass('d-none');
                    $(".err_psn_nonaktifkary").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".err_psn_nonaktifkary").html("Terjadi kesalahan saat menyimpan data nonaktif karyawan, hubungi administrator");
                    }
                }
            });

            $(".err_psn_nonaktifkary").fadeTo(5000, 500).slideUp(500, function() {
                $(".err_psn_nonaktifkary").slideUp(500);
                $(".err_psn_nonaktifkary").addClass("d-none");
            });
        });

        $(document).on('click', '.hpsNonaktifKary', function() {
            let authNonaktifKary = $(this).attr('id');
            let namaNonaktifKary = $(this).attr('value');

            if (authNonaktifKary == "") {
                swal("Error", "NonaktifKary tidak ditemukan", "error");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin NonaktifKary " + namaNonaktifKary + " akan dihapus?",
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
                            url: site_url+"NonaktifKary/hapus_NonaktifKary",
                            data: {
                                authNonaktifKary: authNonaktifKary
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmNonaktifKary.draw();
                                    $(".err_psn_NonaktifKary").removeClass("d-none");
                                    $(".err_psn_NonaktifKary").removeClass("alert-danger");
                                    $(".err_psn_NonaktifKary").addClass("alert-primary");
                                    $(".err_psn_NonaktifKary").html(data.pesan);
                                } else {
                                    $(".err_psn_NonaktifKary").removeClass("d-none");
                                    $(".err_psn_NonaktifKary").removeClass("alert-primary");
                                    $(".err_psn_NonaktifKary").addClass("alert-danger");
                                    $(".err_psn_NonaktifKary").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_NonaktifKary").removeClass("d-none");
                                $(".err_psn_NonaktifKary").removeClass("alert-primary");
                                $(".err_psn_NonaktifKary").addClass("alert-danger");

                                if (xhr.status == 404) {
                                    $(".err_psn_NonaktifKary").html("NonaktifKary gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_NonaktifKary").html("NonaktifKary gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_NonaktifKary").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_NonaktifKary").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_psn_NonaktifKary").slideUp(500);
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'NonaktifKary ' + namaNonaktifKary + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtlnonaktif', function() {
            let authNonaktifKary = $(this).attr('id');
            let namaNonaktifKary = $(this).attr('value');

            $("#detailnonaktifkary").modal("show");
            // if (authNonaktifKary == "") {
            //     swal("Error", "NonaktifKary tidak ditemukan", "error");
            // } else {
            //     $.ajax({
            //         type: "post",
            //         url: site_url+"NonaktifKary/detail_NonaktifKary",
            //         data: {
            //             authNonaktifKary: authNonaktifKary
            //         },
            //         timeout: 15000,
            //         success: function(data) {
            //             var data = JSON.parse(data);
            //             if (data.statusCode == 200) {
            //                 $("#detailNonaktifKaryPerusahaan").val(data.nama_perusahaan);
            //                 $("#detailNonaktifKaryDepart").val(data.depart);
            //                 $("#detailNonaktifKary").val(data.NonaktifKary);
            //                 $("#detailNonaktifKaryStatus").val(data.status);
            //                 $("#detailNonaktifKaryKet").val(data.ket);
            //                 $("#detailNonaktifKaryBuat").val(data.pembuat);
            //                 $("#detailNonaktifKaryTglBuat").val(data.tgl_buat);
            //                 $("#detailNonaktifKarymdl").modal("show");
            //             } else {
            //                 $(".err_psn_NonaktifKary").css("display", "block");
            //                 $(".err_psn_NonaktifKary").html(data.pesan);
            //             }
            //         },
            //         error: function(xhr, ajaxOptions, thrownError) {
            //             $.LoadingOverlay("hide");
            //             $(".err_psn_NonaktifKary").removeClass("alert-primary");
            //             $(".err_psn_NonaktifKary").addClass("alert-danger");
            //             $(".err_psn_NonaktifKary").css("display", "block");
            //             if (xhr.status == 404) {
            //                 $(".err_psn_NonaktifKary").html("NonaktifKary gagal ditampilkan, Link data tidak ditemukan");
            //             } else if (xhr.status == 0) {
            //                 $(".err_psn_NonaktifKary").html("NonaktifKary gagal ditampilkan, Waktu koneksi habis");
            //             } else {
            //                 $(".err_psn_NonaktifKary").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
            //             }
            //             $(".err_psn_NonaktifKary ").fadeTo(3000, 500).slideUp(500, function() {
            //                 $(".err_psn_NonaktifKary ").slideUp(500);
            //             });
            //         }
            //     });
            // }
        });

        $(document).on('click', '.edttNonaktifKary', function() {
            let authNonaktifKary = $(this).attr('id');

            if (authNonaktifKary == "") {
                swal("Error", "NonaktifKary tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: site_url+"NonaktifKary/detail_NonaktifKary",
                    data: {
                        authNonaktifKary: authNonaktifKary
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataNonaktifKary = JSON.parse(data);
                        if (dataNonaktifKary.statusCode == 200) {
                            $.ajax({
                                type: "POST",
                                url: site_url+"NonaktifKary/get_by_idper",
                                success: function(data) {
                                    var data = JSON.parse(data);
                                    if (data.statusCode == 200) {
                                        $("#editNonaktifKaryDepart").html(data.depart);
                                        $.LoadingOverlay("hide");
                                    } else {
                                        $("#editNonaktifKaryDepart").html(data.depart);
                                        $.LoadingOverlay("hide");
                                        $(".err_psn_edit_dprt").removeClass("alert-primary");
                                        $(".err_psn_edit_dprt").addClass("alert-danger");
                                        $(".err_psn_edit_dprt").css("display", "block");
                                        $(".err_psn_edit_dprt").html(data.pesan);
                                    }
                                    $("#editNonaktifKaryDepart").val(dataNonaktifKary.auth_depart);
                                    $("#editNonaktifKary").val(dataNonaktifKary.NonaktifKary);
                                    $("#editNonaktifKaryStatus").val(dataNonaktifKary.status);
                                    $("#editNonaktifKaryKet").val(dataNonaktifKary.ket);
                                    $("#editNonaktifKarymdl").modal("show");
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
                            $(".err_psn_NonaktifKary").css("display", "block");
                            $(".err_psn_NonaktifKary").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_NonaktifKary").removeClass("alert-primary");
                        $(".err_psn_NonaktifKary").addClass("alert-danger");
                        $(".err_psn_NonaktifKary").css("display", "block");
                        if (xhr.status == 404) {
                            $(".err_psn_NonaktifKary").html("NonaktifKary gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_NonaktifKary").html("NonaktifKary gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_NonaktifKary").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_NonaktifKary ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_NonaktifKary ").slideUp(500);
                        });
                    }
                });
            }
        });

        $("#perNonaktifData").change(function(){
            let m_prs = $("#perNonaktifData").val();

            $("#tbmNonaktif").LoadingOverlay("show");
            $('#tbmNonaktif').DataTable().destroy();
            tb_nakary(m_prs);
        });

        tb_nakary();

        function tb_nakary(m_per){
            tbmNonaktifKary = $('#tbmNonaktif').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [2, 'asc'],
                ],
                "ajax": {
                    "url": site_url+"NonaktifKary/ajax_list?auth_m_per="+m_per,
                    "type": "POST",
                    "error": function(xhr, error, code) {
                        if (code != "") {
                            $(".err_psn_nonaktifKary").removeClass("d-none");
                            $(".err_psn_nonaktifKary").css("display", "block");
                            $(".err_psn_nonaktifKary").html("terjadi kesalahan saat melakukan load data nonaktif karyawan, hubungi administrator");
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
                        name: 'id_NonaktifKary',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center align-middle",
                        "width": "1%"
                    },
                    {
                        "data": 'no_ktp',
                        "className": "text-nowrap align-middle",
                        "width": "15%"
                    },
                    {
                        "data": 'nama_lengkap',
                        "className": "text-nowrap align-middle",
                        "width": "20%"
                    },
                    {
                        "data": 'depart',
                        "className": "text-nowrap align-middle",
                        "width": "20%"
                    },
                    {
                        "data": 'tgl_nonaktif',
                        "className": "text-nowrap align-middle",
                        "width": "9%"
                    },
                    {
                        "data": 'alasan_nonaktif',
                        "className": "text-nowrap align-middle",
                        "width": "15%"
                    },
                    {
                        "data": 'kode_perusahaan',
                        "className": "text-center text-nowrap align-middle",
                        "width": "1%"
                    },
                    {
                        "data": 'proses',
                        "className": "text-center text-nowrap align-middle",
                        "width": "1%"
                    }
                ]
            });
    
            $("#tbmNonaktif").LoadingOverlay("hide");
        }
        

    });