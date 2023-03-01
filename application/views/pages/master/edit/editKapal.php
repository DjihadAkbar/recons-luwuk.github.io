<?php
$dataFerry = ''; 
$dataCode = ''; 
$dataCompany = '';
$dataGrt = '';
$dataType = '';
$dataRegister = '';
$dataImo = '';
$dataId = '';
$dataMmsi = '';
$dataLength = '';
$dataBreadth = '';
$dataDraft = '';
$dataGt = '';
$dataBuildYear = '';
$dataShipyard = '';
$dataRegistrationPort = '';
$dataAnchorWeight = '';
foreach($editDataKapal as $row){
    $dataFerry = $row['ferry']; 
    $dataCode = $row['code']; 
    $dataCompany = $row['company'];
    $dataGrt = $row['grt'];
    $dataType = $row['type'];
    $dataRegister = $row['register_num'];
    $dataImo = $row['imo_num'];
    $dataId = $row['id_card'];
    $dataMmsi = $row['mmsi'];
    $dataLength = $row['length_over_all'];
    $dataBreadth = $row['breadth'];
    $dataDraft = $row['draft'];
    $dataGt = $row['gt'];
    $dataBuildYear = $row['build_year'];
    $dataShipyard = $row['shipyard'];
    $dataRegistrationPort = $row['registration_port'];
    $dataAnchorWeight = $row['anchor_weight'];
}
?>
<div class="card ">
    <div class="card-header">
        Edit Data Lintasan
    </div>
    <div class="card-body">
        <?php
        echo form_open(base_url('dashboard/master/kapal/prosesEditKapal?id=').$_GET['id'] , ['class' => 'form-entry']);
        ?>
        
        <div class="form-group row ">
            <label for="ferry" class="col-4 label-wrap">
                Ferry
            </label>
            <div class="col">
                <input type="text" name="ferry" class="form-control"
                    id="ferry" value="<?php echo $dataFerry;?>"
                    
                    min="0" disabled>
            </div>
        </div>
        <div class="form-group row ">
            <label for="code" class="col-4 label-wrap">
                Code
            </label>
            <div class="col">
                <input type="text" name="code" class="form-control"
                    id="code" value="<?php echo $dataCode;?>"
                    
                    min="0" >
            </div>
        </div>
        <div class="form-group row ">
            <label for="company" class="col-4 label-wrap">
                Company
            </label>
            <div class="col">
                <input type="text" name="company" class="form-control"
                    id="company" value="<?php echo $dataCompany;?>"
                    
                    min="0" >
            </div>
        </div>
        <div class="form-group row ">
            <label for="grt" class="col-4 label-wrap">
                GRT
            </label>
            <div class="col">
                <input type="text" name="grt" class="form-control"
                    id="grt" value="<?php echo $dataGrt;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="type" class="col-4 label-wrap">
                Type
            </label>
            <div class="col">
                <input type="text" name="type" class="form-control"
                    id="type" value="<?php echo $dataType;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="register_num" class="col-4 label-wrap">
                Register Number
            </label>
            <div class="col">
                <input type="text" name="register_num" class="form-control"
                    id="register_num" value="<?php echo $dataRegister;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="imo_num" class="col-4 label-wrap">
                IMO Number
            </label>
            <div class="col">
                <input type="text" name="imo_num" class="form-control"
                    id="imo_num" value="<?php echo $dataImo;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="id_card" class="col-4 label-wrap">
                Tanda Pengenal
            </label>
            <div class="col">
                <input type="text" name="id_card" class="form-control"
                    id="id_card" value="<?php echo $dataId;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="mmsi" class="col-4 label-wrap">
                MMSI
            </label>
            <div class="col">
                <input type="text" name="mmsi" class="form-control"
                    id="mmsi" value="<?php echo $dataMmsi;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="length_over_all" class="col-4 label-wrap">
                Panjang
            </label>
            <div class="col">
                <input type="text" name="length_over_all" class="form-control"
                    id="length_over_all" value="<?php echo $dataLength;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="breadth" class="col-4 label-wrap">
                Sarat Air
            </label>
            <div class="col">
                <input type="text" name="breadth" class="form-control"
                    id="breadth" value="<?php echo $dataBreadth;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="draft" class="col-4 label-wrap">
                Lebar
            </label>
            <div class="col">
                <input type="text" name="draft" class="form-control"
                    id="draft" value="<?php echo $dataDraft;?>"
                    
                    min="0">
            </div>
        </div>
        
        <div class="form-group row ">
            <label for="gt" class="col-4 label-wrap">
                Gross Tonage
            </label>
            <div class="col">
                <input type="text" name="gt" class="form-control"
                    id="gt" value="<?php echo $dataGt;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="build_year" class="col-4 label-wrap">
                Tahun Dibuat
            </label>
            <div class="col">
                <input type="text" name="build_year" class="form-control"
                    id="build_year" value="<?php echo $dataBuildYear;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="shipyard" class="col-4 label-wrap">
                Galangan
            </label>
            <div class="col">
                <input type="text" name="shipyard" class="form-control"
                    id="shipyard" value="<?php echo $dataShipyard;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="registration_port" class="col-4 label-wrap">
                Pelabuhan Pendaftaran
            </label>
            <div class="col">
                <input type="text" name="registration_port" class="form-control"
                    id="registration_port" value="<?php echo $dataRegistrationPort;?>"
                    
                    min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="anchor" class="col-4 label-wrap">
                Berat Jangkar
            </label>
            <div class="col">
                <input type="text" name="anchor" class="form-control"
                    id="anchor" value="<?php echo $dataAnchorWeight;?>"
                    
                    min="0">
            </div>
        </div>

        
        <?php
        echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
        echo form_close();
        ?>
    </div>
</div>