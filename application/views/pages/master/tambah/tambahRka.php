<div class="card ">
    <div class="card-header">
        Tambah RKA
    </div>
    <div class="card-body">
        <?php
        echo form_open(base_url('dashboard/entry/prosesEntry'), ['class' => 'form-entry']);
        ?>
        <div class="form-group row">
            <label for="nama_kapal" class="col-4 label-wrap"> Nama Kapal </label>
            <div class="col">
                <select class="form-control" name="nama_kapal" id="nama_kapal" required>
                    <option value="">No Selected</option>
                    <?php foreach ($kapal as $row) : ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['kapal']; ?>
                        </option>
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
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['lintasan']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php
                echo form_error('lintasan');
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="pelabuhan_asal" class="col-4 label-wrap"> Pelabuhan Asal </label>
            <div class="col">
                <select class="form-control" name="pelabuhan_asal" id="pelabuhan_asal" required>
                    <option value="">No Selected</option>
                    <?php foreach ($pelabuhan as $row) : ?>
                        <option value="<?php echo $row['id_harbours']; ?>">
                            <?php echo $row['pelabuhan']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php
                echo form_error('pelabuhan_asal');
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="bulanRka" class=" col-4 label-wrap"> Bulan </label>
            <div class="col">
                <select class="form-control" name="bulanRka" id="bulanRka" required size='1'>
                        <?php

                        $bulan = [1 => "JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER"];


                        for ($i = 0; $i < 12; $i++) {
                        $AmbilNamaBulan = strtotime(sprintf('%d month', $i));
                        $LabelBulan     = $bulan[date('n', $AmbilNamaBulan)];
                        $ValueBulan     = date('n', $AmbilNamaBulan);
                        // if ($ValueBulan <= $i ) continue;
                    ?>
                    <option value="<?php echo $ValueBulan;?>"><?php echo $LabelBulan;?></option>
                    <?php }?>
                </select>
                <?php
                echo form_error('bulanRka');
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="tahunRka" class="col-4 label-wrap"> Tahun </label>
            <div class="col">
                    <select class="form-control" name="tahunRka" id="tahunRka" required size='1' >
                    <?php 
                    for($i = date('Y'); $i < date('Y')+1; $i++){
                        echo "<option>$i</option>";
                    }
                    ?>
                    </select>
                    <?php
                    echo form_error('tahunRka');
                    ?>
            </div>
        </div>