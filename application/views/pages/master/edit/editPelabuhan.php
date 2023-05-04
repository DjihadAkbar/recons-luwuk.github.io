<?php
$dataHarbour = ''; 
$dataCode = ''; 
$dataTimezone = '';
$dataName = '';
foreach($editDataPelabuhan as $row){
    $dataHarbour = $row['harbour']; 
    $dataCode = $row['code']; 
    $dataTimezone = $row['timezone'];
    $dataName = $row['name'];
}

?>
<div class="card ">
    <div class="card-header">
        Edit Data Pelabuhan
    </div>
    <div class="card-body">
        <?php
        echo form_open(base_url('dashboard/master/pelabuhan/prosesEditPelabuhan?id=').$_GET['id'] , ['class' => 'form-entry']);
        ?>

            <div class="form-group row ">
                <label for="pelabuhan" class="col-4 label-wrap">
                    Pelabuhan
                </label>
                <div class="col">
                    <input type="text" name="pelabuhan" class="form-control"
                        id="pelabuhan" value="<?php echo $dataHarbour;?>"
                        
                        min="0" disabled>
                </div>
            </div>
            <div class="form-group row ">
                <label for="nama_pelabuhan" class="col-4 label-wrap">
                    Nama Pelabuhan
                </label>
                <div class="col">
                    <input type="text" name="nama_pelabuhan" class="form-control"
                        id="nama_pelabuhan" value="<?php echo $dataName;?>"
                        
                        min="0" >
                </div>
            </div>
            <div class="form-group row ">
                <label for="code_pelabuhan" class="col-4 label-wrap">
                    Code
                </label>
                <div class="col">
                    <input type="text" name="code_pelabuhan" class="form-control"
                        id="code_pelabuhan" value="<?php echo $dataCode;?>"
                        
                        min="0" >
                </div>
            </div>
            <div class="form-group row ">
                <label for="timezone_pelabuhan" class="col-4 label-wrap">
                    Timezone
                </label>
                <div class="col">
                    <input type="text" name="timezone_pelabuhan" class="form-control"
                        id="timezone_pelabuhan" value="<?php echo $dataTimezone;?>"
                        
                        min="0">
                </div>
            </div>
        <?php
        echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
        echo form_close();
        ?>
    </div>
</div>