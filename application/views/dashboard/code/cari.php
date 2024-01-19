<script>
//========================================== cri ========================================================
$(document).ready(function() {

     $("#logout").click(function() {
          $("#logoutmdl").modal("show");
     });

     $('#btnupdatecri').click(function() {
          let kode = $('#editDepartKode').val();
          let cri = $('#editDepart').val();
          let status = $('#editDepartStatus').val();
          let ket = $('#editDepartKet').val();

          $.ajax({
               type: "POST",
               url: "<?=base_url('cari/edit_cri');?>",
               data: {
                    kode: kode,
                    cri: cri,
                    status: status,
                    ket: ket
               },
               success: function(data) {
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                         tbmcri.draw();
                         $("#editcrimdl").modal("hide");
                         $(".err_psn_cri").removeClass('d-none');
                         $(".err_psn_cri").removeClass('alert-danger');
                         $(".err_psn_cri").addClass('alert-info');
                         $(".err_psn_cri").html(data.pesan);
                         $("#editDepartKode").val('');
                         $("#editDepart").val('');
                         $("#editDepartKet").val('');
                         $("#editDepartStatus").val('');
                         $("#error1ed").html('');
                         $("#error2ed").html('');
                         $("#error3ed").html('');
                         $(".err_psn_cri").fadeTo(3000, 500).slideUp(500,
                              function() {
                                   $(".err_psn_cri").slideUp(500);
                              });
                    } else if (data.statusCode == 201 || data.statusCode == 203 ||
                         data.statusCode == 204 || data.statusCode == 205) {
                         $(".err_psn_edit_dprt").removeClass('d-none');
                         $(".err_psn_edit_dprt").removeClass('alert-info');
                         $(".err_psn_edit_dprt").addClass('alert-danger');
                         $(".err_psn_edit_dprt").html(data.pesan);
                         $(".err_psn_edit_dprt").fadeTo(3000, 500).slideUp(500,
                              function() {
                                   $(".err_psn_edit_dprt").slideUp(500);
                              });
                    } else if (data.statusCode == 202) {
                         $("#error1ed").html(data.kode);
                         $("#error2ed").html(data.cri);
                         $("#error3ed").html(data.status);
                    }
               },
               error: function(xhr, ajaxOptions, thrownError) {
                    $.LoadingOverlay("hide");
                    $(".err_psn_cri").removeClass("alert-primary");
                    $(".err_psn_cri").addClass("alert-danger");
                    $(".err_psn_cri").css("display", "block");
                    if (xhr.status == 404) {
                         $(".err_psn_cri").html(
                              "Cari gagal diupdate, Link data tidak ditemukan");
                    } else if (xhr.status == 0) {
                         $(".err_psn_cri").html(
                              "Cari gagal diupdate, Waktu koneksi habis");
                    } else {
                         $(".err_psn_cri").html(
                              "Terjadi kesalahan saat meng-update data, hubungi administrator"
                         );
                    }
                    $("#editcrimdl").modal("hide");
                    $(".err_psn_cri ").fadeTo(3000, 500).slideUp(500, function() {
                         $(".err_psn_cri ").slideUp(500);
                    });
               }
          })
     });

     $.LoadingOverlay("hide");

     tbmcri = $('#tbmCariData').DataTable();
});
</script>