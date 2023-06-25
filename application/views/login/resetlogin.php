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
     <div class="loader-bg">
          <div class="loader-track">
               <div class="loader-fill"></div>
          </div>
     </div>
     <div class="auth-wrapper">
          <div class="auth-content" style="width:450px;">
               <div class="card animate__animated animate__bounce" style="border-radius: 2%;">
                    <div class="row">
                         <div class="col-md-12">
                              <div class="card-body">
                                   <div class="align-items-center text-center" style="margin-top: -35px;">
                                        <img src="<?= base_url(); ?>assets/assets/images/auth/idc.jpg" alt="PT Indexim Coalindo" class="w-75 mt-1">
                                        <h4 class="text-black font-weight-bolder mt-2">RESET SANDI</h4>
                                        <div class="alert alert-danger errormsg animate__animated animate__bounce d-none"></div>
                                   </div>
                                   <div class="form-group mb-4 mt-3 mb-2">
                                        <label class="floating-label font-weight-bold" for="temail_reset">Email Terdaftar</label>
                                        <input type="email" class="form-control" id="temail_reset" name="temail_reset" placeholder="" value='' required>
                                        <small class="text-danger error1rst font-italic font-weight-bold"></small>
                                   </div>
                                   <div class=" align-content-center text-center mt-2">
                                        <div class="row">
                                             <div class="col-lg-6">
                                                  <button id="btnResetSandi" name="btnResetSandi" class="btn btn-block btn-success font-weight-bold" style="border-radius:7px">RESET SANDI</button>
                                             </div>
                                             <div class="col-lg-6">
                                                  <a href="<?= base_url('login'); ?>" class="btn btn-block btn-primary font-weight-bold text-white" style="border-radius:7px;">LOGIN</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
     <script src="<?= base_url(); ?>assets/assets/js/vendor-all.min.js"></script>
     <script src="<?= base_url(); ?>assets/assets/js/plugins/bootstrap.min.js"></script>
     <script src="<?= base_url(); ?>assets/assets/js/ripple.js"></script>
     <script src="<?= base_url(); ?>assets/assets/js/pcoded.min.js"></script>
     <script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/assets/js/loadingoverlay.min.js"></script>
     <script>
          if (window.history.replaceState) {
               window.history.replaceState(null, null, '<?= base_url(); ?>');
          }

          $("#temail_reset").keyup(function() {
               let email = $("#temail_reset").val();
               if (email != "") {
                    $('.error1rst').html('');
               }
          });

          $(".pesan ").fadeTo(3000, 500).slideUp(500, function() {
               $(".pesan ").slideUp(500);
          });

          $(document).ready(function() {
               $("#btnResetSandi").click(function() {
                    let email = $("#temail_reset").val();

                    $(".card").LoadingOverlay("show");
                    $.ajax({
                         type: "POST",
                         url: "<?= base_url("login/resetsandi"); ?>",
                         data: {
                              email: email
                         },
                         success: function(data) {
                              var data = JSON.parse(data);
                              if (data.statusCode == 200) {
                                   window.location.href = "<?= base_url('login/sukses'); ?>";
                              } else if (data.statusCode == 201) {
                                   $(".error1rst").html(data.email);
                                   $(".card").LoadingOverlay("hide");
                              } else {
                                   $(".card").LoadingOverlay("hide");
                                   $(".errormsg").removeClass('d-none');
                                   $(".errormsg").removeClass('alert-info');
                                   $(".errormsg").addClass('alert-danger');
                                   $(".errormsg").html(data.pesan);
                              }
                         },
                         error: function(xhr, ajaxOptions, thrownError) {
                              $(".card").LoadingOverlay("hide");
                              $(".errormsg").removeClass('d-none');
                              $(".errormsg").removeClass('alert-info');
                              $(".errormsg").addClass('alert-danger');
                              if (thrownError != "") {
                                   $(".errormsg").html("Error saat proses reset sandi, hubungi administrator");
                              }
                         }
                    });
               });
          });
     </script>
</body>

</html>