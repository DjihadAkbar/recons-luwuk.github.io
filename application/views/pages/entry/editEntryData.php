<?php
$dataKapal = ''; 
$dataLintasan = ''; 
$dataPelabuhan = ''; 
$dataTrip = ''; 
$dataTanggal = ''; 
$dataWaktu = ''; 
$dataTarif = '';
$dataBarangPendapatan = '';
$dataBarangVolume = '';
foreach($editData as $row){
    $dataKapal = $row['id_ferry']; 
    $dataLintasan = $row['id_route']; 
    $dataPelabuhan = $row['id_harbour']; 
    $dataTrip = $row['id_trip']; 
    $dataTanggal = $row['date']; 
    $dataWaktu = $row['time']; 
    $dataTarif = $row['rate_type'];
    $dataBarangPendapatan = $row['BarangPendapatan'];
    $dataBarangVolume = $row['BarangVolume'];
}

?>
<div class="card ">
    <div class="card-header">
        Edit Data Pendapatan Harian
    </div>
    <div class="card-body">
        <?php
        echo form_open(base_url('dashboard/entry/prosesEditEntryData?id=').$_GET['id'] , ['class' => 'form-entry']);
        ?>
        <div class="form-group row">
            <label for="nama_kapal" class="col-4 label-wrap"> Nama Kapal </label>
            <div class="col">
                <select class="form-control" name="nama_kapal" id="nama_kapal" required>
                    <option value="">No Selected</option>
                    <?php foreach ($kapal_spv as $row): ?>
                        <?php if($row['id_ferry'] == $dataKapal) {?>
                        <option value="<?php echo $row['id_ferry'];?>" selected>
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
                    <?php foreach ($lintasan as $row): ?>
                        <?php if($row['id'] == $dataLintasan) {?>
                        <option value="<?php echo $row['id'];?>" selected>
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
                    <?php foreach ($trip as $row): ?>
                    <?php if($row['id'] == $dataTrip) {?>
                        <option value="<?php echo $row['id'];?>" selected>
                            <?php echo $row['id']; ?>
                        </option>
                        <?php } else { ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['id']; ?>
                        </option>
                        <?php 
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
                    <?php foreach ($pelabuhan as $row): ?>
                        <?php if($row['id_harbours'] == $dataPelabuhan) {?>
                        <option value="<?php echo $row['id_harbours'];?>" selected>
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
            <label for="jenis_tarif" class="col-4 label-wrap"> Jenis Tarif </label>
            <div class="col">
                <select class="form-control" name="jenis_tarif" id="jenis_tarif" required>
                    <option value="">No Selected</option>
                    <?php foreach ($tarif as $row): ?>
                        <?php if($row['tarif'] == $dataTarif) {?>
                        <option value="<?php echo $row['tarif'];?>" selected>
                            <?php echo $row['tarif']; ?>
                        </option>
                        <?php } else { ?>
                        <option value="<?php echo $row['tarif']; ?>">
                            <?php echo $row['tarif']; ?>
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
            <label for="tanggal_berangkat" class="col-4 label-wrap"> Tanggal Operasi </label>

            <div class="col-8">
                <input class="form-control" type="date" id="tanggal_berangkat" name="tanggal_berangkat"
                value=<?php echo $dataTanggal;?> min="2022-11-01" max="2023-12-31">
            </div>
        </div>
        <div class="form-group row">
            <label for="waktu_berangkat" class="col-4 label-wrap"> Waktu Operasi </label>
            <div class="col">
                <input class="form-control" type="time" id="waktu_berangkat" name="waktu_berangkat" value=<?php echo $dataWaktu;?>>
            </div>
        </div>
        <!-- Input Jumlah Produksi -->
        <?php $no = ""; foreach ($produksi as $row) { ?>
            <div class="form-group row ">
                <label for="<?php echo $row['produksi']; ?>" class="col-4 label-wrap">
                    <?php echo $row['produksi']; ?>
                </label>
                <div class="col">
                    
                    <input type="number" name="<?php echo $row['id_production']; ?>" class="form-control"
                        id="<?php echo $row['id_production']; ?>" value=
                        <?php
                            foreach($editData as $baris){
                                foreach($baris as $key => $baris){
                                    if($key == $row['id_production']){
                                        echo $baris;
                                    }
                                }
                            }

                        ?>
                        min="0" required>
                </div>
            </div>
            <?php
        }
        ?>
        <!-- Akhir Input Jumlah Produksi -->

        <div class="form-group row ">
            <label for="hewan" class="col-4 label-wrap">
                Hewan
            </label>
            <div class="col">
                <input type="number" class="form-control" name="hewan" id="hewan" placeholder="500000" value="0" min="0"
                    placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="gayor" class="col-4 label-wrap">
                Gayor
            </label>
            <div class="col">
                <input type="number" class="form-control" name="gayor" id="gayor" placeholder="500000" value="0" min="0"
                    placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="carter" class="col-4 label-wrap">
                Carter
            </label>
            <div class="col">
                <input type="number" class="form-control" name="carter" id="carter" placeholder="500000" value="0"
                    min="0" placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="barang_volume" class="col-4 label-wrap">
                Barang Volume
            </label>
            <div class="col">
                <input type="number" class="form-control" name="barang_volume" id="barang_volume" value=<?php echo $dataBarangVolume;?> min="0"
                    placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="barang_pendapatan" class="col-4 label-wrap">
                Barang Pendapatan
            </label>
            <div class="col">
                <input type="number" class="form-control" name="barang_pendapatan" id="barang_pendapatan"
                    placeholder="500000" value=<?php echo $dataBarangPendapatan; ?> min="0" placeholder="Jumlah Volume">
            </div>
        </div>
        <?php
        echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
        echo form_close();
        ?>
    </div>
</div>