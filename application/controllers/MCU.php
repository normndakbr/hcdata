<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcu extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logout();
    }

    public function jenisHasil()
    {
        $auth = htmlspecialchars($this->input->post("token", true));
        $this->cek_auth($auth);
        $result = $this->mcu->data_jenis_hasil();
        if (!empty($result)) {
            $output = "<option value=''>-- Pilih Hasil MCU --</option> ";
            foreach ($result as $list) {
                $output = $output . "<option value='" . $list->id_mcu_jenis . "'>" . $list->mcu_jenis . "</option>";
            }
            echo json_encode(array("statusCode" => 200, "data" => $output));
        } else {
            $output = "<option value=''>-- Data Hasil MCU tidak Ditemukan --</option>";
            echo json_encode(array("statusCode" => 201, "data" => $output));
        }
    }

    public function uploadUlangFile()
    {
        $auth_mcu = htmlspecialchars($this->input->post("auth_mcu", true));
        $result = $this->mcu->dataMCU_by_id($auth_mcu);
        $id_personal = $result->id_personal;

        if ($auth_mcu == "") {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU tidak ditemukan"));
            return;
        }

        if ($result->id_m_perusahaan != '1') {
            $nama_file = $result->url_file;

            if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                mkdir('./berkas/karyawan/' . $foldername, 0775, true);
            }

            if (is_dir('./berkas/karyawan/' . $foldername)) {
                $config['upload_path'] = './berkas/karyawan/' . $foldername;
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 300;
                $config['file_name'] = $nama_file;
                $config['overwrite'] = true;

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
                        "pesan" => $error,
                    ));
                } else {
                    if ($auth_mcu != "") {
                        $data_mcu = [
                            'url_file' => $nama_file,
                            'tgl_edit' => date('Y-m-d H:i:s'),
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
                        echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data mcu"));
                    }
                }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Folder data mcu tidak ditemukan"));
            }
        } else {
            $nama_file = $result->url_file;

            if (is_dir('./berkas/mcu/1') == false) {
                mkdir('./berkas/mcu/1', 0775, true);
            }

            if (is_dir('./berkas/mcu/1')) {
                $config['upload_path'] = './berkas/mcu/1';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 1000;
                $config['file_name'] = $nama_file;
                $config['remove_spaces'] = false;
                $config['overwrite'] = true;

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
                        "pesan" => $error,
                    ));
                } else {
                    if ($auth_mcu != "") {
                        $data_mcu = [
                            'url_file' => $nama_file,
                            'tgl_edit' => date('Y-m-d H:i:s'),
                            'id_user' => $this->session->userdata('id_user_hcdata'),
                        ];

                        $mcu = $this->kry->input_dtMCU($data_mcu);
                        if ($mcu) {
                            $auth_mcu = $this->kry->last_row_authmcu();
                            $link = '/assets/berkas/mcu/1/' . $nama_file;
                            echo json_encode(array(
                                "statusCode" => 200,
                                "pesan" => "Data MCU berhasil disimpan",
                            ));
                        } else {
                            echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU gagal disimpan"));
                        }
                    } else {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Error saat mengambil data mcu"));
                    }
                }
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Folder data mcu tidak ditemukan"));
            }
        }
    }

    public function editData()
    {
        $auth_mcu = htmlspecialchars($this->input->post("auth_mcu", true));
        $tanggalMCU = htmlspecialchars($this->input->post("tanggalMCU", true));
        $hasilMCU = htmlspecialchars($this->input->post("hasilMCU", true));
        $keteranganMCU = htmlspecialchars($this->input->post("keteranganMCU", true));
        $dataMCU = $this->mcu->dataMCU_by_id($auth_mcu);
        $id_mcu = $dataMCU->id_mcu;
        if ($auth_mcu == "") {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data mcu tidak ditemukan"));
            return;
        } else {
            $data_mcu = [
                'id_mcu_jenis' => $hasilMCU,
                'tgl_mcu' => $tanggalMCU,
                'ket_mcu' => $keteranganMCU,
                'tgl_edit' => date('Y-m-d H:i:s'),
                'id_user' => $this->session->userdata('id_user_hcdata'),
            ];

            $result = $this->mcu->updateDataMCU($data_mcu, $id_mcu);
            if ($result) {
                echo json_encode(array(
                    "statusCode" => 200,
                    "pesan" => "Data MCU berhasil diedit",
                ));
            } else {
                echo json_encode(array("statusCode" => 201, "pesan" => "Data MCU gagal diedit"));
            }
        }
    }
}
