<div class="card ">
    <div class="card-header">
        Entry Pendapatan Harian
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
                    <?php foreach ($kapal_spv as $row): ?>
                        <option value="<?php echo $row['id_ferry']; ?>">
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
                    <?php foreach ($lintasan as $row): ?>
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
            <label for="trip" class="col-4 label-wrap"> Trip </label>
            <div class="col">
                <select class="form-control" name="trip" id="trip" required>
                    <option value="">No Selected</option>
                    <option value="REGULER">
                        REGULER
                    </option>
                    <option value="EXTRA TRIP">
                        EXTRA TRIP
                    </option>
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
            <label for="tanggal_berangkat" class="col-4 label-wrap"> Tanggal Berangkat </label>

            <div class="col-8">
                <input class="form-control" type="date" id="tanggal_berangkat" name="tanggal_berangkat"
                    value="2022-11-01" min="2022-11-01" max="2023-12-31">
            </div>
        </div>
        <div class="form-group row">
            <label for="waktu_berangkat" class="col-4 label-wrap"> Waktu Berangkat </label>
            <div class="col">
                <input class="form-control" type="time" id="waktu_berangkat" name="waktu_berangkat">
            </div>
        </div>
        <!-- Input Jumlah Produksi -->
        <?php $no = ""; foreach ($produksi as $row) { ?>
            <div class="form-group row ">
                <label for="<?php echo $row['produksi']; ?>" class="col-4 label-wrap">
                    <?php echo $row['produksi']; ?>
                </label>
                <div class="col">
                    <input type="number" name="<?php echo $row['id_production']."Serial_start"; ?>" class="form-control"
                    id="<?php echo $row['id_production']."Serial_start"; ?>" placeholder="<?php echo "Saldo Awal "?>" min="0">
                </div>
                <div class="col">
                    <input type="number" name="<?php echo $row['id_production']."Serial_end"; ?>" class="form-control"
                    id="<?php echo $row['id_production']."Serial_end"; ?>" placeholder="<?php echo "Saldo Akhir "?>" min="0">
                </div>
                <div class="col">
                    <input type="number" name="<?php echo $row['id_production']; ?>" class="form-control"
                    id="<?php echo $row['id_production']; ?>" placeholder="0" min="0">
                </div>
            </div>
            <?php
        }
        ?>
        <!-- Akhir Input Jumlah Produksi -->

        <div class="form-group row ">
            <label for="hewan" class="col-4 label-wrap">
                HEWAN
            </label>
            <div class="col">
                <input type="number" class="form-control" name="hewan" id="hewan" placeholder="0" min="0"
                    placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="gayor" class="col-4 label-wrap">
                GAYOR
            </label>
            <div class="col">
                <input type="number" class="form-control" name="gayor" id="gayor" placeholder="0" min="0"
                    placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="carter" class="col-4 label-wrap">
                CARTER
            </label>
            <div class="col">
                <input type="number" class="form-control" name="carter" id="carter" placeholder="0"
                    min="0" placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="barang_volume" class="col-4 label-wrap">
                BARANG VOLUME (JUMLAH BARANG CURAH)
            </label>
            <div class="col">
                <input type="number" class="form-control" name="barang_volume" id="barang_volume" placeholder="0" min="0"
                    placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="barang_pendapatan" class="col-4 label-wrap">
                BARANG PENDAPATAN (CURAH)
            </label>
            <div class="col">
                <input type="number" class="form-control" name="barang_pendapatan" id="barang_pendapatan"
                    placeholder="5000000" min="0" placeholder="Jumlah Volume">
            </div>
        </div>
        <?php
        echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
        echo form_close();
        ?>
    </div>
</div>