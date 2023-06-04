<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Section extends My_Controller
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
          $this->load->view('dashboard/section/section');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/section');
     }

     public function new()
     {
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/section/section_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/section');
     }

     public function ajax_list()
     {
          $list = $this->sctn->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $sctn) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_section'] = $sctn->auth_section;
               $row['kd_section'] = $sctn->kd_section;
               $row['section'] = $sctn->section;
               $row['depart'] = $sctn->depart;
               $row['ket_section'] = $sctn->ket_section;

               if ($sctn->stat_section == "T") {
                    $row['stat_section'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_section'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['kode_perusahaan'] = $sctn->kode_perusahaan;
               $row['tgl_buat'] = date('d-M-Y', strtotime($sctn->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($sctn->tgl_edit));
               $row['proses'] = '<button id="' . $sctn->auth_section . '" class="btn btn-primary btn-sm font-weight-bold dtlsection" title="Detail" value="' . $sctn->section . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $sctn->auth_section . '" class="btn btn-warning btn-sm font-weight-bold edttsection" title="Edit" value="' . $sctn->section . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $sctn->auth_section . '" class="btn btn-danger btn-sm font-weight-bold hpssection" title="Hapus" value="' . $sctn->section . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->sctn->count_all(),
               "recordsFiltered" => $this->sctn->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_section()
     {

          $this->form_validation->set_rules("prs", "prs", "required|trim", [
               'required' => 'Perusahaan wajib dipilih'
          ]);
          $this->form_validation->set_rules("depart", "depart", "required|trim", [
               'required' => 'Departemen wajib dipilih'
          ]);
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("section", "section", "required|trim|max_length[100]", [
               'required' => 'Section wajib diisi',
               'max_length' => 'Section maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'prs' => form_error("prs"),
                    'depart' => form_error("depart"),
                    'kode' => form_error("kode"),
                    'section' => form_error("section"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $auth_perusahaan = htmlspecialchars($this->input->post("prs", true));
               $auth_depart = htmlspecialchars($this->input->post("depart", true));
               $kd_section = htmlspecialchars($this->input->post("kode", true));
               $section = htmlspecialchars($this->input->post("section", true));
               $ket_section = htmlspecialchars($this->input->post("ket"));
               $id_perusahaan = $this->prs->get_by_auth($auth_perusahaan);
               if ($id_perusahaan == 0) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               $query = $this->dprt->get_depart_id($auth_depart);
               if (!empty($query)) {
                    foreach ($query as $list) {
                         $id_depart = $list->id_depart;
                         if ($id_depart == 0) {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Departemen tidak ditemukan"));
                              return;
                         }
                    }
               }

               $cekkode = $this->sctn->cek_kode($id_perusahaan, $id_depart, $kd_section);
               if ($cekkode) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Kode sudah digunakan"));
                    return;
               }

               $ceksection = $this->sctn->cek_section($id_perusahaan, $id_depart, $section);
               if ($ceksection) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Section sudah digunakan"));
                    return;
               }

               $data = [
                    'kd_section' => $kd_section,
                    'section' => $section,
                    'id_depart' => $id_depart,
                    'ket_section' => $ket_section,
                    'stat_section' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user'),
                    'id_perusahaan' => $id_perusahaan
               ];

               $section = $this->sctn->input_section($data);
               if ($section) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Section berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Section gagal disimpan"));
               }
          }
     }

     public function hapus_section()
     {
          $auth_section = htmlspecialchars(trim($this->input->post('authsection')));
          $query = $this->sctn->hapus_section($auth_section);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Section berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Section gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Section tidak ditemukan"));
               return;
          }
     }

     public function detail_section()
     {
          $auth_section = htmlspecialchars(trim($this->input->post("authsection")));
          $query = $this->sctn->get_section_id($auth_section);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_section == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    if ($list->depart == null) {
                         $auth_depart = '';
                    } else {
                         $auth_depart = $list->auth_depart;
                    }
                    $data = [
                         'statusCode' => 200,
                         'nama_perusahaan' => $list->nama_perusahaan,
                         'kode' => $list->kd_section,
                         'section' => $list->section,
                         'depart' =>  $list->depart,
                         'auth_depart' =>  $auth_depart,
                         'ket' => $list->ket_section,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_section', $list->id_section);
                    $this->session->set_userdata('id_perusahaan', $list->id_perusahaan);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "Section tidak ditemukan"));
          }
     }

     public function edit_section()
     {
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("section", "section", "required|trim|max_length[100]", [
               'required' => 'Section wajib diisi',
               'max_length' => 'Section maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("depart", "depart", "required|trim", [
               'required' => 'Departemen wajib dipilih'
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
                    'depart' => form_error("depart"),
                    'section' => form_error("section"),
                    'status' => form_error("status"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_perusahaan') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               if ($this->session->userdata('id_section') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Section tidak ditemukan"));
                    return;
               }

               if ($this->session->userdata('id_depart') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Departemen tidak ditemukan"));
                    return;
               }

               $kd_section = htmlspecialchars($this->input->post("kode", true));
               $section = htmlspecialchars($this->input->post("section", true));
               $depart = htmlspecialchars($this->input->post("depart", true));
               $ket_section = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }
               $section = $this->sctn->edit_section($kd_section, $section, $depart, $ket_section, $status);
               if ($section == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Section berhasil diupdate"));
               } else if ($section == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Section gagal diupdate"));
               } else if ($section == 203) {
                    echo json_encode(array("statusCode" => 203, "pesan" => "Kode sudah digunakan"));
               } else if ($section == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "Section sudah digunakan"));
               }
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan') != "") {
               $id_per = $this->session->userdata('id_perusahaan');
               $output = "<option value=''>-- Pilih Departemen --</option>";
               $query = $this->dprt->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_depart . "'>" . $list->depart . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "depart" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- Departemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "depart" => $output, "pesan", "Departemen gagal ditampilkan"));
          }
     }
     public function get_by_authdepart()
     {
          $auth_depart = $this->input->post('auth_depart');

          $query = $this->sctn->get_by_authdepart($auth_depart);
          $output = "<option value=''>-- Pilih Section --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_section . "'>" . $list->section . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "section" => $output));
          } else {
               $output = "<option value=''>-- Section Tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "section" => $output));
          }
     }
}
