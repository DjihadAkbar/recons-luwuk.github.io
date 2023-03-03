<div class="card p-2">
    <div class="container-fluid">
        
    <?php
    foreach($account as $row){
    ?>
    <?php
    echo form_open(base_url('dashboard/account/prosesChangeAccount?id='.ucwords($row['id'])), ['class' => 'form-luwuk']);
    ?>
        <div class="form-group row ">
            <label for="old-password" class="col-4">
                Password Lama
            </label>
            <div class="col">

                <?php

                $data = [
                    'name' => 'old-password',
                    'id' => 'old-password',
                    'class' => 'form-control',
                    'placeholder' => 'Masukkan Password Lama',
                ];

                echo form_password($data);
                echo form_error('old-password');
                ?>
            </div>
        </div>
        <div class="form-group row ">
            <label for="password" class="col-4">
                Password Baru
            </label>
            <div class="col">

                <?php

                $data = [
                    'name' => 'password',
                    'id' => 'password',
                    'class' => 'form-control',
                    'placeholder' => 'Masukkan Password Baru',
                ];

                echo form_password($data);
                echo form_error('password');
                ?>
            </div>
        </div>
        <div class="form-group row ">
            <label for="confirm_password" class="col-4">
                Konfirmasi Password Baru
            </label>
            <div class="col">
                <?php
                $data = [
                    'name' => 'confirm_password',
                    'id' => 'confirm_password',
                    'class' => 'form-control',
                    'placeholder' => 'Konfirmasi Password Baru',
                ];

                echo form_password($data);
                echo form_error('confirm_password');
                ?>
            </div>
        </div>
        <?php
        echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
        echo form_close();
        ?>
    <?php
        }
    ?>
    </div>
</div>