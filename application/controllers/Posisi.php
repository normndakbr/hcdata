<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posisi extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_logout();
     }

     public function index()
     {
          if ($this->session->has_userdata('id_m_perusahaan')) {
               $idmper = $this->session->userdata('id_m_perusahaan');
               if ($idmper != "") {
                    $data['permst'] = $this->str->getMasterPrs($idmper, "");
                    $data['perstr'] = $this->str->getMenuPrs($idmper, "");
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
          $this->load->view('dashboard/posisi/posisi');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/posisi');
     }

     public function new()
     {
          if ($this->session->has_userdata('id_m_perusahaan')) {
               $idmper = $this->session->userdata('id_m_perusahaan');
               if ($idmper != "") {
                    $data['permst'] = $this->str->getMasterPrs($idmper, "");
                    $data['perstr'] = $this->str->getMenuPrs($idmper, "");
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
          $this->load->view('dashboard/posisi/posisi_add');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/posisi');
     }

     public function ajax_list()
     {
          $auth_per = $this->input->get("auth_per");
          $list = $this->pss->get_datatables($auth_per);
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $pss) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_posisi'] = $pss->auth_posisi;
               $row['posisi'] = $pss->posisi;
               $row['depart'] = $pss->depart;
               $row['ket_posisi'] = $pss->ket_posisi;

               if ($pss->stat_posisi == "T") {
                    $row['stat_posisi'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_posisi'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['kode_perusahaan'] = $pss->kode_perusahaan;
               $row['tgl_buat'] = date('d-M-Y', strtotime($pss->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($pss->tgl_edit));
               $row['proses'] = '<button id="' . $pss->auth_posisi . '" class="btn btn-primary btn-sm font-weight-bold dtlposisi" title="Detail" value="' . $pss->posisi . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $pss->auth_posisi . '" class="btn btn-warning btn-sm font-weight-bold edttposisi" title="Edit" value="' . $pss->posisi . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $pss->auth_posisi . '" class="btn btn-danger btn-sm font-weight-bold hpsposisi" title="Hapus" value="' . $pss->posisi . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->pss->count_all(),
               "recordsFiltered" => $this->pss->count_filtered($auth_per),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_posisi()
     {

          $this->form_validation->set_rules("prs", "prs", "required|trim", [
               'required' => 'Perusahaan wajib dipilih'
          ]);
          $this->form_validation->set_rules("depart", "depart", "required|trim", [
               'required' => 'Departemen wajib dipilih'
          ]);
          $this->form_validation->set_rules("posisi", "posisi", "required|trim|max_length[100]", [
               'required' => 'Posisi wajib diisi',
               'max_length' => 'Posisi maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'prs' => form_error("prs"),
                    'depart' => form_error("depart"),
                    'posisi' => form_error("posisi"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $auth_perusahaan = htmlspecialchars($this->input->post("prs", true));
               $auth_depart = htmlspecialchars($this->input->post("depart", true));
               $posisi = htmlspecialchars($this->input->post("posisi", true));
               $ket_posisi = htmlspecialchars($this->input->post("ket"));
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

               $cekposisi = $this->pss->cek_posisi($id_perusahaan, $id_depart, $posisi);
               if ($cekposisi) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Posisi sudah digunakan"));
                    return;
               }

               $data = [
                    'posisi' => $posisi,
                    'id_depart' => $id_depart,
                    'ket_posisi' => $ket_posisi,
                    'stat_posisi' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user'),
                    'id_perusahaan' => $id_perusahaan
               ];

               $posisi = $this->pss->input_posisi($data);
               if ($posisi) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Posisi berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Posisi gagal disimpan"));
               }
          }
     }

     public function hapus_posisi()
     {
          $auth_posisi = htmlspecialchars(trim($this->input->post('authposisi')));
          $query = $this->pss->hapus_posisi($auth_posisi);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Posisi berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Posisi gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Posisi tidak ditemukan"));
               return;
          }
     }

     public function detail_posisi()
     {
          $auth_posisi = htmlspecialchars(trim($this->input->post("authposisi")));
          $query = $this->pss->get_posisi_id($auth_posisi);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_posisi == "T") {
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
                         'posisi' => $list->posisi,
                         'depart' =>  $list->depart,
                         'auth_depart' => $auth_depart,
                         'ket' => $list->ket_posisi,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_posisi', $list->id_posisi);
                    $this->session->set_userdata('id_perusahaan', $list->id_perusahaan);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "posisi tidak ditemukan"));
          }
     }

     public function edit_posisi()
     {
          $this->form_validation->set_rules("posisi", "posisi", "required|trim|max_length[100]", [
               'required' => 'posisi wajib diisi',
               'max_length' => 'posisi maksimal 100 karakter'
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
                    'depart' => form_error("depart"),
                    'posisi' => form_error("posisi"),
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

               if ($this->session->userdata('id_posisi') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Posisi tidak ditemukan"));
                    return;
               }

               if ($this->session->userdata('id_depart') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Departemen tidak ditemukan"));
                    return;
               }

               $posisi = htmlspecialchars($this->input->post("posisi", true));
               $depart = htmlspecialchars($this->input->post("depart", true));
               $ket_posisi = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }
               $posisi = $this->pss->edit_posisi($posisi, $depart, $ket_posisi, $status);
               if ($posisi == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Posisi berhasil diupdate"));
               } else if ($posisi == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Posisi gagal diupdate"));
               } else if ($posisi == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "Posisi sudah digunakan"));
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
               $output = "<option value=''>-- DEPARTEMEN TIDAK DITEMUKAN --</option>";
               echo json_encode(array("statusCode" => 200, "depart" => $output, "pesan", "Departemen gagal ditampilkan"));
          }
     }

     public function get_by_authdepart()
     {
          $auth_depart = $this->input->post('auth_depart');

          $query = $this->pss->get_by_authdepart($auth_depart);
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_posisi . "'>" . $list->posisi . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "posisi" => $output));
          } else {
               $output = "<option value=''>-- POSISI TIDAK DITEMUKAN --</option>";
               echo json_encode(array("statusCode" => 201, "posisi" => $output));
          }
     }
}
