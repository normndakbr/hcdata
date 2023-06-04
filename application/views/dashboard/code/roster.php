<script>
    //========================================== Roster ========================================================
    $(document).ready(function() {
        $('#perRoster').select2({
            theme: 'bootstrap4'
        });

        $.ajax({
            type: "POST",
            url: "<?= base_url("perusahaan/get_all") ?>",
            success: function(data) {
                var data = JSON.parse(data);
                $("#perRoster").html(data.prs);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".err_psn_roster").removeClass('d-none');
                $(".err_psn_roster").removeClass('alert-info');
                $(".err_psn_roster").addClass('alert-danger');
                if (thrownError != "") {
                    $(".err_psn_roster").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                    $("#btnTambahRoster").attr("disabled", true);
                }
            }
        })

        function reseteditroster() {
            $("#editRosterKode").val('');
            $("#editRoster").val('');
            $("#editMasaOnsite").val('');
            $("#editMasaOffsite").val('');
            $("#editRosterStatus").val('');
            $("#editRosterKet").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
            $(".error4").html('');
            $(".error5").html('');
            $(".error6").html('');
        }

        $('#btnupdateRoster').click(function() {
            let kode = $('#editRosterKode').val();
            let roster = $('#editRoster').val();
            let masa_onsite = $('#editMasaOnsite').val();
            let masa_offsite = $('#editMasaOffsite').val();
            let status = $('#editRosterStatus').val();
            let ket = $('#editRosterKet').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('roster/edit_roster'); ?>",
                data: {
                    kode: kode,
                    roster: roster,
                    masa_onsite: masa_onsite,
                    masa_offsite: masa_offsite,
                    status: status,
                    ket: ket
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        tbmRoster.draw();
                        $("#editRostermdl").modal("hide");
                        $(".err_psn_roster").removeClass('d-none');
                        $(".err_psn_roster").removeClass('alert-danger');
                        $(".err_psn_roster").addClass('alert-info');
                        $(".err_psn_roster").html(data.pesan);
                        reseteditroster();
                        $(".err_psn_roster").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_roster").slideUp(500);
                        });
                    } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                        $(".err_psn_edit_roster").removeClass('d-none');
                        $(".err_psn_edit_roster").removeClass('alert-info');
                        $(".err_psn_edit_roster").addClass('alert-danger');
                        $(".err_psn_edit_roster").html(data.pesan);
                        $(".err_psn_edit_roster").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_edit_roster").slideUp(500);
                        });
                        $("#error1ers").html('');
                        $("#error2ers").html('');
                        $("#error3ers").html('');
                        $("#error4ers").html('');
                        $("#error5ers").html('');
                        $("#error6ers").html('');
                    } else if (data.statusCode == 202) {
                        $("#error1ers").html(data.kode);
                        $("#error2ers").html(data.roster);
                        $("#error3ers").html(data.masa_onsite);
                        $("#error4ers").html(data.masa_offsite);
                        $("#error5ers").html(data.status);
                        $("#error6ers").html(data.ket);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    alert(xhr.status);
                    $(".err_psn_roster").removeClass("alert-primary");
                    $(".err_psn_roster").addClass("alert-danger");
                    $(".err_psn_roster").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_roster").html("Roster gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_roster").html("Roster gagal diupdate, Waktu koneksi habis");
                    } else {
                        $(".err_psn_roster").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                    }
                    $("#editRostermdl").modal("hide");
                    $(".err_psn_roster ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_roster ").slideUp(500);
                    });
                }
            })
        });

        $.LoadingOverlay("hide");

        function resetaddroster() {
            $("#perRoster").val('').trigger('change');
            $("#kodeRoster").val('');
            $("#Roster").val('');
            $("#masaOnsiteRoster").val('');
            $("#masaOffsiteRoster").val('');
            $("#ketRoster").val('');
            $(".error1").html('');
            $(".error2").html('');
            $(".error3").html('');
            $(".error4").html('');
            $(".error5").html('');
            $(".error6").html('');
        }
        $("#btnBatalRoster").click(function() {
            resetaddroster();
        });
        $("#btnTambahRoster").click(function() {
            let prs = $("#perRoster").val();
            let kode = $("#kodeRoster").val();
            let roster = $("#Roster").val();
            let masa_onsite = $("#masaOnsiteRoster").val();
            let masa_offsite = $("#masaOffsiteRoster").val();
            let ket = $("#ketRoster").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url("roster/input_roster"); ?>",
                data: {
                    prs: prs,
                    kode: kode,
                    roster: roster,
                    masa_onsite: masa_onsite,
                    masa_offsite: masa_offsite,
                    ket: ket
                },
                timeout: 20000,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $(".err_psn_roster").removeClass('d-none');
                        $(".err_psn_roster").removeClass('alert-danger');
                        $(".err_psn_roster").addClass('alert-info');
                        $(".err_psn_roster").html(data.pesan);
                        resetaddroster();
                    } else if (data.statusCode == 201) {
                        $(".err_psn_roster").removeClass('d-none');
                        $(".err_psn_roster").removeClass('alert-info');
                        $(".err_psn_roster").addClass('alert-danger');
                        $(".err_psn_roster").html(data.pesan);
                    } else if (data.statusCode == 202) {
                        $(".error1").html(data.prs);
                        $(".error2").html(data.kode);
                        $(".error3").html(data.roster);
                        $(".error4").html(data.masa_onsite);
                        $(".error5").html(data.masa_offsite);
                        $(".error6").html(data.ket);
                    }

                    $(".err_psn_roster").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_roster").slideUp(500);
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_roster").removeClass("alert-primary");
                    $(".err_psn_roster").addClass("alert-danger");
                    $(".err_psn_roster").removeClass("d-none");
                    if (xhr.status == 404) {
                        $(".err_psn_roster").html("Roster gagal disimpan, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                        $(".err_psn_roster").html("Roster gagal disimpan, Waktu koneksi habis");
                    } else {
                        $(".err_psn_roster").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                    }

                    $(".err_psn_roster ").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_roster ").slideUp(500);
                    });
                }
            })
        });

        $(document).on('click', '.hpsroster', function() {
            let auth_roster = $(this).attr('id');
            let namaRoster = $(this).attr('value');

            if (auth_roster == "") {
                swal("Error", "Roster tidak ditemukan", "error");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin Roster " + namaRoster + " akan dihapus?",
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
                            url: "<?= base_url('roster/hapus_roster'); ?>",
                            data: {
                                auth_roster: auth_roster
                            },
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmRoster.draw();
                                    $(".err_psn_roster").removeClass("alert-danger");
                                    $(".err_psn_roster").addClass("alert-primary");
                                    $(".err_psn_roster").removeClass("d-none");
                                    $(".err_psn_roster").html(data.pesan);
                                } else {
                                    $(".err_psn_roster").removeClass("alert-primary");
                                    $(".err_psn_roster").addClass("alert-danger");
                                    $(".err_psn_roster").removeClass("d-none");
                                    $(".err_psn_roster").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_roster").removeClass("alert-primary");
                                $(".err_psn_roster").addClass("alert-danger");
                                $(".err_psn_roster").removeClass("d-none");
                                if (xhr.status == 404) {
                                    $(".err_psn_roster").html("Roster gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_roster").html("Roster gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_roster").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_roster").fadeTo(4000, 500).slideUp(500, function() {
                            $(".err_psn_roster").slideUp(500);
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'Roster ' + namaRoster + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtlroster', function() {
            let auth_roster = $(this).attr('id');
            let namaRoster = $(this).attr('value');

            if (auth_roster == "") {
                swal("Error", "Roster tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('roster/detail_roster'); ?>",
                    data: {
                        auth_roster: auth_roster
                    },
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#detailRosterPerusahaan").val(data.nama_perusahaan);
                            $("#detailRosterLevel").val(data.level);
                            $("#detailRosterKode").val(data.kode);
                            $("#detailRoster").val(data.roster);
                            $("#detailMasaOnsite").val(data.masa_onsite + " Hari");
                            $("#detailMasaOffsite").val(data.masa_offsite + " Hari");
                            $("#detailRosterStatus").val(data.status);
                            $("#detailRosterKet").val(data.ket);
                            $("#detailRosterBuat").val(data.pembuat);
                            $("#detailRosterTglBuat").val(data.tgl_buat);
                            $("#detailRostermdl").modal("show");
                        } else {
                            $(".err_psn_roster").removeClass("d-none");
                            $(".err_psn_roster").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_roster").removeClass("alert-primary");
                        $(".err_psn_roster").addClass("alert-danger");
                        $(".err_psn_roster").removeClass("d-none");
                        if (xhr.status == 404) {
                            $(".err_psn_roster").html("Roster gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_roster").html("Roster gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_roster").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_roster ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_roster ").slideUp(500);
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edttroster', function() {
            let auth_roster = $(this).attr('id');
            let namaRoster = $(this).attr('value');

            if (auth_roster == "") {
                swal("Error", "Roster tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('roster/detail_roster'); ?>",
                    data: {
                        auth_roster: auth_roster
                    },
                    timeout: 15000,
                    success: function(data) {
                        var dataRoster = JSON.parse(data);
                        if (dataRoster.statusCode == 200) {
                            $("#editRosterKode").val(dataRoster.kode);
                            $("#editRoster").val(dataRoster.roster);
                            $("#editMasaOnsite").val(dataRoster.masa_onsite);
                            $("#editMasaOffsite").val(dataRoster.masa_offsite);
                            $("#editRosterStatus").val(dataRoster.status);
                            $("#editRosterKet").val(dataRoster.ket);
                            $("#editRostermdl").modal("show");
                            $("#error1ers").html('');
                            $("#error2ers").html('');
                            $("#error3ers").html('');
                            $("#error4ers").html('');
                            $("#error5ers").html('');
                            $("#error6ers").html('');
                        } else {
                            $(".err_psn_roster").removeClass("d-none");
                            $(".err_psn_roster").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_roster").removeClass("alert-primary");
                        $(".err_psn_roster").addClass("alert-danger");
                        $(".err_psn_roster").removeClass("d-none");
                        if (xhr.status == 404) {
                            $(".err_psn_roster").html("Roster gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_roster").html("Roster gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_roster").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }

                        $(".err_psn_roster ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_roster ").slideUp(500);
                        });
                    }
                });
            }
        });

        $("#btnrefreshRoster").click(function() {
            $('#tbmRoster').LoadingOverlay("show");
            tbmRoster.draw()
            $('#tbmRoster').LoadingOverlay("hide");
        });

        tbmRoster = $('#tbmRoster').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [6, 'desc']
            ],
            "ajax": {
                "url": "<?= base_url('roster/ajax_list'); ?>",
                "type": "POST",
                "error": function(xhr, error, code) {
                    if (code != "") {
                        $(".err_psn_roster").removeClass("d-none");
                        $(".err_psn_roster").removeClass("d-none");
                        $(".err_psn_roster").html("Terjadi kesalahan saat melakukan load data Roster, hubungi administrator");
                        $("#addbtn").addClass("disabled");
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
                    name: 'id_roster',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "className": "text-center",
                    "width": "1%"
                },
                {
                    "data": 'kd_roster',
                    "className": "text-nowrap align-middle",
                    "width": "10%"
                },
                {
                    "data": 'roster',
                    "className": "text-nowrap align-middle",
                    "width": "50%"
                },
                {
                    "data": 'jml_hari_onsite',
                    "className": "align-middle",
                    "width": "5%"
                },
                {
                    "data": 'jml_hari_offsite',
                    "className": "align-middle",
                    "width": "5%"
                },
                {
                    "data": 'stat_roster',
                    "className": "text-center align-middle",
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
                    "width": "8%"
                },
                {
                    "data": 'proses',
                    "className": "text-center text-nowrap align-middle",
                    "width": "1%"
                }
            ]
        });

    });
</script>