<script>
    //========================================== Detail Langgar ========================================================
    $(document).ready(function() {

        $("#logout").click(function() {
            $("#logoutmdl").modal("show");
        });

        $("#btnSelesai").click(function() {
            window.top.close();
        });

        $("#btnGantiBerkas").click(function() {
            let authlgr = $("#authLgrEdit").val();
            $("#editBerkasPunishment").modal("show");
            $("#authlanggarberkas").val(authlgr);
        });

        $("#btnUploadBerkas").click(function() {
            let authlgr = $("#authlanggarberkas").val();
            let berkaslgr = $("#berkasPunishEdit").val();
            const fllgr = $('#berkasPunishEdit').prop('files')[0];

            if (authlgr == "") {
                swal('Error', 'Karyawan tidak ditemukan', 'error');
                return;
            }

            if (berkaslgr == "") {
                swal('Error', 'Pilih berkas yang akan diupload', 'error');
                return;
            }

            let formData = new FormData();
            formData.append('berkasPunishEdit', fllgr);
            formData.append('berkaslgr', berkaslgr);
            formData.append('authlgr', authlgr);

            $.ajax({
                type: 'POST',
                url: "<?= base_url('pelanggaran/uploadberkas'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#editBerkasPunishment").modal("hide");
                        $("#btnBerkasTampil").attr('href', data.brks);
                        $(".erroredit1").val('');
                        $(".erroredit2").val('');
                        $("#berkasPunishEdit").val('');
                        $("#authlanggarberkas").val('');
                        swal('Berhasil', data.pesan, 'success');
                    } else if (data.statusCode == 202) {
                        $(".erroredit1").val(data.authlgr);
                        $(".erroredit2").val(data.berkaslgr);
                    } else {
                        swal('Error', data.pesan, 'error');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    swal('Error', 'Terjadi kesalahan saat mengupload file', 'error');
                }
            });
        });

        $('#jenisLgrEdit').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        window.addEventListener('resize', function(event) {
            $('#jenisLgrEdit').select2({
                theme: 'bootstrap4',
                width: '100%'
            });

        }, true);

        $("#txtCariKaryLgrEdit").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url('karyawan/getKaryawan'); ?>",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        auth_m_per: $("#authprsLgrEdit").val(),
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                if (ui.item.value != "") {
                    $('#authkary').val(ui.item.value);
                    $('#txtKTPKaryLgrEdit').val(ui.item.ktp);
                    $('#txtNIKKaryLgrEdit').val(ui.item.nik);
                    $('#txtNamaKaryLgrEdit').val(ui.item.nama);
                    $('#txtDepartKaryLgrEdit').val(ui.item.depart);
                    $('#txtPosisiKaryLgrEdit').val(ui.item.posisi);
                    $("#txtCariKaryLgrEdit").val('');
                }
                return false;
            }
        });
    });
</script>