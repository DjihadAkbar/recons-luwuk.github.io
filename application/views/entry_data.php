<div class="container-fluid">
    <div class="row flex-xl-nowrap">
        <div class="col-md-3 col-xl-4 bd-sidebar" style="padding-top: 15px;">
            <div class="card ">
                <div class="card-header">
                    Entry Pendapatan Harian
                </div>
                <div class="card-body">
                    <?php
                    echo form_open(base_url('entry/entryData'), ['class' => 'form-luwuk']);
                    ?>
                    <div class="form-group row">
                        <label for="nama_kapal" class="col-4"> Nama Kapal </label>
                        <div class="col">
                            <select class="form-control" name="nama_kapal" id="nama_kapal" required>
                                <option value="">No Selected</option>
                                <?php foreach ($kapal as $row): ?>
                                    <option value="<?php echo $row['id']; ?>">
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
                        <label for="lintasan" class="col-4"> Lintasan </label>
                        <div class="col">
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
                        <label for="trip" class="col-4"> Trip </label>
                        <div class="col">
                            <select class="form-control" name="trip" id="trip" required>
                                <option value="">No Selected</option>
                                <option value="REGULER">
                                    REGULER
                                </option>
                                <option value="EXTRA TRIP">
                                    EXTRA TRIP
                                </option>
                                <option value="OFF REGULER">
                                    OFF REGULER
                                </option>
                                <option value="OFF CUACA BURUK">
                                    OFF CUACA BURUK
                                </option>
                                <option value="OFF RUSAK">
                                    OFF RUSAK
                                </option>
                                <option value="OFF DOCKING">
                                    OFF DOCKING
                                </option>
                            </select>
                            <?php
                            echo form_error('trip');
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pelabuhan_asal" class="col-4"> Pelabuhan Asal </label>
                        <div class="col">
                            <select class="form-control" name="pelabuhan_asal" id="pelabuhan_asal" required>
                                <option value="">No Selected</option>
                                <?php foreach ($pelabuhan as $row): ?>
                                    <option value="<?php echo $row['id_harbours']; ?>">
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
                        <label for="tanggal_berangkat" class="col-4"> Tanggal Operasi </label>

                        <div class="col">
                            <input class="form-control" type="date" id="tanggal_berangkat" name="tanggal_berangkat"
                                value="2022-11-01" min="2022-11-01">
                        </div>
                    </div>
                    <!-- Input Jumlah Produksi -->
                    <?php $no = ""; foreach ($produksi as $row) { ?>
                        <div class="form-group row ">
                            <label for="<?php echo $row['produksi']; ?>" class="col-4">
                                <?php echo $row['produksi']; ?>
                            </label>
                            <div class="col">
                                <input type="number" name="<?php echo $row['id_production']; ?>" class="form-control"
                                    id="<?php echo $row['id_production']; ?>" value="0" min="0" required>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- Akhir Input Jumlah Produksi -->

                    <div class="form-group row ">
                        <label for="barang_volume" class="col-4">
                            Barang Volume
                        </label>
                        <div class="col">
                            <input type="number" class="form-control" name="barang_volume" id="barang_volume" value="0"
                                min="0" placeholder="Jumlah Volume">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="barang_pendapatan" class="col-4">
                            Barang Pendapatan
                        </label>
                        <div class="col">
                            <input type="number" class="form-control" name="barang_pendapatan" id="barang_pendapatan"
                                placeholder="500000" value="0" min="0" placeholder="Jumlah Volume">
                        </div>
                    </div>
                    <?php
                    echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>

        <main class="col-md-8 col-xl-8 bd-content" role="main">
            <?php
            echo form_open(base_url('entry'), ['class' => 'form-filter']);
            ?>
            <div class="row">
                <?php
                echo form_open(base_url('entry/entryData'), ['class' => 'form-luwuk']);
                ?>
                <div class="card border-0" style="padding-top: 5px; padding-right: 5px; padding-bottom: 5px;">
                    <label for="filter_kapal">
                        Nama Kapal
                    </label>
                    <select class="form-control" name="filter_kapal" id="filter_kapal">
                        <option value="">No Selected</option>
                        <?php foreach ($kapal as $row): ?>
                            <option value="<?php echo $row['kapal']; ?>">
                                <?php echo $row['kapal']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="card border-0" style="padding:5px;">
                    <label for="filter_lintasan">
                        Lintasan
                    </label>
                    <select class="form-control" name="filter_lintasan" id="filter_lintasan">
                        <option value="">No Selected</option>
                        <?php foreach ($lintasan as $row): ?>
                            <option value="<?php echo $row['lintasan']; ?>">
                                <?php echo $row['lintasan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="card border-0" style="padding:5px;">
                    <label for="filter_pelabuhan">
                        Pelabuhan Asal
                    </label>
                    <select class="form-control" name="filter_pelabuhan" id="filter_pelabuhan">
                        <option value="">No Selected</option>
                        <?php foreach ($pelabuhan as $row): ?>
                            <option value="<?php echo $row['pelabuhan']; ?>">
                                <?php echo $row['pelabuhan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="card border-0" style="padding:5px;">
                    <label for="filter_trip">
                        Jenis Trip
                    </label>
                    <select class="form-control" name="filter_trip" id="filter_trip">
                        <option value="">No Selected</option>
                        <option value="REGULER">
                            REGULER
                        </option>
                        <option value="EXTRA TRIP">
                            EXTRA TRIP
                        </option>
                        <option value="OFF REGULER">
                            OFF REGULER
                        </option>
                        <option value="OFF CUACA BURUK">
                            OFF CUACA BURUK
                        </option>
                        <option value="OFF RUSAK">
                            OFF RUSAK
                        </option>
                        <option value="OFF DOCKING">
                            OFF DOCKING
                        </option>
                    </select>
                </div>
                <div class="card border-0" style="padding:5px;">
                    <label for="filter_tanggal"> Tanggal Operasi </label>
                    <input class="form-control" type="date" id="filter_tanggal" name="filter_tanggal" value="2022-11-01"
                        min="2022-11-01" max="2023-12-31">
                </div>
            </div>
            <div class="row">
                <div class="wrapper" style="overflow-x: auto;">
                    <table id="entryTable" class="table table-striped"
                        style="display: block; max-width: -moz-fit-content; max-width: fit-content; margin: 0 auto; font-size:80%;">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"> # </th>
                                <th scope="col">Tanggal Operasi </th>
                                <th scope="col">Nama Kapal </th>
                                <th scope="col">Lintasan </th>
                                <th scope="col">Pelabuhan Asal </th>
                                <th scope="col">Jenis Trip </th>
                                <th scope="col">Golongan 1 </th>
                                <th scope="col">Golongan 2 </th>
                                <th scope="col">Golongan 3 </th>
                                <th scope="col">Golongan 4 Penumpang </th>
                                <th scope="col">Golongan 4 Barang </th>
                                <th scope="col">Golongan 5 Penumpang </th>
                                <th scope="col">Golongan 5 Barang </th>
                                <th scope="col">Golongan 6 Penumpang </th>
                                <th scope="col">Golongan 6 Barang </th>
                                <th scope="col">Golongan 7 </th>
                                <th scope="col">Golongan 8 </th>
                                <th scope="col">Golongan 9 </th>
                                <th scope="col">Dewasa Eksekutif </th>
                                <th scope="col">Bayi Eksekutif </th>
                                <th scope="col">Dewasa Bisnis </th>
                                <th scope="col">Bayi Bisnis </th>
                                <th scope="col">Dewasa Ekonomi </th>
                                <th scope="col">Bayi Ekonomi </th>
                                <th scope="col">Barang Volume </th>
                                <th scope="col">Barang Pendapatan </th>
                                <th scope="col">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1; foreach ($entry_data as $key => $value) {
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $no++; ?>
                                    </th>
                                    <td>
                                        <?php
                                        $original_date = $value['date'];

                                        // Creating timestamp from given date
                                        $timestamp = strtotime($original_date);

                                        // Creating new date format from that timestamp
                                        $new_date = date("d-m-Y", $timestamp);
                                        echo $new_date;

                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $value['ferry']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['route']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['harbour']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['id_trip']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol1']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol2']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol3']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol4Pen']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol4Bar']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol5Pen']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol5Bar']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol6Pen']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol6Bar']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol7']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol8']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['Gol9']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['DewasaEksekutif']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['BayiEksekutif']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['DewasaBisnis']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['BayiBisnis']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['DewasaEkonomi']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['BayiEkonomi']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['BarangVolume']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['BarangPendapatan']; ?>
                                    </td>
                                    <td>
                                        <div class="akses-button">
                                            <?php
                                            $dataAnchor = ['class' => 'btn btn-warning text-dark'];
                                            echo anchor('users/login', 'Edit', $dataAnchor);
                                            ?>
                                        </div>
                                        <div class="akses-button">
                                            <?php
                                            $dataAnchor = ['class' => 'btn btn-danger text-dark'];
                                            echo anchor('users/login', 'Delete', $dataAnchor);
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        <tbody>
                    </table>
                </div>

            </div>

        </main>
    </div>
</div>