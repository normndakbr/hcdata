<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasipenerimaan extends My_Controller
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
          $this->load->view('dashboard/lokterima/lokterima');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/lokterima');
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
          $this->load->view('dashboard/lokterima/lokterima_add');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/lokterima');
     }

     public function ajax_list()
     {
          $auth_per = $this->input->get("auth_per");
          $list = $this->lkt->get_datatables($auth_per);
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $lkt) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_lokterima'] = $lkt->auth_lokterima;
               $row['kd_lokterima'] = $lkt->kd_lokterima;
               $row['lokterima'] = $lkt->lokterima;
               $row['jenis_lokasi'] = $lkt->jenis_lokasi;
               $row['ket_lokterima'] = $lkt->ket_lokterima;

               if ($lkt->stat_lokterima == "T") {
                    $row['stat_lokterima'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_lokterima'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['kode_perusahaan'] = $lkt->kode_perusahaan;
               $row['tgl_buat'] = date('d-M-Y', strtotime($lkt->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($lkt->tgl_edit));
               $row['proses'] = '<button id="' . $lkt->auth_lokterima . '" class="btn btn-primary btn-sm font-weight-bold dtllokterima" title="Detail" value="' . $lkt->lokterima . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $lkt->auth_lokterima . '" class="btn btn-warning btn-sm font-weight-bold edttlokterima" title="Edit" value="' . $lkt->lokterima . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $lkt->auth_lokterima . '" class="btn btn-danger btn-sm font-weight-bold hpslokterima" title="Hapus" value="' . $lkt->lokterima . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->lkt->count_all(),
               "recordsFiltered" => $this->lkt->count_filtered($auth_per),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_lokterima()
     {

          $this->form_validation->set_rules("prs", "prs", "required|trim", [
               'required' => 'Perusahaan wajib dipilih'
          ]);
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("lokterima", "lokterima", "required|trim|max_length[100]", [
               'required' => 'Lokasi penerimaan wajib diisi',
               'max_length' => 'Lokasi penerimaan maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("jenislokasi", "jenislokasi", "required|trim|max_length[20]", [
               'required' => 'Jenis lokasi wajib diisi',
               'max_length' => 'Jenis lokasi maksimal 20 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'prs' => form_error("prs"),
                    'kode' => form_error("kode"),
                    'lokterima' => form_error("lokterima"),
                    'jenislokasi' => form_error("jenislokasi"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $auth_perusahaan = htmlspecialchars($this->input->post("prs", true));
               $kd_lokterima = htmlspecialchars($this->input->post("kode", true));
               $lokterima = htmlspecialchars($this->input->post("lokterima", true));
               $jenislokasi = htmlspecialchars($this->input->post("jenislokasi", true));
               $ket_lokterima = htmlspecialchars($this->input->post("ket", true));
               $id_perusahaan = $this->prs->get_by_auth($auth_perusahaan);

               if ($id_perusahaan == 0) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               $cekkode = $this->lkt->cek_kode($id_perusahaan, $kd_lokterima);
               if ($cekkode) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Kode sudah digunakan"));
                    return;
               }

               $ceklokterima = $this->lkt->cek_lokterima($id_perusahaan, $lokterima);
               if ($ceklokterima) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Lokasi penerimaan sudah digunakan"));
                    return;
               }

               $data = [
                    'kd_lokterima' => $kd_lokterima,
                    'lokterima' => $lokterima,
                    'jenis_lokasi' => $jenislokasi,
                    'ket_lokterima' => $ket_lokterima,
                    'stat_lokterima' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user'),
                    'id_perusahaan' => $id_perusahaan
               ];

               $lokterima = $this->lkt->input_lokterima($data);
               if ($lokterima) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Lokasi penerimaan berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Lokasi penerimaan gagal disimpan"));
               }
          }
     }

     public function hapus_lokterima()
     {
          $auth_lokterima = htmlspecialchars(trim($this->input->post('auth_lokterima')));
          $query = $this->lkt->hapus_lokterima($auth_lokterima);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Lokasi penerimaan berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Lokasi penerimaan gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Lokasi penerimaan tidak ditemukan"));
               return;
          }
     }

     public function detail_lokterima()
     {
          $auth_lokterima = htmlspecialchars(trim($this->input->post("auth_lokterima")));
          $query = $this->lkt->get_lokterima_id($auth_lokterima);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_lokterima == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'nama_perusahaan' => $list->nama_perusahaan,
                         'kode' => $list->kd_lokterima,
                         'lokterima' => $list->lokterima,
                         'ket' => $list->ket_lokterima,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_lokterima', $list->id_lokterima);
                    $this->session->set_userdata('id_perusahaan_lokterima', $list->id_perusahaan);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "Lokasi penerimaan tidak ditemukan"));
          }
     }

     public function edit_lokterima()
     {
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("lokterima", "lokterima", "required|trim|max_length[100]", [
               'required' => 'Lokasi penerimaan wajib diisi',
               'max_length' => 'Lokasi penerimaan maksimal 100 karakter'
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
                    'lokterima' => form_error("lokterima"),
                    'status' => form_error("status")
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_perusahaan') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               if ($this->session->userdata('id_lokterima') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Lokasi penerimaan tidak ditemukan"));
                    return;
               }

               $kd_lokterima = htmlspecialchars($this->input->post("kode", true));
               $lokterima = htmlspecialchars($this->input->post("lokterima", true));
               $ket_lokterima = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $lokterima = $this->lkt->edit_lokterima($kd_lokterima, $lokterima, $ket_lokterima, $status);
               if ($lokterima == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Lokasi penerimaan berhasil diupdate"));
               } else if ($lokterima == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Lokasi penerimaan gagal diupdate"));
               } else if ($lokterima == 203) {
                    echo json_encode(array("statusCode" => 203, "pesan" => "Kode sudah digunakan"));
               } else if ($lokterima == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "Lokasi penerimaan sudah digunakan"));
               }
          }
     }

     public function get_all()
     {
          $query = $this->lkt->get_all();
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_lokterima . "'>" . $list->lokterima . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "lkt" => $output));
          } else {
               $output = "<option value=''>-- LOKASI PENERIMAAN TIDAK ADA --</option>";
               echo json_encode(array("statusCode" => 201, "lkt" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->lkt->get_by_authper($auth_per);
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_lokterima . "'>" . $list->lokterima . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "lkt" => $output));
          } else {
               $output = "<option value=''>-- LOKASI PENERIMAAN TIDAK ADA --</option>";
               echo json_encode(array("statusCode" => 201, "lkt" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_lokterima') != "") {
               $id_per = $this->session->userdata('id_perusahaan_lokterima');
               $output = "<option value=''>-- WAJIB DIPILIH --</option>";
               $query = $this->lkt->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_lokterima . "'>" . $list->lokterima . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "lokterima" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- LOKASI PENERIMAAN TIDAK ADA --</option>";
               echo json_encode(array("statusCode" => 200, "lokterima" => $output, "pesan", "Lokasi penerimaan gagal ditampilkan"));
          }
     }
}
