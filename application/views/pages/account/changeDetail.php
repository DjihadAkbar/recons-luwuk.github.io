<div class="card p-2">
    <div class="container-fluid">
        
    <?php
    foreach($account as $row){
    ?>
    <?php
    echo form_open(base_url('dashboard/account/prosesChangeDetail?id='.ucwords($row['id'])), ['class' => 'form-luwuk']);
    ?>
        <div class="form-group row ">
            <label for="nama" class="col-2">
                Nama
            </label>
            <div class="col">

                <?php

                $data = [
                    'name' => 'nama',
                    'id' => 'nama',
                    'class' => 'form-control',
                    'value' => $row['name'],
                ];

                echo form_input($data);
                echo form_error('nama');
                ?>
            </div>
        </div>
        <div class="form-group row ">
            <label for="username" class="col-2">
                Username
            </label>
            <div class="col">

                <?php

                $data = [
                    'name' => 'username',
                    'id' => 'username',
                    'class' => 'form-control',
                    'value' => $row['username'],
                ];

                echo form_input($data);
                echo form_error('username');
                ?>
            </div>
        </div>
        <div class="form-group row ">
            <label for="pelabuhan" class="col-2">
                Pelabuhan
            </label>
            <div class="col">
                <?php
                $options = array(
                    '' => 'No Selected',
                    'LUWUK' => 'Luwuk',
                    'BANGGAI' => 'Banggai',
                    'BOBONG' => 'Bobong',
                    'AMPANA' => 'Ampana',
                    'PASOKAN' => 'Pasokan',
                    'DOLONG' => 'Dolong',
                    'BONITON' => 'Boniton',
                    'GORONTALO' => 'Gorontalo',
                    'WAKAI' => 'Wakai',
                    'KOLONODALE' => 'Kolondale',
                    'BATURUBE' => 'Baturube',
                    'SAIYONG' => 'Saiyong',
                    'PAGIMANA' => 'Pagimana',
                    'MARISA' => 'Marisa',
                    'TOBOLI' => 'Toboli',
                );


                echo form_dropdown('pelabuhan', $options, $row['harbours'], 'class="form-control" id="pelabuhan"');
                echo form_error('pelabuhan');
                ?>
            </div>
        </div>
        <div class="form-group row ">
            <label for="email" class="col-2">
                Email
            </label>
            <div class="col">
                <?php
                $data = [
                    'name' => 'email',
                    'id' => 'email',
                    'class' => 'form-control',
                    'value' => $row['email'],
                ];

                echo form_input($data);
                echo form_error('email');
                ?>
            </div>
        </div>
        
        <div class="form-group row ">
            <label for="telepon" class="col-2">
                Nomor Telepon
            </label>
            <div class="col">
                <?php
                $data = [
                    'type' => 'tel',
                    'name' => 'telepon',
                    'id' => 'telepon',
                    'class' => 'form-control',
                    'value' => $row['phone'],
                ];

                echo form_input($data);
                echo form_error('telepon');
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