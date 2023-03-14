<div class="card ">
    <div class="card-header d-flex justify-content-between align-items-center " id="headingOne" >
        
        <?php
        echo form_open(base_url('dashboard/report/'), ['class' => 'form-report','method' => 'POST', 'id' => 'form-report']);
            ?>
        <div class="form-group row">
            <!-- <div class="form-group col">
                <label for="nama_kapal" class="label-wrap  ml-2"> NAMA KAPAL </label>
                <div class="col">
                    <select class="form-control" name="nama_kapal" id="nama_kapal" required>
                        <option value="" disabled Selected>No Selected</option>
                        <?php foreach ($kapal as $row): ?>
                            <option value="<?php echo $row['kapal']; ?>">
                                <?php echo $row['kapal']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php
                    echo form_error('nama_kapal');
                    ?>
                </div>
            </div>
    
            
            <div class="form-group col">
                <label for="trip" class="label-wrap  ml-2"> TRIP </label>
                <div class="col">
                    <select class="form-control" name="trip" id="trip" required>
                        <option value="" disabled Selected>No Selected</option>
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
            <div class="form-group col">
                <label for="pelabuhan_asal" class="label-wrap  ml-2"> PELABUHAN </label>
                <div class="col">
                    <select class="form-control" name="pelabuhan_asal" id="pelabuhan_asal" required>
                        <option value="" disabled Selected>No Selected</option>
                        <?php foreach ($pelabuhan as $row): ?>
                            <option value="<?php echo $row['pelabuhan']; ?>">
                                <?php echo $row['pelabuhan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php
                    echo form_error('pelabuhan_asal');
                    ?>
                </div>
            </div>

            <div class="form-group col">
                <label for="lintasan" class="label-wrap  ml-2"> LINTASAN </label>
                <div class="col">
                    <select class="form-control" name="lintasan" id="lintasan" required>
                        <option value="" disabled Selected>No Selected</option>
                        <?php foreach ($lintasan as $row): ?>
                            <option value="<?php echo $row['lintasan']; ?>">
                                <?php echo $row['lintasan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php
                    echo form_error('lintasan');
                    ?>
                </div>
            </div>
            <div class="form-group col">
                <label for="tanggal_awal" class="label-wrap  ml-2"> TANGGAL AWAL </label>
                
                <div class="col">
                    <input class="form-control" type="date" id="tanggal_awal" name="tanggal_awal" value="2022-11-01"
                    min="2022-11-01" max="2023-12-31">
                </div>
            </div>
            <div class="form-group col">
                <label for="tanggal_akhir" class="label-wrap  ml-2"> TANGGAL AKHIR </label>
                
                <div class="col">
                    <input class="form-control" type="date" id="tanggal_akhir" name="tanggal_akhir" value="2022-11-01"
                    min="2022-11-01" max="2023-12-31">
                </div>
            </div> -->


            <div class="form-group col">
                <label for="jenis_laporan" class="label-wrap  ml-2"> JENIS LAPORAN </label>
                <div class="col">
                    <select onchange="OnSelectionChange()" class="form-control" name="jenis_laporan" id="jenis_laporan" required>
                        <option value="" disabled Selected>No Selected</option>
                        <option value="dailyReport">
                            Laporan Pendapatan harian
                        </option>
                        <option value="buktiPenyetoran">
                            Bukti Penyetoran
                        </option>
                    </select>
                    <?php
                    echo form_error('trip');
                    ?>
                </div>
            </div>

            <div class="form-group col">
                <label for="trip" class="label-wrap  ml-2" style="display:inline-block;">&#8203;  </label>
            <div class="col">
                <?php
            echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
            echo form_close();
            ?>
            </div>

            </div>
        </div>
        <div class="card-body">
            
        </div>
    </div>
</div>