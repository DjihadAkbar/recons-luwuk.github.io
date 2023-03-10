<div id="accordion">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center text-center" id="headingOne" >
            <h5 class="mb-0">
                <button style="text-decoration:none;  display: block; color: black;" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div style="white-space:normal"> 
                    Tarif Lintasan
                    </div>
                </button>
            </h5>
            <div class="tambah-data">
                <?php
                $dataAnchor = ['class' => 'btn btn-dark text-light akses-button'];
                echo anchor('dashboard/master/tarif/tambahTarif', 'Tambah Data', $dataAnchor);
                ?>
            </div>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body p-4">
                <div class="row">
                    <div class="wrapper" style="overflow-x: auto;">
                        <table id="table-data" class="table table-striped table-data" style="display: block; font-size:80%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"> # </th>
                                    <th scope="col">Date </th>
                                    <th scope="col">Lintasan </th>
                                    <th scope="col">Golongan 1 </th>
                                    <th scope="col">Golongan 2 </th>
                                    <th scope="col">Golongan 3 </th>
                                    <th scope="col">Golongan 4 - Penumpang </th>
                                    <th scope="col">Golongan 4 - Barang </th>
                                    <th scope="col">Golongan 5 - Penumpang </th>
                                    <th scope="col">Golongan 5 - Barang </th>
                                    <th scope="col">Golongan 6 - Penumpang </th>
                                    <th scope="col">Golongan 6 - Barang </th>
                                    <th scope="col">Golongan 7 </th>
                                    <th scope="col">Golongan 8 </th>
                                    <th scope="col">Golongan 9 </th>
                                    <th scope="col">Dewasa Eksekutif </th>
                                    <th scope="col">Bayi Eksekutif </th>
                                    <th scope="col">Dewasa Bisnis </th>
                                    <th scope="col">Bayi Bisnis </th>
                                    <th scope="col">Dewasa Ekonomi </th>
                                    <th scope="col">Bayi Ekonomi </th>
                                    <th scope="col">
                                        Suplesi Ekonomi I Dewasa
                                    </th>
                                    <th scope="col">
                                        Suplesi Ekonomi I Anak
                                    </th>
                                    <th scope="col">
                                        Suplesi Ekonomi II Dewasa
                                    </th>
                                    <th scope="col">
                                        Suplesi Ekonomi II Anak
                                    </th>
                                    <th scope="col">Hewan </th>
                                    <th scope="col">Gayor </th>
                                    <th scope="col">Carter </th>
                                    <th scope="col">Barang Volume </th>
                                    <th scope="col">Barang Curah </th>
                                    <th scope="col">Golongan 1 TJP</th>
                                    <th scope="col">Golongan 2 TJP</th>
                                    <th scope="col">Golongan 3 TJP</th>
                                    <th scope="col">Golongan 4 - Penumpang TJP</th>
                                    <th scope="col">Golongan 4 - Barang TJP</th>
                                    <th scope="col">Golongan 5 - Penumpang TJP</th>
                                    <th scope="col">Golongan 5 - Barang TJP</th>
                                    <th scope="col">Golongan 6 - Penumpang TJP</th>
                                    <th scope="col">Golongan 6 - Barang TJP</th>
                                    <th scope="col">Golongan 7 TJP</th>
                                    <th scope="col">Golongan 8 TJP</th>
                                    <th scope="col">Golongan 9 TJP</th>
                                    <th scope="col">Dewasa Eksekutif TJP</th>
                                    <th scope="col">Bayi Eksekutif TJP</th>
                                    <th scope="col">Dewasa Bisnis TJP</th>
                                    <th scope="col">Bayi Bisnis TJP</th>
                                    <th scope="col">Dewasa Ekonomi TJP</th>
                                    <th scope="col">Bayi Ekonomi TJP</th>
                                    <th scope="col">Golongan 1 IW</th>
                                    <th scope="col">Golongan 2 IW</th>
                                    <th scope="col">Golongan 3 IW</th>
                                    <th scope="col">Golongan 4 - Penumpang IW</th>
                                    <th scope="col">Golongan 4 - Barang IW</th>
                                    <th scope="col">Golongan 5 - Penumpang IW</th>
                                    <th scope="col">Golongan 5 - Barang IW</th>
                                    <th scope="col">Golongan 6 - Penumpang IW</th>
                                    <th scope="col">Golongan 6 - Barang IW</th>
                                    <th scope="col">Golongan 7 IW</th>
                                    <th scope="col">Golongan 8 IW</th>
                                    <th scope="col">Golongan 9 IW</th>
                                    <th scope="col">Dewasa Eksekutif IW</th>
                                    <th scope="col">Bayi Eksekutif IW</th>
                                    <th scope="col">Dewasa Bisnis IW</th>
                                    <th scope="col">Bayi Bisnis IW</th>
                                    <th scope="col">Dewasa Ekonomi IW</th>
                                    <th scope="col">Bayi Ekonomi IW</th>
                                    <th scope="col">Action </th>
                                    <th scope="col"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($tarif as $key => $value) {
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $no++; ?>
                                        </th>
                                        <td>
                                            <?php
                                            $original_date = $value['start_date'];

                                            // Creating timestamp from given date
                                            $timestamp = strtotime($original_date);

                                            // Creating new date format from that timestamp
                                            $new_date = date("d-m-Y", $timestamp);
                                            echo $new_date;

                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $value['route']; ?>
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
                                            <?php echo $value['Suplesi1Dewasa']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Suplesi1Anak']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Suplesi2Dewasa']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Suplesi2Anak']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Hewan']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gayor']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Carter']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['BarangVolume']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['BarCur']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol1TJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol2TJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol3TJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol4PenTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol4BarTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol5PenTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol5BarTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol6PenTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol6BarTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol7TJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol8TJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol9TJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['DewasaEksekutifTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['BayiEksekutifTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['DewasaBisnisTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['BayiBisnisTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['DewasaEkonomiTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['BayiEkonomiTJP']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol1IW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol2IW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol3IW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol4PenIW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol4BarIW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol5PenIW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol5BarIW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol6PenIW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol6BarIW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol7IW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol8IW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['Gol9IW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['DewasaEksekutifIW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['BayiEksekutifIW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['DewasaBisnisIW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['BayiBisnisIW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['DewasaEkonomiIW']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['BayiEkonomiIW']; ?>
                                        </td>
                                        <td>
                                            <div class="akses-button">
                                            <a class="btn btn-warning text-dark" href="tarif/editDataTarif?id=<?php echo $value['id_rate']; ?>"><i class="fas fa-file-edit"></i></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="akses-button">
                                                <!-- <a data-toggle="modal" data-target="#deleteConfirmation" aria-expanded="true" class="dropdown-sidebar-asdp btn btn-danger text-dark " data-toggle="collapse" href="">
                                                    <i class="fas fa-delete-left"></i>
                                                </a> -->
                                                <a class="btn btn-danger text-dark" href="tarif/deleteTarif?id=<?php echo $value['id_rate']; ?>">
                                                    <i class="fas fa-delete-left"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal delete
                                    <div class="modal fade" id="deleteConfirmation" tabindex="2" role="dialog"
                                        aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteConfirmationLabel">Logout Confirmation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                    <div class="delete-button">
                                                        <a class="btn btn-primary" href="tarif/deleteTarif?id=<?php echo $value['id_rate']; ?>">
                                                            Sure
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    Modal Logout End -->
                                    <?php
                                }
                                ?>
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
