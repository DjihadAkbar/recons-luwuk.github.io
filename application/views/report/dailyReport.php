<?php
// require 'vendor/autoload.php';

// // koneksi php dan mysql
// $koneksi = mysqli_connect("localhost","root","","asdp_luwuk");
// // $koneksi = mysqli_connect("217.21.72.151","u1578336_admin","5september_","u1578336_db_recons_luwuk");

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Style\Border;
// use PhpOffice\PhpSpreadsheet\Style\Color;

// // $title = 'Bukti Penyetoran';


// $spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();

// $entryData = mysqli_query($koneksi,"
//     SELECT *,dayname(date), 
//     entry_data.DewasaEksekutif AS 'Jumlah DewasaEksekutif', entry_data.BayiEksekutif  AS 'Jumlah BayiEksekutif', entry_data.DewasaBisnis AS 'Jumlah DewasaBisnis', entry_data.BayiBisnis AS 'Jumlah BayiBisnis', entry_data.DewasaEkonomi AS 'Jumlah DewasaEkonomi', entry_data.BayiEkonomi AS 'Jumlah BayiEkonomi',
//     entry_data.Gol1 as 'Jumlah Gol1', entry_data.Gol2 as 'Jumlah Gol2', entry_data.Gol3 as 'Jumlah Gol3', entry_data.Gol4Pen as 'Jumlah Gol4Pen', entry_data.Gol4Bar as 'Jumlah Gol4Bar', entry_data.Gol5Pen as 'Jumlah Gol5Pen',entry_data.Gol5Bar as 'Jumlah Gol5Bar',entry_data.Gol6Pen as 'Jumlah Gol6Pen',entry_data.Gol6Bar as 'Jumlah Gol6Bar',entry_data.Gol7 as 'Jumlah Gol7',entry_data.Gol8 as 'Jumlah Gol8',entry_data.Gol9 as 'Jumlah Gol9', 
//     (rate.DewasaEksekutif * entry_data.DewasaEksekutif) as 'Dewasa Eksekutif',
//     (rate.BayiEksekutif * entry_data.BayiEksekutif) as 'Bayi Eksekutif',
//     (rate.DewasaBisnis * entry_data.DewasaBisnis) as 'Dewasa Bisnis',
//     (rate.BayiBisnis * entry_data.BayiBisnis) as 'Bayi Bisnis',
//     (rate.DewasaEkonomi * entry_data.DewasaEkonomi) as 'Dewasa Ekonomi',
//     (rate.BayiEkonomi * entry_data.BayiEkonomi) as 'Bayi Ekonomi',
//     (rate.Gol1 * entry_data.Gol1) as 'Golongan 1',
//     (rate.Gol2 * entry_data.Gol2) as 'Golongan 2',
//     (rate.Gol3 * entry_data.Gol3) as 'Golongan 3',
//     (rate.Gol4Pen * entry_data.Gol4Pen) as 'Golongan 4 Penumpang',
//     (rate.Gol4Bar * entry_data.Gol4Bar) as 'Golongan 4 Barang',
//     (rate.Gol5Pen * entry_data.Gol5Pen) as 'Golongan 5 Penumpang',
//     (rate.Gol5Bar * entry_data.Gol5Bar) as 'Golongan 5 Barang',
//     (rate.Gol6Pen * entry_data.Gol6Pen) as 'Golongan 6 Penumpang',
//     (rate.Gol6Bar * entry_data.Gol6Bar) as 'Golongan 6 Barang',
//     (rate.Gol7 * entry_data.Gol7) as 'Golongan 7',
//     (rate.Gol8 * entry_data.Gol8) as 'Golongan 8',
//     (rate.Gol9 * entry_data.Gol9) as 'Golongan 9',
//     entry_data.BarangVolume as 'Entry Barang Volume'
//     FROM entry_data
//     JOIN ferry ON ferry.id = entry_data.id_ferry
//     JOIN routes ON routes.id = entry_data.id_route
//     JOIN harbours on harbours.id_harbours = entry_data.id_harbour
//     JOIN rate ON rate.id_route = routes.id and entry_data.date >= rate.start_date and rate.rate_type = entry_data.rate_type
//     WHERE date='{$report['tanggalAwalReport']}' and ferry = '{$report['kapalReport']}' and route = '{$report['lintasanReport']}'
// ");

// // sheet peratama
// $sheet->setTitle($title);
// $sheet->mergeCells('C3:H4')->getStyle('C3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
// $sheet->mergeCells('D5:F5')->getStyle('D5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
// $sheet->mergeCells('D6:F6')->getStyle('D6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
// $sheet->mergeCells('C7:C8')->getStyle('C7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
// $sheet->mergeCells('D7:D8')->getStyle('D7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
// $sheet->mergeCells('E7:H7')->getStyle('E7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
// $sheet->mergeCells('C9:C16')->getStyle('C9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
// $sheet->mergeCells('C17:C30')->getStyle('C17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
// $sheet->mergeCells('C31:C34')->getStyle('C31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
// $sheet->mergeCells('C35:C40')->getStyle('C35')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// $sheet->setCellValue('C3', $title);
// $sheet->setCellValue('C5', 'Cabang');
// $sheet->setCellValue('D5', 'LUWUK');
// $sheet->setCellValue('C6', 'Lintasan');
// $sheet->setCellValue('D6', $report['lintasanReport']);
// $sheet->setCellValue('G5', 'Tanggal');
// $sheet->setCellValue('H5', $report['tanggalAwalReport']);
// $sheet->setCellValue('G6', 'Kapal');
// $sheet->setCellValue('H6', $report['kapalReport']);
// $sheet->setCellValue('C7', 'No');
// $sheet->setCellValue('D7', 'Nama Produksi');
// $sheet->setCellValue('E7', $report['lintasanReport']);
// $sheet->setCellValue('E8', 'Produksi');
// $sheet->setCellValue('F8', 'Pendapatan');
// $sheet->setCellValue('G8', 'Asuransi');
// $sheet->setCellValue('H8', 'Total');
// $sheet->setCellValue('C9', 'I');
// $sheet->setCellValue('C17', 'II');
// $sheet->setCellValue('C31', 'III');
// $sheet->setCellValue('C35', 'IV');
// $sheet->setCellValue('D9', 'Penumpang');
// $sheet->setCellValue('D10', 'Eksekutif Dewasa');
// $sheet->setCellValue('D11', 'Eksekutif Anak');
// $sheet->setCellValue('D12', 'Bisnis Dewasa');
// $sheet->setCellValue('D13', 'Bisnis Anak');
// $sheet->setCellValue('D14', 'Ekonomi Dewasa');
// $sheet->setCellValue('D15', 'Ekonomi Anak');
// $sheet->setCellValue('D16', 'Sub Jumlah');
// $sheet->setCellValue('D17', 'Kendaraan');
// $sheet->setCellValue('D18', 'Golongan I');
// $sheet->setCellValue('D19', 'Golongan II');
// $sheet->setCellValue('D20', 'Golongan III');
// $sheet->setCellValue('D21', 'Golongan IV - Penumpang');
// $sheet->setCellValue('D22', 'Golongan IV - Barang');
// $sheet->setCellValue('D23', 'Golongan V - Penumpang');
// $sheet->setCellValue('D24', 'Golongan V - Barang');
// $sheet->setCellValue('D25', 'Golongan VI - Penumpang');
// $sheet->setCellValue('D26', 'Golongan VI - Barang');
// $sheet->setCellValue('D27', 'Golongan VII');
// $sheet->setCellValue('D28', 'Golongan VIII');
// $sheet->setCellValue('D29', 'Golongan IX');
// $sheet->setCellValue('D30', 'Sub Jumlah');
// $sheet->setCellValue('D31', 'Barang');
// $sheet->setCellValue('D32', 'Curah (Ton)/M3');
// $sheet->setCellValue('D33', 'Curah (M3)');
// $sheet->setCellValue('D34', 'Sub Jumlah');
// $sheet->setCellValue('D35', 'Suplesi');
// $sheet->setCellValue('D36', 'Ek. Ke Bisnis I DWS');
// $sheet->setCellValue('D37', 'Ek. Ke Bisnis I ANK');
// $sheet->setCellValue('D38', 'Ek. Ke Bisnis II DWS');
// $sheet->setCellValue('D39', 'Ek. Ke Bisnis II ANK');
// $sheet->setCellValue('D40', 'Sub Jumlah');
// $sheet->setCellValue('D41', 'Jumlah');
// $sheet->setCellValue('G43', 'Dibuat Oleh');
// $sheet->setCellValue('G47', 'Andi Mujahidin');


// for($col = 'A'; $col !== 'K'; $col++){
//     $sheet->getColumnDimension($col)->setAutoSize(true);
// }
// $sheet->getStyle('C35')->getAlignment()->setWrapText(true);

// $styleArray = [ 'borders' => [ 'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,], ]]; 
// $sheet->getStyle('C3:H41')->applyFromArray($styleArray);
// $styleArrayOutline = [ 'borders' => [ 'outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,], ]]; 
// $sheet->getStyle('C42:H48')->applyFromArray($styleArrayOutline);
// $sheet->getPageSetup()->setPrintArea('A1:J42',\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::SETPRINTRANGE_INSERT);
// // $sheet->setBreak('A1:J42',\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);

// print_r($entryData);
// $rowEntry = 8;
// while($record = mysqli_fetch_array($entryData))
// {
//     // Jumlah Produksi
//     $sheet->setCellValue('E10', $record['Jumlah DewasaEksekutif']);
//     $sheet->setCellValue('E11', $record['Jumlah BayiEksekutif']);
//     $sheet->setCellValue('E12', $record['Jumlah DewasaBisnis']);
//     $sheet->setCellValue('E13', $record['Jumlah BayiBisnis']);
//     $sheet->setCellValue('E14', $record['Jumlah DewasaEkonomi']);
//     $sheet->setCellValue('E15', $record['Jumlah BayiEkonomi']);
//     $sheet->setCellValue('E16', '=SUM(E10:E15)');
    
//     // // Pendapatan Pelayaran
//     $sheet->setCellValue('F10', $record['Dewasa Eksekutif']);
//     $sheet->setCellValue('F11', $record['Bayi Eksekutif']);
//     $sheet->setCellValue('F12', $record['Dewasa Bisnis']);
//     $sheet->setCellValue('F13', $record['Bayi Bisnis']);
//     $sheet->setCellValue('F14', $record['Dewasa Ekonomi']);
//     $sheet->setCellValue('F15', $record['Bayi Ekonomi']);
//     $sheet->setCellValue('F16', '=SUM(F10:F15)');
    
//     // // Pendapatan Asuransi
//     $sheet->setCellValue('G10', $record["DewasaEksekutifTJP"] * $record['Jumlah DewasaEksekutif']);
//     $sheet->setCellValue('G11', $record['BayiEksekutifTJP'] * $record['Jumlah BayiEksekutif']);
//     $sheet->setCellValue('G12', $record['DewasaBisnisTJP'] * $record['Jumlah DewasaBisnis']);
//     $sheet->setCellValue('G13', $record['BayiBisnisTJP'] * $record['Jumlah BayiBisnis']);
//     $sheet->setCellValue('G14', $record['DewasaEkonomiTJP'] * $record['Jumlah DewasaEkonomi'] );
//     $sheet->setCellValue('G15', $record['BayiEkonomiTJP'] * $record['Jumlah BayiEkonomi']);
//     $sheet->setCellValue('G16', '=SUM(G10:G15)');
    
//     // Total Penumpang
//     $sheet->setCellValue('H10', '=F10 + G10');
//     $sheet->setCellValue('H11', '=F11 + G11');
//     $sheet->setCellValue('H12', '=F12 + G12');
//     $sheet->setCellValue('H13', '=F13 + G13');
//     $sheet->setCellValue('H14', '=F14 + G14');
//     $sheet->setCellValue('H15', '=F15 + G15');
//     $sheet->setCellValue('H16', '=SUM(H10:H15)');

//     // Tarif Pelayaran
//     $sheet->setCellValue('F18', $record['Golongan ']);
//     $sheet->setCellValue('F19', $record['Golongan 2']);
//     $sheet->setCellValue('F20', $record['Golongan 3']);
//     $sheet->setCellValue('F21', $record['Golongan 4 Penumpang']);
//     $sheet->setCellValue('F22', $record['Golongan 4 Barang']);
//     $sheet->setCellValue('F23', $record['Golongan 5 Penumpang']);
//     $sheet->setCellValue('F24', $record['Golongan 5 Barang']);
//     $sheet->setCellValue('F25', $record['Golongan 6 Penumpang']);
//     $sheet->setCellValue('F26', $record['Golongan 6 Barang']);
//     $sheet->setCellValue('F27', $record['Golongan 7']);
//     $sheet->setCellValue('F28', $record['Golongan 8']);
//     $sheet->setCellValue('F29', $record['Golongan 9']);
//     $sheet->setCellValue('F30', '=SUM(F18:F29)');
    
//     // // Tarif Asuransi
//     // $sheet->setCellValue('D18', $record['Gol1TJP']);
//     // $sheet->setCellValue('D19', $record['Gol2TJP']);
//     // $sheet->setCellValue('D20', $record['Gol3TJP']);
//     // $sheet->setCellValue('D21', $record['Gol4 PenumpangTJP']);
//     // $sheet->setCellValue('D22', $record['Gol4BarTJP']);
//     // $sheet->setCellValue('D23', $record['Gol5PenTJP']);
//     // $sheet->setCellValue('D24', $record['Gol5BarTJP']);
//     // $sheet->setCellValue('D25', $record['Gol6PenTJP']);
//     // $sheet->setCellValue('D26', $record['Gol6BarTJP']);
//     // $sheet->setCellValue('D27', $record['Gol7TJP']);
//     // $sheet->setCellValue('D28', $record['Gol8TJP']);
//     // $sheet->setCellValue('D29', $record['Gol9TJP']);
 
//     // // Pendapatan Pelayaran
//     // $sheet->setCellValue('H18', '=C18 * G18');
//     // $sheet->setCellValue('H19', '=C19 * G19');
//     // $sheet->setCellValue('H20', '=C20 * G20');
//     // $sheet->setCellValue('H21', '=C21 * G21');
//     // $sheet->setCellValue('H22', '=C22 * G22');
//     // $sheet->setCellValue('H23', '=C23 * G23');
//     // $sheet->setCellValue('H24', '=C24 * G24');
//     // $sheet->setCellValue('H25', '=C25 * G25');
//     // $sheet->setCellValue('H26', '=C26 * G26');
//     // $sheet->setCellValue('H27', '=C27 * G27');
//     // $sheet->setCellValue('H28', '=C28 * G28');
//     // $sheet->setCellValue('H29', '=C29 * G29');
//     // $sheet->setCellValue('H30', '=SUM(H18:H29)');
    
//     // // Jumlah Produksi
//     $sheet->setCellValue('E18', $record['Jumlah Gol1']);
//     $sheet->setCellValue('E19', $record['Jumlah Gol2']);
//     $sheet->setCellValue('E20', $record['Jumlah Gol3']);
//     $sheet->setCellValue('E21', $record['Jumlah Gol4Pen']);
//     $sheet->setCellValue('E22', $record['Jumlah Gol4Bar']);
//     $sheet->setCellValue('E23', $record['Jumlah Gol5Pen']);
//     $sheet->setCellValue('E24', $record['Jumlah Gol5Bar']);
//     $sheet->setCellValue('E25', $record['Jumlah Gol6Pen']);
//     $sheet->setCellValue('E26', $record['Jumlah Gol6Bar']);
//     $sheet->setCellValue('E27', $record['Jumlah Gol7']);
//     $sheet->setCellValue('E28', $record['Jumlah Gol8']);
//     $sheet->setCellValue('E29', $record['Jumlah Gol9']);
//     $sheet->setCellValue('E30', '=SUM(E18:E29)');
    
//     // Pendapatan Asuransi
//     $sheet->setCellValue('G18', $record['Jumlah Gol1'] * $record['Gol1TJP']);
//     $sheet->setCellValue('G19', $record['Jumlah Gol2'] * $record['Gol2TJP']);
//     $sheet->setCellValue('G20', $record['Jumlah Gol3'] * $record['Gol3TJP']);
//     $sheet->setCellValue('G21', $record['Jumlah Gol4Pen'] * $record['Gol4PenTJP']);
//     $sheet->setCellValue('G22', $record['Jumlah Gol4Bar'] * $record['Gol4BarTJP']);
//     $sheet->setCellValue('G23', $record['Jumlah Gol5Pen'] * $record['Gol5PenTJP']);
//     $sheet->setCellValue('G24', $record['Jumlah Gol5Bar'] * $record['Gol5BarTJP']);
//     $sheet->setCellValue('G25', $record['Jumlah Gol6Pen'] * $record['Gol6PenTJP']);
//     $sheet->setCellValue('G26', $record['Jumlah Gol6Bar'] * $record['Gol6BarTJP']);
//     $sheet->setCellValue('G27', $record['Jumlah Gol7'] * $record['Gol7TJP']);
//     $sheet->setCellValue('G28', $record['Jumlah Gol8'] * $record['Go81TJP']);
//     $sheet->setCellValue('G29', $record['Jumlah Gol9'] * $record['Go91TJP']);
//     $sheet->setCellValue('G30', '=SUM(G18:G29)');
    
//     // Jumlah
//     $sheet->setCellValue('H18', '=F18 + G18');
//     $sheet->setCellValue('H19', '=F19 + G19');
//     $sheet->setCellValue('H20', '=F20 + G20');
//     $sheet->setCellValue('H21', '=F21 + G21');
//     $sheet->setCellValue('H22', '=F22 + G22');
//     $sheet->setCellValue('H23', '=F23 + G23');
//     $sheet->setCellValue('H24', '=F24 + G24');
//     $sheet->setCellValue('H25', '=F25 + G25');
//     $sheet->setCellValue('H26', '=F26 + G26');
//     $sheet->setCellValue('H27', '=F27 + G27');
//     $sheet->setCellValue('H28', '=F28 + G28');
//     $sheet->setCellValue('H29', '=F29 + G29');
//     $sheet->setCellValue('H30', '=SUM(H18:H29)');

//     // // Jumlah
//     // $sheet->setCellValue('G32', $record['Entry Barang Volume']);
    
//     // $Curah = 0;
//     // if($record['Entry Barang Volume'] != 0)
//     //     $record['BarangPendapatan']/$record['Entry Barang Volume'];

//     // //Pendapatan Pelayaran
//     // $sheet->setCellValue('H32', $Curah);    
//     // //Asuransi Pendapatan
//     // $sheet->setCellValue('I32', 0);
//     // //Jumlah Pendapatan
//     // $sheet->setCellValue('J32', $record['BarangPendapatan']);

//     // //Jumlah Barang
//     // $sheet->setCellValue('G33', '=G32');
//     // $sheet->setCellValue('H33', '=H32');
//     // $sheet->setCellValue('I33', '=I32');
//     // $sheet->setCellValue('J33', '=J32');
    
//     // //Jumlah Total
//     // $sheet->setCellValue('G34', '=G16 + G30 + G33');
//     // $sheet->setCellValue('H34', '=H16 + H30 + H33');
//     // $sheet->setCellValue('I34', '=I16 + I30 + I33');
//     // $sheet->setCellValue('J34', '=J16 + J30 + J33');
    
//     // $sheet->setCellValue('C35', strtoupper(terbilang($sheet->getCell('J34')->getCalculatedValue())));
// }


// // $sheet->getStyle('C10:J16')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_ACCOUNTING_EUR);
// // $sheet->getStyle('C18:J30')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_0);
// // $sheet->getStyle('C32:J34')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_0);

// // $foundInCells = array();
// // $searchValue = '$';

// // foreach ($sheet->getRowIterator() as $row) {
// //     $cellIterator = $row->getCellIterator();
// //     $cellIterator->setIterateOnlyExistingCells(true);
// //     foreach ($cellIterator as $cell) {
// //         if ($cell->getValue() == $searchValue) {
// //             $foundInCells[] = $ws . '!' . $cell->getCoordinate();
// //         }
// //     }
// // }

// $styleArray = array(
//     'allBorders' => array(
//         'outline' => array(
//             'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
//             'color' => array('argb' => 'FFFF0000'),
//         ),
//     ),
// );

// $sheet = $sheet->getStyle('A1:J45')->applyFromArray($styleArray);

// $writer = new Xlsx($spreadsheet);
// ob_end_clean();
// header('Content-Type: application/vnd.ms-excel');
// header('Content-Disposition: attachment; filename="'. urlencode($title." ".$report['lintasanReport']." ".$report['tanggalAwalReport'].".xlsx").'"');
// ob_end_clean();
// $writer->save('php://output');
// exit()
?>

<div class="card ">
    <div class="card-header d-flex justify-content-between align-items-center " id="headingOne" >
        
        <?php
        echo form_open(base_url('dashboard/report/downloadDailyReport'), ['class' => 'form-report','method' => 'POST', 'id' => 'form-report']);
            ?>
        <div class="form-group row">
            <div class="form-group col">
                <label for="nama_kapal" class="label-wrap  ml-2"> NAMA KAPAL </label>
                <div class="col">
                    <select class="form-control" name="nama_kapal" id="nama_kapal" required>
                        <option value="" disabled Selected>No Selected</option>
                        <?php foreach ($kapal as $row): ?>
                            <option value="<?php echo $row['kapal']; ?>">
                                <?php echo $row['kapal']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php
                    echo form_error('nama_kapal');
                    ?>
                </div>
            </div>            
            <!-- <div class="form-group col">
                <label for="trip" class="label-wrap  ml-2"> TRIP </label>
                <div class="col">
                    <select class="form-control" name="trip" id="trip" required>
                        <option value="" disabled Selected>No Selected</option>
                        <option value="REGULER">
                            REGULER
                        </option>
                        <option value="EXTRA TRIP">
                            EXTRA TRIP
                        </option>
                    </select>
                    <?php
                    echo form_error('trip');
                    ?>
                </div>
            </div> -->
            <div class="form-group col">
                <label for="pelabuhan_asal_report" class="label-wrap  ml-2"> PELABUHAN </label>
                <div class="col">
                    <select class="form-control" name="pelabuhan_asal_report" id="pelabuhan_asal_report" required>
                        <option value="" disabled Selected>No Selected</option>
                        <?php foreach ($pelabuhan as $row): ?>
                            <option value="<?php echo $row['pelabuhan']; ?>">
                                <?php echo $row['pelabuhan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php
                    echo form_error('pelabuhan_asal_report');
                    ?>
                </div>
            </div>

            <div class="form-group col">
                <label for="lintasan_report" class="label-wrap  ml-2"> LINTASAN </label>
                <div class="col">
                    <select class="form-control" name="lintasan_report" id="lintasan_report" required>
                        <option value="" disabled Selected>No Selected</option>
                        <?php foreach ($lintasan as $row): ?>
                            <option value="<?php echo $row['lintasan']; ?>">
                                <?php echo $row['lintasan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php
                    echo form_error('lintasan_report');
                    ?>
                </div>
            </div>
            <div class="form-group col">
                <label for="tanggal_awal" class="label-wrap  ml-2"> TANGGAL AWAL </label>
                
                <div class="col">
                    <input class="form-control" type="date" id="tanggal_awal" name="tanggal_awal" value="2022-11-01"
                    min="2022-11-01" max="2023-12-31">
                </div>
            </div>
            <!-- <div class="form-group col">
                <label for="tanggal_akhir" class="label-wrap  ml-2"> TANGGAL AKHIR </label>
                
                <div class="col">
                    <input class="form-control" type="date" id="tanggal_akhir" name="tanggal_akhir" value="2022-11-01"
                    min="2022-11-01" max="2023-12-31">
                </div>
            </div> -->

            <div class="form-group col">
                <label for="trip" class="label-wrap  ml-2" style="display:inline-block;">&#8203;  </label>
            <div class="col">
                <?php
            echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block' ], 'Download');
            echo form_close();
            ?>
            </div>

            </div>
        </div>
    </div>
</div>
