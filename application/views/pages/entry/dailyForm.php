<div id="accordion">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center text-center" id="headingOne" >
            <h5 class="mb-0">
                <button style="text-decoration:none;  display: block; color: black;" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div style="white-space:normal"> 
                    Produksi Harian
                    </div>
                </button>
            </h5>
            <div class="tambah-data mb-0">
                
                <?php
                    $dataAnchor = ['class' => 'btn btn-dark text-light akses-button'];
                    echo anchor('dashboard/entry/entryData', 'Tambah Data', $dataAnchor);
                    ?>
            </div>
        </div>
        
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body p-4">
                <div class="row">
                    <div class="wrapper" style="overflow-x: auto;">
                        <table id="table-data" class="table table-striped table-data"
                            style="display: block; max-width: -moz-fit-content; max-width: fit-content; margin: 0 auto; font-size:80%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"> # </th>
                                    <th scope="col">Minggu </th>
                                    <th scope="col">Tanggal Operasi </th>
                                    <th scope="col">Waktu Keberangkatan </th>
                                    <th scope="col">Nama Kapal </th>
                                    <th scope="col">Lintasan </th>
                                    <th scope="col">Pelabuhan Asal </th>
                                    <th scope="col">Jenis Trip </th>
                                    <th scope="col">Dewasa Eksekutif </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Bayi Eksekutif </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Dewasa Bisnis </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Bayi Bisnis </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Dewasa Ekonomi </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Bayi Ekonomi </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 1 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 2 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 3 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 4 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 4 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 5 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 5 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 6 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 6 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 7 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 8 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 9 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">
                                        Suplesi Ekonomi I Dewasa
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">
                                        Suplesi Ekonomi I Anak
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">
                                        Suplesi Ekonomi II Dewasa
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">
                                        Suplesi Ekonomi II Anak
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Hewan </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Gayor </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Carter </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Barang Volume </th>
                                    <th scope="col">Barang Curah </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Action </th>
                                    <th scope="col"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($entry_data as $key => $value) {
                                    ?>
                                <tr>
                                    <th scope="row">
                                                <?php echo $no++; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['week']; ?>
                                            </td>
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
                                                <?php echo $value['time']; ?>
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
                                                <?php echo $value['DewasaEksekutif']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEksekutifSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEksekutifSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEksekutif']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEksekutifSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEksekutifSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaBisnis']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaBisnisSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaBisnisSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiBisnis']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiBisnisSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiBisnisSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEkonomi']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEkonomiSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEkonomiSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEkonomi']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEkonomiSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEkonomiSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol1']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol1Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol1Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol2']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol3']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol3Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4Pen']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4PenSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4PenSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4Bar']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4BarSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4BarSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5Pen']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5PenSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5PenSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5Bar']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5BarSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5BarSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6Pen']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6PenSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6PenSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6Bar']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6BarSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6BarSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol7']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol7Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol7Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol8']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol8Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol8Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol9']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol9Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol9Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1Dewasa']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1DewasaSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1DewasaSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1Anak']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1AnakSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1AnakSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2Dewasa']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2DewasaSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2DewasaSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2Anak']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2AnakSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2AnakSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Hewan']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['HewanSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['HewanSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gayor']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['GayorSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['GayorSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Carter']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['CarterSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['CarterSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BarangVolume']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BarangPendapatan']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BarangPendapatanSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BarangPendapatanSerial_end']; ?>
                                            </td>

                                            <td>
                                                <div class="akses-button">
                                                    <a class="btn btn-warning text-dark" href="entry/editEntryData?id=<?php echo $value['id_entry']; ?>"><i class="fas fa-file-edit"></i></a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="akses-button">
                                                    <a class="btn btn-danger text-dark" href="entry/deleteEntryData?id=<?php echo $value['id_entry']; ?>">
                                                        <i class="fas fa-delete-left"></i>
                                                    </a>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                    <?php
                                }
                                ?>
                            <tbody>
                            <tfoot class="thead-dark">
                                <tr>
                                    <th scope="col"> # </th>
                                    <th scope="col">Minggu </th>
                                    <th scope="col">Tanggal Operasi </th>
                                    <th scope="col">Waktu Keberangkatan </th>
                                    <th scope="col">Nama Kapal </th>
                                    <th scope="col">Lintasan </th>
                                    <th scope="col">Pelabuhan Asal </th>
                                    <th scope="col">Jenis Trip </th>
                                    <th scope="col">Dewasa Eksekutif </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Bayi Eksekutif </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Dewasa Bisnis </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Bayi Bisnis </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Dewasa Ekonomi </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Bayi Ekonomi </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 1 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 2 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 3 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 4 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 4 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 5 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 5 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 6 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 6 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 7 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 8 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Golongan 9 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">
                                        Suplesi Ekonomi I Dewasa
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">
                                        Suplesi Ekonomi I Anak
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">
                                        Suplesi Ekonomi II Dewasa
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">
                                        Suplesi Ekonomi II Anak
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Hewan </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Gayor </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Carter </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Barang Volume </th>
                                    <th scope="col">Barang Curah </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Action </th>
                                    <th scope="col"> </th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


                   <!-- Modal delete -->
                   <!-- <div class="modal fade" id="deleteConfirmation" tabindex="2" role="dialog"
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
                                                                    <a class="btn btn-primary" href="entry/deleteEntryData?id=<?php echo $value['id_entry']; ?>">
                                                                    <?php echo $value['id_entry']; ?>Sure
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- Modal Logout End -->                     