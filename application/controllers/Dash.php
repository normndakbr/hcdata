<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dash extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logout();
    }

    public function index()
    {
        // Header
        $this->load->view('components/header');

        // Sidebar
        $this->load->view('components/sidebar');

        // Navbar
        $dataNavbar['nama'] = $this->session->userdata("nama_main");
        $this->load->view('components/navbar', $dataNavbar);

        // Main
        $tgl_now = date('Y-m-d');
        $jml_karyawan = $this->dsmod->count_all_karyawan();
        $new_kry = $this->dsmod->new_emp();
        $jml_user = $this->dsmod->count_all_perusahaan();
        $kary_sum = $this->dsmod->get_data_sum($tgl_now);
        $jml_lgr_aktif = $this->dsmod->get_langgar_aktif();
        $dataMain['nama'] = $this->session->userdata("nama_main");
        $dataMain['email'] = $this->session->userdata("email_main");
        $dataMain['menu'] = $this->session->userdata("id_menu_main");
        $dataMain['jml_karyawan'] = $jml_karyawan;
        $dataMain['jml_user'] = $jml_user;
        $dataMain['new_kry'] = $new_kry;
        $dataMain['kary_sum'] = $kary_sum;
        $dataMain['jml_lgr_aktif'] = $jml_lgr_aktif;
        $this->load->view('dashboard', $dataMain);

        // Modal
        if ($this->session->has_userdata('id_m_perusahaan_main')) {
            $idmper = $this->session->userdata('id_m_perusahaan_main');
            if ($idmper != "") {
                $dataModal['permst'] = $this->str->getMaster($idmper, "");
                $dataModal['perstr'] = $this->str->getMenu($idmper, "");
            } else {
                $dataModal['permst'] = "";
                $dataModal['perstr'] = "";
            }
        } else {
            $idmper = "";
            $dataModal['permst'] = "";
            $dataModal['perstr'] = "";
        }
        $this->load->view('components/modal/dashboard', $dataModal);

        // JS
        $this->load->view('components/js');

        // Page JS
        $this->load->view('components/page_js/dashboard');

        // Footer
        $this->load->view('components/footer');
    }

    public function show_jml_kary()
    {
        $ta = $this->input->get('ta');
        if ($ta == 0) {
            $ta = date('Y-m-d');
        }
        $kary_sum = $this->dsmod->get_data_sum($ta);
        $data['kary_sum'] = $kary_sum;
        $data['tgln'] = date('d-M-Y', strtotime($ta));
        $this->load->view('dashboard/perusahaan/jml_prs_beranda', $data);
    }

    public function form_modal()
    {
        $this->load->view("dashboard/mdlform");
    }

    public function data_langgar_aktif($prs)
    {
        $data['prs'] = $prs;
        $this->load->view("dashboard/datalanggaraktif", $data);
    }

    public function data_grafik()
    {
        $query = $this->dsmod->data_grafik_1();
        if (!empty($query)) {
            foreach ($query as $jml) {
                $nilai1 = $jml->bulan_now;
            }

            $data1 = [
                "x" => "April 2023",
                "y" => $nilai1,
            ];
        }

        $query = $this->dsmod->data_grafik_2();
        if (!empty($query)) {
            foreach ($query as $jml) {
                $nilai2 = $jml->bulan_now;
            }

            $data2 = [
                "x" => "Maret 2023",
                "y" => $nilai2,
            ];
        }

        $query = $this->dsmod->data_grafik_3();
        if (!empty($query)) {
            foreach ($query as $jml) {
                $nilai3 = $jml->bulan_now;
            }

            $data3 = [
                "x" => "Februari 2023",
                "y" => $nilai3,
            ];
        }
        $data = [$data1, $data2, $data3];
        echo json_encode($data);
    }

    public function gt_data()
    {
        $query = $this->dsmod->get_data_grafik();

        echo $query;
    }
    public function gt_gender()
    {
        $query = $this->dsmod->get_gender_grafik();

        echo $query;
    }
    public function gt_jlok()
    {
        $query = $this->dsmod->get_lokasi_grafik();

        echo $query;
    }
    public function gt_kls()
    {
        $query = $this->dsmod->get_klasifikasi_grafik();

        echo $query;
    }
    public function gt_didik()
    {
        $query = $this->dsmod->get_pendidikan_grafik();

        echo $query;
    }
    public function gt_stt_tinggal()
    {
        $query = $this->dsmod->get_residence_grafik();

        echo $query;
    }
    public function gt_srt()
    {
        $query = $this->dsmod->get_sertifikasi_grafik();

        echo $query;
    }
}
