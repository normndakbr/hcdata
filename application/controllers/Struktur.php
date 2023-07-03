<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Struktur extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_logout();
     }

     public function index()
     {
          if ($this->session->flashdata("updstr_sukses") != "") {
               $this->session->set_flashdata('psn', '<div class="alert alert-primary suksesupdtstr animate__animated animate__bounce mb-2" role="alert"> Nama perusahaan berhasil diupdate </div>');
          }

          if ($this->session->flashdata("hapus_sukses") != "") {
               $this->session->set_flashdata('psn', '<div class="alert alert-primary suksesupdtstr animate__animated animate__bounce mb-2" role="alert"> Perusahaan berhasil dihapus</div>');
          }

          $id_perusahaan = $this->session->userdata("id_perusahaan");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/struktur/struktur');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/struktur');
     }

     public function new()
     {
          if ($this->session->flashdata("str_sukses") != "") {
               $this->session->set_flashdata('psn', '<div class="alert alert-primary suksesalrt animate__animated animate__bounce mb-2" role="alert"> Struktur perusahaan berhasil dibuat </div>');
          }

          if ($this->session->has_userdata('id_m_perusahaan')) {
               $idmper = $this->session->userdata('id_m_perusahaan');
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
          $id_perusahaan = $this->session->userdata("id_perusahaan");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/struktur/struktur_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/struktur');
     }

     public function pjo()
     {
          $auth_m_per = $this->input->get('auth_m_per');
          $id_m_perusahaan = $this->str->get_id_per($auth_m_per);
          $data['pjo'] = $this->str->tabel_pjo($id_m_perusahaan);
          $this->load->view('dashboard/karyawan/pjo', $data);
     }

     public function pjodetail()
     {
          $auth_m_per = $this->input->get('auth_m_per');
          $id_m_perusahaan = $this->str->get_id_per($auth_m_per);
          $data['pjo'] = $this->str->tabel_pjo($id_m_perusahaan);
          $this->load->view('dashboard/struktur/pjo', $data);
     }

     public function ajax_list()
     {
          $list = $this->str->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $str) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_m_perusahaan'] = $str->auth_m_perusahaan;
               $row['kode_perusahaan'] = $str->kode_perusahaan;
               $row['nama_perusahaan'] = $str->nama_perusahaan;
               $row['jenis_perusahaan'] = $str->jenis_perusahaan;

               if ($str->stat_perusahaan == "T") {
                    $row['stat_perusahaan'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_perusahaan'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['tgl_buat'] = date('d-M-Y', strtotime($str->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($str->tgl_edit));
               $row['proses'] = '<button id="' . $str->auth_m_perusahaan . '" class="btn btn-primary btn-sm font-weight-bold dtlstruktur" title="Detail" value="' . $str->nama_perusahaan . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $str->auth_m_perusahaan . '" class="btn btn-warning btn-sm font-weight-bold edttstruktur" title="Edit" value="' . $str->nama_perusahaan . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $str->auth_m_perusahaan . '" class="btn btn-danger btn-sm font-weight-bold hpsstruktur" title="Hapus" value="' . $str->nama_perusahaan . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->str->count_all(),
               "recordsFiltered" => $this->str->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     function rk3l($auth_m_per)
     {
          $dtmper = $this->str->get_dt_m_authper($auth_m_per);
          if (!empty($dtmper)) {
               foreach ($dtmper as $list) {
                    $url_rk3l = $list->url_rk3l;
                    $id_perusahaan = $list->id_perusahaan;
               }
               if ($url_rk3l != "") {
                    $foldername = md5($id_perusahaan);
                    if (is_file("assets/berkas/perusahaan/" . $foldername . "/" . $url_rk3l)) {
                         $tofile = realpath("assets/berkas/perusahaan/" . $foldername . "/" . $url_rk3l);
                         header('Content-Type: application/pdf');
                         readfile($tofile);
                    } else {
                         redirect('karyawan/error404');
                    }
               } else {
                    redirect('karyawan/error404');
               }
          } else {
               redirect('karyawan/error404');
          }
     }

     function iujp($auth_m_per)
     {
          $dtmper = $this->str->get_dt_m_authper($auth_m_per);
          if (!empty($dtmper)) {
               foreach ($dtmper as $list) {
                    $url_izin_perusahaan = $list->url_izin_perusahaan;
                    $id_perusahaan = $list->id_perusahaan;
               }
               if ($url_izin_perusahaan != "") {
                    $foldername = md5($id_perusahaan);
                    if (is_file("assets/berkas/perusahaan/" . $foldername . "/" . $url_izin_perusahaan)) {
                         $tofile = realpath("assets/berkas/perusahaan/" . $foldername . "/" . $url_izin_perusahaan);
                         header('Content-Type: application/pdf');
                         readfile($tofile);
                    } else {
                         redirect('karyawan/error404');
                    }
               } else {
                    redirect('karyawan/error404');
               }
          } else {
               redirect('karyawan/error404');
          }
     }

     function sio($auth_m_per)
     {
          $dtmper = $this->str->get_dt_m_authper($auth_m_per);
          if (!empty($dtmper)) {
               foreach ($dtmper as $list) {
                    $url_sio = $list->url_sio;
                    $id_perusahaan = $list->id_perusahaan;
               }
               if ($url_sio != "") {
                    $foldername = md5($id_perusahaan);
                    if (is_file("assets/berkas/perusahaan/" . $foldername . "/" . $url_sio)) {
                         $tofile = realpath("assets/berkas/perusahaan/" . $foldername . "/" . $url_sio);
                         header('Content-Type: application/pdf');
                         readfile($tofile);
                    } else {
                         redirect('karyawan/error404');
                    }
               } else {
                    redirect('karyawan/error404');
               }
          } else {
               redirect('karyawan/error404');
          }
     }

     function kontrak($auth_m_per)
     {
          $dtmper = $this->str->get_dt_m_authper($auth_m_per);
          if (!empty($dtmper)) {
               foreach ($dtmper as $list) {
                    $url_doc_kontrak_perusahaan = $list->url_doc_kontrak_perusahaan;
                    $id_perusahaan = $list->id_perusahaan;
               }
               if ($url_doc_kontrak_perusahaan != "") {
                    $foldername = md5($id_perusahaan);
                    if (is_file("assets/berkas/perusahaan/" . $foldername . "/" . $url_doc_kontrak_perusahaan)) {
                         $tofile = realpath("assets/berkas/perusahaan/" . $foldername . "/" . $url_doc_kontrak_perusahaan);
                         header('Content-Type: application/pdf');
                         readfile($tofile);
                    } else {
                         redirect('karyawan/error404');
                    }
               } else {
                    redirect('karyawan/error404');
               }
          } else {
               redirect('karyawan/error404');
          }
     }

     function pjoview($auth_pjo)
     {
          $dtpjo = $this->str->get_by_dt_pjo($auth_pjo);
          if (!empty($dtpjo)) {
               foreach ($dtpjo as $list) {
                    $url_pengesahan_pjo = $list->url_pengesahan_pjo;
                    $id_perusahaan = $list->id_perusahaan;
               }
               if ($url_pengesahan_pjo != "") {
                    $foldername = md5($id_perusahaan);
                    if (is_file("assets/berkas/perusahaan/" . $foldername . "/" . $url_pengesahan_pjo)) {
                         $tofile = realpath("assets/berkas/perusahaan/" . $foldername . "/" . $url_pengesahan_pjo);
                         header('Content-Type: application/pdf');
                         readfile($tofile);
                    } else {
                         redirect('karyawan/error404');
                    }
               } else {
                    redirect('karyawan/error404');
               }
          } else {
               redirect('karyawan/error404');
          }
     }

     public function input_perusahaan()
     {

          $this->form_validation->set_rules("idparent", "idparent", "required|trim", [
               'required' => 'Perusahaan utama wajib dipilih'
          ]);
          $this->form_validation->set_rules("kodeper", "kodeper", "required|trim", [
               'required' => 'Kode perusahaan wajib diisi'
          ]);
          $this->form_validation->set_rules("namaper", "namaper", "required|trim", [
               'required' => 'Nama perusahaan wajib diisi'
          ]);
          if ($this->form_validation->run() == false) {

               $error = [
                    'statusCode' => 202,
                    'idparent' => form_error("idparent"),
                    'kodeper' => form_error("kodeper"),
                    'namaper' => form_error("namaper")
               ];

               echo json_encode($error);
          } else {
               $auth_per = $this->session->userdata('auth_per_sub');
               $idparent = htmlspecialchars($this->input->post("idparent", true));
               $namaper = htmlspecialchars($this->input->post("namaper", true));
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $id_perusahaan = $this->prs->get_by_auth($auth_per);
               $id_parent = $this->str->get_by_m_authper($idparent);

               $dtper = [
                    'id_parent' => $id_parent,
                    'id_perusahaan' => $id_perusahaan,
                    'nama_m_perusahaan' => $namaper,
                    'id_jenis_perusahaan' => 3,
                    'stat_m_perusahaan' => 'T',
                    'url_rk3l' => '',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user')
               ];

               $str_per = $this->str->input_struktur($dtper);
               if ($str_per) {
                    $auth_m_per = $this->str->last_row_idmper();
                    echo json_encode(array(
                         'statusCode' => 200,
                         'pesan' => 'Data perusahaan berhasil disimpan',
                         "auth_m_per" => $auth_m_per,
                         'auth_parent' => $idparent,
                         'auth_per' => $auth_per
                    ));
               } else {
                    echo json_encode(array(
                         'statusCode' => 201,
                         'pesan' => 'Data perusahaan gagal disimpan'
                    ));
               }
          }
     }

     public function addrk3l()
     {
          $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
               'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor'
          ]);

          if ($this->form_validation->run() == false) {
               $filerk3l = htmlspecialchars($this->input->post("filerk3l", true));

               if ($filerk3l == "") {
                    $errupload = "<p>File RK3L wajib diupload</p>";
               } else {
                    $errupload = "";
               }

               $error = [
                    'statusCode' => 202,
                    'auth_m_per' => form_error("auth_m_per"),
                    'filerk3l' => $errupload
               ];

               echo json_encode($error);
          } else {
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $id_m_per = $this->prs->get_m_by_auth($auth_m_per);
               $id_per = $this->prs->get_id_per_by_auth_m($auth_m_per);
               $namafolder = md5($id_per);
               $now = date('YmdHis');
               $nama_file = $now . "-RK3L.pdf";

               $filerk3l = htmlspecialchars($this->input->post("filerk3l", true));
               if ($filerk3l == "") {
                    echo json_encode(array('statusCode' => 202, 'filerk3l' => '<p>File RK3L wajib diupload</p>'));
                    return;
               }

               if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                    mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
               }

               if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                    $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 500;
                    $config['file_name'] = $nama_file;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('flrk3l')) {
                         $err = $this->upload->display_errors();

                         if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                              $error = "<p>Ukuran file maksimal 500 kb.</p>";
                         } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                              $error = "<p>Format file nya dalam bentuk pdf</p>";
                         } else {
                              $error = $err;
                         }

                         echo json_encode(array("statusCode" => 202, "filerk3l" =>  $error));
                    } else {
                         if ($id_m_per != "") {
                              $dtrk3l = [
                                   'url_rk3l' => $nama_file,
                                   'tgl_edit' => date('Y-m-d H:i:s')
                              ];

                              $str_per = $this->str->update_rk3l($id_m_per, $dtrk3l);
                              if ($str_per) {
                                   $link = base_url('struktur/rk3l/') .  $auth_m_per;
                                   echo json_encode(array('statusCode' => 200, 'pesan' => 'Data RK3L berhasil disimpan', 'link' => $link));
                              } else {
                                   echo json_encode(array('statusCode' => 201, 'pesan' => 'Data RK3L gagal disimpan'));
                              }
                         } else {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data perusahaan"));
                         }
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
               }
          }
     }

     public function resetrk3l()
     {
          $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
               'required' => 'Perusahaan tidak ditemukan'
          ]);

          if ($this->form_validation->run() == false) {

               $error = [
                    'statusCode' => 202,
                    'auth_m_per' => form_error("auth_m_per")
               ];

               echo json_encode($error);
          } else {
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $id_m_per = $this->prs->get_m_by_auth($auth_m_per);
               $id_per = $this->prs->get_id_per_by_auth_m($auth_m_per);
               $namafolder = md5($id_per);
               $url_rk3l = $this->prs->get_rk3l_by_auth_m($auth_m_per);

               if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                    mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
               }

               if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                    if ($url_rk3l != "") {
                         unlink('./assets/berkas/perusahaan/' . $namafolder . "/" . $url_rk3l);
                    }

                    if ($id_m_per != "") {
                         $dtrk3l = [
                              'url_rk3l' => '',
                              'tgl_edit' => date('Y-m-d H:i:s')
                         ];

                         $str_per = $this->str->update_rk3l($id_m_per, $dtrk3l);
                         if ($str_per) {
                              echo json_encode(array('statusCode' => 200, 'pesan' => 'Data RK3L berhasil direset'));
                         } else {
                              echo json_encode(array('statusCode' => 201, 'pesan' => 'Data RK3L gagal direset'));
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data perusahaan"));
                    }
               }
          }
     }

     public function addiujp()
     {

          $this->form_validation->set_rules("no_iujp", "no_iujp", "required|trim", [
               'required' => 'No. IUJP wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_awal_iujp", "tgl_awal_iujp", "required|trim", [
               'required' => 'Tanggal mulai IUJP wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_akhir_iujp", "tgl_akhir_iujp", "required|trim", [
               'required' => 'Tanggal akhir IUJP wajib diisi'
          ]);
          $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
               'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor'
          ]);
          $this->form_validation->set_rules("ket_iujp", "ket_iujp", "trim");

          if ($this->form_validation->run() == false) {
               $fileiujp = htmlspecialchars($this->input->post("fileiujp", true));

               if ($fileiujp == "") {
                    $errupload = "<p>File IUJP wajib diupload</p>";
               } else {
                    $errupload = "";
               }

               $error = [
                    'statusCode' => 202,
                    'no_iujp' => form_error("no_iujp"),
                    'tgl_awal_iujp' => form_error("tgl_awal_iujp"),
                    'tgl_akhir_iujp' => form_error("tgl_akhir_iujp"),
                    'fileiujp' => $errupload
               ];

               echo json_encode($error);
          } else {
               $no_iujp = htmlspecialchars($this->input->post("no_iujp", true));
               $tgl_awal_iujp = htmlspecialchars($this->input->post("tgl_awal_iujp", true));
               $tgl_akhir_iujp = htmlspecialchars($this->input->post("tgl_akhir_iujp", true));
               $ket_iujp = htmlspecialchars($this->input->post("ket_iujp", true));
               $auth_iujp = htmlspecialchars($this->input->post("auth_iujp", true));
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $auth_per = htmlspecialchars($this->input->post("auth_per", true));
               $id_m_per = $this->prs->get_m_by_auth($auth_m_per);
               $id_per = $this->prs->get_by_auth($auth_per);
               $namafolder = md5($id_per);
               $now = date('YmdHis');
               $tglakhir = date('Ymd', strtotime($tgl_akhir_iujp));
               $nama_file = $id_per . "-" . $id_m_per . "-" . $tglakhir . "-" . $now . "-IUJP.pdf";
               $fileiujp = htmlspecialchars($this->input->post("fileiujp", true));

               if ($fileiujp == "") {
                    echo json_encode(array('statusCode' => 202, 'fileiujp' => '<p>File IUJP wajib dipilih</p>'));
                    return;
               }

               if ($tgl_awal_iujp > $tgl_akhir_iujp) {
                    echo json_encode(array('statusCode' => 202, 'tgl_akhir_iujp' => '<p>Isi tanggal berakhir dengan benar</p>'));
                    return;
               }

               $cek_izin = $this->str->cek_iujp($no_iujp, $tgl_awal_iujp, $tgl_akhir_iujp);
               if ($cek_izin == 201) {
                    echo json_encode(array('statusCode' => 201, 'pesan' => 'IUJP/Perizinan dengan Nomor : ' . $no_iujp . ' Sudah digunakan'));
                    return;
               }

               if ($id_m_per != "") {
                    if ($auth_iujp == "") {
                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                              mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
                         }

                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                              $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                              $config['allowed_types'] = 'pdf';
                              $config['max_size'] = 100;
                              $config['file_name'] = $nama_file;

                              $this->load->library('upload', $config);

                              if (!$this->upload->do_upload('fliujp')) {
                                   $err = $this->upload->display_errors();

                                   if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                        $error = "<p>Ukuran file maksimal 100 kb.</p>";
                                   } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                        $error = "<p>Format file nya dalam bentuk pdf</p>";
                                   } else {
                                        $error = $err;
                                   }

                                   echo json_encode(array("statusCode" => 202, "fileiujp" =>  $error));
                              } else {
                                   $dtiujp = [
                                        'id_m_perusahaan' => $id_m_per,
                                        'no_izin_perusahaan' => $no_iujp,
                                        'tgl_mulai_izin' => $tgl_awal_iujp,
                                        'tgl_akhir_izin' => $tgl_akhir_iujp,
                                        'url_izin_perusahaan' => $nama_file,
                                        'ket_izin_perusahaan' => $ket_iujp,
                                        'tgl_buat' => date('Y-m-d H:i:s'),
                                        'tgl_edit' => date('Y-m-d H:i:s'),
                                        'id_user' => $this->session->userdata('id_user')
                                   ];

                                   $str_per = $this->str->input_iujp($dtiujp);
                                   if ($str_per) {
                                        $auth_izin = $this->str->last_row_idiujp();
                                        $link = base_url('struktur/iujp/') .  $auth_m_per;
                                        echo json_encode(array('statusCode' => 200, 'pesan' => 'Data IUJP berhasil disimpan', "auth_izin" => $auth_izin, "link" => $link));
                                   } else {
                                        echo json_encode(array('statusCode' => 201, 'pesan' => 'Data IUJP gagal disimpan'));
                                   }
                              }
                         } else {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
                         }
                    } else {
                         $url_izin = $this->str->get_by_url_izin($auth_iujp);

                         if ($url_izin != "") {
                              $nama_file = $url_izin;
                         }

                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                              mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
                         }

                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                              $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                              $config['allowed_types'] = 'pdf';
                              $config['max_size'] = 100;
                              $config['file_name'] = $nama_file;
                              $config['overwrite'] = TRUE;

                              $this->load->library('upload', $config);

                              if (!$this->upload->do_upload('fliujp')) {
                                   $err = $this->upload->display_errors();

                                   if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                        $error = "<p>Ukuran file maksimal 100 kb.</p>";
                                   } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                        $error = "<p>Format file nya dalam bentuk pdf</p>";
                                   } else {
                                        $error = $err;
                                   }

                                   echo json_encode(array("statusCode" => 202, "fileiujp" =>  $error));
                              } else {
                                   $id_izin = $this->str->get_by_auth_izin($auth_iujp);
                                   $dtiujp = [
                                        'no_izin_perusahaan' => $no_iujp,
                                        'tgl_mulai_izin' => $tgl_awal_iujp,
                                        'tgl_akhir_izin' => $tgl_akhir_iujp,
                                        'url_izin_perusahaan' => $nama_file,
                                        'ket_izin_perusahaan' => $ket_iujp,
                                        'tgl_edit' => date('Y-m-d H:i:s'),
                                   ];

                                   $str_per = $this->str->update_iujp($id_izin, $dtiujp);
                                   if ($str_per == 200) {
                                        echo json_encode(array('statusCode' => 200, 'pesan' => 'Data IUJP berhasil diupdate'));
                                   } else {
                                        echo json_encode(array('statusCode' => 201, 'pesan' => 'Data IUJP gagal diupdate'));
                                   }
                              }
                         } else {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
                         }
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data perusahaan"));
               }
          }
     }

     public function add_iujp()
     {

          $this->form_validation->set_rules("no_iujp", "no_iujp", "required|trim", [
               'required' => 'No. IUJP wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_awal_iujp", "tgl_awal_iujp", "required|trim", [
               'required' => 'Tanggal mulai IUJP wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_akhir_iujp", "tgl_akhir_iujp", "required|trim", [
               'required' => 'Tanggal akhir IUJP wajib diisi'
          ]);
          $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
               'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor'
          ]);
          $this->form_validation->set_rules("ket_iujp", "ket_iujp", "trim");

          if ($this->form_validation->run() == false) {
               $fileiujp = htmlspecialchars($this->input->post("fileiujp", true));

               if ($fileiujp == "") {
                    $errupload = "<p>File IUJP wajib diupload</p>";
               } else {
                    $errupload = "";
               }

               $error = [
                    'statusCode' => 202,
                    'no_iujp' => form_error("no_iujp"),
                    'tgl_awal_iujp' => form_error("tgl_awal_iujp"),
                    'tgl_akhir_iujp' => form_error("tgl_akhir_iujp"),
                    'auth_m_per' => form_error("auth_m_per"),
                    'fileiujp' => $errupload
               ];

               echo json_encode($error);
          } else {
               $no_iujp = htmlspecialchars($this->input->post("no_iujp", true));
               $tgl_awal_iujp = htmlspecialchars($this->input->post("tgl_awal_iujp", true));
               $tgl_akhir_iujp = htmlspecialchars($this->input->post("tgl_akhir_iujp", true));
               $ket_iujp = htmlspecialchars($this->input->post("ket_iujp", true));
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $id_m_per = $this->prs->get_m_by_auth($auth_m_per);
               $id_per = $this->prs->get_id_per_by_auth_m($auth_m_per);
               $namafolder = md5($id_per);
               $now = date('YmdHis');
               $tglakhir = date('Ymd', strtotime($tgl_akhir_iujp));
               $nama_file = $tglakhir . "-" . $now . "-IUJP.pdf";
               $fileiujp = htmlspecialchars($this->input->post("fileiujp", true));

               if ($fileiujp == "") {
                    echo json_encode(array('statusCode' => 202, 'fileiujp' => '<p>File IUJP wajib dipilih</p>'));
                    return;
               }

               if ($tgl_awal_iujp > $tgl_akhir_iujp) {
                    echo json_encode(array('statusCode' => 202, 'tgl_akhir_iujp' => '<p>Isi tanggal berakhir dengan benar</p>'));
                    return;
               }

               $cek_izin = $this->str->cek_iujp($no_iujp, $tgl_awal_iujp, $tgl_akhir_iujp);
               if ($cek_izin == 201) {
                    echo json_encode(array('statusCode' => 201, 'pesan' => 'IUJP/Perizinan dengan Nomor : ' . $no_iujp . ' Sudah digunakan'));
                    return;
               }

               if ($id_m_per != "") {
                    if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                         mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
                    }

                    if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                         $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                         $config['allowed_types'] = 'pdf';
                         $config['max_size'] = 100;
                         $config['file_name'] = $nama_file;

                         $this->load->library('upload', $config);

                         if (!$this->upload->do_upload('fliujp')) {
                              $err = $this->upload->display_errors();

                              if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                   $error = "<p>Ukuran file maksimal 100 kb.</p>";
                              } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                   $error = "<p>Format file nya dalam bentuk pdf</p>";
                              } else {
                                   $error = $err;
                              }

                              echo json_encode(array("statusCode" => 202, "fileiujp" =>  $error));
                         } else {
                              $dtiujp = [
                                   'id_m_perusahaan' => $id_m_per,
                                   'no_izin_perusahaan' => $no_iujp,
                                   'tgl_mulai_izin' => $tgl_awal_iujp,
                                   'tgl_akhir_izin' => $tgl_akhir_iujp,
                                   'url_izin_perusahaan' => $nama_file,
                                   'ket_izin_perusahaan' => $ket_iujp,
                                   'tgl_buat' => date('Y-m-d H:i:s'),
                                   'tgl_edit' => date('Y-m-d H:i:s'),
                                   'id_user' => $this->session->userdata('id_user')
                              ];

                              $str_per = $this->str->input_iujp($dtiujp);
                              if ($str_per) {
                                   echo json_encode(array('statusCode' => 200, 'pesan' => 'Data IUJP berhasil disimpan'));
                              } else {
                                   echo json_encode(array('statusCode' => 201, 'pesan' => 'Data IUJP gagal disimpan'));
                              }
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data perusahaan"));
               }
          }
     }

     public function addsio()
     {

          $this->form_validation->set_rules("no_sio", "no_sio", "required|trim", [
               'required' => 'No. SIO wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_awal_sio", "tgl_awal_sio", "required|trim", [
               'required' => 'Tanggal mulai SIO wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_akhir_sio", "tgl_akhir_sio", "required|trim", [
               'required' => 'Tanggal akhir SIO wajib diisi'
          ]);
          $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
               'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor'
          ]);
          $this->form_validation->set_rules("ket_sio", "ket_sio", "trim");


          if ($this->form_validation->run() == false) {

               $filesio = htmlspecialchars($this->input->post("filesio", true));
               if ($filesio == "") {
                    $errfile = "<p>File SIO wajib dipilih</p>";
               } else {
                    $errfile = "";
               }

               $error = [
                    'statusCode' => 202,
                    'no_sio' => form_error("no_sio"),
                    'tgl_awal_sio' => form_error("tgl_awal_sio"),
                    'tgl_akhir_sio' => form_error("tgl_akhir_sio"),
                    'filesio' => $errfile
               ];

               echo json_encode($error);
          } else {
               $no_sio = htmlspecialchars($this->input->post("no_sio", true));
               $tgl_awal_sio = htmlspecialchars($this->input->post("tgl_awal_sio", true));
               $tgl_akhir_sio = htmlspecialchars($this->input->post("tgl_akhir_sio", true));
               $ket_sio = htmlspecialchars($this->input->post("ket_sio", true));
               $auth_sio = htmlspecialchars($this->input->post("auth_sio", true));
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $auth_per = htmlspecialchars($this->input->post("auth_per", true));
               $id_m_per = $this->prs->get_m_by_auth($auth_m_per);
               $id_per = $this->prs->get_by_auth($auth_per);
               $namafolder = md5($id_per);
               $now = date('YmdHis');
               $tglakhir = date('Ymd', strtotime($tgl_akhir_sio));
               $nama_file = $tglakhir . "-" . $now . "-SIO.pdf";

               $filesio = htmlspecialchars($this->input->post("filesio", true));
               if ($filesio == "") {
                    echo json_encode(array('statusCode' => 202, 'filesio' => '<p>File SIO wajib diupload</p>'));
                    return;
               }

               if ($tgl_awal_sio > $tgl_akhir_sio) {
                    echo json_encode(array('statusCode' => 202, 'tgl_akhir_sio' => '<p>Isi tanggal berakhir dengan benar</p>'));
                    return;
               }

               $cek_sio = $this->str->cek_sio($no_sio, $tgl_awal_sio, $tgl_akhir_sio);
               if ($cek_sio == 201) {
                    echo json_encode(array('statusCode' => 201, 'pesan' => 'SIO dengan Nomor : ' . $no_sio . ' Sudah digunakan'));
                    return;
               }

               if ($id_m_per != "") {
                    if ($auth_sio == "") {
                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                              mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
                         }

                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                              $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                              $config['allowed_types'] = 'pdf';
                              $config['max_size'] = 100;
                              $config['file_name'] = $nama_file;

                              $this->load->library('upload', $config);

                              if (!$this->upload->do_upload('flsio')) {
                                   $err = $this->upload->display_errors();

                                   if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                        $error = "<p>Ukuran file maksimal 100 kb.</p>";
                                   } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                        $error = "<p>Format file nya dalam bentuk pdf</p>";
                                   } else {
                                        $error = $err;
                                   }

                                   echo json_encode(array("statusCode" => 202, "filesio" =>  $error));
                              } else {
                                   $dtsio = [
                                        'id_m_perusahaan' => $id_m_per,
                                        'no_sio_perusahaan' => $no_sio,
                                        'tgl_mulai_sio' => $tgl_awal_sio,
                                        'tgl_akhir_sio' => $tgl_akhir_sio,
                                        'url_sio' => $nama_file,
                                        'ket_sio' => $ket_sio,
                                        'tgl_buat' => date('Y-m-d H:i:s'),
                                        'tgl_edit' => date('Y-m-d H:i:s'),
                                        'id_user' => $this->session->userdata('id_user')
                                   ];

                                   $str_per = $this->str->input_sio($dtsio);
                                   if ($str_per) {
                                        $auth_sio = $this->str->last_row_idsio();
                                        $link = base_url('struktur/sio/') .  $auth_m_per;
                                        echo json_encode(array('statusCode' => 200, 'pesan' => 'Data SIO berhasil disimpan', "auth_sio" => $auth_sio, "link" => $link));
                                   } else {
                                        echo json_encode(array('statusCode' => 201, 'pesan' => 'Data SIO gagal disimpan'));
                                   }
                              }
                         } else {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
                         }
                    } else {
                         $url_sio = $this->str->get_by_url_sio($auth_sio);

                         if ($url_sio != "") {
                              $nama_file = $url_sio;
                         }

                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                              mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
                         }

                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                              $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                              $config['allowed_types'] = 'pdf';
                              $config['max_size'] = 1000;
                              $config['file_name'] = $nama_file;
                              $config['overwrite'] = TRUE;

                              $this->load->library('upload', $config);

                              if (!$this->upload->do_upload('flsio')) {
                                   $err = $this->upload->display_errors();

                                   if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                        $error = "<p>Ukuran file maksimal 1 mb.</p>";
                                   } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                        $error = "<p>Format file nya dalam bentuk pdf</p>";
                                   } else {
                                        $error = $err;
                                   }

                                   echo json_encode(array("statusCode" => 202, "filesio" =>  $error));
                              } else {
                                   $id_sio = $this->str->get_by_auth_sio($auth_sio);
                                   $dtsio = [
                                        'no_sio_perusahaan' => $no_sio,
                                        'tgl_mulai_sio' => $tgl_awal_sio,
                                        'tgl_akhir_sio' => $tgl_akhir_sio,
                                        'url_sio' => $nama_file,
                                        'ket_sio' => $ket_sio,
                                        'tgl_edit' => date('Y-m-d H:i:s'),
                                   ];

                                   $str_per = $this->str->update_sio($id_sio, $dtsio);
                                   if ($str_per == 200) {
                                        echo json_encode(array('statusCode' => 200, 'pesan' => 'Data SIO berhasil diupdate'));
                                   } else {
                                        echo json_encode(array('statusCode' => 201, 'pesan' => 'Data SIO gagal diupdate'));
                                   }
                              }
                         } else {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
                         }
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data perusahaan"));
               }
          }
     }

     public function add_sio()
     {

          $this->form_validation->set_rules("no_sio", "no_sio", "required|trim", [
               'required' => 'No. SIO wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_awal_sio", "tgl_awal_sio", "required|trim", [
               'required' => 'Tanggal mulai SIO wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_akhir_sio", "tgl_akhir_sio", "required|trim", [
               'required' => 'Tanggal akhir SIO wajib diisi'
          ]);
          $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
               'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor'
          ]);
          $this->form_validation->set_rules("ket_sio", "ket_sio", "trim");

          if ($this->form_validation->run() == false) {

               $filesio = htmlspecialchars($this->input->post("filesio", true));
               if ($filesio == "") {
                    $errfile = "<p>File SIO wajib dipilih</p>";
               } else {
                    $errfile = "";
               }

               $error = [
                    'statusCode' => 202,
                    'no_sio' => form_error("no_sio"),
                    'tgl_awal_sio' => form_error("tgl_awal_sio"),
                    'tgl_akhir_sio' => form_error("tgl_akhir_sio"),
                    'filesio' => $errfile
               ];

               echo json_encode($error);
          } else {
               $no_sio = htmlspecialchars($this->input->post("no_sio", true));
               $tgl_awal_sio = htmlspecialchars($this->input->post("tgl_awal_sio", true));
               $tgl_akhir_sio = htmlspecialchars($this->input->post("tgl_akhir_sio", true));
               $ket_sio = htmlspecialchars($this->input->post("ket_sio", true));
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $id_m_per = $this->prs->get_m_by_auth($auth_m_per);
               $id_per = $this->prs->get_id_per_by_auth_m($auth_m_per);
               $namafolder = md5($id_per);
               $now = date('YmdHis');
               $tglakhir = date('Ymd', strtotime($tgl_akhir_sio));
               $nama_file = $tglakhir . "-" . $now . "-SIO.pdf";

               $filesio = htmlspecialchars($this->input->post("filesio", true));
               if ($filesio == "") {
                    echo json_encode(array('statusCode' => 202, 'filesio' => '<p>File SIO wajib diupload</p>'));
                    return;
               }

               if ($tgl_awal_sio > $tgl_akhir_sio) {
                    echo json_encode(array('statusCode' => 202, 'tgl_akhir_sio' => '<p>Isi tanggal berakhir dengan benar</p>'));
                    return;
               }

               $cek_sio = $this->str->cek_sio($no_sio, $tgl_awal_sio, $tgl_akhir_sio);
               if ($cek_sio == 201) {
                    echo json_encode(array('statusCode' => 201, 'pesan' => 'SIO dengan Nomor : ' . $no_sio . ' Sudah digunakan'));
                    return;
               }

               if ($id_m_per != "") {
                    if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                         mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
                    }

                    if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                         $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                         $config['allowed_types'] = 'pdf';
                         $config['max_size'] = 100;
                         $config['file_name'] = $nama_file;

                         $this->load->library('upload', $config);

                         if (!$this->upload->do_upload('flsio')) {
                              $err = $this->upload->display_errors();

                              if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                   $error = "<p>Ukuran file maksimal 100 kb.</p>";
                              } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                   $error = "<p>Format file nya dalam bentuk pdf</p>";
                              } else {
                                   $error = $err;
                              }

                              echo json_encode(array("statusCode" => 202, "filesio" =>  $error));
                         } else {
                              $dtsio = [
                                   'id_m_perusahaan' => $id_m_per,
                                   'no_sio_perusahaan' => $no_sio,
                                   'tgl_mulai_sio' => $tgl_awal_sio,
                                   'tgl_akhir_sio' => $tgl_akhir_sio,
                                   'url_sio' => $nama_file,
                                   'ket_sio' => $ket_sio,
                                   'tgl_buat' => date('Y-m-d H:i:s'),
                                   'tgl_edit' => date('Y-m-d H:i:s'),
                                   'id_user' => $this->session->userdata('id_user')
                              ];

                              $str_per = $this->str->input_sio($dtsio);
                              if ($str_per) {
                                   $auth_sio = $this->str->last_row_idsio();
                                   echo json_encode(array('statusCode' => 200, 'pesan' => 'Data SIO berhasil disimpan'));
                              } else {
                                   echo json_encode(array('statusCode' => 201, 'pesan' => 'Data SIO gagal disimpan'));
                              }
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data perusahaan"));
               }
          }
     }

     public function addkontrak()
     {

          $this->form_validation->set_rules("no_kontrak", "no_kontrak", "required|trim", [
               'required' => 'No. kontrak wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_awal_kontrak", "tgl_awal_kontrak", "required|trim", [
               'required' => 'Tanggal mulai kontrak wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_akhir_kontrak", "tgl_akhir_kontrak", "required|trim", [
               'required' => 'Tanggal akhir kontrak wajib diisi'
          ]);
          $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
               'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor'
          ]);
          $this->form_validation->set_rules("ket_kontrak", "ket_kontrak", "trim");

          if ($this->form_validation->run() == false) {
               $filekontrak = htmlspecialchars($this->input->post("filekontrak", true));
               if ($filekontrak == "") {
                    $errfile = "<p>File kontrak wajib dipilih</p>";
               } else {
                    $errfile = "";
               }

               $error = [
                    'statusCode' => 202,
                    'no_kontrak' => form_error("no_kontrak"),
                    'tgl_awal_kontrak' => form_error("tgl_awal_kontrak"),
                    'tgl_akhir_kontrak' => form_error("tgl_akhir_kontrak"),
                    'filekontrak' => $errfile
               ];

               echo json_encode($error);
          } else {
               $no_kontrak = htmlspecialchars($this->input->post("no_kontrak", true));
               $tgl_awal_kontrak = htmlspecialchars($this->input->post("tgl_awal_kontrak", true));
               $tgl_akhir_kontrak = htmlspecialchars($this->input->post("tgl_akhir_kontrak", true));
               $ket_kontrak = htmlspecialchars($this->input->post("ket_kontrak", true));
               $auth_kontrak = htmlspecialchars($this->input->post("auth_kontrak", true));
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $auth_per = htmlspecialchars($this->input->post("auth_per", true));
               $id_m_per = $this->prs->get_m_by_auth($auth_m_per);
               $id_per = $this->prs->get_by_auth($auth_per);
               $namafolder = md5($id_per);
               $now = date('YmdHis');
               $tglakhir = date('Ymd', strtotime($tgl_akhir_kontrak));
               $nama_file = $tglakhir . "-" . $now . "-KONTRAK.pdf";

               $filekontrak = htmlspecialchars($this->input->post("filekontrak", true));
               if ($filekontrak == "") {
                    echo json_encode(array('statusCode' => 202, 'filekontrak' => '<p>File kontrak wajib diupload</p>'));
                    return;
               }

               if ($tgl_awal_kontrak > $tgl_akhir_kontrak) {
                    echo json_encode(array('statusCode' => 202, 'tgl_akhir_kontrak' => '<p>Isi tanggal berakhir dengan benar</p>'));
                    return;
               }

               $cek_kontrak = $this->str->cek_kontrak($no_kontrak, $tgl_awal_kontrak, $tgl_akhir_kontrak);
               if ($cek_kontrak == 201) {
                    echo json_encode(array('statusCode' => 201, 'pesan' => 'Kontrak dengan Nomor : ' . $no_kontrak . ' Sudah digunakan'));
                    return;
               }

               if ($id_m_per != "") {
                    if ($auth_kontrak == "") {
                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                              mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
                         }

                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                              $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                              $config['allowed_types'] = 'pdf';
                              $config['max_size'] = 100;
                              $config['file_name'] = $nama_file;

                              $this->load->library('upload', $config);

                              if (!$this->upload->do_upload('flkontrak')) {
                                   $err = $this->upload->display_errors();

                                   if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                        $error = "<p>Ukuran file maksimal 100 kb.</p>";
                                   } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                        $error = "<p>Format file nya dalam bentuk pdf</p>";
                                   } else {
                                        $error = $err;
                                   }

                                   echo json_encode(array("statusCode" => 202, "filekontrak" =>  $error));
                              } else {
                                   $dtkontrak = [
                                        'id_m_perusahaan' => $id_m_per,
                                        'id_perusahaan' => 0,
                                        'no_kontrak_perusahaan' => $no_kontrak,
                                        'ket_kontrak_perusahaan' => $ket_kontrak,
                                        'tgl_mulai' => $tgl_awal_kontrak,
                                        'tgl_akhir' => $tgl_akhir_kontrak,
                                        'url_doc_kontrak_perusahaan' => $nama_file,
                                        'tgl_buat' => date('Y-m-d H:i:s'),
                                        'tgl_edit' => date('Y-m-d H:i:s'),
                                        'id_user' => $this->session->userdata('id_user')
                                   ];

                                   $str_per = $this->str->input_kontrak($dtkontrak);

                                   if ($str_per) {
                                        $auth_kontrak = $this->str->last_row_idkontrak();
                                        $link = base_url('struktur/kontrak/') .  $auth_m_per;
                                        echo json_encode(array('statusCode' => 200, 'pesan' => 'Data kontrak berhasil disimpan', "auth_kontrak" => $auth_kontrak, "link" => $link));
                                   } else {
                                        echo json_encode(array('statusCode' => 201, 'pesan' => 'Data kontrak gagal disimpan'));
                                   }
                              }
                         } else {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
                         }
                    } else {
                         $url_kontrak = $this->str->get_by_url_kontrak($auth_kontrak);

                         if ($url_kontrak != "") {
                              $nama_file = $url_kontrak;
                         }

                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                              mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
                         }

                         if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                              $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                              $config['allowed_types'] = 'pdf';
                              $config['max_size'] = 100;
                              $config['file_name'] = $nama_file;
                              $config['overwrite'] = TRUE;

                              $this->load->library('upload', $config);

                              if (!$this->upload->do_upload('flkontrak')) {
                                   $err = $this->upload->display_errors();

                                   if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                        $error = "<p>Ukuran file maksimal 100 kb.</p>";
                                   } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                        $error = "<p>Format file nya dalam bentuk pdf</p>";
                                   } else {
                                        $error = $err;
                                   }

                                   echo json_encode(array("statusCode" => 202, "filekontrak" =>  $error));
                              } else {
                                   $id_kontrak = $this->str->get_by_auth_kontrak($auth_kontrak);
                                   $dtkontrak = [
                                        'no_kontrak_perusahaan' => $no_kontrak,
                                        'ket_kontrak_perusahaan' => $ket_kontrak,
                                        'tgl_mulai' => $tgl_awal_kontrak,
                                        'tgl_akhir' => $tgl_akhir_kontrak,
                                        'url_doc_kontrak_perusahaan' => $nama_file,
                                        'tgl_edit' => date('Y-m-d H:i:s'),
                                   ];

                                   $str_per = $this->str->update_kontrak($id_kontrak, $dtkontrak);

                                   if ($str_per == 200) {
                                        echo json_encode(array('statusCode' => 200, 'pesan' => 'Data kontrak berhasil diupdate'));
                                   } else {
                                        echo json_encode(array('statusCode' => 201, 'pesan' => 'Data kontrak gagal diupdate'));
                                   }
                              }
                         } else {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
                         }
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data perusahaan"));
               }
          }
     }

     public function add_kontrak()
     {

          $this->form_validation->set_rules("no_kontrak", "no_kontrak", "required|trim", [
               'required' => 'No. kontrak wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_awal_kontrak", "tgl_awal_kontrak", "required|trim", [
               'required' => 'Tanggal mulai kontrak wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_akhir_kontrak", "tgl_akhir_kontrak", "required|trim", [
               'required' => 'Tanggal akhir kontrak wajib diisi'
          ]);
          $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
               'required' => 'Pilih perusahaan yang akan menjadi contractor/subcontractor'
          ]);
          $this->form_validation->set_rules("ket_kontrak", "ket_kontrak", "trim");

          if ($this->form_validation->run() == false) {
               $filekontrak = htmlspecialchars($this->input->post("filekontrak", true));
               if ($filekontrak == "") {
                    $errfile = "<p>File kontrak wajib dipilih</p>";
               } else {
                    $errfile = "";
               }

               $error = [
                    'statusCode' => 202,
                    'no_kontrak' => form_error("no_kontrak"),
                    'tgl_awal_kontrak' => form_error("tgl_awal_kontrak"),
                    'tgl_akhir_kontrak' => form_error("tgl_akhir_kontrak"),
                    'filekontrak' => $errfile
               ];

               echo json_encode($error);
          } else {
               $no_kontrak = htmlspecialchars($this->input->post("no_kontrak", true));
               $tgl_awal_kontrak = htmlspecialchars($this->input->post("tgl_awal_kontrak", true));
               $tgl_akhir_kontrak = htmlspecialchars($this->input->post("tgl_akhir_kontrak", true));
               $ket_kontrak = htmlspecialchars($this->input->post("ket_kontrak", true));
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $id_m_per = $this->prs->get_m_by_auth($auth_m_per);
               $id_per = $this->prs->get_id_per_by_auth_m($auth_m_per);
               $namafolder = md5($id_per);
               $now = date('YmdHis');
               $tglakhir = date('Ymd', strtotime($tgl_akhir_kontrak));
               $nama_file = $tglakhir . "-" . $now . "-KONTRAK.pdf";

               $filekontrak = htmlspecialchars($this->input->post("filekontrak", true));
               if ($filekontrak == "") {
                    echo json_encode(array('statusCode' => 202, 'filekontrak' => '<p>File kontrak wajib diupload</p>'));
                    return;
               }

               if ($tgl_awal_kontrak > $tgl_akhir_kontrak) {
                    echo json_encode(array('statusCode' => 202, 'tgl_akhir_kontrak' => '<p>Isi tanggal berakhir dengan benar</p>'));
                    return;
               }

               $cek_kontrak = $this->str->cek_kontrak($no_kontrak, $tgl_awal_kontrak, $tgl_akhir_kontrak);
               if ($cek_kontrak == 201) {
                    echo json_encode(array('statusCode' => 201, 'pesan' => 'Kontrak dengan Nomor : ' . $no_kontrak . ' Sudah digunakan'));
                    return;
               }

               if ($id_m_per != "") {
                    if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                         mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
                    }

                    if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                         $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                         $config['allowed_types'] = 'pdf';
                         $config['max_size'] = 100;
                         $config['file_name'] = $nama_file;

                         $this->load->library('upload', $config);

                         if (!$this->upload->do_upload('flkontrak')) {
                              $err = $this->upload->display_errors();

                              if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                   $error = "<p>Ukuran file maksimal 100 kb.</p>";
                              } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                   $error = "<p>Format file nya dalam bentuk pdf</p>";
                              } else {
                                   $error = $err;
                              }

                              echo json_encode(array("statusCode" => 202, "filekontrak" =>  $error));
                         } else {
                              $dtkontrak = [
                                   'id_m_perusahaan' => $id_m_per,
                                   'id_perusahaan' => 0,
                                   'no_kontrak_perusahaan' => $no_kontrak,
                                   'ket_kontrak_perusahaan' => $ket_kontrak,
                                   'tgl_mulai' => $tgl_awal_kontrak,
                                   'tgl_akhir' => $tgl_akhir_kontrak,
                                   'url_doc_kontrak_perusahaan' => $nama_file,
                                   'tgl_buat' => date('Y-m-d H:i:s'),
                                   'tgl_edit' => date('Y-m-d H:i:s'),
                                   'id_user' => $this->session->userdata('id_user')
                              ];

                              $str_per = $this->str->input_kontrak($dtkontrak);

                              if ($str_per) {
                                   $auth_kontrak = $this->str->last_row_idkontrak();
                                   echo json_encode(array('statusCode' => 200, 'pesan' => 'Data kontrak berhasil disimpan'));
                              } else {
                                   echo json_encode(array('statusCode' => 201, 'pesan' => 'Data kontrak gagal disimpan'));
                              }
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data perusahaan"));
               }
          }
     }

     public function addpjo()
     {

          $this->form_validation->set_rules("no_pjo", "no_pjo", "required|trim", [
               'required' => 'No. pengesahan PJO wajib diisi',
          ]);
          $this->form_validation->set_rules("id_lokker", "id_lokker", "required|trim", [
               'required' => 'Lokasi kerja PJO wajib dipilih',
          ]);
          $this->form_validation->set_rules("tgl_awal_pjo", "tgl_awal_pjo", "required|trim", [
               'required' => 'Tanggal aktif wajib diisi',
          ]);
          $this->form_validation->set_rules("tgl_akhir_pjo", "tgl_akhir_pjo", "required|trim", [
               'required' => 'Tanggal akhir wajib diisi',
          ]);
          $this->form_validation->set_rules("ketpjo", "ketpjo", "trim");

          $this->form_validation->set_rules("ktp_pjo", "ktp_pjo", "required|trim", [
               'required' => 'No. KTP PJO wajib diisi',
          ]);
          $this->form_validation->set_rules("nik_pjo", "nik_pjo", "required|trim", [
               'required' => 'NIK PJO wajib diisi',
          ]);
          $this->form_validation->set_rules("nama_pjo", "nama_pjo", "required|trim", [
               'required' => 'Nama PJO Wajib diisi',
          ]);

          if ($this->form_validation->run() == false) {

               $filepjo = htmlspecialchars($this->input->post("filepjo", true));
               if ($filepjo == "") {
                    $errfile = "<p>File pengesahan PJO wajib diupload</p>";
               } else {
                    $errfile = "";
               }

               $error = [
                    'statusCode' => 202,
                    'no_pjo' => form_error("no_pjo"),
                    'id_lokker' => form_error("id_lokker"),
                    'tgl_awal_pjo' => form_error("tgl_awal_pjo"),
                    'tgl_akhir_pjo' => form_error("tgl_akhir_pjo"),
                    'ktp_pjo' => form_error("ktp_pjo"),
                    'nik_pjo' => form_error("nik_pjo"),
                    'nama_pjo' => form_error("nama_pjo"),
                    'filepjo' => $errfile
               ];

               echo json_encode($error);
               return;
          } else {
               $no_pjo = htmlspecialchars($this->input->post("no_pjo", true));
               $lokker_pjo = htmlspecialchars($this->input->post("id_lokker", true));
               $tgl_aktif_pjo = htmlspecialchars($this->input->post("tgl_awal_pjo", true));
               $tgl_akhir_pjo = htmlspecialchars($this->input->post("tgl_akhir_pjo", true));
               $ket_pjo = htmlspecialchars($this->input->post("ket_pjo", true));
               $ktp_pjo = htmlspecialchars($this->input->post("ktp_pjo", true));
               $nik_pjo = htmlspecialchars($this->input->post("nik_pjo", true));
               $nama_pjo = htmlspecialchars($this->input->post("nama_pjo", true));
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
               $filepjo = htmlspecialchars($this->input->post("filepjo", true));
               $id_m_per = $this->prs->get_m_by_auth($auth_m_per);
               $id_per = $this->prs->get_id_per_by_auth_m($auth_m_per);
               $namafolder = md5($id_per);
               $now = date('YmdHis');
               $tglakhir = date('Ymd', strtotime($tgl_akhir_pjo));
               $nama_file = $tglakhir . "-" . $now . "-PJO.pdf";

               if ($filepjo == "") {
                    $errfile = "<p>File pengesahan PJO wajib diupload</p>";
                    echo json_encode(array("statusCode" => 202, "filepjo" => "<p>File pengesahan PJO wajib diupload</p>"));
                    return;
               }

               if ($tgl_aktif_pjo > $tgl_akhir_pjo) {
                    echo json_encode(array('statusCode' => 202, 'tgl_akhir_pjo' => '<p>Isi tanggal berakhir dengan benar</p>'));
                    return;
               }

               $cek_pjo = $this->str->cek_pjo($no_pjo, $tgl_aktif_pjo, $tgl_akhir_pjo);
               if ($cek_pjo == 201) {
                    echo json_encode(array('statusCode' => 201, 'pesan' => 'Pengesahan PJO dengan Nomor : ' . $no_pjo . ' Sudah digunakan'));
                    return;
               }

               if ($id_m_per != "") {
                    if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                         mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
                    }

                    if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                         $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                         $config['allowed_types'] = 'pdf';
                         $config['max_size'] = 100;
                         $config['file_name'] = $nama_file;

                         $this->load->library('upload', $config);

                         if (!$this->upload->do_upload('flpjo')) {
                              $err = $this->upload->display_errors();

                              if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                   $error = "<p>Ukuran file maksimal 100 kb.</p>";
                              } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                   $error = "<p>Format file nya dalam bentuk pdf</p>";
                              } else {
                                   $error = $err;
                              }

                              echo json_encode(array("statusCode" => 202, "filepjo" =>  $error));
                         } else {
                              if ($auth_kary === "") {
                                   $query = $this->kry->cek_noKTP($ktp_pjo);
                                   if ($query) {
                                        echo json_encode(array("statusCode" => 202, "ktp_pjo" => "<p>No. KTP sudah digunakan</p>"));
                                        return;
                                   }

                                   $id_per_cek = $this->prs->get_id_per_by_auth_m($id_per);
                                   $query = $this->kry->cek_nik($nik_pjo, $id_per_cek);
                                   if ($query) {
                                        echo json_encode(array("statusCode" => 202, "nik_pjo" => "<p>NIK sudah digunakan</p>"));
                                        return;
                                   }

                                   $dtpersonal = [
                                        'no_ktp' => $ktp_pjo,
                                        'no_kk' => 0,
                                        'nama_lengkap' => $nama_pjo,
                                        'nama_alias' => '',
                                        'jk' => '',
                                        'tmp_lahir' => '',
                                        'tgl_lahir' => '1970-01-01',
                                        'id_stat_nikah' => 0,
                                        'id_agama' => 0,
                                        'warga_negara' => '',
                                        'email_pribadi' => '',
                                        'hp_1' => 0,
                                        'hp_2' => 0,
                                        'nama_ibu' => '',
                                        'stat_ibu' => '',
                                        'nama_ayah' => '',
                                        'stat_ayah' => '',
                                        'no_bpjstk' => 0,
                                        'no_bpjskes' => 0,
                                        'no_bpjspensiun' => 0,
                                        'no_equity' => 0,
                                        'no_npwp' => 0,
                                        'id_pendidikan' => 0,
                                        'nama_sekolah' => '',
                                        'fakultas' => '',
                                        'jurusan' => '',
                                        'tgl_buat' => date('Y-m-d H:i:s'),
                                        'tgl_edit' => date('Y-m-d H:i:s'),
                                        'id_user' => $this->session->userdata('id_user')
                                   ];

                                   $this->kry->input_dtPersonal($dtpersonal);
                                   $id_personal = $this->kry->last_row_id_personal();

                                   $dtkary = [
                                        'id_personal' => $id_personal,
                                        'id_perkerjaan' => 0,
                                        'no_acr' => 0,
                                        'no_nik' => $nik_pjo,
                                        'doh' => '1970-01-01',
                                        'tgl_aktif' => '1970-01-01',
                                        'id_depart' => 0,
                                        'id_section' => 0,
                                        'id_posisi' => 0,
                                        'id_grade' => 0,
                                        'id_level' => 0,
                                        'id_lokker' => 0,
                                        'id_lokterima' => 0,
                                        'id_poh' => 0,
                                        'id_roster' => 0,
                                        'id_klasifikasi' => 0,
                                        'paybase' => 0,
                                        'statpajak' => 0,
                                        'id_tipe' => 0,
                                        'stat_tinggal' => 0,
                                        'email_kantor' => 0,
                                        'tgl_permanen' => '1970-01-01',
                                        'id_stat_perjanjian' => 0,
                                        'tgl_nonaktif' => '1970-01-01',
                                        'alasan_nonaktif' => '',
                                        'tgl_buat' => date('Y-m-d H:i:s'),
                                        'tgl_edit' => date('Y-m-d H:i:s'),
                                        'id_user' => $this->session->userdata('id_user'),
                                        'id_m_perusahaan' => $id_m_per
                                   ];

                                   $this->kry->input_dtKaryawan($dtkary);

                                   $id_karyawan = $this->kry->last_row_idkary();
                              } else {
                                   $id_karyawan = $this->kry->get_id_karyawan($auth_kary);
                              }

                              $dtpjo = [
                                   'id_m_perusahaan' => $id_m_per,
                                   'id_lokasi' => $lokker_pjo,
                                   'id_karyawan' => $id_karyawan,
                                   'no_pengesahan_pjo' => $no_pjo,
                                   'tgl_aktif_pjo' =>  $tgl_aktif_pjo,
                                   'tgl_akhir_pjo' =>  $tgl_akhir_pjo,
                                   'url_pengesahan_pjo' => $nama_file,
                                   'ket_pjo' =>  $ket_pjo,
                                   'tgl_buat' => date('Y-m-d H:i:s'),
                                   'tgl_edit' => date('Y-m-d H:i:s'),
                                   'id_user' => $this->session->userdata('id_user'),
                              ];

                              $inputpjo = $this->str->input_pjo($dtpjo);

                              if ($inputpjo) {
                                   echo json_encode(array("statusCode" => 200, 'pesan' => 'Data PJO berhasil disimpan'));
                              } else {
                                   echo json_encode(array("statusCode" => 200, 'pesan' => 'Data PJO gagal disimpan'));
                              }
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data perusahaan"));
               }
          }
     }

     public function add_pjo()
     {

          $this->form_validation->set_rules("no_pjo", "no_pjo", "required|trim", [
               'required' => 'No. pengesahan PJO wajib diisi',
          ]);
          $this->form_validation->set_rules("id_lokker", "id_lokker", "required|trim", [
               'required' => 'Lokasi kerja PJO wajib dipilih',
          ]);
          $this->form_validation->set_rules("tgl_awal_pjo", "tgl_awal_pjo", "required|trim", [
               'required' => 'Tanggal aktif wajib diisi',
          ]);
          $this->form_validation->set_rules("tgl_akhir_pjo", "tgl_akhir_pjo", "required|trim", [
               'required' => 'Tanggal akhir wajib diisi',
          ]);
          $this->form_validation->set_rules("ketpjo", "ketpjo", "trim");

          $this->form_validation->set_rules("ktp_pjo", "ktp_pjo", "required|trim", [
               'required' => 'No. KTP PJO wajib diisi',
          ]);
          $this->form_validation->set_rules("nik_pjo", "nik_pjo", "required|trim", [
               'required' => 'NIK PJO wajib diisi',
          ]);
          $this->form_validation->set_rules("nama_pjo", "nama_pjo", "required|trim", [
               'required' => 'Nama PJO Wajib diisi',
          ]);

          if ($this->form_validation->run() == false) {

               $filepjo = htmlspecialchars($this->input->post("filepjo", true));
               if ($filepjo == "") {
                    $errfile = "<p>File pengesahan PJO wajib diupload</p>";
               } else {
                    $errfile = "";
               }

               $error = [
                    'statusCode' => 202,
                    'no_pjo' => form_error("no_pjo"),
                    'id_lokker' => form_error("id_lokker"),
                    'tgl_awal_pjo' => form_error("tgl_awal_pjo"),
                    'tgl_akhir_pjo' => form_error("tgl_akhir_pjo"),
                    'ktp_pjo' => form_error("ktp_pjo"),
                    'nik_pjo' => form_error("nik_pjo"),
                    'nama_pjo' => form_error("nama_pjo"),
                    'filepjo' => $errfile
               ];

               echo json_encode($error);
               return;
          } else {
               $no_pjo = htmlspecialchars($this->input->post("no_pjo", true));
               $lokker_pjo = htmlspecialchars($this->input->post("id_lokker", true));
               $tgl_aktif_pjo = htmlspecialchars($this->input->post("tgl_awal_pjo", true));
               $tgl_akhir_pjo = htmlspecialchars($this->input->post("tgl_akhir_pjo", true));
               $ket_pjo = htmlspecialchars($this->input->post("ket_pjo", true));
               $ktp_pjo = htmlspecialchars($this->input->post("ktp_pjo", true));
               $nik_pjo = htmlspecialchars($this->input->post("nik_pjo", true));
               $nama_pjo = htmlspecialchars($this->input->post("nama_pjo", true));
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
               $filepjo = htmlspecialchars($this->input->post("filepjo", true));
               $id_m_per = $this->prs->get_m_by_auth($auth_m_per);
               $id_per = $this->prs->get_id_per_by_auth_m($auth_m_per);
               $namafolder = md5($id_per);
               $now = date('YmdHis');
               $tglakhir = date('Ymd', strtotime($tgl_akhir_pjo));
               $nama_file = $tglakhir . "-" . $now . "-PJO.pdf";

               if ($filepjo == "") {
                    $errfile = "<p>File pengesahan PJO wajib diupload</p>";
                    echo json_encode(array("statusCode" => 202, "filepjo" => "<p>File pengesahan PJO wajib diupload</p>"));
                    return;
               }

               if ($tgl_aktif_pjo > $tgl_akhir_pjo) {
                    echo json_encode(array('statusCode' => 202, 'tgl_akhir_pjo' => '<p>Isi tanggal berakhir dengan benar</p>'));
                    return;
               }

               $cek_pjo = $this->str->cek_pjo($no_pjo, $tgl_aktif_pjo, $tgl_akhir_pjo);
               if ($cek_pjo == 201) {
                    echo json_encode(array('statusCode' => 201, 'pesan' => 'Pengesahan PJO dengan Nomor : ' . $no_pjo . ' Sudah digunakan'));
                    return;
               }

               if ($id_m_per != "") {
                    if (is_dir('./assets/berkas/perusahaan/' . $namafolder) == false) {
                         mkdir('./assets/berkas/perusahaan/' . $namafolder, 0775, TRUE);
                    }

                    if (is_dir('./assets/berkas/perusahaan/' . $namafolder)) {
                         $config['upload_path'] = './assets/berkas/perusahaan/' . $namafolder;
                         $config['allowed_types'] = 'pdf';
                         $config['max_size'] = 100;
                         $config['file_name'] = $nama_file;

                         $this->load->library('upload', $config);

                         if (!$this->upload->do_upload('flpjo')) {
                              $err = $this->upload->display_errors();

                              if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                   $error = "<p>Ukuran file maksimal 100 kb.</p>";
                              } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                   $error = "<p>Format file nya dalam bentuk pdf</p>";
                              } else {
                                   $error = $err;
                              }

                              echo json_encode(array("statusCode" => 202, "filepjo" =>  $error));
                         } else {
                              if ($auth_kary === "") {
                                   $query = $this->kry->cek_noKTP($ktp_pjo);
                                   if ($query) {
                                        echo json_encode(array("statusCode" => 202, "ktp_pjo" => "<p>No. KTP sudah digunakan</p>"));
                                        return;
                                   }

                                   $id_per_cek = $this->prs->get_id_per_by_auth_m($id_per);
                                   $query = $this->kry->cek_nik($nik_pjo, $id_per_cek);
                                   if ($query) {
                                        echo json_encode(array("statusCode" => 202, "nik_pjo" => "<p>NIK sudah digunakan</p>"));
                                        return;
                                   }

                                   $dtpersonal = [
                                        'no_ktp' => $ktp_pjo,
                                        'no_kk' => 0,
                                        'nama_lengkap' => $nama_pjo,
                                        'nama_alias' => '',
                                        'jk' => '',
                                        'tmp_lahir' => '',
                                        'tgl_lahir' => '1970-01-01',
                                        'id_stat_nikah' => 0,
                                        'id_agama' => 0,
                                        'warga_negara' => '',
                                        'email_pribadi' => '',
                                        'hp_1' => 0,
                                        'hp_2' => 0,
                                        'nama_ibu' => '',
                                        'stat_ibu' => '',
                                        'nama_ayah' => '',
                                        'stat_ayah' => '',
                                        'no_bpjstk' => 0,
                                        'no_bpjskes' => 0,
                                        'no_bpjspensiun' => 0,
                                        'no_equity' => 0,
                                        'no_npwp' => 0,
                                        'id_pendidikan' => 0,
                                        'nama_sekolah' => '',
                                        'fakultas' => '',
                                        'jurusan' => '',
                                        'tgl_buat' => date('Y-m-d H:i:s'),
                                        'tgl_edit' => date('Y-m-d H:i:s'),
                                        'id_user' => $this->session->userdata('id_user')
                                   ];

                                   $this->kry->input_dtPersonal($dtpersonal);
                                   $id_personal = $this->kry->last_row_id_personal();

                                   $dtkary = [
                                        'id_personal' => $id_personal,
                                        'id_perkerjaan' => 0,
                                        'no_acr' => 0,
                                        'no_nik' => $nik_pjo,
                                        'doh' => '1970-01-01',
                                        'tgl_aktif' => '1970-01-01',
                                        'id_depart' => 0,
                                        'id_section' => 0,
                                        'id_posisi' => 0,
                                        'id_grade' => 0,
                                        'id_level' => 0,
                                        'id_lokker' => 0,
                                        'id_lokterima' => 0,
                                        'id_poh' => 0,
                                        'id_roster' => 0,
                                        'id_klasifikasi' => 0,
                                        'paybase' => 0,
                                        'statpajak' => 0,
                                        'id_tipe' => 0,
                                        'stat_tinggal' => 0,
                                        'email_kantor' => 0,
                                        'tgl_permanen' => '1970-01-01',
                                        'id_stat_perjanjian' => 0,
                                        'tgl_nonaktif' => '1970-01-01',
                                        'alasan_nonaktif' => '',
                                        'tgl_buat' => date('Y-m-d H:i:s'),
                                        'tgl_edit' => date('Y-m-d H:i:s'),
                                        'id_user' => $this->session->userdata('id_user'),
                                        'id_m_perusahaan' => $id_m_per
                                   ];

                                   $this->kry->input_dtKaryawan($dtkary);

                                   $id_karyawan = $this->kry->last_row_idkary();
                              } else {
                                   $id_karyawan = $this->kry->get_id_karyawan($auth_kary);
                              }

                              $dtpjo = [
                                   'id_m_perusahaan' => $id_m_per,
                                   'id_lokasi' => $lokker_pjo,
                                   'id_karyawan' => $id_karyawan,
                                   'no_pengesahan_pjo' => $no_pjo,
                                   'tgl_aktif_pjo' =>  $tgl_aktif_pjo,
                                   'tgl_akhir_pjo' =>  $tgl_akhir_pjo,
                                   'url_pengesahan_pjo' => $nama_file,
                                   'ket_pjo' =>  $ket_pjo,
                                   'tgl_buat' => date('Y-m-d H:i:s'),
                                   'tgl_edit' => date('Y-m-d H:i:s'),
                                   'id_user' => $this->session->userdata('id_user'),
                              ];

                              $inputpjo = $this->str->input_pjo($dtpjo);

                              if ($inputpjo) {
                                   echo json_encode(array("statusCode" => 200, 'pesan' => 'Data PJO berhasil disimpan'));
                              } else {
                                   echo json_encode(array("statusCode" => 200, 'pesan' => 'Data PJO gagal disimpan'));
                              }
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Error saat membuat folder"));
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data perusahaan"));
               }
          }
     }

     public function hapus_pjo()
     {
          $auth_pjo = htmlspecialchars(trim($this->input->post('auth_pjo')));
          $auth_m_per = htmlspecialchars(trim($this->input->post('auth_m_per')));
          $id_pjo = $this->str->get_by_auth_pjo($auth_pjo);

          $query = $this->str->hapus_pjo($id_pjo);
          if ($query == 200) {
               $jml_pjo = $this->str->jml_pjo($auth_m_per);
               echo json_encode(array("statusCode" => 200, "pesan" => "Data PJO berhasil dihapus", "jml_pjo" => $jml_pjo));
          } else {
               echo json_encode(array("statusCode" => 201, "pesan" => "Data PJO gagal dihapus"));
          }
     }

     public function hapus_str_per()
     {
          $auth_m_per = htmlspecialchars(trim($this->input->post('auth_m_per')));
          $id_m_per = $this->str->get_by_m_authper($auth_m_per);

          $query = $this->str->hapus_str_per($id_m_per);
          if ($query == 200) {
               $this->session->set_flashdata("hapus_sukses", "1");
               echo json_encode(array("statusCode" => 200, "pesan" => "Data struktur perusahaan berhasil dihapus"));
          } elseif ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Data struktur perusahaan gagal dihapus"));
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Data struktur perusahaan tidak dapat dihapus, digunakan pada data karyawan"));
          }
     }

     public function str_selesai()
     {
          $this->session->set_flashdata("str_sukses", "1");
          echo json_encode(array("statusCode" => 200, "pesan" => "Data struktur perusahaan berhasil dibuat"));
     }

     public function hapus_struktur()
     {
          $auth_struktur = htmlspecialchars(trim($this->input->post('authstruktur')));
          $query = $this->str->hapus_struktur($auth_struktur);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Struktur perusahaan berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Struktur perusahaan gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Struktur perusahaan tidak ditemukan"));
               return;
          }
     }

     public function detail_struktur()
     {
          $auth_struktur = htmlspecialchars(trim($this->input->post("authstruktur")));
          $query = $this->str->get_struktur_id($auth_struktur);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_struktur == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'nama_perusahaan' => $list->nama_perusahaan,
                         'kode' => $list->kd_struktur,
                         'struktur' => $list->struktur,
                         'ket' => $list->ket_struktur,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_struktur', $list->id_struktur);
                    $this->session->set_userdata('id_perusahaan', $list->id_perusahaan);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "struktur tidak ditemukan"));
          }
     }

     public function edit_struktur()
     {
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("struktur", "struktur", "required|trim|max_length[100]", [
               'required' => 'struktur wajib diisi',
               'max_length' => 'struktur maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");
          $this->form_validation->set_rules("status", "status", "required|trim", [
               'required' => 'Status wajib dipilih'
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'kode' => form_error("kode"),
                    'struktur' => form_error("struktur"),
                    'status' => form_error("status")
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_perusahaan') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               if ($this->session->userdata('id_struktur') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "struktur tidak ditemukan"));
                    return;
               }

               $kd_struktur = htmlspecialchars($this->input->post("kode", true));
               $struktur = htmlspecialchars($this->input->post("struktur", true));
               $ket_struktur = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $struktur = $this->str->edit_struktur($kd_struktur, $struktur, $ket_struktur, $status);
               if ($struktur == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "struktur berhasil diupdate"));
               } else if ($struktur == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "struktur gagal diupdate"));
               } else if ($struktur == 203) {
                    echo json_encode(array("statusCode" => 203, "pesan" => "Kode sudah digunakan"));
               } else if ($struktur == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "struktur sudah digunakan"));
               }
          }
     }

     public function update_str_nama_per()
     {
          $this->form_validation->set_rules("namaper", "namaper", "required|trim", [
               'required' => 'Nama perusahaan wajib diisi'
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'namaper' => form_error("namaper")
               ];

               echo json_encode($error);
               die;
          } else {
               $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
               $namaper = htmlspecialchars($this->input->post("namaper", true));
               $id_m_per = $this->str->get_by_m_authper($auth_m_per);

               if ($id_m_per != "") {
                    $dtper = [
                         'nama_m_perusahaan' => $namaper,
                         'tgl_edit' => date('Y-m-d H:i:s')
                    ];

                    $updstr = $this->str->update_struktur($id_m_per, $dtper);
                    if ($updstr == 200) {
                         $this->session->set_flashdata("updstr_sukses", "1");
                         echo json_encode(array("statusCode" => 200, "pesan" => "Nama perusahaan berhasil diupdate"));
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Nama perusahaan gagal diupdate"));
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data perusahaan tidak ditemukan"));
               }
          }
     }

     public function get_all()
     {
          $query = $this->str->get_all();
          $output = "<option value=''>-- Pilih struktur --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_struktur . "'>" . $list->struktur . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "str" => $output));
          } else {
               $output = "<option value=''>-- struktur Tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "str" => $output));
          }
     }

     public function get_lokasi_pjo()
     {
          $query = $this->str->get_all_lokasi_pjo();
          $output = "<option value=''>-- PILIH LOKASI KERJA --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->id_lokasi_pjo . "'>" . $list->lokasi_pjo . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "pjoo" => $output));
          } else {
               $output = "<option value=''>-- LOKASI PJO TIDAK DITEMUKAN --</option>";
               echo json_encode(array("statusCode" => 201, "pjoo" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');
          $query = $this->str->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih struktur --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_struktur . "'>" . $list->struktur . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "str" => $output));
          } else {
               $output = "<option value=''>-- struktur Tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "str" => $output));
          }
     }

     public function get_by_idjenis()
     {
          $idjenis = htmlspecialchars($this->input->post('id_jenis'));
          $query = $this->str->get_by_idjenis(intval($idjenis) - 1);
          if (!empty($query)) {
               $output = "<option value=''>-- PILIH PERUSAHAAN --</option> ";
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_m_perusahaan . "'>" . $list->nama_perusahaan . "</option> ";
               }
          } else {
               $output = "<option value=''>-- PERUSAHAAN TIDAK DITEMUKAN --</option> ";
          }

          echo json_encode(array("per" => $output));
     }

     public function get_detail_m_per()
     {
          $auth_m_per = htmlspecialchars($this->input->post('auth_m_per'));
          $query = $this->str->get_detail_m_per($auth_m_per);

          if (!empty($query)) {
               foreach ($query as $list) {
                    $auth_m_per = $list->auth_m_perusahaan;
                    $kode_perusahaan = $list->kode_perusahaan;
                    $nama_m_perusahaan = $list->nama_m_perusahaan;
                    $url_rk3l = $list->url_rk3l;
                    $no_izin_perusahaan = $list->no_izin_perusahaan;
                    $tgl_mulai_izin = date('d-M-Y', strtotime($list->tgl_mulai_izin));
                    $tgl_akhir_izin = date('d-M-Y', strtotime($list->tgl_akhir_izin));
                    $ket_izin_perusahaan = $list->ket_izin_perusahaan;
                    $url_izin_perusahaan = $list->url_izin_perusahaan;
                    $no_sio_perusahaan = $list->no_sio_perusahaan;
                    $tgl_mulai_sio = date('d-M-Y', strtotime($list->tgl_mulai_sio));
                    $tgl_akhir_sio = date('d-M-Y', strtotime($list->tgl_akhir_sio));
                    $ket_sio = $list->ket_sio;
                    $url_sio = $list->url_sio;
                    $no_kontrak_perusahaan = $list->no_kontrak_perusahaan;
                    $tgl_mulai_kontrak = date('d-M-Y', strtotime($list->tgl_mulai_kontrak));
                    $tgl_akhir_kontrak = date('d-M-Y', strtotime($list->tgl_akhir_kontrak));
                    $ket_kontrak_perusahaan = $list->ket_kontrak_perusahaan;
                    $url_doc_kontrak_perusahaan = $list->url_doc_kontrak_perusahaan;
                    $nama_user = $list->nama_user;
                    $tgl_buat = date('d-M-Y H:i:s', strtotime($list->tgl_buat));
                    $tgl_edit = date('d-M-Y H:i:s', strtotime($list->tgl_edit));
                    if ($list->stat_m_perusahaan == "T") {
                         $stat_m_perusahaan = "AKTIF";
                    } else {
                         $stat_m_perusahaan = "NONAKTIF";
                    }

                    $nama_perusahaan = $this->str->get_nama_per_utama($auth_m_per);

                    if ($tgl_mulai_izin == "01-Jan-1970") {
                         $tgl_izin = "Tidak ada IUJP";
                         $no_izin_perusahaan = "Tidak ada IUJP";
                         $ket_izin_perusahaan = "Tidak ada IUJP";
                    } else {
                         $tgl_izin = $tgl_mulai_izin . " - " . $tgl_akhir_izin;
                         if ($ket_izin_perusahaan == "") {
                              $ket_izin_perusahaan = "-";
                         }
                    }

                    if ($tgl_mulai_sio == "01-Jan-1970") {
                         $tgl_sio = "Tidak ada SIO";
                         $no_sio_perusahaan = "Tidak ada SIO";
                         $ket_sio = "Tidak ada SIO";
                    } else {
                         $tgl_sio = $tgl_mulai_sio . " - " . $tgl_akhir_sio;
                         if ($ket_sio == "") {
                              $ket_sio = "-";
                         }
                    }

                    if ($tgl_mulai_kontrak == "01-Jan-1970") {
                         $tgl_kontrak = "Tidak ada Kontrak";
                         $no_kontrak_perusahaan = "Tidak ada Kontrak";
                         $ket_kontrak_perusahaan = "Tidak ada Kontrak";
                    } else {
                         $tgl_kontrak = $tgl_mulai_kontrak . " - " . $tgl_akhir_kontrak;
                         if ($ket_kontrak_perusahaan == "") {
                              $ket_kontrak_perusahaan = "-";
                         }
                    }

                    if ($url_rk3l != "") {
                         $stat_RK3L = "Ada RK3L";
                    } else {
                         $stat_RK3L = "Tidak ada RK3L";
                    }
               }

               $data = [
                    'statusCode' => 200,
                    'auth_m_per' => $auth_m_per,
                    'kode_perusahaan' => $kode_perusahaan,
                    'nama_perusahaan' => $nama_perusahaan,
                    'nama_m_perusahaan' => $nama_m_perusahaan,
                    'url_rk3l' => $url_rk3l,
                    'stat_RK3L' => $stat_RK3L,
                    'no_izin_perusahaan' => $no_izin_perusahaan,
                    'tgl_izin' =>  $tgl_izin,
                    'ket_izin_perusahaan' => $ket_izin_perusahaan,
                    'url_izin_perusahaan' => $url_izin_perusahaan,
                    'no_sio_perusahaan' => $no_sio_perusahaan,
                    'tgl_sio' => $tgl_sio,
                    'ket_sio' => $ket_sio,
                    'url_sio' => $url_sio,
                    'no_kontrak_perusahaan' => $no_kontrak_perusahaan,
                    'tgl_kontrak' =>  $tgl_kontrak,
                    'ket_kontrak_perusahaan' => $ket_kontrak_perusahaan,
                    'url_doc_kontrak_perusahaan' => $url_doc_kontrak_perusahaan,
                    'nama_buat' => $nama_user,
                    'tgl_buat' => $tgl_buat,
                    'tgl_edit' => $tgl_edit,
                    'stat_m_perusahaan' => $stat_m_perusahaan,
                    'pesan' => 'Sukses'
               ];
          } else {
               $data = [
                    'statusCode' => 201,
                    'pesan' => 'Data tidak ditemukan'
               ];
          }

          echo json_encode($data);
     }
}
