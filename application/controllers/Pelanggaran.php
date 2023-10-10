<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggaran extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_logout();
     }

     public function index()
     {
          if ($this->session->has_userdata('id_m_perusahaan_main')) {
               $idmper = $this->session->userdata('id_m_perusahaan_main');
               if ($idmper != "") {
                    $data['permst'] = $this->str->getMaster($idmper, "");
                    $data['perstr'] = $this->str->getMenu($idmper, "");
               } else {
                    $data['permst'] = "";
                    $data['perstr'] = "";
               }
          } else {
               $idmper = "";
               $data['permst'] = "";
               $data['perstr'] = "";
          }
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/pelanggaran/pelanggaran');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/pelanggaran');
     }

     public function new()
     {
          if ($this->session->has_userdata('id_m_perusahaan_main')) {
               $idmper = $this->session->userdata('id_m_perusahaan_main');
               if ($idmper != "") {
                    $data['permst'] = $this->str->getMaster($idmper, "");
                    $data['perstr'] = $this->str->getMenu($idmper, "");
               } else {
                    $data['permst'] = "";
                    $data['perstr'] = "";
               }
          } else {
               $idmper = "";
               $data['permst'] = "";
               $data['perstr'] = "";
          }
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $data['langgar_jenis'] = $this->lgr->get_data_punish();
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/pelanggaran/pelanggaran_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/pelanggaran');
     }

     public function ajax_list()
     {
          $auth = htmlspecialchars($this->input->get("authtoken", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               $output = array(
                    "draw" => '',
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => '',
                    "pesan" => "Autentikasi tidak valid, refresh data"

               );

               echo json_encode($output);
          } else {
               $auth_per = htmlspecialchars($this->input->get("auth_per", true));
               $list = $this->lgr->get_datatables($auth_per);
               $data = array();
               $no = $_POST['start'];
               foreach ($list as $lgr) {
                    $no++;
                    $row = array();
                    $row['no'] = $no;
                    $row['no_nik'] = $lgr->no_nik;
                    $row['nama_lengkap'] = $lgr->nama_lengkap;
                    $row['depart'] = $lgr->depart;
                    $row['posisi'] = $lgr->posisi;
                    $row['langgar_jenis'] = $lgr->langgar_jenis;
                    $row['tgl_akhir_langgar'] = date('d-M-Y', strtotime($lgr->tgl_akhir_langgar));

                    $tglnow = date('Y-m-d');
                    $tglakhir = date('Y-m-d', strtotime($lgr->tgl_akhir_langgar));
                    if ($tglnow < $tglakhir) {
                         $row['stat_langgar'] = "<span class='btn btn-success btn-sm' style='cursor:text;'>AKTIF</span>";
                    } else {
                         $row['stat_langgar'] = "<span class='btn btn-danger btn-sm' style='cursor:text;'>NONAKTIF</span>";
                    }

                    $row['ket_langgar'] = $lgr->ket_langgar;
                    $row['kode_perusahaan'] = $lgr->kode_perusahaan;
                    $row['tgl_buat'] = date('d-M-Y', strtotime($lgr->tgl_buat));
                    $row['tgl_edit'] = date('d-M-Y', strtotime($lgr->tgl_edit));
                    $row['proses'] = '<a href="' . base_url('pelanggaran/detail/' . $lgr->auth_langgar) . '" target="_blank" class="btn btn-primary btn-sm font-weight-bold text-white" title="Detail" value=""> <i class="fas fa-asterisk"></i> </a> 
                    <a href="' . base_url('pelanggaran/edit/' . $lgr->auth_langgar) . '" target="_blank" class="btn btn-warning btn-sm font-weight-bold text-white" title="Edit" value=""> <i class="fas fa-edit"></i> </a> 
                    <button id="' . $lgr->auth_langgar . '" class="btn btn-danger btn-sm font-weight-bold text-white hapuslanggar" title="Hapus" value=""> <i class="fas fa-trash-alt"></i> </button>';
                    $data[] = $row;
               }

               $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->lgr->count_all(),
                    "recordsFiltered" => $this->lgr->count_filtered($auth_per),
                    "data" => $data,
               );

               //output to json format
               echo json_encode($output);
          }
     }

     public function tglpunish()
     {
          $this->form_validation->set_rules("tgl_punish", "tgl_punish", "required|trim", [
               'required' => 'Tanggal wajib diisi',
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'tgl_punish' => form_error("tgl_punish")
               ];

               echo json_encode($error);
               return;
          } else {
               $authlanggarjenis = htmlspecialchars($this->input->post("authlanggarjenis", true));
               $tgl_punish = htmlspecialchars($this->input->post("tgl_punish", true));
               $tgl_langgar = htmlspecialchars($this->input->post("tgl_langgar", true));

               if ($tgl_langgar > $tgl_punish) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Tanggal punishment tidak boleh lebih sebelum tanggal pelanggaran", "tgl_punish" => ""));
                    return;
               }

               $punish = $this->lgr->data_punish($authlanggarjenis);
               if (!empty($punish)) {
                    foreach ($punish as $lst) {
                         $lamawaktu = $lst->durasi_langgar_jenis;
                         $satuan = $lst->jenis_durasi;
                    }

                    $tgl_punish = strtotime($tgl_punish);
                    $tglakhirpunish = date('Y-m-d', strtotime("+" . $lamawaktu . " " . $satuan, $tgl_punish));

                    echo json_encode(array("statusCode" => 200, "pesan" => "Sukses", "tgl_akhir" => $tglakhirpunish));
               }
          }
     }


     public function cektgl()
     {
          $tgl = htmlspecialchars($this->input->post("tgl", true));
          $tglpunish = htmlspecialchars($this->input->post("tglpunish", true));
          $now = date('Y-m-d');

          if ($tgl > $now) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Tanggal pelanggaran tidak boleh setelah hari ini"));
               return;
          }

          if ($tglpunish != "") {
               if ($tgl > $tglpunish) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Tanggal pelanggaran tidak boleh setelah tanggal punishment"));
                    return;
               }
          }
     }

     public function add()
     {
          $this->form_validation->set_rules("perLanggar", "perLanggar", "required|trim", [
               'required' => 'Perusahaan wajib dipilih'
          ]);
          $this->form_validation->set_rules("authKTPKaryLanggar", "authKTPKaryLanggar", "required|trim", [
               'required' => 'Karyawan wajib dipilih'
          ]);
          $this->form_validation->set_rules("tglLanggar", "tglLanggar", "required|trim", [
               'required' => 'Tgl. pelanggaran wajib diisi',
          ]);
          $this->form_validation->set_rules("tglPunish", "tglPunish", "required|trim", [
               'required' => 'Tgl. punishment wajib diisi',
          ]);
          $this->form_validation->set_rules("jenisPunish", "jenisPunish", "required|trim", [
               'required' => 'Jenis punishment wajib dipilih',
          ]);
          $this->form_validation->set_rules("tglAkhirPunish", "tglAkhirPunish", "required|trim", [
               'required' => 'Tgl. akhir punishment wajib diisi',
          ]);
          $this->form_validation->set_rules("ketLanggar", "ketLanggar", "required|trim|max_length[2500]", [
               'required' => 'Keterangan pelanggaran wajib diisi',
               'max_length' => 'Keterangan maksimal 2500 karakter'
          ]);
          if (empty($_FILES['berkasPunish']['name'])) {
               $this->form_validation->set_rules("berkasPunish", "berkasPunish", "required|trim", [
                    'required' => 'Berkas punishment wajib diupload',
               ]);
          }

          if ($this->form_validation->run() == false) {
               if ($this->session->has_userdata('id_m_perusahaan_main')) {
                    $idmper = $this->session->userdata('id_m_perusahaan_main');
                    if ($idmper != "") {
                         $data['permst'] = $this->str->getMaster($idmper, "");
                         $data['perstr'] = $this->str->getMenu($idmper, "");
                    } else {
                         $data['permst'] = "";
                         $data['perstr'] = "";
                    }
               } else {
                    $idmper = "";
                    $data['permst'] = "";
                    $data['perstr'] = "";
               }
               $data['nama'] = $this->session->userdata("nama");
               $data['email'] = $this->session->userdata("email");
               $data['menu'] = $this->session->userdata("id_menu");
               $data['langgar_jenis'] = $this->lgr->get_data_punish();
               $this->load->view('dashboard/template/header', $data);
               $this->load->view('dashboard/pelanggaran/pelanggaran_add');
               $this->load->view('dashboard/modal/mdlform');
               $this->load->view('dashboard/template/footer', $data);
               $this->load->view('dashboard/code/pelanggaran');
          } else {
               $authKTPKaryLanggar = htmlspecialchars($this->input->post("authKTPKaryLanggar", true));
               $tglLanggar = htmlspecialchars($this->input->post("tglLanggar", true));
               $tglPunish = htmlspecialchars($this->input->post("tglPunish"));
               $jenisPunish = htmlspecialchars($this->input->post("jenisPunish"));
               $tglAkhirPunish = htmlspecialchars($this->input->post("tglAkhirPunish"));
               $ketLanggar = htmlspecialchars($this->input->post("ketLanggar"));
               $id_jenis = $this->lgr->get_id_by_auth($jenisPunish);
               $id_kary = $this->kry->get_id_karyawan($authKTPKaryLanggar);
               $id_personal = $this->kry->get_id_personal_by_kary($authKTPKaryLanggar);
               $foldername = md5($id_personal);
               $now = date('YmdHis');
               $nama_file = $now . "-LGR.pdf";

               $cekdata = $this->lgr->cek_data($id_kary, $id_jenis);
               if ($cekdata) {
                    $this->session->set_flashdata('msg', '<div class="err_psn_langgar_add alert alert-danger animate__animated animate__bounce"> Karyawan yang dipilih masih memiliki punishment yang aktif </div>');
                    if ($this->session->has_userdata('id_m_perusahaan_main')) {
                         $idmper = $this->session->userdata('id_m_perusahaan_main');
                         if ($idmper != "") {
                              $data['permst'] = $this->str->getMaster($idmper, "");
                              $data['perstr'] = $this->str->getMenu($idmper, "");
                         } else {
                              $data['permst'] = "";
                              $data['perstr'] = "";
                         }
                    } else {
                         $idmper = "";
                         $data['permst'] = "";
                         $data['perstr'] = "";
                    }
                    $data['nama'] = $this->session->userdata("nama");
                    $data['email'] = $this->session->userdata("email");
                    $data['menu'] = $this->session->userdata("id_menu");
                    $data['langgar_jenis'] = $this->lgr->get_data_punish();
                    $this->load->view('dashboard/template/header', $data);
                    $this->load->view('dashboard/pelanggaran/pelanggaran_add');
                    $this->load->view('dashboard/modal/mdlform');
                    $this->load->view('dashboard/template/footer', $data);
                    $this->load->view('dashboard/code/pelanggaran');
                    return;
               }

               if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                    mkdir('./berkas/karyawan/' . $foldername, 0775, TRUE);
               }

               if (is_dir('./berkas/karyawan/' . $foldername)) {
                    $config['upload_path'] = './berkas/karyawan/' . $foldername;
                    $config['allowed_types'] = '*';
                    $config['max_size'] = 100;
                    $config['file_name'] = $nama_file;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('berkasPunish')) {
                         $err = $this->upload->display_errors();
                         if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                              $error = "<p>Ukuran file maksimal 100 kb.</p>";
                         } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                              $error = "<p>Format file nya dalam bentuk pdf</p>";
                         } else if ($err == "<p>You did not select a file to upload.</p>") {
                              $error = "<p>Tidak ada file yang dipilih</p>";
                         } else {
                              $error = $err;
                         }

                         if ($this->session->has_userdata('id_m_perusahaan_main')) {
                              $idmper = $this->session->userdata('id_m_perusahaan_main');
                              if ($idmper != "") {
                                   $data['permst'] = $this->str->getMaster($idmper, "");
                                   $data['perstr'] = $this->str->getMenu($idmper, "");
                              } else {
                                   $data['permst'] = "";
                                   $data['perstr'] = "";
                              }
                         } else {
                              $idmper = "";
                              $data['permst'] = "";
                              $data['perstr'] = "";
                         }
                         $data['nama'] = $this->session->userdata("nama");
                         $data['email'] = $this->session->userdata("email");
                         $data['menu'] = $this->session->userdata("id_menu");
                         $data['langgar_jenis'] = $this->lgr->get_data_punish();
                         $data['err_upl'] = $error;
                         $this->load->view('dashboard/template/header', $data);
                         $this->load->view('dashboard/pelanggaran/pelanggaran_add');
                         $this->load->view('dashboard/modal/mdlform');
                         $this->load->view('dashboard/template/footer', $data);
                         $this->load->view('dashboard/code/pelanggaran');
                    } else { //sukses upload
                         $data = [
                              'id_kary' => $id_kary,
                              'tgl_langgar' => $tglLanggar,
                              'tgl_punishment' => $tglPunish,
                              'id_langgar_jenis' => $id_jenis,
                              'ket_langgar' => $ketLanggar,
                              'url_langgar' =>  $nama_file,
                              'tgl_akhir_langgar' => $tglAkhirPunish,
                              'tgl_buat' => date('Y-m-d H:i:s'),
                              'tgl_edit' => date('Y-m-d H:i:s'),
                              'id_user' => $this->session->userdata('id_user_main'),
                         ];

                         $langgar = $this->lgr->input_langgar($data);
                         if ($langgar) {
                              $this->session->set_flashdata('msg', '<div class="err_psn_langgar_add alert alert-info animate__animated animate__bounce"> Data pelanggaran berhasil dibuat </div>');
                              redirect('pelanggaran/new', 'refresh');
                         } else {
                              $this->session->set_flashdata('msg', '<div class="err_psn_langgar_add alert alert-danger animate__animated animate__bounce"> Data pelanggaran gagal dibuat </div>');
                              if ($this->session->has_userdata('id_m_perusahaan_main')) {
                                   $idmper = $this->session->userdata('id_m_perusahaan_main');
                                   if ($idmper != "") {
                                        $data['permst'] = $this->str->getMaster($idmper, "");
                                        $data['perstr'] = $this->str->getMenu($idmper, "");
                                   } else {
                                        $data['permst'] = "";
                                        $data['perstr'] = "";
                                   }
                              } else {
                                   $idmper = "";
                                   $data['permst'] = "";
                                   $data['perstr'] = "";
                              }
                              $data['nama'] = $this->session->userdata("nama");
                              $data['email'] = $this->session->userdata("email");
                              $data['menu'] = $this->session->userdata("id_menu");
                              $data['langgar_jenis'] = $this->lgr->get_data_punish();
                              $this->load->view('dashboard/template/header', $data);
                              $this->load->view('dashboard/pelanggaran/pelanggaran_add');
                              $this->load->view('dashboard/modal/mdlform');
                              $this->load->view('dashboard/template/footer', $data);
                              $this->load->view('dashboard/code/pelanggaran');
                         }
                    }
               }
          }
     }

     public function hapus($auth_langgar)
     {
          $query = $this->lgr->hapus_langgar($auth_langgar);
          if ($query == 200) {
               $this->session->set_flashdata('msg', '<div class="err_psn_langgar_add alert alert-info animate__animated animate__bounce"> Data pelanggaran berhasil dihapus </div>');
               return;
          } else if ($query == 201) {
               $this->session->set_flashdata('msg', '<div class="err_psn_langgar_add alert alert-danger animate__animated animate__bounce"> Data pelanggaran gagal dibuat </div>');
               return;
          } else {
               $this->session->set_flashdata('msg', '<div class="err_psn_langgar_add alert alert-danger animate__animated animate__bounce"> Data pelanggaran tidak ditemukan </div>');
               return;
          }
     }

     public function detail($auth_langgar)
     {
          $query = $this->lgr->data_langgar($auth_langgar);
          if (!empty($query)) {

               foreach ($query as $list) {

                    $tglnow = date('Y-m-d');
                    $tglakhir = date('Y-m-d', strtotime($list->tgl_akhir_langgar));
                    if ($tglnow < $tglakhir) {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data_lgr = [
                         'statusCode' => 200,
                         'pesan' => 'Sukses',
                         'kode_perusahaan' => $list->kode_perusahaan,
                         'nama_perusahaan' => $list->nama_m_perusahaan,
                         'no_ktp' => $list->no_ktp,
                         'no_nik' => $list->no_nik,
                         'nama_lengkap' => $list->nama_lengkap,
                         'depart' => $list->depart,
                         'posisi' => $list->posisi,
                         'tgl_langgar' => date('d-M-Y', strtotime($list->tgl_langgar)),
                         'tgl_punishment' => date('d-M-Y', strtotime($list->tgl_punishment)),
                         'kode_langgar_jenis' => $list->kode_langgar_jenis,
                         'langgar_jenis' => $list->langgar_jenis,
                         'tgl_akhir_langgar' => date('d-M-Y', strtotime($list->tgl_akhir_langgar)),
                         'url_berkas' => base_url('pelanggaran/berkas/') . $auth_langgar,
                         'ket_langgar' => $list->ket_langgar,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'tgl_edit' => date('d-M-Y H:i:s', strtotime($list->tgl_edit)),
                         'pembuat' => $list->nama_user
                    ];
               }

               $data['nama'] = $this->session->userdata("nama");
               $data['email'] = $this->session->userdata("email");
               $data['menu'] = $this->session->userdata("id_menu");
               $data['langgar'] = $data_lgr;
               $this->load->view('dashboard/template/header', $data);
               $this->load->view('dashboard/pelanggaran/pelanggaran_detail');
               $this->load->view('dashboard/template/footer', $data);
               $this->load->view('dashboard/code/detaillanggar');
          }
     }

     public function edit($auth_langgar)
     {
          $query = $this->lgr->data_langgar($auth_langgar);
          if (!empty($query)) {

               foreach ($query as $list) {

                    if ($list->url_langgar == "") {
                         $url_langgar = "";
                    } else {
                         $url_langgar = base_url('pelanggaran/berkas/') . $list->auth_langgar;
                    }

                    $data_lgr = [
                         'statusCode' => 200,
                         'pesan' => 'Sukses',
                         'kode_perusahaan' => $list->kode_perusahaan,
                         'nama_perusahaan' => $list->nama_m_perusahaan,
                         'auth_m_per' => $list->auth_m_per,
                         'auth_langgar' => $list->auth_langgar,
                         'auth_langgar_jenis' => $list->auth_langgar_jenis,
                         'auth_kary' => $list->auth_kary,
                         'no_ktp' => $list->no_ktp,
                         'no_nik' => $list->no_nik,
                         'nama_lengkap' => $list->nama_lengkap,
                         'depart' => $list->depart,
                         'posisi' => $list->posisi,
                         'url_langgar' =>  $url_langgar,
                         'tgl_langgar' => date('Y-m-d', strtotime($list->tgl_langgar)),
                         'tgl_punishment' => date('Y-m-d', strtotime($list->tgl_punishment)),
                         'kode_langgar_jenis' => $list->kode_langgar_jenis,
                         'langgar_jenis' => $list->langgar_jenis,
                         'tgl_akhir_langgar' => date('Y-m-d', strtotime($list->tgl_akhir_langgar)),
                         'ket_langgar' => $list->ket_langgar,
                    ];
               }

               $data['nama'] = $this->session->userdata("nama");
               $data['email'] = $this->session->userdata("email");
               $data['menu'] = $this->session->userdata("id_menu");
               $data['langgar'] = $data_lgr;
               $data['langgar_jenis'] = $this->lgr->get_data_punish();
               $this->load->view('dashboard/template/header', $data);
               $this->load->view('dashboard/pelanggaran/pelanggaran_edit');
               $this->load->view('dashboard/template/footer', $data);
               $this->load->view('dashboard/code/detaillanggar');
          }
     }

     public function update()
     {
          $this->form_validation->set_rules("authLgrEdit", "authLgrEdit", "required|trim", [
               'required' => 'Data pelanggaran tidak ditemukan'
          ]);
          $this->form_validation->set_rules("authkary", "authkary", "required|trim", [
               'required' => 'Karyawan wajib dipilih',
          ]);
          $this->form_validation->set_rules("tglLgrEdit", "tglLgrEdit", "required|trim", [
               'required' => 'Tanggal pelanggaran wajib diisi',
          ]);
          $this->form_validation->set_rules("tglPunishLgrEdit", "tglPunishLgrEdit", "required|trim", [
               'required' => 'Tanggal punishment wajib diisi',
          ]);
          $this->form_validation->set_rules("jenisLgrEdit", "jenisLgrEdit", "required|trim", [
               'required' => 'Jenis punishment wajib dipilih',
          ]);
          $this->form_validation->set_rules("tglAkhirPunishLgrEdit", "tglAkhirPunishLgrEdit", "required|trim", [
               'required' => 'Tanggal akhir punisment wajib diisi',
          ]);
          $this->form_validation->set_rules("ketLgrEdit", "ketLgrEdit", "required|trim|max_length[2500]", [
               'required' => 'Keterangan pelanggaran wajib diisi',
               'max_length' => 'Keterangan maksimal 2500 karakter'
          ]);

          if ($this->form_validation->run() == false) {
               $authLgrEdit = htmlspecialchars($this->input->post("authLgrEdit", true));
               redirect(base_url('pelanggaran/edit/') . $authLgrEdit);
          } else {
               $authLgrEdit = htmlspecialchars($this->input->post("authLgrEdit", true));
               $authkary = htmlspecialchars($this->input->post("authkary", true));
               $tglLgrEdit = htmlspecialchars($this->input->post("tglLgrEdit", true));
               $tglPunishLgrEdit = htmlspecialchars($this->input->post("tglPunishLgrEdit", true));
               $jenisLgrEdit = htmlspecialchars($this->input->post("jenisLgrEdit", true));
               $tglAkhirPunishLgrEdit = htmlspecialchars($this->input->post("tglAkhirPunishLgrEdit", true));
               $ketLgrEdit = htmlspecialchars($this->input->post("ketLgrEdit", true));
               $id_jenis = $this->lgr->get_id_by_auth($jenisLgrEdit);
               $id_kary = $this->kry->get_id_karyawan($authkary);

               $cekdata = $this->lgr->cek_data_edit($id_kary, $id_jenis, $authLgrEdit);
               if ($cekdata) {
                    $this->session->set_flashdata('msg', '<div class="err_psn_langgar_add alert alert-danger animate__animated animate__bounce"> Karyawan yang dipilih masih memiliki punishment yang aktif </div>');
                    redirect(base_url('pelanggaran/edit/') . $authLgrEdit);
                    return;
               }

               $dt_lgr = [
                    'id_kary' => $id_kary,
                    'tgl_langgar' => $tglLgrEdit,
                    'tgl_punishment' => $tglPunishLgrEdit,
                    'id_langgar_jenis' => $id_jenis,
                    'ket_langgar' => $ketLgrEdit,
                    'url_langgar' => '',
                    'tgl_akhir_langgar' => $tglAkhirPunishLgrEdit,
                    'tgl_edit' => date('Y-m-d H:i:s'),
               ];

               $langgar = $this->lgr->update_langgar($dt_lgr,  $authLgrEdit);
               if ($langgar) {
                    $this->session->set_flashdata('msg', '<div class="err_psn_langgar_add alert alert-info animate__animated animate__bounce"> Data pelanggaran berhasil diupdate </div>');
                    redirect('pelanggaran');
               } else if ($langgar == 201) {
                    $this->session->set_flashdata('msg', '<div class="err_psn_langgar_add alert alert-danger animate__animated animate__bounce"> Pelanggaran gagal diupdate </div>');
                    redirect(base_url('pelanggaran/edit/') . $authLgrEdit);
               }
          }
     }

     public function uploadberkas()
     {

          $this->form_validation->set_rules("berkaslgr", "berkaslgr", "required|trim", [
               'required' => 'Berkas punishment wajib diupload'
          ]);
          $this->form_validation->set_rules("authlgr", "authlgr", "required|trim", [
               'required' => 'Karyawan tidak ditemukan'
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'berkaslgr' => form_error("berkaslgr"),
                    'authlgr' => form_error("authlgr")
               ];

               echo json_encode($error);
               die;
          } else {
               $authlgr = htmlspecialchars($this->input->post("authlgr", true));
               $dtlanggar = $this->lgr->data_langgar($authlgr);

               if (!empty($dtlanggar)) {
                    foreach ($dtlanggar as $list) {
                         $id_personal = $list->id_personal;
                    }

                    $foldername = md5($id_personal);
                    if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                         mkdir('./berkas/karyawan/' . $foldername, 0775, TRUE);
                    }

                    $foldername = md5($id_personal);
                    if (is_dir("berkas/karyawan/" . $foldername)) {
                         $namafile = date('YmdHis') . "-LGR.pdf";

                         $config['upload_path'] = './berkas/karyawan/' . $foldername;
                         $config['allowed_types'] = 'pdf';
                         $config['max_size'] = 100;
                         $config['file_name'] = $namafile;

                         $this->load->library('upload', $config);
                         if (!$this->upload->do_upload('berkasPunishEdit')) {
                              $err = $this->upload->display_errors();
                              if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                   $error = "<p>Ukuran file maksimal 100 kb.</p>";
                              } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                   $error = "<p>Format file nya dalam bentuk pdf</p>";
                              } else if ($err == "<p>You did not select a file to upload.</p>") {
                                   $error = "<p>Tidak ada file yang dipilih</p>";
                              } else {
                                   $error = $err;
                              }

                              $error_msg = [
                                   'statusCode' => 202,
                                   'berkaslgr' => $error,
                                   'authlgr' => "",
                              ];

                              echo json_encode($error_msg);
                              die;
                         } else {
                              $langgar = $this->lgr->edit_langgar($authlgr, $namafile);
                              if ($langgar) {
                                   echo json_encode(array("statusCode" => 200, "pesan" => "Berkas punishment berhasil diganti", "brks" => base_url('pelanggaran/berkas/') . $authlgr));
                                   return;
                              } else {
                                   echo json_encode(array("statusCode" => 201, "pesan" => "Berkas punishment gagal diganti"));
                                   return;
                              }
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Folder tidak ditemukan"));
                         return;
                    }
               }
          }
     }


     function berkas($auth_langgar)
     {
          $dtlanggar = $this->lgr->data_langgar($auth_langgar);

          if (!empty($dtlanggar)) {
               foreach ($dtlanggar as $list) {
                    $url_file = $list->url_langgar;
                    $id_personal = $list->id_personal;
               }

               $foldername = md5($id_personal);

               // echo json_encode([$foldername]);
               // return;

               if (is_file("berkas/karyawan/" . $foldername . "/" . $url_file)) {
                    $tofile = realpath("berkas/karyawan/" . $foldername . "/" . $url_file);
                    header('Content-Type: application/pdf');
                    readfile($tofile);
               } else {
                    redirect('karyawan/error404');
               }
          } else {
               redirect('karyawan/error404');
          }
     }

     public function get_all()
     {
          $query = $this->lgr->get_all();
          $output = "<option value=''>-- Pilih Pelanggaran --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_langgar . "'>" . $list->langgar . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "lgr" => $output));
          } else {
               $output = "<option value=''>-- Pelanggaran Tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "lgr" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->lgr->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih Pelanggaran --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_langgar . "'>" . $list->langgar . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "lgr" => $output));
          } else {
               $output = "<option value=''>-- Pelanggaran Tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "lgr" => $output));
          }
     }
}
