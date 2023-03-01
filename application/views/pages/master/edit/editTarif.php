<?php
$dataLintasan = ''; 
$dataTanggal = ''; 
$dataTarif = '';
$dataBarangPendapatan = '';
$dataBarangVolume = '';
foreach($editDataTarif as $row){

    $dataLintasan = $row['id_route']; 
    $dataTanggal = $row['start_date']; 
    $dataTarif = $row['rate_type'];
    $dataBarangPendapatan = $row['BarCur'];
    $dataBarangVolume = $row['BarangVolume'];
}

?>
<div class="card ">
    <div class="card-header">
        Edit Data Tarif
    </div>
    <div class="card-body">
        <?php
        echo form_open(base_url('dashboard/master/tarif/prosesEditTarif?id=').$_GET['id'] , ['class' => 'form-entry']);
        ?>
        

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
            <label for="edit_tanggal_berlaku" class="col-4 label-wrap"> Tanggal Berlaku </label>

            <div class="col-8">
                <input class="form-control" type="date" id="edit_tanggal_berlaku" name="edit_tanggal_berlaku"
                value=<?php echo $dataTanggal;?> min="2022-11-01">
            </div>
        </div>
        
        <!-- Input Jumlah Produksi -->
        <?php $no = ""; 
        foreach ($produksi as $row) { 
            foreach($editDataTarif as $baris){
                foreach($baris as $key => $baris){
                    if($key == $row['id_production']){
            ?>
            <div class="form-group row ">
                <label for="<?php echo $row['produksi']; ?>" class="col-4 label-wrap">
                    <?php echo $row['produksi']; ?>
                </label>
                <div class="col">
                    <input type="number" name="<?php echo $row['id_production']; ?>" class="form-control"
                        id="<?php echo $row['id_production']; ?>" value=
                        <?php
                            foreach($editDataTarif as $baris){
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
                }
            }
        }
        ?>
        <div class="form-group row ">
            <label for="barang_volume" class="col-4 label-wrap">
                BARANG VOLUME (JUMLAH BARANG CURAH)
            </label>
            <div class="col">
                <input type="number" class="form-control" name="barang_volume" id="barang_volume" value=<?php echo $dataBarangVolume;?> min="0"
                    placeholder="Jumlah Volume">
            </div>
        </div>
        <div class="form-group row ">
            <label for="barang_pendapatan" class="col-4 label-wrap">
                BARANG PENDAPATAN (CURAH)
            </label>
            <div class="col">
                <input type="number" class="form-control" name="barang_pendapatan" id="barang_pendapatan"
                    placeholder="500000" value=<?php echo $dataBarangPendapatan; ?> min="0" placeholder="Jumlah Volume">
            </div>
        </div>
        <!-- Akhir Input Jumlah Produksi -->

        <!-- Input Jumlah Produksi TJP-->
        <?php $no = ""; 
        foreach ($produksi as $row) { 
            foreach($editDataTarif as $baris){
                foreach($baris as $key => $baris){
                    if($key == $row['id_production']."TJP"){
            ?>
            <div class="form-group row ">
                <label for="<?php echo $row['produksi']." TJP"; ?>" class="col-4 label-wrap">
                    <?php echo $row['produksi']." TJP"; ?>
                </label>
                <div class="col">
                    <input type="number" name="<?php echo $row['id_production']."TJP"; ?>" class="form-control"
                        id="<?php echo $row['id_production']."TJP"; ?>" value=
                        <?php
                            foreach($editDataTarif as $baris){
                                foreach($baris as $key => $baris){
                                    if($key == $row['id_production']."TJP"){
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
                }
            }
        }
        ?>
        <!-- Akhir Input Jumlah Produksi TJP-->
        
        <!-- Input Jumlah Produksi IW-->
        <?php $no = ""; 
        foreach ($produksi as $row) { 
            foreach($editDataTarif as $baris){
                foreach($baris as $key => $baris){
                    if($key == $row['id_production']."IW"){
            ?>
            <div class="form-group row ">
                <label for="<?php echo $row['produksi']." IW"; ?>" class="col-4 label-wrap">
                    <?php echo $row['produksi']." IW"; ?>
                </label>
                <div class="col">
                    <input type="number" name="<?php echo $row['id_production']."IW"; ?>" class="form-control"
                        id="<?php echo $row['id_production']."IW"; ?>" value=
                        <?php
                            foreach($editDataTarif as $baris){
                                foreach($baris as $key => $baris){
                                    if($key == $row['id_production']."IW"){
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
                }
            }
        }
        ?>
        <!-- Akhir Input Jumlah Produksi IW-->

        
        <?php
        echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
        echo form_close();
        ?>
    </div>
</div>