<?php
$monthname = '';
$datename = '';
$totalTrip = 0;
$dailyTrip = 0;
$merged_array = [];

function formatRupiah($angka)
{
    $formatRupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $formatRupiah;
}

?>

<div id="accordion">
<div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
            <button style="text-decoration:none; display: block; color: black;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <?php echo "Pendapatan " . longdate_indo(date("Y-m-d")); ?>
            </h5>
        </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
                <!-- Pendapatan Hari ini -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomeDaily as $key => $value) {
                        ?>
                                                                                    <?php $dailyTrip += $value['Jumlah Trip']; ?>
                            
                                                                                    <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        
                        <?php echo "Lintasan ( " . $dailyTrip . " Trip )"; ?>
                    </h5>

                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped table-data">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                            Kapal
                                        </th>
                                        <th scope="col">
                                            Lintasan
                                        </th>
                                        <th scope="col">
                                            Pelabuhan Asal
                                        </th>
                                        <th scope="col">
                                            <?php echo "Total Pendapatan " . longdate_indo(date("Y-m-d")); ?>
                                        </th>
                                        <th scope="col">
                                            Jumlah Trip
                                        </th>
                                        <th scope="col">
                                            Jenis Operasi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($incomeDaily as $key => $value) {
                                        ?>
                                                                                                                                        <tr>
                                                                                                                                            <!-- style="vertical-align : middle;text-align:center; -->
                                                                                                                                            <td rowspan="1">
                                                                                                                                                <?php echo $value['ferry']; ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo $value['route']; ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo $value['harbour']; ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php
                                                                                                                                                echo formatRupiah($value['total']);
                                                                                                                                                ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo $value['Jumlah Trip']; ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo $value['Jenis Operasi']; ?>
                                                                                                                                            </td>
                                                                                                                                        </tr>
                                                                                                                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                            Kapal
                                        </th>
                                        <th scope="col">
                                            Lintasan
                                        </th>
                                        <th scope="col">
                                            Pelabuhan Asal
                                        </th>
                                        <th scope="col">
                                            <?php echo "Total Pendapatan " . longdate_indo(date("Y-m-d")); ?>
                                        </th>
                                        <th scope="col">
                                            Jumlah Trip
                                        </th>
                                        <th scope="col">
                                            Jenis Operasi
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Pendapatan Hari ini -->

                <!-- Pendapatan Kapal Hari ini -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomeDaily as $key => $value) {
                        ?>
                                                                                                                            <?php $dailyTrip += $value['Jumlah Trip']; ?>
                                                                        
                                                                                                                            <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        <?php echo "Kapal ( " . $dailyTrip . " Trip )"; ?>

                    </h5>

                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped table-data">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                            Kapal
                                        </th>
                                        <th scope="col">
                                            <?php echo "Total Pendapatan " . longdate_indo(date("Y-m-d")); ?>
                                        </th>
                                        <th scope="col">
                                            Jumlah Trip
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($incomeDailyPerShip as $key => $value) {
                                        ?>
                                                                                                                                        <tr>
                                                                                                                                            <!-- style="vertical-align : middle;text-align:center; -->
                                                                                                                                            <td rowspan="1">
                                                                                                                                                <?php echo $value['ferry']; ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php
                                                                                                                                                echo formatRupiah($value['total']);
                                                                                                                                                ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo $value['Jumlah Trip']; ?>
                                                                                                                                            </td>
                                                                                                                                        </tr>
                                                                                                                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                            Kapal
                                        </th>
                                        <th scope="col">
                                            <?php echo "Total Pendapatan Kapal " . longdate_indo(date("Y-m-d")); ?>
                                        </th>
                                        <th scope="col">
                                            Jumlah Trip
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Pendapatan Kapal Hari ini -->

                <!-- Pendapatan Pelabuhan Hari ini -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomeDaily as $key => $value) {
                        ?>
                                                                                                                            <?php $dailyTrip += $value['Jumlah Trip']; ?>
                                                                        
                                                                                                                            <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        <?php echo "Pelabuhan ( " . $dailyTrip . " Trip )"; ?>

                    </h5>

                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped table-data">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                            Pelabuhan Asal
                                        </th>
                                        <th scope="col">
                                            <?php echo "Total Pendapatan Pelabuhan " . longdate_indo(date("Y-m-d")); ?>
                                        </th>
                                        <th scope="col">
                                            Jumlah Trip
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($incomeDailyPerHarbour as $key => $value) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $value['harbour']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo formatRupiah($value['total']);
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Jumlah Trip']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                            Pelabuhan Asal
                                        </th>
                                        <th scope="col">
                                            <?php echo "Total Pendapatan " . longdate_indo(date("Y-m-d")); ?>
                                        </th>
                                        <th scope="col">
                                            Jumlah Trip
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Pendapatan Pelabuhan Hari ini -->
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
            <button style="text-decoration:none;  display: block; color: black;" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <div style="white-space:normal"> 
                <?php
                if (getBulan($monthname) != null) {
                    echo "Total Pendapatan Pertanggal 1  " . getBulan(getBulan($monthname)) . " " . date("Y") . " s.d " . date("d") . " " . getBulan($monthname) . " " . date("Y");
                } else {
                    echo "Total Pendapatan Pertanggal 1  " . getBulan(date("F")) . " " . date("Y") . " s.d " . date("d") . " " . getBulan(date("F")) . " " . date("Y");
                }
                ?>
                </div>
            </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <!-- Total Lintasan Tgl 1 s.d Hari ini -->
                <div class="card">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                        <?php $monthname = $value['month_date']; ?>
                    <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Lintasan
                    </h5>

                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped table-data">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                            Kapal
                                        </th>
                                        <th scope="col">
                                            Lintasan
                                        </th>
                                        <th scope="col">
                                            Pelabuhan Asal
                                        </th>
                                        <th scope="col">
                                            <?php echo "Total Tanggal 1 " . getBulan($monthname) . " " . date("Y") . " s.d " . date("d") . " " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th scope="col">
                                            Jumlah Trip
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($totalDaily as $key => $value) {
                                        ?>
                                                                                                                                        <tr>
                                                                                                                                            <td rowspan="1">
                                                                                                                                                <?php echo $value['ferry']; ?>
                                                                                                                                            </td>

                                                                                                                                            <td>
                                                                                                                                                <?php echo $value['rute']; ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo $value['harbour']; ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php
                                                                                                                                                echo formatRupiah($value['total']);

                                                                                                                                                ?>
                                                                                                                                            </td>
                                                                                                                                            <td style=" width:15%">
                                                                                                                                                <?php echo "" . $value['trip'] . " Trip"; ?>
                                                                                                                                            </td>
                                                                                                                                        </tr>
                                                                                                                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th scope="col">

                                        </th>
                                        <th scope="col">

                                        </th>
                                        <th scope="col">

                                        </th>
                                        <th scope="col">

                                        </th>
                                        <th scope="col">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Total Lintasan Tgl 1 s.d Hari ini -->

                <!-- Total Kapal Tgl 1 s.d Hari ini -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                                                                                                                                                                                    <?php $monthname = $value['month_date']; ?>
                                                                                                                                                                                    <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Kapal
                    </h5>

                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped table-data">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                            Kapal
                                        </th>
                                        <th scope="col">

                                            <?php echo "Total Tanggal 1 " . getBulan($monthname) . " " . date("Y") . " s.d " . date("d") . " " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th scope="col">
                                            Jumlah Trip
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($totalDailyPerShip as $key => $value) {
                                        ?>
                                                                                                                            <tr>
                                                                                                                                <td rowspan="1">
                                                                                                                                    <?php echo $value['ferry']; ?>
                                                                                                                                </td>
                                                                                                                                <td>
                                                                                                                                    <?php
                                                                                                                                    echo formatRupiah($value['total']);

                                                                                                                                    ?>
                                                                                                                                </td>
                                                                                                                                <td style=" width:15%">
                                                                                                                                    <?php echo "" . $value['trip'] . " Trip"; ?>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                            <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th scope="col">

                                        </th>
                                        <th scope="col">

                                        </th>
                                        <th scope="col">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Total Kapal Tgl 1 s.d Hari ini -->

                <!-- Total Pelabuhan Tgl 1 s.d Hari ini -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                                                                                                                            <?php $monthname = $value['month_date']; ?>
                                                                                                                            <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Pelabuhan
                    </h5>

                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped table-data">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                            Pelabuhan Asal
                                        </th>
                                        <th scope="col">

                                            <?php echo "Total Tanggal 1 " . getBulan($monthname) . " " . date("Y") . " s.d " . date("d") . " " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th scope="col">
                                            Jumlah Trip
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($totalDailyPerHarbour as $key => $value) {
                                        ?>
                                                                                                                                            <tr>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo $value['harbour']; ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php
                                                                                                                                                    echo formatRupiah($value['total']);

                                                                                                                                                    ?>
                                                                                                                                                </td>
                                                                                                                                                <td style=" width:15%">
                                                                                                                                                    <?php echo "" . $value['trip'] . " Trip"; ?>
                                                                                                                                                </td>
                                                                                                                                            </tr>
                                                                                                                                            <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th scope="col">

                                        </th>
                                        <th scope="col">

                                        </th>
                                        <th scope="col">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Total Pelabuhan Tgl 1 s.d Hari ini -->
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header" id="headingThree">
            <h5 class="mb-0">
            <button style="text-decoration:none; display: block; color: black;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <?php
                if (getBulan($monthname) != null) {
                    echo "Total Produksi Pertanggal 1 " . getBulan($monthname) . " " . date("Y") . " s.d " . date("d") . " " . getBulan($monthname) . " " . date("Y");
                } else {
                    echo "Total Produksi Pertanggal 1 " . getBulan(date("F")) . " " . date("Y") . " s.d " . date("d") . " " . getBulan(date("F")) . " " . date("Y");
                }
                ?>
            </button>
            </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
                <!-- Total Produksi Tgl 1 s.d Hari ini -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                                                                                                                <?php $monthname = $value['month_date']; ?>
                                                                                                                <?php $totalTrip += $value['Jumlah Trip']; ?>

                                                                                                                <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Lintasan
                    </h5>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="wrapper" style="overflow-x: auto;">
                                <table id="table-data" class="table table-striped table-data" style="display: block; font-size:80%;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">
                                                Kapal
                                            </th>
                                            <th scope="col">
                                                Lintasan
                                            </th>
                                            <th scope="col">
                                                Pelabuhan Asal
                                            </th>
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
                                            <th scope="col">Barang Curah </th>

                                            <th scope="col">
                                                Jumlah Trip
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($totalDaily as $key => $value) {
                                            ?>
                                            <tr>
                                                <td rowspan="1">
                                                    <?php echo $value['ferry']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $value['rute']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $value['harbour']; ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan I']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan II']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan III']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan IV - Penumpang']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan IV - Barang']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan V - Penumpang']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan V - Barang']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan VI - Penumpang']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan VI - Barang']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan VII']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan VIII']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Golongan IX']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Dewasa Eksekutif']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Bayi Eksekutif']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Dewasa Bisnis']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Bayi Bisnis']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Dewasa Ekonomi']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Bayi Ekonomi']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Suplesi Ekonomi I Dewasa']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Suplesi Ekonomi I Anak']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Suplesi Ekonomi II Dewasa']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Suplesi Ekonomi II Anak']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Hewan']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Gayor']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Carter']); ?>
                                                </td>
                                                <td>
                                                    <?php echo formatRupiah($value['Barang Curah']); ?>
                                                </td>
                                                <td style=" width:15%">
                                                    <?php echo "" . $value['trip'] . " Trip"; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    <tbody>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th scope="col">
                                                Kapal
                                            </th>
                                            <th scope="col">
                                                Lintasan
                                            </th>
                                            <th scope="col">
                                                Pelabuhan Asal
                                            </th>
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
                                            <th scope="col">Barang Curah </th>

                                            <th scope="col">
                                                Jumlah Trip
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Produksi Tgl 1 s.d Hari ini -->

                <!-- Total Produksi Pelabuhan Tgl 1 s.d Hari ini -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                                                                                                                                                                                    <?php $monthname = $value['month_date']; ?>
                                                                                                                                                                                    <?php $totalTrip += $value['Jumlah Trip']; ?>
                                                                                                                                                                                    <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Kapal
                    </h5>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="wrapper" style="overflow-x: auto;">
                                <table id="" class="table table-striped table-data" style="display: block; font-size:80%;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">
                                                Kapal
                                            </th>
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
                                            <th scope="col">Barang Curah </th>

                                            <th scope="col">
                                                Jumlah Trip
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($totalDailyPerShip as $key => $value) {
                                            ?>
                                                                                                                                            <tr>
                                                                                                                                                <td rowspan="1">
                                                                                                                                                    <?php echo $value['ferry']; ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan I']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan II']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan III']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan IV - Penumpang']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan IV - Barang']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan V - Penumpang']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan V - Barang']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan VI - Penumpang']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan VI - Barang']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan VII']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan VIII']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Golongan IX']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Dewasa Eksekutif']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Bayi Eksekutif']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Dewasa Bisnis']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Bayi Bisnis']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Dewasa Ekonomi']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Bayi Ekonomi']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Suplesi Ekonomi I Dewasa']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Suplesi Ekonomi I Anak']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Suplesi Ekonomi II Dewasa']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Suplesi Ekonomi II Anak']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Hewan']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Gayor']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Carter']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php echo formatRupiah($value['Barang Curah']); ?>
                                                                                                                                                </td>
                                                                                                                                                <td style=" width:15%">
                                                                                                                                                    <?php echo "" . $value['trip'] . " Trip"; ?>
                                                                                                                                                </td>
                                                                                                                                            </tr>
                                                                                                                                            <?php
                                        }
                                        ?>
                                    <tbody>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th scope="col">
                                                Kapal
                                            </th>
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
                                            <th scope="col">Barang Curah </th>

                                            <th scope="col">
                                                Jumlah Trip
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Produksi Pelabuhan Tgl 1 s.d Hari ini -->

                <!-- Total Produksi Kapal Tgl 1 s.d Hari ini -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                                                                                                                <?php $monthname = $value['month_date']; ?>
                                                                                                                <?php $totalTrip += $value['Jumlah Trip']; ?>

                                                                                                                <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Pelabuhan
                    </h5>

                    <div class="card-body p-4">
                        <div class="row">
                            <div class="wrapper" style="overflow-x: auto;">
                                <table id="" class="table table-striped table-data" style="display: block; font-size:80%;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">
                                                Pelabuhan Asal
                                            </th>
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
                                            <th scope="col">Barang Curah </th>

                                            <th scope="col">
                                                Jumlah Trip
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($totalDailyPerHarbour as $key => $value) {
                                            ?>
                                                                                                                                        <tr>
                                                                                                                                            <td>
                                                                                                                                                <?php echo $value['harbour']; ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan I']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan II']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan III']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan IV - Penumpang']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan IV - Barang']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan V - Penumpang']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan V - Barang']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan VI - Penumpang']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan VI - Barang']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan VII']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan VIII']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Golongan IX']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Dewasa Eksekutif']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Bayi Eksekutif']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Dewasa Bisnis']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Bayi Bisnis']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Dewasa Ekonomi']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Bayi Ekonomi']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Suplesi Ekonomi I Dewasa']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Suplesi Ekonomi I Anak']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Suplesi Ekonomi II Dewasa']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Suplesi Ekonomi II Anak']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Hewan']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Gayor']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Carter']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php echo formatRupiah($value['Barang Curah']); ?>
                                                                                                                                            </td>
                                                                                                                                            <td style=" width:15%">
                                                                                                                                                <?php echo "" . $value['trip'] . " Trip"; ?>
                                                                                                                                            </td>
                                                                                                                                        </tr>
                                                                                                                                        <?php
                                        }
                                        ?>
                                    <tbody>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th scope="col">
                                                Pelabuhan Asal
                                            </th>
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
                                            <th scope="col">Barang Curah </th>

                                            <th scope="col">
                                                Jumlah Trip
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Produksi Kapal Tgl 1 s.d Hari ini --> 
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingFour">
            <h5 class="mb-0">
            <button style="text-decoration:none;
    display: block;
color: black;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <?php
                if (getBulan($monthname) != null) {
                    echo "Perbandingan Realisasi " . getBulan($monthname) . " " . date("Y") . " & RKA " . getBulan($monthname) . " " . date("Y");
                } else {
                    echo "Perbandingan Realisasi " . getBulan(date("F")) . " " . date("Y") . " & RKA " . getBulan(date("F")) . " " . date("Y");
                }
                ?>
            </button>
            </h5>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
            <div class="card-body">
            <!-- Perbandingan Total Bulan dan RKA -->
            <div class="card mt-3">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                                                                                                                <?php $monthname = $value['month_date']; ?>
                                                                                                                <?php $totalTrip += $value['Jumlah Trip']; ?>
                                                                                                                <!-- <?php echo date("Y"); ?> Print Current Year -->
                                                                                                                <!-- <?php echo getBulan(date("F")); ?> Print Current Month -->
                                                                                                                <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Lintasan
                    </h5>
                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped  table-data">
                                <thead class="thead-dark">
                                    <tr>
                                    <tr class=" border-0">
                                        <th scope="col" rowspan="2" style="vertical-align:middle;" id="card-button" class="text-center">
                                            Kapal
                                        </th>
                                        <th scope="col" rowspan="2" style="vertical-align:middle;" id="card-button" class="text-center">
                                            Lintasan
                                        </th>
                                        <th scope="col" rowspan="2" style="vertical-align:middle;" id="card-button" class="text-center">
                                            Pelabuhan Asal
                                        </th>
                                        <th colspan="2" class="text-center">
                                            <?php echo "Realisasi " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th colspan="2" class="text-center">
                                            <?php echo "RKA " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th colspan="2" class="text-center">Persentase Pencapaian</th>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($incomePerRoute as $key => $value) {
                                        ?>
                                                                                                                                        <tr>
                                                                                                                                            <td rowspan="" style=" width:25%">
                                                                                                                                                <?php echo $value['ferry']; ?>
                                                                                                                                            </td>
                                                                                                                                            <td rowspan="" style=" width:25%">
                                                                                                                                                <?php echo $value['route']; ?>
                                                                                                                                            </td>

                                                                                                                                            <td style=" width:20%">
                                                                                                                                                <?php echo $value['harbour']; ?>
                                                                                                                                            </td>
                                                                                                                                            <td style=" width:15%">
                                                                                                                                                <?php echo "" . $value['Jumlah Trip'] . " Trip"; ?>
                                                                                                                                            </td>
                                                                                                                                            <td style=" width:15%">
                                                                                                                                                <?php
                                                                                                                                                echo formatRupiah($value['total']);
                                                                                                                                                ?>
                                                                                                                                            </td>
                                                                                                                                            <td style="width:15%">
                                                                                                                                                <?php echo "" . $value['target_trip'] . " Trip"; ?>
                                                                                                                                            </td>
                                                                                                                                            <td style="width:15%">
                                                                                                                                                <?php
                                                                                                                                                echo formatRupiah($value['target']);
                                                                                                                                                ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php
                                                                                                                                                $tripSebelum = $value['Jumlah Trip'];
                                                                                                                                                $tripSetelah = $value['target_trip'];
                                                                                                                                                if ($tripSetelah == 0 && $tripSebelum != 0):
                                                                                                                                                    $persentase = -100;
                                                                                                                                                elseif ($tripSebelum == 0 && $tripSetelah == 0):
                                                                                                                                                    $persentase = 0;
                                                                                                                                                else:
                                                                                                                                                    $persentase = ($tripSebelum / $tripSetelah) * 100;
                                                                                                                                                endif;
                                                                                                                                                echo number_format($persentase, 2) . "%";
                                                                                                                                                ?>
                                                                                                                                            </td>
                                                                                                                                            <td>
                                                                                                                                                <?php

                                                                                                                                                $totalSebelum = $value['total'];
                                                                                                                                                $totalSetelah = $value['target'];
                                                                                                                                                if ($totalSetelah == 0 && $totalSebelum != 0):
                                                                                                                                                    $persentase = -100;
                                                                                                                                                elseif ($tripSetelah == 0 && $totalSetelah == 0):
                                                                                                                                                    $persentase = 0;
                                                                                                                                                else:
                                                                                                                                                    $persentase = ($totalSebelum / $totalSetelah) * 100;
                                                                                                                                                endif;
                                                                                                                                                echo number_format($persentase, 2) . "%";
                                                                                                                                                ?>
                                                                                                                                            </td>

                                                                                                                                        </tr>

                                                                                                                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Perbandingan Total Bulan dan RKA -->

                <!-- Perbandingan Total Kapal Bulan dan RKA -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                                                                                                                <?php $monthname = $value['month_date']; ?>
                                                                                                                <?php $totalTrip += $value['Jumlah Trip']; ?>
                                                                                                                <!-- <?php echo date("Y"); ?> Print Current Year -->
                                                                                                                <!-- <?php echo getBulan(date("F")); ?> Print Current Month -->
                                                                                                                <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Kapal
                    </h5>
                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped  table-data">
                                <thead class="thead-dark">
                                    <tr>
                                    <tr class=" border-0">
                                        <th scope="col" rowspan="2" style="vertical-align:middle;" id="card-button" class="text-center">
                                            Kapal
                                        </th>
                                        <th colspan="2" class="text-center">
                                            <?php echo "Realisasi Kapal " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th colspan="2" class="text-center">
                                            <?php echo "RKA Kapal " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th colspan="2" class="text-center">Persentase Pencapaian</th>
                                    </tr>
                                    <tr>
                                        
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($incomePerShip as $key => $value) {
                                        ?>
                                                                                                                                            <tr>
                                                                                                                                                <td rowspan="" style=" width:25%">
                                                                                                                                                    <?php echo $value['ferry']; ?>
                                                                                                                                                </td>

                                                                                                                                                <td style=" width:15%">
                                                                                                                                                    <?php echo "" . $value['Jumlah Trip'] . " Trip"; ?>
                                                                                                                                                </td>
                                                                                                                                                <td style=" width:15%">
                                                                                                                                                    <?php
                                                                                                                                                    echo formatRupiah($value['total']);
                                                                                                                                                    ?>
                                                                                                                                                </td>
                                                                                                                                                <td style="width:15%">
                                                                                                                                                    <?php echo "" . $value['target_trip'] . " Trip"; ?>
                                                                                                                                                </td>
                                                                                                                                                <td style="width:15%">
                                                                                                                                                    <?php
                                                                                                                                                    echo formatRupiah($value['target']);
                                                                                                                                                    ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php
                                                                                                                                                    $tripSebelum = $value['Jumlah Trip'];
                                                                                                                                                    $tripSetelah = $value['target_trip'];
                                                                                                                                                    if (
                                                                                                                                                        $tripSetelah
                                                                                                                                                        == 0
                                                                                                                                                    ) {
                                                                                                                                                        $persentase = 0;
                                                                                                                                                    } else {
                                                                                                                                                        $persentase = ($tripSebelum / $tripSetelah) * 100;
                                                                                                                                                    }
                                                                                                                                                    echo number_format($persentase, 2) . "%";
                                                                                                                                                    ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php
                                                                                                                                                    $totalSebelum = $value['total'];
                                                                                                                                                    $totalSetelah = $value['target'];
                                                                                                                                                    if ($totalSetelah == 0 && $totalSebelum != 0):
                                                                                                                                                        $persentase = -100;
                                                                                                                                                    elseif ($tripSetelah == 0 && $totalSetelah == 0):
                                                                                                                                                        $persentase = 0;
                                                                                                                                                    else:
                                                                                                                                                        $persentase = ($totalSebelum / $totalSetelah) * 100;
                                                                                                                                                    endif;
                                                                                                                                                    echo number_format($persentase, 2) . "%";
                                                                                                                                                    ?>
                                                                                                                                                </td>

                                                                                                                                            </tr>

                                                                                                                                            <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Perbandingan Total Kapal Bulan dan RKA -->

                <!-- Perbandingan Total Pelabuhan Bulan dan RKA -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                                                                                                                <?php $monthname = $value['month_date']; ?>
                                                                                                                <?php $totalTrip += $value['Jumlah Trip']; ?>
                                                                                                                <!-- <?php echo date("Y"); ?> Print Current Year -->
                                                                                                                <!-- <?php echo getBulan(date("F")); ?> Print Current Month -->
                                                                                                                <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Pelabuhan
                    </h5>
                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped  table-data">
                                <thead class="thead-dark">
                                    <tr>
                                    <tr class=" border-0">
                                        <th scope="col" rowspan="2" style="vertical-align:middle;" id="card-button" class="text-center">
                                            Pelabuhan Asal
                                        </th>
                                        <th colspan="2" class="text-center">
                                            <?php echo "Realisasi Pelabuhan " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th colspan="2" class="text-center">
                                            <?php echo "RKA Pelabuhan " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th colspan="2" class="text-center">Persentase Pencapaian</th>
                                    </tr>
                                    <tr>

                                        
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($incomePerHarbour as $key => $value) {
                                        ?>
                                                                                                                                            <tr>

                                                                                                                                                <td style=" width:20%">
                                                                                                                                                    <?php echo $value['harbour']; ?>
                                                                                                                                                </td>
                                                                                                                                                <td style=" width:15%">
                                                                                                                                                    <?php echo $value['Jumlah Trip'] . " Trip"; ?>
                                                                                                                                                </td>
                                                                                                                                                <td style=" width:15%">
                                                                                                                                                    <?php
                                                                                                                                                    echo formatRupiah($value['total']);
                                                                                                                                                    ?>
                                                                                                                                                </td>
                                                                                                                                                <td style="width:15%">
                                                                                                                                                    <?php echo $value['target_trip'] . " Trip"; ?>
                                                                                                                                                </td>
                                                                                                                                                <td style="width:15%">
                                                                                                                                                    <?php
                                                                                                                                                    echo formatRupiah($value['target']);
                                                                                                                                                    ?>
                                                                                                                                                </td>

                                                                                                                                                <td>
                                                                                                                                                    <?php
                                                                                                                                                    $tripSebelum = $value['Jumlah Trip'];
                                                                                                                                                    $tripSetelah = $value['target_trip'];
                                                                                                                                                    if ($tripSetelah == 0 && $tripSebelum != 0):
                                                                                                                                                        $persentase = -100;
                                                                                                                                                    elseif ($tripSebelum == 0 && $tripSetelah == 0):
                                                                                                                                                        $persentase = 0;
                                                                                                                                                    else:
                                                                                                                                                        $persentase = ($tripSebelum / $tripSetelah) * 100;
                                                                                                                                                    endif;
                                                                                                                                                    echo number_format($persentase, 2) . "%";
                                                                                                                                                    ?>
                                                                                                                                                </td>
                                                                                                                                                <td>
                                                                                                                                                    <?php
                                                                                                                                                    $totalSebelum = $value['total'];
                                                                                                                                                    $totalSetelah = $value['target'];
                                                                                                                                                    if ($totalSetelah == 0 && $totalSebelum != 0):
                                                                                                                                                        $persentase = -100;
                                                                                                                                                    elseif ($tripSetelah == 0 && $totalSetelah == 0):
                                                                                                                                                        $persentase = 0;
                                                                                                                                                    else:
                                                                                                                                                        $persentase = ($totalSebelum / $totalSetelah) * 100;
                                                                                                                                                    endif;
                                                                                                                                                    echo number_format($persentase, 2) . "%";
                                                                                                                                                    ?>
                                                                                                                                                </td>
                                                                                                                                            </tr>
                                                                                                                                            <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>

                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Perbandingan Total Pelabuhan Bulan dan RKA -->
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingFive">
            <h5 class="mb-0">
            <button style="text-decoration:none;
    display: block;
color: black;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <?php
                if (getBulan($monthname) != null) {
                    echo "Perbandingan Realisasi Lintasan " . getBulan($monthname) . " " . date("Y") - 1 . " & Realisasi " . getBulan($monthname) . " " . date("Y");
                } else {
                    echo "Perbandingan Realisasi Lintasan " . getBulan(date("F")) . " " . date("Y") - 1 . " & Realisasi " . getBulan(date("F")) . " " . date("Y");
                }
                ?>
            </button>
            </h5>
        </div>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
            <div class="card-body">
            <!-- Perbandingan Total Bulan 2022 dan 2023 -->
            <div class="card mt-3">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                                                                                                                <?php $monthname = $value['month_date']; ?>
                                                                                                                <?php $totalTrip += $value['Jumlah Trip']; ?>
                                                                                                                <!-- <?php echo date("Y"); ?> Print Current Year -->
                                                                                                                <!-- <?php echo getBulan(date("F")); ?> Print Current Month -->

                                                                                                                <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">

                        Lintasan
                    </h5>

                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped  table-data" style="border-collapse: collapse">
                                <thead class="thead-dark">
                                    <tr>
                                    <tr class=" border-0">
                                        <th scope="col" rowspan="2" style="vertical-align:middle;" id="card-button" class="text-center">
                                            Kapal
                                        </th>
                                        <th scope="col" rowspan="2" style="vertical-align:middle;" id="card-button" class="text-center">
                                            Lintasan
                                        </th>
                                        <th scope="col" rowspan="2" style="vertical-align:middle;" id="card-button" class="text-center">
                                            Pelabuhan Asal
                                        </th>
                                        <th colspan="2" class="text-center">
                                            <?php echo "Realisasi Lintasan " . getBulan($monthname) . " " . date("Y") - 1; ?>
                                        </th>
                                        <th colspan="2" class="text-center">
                                            <?php echo "Realisasi Lintasan " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th colspan="2" class="text-center">Persentase Pencapaian</th>
                                    </tr>
                                    <tr>
                                        
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($incomePerRoute as $key => $value) {
                                        ?>
                                            <tr class="text-center">
                                                <td rowspan="" style=" width:25%">
                                                    <?php echo $value['ferry']; ?>
                                                </td>
                                                <td rowspan="" style=" width:25%">
                                                    <?php echo $value['route']; ?>
                                                </td>

                                                <td style=" width:20%">
                                                    <?php echo $value['harbour']; ?>
                                                </td>
                                                <td style=" width:15%">
                                                    <?php echo "" . $value['tripLastYear'] . " Trip"; ?>
                                                </td>
                                                <td style=" width:15%">
                                                    <?php
                                                    if ($value['totalLastYear'] == null) {
                                                        echo formatRupiah(0);
                                                    } else {
                                                        echo formatRupiah($value['totalLastYear']);
                                                    }
                                                    ?>
                                                </td>

                                                <td style=" width:15%">
                                                    <?php echo "" . $value['Jumlah Trip'] . " Trip"; ?>
                                                </td>
                                                <td style=" width:15%">
                                                    <?php
                                                    echo formatRupiah($value['total']);
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php
                                                    $tripSebelum = $value['tripLastYear'];
                                                    $tripSetelah = $value['Jumlah Trip'];
                                                    if ($tripSetelah == 0 && $tripSebelum != 0):
                                                        $persentase = -100;
                                                    elseif ($tripSebelum == 0 && $tripSetelah == 0):
                                                        $persentase = 0;
                                                    elseif($tripSebelum != 0 && $tripSetelah != 0):
                                                        $persentase = ($tripSetelah / $tripSebelum) * 100;
                                                    endif;
                                                    echo number_format($persentase, 2) . "%";
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $totalSebelum = $value['totalLastYear'];
                                                    $totalSetelah = $value['total'];
                                                    if ($totalSetelah == 0 && $totalSebelum != 0):
                                                        $persentase = -100;
                                                    elseif ($tripSetelah == 0 && $totalSetelah == 0):
                                                        $persentase = 0;
                                                    elseif($totalSetelah != 0 && $totalSebelum != 0):
                                                        $persentase = ($totalSetelah / $totalSebelum) * 100;
                                                    endif;
                                                    echo number_format($persentase, 2) . "%";
                                                    ?>
                                                </td>

                                            </tr>
                                            <?php
                                    }
                                    ?>

                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Perbandingan Total Bulan 2022 dan 2023 -->

                <!-- Perbandingan Total Kapal Bulan 2022 dan 2023 -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                                                                                                                <?php $monthname = $value['month_date']; ?>
                                                                                                                <?php $totalTrip += $value['Jumlah Trip']; ?>
                                                                                                                <!-- <?php echo date("Y"); ?> Print Current Year -->
                                                                                                                <!-- <?php echo getBulan(date("F")); ?> Print Current Month -->

                                                                                                                <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">

                        Kapal
                    </h5>

                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped  table-data table-vcenter" style="border-collapse: collapse;">
                                <thead class="thead-dark">
                                    <tr class=" border-0">
                                        <th scope="col" rowspan="2" style="vertical-align:middle;" id="card-button" class="text-center">
                                            Kapal
                                        </th>
                                        
                                        <th colspan="2" class="text-center">
                                            <?php echo "Realisasi Kapal " . getBulan($monthname) . " " . date("Y") - 1; ?>
                                        </th>
                                        <th colspan="2" class="text-center">
                                            <?php echo "Realisasi Kapal " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th colspan="2" class="text-center">Persentase Pencapaian</th>
                                    </tr>
                                    <tr>
                                        
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($incomePerShip as $key => $value) {
                                        ?>
                                        <tr class="text-center">
                                            <td rowspan="" style=" width:25%">
                                                <?php echo $value['ferry']; ?>
                                            </td>
                                            <td style=" width:15%">
                                                <?php echo "" . $value['tripLastYear'] . " Trip"; ?>
                                            </td>
                                            <td style=" width:15%">
                                                <?php
                                                if ($value['totalLastYear'] == null) {
                                                    echo formatRupiah(0);
                                                } else {
                                                    echo formatRupiah($value['totalLastYear']);
                                                }
                                                ?>
                                            </td>

                                            <td style=" width:15%">
                                                <?php echo "" . $value['Jumlah Trip'] . " Trip"; ?>
                                            </td>
                                            <td style=" width:15%">
                                                <?php
                                                echo formatRupiah($value['total']);
                                                ?>
                                            </td>

                                            <td>
                                                <?php
                                                $tripSebelum = $value['tripLastYear'];
                                                $tripSetelah = $value['Jumlah Trip'];
                                                if ($tripSetelah == 0 && $tripSebelum != 0):
                                                    $persentase = -100;
                                                elseif ($tripSebelum == 0 && $tripSetelah == 0):
                                                    $persentase = 0;
                                                elseif($tripSebelum != 0 && $tripSetelah != 0):
                                                    $persentase = ($tripSetelah / $tripSebelum) * 100;
                                                endif;
                                                echo number_format($persentase, 2) . "%";
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $totalSebelum = $value['totalLastYear'];
                                                $totalSetelah = $value['total'];
                                                if ($totalSetelah == 0 && $totalSebelum != 0):
                                                    $persentase = 100;
                                                elseif ($totalSetelah != 0 && $totalSebelum == 0):
                                                    $persentase = -100;
                                                elseif ($totalSebelum == 0 && $totalSetelah == 0):
                                                    $persentase = 0;
                                                elseif($totalSetelah != 0 && $totalSebelum != 0):
                                                    $persentase = ($totalSetelah / $totalSebelum) * 100;
                                                endif;
                                                echo number_format($persentase, 2) . "%";
                                                ?>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                        <th scope="col" class="text-center">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Perbandingan Total Kapal Bulan 2022 dan 2023 -->

                <!-- Perbandingan Total Bulan 2022 dan 2023 -->
                <div class="card mt-3">
                    <?php
                    foreach ($incomePerRoute as $key => $value) {
                        ?>
                                                                                                                <?php $monthname = $value['month_date']; ?>
                                                                                                                <?php $totalTrip += $value['Jumlah Trip']; ?>
                                                                                                                <!-- <?php echo date("Y"); ?> Print Current Year -->
                                                                                                                <!-- <?php echo getBulan(date("F")); ?> Print Current Month -->

                                                                                                                <?php
                    }
                    ?>
                    <h5 class="card-header d-flex justify-content-between align-items-center">

                        Pelabuhan
                    </h5>

                    <div class="card-body">
                        <div class="wrapper" style="overflow-x: auto;">
                            <table class="dashboard-table table table-striped  table-data" style="border-collapse: collapse;">
                                <thead class="thead-dark">
                                    <tr>
                                    <tr class=" border-0">

                                        
                                        <th scope="col" rowspan="2" style="vertical-align:middle;" id="card-button" class="text-center">
                                            Pelabuhan Asal
                                        </th>
                                        <th colspan="2" class="text-center">
                                            <?php echo "Realisasi Pelabuhan " . getBulan($monthname) . " " . date("Y") - 1; ?>
                                        </th>
                                        <th colspan="2" class="text-center">
                                            <?php echo "Realisasi Pelabuhan " . getBulan($monthname) . " " . date("Y"); ?>
                                        </th>
                                        <th colspan="2" class="text-center">Persentase Pencapaian</th>
                                    </tr>
                                    <tr>

                                        
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                        <th scope="col" class="text-center">
                                            Trip
                                        </th>
                                        <th scope="col" class="text-center">
                                            Pendapatan
                                        </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($incomePerHarbour as $key => $value) {
                                        ?>
                                        <tr class="text-center">


                                            <td style=" width:20%">
                                                <?php echo $value['harbour']; ?>
                                            </td>
                                            <td style=" width:15%">
                                                <?php echo "" . $value['tripLastYear'] . " Trip"; ?>
                                            </td>
                                            <td style=" width:15%">
                                                <?php
                                                if ($value['totalLastYear'] == null) {
                                                    echo formatRupiah(0);
                                                } else {
                                                    echo formatRupiah($value['totalLastYear']);
                                                }
                                                ?>
                                            </td>

                                            <td style=" width:15%">
                                                <?php echo "" . $value['Jumlah Trip'] . " Trip"; ?>
                                            </td>
                                            <td style=" width:15%">
                                                <?php
                                                echo formatRupiah($value['total']);
                                                ?>
                                            </td>

                                            <td>
                                                <?php
                                                $tripSebelum = $value['tripLastYear'];
                                                $tripSetelah = $value['Jumlah Trip'];
                                                if ($tripSetelah == 0 && $tripSebelum != 0):
                                                    $persentase = -100;
                                                elseif ($tripSebelum == 0 && $tripSetelah == 0):
                                                    $persentase = 0;
                                                elseif($tripSebelum != 0 && $tripSetelah != 0):
                                                    $persentase = ($tripSetelah / $tripSebelum) * 100;
                                                endif;
                                                echo number_format($persentase, 2) . "%";
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $totalSebelum = $value['totalLastYear'];
                                                $totalSetelah = $value['total'];
                                                if ($totalSetelah == 0 && $totalSebelum != 0):
                                                    $persentase = -100;
                                                elseif ($totalSebelum == 0 && $totalSetelah == 0):
                                                    $persentase = 0;
                                                elseif($totalSebelum!=0 && $totalSetelah != 0):
                                                    $persentase = ($totalSetelah / $totalSebelum) * 100;
                                                endif;
                                                echo number_format($persentase, 2) . "%";
                                                ?>
                                            </td>

                                        </tr>
                                        <?php
                                }
                                    ?>

                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Perbandingan Total Pelabuhan Bulan 2022 dan 2023 -->
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingSix">
            <h5 class="mb-0">
            <button style="text-decoration:none;
    display: block;
color: black;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                Pendapatan Harian
            </button>
            </h5>
        </div>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
            <div class="card-body">
            <!-- Table Pendapatan -->
            <div class="card mt-3">
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Pendapatan Harian
                    </h5>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="wrapper" style="overflow-x: auto;">
                                <table id="" class="table table-striped  table-data" style="display: block; font-size:80%;">
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
                                            <th scope="col">Barang Curah </th>
                                            <th scope="col">Nomor Seri Awal </th>
                                            <th scope="col">Nomor Seri Akhir </th>
                                            <th scope="col">Total </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($pendapatan as $key => $value) {
                                            ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $no++; ?>
                                            </th>
                                            <th>
                                                <?php echo $value['week']; ?>
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
                                                <?php echo $value['time']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['ferry']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['rute']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['harbour']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['trip']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Dewasa Eksekutif']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEksekutifSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEksekutifSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Bayi Eksekutif']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEksekutifSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEksekutifSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Dewasa Bisnis']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaBisnisSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaBisnisSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Bayi Bisnis']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiBisnisSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiBisnisSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Dewasa Ekonomi']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEkonomiSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DewasaEkonomiSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Bayi Ekonomi']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEkonomiSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BayiEkonomiSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan I']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol1Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol1Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan II']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol2Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol2Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan III']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol3Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol3Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan IV - Penumpang']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4PenSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4PenSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan IV - Barang']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4BarSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol4BarSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan V - Penumpang']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5PenSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5PenSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan V - Barang']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5BarSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol5BarSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan VI - Penumpang']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6PenSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6PenSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan VI - Barang']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6BarSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol6BarSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan VII']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol7Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol7Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan VIII']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol8Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol8Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Golongan IX']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol9Serial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Gol9Serial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi Ekonomi I Dewasa']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1DewasaSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1DewasaSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi Ekonomi I Anak']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1AnakSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi1AnakSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi Ekonomi II Dewasa']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2DewasaSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi2DewasaSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['Suplesi Ekonomi II Anak']; ?>
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
                                                <?php echo $value['Barang Curah']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BarangPendapatanSerial_start']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['BarangPendapatanSerial_end']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['total']; ?>
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
                                            <th scope="col">Barang Curah </th>
                                            <th scope="col">Nomor Seri Awal </th>
                                            <th scope="col">Nomor Seri Akhir </th>
                                            <th scope="col">Total </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table Pendapatan -->
            </div>
        </div>
    </div>
</div>



