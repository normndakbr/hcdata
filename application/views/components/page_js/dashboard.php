<script>
$("#detLanggar").click(function() {
    let prs = $('#perDetLgrAktif').val();

    $.LoadingOverlay('show');
    $('#mdlDetLanggarAktif').modal('show');
    $('#tbLanggarAktif').load(site_url + "dash/data_langgar_aktif/" + prs);
});

$('#perDetLgrAktif').select2({
    theme: 'bootstrap4',
    width: '100%',
    dropdownParent: $('#mdlDetLanggarAktif')
});

$('#perDetLgrAktif').change(function() {
    let prs = $('#perDetLgrAktif').val();

    $.LoadingOverlay('show');
    $('#tbLanggarAktif').empty();
    $('#tbLanggarAktif').load(site_url + "dash/data_langgar_aktif/" + prs);
});
</script>
<script src="<?=base_url()?>assets/js/dashboard.js"></script>