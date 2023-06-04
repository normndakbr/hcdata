<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roster extends My_Controller
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
          $this->load->view('dashboard/roster/roster');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/roster');
     }

     public function new()
     {
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/roster/roster_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/roster');
     }

     public function ajax_list()
     {
          $list = $this->rst->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $rst) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_roster'] = $rst->auth_roster;
               $row['kd_roster'] = $rst->kd_roster;
               $row['roster'] = $rst->roster;
               $row['jml_hari_onsite'] = intval($rst->jml_hari_onsite) . " Hari";
               $row['jml_hari_offsite'] = intval($rst->jml_hari_offsite) . " Hari";
               $row['ket_roster'] = $rst->ket_roster;

               if ($rst->stat_roster == "T") {
                    $row['stat_roster'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_roster'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['kode_perusahaan'] = $rst->kode_perusahaan;
               $row['tgl_buat'] = date('d-M-Y', strtotime($rst->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($rst->tgl_edit));
               $row['proses'] = '<button id="' . $rst->auth_roster . '" class="btn btn-primary btn-sm font-weight-bold dtlroster" title="Detail" value="' . $rst->roster . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $rst->auth_roster . '" class="btn btn-warning btn-sm font-weight-bold edttroster" title="Edit" value="' . $rst->roster . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $rst->auth_roster . '" class="btn btn-danger btn-sm font-weight-bold hpsroster" title="Hapus" value="' . $rst->roster . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->rst->count_all(),
               "recordsFiltered" => $this->rst->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_roster()
     {

          $this->form_validation->set_rules("prs", "prs", "required|trim", [
               'required' => 'Perusahaan wajib dipilih'
          ]);
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("roster", "roster", "required|trim|max_length[100]", [
               'required' => 'Roster wajib diisi',
               'max_length' => 'Roster maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("masa_onsite", "masa_onsite", "required|trim|max_length[4]|greater_than[1]", [
               'required' => 'Masa onsite wajib diisi',
               'max_length' => 'Masa onsite maksimal 4 karakter',
               'greater_than' => 'Masa Offsite minimal 1 hari'
          ]);
          $this->form_validation->set_rules("masa_offsite", "masa_offsite", "required|trim|max_length[4]|greater_than[1]", [
               'required' => 'Masa offsite wajib diisi',
               'max_length' => 'Masa offsite maksimal 4 karakter',
               'greater_than' => 'Masa Offsite minimal 1 hari'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'prs' => form_error("prs"),
                    'kode' => form_error("kode"),
                    'roster' => form_error("roster"),
                    'masa_onsite' => form_error("masa_onsite"),
                    'masa_offsite' => form_error("masa_offsite")
               ];

               echo json_encode($error);
               return;
          } else {
               $auth_perusahaan = htmlspecialchars($this->input->post("prs", true));
               $kd_roster = htmlspecialchars($this->input->post("kode", true));
               $roster = htmlspecialchars($this->input->post("roster", true));
               $masa_onsite = intval(htmlspecialchars($this->input->post("masa_onsite", true)));
               $masa_offsite = intval(htmlspecialchars($this->input->post("masa_offsite", true)));
               $ket_roster = htmlspecialchars($this->input->post("ket"));
               $id_perusahaan = $this->prs->get_by_auth($auth_perusahaan);

               if ($id_perusahaan == 0) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               $cekkode = $this->rst->cek_kode($id_perusahaan, $kd_roster);
               if ($cekkode) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Kode sudah digunakan"));
                    return;
               }

               $cekroster = $this->rst->cek_roster($id_perusahaan, $roster);
               if ($cekroster) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Roster sudah digunakan"));
                    return;
               }

               $data = [
                    'kd_roster' => $kd_roster,
                    'roster' => $roster,
                    'jml_hari_onsite' => $masa_onsite,
                    'jml_hari_offsite' => $masa_offsite,
                    'ket_roster' => $ket_roster,
                    'stat_roster' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user'),
                    'id_perusahaan' => $id_perusahaan
               ];

               $roster = $this->rst->input_roster($data);
               if ($roster) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Roster berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Roster gagal disimpan"));
               }
          }
     }

     public function hapus_roster()
     {
          $auth_roster = htmlspecialchars(trim($this->input->post('auth_roster')));
          $query = $this->rst->hapus_roster($auth_roster);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Roster berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Roster gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Roster tidak ditemukan"));
               return;
          }
     }

     public function detail_roster()
     {
          $auth_roster = htmlspecialchars(trim($this->input->post("auth_roster")));
          $query = $this->rst->get_roster_id($auth_roster);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_roster == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'nama_perusahaan' => $list->nama_perusahaan,
                         'kode' => $list->kd_roster,
                         'roster' => $list->roster,
                         'masa_onsite' => $list->jml_hari_onsite,
                         'masa_offsite' => $list->jml_hari_offsite,
                         'ket' => $list->ket_roster,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_roster', $list->id_roster);
                    $this->session->set_userdata('id_perusahaan_roster', $list->id_perusahaan);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "Roster tidak ditemukan"));
          }
     }

     public function edit_roster()
     {
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("roster", "roster", "required|trim|max_length[100]", [
               'required' => 'roster wajib diisi',
               'max_length' => 'roster maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("masa_onsite", "masa_onsite", "required|trim|max_length[3]|greater_than[1]", [
               'required' => 'Masa onsite wajib diisi',
               'max_length' => 'Masa onsite maksimal 999 hari',
               'greater_than' => 'Masa Offsite minimal 1 hari'
          ]);
          $this->form_validation->set_rules("masa_offsite", "masa_offsite", "required|trim|max_length[3]|greater_than[1]", [
               'required' => 'Masa offsite wajib diisi',
               'max_length' => 'Masa offsite maksimal 999 hari',
               'greater_than' => 'Masa Offsite minimal 1 hari'
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
                    'roster' => form_error("roster"),
                    'masa_onsite' => form_error("masa_onsite"),
                    'masa_offsite' => form_error("masa_offsite"),
                    'ket' => form_error("ket"),
                    'status' => form_error("status")
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_perusahaan_roster') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               if ($this->session->userdata('id_roster') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Roster tidak ditemukan"));
                    return;
               }

               $kd_roster = htmlspecialchars($this->input->post("kode", true));
               $roster = htmlspecialchars($this->input->post("roster", true));
               $masa_onsite = intval(htmlspecialchars($this->input->post("masa_onsite", true)));
               $masa_offsite = intval(htmlspecialchars($this->input->post("masa_offsite", true)));
               $ket_roster = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $roster = $this->rst->edit_roster($kd_roster, $roster,  $masa_onsite,  $masa_offsite, $ket_roster, $status);
               if ($roster == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Roster berhasil diupdate"));
               } else if ($roster == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Roster gagal diupdate"));
               } else if ($roster == 203) {
                    echo json_encode(array("statusCode" => 203, "pesan" => "Kode sudah digunakan"));
               } else if ($roster == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "Roster sudah digunakan"));
               }
          }
     }

     public function get_all()
     {
          $query = $this->rst->get_all();
          $output = "<option value=''>-- Pilih roster --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_roster . "'>" . $list->roster . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "rst" => $output));
          } else {
               $output = "<option value=''>-- Roster tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "rst" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->rst->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih roster --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_roster . "'>" . $list->roster . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "rst" => $output));
          } else {
               $output = "<option value=''>-- Roster tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "rst" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_roster') != "") {
               $id_per = $this->session->userdata('id_perusahaan_roster');
               $output = "<option value=''>-- Pilih roster --</option>";
               $query = $this->rst->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_roster . "'>" . $list->roster . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "roster" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- Roster tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "roster" => $output, "pesan", "Roster gagal ditampilkan"));
          }
     }
}
