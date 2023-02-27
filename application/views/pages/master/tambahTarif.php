<div class="card ">
    <div class="card-header">
        Tambah Tarif
    </div>
    <div class="card-body">
        <?php
        echo form_open(base_url('dashboard/master/tarif/prosesTambahTarif'), ['class' => 'form-entry']);
        ?>
       <ul class="list-group list-group-flush">
        <li class="list-group-item">

            <div class="form-group row">
                <label for="lintasan" class="col-4 label-wrap"> LINTASAN </label>
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
                <label for="tanggal_berlaku" class="col-4 label-wrap"> TANGGAL BERLAKU </label>
                
                <div class="col">
                    <input class="form-control" type="date" id="tanggal_berlaku" name="tanggal_berlaku" value="2022-11-01"
                    min="2022-11-01" max="2023-12-31">
                </div>
            </div>
        </li>

        <li class="list-group-item tarif-utama">
            <!-- Input Jumlah Produksi -->
            <?php $no = ""; foreach ($produksi as $row) { ?>
                <div class="form-group row">
                    <label for="<?php echo $row['produksi']; ?>" class="col-4 label-wrap">
                        <?php echo $row['produksi']; ?>
                    </label>
                    <div class="col">
                        <input type="number" name="<?php echo $row['id_production']; ?>" class="form-control"
                            id="<?php echo $row['id_production']; ?>" value="0" min="0" required>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="form-group row ">
                <label for="barang_volume" class="col-4 label-wrap">
                    BARANG VOLUME
                </label>
                <div class="col">
                    <input type="number" class="form-control" name="barang_volume" id="barang_volume" value="0"
                        min="0" placeholder="Jumlah Volume">
                </div>
            </div>
            <div class="form-group row ">
                <label for="barang_pendapatan" class="col-4 label-wrap">
                    BARANG PENDAPATAN (CURAH)
                </label>
                <div class="col">
                    <input type="number" class="form-control" name="barang_pendapatan" id="barang_pendapatan"
                        value="0" min="0" placeholder="Jumlah Volume">
                </div>
            </div>
        </li>

            <li class="list-group-item tjp">

                    <!-- Input Jumlah Produksi -->
                    <?php $no = "";
                    foreach ($produksi as $row) {
                        if ($row['type'] == 'KENDARAAN' or $row['type'] == 'PENUMPANG') {
                            ?>
                            <div class="form-group row ">
                                <label for="<?php echo $row['produksi']; ?>" class="col-4 label-wrap">
                                    <?php echo $row['produksi'] . " TJP"; ?>
                                </label>
                                <div class="col">
                                    <input type="number" name="<?php echo $row['id_production'] . "TJP"; ?>" class="form-control"
                                        id="<?php echo $row['id_production'] . "TJP"; ?>" value="0" min="0" required>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
            </li>
            <li class="list-group-item iw">

                    <!-- Input Jumlah Produksi -->
                    <?php $no = "";
                    foreach ($produksi as $row) {
                        if ($row['type'] == 'KENDARAAN' or $row['type'] == 'PENUMPANG') {
                            ?>
                            <div class="form-group row ">
                                <label for="<?php echo $row['produksi']; ?>" class="col-4 label-wrap">
                                    <?php echo $row['produksi'] . " IW"; ?>
                                </label>
                                <div class="col">
                                    <input type="number" name="<?php echo $row['id_production'] . "IW"; ?>" class="form-control"
                                        id="<?php echo $row['id_production'] . "IW"; ?>" value="0" min="0" required>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
            </li>
        </ul>

        <!-- Akhir Input Jumlah Produksi -->


        <?php
        echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
        echo form_close();
        ?>
    </div>
</div>