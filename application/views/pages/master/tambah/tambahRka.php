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
            <label for="tanggal_tiba" class="col-4 label-wrap"> Tanggal Tiba </label>

            <div class="col-8">
                <input class="form-control" type="date" id="tanggal_tiba" name="tanggal_tiba" value="2022-11-01" min="2022-11-01">
            </div>
        </div>
        <div class="form-group row">
            <label for="tanggal_berangkat" class="col-4 label-wrap"> Tanggal Berangkat </label>

            <div class="col-8">
                <input class="form-control" type="date" id="tanggal_berangkat" name="tanggal_berangkat" value="2022-11-01" min="2022-11-01">
            </div>
        </div>
        <div class="form-group row">
            <label for="waktu_tiba" class="col-4 label-wrap"> Waktu Tiba </label>
            <div class="col">
                <input class="form-control" type="time" id="waktu_tiba" name="waktu_tiba">
            </div>
        </div>
        <div class="form-group row">
            <label for="waktu_berangkat" class="col-4 label-wrap"> Waktu Berangkat </label>
            <div class="col">
                <input class="form-control" type="time" id="waktu_berangkat" name="waktu_berangkat">
            </div>
        </div>