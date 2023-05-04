<div class="row text-center">
    <div class="col-md">
        <h2>
            <?php echo $title; ?>
        </h2>
        <h3>
            <!-- Nama Tabel -->
        </h3>

        <!-- <div class="row">
                <div class="col-md-6">
                    <div class="akses-button">
                        <?php
                        $dataAnchor = ['class' => 'btn btn-outline-primary'];
                        echo anchor('users/login', 'login', $dataAnchor);
                        ?>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="akses-button">
                        <?php
                        $dataAnchor = ['class' => 'btn btn-outline-primary'];
                        echo anchor('users/register', 'register', $dataAnchor);
                        ?>
                    </div>
                </div>
            </div> -->
    </div>
</div>



<div class="row" style='padding:5mm'>
    <div class="col-md-4">
        <div class="card frame-form-luwuk">
            <div class="card-header text-center">
                Input Pendapatan Harian
            </div>

            <div class="card-body">
                <?php
                echo form_open(base_url('trip/inputTrip'), ['class' => 'form-luwuk']);
                ?>
                <div class="form-group row">
                    <label for="nama_kapal" class="col-3"> Kapal </label>
                    <div class="col-9">
                        <select class="form-control" name="nama_kapal" id="nama_kapal" required>
                            <option value="">No Selected</option>
                            <?php foreach ($kapal as $row): ?>
                                <option value="<?php echo $row['id']; ?>">
                                    <?php echo $row['id']; ?>
                                    <?php echo $row['kapal']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php
                        echo form_error('nama_kapal');
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lintasan" class="col-3"> Lintasan </label>
                    <div class="col-9">
                        <select class="form-control" name="lintasan" id="lintasan" required>
                            <option value="">No Selected</option>
                            <?php foreach ($lintasan as $row): ?>
                                <option value="<?php echo $row['id']; ?>">
                                    <?php echo $row['lintasan']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php
                        echo form_error('lintasan');
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jumlah_trip" class="col-3"> Jumlah Trip </label>
                    <div class="col-9">
                        <?php
                        $data = [
                            'name' => 'jumlah_trip',
                            'id' => 'jumlah_trip',
                            'class' => 'form-control',
                            'placeholder' => 'Jumlah Trip',
                        ];
                        echo form_input($data);
                        echo form_error('jumlah_trip');
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_operasi" class="col-3"> Jenis Operasi </label>
                    <div class="col-9">
                        <select class="form-control" name="jenis_operasi" id="jenis_operasi" required>
                            <option value="">No Selected</option>
                            <option value="REGULER"> REGULER </option>
                            <option value="EXTRATRIP"> EXTRATRIP </option>
                            <option value="OFF"> OFF </option>
                        </select>
                        <?php
                        echo form_error('jenis_operasi');
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_berangkat" class="col-3"> Tanggal Operasi </label>
                    <div class="col-9">
                        <input class="form-control" type="date" id="tanggal_berangkat" name="tanggal_berangkat"
                            value="2022-11-01" min="2022-11-01" max="2023-12-31" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="catatan" class="col-3"> Catatan </label>
                    <div class="col-9">
                        <?php
                        $data = [
                            'name' => 'catatan',
                            'id' => 'catatan',
                            'class' => 'form-control',
                            'placeholder' => 'Catatan',
                        ];
                        echo form_input($data);
                        ?>
                    </div>
                </div>
                <!--  
                    <div class="form-group row">
                        <label for="jk" class="col-3"> Jenis Kelamin </label>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-4">
                                    <div class="radio-inline">
                                        <?php
                                        $data = [
                                            'name' => 'jk',
                                            'id' => 'jk',
                                        ];
                                        echo form_radio($data), 'Wanita';
                                        ?>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="radio-inline">
                                        <?php
                                        $data = [
                                            'name' => 'jk',
                                            'id' => 'jk',
                                        ];
                                        echo form_radio($data), 'Pria';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                <?php


                echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
                echo form_close();
                ?>


            </div>
        </div>

    </div>

    <div class="col-md-8">
        <table class="table w-10 table-striped">
            <thead class="thead-dark    ">
                <tr>
                    <th scope="col"> # </th>
                    <th scope="col"> Kapal </th>
                    <th scope="col"> Rute </th>
                    <th scope="col"> Pelabuhan Asal </th>
                    <th scope="col"> Pelabuhan Tujuan </th>
                    <th scope="col"> Jumlah </th>
                    <th scope="col"> Jenis Operasi </th>
                    <th scope="col"> Tanggal Operasi </th>
                    <th scope="col"> Catatan </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1; foreach ($trip as $key => $value) {
                    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $no++; ?>
                        </th>
                        <td>
                            <?php echo $value['kapal']; ?>
                        </td>
                        <td>
                            <?php echo $value['lintasan']; ?>
                        </td>
                        <td>
                            <?php echo $value['pelabuhan_asal']; ?>
                        </td>
                        <td>
                            <?php echo $value['pelabuhan_tujuan']; ?>
                        </td>
                        <td>
                            <?php echo $value['jumlah_trip']; ?>
                        </td>
                        <td>
                            <?php echo $value['jenis_operation']; ?>
                        </td>
                        <td>
                            <?php echo $value['tanggal_operasi']; ?>
                        </td>
                        <td>
                            <?php echo $value['catatan']; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            <tbody>
        </table>
    </div>
</div>