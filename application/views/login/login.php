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

</head>

<div class="auth-wrapper">
     <div class="auth-content">
          <div class="card animate__animated animate__bounce">
               <form action="<?= base_url('login/auth'); ?>" method="post">
                    <div class="row">
                         <div class="col-md-12">
                              <div class="card-body">
                                   <div class="align-items-center text-center">
                                        <h3 class="mb-3 f-w-400 font-weight-bold">eEmployee System</h3>
                                        <h4 class="mb-3 f-w-400">Selamat Datang</h4>
                                        <?= $this->session->userdata('pesan'); ?>
                                   </div>
                                   <div class="form-group mb-3">
                                        <label class="floating-label" for="temail">Email</label>
                                        <input type="text" class="form-control" id="temail" name="temail" placeholder="" value='<?= set_value('temail'); ?>'>
                                        <?= form_error('temail', '<small class="text-danger font-italic font-weight-bold">', ' </small>') ?>
                                   </div>
                                   <div class="form-group mb-4">
                                        <label class="floating-label" for="tsandi">Sandi</label>
                                        <input type="password" class="form-control" id="tsandi" name="tsandi" placeholder="">
                                        <?= form_error('tsandi', '<small class="text-danger font-italic font-weight-bold">', ' </small>') ?>
                                   </div>
                                   <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Ingatkan saya</label>
                                   </div>
                                   <button type='submit' class="btn btn-block btn-primary mb-4 uiusdd123">Masuk</button>
                                   <p class="mb-2 text-muted">Lupa Sandi? <a href="#" class="f-w-400">Reset</a></p>
                              </div>
                         </div>
                    </div>
               </form>
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

     $(".pesan ").fadeTo(2000, 500).slideUp(500, function() {
          $(".pesan ").slideUp(500);
     });
</script>
</body>

</html>