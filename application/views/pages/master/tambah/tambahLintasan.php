<div class="card ">
    <div class="card-header">
        Tambah Lintasan
    </div>
    <div class="card-body">
        <?php
        echo form_open(base_url('dashboard/master/lintasan/prosesTambahLintasan'), ['class' => 'form-entry']);
        ?>
        <div class="form-group">
            <div class="row">
                <label for="origin_name" class="col-4 label-wrap">
                    Nama Lintasan
                </label>
                <div class="col-4">
                    <select class="form-control" name="origin_name" id="origin_name" >
                    <option value="" selected>No Selected</option>
                    <?php
                    foreach($pelabuhan as $row){
                    ?>
                    <option value="<?php echo $row['id_harbours'];?>">
                                    <?php echo $row['pelabuhan']; ?>
                    </option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="col-4">
                    <select class="form-control" name="destination_name" id="destination_name" >
                        <option value="" selected>No Selected</option>
                        <?php
                        foreach($pelabuhan as $row){
                        ?>
                        <option value="<?php echo $row['id_harbours'];?>">
                                        <?php echo $row['pelabuhan']; ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group row ">
            <label for="origin" class="col-4 label-wrap">
                Pelabuhan Asal
            </label>
            <div class="col">
                <select class="form-control" name="origin" id="origin" >
                    <option value="" selected>No Selected</option>
                    <?php
                    foreach($pelabuhan as $row){
                    ?>
                    <option value="<?php echo $row['id_harbours'];?>">
                                    <?php echo $row['pelabuhan']; ?>
                    </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row ">
            <label for="destination" class="col-4 label-wrap">
                Pelabuhan Tujuan
            </label>
            <div class="col">
                <select class="form-control" name="destination" id="destination" >
                    <option value="" selected>No Selected</option>
                    <?php
                    foreach($pelabuhan as $row){
                    ?>
                    <option value="<?php echo $row['id_harbours'];?>">
                                    <?php echo $row['pelabuhan']; ?>
                    </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row ">
            <label for="segmen" class="col-4 label-wrap">
                Segmen
            </label>
            <div class="col">
                <input type="text" name="segmen" class="form-control"
                    id="segmen"  placeholder="Segmen" min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="jarak" class="col-4 label-wrap">
                Jarak Tempuh
            </label>
            <div class="col">
                <input type="text" name="jarak" class="form-control"
                    id="jarak" placeholder="Jarak Tempuh" min="0">
            </div>
        </div>
        <div class="form-group row ">
            <label for="waktu_tempuh" class="col-4 label-wrap">
                Waktu Tempuh
            </label>
            <div class="col">
                <input type="time" name="waktu_tempuh" class="form-control"
                    id="waktu_tempuh" placeholder="" min="0">
            </div>
        </div>

        
        <?php
        echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
        echo form_close();
        ?>
    </div>
</div>