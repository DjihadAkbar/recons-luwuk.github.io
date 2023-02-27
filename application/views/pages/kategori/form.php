<div class="card">
    <div class="card-body">
        <?php
        echo form_open('dashboard/administrasi/kategori/simpan');
        ?>
        <div class="form-group row">
            <label class="col-3" for="">Kategori</label>
            <div class="col-9">
                <?php
                $data = [
                    'type' => 'text',
                    'name' => 'kategori',
                    'class' => 'form-control',
                ];
                echo form_input($data);
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-3" for="">Tipe</label>
            <div class="col-9">
                <?php
                $data = [
                    'type' => 'text',
                    'name' => 'type',
                    'class' => 'form-control',
                ];
                echo form_input($data);
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-3" for="">Keterangan</label>
            <div class="col-9">
                <?php
                $data = [
                    'name' => 'keterangan',
                    'class' => 'form-control',
                ];
                echo form_textarea($data);
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-3" for="">Status</label>
            <div class="col-9">
                <?php
                $status = [
                    'ACTIVE' => 'ACTIVE',
                    'DEACTIVE' => 'DEACTIVE',
                    'DELETE' => 'DELETE',
                ];
                $data = [
                    'name' => 'status',
                    'class' => 'form-control',
                ];
                echo form_dropdown($data, $status);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group row">
                <div class="col-9">
                    <?php
                    $data = [
                        'name' => 'submit',
                        'class' => 'form-control',
                    ];
                    echo form_submit($data);
                    ?>
                </div>
            </div>
        </div>
        <?php echo form_close();
        ?>
    </div>
</div>