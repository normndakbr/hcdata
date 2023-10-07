
    $(document).ready(function() {
        $("#logout").click(function() {
            $("#logoutmdl").modal("show");
        });

        $('#perIzinData').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        $('#perIzinDataAdd').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        $('#lstJenisIzinAdd').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        $('#lstProsesIzinAdd').select2({
            theme: 'bootstrap4',
            width: '100%',
            dropdownParent: $('#mdllstkaryizin')
        });

        window.addEventListener('resize', function(event) {
            $('#perIzinData').select2({
                theme: 'bootstrap4',
            width: '100%'
            });
    
            $('#perIzinDataAdd').select2({
                theme: 'bootstrap4',
            width: '100%'
            });
    
            $('#lstJenisIzinAdd').select2({
                theme: 'bootstrap4',
            width: '100%'
            });
    
            $('#lstProsesIzinAdd').select2({
                theme: 'bootstrap4',
            width: '100%',
                dropdownParent: $('#mdllstkaryizin')
            });
        }, true);

        $.ajax({
            type: "POST", 
            url: site_url + "perusahaan/getidperusahaan",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                if(data.statusCode==200){
                    $("#perIzinData").val(data.prs).trigger('change');
                } else {
                    $("#perIzinData").val('').trigger('change');
                }
                $.LoadingOverlay("hide");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".err_pesan_izin").removeClass('d-none');
                $(".err_pesan_izin").removeClass('alert-info');
                $(".err_pesan_izin").addClass('alert-danger');
                if (thrownError != "") {
                    $(".err_pesan_izin").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                    $("#addbtnizin").remove();
                }
            }
        })
        
        $("#perIzinData").change(function(){
            let prs = $("#perIzinData").val();
            tbizin();
        });

        $('#btnupdateLokterima').click(function() {
            let kode = $('#editLokterimaKode').val();
            let lokterima = $('#editLokterima').val();
            let status = $('#editLokterimaStatus').val();
            let ket = $('#editLokterimaKet').val();

            $.ajax({
                type: "POST",
                url: site_url+"lokasipenerimaan/edit_lokterima",
                data: {
                    kode: kode,
                    lokterima: lokterima,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmLokterima.draw();
                        $("#editLokterimamdl").modal("hide");
                        $(".err_psn_lokterima").removeClass('d-none');
                        $(".err_psn_lokterima").removeClass('alert-danger');
                        $(".err_psn_lokterima").addClass('alert-info');
                        $(".err_psn_lokterima").html(data.pesan);
                        reseteditlokterima();
                        $(".err_psn_lokterima").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_lokterima").slideUp(500);
                            $(".err_psn_lokterima").addClass('d-none');
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_lokterima").removeClass('d-none');
                        $(".err_psn_edit_lokterima").removeClass('alert-info');
                        $(".err_psn_edit_lokterima").addClass('alert-danger');
                        $(".err_psn_edit_lokterima").html(data.pesan);
                        $(".err_psn_edit_lokterima").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_lokterima").slideUp(500);
                            $(".err_psn_edit_lokterima").addClass('d-none');
                        });
                        $("#error1elkt").html('');
                        $("#error2elkt").html('');
                        $("#error3elkt").html('');
                        $("#error4elkt").html('');
                    } else if (data.statusCode == 202) {
                        $("#error1elkt").html(data.kode);
                        $("#error2elkt").html(data.lokterima);
                        $("#error3elkt").html(data.status);
                        $("#error4elkt").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_lokterima").removeClass("alert-primary");
                    $(".err_psn_lokterima").addClass("alert-danger");
                    $(".err_psn_lokterima").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_lokterima").html("Lokasi penerimaan gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_lokterima").html("Lokasi penerimaan gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_lokterima").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }
                    $("#editLokterimamdl").modal("hide");
                    $(".err_psn_lokterima ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_lokterima ").slideUp(500);
                        $(".err_psn_lokterima").addClass('d-none');
                    });
                }
            })
        });
        
        function get_karyawan_izin(auth_m_prs, prosesizinadd, jenisizinadd){
            $("#txtCariKaryIzinAdd").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: site_url + "karyawan/getKaryawanIzin",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            auth_m_per: auth_m_prs,
                            prosesizinadd: prosesizinadd,
                            jenisizinadd: jenisizinadd,
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    if (ui.item.value != "") {
                        $('#authKaryIzinAdd').val(ui.item.value);
                        $('#txtNikKaryIzinAdd').text(ui.item.nik);
                        $('#txtNamaKaryIzinAdd').text(ui.item.nama);
                        $('#txtDepartKaryIzinAdd').text(ui.item.depart);
                        $('#txtPosisiKaryIzinAdd').text(ui.item.posisi);
                        $('#txtDohKaryIzinAdd').text(ui.item.dohshow);
                        $('#txtExpMPKaryIzinAdd').text(ui.item.tglexpiredshow);
                        $('#lblExpMPKaryIzinAdd').text(ui.item.labeljenis);
                        $("#txtCariKaryIzinAdd").val('');
                    }
                    return false;
                }
            });
        }

        $("#btnSimpanIzinAdd").click(function() {
            let prsizinadd = $("#perIzinDataAdd").val();
            let prsizinaddtext = $("#perIzinDataAdd :selected").text();
            let jenisizinadd = $("#lstJenisIzinAdd").val();
            let jenisizinaddtext = $("#lstJenisIzinAdd :selected").text();
            let tglpengajuan = $("#dtpTglPengajuanIzinAdd").val();
            let ketizinadd = $("#txtKetIzinAdd").val();

            if(prsizinadd == ""){
                err_prsizinadd = "Perusahaan wajib dipilih";
            } else {
                err_prsizinadd = "";
            }

            if(jenisizinadd == ""){
                err_jenisizinadd = "Jenis izin wajib dipilih";
            } else {
                err_jenisizinadd = "";
            }

            if(tglpengajuan == ""){
                err_tglpengajuan = "Tanggal pengajuan wajib diisi";
            } else {
                err_tglpengajuan = "";
            }

            if(err_prsizinadd=="" && err_jenisizinadd == "" && err_tglpengajuan == ""){
                swal({
                    title: "Buat Pengajuan",
                    text: "Yakin pengajuan " + jenisizinaddtext + " akan dibuat?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#36c6d3',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, buat pengajuan',
                    cancelButtonText: 'Batalkan'
                }).then(function(result) {
                    if (result.value) {
                        // $.LoadingOverlay("show");
                        $.ajax({
                            type: "POST",
                            url: site_url + "pengajuansm/input_pengajuansm",
                            data: {
                                prsizinadd: prsizinadd,
                                tglpengajuan: tglpengajuan,
                                jenisizinadd: jenisizinadd,
                                ketizinadd: ketizinadd
                            },
                            timeout: 20000,
                            success: function(data) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    $("#kodePengajuanIizinAdd").val(data.kode);
                                    $("#authPengajuanIzinAdd").val(data.authpengajuansm);
                                    $("#tbDataKary").load(site_url + data.tabel + "?authpengajuansm=" + data.authpengajuansm + "&tabel=" + data.tabel);
                                    $("#jdlmdllstkaryizin").html("<i class='fas fa-user-plus'></i> Data Karyawan | " + prsizinaddtext + " | Kode : " + data.kode + " | PROSES : " + jenisizinaddtext);
                                    $("#mdllstkaryizin").modal("show");
                                    $.LoadingOverlay("hide");
                                } else if (data.statusCode == 201) {
                                    $.LoadingOverlay("hide");
                                    swal('Error',data.pesan,'error');
                                } else if (data.statusCode == 202) {
                                    $.LoadingOverlay("hide");
                                    $(".error1izinadd").text(data.prsizinadd);
                                    $(".error2izinadd").text(data.jenisizinadd);
                                    $(".error4izinadd").text(data.tglpengajuan);
                                    $(".error5izinadd").text(data.ketizinadd);
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_kary_izin_add").removeClass("alert-primary");
                                $(".err_kary_izin_add").addClass("alert-danger");
                                $(".err_kary_izin_add").removeClass("d-none");
                                if (xhr.status == 404) {
                                    $(".err_kary_izin_add").html("Data karyawan gagal disimpan, Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_kary_izin_add").html("Data karyawan gagal disimpan, Waktu koneksi habis");
                                } else {
                                    $(".err_kary_izin_add").html("Terjadi kesalahan saat load data, hubungi administrator");
                                }
            
                                $(".err_kary_izin_add ").fadeTo(3000, 500).slideUp(500, function() {
                                    $(".err_kary_izin_add ").slideUp(500);
                                    $(".err_kary_izin_add").addClass('d-none');
                                });
                            }
                        })
                    }
                });
            } else {
                $(".error1izinadd").text(err_prsizinadd);
                $(".error2izinadd").text(err_jenisizinadd);
                $(".error4izinadd").text(err_tglpengajuan);
            }
        });

        $("#btnAddKaryIzin").click(function() {
            let prsizinadd = $("#perIzinDataAdd").val();
            let jenisizinadd = $("#lstJenisIzinAdd").val();
            let prosesizinadd = $("#lstProsesIzinAdd").val();
            let prosesizinaddtext = $("#lstProsesIzinAdd :selected").text();
            let jdlkaryizinadd = $("#jdlmdllstkaryizin").html();

            if(prosesizinadd != ""){
                get_karyawan_izin(prsizinadd, prosesizinadd, jenisizinadd);
                $("#mdladdkaryizin").modal("show");
                $("#jdlmdlkaryizin").html(jdlkaryizinadd + " | " + prosesizinaddtext);
                $('#authKaryIzinAdd').val('');
                $('#txtNikKaryIzinAdd').text('');
                $('#txtNamaKaryIzinAdd').text('');
                $('#txtDepartKaryIzinAdd').text('');
                $('#txtPosisiKaryIzinAdd').text('');
                $('#txtDohKaryIzinAdd').text('');
                $('#txtExpMPKaryIzinAdd').text('');
                $("#txtCariKaryIzinAdd").val('');
            } else {
                swal('Error','Proses Izin wajib dipilih','error');
            }
        });

        $("#btnSelesaiKaryAddIzin").click(function() {
            $("#mdladdkaryizin").modal("hide");
        });

        $("#btnSelesaiAddIzinDet").click(function() {
            swal({
                title: "Pengajuan Izin",
                text: "Yakin pengajuan SIMPER/Mine Permit sudah selesai?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, selesai',
                cancelButtonText: 'Belum'
            }).then(function(result) {
                if (result.value) {
                    $("#mdllstkaryizin").modal("hide");
                }
            });
        });

        $("#btnSimpanKaryAddIzinDet").click(function() {
            let authpengajuansm = $("#authPengajuanIzinAdd").val();
            let authkary = $("#authKaryIzinAdd").val();
            let nik = $("#txtNikKaryIzinAdd").text();
            let nama = $("#txtNamaKaryIzinAdd").text();
            let prosesizin = $("#lstProsesIzinAdd").val();
            let ketdet = $("#txtKetDetKaryIzinAdd").val();
            let tabel = $("#tbldata").val();

            swal({
                title: "Data Karyawan",
                text: "Yakin data karyawan NIK : " + nik + ", Nama : " + nama + " akan diambil?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Ambil Data',
                cancelButtonText: 'Batalkan'
            }).then(function(result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: "POST",
                        url: site_url + "pengajuansm/input_karypengajuansm",
                        data: {
                            authpengajuansm: authpengajuansm,
                            authkary: authkary,
                            prosesizin: prosesizin,
                            ketdet: ketdet,
                            nik: nik,
                            nama: nama,
                        },
                        timeout: 20000,
                        success: function(data, textStatus, xhr) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $.LoadingOverlay("hide");
                                tbmKaryIzin.draw();
                                $('#authKaryIzinAdd').val('');
                                $('#txtNikKaryIzinAdd').text('');
                                $('#txtNamaKaryIzinAdd').text('');
                                $('#txtDepartKaryIzinAdd').text('');
                                $('#txtPosisiKaryIzinAdd').text('');
                                $('#txtDohKaryIzinAdd').text('');
                                $('#txtExpMPKaryIzinAdd').text('');
                                $("#txtCariKaryIzinAdd").val('');
                                $(".err_kary_izin_add").removeClass("alert-danger");
                                $(".err_kary_izin_add").addClass("alert-primary");
                                $(".err_kary_izin_add").removeClass("d-none");
                                $(".err_kary_izin_add").html(data.pesan);
                            } else {
                                $(".err_kary_izin_add").removeClass("alert-primary");
                                $(".err_kary_izin_add").addClass("alert-danger");
                                $(".err_kary_izin_add").removeClass("d-none");
                                $(".err_kary_izin_add").html(data.pesan);
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_kary_izin_add").removeClass("alert-primary");
                            $(".err_kary_izin_add").addClass("alert-danger");
                            $(".err_kary_izin_add").removeClass("d-none");
                            if (xhr.status == 404) {
                                $(".err_kary_izin_add").html("Data karyawan gagal diambil, , Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_kary_izin_add").html("Data karyawan gagal diambil, Waktu koneksi habis");
                            } else {
                                $(".err_kary_izin_add").html("Terjadi kesalahan saat load data, hubungi administrator");
                            }
                        }
                    });

                    $(".err_kary_izin_add").fadeTo(4000, 500).slideUp(500, function() {
                        $(".err_kary_izin_add").slideUp(500);
                        $(".err_kary_izin_add").addClass('d-none');
                    });
                }
            });

        });

        $("#btnBatalIzinAdd").click(function() {
            $.LoadingOverlay("show");
            $("#perIzinDataAdd").val('').trigger('change');
            $("#lstJenisIzinAdd").val('').trigger('change');
            $("#lstProsesIzinAdd").val('').trigger('change');
            $("#authPengajuanIzinAdd").val('');
            $.LoadingOverlay("hide");
        });

        $("#btnBatalKaryAddIzinDet").click(function() {
            $.LoadingOverlay("show");
            $('#authKaryIzinAdd').val('');
            $('#txtNikKaryIzinAdd').text('');
            $('#txtNamaKaryIzinAdd').text('');
            $('#txtDepartKaryIzinAdd').text('');
            $('#txtPosisiKaryIzinAdd').text('');
            $('#txtDohKaryIzinAdd').text('');
            $('#txtExpMPKaryIzinAdd').text('');
            $("#txtCariKaryIzinAdd").val('');
            $.LoadingOverlay("hide");
        });

        $("#btnBatalAddIzinDet").click(function() {
            let kodepengajuansm = $("#kodePengajuanIizinAdd").val();
            let authpengajuansm = $("#authPengajuanIzinAdd").val();

            swal({
                title: "Batal",
                text: "Yakin pengajuan dengan Kode : " + kodepengajuansm +" akan dibatalkan? semua data terkait akan dihapus",
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
                        url: site_url + "pengajuansm/hapus_pengajuansm",
                        data: {
                            authpengajuansm: authpengajuansm
                        },
                        timeout: 20000,
                        success: function(data, textStatus, xhr) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#mdllstkaryizin").modal("hide");
                            }
                            $.LoadingOverlay("hide");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_pesan_izin").removeClass("alert-primary");
                            $(".err_pesan_izin").addClass("alert-danger");
                            $(".err_pesan_izin").removeClass("d-none");
                            if (xhr.status == 404) {
                                $(".err_pesan_izin").html("Pengajuan izin gagal dihapus, , Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_pesan_izin").html("Pengajuan izin gagal dihapus, Waktu koneksi habis");
                            } else {
                                $(".err_pesan_izin").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                            }
                        }
                    });

                    $(".err_pesan_izin").fadeTo(4000, 500).slideUp(500, function() {
                        $(".err_pesan_izin").slideUp(500);
                        $(".err_pesan_izin").addClass('d-none');
                    });
                }
            });
        });

        $("#btnSelesaiIzinDet").click(function() {
            $("#mdldetizindetail").modal("hide");
         });

        $(document).on('click', '.hpsdtizinkry', function() {
            let authpengajuansm = $(this).attr('id');
            let kodepengajuansm = $(this).attr('value');
            let jenis = $(this).attr('dt-jenis');

            if (authpengajuansm == "") {
                swal("Error", "Pengajuan tidak ditemukan", "error");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin pengajuan " + jenis + ", Kode : " + kodepengajuansm +" akan dihapus?",
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
                            url: site_url + "pengajuansm/hapus_pengajuansm",
                            data: {
                                authpengajuansm: authpengajuansm
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    $(".err_pesan_izin").removeClass("alert-danger");
                                    $(".err_pesan_izin").addClass("alert-primary");
                                    $(".err_pesan_izin").removeClass("d-none");
                                    $(".err_pesan_izin").html(data.pesan);
                                    tbizin();
                                } else {
                                    $(".err_pesan_izin").removeClass("alert-primary");
                                    $(".err_pesan_izin").addClass("alert-danger");
                                    $(".err_pesan_izin").removeClass("d-none");
                                    $(".err_pesan_izin").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_pesan_izin").removeClass("alert-primary");
                                $(".err_pesan_izin").addClass("alert-danger");
                                $(".err_pesan_izin").removeClass("d-none");
                                if (xhr.status == 404) {
                                    $(".err_pesan_izin").html("Pengajuan izin gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_pesan_izin").html("Pengajuan izin gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_pesan_izin").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_pesan_izin").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_pesan_izin").slideUp(500);
                            $(".err_pesan_izin").addClass('d-none');
                        });
                    }
                });
            }
        });

        $(document).on('click', '.dtldtizinkry', function() {
            let authpengajuansm = $(this).attr('id');
            let kodepengajuansm = $(this).attr('value');
            let stt_izin = $(this).attr('dt-status');

            if (authpengajuansm == "") {
                swal("Error", "Pengajuan tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: site_url + "pengajuansm/det_pengajuan",
                    data: {
                        authpengajuansm: authpengajuansm
                    },
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#txtKetIzinAddDet").val(data.ketdetail);
                            tbkaryizindetail(authpengajuansm);
                            $("#jdlmdldetizindetail").html("<i class='fas fa-users'></i> Data Karyawan | Kode : " + kodepengajuansm + " | Status : " + stt_izin);
                            $("#mdldetizindetail").modal("show");
                        } else {
                            $(".err_list_kary_izin_add").removeClass("d-none");
                            $(".err_list_kary_izin_add").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_list_kary_izin_add").removeClass("alert-primary");
                        $(".err_list_kary_izin_add").addClass("alert-danger");
                        $(".err_list_kary_izin_add").removeClass("d-none");
                        if (xhr.status == 404) {
                            $(".err_list_kary_izin_add").html("Pengajuan gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_list_kary_izin_add").html("Pengajuan gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_list_kary_izin_add").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_list_kary_izin_add").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_list_kary_izin_add ").slideUp(500);
                            $(".err_list_kary_izin_add").addClass('d-none');
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edttlokterima', function() {
            let auth_lokterima = $(this).attr('id');

            if (auth_lokterima == "") {
                swal("Error", "Lokasi penerimaan tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: site_url+"lokasipenerimaan/detail_lokterima",
                    data: {
                        auth_lokterima: auth_lokterima
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataLokterima = JSON.parse(data);
                        if (dataLokterima.statusCode == 200) {
                            reseteditlokterima();
                            $("#editLokterimaKode").val(dataLokterima.kode);
                            $("#editLokterima").val(dataLokterima.lokterima);
                            $("#editLokterimaStatus").val(dataLokterima.status);
                            $("#editLokterimaKet").val(dataLokterima.ket);
                            $("#editLokterimamdl").modal("show");
                            $("#error1elkt").html('');
                            $("#error2elkt").html('');
                            $("#error3elkt").html('');
                            $("#error4elkt").html('');
                        } else {
                            $(".err_psn_lokterima").removeClass("d-none");
                            $(".err_psn_lokterima").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_lokterima").removeClass("alert-primary");
                        $(".err_psn_lokterima").addClass("alert-danger");
                        $(".err_psn_lokterima").removeClass("d-none");
                        if (xhr.status == 404) {
                            $(".err_psn_lokterima").html("Lokasi penerimaan gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_lokterima").html("Lokasi penerimaan gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_lokterima").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_lokterima").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_lokterima ").slideUp(500);
                            $(".err_psn_lokterima").addClass('d-none');
                        });
                    }
                });
            }
        });

        tbizin();

        $("#btnRefreshKaryIzin").click(function() {
            tbmKaryIzin.draw();
        });

        $("#btnrefreshLokterima").click(function() {
            tbizin()
        });

        function tbizin(){
            $.LoadingOverlay("show"); 

            $('#tbmIzin').DataTable().destroy();
            tbmIzin = $('#tbmIzin').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [1, 'asc'],
                ],
                "ajax": {
                    "url": site_url + "pengajuansm/ajax_list",
                    "type": "POST",
                    "error": function(xhr, error, code) {
                        if (code != "") {
                            $(".err_pesan_izin").removeClass("d-none");
                            $(".err_pesan_izin").removeClass("d-none");
                            $(".err_pesan_izin").html("Terjadi kesalahan saat melakukan load data pengajuan SIMPER/MIN PERMIT, hubungi administrator");
                            $("#addbtnizin").remove();
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
                        name: 'id_pengajuan_sm',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center align-middle",
                        "width": "1%"
                    },
                    {
                        "data": 'kode_pengajuan_sm',
                        "className": "align-middle",
                        "width": "15%"
                    },
                    {
                        "data": 'tgl_pengajuan_sm_show',
                        "className": "text-nowrap align-middle",
                        "width": "15%"
                    },
                    {
                        "data": 'jenis_izin_tambang',
                        "className": "text-nowrap align-middle",
                        "width": "10%"
                    },
                    {
                        "data": 'kode_perusahaan',
                        "className": "text-center text-nowrap align-middle",
                        "width": "1%"
                    },
                    {
                        "data": 'stat_pengajuan_sm',
                        "className": "text-center  align-middle",
                        "width": "1%"
                    },
                    {
                        "data": 'tgl_buat',
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
    
            $.LoadingOverlay("hide"); 
        }

        // function tbkaryizin(authpengajuansm){
        //     $.LoadingOverlay("show"); 

        //     $('#tbmKaryMP').DataTable().destroy();
        //     tbmKaryIzin = $('#tbmKaryMP').DataTable({
        //         "processing": true,
        //         "responsive": true,
        //         "serverSide": true,
        //         "ordering": true,
        //         "order": [
        //             [1, 'asc'],
        //         ],
        //         "ajax": {
        //             "url": site_url + "karyizin/ajax_list?authizinmst=" + authpengajuansm,
        //             "type": "POST",
        //             "error": function(xhr, error, code) {
        //                 if (code != "") {
        //                     $(".err_list_kary_izin_add").removeClass("d-none");
        //                     $(".err_list_kary_izin_add").removeClass("d-none");
        //                     $(".err_list_kary_izin_add").html("Terjadi kesalahan saat melakukan load data karyawan, hubungi administrator");
        //                     $("#addbtnizin").remove();
        //                 }
        //             }
        //         },
        //         "deferRender": true,
        //         "aLengthMenu": [
        //             [10, 25, 50],
        //             [10, 25, 50]
        //         ],
        //         "columns": [{
        //                 data: 'no',
        //                 name: 'id_pengajuan_sm_detail',
        //                 render: function(data, type, row, meta) {
        //                     return meta.row + meta.settings._iDisplayStart + 1;
        //                 },
        //                 "className": "text-center align-middle",
        //                 "width": "1%"
        //             },
        //             {
        //                 "data": 'nik',
        //                 "className": "align-middle",
        //                 "width": "15%"
        //             },
        //             {
        //                 "data": 'nama_lengkap',
        //                 "className": "text-nowrap align-middle",
        //                 "width": "15%"
        //             },
        //             {
        //                 "data": 'depart',
        //                 "className": "text-nowrap align-middle",
        //                 "width": "10%"
        //             },
        //             {
        //                 "data": 'posisi',
        //                 "className": "text-center text-nowrap align-middle",
        //                 "width": "1%"
        //             },
        //             {
        //                 "data": 'dohshow',
        //                 "className": "text-center text-nowrap align-middle",
        //                 "width": "1%"
        //             },
        //             {
        //                 "data": 'proses_izin_tambang',
        //                 "className": "text-center  align-middle",
        //                 "width": "1%"
        //             },
        //             {
        //                 "data": 'proses',
        //                 "className": "text-center text-nowrap align-middle",
        //                 "width": "1%"
        //             }
        //         ]
        //     });
    
        //     $.LoadingOverlay("hide"); 
        // }

        function tbkaryizindetail(authizinmst){
            $.LoadingOverlay("show"); 

            $('#tbmKaryIzinDet').DataTable().destroy();
            tbmKaryIzinDet = $('#tbmKaryIzinDet').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [1, 'asc'],
                ],
                "ajax": {
                    "url": site_url + "karyizin/ajax_list?authizinmst=" + authizinmst,
                    "type": "POST",
                    "error": function(xhr, error, code) {
                        if (code != "") {
                            $(".err_list_kary_izin_add").removeClass("d-none");
                            $(".err_list_kary_izin_add").removeClass("d-none");
                            $(".err_list_kary_izin_add").html("Terjadi kesalahan saat melakukan load data karyawan, hubungi administrator");
                            $("#addbtnizin").remove();
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
                        name: 'id_pengajuan_sm_detail',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center align-middle",
                        "width": "1%"
                    },
                    {
                        "data": 'nik',
                        "className": "align-middle",
                        "width": "15%"
                    },
                    {
                        "data": 'nama_lengkap',
                        "className": "text-nowrap align-middle",
                        "width": "15%"
                    },
                    {
                        "data": 'depart',
                        "className": "text-nowrap align-middle",
                        "width": "10%"
                    },
                    {
                        "data": 'posisi',
                        "className": "text-center text-nowrap align-middle",
                        "width": "1%"
                    },
                    {
                        "data": 'dohshow',
                        "className": "text-center text-nowrap align-middle",
                        "width": "1%"
                    },
                    {
                        "data": 'proses_izin_tambang',
                        "className": "text-center  align-middle",
                        "width": "1%"
                    },
                    {
                        "data": 'proses',
                        "className": "text-center text-nowrap align-middle",
                        "width": "1%"
                    }
                ]
            });
    
            $.LoadingOverlay("hide"); 
        }
    });