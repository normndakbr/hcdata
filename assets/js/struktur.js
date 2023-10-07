
function htmlspecialchars(str) {
    return str.replace('&', '&amp;').replace('"', '&quot;').replace("'", '&#039;').replace('<', '&lt;').replace('>', '&gt;');
}

$("#cariMPerusahaan").keyup(function () {
    let perutama = $("#perJenis").val();

    if (perutama === "") {
        swal('Perusahaan Utama', 'Pilih Perusahaan utama terlebih dahulu', 'warning');
        $("#cariMPerusahaan").val('');
    }
});

$("#clRK3L-click").click(function () {
    if ($("#colRK3L").hasClass("show")) {
        $("#colRK3L").collapse("hide");
    } else {
        $("#colRK3L").collapse("show");
    }
});

$("#clIUJP-click").click(function () {
    if ($("#colIUJP").hasClass("show")) {
        $("#colIUJP").collapse("hide");
    } else {
        $("#colIUJP").collapse("show");
    }
});

$("#clSIO-click").click(function () {
    if ($("#colSIO").hasClass("show")) {
        $("#colSIO").collapse("hide");
    } else {
        $("#colSIO").collapse("show");
    }
});

$("#clKontrak-click").click(function () {
    if ($("#colKontrak").hasClass("show")) {
        $("#colKontrak").collapse("hide");
    } else {
        $("#colKontrak").collapse("show");
    }
});

$("#clPJO-click").click(function () {
    if ($("#colPJO").hasClass("show")) {
        $("#colPJO").collapse("hide");
    } else {
        $("#colPJO").collapse("show");
    }
});

$("#cariMPerusahaan").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: site_url + "perusahaan/getPerusahaan",
            type: 'post',
            dataType: "json",
            data: {
                search: request.term
            },
            success: function (data) {
                response(data);
                var perjenis = $("#perJenis").val();

                if (jenisper !== "") {
                    response(data);
                }
            }
        });
    },
    select: function (event, ui) {
        if (ui.item.value != "") {
            $.ajax({
                type: 'post',
                url: site_url + "perusahaan/getidper",
                data: {
                    auth_per: ui.item.value
                },
                success: function (data) {
                    $('#namaMperusahaan').val(ui.item.nama);
                    $('#kodeMperusahaan').val(ui.item.kode);
                    $("#cariMPerusahaan").val('');
                    $(".error2str").text('');
                    $(".error3str").text('');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                        $("#btnAddPerusahaan").remove();
                    }
                }
            });
        }
        return false;
    }
});

$("#caripjonew").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: site_url + "karyawan/getKaryawan",
            type: 'post',
            dataType: "json",
            data: {
                search: request.term,
                auth_m_per: $(".2d3f4g5h6j7k8j6b4vec5v").text()
            },
            success: function (data) {
                response(data);
            }
        });
    },
    select: function (event, ui) {
        if (ui.item.value != "") {
            $('.ccv445bb66n7uj8ikmhg23fsdf').text(ui.item.value);
            $('#ktppjonew').val(ui.item.ktp);
            $('#nikpjonew').val(ui.item.nik);
            $('#namapjonew').val(ui.item.nama);
            $('#ktppjonew').attr('disabled', true);
            $('#nikpjonew').attr('disabled', true);
            $('#namapjonew').attr('disabled', true);
            $("#caripjonew").val('');
            $(".errktppjonew").text('');
            $(".errnikpjonew").text('');
            $(".errnamapjonew").text('');
        }
        return false;
    }
});

$("#caripjo").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: site_url + "karyawan/getKaryawan",
            type: 'post',
            dataType: "json",
            data: {
                search: request.term,
                auth_m_per: $(".a67z34ssdh53b45jfasda4").text()
            },
            success: function (data) {
                response(data);
            }
        });
    },
    select: function (event, ui) {
        alert(ui.item.value);
        if (ui.item.value != "") {
            alert(ui.item.value);
            $('.8c9l1k4n9d09vm3mn43k8s834kk45').text(ui.item.value);
            $('#ktppjo').val(ui.item.ktp);
            $('#nikpjo').val(ui.item.nik);
            $('#namapjo').val(ui.item.nama);
            $('#ktppjo').attr('disabled', true);
            $('#nikpjo').attr('disabled', true);
            $('#namapjo').attr('disabled', true);
            $("#caripjo").val('');
            $(".error6pjo").text('');
            $(".error7pjo").text('');
            $(".error8pjo").text('');
        } else {
            alert(ui.item.value);
        }
        return false;
    }
});

$(document).ready(function () {
    $.LoadingOverlay("hide");
    $("#colPerusahaan").collapse("show");
    $("#idpjo").load(site_url + "struktur/pjo");

    $("#perJenis").change(function () {
        $("#cariMPerusahaan").focus();
    });

    $("#btnNewStr").click(function () {
        if ($("#btnSelesaiStrPer").length > 0) {
            swal("Error", "Tidak dapat membuat data baru, selesaikan data perusahaan", "error");
            return false;
        } else {
            $("#mdlstrperusahaan").modal("show");
            $("#perJenis").val('').trigger('change');
            $("#cariMPerusahaan").val('');
            $("#kodeMperusahaan").val('');
            $("#namaMperusahaan").val('');
            $(".error1str").text('');
            $(".error2str").text('');
            $(".error3str").text('');
            $(".8ih3js7h3k8kj42b5n1m5n3").text('');
            $(".b8f9s7sd7f7asj3h4j3k2j").text('');
            $(".a67z34ssdh53b45jfasda4").text('');
        }
    });

    $("#btnResetKaryNew").click(function () {
        $.LoadingOverlay("show");
        $("#ktppjonew").val('');
        $("#nikpjonew").val('');
        $("#namapjonew").val('');
        $("#ktppjonew").removeAttr('disabled');
        $("#nikpjonew").removeAttr('disabled');
        $("#namapjonew").removeAttr('disabled');
        $(".ccv445bb66n7uj8ikmhg23fsdf").text('');
        $.LoadingOverlay("hide");
    });

    $("#btnResetKary").click(function () {
        $.LoadingOverlay("show");
        $("#ktppjo").val('');
        $("#nikpjo").val('');
        $("#namapjo").val('');
        $("#ktppjo").removeAttr('disabled');
        $("#nikpjo").removeAttr('disabled');
        $("#namapjo").removeAttr('disabled');
        $(".8c9l1k4n9d09vm3mn43k8s834kk").text('');
        $.LoadingOverlay("hide");
    });

    $("#logout").click(function () {
        $("#logoutmdl").modal("show");
    });

    $("#iujptdkada").click(function () {
        $("#colIUJPada").collapse("hide");
    });

    $("#iujpada").click(function () {
        $("#colIUJPada").collapse("show");
    });

    $("#siotdkada").click(function () {
        $("#colSIOada").collapse("hide");
    });

    $("#sioada").click(function () {
        $("#colSIOada").collapse("show");
    });

    $("#kontraktdkada").click(function () {
        $("#colKontrakada").collapse("hide");
    });

    $("#kontrakada").click(function () {
        $("#colKontrakada").collapse("show");
    });

    $('#provData').select2({
        theme: 'bootstrap4',
            width: '100%'
    });

    $('#lokkerpjo').select2({
        theme: 'bootstrap4',
            width: '100%'
    });

    $('#perJenis').select2({
        theme: 'bootstrap4',
            width: '100%'
    });


    $("#perJenis").select2({
        dropdownParent: $("#mdlstrperusahaan")
    });

    window.addEventListener('resize', function (event) {
        $('#provData').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        $('#lokkerpjo').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        $('#perJenis').select2({
            theme: 'bootstrap4',
            width: '100%'
        });


        $("#perJenis").select2({
            dropdownParent: $("#mdlstrperusahaan")
        });
    }, true);

    $.ajax({
        type: "POST",
        url: site_url + "perusahaan/get_m_all",
        data: {},
        success: function (data) {
            var data = JSON.parse(data);
            $("#perLevel").html(data.prs);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsgper").removeClass('d-none');
            $(".errormsgper").removeClass('alert-info');
            $(".errormsgper").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsgper").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                $("#btnTambahLevel").attr("disabled", true);
            }
        }
    })

    $.ajax({
        type: "POST",
        url: site_url + "struktur/get_lokasi_pjo",
        data: {},
        success: function (data) {
            var data = JSON.parse(data);
            $("#lokkerpjo").html(data.pjoo);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.LoadingOverlay("hide");
            $(".errormsgpjo").removeClass('d-none');
            $(".errormsgpjo").removeClass('alert-info');
            $(".errormsgpjo").addClass('alert-danger');
            if (thrownError != "") {
                $(".errormsgpjo").html("Terjadi kesalahan saat load data lokasi PJO, hubungi administrator");
                $("#btnTambahLevel").attr("disabled", true);
            }
        }
    })

    $('#btnSaveStrPer').click(function () {
        let idparent = htmlspecialchars($("#perJenis").val());
        let perutama = htmlspecialchars($("#perJenis option:selected").text());
        let kodeper = htmlspecialchars($("#kodeMperusahaan").val());
        let namaper = htmlspecialchars($("#namaMperusahaan").val());
        let auth_m_per = htmlspecialchars($(".a67z34ssdh53b45jfasda4").text());
        var token = $("#token").val();

        if (idparent == "") {
            errparent = "Perusahaan utama wajib dipilih";
        } else {
            errparent = "";
        }

        if (kodeper == "") {
            errkodeper = "Perusahaan utama wajib dipilih";
        } else {
            errkodeper = "";
        }

        if (namaper == "") {
            errnamaper = "Perusahaan utama wajib dipilih";
        } else {
            errnamaper = "";
        }

        if (errparent == "" && errkodeper == "" && errnamaper == "") {
            swal({
                title: "Buat Struktur Perusahaan",
                text: "Yakin data struktur perusahaan sudah benar, data tidak dapat diubah setelah disimpan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Buat data',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    let formData = new FormData();
                    formData.append('idparent', idparent);
                    formData.append('kodeper', kodeper);
                    formData.append('namaper', namaper);
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('token', token);

                    $.ajax({
                        type: "POST",
                        url: site_url + "struktur/input_perusahaan",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $('.btnselesai').append('<button id="btnSelesaiStrPer" class="btn btn-success font-weight-bold mt-1 ml-2">Update & Selesai</button>');
                                $('#imgPerusahaan').removeClass('d-none');
                                $('#colRK3L').collapse('show');
                                $('#colIUJP').collapse('hide');
                                $('#colSIO').collapse('hide');
                                $('#colKontrak').collapse('hide');
                                $('#colPJO').collapse('hide');
                                $("#txtPerusahaanUtama").text(perutama);
                                $("#txtkodeMperusahaan").text(kodeper);
                                $("#txtnamaMperusahaan").text(namaper);
                                $(".a67z34ssdh53b45jfasda4").text(data.auth_m_per);
                                $(".b8f9s7sd7f7asj3h4j3k2j").text(data.auth_parent);
                                $(".8ih3js7h3k8kj42b5n1m5n3").text(data.auth_per);
                                $("#mdlstrperusahaan").modal('hide');
                                aktifRK3L();
                                aktifIUJP();
                                aktifSIO();
                                aktifKontrak();
                                aktifPJO();
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                                //=============================================================================================================
                                $('#btnSelesaiStrPer').click(function () {
                                    swal({
                                        title: "Simpan Data Perusahaan",
                                        text: "Yakin data perusahaan sudah lengkap dan akan disimpan?",
                                        type: 'question',
                                        showCancelButton: true,
                                        confirmButtonColor: '#36c6d3',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, simpan',
                                        cancelButtonText: 'Batalkan'
                                    }).then(function (result) {
                                        if (result.value) {
                                            $.LoadingOverlay("show");
                                            $.ajax({
                                                type: 'POST',
                                                url: site_url + "struktur/str_selesai",
                                                success: function (data) {
                                                    var data = JSON.parse(data);
                                                    if (data.statusCode == 200) {
                                                        $.LoadingOverlay("hide");
                                                        window.location.href = site_url + "struktur/new";
                                                    } else {
                                                        $.LoadingOverlay("hide");
                                                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                                    }
                                                }
                                            });
                                        }
                                    });
                                });
                            } else if (data.statusCode == 201) {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            } else {
                                $('.error1str').html(data.idparent);
                                $('.error2str').html(data.kodeper);
                                $('.error3str').html(data.namaper);
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat menyimpan data struktur Perusahaan, hubungi administrator";
                                $("#AddPerusahaan").remove();
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    })
                }
            });
        } else {
            $('.error1str').text(errparent);
            $('.error2str').text(errkodeper);
            $('.error3str').text(errnamaper);
        }
    });

    $("#btnTabelStr").click(function () {
        if ($('#btnSelesaiStrPer').length) {
            swal('', 'Tidak dapat melanjutkan, selesai data perusahaan', 'error');
            return false;
        } else {
            let url = site_url + "struktur";
            window.open(url, '_blank');
        }
    });

    function aktifRK3L() {
        $("#filerk3l").removeAttr('disabled');
        $("#btnUploadFileRK3L").removeAttr('disabled');
    }

    function aktifIUJP() {
        $("#fileiujp").removeAttr('disabled');
        $("#noiujp").removeAttr('disabled');
        $("#tglAktifiujp").removeAttr('disabled');
        $("#tglakhiriujp").removeAttr('disabled');
        $("#ketiujp").removeAttr('disabled');
        $("#btnUploadFileIUJP").removeAttr('disabled');
    }

    function aktifSIO() {
        $("#fileSIO").removeAttr('disabled');
        $("#noSIO").removeAttr('disabled');
        $("#tglaktifSIO").removeAttr('disabled');
        $("#tglakhirSIO").removeAttr('disabled');
        $("#ketSIO").removeAttr('disabled');
        $("#btnUploadFileSIO").removeAttr('disabled');
    }

    function aktifKontrak() {
        $("#fileKontrak").removeAttr('disabled');
        $("#nokontrak").removeAttr('disabled');
        $("#tglaktifkontrak").removeAttr('disabled');
        $("#tglakhirkontrak").removeAttr('disabled');
        $("#ketkontrak").removeAttr('disabled');
        $("#btnUploadFileKontrak").removeAttr('disabled');
    }

    function aktifPJO() {
        $("#filePJO").removeAttr('disabled');
        $("#nopjo").removeAttr('disabled');
        $("#tglaktifpjo").removeAttr('disabled');
        $("#tglakhirpjo").removeAttr('disabled');
        $("#lokkerpjo").removeAttr('disabled');
        $("#caripjo").removeAttr('disabled');
        $("#ktppjo").removeAttr('disabled');
        $("#nikpjo").removeAttr('disabled');
        $("#namapjo").removeAttr('disabled');
        $("#ketpjo").removeAttr('disabled');
        $("#refreshPjo").removeAttr('disabled');
        $("#addSimpanPJO").removeAttr('disabled');
    }

    $('#btnUploadFileRK3L').click(function () {
        let auth_m_per = htmlspecialchars($(".a67z34ssdh53b45jfasda4").text());
        let filerk3l = $("#filerk3l").val();
        const flrk3l = $('#filerk3l').prop('files')[0];
        var token = $("#token").val();

        if (auth_m_per == "") {
            err_auth_m_per = "Perusahaan belum dibuat";
        } else {
            err_auth_m_per = "";
        }

        if (filerk3l == "") {
            err_filerk3l = "RK3L wajib diupload";
        } else {
            err_filerk3l = "";
        }

        if (err_filerk3l == "" && err_auth_m_per == "") {
            swal({
                title: "Upload Data RK3L",
                text: "Yakin data RK3L sudah benar?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Upload file',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    let formData = new FormData();
                    formData.append('flrk3l', flrk3l);
                    formData.append('filerk3l', filerk3l);
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('token', token);

                    $.ajax({
                        type: "POST",
                        url: site_url + "struktur/addrk3l",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $('#imgRK3L').removeClass('d-none');
                                $('#colRK3L').collapse('hide');
                                $('#colIUJP').collapse('hide');
                                $('#colSIO').collapse('hide');
                                $('#colKontrak').collapse('hide');
                                $('#colPJO').collapse('hide');
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $("#filerk3l").attr('disabled', true);
                                $("#btnUploadFileRK3L").attr('disabled', true);
                                $("#addResetFileRK3L").removeAttr('disabled');
                                $("#addBukaFile").attr("href", data.link);
                                $("#addBukaFile").removeClass('disabled');
                                $(".error6rk3l").text('');
                                $.LoadingOverlay("hide");
                            } else if (data.statusCode == 201) {
                                swal("Error", data.pesan, "error");
                                $.LoadingOverlay("hide");
                            } else {
                                $(".error6rk3l").html(data.filerk3l);
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat upload data RK3L, hubungi administrator";
                                $("#AddPerusahaan").remove();
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    })
                }
            });
        } else {
            $(".error6rk3l").html(err_filerk3l);
            if (err_auth_m_per != "") {
                swal("Error", err_auth_m_per, "error");
            }
        }

    });

    $('#addResetFileRK3L').click(function () {
        let auth_m_per = htmlspecialchars($(".a67z34ssdh53b45jfasda4").text());
        let filerk3l = $("#filerk3l").val();
        var token = $("#token").val();

        if (auth_m_per == "") {
            err_auth_m_per = "Perusahaan belum dibuat";
        } else {
            err_auth_m_per = "";
        }

        if (filerk3l == "") {
            err_filerk3l = "RK3L wajib diupload";
        } else {
            err_filerk3l = "";
        }

        if (err_filerk3l == "" && err_auth_m_per == "") {
            swal({
                title: "Reset Data RK3L",
                text: "Yakin data RK3L akan direset?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Reset RK3L',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    let formData = new FormData();
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('token', token);
                    $.ajax({
                        type: "POST",
                        url: site_url + "struktur/resetrk3l",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $('#imgRK3L').addClass('d-none');
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $("#addBukaFile").addClass('disabled');
                                $("#addBukaFile").attr('href', '');
                                $("#addResetFileRK3L").attr('disabled', true);
                                $("#filerk3l").removeAttr('disabled');
                                $("#btnUploadFileRK3L").removeAttr('disabled');
                                $(".error6rk3l").text('');
                                $("#filerk3l").val('');
                                $.LoadingOverlay("hide");
                            } else if (data.statusCode == 201) {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            } else {
                                $(".error6rk3l").html(data.filerk3l);
                                if (data.auth_m_per != "") {
                                    swal(data.kode_pesan, data.auth_m_per, data.tipe_pesan);
                                }
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");

                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat reset data RK3L, hubungi administrator";
                                $("#AddPerusahaan").remove();
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');

                        }
                    })
                }
            });
        } else {
            $(".error6rk3l").html(err_filerk3l);
            if (err_auth_m_per != "") {
                swal("Error", err_auth_m_per, 'error');
            }
        }

    });

    $('#btnUploadFileIUJP').click(function () {
        let no_iujp = htmlspecialchars($("#noiujp").val());
        let tgl_awal_iujp = $("#tglAktifiujp").val();
        let tgl_akhir_iujp = $("#tglakhiriujp").val();
        let ket_iujp = htmlspecialchars($("#ketiujp").val());
        let fileiujp = $("#fileiujp").val();
        const fliujp = $('#fileiujp').prop('files')[0];
        let perutama = $('#perUtamaIUJP').val();
        let persub = $('#perSubIUJP').val();
        let auth_m_per = htmlspecialchars($(".a67z34ssdh53b45jfasda4").text());
        let auth_parent = htmlspecialchars($(".b8f9s7sd7f7asj3h4j3k2j").text());
        let auth_per = htmlspecialchars($(".8ih3js7h3k8kj42b5n1m5n3").text());
        let auth_iujp = $(".o8s9l3l8n34m7834m22n4w3a").text();
        var token = $("#token").val();

        if (no_iujp == "") {
            err_no_iujp = "No. IUJP wajib diisi";
        } else {
            err_no_iujp = "";
        }

        if (tgl_awal_iujp == "") {
            err_tgl_awal_iujp = "Tanggal aktif IUJP wajib diisi";
        } else {
            err_tgl_awal_iujp = "";
        }

        if (tgl_akhir_iujp == "") {
            err_tgl_akhir_iujp = "Tanggal akhir IUJP wajib diisi";
        } else {
            err_tgl_akhir_iujp = "";
        }

        if (fileiujp == "") {
            err_fileiujp = "File IUJP wajib diupload";
        } else {
            err_fileiujp = "";
        }

        if (err_no_iujp == "" && err_tgl_awal_iujp == "" && err_tgl_akhir_iujp == "" && err_fileiujp == "") {
            swal({
                title: "Simpan IUJP",
                text: "Yakin data IUJP akan disimpan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan IUJP',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    let formData = new FormData();
                    formData.append('fliujp', fliujp);
                    formData.append('fileiujp', fileiujp);
                    formData.append('no_iujp', no_iujp);
                    formData.append('tgl_awal_iujp', tgl_awal_iujp);
                    formData.append('tgl_akhir_iujp', tgl_akhir_iujp);
                    formData.append('ket_iujp', ket_iujp);
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('auth_parent', auth_parent);
                    formData.append('auth_per', auth_per);
                    formData.append('auth_iujp', auth_iujp);
                    formData.append('token', token);
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: 'POST',
                        url: site_url + "struktur/addiujp",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $('#imgIUJP').removeClass('d-none');
                                $('#colIUJP').collapse('hide');
                                $('#colSIO').collapse('hide');
                                $('#colKontrak').collapse('hide');
                                $('#colPJO').collapse('hide');
                                $('#perUtamaSIO').val(perutama);
                                $('#perSubSIO').val(persub);
                                $(".o8s9l3l8n34m7834m22n4w3a").text(data.auth_izin);
                                $("#addBukaFileIUJP").attr("href", data.link);
                                $("#addBukaFileIUJP").removeClass('disabled');
                                $("#addResetFileIUJP").removeAttr('disabled');
                                $(".error2iujp").html('');
                                $(".error3iujp").html('');
                                $(".error4iujp").html('');
                                $(".error6iujp").html('');
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            } else if (data.statusCode == 201) {
                                swal("Error", data.pesan, "error");
                                $.LoadingOverlay("hide");
                            } else {
                                $(".error2iujp").html(data.no_iujp);
                                $(".error3iujp").html(data.tgl_awal_iujp);
                                $(".error4iujp").html(data.tgl_akhir_iujp);
                                $(".error6iujp").html(data.fileiujp);
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat menyimpan data IUJP, hubungi administrator";
                                $("#addIUJP").remove();
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');

                        }
                    });
                }
            });
        } else {
            $(".error2iujp").html(err_no_iujp);
            $(".error3iujp").html(err_tgl_awal_iujp);
            $(".error4iujp").html(err_tgl_akhir_iujp);
            $(".error6iujp").html(err_fileiujp);
            $.LoadingOverlay("hide");
        }
    });

    $('#addResetFileIUJP').click(function () {
        let auth_izin = htmlspecialchars($(".o8s9l3l8n34m7834m22n4w3a").text());
        var token = $("#token").val();

        if (auth_izin !== "") {
            swal({
                title: "Hapus Data IUJP/Perizinan",
                text: "Yakin data IUJP/Perizinan akan dihapus, data tidak dapat dikembalikan lagi?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    let formData = new FormData();
                    formData.append('auth_izin', auth_izin);
                    formData.append('token', token);
                    $.ajax({
                        type: "POST",
                        url: site_url + "struktur/resetiujp",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#noiujp").val('');
                                $("#tglAktifiujp").val('');
                                $("#tglakhiriujp").val('');
                                $("#ketiujp").val('');
                                $("#fileiujp").val('');
                                $('#imgIUJP').addClass('d-none');
                                $(".o8s9l3l8n34m7834m22n4w3a").text('')
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                swal("Berhasil", "IUJP/Perizinan berhasil dihapus", "success");
                                $("#addBukaFileIUJP").addClass('disabled');
                                $("#addBukaFileIUJP").attr('href', '');
                                $("#addResetFileIUJP").attr('disabled', true);
                                $("#btnUploadFileIUJP").removeAttr('disabled');
                                $(".error6rk3l").text('');
                                $.LoadingOverlay("hide");
                            } else if (data.statusCode == 201) {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            } else {
                                $(".error6rk3l").html(data.filerk3l);
                                if (data.auth_m_per != "") {
                                    swal("Error", data.auth_m_per, "error");
                                }
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat reset data RK3L, hubungi administrator";
                                $("#AddPerusahaan").remove();
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');

                        }
                    })
                }
            });
        } else {
            $(".error6rk3l").html(err_filerk3l);
            if (err_auth_m_per != "") {
                swal("Error", err_auth_m_per, "error");
            }
        }

    });

    $('#btnUploadFileSIO').click(function () {
        let no_sio = htmlspecialchars($("#noSIO").val());
        let tgl_awal_sio = $("#tglaktifSIO").val();
        let tgl_akhir_sio = $("#tglakhirSIO").val();
        let ket_sio = htmlspecialchars($("#ketSIO").val());
        let filesio = $("#fileSIO").val();
        const flsio = $('#fileSIO').prop('files')[0];
        let perutama = $('#perUtamaIUJP').val();
        let persub = $('#perSubIUJP').val();
        let auth_m_per = htmlspecialchars($(".a67z34ssdh53b45jfasda4").text());
        let auth_parent = htmlspecialchars($(".b8f9s7sd7f7asj3h4j3k2j").text());
        let auth_per = htmlspecialchars($(".8ih3js7h3k8kj42b5n1m5n3").text());
        let auth_sio = $(".2l7k6h9m1v9j3b8k3h8d5d0").text();
        var token = $("#token").val();

        if (no_sio == "") {
            err_no_sio = "No. SIO wajib diisi";
        } else {
            err_no_sio = "";
        }

        if (tgl_awal_sio == "") {
            err_tgl_awal_sio = "Tanggal aktif SIO wajib diisi";
        } else {
            err_tgl_awal_sio = "";
        }

        if (tgl_akhir_sio == "") {
            err_tgl_akhir_sio = "Tanggal akhir SIO wajib diisi";
        } else {
            err_tgl_akhir_sio = "";
        }

        if (filesio == "") {
            err_filesio = "File SIO wajib diupload";
        } else {
            err_filesio = "";
        }

        if (err_no_sio == "" && err_tgl_awal_sio == "" && err_tgl_akhir_sio == "" && err_filesio == "") {
            swal({
                title: "Simpan SIO",
                text: "Yakin data SIO akan disimpan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan SIO',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    let formData = new FormData();
                    formData.append('flsio', flsio);
                    formData.append('filesio', filesio);
                    formData.append('no_sio', no_sio);
                    formData.append('tgl_awal_sio', tgl_awal_sio);
                    formData.append('tgl_akhir_sio', tgl_akhir_sio);
                    formData.append('ket_sio', ket_sio);
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('auth_parent', auth_parent);
                    formData.append('auth_per', auth_per);
                    formData.append('auth_sio', auth_sio);
                    formData.append('token', token);

                    $.LoadingOverlay("show");
                    $.ajax({
                        type: 'POST',
                        url: site_url + "struktur/addsio",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $('#imgSIO').removeClass('d-none');
                                $('#colSIO').collapse('hide');
                                $('#colKontrak').collapse('hide');
                                $('#colIUJP').collapse('hide');
                                $('#colPJO').collapse('hide');
                                $('#perUtamaKontrak').val(perutama);
                                $('#perSubKontrak').val(persub);
                                $(".2l7k6h9m1v9j3b8k3h8d5d0").text(data.auth_sio);
                                $("#addBukaFileSIO").attr("href", data.link);
                                $("#addBukaFileSIO").removeAttr('disabled');
                                $("#addResetFileSIO").removeAttr('disabled');
                                $(".error2SIO").html('');
                                $(".error3SIO").html('');
                                $(".error4SIO").html('');
                                $(".error6fileSIO").html('');
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            } else if (data.statusCode == 201) {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            } else {
                                $(".error2SIO").html(data.no_sio);
                                $(".error3SIO").html(data.tgl_awal_sio);
                                $(".error4SIO").html(data.tgl_akhir_sio);
                                $(".error6fileSIO").html(data.filesio);
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat menyimpan data SIO, hubungi administrator";
                                $("#AddPerusahaan").remove();
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    });
                }
            });
        } else {
            $(".error2SIO").html(err_no_sio);
            $(".error3SIO").html(err_tgl_awal_sio);
            $(".error4SIO").html(err_tgl_akhir_sio);
            $(".error6fileSIO").html(err_filesio);
        }
    });

    $('#btnUploadFileKontrak').click(function () {
        let no_kontrak = htmlspecialchars($("#nokontrak").val());
        let tgl_awal_kontrak = $("#tglaktifkontrak").val();
        let tgl_akhir_kontrak = $("#tglakhirkontrak").val();
        let ket_kontrak = htmlspecialchars($("#ketkontrak").val());
        let filekontrak = $("#fileKontrak").val();
        const flkontrak = $('#fileKontrak').prop('files')[0];
        let perutama = $('#perUtamaKontrak').val();
        let persub = $('#perSubKontrak').val();
        let auth_m_per = htmlspecialchars($(".a67z34ssdh53b45jfasda4").text());
        let auth_parent = htmlspecialchars($(".b8f9s7sd7f7asj3h4j3k2j").text());
        let auth_per = htmlspecialchars($(".8ih3js7h3k8kj42b5n1m5n3").text());
        let auth_kontrak = $(".8jl23m67jsd9lasd0m2n34bn344").text();
        var token = $("#token").val();

        if (no_kontrak == "") {
            err_no_kontrak = "No. kontrak wajib diisi";
        } else {
            err_no_kontrak = "";
        }

        if (tgl_awal_kontrak == "") {
            err_tgl_awal_kontrak = "Tanggal aktif kontrak wajib diisi";
        } else {
            err_tgl_awal_kontrak = "";
        }

        if (tgl_akhir_kontrak == "") {
            err_tgl_akhir_kontrak = "Tanggal akhir kontrak wajib diisi";
        } else {
            err_tgl_akhir_kontrak = "";
        }

        if (filekontrak == "") {
            err_filekontrak = "File kontrak wajib diupload";
        } else {
            err_filekontrak = "";
        }

        if (err_no_kontrak == "" && err_tgl_awal_kontrak == "" && err_tgl_akhir_kontrak == "" && err_filekontrak == "") {
            swal({
                title: "Simpan Kontrak",
                text: "Yakin data Kontrak akan disimpan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan Kontrak',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    let formData = new FormData();
                    formData.append('flkontrak', flkontrak);
                    formData.append('filekontrak', filekontrak);
                    formData.append('no_kontrak', no_kontrak);
                    formData.append('tgl_awal_kontrak', tgl_awal_kontrak);
                    formData.append('tgl_akhir_kontrak', tgl_akhir_kontrak);
                    formData.append('ket_kontrak', ket_kontrak);
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('auth_parent', auth_parent);
                    formData.append('auth_per', auth_per);
                    formData.append('auth_kontrak', auth_kontrak);
                    formData.append('token', token);

                    $.LoadingOverlay("show");
                    $.ajax({
                        type: 'POST',
                        url: site_url + "struktur/addkontrak",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $('#imgKontrak').removeClass('d-none');
                                $('#colKontrak').collapse('hide');
                                $('#colPJO').collapse('hide');
                                $('#colSIO').collapse('hide');
                                $('#colIUJP').collapse('hide');
                                $('#perUtamaPJO').val(perutama);
                                $('#perSubPJO').val(persub);
                                $(".8jl23m67jsd9lasd0m2n34bn344").text(data.auth_kontrak);
                                $("#addBukaFileKontrak").attr("href", data.link)
                                $("#addBukaFileKontrak").removeAttr('disabled');
                                $("#addResetFileKontrak").removeAttr('disabled');
                                $(".error3kontrak").html('');
                                $(".error4kontrak").html('');
                                $(".error5kontrak").html('');
                                $(".error7kontrak").html('');
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            } else if (data.statusCode == 201) {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            } else {
                                $(".error3kontrak").html(data.no_kontrak);
                                $(".error4kontrak").html(data.tgl_awal_kontrak);
                                $(".error5kontrak").html(data.tgl_akhir_kontrak);
                                $(".error7kontrak").html(data.filekontrak);
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");

                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat menyimpan data kontrak, hubungi administrator";
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    });
                }
            });
        } else {
            $(".error3kontrak").html(err_no_kontrak);
            $(".error4kontrak").html(err_tgl_awal_kontrak);
            $(".error5kontrak").html(err_tgl_akhir_kontrak);
            $(".error7kontrak").html(err_filekontrak);
        }
    });

    $('#refreshPjo').click(function () {
        let auth_m_per = $(".a67z34ssdh53b45jfasda4").text();

        $.LoadingOverlay('show');
        $("#nopjo").val('');
        $("#tglaktifpjo").val('');
        $("#lokkerpjo").val('').trigger('change');
        $("#tglakhirpjo").val('');
        $("#lokkerpjo").val('');
        $("#ktppjo").val('');
        $("#nikpjo").val('');
        $("#namapjo").val('');
        $("#ketpjo").val('');
        $("#filePJO").val('');
        $(".error2pjo").html('');
        $(".error3pjo").html('');
        $(".error4pjo").html('');
        $(".error5pjo").html('');
        $(".error6pjo").html('');
        $(".error7pjo").html('');
        $(".error8pjo").html('');
        $(".error10pjo").html('');
        $(".8jl23m67jsd9lasd0m2n34bn344").text('');
        $("#idpjo").LoadingOverlay("show");
        $("#idpjo").load(site_url + "struktur/pjo?auth_m_per=" + auth_m_per + "&authtoken=" + $("#token").val());
        $("#idpjo").LoadingOverlay("hide");
        $.LoadingOverlay('hide');
    });

    $('#addSimpanPJO').click(function () {
        let no_pjo = htmlspecialchars($("#nopjo").val());
        let id_lokker = htmlspecialchars($("#lokkerpjo").val());
        let tgl_awal_pjo = $("#tglaktifpjo").val();
        let tgl_akhir_pjo = $("#tglakhirpjo").val();
        let ket_pjo = htmlspecialchars($("#ketpjo").val());
        let ktp_pjo = htmlspecialchars($("#ktppjo").val());
        let jml_ktp_pjo = $("#ktppjo").val().length;
        let nik_pjo = htmlspecialchars($("#nikpjo").val());
        let nama_pjo = htmlspecialchars($("#namapjo").val());
        let auth_kary = $(".8c9l1k4n9d09vm3mn43k8s834kk45").text();
        let filepjo = $("#filePJO").val();
        const flpjo = $('#filePJO').prop('files')[0];
        let perutama = $('#perUtamaPJO').val();
        let persub = $('#perSubPJO').val();
        let auth_m_per = htmlspecialchars($(".a67z34ssdh53b45jfasda4").text());
        let auth_parent = htmlspecialchars($(".b8f9s7sd7f7asj3h4j3k2j").text());
        let auth_per = htmlspecialchars($(".8ih3js7h3k8kj42b5n1m5n3").text());
        var token = $("#token").val();

        if (no_pjo == "") {
            err_no_pjo = "No. PJO wajib diisi";
        } else {
            err_no_pjo = "";
        }

        if (id_lokker == "") {
            err_id_lokker = "Lokasi kerja wajib dipilih";
        } else {
            err_id_lokker = "";
        }

        if (tgl_awal_pjo == "") {
            err_tgl_awal_pjo = "Tanggal aktif PJO wajib diisi";
        } else {
            err_tgl_awal_pjo = "";
        }

        if (tgl_akhir_pjo == "") {
            err_tgl_akhir_pjo = "Tanggal akhir PJO wajib diisi";
        } else {
            err_tgl_akhir_pjo = "";
        }

        if (filepjo == "") {
            err_filepjo = "File PJO wajib diupload";
        } else {
            err_filepjo = "";
        }

        if (ktp_pjo == "") {
            err_ktp_pjo = "KTP PJO wajib diisi";
        } else {
            if (jml_ktp_pjo < 16 || jml_ktp_pjo > 16) {
                err_ktp_pjo = "No. KTP harus 16 karakter";
            } else {
                err_ktp_pjo = "";
            }
        }

        if (nik_pjo == "") {
            err_nik_pjo = "NIK PJO wajib diisi";
        } else {
            err_nik_pjo = "";
        }

        if (nama_pjo == "") {
            err_nama_pjo = "Nama PJO wajib diisi";
        } else {
            err_nama_pjo = "";
        }

        if (err_no_pjo == "" && err_tgl_awal_pjo == "" && err_tgl_akhir_pjo == "" &&
            err_filepjo == "" && err_id_lokker == "" && err_ktp_pjo == "" &&
            err_nik_pjo == "" && err_nama_pjo == "") {
            swal({
                title: "Simpan PJO",
                text: "Yakin data PJO akan disimpan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan PJO',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    let formData = new FormData();
                    formData.append('flpjo', flpjo);
                    formData.append('filepjo', filepjo);
                    formData.append('no_pjo', no_pjo);
                    formData.append('id_lokker', id_lokker);
                    formData.append('tgl_awal_pjo', tgl_awal_pjo);
                    formData.append('tgl_akhir_pjo', tgl_akhir_pjo);
                    formData.append('ket_pjo', ket_pjo);
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('auth_parent', auth_parent);
                    formData.append('auth_per', auth_per);
                    formData.append('ktp_pjo', ktp_pjo);
                    formData.append('nik_pjo', nik_pjo);
                    formData.append('nama_pjo', nama_pjo);
                    formData.append('auth_kary', auth_kary);
                    formData.append('token', token);

                    $.ajax({
                        type: 'POST',
                        url: site_url + "struktur/addpjo",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#nopjo").val('');
                                $("#tglaktifpjo").val('');
                                $("#tglakhirpjo").val('');
                                $("#lokkerpjo").val('').trigger("change");
                                $("#ktppjo").val('');
                                $("#nikpjo").val('');
                                $("#namapjo").val('');
                                $("#ketpjo").val('');
                                $("#filePJO").val('');
                                $(".error2pjo").html('');
                                $(".error3pjo").html('');
                                $(".error4pjo").html('');
                                $(".error5pjo").html('');
                                $(".error6pjo").html('');
                                $(".error7pjo").html('');
                                $(".error8pjo").html('');
                                $(".error10pjo").html('');
                                $("#imgPJO").removeClass("d-none");
                                $(".8jl23m67jsd9lasd0m2n34bn344").text(data.auth_pjo);
                                $("#idpjo").LoadingOverlay("show");
                                $("#idpjo").load(site_url + "struktur/pjo?auth_m_per=" + auth_m_per);
                                $("#idpjo").LoadingOverlay("hide");
                                $.LoadingOverlay("hide");
                            } else if (data.statusCode == 201) {
                                swal("Error", data.pesan, "error");
                                $.LoadingOverlay("hide");
                            } else {
                                $(".error2pjo").html(data.no_pjo);
                                $(".error3pjo").html(data.id_lokker);
                                $(".error4pjo").html(data.tgl_awal_pjo);
                                $(".error5pjo").html(data.tgl_akhir_pjo);
                                $(".error6pjo").html(data.ktp_pjo);
                                $(".error7pjo").html(data.nik_pjo);
                                $(".error8pjo").html(data.nama_pjo);
                                $(".error10pjo").html(data.filepjo);
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");

                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat menyimpan data PJO, hubungi administrator";
                                $("#AddPerusahaan").remove();
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    });
                }
            });
        } else {
            $(".error2pjo").html(err_no_pjo);
            $(".error3pjo").html(err_id_lokker);
            $(".error4pjo").html(err_tgl_awal_pjo);
            $(".error5pjo").html(err_tgl_akhir_pjo);
            $(".error6pjo").html(err_ktp_pjo);
            $(".error7pjo").html(err_nik_pjo);
            $(".error8pjo").html(err_nama_pjo);
            $(".error10pjo").html(err_filepjo);
        }
    });

    $('#ktppjo').keyup(function (e) {
        let noktp = $('#ktppjo').val().trim();
        let jmlhrf = $('#ktppjo').val().length;

        if (noktp != "") {
            if (jmlhrf > 16) {
                $('.error6pjo').html('<p>No. KTP maksimal 16 karakter</p>');
            } else if (jmlhrf < 16) {
                $('.error6pjo').html('<p>No. KTP minimal 16 karakter</p>');
            } else {
                $('.error6pjo').html('');
            }
        }
    });

    $('#ktppjonew').keyup(function (e) {
        let noktp = $('#ktppjonew').val().trim();
        let jmlhrf = $('#ktppjonew').val().length;

        if (noktp != "") {
            if (jmlhrf > 16) {
                $('.errktppjonew').html('<p>No. KTP maksimal 16 karakter</p>');
            } else if (jmlhrf < 16) {
                $('.errktppjonew').html('<p>No. KTP minimal 16 karakter</p>');
            } else {
                $('.errktppjonew').html('');
            }
        }
    });

    $('#btnSimpanStrPerEdit').click(function () {
        let noktp = $('#namaPerEdit').val().trim();

        if (noktp != "") {
            if (jmlhrf > 16) {
                $('.error6pjo').html('<p>No. KTP maksimal 16 karakter</p>');
            } else if (jmlhrf < 16) {
                $('.error6pjo').html('<p>No. KTP minimal 16 karakter</p>');
            } else {
                $('.error6pjo').html('');
            }
        }
    });

    $('#tbmStruktur').DataTable({
        ordering: false,
        searching: true,
        paging: true
    });

    $('#tbmPJO').DataTable({
        ordering: false,
        searching: true,
        paging: true
    });

    $(document).on('click', '.btnDetailStrPer', function () {
        let auth_m_per = $(this).attr('id');
        var token = $("#token").val();

        if (auth_m_per != "") {
            $.ajax({
                type: "POST",
                url: site_url + "struktur/get_detail_m_per",
                data: {
                    auth_m_per: auth_m_per,
                    token: token,
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#mainCon").text(data.nama_perusahaan);
                        $("#subCon").text(data.nama_m_perusahaan + " | " + data.kode_perusahaan);
                        $("#noRK3L").text(data.stat_RK3L);
                        $("#noIUJP").text(data.no_izin_perusahaan);
                        $("#tglIUJP").text(data.tgl_izin);
                        $("#ketIUJP").text(data.ket_izin_perusahaan);
                        $("#noSIO").text(data.no_sio_perusahaan);
                        $("#tglSIO").text(data.tgl_sio);
                        $("#ketSIO").text(data.ket_sio);
                        $("#noKontrak").text(data.no_kontrak_perusahaan);
                        $("#tglKontrak").text(data.tgl_kontrak);
                        $("#ketKontrak").text(data.ket_kontrak_perusahaan);
                        $("#statStr").text(data.stat_m_perusahaan);
                        $("#tglEdit").text(data.tgl_edit);
                        $("#tglBuat").text(data.tgl_buat);
                        $("#namaBuat").text(data.nama_buat);
                        $("#tblPJODetail").load(site_url + "struktur/pjodetail?auth_m_per=" + auth_m_per);
                        $("#tblIUJPDetail").load(site_url + "struktur/iujpdetail?auth_m_per=" + auth_m_per);
                        $("#tblSIODetail").load(site_url + "struktur/siodetail?auth_m_per=" + auth_m_per);
                        $("#tblKontrakDetail").load(site_url + "struktur/kontrakdetail?auth_m_per=" + auth_m_per);
                        $('#mdlDetailStrPer').modal('show');
                    } else {
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");

                    if (thrownError != "") {
                        pesan = "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
                        $("#AddPerusahaan").remove();
                    } else {
                        pesan = "";
                    }

                    swal("Error", pesan, 'error');
                }
            })
        } else {
            swal("Error", "Data perusahaan tidak ditemukan", "error");
        }
    });

    $(document).on('click', '.btnRK3LStrPer', function () {
        let auth_m_per = $(this).attr('id');
        var token = $("#token").val();

        if (auth_m_per != "") {
            $.ajax({
                type: "POST",
                url: site_url + "struktur/get_detail_m_per",
                data: {
                    auth_m_per: auth_m_per,
                    token: token,
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#mainConRK3L").text(data.nama_perusahaan);
                        $(".7c7dj3hn7k2j7n8j3g7j34").text(auth_m_per);
                        $("#subConRK3L").text(data.nama_m_perusahaan + " | " + data.kode_perusahaan);
                        $('#mdlUploadRK3L').modal('show');
                    } else {
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");

                    if (thrownError != "") {
                        pesan = "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
                    } else {
                        pesan = "";
                    }

                    swal("Error", pesan, 'error');
                }
            })

        } else {
            swal("Error", "Data perusahaan tidak ditemukan", "error");
        }
    });

    $(document).on('click', '.btnIUJPStrPer', function () {
        let auth_m_per = $(this).attr('id');
        var token = $("#token").val();

        if (auth_m_per != "") {
            $.ajax({
                type: "POST",
                url: site_url + "struktur/get_detail_m_per",
                data: {
                    auth_m_per: auth_m_per,
                    token: token,
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#mainConIUJP").text(data.nama_perusahaan);
                        $("#subConIUJP").text(data.nama_m_perusahaan + " | " + data.kode_perusahaan);
                        $(".7k23n78j23b7l34c77s4f5h7").text(auth_m_per);
                        $('#noIUJPnew').val('');
                        $('#tglIUJPnew').val('');
                        $('#tglAkhirIUJPnew').val('');
                        $('#ketIUJP').val('');
                        $('#uploadIUJP').val('');
                        $(".errnoIUJP").html('');
                        $(".errtglIUJP").html('');
                        $(".errtglAkhirIUJP").html('');
                        $(".erruploadIUJP").html('');
                        $(".errsubcon").html('');
                        $('#mdlUploadIUJP').modal('show');
                    } else {
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");

                    if (thrownError != "") {
                        pesan = "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
                        $("#AddPerusahaan").remove();
                    } else {
                        pesan = "";
                    }

                    swal("Error", pesan, 'error');
                }
            })
        } else {
            swal("Error", "Data perusahaan tidak ditemukan", "error");
        }
    });

    $(document).on('click', '.btnSIOStrPer', function () {
        let auth_m_per = $(this).attr('id');
        var token = $("#token").val();

        if (auth_m_per != "") {
            $.ajax({
                type: "POST",
                url: site_url + "struktur/get_detail_m_per",
                data: {
                    auth_m_per: auth_m_per,
                    token: token,
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#mainConSIO").text(data.nama_perusahaan);
                        $(".errormsgsio").text('');
                        $(".errnosionew").text('');
                        $(".errtglawalsionew").text('');
                        $(".errtglakhirsionew").text('');
                        $(".erruploadsionew").text('');
                        $(".noSIO").text('');
                        $(".tglAktifSIO").text('');
                        $(".tglAkhirSIO").text('');
                        $(".ketSIO").text('');
                        $(".uploadSIO").text('');
                        $(".9k7j8h5g4h9j0k2g3b5g3g").text(auth_m_per);
                        $("#subConSIO").text(data.nama_m_perusahaan + " | " + data.kode_perusahaan);
                        $('#mdlUploadSIO').modal('show');
                    } else {
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");

                    if (thrownError != "") {
                        pesan = "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
                    } else {
                        pesan = "";
                    }

                    swal("Error", pesan, 'error');
                }
            })

        } else {
            swal("Error", "Data perusahaan tidak ditemukan", "error");
        }
    });
    $(document).on('click', '.btnKontrakStrPer', function () {
        let auth_m_per = $(this).attr('id');
        var token = $("#token").val();

        if (auth_m_per != "") {
            $.ajax({
                type: "POST",
                url: site_url + "struktur/get_detail_m_per",
                data: {
                    auth_m_per: auth_m_per,
                    token: token,
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#mainConKontrak").text(data.nama_perusahaan);
                        $("#subConKontrak").text(data.nama_m_perusahaan + " | " + data.kode_perusahaan);
                        $(".2e3r4t5y6u7i8o0o9i8u7y6t").text(auth_m_per);
                        $("#noKontraknew").val('');
                        $("#tglAktifKontrak").val('');
                        $("#tglAkhirKontrak").val('');
                        $("#ketKontrak").val('');
                        $("#uploadKontrak").val('');
                        $(".errnokontraknew").text('');
                        $(".errtglkontraknew").text('');
                        $(".errtglakhirkontraknew").text('');
                        $(".erruploadkontraknew").text('');
                        $('#mdlUploadKontrak').modal('show');
                    } else {
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");

                    if (thrownError != "") {
                        pesan = "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
                    } else {
                        pesan = "";
                    }

                    swal("Error", pesan, 'error');
                }
            })
        } else {
            swal("Error", "Data perusahaan tidak ditemukan", "error");
        }
    });
    $(document).on('click', '.btnPJOStrPer', function () {
        let auth_m_per = $(this).attr('id');
        var token = $("#token").val();

        if (auth_m_per != "") {
            $.ajax({
                type: "POST",
                url: site_url + "struktur/get_detail_m_per",
                data: {
                    auth_m_per: auth_m_per,
                    token: token,
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {

                        $.ajax({
                            type: "POST",
                            url: site_url + "struktur/get_lokasi_pjo",
                            data: {},
                            success: function (data) {
                                var data = JSON.parse(data);
                                $("#lokkerpjonew").html(data.pjoo);
                                $('#lokkerpjonew').select2({
                                    theme: 'bootstrap4',
                                    width: '100%',
                                    dropdownParent: $("#mdlUploadPJO")
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");

                                if (thrownError != "") {
                                    pesan = "Terjadi kesalahan saat load data lokasi kerja PJO, hubungi administrator";
                                } else {
                                    pesan = "";
                                }

                                swal("Error", pesan, 'error');
                            }
                        })

                        $("#mainConPJO").text(data.nama_perusahaan);
                        $("#subConPJO").text(data.nama_m_perusahaan + " | " + data.kode_perusahaan);
                        $(".2d3f4g5h6j7k8j6b4vec5v").text(auth_m_per);
                        $(".errnopjonew").text("");
                        $(".errtglaktifpjonew").text("");
                        $(".errtglakhirpjonew").text("");
                        $(".errlokkerpjonew").text("");
                        $(".ccv445bb66n7uj8ikmhg23fsdf").text("");
                        $(".errktppjonew").text("");
                        $(".errnikpjonew").text("");
                        $(".errnamapjonew").text("");
                        $("#nopjonew").val("");
                        $("#tglakhifpjonew").val("");
                        $("#tglakhirpjonew").val("");
                        $("#lokkerpjonew").val("").trigger("");
                        $("#caripjonew").val("");
                        $("#ktppjonew").val("");
                        $("#nikpjonew").val("");
                        $("#namapjonew").val("");
                        $("#ketpjonew").val("");
                        $("#filepjonew").val("");
                        $('#mdlUploadPJO').modal('show');
                    } else {
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");

                    if (thrownError != "") {
                        pesan = "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
                    } else {
                        pesan = "";
                    }

                    swal("Error", pesan, 'error');
                }
            })
        } else {
            swal("Error", "Data perusahaan tidak ditemukan", "error");
        }
    });
    $(document).on('click', '.editPJO', function () {
        let auth_pjo = $(this).attr('id');
        var token = $("#token").val();

        if (auth_pjo != "") {
            $.ajax({
                type: "POST",
                url: site_url + "struktur/get_detail_m_per",
                data: {
                    auth_m_per: auth_m_per,
                    token: token,
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#mainConPJO").text(data.nama_perusahaan);
                        $("#subConPJO").text(data.nama_m_perusahaan + " | " + data.kode_perusahaan);
                        $('#mdlUploadPJO').modal('show');
                    } else {
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (thrownError != "") {
                        pesan = "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
                        $("#AddPerusahaan").remove();
                    } else {
                        pesan = "";
                    }

                    swal("Error", pesan, 'error');
                }
            })
        } else {
            swal("Error", "Data PJO tidak ditemukan", "error");
        }
    });
    $(document).on('click', '.hapusPJO', function () {
        let auth_pjo = $(this).attr('id');
        let auth_m_per = $(".a67z34ssdh53b45jfasda4").text();
        var token = $("#token").val();

        if (auth_pjo != "") {
            swal({
                title: "Hapus PJO",
                text: "Yakin data PJO akan dihapus, data tidak dapat dikembalikan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus PJO',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: site_url + "struktur/hapus_pjo",
                        data: {
                            auth_pjo: auth_pjo,
                            auth_m_per: auth_m_per,
                            token: token,
                        },
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#idpjo").LoadingOverlay("show");
                                $("#idpjo").load(site_url + "struktur/pjo?auth_m_per=" + auth_m_per);
                                $("#idpjo").LoadingOverlay("hide");
                                if (data.jml_pjo == 0) {
                                    $("#imgPJO").addClass("d-none");
                                }
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            } else {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat menghapus PJO, hubungi administrator";
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    })
                }
            });
        } else {
            swal("Error", "Data PJO tidak ditemukan", "error");
        }
    });
    $(document).on('click', '.hpsStrPer', function () {
        let auth_m_per = $(this).attr('id');
        var token = $("#token").val();

        if (auth_m_per != "") {
            swal({
                title: "Hapus Perusahaan",
                text: "Yakin data perusahaan ini akan dihapus, data tidak dapat dikembalikan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Perusahaan',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: "POST",
                        url: site_url + "struktur/hapus_str_per",
                        data: {
                            auth_m_per: auth_m_per,
                            token: token,
                        },
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $.LoadingOverlay("hide");
                                window.location.href = site_url + "struktur";
                            } else {
                                $.LoadingOverlay("hide");
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat menghapus PJO, hubungi administrator";
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    })
                }
            });
        } else {
            swal("Error", "Data PJO tidak ditemukan", "error");
        }
    });
    $(document).on('click', '.editStrPer', function () {
        let auth_m_per = $(this).attr('id');
        var token = $("#token").val();

        if (auth_m_per != "") {
            $.ajax({
                type: "POST",
                url: site_url + "struktur/get_detail_m_per",
                data: {
                    auth_m_per: auth_m_per,
                    token: token,
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#jdlEditStrPer").text(" EDIT STRUKTUR PERUSAHAAN | " + data.nama_m_perusahaan);
                        $(".7uik4gsdm89okl23s6j4h3c").text(data.auth_m_per);
                        $("#mainConStrPerEdit").text(data.nama_perusahaan);
                        $("#namaPerEdit").val(data.nama_m_perusahaan);
                        $("#mdlEditStrPer").modal("show")
                    } else {
                        swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    if (thrownError != "") {
                        pesan = "Terjadi kesalahan saat load data struktur perusahaan, hubungi administrator";
                        $("#AddPerusahaan").remove();
                    } else {
                        pesan = "";
                    }

                    swal("Error", pesan, 'error');
                }
            })
        } else {
            swal("Error", "Data perusahaan tidak ditemukan", "error");
        }
    });

    $("#btnUpdateStrPerEdit").click(function () {
        let auth_m_per = $(".7uik4gsdm89okl23s6j4h3c").text();
        let namaper = $("#namaPerEdit").val();
        var token = $("#token").val();

        if (auth_m_per != "") {
            if (namaper != "") {
                swal({
                    title: "Ganti Nama Perusahaan",
                    text: "Yakin nama perusahaan ini akan diganti, data tidak dapat dikembalikan?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#36c6d3',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Ganti',
                    cancelButtonText: 'Batalkan'
                }).then(function (result) {
                    if (result.value) {
                        $.LoadingOverlay("show");
                        $.ajax({
                            type: "POST",
                            url: site_url + "struktur/update_str_nama_per",
                            data: {
                                auth_m_per: auth_m_per,
                                namaper: namaper,
                                token: token,
                            },
                            success: function (data) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    $("#mdlEditStrPer").modal("hide");
                                    $.LoadingOverlay("hide");
                                    window.location.href = site_url + "struktur";
                                } else {
                                    swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                    $.LoadingOverlay("hide");
                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");

                                if (thrownError != "") {
                                    pesan = "Terjadi kesalahan saat meng-update nama perusahaan, hubungi administrator";
                                } else {
                                    pesan = "";
                                }

                                swal("Error", pesan, 'error');
                            }
                        })
                    }
                });
            } else {
                $(".errornamaperedit").text("Nama perusahaan wajib diisi");
            }
        } else {
            swal("Error", "Data perusahaan tidak ditemukan", "error");
        }
    });

    $("#btnUploadRK3L").click(function () {
        let auth_m_per = $(".7c7dj3hn7k2j7n8j3g7j34").text();
        let filerk3l = $("#uploadRK3L").val();
        const flrk3l = $('#uploadRK3L').prop('files')[0];
        var token = $("#token").val();

        if (auth_m_per == "") {
            err_auth_m_per = "Perusahaan tidak ditemukan";
        } else {
            err_auth_m_per = "";
        }

        if (filerk3l == "") {
            err_filerk3l = "RK3L wajib diupload";
        } else {
            err_filerk3l = "";
        }

        if (err_filerk3l == "" && err_auth_m_per == "") {
            swal({
                title: "Upload Data RK3L",
                text: "Yakin data RK3L sudah benar?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Upload file',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    let formData = new FormData();
                    formData.append('flrk3l', flrk3l);
                    formData.append('filerk3l', filerk3l);
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('token', token);

                    $.ajax({
                        type: "POST",
                        url: site_url + "struktur/addrk3l",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $.LoadingOverlay("hide");
                                $("#uploadRK3L").val('');
                                $(".erruploadRK3L").text('');
                                $("#mdlUploadRK3L").modal('hide')
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                swal("Berhasil", "RK3L berhasil di-upload", "success");
                                // location.reload();
                            } else if (data.statusCode == 201) {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            } else {
                                $(".erruploadRK3L").html(data.filerk3l);
                                $.LoadingOverlay("hide");
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat upload data RK3L, hubungi administrator";
                                $("#AddPerusahaan").remove();
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    })
                }
            });
        } else {
            $(".erruploadRK3L").html(err_filerk3l);
            if (err_auth_m_per != "") {
                $(".errormsgRK3L").removeClass('d-none');
                $(".errormsgRK3L").addClass('alert-danger');
                $(".errormsgRK3L").html(err_auth_m_per);
            }

            $(".errormsgRK3L ").fadeTo(3000, 500).slideUp(500, function () {
                $(".errormsgRK3L ").slideUp(500);
                $(".errormsgRK3L ").addClass("d-none");
            });
        }
    });

    $("#btnUploadIUJP").click(function () {
        let no_iujp = htmlspecialchars($("#noIUJPnew").val());
        let tgl_awal_iujp = $("#tglIUJPnew").val();
        let tgl_akhir_iujp = $("#tglAkhirIUJPnew").val();
        let ket_iujp = htmlspecialchars($("#ketIUJP").val());
        let fileiujp = $("#uploadIUJP").val();
        const fliujp = $('#uploadIUJP').prop('files')[0];
        let auth_m_per = htmlspecialchars($(".7k23n78j23b7l34c77s4f5h7").text());
        var token = $("#token").val();

        if (auth_m_per == "") {
            err_auth_m_per = "Perusahaan tidak ditemukan";
        } else {
            err_auth_m_per = "";
        }

        if (no_iujp == "") {
            err_no_iujp = "No. IUJP wajib diisi";
        } else {
            err_no_iujp = "";
        }

        if (tgl_awal_iujp == "") {
            err_tgl_awal_iujp = "Tanggal aktif IUJP wajib diisi";
        } else {
            err_tgl_awal_iujp = "";
        }

        if (tgl_akhir_iujp == "") {
            err_tgl_akhir_iujp = "Tanggal akhir IUJP wajib diisi";
        } else {
            err_tgl_akhir_iujp = "";
        }

        if (fileiujp == "") {
            err_fileiujp = "File IUJP wajib diupload";
        } else {
            err_fileiujp = "";
        }

        if (err_no_iujp == "" && err_tgl_awal_iujp == "" && err_tgl_akhir_iujp == "" && err_fileiujp == "") {
            swal({
                title: "Simpan IUJP",
                text: "Yakin data IUJP akan disimpan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan IUJP',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    let formData = new FormData();
                    formData.append('fliujp', fliujp);
                    formData.append('fileiujp', fileiujp);
                    formData.append('no_iujp', no_iujp);
                    formData.append('tgl_awal_iujp', tgl_awal_iujp);
                    formData.append('tgl_akhir_iujp', tgl_akhir_iujp);
                    formData.append('ket_iujp', ket_iujp);
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('token', token);

                    $.LoadingOverlay("show");
                    $.ajax({
                        type: 'POST',
                        url: site_url + "struktur/add_iujp",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $('.7k23n78j23b7l34c77s4f5h7').text('');
                                $('#noIUJP').val('');
                                $('#tglIUJP').val('');
                                $('#tglAkhirIUJP').val('');
                                $('#ketIUJP').val('');
                                $('#uploadIUJP').val('');
                                $(".errnoIUJP").html('');
                                $(".errtglIUJP").html('');
                                $(".errtglAkhirIUJP").html('');
                                $(".erruploadIUJP").html('');
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                                // location.reload();
                            } else if (data.statusCode == 201) {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            } else {
                                $(".errsubcon").html(data.auth_m_per);
                                $(".errnoIUJP").html(data.no_iujp);
                                $(".errtglIUJP").html(data.tgl_awal_iujp);
                                $(".errtglAkhirIUJP").html(data.tgl_akhir_iujp);
                                $(".erruploadIUJP").html(data.fileiujp);
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat menyimpan data IUJP, hubungi administrator";
                                $("#addIUJP").remove();
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    });
                }
            });
        } else {
            $(".errsubcon").html(err_auth_m_per);
            $(".errnoIUJP").html(err_no_iujp);
            $(".errtglIUJP").html(err_tgl_awal_iujp);
            $(".errtglAkhirIUJP").html(err_tgl_akhir_iujp);
            $(".erruploadIUJP").html(err_fileiujp);
        }


    });

    $("#btnUploadSIO").click(function () {
        let no_sio = htmlspecialchars($("#noSionew").val());
        let tgl_awal_sio = $("#tglAktifSIO").val();
        let tgl_akhir_sio = $("#tglAkhirSIO").val();
        let ket_sio = htmlspecialchars($("#ketSIO").val());
        let filesio = $("#uploadSIO").val();
        const flsio = $('#uploadSIO').prop('files')[0];
        let auth_m_per = htmlspecialchars($(".9k7j8h5g4h9j0k2g3b5g3g").text());
        var token = $("#token").val();

        if (no_sio == "") {
            err_no_sio = "No. SIO wajib diisi";
        } else {
            err_no_sio = "";
        }

        if (tgl_awal_sio == "") {
            err_tgl_awal_sio = "Tanggal aktif SIO wajib diisi";
        } else {
            err_tgl_awal_sio = "";
        }

        if (tgl_akhir_sio == "") {
            err_tgl_akhir_sio = "Tanggal akhir SIO wajib diisi";
        } else {
            err_tgl_akhir_sio = "";
        }

        if (filesio == "") {
            err_filesio = "File SIO wajib diupload";
        } else {
            err_filesio = "";
        }

        if (err_no_sio == "" && err_tgl_awal_sio == "" && err_tgl_akhir_sio == "" && err_filesio == "") {
            swal({
                title: "Simpan SIO",
                text: "Yakin data SIO akan disimpan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan SIO',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    let formData = new FormData();
                    formData.append('flsio', flsio);
                    formData.append('filesio', filesio);
                    formData.append('no_sio', no_sio);
                    formData.append('tgl_awal_sio', tgl_awal_sio);
                    formData.append('tgl_akhir_sio', tgl_akhir_sio);
                    formData.append('ket_sio', ket_sio);
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('token', token);

                    $.LoadingOverlay("show");
                    $.ajax({
                        type: 'POST',
                        url: site_url + "struktur/add_sio",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $(".9k7j8h5g4h9j0k2g3b5g3g").text('');
                                $(".errnosionew").html('');
                                $(".errtglawalsionew").html('');
                                $(".errtglakhirsionew").html('');
                                $(".erruploadsionew").html('');
                                $("#noSIO").val('');
                                $("#tglAktifSIO").val('');
                                $("#tglAkhirSIO").val('');
                                $("#ketSIO").val('');
                                $("#uploadSIO").val('');
                                $.LoadingOverlay("hide");
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                // location.reload();
                            } else if (data.statusCode == 201) {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            } else {
                                $(".errnosionew").html(data.no_sio);
                                $(".errtglawalsionew").html(data.tgl_awal_sio);
                                $(".errtglakhirsionew").html(data.tgl_akhir_sio);
                                $(".erruploadsionew").html(data.filesio);
                                $.LoadingOverlay("hide");
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat menyimpan data SIO, hubungi administrator";
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    });
                }
            });
        } else {
            $(".errnosionew").html(err_no_sio);
            $(".errtglawalsionew").html(err_tgl_awal_sio);
            $(".errtglakhirsionew").html(err_tgl_akhir_sio);
            $(".erruploadsionew").html(err_filesio);
        }
    });

    $("#btnUploadKontrak").click(function () {
        let no_kontrak = htmlspecialchars($("#noKontraknew").val());
        let tgl_awal_kontrak = $("#tglAktifKontrak").val();
        let tgl_akhir_kontrak = $("#tglAkhirKontrak").val();
        let ket_kontrak = htmlspecialchars($("#ketKontrak").val());
        let filekontrak = $("#uploadKontrak").val();
        const flkontrak = $('#uploadKontrak').prop('files')[0];
        let auth_m_per = htmlspecialchars($(".2e3r4t5y6u7i8o0o9i8u7y6t").text());
        var token = $("#token").val();

        if (no_kontrak == "") {
            err_no_kontrak = "No. kontrak wajib diisi";
        } else {
            err_no_kontrak = "";
        }

        if (tgl_awal_kontrak == "") {
            err_tgl_awal_kontrak = "Tanggal aktif kontrak wajib diisi";
        } else {
            err_tgl_awal_kontrak = "";
        }

        if (tgl_akhir_kontrak == "") {
            err_tgl_akhir_kontrak = "Tanggal akhir kontrak wajib diisi";
        } else {
            err_tgl_akhir_kontrak = "";
        }

        if (filekontrak == "") {
            err_filekontrak = "File kontrak wajib diupload";
        } else {
            err_filekontrak = "";
        }

        if (err_no_kontrak == "" && err_tgl_awal_kontrak == "" && err_tgl_akhir_kontrak == "" && err_filekontrak == "") {
            swal({
                title: "Simpan Kontrak",
                text: "Yakin data Kontrak akan disimpan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan Kontrak',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    let formData = new FormData();
                    formData.append('flkontrak', flkontrak);
                    formData.append('filekontrak', filekontrak);
                    formData.append('no_kontrak', no_kontrak);
                    formData.append('tgl_awal_kontrak', tgl_awal_kontrak);
                    formData.append('tgl_akhir_kontrak', tgl_akhir_kontrak);
                    formData.append('ket_kontrak', ket_kontrak);
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('token', token);
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: 'POST',
                        url: site_url + "struktur/add_kontrak",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $.LoadingOverlay("hide");
                                $(".2e3r4t5y6u7i8o0o9i8u7y6t").text('');
                                $("#noKontraknew").val('');
                                $("#tglAktifKontrak").val('');
                                $("#tglAkhirKontrak").val('');
                                $("#ketKontrak").val('');
                                $("#uploadKontrak").val('');
                                $(".errnokontraknew").text('');
                                $(".errtglkontraknew").text('');
                                $(".errtglakhirkontraknew").text('');
                                $(".erruploadkontraknew").text('');
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                // location.reload();
                            } else if (data.statusCode == 201) {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            } else {
                                $(".errnokontraknew").html(data.no_kontrak);
                                $(".errtglkontraknew").html(data.tgl_awal_kontrak);
                                $(".errtglakhirkontraknew").html(data.tgl_akhir_kontrak);
                                $(".erruploadkontraknew").html(data.filekontrak);
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");

                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat menyimpan data kontrak, hubungi administrator";
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    });
                }
            });
        } else {
            $(".errnokontraknew").html(err_no_kontrak);
            $(".errtglkontraknew").html(err_tgl_awal_kontrak);
            $(".errtglakhirkontraknew").html(err_tgl_akhir_kontrak);
            $(".erruploadkontraknew").html(err_filekontrak);
        }
    });

    $('#addSimpanPJOnew').click(function () {
        let no_pjo = htmlspecialchars($("#nopjonew").val());
        let id_lokker = htmlspecialchars($("#lokkerpjonew").val());
        let tgl_awal_pjo = $("#tglakhifpjonew").val();
        let tgl_akhir_pjo = $("#tglakhirpjonew").val();
        let ket_pjo = htmlspecialchars($("#ketpjonew").val());
        let ktp_pjo = htmlspecialchars($("#ktppjonew").val());
        let jml_ktp_pjo = $("#ktppjonew").val().length;
        let nik_pjo = htmlspecialchars($("#nikpjonew").val());
        let nama_pjo = htmlspecialchars($("#namapjonew").val());
        let auth_kary = $(".ccv445bb66n7uj8ikmhg23fsdf").text();
        let filepjo = $("#filepjonew").val();
        const flpjo = $('#filepjonew').prop('files')[0];
        let auth_m_per = $(".2d3f4g5h6j7k8j6b4vec5v").text()
        var token = $("#token").val();

        if (no_pjo == "") {
            err_no_pjo = "No. PJO wajib diisi";
        } else {
            err_no_pjo = "";
        }

        if (id_lokker == "") {
            err_id_lokker = "Lokasi kerja wajib dipilih";
        } else {
            err_id_lokker = "";
        }

        if (tgl_awal_pjo == "") {
            err_tgl_awal_pjo = "Tanggal aktif PJO wajib diisi";
        } else {
            err_tgl_awal_pjo = "";
        }

        if (tgl_akhir_pjo == "") {
            err_tgl_akhir_pjo = "Tanggal akhir PJO wajib diisi";
        } else {
            err_tgl_akhir_pjo = "";
        }

        if (filepjo == "") {
            err_filepjo = "File PJO wajib diupload";
        } else {
            err_filepjo = "";
        }

        if (ktp_pjo == "") {
            err_ktp_pjo = "KTP PJO wajib diisi";
        } else {
            if (jml_ktp_pjo < 16 || jml_ktp_pjo > 16) {
                err_ktp_pjo = "No. KTP harus 16 karakter";
            } else {
                err_ktp_pjo = "";
            }
        }

        if (nik_pjo == "") {
            err_nik_pjo = "NIK PJO wajib diisi";
        } else {
            err_nik_pjo = "";
        }

        if (nama_pjo == "") {
            err_nama_pjo = "Nama PJO wajib diisi";
        } else {
            err_nama_pjo = "";
        }

        if (err_no_pjo == "" && err_tgl_awal_pjo == "" && err_tgl_akhir_pjo == "" &&
            err_filepjo == "" && err_id_lokker == "" && err_ktp_pjo == "" &&
            err_nik_pjo == "" && err_nama_pjo == "") {
            swal({
                title: "Simpan PJO",
                text: "Yakin data PJO akan disimpan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan PJO',
                cancelButtonText: 'Batalkan'
            }).then(function (result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    let formData = new FormData();
                    formData.append('flpjo', flpjo);
                    formData.append('filepjo', filepjo);
                    formData.append('no_pjo', no_pjo);
                    formData.append('id_lokker', id_lokker);
                    formData.append('tgl_awal_pjo', tgl_awal_pjo);
                    formData.append('tgl_akhir_pjo', tgl_akhir_pjo);
                    formData.append('ket_pjo', ket_pjo);
                    formData.append('auth_m_per', auth_m_per);
                    formData.append('ktp_pjo', ktp_pjo);
                    formData.append('nik_pjo', nik_pjo);
                    formData.append('nama_pjo', nama_pjo);
                    formData.append('auth_kary', auth_kary);
                    formData.append('token', token);

                    $.ajax({
                        type: 'POST',
                        url: site_url + "struktur/add_pjo",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $("#mdlUploadPJO").modal('hide');
                                $(".2d3f4g5h6j7k8j6b4vec5v").text('');
                                $(".ccv445bb66n7uj8ikmhg23fsdf").text('');
                                $.LoadingOverlay("hide");
                                // location.reload();
                            } else if (data.statusCode == 201) {
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            } else {
                                $(".errnopjonew").html(data.no_pjo);
                                $(".errlokkerpjonew").html(data.id_lokker);
                                $(".errtglaktifpjonew").html(data.tgl_awal_pjo);
                                $(".errtglakhirpjonew").html(data.tgl_akhir_pjo);
                                $(".errktppjonew").html(data.ktp_pjo);
                                $(".errnikpjonew").html(data.nik_pjo);
                                $(".errnamapjonew").html(data.nama_pjo);
                                $(".errfilepjonew").html(data.filepjo);
                                swal(data.kode_pesan, data.pesan, data.tipe_pesan);
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            if (thrownError != "") {
                                pesan = "Terjadi kesalahan saat menyimpan data kontrak, hubungi administrator";
                            } else {
                                pesan = "";
                            }

                            swal("Error", pesan, 'error');
                        }
                    });
                }
            });
        } else {
            $(".errnopjonew").html(err_no_pjo);
            $(".errlokkerpjonew").html(err_id_lokker);
            $(".errtglaktifpjonew").html(err_tgl_awal_pjo);
            $(".errtglakhirpjonew").html(err_tgl_akhir_pjo);
            $(".errktppjonew").html(err_ktp_pjo);
            $(".errnikpjonew").html(err_nik_pjo);
            $(".errnamapjonew").html(err_nama_pjo);
            $(".errfilepjonew").html(err_filepjo);
        }
    });

});