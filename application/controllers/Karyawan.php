<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends My_Controller
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
          $this->load->view('dashboard/karyawan/karyawan');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/karyawan');
     }

     public function new()
     {
          if ($this->session->has_userdata('idkaryawan')) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Tambah data karyawan sedang digunakan"));
               return;
          } else {
               $newdata = array(
                    'idkaryawan',
                    'idpersonal',
                    'idalamat',
                    'idizin',
                    'unit_izin',
                    'unit_izin_text',
                    'idmcu'
               );

               if ($this->session->flashdata("kary_sukses") != "") {
                    $this->session->set_flashdata('psn', '<div class="alert alert-primary suksesalrt animate__animated animate__bounce mb-2" role="alert"> Data karyawan berhasil disimpan </div>');
               }

               $this->session->unset_userdata($newdata);
               $data['nama'] = $this->session->userdata("nama");
               $data['email'] = $this->session->userdata("email");
               $data['menu'] = $this->session->userdata("id_menu");
               $this->load->view('dashboard/template/header', $data);
               $this->load->view('dashboard/karyawan/karyawan_add');
               $this->load->view('dashboard/template/footer', $data);
               $this->load->view('dashboard/code/karyawan');
          }
     }

     public function izin_tambang()
     {
          $this->load->view('dashboard/karyawan/izin_tambang');
     }

     public function sertifikasi()
     {
          $data['sert'] = $this->srt->tabel_sertifikasi();
          $this->load->view('dashboard/karyawan/sertifikasi', $data);
     }

     public function vaksin()
     {
          $data['vaks'] = $this->vks->tabel_vaksin();
          $this->load->view('dashboard/karyawan/vaksin', $data);
     }

     public function detail_karyawan($id_kary)
     {
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $data["data_kary"] = $this->kry->get_by_auth($id_kary);
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/karyawan/karyawan_detail', $data);
          $this->load->view('dashboard/modal/karyawan');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/karyawan');
     }

     public function addpersonal()
     {
          $this->form_validation->set_rules("noktp", "noktp", "required|trim|numeric|max_length[16]|min_length[16]", [
               'required' => 'No. KTP wajib diisi',
               'numeric' => 'Wajib diisi dengan angka',
               'max_length' => 'No. KTP maksimal 16 karakter',
               'min_length' => 'No. KTP minimal 16 karakter'
          ]);
          $this->form_validation->set_rules("nama", "nama", "required|trim", [
               'required' => 'Nama wajib dipilih'
          ]);
          $this->form_validation->set_rules("alamat", "alamat", "required|trim|max_length[1000]", [
               'required' => 'Alamat wajib diisi',
               'max_length' => 'Alamat maksimal 1000 karakter'
          ]);
          $this->form_validation->set_rules("rt", "rt", "trim|max_length[3]", [
               'max_length' => 'No. RT maksimal 3 karakter'
          ]);
          $this->form_validation->set_rules("rw", "rw", "trim|max_length[3]", [
               'max_length' => 'No. RW maksimal 3 karakter'
          ]);
          $this->form_validation->set_rules("id_prov", "id_prov", "required|trim", [
               'required' => 'Provinsi wajib dipilih',
          ]);
          $this->form_validation->set_rules("id_kab", "id_kab", "required|trim", [
               'required' => 'Kabupaten wajib dipilih',
          ]);
          $this->form_validation->set_rules("id_kec", "id_kec", "required|trim", [
               'required' => 'Kecamatan wajib dipilih',
          ]);
          $this->form_validation->set_rules("id_kel", "id_kel", "required|trim", [
               'required' => 'Kelurahan wajib dipilih',
          ]);
          $this->form_validation->set_rules("tmp_lahir", "tmp_lahir", "required|trim|max_length[100]", [
               'required' => 'Tempat lahir wajib diisi',
               'max_length' => 'Tempat Lahir maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("tgl_lahir", "tgl_lahir", "required|trim", [
               'required' => 'Tanggal lahir wajib diisi',
          ]);
          $this->form_validation->set_rules("stat_nikah", "stat_nikah", "required|trim", [
               'required' => 'Status pernikahan wajib diisi',
          ]);
          $this->form_validation->set_rules("id_agama", "id_agama", "required|trim", [
               'required' => 'Agama wajib dipilih',
          ]);
          $this->form_validation->set_rules("warga", "warga", "required|trim", [
               'required' => 'Warga negara wajib diisi',
          ]);
          $this->form_validation->set_rules("jk", "jk", "required|trim", [
               'required' => 'Jenis kelamin wajib dipilih',
          ]);
          $this->form_validation->set_rules("email", "email", "trim|valid_email", [
               'valid_email' => 'Format email salah',
          ]);
          $this->form_validation->set_rules("telp", "telp", "trim");
          $this->form_validation->set_rules("bpjs_tk", "bpjs_tk", "trim");
          $this->form_validation->set_rules("bpjs_kes", "bpjs_kes", "trim");
          $this->form_validation->set_rules("no_equity", "no_equity", "trim");
          $this->form_validation->set_rules("npwp", "npwp", "trim");
          $this->form_validation->set_rules("nokk", "nokk", "required|trim|max_length[16]|min_length[16]", [
               'required' => 'No. Kartu Keluarga wajib diisi',
               'numeric' => 'Wajib diisi dengan angka',
               'max_length' => 'No. Kartu Keluarga maksimal 16 karakter',
               'min_length' => 'No. Kartu Keluarga minimal 16 karakter'
          ]);
          $this->form_validation->set_rules("namaibu", "namaibu", "required|trim|max_length[100]", [
               'required' => 'Nama ibu kandung wajib diisi',
               'max_length' => 'Nama ibu kandung maksimal 100 karakter',
          ]);

          if ($this->form_validation->run() == false) {
               $npwp = htmlspecialchars($this->input->post("npwp", true));
               $npwp_num = str_replace([".", "-", "_"], "", $npwp);
               $jml_npwp = strlen($npwp_num);
               if ($npwp != "") {
                    if ($jml_npwp < 15) {
                         $errnpwp = "<p>NPWP tidak boleh kurang dari 15 karakter</p>";
                    } else {
                         $errnpwp = "";
                    }
               } else {
                    $errnpwp = "";
               }

               $error = [
                    'statusCode' => 202,
                    'noktp' => form_error("noktp"),
                    'nama' => form_error("nama"),
                    'alamat' => form_error("alamat"),
                    'rt' => form_error("rt"),
                    'rw' => form_error("rw"),
                    'id_prov' => form_error("id_prov"),
                    'id_kab' => form_error("id_kab"),
                    'id_kec' => form_error("id_kec"),
                    'id_kel' => form_error("id_kel"),
                    'tmp_lahir' => form_error("tmp_lahir"),
                    'tgl_lahir' => form_error("tgl_lahir"),
                    'stat_nikah' => form_error("stat_nikah"),
                    'id_agama' => form_error("id_agama"),
                    'warga' => form_error("warga"),
                    'jk' => form_error("jk"),
                    'email' => form_error("email"),
                    'telp' => form_error("telp"),
                    'bpjs_tk' => form_error("bpjs_tk"),
                    'bpjs_kes' => form_error("bpjs_kes"),
                    'no_equity' => form_error("no_equity"),
                    'npwp' => $errnpwp,
                    'nokk' => form_error("nokk"),
                    'namaibu' => form_error("namaibu")
               ];

               echo json_encode($error);
               return;
          } else {
               $noktp = htmlspecialchars($this->input->post("noktp", true));
               $nokk = htmlspecialchars($this->input->post("nokk", true));

               if ($this->session->has_userdata('idpersonal')) {
                    $no_ktp = $this->session->userdata('noktp');
                    $no_kk = $this->session->userdata('nokk');

                    if ($no_ktp != $noktp) {
                         $query = $this->kry->cek_noKTP($noktp);
                         if ($query) {
                              echo json_encode(array("statusCode" => 201, "pesan" => "No. KTP sudah digunakan"));
                              return;
                         }
                    }

                    if ($no_kk != $nokk) {
                         $query = $this->kry->cek_noKK($nokk);
                         if ($query) {
                              echo json_encode(array("statusCode" => 201, "pesan" => "No. Kartu Keluarga sudah digunakan"));
                              return;
                         }
                    }
               } else {
                    $query = $this->kry->cek_noKTP($noktp);
                    if ($query) {
                         echo json_encode(array("statusCode" => 201, "pesan" => "No. KTP sudah digunakan"));
                         return;
                    }

                    $query = $this->kry->cek_noKK($nokk);
                    if ($query) {
                         echo json_encode(array("statusCode" => 201, "pesan" => "No. Kartu Keluarga sudah digunakan"));
                         return;
                    }
               }

               echo json_encode(array("statusCode" => 200, "pesan" => "Sukses"));
          }
     }

     function get_id_depart($auth_depart)
     {
          $query = $this->dprt->get_id_depart($auth_depart);
          if ($query === 0) {
               return 0;
          } else {
               return $query;
          }
     }

     function get_id_posisi($auth_posisi)
     {
          $query = $this->pss->get_id_posisi($auth_posisi);
          if ($query === 0) {
               return 0;
          } else {
               return $query;
          }
     }

     function get_id_lokterima($auth_lokterima)
     {
          $query = $this->lkt->get_id_lokterima($auth_lokterima);
          if ($query === 0) {
               return 0;
          } else {
               return $query;
          }
     }

     function get_id_lokker($auth_lokker)
     {
          $query = $this->lkr->get_id_lokker($auth_lokker);
          if ($query === 0) {
               return 0;
          } else {
               return $query;
          }
     }

     function get_id_poh($auth_poh)
     {
          $query = $this->pho->get_id_poh($auth_poh);
          if ($query === 0) {
               return 0;
          } else {
               return $query;
          }
     }

     function get_id_tipe($auth_tipe)
     {
          $query = $this->tpe->get_id_tipe($auth_tipe);
          if ($query === 0) {
               return 0;
          } else {
               return $query;
          }
     }

     public function addkaryawan()
     {
          $this->form_validation->set_rules("no_nik", "no_nik", "required|trim|numeric|max_length[25]", [
               'required' => 'NIK wajib diisi',
               'numeric' => 'Wajib diisi dengan angka',
               'max_length' => 'NIK maksimal 25 karakter'
          ]);
          $this->form_validation->set_rules("depart", "depart", "required|trim", [
               'required' => 'Departemen wajib dipilih'
          ]);
          $this->form_validation->set_rules("posisi", "posisi", "required|trim", [
               'required' => 'Posisi wajib dipilih',
          ]);
          $this->form_validation->set_rules("doh", "doh", "required|trim", [
               'required' => 'Date of Hire wajib diisi',
          ]);
          $this->form_validation->set_rules("doh", "doh", "required|trim", [
               'required' => 'Date of Hire wajib diisi',
          ]);
          $this->form_validation->set_rules("tgl_aktif", "tgl_aktif", "required|trim", [
               'required' => 'Tanggal aktif wajib diisi',
          ]);
          $this->form_validation->set_rules("id_lokker", "id_lokker", "required|trim", [
               'required' => 'Lokasi kerja wajib dipilih',
          ]);
          $this->form_validation->set_rules("id_lokterima", "id_lokterima", "required|trim", [
               'required' => 'Lokasi penerimaan wajib dipilih',
          ]);
          $this->form_validation->set_rules("id_poh", "id_poh", "required|trim", [
               'required' => 'Point of Hire wajib dipilih',
          ]);
          $this->form_validation->set_rules("id_klasifikasi", "id_klasifikasi", "required|trim", [
               'required' => 'Klasifikasi wajib dipilih',
          ]);
          $this->form_validation->set_rules("id_tipe", "id_tipe", "required|trim", [
               'required' => 'Tipe wajib dipilih',
          ]);
          $this->form_validation->set_rules("id_grade", "id_grade", "required|trim", [
               'required' => 'Grade wajib dipilih',
          ]);
          $this->form_validation->set_rules("stat_tinggal", "stat_tinggal", "required|trim", [
               'required' => 'Warga negara wajib diisi',
          ]);
          $this->form_validation->set_rules("stat_kerja", "stat_kerja", "required|trim", [
               'required' => 'Status karyawan wajib dipilih',
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'no_nik' => form_error("no_nik"),
                    'depart' => form_error("depart"),
                    'posisi' => form_error("posisi"),
                    'doh' => form_error("doh"),
                    'tgl_aktif' => form_error("tgl_aktif"),
                    'id_lokker' => form_error("id_lokker"),
                    'id_lokterima' => form_error("id_lokterima"),
                    'id_poh' => form_error("id_poh"),
                    'id_klasifikasi' => form_error("id_klasifikasi"),
                    'id_tipe' => form_error("id_tipe"),
                    'id_grade' => form_error("id_grade"),
                    'stat_tinggal' => form_error("stat_tinggal"),
                    'stat_kerja' => form_error("stat_kerja"),
                    'tgl_mulai_kontrak' => form_error("tgl_mulai_kontrak"),
                    'tgl_akhir_kontrak' => form_error("tgl_akhir_kontrak")
               ];

               echo json_encode($error);
               return;
          } else {
               //personal
               $noktp = htmlspecialchars($this->input->post("noktp", true));
               $nokk = htmlspecialchars($this->input->post("nokk", true));
               $nama = htmlspecialchars($this->input->post("nama", true));
               $alamat = htmlspecialchars($this->input->post("alamat", true));
               $rt = htmlspecialchars($this->input->post("rt", true));
               $rw = htmlspecialchars($this->input->post("rw", true));
               $id_prov = htmlspecialchars($this->input->post("id_prov", true));
               $id_kab = htmlspecialchars($this->input->post("id_kab", true));
               $id_kec = htmlspecialchars($this->input->post("id_kec", true));
               $id_kel = htmlspecialchars($this->input->post("id_kel", true));
               $tmp_lahir = htmlspecialchars($this->input->post("tmp_lahir", true));
               $tgl_lahir = htmlspecialchars($this->input->post("tgl_lahir", true));
               $stat_nikah = htmlspecialchars($this->input->post("stat_nikah", true));
               $id_agama = htmlspecialchars($this->input->post("id_agama", true));
               $warga = htmlspecialchars($this->input->post("warga", true));
               $jk = htmlspecialchars($this->input->post("jk", true));
               $email = htmlspecialchars($this->input->post("email", true));
               $telp = htmlspecialchars($this->input->post("telp", true));
               $bpjs_tk = htmlspecialchars($this->input->post("bpjs_tk", true));
               $bpjs_kes = htmlspecialchars($this->input->post("bpjs_kes", true));
               $npwp = htmlspecialchars($this->input->post("npwp", true));
               $namaibu = htmlspecialchars($this->input->post("namaibu", true));
               $id_pendidikan = htmlspecialchars($this->input->post("id_pendidikan", true));

               //karyawan
               $no_nik = htmlspecialchars($this->input->post("no_nik", true));
               $auth_depart = htmlspecialchars($this->input->post("depart", true));
               $auth_posisi = htmlspecialchars($this->input->post("posisi", true));
               $auth_lokker = htmlspecialchars($this->input->post("id_lokker", true));
               $auth_lokterima = htmlspecialchars($this->input->post("id_lokterima", true));
               $auth_poh = htmlspecialchars($this->input->post("id_poh", true));
               $id_klasifikasi = htmlspecialchars($this->input->post("id_klasifikasi", true));
               $id_tipe = htmlspecialchars($this->input->post("id_tipe", true));
               $id_grade = htmlspecialchars($this->input->post("id_grade", true));
               $doh = htmlspecialchars($this->input->post("doh", true));
               $tgl_aktif = htmlspecialchars($this->input->post("tgl_aktif", true));
               $stat_tinggal = htmlspecialchars($this->input->post("stat_tinggal", true));
               $stat_kerja = htmlspecialchars($this->input->post("stat_kerja", true));
               $tgl_permanen = htmlspecialchars($this->input->post("tgl_permanen", true));
               $tgl_mulai_kontrak = htmlspecialchars($this->input->post("tgl_mulai_kontrak", true));
               $tgl_akhir_kontrak = htmlspecialchars($this->input->post("tgl_akhir_kontrak", true));
               $id_m_perusahaan = htmlspecialchars($this->input->post("id_m_perusahaan", true));

               $query = $this->get_stat_kerja($stat_kerja);
               if ($query == "T") {
                    if ($tgl_mulai_kontrak == "" && $tgl_akhir_kontrak == "") {
                         echo json_encode(array("statusCode" => 202, "pesan" => "", "pesan1" => "Tanggal mulai wajib diisi", "pesan2" => "Tanggal akhir wajib diisi"));
                         return;
                    }
                    if ($tgl_mulai_kontrak == "") {
                         echo json_encode(array("statusCode" => 202, "pesan" => "", "pesan1" => "Tanggal mulai wajib diisi", "pesan2" => ""));
                         return;
                    }
                    if ($tgl_akhir_kontrak == "") {
                         echo json_encode(array("statusCode" => 202, "pesan" => "", "pesan1" => "", "pesan2" => "Tanggal akhir wajib diisi"));
                         return;
                    }
               } else if ($query == "F") {
                    if ($tgl_permanen == "") {
                         echo json_encode(array("statusCode" => 202, "pesan" => "Tanggal permanen wajib diisi", "pesan1" => "", "pesan2" => ""));
                         return;
                    }
               } else {
                    echo json_encode(array("statusCode" => 202, "pesan" => "Kesalahan saat mengambil status kerja", "pesan1" => "", "pesan2" => ""));
                    return;
               }

               if ($this->session->has_userdata('idpersonal')) {
                    $idpersonal = $this->session->userdata('idpersonal');
                    $idkaryawan = $this->session->userdata('idkaryawan');
                    $idalamat = $this->session->userdata('idalamat');
                    $nonik = $this->session->userdata('nonik');

                    if ($nonik != $no_nik) {
                         $id_m_per = $this->prs->get_m_by_auth($id_m_perusahaan);
                         $query = $this->kry->cek_nik($no_nik, $id_m_per);
                         if ($query) {
                              echo json_encode(array("statusCode" => 202, "no_nik" => "NIK sudah digunakan", "pesan1" => "", "pesan2" => ""));
                              die;
                         }
                    }

                    $dt_personal = array(
                         'no_ktp' => $noktp,
                         'no_kk' => $nokk,
                         'nama_lengkap' => $nama,
                         'nama_alias' => '',
                         'jk' => $jk,
                         'tmp_lahir' => $tmp_lahir,
                         'tgl_lahir' => $tgl_lahir,
                         'id_stat_nikah' => $stat_nikah,
                         'id_agama' => $id_agama,
                         'warga_negara' => $warga,
                         'email_pribadi' => $email,
                         'hp_1' => $telp,
                         'hp_2' => 0,
                         'nama_ibu' => $namaibu,
                         'stat_ibu' => '',
                         'nama_ayah' => '',
                         'stat_ayah' => '',
                         'no_bpjstk' => $bpjs_tk,
                         'no_bpjskes' => $bpjs_kes,
                         'no_bpjspensiun' => '',
                         'no_equity' => '',
                         'no_npwp' => $npwp,
                         'id_pendidikan' => $id_pendidikan,
                         'nama_sekolah' => '',
                         'fakultas' => '',
                         'jurusan' => ''
                    );

                    $this->kry->update_dtPersonal($idpersonal, $dt_personal);

                    $data_al = array(
                         'alamat_ktp' => $alamat,
                         'rt_ktp' => $rt,
                         'rw_ktp' => $rw,
                         'kel_ktp' => $id_kel,
                         'kec_ktp' => $id_kec,
                         'kab_ktp' => $id_kab,
                         'prov_ktp' => $id_prov,
                         'kode_pos_ktp' => 0,
                         'ket_alamat_ktp' => '',
                         'stat_alamat_ktp' => 'T'
                    );

                    $this->kry->update_dtAlamat($idalamat, $data_al);

                    $id_m_perusahaan = $this->prs->get_m_by_auth($id_m_perusahaan);
                    $id_depart = $this->get_id_depart($auth_depart);
                    $id_posisi = $this->get_id_posisi($auth_posisi);
                    $id_lokterima = $this->get_id_lokterima($auth_lokterima);
                    $id_lokker = $this->get_id_lokker($auth_lokker);
                    $id_poh = $this->get_id_poh($auth_poh);

                    $data_kry = array(
                         'id_perkerjaan' => 0,
                         'no_acr' => 0,
                         'no_nik' => $no_nik,
                         'doh' => $doh,
                         'tgl_aktif' => $tgl_aktif,
                         'id_depart' => $id_depart,
                         'id_section' => 0,
                         'id_posisi' => $id_posisi,
                         'id_grade' => $id_grade,
                         'id_level' => 0,
                         'id_lokker' => $id_lokker,
                         'id_lokterima' => $id_lokterima,
                         'id_poh' => $id_poh,
                         'id_roster' => 0,
                         'id_klasifikasi' => $id_klasifikasi,
                         'paybase' => 0,
                         'statpajak' => 0,
                         'id_tipe' => $id_tipe,
                         'stat_tinggal' => $stat_tinggal,
                         'stat_kerja' => $stat_kerja,
                         'tgl_permanen' => $tgl_permanen,
                         'stat_karyawan' => $stat_kerja,
                         'id_m_perusahaan' => $id_m_perusahaan
                    );

                    $this->kry->update_dtkary($idkaryawan, $data_kry);
                    // echo json_encode(array("asd" => $data_kry));
                    // return;

                    $newdata = array(
                         'noktp' => $noktp,
                         'nokk' => $nokk,
                         'nonik' => $no_nik
                    );
                    $this->session->set_userdata($newdata);

                    echo json_encode(array("statusCode" => 200, "pesan" => "Data karyawan berhasil diupdate "));
               } else {
                    $id_m_per = $this->prs->get_m_by_auth($id_m_perusahaan);
                    $query = $this->kry->cek_nik($no_nik, $id_m_per);
                    if ($query) {
                         echo json_encode(array("statusCode" => 202, "no_nik" => "NIK sudah digunakan", "pesan1" => "", "pesan2" => ""));
                         return;
                    }

                    $data_personal = [
                         'no_ktp' => $noktp,
                         'no_kk' => $nokk,
                         'nama_lengkap' => $nama,
                         'nama_alias' => '',
                         'jk' => $jk,
                         'tmp_lahir' => $tmp_lahir,
                         'tgl_lahir' => $tgl_lahir,
                         'id_stat_nikah' => $stat_nikah,
                         'id_agama' => $id_agama,
                         'warga_negara' => $warga,
                         'email_pribadi' => $email,
                         'hp_1' => $telp,
                         'hp_2' => 0,
                         'nama_ibu' => $namaibu,
                         'stat_ibu' => '',
                         'nama_ayah' => '',
                         'stat_ayah' => '',
                         'no_bpjstk' => $bpjs_tk,
                         'no_bpjskes' => $bpjs_kes,
                         'no_bpjspensiun' => '',
                         'no_equity' => '',
                         'no_npwp' => $npwp,
                         'id_pendidikan' => $id_pendidikan,
                         'nama_sekolah' => '',
                         'fakultas' => '',
                         'jurusan' => '',
                         'tgl_buat' => date('Y-m-d H:i:s'),
                         'tgl_edit' => date('Y-m-d H:i:s'),
                         'id_user' => $this->session->userdata('id_user'),
                    ];

                    $personal = $this->kry->input_dtPersonal($data_personal);
                    if ($personal) {
                         $id_personal = $this->kry->last_row_personal();
                         if ($id_personal === 0) {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Tidak dapat menyimpan alamat"));
                              return;
                         } else {
                              if (is_dir('./assets/berkas/karyawan/' . $id_personal) == false) {
                                   mkdir('./assets/berkas/karyawan/' . $id_personal, 0777, TRUE);
                              }

                              $data = [
                                   'id_personal' => $id_personal,
                                   'alamat_ktp' => $alamat,
                                   'rt_ktp' => $rt,
                                   'rw_ktp' => $rw,
                                   'kel_ktp' => $id_kel,
                                   'kec_ktp' => $id_kec,
                                   'kab_ktp' => $id_kab,
                                   'prov_ktp' => $id_prov,
                                   'kode_pos_ktp' => 0,
                                   'ket_alamat_ktp' => '',
                                   'stat_alamat_ktp' => 'T',
                                   'tgl_buat' => date('Y-m-d H:i:s'),
                                   'tgl_edit' => date('Y-m-d H:i:s'),
                                   'id_user' => $this->session->userdata('id_user'),
                              ];

                              $this->kry->input_dtAlamat($data);
                              $id_alamat = $this->kry->last_row_alamat();
                              $id_m_perusahaan = $this->prs->get_m_by_auth($id_m_perusahaan);
                              $id_depart = $this->get_id_depart($auth_depart);
                              $id_posisi = $this->get_id_posisi($auth_posisi);
                              $id_lokterima = $this->get_id_lokterima($auth_lokterima);
                              $id_lokker = $this->get_id_lokker($auth_lokker);
                              $id_poh = $this->get_id_poh($auth_poh);
                              $id_tipe = $this->get_id_tipe($id_tipe);
                              $data_karyawan = [
                                   'id_personal' => $id_personal,
                                   'id_perkerjaan' => 0,
                                   'no_acr' => 0,
                                   'no_nik' => $no_nik,
                                   'doh' => $doh,
                                   'tgl_aktif' => $tgl_aktif,
                                   'id_depart' => $id_depart,
                                   'id_section' => 0,
                                   'id_posisi' => $id_posisi,
                                   'id_grade' => $id_grade,
                                   'id_level' => 0,
                                   'id_lokker' => $id_lokker,
                                   'id_lokterima' => $id_lokterima,
                                   'id_poh' => $id_poh,
                                   'id_roster' => 0,
                                   'id_klasifikasi' => $id_klasifikasi,
                                   'paybase' => 0,
                                   'statpajak' => 0,
                                   'id_tipe' => $id_tipe,
                                   'stat_tinggal' => $stat_tinggal,
                                   'stat_kerja' => $stat_kerja,
                                   'tgl_permanen' => $tgl_permanen,
                                   'stat_karyawan' => $stat_kerja,
                                   'tgl_nonaktif' => '1970-01-01',
                                   'alasan_nonaktif' => '',
                                   'tgl_buat' =>  date('Y-m-d H:i:s'),
                                   'tgl_edit' =>  date('Y-m-d H:i:s'),
                                   'id_user' => $this->session->userdata('id_user'),
                                   'id_m_perusahaan' => $id_m_perusahaan,
                              ];

                              $karyawan = $this->kry->input_dtKaryawan($data_karyawan);
                              if ($karyawan) {
                                   $id_karyawan = $this->kry->last_row_idkary();
                                   $newdata = array(
                                        'idkaryawan'  => $id_karyawan,
                                        'idpersonal'  => $id_personal,
                                        'idalamat' => $id_alamat,
                                        'noktp' => $noktp,
                                        'nokk' => $nokk,
                                        'nonik' => $no_nik
                                   );
                                   $this->session->set_userdata($newdata);
                                   echo json_encode(array("statusCode" => 200, "pesan" => "Data karyawan berhasil disimpan "));
                              } else {
                                   echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan gagal disimpan"));
                              }
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Data personal gagal disimpan"));
                    }
               }
          }
     }

     public function addsimper()
     {
          $this->form_validation->set_rules("jenisizin", "jenisizin", "required|trim", [
               'required' => 'Jenis Izin wajib dipilih'
          ]);
          $this->form_validation->set_rules("noreg", "noreg", "required|trim|max_length[50]", [
               'required' => 'No. Register wajib diisi',
               'max_length' => 'No. Register maksimal 50 karakter'
          ]);
          $this->form_validation->set_rules("tglexp", "tglexp", "required|trim", [
               'required' => 'Tanggal expired wajib diisi',
          ]);
          $this->form_validation->set_rules("jenissim", "jenissim", "trim");
          $this->form_validation->set_rules("tglexpsim", "tglexpsim", "trim");

          if ($this->form_validation->run() == false) {
               $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
               $jenissim = htmlspecialchars($this->input->post("jenissim", true));
               $tglexpsim = htmlspecialchars($this->input->post("tglexpsim", true));

               if ($jenisizin == "SP") {
                    if ($jenissim == "") {
                         $errjenis = "<p>Jenis SIM wajib dipilih</p>";
                    } else {
                         $errjenis = "";
                    }

                    if ($tglexpsim == "") {
                         $errtglsim = "<p>Tanggal expired SIM wajib diisi</p>";
                    } else {
                         $errtglsim = "";
                    }
               }

               $error = [
                    'statusCode' => 202,
                    'jenisizin' => form_error("jenisizin"),
                    'noreg' => form_error("noreg"),
                    'tglexp' => form_error("tglexp"),
                    'jenissim' => $errjenis,
                    'tglexpsim' => $errtglsim,
               ];

               echo json_encode($error);
               return;
          } else {
               $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
               $noreg = htmlspecialchars($this->input->post("noreg", true));
               $tglexp = htmlspecialchars($this->input->post("tglexp", true));
               $jenissim = htmlspecialchars($this->input->post("jenissim", true));
               $tglexpsim = htmlspecialchars($this->input->post("tglexpsim", true));
               $id_karyawan = $this->session->userdata('idkaryawan');


               if ($tglexpsim == "") {
                    $tglexpsim = "1970-01-01";
               }

               if ($jenisizin == "MP") {
                    $jenissim = 0;
               }

               if ($this->session->has_userdata('idizin')) {
                    $id_izin = $this->session->userdata('idizin');
                    if ($id_izin != "") {
                         $data = array(
                              'jenis_izin_tambang' => $jenisizin,
                              'no_reg' => $noreg,
                              'tgl_expired' => $tglexp,
                              'jenis_sim' => $jenissim,
                              'tgl_exp_sim' => $tglexpsim
                         );

                         $where = array(
                              'id_izin_tambang' => $id_izin
                         );

                         $this->smp->update_izin($where, $data, 'tb_izin_tambang');
                         echo json_encode(array("statusCode" => 200, "pesan" => "Data SIMPER/Mine Permite berhasil diupdate"));
                    }
               } else {
                    if ($id_karyawan != "") {
                         $data_izin_tambang = [
                              'id_kary' => $id_karyawan,
                              'jenis_izin_tambang' => $jenisizin,
                              'no_Reg' => $noreg,
                              'tgl_expired' => $tglexp,
                              'jenis_sim' => $jenissim,
                              'tgl_exp_sim' => $tglexpsim,
                              'ket_izin_tambang' => '',
                              'tgl_buat' => date('Y-m-d H:i:s'),
                              'tgl_edit' => date('Y-m-d H:i:s'),
                              'id_user' => $this->session->userdata('id_user'),
                         ];
                         $izin = $this->smp->input_izin_tambang($data_izin_tambang);
                         if ($izin) {
                              $id_izin = $this->kry->last_row_idizin();
                              if ($jenisizin == "SP") {
                                   if ($this->session->has_userdata("unit_izin")) {
                                        $unit = $this->session->userdata("unit_izin");
                                        $baris = explode("|", $unit);
                                        foreach ($baris as $data) {
                                             $item = explode("%", $data);

                                             $data_unit_izin = [
                                                  'id_izin_tambang' => $id_izin,
                                                  'id_unit' => $item[0],
                                                  'id_tipe_akses_unit' => $item[1],
                                                  'tgl_buat' => date('Y-m-d H:i:s'),
                                                  'tgl_edit' => date('Y-m-d H:i:s'),
                                                  'id_user' => $this->session->userdata('id_user'),
                                             ];

                                             $this->smp->input_unit($data_unit_izin);
                                        }
                                   }
                              }

                              $newdata = array(
                                   'idizin'  => $id_izin
                              );
                              $this->session->set_userdata($newdata);
                              echo json_encode(array("statusCode" => 200, "pesan" => "Data SIMPER / Mine Permite berhasil disimpan"));
                         } else {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Data SIMPER / Mine Permite gagal disimpan"));
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data karyawan"));
                    }
               }
          }
     }

     public function addsertifikasi()
     {
          $this->form_validation->set_rules("jenissrt", "jenissrt", "required|trim", [
               'required' => 'Jenis sertifikasi wajib dipilih'
          ]);
          $this->form_validation->set_rules("nosrt", "nosrt", "required|trim|max_length[50]", [
               'required' => 'No. Sertifikat wajib diisi',
               'max_length' => 'No. Sertikat maksimal 50 karakter'
          ]);
          $this->form_validation->set_rules("tglsrt", "tglsrt", "required|trim", [
               'required' => 'Tanggal sertifikat wajib diisi',
          ]);
          $this->form_validation->set_rules("tglexp", "tglexp", "required|trim", [
               'required' => 'Tanggal expired wajib diisi',
          ]);
          $this->form_validation->set_rules("filesrt", "filesrt", "required|trim", [
               'required' => 'File sertifikat wajib diupload',
          ]);
          $this->form_validation->set_rules("namalembaga", "namalembaga", "required|trim", [
               'required' => 'Nama lembaga wajib diisi',
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'jenissrt' => form_error("jenissrt"),
                    'nosrt' => form_error("nosrt"),
                    'tglsrt' => form_error("tglsrt"),
                    'tglexp' => form_error("tglexp"),
                    'filesrt' => form_error("filesrt"),
                    'namalembaga' => form_error("namalembaga")
               ];

               echo json_encode($error);
               return;
          } else {
               $jenisizin = htmlspecialchars($this->input->post("jenissrt", true));
               $nosrt = htmlspecialchars($this->input->post("nosrt", true));
               $tglsrt = htmlspecialchars($this->input->post("tglsrt", true));
               $tglexp = htmlspecialchars($this->input->post("tglexp", true));
               $namalembaga = htmlspecialchars($this->input->post("namalembaga", true));
               $id_personal = $this->session->userdata('idpersonal');
               $now = date('YmdHis');
               $nama_file = $id_personal . "-" . $now . "-SRT";

               if (is_dir('./assets/berkas/karyawan/' . $id_personal) == false) {
                    mkdir('./assets/berkas/karyawan/' . $id_personal, 0775, TRUE);
               }

               if (is_dir('./assets/berkas/karyawan/' . $id_personal)) {
                    $config['upload_path'] = './assets/berkas/karyawan/' . $id_personal;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 100;
                    $config['file_name'] = $nama_file;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('filesertifikat')) {
                         $err = $this->upload->display_errors();

                         if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                              $error = "<p>Ukuran file maksimal 100 kb.</p>";
                         } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                              $error = "<p>Format file nya dalam bentuk pdf</p>";
                         } else {
                              $error = $err;
                         }

                         echo json_encode(array("statusCode" => 202, "filesrt" =>  $error));
                    } else {
                         if ($id_personal != "") {
                              $data_sertifikat = [
                                   'id_personal' => $id_personal,
                                   'id_jenis_sertifikasi' => $jenisizin,
                                   'no_sertifikasi' => $nosrt,
                                   'lembaga' => $namalembaga,
                                   'tgl_sertifikasi' => $tglsrt,
                                   'tgl_berakhir_sertifikasi' => $tglexp,
                                   'file_sertifikasi' =>  $nama_file,
                                   'tgl_buat' => date('Y-m-d H:i:s'),
                                   'tgl_edit' => date('Y-m-d H:i:s'),
                                   'id_user' => $this->session->userdata('id_user')
                              ];

                              $sertifikasi = $this->srt->input_sertifikasi($data_sertifikat);
                              if ($sertifikasi) {
                                   echo json_encode(array("statusCode" => 200, "pesan" => "Data sertifikasi berhasil disimpan"));
                              } else {
                                   echo json_encode(array("statusCode" => 201, "pesan" => "Data sertifikasi gagal disimpan"));
                              }
                         } else {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data personal"));
                         }
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Folder data personal tidak ditemukan"));
               }
          }
     }

     public function addmcu()
     {
          $this->form_validation->set_rules("tglmcu", "tglmcu", "required|trim", [
               'required' => 'Tanggal MCU wajib dipilih'
          ]);
          $this->form_validation->set_rules("hasilmcu", "hasilmcu", "required|trim|max_length[50]", [
               'required' => 'Hasil MCU wajib dipilih',
               'max_length' => 'Hasil MCU maksimal 50 karakter'
          ]);
          $this->form_validation->set_rules("ketmcu", "ketmcu", "required|trim", [
               'required' => 'Keterangan MCU wajib diisi',
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'tglmcu' => form_error("tglmcu"),
                    'hasilmcu' => form_error("hasilmcu"),
                    'ketmcu' => form_error("ketmcu")
               ];

               echo json_encode($error);
               return;
          } else {
               $tglmcu = htmlspecialchars($this->input->post("tglmcu", true));
               $hasilmcu = htmlspecialchars($this->input->post("hasilmcu", true));
               $ketmcu = htmlspecialchars($this->input->post("ketmcu", true));
               $id_personal = $this->session->userdata('idpersonal');
               $now = date('YmdHis');
               $nama_file = $id_personal . "-" . $now . "-MCU.pdf";

               if ($this->session->has_userdata('idmcu')) {
                    $id_mcu = $this->session->userdata('idmcu');
                    $flemcu = $this->session->userdata('filemcu');

                    if ($id_mcu != "") {
                         if (is_dir('./assets/berkas/karyawan/' . $id_personal)) {
                              $config['upload_path'] = './assets/berkas/karyawan/' . $id_personal;
                              $config['allowed_types'] = 'pdf';
                              $config['max_size'] = 250;
                              $config['file_name'] = $nama_file;

                              $this->load->library('upload', $config);
                              if (!$this->upload->do_upload('filemedik')) {
                                   $err = $this->upload->display_errors();

                                   if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                        $error = "<p>Ukuran file maksimal 250 kb.</p>";
                                   } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                        $error = "<p>Format file nya dalam bentuk pdf</p>";
                                   } else {
                                        $error = $err;
                                   }

                                   $error = [
                                        'statusCode' => 202,
                                        'tglmcu' => '',
                                        'hasilmcu' => '',
                                        'ketmcu' => '',
                                        "filmcu" =>  $err
                                   ];

                                   echo json_encode($error);
                                   die;
                              } else {
                                   if ($flemcu != "") {
                                        unlink('assets/berkas/karyawan/' . $id_personal . '/' . $flemcu);
                                   }

                                   $newdata = array(
                                        'filemcu' => $nama_file,
                                   );
                                   $this->session->set_userdata($newdata);

                                   // echo json_encode(array($id_mcu, $hasilmcu, $tglmcu, $ketmcu, $nama_file));
                                   // return;

                                   $dtmcu = array(
                                        'id_mcu_jenis' => $hasilmcu,
                                        'tgl_mcu' => $tglmcu,
                                        'ket_mcu' => $ketmcu,
                                        'url_file' => $nama_file
                                   );

                                   $u_mcu = $this->kry->update_mcu($id_mcu, $dtmcu);
                                   if ($u_mcu == 200) {
                                        echo json_encode(array("statusCode" => 200, "pesan" => "Data MCU berhasil disimpan"));
                                        return;
                                   } else {
                                        echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU gagal disimpan"));
                                   }
                              }
                         } else {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Folder penyimpanan tidak ditemukan"));
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Gagal memanggil data MCU"));
                    }
               } else {
                    if (is_dir('./assets/berkas/karyawan/' . $id_personal) == false) {
                         mkdir('./assets/berkas/karyawan/' . $id_personal, 0775, TRUE);
                    }

                    if (is_dir('./assets/berkas/karyawan/' . $id_personal)) {
                         $config['upload_path'] = './assets/berkas/karyawan/' . $id_personal;
                         $config['allowed_types'] = 'pdf';
                         $config['max_size'] = 250;
                         $config['file_name'] = $nama_file;

                         $this->load->library('upload', $config);

                         if (!$this->upload->do_upload('filemedik')) {
                              $err = $this->upload->display_errors();

                              echo json_encode(array($err));
                              return;
                              if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                   $error = "<p>Ukuran file maksimal 250 kb.</p>";
                              } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                                   $error = "<p>Format file nya dalam bentuk pdf</p>";
                              } else {
                                   $error = $err;
                              }

                              $error = [
                                   'statusCode' => 202,
                                   'tglmcu' => '',
                                   'hasilmcu' => '',
                                   'ketmcu' => '',
                                   "filmcu" =>  $err
                              ];

                              echo json_encode($error);
                         } else {
                              if ($this->session->has_userdata('idmcu')) {
                              } else {
                                   if ($id_personal != "") {
                                        $data_mcu = [
                                             'id_personal' => $id_personal,
                                             'id_mcu_jenis' => $hasilmcu,
                                             'tgl_mcu' => $tglmcu,
                                             'ket_mcu' => $ketmcu,
                                             'hasil_follow_up' => '',
                                             'tgl_follow_up' => '1970-01-01',
                                             'tgl_akhir' => '1970-01-01',
                                             'url_file' => $nama_file,
                                             'stat_mcu' => 'T',
                                             'tgl_buat' => date('Y-m-d H:i:s'),
                                             'tgl_edit' => date('Y-m-d H:i:s'),
                                             'id_perusahaan' => 0,
                                             'id_user' => $this->session->userdata('id_user')
                                        ];

                                        $mcu = $this->kry->input_dtMCU($data_mcu);
                                        if ($mcu) {
                                             $id_mcu = $this->kry->last_row_idmcu();
                                             $newdata = array(
                                                  'idmcu'  => $id_mcu,
                                                  'filemcu' => $nama_file,
                                             );
                                             $this->session->set_userdata($newdata);
                                             echo json_encode(array("statusCode" => 200, "pesan" => "Data MCU berhasil disimpan"));
                                        } else {
                                             echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU gagal disimpan"));
                                        }
                                   } else {
                                        echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data personal"));
                                   }
                              }
                         }
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Folder penyimpanan tidak ditemukan"));
                    }
               }
          }
     }

     public function addvaksin()
     {
          $this->form_validation->set_rules("jenisvaksin", "jenisvaksin", "required|trim", [
               'required' => 'Jenis vaksin wajib dipilih'
          ]);
          $this->form_validation->set_rules("namavaksin", "namavaksin", "required|trim|max_length[20]", [
               'required' => 'Nama vaksin wajib diisi',
               'max_length' => 'Nama vaksin maksimal 20 karakter'
          ]);
          $this->form_validation->set_rules("tglvaksin", "tglvaksin", "required|trim", [
               'required' => 'Tanggal vaksin wajib diisi',
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'jenisvaksin' => form_error("jenisvaksin"),
                    'namavaksin' => form_error("namavaksin"),
                    'tglvaksin' => form_error("tglvaksin")
               ];

               echo json_encode($error);
               return;
          } else {
               $jenisvaksin = htmlspecialchars($this->input->post("jenisvaksin", true));
               $namavaksin = htmlspecialchars($this->input->post("namavaksin", true));
               $tglvaksin = htmlspecialchars($this->input->post("tglvaksin", true));
               $id_personal = $this->session->userdata('idpersonal');

               if ($id_personal != "") {
                    $data_vaksin = [
                         'id_personal' => $id_personal,
                         'id_vaksin_jenis' => $jenisvaksin,
                         'tgl_vaksin' => $tglvaksin,
                         'id_vaksin_nama' => $namavaksin,
                         'tgl_buat' => date('Y-m-d H:i:s'),
                         'tgl_edit' => date('Y-m-d H:i:s'),
                         'id_user' => $this->session->userdata('id_user')
                    ];

                    $vaksin = $this->vks->input_vaksin_kary($data_vaksin);
                    if ($vaksin) {
                         echo json_encode(array("statusCode" => 200, "pesan" => "Data vaksin berhasil disimpan"));
                    } else {
                         echo json_encode(array("statusCode" => 201, "pesan" => "Data vaksin gagal disimpan"));
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data personal"));
               }
          }
     }

     public function addfilependukung()
     {
          $idpersonal = $this->session->userdata("idpersonal");
          $now = date('YmdHis');
          $nama_file = $idpersonal .  "-" . $now . "-SUPPORT";

          $alamat = './assets/berkas/karyawan/' . $idpersonal . "/" . $nama_file . ".pdf";
          if (!is_file($alamat)) {
               if (is_dir('./assets/berkas/karyawan/' . $idpersonal) == false) {
                    mkdir('./assets/berkas/karyawan/' . $idpersonal, 0775, TRUE);
               } else {
                    $config['upload_path'] = './assets/berkas/karyawan/' . $idpersonal;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 10000;
                    $config['file_name'] = $nama_file;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('filePendukung')) {
                         $error = $this->upload->display_errors;
                         echo json_encode(array("statusCode" => 201, "pesan_muasd" => $error));
                         die;
                    } else {
                         $this->session->set_flashdata("kary_sukses", "1");
                         echo json_encode(array("statusCode" => 200, "pesan" => "Data karyawan berhasil dibuat"));
                    }
               }
          } else {
               echo json_encode(array("statusCode" => 201, "pesan" => "File sudah ada, gagal upload file"));
          }
     }

     function get_stat_kerja($stat_kerja)
     {
          $query = $this->kry->get_stat_kerja($stat_kerja);

          if (!empty($query)) {
               foreach ($query as $list) {
                    $stat_waktu = $list->stat_waktu;
               }

               return $stat_waktu;
          } else {
               return 0;
          }
     }

     public function get_agama()
     {
          $list = $this->kry->get_agama();
          if (!empty($list)) {
               $output = "<option value=''>-- PILIH AGAMA --</option>";
               $output = $output . "<option value='0'>-- WAJIB DIPILIH --</option>";
               foreach ($list as $agm) {
                    $output = $output . "<option value=" . $agm->id_agama . ">" . $agm->agama . "</option>";
               }
          } else {
               $output = "<option value=''>-- Agama tidak ditemukan --</option>";
          }

          echo json_encode(array("agama" => $output));
     }

     public function get_stat_nikah()
     {
          $list = $this->kry->get_stat_nikah();
          if (!empty($list)) {
               $output = "<option value=''>-- PILIH PERNIKAHAN --</option>";
               $output = $output . "<option value='0'>-- WAJIB DIPILIH --</option>";
               foreach ($list as $stt) {
                    $output = $output . "<option value=" . $stt->id_stat_nikah . ">" . $stt->kode_stat_nikah . "</option>";
               }
          } else {
               $output = "<option value=''>-- Status pernikahan tidak ditemukan --</option>";
          }

          echo json_encode(array("statnikah" => $output));
     }

     public function get_sim()
     {
          $list = $this->kry->get_sim();
          if (!empty($list)) {
               $output = "<option value=''>-- PILIH SIM --</option>";
               $output = $output . "<option value='0'>-- WAJIB DIPILIH --</option>";
               foreach ($list as $simm) {
                    $output = $output . "<option value=" . $simm->id_sim . ">" . $simm->sim . "</option>";
               }
          } else {
               $output = "<option value=''>-- SIM tidak ditemukan --</option>";
          }

          echo json_encode(array("siim" => $output));
     }

     public function data_detail_karyawan($auth_karyawan)
     {
          $list = $this->kry->get_by_auth($auth_karyawan);
          echo json_encode($list);
     }

     public function get_all_kab()
     {
          $list = $this->drh->get_all_kab();
          echo json_encode($list);
     }

     public function get_id_perusahaan($auth_perusahaan)
     {
          $id_perusahaan = $this->prs->get_by_auth($auth_perusahaan);
          $_SESSION["addPerKary"] = $id_perusahaan;
          echo json_encode($id_perusahaan);
     }

     public function get_all_tipe()
     {
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          $query = $this->kry->get_all_tipe();
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->id_tipe . "'>" . $list->tipe . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "tipe" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- Tipe tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "tipe" => $output, "pesan" => "Sukses"));
          }
     }

     public function get_all_jenis_mcu()
     {
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          $query = $this->kry->get_all_jenis_mcu();
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->id_mcu_jenis . "'>" . $list->mcu_jenis . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "jmcu" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- Hasil MCU tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "jmcu" => $output, "pesan" => "Sukses"));
          }
     }

     // fetch data karyawan
     public function ajax_list()
     {
          $list = $this->kry->get_datatables();
          $data = array();
          $no = 0;
          foreach ($list as $kry) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['id_kary'] = $kry->id_kary;
               $row['no_ktp'] = $kry->no_ktp;
               $row['no_acr'] = $kry->no_acr;
               $row['no_nik'] = $kry->no_nik;
               $row['nama_lengkap'] = $kry->nama_lengkap;
               $row['depart'] = $kry->depart;
               $row['section'] = $kry->section;
               $row['kode_perusahaan'] = $kry->kode_perusahaan;
               $row['posisi'] = $kry->posisi;

               $row['tgl_buat'] = date('d-M-Y', strtotime($kry->tgl_buat));
               $row['proses'] = '
                    <a href="' . base_url('karyawan/detail_karyawan/' . $kry->auth_karyawan) . '" id="detailKaryawan" class="btn btn-primary btn-sm font-weight-bold detailKaryawan" title="Detail" value="' . $kry->nama_lengkap . '"> <i class="fas fa-asterisk"></i> </a> 
                    <button id="' . $kry->auth_karyawan . '" class="btn btn-warning btn-sm font-weight-bold edttKaryawan" title="Edit" value="' . $kry->nama_lengkap . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $kry->auth_karyawan . '" class="btn btn-danger btn-sm font-weight-bold hpsKaryawan" title="Hapus" value="' . $kry->nama_lengkap . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->kry->count_all(),
               "recordsFiltered" => $this->kry->count_filtered(),
               "data" => $data,
          );

          //output to json format
          echo json_encode($output);
     }
}
