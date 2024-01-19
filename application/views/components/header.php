<!DOCTYPE html>
<html lang="en">

<head>
    <title>1DBsys - Main</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- Favicon icon -->

    <link rel="icon" href="<?=base_url();?>assets/assets/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets/others/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets/others/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/css/select2.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets/others/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets/others/jquery-ui.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/css/style.css" />

    <!-- SweetAlert -->
    <link rel='stylesheet' href='<?=base_url();?>assets/assets/css/sweetalert2.min.css'>
    <script src="<?=base_url();?>assets/assets/js/sweetalert2.all.min.js"></script>

    <style>
    .swal2-container {
        z-index: 2000000000000 !important;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    a.disabled {
        pointer-events: none;
        cursor: default;
    }

    .parsley-error {
        color: red;
    }

    .form-group.mandatory .form-label:first-child:after {
        content: " *";
        color: #dc3545
    }
    </style>
</head>

<body class=" bg-c-blue">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>