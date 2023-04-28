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
                        <table  class="table table-striped table-data"
                            style="display: block; max-width: -moz-fit-content; max-width: fit-content; margin: 0 auto; font-size:80%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"> # </th>
                                    <th scope="col">Hari </th>
                                    <th scope="col">Tanggal </th>
                                    <th scope="col">Bulan </th>
                                    <th scope="col">Tahun </th>
                                    <th scope="col">Minggu </th>
                                    <th scope="col">Waktu Keberangkatan </th>
                                    <th scope="col">Waktu Tiba </th>
                                    <th scope="col">Nama Kapal </th>
                                    <th scope="col">Lintasan </th>
                                    <th scope="col">Pelabuhan Asal </th>
                                    <th scope="col">Pelabuhan Tujuan </th>
                                    <th scope="col">HSO </th>
                                    <th scope="col">HO </th>
                                    <th scope="col">Jenis Trip </th>
                                    <th scope="col">Dewasa Eksekutif </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Bayi Eksekutif </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Dewasa Bisnis </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Bayi Bisnis </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Dewasa Ekonomi </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Bayi Ekonomi </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 1 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 2 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 3 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 4 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 4 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 5 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 5 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 6 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 6 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 7 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 8 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 9 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">
                                        Suplesi Ekonomi I Dewasa
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">
                                        Suplesi Ekonomi I Anak
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">
                                        Suplesi Ekonomi II Dewasa
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">
                                        Suplesi Ekonomi II Anak
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Hewan </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Gayor </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Carter </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Barang Volume </th>
                                    <th scope="col">Barang Curah </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
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
                                            <td scope="col"> <?php                                             
                                                $original_date = $value['date'];
                                                echo getHari($original_date);
                                                ?></td>
                                            <td scope="col"><?php 
                                                $original_date = $value['day'];
                                                echo $original_date;
                                                ?> 
                                            </td>
                                            <td scope="col"><?php 
                                                $original_date = $value['date'];
                                                echo getBulan($original_date);
                                                ?>
                                            </td>
                                            <td scope="col"><?php 
                                                $original_date = $value['year'];
                                                echo $original_date;
                                                ?> 
                                            <th>
                                                <?php echo $value['week']; ?>
                                            </th>
                                            <!-- // <td>
                                            //     <?php
                                            //     $original_date = $value['date'];

                                            //     // Creating timestamp from given date
                                            //     $timestamp = strtotime($original_date);

                                            //     // Creating new date format from that timestamp
                                            //     $new_date = date("d-m-Y", $timestamp);
                                            //     echo $new_date;

                                            //     ?>
                                            // </td> -->
                                            <td>
                                                <?php echo $value['time']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['departure_time']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['ferry']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['ofc_route']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['harbour']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['destination_harbour']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['HSO']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['trip']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['trip']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['DewasaEksekutif']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['DewasaEksekutifSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEksekutifSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEksekutif2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEksekutif2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEksekutif3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEksekutif3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['BayiEksekutif']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['BayiEksekutifSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEksekutifSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEksekutif2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEksekutif2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEksekutif3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEksekutif3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['DewasaBisnis']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['DewasaBisnisSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaBisnisSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaBisnis2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaBisnis2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaBisnis3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaBisnis3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['BayiBisnis']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['BayiBisnisSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiBisnisSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiBisnis2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiBisnis2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiBisnis3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiBisnis3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['DewasaEkonomi']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['DewasaEkonomiSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEkonomiSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEkonomi2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEkonomi2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEkonomi3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEkonomi3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['BayiEkonomi']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['BayiEkonomiSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEkonomiSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEkonomi2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEkonomi2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEkonomi3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEkonomi3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol1']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol1Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol1Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol12Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol12Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol13Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol13Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol2']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol22Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol22Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol23Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol23Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol3']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol3Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol32Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol32Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol33Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol33Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol4Pen']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol4PenSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4PenSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4Pen2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4Pen2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4Pen3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4Pen3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol4Bar']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol4BarSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4BarSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4Bar2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4Bar2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4Bar3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4Bar3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol5Pen']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol5PenSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5PenSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5Pen2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5Pen2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5Pen3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5Pen3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol5Bar']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol5BarSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5BarSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5Bar2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5Bar2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5Bar3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5Bar3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol6Pen']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol6PenSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6PenSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6Pen2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6Pen2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6Pen3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6Pen3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol6Bar']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol6BarSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6BarSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6Bar2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6Bar2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6Bar3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6Bar3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol7']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol7Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol7Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol72Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol72Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol73Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol73Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol8']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol8Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol8Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol82Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol82Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol83Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol83Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gol9']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Gol9Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol9Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol92Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol92Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol93Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol93Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Suplesi1Dewasa']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Suplesi1DewasaSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1DewasaSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1Dewasa2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1Dewasa2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1Dewasa3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1Dewasa3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Suplesi1Anak']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Suplesi1AnakSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1AnakSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1Anak2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1Anak2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1Anak3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1Anak3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Suplesi2Dewasa']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Suplesi2DewasaSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2DewasaSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2Dewasa2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2Dewasa2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2Dewasa3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2Dewasa3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Suplesi2Anak']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['Suplesi2AnakSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2AnakSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2Anak2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2Anak2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2Anak3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2Anak3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Hewan']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['HewanSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['HewanSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Hewan2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Hewan2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Hewan3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Hewan3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Gayor']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['GayorSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['GayorSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gayor2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gayor2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gayor3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gayor3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['Carter']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['CarterSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['CarterSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Carter2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Carter2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Carter3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Carter3Serial_end']; ?>
                                            </td>
                                            <th>
                                                <?php echo $value['BarangVolume']; ?>
                                            </th>
                                            <th>
                                                <?php echo $value['BarangPendapatan']; ?>
                                            </th>
                                            <td>
                                                <?php echo $value['BarangPendapatanSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BarangPendapatanSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BarangPendapatan2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BarangPendapatan2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BarangPendapatan3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BarangPendapatan3Serial_end']; ?>
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
                                    <th scope="col">Hari </th>
                                    <th scope="col">Tanggal </th>
                                    <th scope="col">Bulan </th>
                                    <th scope="col">Tahun </th>
                                    <th scope="col">Minggu </th>
                                    <th scope="col">Waktu Keberangkatan </th>
                                    <th scope="col">Waktu Tiba </th>
                                    <th scope="col">Nama Kapal </th>
                                    <th scope="col">Lintasan </th>
                                    <th scope="col">Pelabuhan Asal </th>
                                    <th scope="col">Pelabuhan Tujuan </th>
                                    <th scope="col">HSO </th>
                                    <th scope="col">HO </th>
                                    <th scope="col">Jenis Trip </th>
                                    <th scope="col">Dewasa Eksekutif </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Bayi Eksekutif </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Dewasa Bisnis </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Bayi Bisnis </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Dewasa Ekonomi </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Bayi Ekonomi </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 1 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 2 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 3 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 4 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 4 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 5 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 5 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 6 - Penumpang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 6 - Barang </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 7 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 8 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Golongan 9 </th>
                                        <th scope="col">Nomor Seri Awal </th>
                                        <th scope="col">Nomor Seri Akhir </th>
                                        <th scope="col">Nomor Seri Awal 2</th>
                                        <th scope="col">Nomor Seri Akhir 2</th>
                                        <th scope="col">Nomor Seri Awal 3</th>
                                        <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">
                                        Suplesi Ekonomi I Dewasa
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">
                                        Suplesi Ekonomi I Anak
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">
                                        Suplesi Ekonomi II Dewasa
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">
                                        Suplesi Ekonomi II Anak
                                    </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Hewan </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Gayor </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Carter </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
                                    <th scope="col">Barang Volume </th>
                                    <th scope="col">Barang Curah </th>
                                    <th scope="col">Nomor Seri Awal </th>
                                    <th scope="col">Nomor Seri Akhir </th>
                                    <th scope="col">Nomor Seri Awal 2</th>
                                    <th scope="col">Nomor Seri Akhir 2</th>
                                    <th scope="col">Nomor Seri Awal 3</th>
                                    <th scope="col">Nomor Seri Akhir 3</th>
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