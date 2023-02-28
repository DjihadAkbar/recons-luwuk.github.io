<div class="card">
    <div class="container-fluid">
        
    <?php
    // print_r($account); 
    foreach($account as $row){
    ?>
        <div class="input-group mb-3">
            <input type="text" class="form-control" disabled placeholder="Nama" value=<?php echo ucwords($row['name']);?> aria-label="Username" aria-describedby="basic-addon1">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Button</button>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" disabled placeholder="Pelabuhan" value=<?php echo ucwords($row['harbours']);?> aria-label="Username" aria-describedby="basic-addon1">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Button</button>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" disabled placeholder="Email" value="<?php echo $row['email'];?>" aria-label="Username" aria-describedby="basic-addon1">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Button</button>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" disabled placeholder="Telepon" value="<?php echo $row['phone'];?>" aria-label="Username" aria-describedby="basic-addon1">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Button</button>
            </div>
        </div>
        <div class="input-group mb-3">
            <button class="form-control">Ubah Detail Pribadi</button>
            <button class="form-control">Ubah Password</button>
        </div>
        

    <?php
        }
    ?>
    </div>
</div>