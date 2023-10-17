<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izin_tambang extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logout();
    }

    public function index()
    {
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
        $data['nama'] = $this->session->userdata("nama_hcdata");
        $data['email'] = $this->session->userdata("email_hcdata");
        $data['menu'] = $this->session->userdata("id_menu_hcdata");
        $this->load->view('dashboard/template/header', $data);
        $this->load->view('dashboard/izin_tambang/izin_tambang');
        $this->load->view('dashboard/modal/mdlform');
        $this->load->view('dashboard/template/footer', $data);
        $this->load->view('dashboard/code/izin_tambang');
    }

    public function new ()
    {
        $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
        $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
        $data['nama'] = $this->session->userdata("nama_hcdata");
        $data['email'] = $this->session->userdata("email_hcdata");
        $data['menu'] = $this->session->userdata("id_menu_hcdata");
        $this->load->view('dashboard/template/header', $data);
        $this->load->view('dashboard/izin_tambang/izin_tambang_add');
        $this->load->view('dashboard/modal/mdlform');
        $this->load->view('dashboard/template/footer', $data);
        $this->load->view('dashboard/code/izin_tambang');
    }

    public function add_unit_izin_tambang()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $this->form_validation->set_rules("jenisunit", "jenisunit", "required|trim", [
            'required' => 'Jenis unit wajib dipilih',
        ]);
        $this->form_validation->set_rules("tipeakses", "tipeakses", "required|trim", [
            'required' => 'Tipe akses wajib dipilih',
        ]);

        if ($this->form_validation->run() == false) {
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));

            if ($filesim == "" || $filesim == "") {
                $errsim = "<p>SIM Polisi wajib diupload</p>";
            } else {
                $errsim = "";
            }

            if ($filesmp == "" || $filesmp == "") {
                $errsmp = "<p>SIMPER /MINE PERMIT wajib diupload</p>";
            } else {
                $errsmp = "";
            }

            $error = [
                'statusCode' => 202,
                'jenisunit' => form_error("jenisunit"),
                'tipeakses' => form_error("tipeakses"),
                "filesim" => $errsim,
                "filesmp" => $errsmp,
            ];

            echo json_encode($error);
            return;
        } else {
            $auth_person = htmlspecialchars($this->input->post("auth_person", true));
            $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
            $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
            // $auth_simpol = htmlspecialchars($this->input->post("auth_simpol", true));
            $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));
            $noreg = htmlspecialchars($this->input->post("noreg", true));
            $tglexp = htmlspecialchars($this->input->post("tglexp", true));
            $jenissim = htmlspecialchars($this->input->post("jenissim", true));
            $tglexpsim = htmlspecialchars($this->input->post("tglexpsim", true));
            $id_karyawan = $this->kry->get_id_karyawan($auth_kary);
            $jenis_unit = htmlspecialchars($this->input->post("jenisunit", true));
            $tipe_akses = htmlspecialchars($this->input->post("tipeakses", true));
            $filesim = htmlspecialchars($this->input->post("filesim", true));
            $filesmp = htmlspecialchars($this->input->post("filesmp", true));
            $filesimnm = htmlspecialchars($this->input->post("filesimnm", true));
            $filesimsv = htmlspecialchars($this->input->post("filesimsv", true));
            $filesmpnm = htmlspecialchars($this->input->post("filesmpnm", true));
            $filesmpsv = htmlspecialchars($this->input->post("filesmpsv", true));
            $id_personal = $this->kry->get_id_personal($auth_person);
            $foldername = md5($id_personal);
            $now = date('YmdHis');
            $nama_smp = $now . "-SMP.pdf";
            $nama_sim = $now . "-SIMPOL.pdf";
            $id_sim_kary = $this->kry->get_sim_kary_by_idkary($id_karyawan);

            $akses = $this->smp->get_akses($tipe_akses);
            if ($akses === 0) {
                echo json_encode(array("statusCode" => 201, "pesan" => "Izin akses tidak ditemukan"));
                return;
            }

            // ---------- cek simper ---------------------------
            $smpname = $_FILES['filesmpkary']['name'];
            $smptipe = $_FILES['filesmpkary']['type'];
            $smpsize = $_FILES['filesmpkary']['size'];

            if ($smpname == "") {
                echo json_encode(array("statusCode" => 202, "filesmp" => "SIMPER wajib diupload."));
                return;
            }

            if ($smptipe === 'application\/pdf') {
                echo json_encode(array("statusCode" => 202, "filesmp" => "Format file yang diupload wajib dalam bentuk pdf."));
                return;
            }

            if ($smpsize > 70000) {
                echo json_encode(array("statusCode" => 202, "filesmp" => "Ukuran file maksimal 70kb."));
                return;
            }

            // ---------- cek sim ---------------------------
            $simname = $_FILES['filesimpolisi']['name'];
            $simtype = $_FILES['filesimpolisi']['type'];
            $simsize = $_FILES['filesimpolisi']['size'];

            if ($simname == "") {
                echo json_encode(array("statusCode" => 202, "filesim" => "SIM Polisi wajib diupload."));
                return;
            }

            if ($simtype == "application\/pdf") {
                echo json_encode(array("statusCode" => 202, "filesim" => "Format file yang diupload wajib dalam bentuk pdf."));
                return;
            }

            if ($simsize > 70000) {
                echo json_encode(array("statusCode" => 202, "filesim" => "Ukuran file maksimal 70kb."));
                return;
            }

            if ($auth_izin == "") { //================ jika belum ada izin_tambang =========================
                if ($filesim == "") {
                    $errsim = "SIM Polisi wajib diupload";

                    $error = [
                        'statusCode' => 202,
                        'filesim' => $errsim,
                    ];

                    echo json_encode($error);
                    return;
                }

                if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                    mkdir('./berkas/karyawan/' . $foldername, 0775, true);
                }

                if (is_dir('./berkas/karyawan/' . $foldername)) {
                    // ======== upload simper =========================
                    $_FILES['filesmpkary']['name'] = $nama_smp;
                    $config['upload_path'] = './berkas/karyawan/' . $foldername;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 70;

                    $this->load->library('upload', $config);
                    $this->load->initialize($config);
                    $this->upload->do_upload('filesmpkary');

                    // ======== upload sim =========================
                    $_FILES['filesimpolisi']['name'] = $nama_sim;
                    $config['upload_path'] = './berkas/karyawan/' . $foldername;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 70;

                    $this->load->library('upload', $config);
                    $this->load->initialize($config);
                    $this->upload->do_upload('filesimpolisi');

                    $data_sim_polisi = [
                        'id_personal' => $id_personal,
                        'id_sim' => $jenissim,
                        'tgl_exp_sim' => $tglexpsim,
                        'ket_sim_kary' => '',
                        'url_file' => $nama_sim,
                        'tgl_buat' => date('Y-m-d H:i:s'),
                        'tgl_edit' => date('Y-m-d H:i:s'),
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];

                    $this->smp->input_sim_polisi($data_sim_polisi);
                    $last_sim = $this->smp->last_row_sim($id_personal);

                    $data_izin_tambang = [
                        'id_kary' => $id_karyawan,
                        'id_jenis_izin_tambang' => $jenisizin,
                        'no_reg' => $noreg,
                        'tgl_expired' => $tglexp,
                        'id_sim_kary' => $last_sim,
                        'url_izin_tambang' => $nama_smp,
                        'ket_izin_tambang' => '',
                        'tgl_buat' => date('Y-m-d H:i:s'),
                        'tgl_edit' => date('Y-m-d H:i:s'),
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];

                    $this->smp->input_izin_tambang($data_izin_tambang);

                    $last_izin = $this->smp->last_row_izin_sm($id_personal);
                    $auth_simpol = $this->smp->last_row_simpol($auth_person);
                    if (!empty($last_izin)) {
                        foreach ($last_izin as $list) {
                            $auth_izin = $list->auth_izin_tambang;
                            $id_izin = $list->id_izin_tambang;
                        }

                        $data_unit_izin = [
                            'id_izin_tambang' => $id_izin,
                            'id_unit' => $jenis_unit,
                            'id_tipe_akses_unit' => $tipe_akses,
                            'tgl_buat' => date('Y-m-d H:i:s'),
                            'tgl_edit' => date('Y-m-d H:i:s'),
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                        ];

                        $this->smp->input_unit($data_unit_izin);
                        $linkizn = base_url('karyawan/berkasizinadd/' . $auth_izin);
                        $linksim = base_url('karyawan/berkassimadd/' . $auth_simpol);

                        echo json_encode(array(
                            "statusCode" => 200,
                            "pesan" => "Data SIMPER berhasil disimpan",
                            "auth_izin" => $auth_izin,
                            "auth_simpol" => $auth_simpol,
                            "auth_unit" => "j78uh5yg",
                            "filesmp" => $smpname,
                            "filesmpsv" => $_FILES['filesmpkary']['name'],
                            "linkizin" => $linkizn,
                            "filesim" => $smpname,
                            "filesimsv" => $_FILES['filesimpolisi']['name'],
                            "linksim" => $linksim,
                        ));
                    } else {
                        $auth_izin = "";
                        $id_izin = "";

                        echo json_encode(array(
                            "statusCode" => 201,
                            "pesan" => "Unit gagal disimpan, data izin tidak ditemukan",
                        ));
                    }
                }
            } else { // ====================== jika izin tambang sudah ada ======================================
                $query = $this->smp->cek_unit_izin($auth_izin, $jenis_unit);
                if (!empty($query)) {
                    echo json_encode(array(
                        "statusCode" => 201,
                        'pesan' => 'Unit sudah ada',
                    ));
                    return;
                }

                $id_izin = $this->smp->get_id_izin_tambang($auth_izin);

                if (!empty($id_izin)) {
                    $data_unit_izin = [
                        'id_izin_tambang' => $id_izin,
                        'id_unit' => $jenis_unit,
                        'id_tipe_akses_unit' => $tipe_akses,
                        'tgl_buat' => date('Y-m-d H:i:s'),
                        'tgl_edit' => date('Y-m-d H:i:s'),
                        'id_user' => $this->session->userdata('id_user_hcdata'),
                    ];

                    $this->smp->input_unit($data_unit_izin);
                    echo json_encode(array(
                        "statusCode" => 200,
                        'pesan' => 'Unit berhasil ditambahkan',
                        "auth_izin" => $auth_izin,
                        "auth_unit" => 0,
                    ));
                } else {
                    echo json_encode(array(
                        "statusCode" => 200,
                        'pesan' => 'Unit gagal ditambahkan',
                        "auth_unit" => 0,
                    ));
                    return;
                }
            }
        }
    }

    public function hapus_unit()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $id_unit = htmlspecialchars($this->input->post("id_unit", true));

        if ($id_unit != "") {
            $query = $this->smp->hapus_unit($id_unit);

            if ($query == 200) {
                echo json_encode(array("statusCode" => 200, "pesan" => "Unit berhasil dihapus"));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Unit gagal dihapus"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data tidak ditemukan"));
        }
    }

    public function hapus_unit_all()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));

        if ($auth_izin != "") {
            $query = $this->smp->hapus_unit_all($auth_izin);

            if ($query == 200) {
                echo json_encode(array(
                    "statusCode" => 200,
                    "pesan" => "SIMPER, SIM Polisi dan Unit berhasil dihapus",
                    "filesmp" => "Pilih file SIMPER/MINE PERMIT",
                    "filesim" => "Pilih file SIM Polisi",
                ));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "SIMPER, SIM Polisi dan Unit gagal dihapus"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data tidak ditemukan"));
        }
    }

    public function hapus_izin_all()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));

        if ($auth_izin != "") {
            $query = $this->smp->hapus_izin_all($auth_izin);

            if ($query == 200) {
                echo json_encode(array(
                    "statusCode" => 200,
                    "pesan" => "Data izin berhasil dihapus",
                    "filesmp" => "Pilih file SIMPER/MINE PERMIT",
                    "filesim" => "Pilih file SIM Polisi",
                ));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "SIMPER, SIM Polisi dan Unit gagal dihapus"));
            }
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data tidak ditemukan"));
        }
    }

    public function cek_jenisizin()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $auth_izin = htmlspecialchars($this->input->post("auth_izin", true));
        $jenisizin = htmlspecialchars($this->input->post("jenisizin", true));

        if ($auth_izin != "") {
            $query = $this->smp->cek_jenisizin($auth_izin);

            if (!empty($query)) {
                foreach ($query as $list) {
                    $id_jenis = $list->id_jenis_izin_tambang;
                }

                if ($jenisizin != $id_jenis) {
                    echo json_encode(array(
                        "statusCode" => 200,
                        "pesan" => "Yakin akan diganti jenis izin? semua data sebelumnya akan dihapus",
                        "auth_izn" => $jenisizin,
                        "jns" => $id_jenis,
                    ));

                    return;
                }
            }
        }
    }

    public function izin_tambang()
    {
        $auth_izin = htmlspecialchars($this->input->get('auth_izin', true));
        $data['unit_izin'] = $this->smp->tabel_unit_izin($auth_izin);
        $this->load->view('dashboard/karyawan/izin_tambang', $data);
    }

    public function tgl_exp_izin()
    {
        $tglsim = htmlspecialchars($this->input->post("tglsim", true));
        $now = date('Y-m-d');

        if ($tglsim < $now) {
            echo json_encode(array(
                "statusCode" => 201,
                'pesan' => 'Tanggal expired SIM tidak boleh sebelum hari ini',
            ));
            return;
        }

        if ($tglsim == $now) {
            echo json_encode(array(
                "statusCode" => 201,
                'pesan' => 'Tanggal expired SIM tidak boleh sama dengan hari ini',
            ));
            return;
        }

        $dsim = date('d', strtotime($tglsim));
        $msim = date('m', strtotime($tglsim));
        $ysim = date('Y', strtotime($tglsim));

        $ynow = date("Y");
        $mnow = date("m");
        $dnow = date("d");

        if ($ysim > $ynow) {
            $tglexpizin = (intval($ynow) + 1) . "-" . $msim . "-" . $dsim;
        } else {
            if ($msim > $mnow) {
                $tglexpizin = (intval($ynow)) . "-" . $msim . "-" . $dsim;
            } else if ((intval($msim) - intval($mnow)) == 0) {
                if ($dsim > $dnow) {
                    $tglexpizin = (intval($ynow)) . "-" . $msim . "-" . $dsim;
                } else {
                    echo json_encode(array(
                        "statusCode" => 201,
                        'pesan' => 'Tanggal expired SIM tidak boleh sama dengan hari ini',
                    ));
                    return;
                }
            } else {
                echo json_encode(array(
                    "statusCode" => 201,
                    'pesan' => 'Tanggal expired SIM tidak dapat dibuat',
                ));
                return;
            }
        }

        echo json_encode(array(
            "statusCode" => 200,
            'pesan' => 'Tanggal expired SIM berhasil dibuat',
            "tglexpizin" => $tglexpizin,
        ));
    }

    public function ajax_list()
    {
        $list = $this->smp->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $smp) {
            $no++;
            $row = array();
            $row['no'] = $no;
            $row['auth_izin_tambang'] = $smp->auth_izin_tambang;
            $row['jenis_izin_tambang'] = $smp->jenis_izin_tambang;
            $row['ket_izin_tambang'] = $smp->ket_izin_tambang;

            $row['tgl_buat'] = date('d-M-Y', strtotime($smp->tgl_buat));
            $row['tgl_edit'] = date('d-M-Y', strtotime($smp->tgl_edit));
            $row['proses'] = '<button id="' . $smp->auth_izin_tambang . '" class="btn btn-primary btn-sm font-weight-bold dtlizin_tambang" title="Detail"> <i class="fas fa-asterisk"></i> </button>
                    <button id="' . $smp->auth_izin_tambang . '" class="btn btn-warning btn-sm font-weight-bold edttizin_tambang" title="Edit"> <i class="fas fa-edit"></i> </button>
                    <button id="' . $smp->auth_izin_tambang . '" class="btn btn-danger btn-sm font-weight-bold hpsizin_tambang" title="Hapus"> <i class="fas fa-trash-alt"></i> </button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->smp->count_all(),
            "recordsFiltered" => $this->smp->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function input_izin_tambang()
    {
        $this->form_validation->set_rules("izin_tambang", "izin_tambang", "required|trim|max_length[100]", [
            'required' => 'izin_tambang wajib diisi',
            'max_length' => 'izin_tambang maksimal 100 karakter',
        ]);
        $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'izin_tambang' => form_error("izin_tambang"),
                'ket' => form_error("ket"),
            ];

            echo json_encode($error);
            return;
        } else {
            $izin_tambang = htmlspecialchars($this->input->post("izin_tambang", true));
            $ket_izin_tambang = htmlspecialchars($this->input->post("ket"));

            $cekizin_tambang = $this->smp->cek_izin_tambang($izin_tambang);
            if ($cekizin_tambang) {
                echo json_encode(array("statusCode" => 201, "pesan" => "izin_tambang sudah digunakan"));
                return;
            }

            $data = [
                'izin_tambang' => $izin_tambang,
                'ket_izin_tambang' => $ket_izin_tambang,
                'stat_izin_tambang' => 'T',
                'tgl_buat' => date('Y-m-d H:i:s'),
                'tgl_edit' => date('Y-m-d H:i:s'),
                'id_user' => $this->session->userdata('id_user_hcdata'),
            ];

            $izin_tambang = $this->smp->input_izin_tambang($data);
            if ($izin_tambang) {
                echo json_encode(array("statusCode" => 200, "pesan" => "izin_tambang berhasil disimpan"));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "izin_tambang gagal disimpan"));
            }
        }
    }

    public function hapus_izin_tambang()
    {
        $auth_izin_tambang = htmlspecialchars(trim($this->input->post('auth_izin_tambang')));
        $query = $this->smp->hapus_izin_tambang($auth_izin_tambang);
        if ($query == 200) {
            echo json_encode(array("statusCode" => 200, "pesan" => "izin_tambang berhasil dihapus"));
            return;
        } else if ($query == 201) {
            echo json_encode(array("statusCode" => 201, "pesan" => "izin_tambang gagal dihapus"));
            return;
        } else {
            echo json_encode(array("statusCode" => 202, "pesan" => "izin_tambang tidak ditemukan"));
            return;
        }
    }

    public function detail_izin_tambang()
    {
        $auth_izin_tambang = htmlspecialchars(trim($this->input->post("auth_izin_tambang")));
        $query = $this->smp->get_izin_tambang_id($auth_izin_tambang);
        if (!empty($query)) {
            foreach ($query as $list) {
                if ($list->stat_izin_tambang == "T") {
                    $status = "AKTIF";
                } else {
                    $status = "NONAKTIF";
                }

                $data = [
                    'statusCode' => 200,
                    'izin_tambang' => $list->izin_tambang,
                    'ket' => $list->ket_izin_tambang,
                    'status' => $status,
                    'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                    'pembuat' => $list->nama_user,
                ];

                $this->session->set_userdata('id_izin_tambang_hcdata', $list->id_izin_tambang);
            }
            echo json_encode($data);
        } else {
            echo json_encode(array('statusCode' => 201, "pesan" => "izin_tambang tidak ditemukan"));
        }
    }

    public function edit_izin_tambang()
    {
        $this->form_validation->set_rules("izin_tambang", "izin_tambang", "required|trim|max_length[100]", [
            'required' => 'izin_tambang wajib diisi',
            'max_length' => 'izin_tambang maksimal 100 karakter',
        ]);
        $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");
        $this->form_validation->set_rules("status", "status", "required|trim", [
            'required' => 'Status wajib dipilih',
        ]);

        if ($this->form_validation->run() == false) {
            $error = [
                'statusCode' => 202,
                'izin_tambang' => form_error("izin_tambang"),
                'status' => form_error("status"),
                'ket' => form_error('ket'),
            ];

            echo json_encode($error);
            die;
        } else {
            if ($this->session->userdata('id_izin_tambang_hcdata') == "") {
                echo json_encode(array("statusCode" => 201, "pesan" => "izin_tambang tidak ditemukan"));
                return;
            }

            $izin_tambang = htmlspecialchars($this->input->post("izin_tambang", true));
            $ket_izin_tambang = htmlspecialchars($this->input->post("ket", true));
            if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                $status = "T";
            } else {
                $status = "F";
            }

            $izin_tambang = $this->smp->edit_izin_tambang($izin_tambang, $ket_izin_tambang, $status);
            if ($izin_tambang == 200) {
                echo json_encode(array("statusCode" => 200, "pesan" => "izin_tambang berhasil diupdate"));
            } else if ($izin_tambang == 201) {
                echo json_encode(array("statusCode" => 201, "pesan" => "izin_tambang gagal diupdate"));
            } else if ($izin_tambang == 204) {
                echo json_encode(array("statusCode" => 205, "pesan" => "izin_tambang sudah digunakan"));
            }
        }
    }

    public function get_all()
    {
        $query = $this->smp->get_all();
        $output = "<option value=''>-- Pilih izin_tambang --</option>";
        if (!empty($query)) {
            foreach ($query as $list) {
                $output = $output . "<option value='" . $list->auth_izin_tambang . "'>" . $list->izin_tambang . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "smp" => $output));
        } else {
            $output = "<option value=''>-- izin_tambang tidak Ditemukan --</option>";
            echo json_encode(array("statusCode" => 201, "smp" => $output));
        }
    }

    public function get_all_unit()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $query = $this->smp->get_all_unit();
        $output = "<option value=''>-- WAJIB DIPILIH --</option>";
        if (!empty($query)) {
            foreach ($query as $list) {
                $output = $output . "<option value='" . $list->id_unit . "'>" . $list->unit . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "unit" => $output));
        } else {
            $output = "<option value=''>-- Unit tidak Ditemukan --</option>";
            echo json_encode(array("statusCode" => 201, "unit" => $output));
        }
    }

    public function get_all_akses()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);

        $query = $this->smp->get_all_akses();
        $output = "<option value=''>-- WAJIB DIPILIH --</option>";
        if (!empty($query)) {
            foreach ($query as $list) {
                $output = $output . "<option value='" . $list->id_tipe_akses_unit . "'>" . $list->tipe_akses_unit . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "akses" => $output));
        } else {
            $output = "<option value=''>-- tipe akses tidak Ditemukan --</option>";
            echo json_encode(array("statusCode" => 201, "akses" => $output));
        }
    }

    public function get_by_idper()
    {
        if ($this->session->userdata('id_perusahaan_izin_tambang') != "") {
            $id_per = $this->session->userdata('id_perusahaan_izin_tambang');
            $output = "<option value=''>-- Pilih izin_tambang --</option>";
            $query = $this->smp->get_by_idper($id_per);
            foreach ($query as $list) {
                $output = $output . " <option value='" . $list->auth_izin_tambang . "'>" . $list->izin_tambang . "</option>";
            }

            echo json_encode(array("statusCode" => 200, "izin_tambang" => $output, "pesan" => "Sukses"));
        } else {
            $output = "<option value=''>-- izin_tambangemen tidak ditemukan --</option>";
            echo json_encode(array("statusCode" => 200, "izin_tambang" => $output, "pesan", "izin_tambang gagal ditampilkan"));
        }
    }
}