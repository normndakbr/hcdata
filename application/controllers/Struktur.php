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
          // if ($this->session->has_userdata('id_m_per_new')) {
          //      echo json_encode(array("statusCode" => 201, "pesan" => "Tambah data perusahaan sedang digunakan"));
          //      return;
          // } else {
          //      echo json_encode(array("statusCode" => 200, "pesan" => "Ready"));
          //      return;

          // }
          $newData = array(
               'id_m_per_new',
               'id_m_per_add',
               'id_parent_add',
               'auth_per_sub',
               'id_iujp_add'
          );

          $this->session->unset_userdata($newData);
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/struktur/struktur_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/struktur');
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
                    'namaper' => form_error("namaper"),
               ];

               echo json_encode($error);
          } else {
               $auth_per = $this->session->userdata('auth_per_sub');
               $idparent = htmlspecialchars($this->input->post("idparent", true));
               $namaper = htmlspecialchars($this->input->post("namaper", true));
               $id_perusahaan = $this->str->get_by_authperusahaan($auth_per);
               $id_parent = $this->str->get_by_m_authper($idparent);

               if ($this->session->has_userdata('id_m_per_new')) {
                    $id_m_per_new = $this->session->userdata('id_m_per_new');
                    $dtper = [
                         'id_parent' => $id_parent,
                         'id_perusahaan' => $id_perusahaan,
                         'nama_m_perusahaan' => $namaper
                    ];
                    $uper = $this->str->update_struktur($id_m_per_new, $dtper);
                    if ($uper) {
                         $newData = array(
                              'id_m_per_add' => $id_perusahaan,
                              'id_parent_add' => $id_parent
                         );
                         $this->session->set_userdata($newData);
                         echo json_encode(array('statusCode' => 200, 'pesan' => 'Data perusahaan berhasil diupdate'));
                    } else {
                         echo json_encode(array('statusCode' => 201, 'pesan' => 'Data perusahaan gagal diupdate'));
                    }
               } else {
                    $dtper = [
                         'id_parent' => $id_parent,
                         'id_perusahaan' => $id_perusahaan,
                         'nama_m_perusahaan' => $namaper,
                         'id_jenis_perusahaan' => 3,
                         'stat_m_perusahaan' => 'T',
                         'tgl_buat' => date('Y-m-d H:i:s'),
                         'tgl_edit' => date('Y-m-d H:i:s'),
                         'id_user' => $this->session->userdata('id_user')
                    ];

                    $str_per = $this->str->input_struktur($dtper);
                    if ($str_per) {
                         $id_m_per = $this->str->last_row_idmper($dtper);
                         $newData = array(
                              'id_m_per_new' => $id_m_per,
                              'id_m_per_add' => $id_perusahaan,
                              'id_parent_add' => $id_parent
                         );

                         $this->session->set_userdata($newData);
                         echo json_encode(array('statusCode' => 200, 'pesan' => 'Data perusahaan berhasil disimpan'));
                    } else {
                         echo json_encode(array('statusCode' => 201, 'pesan' => 'Data perusahaan gagal disimpan'));
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
          $this->form_validation->set_rules("ket_iujp", "ket_iujp", "trim");

          $fileiujp = htmlspecialchars($this->input->post("fileiujp", true));
          if ($fileiujp == "") {
               $errfile = "<p>File IUJP wajib dipilih</p>";
          } else {
               $errfile = "";
          }

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'no_iujp' => form_error("no_iujp"),
                    'tgl_awal_iujp' => form_error("tgl_awal_iujp"),
                    'tgl_akhir_iujp' => form_error("tgl_akhir_iujp"),
                    'fileiujp' => $errfile
               ];

               echo json_encode($error);
          } else {
               $no_iujp = htmlspecialchars($this->input->post("no_iujp", true));
               $tgl_awal_iujp = htmlspecialchars($this->input->post("tgl_awal_iujp", true));
               $tgl_akhir_iujp = htmlspecialchars($this->input->post("tgl_akhir_iujp", true));
               $ket_iujp = htmlspecialchars($this->input->post("ket_iujp", true));

               if ($this->session->has_userdata('id_iujp_add')) {
                    $id_m_per_new = $this->session->userdata('id_m_per_new');
                    $id_iujp_new = $this->session->userdata('id_iujp_add');

                    $dtiujp = [
                         'no_izin_perusahaan' => $no_iujp,
                         'tgl_mulai_izin' => $tgl_awal_iujp,
                         'tgl_akhir_izin' => $tgl_akhir_iujp,
                         'url_izin_perusahaan' => '',
                         'ket_izin_perusahaan' => $ket_iujp,
                    ];

                    $uiujp = $this->str->update_iujp($id_iujp_new, $dtiujp);
                    if ($uiujp) {
                         echo json_encode(array('statusCode' => 200, 'pesan' => 'Data IUJP berhasil diupdate'));
                    } else {
                         echo json_encode(array('statusCode' => 201, 'pesan' => 'Data IUJP gagal diupdate'));
                    }
               } else {
                    $id_m_per_new = $this->session->userdata('id_m_per_new');
                    $id_m_per_add = $this->session->userdata('id_m_per_add');

                    $now = date('YmdHis');
                    $nama_file = $id_m_per_add . "-" . $id_m_per_new . "-" . $now . "-IUJP.pdf";


                    if (is_dir('./assets/berkas/perusahaan/' . $id_m_per_add) == false) {
                         mkdir('./assets/berkas/perusahaan/' . $id_m_per_add, 0775, TRUE);
                    }

                    if (is_dir('./assets/berkas/perusahaan/' . $id_m_per_add)) {
                         $config['upload_path'] = './assets/berkas/perusahaan/' . $id_m_per_add;
                         $config['allowed_types'] = 'pdf';
                         $config['max_size'] = 1000;
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
                              if ($id_m_per_new != "") {
                                   $dtiujp = [
                                        'id_m_perusahaan' => $id_m_per_new,
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
                                        $id_iujp_add = $this->str->last_row_idiujp();
                                        $newData = array(
                                             'id_iujp_add' => $id_iujp_add
                                        );

                                        $this->session->set_userdata($newData);
                                        echo json_encode(array('statusCode' => 200, 'pesan' => 'Data IUJP berhasil disimpan'));
                                   } else {
                                        echo json_encode(array('statusCode' => 201, 'pesan' => 'Data IUJP gagal disimpan'));
                                   }
                              } else {
                                   echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data perusahaan"));
                              }
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Folder data perusahaan tidak ditemukan"));
                    }
               }
          }
     }

     // public function input_struktur()
     // {
     //      $this->form_validation->set_rules("jkau092321", "jkau092321", "required|trim", [
     //           'required' => 'Perusahaan wajib dipilih'
     //      ]);
     //      $this->form_validation->set_rules("jlasd1233", "jlasd1233", "required|trim", [
     //           'required' => 'Perusahaan wajib diisi'
     //      ]);
     //      $this->form_validation->set_rules("jenisPerusahaan", "jenisPerusahaan", "required|trim", [
     //           'required' => 'Jenis perusahaan wajib dipilih'
     //      ]);
     //      if ($this->form_validation->run() == false) {
     //           $error = [
     //                'statusCode' => 202,
     //                'jenis_per' => form_error("jkau092321"),
     //                'per_jenis' => form_error("jlasd1233"),
     //                'jenisper' => form_error("jenisPerusahaan")
     //           ];
     //           $data['nama'] = $this->session->userdata("nama");
     //           $data['email'] = $this->session->userdata("email");
     //           $data['menu'] = $this->session->userdata("id_menu");
     //           $this->load->view('dashboard/template/header', $data);
     //           $this->load->view('dashboard/struktur/struktur_add');
     //           $this->load->view('dashboard/modal/mdlform');
     //           $this->load->view('dashboard/template/footer', $data);
     //           $this->load->view('dashboard/code/struktur');
     //      } else {
     //           $auth_m_perusahaan = htmlspecialchars($this->input->post("jkau092321", true));
     //           $auth_per = htmlspecialchars($this->input->post("jlasd1233", true));
     //           $jenis_per = htmlspecialchars($this->input->post("jenisPerusahaan", true));
     //           $id_p_per = $this->prs->get_m_by_auth($auth_m_perusahaan);
     //           $id_parent = $this->prs->get_parent_by_auth($auth_m_perusahaan);
     //           $auth_parent = $this->prs->get_p_by_auth($auth_m_perusahaan);
     //           $id_per = $this->prs->get_by_auth($auth_per);

     //           if ($id_p_per === "0") {
     //                $this->session->set_flashdata('msg', '<div class="err_psn_prs_str alert alert-danger animate__animated animate__bounce"> Perusahaan tidak terdaftar </div>');
     //                $data['nama'] = $this->session->userdata("nama");
     //                $data['email'] = $this->session->userdata("email");
     //                $data['menu'] = $this->session->userdata("id_menu");
     //                $this->load->view('dashboard/template/header', $data);
     //                $this->load->view('dashboard/struktur/struktur_add');
     //                $this->load->view('dashboard/modal/mdlform');
     //                $this->load->view('dashboard/template/footer', $data);
     //                $this->load->view('dashboard/code/struktur');
     //                return;
     //           }
     //           if ($id_per === "0") {
     //                $this->session->set_flashdata('msg', '<div class="err_psn_prs_str alert alert-danger animate__animated animate__bounce"> Perusahaan tidak terdaftar </div>');
     //                $data['nama'] = $this->session->userdata("nama");
     //                $data['email'] = $this->session->userdata("email");
     //                $data['menu'] = $this->session->userdata("id_menu");
     //                $this->load->view('dashboard/template/header', $data);
     //                $this->load->view('dashboard/struktur/struktur_add');
     //                $this->load->view('dashboard/modal/mdlform');
     //                $this->load->view('dashboard/template/footer', $data);
     //                $this->load->view('dashboard/code/struktur');
     //                return;
     //           }

     //           if ($auth_per == $auth_parent) {
     //                $this->session->set_flashdata('msg', '<div class="err_psn_prs_str alert alert-danger animate__animated animate__bounce"> Perusahaan tidak boleh sama </div>');
     //                $data['nama'] = $this->session->userdata("nama");
     //                $data['email'] = $this->session->userdata("email");
     //                $data['menu'] = $this->session->userdata("id_menu");
     //                $this->load->view('dashboard/template/header', $data);
     //                $this->load->view('dashboard/struktur/struktur_add');
     //                $this->load->view('dashboard/modal/mdlform');
     //                $this->load->view('dashboard/template/footer', $data);
     //                $this->load->view('dashboard/code/struktur');
     //                return;
     //           }

     //           echo $id_parent . " - " . $id_per;
     //           return;

     //           $cek_str_per = $this->str->cek_str_per($id_parent, $id_per);
     //           if ($cek_str_per) {
     //                $this->session->set_flashdata('msg', '<div class="err_psn_prs_str alert alert-danger animate__animated animate__bounce"> Struktur perusahaan sudah ada </div>');
     //                $data['nama'] = $this->session->userdata("nama");
     //                $data['email'] = $this->session->userdata("email");
     //                $data['menu'] = $this->session->userdata("id_menu");
     //                $this->load->view('dashboard/template/header', $data);
     //                $this->load->view('dashboard/struktur/struktur_add');
     //                $this->load->view('dashboard/modal/mdlform');
     //                $this->load->view('dashboard/template/footer', $data);
     //                $this->load->view('dashboard/code/struktur');
     //                return;
     //           }
     //           $data = [
     //                'id_parent' => $id_p_per,
     //                'id_perusahaan' => $id_per,
     //                'id_jenis_perusahaan' => $jenis_per,
     //                'stat_m_perusahaan' => 'T',
     //                'tgl_buat' => date('Y-m-d H:i:s'),
     //                'tgl_edit' => date('Y-m-d H:i:s'),
     //                'id_user' => $this->session->userdata('id_user')
     //           ];

     //           $struktur = $this->str->input_struktur($data);
     //           if ($struktur) {
     //                $this->session->set_flashdata('msg', '<div class="err_psn_prs_str alert alert-primary animate__animated animate__bounce"> Struktur perusahaan berhasil disimpan </div>');
     //                $data['nama'] = $this->session->userdata("nama");
     //                $data['email'] = $this->session->userdata("email");
     //                $data['menu'] = $this->session->userdata("id_menu");
     //                $this->load->view('dashboard/template/header', $data);
     //                $this->load->view('dashboard/struktur/struktur_add');
     //                $this->load->view('dashboard/modal/mdlform');
     //                $this->load->view('dashboard/template/footer', $data);
     //                $this->load->view('dashboard/code/struktur');
     //           } else {
     //                $this->session->set_flashdata('msg', '<div class="err_psn_prs_str alert alert-primary animate__animated animate__bounce"> Struktur perusahaan gagal disimpan </div>');
     //                $data['nama'] = $this->session->userdata("nama");
     //                $data['email'] = $this->session->userdata("email");
     //                $data['menu'] = $this->session->userdata("id_menu");
     //                $this->load->view('dashboard/template/header', $data);
     //                $this->load->view('dashboard/struktur/struktur_add');
     //                $this->load->view('dashboard/modal/mdlform');
     //                $this->load->view('dashboard/template/footer', $data);
     //                $this->load->view('dashboard/code/struktur');
     //           }
     //      }
     // }

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
}
