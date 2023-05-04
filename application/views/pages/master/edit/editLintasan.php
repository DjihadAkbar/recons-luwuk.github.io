<?php
$dataRoute = ''; 
$dataOrigin = ''; 
$dataDestination = '';
$dataSegment = '';
$dataDistance = '';
$dataTravel = '';
foreach($editDataLintasan as $row){
    $dataRoute = $row['route']; 
    $dataOrigin = $row['asal']; 
    $dataDestination = $row['tujuan'];
    $dataSegment = $row['segment'];
    $dataDistance = $row['distance'];
    $dataTravel = $row['travel_time'];
}

?>
<div class="card ">
    <div class="card-header">
        Edit Data Lintasan
    </div>
    <div class="card-body">
        <?php
        echo form_open(base_url('dashboard/master/lintasan/prosesEditLintasan?id=').$_GET['id'] , ['class' => 'form-entry']);
        ?>
        
        <div class="form-group row ">
            <label for="route" class="col-4 label-wrap">
                Lintasan
            </label>
            <div class="col">
                <input type="text" name="route" class="form-control"
                    id="route" value="<?php echo $dataRoute;?>"
                    
                    min="0" disabled>
            </div>
        </div>
        <div class="form-group row ">
            <label for="origin" class="col-4 label-wrap">
                Pelabuhan Asal
            </label>
            <div class="col">
                <input type="text" name="origin" class="form-control"
                    id="origin" value="<?php echo $dataOrigin;?>"
                    
                    min="0" disabled>
            </div>
        </div>
        <div class="form-group row ">
            <label for="destination" class="col-4 label-wrap">
                Pelabuhan Tujuan
            </label>
            <div class="col">
                <input type="text" name="destination" class="form-control"
                    id="code_pelabuhan" value="<?php echo $dataDestination;?>"
                    
                    min="0" disabled>
            </div>
        </div>
        <div class="form-group row ">
            <label for="segmen" class="col-4 label-wrap">
                Segmen
            </label>
            <div class="col">
                <input type="text" name="segmen" class="form-control"
                    id="segmen" value="<?php echo $dataSegment;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="jarak" class="col-4 label-wrap">
                Jarak Tempuh
            </label>
            <div class="col">
                <input type="text" name="jarak" class="form-control"
                    id="jarak" value="<?php echo $dataDistance;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="waktu_tempuh" class="col-4 label-wrap">
                Waktu Tempuh
            </label>
            <div class="col">
                <input type="time" name="waktu_tempuh" class="form-control"
                    id="waktu_tempuh" value="<?php echo $dataTravel;?>"
                    
                    min="0">
            </div>
        </div>

        
        <?php
        echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
        echo form_close();
        ?>
    </div>
</div>