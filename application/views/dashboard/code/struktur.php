<script>
    //========================================== Level ========================================================
    $("#cariMPerusahaan").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "<?= base_url('perusahaan/getPerusahaan') ?>",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    response(data);
                    var perjenis = $("#perJenis").val();

                    if (jenisper !== "") {
                        response(data);
                    }
                }
            });
        },
        select: function(event, ui) {
            if (ui.item.value != "") {
                $.ajax({
                    type: 'post',
                    url: "<?= base_url('perusahaan/getidper') ?>",
                    data: {
                        auth_per: ui.item.value
                    },
                    success: function(data) {
                        $('#namaMperusahaan').val(ui.item.label);
                        $('#kodeMperusahaan').val(ui.item.kode);
                        $("#cariMPerusahaan").val('');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
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

    $(document).ready(function() {
        $('#colPerusahaan').collapse('show');
        $(".err_psn_prs_str ").fadeTo(3000, 500).slideUp(500, function() {
            $(".err_psn_prs_str ").slideUp(500);
            $(".err_psn_prs_str ").addClass("d-none");
        });

        $.LoadingOverlay("hide");

        $('#jenisPerusahaan').select2({
            theme: 'bootstrap4'
        });

        $('#perJenis').select2({
            theme: 'bootstrap4'
        });

        $.ajax({
            type: "POST",
            url: "<?= base_url("perusahaan/get_m_all") ?>",
            data: {},
            success: function(data) {
                var data = JSON.parse(data);
                $("#perLevel").html(data.prs);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.LoadingOverlay("hide");
                $(".err_psn_level").removeClass('d-none');
                $(".err_psn_level").removeClass('alert-info');
                $(".err_psn_level").addClass('alert-danger');
                if (thrownError != "") {
                    $(".err_psn_level").html("Terjadi kesalahan saat load data perusahaan, hubungi administrator");
                    $("#btnTambahLevel").attr("disabled", true);
                }
            }
        })

        $('#AddPerusahaan').click(function() {
            let idparent = $("#perJenis").val();
            let perutama = $("#perJenis option:selected").text();
            let kodeper = $("#kodeMperusahaan").val();
            let namaper = $("#namaMperusahaan").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url("struktur/input_perusahaan") ?>",
                data: {
                    idparent: idparent,
                    kodeper: kodeper,
                    namaper: namaper
                },
                success: function(data) {
                    alert(data);
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $('#imgPerusahaan').removeClass('d-none');
                        $('#colPerusahaan').collapse('hide');
                        $('#colIUJP').collapse('show');
                        $('#perUtamaIUJP').val(perutama);
                        $('#perSubIUJP').val(namaper);
                    } else if (data.statusCode == 201) {
                        swal("Error", data.pesan, "error");
                    } else {
                        $('.error1str').html(data.idparent);
                        $('.error2str').html(data.kodeper);
                        $('.error3str').html(data.namaper);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsgper").removeClass('d-none');
                    $(".errormsgper").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsgper").html("Terjadi kesalahan saat menyimpan data IUJP, hubungi administrator");
                        $("#AddPerusahaan").remove();

                        $(".errormsgper ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".errormsgper ").slideUp(500);
                            $(".errormsgper ").addClass("d-none");
                        });
                    }
                }
            })
        });

        $('#addIUJP').click(function() {
            let no_iujp = $("#noiujp").val();
            let tgl_awal_iujp = $("#tglAktifiujp").val();
            let tgl_akhir_iujp = $("#tglakhiriujp").val();
            let ket_iujp = $("#ketiujp").val();
            let fileiujp = $("#fileiujp").val();
            const fliujp = $('#fileiujp').prop('files')[0];
            let perutama = $('#perUtamaIUJP').val();
            let persub = $('#perSubIUJP').val();

            let formData = new FormData();
            formData.append('fliujp', fliujp);
            formData.append('fileiujp', fileiujp);
            formData.append('no_iujp', no_iujp);
            formData.append('tgl_awal_iujp', tgl_awal_iujp);
            formData.append('tgl_akhir_iujp', tgl_akhir_iujp);
            formData.append('ket_iujp', ket_iujp);

            $.ajax({
                type: 'POST',
                url: "<?= base_url('struktur/addiujp'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $('#imgIUJP').removeClass('d-none');
                        $('#colIUJP').collapse('hide');
                        $('#colSIO').collapse('show');
                        $('#perUtamaSIO').val(perutama);
                        $('#perSubSIO').val(persub);
                    } else if (data.statusCode == 201) {
                        swal("Error", data.pesan, "error");
                    } else {
                        $(".error2iujp").html(data.no_iujp);
                        $(".error3iujp").html(data.tgl_awal_iujp);
                        $(".error4iujp").html(data.tgl_akhir_iujp);
                        $(".error6iujp").html(data.fileiujp);
                        swal("Error", "Tidak dapat melanjutkan, lengkapi data IUJP.", "error");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsgiujp").removeClass('d-none');
                    $(".errormsgiujp").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsgiujp").html("Terjadi kesalahan saat menyimpan data IUJP, hubungi administrator");
                        $("#addIUJP").remove();

                        $(".errormsgiujp ").fadeTo(3000, 500).slideUp(500, function() {
                            $(".errormsgiujp ").slideUp(500);
                            $(".errormsgiujp ").addClass("d-none");
                        });
                    }
                }
            });
        });

        $('#btnNewStruktur').click(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url("struktur/new") ?>",
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        window.Location.href = '<?= base_url('struktur'); ?>'
                    } else {
                        swal("Error", data.pesan, "error");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".errormsg").removeClass('d-none');
                    $(".errormsg").removeClass('alert-info');
                    $(".errormsg").addClass('alert-danger');
                    if (thrownError != "") {
                        $(".errormsg").html("Terjadi kesalahan saat load tambah perusahaan, hubungi administrator");
                        $("#addSimpanPekerjaan").remove();
                    }
                }
            });
        });

        $('#tbmStruktur').DataTable({
            ordering: false,
            searching: true,
            paging: true
        });
    });
</script>