<script>
    $(".err_psn_sandi").fadeTo(3000, 500).slideUp(500, function() {
        $(".err_psn_sandi").slideUp(500);
        " <?= $this->session->set_flashdata('msg', '') ?>";
    });

    $("#logout").click(function() {
        $("#logoutmdl").modal("show");
    });
</script>