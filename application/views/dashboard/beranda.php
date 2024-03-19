<div class="pcoded-main-container">
     <div class="pcoded-content">
          <div class="page-header">
               <div class="page-block">
                    <div class="row align-items-center">
                         <div class="col-md-12 mt-3">
                              <div class="page-header-title">
                                   <h6 class="font-italic font-weight-bold text-white">Selamat Datang,</h6>
                                   <h1 class="font-weight-bold text-white" style="margin-top:-10px;"><?= $nama; ?></h1>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
               <img src="<?= base_url('assets/assets/images/auth/dash_trans.png'); ?>" alt="PT Indexim Coalindo" class="mt-5 center_img">
          </div>
     </div>
</div>
<script>
     $(document).ready(function() {
          $("#logout").click(function() {
               $("#logoutmdl").modal("show");
          });

     });
</script>