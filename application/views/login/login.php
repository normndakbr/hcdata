<!DOCTYPE html>
<html lang="en">

<head>
     <title>eEmployee - Login</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="description" content="" />
     <meta name="keywords" content="">
     <meta name="author" content="Phoenixcoded" />
     <link rel="icon" href="<?= base_url(); ?>assets/assets/images/favicon.ico" type="image/x-icon">
     <link rel="stylesheet" href="<?= base_url(); ?>assets/assets/css/style.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
     <style>
          .auth-wrapper {
               background-image: url(<?= base_url('assets/assets/images/back/login.png') ?>);
               background-size: cover;
               background-repeat: no-repeat;
          }
     </style>
</head>

<body>
     <div class="auth-wrapper">
          <div class="auth-content" style="width:450px">
               <div class="card" style="border-radius: 2%;">
                    <form action="<?= base_url('login/auth'); ?>" method="post">
                         <div class="row">
                              <div class="col-md-12">
                                   <div class="card-body">
                                        <div class="align-items-center text-center" style="margin-top: -35px;">
                                             <img src="<?= base_url('assets/assets/images/auth/idc.jpg'); ?>" alt="PT Indexim Coalindo" class="w-75 mt-1">
                                             <h4 class="text-black font-weight-bolder mt-2">PT INDEXIM COALINDO</h4>
                                             <?= $this->session->userdata('pesan'); ?>
                                             <?= $this->session->unset_userdata('pesan'); ?>
                                        </div>
                                        <div class="form-group mb-3 mt-3">
                                             <label class="floating-label font-weight-bold" for="temail">Email</label>
                                             <input type="text" class="form-control" id="temail" name="temail" placeholder="" value='<?= set_value('temail'); ?>'>
                                             <?= form_error('temail', '<small class="text-danger font-italic font-weight-bold">', ' </small>') ?>
                                        </div>
                                        <div class="form-group mb-4">
                                             <label class="floating-label font-weight-bold" for="tsandi">Sandi</label>
                                             <input type="password" class="form-control" id="tsandi" name="tsandi" placeholder="">
                                             <?= form_error('tsandi', '<small class="text-danger font-italic font-weight-bold">', ' </small>') ?>
                                        </div>
                                        <div class="align-items-center text-center">
                                             <button type='submit' class="btn btn-block btn-primary mb-4 font-weight-bold" style="border-radius:7px;">LOGIN</button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </form>
               </div>
               <div class="text-center mt-2">
                    <small class=" font-weight-bold text-white">© 2009-2023 PT Indexim Coalindo. All rights reserved.</small>
               </div>
          </div>
     </div>

     <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
     <script src="<?= base_url(); ?>assets/assets/js/vendor-all.min.js"></script>
     <script src="<?= base_url(); ?>assets/assets/js/plugins/bootstrap.min.js"></script>
     <script src="<?= base_url(); ?>assets/assets/js/ripple.js"></script>
     <script src="<?= base_url(); ?>assets/assets/js/pcoded.min.js"></script>
     <script>
          if (window.history.replaceState) {
               window.history.replaceState(null, null, '<?= base_url(); ?>');
          }

          $(".pesan ").fadeTo(3000, 500).slideUp(500, function() {
               $(".pesan ").slideUp(500);
          });
     </script>

</body>


</html>