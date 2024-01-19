<script src="<?= base_url(); ?>assets/assets/js/jquery-3.5.1.js"></script>
<script src="<?= base_url(); ?>assets/assets/js/vendor-all.min.js"></script>
<script src="<?= base_url(); ?>assets/assets/js/plugins/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/assets/js/ripple.js"></script>
<script src="<?= base_url(); ?>assets/assets/js/pcoded.min.js"></script>
<script src="<?= base_url(); ?>assets/assets/js/plugins/apexcharts.min.js"></script>
<script src="<?= base_url(); ?>assets/assets/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>assets/assets/js/loadingoverlay.min.js"></script>
<script src="<?= base_url(); ?>assets/assets/others/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/assets/others/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>assets/assets/others/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/assets/others/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/assets/others/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/assets/js/jquery.inputmask.bundle.js"></script>
<script>
let site_url = '<?=base_url()?>';
$(document).on('click', '.onprocess', function() {
    swal("Under Maintenance", "Fitur masih diproses", 'info');
});
$("#txtcarikary").on('keypress', function(e) {
    if (e.which == 13) {
        let txt = $("#txtcarikary").val().replace(/' '/g, "_");
        window.open(site_url + "cari?fdt=" + txt, '_blank');
    }
});
</script>