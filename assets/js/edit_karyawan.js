$(document).ready(function () {
    let idMasterPerusahaan = $("#valuePerusahaan").val();
    let idDepart = $("#valueDepart").val();
    let idPosisi = $("#valuePosisi").val();
    let idKlasifikasi = $("#valueKlasifikasi").val();

    $("#editPerKary").val(idMasterPerusahaan).trigger('change');

    function fetch_depart() {
        $.ajax({
            type: "POST",
            url: site_url + "departemen/get_by_auth_m_per",
            data: {
                auth_m_per: idMasterPerusahaan
            },
            success: function (res) {
                var data = JSON.parse(res);
                $("#editDepartKary").html(data.dprt);
                $("#editDepartKary").removeAttr('disabled');
                $("#editPosisiKary").attr('disabled', true);
                $("#refreshEditPosisi").attr('disabled', true);
                $("#editPosisiKary").html('<option value ="">-- WAJIB DIPILIH --</option>');
                $("#txtEditDepartKary").LoadingOverlay("hide");
                $("#txtEditPosisiKary").LoadingOverlay("hide");

                if (idMasterPerusahaan != "") {
                    $(".errorEditPerKary").html("");
                } else {
                    $(".errorEditPerKary").html("<p>Perusahaan wajib dipilih</p>");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
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
    }

    fetch_depart();

    $.ajax({
        type: "POST",
        url: site_url + "departemen/get_auth_depart_by_id",
        data: {
            id_depart: idDepart
        },
        success: function (res) {
            let data = JSON.parse(res);
            $("#editDepartKary").val(data.auth_depart).trigger('change');

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("Error!! " + idDepart);
            console.log(thrownError);
        }
    });



});