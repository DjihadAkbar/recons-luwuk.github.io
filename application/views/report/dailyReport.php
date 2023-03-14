<div class="card ">
    <div class="card-header d-flex justify-content-between align-items-center " id="headingOne" >
        
        <?php
        echo form_open(base_url('dashboard/report/downloadDailyReport'), ['class' => 'form-report','method' => 'POST', 'id' => 'form-report']);
            ?>
        <div class="form-group row">
            <div class="form-group col">
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
            <!-- <div class="form-group col">
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
            </div> -->
            <div class="form-group col">
                <label for="pelabuhan_asal_report" class="label-wrap  ml-2"> PELABUHAN </label>
                <div class="col">
                    <select class="form-control" name="pelabuhan_asal_report" id="pelabuhan_asal_report" required>
                        <option value="" disabled Selected>No Selected</option>
                        <?php foreach ($pelabuhan as $row): ?>
                            <option value="<?php echo $row['pelabuhan']; ?>">
                                <?php echo $row['pelabuhan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php
                    echo form_error('pelabuhan_asal_report');
                    ?>
                </div>
            </div>

            <div class="form-group col">
                <label for="lintasan_report" class="label-wrap  ml-2"> LINTASAN </label>
                <div class="col">
                    <select class="form-control" name="lintasan_report" id="lintasan_report" required>
                        <option value="" disabled Selected>No Selected</option>
                        <?php foreach ($lintasan as $row): ?>
                            <option value="<?php echo $row['lintasan']; ?>">
                                <?php echo $row['lintasan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php
                    echo form_error('lintasan_report');
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
            <!-- <div class="form-group col">
                <label for="tanggal_akhir" class="label-wrap  ml-2"> TANGGAL AKHIR </label>
                
                <div class="col">
                    <input class="form-control" type="date" id="tanggal_akhir" name="tanggal_akhir" value="2022-11-01"
                    min="2022-11-01" max="2023-12-31">
                </div>
            </div> -->

            <div class="form-group col">
                <label for="trip" class="label-wrap  ml-2" style="display:inline-block;">&#8203;  </label>
            <div class="col">
                <?php
            echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block' ], 'Download');
            echo form_close();
            ?>
            </div>

            </div>
        </div>
    </div>
</div>
