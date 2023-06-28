    $(document).ready(function() {
        $("#logout").click(function() {
            $("#logoutmdl").modal("show");
        });

        let auth_per_old = '';
        $("#colPersonal").collapse("show");
        $('#noNPWP').inputmask("99.999.999.9-999.999");
        $("#idizintambang").load(site_url+"izin_tambang/izin_tambang?auth_izin=" + 0);
        $("#idsertifikat").load(site_url+"karyawan/sertifikasi?auth_person=" + 0);
        $("#idvaksin").load(site_url+"karyawan/vaksin?auth_person=" + 0);

        $(".suksesalrt").fadeTo(4000, 500).slideUp(500, function() {
            $(".suksesalrt").slideUp(500);
            $(".suksesalrt").addClass("d-none");
        });

        $("#perJenisData").change(function(){
            let prs = $("#perJenisData").val();
            $("#tbmKaryawan").LoadingOverlay("show");
            $('#tbmKaryawan').DataTable().destroy();
            tbKary(prs);
        });

        tbKary();
        $('#perJenisData').select2({
            theme: 'bootstrap4'
        });
        $('#provData').select2({
            theme: 'bootstrap4'
        });
        $('#kotaData').select2({
            theme: 'bootstrap4'
        });
        $('#kecData').select2({
            theme: 'bootstrap4'
        });
        $('#kelData').select2({
            theme: 'bootstrap4'
        });
        $('#addPerKary').select2({
            theme: 'bootstrap4',
            dropdownParent: $('#addkry')
        });
        $('#addDepartKary').select2({
            theme: 'bootstrap4'
        });
        $('#addPosisiKary').select2({
            theme: 'bootstrap4'
        });
        $('#addKlasifikasiKary').select2({
            theme: 'bootstrap4'
        });
        $("#addPOHKary").select2({
            theme: 'bootstrap4'
        });
        $("#addLokterimaKary").select2({
            theme: 'bootstrap4'
        });
        $("#addLokasiKerja").select2({
            theme: 'bootstrap4'
        });
        $('#addLevelKary').select2({
            theme: 'bootstrap4'
        });
        $('#addStatusResidence').select2({
            theme: 'bootstrap4'
        });
        $('#addTipeKaryawan').select2({
            theme: 'bootstrap4'
        });
        $('#statPernikahan').select2({
            theme: 'bootstrap4'
        });
        $('#addagama').select2({
            theme: 'bootstrap4'
        });
        $('#kewarganegaraan').select2({
            theme: 'bootstrap4'
        });
        $('#jenisKelamin').select2({
            theme: 'bootstrap4'
        });
        $('#addJenisSIM').select2({
            theme: 'bootstrap4'
        });
        $('#jenisUnitSimper').select2({
            dropdownParent: $('#mdlunitsimper'),
            theme: 'bootstrap4'
        });
        $('#tipeAksesUnit').select2({
            dropdownParent: $('#mdlunitsimper'),
            theme: 'bootstrap4'
        });
        $('#jenisSertifikasi').select2({
            theme: 'bootstrap4'
        });

        $('#jenisSertifikasiEdit').select2({
            theme: 'bootstrap4',
            dropdownParent: $('#mdleditsertifikat')
        });

        window.addEventListener('resize', function(event) {
            $('#addJenisSIM').select2({
                theme: 'bootstrap4'
            });
            $('#perJenisData').select2({
                theme: 'bootstrap4'
            });
            $('#provData').select2({
                theme: 'bootstrap4'
            });
            $('#kotaData').select2({
                theme: 'bootstrap4'
            });
            $('#kecData').select2({
                theme: 'bootstrap4'
            });
            $('#kelData').select2({
                theme: 'bootstrap4'
            });
            $('#addPerKary').select2({
                theme: 'bootstrap4'
            });
            $('#addDepartKary').select2({
                theme: 'bootstrap4'
            });
            $('#addPosisiKary').select2({
                theme: 'bootstrap4'
            });
            $('#addKlasifikasiKary').select2({
                theme: 'bootstrap4'
            });
            $("#addPOHKary").select2({
                theme: 'bootstrap4'
            });
            $("#addLokterimaKary").select2({
                theme: 'bootstrap4'
            });
            $("#addLokasiKerja").select2({
                theme: 'bootstrap4'
            });
            $('#addLevelKary').select2({
                theme: 'bootstrap4'
            });
            $('#addStatusResidence').select2({
                theme: 'bootstrap4'
            });
            $('#addJenisKaryawan').select2({
                theme: 'bootstrap4'
            });
            $('#statPernikahan').select2({
                theme: 'bootstrap4'
            });
            $('#addagama').select2({
                theme: 'bootstrap4'
            });
            $('#kewarganegaraan').select2({
                theme: 'bootstrap4'
            });
            $('#jenisKelamin').select2({
                theme: 'bootstrap4'
            });
            $('#jenisUnitSimper').select2({
                dropdownParent: $('#mdlunitsimper'),
                theme: 'bootstrap4'
            });
            $('#tipeAksesUnit').select2({
                dropdownParent: $('#mdlunitsimper'),
                theme: 'bootstrap4'
            });
            $('#jenisSertifikasi').select2({
                theme: 'bootstrap4'
            });
            $('#jenisSertifikasiEdit').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#mdleditsertifikat')
            });

        }, true);
        $("#addUnitSIMPER").click(function() {
            let jenisizin = $("#addJenisIzin").val();

            if (jenisizin == "SP") {
                let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
                let jenisizin = $("#addJenisIzin").val();
                let noreg = $("#addNoReg").val();
                let tglexp = $("#addTglExp").val();
                let jenissim = $("#addJenisSIM").val();
                let tglexpsim = $("#addTglExpSIM").val();
                let jenisunit = $("#jenisUnitSimper").val();
                let tipeakses = $("#tipeAksesUnit").val();

                if (auth_kary == "") {
                    $(".errormsgizin").removeClass('d-none');
                    $(".errormsgizin").removeClass('alert-info');
                    $(".errormsgizin").addClass('alert-danger');
                    $(".errormsgizin").html("Data karyawan tidak ditemukan");
                }

                if (jenisizin == "") {
                    errjenisizin = "Jenis izin wajib dipilih";
                } else {
                    errjenisizin = "";
                }

                if (noreg == "") {
                    errnoreg = "No. Registrasi wajib diisi";
                } else {
                    errnoreg = "";
                }

                if (jenisizin == "SP") {
                    if (jenissim == "") {
                        errjenissim = "Jenis SIM wajib dipilih";
                    } else {
                        errjenissim = "";
                    }
                } else {
                    errjenissim = "";
                }

                if (tglexpsim == "") {
                    errtglexpsim = "Tanggal expired SIM wajib diisi";
                } else {
                    errtglexpsim = "";
                }

                if (tglexp == "") {
                    errtglexp = "Tanggal expired izin wajib diisi";
                } else {
                    errtglexp = "";
                }

                if (errjenisizin == "" && errnoreg == "" && errtglexp == "" && errjenissim == "" && errtglexpsim == "") {
                    $("#mdlunitsimper").modal("show");
                } else {
                    $(".erroraddJenisIzin").html(errjenisizin);
                    $(".erroraddNoReg").html(errnoreg);
                    $(".erroraddJenisSIM").html(errjenissim);
                    $(".erroraddTglExpSIM").html(errtglexpsim);
                    $(".erroraddTglExp").html(errtglexp);
                }
            }
        });

        function aktifPersonal() {
            $("#noKTP").removeAttr('disabled');
            $("#namaLengkap").removeAttr('disabled');
            $("#alamatKTP").removeAttr('disabled');
            $("#rtKTP").removeAttr('disabled');
            $("#rwKTP").removeAttr('disabled');
            $("#provData").removeAttr('disabled');
            $("#kotaData").removeAttr('disabled');
            $("#kecData").removeAttr('disabled');
            $("#kelData").removeAttr('disabled');
            $("#tempatLahir").removeAttr('disabled');
            $("#tanggalLahir").removeAttr('disabled');
            $("#statPernikahan").removeAttr('disabled');
            $("#addagama").removeAttr('disabled');
            $("#kewarganegaraan").removeAttr('disabled');
            $("#jenisKelamin").removeAttr('disabled');
            $("#emailPribadi").removeAttr('disabled');
            $("#noTelp").removeAttr('disabled');
            $("#noBPJSTK").removeAttr('disabled');
            $("#noBPJSKES").removeAttr('disabled');
            $("#noKK").removeAttr('disabled');
            $("#namaIbu").removeAttr('disabled');
            $('#noNPWP').removeAttr('disabled');
            $('#pendidikanTerakhir').removeAttr('disabled');
            $('#refreshProv').removeAttr('disabled');
            $('#refreshKota').removeAttr('disabled');
            $('#refreshKec').removeAttr('disabled');
            $('#refreshKel').removeAttr('disabled');
            $('#refreshStatNikah').removeAttr('disabled');
            $('#refreshDidik').removeAttr('disabled');
            $('#addSimpanPersonal').removeClass('disabled');
        }

        function nonAktifPersonal() {
            $("#noKTP").attr('disabled', true);
            $("#namaLengkap").attr('disabled', true);
            $("#alamatKTP").attr('disabled', true);
            $("#rtKTP").attr('disabled', true);
            $("#rwKTP").attr('disabled', true);
            $("#provData").attr('disabled', true);
            $("#kotaData").attr('disabled', true);
            $("#kecData").attr('disabled', true);
            $("#kelData").attr('disabled', true);
            $("#tempatLahir").attr('disabled', true);
            $("#tanggalLahir").attr('disabled', true);
            $("#statPernikahan").attr('disabled', true);
            $("#addagama").attr('disabled', true);
            $("#kewarganegaraan").attr('disabled', true);
            $("#jenisKelamin").attr('disabled', true);
            $("#emailPribadi").attr('disabled', true);
            $("#noTelp").attr('disabled', true);
            $("#noBPJSTK").attr('disabled', true);
            $("#noBPJSKES").attr('disabled', true);
            $("#noKK").attr('disabled', true);
            $("#namaIbu").attr('disabled', true);
            $('#noNPWP').attr('disabled', true);
            $('#pendidikanTerakhir').attr('disabled', true);
            $('#refreshProv').attr('disabled', true);
            $('#refreshKota').attr('disabled', true);
            $('#refreshKec').attr('disabled', true);
            $('#refreshKel').attr('disabled', true);
            $('#refreshStatNikah').attr('disabled', true);
            $('#refreshDidik').attr('disabled', true);
            $('#addSimpanPersonal').addClass('disabled');
        }

        function aktifKaryawan() {
            $("#addPerKary").removeAttr('disabled');
            $("#addNIKKary").removeAttr('disabled');
            $("#addDepartKary").removeAttr('disabled');
            $("#addPosisiKary").removeAttr('disabled');
            $("#addDOH").removeAttr('disabled');
            $("#addTanggalAktif").removeAttr('disabled');
            $("#addLokasiKerja").removeAttr('disabled');
            $("#addLokterimaKary").removeAttr('disabled');
            $("#addPOHKary").removeAttr('disabled');
            $("#addKlasifikasiKary").removeAttr('disabled');
            $("#addJenisKaryawan").removeAttr('disabled');
            $("#addLevelKary").removeAttr('disabled');
            $("#addStatusResidence").removeAttr('disabled');
            $("#addStatusKaryawan").removeAttr('disabled');
            $("#addTipeKaryawan").removeAttr('disabled');
            $("#addEmailKantor").removeAttr('disabled');
            $("#addTanggalPermanen").removeAttr('disabled');
            $("#addTanggalKontrakAwal").removeAttr('disabled');
            $("#addTanggalKontrakAkhir").removeAttr('disabled');
            $("#refreshDepart").removeAttr('disabled');
            $("#refreshPosisi").removeAttr('disabled');
            $("#refreshKlasifikasi").removeAttr('disabled');
            $("#refreshTipe").removeAttr('disabled');
            $("#refreshLevel").removeAttr('disabled');
            $("#refreshPOH").removeAttr('disabled');
            $("#refreshLokterima").removeAttr('disabled');
            $("#refreshLokker").removeAttr('disabled');
            $("#refreshResidence").removeAttr('disabled');
            $("#refreshstatkaryawan").removeAttr('disabled');
            $('#addKembaliPekerjaan').removeClass('disabled');
            $('#addSimpanPekerjaan').removeClass('disabled');
        }

        function nonAktifKaryawan() {
            $("#addPerKary").attr('disabled', true);
            $("#addNIKKary").attr('disabled', true);
            $("#addDepartKary").attr('disabled', true);
            $("#addPosisiKary").attr('disabled', true);
            $("#addDOH").attr('disabled', true);
            $("#addTanggalAktif").attr('disabled', true);
            $("#addLokasiKerja").attr('disabled', true);
            $("#addLokterimaKary").attr('disabled', true);
            $("#addPOHKary").attr('disabled', true);
            $("#addKlasifikasiKary").attr('disabled', true);
            $("#addJenisKaryawan").attr('disabled', true);
            $("#addLevelKary").attr('disabled', true);
            $("#addStatusResidence").attr('disabled', true);
            $("#addStatusKaryawan").attr('disabled', true);
            $("#addTipeKaryawan").attr('disabled', true);
            $("#addEmailKantor").attr('disabled', true);
            $("#addTanggalPermanen").attr('disabled', true);
            $("#addTanggalKontrakAwal").attr('disabled', true);
            $("#addTanggalKontrakAkhir").attr('disabled', true);
            $("#refreshDepart").attr('disabled', true);
            $("#refreshPosisi").attr('disabled', true);
            $("#refreshKlasifikasi").attr('disabled', true);
            $("#refreshTipe").attr('disabled', true);
            $("#refreshLevel").attr('disabled', true);
            $("#refreshPOH").attr('disabled', true);
            $("#refreshLokterima").attr('disabled', true);
            $("#refreshLokker").attr('disabled', true);
            $("#refreshResidence").attr('disabled', true);
            $("#refreshstatkaryawan").attr('disabled', true);
            $('#addKembaliPekerjaan').addClass('disabled');
            $('#addSimpanPekerjaan').addClass('disabled');
        }

        function aktifSIMPER() {
            $("#addJenisIzin").removeAttr('disabled');
            $("#addNoReg").removeAttr('disabled');
            $("#addTglExp").removeAttr('disabled');
            $("#addJenisSIM").removeAttr('disabled');
            $("#addTglExpSIM").removeAttr('disabled');
            $("#addKembaliIzinUnit").removeClass('disabled');
            $("#addSimpanIzinUnit").removeClass('disabled');
        }

        function nonaktifSIMPER() {
            $("#addJenisIzin").atts('disabled', true);
            $("#addNoReg").atts('disabled', true);
            $("#addTglExp").atts('disabled', true);
            $("#addJenisSIM").atts('disabled', true);
            $("#addTglExpSIM").atts('disabled', true);
            $("#addKembaliIzinUnit").addClass('disabled');
            $("#addSimpanIzinUnit").addClass('disabled');
        }

        function aktifSertifikat() {
            $("#jenisSertifikasi").removeAttr('disabled');
            $("#noSertifikat").removeAttr('disabled');
            $("#namaLembaga").removeAttr('disabled');
            $("#tanggalSertifikasi").removeAttr('disabled');
            $("#masaBerlakuSertifikat").removeAttr('disabled');
            $("#tanggalSertifikasiAkhir").removeAttr('disabled');
            $("#fileSertifikasi").removeAttr('disabled');
            $("#addSimpanSertifikasi").removeClass('disabled');
            $("#addResetSertifikasi").removeClass('disabled');
            $("#addbtnkembaliSertifikat").removeClass('disabled');
            $("#addLanjutSertifikasi").removeClass('disabled');
        }

        function nonaktifSertifikat() {
            $("#jenisSertifikasi").attr('disabled', true);
            $("#noSertifikat").attr('disabled', true);
            $("#namaLembaga").attr('disabled', true);
            $("#tanggalSertifikasi").attr('disabled', true);
            $("#masaBerlakuSertifikat").attr('disabled', true);
            $("#tanggalSertifikasiAkhir").attr('disabled', true);
            $("#fileSertifikasi").attr('disabled', true);
            $("#addSimpanSertifikasi").addClass('disabled');
            $("#addResetSertifikasi").addClass('disabled');
            $("#addbtnkembaliSertifikat").addClass('disabled');
            $("#addLanjutSertifikasi").addClass('disabled');
        }

        function aktifMCU() {
            $("#tglMCU").removeAttr('disabled');
            $("#hasilMCU").removeAttr('disabled');
            $("#ketMCU").removeAttr('disabled');
            $("#fileMCU").removeAttr('disabled');
            $("#addbtnkembaliMCU").removeClass('disabled');
            $("#addSimpanMCU").removeClass('disabled');
        }

        function nonaktifMCU() {
            $("#tglMCU").attr('disabled');
            $("#hasilMCU").attr('disabled');
            $("#ketMCU").attr('disabled');
            $("#fileMCU").attr('disabled');
            $("#addbtnkembaliMCU").addClass('disabled');
            $("#addSimpanMCU").addClass('disabled');
        }

        function aktifVaksin() {
            $("#jenisVaksin").removeAttr('disabled');
            $("#namaVaksin").removeAttr('disabled');
            $("#tanggalVaksin").removeAttr('disabled');
            $("#fileMCU").removeAttr('disabled');
            $("#addSimpanVaksin").removeClass('disabled');
            $("#addResetVaksin").removeClass('disabled');
            $("#addbtnkembalivaksin").removeClass('disabled');
            $("#addLanjutkanVaksin").removeClass('disabled');
        }

        function nonaktifVaksin() {
            $("#jenisVaksin").attr('disabled');
            $("#namaVaksin").attr('disabled');
            $("#tanggalVaksin").attr('disabled');
            $("#fileMCU").attr('disabled');
            $("#addSimpanVaksin").addClass('disabled');
            $("#addResetVaksin").addClass('disabled');
            $("#addbtnkembalivaksin").addClass('disabled');
            $("#addLanjutkanVaksin").addClass('disabled');
        }

        function aktifFilePendukung() {
            $("#filePendukung").removeAttr('disabled');
            $("#addbtnkembaliFile").removeClass('disabled');
            $("#addUploadFileSelesai").removeClass('disabled');
            $("#addUploadFilePendukung").removeClass('disabled');
        }

        function nonaktifFilePendukung() {
            $("#filePendukung").attr('disabled');
            $("#addbtnkembaliFile").addClass('disabled');
            $("#addUploadFileSelesai").addClass('disabled');
            $("#addUploadFilePendukung").addClass('disabled');
        }

        $("#clKaryawan-click").click(function() {
            if ($("#colKaryawan").hasClass("show")) {
                $("#colKaryawan").collapse("hide");
            } else {
                $("#colKaryawan").collapse("show");
            }
        });

        $("#clPersonal-click").click(function() {
            if ($("#colPersonal").hasClass("show")) {
                $("#colPersonal").collapse("hide");
            } else {
                $("#colPersonal").collapse("show");
            }
        });

        $("#clIzinTambang-click").click(function() {
            if ($("#colIzinTambang").hasClass("show")) {
                $("#colIzinTambang").collapse("hide");
            } else {
                $("#colIzinTambang").collapse("show");
            }
        });

        $("#clSertifikasi-click").click(function() {
            if ($("#colSertifikasi").hasClass("show")) {
                $("#colSertifikasi").collapse("hide");
            } else {
                $("#colSertifikasi").collapse("show");
            }
        });

        $("#clMCU-click").click(function() {
            if ($("#colMCU").hasClass("show")) {
                $("#colMCU").collapse("hide");
            } else {
                $("#colMCU").collapse("show");
            }
        });

        $("#clVaksin-click").click(function() {
            if ($("#colVaksin").hasClass("show")) {
                $("#colVaksin").collapse("hide");
            } else {
                $("#colVaksin").collapse("show");
            }
        });

        $("#clFilePendukung-click").click(function() {
            if ($("#colFilePendukung").hasClass("show")) {
                $("#colFilePendukung").collapse("hide");
            } else {
                $("#colFilePendukung").collapse("show");
            }
        });

        $(".btnrespage").click(function() {
            let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();

            if (auth_kary !== "") {
                swal({
                    title: "Reset Data Karyawan",
                    text: "Data anda belum lengkap, yakin reset data karyawan?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#36c6d3',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, reset data',
                    cancelButtonText: 'Batalkan'
                }).then(function(result) {
                    if (result.value) {
                        window.location.href = site_url+"karyawan/new";
                        $.LoadingOverlay("show");
                        $.LoadingOverlay("hide");
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'Data karyawan batal direset', 'info');
                    }
                });
            } else {
                window.location.href = site_url+"karyawan/new";
                $.LoadingOverlay("show");
                $.LoadingOverlay("hide");
            }
        });
        $("#btnbatalunitsimper").click(function() {
            $("#jenisUnitSimper").val('').trigger("change");
            $("#tipeAksesUnit").val('').trigger("change");
            $("#mdlunitsimper").modal("hide");
        });
        $("#btnsimpanunitsimper").click(function() {
            let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
            let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();
            let jenisizin = $("#addJenisIzin").val();
            let noreg = $("#addNoReg").val();
            let tglexp = $("#addTglExp").val();
            let jenissim = $("#addJenisSIM").val();
            let tglexpsim = $("#addTglExpSIM").val();
            let jenisunit = $("#jenisUnitSimper").val();
            let tipeakses = $("#tipeAksesUnit").val();

            $.ajax({
                type: "POST",
                url: site_url+"izin_tambang/add_unit_izin_tambang",
                data: {
                    jenisizin: jenisizin,
                    noreg: noreg,
                    tglexp: tglexp,
                    jenissim: jenissim,
                    tglexpsim: tglexpsim,
                    jenisunit: jenisunit,
                    tipeakses: tipeakses,
                    auth_kary: auth_kary,
                    auth_izin: auth_izin
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#jenisUnitSimper").val('').trigger('change');
                        $("#tipeAksesUnit").val('').trigger('change');
                        $(".errorjenisUnitSimper").text('');
                        $(".errortipeAksesUnit").text('');
                        $("#idizintambang").LoadingOverlay("show");
                        $(".ecb14fe704e08d9df8e343030bbbafcb").text(data.auth_izin);
                        $("#idizintambang").load(site_url+"izin_tambang/izin_tambang?auth_izin=" + data.auth_izin);
                        swal('Berhasil', data.pesan, 'success');
                    } else if (data.statusCode == 201) {
                        swal('Error', data.pesan, 'error');
                    } else {
                        $(".errorjenisUnitSimper").html(data.jenisunit);
                        $(".errortipeAksesUnit").html(data.tipeakses);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat menyimpan unit hubungi administrator");
                    }
                }
            });
        });

        // function jenistambang() {
        //     let jenisizin = $("#addJenisIzin").val();

        //     if (jenisizin == "SP") {
        //         $(".simperunit").collapse("show");
        //     } else {
        //         $(".simperunit").collapse("hide");
        //     }
        // }

        // jenistambang();

        // $("#addJenisIzin").change(function() {
        //     let jenisizin = $("#addJenisIzin").val();

        //     if (jenisizin == "SP") {

        //     } else {
        //         $(".simperunit").collapse("hide");
        //     }
        // });
        $("#addStatusKaryawan").change(function() {
            let stat_kary = $("#addStatusKaryawan").val();

            $.ajax({
                type: "POST",
                url: site_url+"perjanjian/get_stat_waktu",
                data: {
                    stat_kary: stat_kary
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        if (data.stat_waktu == "T") {
                            $("#addFieldPermanen").addClass("d-none");
                            $("#addFieldKontrakAwal").removeClass("d-none");
                            $("#addFieldKontrakAkhir").removeClass("d-none");
                        } else if (data.stat_waktu == "F") {
                            $("#addFieldPermanen").removeClass("d-none");
                            $("#addFieldKontrakAwal").addClass("d-none");
                            $("#addFieldKontrakAkhir").addClass("d-none");
                        }
                    } else {
                        $("#erroraddStatusKaryawan").html(data.pesan);
                        $("#addFieldPermanen").addClass("d-none");
                        $("#addFieldKontrakAwal").addClass("d-none");
                        $("#addFieldKontrakAkhir").addClass("d-none");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data status karyawan hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                }
            });
        });
        $.ajax({
            type: "POST",
            url: site_url+"karyawan/get_agama",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#addagama").html(data.agama);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data agama, hubungi administrator");
                    $("#addSimpanPersonal").remove();
                }
            }
        });
        $.ajax({
            type: "POST",
            url: site_url+"karyawan/get_stat_nikah",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#statPernikahan").html(data.statnikah);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data status pernikahan, hubungi administrator");
                    $("#addSimpanPersonal").remove();
                }
            }
        });
        $.ajax({
            type: "POST",
            url: site_url+"karyawan/get_all_jenis_mcu",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#hasilMCU").html(data.jmcu);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data hasil MCU, hubungi administrator");
                }
            }
        });
        $.ajax({
            type: "POST",
            url: site_url+"izin_tambang/get_all_unit",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#jenisUnitSimper").html(data.unit);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormdlsimper").removeClass('d-none');
                $(".errormdlsimper").removeClass('alert-info');
                $(".errormdlsimper").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormdlsimper").html("Terjadi kesalahan saat load data unit simper, hubungi administrator");
                    $("#btnsimpanunitsimper").remove();
                }
            }
        });
        $.ajax({
            type: "POST",
            url: site_url+"vaksin/get_vaksin_jenis_all",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#jenisVaksin").html(data.jvks);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data jenis vaksin, hubungi administrator");
                }
            }
        });
        $.ajax({
            type: "POST",
            url: site_url+"vaksin/get_vaksin_nama_all",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#namaVaksin").html(data.nvks);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data nama vaksin, hubungi administrator");
                }
            }
        });
        $.ajax({
            type: "POST",
            url: site_url+"izin_tambang/get_all_akses",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#tipeAksesUnit").html(data.akses);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormdlsimper").removeClass('d-none');
                $(".errormdlsimper").removeClass('alert-info');
                $(".errormdlsimper").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormdlsimper").html("Terjadi kesalahan saat load data unit simper, hubungi administrator");
                    $("#btnsimpanunitsimper").remove();
                }
            }
        });
        $.ajax({
            type: "POST",
            url: site_url+"pendidikan/get_all",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#pendidikanTerakhir").html(data.pdk);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data pendidikan terakhir, hubungi administrator");
                    $("#addSimpanPersonal").remove();
                }
            }
        });
        $.ajax({
            type: "POST",
            url: site_url+"daerah/get_prov",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#provData").html(data.prov);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data provinsi, hubungi administrator");
                    $("#addSimpanPersonal").remove();
                }
            }
        });
        $("#provData").change(function() {
            let id_prov = $("#provData").val();

            $("#txtkota").LoadingOverlay("show");
            $("#txtkec").LoadingOverlay("show");
            $("#txtkel").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url+"daerah/get_kab",
                data: {
                    id_prov: id_prov
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#kotaData").html(data.kab);
                        $("#kecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                        $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                        $("#kotaData").removeAttr('disabled');
                        $("#txtkota").LoadingOverlay("hide");
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");
                    } else {
                        $("#kotaData").html("<option value=''>-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>");
                        $("#kecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                        $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                        $("#kotaData").attr('disabled', true);
                        $("#kecData").attr('disabled', true);
                        $("#kelData").attr('disabled', true);
                        $("#txtkota").LoadingOverlay("hide");
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");
                    }

                    if (id_prov != "") {
                        $(".errorProvData").html("");
                    } else {
                        $(".errorProvData").html("<p>Provinsi wajib diisi</p>");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    $("#txtkota").LoadingOverlay("hide");
                    $("#txtkec").LoadingOverlay("hide");
                    $("#txtkel").LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                }
            });
        });

        $("#kotaData").change(function() {
            let id_kab = $("#kotaData").val();

            $("#txtkec").LoadingOverlay("show");
            $("#txtkel").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url+"daerah/get_kec",
                data: {
                    id_kab: id_kab
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#kecData").html(data.kec);
                        $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                        $("#kecData").removeAttr('disabled');
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");
                    } else {
                        $("#kecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                        $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                        $("#kecData").attr('disabled', true);
                        $("#kelData").attr('disabled', true);
                        $("#txtkec").LoadingOverlay("hide");
                        $("#txtkel").LoadingOverlay("hide");
                    }

                    if (id_kab != "") {
                        $(".errorKotaData").html("");
                    } else {
                        $(".errorKotaData").html("<p>Kabupaten/kota wajib dipilih</p>");
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    $("#txtkec").LoadingOverlay("hide");
                    $("#txtkel").LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                }
            });
        });
        $("#kecData").change(function() {
            let id_kec = $("#kecData").val();

            $("#txtkel").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url+"daerah/get_kel",
                data: {
                    id_kec: id_kec
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#kelData").html(data.kel);
                        $("#kelData").removeAttr('disabled');
                        $("#txtkel").LoadingOverlay("hide");
                    } else {
                        $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                        $("#kelData").attr('disabled', true);
                        $("#txtkel").LoadingOverlay("hide");
                    }

                    if (id_kec != "") {
                        $(".errorKecData").html("");
                    } else {
                        $(".errorKecData").html("<p>Kecamatan wajib dipilih</p>");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    $("#txtkel").LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                }
            });
        });

        $("#kelData").change(function() {
            let id_kel = $("#kelData").val();
            if (id_kel != "") {
                $(".errorKelData").html("");
            } else {
                $(".errorKelData").html("<p>Kelurahan wajib dipilih</p>");
            }
        });

        $("#addStatusKaryawan").change(function() {
            $("#addTanggalPermanen").val('');
            $("#addTanggalKontrakAwal").val('');
            $("#addTanggalKontrakAkhir").val('');
        });

        $("#refreshJenisSIM").click(function() {
            $("#txtizinSIM").LoadingOverlay("show");

            $.ajax({
                type: "POST",
                url: site_url+"karyawan/get_sim",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addJenisSIM").html(data.siim);
                    $("#txtizinSIM").LoadingOverlay("hide");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data jenis SIM, hubungi administrator");
                    }
                }
            });
        });

        $("#refreshProv").click(function() {
            $("#txtprov").LoadingOverlay("show");
            $("#txtkota").LoadingOverlay("show");
            $("#txtkec").LoadingOverlay("show");
            $("#txtkel").LoadingOverlay("show");

            $.ajax({
                type: "POST",
                url: site_url+"daerah/get_prov",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#provData").html(data.prov);
                    $("#kotaData").html("<option value=''>-- KABUPATEN/KOTA TIDAK DITEMUKAN --</option>");
                    $("#kecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                    $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    $("#txtprov").LoadingOverlay("hide");
                    $("#txtkota").LoadingOverlay("hide");
                    $("#txtkec").LoadingOverlay("hide");
                    $("#txtkel").LoadingOverlay("hide");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#provData").LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    $("#txtprov").LoadingOverlay("hide");
                    $("#txtkota").LoadingOverlay("hide");
                    $("#txtkec").LoadingOverlay("hide");
                    $("#txtkel").LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data provinsi, hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                }
            });
        });

        $("#refreshKota").click(function() {
            let id_prov = $("#provData").val();

            $("#txtkota").LoadingOverlay("show");
            $("#txtkec").LoadingOverlay("show");
            $("#txtkel").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url+"daerah/get_kab",
                data: {
                    id_prov: id_prov
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#kotaData").html(data.kab);
                    $("#kecData").html("<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>");
                    $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    $("#txtkota").LoadingOverlay("hide");
                    $("#txtkec").LoadingOverlay("hide");
                    $("#txtkel").LoadingOverlay("hide");

                    if (id_prov != "") {
                        $(".errorProvData").html("");
                    } else {
                        $(".errorProvData").html("<p>Provinsi wajib diisi</p>");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    $("#txtkota").LoadingOverlay("hide");
                    $("#txtkec").LoadingOverlay("hide");
                    $("#txtkel").LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data kabupaten/kota, hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                }
            });
        });

        $("#refreshKec").click(function() {
            let id_kab = $("#kotaData").val();

            $("#txtkec").LoadingOverlay("show");
            $("#txtkota").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url+"daerah/get_kec",
                data: {
                    id_kab: id_kab
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#kecData").html(data.kec);
                    $("#kelData").html("<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>");
                    $("#txtkec").LoadingOverlay("hide");
                    $("#txtkota").LoadingOverlay("hide");
                    if (id_kab != "") {
                        $(".errorKotaData").html("");
                    } else {
                        $(".errorKotaData").html("<p>Kabupaten/kota wajib dipilih</p>");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    $("#txtkec").LoadingOverlay("hide");
                    $("#txtkota").LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                }
            });
        });

        $("#refreshKel").click(function() {
            let id_kec = $("#kecData").val();

            $("#txtkel").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url+"daerah/get_kel",
                data: {
                    id_kec: id_kec
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#kelData").html(data.kel);
                    $("#txtkel").LoadingOverlay("hide");
                    if (id_kab != "") {
                        $(".errorKecData").html("");
                    } else {
                        $(".errorKecData").html("<p>Kecamatan wajib dipilih</p>");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    $("#txtkel").LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data kecamatan, hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                }
            });
        });

        // $("#refreshStatNikah").click(function() {
        //     $("#txtnikah").LoadingOverlay("show");

        //     $.ajax({
        //         type: "POST",
        //         url: site_url+"karyawan/get_stat_nikah",
        //         data: {},
        //         success: function(data) {
        //             var data = JSON.parse(data);
        //             $("#statPernikahan").html(data.statnikah);
        //             $("#txtnikah").LoadingOverlay("hide");
        //         },
        //         error: function(xhr, ajaxOptions, thrownError) {
        //             $("#txtnikah").LoadingOverlay("hide");
        //             $(".errormsg").removeClass('d-none');
        //             $(".errormsg").removeClass('alert-info');
        //             $(".errormsg").addClass('alert-danger');
        //             if (thrownError != "") {
        //                 $(".errormsg").html("Terjadi kesalahan saat load data status pernikahan, hubungi administrator");
        //                 $("#addSimpanPersonal").remove();
        //             }
        //         }
        //     });
        // });

        $("#refreshDidik").click(function() {
            $("#txtDidik").LoadingOverlay("show");

            $.ajax({
                type: "POST",
                url: site_url+"pendidikan/get_all",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#pendidikanTerakhir").html(data.pdk);
                    $("#txtDidik").LoadingOverlay("hide");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    $("#txtDidik").LoadingOverlay("hide");
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data pendidikan terakhir, hubungi administrator");
                        $("#addSimpanPersonal").remove();
                    }
                }
            });
        });

        // $("#refreshPerKary").click(function() {
        //     $("#txtperkary").LoadingOverlay("show");

        //     $.ajax({
        //         type: "POST",
        //         url: "<?php base_url("perusahaan/get_m_all",
        //         data: {},
        //         success: function(data) {
        //             var data = JSON.parse(data);
        //             if (data.statusCode == 200) {
        //                 $("#addPerKary").html(data.prs);
        //                 $("#addPerKary").val('').trigger('change');
        //                 $("#txtperkary").LoadingOverlay("hide");
        //                 $("#addDepartKary").attr('disabled', true);
        //                 $("#addPosisiKary").attr('disabled', true);
        //             } else {
        //                 $("#txtperkary").LoadingOverlay("hide");
        //                 $(".errormsg").removeClass('d-none');
        //                 $(".errormsg").removeClass('alert-info');
        //                 $(".errormsg").addClass('alert-danger');
        //                 $(".errormsg").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
        //                 $("#addSimpanPersonal").remove();
        //             }
        //         },
        //         error: function(xhr, ajaxOptions, thrownError) {
        //             $("#txtperkary").LoadingOverlay("hide");
        //             $(".errormsg").removeClass('d-none');
        //             $(".errormsg").removeClass('alert-info');
        //             $(".errormsg").addClass('alert-danger');
        //             if (thrownError != "") {
        //                 $(".errormsg").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
        //                 $("#addSimpanPersonal").remove();
        //             }
        //         }
        //     });
        // });

        $("#refreshDepart").click(function() {
            let auth_m_per = $("#addPerKary").val();

            if (auth_m_per != "") {
                $("#txtdepartkary").LoadingOverlay("show");
                $("#txtposisikary").LoadingOverlay("show");

                $.ajax({
                    type: "POST",
                    url: site_url+"departemen/get_by_auth_m_per",
                    data: {
                        auth_m_per: auth_m_per
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#addDepartKary").html(data.dprt);
                        $("#addDepartKary").removeAttr('disabled');
                        $("#addPosisiKary").attr('disabled', true);
                        $("#refreshPosisi").attr('disabled', true);
                        $("#addPosisiKary").html('<option value ="">-- WAJIB DIPILIH --</option>');
                        $("#txtdepartkary").LoadingOverlay("hide");
                        $("#txtposisikary").LoadingOverlay("hide");

                        if (auth_m_per != "") {
                            $(".errorAddPerKary").html("");
                        } else {
                            $(".errorAddPerKary").html("<p>Perusahaan wajib dipilih</p>");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#txtdepartkary").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data departemen, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });
            } else {
                swal('Error', 'Pilih perusahaan', 'error');
            }
        });

        $("#refreshPosisi").click(function() {
            let auth_depart = $("#addDepartKary").val();

            $("#addPosisiKary").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url+"posisi/get_by_authdepart",
                data: {
                    auth_depart: auth_depart
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addPosisiKary").html(data.posisi);
                    $("#addPosisiKary").LoadingOverlay("hide");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#addPosisiKary").LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data posisi, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });
        });
        $("#refreshKlasifikasi").click(function() {
            $("#txtklasifikasikary").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url+"klasifikasi/get_all",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addKlasifikasiKary").html(data.kls);
                    $("#txtklasifikasikary").LoadingOverlay("hide");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#txtklasifikasikary").LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data klasifikasi, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });
        });
        $("#refreshPOH").click(function() {
            $("#txtPOHKary").LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: site_url+"poh/get_all",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addPOHKary").html(data.pho);
                    $("#txtPOHKary").LoadingOverlay("hide");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#txtPOHKary").LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data POH, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });
        });

        $("#refreshLokterima").click(function() {
            let auth_per = $("#addPerKary").val();
            $("#txtlokterimakary").LoadingOverlay("show");

            if (auth_per != "") {
                $.ajax({
                    type: "POST",
                    url: site_url+"lokasipenerimaan/get_by_authper",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#txtlokterimakary").LoadingOverlay("hide");
                        $("#addLokterimaKary").removeAttr('disabled');
                        $("#addLokterimaKary").html(data.lkt);
                        $("#addLokterimaKary").removeAttr('disabled');
                        $("#refreshLokterima").removeAttr('disabled');
                    },
                    error: function() {
                        $("#txtlokterimakary").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").removeClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data lokasi penerimaan, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });
            }
        });

        $("#refreshLokker").click(function() {
            $("#txtlokkerkary").LoadingOverlay("show");

            $.ajax({
                type: "POST",
                url: site_url+"lokasikerja/get_all",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addLokasiKerja").html(data.lkr);
                    $("#txtlokkerkary").LoadingOverlay("hide");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#txtlokkerkary").LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data lokasi kerja, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });
        });

        $("#refreshTipe").click(function() {
            $("#txtjeniskary").LoadingOverlay("show");

            $.ajax({
                type: "POST",
                url: site_url+"karyawan/get_all_tipe",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addTipeKaryawan").html(data.tipe);
                    $("#txtjeniskary").LoadingOverlay("hide");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#txtjeniskary").LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data tipe karyawan, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });
        });

        $("#refreshLevel").click(function() {
            let auth_per = $("#addPerKary").val();
            $("#txtLevelkary").LoadingOverlay("show");

            if (auth_per != "") {
                $.ajax({
                    type: "POST",
                    url: site_url+"level/get_all",
                    data: {
                        auth_per: auth_per
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#addLevelKary").html(data.grd);
                        $("#txtLevelkary").LoadingOverlay("hide");
                        $("#addLevelKary").removeAttr('disabled');
                        $("#refreshLevel").removeAttr('disabled');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#txtLevelkary").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data level, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });
            }
        });

        $("#refreshResidence").click(function() {
            $("#txtstatresidence").LoadingOverlay("show");
            $("#addStatusResidence").val('').trigger('change');
            $("#txtstatresidence").LoadingOverlay("hide");
        });

        $("#refreshstatkaryawan").click(function() {
            $("#txtstatkary").LoadingOverlay("show");

            $.ajax({
                type: "POST",
                url: site_url+"perjanjian/get_all",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addStatusKaryawan").html(data.janji);
                    $("#addFieldKontrakAwal").addClass('d-none');
                    $("#addFieldKontrakAkhir").addClass('d-none');
                    $("#addFieldPermanen").addClass('d-none');

                    $("#addTanggalPermanen").val('');
                    $("#addTanggalKontrakAwal").val('');
                    $("#addTanggalKontrakAkhir").val('');

                    $("#txtstatkary").LoadingOverlay("hide");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#txtstatkary").LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data status karyawan, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });
        });

        $.ajax({
            type: "POST",
            url: site_url+"klasifikasi/get_all",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#addKlasifikasiKary").html(data.kls);
                $('#addKlasifikasiKary').select2({
                    theme: 'bootstrap4'
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data klasifikasi, hubungi administrator");
                    $("#addSimpanPekerjaan").remove();
                }
            }
        });

        $.ajax({
            type: "POST",
            url: site_url+"karyawan/get_sim",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#addJenisSIM").html(data.siim);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data SIM, hubungi administrator");
                }
            }
        });

        $("#addagama").change(function() {
            let agama = $("#addagama").val();

            if (agama != "") {
                $(".errorAddAgama").html("");
            } else {
                $(".errorAddAgama").html("<p>Agama wajib dipilih</p>");
            }
        });
        $("#jenisKelamin").change(function() {
            let jk = $("#jenisKelamin").val();
            if (jk != "") {
                $(".errorJenisKelamin").html("");
            } else {
                $(".errorJenisKelamin").html("<p>Jenis kelamin wajib dipilih</p>");
            }
        });
        $("#statPernikahan").change(function() {
            let stkw = $("#statPernikahan").val();
            if (stkw != "") {
                $(".errorStatPernikahan").html("");
            } else {
                $(".errorStatPernikahan").html("<p>Kelurahan wajib dipilih</p>");
            }
        });
        $("#kewarganegaraan").change(function() {
            let warga = $("#kewarganegaraan").val();
            if (warga != "") {
                $(".errorKewarganegaraan").html("");
            } else {
                $(".errorKewarganegaraan").html("<p>Warga negara wajib dipilih</p>");
            }
        });

        function get_data_kary(auth_per) {
            $("#txtdepartkary").LoadingOverlay("show");
            $("#txtposisikary").LoadingOverlay("show");
            $("#txtlokterimakary").LoadingOverlay("show");
            $("#txtpohkary").LoadingOverlay("show");
            $("#txtLevelkary").LoadingOverlay("show");

            $.ajax({
                type: "POST",
                url: site_url+"departemen/get_by_auth_m_per",
                data: {
                    auth_m_per: auth_per
                },
                success: function(data) {
                    $("#addPosisiKary").attr('disabled', true);
                    $("#addPosisiKary").html('<option value="">-- WAJIB DIPILIH --</option>');
                    $("#refreshPosisi").attr('disabled', true);
                    var data = JSON.parse(data);
                    $("#addDepartKary").html(data.dprt);
                    if (auth_per != "") {
                        $(".errorAddPerKary").html("");
                    } else {
                        $(".errorAddPerKary").html("<p>Perusahaan wajib dipilih</p>");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data departemen, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });

            $.ajax({
                type: "POST",
                url: site_url+"level/get_all",
                data: {
                    auth_per: auth_per
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#addLevelKary").html(data.grd);
                    $("#addLevelKary").removeAttr('disabled');
                    $("#refreshLevel").removeAttr('disabled');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data level, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });

            $.ajax({
                type: "POST",
                url: site_url+"lokasipenerimaan/get_by_authper",
                data: {
                    auth_per: auth_per
                },
                success: function(data) {
                    $("#addLokterimaKary").removeAttr('disabled');
                    var data = JSON.parse(data);
                    $("#addLokterimaKary").html(data.lkt);
                    $("#addLokterimaKary").removeAttr('disabled');
                    $("#refreshLokterima").removeAttr('disabled');
                },
                error: function() {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").removeClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data lokasi penerimaan, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });

            $("#txtdepartkary").LoadingOverlay("hide");
            $("#txtposisikary").LoadingOverlay("hide");
            $("#txtlokterimakary").LoadingOverlay("hide");
            $("#txtpohkary").LoadingOverlay("hide");
            $("#txtLevelkary").LoadingOverlay("hide");
        }

        $("#addPerKary").change(function() {
            let auth_per = $("#addPerKary").val();
            let auth_cek = $(".89kjm78ujki782m4x787909h3").text();
            let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();

            if (auth_per != "") {
                if (auth_per_old != "") {
                    if (auth_per != auth_per_old) {
                        swal({
                            title: "Ganti Perusahaan",
                            text: "Mengganti perusahaan akan me-reset beberapa data karyawan, yakin akan diganti?",
                            type: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#36c6d3',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Ganti perusahaan',
                            cancelButtonText: 'Batalkan'
                        }).then(function(result) {
                            if (result.value) {
                                $.LoadingOverlay("show");
                                auth_per_old = auth_per;
                                get_data_kary(auth_per)
                                $("#addPerKary").val(auth_per).trigger('change');
                                $('#addPosisiKary').html('<option value="">-- WAJIB DIPILIH --</option>');
                                $('#addPosisiKary').attr('disabled', true);
                                $('#refreshPosisi').attr('disabled', true);
                                aktifKaryawan();
                                // if (auth_cek == "") {
                                //     $('#colPersonal').collapse("show");
                                //     $('#colKaryawan').collapse("hide");
                                //     $('#colIzinTambang').collapse("hide");
                                //     $('#colSertifikasi').collapse("hide");
                                //     $('#colMCU').collapse("hide");
                                //     $('#colVaksin').collapse("hide");
                                //     $('#colFilePendukung').collapse("hide");
                                // } else {
                                //     get_data_kary(auth_per)
                                //     $("#addPerKary").val(auth_per).trigger('change');
                                //     $('#addPosisiKary').html('<option value="">-- WAJIB DIPILIH --</option>');
                                //     $('#addPosisiKary').attr('disabled', true);
                                //     $('#refreshPosisi').attr('disabled', true);
                                //     aktifKaryawan();
                                // }
                                $.LoadingOverlay("hide");
                            } else if (result.dismiss == 'cancel') {
                                swal('Batal', 'Perusahaan batal diganti', 'info');
                                $("#addPerKary").val(auth_per_old).trigger('change');
                                $('#addDepartKary').removeAttr('disabled');
                                $('#addPosisiKary').removeAttr('disabled');
                            }
                        });
                    }
                } else {
                    $.LoadingOverlay("show");
                    get_data_kary(auth_per);
                    auth_per_old = auth_per;
                    if (auth_cek == "") {
                        $('#colPersonal').collapse("show");
                        $('#colKaryawan').collapse("hide");
                        $('#colIzinTambang').collapse("hide");
                        $('#colSertifikasi').collapse("hide");
                        $('#colMCU').collapse("hide");
                        $('#colVaksin').collapse("hide");
                        $('#colFilePendukung').collapse("hide");
                    }
                    $.LoadingOverlay("hide");
                }

                aktifPersonal();
            } else {
                $('#addDepartKary').html('<option value="">-- WAJIB DIPILIH --</option>');
                $('#addPosisiKary').html('<option value="">-- WAJIB DIPILIH --</option>');
                $('#addLevelKary').html('<option value="">-- WAJIB DIPILIH --</option>');
                $('#addLokterimaKary').html('<option value="">-- WAJIB DIPILIH --</option>');
                $('#addDepartKary').attr('disabled', true)
                $('#addPosisiKary').attr('disabled', true)
                $('#addLevelKary').attr('disabled', true)
                $('#addLokterimaKary').attr('disabled', true)
                $('#refreshDepart').attr('disabled', true)
                $('#refreshPosisi').attr('disabled', true)
                $('#refreshLevel').attr('disabled', true)
                $('#refreshLokterima').attr('disabled', true)
            }

        });

        $(document).on('click', '.hapus_unit', function() {
            let id_unit = $(this).attr("id");
            let jenis_unit = $(this).attr("value");
            let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();

            swal({
                title: "Hapus unit",
                text: "Yakin data unit " + jenis_unit + " akan dihapus?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batalkan'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: site_url+"izin_tambang/hapus_unit",
                        data: {
                            id_unit: id_unit
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#idizintambang").LoadingOverlay("show");
                                $("#idizintambang").load(site_url+"izin_tambang/izin_tambang?auth_izin=" + auth_izin);
                                // $("#idizintambang").LoadingOverlay("hide");
                            } else {
                                $(".errormsgizin").removeClass('d-none');
                                $(".errormsgizin").removeClass('alert-info');
                                $(".errormsgizin").addClass('alert-danger');
                                $(".errormsgizin").html(data.pesan);

                                $(".errormsgizin").fadeTo(3000, 500).slideUp(500, function() {
                                    $(".errormsgizin").slideUp(500);
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".errormsgizin").removeClass('d-none');
                            $(".errormsgizin").removeClass('alert-info');
                            $(".errormsgizin").addClass('alert-danger');
                            if (thrownError != "") {
                                $(".errormsgizin").html("Terjadi kesalahan saat menghapus unit, hubungi administrator");
                            }

                            $(".errormsgizin").fadeTo(3000, 500).slideUp(500, function() {
                                $(".errormsgizin").slideUp(500);
                                $(".errormsgizin").addClass("d-none");
                            });
                        }
                    });
                } else if (result.dismiss == 'cancel') {
                    swal('Batal', 'Data unit batal disimpan', 'warning');
                    return false;
                }
            });


        });

        $(document).on('click', '.hapus_sertifikasi', function() {
            let auth_Sertifikat = $(this).attr("id");
            let no_sertifikat = $(this).attr("value");
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

            swal({
                title: "Hapus Sertifikasi",
                text: "Yakin data No. Sertifikat " + no_sertifikat + " akan dihapus?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batalkan'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: site_url+"sertifikasi/hapus_sertifikasi",
                        data: {
                            auth_Sertifikat: auth_Sertifikat
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#idsertifikat").LoadingOverlay("show");
                                $("#idsertifikat").load(site_url+"karyawan/sertifikasi?auth_person=" + auth_person);
                                // $("#idizintambang").LoadingOverlay("hide");
                            } else {
                                $(".errMsgSertifikasi").removeClass('d-none');
                                $(".errMsgSertifikasi").removeClass('alert-info');
                                $(".errMsgSertifikasi").addClass('alert-danger');
                                $(".errMsgSertifikasi").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".errMsgSertifikasi").removeClass('d-none');
                            $(".errMsgSertifikasi").removeClass('alert-info');
                            $(".errMsgSertifikasi").addClass('alert-danger');
                            if (thrownError != "") {
                                $(".errMsgSertifikasi").html("Terjadi kesalahan saat menghapus sertifikat, hubungi administrator");
                            }

                            $(".errMsgSertifikasi").fadeTo(3000, 500).slideUp(500, function() {
                                $(".errMsgSertifikasi").slideUp(500);
                                $(".errMsgSertifikasi").addClass("d-none");
                            });
                        }
                    });
                } else if (result.dismiss == 'cancel') {
                    swal('Batal', 'Data unit batal disimpan', 'warning');
                    return false;
                }
            });


        });

        $(document).on('click', '.edit_sertifikasi', function() {
            let auth_sertifikat = $(this).attr("id");
            let no_sertifikat = $(this).attr("value");
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

            $.ajax({
                type: "POST",
                url: site_url+"sertifikasi/get_sertifikasi",
                data: {
                    auth_sertifikat: auth_sertifikat
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#mdleditsertifikat").modal("show");
                    $(".7u67u834hs7dg4haj231hh67ju7a2").text(data.auth_sertifikat);
                    $("#jenisSertifikasiEdit").val(data.id_jenis_sertifikasi).trigger('change');
                    $("#noSertifikatEdit").val(data.no_sertifikasi);
                    $("#namaLembagaEdit").val(data.lembaga);
                    $("#tanggalSertifikasiEdit").val(data.tgl_sertifikasi);
                    $("#masaBerlakuSertifikatEdit").val('');
                    $("#tanggalSertifikasiAkhirEdit").val(data.tgl_berakhir_sertifikasi);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".erreditsertifikat").removeClass('d-none');
                    $(".erreditsertifikat").removeClass('alert-info');
                    $(".erreditsertifikat").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".erreditsertifikat").html("Terjadi kesalahan saat load data sertifikasi, hubungi administrator");
                    }
                }
            });

        });

        $(document).on('click', '.upload_sertifikasi', function() {
            let auth_sertifikat = $(this).attr("id");

            $.ajax({
                type: "POST",
                url: site_url+"sertifikasi/get_sertifikasi",
                data: {
                    auth_sertifikat: auth_sertifikat
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#mdluploadulangser").modal("show");
                    $(".9f7fjmuj8ik2js4n8k66g3hjl323").text(data.auth_sertifikat);
                    $("#jdluploadulangser").text(data.no_sertifikat + " | " + data.jenis_sertifikasi);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".erreditsertifikat").removeClass('d-none');
                    $(".erreditsertifikat").removeClass('alert-info');
                    $(".erreditsertifikat").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".erreditsertifikat").html("Terjadi kesalahan saat load data sertifikasi, hubungi administrator");
                    }
                }
            });
        });

        $("#btnuploadulangser").click(function() {
            let auth_ser = $(".9f7fjmuj8ik2js4n8k66g3hjl323").text();
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
            let filesrt = $("#fileSertifikasiUlang").val();
            const flsert = $('#fileSertifikasiUlang').prop('files')[0];

            if (filesrt == "") {
                $(".errorFileSertifikasiUlang").text('File sertifikat wajib dipilih');
                return false;
            }

            swal({
                title: "Upload Ulang Sertifikat",
                text: "Yakin sertifikat akan di-upload ulang",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, upload',
                cancelButtonText: 'Batalkan'
            }).then(function(result) {
                if (result.value) {
                    let formData = new FormData();
                    formData.append('filesertifikat', flsert);
                    formData.append('filesrt', filesrt);
                    formData.append('auth_ser', auth_ser);
                    formData.append('auth_person', auth_person);
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: 'POST',
                        url: site_url+"sertifikasi/upload_ulang_ser",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#mdluploadulangser").modal("hide");
                                $("#fileSertifikasiUlang").val('');
                                $(".errorFileSertifikasiUlang").text('');
                                $(".9f7fjmuj8ik2js4n8k66g3hjl323").text('');
                                $.LoadingOverlay("hide");
                                $("#idsertifikat").LoadingOverlay("show");
                                $("#idsertifikat").load(site_url+"karyawan/sertifikasi?auth_person=" + auth_person);
                            } else if (data.statusCode == 201) {
                                $(".erruploadulangser").removeClass('d-none');
                                $(".erruploadulangser").removeClass('alert-primary');
                                $(".erruploadulangser").addClass('alert-danger');
                                $(".erruploadulangser").html(data.pesan);
                                $.LoadingOverlay("hide");
                            } else {
                                $(".errorFileSertifikasiUlang").html(data.pesan);
                                $.LoadingOverlay("hide");
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".erruploadulangser").removeClass('d-none');
                            $(".erruploadulangser").addClass('alert-danger');
                            if (thrownError != "") {
                                $(".erruploadulangser").html("Terjadi kesalahan saat meng-upload data sertifikat, hubungi administrator");
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '.detail_sertifikasi', function() {
            let auth_sertifikat = $(this).attr("id");

            $.ajax({
                type: "POST",
                url: site_url+"sertifikasi/get_sertifikasi",
                data: {
                    auth_sertifikat: auth_sertifikat
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#mdldetailsertifikat").modal("show");
                    $("#jdldetailsertifikat").text(data.no_sertifikat + " | " + data.jenis_sertifikasi);
                    $("#jenisSertifikasiDetail").val(data.jenis_sertifikasi);
                    $("#noSertifikatDetail").val(data.no_sertifikasi);
                    $("#namaLembagaDetail").val(data.lembaga);
                    $("#tanggalSertifikasiDetail").val(data.tgl_sertifikasi_show);
                    $("#tanggalSertifikasiAkhirDetail").val(data.tgl_berakhir_sertifikasi_show);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errsertifikatdetail").removeClass('d-none');
                    $(".errsertifikatdetail").removeClass('alert-info');
                    $(".errsertifikatdetail").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errsertifikatdetail").html("Terjadi kesalahan saat load data sertifikasi, hubungi administrator");
                    }
                }
            });
        });

        $(document).on('click', '.hapusvks', function() {
            let auth_vaksin = $(this).attr("id");
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

            swal({
                title: "Sukses",
                text: "Hapus data vaksin?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batalkan'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: site_url+"karyawan/hapus_vaksin",
                        data: {
                            auth_vaksin: auth_vaksin
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $("#idvaksin").LoadingOverlay("show");
                                $("#idvaksin").load(site_url+"karyawan/vaksin?auth_person=" + auth_person);
                            } else if (data.statusCode == 201) {
                                swal('Error', data.pesan, 'error');
                            } else {
                                $.LoadingOverlay("hide");
                                $(".errormsgvaksin").removeClass('d-none');
                                $(".errormsgvaksin").removeClass('alert-info');
                                $(".errormsgvaksin").addClass('alert-danger');
                                $(".errormsgvaksin").html(data.pesan);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".errormsgvaksin").removeClass('d-none');
                            $(".errormsgvaksin").removeClass('alert-info');
                            $(".errormsgvaksin").addClass('alert-danger');
                            if (thrownError != "") {
                                $(".errormsgvaksin").html("Terjadi kesalahan saat menghapus vaksin, hubungi administrator");
                            }
                        }
                    });
                }
            });
        });

        $("#btneditsertifikat").click(function() {
            let auth_ser = $(".7u67u834hs7dg4haj231hh67ju7a2").text();
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
            let jenis_ser = $("#jenisSertifikasiEdit").val();
            let no_ser = $("#noSertifikatEdit").val();
            let lembaga = $("#namaLembagaEdit").val();
            let tgl_ser = $("#tanggalSertifikasiEdit").val();
            let tgl_akhir = $("#tanggalSertifikasiAkhirEdit").val();

            $.ajax({
                type: "POST",
                url: site_url+"sertifikasi/update_sertifikasi",
                data: {
                    auth_ser: auth_ser,
                    jenis_ser: jenis_ser,
                    no_ser: no_ser,
                    lembaga: lembaga,
                    tgl_ser: tgl_ser,
                    tgl_akhir: tgl_akhir
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 202) {
                        $(".errorjenisSertifikasiEdit").html(data.jenis_ser);
                        $(".errorNoSertifikatEdit").html(data.no_ser);
                        $(".errorNamaLembagaEdit").html(data.lembaga);
                        $(".errorTanggalSertifikasiEdit").html(data.tgl_ser);
                        $(".errorTanggalSertifikasiAkhir").html(data.tgl_akhir);
                    } else {
                        $("#mdleditsertifikat").modal("hide");
                        $("#idsertifikat").LoadingOverlay("show");
                        $("#idsertifikat").load(site_url+"karyawan/sertifikasi?auth_person=" + auth_person);
                        swal('Berhasil', data.pesan, 'success');
                        $(".7u67u834hs7dg4haj231hh67ju7a2").text('');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".erreditsertifikat").removeClass('d-none');
                    $(".erreditsertifikat").removeClass('alert-info');
                    $(".erreditsertifikat").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".erreditsertifikat").html("Terjadi kesalahan saat update sertifikat, hubungi administrator");
                    }
                }
            });
        });

        $.ajax({
            type: "POST",
            url: site_url+"poh/get_all",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#addPOHKary").html(data.pho);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data POH, hubungi administrator");
                    $("#addSimpanPekerjaan").remove();
                }
            }
        });

        $.ajax({
            type: "POST",
            url: site_url+"lokasikerja/get_all",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#addLokasiKerja").html(data.lkr);
                $('#addLokasiKerja').select2({
                    theme: 'bootstrap4'
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data lokasi kerja, hubungi administrator");
                    $("#addSimpanPekerjaan").remove();
                }
            }
        });
        $.ajax({
            type: "POST",
            url: site_url+"perjanjian/get_all",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#addStatusKaryawan").html(data.janji);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data status karyawan, hubungi administrator");
                    $("#addSimpanPekerjaan").remove();
                }
            }
        });

        $.ajax({
            type: "POST",
            url: site_url+"karyawan/get_all_tipe",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#addTipeKaryawan").html(data.tipe);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data tipe karyawan, hubungi administrator");
                    $("#addSimpanPekerjaan").remove();
                }
            }
        });

        $("#addDepartKary").change(function() {
            let auth_depart = $("#addDepartKary").val();

            if (auth_depart != "") {
                $("#txtposisikary").LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: site_url+"posisi/get_by_authdepart",
                    data: {
                        auth_depart: auth_depart
                    },
                    success: function(data) {
                        $("#addPosisiKary").removeAttr('disabled');
                        $("#refreshPosisi").removeAttr('disabled');
                        var data = JSON.parse(data);
                        $("#addPosisiKary").html(data.posisi);
                        $("#txtposisikary").LoadingOverlay("hide");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#txtposisikary").LoadingOverlay("hide");
                        $(".errormsg").removeClass('d-none');
                        $(".errormsg").removeClass('alert-info');
                        $(".errormsg").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errormsg").html("Terjadi kesalahan saat load data posisi, hubungi administrator");
                            $("#addSimpanPekerjaan").remove();
                        }
                    }
                });
            } else {
                $("#addPosisiKary").html('<option value="">-- WAJIB DIPILIH --</option>');
                $("#addPosisiKary").attr('disabled', true);
                $("#refreshPosisi").attr('disabled', true);
            }
        });

        $("#masaBerlakuSertifikat").change(function() {
            let tglsrt = $("#tanggalSertifikasi").val();
            let masa = $("#masaBerlakuSertifikat").val();

            $.ajax({
                type: "post",
                url: site_url+"sertifikasi/getdateexpmasa",
                data: {
                    tglsrt: tglsrt,
                    masa: masa
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#tanggalSertifikasiAkhir").val(data.tglexp);
                    }
                }
            })
        });
        $("#tanggalSertifikasi").change(function() {
            let tglsrt = $("#tanggalSertifikasi").val();
            let masa = $("#masaBerlakuSertifikat").val();

            $.ajax({
                type: "post",
                url: site_url+"sertifikasi/getdateexpsrt",
                data: {
                    tglsrt: tglsrt,
                    masa: masa
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#tanggalSertifikasiAkhir").val(data.tglexp);
                    }
                }
            })
        });
        $.ajax({
            type: "POST",
            url: site_url+"sertifikasi/get_jenis_sertifikasi",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#jenisSertifikasi").html(data.srt);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator");
                    $("#addSimpanSertifikasi").remove();
                    $("#addResetSertifikasi").remove();
                }
            }
        });
        $.ajax({
            type: "POST",
            url: site_url+"sertifikasi/get_jenis_sertifikasi",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#jenisSertifikasiEdit").html(data.srt);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator");
                    $("#addSimpanSertifikasi").remove();
                    $("#addResetSertifikasi").remove();
                }
            }
        });
        $('#namaLengkap').keyup(function(e) {
            let nama = $('#namaLengkap').val().trim();

            if (nama != "") {
                $('.errorNamaLengkap').html('');
            } else {
                $('.errorNamaLengkap').html('<p>Nama lengkap wajib diisi</p>');
            }
        });
        $('#tempatLahir').keyup(function(e) {
            let tmp_lahir = $('#tempatLahir').val().trim();

            if (tmp_lahir != "") {
                $('.errorTempatLahir').html('');
            } else {
                $('.errorTempatLahir').html('<p>Tempat lahir wajib diisi</p>');
            }
        });
        $('#tanggalLahir').keyup(function(e) {
            let tgl_lahir = $('#tanggalLahir').val().trim();

            if (tgl_lahir != "") {
                $('.errorTanggalLahir').html('');
            } else {
                $('.errorTanggalLahir').html('<p>Tanggal lahir wajib diisi</p>');
            }
        });
        $('#tanggalLahir').change(function() {
            let tgl_lahir = $('#tanggalLahir').val().trim();

            if (tgl_lahir != "") {
                $('.errorTanggalLahir').html('');
            } else {
                $('.errorTanggalLahir').html('<p>Tanggal lahir wajib diisi</p>');
            }
        });
        $('#namaIbu').keyup(function(e) {
            let tgl_lahir = $('#namaIbu').val().trim();

            if (tgl_lahir != "") {
                $('.errorNamaIbu').html('');
            } else {
                $('.errorNamaIbu').html('<p>Nama ibu kandung wajib diisi</p>');
            }
        });
        $('#noNPWP').keyup(function(e) {
            let nonpwp = $('#noNPWP').val().trim();

            if (nonpwp != "") {
                jmlnpwp = nonpwp.replace(/['.'|_|-]/g, '');
                jml = jmlnpwp.length;

                if (jml < 15) {
                    $('.errorNoNPWP').html('<p>No. NPWP minimal 15 karakter</p>');
                } else {
                    $('.errorNoNPWP').html('');
                }
            } else {
                $('.errorNoNPWP').html('');
            }
        });
        $('#noKTP').keyup(function(e) {
            let noktp = $('#noKTP').val().trim();
            let jmlhrf = $('#noKTP').val().length;

            if (noktp != "") {
                if (jmlhrf > 16) {
                    $('.errorNoKTP').html('<p>No. KTP maksimal 16 karakter</p>');
                } else if (jmlhrf < 16) {
                    $('.errorNoKTP').html('<p>No. KTP minimal 16 karakter</p>');
                } else {
                    $('.errorNoKTP').html('');
                }
            }
        });
        $('#noKK').keyup(function(e) {
            let noKK = $('#noKK').val().trim();
            let jmlhrf = $('#noKK').val().length;

            if (noKK != "") {
                if (jmlhrf > 16) {
                    $('.errorNoKK').html('<p>No. KK maksimal 16 karakter</p>');
                } else if (jmlhrf < 16) {
                    $('.errorNoKK').html('<p>No. KK minimal 16 karakter</p>');
                } else {
                    $('.errorNoKK').html('');
                }
            }
        });
        $('#alamatKTP').keyup(function(e) {
            let alamat = $('#alamatKTP').val().trim();

            if (alamat != "") {
                $('.errorAlamatKTP').html('');
            } else {
                $('.errorAlamatKTP').html('<p>Alamat wajib diisi</p>');
            }
        });

        $("#addSimpanPersonal").click(function() {
            let auth_per = $("#addPerKary").val();
            let noktp_old = $(".9d56835ae6e4d20993874daf592f6aca").text();
            let nokk_old = $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text();
            let no_nik_old = $(".c1492f38214db699dfd3574b2644271d").text();
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
            let noktp = $("#noKTP").val();
            let nama = $("#namaLengkap").val();
            let alamat = $("#alamatKTP").val();
            let rt = $("#rtKTP").val();
            let rw = $("#rwKTP").val();
            let id_prov = $("#provData").val();
            let id_kab = $("#kotaData").val();
            let id_kec = $("#kecData").val();
            let id_kel = $("#kelData").val();
            let tmp_lahir = $("#tempatLahir").val();
            let tgl_lahir = $("#tanggalLahir").val();
            let stat_nikah = $("#statPernikahan").val();
            let id_agama = $("#addagama").val();
            let warga = $("#kewarganegaraan").val();
            let jk = $("#jenisKelamin").val();
            let email = $("#emailPribadi").val();
            let telp = $("#noTelp").val();
            let bpjs_tk = $("#noBPJSTK").val();
            let bpjs_kes = $("#noBPJSKES").val();
            let nokk = $("#noKK").val();
            let namaibu = $("#namaIbu").val();
            let npwp = $('#noNPWP').val();
            let cek_log = md5(new Date().toLocaleString());

            $.ajax({
                type: "POST",
                url: site_url+"karyawan/addpersonal",
                data: {
                    noktp_old: noktp_old,
                    nokk_old: nokk_old,
                    no_nik_old: no_nik_old,
                    noktp: noktp,
                    nama: nama,
                    alamat: alamat,
                    rt: rt,
                    rw: rw,
                    id_prov: id_prov,
                    id_kab: id_kab,
                    id_kec: id_kec,
                    id_kel: id_kel,
                    tmp_lahir: tmp_lahir,
                    tgl_lahir: tgl_lahir,
                    stat_nikah: stat_nikah,
                    id_agama: id_agama,
                    warga: warga,
                    jk: jk,
                    email: email,
                    telp: telp,
                    bpjs_tk: bpjs_tk,
                    bpjs_kes: bpjs_kes,
                    npwp: npwp,
                    nokk: nokk,
                    namaibu: namaibu,
                    auth_per: auth_per,
                    auth_person: auth_person
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $('#colKaryawan').collapse("show");
                        $('#colPersonal').collapse("hide");
                        $('#imgPersonal').removeClass("d-none");
                        $('.noktpshow').val(noktp);
                        $('.namalengkapshow').val(nama);
                        $(".89kjm78ujki782m4x787909h3").text(cek_log);
                        aktifKaryawan();
                    } else if (data.statusCode == 201) {
                        swal("Error", data.pesan, "error");
                    } else {
                        $(".errorNoKTP").html(data.noktp);
                        $(".errorNamaLengkap").html(data.nama);
                        $(".errorAlamatKTP").html(data.alamat);
                        $(".errorRtKTP").html(data.rt);
                        $(".errorRwKTP").html(data.rw);
                        $(".errorProvData").html(data.id_prov);
                        $(".errorKotaData").html(data.id_kab);
                        $(".errorKecData").html(data.id_kec);
                        $(".errorKelData").html(data.id_kel);
                        $(".errorTempatLahir").html(data.tmp_lahir);
                        $(".errorTanggalLahir").html(data.tgl_lahir);
                        $(".errorStatPernikahan").html(data.stat_nikah);
                        $(".errorAddAgama").html(data.id_agama);
                        $(".errorKewarganegaraan").html(data.warga);
                        $(".errorJenisKelamin").html(data.jk);
                        $(".errorEmailPribadi").html(data.email);
                        $(".errorNoTelp").html(data.telp);
                        $(".errorNoBPJSTK").html(data.bpjs_tk);
                        $(".errorNoBPJSKES").html(data.bpjs_kes);
                        $(".errorNoNPWP").html(data.npwp);
                        $(".errorNoKK").html(data.nokk);
                        $(".errorNamaIbu").html(data.namaibu);
                        swal("Error", "Tidak dapat melanjutkan, lengkapi data personal.", "error");
                        window.scrollTo(0, 0);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat menyimpan data, hubungi administrator");
                    }
                }
            });

            $(".errormsg").fadeTo(3000, 500).slideUp(500, function() {
                $(".errormsg").slideUp(500);
                $(".errormsg").addClass("d-none");
            });
        });

        $("#addKembaliPekerjaan").click(function() {
            $('#colKaryawan').collapse("hide");
            $('#colPersonal').collapse("show");
        });

        $("#addSimpanPekerjaan").click(function() {
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
            let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
            let auth_alamat = $(".150b3427b97bb43ac2fb3e5c687e384c").text();
            let no_nik_old = $(".c1492f38214db699dfd3574b2644271d").text();
            let noktp_old = $(".9d56835ae6e4d20993874daf592f6aca").text();
            let nokk_old = $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text();
            let noktp = $("#noKTP").val();
            let nama = $("#namaLengkap").val();
            let alamat = $("#alamatKTP").val();
            let rt = $("#rtKTP").val();
            let rw = $("#rwKTP").val();
            let id_prov = $("#provData").val();
            let id_kab = $("#kotaData").val();
            let id_kec = $("#kecData").val();
            let id_kel = $("#kelData").val();
            let tmp_lahir = $("#tempatLahir").val();
            let tgl_lahir = $("#tanggalLahir").val();
            let stat_nikah = $("#statPernikahan").val();
            let id_agama = $("#addagama").val();
            let warga = $("#kewarganegaraan").val();
            let jk = $("#jenisKelamin").val();
            let email = $("#emailPribadi").val();
            let telp = $("#noTelp").val();
            let bpjs_tk = $("#noBPJSTK").val();
            let bpjs_kes = $("#noBPJSKES").val();
            let npwp = $("#noNPWP").val();
            let nokk = $("#noKK").val();
            let namaibu = $("#namaIbu").val();
            let id_pendidikan = $("#pendidikanTerakhir").val();
            let no_nik = $("#addNIKKary").val();
            let depart = $("#addDepartKary").val();
            let posisi = $("#addPosisiKary").val();
            let doh = $("#addDOH").val();
            let tgl_aktif = $("#addTanggalAktif").val();
            let id_lokker = $("#addLokasiKerja").val();
            let id_lokterima = $("#addLokterimaKary").val();
            let id_poh = $("#addPOHKary").val();
            let id_klasifikasi = $("#addKlasifikasiKary").val();
            let id_tipe = $("#addTipeKaryawan").val();
            let id_level = $("#addLevelKary").val();
            let stat_tinggal = $("#addStatusResidence").val();
            let stat_kerja = $("#addStatusKaryawan").val();
            let email_kantor = $("#addEmailKantor").val();
            let tgl_permanen = $("#addTanggalPermanen").val();
            let tgl_mulai_kontrak = $("#addTanggalKontrakAwal").val();
            let tgl_akhir_kontrak = $("#addTanggalKontrakAkhir").val();
            let id_m_perusahaan = $("#addPerKary").val();
            let auth_check = $(".89kjm78ujki782m4x787909h3").text();

            if (auth_person != "") {
                $.ajax({
                    type: "POST",
                    url: site_url+"karyawan/addkaryawan",
                    data: {
                        auth_person: auth_person,
                        auth_kary: auth_kary,
                        auth_alamat: auth_alamat,
                        no_nik_old: no_nik_old,
                        noktp_old: noktp_old,
                        nokk_old: nokk_old,
                        noktp: noktp,
                        nama: nama,
                        alamat: alamat,
                        rt: rt,
                        rw: rw,
                        id_prov: id_prov,
                        id_kab: id_kab,
                        id_kec: id_kec,
                        id_kel: id_kel,
                        tmp_lahir: tmp_lahir,
                        tgl_lahir: tgl_lahir,
                        stat_nikah: stat_nikah,
                        id_agama: id_agama,
                        warga: warga,
                        jk: jk,
                        email: email,
                        telp: telp,
                        bpjs_tk: bpjs_tk,
                        bpjs_kes: bpjs_kes,
                        npwp: npwp,
                        nokk: nokk,
                        namaibu: namaibu,
                        id_pendidikan: id_pendidikan,
                        auth_kary: auth_kary,
                        no_nik: no_nik,
                        depart: depart,
                        posisi: posisi,
                        doh: doh,
                        tgl_aktif: tgl_aktif,
                        id_lokker: id_lokker,
                        id_lokterima: id_lokterima,
                        id_poh: id_poh,
                        id_klasifikasi: id_klasifikasi,
                        id_tipe: id_tipe,
                        id_level: id_level,
                        stat_tinggal: stat_tinggal,
                        stat_kerja: stat_kerja,
                        email_kantor: email_kantor,
                        tgl_permanen: tgl_permanen,
                        tgl_mulai_kontrak: tgl_mulai_kontrak,
                        tgl_akhir_kontrak: tgl_akhir_kontrak,
                        id_m_perusahaan: id_m_perusahaan,
                        auth_check: auth_check
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $('.0c09efa8ccb5e0114e97df31736ce2e3').text(data.auth_person);
                            $('.a6b73b5c154d3540919ddf46edf3b84e').text(data.auth_kary);
                            $('.150b3427b97bb43ac2fb3e5c687e384c').text(data.auth_alamat);
                            $(".9d56835ae6e4d20993874daf592f6aca").text(data.no_ktp);
                            $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text(data.no_kk);
                            $(".c1492f38214db699dfd3574b2644271d").text(data.nik);
                            $('#colPersonal').collapse("hide");
                            $('#colKaryawan').collapse("hide");
                            $('#colIzinTambang').collapse("show");
                            $("#idizintambang").load(site_url+"karyawan/izin_tambang");
                            $('#imgKaryawan').removeClass("d-none");
                            $('#noktpshow').val(noktp);
                            $('#namalengkapshow').val(nama);
                            aktifSIMPER();
                            swal("Berhasil", "Lengkapi data selanjutnya", "success");
                            $.LoadingOverlay("hide");
                        } else if (data.statusCode == 201) {
                            $(".errmsgKary").removeClass('d-none');
                            $(".errmsgKary").removeClass('alert-primary');
                            $(".errmsgKary").addClass('alert-danger');
                            $(".errmsgKary").html(data.pesan);
                            $.LoadingOverlay("hide");
                        } else {
                            $(".erroraddNIKKary").html(data.no_nik);
                            $(".errorAddDepartKary").html(data.depart);
                            $(".errorAddPosisiKary").html(data.posisi);
                            $(".errorAddKlasifikasiKary").html(data.id_klasifikasi);
                            $(".erroraddPOHKary").html(data.id_poh);
                            $(".erroraddLokterimaKary").html(data.id_lokterima);
                            $(".erroraddLokasiKerja").html(data.id_lokker);
                            $(".erroraddLevelKary").html(data.id_level);
                            $(".erroraddStatusResidence").html(data.stat_tinggal);
                            $(".erroraddDOH").html(data.doh);
                            $(".erroraddTanggalAktif").html(data.tgl_aktif);
                            $(".erroraddTipeKaryawan").html(data.id_tipe);
                            $(".erroraddJenisKaryawan").html(data.stat_kerja);
                            $(".erroraddEmail").html(data.email_kantor);
                            $(".erroraddTanggalPermanen").html(data.pesan);
                            $(".erroraddTanggalKontrakAwal").html(data.pesan1);
                            $(".erroraddTanggalKontrakAkhir").html(data.pesan2);
                            swal("Error", "Tidak dapat melanjutkan, lengkapi data karyawan.", "error");
                            $.LoadingOverlay("hide");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".errmsgKary").removeClass('d-none');
                        $(".errmsgKary").addClass('alert-danger');
                        if (thrownError != "") {
                            $(".errmsgKary").html("Terjadi kesalahan saat menyimpan data karyawan, hubungi administrator");
                        }
                    }
                });
            } else {
                swal({
                    title: "Simpan Data",
                    text: "Yakin data karyawan akan disimpan?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#36c6d3',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, simpan',
                    cancelButtonText: 'Batalkan'
                }).then(function(result) {
                    if (result.value) {
                        $.LoadingOverlay("show");
                        $.ajax({
                            type: "POST",
                            url: site_url+"karyawan/addkaryawan",
                            data: {
                                auth_person: auth_person,
                                auth_kary: auth_kary,
                                auth_alamat: auth_alamat,
                                no_nik_old: no_nik_old,
                                noktp_old: noktp_old,
                                nokk_old: nokk_old,
                                noktp: noktp,
                                nama: nama,
                                alamat: alamat,
                                rt: rt,
                                rw: rw,
                                id_prov: id_prov,
                                id_kab: id_kab,
                                id_kec: id_kec,
                                id_kel: id_kel,
                                tmp_lahir: tmp_lahir,
                                tgl_lahir: tgl_lahir,
                                stat_nikah: stat_nikah,
                                id_agama: id_agama,
                                warga: warga,
                                jk: jk,
                                email: email,
                                telp: telp,
                                bpjs_tk: bpjs_tk,
                                bpjs_kes: bpjs_kes,
                                npwp: npwp,
                                nokk: nokk,
                                namaibu: namaibu,
                                id_pendidikan: id_pendidikan,
                                auth_kary: auth_kary,
                                no_nik: no_nik,
                                depart: depart,
                                posisi: posisi,
                                doh: doh,
                                tgl_aktif: tgl_aktif,
                                id_lokker: id_lokker,
                                id_lokterima: id_lokterima,
                                id_poh: id_poh,
                                id_klasifikasi: id_klasifikasi,
                                id_tipe: id_tipe,
                                id_level: id_level,
                                stat_tinggal: stat_tinggal,
                                stat_kerja: stat_kerja,
                                email_kantor: email_kantor,
                                tgl_permanen: tgl_permanen,
                                tgl_mulai_kontrak: tgl_mulai_kontrak,
                                tgl_akhir_kontrak: tgl_akhir_kontrak,
                                id_m_perusahaan: id_m_perusahaan,
                                auth_check: auth_check
                            },
                            success: function(data) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    $('.0c09efa8ccb5e0114e97df31736ce2e3').text(data.auth_person);
                                    $('.a6b73b5c154d3540919ddf46edf3b84e').text(data.auth_kary);
                                    $('.150b3427b97bb43ac2fb3e5c687e384c').text(data.auth_alamat);
                                    $(".9d56835ae6e4d20993874daf592f6aca").text(data.no_ktp);
                                    $(".9100fd1e98da52ac823c5fdc6d3e4ff1").text(data.no_kk);
                                    $(".c1492f38214db699dfd3574b2644271d").text(data.nik);
                                    $('#colPersonal').collapse("hide");
                                    $('#colKaryawan').collapse("hide");
                                    $('#colIzinTambang').collapse("show");
                                    $("#idizintambang").load(site_url+"karyawan/izin_tambang");
                                    $('#imgKaryawan').removeClass("d-none");
                                    $('#noktpshow').val(noktp);
                                    $('#namalengkapshow').val(nama);
                                    aktifSIMPER();
                                    swal("Berhasil", "Data karyawan berhasil disimpan, lengkapi data selanjutnya", "success");
                                    $.LoadingOverlay("hide");
                                } else if (data.statusCode == 201) {
                                    $(".errmsgKary").removeClass('d-none');
                                    $(".errmsgKary").removeClass('alert-primary');
                                    $(".errmsgKary").addClass('alert-danger');
                                    $(".errmsgKary").html(data.pesan);
                                    $.LoadingOverlay("hide");
                                } else {
                                    $(".erroraddNIKKary").html(data.no_nik);
                                    $(".errorAddDepartKary").html(data.depart);
                                    $(".errorAddPosisiKary").html(data.posisi);
                                    $(".errorAddKlasifikasiKary").html(data.id_klasifikasi);
                                    $(".erroraddPOHKary").html(data.id_poh);
                                    $(".erroraddLokterimaKary").html(data.id_lokterima);
                                    $(".erroraddLokasiKerja").html(data.id_lokker);
                                    $(".erroraddLevelKary").html(data.id_level);
                                    $(".erroraddStatusResidence").html(data.stat_tinggal);
                                    $(".erroraddDOH").html(data.doh);
                                    $(".erroraddTanggalAktif").html(data.tgl_aktif);
                                    $(".erroraddTipeKaryawan").html(data.id_tipe);
                                    $(".erroraddJenisKaryawan").html(data.stat_kerja);
                                    $(".erroraddEmail").html(data.email_kantor);
                                    $(".erroraddTanggalPermanen").html(data.pesan);
                                    $(".erroraddTanggalKontrakAwal").html(data.pesan1);
                                    $(".erroraddTanggalKontrakAkhir").html(data.pesan2);
                                    swal("Error", "Tidak dapat melanjutkan, lengkapi data karyawan.", "error");
                                    $.LoadingOverlay("hide");
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".errmsgKary").removeClass('d-none');
                                $(".errmsgKary").addClass('alert-danger');
                                if (thrownError != "") {
                                    $(".errmsgKary").html("Terjadi kesalahan saat menyimpan data karyawan, hubungi administrator");
                                }
                            }
                        });
                    }
                });
            }


            $(".errormsg").fadeTo(5000, 500).slideUp(500, function() {
                $(".errormsg").slideUp(500);
                $(".errormsg").addClass("d-none");
            });
        });

        $('#addJenisIzin').change(function() {
            let jenisizin = $('#addJenisIzin').val();
            let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();

            $.ajax({
                type: "POST",
                url: site_url+"izin_tambang/cek_jenisizin",
                data: {
                    auth_izin: auth_izin,
                    jenisizin: jenisizin
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        swal({
                            title: "Ganti Jenis Izin",
                            text: data.pesan,
                            type: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#36c6d3',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, ganti',
                            cancelButtonText: 'Batalkan'
                        }).then(function(result) {
                            if (result.value) {
                                $.ajax({
                                    type: "POST",
                                    url: site_url+"izin_tambang/hapus_unit_all",
                                    data: {
                                        auth_izin: auth_izin
                                    },
                                    success: function(data) {
                                        var data = JSON.parse(data);
                                        $('#txtsim').addClass('d-none');
                                        $('#txtunit').addClass('d-none');
                                        $('#addTglExpSIM').val('');
                                        $(".simperunit").collapse("hide");
                                        $("#addJenisSIM").val('').trigger('change');
                                        $("#idizintambang").LoadingOverlay("show");
                                        $("#idizintambang").load(site_url+"izin_tambang/izin_tambang?auth_izin=" + 0);
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        $.LoadingOverlay("hide");
                                        $(".errormsgizin").removeClass('d-none');
                                        $(".errormsgizin").removeClass('alert-info');
                                        $(".errormsgizin").addClass('alert-danger');
                                        if (thrownError != "") {
                                            $(".errormsgizin").html("Terjadi kesalahan saat load data jenis SIMPER, hubungi administrator");
                                        }
                                    }
                                });
                            } else if (result.dismiss == 'cancel') {
                                $("#addJenisIzin").val('SP').trigger('change');
                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsgizin").removeClass('d-none');
                    $(".errormsgizin").removeClass('alert-info');
                    $(".errormsgizin").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsgizin").html("Terjadi kesalahan saat load data SIM, hubungi administrator");
                    }
                }
            });

            if (jenisizin == "SP") {
                $('#txtsim').removeClass('d-none');
                $('#txtunit').removeClass('d-none');
                $(".simperunit").collapse("show");
            } else {
                $('#txtsim').addClass('d-none');
                $('#txtunit').addClass('d-none');
                $(".simperunit").collapse("hide");
            }
        });

        $('#addTglExpSIM').change(function() {
            let tglsim = $('#addTglExpSIM').val();

            $.ajax({
                type: "POST",
                url: site_url+"izin_tambang/tgl_exp_izin",
                data: {
                    tglsim: tglsim
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $('#addTglExp').val(data.tglexpizin);
                        $('#addTglExp').removeAttr('disabled');
                        $(".errormsgizin").addClass("d-none");
                    } else {
                        $(".errormsgizin").removeClass('d-none');
                        $(".errormsgizin").removeClass('alert-info');
                        $(".errormsgizin").addClass('alert-danger');
                        $(".errormsgizin").html(data.pesan);
                        $('#addTglExp').val('');
                        $('#addTglExp').attr('disabled', true);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsgizin").removeClass('d-none');
                    $(".errormsgizin").removeClass('alert-info');
                    $(".errormsgizin").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsgizin").html("Terjadi kesalahan saat membuat tanggal izin");
                    }
                }

            });
        });

        $("#addSimpanIzinUnit").click(function() {
            let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
            let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();
            let jenisizin = $("#addJenisIzin").val();
            let noreg = $("#addNoReg").val();
            let tglexp = $("#addTglExp").val();
            let jenissim = $("#addJenisSIM").val();
            let tglexpsim = $("#addTglExpSIM").val();

            $.ajax({
                type: "POST",
                url: site_url+"karyawan/addsimper",
                data: {
                    jenisizin: jenisizin,
                    noreg: noreg,
                    tglexp: tglexp,
                    jenissim: jenissim,
                    tglexpsim: tglexpsim,
                    auth_izin: auth_izin,
                    auth_kary: auth_kary
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        if (auth_izin == "") {
                            $(".ecb14fe704e08d9df8e343030bbbafcb").text(data.auth_izin);
                        }
                        aktifSertifikat();
                        $('#colPersonal').collapse("hide");
                        $('#colKaryawan').collapse("hide");
                        $('#colIzinTambang').collapse("hide");
                        $('#colSertifikasi').collapse("show");
                        $('#imgIzinTambang').removeClass("d-none");
                    } else if (data.statusCode == 201) {
                        $(".errormsgizin").removeClass('d-none');
                        $(".errormsgizin").removeClass('alert-primary');
                        $(".errormsgizin").addClass('alert-danger');
                        $(".errormsgizin").html(data.pesan);
                    } else {
                        $(".erroraddJenisIzin").html(data.jenisizin);
                        $(".erroraddNoReg").html(data.noreg);
                        $(".erroraddTglExp").html(data.tglexp);
                        $(".erroraddJenisSIM").html(data.jenissim);
                        $(".erroraddTglExpSIM").html(data.tglexpsim);
                        swal("Error", "Tidak dapat melanjutkan, lengkapi data SIMPER/Mine Permit.", "error");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsgizin").removeClass('d-none');
                    $(".errormsgizin").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsgizin").html("Terjadi kesalahan saat menyimpan data SIMPER/Mine Permit, hubungi administrator");
                    }
                }
            });

            $(".errormsgizin").fadeTo(5000, 500).slideUp(500, function() {
                $(".errormsgizin").slideUp(500);
                $(".errormsgizin").addClass("d-none");
            });
        });

        $("#addSimpanSertifikasi").click(function() {
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
            let jenissrt = $("#jenisSertifikasi").val();
            let nosrt = $("#noSertifikat").val();
            let tglsrt = $("#tanggalSertifikasi").val();
            let tglexp = $("#tanggalSertifikasiAkhir").val();
            let namalembaga = $("#namaLembaga").val();
            let filesrt = $("#fileSertifikasi").val();
            const flsert = $('#fileSertifikasi').prop('files')[0];

            let formData = new FormData();
            formData.append('filesertifikat', flsert);
            formData.append('filesrt', filesrt);
            formData.append('jenissrt', jenissrt);
            formData.append('nosrt', nosrt);
            formData.append('tglsrt', tglsrt);
            formData.append('tglexp', tglexp);
            formData.append('namalembaga', namalembaga);
            formData.append('auth_person', auth_person);

            $.ajax({
                type: 'POST',
                url: site_url+"karyawan/addsertifikasi",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#jenisSertifikasi").val('').trigger("change");
                        $("#noSertifikat").val('');
                        $("#tanggalSertifikasi").val('');
                        $("#masaBerlakuSertifikat").val('');
                        $("#tanggalSertifikasiAkhir").val('');
                        $("#fileSertifikasi").val('');
                        $("#namaLembaga").val('');
                        $(".errorFileSertifikasi").html("");
                        $(".errorjenisSertifikasi").html('');
                        $(".errorNoSertifikat").html('');
                        $(".errorTanggalSertifikasi").html('');
                        $(".errorTanggalSertifikasiAkhir").html('');
                        $(".errorFileSertifikasi").html('');
                        $(".errorNamaLembaga").html('');
                        $("#idsertifikat").LoadingOverlay("show");
                        $("#idsertifikat").load(site_url+"karyawan/sertifikasi?auth_person=" + auth_person);
                        swal('Berhasil', 'Data sertifikasi berhasil disimpan', 'success');
                    } else if (data.statusCode == 201) {
                        $(".errormsgsertifikasi").removeClass('d-none');
                        $(".errormsgsertifikasi").removeClass('alert-primary');
                        $(".errormsgsertifikasi").addClass('alert-danger');
                        $(".errormsgsertifikasi").html(data.pesan);
                    } else {
                        $(".errorjenisSertifikasi").html(data.jenissrt);
                        $(".errorNoSertifikat").html(data.nosrt);
                        $(".errorTanggalSertifikasi").html(data.tglsrt);
                        $(".errorTanggalSertifikasiAkhir").html(data.tglexp);
                        $(".errorFileSertifikasi").html(data.filesrt);
                        $(".errorNamaLembaga").html(data.namalembaga);
                        swal("Error", "Tidak dapat melanjutkan, lengkapi data sertifikasi.", "error");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsgsertifikasi").removeClass('d-none');
                    $(".errormsgsertifikasi").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsgsertifikasi").html("Terjadi kesalahan saat menyimpan data sertifikat, hubungi administrator");
                    }
                }
            });

            $(".errormsgsertifikasi").fadeTo(5000, 500).slideUp(500, function() {
                $(".errormsgsertifikasi").slideUp(500);
                $(".errormsgsertifikasi").addClass("d-none");
            });
        });

        $("#addKembaliIzinUnit").click(function() {
            $('#colKaryawan').collapse("show");
            $('#colIzinTambang').collapse("hide");
        });

        $("#addLanjutSertifikasi").click(function() {
            $('#colPersonal').collapse("hide");
            $('#colKaryawan').collapse("hide");
            $('#colIzinTambang').collapse("hide");
            $('#colSertifikasi').collapse("hide");
            $('#colMCU').collapse("show");
            $('#imgSertifikasi').removeClass("d-none");
            aktifMCU();
        });

        $("#addbtnkembaliSertifikat").click(function() {
            $('#colSertifikasi').collapse("hide");
            $('#colIzinTambang').collapse("show");
        });

        $("#addbtnkembaliMCU").click(function() {
            $('#colMCU').collapse("hide");
            $('#colSertifikasi').collapse("show");
        });

        $("#addSimpanMCU").click(function() {
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
            let auth_mcu = $(".90dea748042796037c02b4cf2b388b03").text();
            let filemcu_old = $(".35d23dc4f4239e74ae49ee0b3e972586").text();
            let tglmcu = $("#tglMCU").val();
            let hasilmcu = $("#hasilMCU").val();
            let ketmcu = $("#ketMCU").val();
            let fileMCU = $("#fileMCU").val();
            const flMCU = $('#fileMCU').prop('files')[0];

            let formData = new FormData();
            formData.append('filemedik', flMCU);
            formData.append('ketmcu', ketmcu);
            formData.append('hasilmcu', hasilmcu);
            formData.append('tglmcu', tglmcu);
            formData.append('auth_person', auth_person);
            formData.append('auth_mcu', auth_mcu);
            formData.append('filemcu_old', filemcu_old);
            $.ajax({
                type: 'POST',
                url: site_url+"karyawan/addmcu",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $(".errorTglMCU").html('');
                        $(".errorHasilMCU").html('');
                        $(".errorKetMCU").html('');
                        $(".errorFileMCU").html('');
                        $("#colVaksin").collapse("show");
                        $("#colMCU").collapse("hide");
                        $('#imgMCU').removeClass("d-none");
                        $('#addTampilkanMCU').removeClass("disabled");
                        $('#addTampilkanMCU').attr("href", data.link);
                        $('#addHapusMCU').removeClass("disabled");
                        $(".90dea748042796037c02b4cf2b388b03").text(data.auth_mcu);
                        $(".35d23dc4f4239e74ae49ee0b3e972586").text(data.filemcu_old);
                        swal('Berhasil', 'Data MCU berhasil disimpan', 'success');
                        aktifVaksin();
                    } else if (data.statusCode == 201) {
                        $(".errormsgmcu").removeClass('d-none');
                        $(".errormsgmcu").removeClass('alert-primary');
                        $(".errormsgmcu").addClass('alert-danger');
                        $(".errormsgmcu").html(data.pesan);
                    } else {
                        $(".errorTglMCU").html(data.tglmcu);
                        $(".errorHasilMCU").html(data.hasilmcu);
                        $(".errorKetMCU").html(data.ketmcu);

                        if (fileMCU == "") {
                            $(".errorFileMCU").html('File MCU wajib di-upload');
                        } else {
                            $(".errorFileMCU").html(data.filmcu);
                        }

                        swal("Error", "Tidak dapat melanjutkan, lengkapi data Medical Check Up (MCU).", "error");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsgmcu").removeClass('d-none');
                    $(".errormsgmcu").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errMCU").html("Terjadi kesalahan saat menyimpan data MCU, hubungi administrator");
                    }
                }
            });

            $(".errormsgmcu").fadeTo(5000, 500).slideUp(500, function() {
                $(".errormsgmcu").slideUp(500);
                $(".errormsgmcu").addClass("d-none");
            });
        });

        $("#addHapusMCU").click(function() {
            let auth_mcu = $(".90dea748042796037c02b4cf2b388b03").text();

            if (auth_mcu != "") {
                swal({
                    title: "Hapus MCU",
                    text: "Yakin data MCU akan dihapus? termasuk file yang telah di-upload",
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
                            url: site_url+"karyawan/hapus_mcu",
                            data: {
                                auth_mcu: auth_mcu
                            },
                            success: function(data) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    $('#tglMCU').val('');
                                    $('#hasilMCU').val('');
                                    $('#ketMCU').val('');
                                    $('#fileMCU').val('');
                                    $('.errorTglMCU').text('');
                                    $('.errorHasilMCU').text('');
                                    $('.errorKetMCU').text('');
                                    $('.errorFileMCU').text('');
                                    $('#addTampilkanMCU').attr('href', '');
                                    $('#imgMCU').addClass('d-none');
                                    $('#addTampilkanMCU').addClass('disabled');
                                    $('#addHapusMCU').addClass('disabled');
                                    $('.90dea748042796037c02b4cf2b388b03').text('');
                                    $.LoadingOverlay("hide");
                                    swal('Berhasil', data.pesan, 'success');
                                } else if (data.statusCode == 201) {
                                    swal('Error', data.pesan, 'error');
                                    $.LoadingOverlay("hide");
                                } else {
                                    $(".errormsgmcu").removeClass('d-none');
                                    $(".errormsgmcu").removeClass('alert-primary');
                                    $(".errormsgmcu").addClass('alert-danger');
                                    $(".errormsgmcu").html(data.pesan);
                                    $.LoadingOverlay("hide");
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".errormsgmcu").removeClass('d-none');
                                $(".errormsgmcu").addClass('alert-danger');
                                if (thrownError != "") {
                                    $(".errormsgmcu").html("Terjadi kesalahan saat menghapus data MCU, hubungi administrator");
                                }
                            }
                        });
                    }
                });
            } else {
                $(".errormsgmcu").removeClass('d-none');
                $(".errormsgmcu").removeClass('alert-primary');
                $(".errormsgmcu").addClass('alert-danger');
                $(".errormsgmcu").html('Belum ada data MCU yang disimpan');
            }

            $(".errormsgmcu").fadeTo(5000, 500).slideUp(500, function() {
                $(".errormsgmcu").slideUp(500);
                $(".errormsgmcu").addClass("d-none");
            });
        });

        $("#addbtnkembalivaksin").click(function() {
            $('#colVaksin').collapse("hide");
            $('#colMCU').collapse("show");
        });

        $("#addLanjutkanVaksin").click(function() {
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

            $.ajax({
                type: "POST",
                url: site_url+"karyawan/cek_vaksin",
                data: {
                    auth_person: auth_person
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $('#colVaksin').collapse("hide");
                        $('#colFilePendukung').collapse("show");
                        $('#imgVaksin').removeClass("d-none");
                        aktifFilePendukung();
                    } else if (data.statusCode == 201) {
                        swal('Error', 'Tidak dapat melanjutkan, lengkapi data vaksin', 'error');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsgvaksin").removeClass('d-none');
                    $(".errormsgvaksin").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsgvaksin").html("Terjadi kesalahan saat load data vaksin, hubungi administrator");
                    }
                }
            });
        });

        $("#addResetVaksin").click(function() {
            $('#jnsVaksin').LoadingOverlay("show");
            $('#nmVaksin').LoadingOverlay("show");
            $('#tglVaksin').LoadingOverlay("show");
            $('#jenisVaksin').val('').trigger('change');
            $('#namaVaksin').val('').trigger('change');
            $('#tanggalVaksin').val('');
            $('#jnsVaksin').LoadingOverlay("hide");
            $('#nmVaksin').LoadingOverlay("hide");
            $('#tglVaksin').LoadingOverlay("hide");
        });

        $("#addSimpanVaksin").click(function() {
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
            let jenisvaksin = $("#jenisVaksin").val();
            let namavaksin = $("#namaVaksin").val();
            let tglvaksin = $("#tanggalVaksin").val();

            $.ajax({
                type: "POST",
                url: site_url+"karyawan/addvaksin",
                data: {
                    jenisvaksin: jenisvaksin,
                    namavaksin: namavaksin,
                    tglvaksin: tglvaksin,
                    auth_person: auth_person
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#idvaksin").LoadingOverlay("show");
                        $("#idvaksin").load(site_url+"karyawan/vaksin?auth_person=" + auth_person);
                        $('#jenisVaksin').val('').trigger('change');
                        $('#namaVaksin').val('').trigger('change');
                        $('#tanggalVaksin').val('');
                        swal('Berhasil', 'Data vaksin berhasil disimpan', 'success');
                    } else if (data.statusCode == 201) {
                        $(".errormsgvaksin").removeClass('d-none');
                        $(".errormsgvaksin").removeClass('alert-primary');
                        $(".errormsgvaksin").addClass('alert-danger');
                        $(".errormsgvaksin").html(data.pesan);
                    } else {
                        $(".errorJenisVaksin").html(data.jenisvaksin);
                        $(".errorNamaVaksin").html(data.namavaksin);
                        $(".errorTanggalVaksin").html(data.tglvaksin);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsgvaksin").removeClass('d-none');
                    $(".errormsgvaksin").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsgvaksin").html("Terjadi kesalahan saat menyimpan data vaksin, hubungi administrator");
                    }
                }
            });

            $(".errormsgvaksin").fadeTo(5000, 500).slideUp(500, function() {
                $(".errormsgvaksin").slideUp(500);
                $(".errormsgvaksin").addClass("d-none");
            });
        });

        $("#addbtnkembaliFile").click(function() {
            $('#colFilePendukung').collapse("hide");
            $('#colVaksin').collapse("show");
        });

        $('#addUploadFileSelesai').click(function() {
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
            let auth_kary = $(".a6b73b5c154d3540919ddf46edf3b84e").text();
            let auth_izin = $(".ecb14fe704e08d9df8e343030bbbafcb").text();
            let auth_mcu = $(".90dea748042796037c02b4cf2b388b03").text();

            swal({
                title: "Simpan Data",
                text: "Yakin data karyawan telah lengkap dan benar?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batalkan'
            }).then(function(result) {
                if (result.value) {
                    // $.LoadingOverlay("show");
                    $.ajax({
                        type: "POST",
                        url: site_url+"karyawan/cek_file",
                        data: {
                            auth_person: auth_person,
                            auth_kary: auth_kary,
                            auth_izin: auth_izin,
                            auth_mcu: auth_mcu
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $.LoadingOverlay("hide");
                                swal({
                                    title: "Sukses",
                                    text: "Data karyawan berhasil disimpan",
                                    type: 'success',
                                    confirmButtonColor: '#36c6d3',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ok'
                                }).then(function(result) {
                                    if (result.value) {
                                        $(".errorFilePendukung").html("");
                                        $("#fileUpload").val("");
                                        $('.noktpshow').val('');
                                        $('.namalengkapshow').val('');
                                        window.location.href = site_url+"karyawan/new";
                                    } else {
                                        $(".errorFilePendukung").html("");
                                        $("#fileUpload").val("");
                                        $('.noktpshow').val('');
                                        $('.namalengkapshow').val('');
                                        window.location.href = site_url+"karyawan/new";
                                    }
                                });
                            } else if (data.statusCode == 201) {
                                $(".errmsgfilependukung").removeClass('d-none');
                                $(".errmsgfilependukung").removeClass('alert-primary');
                                $(".errmsgfilependukung").addClass('alert-danger');
                                $(".errmsgfilependukung").html(data.pesan);
                            } else {}
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".errmsgfilependukung").removeClass('d-none');
                            $(".errmsgfilependukung").addClass('alert-danger');
                            if (thrownError != "") {
                                $(".errmsgfilependukung").html("Terjadi kesalahan saat menyimpan data vaksin, hubungi administrator");
                            }
                        }
                    });

                    $(".errmsgfilependukung").fadeTo(5000, 500).slideUp(500, function() {
                        $(".errmsgfilependukung").slideUp(500);
                        $(".errmsgfilependukung").addClass("d-none");
                    });

                }
            });
        });

        $("#addUploadFilePendukung").click(function() {
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();
            let filepdukung = $('#filePendukung').val();
            const fldukung = $('#filePendukung').prop('files')[0];

            if (filepdukung == "") {
                $(".errmsgfilependukung").removeClass('d-none');
                $(".errmsgfilependukung").removeClass('alert-primary');
                $(".errmsgfilependukung").addClass('alert-danger');
                $(".errmsgfilependukung").html('File pendukung wajib di-upload');

                $(".errmsgfilependukung").fadeTo(3000, 500).slideUp(500, function() {
                    $(".errmsgfilependukung").slideUp(500);
                    $(".errmsgfilependukung").addClass("d-none");
                    $(".errmsgfilependukung").html('');
                });

                return;
            }

            swal({
                title: "Upload File Pendukung",
                text: "Yakin file pendukung yang akan di-upload?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, upload',
                cancelButtonText: 'Batalkan'
            }).then(function(result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    let formData = new FormData();
                    formData.append('filePendukung', fldukung);
                    formData.append('auth_person', auth_person);
                    $.ajax({
                        type: 'POST',
                        url: site_url+"karyawan/addfilependukung",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                $.LoadingOverlay("hide");
                                $(".8k79k67h5h9k73j7f0l28jf689sd7").text(data.auth_cek);
                                $("#addTampilkanFilePendukung").attr("href", data.link);
                                $("#addHapusFilePendukung").removeClass("disabled");
                                $("#addTampilkanFilePendukung").removeClass("disabled");
                                $("#addUploadFilePendukung").addClass("disabled");
                            } else {
                                $.LoadingOverlay("hide");
                                $(".errmsgfilependukung").removeClass("d-none");
                                $(".errmsgfilependukung").removeClass("alert-primary]");
                                $(".errmsgfilependukung").addClass("alert-danger");
                                $(".errmsgfilependukung").html(data.pesan);
                            }
                        }
                    });
                }
            });
        });

        $("#addHapusFilePendukung").click(function() {
            let auth_person = $(".0c09efa8ccb5e0114e97df31736ce2e3").text();

            if (auth_person != "") {
                swal({
                    title: "Hapus File Pendukung",
                    text: "Yakin file pendukung akan di-hapus?",
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
                            url: site_url+"karyawan/hapus_filependukung",
                            data: {
                                auth_person: auth_person
                            },
                            success: function(data) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    $('#filePendukung').val('');
                                    $('#addTampilkanFilePendukung').addClass('disabled');
                                    $('#addTampilkanFilePendukung').attr('href', '');
                                    $('#addHapusFilePendukung').addClass('disabled');
                                    $('#addUploadFilePendukung').removeClass('disabled');
                                    swal('Berhasil', 'File pendukung berhasil dihapus', 'success');
                                    $.LoadingOverlay("hide");
                                } else if (data.statusCode == 201) {
                                    $(".errmsgfilependukung").removeClass("d-none");
                                    $(".errmsgfilependukung").removeClass("alert-primary]");
                                    $(".errmsgfilependukung").addClass("alert-danger");
                                    $(".errmsgfilependukung").html(data.pesan);
                                    $.LoadingOverlay("hide");
                                } else {
                                    $(".errorFilePendukung").html(data.errpesan);
                                    $.LoadingOverlay("hide");
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".errmsgfilependukung").removeClass('d-none');
                                $(".errmsgfilependukung").addClass('alert-danger');
                                if (thrownError != "") {
                                    $(".errmsgfilependukung").html("Terjadi kesalahan saat menghapus file pendukung, hubungi administrator");
                                }
                            }
                        });
                    }
                });
            } else {
                $.LoadingOverlay("hide");
                $(".errmsgfilependukung").removeClass("d-none");
                $(".errmsgfilependukung").removeClass("alert-primary]");
                $(".errmsgfilependukung").addClass("alert-danger");
                $(".errmsgfilependukung").html("Data personal tidak ditemukan");
            }

            $(".errmsgfilependukung").fadeTo(5000, 500).slideUp(500, function() {
                $(".errmsgfilependukung").slideUp(500);
                $(".errmsgfilependukung").addClass("d-none");
            });

        });

        $(document).on("click", ".btnSertifikasi ", function() {
            let auth_kary = $(this).attr("id");
            $(".8k23jnm89d56jl123mn90bv542ll").text(auth_kary);

            $.ajax({
                type: "POST",
                url: site_url+"sertifikasi/get_jenis_sertifikasi",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#jenisSertifikasiNew").html(data.srt);

                    $('#jenisSertifikasiNew').select2({
                        theme: 'bootstrap4',
                        dropdownParent: $('#mdlnewsertifikat')
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator");
                        $("#addSimpanSertifikasi").remove();
                        $("#addResetSertifikasi").remove();
                    }
                }
            });

            $("#jenisSertifikasiNew").val('').trigger('change');
            $("#noSertifikatNew").val('');
            $("#namaLembagaNew").val('');
            $("#tanggalSertifikasiNew").val('');
            $("#masaBerlakuSertifikatNew").val('').trigger('change');
            $("#tanggalSertifikasiAkhirNew").val('');
            $('#filePendukung').val('');
            $(".errorjenisSertifikasiNew").html('');
            $(".errorNoSertifikatNew").html('');
            $(".errorNamaLembagaNew").html('');
            $(".errorTanggalSertifikasiNew").html('');
            $(".errorTanggalSertifikasiAkhir").html('');
            $(".errorFileSertifikasi").html('');
            $("#mdlnewsertifikat").modal("show");
        });

        $(document).on("click", ".btnHapusKary", function() {
            let auth_kary = $(this).attr("id");
            let nama_kary = $(this).attr("value");

            swal({
                title: "Hapus Data Karyawan",
                text: "Yakin semua data karyawan atas nama : "+nama_kary+" akan dihapus? termasuk file yang telah diupload, data tidak dapat dikembalikan",
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
                        url: site_url+"karyawan/hapus_karyawan",
                        data: {
                            auth_kary:auth_kary
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            if(data.statusCode==200){
                                tbmKaryawan.draw();
                            } else {

                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".errormsg").removeClass('d-none');
                            $(".errormsg").removeClass('alert-info');
                            $(".errormsg").addClass('alert-danger');
                            if (thrownError != "") {
                                $(".errormsg").html("Terjadi kesalahan saat load data jenis sertifikasi, hubungi administrator");
                                $("#addSimpanSertifikasi").remove();
                                $("#addResetSertifikasi").remove();
                            }
                        }
                    });
                }
            });
        });

        $("#masaBerlakuSertifikatNew").change(function() {
            let tglsrt = $("#tanggalSertifikasiNew").val();
            let masa = $("#masaBerlakuSertifikatNew").val();

            $.ajax({
                type: "post",
                url: site_url+"sertifikasi/getdateexpmasa",
                data: {
                    tglsrt: tglsrt,
                    masa: masa
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#tanggalSertifikasiAkhirNew").val(data.tglexp);
                    }
                }
            })
        });

        $("#tanggalSertifikasiNew").change(function() {
            let tglsrt = $("#tanggalSertifikasiNew").val();
            let masa = $("#masaBerlakuSertifikatNew").val();

            $.ajax({
                type: "post",
                url: site_url+"sertifikasi/getdateexpsrt",
                data: {
                    tglsrt: tglsrt,
                    masa: masa
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#tanggalSertifikasiAkhirNew").val(data.tglexp);
                    }
                }
            })
        });

        $("#btnnewsertifikat").click(function() {
            let auth_kary = $(".8k23jnm89d56jl123mn90bv542ll").text();
            let jenis = $("#jenisSertifikasiNew").val();
            let no_ser = $("#noSertifikatNew").val();
            let lembaga = $("#namaLembagaNew").val();
            let tgl_ser = $("#tanggalSertifikasiNew").val();
            let tgl_akhir_ser = $("#tanggalSertifikasiAkhirNew").val();
            let file_ser = $('#fileSertifikasi').val();
            const fl_ser = $('#fileSertifikasi').prop('files')[0];

            if (auth_kary == "") {
                errkary = "Data karyawan tidak ditemukan";
            } else {
                errkary = "";

            }

            if (jenis == "") {
                errjenis = "Jenis sertifikasi wajib dipilih";
            } else {
                errjenis = "";

            }
            if (no_ser == "") {
                errno_ser = "No. sertifikasi wajib diisi";
            } else {
                errno_ser = "";

            }
            if (lembaga == "") {
                errlembaga = "Lembaga wajib diisi";
            } else {
                errlembaga = "";

            }
            if (tgl_ser == "") {
                errtgl_ser = "Tanggal sertifikasi wajib diisi";
            } else {
                errtgl_ser = "";

            }
            if (tgl_akhir_ser == "") {
                errtgl_akhir_ser = "Jenis sertifikasi wajib diisi";
            } else {
                errtgl_akhir_ser = "";

            }
            if (file_ser == "") {
                errfile_ser = "File sertifikasi wajib diupload";
            } else {
                errfile_ser = "";

            }

            if (errkary == "" && errjenis == "" && errno_ser == "" && errlembaga == "" && errtgl_ser == "" && errtgl_akhir_ser == "" && errfile_ser == "") {
                swal({
                    title: "Upload Sertifikasi",
                    text: "Yakin data sertifikasi akan di-upload?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#36c6d3',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, upload',
                    cancelButtonText: 'Batalkan'
                }).then(function(result) {
                    if (result.value) {
                        $.LoadingOverlay("show");
                        let formData = new FormData();
                        formData.append('jenis', jenis);
                        formData.append('no_ser', no_ser);
                        formData.append('lembaga', lembaga);
                        formData.append('tgl_ser', tgl_ser);
                        formData.append('tgl_akhir_ser', tgl_akhir_ser);
                        formData.append('file_ser', file_ser);
                        formData.append('fl_ser', fl_ser);
                        formData.append('auth_kary', auth_kary);

                        $.ajax({
                            type: 'POST',
                            url: site_url+"karyawan/newsertifikasi",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    $("#mdlnewsertifikat").modal("hide");
                                    $(".8k23jnm89d56jl123mn90bv542ll").text('');
                                    $("#jenisSertifikasiNew").val('').trigger('change');
                                    $("#noSertifikatNew").val('');
                                    $("#namaLembagaNew").val('');
                                    $("#tanggalSertifikasiNew").val('');
                                    $("#tanggalSertifikasiAkhirNew").val('');
                                    $("#masaBerlakuSertifikatNew").val('').trigger('change');
                                    $('#filePendukung').val('');
                                    swal('Berhasil', data.pesan, 'success');
                                    $.LoadingOverlay("hide");
                                } else if (data.statusCode == 201) {
                                    $.LoadingOverlay("hide");
                                    $(".errnewsertifikat").removeClass("d-none");
                                    $(".errnewsertifikat").removeClass("alert-primary]");
                                    $(".errnewsertifikat").addClass("alert-danger");
                                    $(".errnewsertifikat").html(data.pesan);
                                } else {
                                    $(".errorjenisSertifikasiNew").html(data.jenis);
                                    $(".errorNoSertifikatNew").html(data.no_ser);
                                    $(".errorNamaLembagaNew").html(data.lembaga);
                                    $(".errorTanggalSertifikasiNew").html(data.tgl_ser);
                                    $(".errorTanggalSertifikasiAkhir").html(data.tgl_akhir_ser);
                                    $(".errorFileSertifikasi").html(data.filesrt);
                                    $.LoadingOverlay("hide");
                                }
                            }
                        });
                    }
                });
            } else {
                if (errkary != "") {
                    $(".errnewsertifikat").removeClass("d-none");
                    $(".errnewsertifikat").removeClass("alert-primary]");
                    $(".errnewsertifikat").addClass("alert-danger");
                    $(".errnewsertifikat").html(errkary);
                } else {
                    $(".errnewsertifikat").addClass("d-none");
                    $(".errnewsertifikat").html('');
                }

                $(".errorjenisSertifikasiNew").html(errjenis);
                $(".errorNoSertifikatNew").html(errno_ser);
                $(".errorNamaLembagaNew").html(errlembaga);
                $(".errorTanggalSertifikasiNew").html(errtgl_ser);
                $(".errorTanggalSertifikasiAkhir").html(errtgl_akhir_ser);
                $(".errorFileSertifikasi").html(errfile_ser);
            }

            $(".errnewsertifikat").fadeTo(5000, 500).slideUp(500, function() {
                $(".errnewsertifikat").slideUp(500);
                $(".errnewsertifikat").addClass("d-none");
            });
        });

        $(document).on("click", ".btnMCU ", function() {
            let auth_kary = $(this).attr("id");
            $(".890123hjn34267xcxvbj7234hh").text(auth_kary);

            $.ajax({
                type: "POST",
                url: site_url+"karyawan/get_all_jenis_mcu",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#hasilMCUnew").html(data.jmcu);
                    $('#hasilMCUnew').select2({
                        theme: 'bootstrap4',
                        dropdownParent: $('#mdlnewmcu')
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errnewmcu").removeClass('d-none');
                    $(".errnewmcu").removeClass('alert-info');
                    $(".errnewmcu").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errnewmcu").html("Terjadi kesalahan saat load data hasil MCU, hubungi administrator");
                    }
                }
            });

            $("#hasilMCUnew").val('').trigger('change');
            $("#tglMCUnew").val('');
            $("#ketMCUnew").val('');
            $("#fileMCUnew").val('');
            $(".errorTglMCUnew").html('');
            $(".errorHasilMCUnew").html('');
            $(".errorKetMCUnew").html('');
            $(".errorFileMCUnew").html('');
            $("#mdlnewmcu").modal("show");
        });

        $("#btnnewMCU").click(function() {
            let auth_kary = $(".890123hjn34267xcxvbj7234hh").text();
            let tglMCU = $("#tglMCUnew").val();
            let hasilMCU = $("#hasilMCUnew").val();
            let ketMCU = $("#ketMCUnew").val();
            let file_MCU = $('#fileMCUnew').val();
            const fl_MCU = $('#fileMCUnew').prop('files')[0];

            if (auth_kary == "") {
                errkary = "Data karyawan tidak ditemukan";
            } else {
                errkary = "";
            }

            if (tglMCU == "") {
                errtglMCU = "Tanggal MCU wajib diisi";
            } else {
                errtglMCU = "";

            }
            if (hasilMCU == "") {
                errhasilMCU = "Hasil wajib dipilih";
            } else {
                errhasilMCU = "";

            }
            if (ketMCU == "") {
                errketMCU = "Keterangan wajib diisi";
            } else {
                errketMCU = "";

            }
            if (file_MCU == "") {
                errfile_MCU = "File MCU wajib diupload";
            } else {
                errfile_MCU = "";

            }

            if (errkary == "" && errtglMCU == "" && errhasilMCU == "" && errketMCU == "" && errfile_MCU == "") {
                swal({
                    title: "Upload MCU",
                    text: "Yakin data MCU akan di-upload?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#36c6d3',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, upload',
                    cancelButtonText: 'Batalkan'
                }).then(function(result) {
                    if (result.value) {
                        $.LoadingOverlay("show");
                        let formData = new FormData();
                        formData.append('tglMCU', tglMCU);
                        formData.append('hasilMCU', hasilMCU);
                        formData.append('ketMCU', ketMCU);
                        formData.append('file_MCU', file_MCU);
                        formData.append('fl_MCU', fl_MCU);
                        formData.append('auth_kary', auth_kary);

                        $.ajax({
                            type: 'POST',
                            url: site_url+"karyawan/newMCU",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    $("#mdlnewmcu").modal("hide");
                                    $(".890123hjn34267xcxvbj7234hh").text('');
                                    $("#hasilMCUnew").val('').trigger('change');
                                    $("#ketMCUnew").val('');
                                    $("#tglMCUnew").val('');
                                    $('#fileMCUnew').val('');
                                    swal('Berhasil', data.pesan, 'success');
                                    $.LoadingOverlay("hide");
                                } else if (data.statusCode == 201) {
                                    $.LoadingOverlay("hide");
                                    $(".errnewmcu").removeClass("d-none");
                                    $(".errnewmcu").removeClass("alert-primary]");
                                    $(".errnewmcu").addClass("alert-danger");
                                    $(".errnewmcu").html(data.pesan);
                                } else {
                                    $(".errorTglMCUnew").html(data.tglMCU);
                                    $(".errorHasilMCUnew").html(data.hasilMCU);
                                    $(".errorKetMCUnew").html(data.ketMCU);
                                    $(".errorFileMCUnew").html(data.file_MCU);
                                    $.LoadingOverlay("hide");
                                }
                            }
                        });
                    }
                });
            } else {
                if (errkary != "") {
                    $(".errnewmcu").removeClass("d-none");
                    $(".errnewmcu").removeClass("alert-primary]");
                    $(".errnewmcu").addClass("alert-danger");
                    $(".errnewmcu").html(errkary);
                } else {
                    $(".errnewmcu").addClass("d-none");
                    $(".errnewmcu").html('');
                }

                $(".errorTglMCUnew").html(errtglMCU);
                $(".errorHasilMCUnew").html(errhasilMCU);
                $(".errorKetMCUnew").html(errketMCU);
                $(".errorFileMCUnew").html(errfile_MCU);

                $(".errnewmcu").fadeTo(5000, 500).slideUp(500, function() {
                    $(".errnewmcu").slideUp(500);
                    $(".errnewmcu").addClass("d-none");
                });
            }
        });

        $(document).on("click", ".btnFilePendukung ", function() {
            let auth_kary = $(this).attr("id");
            $(".12390lkjj4234bn12j28j4nc9").text(auth_kary);
            $("#mdlnewfilependukung").modal("show");
        });

        $("#btnnewfilependukung").click(function() {
            let auth_kary = $(".12390lkjj4234bn12j28j4nc9").text();
            let file_pendukung = $('#filePendukungnew').val();
            const fl_pendukung = $('#filePendukungnew').prop('files')[0];

            if (auth_kary == "") {
                errkary = "Data karyawan tidak ditemukan";
            } else {
                errkary = "";
            }

            if (file_pendukung == "") {
                errfile_pendukung = "File pendukung wajib diupload";
            } else {
                errfile_pendukung = "";

            }

            if (errkary == "" && errfile_pendukung == "") {
                swal({
                    title: "Upload File Pendukung",
                    text: "Yakin file pendukung akan di-upload?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#36c6d3',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, upload',
                    cancelButtonText: 'Batalkan'
                }).then(function(result) {
                    if (result.value) {
                        $.LoadingOverlay("show");
                        let formData = new FormData();
                        formData.append('file_pendukung', file_pendukung);
                        formData.append('fl_pendukung', fl_pendukung);
                        formData.append('auth_kary', auth_kary);

                        $.ajax({
                            type: 'POST',
                            url: site_url+"karyawan/newfilependukung",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    $("#mdlnewfilependukung").modal("hide");
                                    $(".12390lkjj4234bn12j28j4nc9").text('');
                                    $("#hasilMCUnew").val('').trigger('change');
                                    $('#filePendukungnew').val('');
                                    swal('Berhasil', data.pesan, 'success');
                                    $.LoadingOverlay("hide");
                                } else if (data.statusCode == 201) {
                                    $.LoadingOverlay("hide");
                                    $(".errnewfilependukung").removeClass("d-none");
                                    $(".errnewfilependukung").removeClass("alert-primary]");
                                    $(".errnewfilependukung").addClass("alert-danger");
                                    $(".errnewfilependukung").html(data.pesan);
                                } else {
                                    $(".errorFilePendukungnew").html(data.file_MCU);
                                    $.LoadingOverlay("hide");
                                }
                            }
                        });
                    }
                });
            } else {
                if (errkary != "") {
                    $(".errnewfilependukung").removeClass("d-none");
                    $(".errnewfilependukung").removeClass("alert-primary]");
                    $(".errnewfilependukung").addClass("alert-danger");
                    $(".errnewfilependukung").html(errkary);
                } else {
                    $(".errnewfilependukung").addClass("d-none");
                    $(".errnewfilependukung").html('');
                }

                $(".errorFilePendukungnew").html(errfile_pendukung);

                $(".errnewfilependukung").fadeTo(5000, 500).slideUp(500, function() {
                    $(".errnewfilependukung").slideUp(500);
                    $(".errnewfilependukung").addClass("d-none");
                });
            }
        });

        function tbKary(prs){
            tbmKaryawan = $('#tbmKaryawan').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [6, 'asc']
                ],
                "ajax": {
                    "url": site_url+"karyawan/ajax_list?auth_m_per="+prs,
                    "type": "POST",
                    "error": function(xhr, error, code) {
                        if (code != "") {
                            $(".err_psn_kary").removeClass("d-none");
                            $(".err_psn_kary").css("display", "block");
                            $(".err_psn_kary").html("terjadi kesalahan saat melakukan load data karyawan, hubungi administrator");
                            $("#addTambahKary").addClass("disabled");
                            $(".err_psn_kary ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_kary ").slideUp(500);
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
                        "data": 'proses',
                        "className": "text-center text-nowrap align-middle",
                        "width": "1%"
                    }, {
                        "data": 'no',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "className": "text-center align-middle",
                        "width": "1%"
                    },
                    {
                        "data": 'no_nik',
                        "className": "align-middle ",
                    },
                    {
                        "data": 'nama_lengkap',
                        "className": " align-middle",
                    },
                    {
                        "data": 'depart',
                        "className": "text-wrap align-middle",
                    },
                    {
                        "data": 'posisi',
                        "className": "text-wrap align-middle",
                    },
                    {
                        "data": 'kode_m_perusahaan',
                        "className": "text-wrap align-middle text-center",
                        "width": "12%"
                    },
                    {
                        "data": 'stat_aktif',
                        "className": "text-wrap align-middle text-center",
                        "width": "1%"
                    }
                ]
            });

            $("#tbmKaryawan").LoadingOverlay("hide");
        }
    });