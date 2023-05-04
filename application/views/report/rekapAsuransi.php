<div class="card ">
    <div class="card-header d-flex justify-content-between align-items-center " id="headingOne" >
        
        <?php
        echo form_open(base_url('dashboard/report/downloadRekapAsuransi'), ['class' => 'form-report','method' => 'POST', 'id' => 'form-report']);
            ?>
        <div class="form-group row">
            <!-- <div class="form-group col">
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
            </div> -->
            <div class="form-group col">
                <label for="bulan_report" class="label-wrap  ml-2">BULAN </label>
                <div class="col">
                    <select class="form-control" name="bulan_report" id="bulan_report" required size='1'>
                            <?php

                            $bulan = [1 => "JANUARI","FEBURARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER"];


                            for ($i = 0; $i < 12; $i++) {
                            $AmbilNamaBulan = strtotime(sprintf('%d months', $i));
                            $LabelBulan     = $bulan[date('n', $AmbilNamaBulan)];
                            $ValueBulan     = date('n', $AmbilNamaBulan);
                            // if ($ValueBulan <= $i ) continue;
                        ?>
                        <option value="<?php echo $ValueBulan;?>"><?php echo $LabelBulan;?></option>
                        <?php }?>
                    </select>
                    <?php
                    echo form_error('bulan_report');
                    ?>
                </div>
            </div>
            <div class="form-group col">
                <label for="tahun_report" class="label-wrap  ml-2"> TAHUN </label>
                <div class="col">
                    <select class="form-control" name="tahun_report" id="tahun_report" required size='1' >
                    <?php 
                    for($i = date('Y') -2; $i < date('Y') + 1; $i++){
                        echo "<option>$i</option>";
                        
                    }
                    ?>
                    </select>
                    <?php
                    echo form_error('tahun_report');
                    ?>
                </div>
            </div>
            
            

            <!-- <div class="form-group col">
                <label for="tanggal_berangkat" class="label-wrap  ml-2"> TANGGAL AWAL </label>
                
                <div class="col">
                    <input class="form-control" type="date" id="tanggal_berangkat" name="tanggal_berangkat" value="2022-11-01"
                    min="2022-11-01" >
                </div>
            </div> -->
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
