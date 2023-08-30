$(document).ready(function () {
    let flag_SIM = false;
    let jenis_izin_tambang = $("#valueJenisIzinTambang").val();
    let id_sim = $("#valueIDSim").val();
    let auth_sim = "";

    function fetch_sim() {
        $.ajax({
            type: "POST",
            url: site_url + "sim/get_all",
            data: {},
            success: function (res) {
                var data = JSON.parse(res);
                $("#editJenisSIM").html(data.smm);
                $("#refreshEditJenisSIM").removeAttr('disabled');
                $("#txtEditIzinSIM").LoadingOverlay("hide");
                $.ajax({
                    type: "POST",
                    url: site_url + "sim/get_auth_sim_by_id",
                    data: { id_sim: id_sim },
                    success: function (res) {
                        let data = JSON.parse(res);
                        auth_sim = data.auth_sim;
                        if (!flag_SIM) {
                            $("#editJenisSIM").val(auth_sim).trigger('change');
                            flag_SIM = !flag_SIM;
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log("Error get auth sim by id");
                        console.log(thrownError);
                    }
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#txtEditIzinSIM").LoadingOverlay("hide");
                $(".errormsg").removeClass('d-none');
                $(".errormsg").removeClass('alert-info');
                $(".errormsg").addClass('alert-danger');
                if (thrownError != "") {
                    $(".errormsg").html("Terjadi kesalahan saat load data SIM, hubungi administrator");
                }
            }
        });
    }

    // Ketika permasalahan dunia bertumpu dalam perspektif masing-masing.
    $("#editJenisIzin").change(() => {
        if ($("#editJenisIzin").val() == "SP") {
            $("#txtEditSIM").removeClass("d-none");
            fetch_sim();
        } else {
            $("#txtEditSIM").addClass("d-none");
        }
    });

    if (jenis_izin_tambang != "") {
        $("#editJenisIzin").val(jenis_izin_tambang).trigger("change");
    }

    $("#refreshEditJenisSIM").click(() => {
        fetch_sim();
    });

    $(document).on('click', '.btnDetailIzinKaryawan', function () {
        console.log("btnDetailIzinKaryawan clicked!");
        $("#mdlDetailIzinKaryawan").modal("show");
    });


});