<div class="pcoded-main-container">
     <div class="pcoded-content">
          <div class="page-header">
               <div class="page-block">
                    <div class="row align-items-center">
                         <div class="col-md-12">
                              <div class="page-header-title">
                                   <h5 class="m-b-10">Data Master</h5>
                              </div>
                              <ul class="breadcrumb">
                                   <li class="breadcrumb-item">
                                        <a href="<?= base_url('dash'); ?>">
                                             <i class="feather icon-home"></i>
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a href="<?= base_url('user'); ?>">
                                             User
                                        </a>
                                   </li>
                                   <li class="breadcrumb-item">
                                        <a id="bc2">
                                             Tambah User
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-xl-12 col-md-12">
                    <div class="card latest-update-card">
                         <div class="card-header">
                              <h5>Tambah User</h5>
                              <div class="card-header-right">
                                   <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                             <li class="dropdown-item full-card">
                                                  <a href="#!"><span><i class="feather icon-maximize"></i>
                                                            Perbesar</span><span style="display: none"><i class="feather icon-minimize"></i> Restore</span></a>
                                             </li>
                                             <li class="dropdown-item minimize-card">
                                                  <a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display: none"><i class="feather icon-plus"></i> expand</span></a>
                                             </li>
                                             <li class="dropdown-item reload-card">
                                                  <a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                                             </li>
                                        </ul>
                                   </div>
                              </div>
                         </div>
                         <div class="card-body">
                              <div class="mt-3">
                                   <div class="mb-4">
                                        <a href="<?= base_url('user'); ?>" class="btn btn-primary font-weight-bold">Refresh / Data</a>
                                        <a href="<?= base_url('user/new'); ?>" class="btn btn-success font-weight-bold">Tambah Data</a>
                                   </div>
                                   <?= $this->session->flashdata('msg'); ?>
                              </div>
                              <form action="<?= base_url('user/buatuser'); ?>" method="post">
                                   <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                             <label for="namaUser">Nama User :</label>
                                             <input id='namaUser' name='namaUser' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="<?= set_value('namaUser'); ?>">
                                             <?= form_error('namaUser', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-6 col-md-4 col-sm-12">
                                             <label for="emailUser">Email User :</label>
                                             <input id='emailUser' name='emailUser' type="text" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="<?= set_value('emailUser'); ?>">
                                             <?= form_error('emailUser', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                             <label for="tglAktif">Tanggal Aktif :</label>
                                             <input id='tglAktif' name='tglAktif' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="<?= set_value('tglAktif'); ?>">
                                             <?= form_error('tglAktif', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                             <label for="tglExpired">Tanggal Expired :</label>
                                             <input id='tglExpired' name='tglExpired' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="<?= set_value('tglExpired'); ?>">
                                             <?= form_error('tglExpired', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                             <label for="aksesUser">Akses Menu :</label>
                                             <select id='aksesUser' name='aksesUser' type="date" autocomplete="off" spellcheck="false" class="form-control form-control-user" value="">
                                                  <option value="">-- Pilih Akses Menu --</option>
                                                  <option value="0">Admin</option>
                                             </select>
                                             <?= form_error('aksesUser', '<small class="text-danger font-italic font-weight-bold">', '</small>'); ?><br>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <hr class="mb-2">
                                             <button type="submit" name="btnTambahUser" id="btnTambahUser" class="btn font-weight-bold btn-primary">Simpan</button>
                                             <a href="<?= base_url('user/new'); ?>" name="btnBatalUser" id="btnBatalUser" class="btn font-weight-bold btn-danger">Batal</a>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>