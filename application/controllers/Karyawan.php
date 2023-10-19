<?php
// header('Content-Type: application/json');
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
        if ($this->session->has_userdata('id_m_perusahaan_hcdata')) {
            $idmper = $this->session->userdata('id_m_perusahaan_hcdata');
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
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
        $data['nama'] = $this->session->userdata("nama_hcdata");
        $data['email'] = $this->session->userdata("email_hcdata");
        $data['menu'] = $this->session->userdata("id_menu_hcdata");
        $data['get_menu'] = $this->dsmod->get_menu();
        $this->load->view('dashboard/template/header', $data);
        $this->load->view('dashboard/karyawan/karyawan');
        $this->load->view('dashboard/template/footer', $data);
        $this->load->view('dashboard/code/karyawan');
    }

    public function new ()
    {
        if ($this->session->has_userdata('id_m_perusahaan_hcdata')) {
            $idmper = $this->session->userdata('id_m_perusahaan_hcdata');
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
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
        $data['nama'] = $this->session->userdata("nama_hcdata");
        $data['email'] = $this->session->userdata("email_hcdata");
        $data['menu'] = $this->session->userdata("id_menu_hcdata");
        $data['get_menu'] = $this->dsmod->get_menu();
        $this->load->view('dashboard/template/header', $data);
        $this->load->view('dashboard/karyawan/karyawan_add');
        $this->load->view('dashboard/template/footer', $data);
        $this->load->view('dashboard/code/karyawan');
    }

    public function error404()
    {
        $this->load->view('errors/errnotfound');
    }

    public function sertifikasi()
    {
        $auth_person = $this->input->get('auth_person');
        $id_personal = $this->kry->get_id_personal($auth_person);
        $data['sert'] = $this->srt->tabel_sertifikasi($id_personal);
        $this->load->view('dashboard/karyawan/sertifikasi', $data);
    }

    public function vaksin()
    {
        $auth_person = $this->input->get('auth_person');
        $status = $this->input->get('status');
        $id_personal = $this->kry->get_id_personal($auth_person);
        $data['vaks'] = $this->vks->tabel_vaksin($id_personal);
        $data['status'] = $status;
        $this->load->view('dashboard/karyawan/vaksin', $data);
    }

    public function getKaryawan()
    {
        // POST data
        $data = $this->input->post();
        $list = $this->kry->getKaryawan($data);

        echo json_encode($list);
    }

    public function getKaryawanIzin()
    {
        // POST data
        $data = $this->input->post();
        $list = $this->kry->getKaryawanIzin($data);

        echo json_encode($list);
    }

    public function detail($auth_kary)
    {
        $cekauth = $this->kry->get_by_auth($auth_kary);
        if (!empty($cekauth)) {
            $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
            $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
            $data['nama'] = $this->session->userdata("nama_hcdata");
            $data['email'] = $this->session->userdata("email_hcdata");
            $data['menu'] = $this->session->userdata("id_menu_hcdata");
            $data["data_kary"] = $this->kry->get_by_auth($auth_kary);
            $data["data_alamat"] = $this->kry->get_alamat_by_auth($auth_kary);
            $data["data_izin"] = $this->kry->get_izin_by_auth($auth_kary);
            $data["data_unit"] = $this->kry->get_izin_unit_by_auth($auth_kary);
            $data["data_sertifikasi"] = $this->kry->get_sertifikasi_by_auth($auth_kary);
            $data["data_izin"] = $this->kry->get_all_izin_by_auth($auth_kary);
            $data["data_langgar"] = $this->kry->get_pelanggaran_by_auth($auth_kary);
            $data["data_mcu"] = $this->kry->get_mcu_by_auth($auth_kary);
            $data["data_vaksin"] = $this->kry->get_vaksin_by_auth($auth_kary);
            $data["data_kontrak"] = $this->kry->get_kontrak_by_auth($auth_kary);
            $data['get_menu'] = $this->dsmod->get_menu();
            $this->load->view('dashboard/template/header', $data);
            $this->load->view('dashboard/karyawan/karyawan_detail', $data);
            $this->load->view('dashboard/modal/karyawan');
            $this->load->view('dashboard/template/footer', $data);
            $this->load->view('dashboard/code/karydetail');
        } else {
            $this->load->view('errors/errnotfound');
        }
    }

    public function edit_karyawan($id_kary)
    {
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");

        $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
        $data['nama'] = $this->session->userdata("nama_hcdata");
        $data['email'] = $this->session->userdata("email_hcdata");
        $data['menu'] = $this->session->userdata("id_menu_hcdata");
        $data["data_kary"] = $this->kry->get_by_auth($id_kary);
        $data["data_alamat"] = $this->kry->get_edit_alamat_by_auth($id_kary);
        $data["data_izin"] = $this->kry->get_izin_by_auth($id_kary);
        $data["data_sim_kary"] = $this->kry->get_sim_by_auth($data["data_kary"]->auth_personal);
        $data["data_unit"] = $this->kry->get_izin_unit_by_auth($id_kary);
        $data["data_sertifikasi"] = $this->kry->get_sertifikasi_by_auth($id_kary);
        $data["data_mcu"] = $this->kry->get_mcu_by_auth($id_kary);
        $data["data_vaksin"] = $this->kry->get_vaksin_by_auth($id_kary);
        $data["data_kontrak"] = $this->kry->get_kontrak_by_auth($id_kary);
        $data['get_menu'] = $this->dsmod->get_menu();

        $data['jsonData'] = json_encode($data);

        $this->load->view('dashboard/template/header', $data);
        $this->load->view('dashboard/karyawan/karyawan_edit_v2', $data);
        $this->load->view('dashboard/modal/karyawan', $data);
        $this->load->view('dashboard/template/footer', $data);
        $this->load->view('dashboard/code/karydetail');
    }

    public function hapus_mcu()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $auth_mcu = htmlspecialchars(trim($this->input->post('auth_mcu', true)));
        $datamcu = $this->kry->get_mcu_by_authmcu($auth_mcu);

        if (!empty($datamcu)) {
            foreach ($datamcu as $list) {
                $id_personal = $list->id_personal;
                $nama_file = $list->url_file;
            }

            $namafolder = md5($id_personal);
        } else {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data MCU tidak ditemukan"));
            return;
        }

        $query = $this->kry->hapus_mcu($auth_mcu);
        if ($query == 200) {
            unlink('assets/berkas/karyawan/' . $namafolder . '/' . $nama_file);
            echo json_encode(array("statusCode" => 200, "pesan" => "Data MCU berhasil dihapus"));
            return;
        } else if ($query == 201) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU gagal dihapus"));
            return;
        } else {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data MCU tidak ditemukan"));
            return;
        }
    }

    public function hapus_filependukung()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $auth_person = htmlspecialchars(trim($this->input->post('auth_person', true)));
        $dataperson = $this->kry->get_personal_by_auth($auth_person);

        if (!empty($dataperson)) {
            foreach ($dataperson as $list) {
                $id_personal = $list->id_personal;
                $nama_file = $list->url_pendukung;
            }

            $namafolder = md5($id_personal);
        } else {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data MCU tidak ditemukan"));
            return;
        }

        $dtpersonal = [
            'url_pendukung' => '',
        ];

        $query = $this->kry->update_filependukung($auth_person, $dtpersonal);
        if ($query == 200) {
            unlink('assets/berkas/karyawan/' . $namafolder . '/' . $nama_file);
            echo json_encode(array("statusCode" => 200, "pesan" => "File pendukung berhasil dihapus"));
            return;
        } else if ($query == 201) {
            echo json_encode(array("statusCode" => 201, "pesan" => "File pendukung gagal dihapus"));
            return;
        } else {
            echo json_encode(array("statusCode" => 202, "pesan" => "File pendukung tidak ditemukan"));
            return;
        }
    }

    public function hapus_vaksin()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $auth_vaksin = htmlspecialchars(trim($this->input->post('auth_vaksin', true)));

        $query = $this->kry->hapus_vaksin($auth_vaksin);

        if ($query == 200) {
            echo json_encode(array("statusCode" => 200, "pesan" => "Data vaksin berhasil dihapus"));
            return;
        } else if ($query == 201) {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data vaksin gagal dihapus"));
            return;
        } else {
            echo json_encode(array("statusCode" => 202, "pesan" => "Data vaksin tidak ditemukan"));
            return;
        }
    }

//     public function cekfoto()
    //     {

//         if ($_FILES['fl_foto']['name'] == "") {
    //             echo json_encode(array('statusCode' => 201, "pesan" => "File foto wajib di-upload"));
    //             return;
    //         }

//         if ($_FILES['fl_foto']['type'] !== 'image/jpeg') {
    //             echo json_encode(array('statusCode' => 201, "pesan" => "File harus dalam format jpg"));
    //             return;
    //         }

//         if ($_FILES['fl_foto']['size'] > 50) {
    //             echo json_encode(array('statusCode' => 201, "pesan" => "Ukuran file tidak boleh lebih dari 50 kb"));
    //             return;
    //         }
    //     }

    public function addpersonal()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $this->form_validation->set_rules("noktp", "noktp", "required|trim|numeric|max_length[16]|min_length[16]", [
            'required' => 'No. KTP wajib diisi',
            'numeric' => 'Wajib diisi dengan angka',
            'max_length' => 'No. KTP maksimal 16 karakter',
            'min_length' => 'No. KTP minimal 16 karakter',
        ]);
        $this->form_validation->set_rules("nama", "nama", "required|trim", [
            'required' => 'Nama wajib dipilih',
        ]);
        $this->form_validation->set_rules("alamat", "alamat", "required|trim|max_length[1000]", [
            'required' => 'Alamat wajib diisi',
            'max_length' => 'Alamat maksimal 1000 karakter',
        ]);
        $this->form_validation->set_rules("rt", "rt", "trim|max_length[3]", [
            'max_length' => 'No. RT maksimal 3 karakter',
        ]);
        $this->form_validation->set_rules("rw", "rw", "trim|max_length[3]", [
            'max_length' => 'No. RW maksimal 3 karakter',
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
            'max_length' => 'Tempat Lahir maksimal 100 karakter',
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
        $this->form_validation->set_rules("bpjs_tk", "bpjs_tk", "trim");
        $this->form_validation->set_rules("bpjs_kes", "bpjs_kes", "trim");
        $this->form_validation->set_rules("no_equity", "no_equity", "trim");
        $this->form_validation->set_rules("npwp", "npwp", "trim");
        $this->form_validation->set_rules("email", "email", "trim|valid_email", [
            'valid_email' => 'Format email anda salah',
        ]);
        $this->form_validation->set_rules("notelp", "notelp", "trim|numeric", [
            'numeric' => 'No. Telp. wajib diisi dengan angka',
        ]);
        $this->form_validation->set_rules("nokk", "nokk", "required|trim|max_length[16]|min_length[16]", [
            'required' => 'No. Kartu Keluarga wajib diisi',
            'numeric' => 'Wajib diisi dengan angka',
            'max_length' => 'No. Kartu Keluarga maksimal 16 karakter',
            'min_length' => 'No. Kartu Keluarga minimal 16 karakter',
        ]);
        $this->form_validation->set_rules("pddakhir", "pddakhir", "required|trim", [
            'required' => 'Pendidikan Terakhir wajib diisi',
        ]);

        if ($_FILES['fl_foto']['name'] = '') {
            $this->form_validation->set_rules("filePasFoto", "filePasFoto", "required!trim", [
                'valid_email' => 'Foto karyawan wajib diupload',
            ]);
        }

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
                'pesan' => 'Tidak dapat melanjutkan, lengkapi data personal.',
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
                'bpjs_tk' => form_error("bpjs_tk"),
                'bpjs_kes' => form_error("bpjs_kes"),
                'no_equity' => form_error("no_equity"),
                'email' => form_error("email"),
                'notelp' => form_error("notelp"),
                'nokk' => form_error("nokk"),
                'pddakhir' => form_error("pddakhir"),
                'npwp' => $errnpwp,
            ];

            echo json_encode($error);
            return;
        } else {
            $noktp = htmlspecialchars($this->input->post("noktp", true));
            $nokk = htmlspecialchars($this->input->post("nokk", true));
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $auth_check = htmlspecialchars($this->input->post("auth_check", true));
            $noktp_old = htmlspecialchars($this->input->post("noktp_old", true));
            $nokk_old = htmlspecialchars($this->input->post("nokk_old", true));
            $tgl_lahir = htmlspecialchars($this->input->post("tgl_lahir", true));
            $ynow = date("Y");
            $ylahir = date("Y", strtotime($tgl_lahir));
            $usia = intval($ynow) - intval($ylahir);

            if ($usia <= 15) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Usia kurang dari 15 tahun, isi tanggal lahir anda dengan benar"));
                return;
            }

            if ($usia >= 75) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Isi tanggal lahir anda dengan benar"));
                return;
            }

            if ($auth_person !== "") {
                if ($auth_check == "") {
                    $no_ktp = $noktp_old;
                    $no_kk = $nokk_old;

                    if ($no_ktp != $noktp) {
                        $query = $this->kry->cek_noKTP($noktp);
                        if ($query) {
                            echo json_encode(array("statusCode" => 201, "pesan" => "No. KTP sudah digunakan"));
                            return;
                        }
                    }

                    // if ($no_kk != $nokk) {
                    //      $query = $this->kry->cek_noKK($nokk);
                    //      if ($query) {
                    //           echo json_encode(array("statusCode" => 201, "pesan" => "No. Kartu Keluarga sudah digunakan"));
                    //           return;
                    //      }
                    // }
                }
            } else {
                $query = $this->kry->cek_noKTP($noktp);
                if ($query) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "No. KTP sudah digunakan"));
                    return;
                }

                // $query = $this->kry->cek_noKK($nokk);
                // if ($query) {
                //      echo json_encode(array("statusCode" => 201, "pesan" => "No. Kartu Keluarga sudah digunakan"));
                //      return;
                // }
            }

            echo json_encode(array("statusCode" => 200, "pesan" => "Sukses"));
        }
    }

    public function get_resident()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $query = $this->kry->get_resident();
        $output = "<option value=''>-- PILIH STATUS TINGGAL --</option>";
        if (!empty($query)) {
            foreach ($query as $list) {
                $output = $output . "<option value='" . $list->id_stat_tinggal . "'>" . $list->stat_tinggal . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "tgl" => $output));
        } else {
            $output = "<option value=''>-- DATA TIDAK DITEMUKAN --</option>";
            echo json_encode(array("statusCode" => 201, "tgl" => $output));
        }
    }

    public function get_id_depart($auth_depart)
    {
        $query = $this->dprt->get_id_depart($auth_depart);
        if ($query === 0) {
            return 0;
        } else {
            return $query;
        }
    }

    public function get_id_posisi($auth_posisi)
    {
        $query = $this->pss->get_id_posisi($auth_posisi);
        if ($query === 0) {
            return 0;
        } else {
            return $query;
        }
    }

    public function get_id_lokterima($auth_lokterima)
    {
        $query = $this->lkt->get_id_lokterima($auth_lokterima);
        if ($query === 0) {
            return 0;
        } else {
            return $query;
        }
    }

    public function get_id_lokker($auth_lokker)
    {
        $query = $this->lkr->get_id_lokker($auth_lokker);
        if ($query === 0) {
            return 0;
        } else {
            return $query;
        }
    }

    public function get_id_level($auth_level)
    {
        $query = $this->lvl->get_id_level($auth_level);
        if ($query === 0) {
            return 0;
        } else {
            return $query;
        }
    }

    public function get_id_poh($auth_poh)
    {
        $query = $this->pho->get_id_poh($auth_poh);
        if ($query === 0) {
            return 0;
        } else {
            return $query;
        }
    }
    public function get_id_tipe($auth_tipe)
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
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $this->form_validation->set_rules("no_nik", "no_nik", "required|trim|numeric|max_length[25]", [
            'required' => 'NIK wajib diisi',
            'numeric' => 'Wajib diisi dengan angka',
            'max_length' => 'NIK maksimal 25 karakter',
        ]);
        $this->form_validation->set_rules("depart", "depart", "required|trim", [
            'required' => 'Departemen wajib dipilih',
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
        $this->form_validation->set_rules("id_level", "id_level", "required|trim", [
            'required' => 'Grade wajib dipilih',
        ]);
        $this->form_validation->set_rules("stat_tinggal", "stat_tinggal", "required|trim", [
            'required' => 'Warga negara wajib diisi',
        ]);
        $this->form_validation->set_rules("stat_kerja", "stat_kerja", "required|trim", [
            'required' => 'Status karyawan wajib dipilih',
        ]);
        $this->form_validation->set_rules("email_kantor", "email_kantor", "trim|valid_email", [
            'valid_email' => 'Format email salah',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'pesan3' => 'Tidak dapat melanjutkan, lengkapi data karyawan.',
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
                'id_level' => form_error("id_level"),
                'stat_tinggal' => form_error("stat_tinggal"),
                'stat_kerja' => form_error("stat_kerja"),
                'email_kantor' => form_error("email_kantor"),
                'filePasFoto' => form_error("filePasFoto"),
                'tgl_mulai_kontrak' => form_error("tgl_mulai_kontrak"),
                'tgl_akhir_kontrak' => form_error("tgl_akhir_kontrak"),
            ];

            echo json_encode($error);
            return;
        } else {
            //personal
            $auth_ver = htmlspecialchars($this->input->post("auth_ver", true));
            $auth_check = htmlspecialchars($this->input->post("auth_check", true));
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $auth_alamat = htmlspecialchars($this->input->post("auth_alamat", true));
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
            $auth_ktr = htmlspecialchars($this->input->post("auth_ktr", true));
            $no_nik = htmlspecialchars($this->input->post("no_nik", true));
            $auth_depart = htmlspecialchars($this->input->post("depart", true));
            $auth_posisi = htmlspecialchars($this->input->post("posisi", true));
            $auth_lokker = htmlspecialchars($this->input->post("id_lokker", true));
            $auth_lokterima = htmlspecialchars($this->input->post("id_lokterima", true));
            $auth_poh = htmlspecialchars($this->input->post("id_poh", true));
            $auth_level = htmlspecialchars($this->input->post("id_level", true));
            $id_klasifikasi = htmlspecialchars($this->input->post("id_klasifikasi", true));
            $id_tipe = htmlspecialchars($this->input->post("id_tipe", true));
            $doh = htmlspecialchars($this->input->post("doh", true));
            $tgl_aktif = htmlspecialchars($this->input->post("tgl_aktif", true));
            $stat_tinggal = htmlspecialchars($this->input->post("stat_tinggal", true));
            $stat_kerja = htmlspecialchars($this->input->post("stat_kerja", true));
            $email_kantor = htmlspecialchars($this->input->post("email_kantor", true));
            $tgl_permanen = htmlspecialchars($this->input->post("tgl_permanen", true));
            $tgl_mulai_kontrak = htmlspecialchars($this->input->post("tgl_mulai_kontrak", true));
            $tgl_akhir_kontrak = htmlspecialchars($this->input->post("tgl_akhir_kontrak", true));
            $id_m_perusahaan = htmlspecialchars($this->input->post("id_m_perusahaan", true));
            $no_nik_old = htmlspecialchars($this->input->post("no_nik_old", true));

            if ($auth_check == "") {
                echo json_encode(array("statusCode" => 202, "pesan" => "Data karyawan tidak ditemukan"));
                die;
            }

            if ($id_m_perusahaan == "") {
                echo json_encode(array("statusCode" => 202, "pesan" => "Data perusahaan tidak ditemukan"));
                die;
            }

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

                if ($tgl_mulai_kontrak > $tgl_akhir_kontrak) {
                    echo json_encode(array("statusCode" => 202, "pesan" => "", "pesan1" => "", "pesan2" => "Isi tanggal akhir dengan benar"));
                    return;
                }

                $tgl_permanen = "1970-01-01";
            } else if ($query == "F") {
                if ($tgl_permanen == "") {
                    echo json_encode(array("statusCode" => 202, "pesan" => "Tanggal permanen wajib diisi", "pesan1" => "", "pesan2" => ""));
                    return;
                }

                $tgl_akhir_kontrak = "1970-01-01";
                $tgl_mulai_kontrak = $tgl_permanen;
            } else {
                echo json_encode(array("statusCode" => 202, "pesan" => "Kesalahan saat mengambil status kerja", "pesan1" => "", "pesan2" => ""));
                return;
            }

            if ($auth_person !== "") { // ======================= jika sudah dibuat ========================
                $nonik = $no_nik_old;
                if ($nonik != $no_nik) {
                    $id_per = $this->prs->get_id_per_by_auth_m($id_m_perusahaan);
                    $query = $this->kry->cek_nik($no_nik, $id_per);
                    if ($query) {
                        echo json_encode(array("statusCode" => 202, "no_nik" => "NIK sudah digunakan", "pesan1" => "", "pesan2" => ""));
                        die;
                    }
                }

                $data_personal = array(
                    'no_ktp' => $noktp,
                    'no_kk' => $nokk,
                    'nama_lengkap' => $nama,
                    'nama_alias' => '',
                    'jk' => $jk,
                    'tmp_lahir' => strtoupper($tmp_lahir),
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
                    'url_pendukung' => '',
                );

                $idpersonal = $this->kry->get_id_personal($auth_person);
                $this->kry->update_dtPersonal($idpersonal, $data_personal);

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
                    'stat_alamat_ktp' => 'T',
                );

                $idalamat = $this->kry->get_id_alamat($auth_person);
                $this->kry->update_dtAlamat($idalamat, $data_al);

                if ($auth_ver == "") { // ========================= jika ktp belum ada di database ====================
                    $id_m_perusahaan = $this->prs->get_m_by_auth($id_m_perusahaan);
                    $id_depart = $this->get_id_depart($auth_depart);
                    $id_posisi = $this->get_id_posisi($auth_posisi);
                    $id_level = $this->get_id_level($auth_level);
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
                        'id_posisi' => $id_posisi,
                        'id_grade' => 0,
                        'id_level' => $id_level,
                        'id_lokker' => $id_lokker,
                        'id_lokterima' => $id_lokterima,
                        'id_poh' => $id_poh,
                        'id_klasifikasi' => $id_klasifikasi,
                        'id_tipe' => $id_tipe,
                        'id_stat_tinggal' => $stat_tinggal,
                        'email_kantor' => $email_kantor,
                        'tgl_permanen' => $tgl_permanen,
                        'id_stat_perjanjian' => $stat_kerja,
                        'id_m_perusahaan' => $id_m_perusahaan,
                    );

                    $idkaryawan = $this->kry->get_id_karyawan($auth_kary);
                    $this->kry->update_dtkary($idkaryawan, $data_kry);

                    if ($auth_ktr != "") {
                        $dtkontrak = $this->kry->get_id_kontrak_by_auth($auth_ktr);
                        if (!empty($dtkontrak)) {
                            foreach ($dtkontrak as $lst) {
                                $id_kontrak = $lst->id_kontrak_kary;
                            }
                        } else {
                            $id_kontrak = "";
                        }
                        if ($id_kontrak != "") {
                            $data_kontrak = [
                                'id_kary' => $idkaryawan,
                                'id_stat_perjanjian' => $stat_kerja,
                                'tgl_mulai' => $tgl_mulai_kontrak,
                                'tgl_akhir' => $tgl_akhir_kontrak,
                                'ket_kontrak' => '',
                            ];

                            // echo json_encode([$data_kontrak]);
                            // return;

                            $this->kry->update_dtkontrak($id_kontrak, $data_kontrak);
                        }
                    }

                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "Data karyawan berhasil diupdate",
                        "no_ktp" => $noktp,
                        "no_kk" => $nokk,
                        "nik" => $no_nik,
                    ));
                } else {
                    $id_personal = $this->kry->get_id_personal($auth_person);
                    $id_m_perusahaan = $this->prs->get_m_by_auth($id_m_perusahaan);
                    $id_depart = $this->get_id_depart($auth_depart);
                    $id_level = $this->get_id_level($auth_level);
                    $id_posisi = $this->get_id_posisi($auth_posisi);
                    $id_lokterima = $this->get_id_lokterima($auth_lokterima);
                    $id_lokker = $this->get_id_lokker($auth_lokker);
                    $id_poh = $this->get_id_poh($auth_poh);

                    if ($auth_kary != "") {
                        $data_kry = array(
                            'id_perkerjaan' => 0,
                            'no_acr' => 0,
                            'no_nik' => $no_nik,
                            'doh' => $doh,
                            'tgl_aktif' => $tgl_aktif,
                            'id_depart' => $id_depart,
                            'id_posisi' => $id_posisi,
                            'id_grade' => 0,
                            'id_level' => $id_level,
                            'id_lokker' => $id_lokker,
                            'id_lokterima' => $id_lokterima,
                            'id_poh' => $id_poh,
                            'id_klasifikasi' => $id_klasifikasi,
                            'id_tipe' => $id_tipe,
                            'id_stat_tinggal' => $stat_tinggal,
                            'email_kantor' => $email_kantor,
                            'tgl_permanen' => $tgl_permanen,
                            'id_stat_perjanjian' => $stat_kerja,
                            'id_m_perusahaan' => $id_m_perusahaan,
                        );

                        $idkaryawan = $this->kry->get_id_karyawan($auth_kary);
                        $this->kry->update_dtkary($idkaryawan, $data_kry);

                        if ($auth_ktr != "") {

                            $data_ktr = $this->kry->get_id_kontrak_by_auth($auth_ktr);
                            if (!empty($data_ktr)) {
                                foreach ($data_ktr as $lsk) {
                                    $id_kontrak = $lsk->id_kontrak_kary;
                                }

                                // echo json_encode([$id_kontrak]);
                                // return;

                                $data_kontrak = [
                                    'id_kary' => $idkaryawan,
                                    'id_stat_perjanjian' => $stat_kerja,
                                    'tgl_mulai' => $tgl_mulai_kontrak,
                                    'tgl_akhir' => $tgl_akhir_kontrak,
                                    'ket_kontrak' => '',
                                    'tgl_buat' => date('Y-m-d H:i:s'),
                                    'tgl_edit' => date('Y-m-d H:i:s'),
                                    'id_user' => $this->session->userdata('id_user_hcdata'),
                                ];

                                $this->kry->update_dtkontrak($id_kontrak, $data_kontrak);
                            }
                        }

                        echo json_encode(array(
                            "statusCode" => 200,
                            "pesan" => "Data karyawan berhasil diupdate",
                            "no_ktp" => $noktp,
                            "no_kk" => $nokk,
                            "nik" => $no_nik,
                        ));
                    } else {
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
                            'id_grade' => 0,
                            'id_level' => $id_level,
                            'id_lokker' => $id_lokker,
                            'id_lokterima' => $id_lokterima,
                            'id_poh' => $id_poh,
                            'id_roster' => 0,
                            'id_klasifikasi' => $id_klasifikasi,
                            'paybase' => 0,
                            'statpajak' => 0,
                            'id_tipe' => $id_tipe,
                            'id_stat_tinggal' => $stat_tinggal,
                            'email_kantor' => $email_kantor,
                            'tgl_permanen' => '1970-01-01',
                            'id_stat_perjanjian' => 0,
                            'tgl_nonaktif' => '1970-01-01',
                            'alasan_nonaktif' => '',
                            'url_foto' => '',
                            'tgl_buat' => date('Y-m-d H:i:s'),
                            'tgl_edit' => date('Y-m-d H:i:s'),
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                            'id_m_perusahaan' => $id_m_perusahaan,
                        ];

                        $karyawan = $this->kry->input_dtKaryawan($data_karyawan);

                        if ($karyawan) {
                            if ($auth_ver == "") {
                                $auth_person = $this->kry->last_row_personal();
                            }

                            $auth_kary_new = $this->kry->last_row_authkary($auth_person);
                            $auth_alamat = $this->kry->last_row_alamat($auth_person);
                            $id_kary = $this->kry->last_row_idkary($auth_kary_new);

                            if (!empty($id_kary)) {
                                $data_kontrak = [
                                    'id_kary' => $id_kary,
                                    'id_stat_perjanjian' => $stat_kerja,
                                    'tgl_mulai' => $tgl_mulai_kontrak,
                                    'tgl_akhir' => $tgl_akhir_kontrak,
                                    'ket_kontrak' => '',
                                    'tgl_buat' => date('Y-m-d H:i:s'),
                                    'tgl_edit' => date('Y-m-d H:i:s'),
                                    'id_user' => $this->session->userdata('id_user_hcdata'),
                                ];

                                $this->kry->input_dtKontrak($data_kontrak);
                                $auth_kontrak = $this->kry->last_row_kontrak($id_kary);
                            } else {
                                $auth_kontrak = "";
                            }

                            echo json_encode(array(
                                "statusCode" => 200,
                                "pesan" => "Data karyawan berhasil disimpan",
                                "auth_person" => $auth_person,
                                "auth_kary" => $auth_kary_new,
                                "auth_alamat" => $auth_alamat,
                                "auth_kontrak" => $auth_kontrak,
                                "no_ktp" => $noktp,
                                "no_kk" => $nokk,
                                "nik" => $no_nik,
                            ));
                        } else {
                            echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan gagal disimpan"));
                        }
                    }
                }
            } else { //===================================== jika belum dibuat ====================================
                $id_per = $this->prs->get_id_per_by_auth_m($id_m_perusahaan);
                $query = $this->kry->cek_nik($no_nik, $id_per);
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
                    'url_pendukung' => '',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user_hcdata'),
                ];

                $personal = $this->kry->input_dtPersonal($data_personal);
                if ($personal) {
                    $id_personal = $this->kry->last_row_id_personal();
                    if ($id_personal === 0) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Tidak dapat menyimpan alamat"));
                        return;
                    } else {
                        $foldername = md5($id_personal);
                        if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                            mkdir('./berkas/karyawan/' . $foldername, 0775, true);
                        }

                        $data_alamat = [
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
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                        ];

                        $this->kry->input_dtAlamat($data_alamat);
                        $id_m_perusahaan = $this->prs->get_m_by_auth($id_m_perusahaan);
                        $id_depart = $this->get_id_depart($auth_depart);
                        $id_level = $this->get_id_level($auth_level);
                        $id_posisi = $this->get_id_posisi($auth_posisi);
                        $id_lokterima = $this->get_id_lokterima($auth_lokterima);
                        $id_lokker = $this->get_id_lokker($auth_lokker);
                        $id_poh = $this->get_id_poh($auth_poh);

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
                            'id_grade' => 0,
                            'id_level' => $id_level,
                            'id_lokker' => $id_lokker,
                            'id_lokterima' => $id_lokterima,
                            'id_poh' => $id_poh,
                            'id_roster' => 0,
                            'id_klasifikasi' => $id_klasifikasi,
                            'paybase' => 0,
                            'statpajak' => 0,
                            'id_tipe' => $id_tipe,
                            'id_stat_tinggal' => $stat_tinggal,
                            'email_kantor' => $email_kantor,
                            'tgl_permanen' => '1970-01-01',
                            'id_stat_perjanjian' => 0,
                            'tgl_nonaktif' => '1970-01-01',
                            'alasan_nonaktif' => '',
                            'url_foto' => '',
                            'tgl_buat' => date('Y-m-d H:i:s'),
                            'tgl_edit' => date('Y-m-d H:i:s'),
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                            'id_m_perusahaan' => $id_m_perusahaan,
                        ];

                        $karyawan = $this->kry->input_dtKaryawan($data_karyawan);

                        if ($karyawan) {
                            $auth_person = $this->kry->last_row_personal();
                            $auth_kary = $this->kry->last_row_authkary($auth_person);
                            $auth_alamat = $this->kry->last_row_alamat($auth_person);
                            $id_kary = $this->kry->last_row_idkary($auth_kary);

                            if (!empty($id_kary)) {
                                $data_kontrak = [
                                    'id_kary' => $id_kary,
                                    'id_stat_perjanjian' => $stat_kerja,
                                    'tgl_mulai' => $tgl_mulai_kontrak,
                                    'tgl_akhir' => $tgl_akhir_kontrak,
                                    'ket_kontrak' => '',
                                    'tgl_buat' => date('Y-m-d H:i:s'),
                                    'tgl_edit' => date('Y-m-d H:i:s'),
                                    'id_user' => $this->session->userdata('id_user_hcdata'),
                                ];

                                $this->kry->input_dtKontrak($data_kontrak);
                                $auth_kontrak = $this->kry->last_row_kontrak($id_kary);
                            } else {
                                $auth_kontrak = "";
                            }

                            echo json_encode(array(
                                "statusCode" => 200,
                                "pesan" => "Data karyawan berhasil disimpan, lengkapi data selanjutnya",
                                "auth_person" => $auth_person,
                                "auth_kary" => $auth_kary,
                                "auth_alamat" => $auth_alamat,
                                "auth_kontrak" => $auth_kontrak,
                                "no_ktp" => $noktp,
                                "no_kk" => $nokk,
                                "nik" => $no_nik,
                            ));
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
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $this->form_validation->set_rules("jenisizin", "jenisizin", "required|trim", [
            'required' => 'Jenis Izin wajib dipilih',
        ]);
        $this->form_validation->set_rules("noreg", "noreg", "required|trim|max_length[50]", [
            'required' => 'No. Register wajib diisi',
            'max_length' => 'No. Register maksimal 50 karakter',
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
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));

            if ($jenisizin == 2) { // ================= jika simper ===========================
                $filesim = htmlspecialchars($this->input->post("filesim", true));
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

                if ($filesim == "") {
                    $errsim = "<p>SIM Polisi wajib diupload</p>";
                } else {
                    $errsim = "";
                }
            } else {
                $errjenis = "";
                $errtglsim = "";
                $errsim = "";
            }

            if ($filesmp == "") {
                $errsmp = "<p>SIMPER / MINE PERMIT wajib diupload</p>";
            } else {
                $errsmp = "";
            }

            $error = [
                'statusCode' => 202,
                'jenisizin' => form_error("jenisizin"),
                'noreg' => form_error("noreg"),
                'tglexp' => form_error("tglexp"),
                'jenissim' => $errjenis,
                'tglexpsim' => $errtglsim,
                'filesim' => $errsim,
                'filesmp' => $errsmp,
            ];

            echo json_encode($error);
            return;
        } else {

            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
            $auth_simpol = htmlspecialchars($this->input->post("auth_simpol", true));
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
            $noreg = htmlspecialchars($this->input->post("noreg", true));
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $jenissim = htmlspecialchars($this->input->post("jenissim", true));
            $tglexpsim = htmlspecialchars($this->input->post("tglexpsim", true));
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $filesimnm = htmlspecialchars($this->input->post("filesimnm", true));
            $filesimsv = htmlspecialchars($this->input->post("filesimsv", true));
            $filesmpnm = htmlspecialchars($this->input->post("filesmpnm", true));
            $filesmpsv = htmlspecialchars($this->input->post("filesmpsv", true));
            $id_karyawan = $this->kry->get_id_karyawan($auth_kary);
            $id_personal = $this->kry->get_id_personal_by_kary($auth_kary);
            $id_sim_kary = $this->kry->get_sim_kary_by_idkary($id_karyawan);
            $url_izin = date('YmdHis') . '-SMP.pdf';
            $url_sim = date('YmdHis') . '-SIMPOL.pdf';
            $foldername = md5($id_personal);

            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
                return;
            }

            if ($jenisizin == 2) { // ===================== jika simper ==============================
                if ($auth_izin != "") { // ====================== jika izin tambang sudah ada =======================
                    $query = $this->smp->cek_unit($auth_izin);

                    if ($query == 201) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Data unit SIMPER belum dibuat"));
                        return;
                    } else {
                        if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                            mkdir('./berkas/karyawan/' . $foldername, 0775, true);
                        }

                        if (is_dir('./berkas/karyawan/' . $foldername)) {
                            $simname = $_FILES['filesimkary']['name'];
                            $simtipe = $_FILES['filesimkary']['type'];
                            $simsize = $_FILES['filesimkary']['size'];

                            if ($filesimnm !== $simname) { //  ================== jika sim di ganti file =====================

                                if ($simname == "" || $simname == "Pilih file SIMPER/MINE PERMIT") {
                                    echo json_encode(array("statusCode" => 202, "filesim" => "SIM Polisi wajib diupload."));
                                    return;
                                }

                                if ($simtipe == "application\/pdf") {
                                    echo json_encode(array("statusCode" => 202, "filesim" => "Format file yang diupload wajib dalam bentuk pdf."));
                                    return;
                                }

                                if ($simsize > 70000) {
                                    echo json_encode(array("statusCode" => 202, "filesim" => "File melebihi batas ukuran file maksimal. Batas ukuran file maksimal 70kb."));
                                    return;
                                }

                                if ($filesimsv == "") {
                                    $_FILES['filesimkary']['name'] = $url_sim;
                                } else {
                                    $_FILES['filesimkary']['name'] = $filesimsv;
                                }

                                $config['upload_path'] = './berkas/karyawan/' . $foldername;
                                $config['allowed_types'] = 'pdf';
                                $config['max_size'] = 70;
                                $config['overwrite'] = true;
                                $this->load->library('upload', $config);
                                $this->load->initialize($config);
                                $this->upload->do_upload('filesimkary');
                            } else {
                                if ($filesimsv == "") {
                                    $_FILES['filesimkary']['name'] = $url_sim;
                                } else {
                                    $_FILES['filesimkary']['name'] = $filesimsv;
                                }
                            }

                            $smpname = $_FILES['filesmpkary']['name'];
                            $smptipe = $_FILES['filesmpkary']['type'];
                            $smpsize = $_FILES['filesmpkary']['size'];

                            // echo json_encode([$filesmpnm . " - " . $smpname]);
                            // return;

                            if ($filesmpnm !== $smpname) { //  ================== jika smp di ganti file =====================
                                if ($smpname == "" || $smpname == "Pilih file SIMPER/MINE PERMIT") {
                                    echo json_encode(array("statusCode" => 202, "filesmp" => "SIMPER/MINE PERMIT wajib diupload."));
                                    return;
                                }

                                if ($smptipe == "application\/pdf") {
                                    echo json_encode(array("statusCode" => 202, "filesmp" => "Format file yang diupload wajib dalam bentuk pdf."));
                                    return;
                                }

                                if ($smpsize > 70000) {
                                    echo json_encode(array("statusCode" => 202, "filesmp" => "File melebihi Batas ukuran file maksimal 70kb."));
                                    return;
                                }

                                if ($filesmpsv == "") {
                                    $_FILES['filesmpkary']['name'] = $url_izin;
                                } else {
                                    $_FILES['filesmpkary']['name'] = $filesmpsv;
                                }

                                $config['upload_path'] = './berkas/karyawan/' . $foldername;
                                $config['allowed_types'] = 'pdf';
                                $config['max_size'] = 70;
                                $config['overwrite'] = true;
                                $this->load->library('upload', $config);
                                $this->load->initialize($config);
                                $this->upload->do_upload('filesmpkary');
                            } else {
                                if ($filesmpsv == "") {
                                    $_FILES['filesmpkary']['name'] = $url_izin;
                                } else {
                                    $_FILES['filesmpkary']['name'] = $filesmpsv;
                                }
                            }

                            $id_izin = $this->kry->get_id_izin($auth_izin);
                            $dtizin = array(
                                'id_jenis_izin_tambang' => $jenisizin,
                                'no_reg' => $noreg,
                                'tgl_expired' => $tglexp,
                                'id_sim_kary' => $id_sim_kary,
                                'ket_izin_tambang' => '',
                            );

                            // echo json_encode([$_FILES['filesmpkary']['name'] . " - " . $_FILES['filesimkary']['name']]);
                            // return;

                            $upt_izin = $this->smp->update_izin($id_izin, $dtizin);
                            $id_sim_kary_last = $this->smp->get_id_simpol($auth_simpol);

                            $data_sim_polisi = [
                                'id_sim' => $jenissim,
                                'tgl_exp_sim' => $tglexpsim,
                                'ket_sim_kary' => '',
                            ];

                            $this->kry->update_sim($id_sim_kary_last, $data_sim_polisi);

                            echo json_encode(array(
                                "statusCode" => 200,
                                "pesan" => "Data SIMPER berhasil diupdate",
                                "filesim" => $simname,
                                "filesimsv" => $_FILES['filesimkary']['name'],
                                "filesmp" => $smpname,
                                "filesmpsv" => $_FILES['filesmpkary']['name'],
                            ));
                        } else {
                            echo json_encode(array("statusCode" => 201, "pesan" => "Folder data karyawan gagal dibuat"));
                            return;
                        }
                    }
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data unit SIMPER belum dibuat"));
                    return;
                }
            } else if ($jenisizin == 1) { // jika mine permit -------------------------------
                $id_sim_kary = 0;
                $tglexpsim = "1970-01-01";

                if ($auth_izin !== "") { // ====================== jika izin tambang sudah ada =======================
                    $id_izin = $this->smp->get_id_izin_tambang($auth_izin);
                    $cek_noreg_ada = $this->kry->cek_no_simper_ada($noreg, $id_izin);

                    if ($cek_noreg_ada) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "No. Register SIMPER/Mine Permit sudah digunakan"));
                        return;
                    }

                    $smpname = $_FILES['filesmpkary']['name'];
                    $smptipe = $_FILES['filesmpkary']['type'];
                    $smpsize = $_FILES['filesmpkary']['size'];

                    if ($filesmpnm != $smpname) { //  ================== jika sim di ganti =====================

                        if ($smpname == "") {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "MINE PERMIT wajib diupload."));
                            return;
                        }

                        if ($smptipe == "application\/pdf") {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "Format file yang diupload wajib dalam bentuk pdf."));
                            return;
                        }

                        if ($smpsize > 70000) {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "File MINE PERMIT melebihi batas ukuran file maksimal. Batas ukuran file maksimal 70kb."));
                            return;
                        }

                        if ($filesmpsv == "") {
                            $_FILES['filesmpkary']['name'] = $url_izin;
                        } else {
                            $_FILES['filesmpkary']['name'] = $filesmpsv;
                        }

                        // echo json_encode([$smpname]);
                        // return;

                        $config['upload_path'] = './berkas/karyawan/' . $foldername;
                        $config['allowed_types'] = 'pdf';
                        $config['max_size'] = 70;
                        $config['overwrite'] = true;
                        $this->load->library('upload', $config);
                        $this->load->initialize($config);
                        $this->upload->do_upload('filesmpkary');
                    } else {
                        if ($filesmpsv == "") {
                            $_FILES['filesmpkary']['name'] = $url_izin;
                        } else {
                            $_FILES['filesmpkary']['name'] = $filesmpsv;
                        }
                    }

                    $dtizin = array(
                        'id_jenis_izin_tambang' => $jenisizin,
                        'no_reg' => $noreg,
                        'tgl_expired' => $tglexp,
                        'id_sim_kary' => $id_sim_kary,
                        'url_izin_tambang' => $_FILES['filesmpkary']['name'],
                        'ket_izin_tambang' => '',
                    );

                    $upt_izin = $this->smp->update_izin($id_izin, $dtizin);
                    $linkizn = base_url('karyawan/berkasizinadd/' . $auth_izin);

                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "Data Mine Permit berhasil diupdate",
                        "filesmp" => $smpname,
                        "filesmpsv" => $_FILES['filesmpkary']['name'],
                        "linkizin" => $linkizn,
                    ));
                    return;
                } else { // ========================= jika belum ada izin tambang ===========================
                    $cek_noreg = $this->kry->cek_no_simper($noreg);
                    if ($cek_noreg) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "No. Register SIMPER/Mine Permit sudah digunakan"));
                        return;
                    }

                    if ($auth_kary !== "") {
                        $smpname = $_FILES['filesmpkary']['name'];
                        $smptipe = $_FILES['filesmpkary']['type'];
                        $smpsize = $_FILES['filesmpkary']['size'];

                        if ($smpname == "" || $smpname == "Pilih file SIMPER/MINE PERMIT") {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "MINE PERMIT wajib diupload."));
                            return;
                        }

                        if ($smptipe == "application\/pdf") {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "Format file yang diupload wajib dalam bentuk pdf."));
                            return;
                        }

                        if ($smpsize > 70000) {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "File MINE PERMIT melebihi batas ukuran file maksimal. Batas ukuran file maksimal 70kb."));
                            return;
                        }

                        $_FILES['filesmpkary']['name'] = $url_izin;
                        $config['upload_path'] = './berkas/karyawan/' . $foldername;
                        $config['allowed_types'] = 'pdf';
                        $config['max_size'] = 70;
                        $config['overwrite'] = true;
                        $this->load->library('upload', $config);
                        $this->load->initialize($config);
                        $this->upload->do_upload('filesmpkary');

                        $data_izin_tambang = [
                            'id_kary' => $id_karyawan,
                            'id_jenis_izin_tambang' => $jenisizin,
                            'no_Reg' => $noreg,
                            'tgl_expired' => $tglexp,
                            'id_sim_kary' => $id_sim_kary,
                            'url_izin_tambang' => $url_izin,
                            'ket_izin_tambang' => '',
                            'tgl_buat' => date('Y-m-d H:i:s'),
                            'tgl_edit' => date('Y-m-d H:i:s'),
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                        ];

                        $izin = $this->smp->input_izin_tambang($data_izin_tambang);

                        if ($izin) {
                            $last_izin = $this->smp->last_row_izin($auth_kary);

                            if (!empty($last_izin)) {
                                foreach ($last_izin as $list) {
                                    $auth_izin = $list->auth_izin_tambang;
                                }

                                $linkizn = base_url('karyawan/berkasizinadd/' . $auth_izin);

                                echo json_encode(array(
                                    "statusCode" => 200,
                                    "pesan" => "Data Mine Permit berhasil disimpan",
                                    "auth_izin" => $auth_izin,
                                    "filesmp" => $smpname,
                                    "filesmpsv" => $url_izin,
                                    "linkizin" => $linkizn,
                                ));
                            } else {
                                echo json_encode(array(
                                    "statusCode" => 201,
                                    "pesan" => "Error saat mengambil data Mine Permit",
                                ));
                            }
                        } else {
                            echo json_encode(array("statusCode" => 201, "pesan" => "Data Mine Permit gagal disimpan"));
                        }
                    } else {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data karyawan"));
                    }
                }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Kode jenis izin tidak diketahui"));
                die;
            }
        }
    }

    public function addsimpernew()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $this->form_validation->set_rules("jenisizin", "jenisizin", "required|trim", [
            'required' => 'Jenis Izin wajib dipilih',
        ]);
        $this->form_validation->set_rules("noreg", "noreg", "required|trim|max_length[50]", [
            'required' => 'No. Register wajib diisi',
            'max_length' => 'No. Register maksimal 50 karakter',
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
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));

            if ($jenisizin == 2) { // ================= jika simper ===========================
                $filesim = htmlspecialchars($this->input->post("filesim", true));
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

                if ($filesim == "") {
                    $errsim = "<p>SIM Polisi wajib diupload</p>";
                } else {
                    $errsim = "";
                }
            } else {
                $errjenis = "";
                $errtglsim = "";
                $errsim = "";
            }

            if ($filesmp == "") {
                $errsmp = "<p>SIMPER / MINE PERMIT wajib diupload</p>";
            } else {
                $errsmp = "";
            }

            $error = [
                'statusCode' => 202,
                'jenisizin' => form_error("jenisizin"),
                'noreg' => form_error("noreg"),
                'tglexp' => form_error("tglexp"),
                'jenissim' => $errjenis,
                'tglexpsim' => $errtglsim,
                'filesim' => $errsim,
                'filesmp' => $errsmp,
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
            $noreg = htmlspecialchars($this->input->post("noreg", true));
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $jenissim = htmlspecialchars($this->input->post("jenissim", true));
            $tglexpsim = htmlspecialchars($this->input->post("tglexpsim", true));
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $filesimnm = htmlspecialchars($this->input->post("filesimnm", true));
            $filesimsv = htmlspecialchars($this->input->post("filesimsv", true));
            $filesmpnm = htmlspecialchars($this->input->post("filesmpnm", true));
            $filesmpsv = htmlspecialchars($this->input->post("filesmpsv", true));
            $id_karyawan = $this->kry->get_id_karyawan($auth_kary);
            $id_personal = $this->kry->get_id_personal_by_kary($auth_kary);
            $id_sim_kary = $this->kry->get_sim_kary_by_idkary($id_karyawan);
            $url_izin = date('YmdHis') . '-SMP.pdf';
            $url_sim = date('YmdHis') . '-SIMPOL.pdf';
            $foldername = md5($id_personal);

            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
                return;
            }

            if ($jenisizin == 2) { // ===================== jika simper ==============================
                if($auth_izin == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data unit SIMPER belum dibuat"));
                    return;
                } else {
                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "Data SIMPER berhasil disimpan"
                    ));
                }
            } else if ($jenisizin == 1) { // jika mine permit -------------------------------
                $id_sim_kary = 0;
                $tglexpsim = "1970-01-01";

                $cek_noreg = $this->kry->cek_no_simper($noreg);
                    if ($cek_noreg) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "No. Register SIMPER/Mine Permit sudah digunakan"));
                        return;
                    }

                    if ($auth_kary !== "") {
                        $smpname = $_FILES['filesmpkary']['name'];
                        $smptipe = $_FILES['filesmpkary']['type'];
                        $smpsize = $_FILES['filesmpkary']['size'];

                        if ($smpname == "" || $smpname == "Pilih file SIMPER/MINE PERMIT") {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "MINE PERMIT wajib diupload."));
                            return;
                        }

                        if ($smptipe == "application\/pdf") {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "Format file yang diupload wajib dalam bentuk pdf."));
                            return;
                        }

                        if ($smpsize > 70000) {
                            echo json_encode(array("statusCode" => 202, "filesmp" => "File MINE PERMIT melebihi batas ukuran file maksimal. Batas ukuran file maksimal 70kb."));
                            return;
                        }

                        $_FILES['filesmpkary']['name'] = $url_izin;
                        $config['upload_path'] = './berkas/karyawan/' . $foldername;
                        $config['allowed_types'] = 'pdf';
                        $config['max_size'] = 70;
                        $config['overwrite'] = true;
                        $this->load->library('upload', $config);
                        $this->load->initialize($config);
                        $this->upload->do_upload('filesmpkary');

                        $data_izin_tambang = [
                            'id_kary' => $id_karyawan,
                            'id_jenis_izin_tambang' => $jenisizin,
                            'no_Reg' => $noreg,
                            'tgl_expired' => $tglexp,
                            'id_sim_kary' => $id_sim_kary,
                            'url_izin_tambang' => $url_izin,
                            'ket_izin_tambang' => '',
                            'tgl_buat' => date('Y-m-d H:i:s'),
                            'tgl_edit' => date('Y-m-d H:i:s'),
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                        ];

                        $izin = $this->smp->input_izin_tambang($data_izin_tambang);

                        if ($izin) {
                            $last_izin = $this->smp->last_row_izin($auth_kary);

                            if (!empty($last_izin)) {
                                foreach ($last_izin as $list) {
                                    $auth_izin = $list->auth_izin_tambang;
                                }

                                $linkizn = base_url('karyawan/berkasizinadd/' . $auth_izin);

                                echo json_encode(array(
                                    "statusCode" => 200,
                                    "pesan" => "Data Mine Permit berhasil disimpan",
                                    "auth_izin" => $auth_izin,
                                    "filesmp" => $smpname,
                                    "filesmpsv" => $url_izin,
                                    "linkizin" => $linkizn,
                                ));
                            } else {
                                echo json_encode(array(
                                    "statusCode" => 201,
                                    "pesan" => "Error saat mengambil data Mine Permit",
                                ));
                            }
                        } else {
                            echo json_encode(array("statusCode" => 201, "pesan" => "Data Mine Permit gagal disimpan"));
                        }
                    } else {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data karyawan"));
                    }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Kode jenis izin tidak diketahui"));
                die;
            }
        }
    }

    public function addsertifikasi()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $this->form_validation->set_rules("jenissrt", "jenissrt", "required|trim", [
            'required' => 'Jenis sertifikasi wajib dipilih',
        ]);
        $this->form_validation->set_rules("nosrt", "nosrt", "required|trim|max_length[50]", [
            'required' => 'No. Sertifikat wajib diisi',
            'max_length' => 'No. Sertikat maksimal 50 karakter',
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
                'namalembaga' => form_error("namalembaga"),
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $jenisizin = htmlspecialchars($this->input->post("jenissrt", true));
            $nosrt = htmlspecialchars($this->input->post("nosrt", true));
            $tglsrt = htmlspecialchars($this->input->post("tglsrt", true));
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $namalembaga = htmlspecialchars($this->input->post("namalembaga", true));
            $id_personal = $this->kry->get_id_personal($auth_person);
            $foldername = md5($id_personal);
            $now = date('YmdHis');
            $nama_file = $now . "-SRT.pdf";

            if ($auth_person == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                die;
            }

            if ($tglsrt > $tglexp) {
                $error = [
                    'statusCode' => 202,
                    'jenissrt' => "",
                    'nosrt' => "",
                    'tglsrt' => "",
                    'tglexp' => "Isi tanggal expired dengan benar",
                    'filesrt' => "",
                    'namalembaga' => "",
                ];

                echo json_encode($error);
                return;
            }

            if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                mkdir('./berkas/karyawan/' . $foldername, 0775, true);
            }

            if (is_dir('./berkas/karyawan/' . $foldername)) {
                $config['upload_path'] = './berkas/karyawan/' . $foldername;
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 300;
                $config['file_name'] = $nama_file;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('filesertifikat')) {
                    $err = $this->upload->display_errors();

                    if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                        $error = "<p>Ukuran file maksimal 300 kb.</p>";
                    } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                        $error = "<p>Format file nya dalam bentuk pdf</p>";
                    } else {
                        $error = $err;
                    }

                    echo json_encode(array("statusCode" => 202, "filesrt" => $error));
                } else {
                    if ($auth_person !== "") {
                        $data_sertifikat = [
                            'id_personal' => $id_personal,
                            'id_jenis_sertifikasi' => $jenisizin,
                            'no_sertifikasi' => $nosrt,
                            'lembaga' => $namalembaga,
                            'tgl_sertifikasi' => $tglsrt,
                            'tgl_berakhir_sertifikasi' => $tglexp,
                            'file_sertifikasi' => $nama_file,
                            'tgl_buat' => date('Y-m-d H:i:s'),
                            'tgl_edit' => date('Y-m-d H:i:s'),
                            'id_user' => $this->session->userdata('id_user_hcdata'),
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

    public function newsertifikasi()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $this->form_validation->set_rules("jenis", "jenis", "required|trim", [
            'required' => 'Jenis sertifikasi wajib dipilih',
        ]);
        $this->form_validation->set_rules("no_ser", "no_ser", "required|trim|max_length[50]", [
            'required' => 'No. Sertifikat wajib diisi',
            'max_length' => 'No. Sertikat maksimal 50 karakter',
        ]);
        $this->form_validation->set_rules("tgl_ser", "tgl_ser", "required|trim", [
            'required' => 'Tanggal sertifikat wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_akhir_ser", "tgl_akhir_ser", "required|trim", [
            'required' => 'Tanggal expired wajib diisi',
        ]);
        $this->form_validation->set_rules("file_ser", "file_ser", "required|trim", [
            'required' => 'File sertifikat wajib diupload',
        ]);
        $this->form_validation->set_rules("lembaga", "lembaga", "required|trim", [
            'required' => 'Nama lembaga wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'jenis' => form_error("jenis"),
                'nosrt' => form_error("nosrt"),
                'tgl_ser' => form_error("tgl_ser"),
                'tgl_akhir_ser' => form_error("tgl_akhir_ser"),
                'file_ser' => form_error("file_ser"),
                'lembaga' => form_error("lembaga"),
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $jenis = htmlspecialchars($this->input->post("jenis", true));
            $no_ser = htmlspecialchars($this->input->post("no_ser", true));
            $tgl_ser = htmlspecialchars($this->input->post("tgl_ser", true));
            $tgl_akhir_ser = htmlspecialchars($this->input->post("tgl_akhir_ser", true));
            $lembaga = htmlspecialchars($this->input->post("lembaga", true));
            $id_personal = $this->kry->get_id_personal_by_kary($auth_kary);
            $foldername = md5($id_personal);
            $now = date('YmdHis');
            $nama_file = $now . "-SRT.pdf";

            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
                die;
            }

            if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                mkdir('./berkas/karyawan/' . $foldername, 0775, true);
            }

            if (is_dir('./berkas/karyawan/' . $foldername)) {
                $config['upload_path'] = './berkas/karyawan/' . $foldername;
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 300;
                $config['file_name'] = $nama_file;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('fl_ser')) {
                    $err = $this->upload->display_errors();

                    if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                        $error = "<p>Ukuran file maksimal 300 kb.</p>";
                    } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                        $error = "<p>Format file nya dalam bentuk pdf</p>";
                    } else {
                        $error = $err;
                    }

                    echo json_encode(array(
                        "statusCode" => 202,
                        'jenis' => form_error("jenis"),
                        'nosrt' => form_error("nosrt"),
                        'tgl_ser' => form_error("tgl_ser"),
                        'tgl_akhir_ser' => form_error("tgl_akhir_ser"),
                        'file_ser' => form_error("file_ser"),
                        'lembaga' => form_error("lembaga"),
                        "filesrt" => $error,
                    ));
                } else {
                    if ($auth_kary !== "") {
                        $data_sertifikat = [
                            'id_personal' => $id_personal,
                            'id_jenis_sertifikasi' => $jenis,
                            'no_sertifikasi' => $no_ser,
                            'lembaga' => $lembaga,
                            'tgl_sertifikasi' => $tgl_ser,
                            'tgl_berakhir_sertifikasi' => $tgl_akhir_ser,
                            'file_sertifikasi' => $nama_file,
                            'tgl_buat' => date('Y-m-d H:i:s'),
                            'tgl_edit' => date('Y-m-d H:i:s'),
                            'id_user' => $this->session->userdata('id_user_hcdata'),
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

    public function newMCU()
    {
        $this->form_validation->set_rules("tglMCU", "tglMCU", "required|trim", [
            'required' => 'Tanggal MCU wajib diisi',
        ]);
        $this->form_validation->set_rules("hasilMCU", "hasilMCU", "required|trim", [
            'required' => 'Hasil MCU wajib dipilih',

        ]);
        $this->form_validation->set_rules("ketMCU", "ketMCU", "required|trim|max_length[1000]", [
            'required' => 'Keterangan MCU wajib diisi',
            'max_length' => 'Keterangan MCU maksimal 1000 karakter',
        ]);
        $this->form_validation->set_rules("file_MCU", "file_MCU", "required|trim", [
            'required' => 'File MCU wajib di-upload',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'tglMCU' => form_error("tglMCU"),
                'hasilMCU' => form_error("hasilMCU"),
                'ketMCU' => form_error("ketMCU"),
                'file_MCU' => form_error("file_MCU"),
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $tglMCU = htmlspecialchars($this->input->post("tglMCU", true));
            $hasilMCU = htmlspecialchars($this->input->post("hasilMCU", true));
            $ketMCU = htmlspecialchars($this->input->post("ketMCU", true));
            $id_personal = $this->kry->get_id_personal_by_kary($auth_kary);
            $foldername = md5($id_personal);
            $now = date('YmdHis');
            $nama_file = $now . "-SRT.pdf";

            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
                die;
            }

            if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                mkdir('./berkas/karyawan/' . $foldername, 0775, true);
            }

            if (is_dir('./berkas/karyawan/' . $foldername)) {
                $config['upload_path'] = './berkas/karyawan/' . $foldername;
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 300;
                $config['file_name'] = $nama_file;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('fl_MCU')) {
                    $err = $this->upload->display_errors();

                    if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                        $error = "<p>Ukuran file maksimal 300 kb.</p>";
                    } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                        $error = "<p>Format file nya dalam bentuk pdf</p>";
                    } else {
                        $error = $err;
                    }

                    echo json_encode(array(
                        "statusCode" => 202,
                        'tglMCU' => form_error("tglMCU"),
                        'hasilMCU' => form_error("hasilMCU"),
                        'ketMCU' => form_error("ketMCU"),
                        'file_MCU' => form_error("file_MCU"),
                        "filesrt" => $error,
                    ));
                } else {
                    if ($auth_kary != "") {
                        $data_mcu = [
                            'id_personal' => $id_personal,
                            'id_mcu_jenis' => $hasilMCU,
                            'tgl_mcu' => $tglMCU,
                            'ket_mcu' => $ketMCU,
                            'hasil_follow_up' => '',
                            'tgl_follow_up' => '1970-01-01',
                            'tgl_akhir' => '1970-01-01',
                            'url_file' => $nama_file,
                            'stat_mcu' => 'T',
                            'tgl_buat' => date('Y-m-d H:i:s'),
                            'tgl_edit' => date('Y-m-d H:i:s'),
                            'id_perusahaan' => 0,
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                        ];

                        $mcu = $this->kry->input_dtMCU($data_mcu);
                        if ($mcu) {
                            $auth_mcu = $this->kry->last_row_authmcu();
                            $link = '/assets/berkas/karyawan/' . $foldername . '/' . $nama_file;
                            echo json_encode(array(
                                "statusCode" => 200,
                                "pesan" => "Data MCU berhasil disimpan",
                            ));
                        } else {
                            echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU gagal disimpan"));
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
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $this->form_validation->set_rules("tglmcu", "tglmcu", "required|trim", [
            'required' => 'Tanggal MCU wajib dipilih',
        ]);
        $this->form_validation->set_rules("hasilmcu", "hasilmcu", "required|trim|max_length[50]", [
            'required' => 'Hasil MCU wajib dipilih',
            'max_length' => 'Hasil MCU maksimal 50 karakter',
        ]);
        $this->form_validation->set_rules("ketmcu", "ketmcu", "required|trim", [
            'required' => 'Keterangan MCU wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'tglmcu' => form_error("tglmcu"),
                'hasilmcu' => form_error("hasilmcu"),
                'ketmcu' => form_error("ketmcu"),
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $auth_mcu = htmlspecialchars($this->input->post("auth_mcu", true));
            $tglmcu = htmlspecialchars($this->input->post("tglmcu", true));
            $hasilmcu = htmlspecialchars($this->input->post("hasilmcu", true));
            $ketmcu = htmlspecialchars($this->input->post("ketmcu", true));
            $id_personal = $this->kry->get_id_personal($auth_person);
            $foldername = md5($id_personal);
            $now = date('YmdHis');
            $nama_file = $now . "-MCU.pdf";

            if (empty($auth_person)) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                return;
            } else {
                $ck_person = $this->kry->cek_personal($auth_person);

                if ($ck_person == false) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                    return;
                }
            }

            if (!empty($auth_mcu)) {
                $ck_mcu = $this->kry->cek_mcu($auth_mcu);

                if ($ck_mcu == false) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU tidak ditemukan"));
                    return;
                }

                $data_mcu = $this->kry->get_mcu_by_authmcu_one($auth_mcu);

                $id_mcu = $data_mcu->id_mcu;
                $flemcu = $data_mcu->url_file;

                if ($id_mcu != "") {
                    if (is_dir('./berkas/karyawan/' . $foldername)) {
                        $config['upload_path'] = './berkas/karyawan/' . $foldername;
                        $config['allowed_types'] = 'pdf';
                        $config['max_size'] = 300;
                        $config['file_name'] = $nama_file;

                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('filemedik')) {
                            $err = $this->upload->display_errors();

                            if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                                $error = "<p>Ukuran file maksimal 300 kb.</p>";
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
                                "filmcu" => $err,
                            ];

                            echo json_encode($error);
                            die;
                        } else {
                            if ($flemcu != "") {
                                unlink('berkas/karyawan/' . $foldername . '/' . $flemcu);
                            }

                            $dtmcu = array(
                                'id_mcu_jenis' => $hasilmcu,
                                'tgl_mcu' => $tglmcu,
                                'ket_mcu' => $ketmcu,
                                'url_file' => $nama_file,
                            );

                            $u_mcu = $this->kry->update_mcu($id_mcu, $dtmcu);
                            if ($u_mcu == 200) {
                                $link = "";
                                echo json_encode(array("statusCode" => 200, "pesan" => "Data MCU berhasil diupdate"));
                                return;
                            } else {
                                echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU gagal diupdate"));
                            }
                        }
                    } else {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Folder penyimpanan tidak ditemukan"));
                    }
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Gagal memanggil data MCU"));
                }
            } else {
                if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                    mkdir('./berkas/karyawan/' . $foldername, 0775, true);
                }

                if (is_dir('./berkas/karyawan/' . $foldername)) {
                    $config['upload_path'] = './berkas/karyawan/' . $foldername;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 200;
                    $config['file_name'] = $nama_file;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('filemedik')) {
                        $err = $this->upload->display_errors();

                        // echo json_encode(array($err));
                        // return;

                        if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                            $error = "<p>Ukuran file maksimal 200 kb.</p>";
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
                            "filmcu" => $err,
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
                                    'id_user' => $this->session->userdata('id_user_hcdata'),
                                ];

                                $mcu = $this->kry->input_dtMCU($data_mcu);
                                if ($mcu) {
                                    $auth_mcu = $this->kry->last_row_authmcu();
                                    $link = base_url('karyawan/mcu/') . $auth_mcu;
                                    echo json_encode(array(
                                        "statusCode" => 200,
                                        "pesan" => "Data MCU berhasil disimpan",
                                        "auth_mcu" => $auth_mcu,
                                        "filemcu" => $nama_file,
                                        "link" => $link,
                                    ));
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

    public function cek_mcu()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $auth_mcu = htmlspecialchars($this->input->post("auth_mcu", true));
        $auth_person = htmlspecialchars($this->input->post("auth_person", true));

        if (!empty($auth_person)) {
            $query_mcu = $this->kry->cek_personal($auth_person);

            if ($auth_person == false) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Tidak dapat dilanjutkan, Data personal belum di-input"));
            } else {
                if (!empty($auth_mcu)) {
                    $query_mcu = $this->kry->cek_mcu($auth_mcu);

                    if ($query_mcu == false) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Tidak dapat dilanjutkan, Data MCU belum di-input"));
                    } else {
                        echo json_encode(array("statusCode" => 200, "pesan" => "Sukses"));
                    }
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Tidak dapat dilanjutkan, Data MCU belum di-input"));
                }
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Tidak dapat dilanjutkan, Data personal belum di-input"));
        }
    }

    public function cek_vaksin()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $this->form_validation->set_rules("auth_person", "auth_person", "required|trim", [
            'required' => 'Data personal tidak ditemukan',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 201,
                'auth_person' => form_error("auth_person"),
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $id_personal = $this->kry->get_id_personal($auth_person);

            if ($id_personal != "") {
                $vaksin = $this->vks->cek_data_vaksin($id_personal);
                if (!empty($vaksin)) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Data vaksin wajib diisi"));
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data vaksin tidak ada"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data personal"));
            }
        }
    }

    public function addvaksin()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $this->form_validation->set_rules("jenisvaksin", "jenisvaksin", "required|trim", [
            'required' => 'Jenis vaksin wajib dipilih',
        ]);
        $this->form_validation->set_rules("namavaksin", "namavaksin", "required|trim|max_length[20]", [
            'required' => 'Nama vaksin wajib diisi',
            'max_length' => 'Nama vaksin maksimal 20 karakter',
        ]);
        $this->form_validation->set_rules("tglvaksin", "tglvaksin", "required|trim", [
            'required' => 'Tanggal vaksin wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'jenisvaksin' => form_error("jenisvaksin"),
                'namavaksin' => form_error("namavaksin"),
                'tglvaksin' => form_error("tglvaksin"),
            ];

            echo json_encode($error);
            return;
        } else {
            $jenisvaksin = htmlspecialchars($this->input->post("jenisvaksin", true));
            $namavaksin = htmlspecialchars($this->input->post("namavaksin", true));
            $tglvaksin = htmlspecialchars($this->input->post("tglvaksin", true));
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $id_personal = $this->kry->get_id_personal($auth_person);
            $now = date("Y-m-d");

            if ($auth_person == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                die;
            }

            if ($tglvaksin > $now) {
                echo json_encode(array("statusCode" => 202, "tglvaksin" => "Isi tanggal vaksin dengan benar"));
                die;
            }

            if ($id_personal != "") {
                $data_vaksin = [
                    'id_personal' => $id_personal,
                    'id_vaksin_jenis' => $jenisvaksin,
                    'tgl_vaksin' => $tglvaksin,
                    'id_vaksin_nama' => $namavaksin,
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user_hcdata'),
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
        $auth = htmlspecialchars($this->input->post("token", true));
        $cekauth = $this->cek_auth($auth);

        if ($cekauth == 501) {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
        } else {

            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $idpersonal = $this->kry->get_id_personal($auth_person);
            $foldername = md5($idpersonal);

            if ($auth_person == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                die;
            }

            $dtperson = $this->kry->get_personal_by_auth($auth_person);
            if (!empty($dtperson)) {
                foreach ($dtperson as $list) {
                    $nama_file = $list->url_pendukung;
                }

                if ($nama_file == "") {
                    $now = date('YmdHis');
                    $nama_file = $now . "-SUPPORT.pdf";
                }

                if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                    mkdir('./berkas/karyawan/' . $foldername, 0775, true);
                }

                if (is_dir('./berkas/karyawan/' . $foldername)) {
                    $config['upload_path'] = './berkas/karyawan/' . $foldername;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 1000;
                    $config['file_name'] = $nama_file;
                    $config['overwrite'] = true;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('filePendukung')) {
                        $error = $this->upload->display_errors();
                        echo json_encode(array("statusCode" => 201, "pesan_muasd" => $error));
                        die;
                    } else {
                        $dt_personal = array(
                            'url_pendukung' => $nama_file,
                        );

                        $this->kry->update_dtPersonal($idpersonal, $dt_personal);
                        $link = base_url('karyawan/support/') . $auth_person;
                        echo json_encode(array(
                            "statusCode" => 200,
                            "pesan" => "File pendukung berhasil diupload",
                            "link" => $link,
                        ));
                    }
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload file pendukung"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
            }
        }
    }

    public function cek_file()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $cekauth = $this->cek_auth($auth);

        if ($cekauth == 501) {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
            return;
        } else {

            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
            $auth_mcu = htmlspecialchars($this->input->post("auth_mcu", true));

            if ($auth_person == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                return;
            }

            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
                return;
            }

            if ($auth_izin == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data SIMPER/Mine Permit tidak ditemukan"));
                return;
            }

            if ($auth_mcu == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU tidak ditemukan"));
                return;
            }

            $dtvaksin = $this->vks->get_vks_by_person($auth_person);
            if (empty($dtvaksin)) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data vaksin tidak ditemukan"));
                return;
            }

            // ======= cek foto =============
            $fotoname = $_FILES['flfoto']['name'];
            $fototype = $_FILES['flfoto']['type'];
            $fotosize = $_FILES['flfoto']['size'];

            if ($fotoname == "" || $fotoname == "Pilih file foto karyawan") {
                echo json_encode(array(
                    "statusCode" => 202,
                    "filefoto" => "Foto karyawan wajib diupload.",
                    "filedukung" => "",
                ));
                return;
            }

            if ($fototype == "application\/pdf") {
                echo json_encode(array(
                    "statusCode" => 202,
                    "filefoto" => "Format file foto yang diupload wajib dalam bentuk jpg.",
                    "filedukung" => "",
                ));
                return;
            }

            if ($fotosize > 100000) {
                echo json_encode(array(
                    "statusCode" => 202,
                    "filefoto" => "Ukuran file maksimal 100kb.",
                    "filedukung" => "",
                ));
                return;
            }

            // ========= cek pendukung =============
            $dukungname = $_FILES['fldukung']['name'];
            $dukungtype = $_FILES['fldukung']['type'];
            $dukungsize = $_FILES['fldukung']['size'];

            if ($dukungname == "" || $dukungname == "Pilih file pendukung") {
                echo json_encode(array(
                    "statusCode" => 202,
                    "filedukung" => "File pedukung wajib diupload.",
                    "filefoto" => "",
                ));
                return;
            }

            if ($dukungtype == "application\/pdf") {
                echo json_encode(array(
                    "statusCode" => 202,
                    "filedukung" => "Format file pendukung yang diupload wajib dalam bentuk jpg.",
                    "filefoto" => ""));
                return;
            }

            if ($dukungsize > 700000) {
                echo json_encode(array(
                    "statusCode" => 202,
                    "filedukung" => "Ukuran file maksimal 700kb.",
                    "filefoto" => ""));
                return;
            }

            $dtperson = $this->kry->get_personal_by_auth($auth_person);
            if (!empty($dtperson)) {
                foreach ($dtperson as $list) {
                    $id_personal = $list->id_personal;
                }

                $foldername = md5($id_personal);
                $namafile = date('YmdHis') . "-SUPPORT.pdf";
                $id_kary = $this->kry->get_id_karyawan($auth_kary);
                if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                    mkdir('./berkas/karyawan/' . $foldername, 0775, true);
                }

                if (is_dir('./berkas/karyawan/' . $foldername)) {
                    $config['upload_path'] = './berkas/karyawan/' . $foldername;
                    $config['allowed_types'] = '*';
                    $config['max_size'] = 70;
                    $this->load->library('upload', $config);
                    $this->load->initialize($config);
                    $this->upload->do_upload('flfoto');

                    $_FILES['fldukung']['name'] = $namafile;
                    $config['upload_path'] = './berkas/karyawan/' . $foldername;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 70;
                    $this->load->library('upload', $config);
                    $this->load->initialize($config);
                    $this->upload->do_upload('fldukung');

                    $dtfoto = [
                        'url_foto' => $_FILES['flfoto']['name'],
                    ];

                    $dtdukung = [
                        'url_pendukung' => $_FILES['fldukung']['name'],
                    ];

                    $updfoto = $this->kry->update_dtkary($id_kary, $dtfoto);
                    $upddukung = $this->kry->update_dtPersonal($id_personal, $dtdukung);

                    echo json_encode(array("statusCode" => 200, "pesan" => "Data karyawan berhasil disimpan"));
                } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Folder karyawan gagal dibuat"));
                }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal karyawan tidak ditemukan"));
            }
        }
    }

    public function get_stat_kerja($stat_kerja)
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
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

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
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $list = $this->kry->get_stat_nikah();
        if (!empty($list)) {
            $output = "<option value=''>-- PILIH PERNIKAHAN --</option>";
            $output = $output . "<option value='0'>-- WAJIB DIPILIH --</option>";
            foreach ($list as $stt) {
                $output = $output . "<option value=" . $stt->id_stat_nikah . ">" . $stt->stat_nikah . "</option>";
            }
        } else {
            $output = "<option value=''>-- Status pernikahan tidak ditemukan --</option>";
        }

        echo json_encode(array("statnikah" => $output));
    }

    public function get_sim()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $list = $this->kry->get_sim();
        if (!empty($list)) {
            $output = "<option value=''>-- PILIH SIM --</option>";
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
        echo json_encode($id_perusahaan);
    }

    public function get_all_tipe()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

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
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

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

    public function mcu($auth_mcu)
    {
        $dtmcu = $this->kry->get_dt_mcu($auth_mcu);
        if (!empty($dtmcu)) {
            foreach ($dtmcu as $list) {
                $url_file = $list->url_file;
                $id_personal = $list->id_personal;
            }
            $foldername = md5($id_personal);
            if (is_file("berkas/karyawan/" . $foldername . "/" . $url_file)) {
                $tofile = realpath("berkas/karyawan/" . $foldername . "/" . $url_file);
                header('Content-Type: application/pdf');
                readfile($tofile);
            } else {
                $this->load->view('errors/errnotfound');
            }
        } else {
            $this->load->view('errors/errnotfound');
        }
    }

    public function berkasizin($auth_izin_tambang)
    {
        $dtizin = $this->kry->get_dt_izin($auth_izin_tambang);
        if (!empty($dtizin)) {
            foreach ($dtizin as $list) {
                $url_izin_tambang = $list->url_izin_tambang;
                $id_m_perusahaan = $list->id_m_perusahaan;
                $id_personal = $list->id_personal;
            }

            $foldername = md5($id_personal);

            if ($id_m_perusahaan == 1) {
                $fileizin = "berkas/simper/" . $id_m_perusahaan . "/" . $url_izin_tambang;
            } else {
                $fileizin = "berkas/karyawan/" . $foldername . "/" . $url_izin_tambang;
            }

            if (is_file($fileizin)) {
                $tofile = realpath($fileizin);
                header('Content-Type: application/pdf');
                readfile($tofile);
            } else {
                $this->load->view('errors/errnotfound');
            }
        } else {
            $this->load->view('errors/errnotfound');
        }
    }

    public function berkasizinadd($auth_izin_tambang)
    {
        $dtizin = $this->kry->get_dt_izin($auth_izin_tambang);
        if (!empty($dtizin)) {
            foreach ($dtizin as $list) {
                $url_izin_tambang = $list->url_izin_tambang;
                $id_m_perusahaan = $list->id_m_perusahaan;
                $id_personal = $list->id_personal;
            }

            $foldername = md5($id_personal);

            if (is_file("berkas/karyawan/" . $foldername . "/" . $url_izin_tambang)) {
                $tofile = realpath("berkas/karyawan/" . $foldername . "/" . $url_izin_tambang);
                header('Content-Type: application/pdf');
                readfile($tofile);
            } else {
                $this->load->view('errors/errnotfound');
            }
        } else {
            $this->load->view('errors/errnotfound');
        }
    }

    public function berkassimadd($auth_simpol)
    {
        $dtsim = $this->kry->get_dt_sim($auth_simpol);
        if (!empty($dtsim)) {
            foreach ($dtsim as $list) {
                $url_file = $list->url_file;
                $id_personal = $list->id_personal;
            }

            $foldername = md5($id_personal);

            if (is_file("berkas/karyawan/" . $foldername . "/" . $url_file)) {
                $tofile = realpath("berkas/karyawan/" . $foldername . "/" . $url_file);
                header('Content-Type: application/pdf');
                readfile($tofile);
            } else {
                $this->load->view('errors/errnotfound');
            }
        } else {
            $this->load->view('errors/errnotfound');
        }
    }

    public function berkassim($auth_izin_tambang)
    {
        $dtizin = $this->kry->get_dt_izin($auth_izin_tambang);
        if (!empty($dtizin)) {
            foreach ($dtizin as $list) {
                $url_izin_tambang = $list->url_izin_tambang;
                $id_personal = $list->id_personal;
                $id_m_perusahaan = $list->id_m_perusahaan;
            }

            $dtsim = $this->kry->get_dt_sim_by_id($id_personal);

            if (!empty($dtsim)) {
                foreach ($dtsim as $list) {
                    $url_file = $list->url_file;
                }

                $foldername = md5($id_personal);

                if ($id_m_perusahaan == 1) {
                    $fileizin = "berkas/sim/" . $id_m_perusahaan . "/" . $url_file;
                } else {
                    $fileizin = "berkas/karyawan/" . $foldername . "/" . $url_file;
                }

                if (is_file($fileizin)) {
                    $tofile = realpath($fileizin);
                    header('Content-Type: application/pdf');
                    readfile($tofile);
                } else {
                    $this->load->view('errors/errnotfound');
                }
            } else {
                $this->load->view('errors/errnotfound');
            }

        } else {
            $this->load->view('errors/errnotfound');
        }
    }

    public function hapus_karyawan()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
        $hapusdata = $this->kry->hapus_karyawan($auth_kary);

        if ($hapusdata == 200) {
            echo json_encode(array(
                'statusCode' => 200,
                'pesan' => 'Data karyawan berhasil dihapus',
            ));
        } else if ($hapusdata == 201) {
            echo json_encode(array(
                'statusCode' => 201,
                'pesan' => 'Data karyawan gagal dihapus',
            ));
        } else {
            echo json_encode(array(
                'statusCode' => 201,
                'pesan' => 'Data karyawan tidak ditemukan',
            ));
        }
    }

    public function sertifikat($auth_sertifikat)
    {
        $dtsertifikat = $this->srt->get_sertifikasi_id($auth_sertifikat);
        if (!empty($dtsertifikat)) {
            foreach ($dtsertifikat as $list) {
                $file_sertifikasi = $list->file_sertifikasi;
                $id_personal = $list->id_personal;
            }
            $foldername = md5($id_personal);
            if (is_file("berkas/karyawan/" . $foldername . "/" . $file_sertifikasi)) {
                $tofile = realpath("berkas/karyawan/" . $foldername . "/" . $file_sertifikasi);
                header('Content-Type: application/pdf');
                readfile($tofile);
            } else {
                $this->load->view('errors/errnotfound');
            }
        } else {
            $this->load->view('errors/errnotfound');
        }
    }

    public function support($auth_personal)
    {
        $dtpersonal = $this->kry->get_personal_by_auth($auth_personal);
        if (!empty($dtpersonal)) {
            foreach ($dtpersonal as $list) {
                $url_pendukung = $list->url_pendukung;
                $id_personal = $list->id_personal;
            }
            $foldername = md5($id_personal);
            if (is_file("berkas/karyawan/" . $foldername . "/" . $url_pendukung)) {
                $tofile = realpath("berkas/karyawan/" . $foldername . "/" . $url_pendukung);
                header('Content-Type: application/pdf');
                readfile($tofile);
            } else {
                $this->load->view('errors/errnotfound');
            }
        } else {
            $this->load->view('errors/errnotfound');
        }
    }

    public function cek_ktp()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $cekauth = $this->cek_auth($auth);

        if ($cekauth == 501) {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
        } else {
            $this->form_validation->set_rules("noktp", "noktp", "required|trim|max_length[20]", [
                'required' => 'No. KTP wajib diisi',
                'max_length' => 'No. KTP maksimal 16 karakter',
            ]);

            if ($this->form_validation->run() == false) {
                $error = [
                    'statusCode' => 201,
                    'noktp' => form_error("noktp"),
                ];

                echo json_encode($error);
                return;
            } else {
                $noktp = htmlspecialchars($this->input->post("noktp", true));

                $query = $this->kry->cek_noKTP($noktp);
                if ($query) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "No. KTP sudah digunakan", "tipe_pesan" => "error"));
                    return;
                } else {
                    echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "No. KTP belum digunakan", "tipe_pesan" => "success"));
                    return;
                }
            }
        }
    }

    public function verifikasi_ktp()
    {

        $auth = htmlspecialchars($this->input->post("token", true));
        $cekauth = $this->cek_auth($auth);

        if ($cekauth == 501) {
            echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
        } else {

            $this->form_validation->set_rules("noktp", "noktp", "required|trim|max_length[20]", [
                'required' => 'No. KTP wajib diisi',
                'max_length' => 'No. KTP maksimal 16 karakter',
            ]);

            if ($this->form_validation->run() == false) {
                $error = [
                    'statusCode' => 201,
                    'noktp' => form_error("noktp"),
                ];

                echo json_encode($error);
                return;
            } else {
                $noktp = htmlspecialchars($this->input->post("noktp", true));
                $dtperson = $this->kry->verifikasi_ktp($noktp);

                if (empty($dtperson)) {
                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "Data personal dengan No. KTP : " . $noktp . ", belum ada, silahkan lengkapi data selanjutnya",
                        "auth_personal" => "",
                    ));
                    return;
                } else {
                    if ($dtperson->tgl_nonaktif == null) {
                        $dtkary = $this->kry->get_karyawan_by_ktp($noktp);
                        if (!empty($dtkary)) {
                            $data = [
                                "statusCode" => 201,
                                "pesan" => 'Proses tidak dapat dilanjutkan, Data karyawan :',
                                "no_ktp" => $dtkary->no_ktp,
                                "nama_lengkap" => $dtkary->nama_lengkap,
                                "tgl_nonaktif" => date('d-M-Y', strtotime($dtkary->tgl_nonaktif)),
                                "lama_nonaktif" => "0 Hari",
                                "perusahaan" => $dtkary->nama_perusahaan,
                                "status" => 'AKTIF',
                            ];
                        } else {
                            $data = [
                                "statusCode" => 200,
                                "pesan" => "Data Karyawan dengan No. KTP : " . $noktp . ", belum ada, silahkan lengkapi data selanjutnya",
                                "auth_personal" => "",
                            ];
                        }

                        echo json_encode($data);
                        return;
                    } else {
                        $tgl_nonaktif = strtotime(date('Y-m-d', strtotime($dtperson->tgl_nonaktif)));
                        $tgl_Sekarang = strtotime(date('Y-m-d'));
                        $jarak = $tgl_Sekarang - $tgl_nonaktif;
                        $hari = $jarak / 60 / 60 / 24;

                        if ($hari > 90) {
                            $dtpersonal = $this->kry->get_personal_by_ktp($noktp);
                            if (!empty($dtpersonal)) {
                                $dtalamat = $this->kry->get_alamat_by_id_person($dtpersonal->id_personal);
                                if (!empty($dtalamat)) {
                                    foreach ($dtalamat as $ls) {
                                        $alamat = $ls->alamat_ktp;
                                        $prov = $ls->prov_ktp;
                                        $kab = $ls->kab_ktp;
                                        $kec = $ls->kec_ktp;
                                        $kel = $ls->kel_ktp;
                                        $rt = $ls->rt_ktp;
                                        $rw = $ls->rw_ktp;
                                        $auth_alamat = $ls->auth_alamat;
                                    }
                                } else {
                                    $alamat = '';
                                    $prov = '';
                                    $kab = '';
                                    $kec = '';
                                    $kel = '';
                                    $rt = '';
                                    $rw = '';
                                    $auth_alamat = '';
                                }

                                $data = [
                                    "statusCode" => 202,
                                    "pesan" => 'Data berhasil ditemukan',
                                    "auth_personal" => $dtpersonal->auth_personal,
                                    "auth_alamat" => $auth_alamat,
                                    "no_ktp" => $dtpersonal->no_ktp,
                                    "nama" => $dtpersonal->nama_lengkap,
                                    "alamat" => $alamat,
                                    "rt" => $rt,
                                    "rw" => $rw,
                                    "kel" => $kel,
                                    "kec" => $kec,
                                    "kab" => $kab,
                                    "prov" => $prov,
                                    "warga_negara" => $dtpersonal->warga_negara,
                                    "agama" => $dtpersonal->id_agama,
                                    "jk" => $dtpersonal->jk,
                                    "stat_nikah" => $dtpersonal->id_stat_nikah,
                                    "tmp_lahir" => $dtpersonal->tmp_lahir,
                                    "tgl_lahir" => $dtpersonal->tgl_lahir,
                                    "bpjs_tk" => $dtpersonal->no_bpjstk,
                                    "bpjs_ks" => $dtpersonal->no_bpjstk,
                                    "npwp" => $dtpersonal->no_npwp,
                                    "no_kk" => $dtpersonal->no_kk,
                                    "email_pribadi" => $dtpersonal->email_pribadi,
                                    "no_telp" => $dtpersonal->hp_1,
                                    "didik_terakhir" => $dtpersonal->id_pendidikan,
                                ];
                            } else {
                                $data = [
                                    "statusCode" => 201,
                                    "auth_personal" => 'Data personal tidak ditemukan',
                                ];
                            }

                            echo json_encode($data);
                            return;
                        } else {
                            $dtkary = $this->kry->get_karyawan_by_ktp($noktp);
                            if (!empty($dtkary)) {
                                $data = [
                                    "statusCode" => 201,
                                    "pesan" => 'Proses tidak dapat dilanjutkan, Data karyawan :',
                                    "no_ktp" => $dtkary->no_ktp,
                                    "nama_lengkap" => $dtkary->nama_lengkap,
                                    "tgl_nonaktif" => date('d-M-Y', strtotime($dtkary->tgl_nonaktif)),
                                    "lama_nonaktif" => $hari . " Hari",
                                    "perusahaan" => $dtkary->nama_perusahaan,
                                    "status" => 'NONAKTIF',
                                ];
                            }

                            echo json_encode($data);
                            return;
                        }
                    }
                }
            }
        }
    }

    // fetch data karyawan
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
                "pesan" => "Autentikasi tidak valid, refresh data",

            );

            echo json_encode($output);
        } else {
            $ck = $this->input->get("ck");
            $auth_m_per = $this->input->get("auth_m_per");
            $list = $this->kry->get_datatables($auth_m_per, $ck);
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
                $row['kode_perusahaan'] = $kry->kode_perusahaan;

                $kd_per = $this->prs->get_kode_per_by_parent($kry->id_m_perusahaan);
                if (!empty($kd_per)) {
                    $row['kode_m_perusahaan'] = $kry->kode_perusahaan . " | " . $kd_per;
                } else {
                    $row['kode_m_perusahaan'] = $kry->kode_perusahaan . " | - ";
                }

                $row['posisi'] = $kry->posisi;
                if ($kry->tgl_nonaktif == null) {
                    $row['stat_aktif'] = '<span class="btn btn-success btn-sm" style="cursor:text;">AKTIF</span>';
                } else {
                    $row['stat_aktif'] = '<span class="btn btn-danger btn-sm" style="cursor:text;">NONAKTIF</span>';
                }

                $row['tgl_buat'] = date('d-M-Y', strtotime($kry->tgl_buat));
                $row['proses'] = '<div class="dropdown dropleft"><button id="' . $kry->auth_karyawan . '" class="btn btn-success btn-sm font-weight-bold aksikary" aria-haspopup="true" title="Aksi" data-toggle="dropdown" aria-expanded="false" value="' . $kry->nama_lengkap . '"> ... </button>
                    <div class="dropdown-menu">
                    <a id="' . $kry->auth_karyawan . '" class="dropdown-item btnDetailKary" title ="Detail" href="' . base_url('karyawan/detail/' . $kry->auth_karyawan) . '" target="_blank">Detail</a>
                    <a id="' . $kry->auth_karyawan . '" class="dropdown-item btnHapusKary" title ="Hapus" value="' . $kry->nama_lengkap . '">Hapus</a>
                    <a id="' . $kry->auth_karyawan . '" class="dropdown-item btnEditKary" title ="Edit" href="' . base_url('karyawan/edit_karyawan/' . $kry->auth_karyawan) . '" value="' . $kry->nama_lengkap . '">Edit</a>
                    <a id="' . $kry->auth_karyawan . '" class="dropdown-item btnFotoKaryawan" dt1= "' . $kry->no_nik . '" dt2="' . $kry->nama_lengkap . '" dt3="' . $kry->nama_perusahaan . '" title ="Foto Karyawan" href="#!">Foto Karyawan</a>
                    <a id="' . $kry->auth_karyawan . '" class="dropdown-item btnSIMPER" dt1= "' . $kry->no_nik . '" dt2="' . $kry->nama_lengkap . '" dt3="' . $kry->nama_perusahaan . '" title ="SIMPER/Mine Permit" href="#!">SIMPER/Mine Permit</a>
                    <a id="' . $kry->auth_karyawan . '" class="dropdown-item btnSertifikasi" dt1= "' . $kry->no_nik . '" dt2="' . $kry->nama_lengkap . '" dt3="' . $kry->nama_perusahaan . '" title ="Sertifikasi" href="#!">Sertifikasi</a>
                    <a id="' . $kry->auth_karyawan . '" class="dropdown-item btnMCU" dt1= "' . $kry->no_nik . '" dt2="' . $kry->nama_lengkap . '" dt3="' . $kry->nama_perusahaan . '" title ="MCU" href="#!">MCU</a>
                    <a id="' . $kry->auth_karyawan . '" class="dropdown-item btnVaksin" dt1= "' . $kry->no_nik . '" dt2="' . $kry->nama_lengkap . '" dt3="' . $kry->nama_perusahaan . '" title ="Vaksin" href="#!">Vaksin</a>
                    <a id="' . $kry->auth_karyawan . '" class="dropdown-item btnFilePendukung" dt1= "' . $kry->no_nik . '" dt2="' . $kry->nama_lengkap . '" dt3="' . $kry->nama_perusahaan . '" title ="File Pendukung" href="#!">File Pendukung</a>
                    </div>
                    </div>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->kry->count_all(),
                "recordsFiltered" => $this->kry->count_filtered($auth_m_per, $ck),
                "data" => $data,
            );

            //output to json format
            echo json_encode($output);
        }
    }

    public function update_personal()
    {
        $this->form_validation->set_rules("no_ktp", "no_ktp", "required|trim|numeric|max_length[16]|min_length[16]", [
            'required' => 'No. KTP wajib diisi',
            'numeric' => 'Wajib diisi dengan angka',
            'max_length' => 'No. KTP maksimal 16 karakter',
            'min_length' => 'No. KTP minimal 16 karakter',
        ]);
        $this->form_validation->set_rules("no_kk", "no_kk", "required|trim|max_length[16]|min_length[16]", [
            'required' => 'No. Kartu Keluarga wajib diisi',
            'numeric' => 'Wajib diisi dengan angka',
            'max_length' => 'No. Kartu Keluarga maksimal 16 karakter',
            'min_length' => 'No. Kartu Keluarga minimal 16 karakter',
        ]);
        $this->form_validation->set_rules("nama_lengkap", "nama_lengkap", "required|trim", [
            'required' => 'Nama wajib dipilih',
        ]);
        $this->form_validation->set_rules("jk", "jk", "required|trim", [
            'required' => 'Jenis kelamin wajib dipilih',
        ]);
        $this->form_validation->set_rules("tmp_lahir", "tmp_lahir", "required|trim|max_length[100]", [
            'required' => 'Tempat lahir wajib diisi',
            'max_length' => 'Tempat Lahir maksimal 100 karakter',
        ]);
        $this->form_validation->set_rules("tgl_lahir", "tgl_lahir", "required|trim", [
            'required' => 'Tanggal lahir wajib diisi',
        ]);
        $this->form_validation->set_rules("id_stat_nikah", "id_stat_nikah", "required|trim", [
            'required' => 'Status pernikahan wajib diisi',
        ]);
        $this->form_validation->set_rules("id_agama", "id_agama", "required|trim", [
            'required' => 'Agama wajib dipilih',
        ]);
        $this->form_validation->set_rules("warga_negara", "warga_negara", "required|trim", [
            'required' => 'Warga negara wajib diisi',
        ]);
        $this->form_validation->set_rules("email_pribadi", "email_pribadi", "trim|valid_email", [
            'valid_email' => 'Format email anda salah',
        ]);
        $this->form_validation->set_rules("hp_1", "hp_1", "trim|numeric", [
            'numeric' => 'No. Telp. wajib diisi dengan angka',
        ]);
        $this->form_validation->set_rules("no_bpjstk", "no_bpjstk", "trim");
        $this->form_validation->set_rules("no_bpjskes", "no_bpjskes", "trim");
        $this->form_validation->set_rules("no_npwp", "no_npwp", "trim");

        if ($this->form_validation->run() == false) {
            $no_npwp = htmlspecialchars($this->input->post("no_npwp", true));
            $no_npwp_num = str_replace([".", "-", "_"], "", $no_npwp);
            $jml_no_npwp = strlen($no_npwp_num);
            if ($no_npwp != "") {
                if ($jml_no_npwp < 15) {
                    $errno_npwp = "<p>No. NPWP tidak boleh kurang dari 15 karakter</p>";
                } else {
                    $errno_npwp = "";
                }
            } else {
                $errno_npwp = "";
            }

            $error = [
                'statusCode' => 202,
                'no_ktp' => form_error("no_ktp"),
                'no_kk' => form_error("no_kk"),
                'nama_lengkap' => form_error("nama_lengkap"),
                'jk' => form_error("jk"),
                'tmp_lahir' => form_error("tmp_lahir"),
                'tgl_lahir' => form_error("tgl_lahir"),
                'id_stat_nikah' => form_error("id_stat_nikah"),
                'id_agama' => form_error("id_agama"),
                'warga_negara' => form_error("warga_negara"),
                'email_pribadi' => form_error("email_pribadi"),
                'hp_1' => form_error("hp_1"),
                'no_bpjstk' => form_error("no_bpjstk"),
                'no_bpjskes' => form_error("no_bpjskes"),
                'no_npwp' => form_error("no_npwp"),
                'npwp' => $errno_npwp,
            ];

            echo json_encode($error);
            return;
        } else {
            // data personal
            $id_personal = $this->input->post("id_personal", true);
            $no_ktp_old = htmlspecialchars($this->input->post("no_ktp_old", true));
            $no_kk_old = htmlspecialchars($this->input->post("no_kk_old", true));
            $no_ktp = htmlspecialchars($this->input->post("no_ktp", true));
            $no_kk = htmlspecialchars($this->input->post("no_kk", true));
            $nama_lengkap = htmlspecialchars($this->input->post("nama_lengkap", true));
            $jk = htmlspecialchars($this->input->post("jk", true));
            $tmp_lahir = htmlspecialchars($this->input->post("tmp_lahir", true));
            $tgl_lahir = htmlspecialchars($this->input->post("tgl_lahir", true));
            $id_stat_nikah = htmlspecialchars($this->input->post("id_stat_nikah", true));
            $id_agama = htmlspecialchars($this->input->post("id_agama", true));
            $warga_negara = htmlspecialchars($this->input->post("warga_negara", true));
            $email_pribadi = htmlspecialchars($this->input->post("email_pribadi", true));
            $hp_1 = htmlspecialchars($this->input->post("hp_1", true));
            $no_bpjstk = htmlspecialchars($this->input->post("no_bpjstk", true));
            $no_bpjskes = htmlspecialchars($this->input->post("no_bpjskes", true));
            $no_npwp = htmlspecialchars($this->input->post("no_npwp", true));
            $id_pendidikan = htmlspecialchars($this->input->post("id_pendidikan", true));
            $tgl_buat = htmlspecialchars($this->input->post("tgl_buat", true));
            $tgl_edit = htmlspecialchars($this->input->post("tgl_edit", true));
            $id_user = htmlspecialchars($this->input->post("id_user", true));

            // data alamat
            $id_alamat_ktp = htmlspecialchars($this->input->post("id_alamat_ktp", true));
            $alamat_ktp = htmlspecialchars($this->input->post("alamat_ktp", true));
            $rt_ktp = htmlspecialchars($this->input->post("rt_ktp", true));
            $rw_ktp = htmlspecialchars($this->input->post("rw_ktp", true));
            $prov_ktp = htmlspecialchars($this->input->post("prov_ktp", true));
            $kab_ktp = htmlspecialchars($this->input->post("kab_ktp", true));
            $kec_ktp = htmlspecialchars($this->input->post("kec_ktp", true));
            $kel_ktp = htmlspecialchars($this->input->post("kel_ktp", true));

            // verif tgl.lahir
            $ynow = date("Y");
            $ylahir = date("Y", strtotime($tgl_lahir));
            $usia = intval($ynow) - intval($ylahir);
            if ($usia <= 15) {
                echo json_encode(array("statusCode" => 403, "status" => "Unauthorized", "pesan" => "Usia kurang dari 15 tahun, isi tanggal lahir anda dengan benar"));
                return;
            } else if ($usia >= 75) {
                echo json_encode(array("statusCode" => 403, "status" => "Unauthorized", "pesan" => "Isi tanggal lahir anda dengan benar"));
                return;
            }

            $data_personal = array(
                'no_ktp' => $no_ktp,
                'no_kk' => $no_kk,
                'nama_lengkap' => $nama_lengkap,
                'nama_alias' => '',
                'jk' => $jk,
                'tmp_lahir' => $tmp_lahir,
                'tgl_lahir' => $tgl_lahir,
                'id_stat_nikah' => $id_stat_nikah,
                'id_agama' => $id_agama,
                'warga_negara' => $warga_negara,
                'email_pribadi' => $email_pribadi,
                'hp_1' => $hp_1,
                'hp_2' => 0,
                'nama_ibu' => '',
                'stat_ibu' => '',
                'nama_ayah' => '',
                'stat_ayah' => '',
                'no_bpjstk' => $no_bpjstk,
                'no_bpjskes' => $no_bpjskes,
                'no_bpjspensiun' => '',
                'no_equity' => '',
                'no_npwp' => $no_npwp,
                'id_pendidikan' => $id_pendidikan,
                'nama_sekolah' => '',
                'fakultas' => '',
                'jurusan' => '',
                'url_pendukung' => '',
                'tgl_buat' => $tgl_buat,
                'tgl_edit' => $tgl_edit,
                'id_user' => $id_user,
            );

            $data_alamat_ktp = array(
                'id_alamat_ktp' => $id_alamat_ktp,
                'alamat_ktp' => $alamat_ktp,
                'rt_ktp' => $rt_ktp,
                'rw_ktp' => $rw_ktp,
                'kel_ktp' => $kel_ktp,
                'kec_ktp' => $kec_ktp,
                'kab_ktp' => $kab_ktp,
                'prov_ktp' => $prov_ktp,
                'kode_pos_ktp' => "",
                'ket_alamat_ktp' => "",
                'stat_alamat_ktp' => "",
                'tgl_buat' => $tgl_buat,
                'tgl_edit' => $tgl_edit,
                'id_user' => $id_user,
            );

            if ($no_ktp != $no_ktp_old) {
                // verif no. KTP
                $query = $this->kry->cek_noKTP($no_ktp);
                if ($query) {
                    echo json_encode(array("statusCode" => 403, "status" => "Unauthorized", "pesan" => "No. KTP sudah digunakan"));
                    return;
                }
            }
            // else if ($no_kk != $no_kk_old) {
            //      // verif no. KK
            //      $query = $this->kry->cek_noKK($no_kk);
            //      if ($query) {
            //           echo json_encode(array("statusCode" => 403, "status" => "Unauthorized", "pesan" => "No. Kartu Keluarga sudah digunakan"));
            //           return;
            //      }
            // }

            $save_dtPersonal = $this->kry->update_dtPersonal($id_personal, $data_personal);
            $save_dtAlamatKtp = $this->kry->update_dtAlamat($id_alamat_ktp, $data_alamat_ktp);

            if ($save_dtPersonal && $save_dtAlamatKtp) {
                echo json_encode(array("statusCode" => 204, "status" => "Success", "pesan" => "Data personal berhasil diperbarui."));
            } else if (!$save_dtPersonal) {
                echo json_encode(array("statusCode" => 400, "status" => "Bad Request", "pesan" => "Terjadi kesalahan saat menyimpan data personal."));
            } else if (!$save_dtAlamatKtp) {
                echo json_encode(array("statusCode" => 400, "status" => "Bad Request", "pesan" => "Terjadi kesalahan saat menyimpan data alamat."));
            }
        }
    }

    public function hirarki()
    {
        $prs = htmlspecialchars($this->input->post("prs", true));
        $id_m_per = $this->str->get_id_per($prs);

        $query = $this->kry->getHirarki($id_m_per);
        echo $query;
    }

    public function update_karyawan()
    {
        $this->form_validation->set_rules("no_nik", "no_nik", "required|trim|numeric|max_length[25]", [
            'required' => 'NRP wajib diisi',
            'numeric' => 'Wajib diisi dengan angka',
            'max_length' => 'NRP maksimal 25 karakter',
        ]);
        $this->form_validation->set_rules("auth_depart", "auth_depart", "required|trim", [
            'required' => 'Departemen wajib dipilih',
        ]);
        $this->form_validation->set_rules("auth_posisi", "auth_posisi", "required|trim", [
            'required' => 'Posisi wajib dipilih',
        ]);
        $this->form_validation->set_rules("auth_lokker", "auth_lokker", "required|trim", [
            'required' => 'Lokasi kerja wajib dipilih',
        ]);
        $this->form_validation->set_rules("auth_lokterima", "auth_lokterima", "required|trim", [
            'required' => 'Lokasi penerimaan wajib dipilih',
        ]);
        $this->form_validation->set_rules("auth_poh", "auth_poh", "required|trim", [
            'required' => 'Point of Hire wajib dipilih',
        ]);
        $this->form_validation->set_rules("auth_tipe", "auth_tipe", "required|trim", [
            'required' => 'Tipe wajib dipilih',
        ]);
        $this->form_validation->set_rules("auth_level", "auth_level", "required|trim", [
            'required' => 'Grade wajib dipilih',
        ]);
        $this->form_validation->set_rules("doh", "doh", "required|trim", [
            'required' => 'Date of Hire wajib diisi',
        ]);
        $this->form_validation->set_rules("tgl_aktif", "tgl_aktif", "required|trim", [
            'required' => 'Tanggal aktif wajib diisi',
        ]);
        $this->form_validation->set_rules("id_klasifikasi", "id_klasifikasi", "required|trim", [
            'required' => 'Klasifikasi wajib dipilih',
        ]);
        $this->form_validation->set_rules("stat_tinggal", "stat_tinggal", "required|trim", [
            'required' => 'Warga negara wajib diisi',
        ]);
        $this->form_validation->set_rules("email_kantor", "email_kantor", "trim|valid_email", [
            'valid_email' => 'Format email salah',
        ]);
        $this->form_validation->set_rules("stat_kerja", "stat_kerja", "required|trim", [
            'required' => 'Status karyawan wajib dipilih',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'no_nik' => form_error("no_nik"),
                'depart' => form_error("auth_depart"),
                'posisi' => form_error("auth_posisi"),
                'id_lokker' => form_error("auth_lokker"),
                'id_lokterima' => form_error("auth_lokterima"),
                'id_tipe' => form_error("auth_tipe"),
                'id_level' => form_error("auth_level"),
                'doh' => form_error("doh"),
                'tgl_aktif' => form_error("tgl_aktif"),
                'id_poh' => form_error("auth_poh"),
                'id_klasifikasi' => form_error("id_klasifikasi"),
                'stat_tinggal' => form_error("stat_tinggal"),
                'stat_kerja' => form_error("stat_kerja"),
                'email_kantor' => form_error("email_kantor"),
                'tgl_mulai_kontrak' => form_error("tgl_mulai_kontrak"),
                'tgl_akhir_kontrak' => form_error("tgl_akhir_kontrak"),
            ];

            echo json_encode($error);
            return;
        } else {
            $id_karyawan = htmlspecialchars($this->input->post("id_karyawan", true));
            $no_ktp = htmlspecialchars($this->input->post("no_ktp", true));
            $no_kk = htmlspecialchars($this->input->post("no_kk", true));
            $auth_ktr = htmlspecialchars($this->input->post("auth_ktr", true));
            $no_nik = htmlspecialchars($this->input->post("no_nik", true));
            $auth_depart = htmlspecialchars($this->input->post("auth_depart", true));
            $auth_posisi = htmlspecialchars($this->input->post("auth_posisi", true));
            $auth_lokker = htmlspecialchars($this->input->post("auth_lokker", true));
            $auth_lokterima = htmlspecialchars($this->input->post("auth_lokterima", true));
            $auth_poh = htmlspecialchars($this->input->post("auth_poh", true));
            $auth_tipe = htmlspecialchars($this->input->post("auth_tipe", true));
            $auth_level = htmlspecialchars($this->input->post("auth_level", true));
            $id_klasifikasi = htmlspecialchars($this->input->post("id_klasifikasi", true));
            $doh = htmlspecialchars($this->input->post("doh", true));
            $tgl_aktif = htmlspecialchars($this->input->post("tgl_aktif", true));
            $stat_tinggal = htmlspecialchars($this->input->post("stat_tinggal", true));
            $stat_kerja = htmlspecialchars($this->input->post("stat_kerja", true));
            $email_kantor = htmlspecialchars($this->input->post("email_kantor", true));
            $tgl_permanen = htmlspecialchars($this->input->post("tgl_permanen", true));
            $tgl_mulai_kontrak = htmlspecialchars($this->input->post("tgl_mulai_kontrak", true));
            $tgl_akhir_kontrak = htmlspecialchars($this->input->post("tgl_akhir_kontrak", true));
            $tgl_buat = htmlspecialchars($this->input->post("tgl_buat", true));
            $tgl_edit = htmlspecialchars($this->input->post("tgl_edit", true));
            $id_user = htmlspecialchars($this->input->post("id_user", true));
            // $auth_m_perusahaan = htmlspecialchars($this->input->post("auth_m_perusahaan", true));

            // if ($auth_m_perusahaan == "") {
            //      echo json_encode(array("statusCode" => 422, "status" => "error", "pesan" => "Data perusahaan tidak ditemukan"));
            //      die;
            // }

            $query = $this->get_stat_kerja($stat_kerja);
            if ($query == "T") {
                if ($tgl_mulai_kontrak == "" && $tgl_akhir_kontrak == "") {
                    echo json_encode(array("statusCode" => 422, "status" => "error", "pesan" => "", "pesan1" => "Tanggal mulai wajib diisi", "pesan2" => "Tanggal akhir wajib diisi"));
                    return;
                } else if ($tgl_mulai_kontrak == "") {
                    echo json_encode(array("statusCode" => 422, "status" => "error", "pesan" => "", "pesan1" => "Tanggal mulai wajib diisi", "pesan2" => ""));
                    return;
                } else if ($tgl_akhir_kontrak == "") {
                    echo json_encode(array("statusCode" => 422, "status" => "error", "pesan" => "", "pesan1" => "", "pesan2" => "Tanggal akhir wajib diisi"));
                    return;
                } else if ($tgl_mulai_kontrak > $tgl_akhir_kontrak) {
                    echo json_encode(array("statusCode" => 422, "status" => "error", "pesan" => "", "pesan1" => "", "pesan2" => "Isi tanggal akhir dengan benar"));
                    return;
                }
                $tgl_permanen = "1970-01-01";
            } else if ($query == "F") {
                if ($tgl_permanen == "") {
                    echo json_encode(array("statusCode" => 422, "status" => "error", "pesan" => "Tanggal permanen wajib diisi", "pesan1" => "", "pesan2" => ""));
                    return;
                }
                $tgl_akhir_kontrak = "1970-01-01";
                $tgl_mulai_kontrak = $tgl_permanen;
            } else {
                echo json_encode(array("statusCode" => 422, "status" => "error", "pesan" => "Kesalahan saat mengambil status kerja", "pesan1" => "", "pesan2" => ""));
                return;
            }

            // $id_m_perusahaan = $this->prs->get_m_by_auth($auth_m_perusahaan);
            $id_depart = $this->get_id_depart($auth_depart);
            $id_posisi = $this->get_id_posisi($auth_posisi);
            $id_level = $this->get_id_level($auth_level);
            $id_lokterima = $this->get_id_lokterima($auth_lokterima);
            $id_lokker = $this->get_id_lokker($auth_lokker);
            $id_poh = $this->get_id_poh($auth_poh);
            $id_tipe = $this->get_id_poh($auth_tipe);

            $data_kry = array(
                'id_perkerjaan' => 0,
                'no_acr' => 0,
                'no_nik' => $no_nik,
                'doh' => $doh,
                'tgl_aktif' => $tgl_aktif,
                'id_depart' => $id_depart,
                'id_posisi' => $id_posisi,
                'id_grade' => 0,
                'id_level' => $id_level,
                'id_lokker' => $id_lokker,
                'id_lokterima' => $id_lokterima,
                'id_poh' => $id_poh,
                'id_klasifikasi' => $id_klasifikasi,
                'id_tipe' => $id_tipe,
                'id_stat_tinggal' => $stat_tinggal,
                'email_kantor' => $email_kantor,
                'tgl_permanen' => $tgl_permanen,
                'id_stat_perjanjian' => $stat_kerja,
                'tgl_edit' => $tgl_edit,
            );

            $this->kry->update_dtkary($id_karyawan, $data_kry);

            if ($auth_ktr != "") {
                $dtkontrak = $this->kry->get_id_kontrak_by_auth($auth_ktr);
                if (!empty($dtkontrak)) {
                    foreach ($dtkontrak as $lst) {
                        $id_kontrak = $lst->id_kontrak_kary;
                    }
                } else {
                    $id_kontrak = "";
                }
                if ($id_kontrak != "") {
                    $data_kontrak = [
                        'id_kary' => $id_karyawan,
                        'id_stat_perjanjian' => $stat_kerja,
                        'tgl_mulai' => $tgl_mulai_kontrak,
                        'tgl_akhir' => $tgl_akhir_kontrak,
                        'ket_kontrak' => '',
                    ];
                    $this->kry->update_dtkontrak($id_kontrak, $data_kontrak);
                }
            }

            echo json_encode(array(
                "statusCode" => 204,
                "status" => "success",
                "pesan" => "Data karyawan berhasil diperbarui",
            ));
        }
    }

    public function newfilependukung()
    {
        $auth_kary = $this->input->post("auth_kary");
        $idpersonal = $this->kry->get_by_auth($auth_kary);
        if ($idpersonal->id_m_perusahaan != '1') {
            $foldername = md5($idpersonal->id_personal);
            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                return;
            }
            $nama_file = $idpersonal->url_pendukung;
            if ($nama_file == "") {
                $now = date('YmdHis');
                $nama_file = $now . "-SUPPORT.pdf";
            }

            $alamat = './berkas/karyawan/' . $foldername . "/" . $nama_file;
            //   if (!is_file($alamat)) {
            if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                mkdir('./berkas/karyawan/' . $foldername, 0775, true);
            } else {
                $config['upload_path'] = './berkas/karyawan/' . $foldername;
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 700;
                $config['file_name'] = $nama_file;
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('fl_pendukung')) {
                    $error = $this->upload->display_errors();
                    echo json_encode(array("statusCode" => 201, "pesan" => $error));
                    return;
                } else {
                    $dt_personal = array(
                        'url_pendukung' => $nama_file,
                    );
                    $id_personal = $idpersonal->id_personal;
                    $this->kry->update_dtPersonal($id_personal, $dt_personal);
                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "File pendukung berhasil diupload",
                    ));
                }
            }
            //   } else {
            //       echo json_encode(array("statusCode" => 201, "pesan" => "File sudah ada, gagal upload file"));
            //   }
        } else {
            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                return;
            }
            $nama_file = $idpersonal->url_pendukung;
            if ($nama_file == "") {
                //  $now = date('YmdHis');
                //  $nama_file = $now . "-SUPPORT.pdf";
                $nik = $idpersonal->no_nik;
                $nama_file = strval($nik) . "-SUPPORT.pdf";
            }

            $alamat = './berkas/pendukung/1/' . $nama_file;
            //   if (!is_file($alamat)) {
            if (is_dir('./berkas/pendukung/1') == false) {
                mkdir('./berkas/pendukung/1', 0775, true);
            } else {
                $config['upload_path'] = './berkas/pendukung/1';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 500;
                $config['file_name'] = $nama_file;
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('fl_pendukung')) {
                    $error = $this->upload->display_errors();
                    echo json_encode(array("statusCode" => 201, "pesan" => $error));
                    return;
                } else {
                    $dt_personal = array(
                        'url_pendukung' => $nama_file,
                    );
                    $id_personal = $idpersonal->id_personal;
                    $this->kry->update_dtPersonal($id_personal, $dt_personal);
                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "File pendukung berhasil diupload",
                    ));
                }
            }
            //   } else {
            //       echo json_encode(array("statusCode" => 201, "pesan" => "File sudah ada, gagal upload file"));
            //   }
        }
    }

    public function newvaksin()
    {
        $jenisVaksin = $this->input->post("jenisVaksin");
        $namaVaksin = $this->input->post("namaVaksin");
        $tanggalVaksin = $this->input->post("tanggalVaksin");
        $auth_kary = $this->input->post("auth_kary");
        $dataKaryawan = $this->kry->get_by_auth($auth_kary);
        $id_personal = $dataKaryawan->id_personal;
        $now = date("Y-m-d");

        if ($auth_kary == "") {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
            die;
        }

        if ($dataKaryawan != "") {
            $data_vaksin = [
                'id_personal' => $id_personal,
                'id_vaksin_jenis' => $jenisVaksin,
                'tgl_vaksin' => $tanggalVaksin,
                'id_vaksin_nama' => $namaVaksin,
                'tgl_buat' => date('Y-m-d H:i:s'),
                'tgl_edit' => date('Y-m-d H:i:s'),
                'id_user' => $this->session->userdata('id_user_hcdata'),
            ];

            $vaksin = $this->vks->input_vaksin_kary($data_vaksin);
            if ($vaksin) {
                echo json_encode(array("statusCode" => 200, "pesan" => "Data vaksin berhasil disimpan"));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data vaksin gagal disimpan"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data karyawan"));
        }
    }

    public function newfotokaryawan()
    {
        $auth_kary = $this->input->post("auth_kary");
        $idpersonal = $this->kry->get_by_auth($auth_kary);
        if ($idpersonal->id_m_perusahaan != '1') {
            $foldername = md5($idpersonal->id_personal);
            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                return;
            }
            $nama_file = $idpersonal->url_foto;
            if ($nama_file == "" || $nama_file == null) {
                $now = date('YmdHis');
                $nama_file = $now . "-FOTO.jpg";
            }

            $alamat = './berkas/karyawan/' . $foldername . "/" . $nama_file;
            //   if (!is_file($alamat)) {
                
            if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                mkdir('./berkas/karyawan/' . $foldername, 0775, true);
            }

            if (is_dir('./berkas/karyawan/' . $foldername)) {
                $config['upload_path'] = './berkas/karyawan/' . $foldername;
                $config['allowed_types'] = 'jpg';
                $config['max_size'] = 100;
                $config['file_name'] = $nama_file;
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_foto')) {
                    $error = $this->upload->display_errors();
                    echo json_encode(array("statusCode" => 201, "pesan" => $error));
                    return;
                } else {
                    $dt_personal = array(
                        'url_foto' => $nama_file,
                    );
                    $id_karyawan = $idpersonal->id_kary;
                    $this->kry->update_dtkary($id_karyawan, $dt_personal);
                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "Foto Karyawan berhasil diupload",
                    ));
                }
            } else {
                  echo json_encode(array("statusCode" => 201, "pesan" => "Gagal upload foto karyawan"));
                return;   
            }
        } else {
            if ($auth_kary == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
                return;
            }
            $nama_file = $idpersonal->url_foto;
            if ($nama_file == "" || $nama_file == null) {
                $nama = $idpersonal->nama_lengkap;
                $nama_file = strval($nama) . "-FOTO.jpg";
            }

            $alamat = './berkas/foto/1/' . $nama_file;
            //   if (!is_file($alamat)) {
            if (is_dir('./berkas/foto/1') == false) {
                mkdir('./berkas/foto/1', 0775, true);
            } else {
                $config['upload_path'] = './berkas/foto/1';
                $config['allowed_types'] = 'jpg';
                $config['max_size'] = 100;
                $config['file_name'] = $nama_file;
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_foto')) {
                    $error = $this->upload->display_errors();
                    echo json_encode(array("statusCode" => 201, "pesan" => $error));
                    return;
                } else {
                    $dt_personal = array(
                        'url_foto' => $nama_file,
                    );
                    $id_karyawan = $idpersonal->id_kary;
                    $this->kry->update_dtkary($id_karyawan, $dt_personal);
                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "Foto Karyawan berhasil diupload",
                    ));
                }
            }
            //   } else {
            //       echo json_encode(array("statusCode" => 201, "pesan" => "File sudah ada, gagal upload file"));
            //   }
        }
    }
}