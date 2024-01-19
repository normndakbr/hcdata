<script>
    //========================================== User ========================================================
    $(document).ready(function() {
        if (window.history.replaceState) {
            window.history.replaceState(null, null, '<?= base_url('user/new'); ?>');
        }

        $(".err_psn_user").fadeTo(2000, 500).slideUp(500, function() {
            $(".err_psn_user").slideUp(500);
            " <?= $this->session->set_flashdata('msg', ''); ?>";
            $('#namaUser').val('');
            $('#emailUser').val('');
            $('#tglAktif').val('');
            $('#tglExpired').val('');
            $('#aksesUser').val('').trigger('change');
        });

        $("#logout").click(function() {
            $("#logoutmdl").modal("show");
        });

        $('#aksesUser').select2({
            theme: 'bootstrap4'
        });

        $('#perusahaanUser').select2({
            theme: 'bootstrap4'
        });

        function resetedituser() {
            $("#editUserNama").val('');
            $("#editUserEmail").val('');
            $("#editUserTglAktif").val('');
            $("#editUserTglExp").val('');
            $("#editUserAksesMenu").val('');
            $("#editUserStatus").val('');
            $(".error1eusr").html('');
            $(".error2eusr").html('');
            $(".error3eusr").html('');
            $(".error4eusr").html('');
            $(".error5eusr").html('');
            $(".error6eusr").html('');
        }

        $('#btnupdateUser').click(function() {
            let nama = $('#editUserNama').val();
            let email = $('#editUserEmail').val();
            let tgl_aktif = $('#editUserTglAktif').val();
            let tgl_exp = $('#editUserTglExp').val();
            let akses_menu = $('#editUserAksesMenu').val();
            let status = $('#editUserStatus').val();
            swal({
                title: "Update",
                text: "Yakin User " + email + " akan diupdate?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Update',
                cancelButtonText: 'Batalkan'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('user/edit_user'); ?>",
                        data: {
                            nama: nama,
                            email: email,
                            tgl_aktif: tgl_aktif,
                            tgl_exp: tgl_exp,
                            akses_menu: akses_menu,
                            status: status,
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            if (data.statusCode == 200) {
                                tbmUser.draw();
                                $("#editUsermdl").modal("hide");
                                $(".err_psn_user").removeClass('d-none');
                                $(".err_psn_user").removeClass('alert-danger');
                                $(".err_psn_user").addClass('alert-info');
                                $(".err_psn_user").html(data.pesan);
                                resetedituser();
                                $(".err_psn_user").fadeTo(3000, 500).slideUp(500, function() {
                                    $(".err_psn_user").slideUp(500);
                                    $(".err_psn_user").addClass('d-none');
                                });
                            } else if (data.statusCode == 201 || data.statusCode == 203 || data.statusCode == 204 || data.statusCode == 205) {
                                $(".err_psn_edit_user").removeClass('d-none');
                                $(".err_psn_edit_user").removeClass('alert-info');
                                $(".err_psn_edit_user").addClass('alert-danger');
                                $(".err_psn_edit_user").html(data.pesan);
                                $(".err_psn_edit_user").fadeTo(3000, 500).slideUp(500, function() {
                                    $(".err_psn_edit_user").slideUp(500);
                                    $(".err_psn_edit_user").addClass('d-none');
                                });
                                $(".error1eusr").html('');
                                $(".error2eusr").html('');
                                $(".error3eusr").html('');
                                $(".error4eusr").html('');
                                $(".error5eusr").html('');
                                $(".error6eusr").html('');
                            } else if (data.statusCode == 202) {
                                $(".error1eusr").html(data.nama);
                                $(".error2eusr").html(data.email);
                                $(".error3eusr").html(data.tgl_aktif);
                                $(".error4eusr").html(data.tgl_exp);
                                $(".error5eusr").html(data.akses_menu);
                                $(".error6eusr").html(data.status);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $.LoadingOverlay("hide");
                            $(".err_psn_user").removeClass("alert-primary");
                            $(".err_psn_user").addClass("alert-danger");
                            $(".err_psn_user").removeClass('d-none');
                            if (xhr.status == 404) {
                                $(".err_psn_user").html("User gagal diupdate, Link data tidak ditemukan");
                            } else if (xhr.status == 0) {
                                $(".err_psn_user").html("User gagal diupdate, Waktu koneksi habis");
                            } else {
                                $(".err_psn_user").html("Terjadi kesalahan saat meng-update data, hubungi administrator");
                            }
                            $("#editUsermdl").modal("hide");
                            $(".err_psn_user ").fadeTo(3000, 500).slideUp(500, function() {
                                $(".err_psn_user ").slideUp(500);
                                $(".err_psn_user").addClass('d-none');
                            });
                        }
                    })
                    $(".err_psn_user").fadeTo(3000, 500).slideUp(500, function() {
                        $(".err_psn_user").slideUp(500);
                        $(".err_psn_user").addBack("d-none");
                    });
                } else if (result.dismiss == 'cancel') {
                    swal('Batal', 'User ' + namaUser + ' batal diupdate', 'error');
                    return false;
                }
            });


        });

        $('#tglAktif').change(function() {
            let tglAktif = $("#tglAktif").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url("user/tgl_expired") ?>",
                data: {
                    tglAktif: tglAktif
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#tglExpired").val(data.tglExpired);
                }
            })
        });

        $(document).on('click', '.hapusUser', function() {
            let auth_user = $(this).attr('id');
            let namaUser = $(this).attr('value');

            if (auth_user == "") {
                swal("Error", "User tidak ditemukan", "error");
            } else {
                swal({
                    title: "Hapus",
                    text: "Yakin User " + namaUser + " akan dihapus?",
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
                            url: "<?= base_url('user/hapus_User/'); ?>" + auth_user,
                            timeout: 20000,
                            success: function(data, textStatus, xhr) {
                                var data = JSON.parse(data);
                                if (data.statusCode == 200) {
                                    tbmUser.draw();
                                    $(".err_psn_user").removeClass("alert-danger");
                                    $(".err_psn_user").addClass("alert-primary");
                                    $(".err_psn_user").removeClass("d-none");
                                    $(".err_psn_user").html(data.pesan);
                                } else {
                                    $(".err_psn_user").removeClass("alert-primary");
                                    $(".err_psn_user").addClass("alert-danger");
                                    $(".err_psn_user").removeClass("d-none");
                                    $(".err_psn_user").html(data.pesan);
                                }

                                $.LoadingOverlay("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $.LoadingOverlay("hide");
                                $(".err_psn_user").removeClass("alert-primary");
                                $(".err_psn_user").addClass("alert-danger");
                                $(".err_psn_user").removeClass("d-none");
                                if (xhr.status == 404) {
                                    $(".err_psn_user").html("User gagal dihapus, , Link data tidak ditemukan");
                                } else if (xhr.status == 0) {
                                    $(".err_psn_user").html("User gagal dihapus, Waktu koneksi habis");
                                } else {
                                    $(".err_psn_user").html("Terjadi kesalahan saat menghapus data, hubungi administrator");
                                }
                            }
                        });

                        $(".err_psn_user").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_user").slideUp(500);
                            $(".err_psn_user").addBack("d-none");
                        });
                    } else if (result.dismiss == 'cancel') {
                        swal('Batal', 'User ' + namaUser + ' batal dihapus', 'error');
                        return false;
                    }
                });
            }
        });

        $(document).on('click', '.dtlUser', function() {
            let auth_user = $(this).attr('id');
            let namaUser = $(this).attr('value');

            if (auth_user == "") {
                swal("Error", "User tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('user/detail_User/'); ?>" + auth_user,
                    timeout: 15000,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            $("#detailUserNama").val(data.nama);
                            $("#detailUserEmail").val(data.email);
                            $("#detailUserTglAktif").val(data.tgl_aktif);
                            $("#detailUserTglExp").val(data.tgl_exp);
                            $("#detailUserAksesMenu").val(data.akses_menu);
                            $("#detailUserStatus").val(data.status);
                            $("#detailUserPembuat").val(data.pembuat);
                            $("#detailUserTglBuat").val(data.tgl_buat);
                            $("#detailUserTglEdit").val(data.tgl_edit);
                            $("#detailUsermdl").modal("show");
                        } else {
                            $(".err_psn_user").removeClass("d_none");
                            $(".err_psn_user").html(data.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $(".err_psn_user").removeClass("alert-primary");
                        $(".err_psn_user").addClass("alert-danger");
                        $(".err_psn_user").removeClass("d_none");
                        if (xhr.status == 404) {
                            $(".err_psn_user").html("User gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_user").html("User gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_user").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_user ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_user ").slideUp(500);
                            $(".err_psn_user").addClass("d_none");
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edtUser', function() {
            let auth_user = $(this).attr('id');
            let namaUser = $(this).attr('value');

            if (auth_user == "") {
                swal("Error", "User tidak ditemukan", "error");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('user/detail_User/'); ?>" + auth_user,
                    timeout: 15000,
                    success: function(data) {
                        var dataUser = JSON.parse(data);
                        if (dataUser.statusCode == 200) {
                            resetedituser();
                            $("#editUsermdl").modal("show");
                            $("#editUserNama").val(dataUser.nama);
                            $("#editUserEmail").val(dataUser.email);
                            $("#editUserTglAktif").val(dataUser.tgl_aktif);
                            $("#editUserTglExp").val(dataUser.tgl_exp);
                            $("#editUserAksesMenu").val(dataUser.akses_menu);
                            $("#editUserStatus").val(dataUser.status);
                            $("#error1eusr").html('');
                            $("#error2eusr").html('');
                            $("#error3eusr").html('');
                            $("#error4eusr").html('');
                            $("#error5eusr").html('');
                        } else {
                            $(".err_psn_user").removeClass("d-none");
                            $(".err_psn_user").html(dataUser.pesan);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay("hide");
                        $(".err_psn_user").removeClass("alert-primary");
                        $(".err_psn_user").addClass("alert-danger");
                        $(".err_psn_user").removeClass("d-none");
                        if (xhr.status == 404) {
                            $(".err_psn_user").html("User gagal ditampilkan, Link data tidak ditemukan");
                        } else if (xhr.status == 0) {
                            $(".err_psn_user").html("User gagal ditampilkan, Waktu koneksi habis");
                        } else {
                            $(".err_psn_user").html("Terjadi kesalahan saat menampilkan data, hubungi administrator");
                        }
                        $(".err_psn_user ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".err_psn_user ").slideUp(500);
                            $(".err_psn_user").addClass("d-none");
                        });
                    }
                });
            }
        });

        $("#btnrefreshUser").click(function() {
            $('#tbmUser').LoadingOverlay("show");
            tbmUser.draw()
            $('#tbmUser').LoadingOverlay("hide");
        });

        tbmUser = $('#tbmUser').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [1, 'desc'],
            ],
            "ajax": {
                "url": "<?= base_url('user/ajax_list'); ?>",
                "type": "POST",
                "error": function(xhr, error, code) {
                    if (code != "") {
                        $(".err_psn_user").removeClass("d-none");
                        $(".err_psn_user").html("terjadi kesalahan saat melakukan load data user, hubungi administrator");
                        $("#addbtn").remove();
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
                    name: 'id_User',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "className": "text-center align-middle",
                    "width": "1%"
                },
                {
                    "data": 'nama_user',
                    "className": "align-middle",
                    "width": "25%"
                },
                {
                    "data": 'email_user',
                    "className": "align-middle",
                    "width": "30%"
                },
                {
                    "data": 'tgl_exp',
                    "className": "text-nowrap align-middle",
                    "width": "1%"
                },
                {
                    "data": 'NamaMenu',
                    "className": "text-nowrap align-middle",
                    "width": "10%"
                },
                {
                    "data": 'stat_user',
                    "className": "text-center align-middle",
                    "width": "1%"
                },
                {
                    "data": 'kode_perusahaan',
                    "className": "text-center align-middle",
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