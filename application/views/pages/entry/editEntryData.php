<?php
$dataKapal = '';
$dataLintasan = '';
$dataPelabuhan = '';
$dataPelabuhanTiba = '';
$dataTrip = '';
$dataTanggal = '';
$dataWaktu = '';
$dataWaktuTiba = '';
$dataTarif = '';
$dataGambar = '';
$dataBarangPendapatanSeriAwal = '';
$dataBarangPendapatanSeriAkhir = '';
$dataBarangPendapatanSeriAwal2 = '';
$dataBarangPendapatanSeriAkhir2 = '';
$dataBarangPendapatanSeriAwal3 = '';
$dataBarangPendapatanSeriAkhir3 = '';
$dataBarangPendapatan = '';
$dataBarangVolume = '';

$produksiSerialStart = 0;
$produksiSerialStart2 = 0;
$produksiSerialStart3 = 0;
$produksiSerialEnd = 0;
$produksiSerialEnd2 = 0;
$produksiSerialEnd3 = 0;

foreach ($editData as $row) {
    $dataKapal = $row['id_ferry'];
    $dataLintasan = $row['id_route'];
    $dataPelabuhan = $row['id_harbour'];
    $dataTrip = $row['id_trip'];
    $dataTanggal = $row['date'];
    $dataWaktu = $row['time'];
    $dataWaktuTiba = $row['departure_time'];
    $dataTarif = $row['rate_type'];
    $dataBarangPendapatanSeriAwal = $row['BarangPendapatanSerial_start'];
    $dataBarangPendapatanSeriAkhir = $row['BarangPendapatanSerial_end'];
    $dataBarangPendapatanSeriAwal2 = $row['BarangPendapatan2Serial_start'];
    $dataBarangPendapatanSeriAkhir2 = $row['BarangPendapatan2Serial_end'];
    $dataBarangPendapatanSeriAwal3 = $row['BarangPendapatan3Serial_start'];
    $dataBarangPendapatanSeriAkhir3 = $row['BarangPendapatan3Serial_end'];
    $dataBarangPendapatan = $row['BarangPendapatan'];
    $dataBarangVolume = $row['BarangVolume'];
    // $dataGambar = $row['BuktiSetoran'];
}

?>
<div class="card ">
    <div class="card-header">
        Edit Data Pendapatan Harian
    </div>
    <div class="card-body">
        <?php
        echo form_open(base_url('dashboard/entry/prosesEditEntryData?id=') . $_GET['id'], ['class' => 'form-entry']);
        ?>
        <div class="form-group row">
            <label for="nama_kapal" class="col-4 label-wrap"> Nama Kapal </label>
            <div class="col">
                <select class="form-control" name="nama_kapal" id="nama_kapal" required>
                    <option value="">No Selected</option>
                    <?php foreach ($kapal_spv as $row) : ?>
                        <?php if ($row['id_ferry'] == $dataKapal) { ?>
                            <option value="<?php echo $row['id_ferry']; ?>" selected>
                                <?php echo $row['kapal']; ?>
                            </option>
                        <?php } else { ?>
                            <option value="<?php echo $row['id_ferry']; ?>">
                                <?php echo $row['kapal']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    <?php endforeach; ?>
                </select>
                <?php
                echo form_error('nama_kapal');
                ?>
            </div>
        </div>

        <div class="form-group row">
            <label for="lintasan" class="col-4 label-wrap"> Lintasan </label>
            <div class="col">
                <select class="form-control" name="lintasan" id="lintasan" required>
                    <option value="">No Selected</option>
                    <?php foreach ($lintasan as $row) : ?>
                        <?php if ($row['id'] == $dataLintasan) { ?>
                            <option value="<?php echo $row['id']; ?>" selected>
                                <?php echo $row['lintasan']; ?>
                            </option>
                        <?php } else { ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo $row['lintasan']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    <?php endforeach; ?>
                </select>
                <?php
                echo form_error('lintasan');
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="trip" class="col-4 label-wrap"> Trip </label>
            <div class="col">
                <select class="form-control" name="trip" id="trip" required>
                    <option value="">No Selected</option>
                    <?php foreach ($trip as $row) : ?>
                        <?php if (!str_contains($row['id'], 'OFF')) { ?>
                            <?php if ($row['id'] == $dataTrip) { ?>
                                <option value="<?php echo $row['id']; ?>" selected>
                                    <?php echo $row['id']; ?>
                                </option>
                            <?php } else { ?>
                                <option value="<?php echo $row['id']; ?>">
                                    <?php echo $row['id']; ?>
                                </option>
                        <?php
                            }
                        }
                        ?>
                    <?php endforeach; ?>
                </select>
                <?php
                echo form_error('trip');
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="pelabuhan_asal" class="col-4 label-wrap"> Pelabuhan Asal </label>
            <div class="col">
                <select class="form-control" name="pelabuhan_asal" id="pelabuhan_asal" required>
                    <option value="">No Selected</option>
                    <?php foreach ($pelabuhan as $row) : ?>

                        <?php if ($row['id_harbours'] == $dataPelabuhan) { ?>
                            <option value="<?php echo $row['id_harbours']; ?>" selected>
                                <?php echo $row['pelabuhan']; ?>
                            </option>
                        <?php } else { ?>
                            <option value="<?php echo $row['id_harbours']; ?>">
                                <?php echo $row['pelabuhan']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    <?php endforeach; ?>
                </select>
                <?php
                echo form_error('pelabuhan_asal');
                ?>
            </div>
        </div>

        <div class="form-group row">
            <label for="edit_tanggal_berangkat" class="col-4 label-wrap"> Tanggal Berangkat </label>

            <div class="col-8">
                <input class="form-control" type="date" id="edit_tanggal_berangkat" name="edit_tanggal_berangkat" value=<?php echo $dataTanggal; ?> min="2022-11-01">
            </div>
        </div>
        <div class="form-group row">
            <label for="edit_waktu_berangkat" class="col-4 label-wrap"> Waktu Berangkat </label>
            <div class="col">
                <input class="form-control" type="time" id="edit_waktu_berangkat" name="edit_waktu_berangkat" value=<?php echo $dataWaktu; ?>>
            </div>
        </div>

        <div class="form-group row">
            <label for="edit_waktu_tiba" class="col-4 label-wrap"> Waktu Tiba </label>
            <div class="col">
                <input class="form-control" type="time" id="edit_waktu_tiba" name="edit_waktu_tiba" value=<?php echo $dataWaktuTiba; ?> <?php if ($this->session->userdata['pelabuhan'] != $dataPelabuhanTiba) { ?>disabled <?php } ?>>
            </div>
        </div>

        <!-- Input Jumlah Produksi -->
        <?php $no = "";
        $serialStart1 = 0;
        $serialEnd1 = 0;
        $serialStart2 = 0;
        $serialEnd2 = 0;
        $serialStart3 = 0;
        $serialEnd3 = 0;
        foreach ($produksi as $row) {
            foreach ($editData as $baris) {
                foreach ($baris as $key => $baris) {
                    if ($key == $row['id_production']) {
        ?>
                        <div class="form-group row ">
                            <label for="<?php echo $row['produksi']; ?>" class="col-4 label-wrap">
                                <?php echo $row['produksi']; ?>
                            </label>
                            <div class="col">
                                <input type="number" name="<?php echo $row['id_production'] . "Serial_start"; ?>" class="form-control input-produksi" id="<?php echo $row['id_production'] . "Serial_start"; ?>" value="
                                <?php
                                foreach ($editData as $baris) {
                                    foreach ($baris as $key => $baris) {
                                        if ($key == $row['id_production'] . "Serial_start") {
                                            echo $baris;
                                            $serialStart1 = $baris;
                                        }
                                    }
                                }
                                ?>" min="0">
                            </div>
                            <div class="col">
                                <input type="number" name="<?php echo $row['id_production'] . "Serial_end"; ?>" class="form-control input-produksi" id="<?php echo $row['id_production'] . "Serial_end"; ?>" value="
                                <?php
                                foreach ($editData as $baris) {
                                    foreach ($baris as $key => $baris) {
                                        if ($key == $row['id_production'] . "Serial_end") {
                                            echo $baris;
                                            $serialEnd1 = $baris;
                                        }
                                    }
                                }
                                ?>" min="0">
                            </div>
                            <div class="col">
                                <input type="number" name="<?php echo $row['id_production']; ?>" class="form-control" id="<?php echo $row['id_production']; ?>" value="
                                <?php
                                if ($serialEnd1 != 0 && $serialStart1 != 0) {
                                    echo ($serialEnd1 - $serialStart1) + 1;
                                } else {
                                    echo 0;
                                }
                                // foreach($editData as $baris){
                                //     foreach($baris as $key => $baris){
                                //         if($key == $row['id_production']){
                                //             // echo $baris;
                                //         }
                                //     }
                                // }
                                ?>" min=" 0">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="<?php echo $row['produksi']; ?>" class="col-4 label-wrap">
                                &#8203
                            </label>
                            <div class="col">
                                <input type="number" name="<?php echo $row['id_production'] . "2Serial_start"; ?>" class="form-control input-produksi" id="<?php echo $row['id_production'] . "2Serial_start"; ?>" value="
                                <?php
                                foreach ($editData as $baris) {
                                    foreach ($baris as $key => $baris) {
                                        if ($key == $row['id_production'] . "2Serial_start") {
                                            echo $baris;
                                            $serialStart2 = $baris;
                                        }
                                    }
                                }
                                ?>" min="0">
                            </div>
                            <div class="col">
                                <input type="number" name="<?php echo $row['id_production'] . "2Serial_end"; ?>" class="form-control input-produksi" id="<?php echo $row['id_production'] . "2Serial_end"; ?>" value="<
                                ?php
                                                                                                                                                                                                                        foreach ($editData as $baris) {
                                                                                                                                                                                                                            foreach ($baris as $key => $baris) {
                                                                                                                                                                                                                                if ($key == $row['id_production'] . " 2Serial_end") { echo $baris; $serialEnd2=$baris; } } } ?>" min="0">
                            </div>
                            <div class="col">
                                <input type="number" name="<?php echo $row['id_production'] . "2"; ?>" class="form-control " id="<?php echo $row['id_production'] . "2"; ?>" value="
                                <?php
                                if ($serialEnd2 != 0 && $serialStart2 != 0) {
                                    echo ($serialEnd2 - $serialStart2) + 1;
                                } else {
                                    if (is_null($moon))
                                        echo -1;
                                }
                                // foreach($editData as $baris){
                                //     foreach($baris as $key => $baris){
                                //         if($key == $row['id_production']."2"){
                                //             // echo $baris;


                                //         }
                                //     }
                                // }
                                ?>" min="0">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="<?php echo $row['produksi']; ?>" class="col-4 label-wrap">
                                &#8203
                            </label>
                            <div class="col">
                                <input type="number" name="<?php echo $row['id_production'] . "3Serial_start"; ?>" class="form-control input-produksi" id="<?php echo $row['id_production'] . "3Serial_start"; ?>" value="<?php
                                                                                                                                                                                                                            foreach ($editData as $baris) {
                                                                                                                                                                                                                                foreach ($baris as $key => $baris) {
                                                                                                                                                                                                                                    if ($key == $row['id_production'] . "3Serial_start") {
                                                                                                                                                                                                                                        echo $baris;
                                                                                                                                                                                                                                        $serialStart3 = $baris;
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            ?>" min="0">
                            </div>
                            <div class="col">
                                <input type="number" name="<?php echo $row['id_production'] . "3Serial_end"; ?>" class="form-control input-produksi" id="<?php echo $row['id_production'] . "3Serial_end"; ?>" value="<?php
                                                                                                                                                                                                                        foreach ($editData as $baris) {
                                                                                                                                                                                                                            foreach ($baris as $key => $baris) {
                                                                                                                                                                                                                                if ($key == $row['id_production'] . "3Serial_end") {
                                                                                                                                                                                                                                    echo $baris;
                                                                                                                                                                                                                                    $serialEnd3 = $baris;
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                        ?>" min="0">
                            </div>
                            <div class="col">
                                <input type="number" name="<?php echo $row['id_production'] . "3"; ?>" class="form-control " id="<?php echo $row['id_production'] . "3"; ?>" value=<?php
                                                                                                                                                                                    if ($serialEnd3 != 0 && $serialStart3 != 0) {
                                                                                                                                                                                        echo ($serialEnd3 - $serialStart3) + 1;
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo 0;
                                                                                                                                                                                    }
                                                                                                                                                                                    // foreach($editData as $baris){
                                                                                                                                                                                    //     foreach($baris as $key => $baris){
                                                                                                                                                                                    //         if($key == $row['id_production']."3"){
                                                                                                                                                                                    //             // echo $baris;
                                                                                                                                                                                    //         }
                                                                                                                                                                                    //     }
                                                                                                                                                                                    // }
                                                                                                                                                                                    ?> min="0">
                            </div>
                        </div>
        <?php
                    }
                }
            }
        }
        ?>
        <!-- Akhir Input Jumlah Produksi -->

        <div class="form-group row ">
            <label for="BarangPendapatan" class="col-4 label-wrap">
                PRODUKSI BARANG CURAH
            </label>
            <div class="col">
                <input type="number" name="BarangPendapatanSerial_start" class="form-control input-produksi" id="BarangPendapatanSerial_start" value="<?php echo $dataBarangPendapatanSeriAwal; ?>" min="0">
            </div>
            <div class="col">
                <input type="number" name="BarangPendapatanSerial_end" class="form-control input-produksi" id="BarangPendapatanSerial_end" value=<?php echo $dataBarangPendapatanSeriAkhir; ?> min="0">
            </div>
            <div class="col">
                <input type="number" class="form-control" name="BarangPendapatan" id="BarangPendapatan" placeholder="0" value=<?php if ($dataBarangPendapatanSeriAkhir2 != 0 && $dataBarangPendapatanSeriAwal2 !=  0) echo ((int) $dataBarangPendapatanSeriAkhir - (int) $dataBarangPendapatanSeriAwal + 1); ?> min="0" placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="BarangPendapatan" class="col-4 label-wrap">
                &#8203
            </label>
            <div class="col">
                <input type="number" name="BarangPendapatan2Serial_start" class="form-control input-produksi" id="BarangPendapatan2Serial_start" value="<?php echo $dataBarangPendapatanSeriAwal2; ?>" min="0">
            </div>
            <div class="col">
                <input type="number" name="BarangPendapatan2Serial_end" class="form-control input-produksi" id="BarangPendapatan2Serial_end" value=<?php echo $dataBarangPendapatanSeriAkhir2; ?> min="0">
            </div>
            <div class="col">
                <input type="number" class="form-control" name="BarangPendapatan2" id="BarangPendapatan2" placeholder="0" value=<?php if ($dataBarangPendapatanSeriAkhir2 != 0 && $dataBarangPendapatanSeriAwal2 !=  0) echo ((int) $dataBarangPendapatanSeriAkhir2 - (int) $dataBarangPendapatanSeriAwal2 + 1); ?> min="0" placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="BarangPendapatan" class="col-4 label-wrap">
                &#8203
            </label>
            <div class="col">
                <input type="number" name="BarangPendapatan3Serial_start" class="form-control input-produksi" id="BarangPendapatan3Serial_start" value="<?php echo $dataBarangPendapatanSeriAwal3; ?>" min="0">
            </div>
            <div class="col">
                <input type="number" name="BarangPendapatan3Serial_end" class="form-control input-produksi" id="BarangPendapatan3Serial_end" value=<?php echo $dataBarangPendapatanSeriAkhir3; ?> min="0">
            </div>
            <div class="col">
                <input type="number" class="form-control" name="Barang3Pendapatan" id="Barang3Pendapatan" placeholder="0" value=<?php if ($dataBarangPendapatanSeriAkhir3 != 0 && $dataBarangPendapatanSeriAwal3 !=  0) echo ((int) $dataBarangPendapatanSeriAkhir3 - (int) $dataBarangPendapatanSeriAwal3 + 1); ?> min="0" placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="barang_volume" class="col-4 label-wrap">
                PENDAPATAN BARANG CURAH
            </label>
            <div class="col">
                <input type="number" class="form-control" name="barang_volume" id="barang_volume" value=<?php echo $dataBarangPendapatan; ?> min="0" placeholder="5000000">
            </div>
        </div>

        <div class="form-group row ">
            <label for="barang_volume" class="col-4 label-wrap">
                CATATAN OPERASIONAL
            </label>
            <div class="col">
                <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="(Opsional) Kendala Pelayaran / Catatan Permasalahan Pendapatan"></textarea>
            </div>
        </div>
        <?php
        echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
        echo form_close();
        ?>
    </div>
</div>

<!-- <div class="form-group row ">
            <label for="barang_volume" class="col-4 label-wrap">
                LAMPIRAN BUKTI SETORAN
            </label>
            <div class="col">
                <div class="mb-3">
                    <label for="formFile" class="form-label"> <a href="">Tampilkan Bukti Setoran</a> : <?php echo $dataGambar; ?> </label>

                    <input id="bukti-setoran" name="bukti-setoran" class="form-control" type="file" id="formFile">
                </div>
            </div>
        </div> -->