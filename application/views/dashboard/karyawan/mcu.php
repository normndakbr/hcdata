<table id="tbmSertifikasi" class="table table-striped table-bordered table-hover text-black text-nowrap"
    style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
    <thead>
        <tr>
            <th style="text-align:center;width:1%;">No.</th>
            <th style="text-align:center;width:10%;">Hasil MCU</th>
            <th style="text-align:center;width:10%;">Tanggal MCU</th>
            <th style="text-align:center;width:9%;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php

                                                    if (!empty($data_mcu)) {
                                                        $n = 1;
                                                        foreach ($data_mcu as $list) {
                                                            echo "<tr>";
                                                            echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $n++ . "</td>";
                                                            echo "<td class='align-middle text-center' style='width:35%;'>" . $list->mcu_jenis . "</td>";
                                                            echo "<td class='align-middle text-center' style='width:35%;'>" . date("d-M-Y", strtotime($list->tgl_mcu)) . "</td>";
                                                            echo "<td class='align-middle' style='width:9%;'>";
                                                            echo "<button type='button' id=" . $list->auth_mcu . " class='btn btn-primary btn-sm detailMCU' value='" . $list->id_mcu . "' title='Detail MCU'><i class='fas fa-asterisk'></i></button> ";
                                                            echo "<a id=" . $list->auth_mcu . " class='btn btn-success btn-sm' href ='" . base_url('karyawan/mcu/') . $list->auth_mcu . "' target='_blank' title='Tampilkan file MCU' value='" . $list->id_mcu . "'> <i class='fas fa-file-alt'></i> </a> ";
                                                            echo "<button type='button' id=" . $list->auth_mcu . " class='btn btn-primary btn-sm uploadMCU' value='" . $list->id_mcu . "' title='Upload Ulang File MCU'><i class='fas fa-file-upload'></i></button> ";
                                                            echo "<button type='button' id=" . $list->auth_mcu . " class='btn btn-warning btn-sm editMCU' value='" . $list->id_mcu . "' title='Edit Data MCU'><i class='fas fa-edit'></i></button> ";
                                                            echo "<button type='button' id=" . $list->auth_mcu . " class='btn btn-danger btn-sm hapusMCU' value='" . $list->id_mcu . "' title='Hapus Data MCU'><i class='fas fa-trash'></i></button> ";
                                                            echo "</td>";
                                                            echo "<tr>";
                                                        }
                                                    } else {
                                                        echo  "<tr>";
                                                        echo "<td colspan='6' style='text-align:center;'> Tidak ada data</td>";
                                                        echo "</tr>";
                                                    }

                                                    ?>
    </tbody>
</table>