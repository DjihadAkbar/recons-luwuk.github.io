<div class="card p-2">
    <div class="container-fluid">
    <?php if ($this->session->flashdata('pesan')): ?>
                <div class="alert <?php echo $this->session->flashdata('alert') ?>">
                    <?php echo $this->session->flashdata('pesan'); ?>
                </div>
            <?php endif; ?>
    <?php
    foreach($account as $row){
    ?>
    
        <div class="input-group mb-3 mt-2">
            <label for="nama" class="col-2"> Nama </label>
            <input name="nama" type="text" class="form-control" disabled placeholder="Nama" value=<?php echo ucwords($row['name']);?> aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3 mt-2">
            <label for="username" class="col-2"> Username </label>
            <input type="text" class="form-control" disabled placeholder="Username" value=<?php echo ($row['username']);?> aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <label for="pelabuhan" class="col-2"> Pelabuhan </label>
            <input type="text" class="form-control" disabled placeholder="Pelabuhan" value=<?php echo ucwords($row['harbours']);?> aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <label for="nama" class="col-2"> Email </label>
            <input type="text" class="form-control" disabled placeholder="Email" value="<?php echo $row['email'];?>" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <label for="nama" class="col-2"> No. Telepon </label>
            <input type="text" class="form-control" disabled placeholder="Telepon" value="<?php echo $row['phone'];?>" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <a href="account/changeDetail?id=<?php echo ucwords($row['id']);?>" class="btn btn-dark form-control">Ubah Detail Pribadi</a>
            <a href="account/changeAccount?id=<?php echo ucwords($row['id']);?>" class="btn btn-dark form-control">Ubah Password</a>
        </div>
        

    <?php
        }
    ?>
    </div>
</div>