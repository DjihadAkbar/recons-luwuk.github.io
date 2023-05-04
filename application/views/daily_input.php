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
        <div class="row" style="padding:5mm">
            <div class="card frame-form-luwuk" style="margin-top:-5mm; margin-bottom: 5mm;">
                <div class="card-header text-center">
                    Input Pendapatan Harian
                </div>

                <div class="card-body">
                    <?php
                    echo form_open(base_url('dailyInput/prosesInput'), ['class' => 'form-luwuk', 'id' => 'form']);
                    ?>
                    <div class="form-group row">
                        <label for="jenis_produksi" class="col-3"> Jenis Produksi </label>
                        <div class="col-9">
                            <select class="form-control" name="jenis_produksi" id="jenis_produksi" required>
                                <option value="">No Selected</option>
                                <?php foreach ($produksi as $row): ?>
                                    <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['produksi']; ?>
                                    </option>
                                <?php endforeach; ?>
                                <option value="lain">
                                    LAIN-LAIN
                                </option>
                            </select>

                            <?php
                            echo form_error('jenis_produksi');
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="label_produksi" for="nama_produksi" class="col-3"> Harga Produksi </label>
                        <div class="col-9" id="harga_produksi">

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
                        <label for="pelabuhan_asal" class="col-3"> Pelabuhan Asal </label>
                        <div class="col-9">
                            <select class="form-control" name="pelabuhan_asal" id="pelabuhan_asal" required>
                                <option value="">No Selected</option>
                                <?php foreach ($pelabuhan as $row): ?>
                                    <option value="<?php echo $row['pelabuhan']; ?>">
                                        <?php echo $row['pelabuhan']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php
                            echo form_error('pelabuhan_asal');
                            ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_berangkat" class="col-3"> Tanggal Operasi </label>

                        <div class="col-9">
                            <input class="form-control" type="date" id="tanggal_berangkat" name="tanggal_berangkat"
                                value="2022-11-01" min="2022-11-01" max="2023-12-31">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_produksi" class="col-3"> Jumlah Produksi </label>
                        <div class="col-9">
                            <?php
                            $data = [
                                'name' => 'jumlah_produksi',
                                'id' => 'jumlah_produksi',
                                'class' => 'form-control',
                                'placeholder' => 'Jumlah Produksi',
                            ];
                            echo form_input($data);
                            echo form_error('jumlah_produksi');
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
    </div>

    <div class="col-md-8">
        <table class="table w-10 table-striped">
            <thead class="thead-dark    ">
                <tr>
                    <th scope="col"> # </th>
                    <th scope="col"> Bulan </th>
                    <th scope="col"> Pelabuhan Asal </th>
                    <th scope="col"> Rute </th>
                    <th scope="col"> Pendapatan Penyebrangan </th>
                    <th scope="col"> Total Produksi </th>

                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1; foreach ($dataPendapatan as $key => $value) {
                    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $no++; ?>
                        </th>
                        <td>
                            <?php echo $value['bulan']; ?>
                        </td>
                        <td>
                            <?php echo $value['pelabuhan']; ?>
                        </td>
                        <td>
                            <?php echo $value['rute']; ?>
                        </td>
                        <td>
                            <?php echo $value['pendapatan_penyebrangan']; ?>
                        </td>
                        <td>
                            <?php echo $value['jumlah_produksi']; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            <tbody>
        </table>
    </div>
</div>