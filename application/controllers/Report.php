<?php
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Report extends CI_Controller
{

    public $employee;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->employee = $this->Report_model->employee();
    }
    public function index()
    {
        $data['title'] = 'Export Report';
        $data['contentView'] = 'report/report';
        $data['tarif'] = $this->Master_model->rate();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Master_model->lintasan();
        $data['pelabuhan'] = $this->Master_model->pelabuhan();
        $data['kapal'] = $this->Master_model->kapal_spv();
        $data['tarif'] = $this->Master_model->tarif();

        $this->load->view('template/dashboard/body', $data);
    }
    
    public function buktiPenyetoran(){
        
        $data['title'] = 'Bukti Penyetoran';
        $data['contentView'] = 'report/buktiPenyetoran';
        
        $data['tarif'] = $this->Master_model->rate();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Master_model->lintasan();
        $data['pelabuhan'] = $this->Master_model->pelabuhan();
        $data['kapal'] = $this->Master_model->kapal_spv();
        $data['tarif'] = $this->Master_model->tarif();



        $this->load->view('template/dashboard/body', $data);
        // redirect(base_url('dashboard/report'));
    }

    public function downloadBuktiPenyetoran(){
    $koneksi = mysqli_connect("217.21.72.151","u1578336_admin","5september_","u1578336_db_recons_luwuk");

    $title = 'Bukti Penyetoran';
    $kapalReport = $this->input->post('nama_kapal');
    $tripReport = $this->input->post('trip');
    $pelabuhanReport = $this->input->post('pelabuhan_asal_report');
    $lintasanReport = $this->input->post('lintasan_report');
    $tanggalAwalReport = $this->input->post('tanggal_awal');
    $jamReport = $this->input->post('jam');
    $supervisor = $this->Report_model->supervisorName();



    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $entryData = mysqli_query($koneksi,"
        SELECT *,dayname(date), 
        entry_data.DewasaEksekutif AS 'Jumlah DewasaEksekutif', entry_data.BayiEksekutif  AS 'Jumlah BayiEksekutif', entry_data.DewasaBisnis AS 'Jumlah DewasaBisnis', entry_data.BayiBisnis AS 'Jumlah BayiBisnis', entry_data.DewasaEkonomi AS 'Jumlah DewasaEkonomi', entry_data.BayiEkonomi AS 'Jumlah BayiEkonomi',
        entry_data.Gol1 as 'Jumlah Gol1', entry_data.Gol2 as 'Jumlah Gol2', entry_data.Gol3 as 'Jumlah Gol3', entry_data.Gol4Pen as 'Jumlah Gol4Pen', entry_data.Gol4Bar as 'Jumlah Gol4Bar', entry_data.Gol5Pen as 'Jumlah Gol5Pen',entry_data.Gol5Bar as 'Jumlah Gol5Bar',entry_data.Gol6Pen as 'Jumlah Gol6Pen',entry_data.Gol6Bar as 'Jumlah Gol6Bar',entry_data.Gol7 as 'Jumlah Gol7',entry_data.Gol8 as 'Jumlah Gol8',entry_data.Gol9 as 'Jumlah Gol9', 
        (rate.DewasaEksekutif * entry_data.DewasaEksekutif) as 'Dewasa Eksekutif',
        (rate.BayiEksekutif * entry_data.BayiEksekutif) as 'Bayi Eksekutif',
        (rate.DewasaBisnis * entry_data.DewasaBisnis) as 'Dewasa Bisnis',
        (rate.BayiBisnis * entry_data.BayiBisnis) as 'Bayi Bisnis',
        (rate.DewasaEkonomi * entry_data.DewasaEkonomi) as 'Dewasa Ekonomi',
        (rate.BayiEkonomi * entry_data.BayiEkonomi) as 'Bayi Ekonomi',
        (rate.Gol1 * entry_data.Gol1) as 'Golongan 1',
        (rate.Gol2 * entry_data.Gol2) as 'Golongan 2',
        (rate.Gol3 * entry_data.Gol3) as 'Golongan 3',
        (rate.Gol4Pen * entry_data.Gol4Pen) as 'Golongan 4 Penumpang',
        (rate.Gol4Bar * entry_data.Gol4Bar) as 'Golongan 4 Barang',
        (rate.Gol5Pen * entry_data.Gol5Pen) as 'Golongan 5 Penumpang',
        (rate.Gol5Bar * entry_data.Gol5Bar) as 'Golongan 5 Barang',
        (rate.Gol6Pen * entry_data.Gol6Pen) as 'Golongan 6 Penumpang',
        (rate.Gol6Bar * entry_data.Gol6Bar) as 'Golongan 6 Barang',
        (rate.Gol7 * entry_data.Gol7) as 'Golongan 7',
        (rate.Gol8 * entry_data.Gol8) as 'Golongan 8',
        (rate.Gol9 * entry_data.Gol9) as 'Golongan 9',
        entry_data.BarangVolume as 'Entry Barang Volume'
        FROM entry_data
        JOIN ferry ON ferry.id = entry_data.id_ferry
        JOIN routes ON routes.id = entry_data.id_route
        JOIN harbours on harbours.id_harbours = entry_data.id_harbour
        JOIN rate ON rate.id_route = routes.id and entry_data.date >= rate.start_date and rate.rate_type = entry_data.rate_type
        WHERE date='{$tanggalAwalReport}' and ferry = '{$kapalReport}' and route = '{$lintasanReport}'
    ");

    // sheet peratama
    $sheet->setTitle($title);
    $sheet->mergeCells('A1:J1')->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('A2:D2')->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
    $sheet->mergeCells('A3:D3')->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
    $sheet->mergeCells('A4:D4')->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
    $sheet->mergeCells('A5:D5')->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
    $sheet->mergeCells('A6:D6')->getStyle('A6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
    $sheet->mergeCells('E2:J2')->getStyle('E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    $sheet->mergeCells('E3:J3')->getStyle('E3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    $sheet->mergeCells('E4:J4')->getStyle('E4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    $sheet->mergeCells('E5:J5')->getStyle('E5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    $sheet->mergeCells('E6:J6')->getStyle('E6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    $sheet->mergeCells('A7:A8')->getStyle('A7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet->mergeCells('B7:B8')->getStyle('B7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet->mergeCells('C7:D7')->getStyle('C7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('E7:F7')->getStyle('E7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('G7:G8')->getStyle('G7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet->mergeCells('J7:J8')->getStyle('J7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet->mergeCells('H7:I7')->getStyle('H7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('B9:J9')->getStyle('B9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('B17:J17')->getStyle('B17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('B31:J31')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('C16:F16')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('C30:F30')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('C33:F33')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('C34:F34')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('C35:J35')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->mergeCells('A9:A16')->getStyle('A9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('A17:A30')->getStyle('A17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('A31:A34')->getStyle('A31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('B38:B40')->getStyle('B38')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('E38:E40')->getStyle('E38')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('I38:I40')->getStyle('I38')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->setCellValue('A1', $title);
    $sheet->setCellValue('A2', 'Hari');
    $sheet->setCellValue('A3', 'Tanggal');
    $sheet->setCellValue('A4', 'Pelabuhan');
    $sheet->setCellValue('A5', 'Lintas');
    $sheet->setCellValue('A6', 'Jam Pemberangkatan');
    $sheet->setCellValue('E2', getHari($tanggalAwalReport));
    $sheet->setCellValue('E3', $tanggalAwalReport);
    $sheet->setCellValue('E4', $pelabuhanReport);
    $sheet->setCellValue('E5', $lintasanReport);
    $sheet->setCellValue('C7', 'Tarif');
    $sheet->setCellValue('E7', 'Nomor Seri Terjual');
    $sheet->setCellValue('H7', 'Pendapatan');
    $sheet->setCellValue('A7', 'No');
    $sheet->setCellValue('B7', 'Jenis Tiket');
    $sheet->setCellValue('C8', 'Pelayaran');
    $sheet->setCellValue('D8', 'Asuransi');
    $sheet->setCellValue('E8', 'Awal');
    $sheet->setCellValue('F8', 'Akhir');
    $sheet->setCellValue('G7', 'Jumlah');
    $sheet->setCellValue('H8', 'Pelayaran');
    $sheet->setCellValue('I8', 'Asuransi');
    $sheet->setCellValue('J7', 'Jumlah');
    $sheet->setCellValue('A9', 'I');
    $sheet->setCellValue('B9', 'Tiket Penumpang');
    $sheet->setCellValue('B10', 'Dewasa Eksekutif');
    $sheet->setCellValue('B11', 'Anak Eksekutif');
    $sheet->setCellValue('B12', 'Dewasa Bisnis');
    $sheet->setCellValue('B13', 'Anak Bisnis');
    $sheet->setCellValue('B14', 'Dewasa Ekonomi');
    $sheet->setCellValue('B15', 'Anak Ekonomi');
    $sheet->setCellValue('B16', 'Jumlah Penumpang');

    $sheet->setCellValue('A17', 'II');
    $sheet->setCellValue('B17', 'Tiket Kendaraan');
    $sheet->setCellValue('B18', 'Golongan I');
    $sheet->setCellValue('B19', 'Golongan II');
    $sheet->setCellValue('B20', 'Golongan III');
    $sheet->setCellValue('B21', 'Golongan IV Penumpang');
    $sheet->setCellValue('B22', 'Golongan IV Barang');
    $sheet->setCellValue('B23', 'Golongan V Penumpang');
    $sheet->setCellValue('B24', 'Golongan V Barang');
    $sheet->setCellValue('B25', 'Golongan VI Penumpang');
    $sheet->setCellValue('B26', 'Golongan VI Barang');
    $sheet->setCellValue('B27', 'Golongan VII');
    $sheet->setCellValue('B28', 'Golongan VIII');
    $sheet->setCellValue('B29', 'Golongan IX');
    $sheet->setCellValue('B30', 'Jumlah Kendaraan');

    $sheet->setCellValue('A31', 'III');
    $sheet->setCellValue('B31', 'Barang');
    $sheet->setCellValue('B32', 'Barang Curah');
    $sheet->setCellValue('B33', 'Jumlah Barang');
    $sheet->setCellValue('B34', 'Jumlah');
    $sheet->setCellValue('B35', 'Terbilang');
    foreach($this->employee as $row){
        if($row['position'] == "MANAGER USAHA"){
            $sheet->setCellValue('B37', 'MANAGER USAHA');
            $sheet->setCellValue('B41', $row['name']);
            $sheet->setCellValue('B42', 'NIK '.$row['id_num']);
        }
        if($row['position'] == "KASIR"){
            $sheet->setCellValue('E37', 'KASIR');
            $sheet->setCellValue('E41', $row['name']);
            $sheet->setCellValue('E42', 'NIK '.$row['id_num']);
        }
    }
    foreach($supervisor as $row){
        $sheet->setCellValue('I37', $row['position']);
        $sheet->setCellValue('I41', $row['name']);
        $sheet->setCellValue('I42', 'NIK '.$row['id_num']);
    }


    for($col = 'A'; $col !== 'K'; $col++){
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    $sheet->getStyle('C35')->getAlignment()->setWrapText(true);

    $styleArray = [ 'borders' => [ 'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,], ]]; 
    $sheet->getStyle('A1:J35')->applyFromArray($styleArray);
    $styleArrayOutline = [ 'borders' => [ 'outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,], ]]; 
    $sheet->getStyle('A36:J45')->applyFromArray($styleArrayOutline);
    $sheet->getPageSetup()->setPrintArea('A1:J42',\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::SETPRINTRANGE_INSERT);
    // $sheet->setBreak('A1:J42',\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);


    while($record = mysqli_fetch_array($entryData))
    {
        if(!$record['time']){
            $sheet->setCellValue('E6', $jamReport);
        } else {
            $sheet->setCellValue('E6', $record['time']);
        }

        // Tarif Pelayaran
        $sheet->setCellValue('C10', $record['DewasaEksekutif']);
        $sheet->setCellValue('C11', $record['BayiEksekutif']);
        $sheet->setCellValue('C12', $record['DewasaBisnis']);
        $sheet->setCellValue('C13', $record['BayiBisnis']);
        $sheet->setCellValue('C14', $record['DewasaEkonomi']);
        $sheet->setCellValue('C15', $record['BayiEkonomi']);
        
        // Tarif Asuransi
        $sheet->setCellValue('D10', $record['DewasaEksekutifTJP']);
        $sheet->setCellValue('D11', $record['BayiEksekutifTJP']);
        $sheet->setCellValue('D12', $record['DewasaBisnisTJP']);
        $sheet->setCellValue('D13', $record['BayiBisnisTJP']);
        $sheet->setCellValue('D14', $record['DewasaEkonomiTJP']);
        $sheet->setCellValue('D15', $record['BayiEkonomiTJP']);
    
        // Jumlah
        $sheet->setCellValue('G10', $record['Jumlah DewasaEksekutif']);
        $sheet->setCellValue('G11', $record['Jumlah BayiEksekutif']);
        $sheet->setCellValue('G12', $record['Jumlah DewasaBisnis']);
        $sheet->setCellValue('G13', $record['Jumlah BayiBisnis']);
        $sheet->setCellValue('G14', $record['Jumlah DewasaEkonomi']);
        $sheet->setCellValue('G15', $record['Jumlah BayiEkonomi']);
        $sheet->setCellValue('G16', '=SUM(G10:G15)');
        
        // Pendapatan Pelayaran
        $sheet->setCellValue('H10', $record['Dewasa Eksekutif']);
        $sheet->setCellValue('H11', $record['Bayi Eksekutif']);
        $sheet->setCellValue('H12', $record['Dewasa Bisnis']);
        $sheet->setCellValue('H13', $record['Bayi Bisnis']);
        $sheet->setCellValue('H14', $record['Dewasa Ekonomi']);
        $sheet->setCellValue('H15', $record['Bayi Ekonomi']);
        $sheet->setCellValue('H16', '=SUM(H10:H15)');
        
        // Pendapatan Asuransi
        $sheet->setCellValue('I10', '=D10 * G10');
        $sheet->setCellValue('I11', '=D11 * G11');
        $sheet->setCellValue('I12', '=D12 * G12');
        $sheet->setCellValue('I13', '=D13 * G13');
        $sheet->setCellValue('I14', '=D14 * G14');
        $sheet->setCellValue('I15', '=D15 * G15');
        $sheet->setCellValue('I16', '=SUM(I10:I15)');
        
        // Jumlah
        $sheet->setCellValue('J10', '=H10 + I10');
        $sheet->setCellValue('J11', '=H11 + I11');
        $sheet->setCellValue('J12', '=H12 + I12');
        $sheet->setCellValue('J13', '=H13 + I13');
        $sheet->setCellValue('J14', '=H14 + I14');
        $sheet->setCellValue('J15', '=H15 + I15');
        $sheet->setCellValue('J16', '=SUM(J10:J15)');

        // Tarif Pelayaran
        $sheet->setCellValue('C18', $record['Gol1']);
        $sheet->setCellValue('C19', $record['Gol2']);
        $sheet->setCellValue('C20', $record['Gol3']);
        $sheet->setCellValue('C21', $record['Gol4Pen']);
        $sheet->setCellValue('C22', $record['Gol4Bar']);
        $sheet->setCellValue('C23', $record['Gol5Pen']);
        $sheet->setCellValue('C24', $record['Gol5Bar']);
        $sheet->setCellValue('C25', $record['Gol6Pen']);
        $sheet->setCellValue('C26', $record['Gol6Bar']);
        $sheet->setCellValue('C27', $record['Gol7']);
        $sheet->setCellValue('C28', $record['Gol8']);
        $sheet->setCellValue('C29', $record['Gol9']);
        
        // Tarif Asuransi
        $sheet->setCellValue('D18', $record['Gol1TJP']);
        $sheet->setCellValue('D19', $record['Gol2TJP']);
        $sheet->setCellValue('D20', $record['Gol3TJP']);
        $sheet->setCellValue('D21', $record['Gol4PenTJP']);
        $sheet->setCellValue('D22', $record['Gol4BarTJP']);
        $sheet->setCellValue('D23', $record['Gol5PenTJP']);
        $sheet->setCellValue('D24', $record['Gol5BarTJP']);
        $sheet->setCellValue('D25', $record['Gol6PenTJP']);
        $sheet->setCellValue('D26', $record['Gol6BarTJP']);
        $sheet->setCellValue('D27', $record['Gol7TJP']);
        $sheet->setCellValue('D28', $record['Gol8TJP']);
        $sheet->setCellValue('D29', $record['Gol9TJP']);
    
        // Pendapatan Pelayaran
        $sheet->setCellValue('H18', '=C18 * G18');
        $sheet->setCellValue('H19', '=C19 * G19');
        $sheet->setCellValue('H20', '=C20 * G20');
        $sheet->setCellValue('H21', '=C21 * G21');
        $sheet->setCellValue('H22', '=C22 * G22');
        $sheet->setCellValue('H23', '=C23 * G23');
        $sheet->setCellValue('H24', '=C24 * G24');
        $sheet->setCellValue('H25', '=C25 * G25');
        $sheet->setCellValue('H26', '=C26 * G26');
        $sheet->setCellValue('H27', '=C27 * G27');
        $sheet->setCellValue('H28', '=C28 * G28');
        $sheet->setCellValue('H29', '=C29 * G29');
        $sheet->setCellValue('H30', '=SUM(H18:H29)');
        
        // Jumlah
        $sheet->setCellValue('G18', $record['Jumlah Gol1']);
        $sheet->setCellValue('G19', $record['Jumlah Gol2']);
        $sheet->setCellValue('G20', $record['Jumlah Gol3']);
        $sheet->setCellValue('G21', $record['Jumlah Gol4Pen']);
        $sheet->setCellValue('G22', $record['Jumlah Gol4Bar']);
        $sheet->setCellValue('G23', $record['Jumlah Gol5Pen']);
        $sheet->setCellValue('G24', $record['Jumlah Gol5Bar']);
        $sheet->setCellValue('G25', $record['Jumlah Gol6Pen']);
        $sheet->setCellValue('G26', $record['Jumlah Gol6Bar']);
        $sheet->setCellValue('G27', $record['Jumlah Gol7']);
        $sheet->setCellValue('G28', $record['Jumlah Gol8']);
        $sheet->setCellValue('G29', $record['Jumlah Gol9']);
        $sheet->setCellValue('G30', '=SUM(G18:G29)');
        
        // Pendapatan Asuransi
        $sheet->setCellValue('I18', '=D18 * G18');
        $sheet->setCellValue('I19', '=D19 * G19');
        $sheet->setCellValue('I20', '=D20 * G20');
        $sheet->setCellValue('I21', '=D21 * G21');
        $sheet->setCellValue('I22', '=D22 * G22');
        $sheet->setCellValue('I23', '=D23 * G23');
        $sheet->setCellValue('I24', '=D24 * G24');
        $sheet->setCellValue('I25', '=D25 * G25');
        $sheet->setCellValue('I26', '=D26 * G26');
        $sheet->setCellValue('I27', '=D27 * G27');
        $sheet->setCellValue('I28', '=D28 * G28');
        $sheet->setCellValue('I29', '=D29 * G29');
        $sheet->setCellValue('I30', '=SUM(I18:I29)');
        
        // Jumlah
        $sheet->setCellValue('J18', '=H18 + I18');
        $sheet->setCellValue('J19', '=H19 + I19');
        $sheet->setCellValue('J20', '=H20 + I20');
        $sheet->setCellValue('J21', '=H21 + I21');
        $sheet->setCellValue('J22', '=H22 + I22');
        $sheet->setCellValue('J23', '=H23 + I23');
        $sheet->setCellValue('J24', '=H24 + I24');
        $sheet->setCellValue('J25', '=H25 + I25');
        $sheet->setCellValue('J26', '=H26 + I26');
        $sheet->setCellValue('J27', '=H27 + I27');
        $sheet->setCellValue('J28', '=H28 + I28');
        $sheet->setCellValue('J29', '=H29 + I29');
        $sheet->setCellValue('J30', '=SUM(J18:J29)');

        // Jumlah
        $sheet->setCellValue('G32', $record['Entry Barang Volume']);
        
        $Curah = 0;
        if($record['Entry Barang Volume'] != 0)
            $record['BarangPendapatan']/$record['Entry Barang Volume'];

        //Pendapatan Pelayaran
        $sheet->setCellValue('H32', $Curah);    
        //Asuransi Pendapatan
        $sheet->setCellValue('I32', 0);
        //Jumlah Pendapatan
        $sheet->setCellValue('J32', $record['BarangPendapatan']);

        //Jumlah Barang
        $sheet->setCellValue('G33', '=G32');
        $sheet->setCellValue('H33', '=H32');
        $sheet->setCellValue('I33', '=I32');
        $sheet->setCellValue('J33', '=J32');
        
        //Jumlah Total
        $sheet->setCellValue('G34', '=G16 + G30 + G33');
        $sheet->setCellValue('H34', '=H16 + H30 + H33');
        $sheet->setCellValue('I34', '=I16 + I30 + I33');
        $sheet->setCellValue('J34', '=J16 + J30 + J33');
        
        $sheet->setCellValue('C35', strtoupper(terbilang($sheet->getCell('J34')->getCalculatedValue())));
    }


    // $sheet->getStyle('C10:J16')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_ACCOUNTING_EUR);
    // $sheet->getStyle('C18:J30')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_0);
    // $sheet->getStyle('C32:J34')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_0);

    $styleArray = array(
        'allBorders' => array(
            'outline' => array(
                'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => array('argb' => 'FFFF0000'),
            ),
        ),
    );

    $sheet = $sheet->getStyle('A1:J45')->applyFromArray($styleArray);
    
    
    $writer = new Xlsx($spreadsheet);
    ob_start();
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="'. urlencode($title." ".$lintasanReport." ".$tanggalAwalReport.".xlsx").'"');
    ob_end_clean();
    $writer->save('php://output');
    exit();
    }
    
    public function dailyReport (){
        $data['title'] = 'Laporan Pendapatan Harian';
        $data['contentView'] = 'report/dailyReport';
        
        $data['tarif'] = $this->Master_model->rate();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Master_model->lintasan();
        $data['pelabuhan'] = $this->Master_model->pelabuhan();
        $data['kapal'] = $this->Master_model->kapal_spv();
        $data['tarif'] = $this->Master_model->tarif();
        
        $this->load->view('template/dashboard/body', $data);
        // redirect('index');

    }

    public function downloadDailyReport(){

        // koneksi php dan mysql
        // $koneksi = mysqli_connect("localhost","root","","asdp_luwuk");
        $koneksi = mysqli_connect("217.21.72.151","u1578336_admin","5september_","u1578336_db_recons_luwuk");

        $title = 'Laporan Pendapatan Harian';
        $kapalReport = $this->input->post('nama_kapal');
        $lintasanReport = $this->input->post('lintasan_report');
        $tanggalAwalReport = $this->input->post('tanggal_awal');
        $supervisor = $this->Report_model->supervisorName();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $entryData = mysqli_query($koneksi,"
            SELECT *,dayname(date), 
            entry_data.DewasaEksekutif AS 'Jumlah DewasaEksekutif', entry_data.BayiEksekutif  AS 'Jumlah BayiEksekutif', entry_data.DewasaBisnis AS 'Jumlah DewasaBisnis', entry_data.BayiBisnis AS 'Jumlah BayiBisnis', entry_data.DewasaEkonomi AS 'Jumlah DewasaEkonomi', entry_data.BayiEkonomi AS 'Jumlah BayiEkonomi', entry_data.BarangVolume AS 'Jumlah BarangVolume', entry_data.BarangPendapatan AS 'Jumlah BarangPendapatan',
            entry_data.Gol1 as 'Jumlah Gol1', entry_data.Gol2 as 'Jumlah Gol2', entry_data.Gol3 as 'Jumlah Gol3', entry_data.Gol4Pen as 'Jumlah Gol4Pen', entry_data.Gol4Bar as 'Jumlah Gol4Bar', entry_data.Gol5Pen as 'Jumlah Gol5Pen',entry_data.Gol5Bar as 'Jumlah Gol5Bar',entry_data.Gol6Pen as 'Jumlah Gol6Pen',entry_data.Gol6Bar as 'Jumlah Gol6Bar',entry_data.Gol7 as 'Jumlah Gol7',entry_data.Gol8 as 'Jumlah Gol8',entry_data.Gol9 as 'Jumlah Gol9',
            entry_data.Suplesi1Dewasa as 'Jumlah Suplesi1Dewasa', entry_data.Suplesi2Dewasa as 'Jumlah Suplesi2Dewasa', entry_data.Suplesi1Anak as 'Jumlah Suplesi1Anak', entry_data.Suplesi2Anak as 'Jumlah Suplesi2Anak',
            (rate.DewasaEksekutif * entry_data.DewasaEksekutif) as 'Dewasa Eksekutif',
            (rate.BayiEksekutif * entry_data.BayiEksekutif) as 'Bayi Eksekutif',
            (rate.DewasaBisnis * entry_data.DewasaBisnis) as 'Dewasa Bisnis',
            (rate.BayiBisnis * entry_data.BayiBisnis) as 'Bayi Bisnis',
            (rate.DewasaEkonomi * entry_data.DewasaEkonomi) as 'Dewasa Ekonomi',
            (rate.BayiEkonomi * entry_data.BayiEkonomi) as 'Bayi Ekonomi',
            (rate.Gol1 * entry_data.Gol1) as 'Golongan 1',
            (rate.Gol2 * entry_data.Gol2) as 'Golongan 2',
            (rate.Gol3 * entry_data.Gol3) as 'Golongan 3',
            (rate.Gol4Pen * entry_data.Gol4Pen) as 'Golongan 4 Penumpang',
            (rate.Gol4Bar * entry_data.Gol4Bar) as 'Golongan 4 Barang',
            (rate.Gol5Pen * entry_data.Gol5Pen) as 'Golongan 5 Penumpang',
            (rate.Gol5Bar * entry_data.Gol5Bar) as 'Golongan 5 Barang',
            (rate.Gol6Pen * entry_data.Gol6Pen) as 'Golongan 6 Penumpang',
            (rate.Gol6Bar * entry_data.Gol6Bar) as 'Golongan 6 Barang',
            (rate.Gol7 * entry_data.Gol7) as 'Golongan 7',
            (rate.Gol8 * entry_data.Gol8) as 'Golongan 8',
            (rate.Gol9 * entry_data.Gol9) as 'Golongan 9',
            entry_data.BarangPendapatan as 'Barang Pendapatan',
            entry_data.BarangVolume as 'Entry Barang Volume',
            (rate.Suplesi1Dewasa * entry_data.Suplesi1Dewasa) as 'Suplesi1 Dewasa',
            (rate.Suplesi1Anak * entry_data.Suplesi1Anak) as 'Suplesi1 Anak',
            (rate.Suplesi2Dewasa * entry_data.Suplesi2Dewasa) as 'Suplesi2 Dewasa',
            (rate.Suplesi2Anak * entry_data.Suplesi2Anak) as 'Suplesi2 Anak'
            FROM entry_data
            JOIN ferry ON ferry.id = entry_data.id_ferry
            JOIN routes ON routes.id = entry_data.id_route
            JOIN harbours on harbours.id_harbours = entry_data.id_harbour
            JOIN rate ON rate.id_route = routes.id and entry_data.date >= rate.start_date and rate.rate_type = entry_data.rate_type
            WHERE date='{$tanggalAwalReport}' and ferry = '{$kapalReport}' and route = '{$lintasanReport}'
        ");

        // sheet peratama
        $sheet->setTitle($title);
        $sheet->mergeCells('C3:H4')->getStyle('C3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C3:H4')->getStyle('C3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('D5:F5')->getStyle('D5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->mergeCells('D6:F6')->getStyle('D6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->mergeCells('C7:C8')->getStyle('C7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C7:C8')->getStyle('C7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('D7:D8')->getStyle('D7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('D7:D8')->getStyle('D7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('E7:H7')->getStyle('E7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C9:C16')->getStyle('C9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C9:C16')->getStyle('C9')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('C17:C30')->getStyle('C17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C17:C30')->getStyle('C17')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('C31:C34')->getStyle('C31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C31:C34')->getStyle('C31')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('C35:C40')->getStyle('C35')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C35:C40')->getStyle('C35')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('C3', $title);
        $sheet->getStyle('C3')->getFont()->setBold(true);
        $sheet->setCellValue('C5', 'Cabang')->getStyle('C5')->getFont()->setBold(true);
        $sheet->setCellValue('D5', 'LUWUK');
        $sheet->setCellValue('C6', 'Lintasan')->getStyle('C6')->getFont()->setBold(true);
        $sheet->setCellValue('D6', $lintasanReport);
        $sheet->setCellValue('G5', 'Tanggal')->getStyle('G5')->getFont()->setBold(true);
        $sheet->setCellValue('H5', $tanggalAwalReport);
        $sheet->setCellValue('G6', 'Kapal')->getStyle('G6')->getFont()->setBold(true);
        $sheet->setCellValue('H6', $kapalReport);
        $sheet->setCellValue('C7', 'No')->getStyle('C7')->getFont()->setBold(true);
        $sheet->setCellValue('D7', 'Nama Produksi')->getStyle('D7')->getFont()->setBold(true);
        $sheet->setCellValue('E7', $lintasanReport)->getStyle('E7')->getFont()->setBold(true);
        $sheet->setCellValue('E8', 'Produksi')->getStyle('E8')->getFont()->setBold(true);
        $sheet->setCellValue('F8', 'Pendapatan')->getStyle('F8')->getFont()->setBold(true);
        $sheet->setCellValue('G8', 'Asuransi')->getStyle('G8')->getFont()->setBold(true);
        $sheet->setCellValue('H8', 'Total')->getStyle('H8')->getFont()->setBold(true);
        $sheet->setCellValue('C9', 'I')->getStyle('C9')->getFont()->setBold(true);
        $sheet->setCellValue('C17', 'II')->getStyle('C17')->getFont()->setBold(true);
        $sheet->setCellValue('C31', 'III')->getStyle('C31')->getFont()->setBold(true);
        $sheet->setCellValue('C35', 'IV')->getStyle('C35')->getFont()->setBold(true);
        $sheet->setCellValue('D9', 'Penumpang')->getStyle('D9')->getFont()->setBold(true);
        $sheet->setCellValue('D10', 'Eksekutif Dewasa');
        $sheet->setCellValue('D11', 'Eksekutif Anak');
        $sheet->setCellValue('D12', 'Bisnis Dewasa');
        $sheet->setCellValue('D13', 'Bisnis Anak');
        $sheet->setCellValue('D14', 'Ekonomi Dewasa');
        $sheet->setCellValue('D15', 'Ekonomi Anak');
        $sheet->setCellValue('D16', 'Sub Jumlah');
        $sheet->setCellValue('D17', 'Kendaraan')->getStyle('D17')->getFont()->setBold(true);
        $sheet->setCellValue('D18', 'Golongan I');
        $sheet->setCellValue('D19', 'Golongan II');
        $sheet->setCellValue('D20', 'Golongan III');
        $sheet->setCellValue('D21', 'Golongan IV - Penumpang');
        $sheet->setCellValue('D22', 'Golongan IV - Barang');
        $sheet->setCellValue('D23', 'Golongan V - Penumpang');
        $sheet->setCellValue('D24', 'Golongan V - Barang');
        $sheet->setCellValue('D25', 'Golongan VI - Penumpang');
        $sheet->setCellValue('D26', 'Golongan VI - Barang');
        $sheet->setCellValue('D27', 'Golongan VII');
        $sheet->setCellValue('D28', 'Golongan VIII');
        $sheet->setCellValue('D29', 'Golongan IX');
        $sheet->setCellValue('D30', 'Sub Jumlah')->getStyle('D30')->getFont()->setBold(true);
        $sheet->setCellValue('D31', 'Barang')->getStyle('D31')->getFont()->setBold(true);
        $sheet->setCellValue('D32', 'Curah (Ton)/M3');
        $sheet->setCellValue('D33', 'Curah (M3)');
        $sheet->setCellValue('D34', 'Sub Jumlah')->getStyle('D34')->getFont()->setBold(true);
        $sheet->setCellValue('D35', 'Suplesi')->getStyle('D35')->getFont()->setBold(true);
        $sheet->setCellValue('D36', 'Ek. Ke Bisnis I DWS');
        $sheet->setCellValue('D37', 'Ek. Ke Bisnis I ANK');
        $sheet->setCellValue('D38', 'Ek. Ke Bisnis II DWS');
        $sheet->setCellValue('D39', 'Ek. Ke Bisnis II ANK');
        $sheet->setCellValue('D40', 'Sub Jumlah')->getStyle('D40')->getFont()->setBold(true);
        $sheet->setCellValue('D41', 'Jumlah')->getStyle('D41')->getFont()->setBold(true);
        $sheet->setCellValue('G43', 'Dibuat Oleh')->getStyle('G43')->getFont()->setBold(true);
        foreach($supervisor as $row){
            $sheet->setCellValue('G47', $row['name'])->getStyle('G47')->getFont()->setBold(true);
        }


        for($col = 'A'; $col !== 'K'; $col++){
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet->getStyle('C35')->getAlignment()->setWrapText(true);

        $styleArray = [ 'borders' => [ 'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,], ]]; 
        $sheet->getStyle('C3:H41')->applyFromArray($styleArray);
        $styleArrayOutline = [ 'borders' => [ 'outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,], ]]; 
        $sheet->getStyle('C42:H48')->applyFromArray($styleArrayOutline);
        $sheet->getPageSetup()->setPrintArea('A1:J42',\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::SETPRINTRANGE_INSERT);
        // $sheet->setBreak('A1:J42',\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);

        $rowEntry = 8;
        while($record = mysqli_fetch_array($entryData))
        {
            // Jumlah Produksi
            $sheet->setCellValue('E10', $record['Jumlah DewasaEksekutif']);
            $sheet->setCellValue('E11', $record['Jumlah BayiEksekutif']);
            $sheet->setCellValue('E12', $record['Jumlah DewasaBisnis']);
            $sheet->setCellValue('E13', $record['Jumlah BayiBisnis']);
            $sheet->setCellValue('E14', $record['Jumlah DewasaEkonomi']);
            $sheet->setCellValue('E15', $record['Jumlah BayiEkonomi']);
            $sheet->setCellValue('E16', '=SUM(E10:E15)')->getStyle('E16')->getFont()->setBold(true);
            
            // // Pendapatan Pelayaran
            $sheet->setCellValue('F10', $record['Dewasa Eksekutif']);
            $sheet->setCellValue('F11', $record['Bayi Eksekutif']);
            $sheet->setCellValue('F12', $record['Dewasa Bisnis']);
            $sheet->setCellValue('F13', $record['Bayi Bisnis']);
            $sheet->setCellValue('F14', $record['Dewasa Ekonomi']);
            $sheet->setCellValue('F15', $record['Bayi Ekonomi']);
            $sheet->setCellValue('F16', '=SUM(F10:F15)')->getStyle('F16')->getFont()->setBold(true);
            
            // // Pendapatan Asuransi
            $sheet->setCellValue('G10', $record["DewasaEksekutifTJP"] * $record['Jumlah DewasaEksekutif']);
            $sheet->setCellValue('G11', $record['BayiEksekutifTJP'] * $record['Jumlah BayiEksekutif']);
            $sheet->setCellValue('G12', $record['DewasaBisnisTJP'] * $record['Jumlah DewasaBisnis']);
            $sheet->setCellValue('G13', $record['BayiBisnisTJP'] * $record['Jumlah BayiBisnis']);
            $sheet->setCellValue('G14', $record['DewasaEkonomiTJP'] * $record['Jumlah DewasaEkonomi'] );
            $sheet->setCellValue('G15', $record['BayiEkonomiTJP'] * $record['Jumlah BayiEkonomi']);
            $sheet->setCellValue('G16', number_format((int)'=SUM(G10:G15)'))->getStyle('G16')->getFont()->setBold(true);
            
            // Total Penumpang
            $sheet->setCellValue('H10', '=F10 + G10');
            $sheet->setCellValue('H11', '=F11 + G11');
            $sheet->setCellValue('H12', '=F12 + G12');
            $sheet->setCellValue('H13', '=F13 + G13');
            $sheet->setCellValue('H14', '=F14 + G14');
            $sheet->setCellValue('H15', '=F15 + G15');
            $sheet->setCellValue('H16', '=SUM(H10:H15)')->getStyle('H16')->getFont()->setBold(true);

            // Tarif Pelayaran
            $sheet->setCellValue('F18', $record['Golongan ']);
            $sheet->setCellValue('F19', $record['Golongan 2']);
            $sheet->setCellValue('F20', $record['Golongan 3']);
            $sheet->setCellValue('F21', $record['Golongan 4 Penumpang']);
            $sheet->setCellValue('F22', $record['Golongan 4 Barang']);
            $sheet->setCellValue('F23', $record['Golongan 5 Penumpang']);
            $sheet->setCellValue('F24', $record['Golongan 5 Barang']);
            $sheet->setCellValue('F25', $record['Golongan 6 Penumpang']);
            $sheet->setCellValue('F26', $record['Golongan 6 Barang']);
            $sheet->setCellValue('F27', $record['Golongan 7']);
            $sheet->setCellValue('F28', $record['Golongan 8']);
            $sheet->setCellValue('F29', $record['Golongan 9']);
            $sheet->setCellValue('F30', '=SUM(F18:F29)')->getStyle('F30')->getFont()->setBold(true);
            
            // // Jumlah Produksi
            $sheet->setCellValue('E18', $record['Jumlah Gol1']);
            $sheet->setCellValue('E19', $record['Jumlah Gol2']);
            $sheet->setCellValue('E20', $record['Jumlah Gol3']);
            $sheet->setCellValue('E21', $record['Jumlah Gol4Pen']);
            $sheet->setCellValue('E22', $record['Jumlah Gol4Bar']);
            $sheet->setCellValue('E23', $record['Jumlah Gol5Pen']);
            $sheet->setCellValue('E24', $record['Jumlah Gol5Bar']);
            $sheet->setCellValue('E25', $record['Jumlah Gol6Pen']);
            $sheet->setCellValue('E26', $record['Jumlah Gol6Bar']);
            $sheet->setCellValue('E27', $record['Jumlah Gol7']);
            $sheet->setCellValue('E28', $record['Jumlah Gol8']);
            $sheet->setCellValue('E29', $record['Jumlah Gol9']);
            $sheet->setCellValue('E30', '=SUM(E18:E29)')->getStyle('E30')->getFont()->setBold(true);
            
            // Pendapatan Asuransi
            $sheet->setCellValue('G18', $record['Jumlah Gol1'] * $record['Gol1TJP']);
            $sheet->setCellValue('G19', $record['Jumlah Gol2'] * $record['Gol2TJP']);
            $sheet->setCellValue('G20', $record['Jumlah Gol3'] * $record['Gol3TJP']);
            $sheet->setCellValue('G21', $record['Jumlah Gol4Pen'] * $record['Gol4PenTJP']);
            $sheet->setCellValue('G22', $record['Jumlah Gol4Bar'] * $record['Gol4BarTJP']);
            $sheet->setCellValue('G23', $record['Jumlah Gol5Pen'] * $record['Gol5PenTJP']);
            $sheet->setCellValue('G24', $record['Jumlah Gol5Bar'] * $record['Gol5BarTJP']);
            $sheet->setCellValue('G25', $record['Jumlah Gol6Pen'] * $record['Gol6PenTJP']);
            $sheet->setCellValue('G26', $record['Jumlah Gol6Bar'] * $record['Gol6BarTJP']);
            $sheet->setCellValue('G27', $record['Jumlah Gol7'] * $record['Gol7TJP']);
            $sheet->setCellValue('G28', $record['Jumlah Gol8'] * $record['Go81TJP']);
            $sheet->setCellValue('G29', $record['Jumlah Gol9'] * $record['Go91TJP']);
            $sheet->setCellValue('G30', '=SUM(G18:G29)')->getStyle('G30')->getFont()->setBold(true);
            
            // Jumlah
            $sheet->setCellValue('H18', '=F18 + G18');
            $sheet->setCellValue('H19', '=F19 + G19');
            $sheet->setCellValue('H20', '=F20 + G20');
            $sheet->setCellValue('H21', '=F21 + G21');
            $sheet->setCellValue('H22', '=F22 + G22');
            $sheet->setCellValue('H23', '=F23 + G23');
            $sheet->setCellValue('H24', '=F24 + G24');
            $sheet->setCellValue('H25', '=F25 + G25');
            $sheet->setCellValue('H26', '=F26 + G26');
            $sheet->setCellValue('H27', '=F27 + G27');
            $sheet->setCellValue('H28', '=F28 + G28');
            $sheet->setCellValue('H29', '=F29 + G29');
            $sheet->setCellValue('H30', '=SUM(H18:H29)')->getStyle('H30')->getFont()->setBold(true);

            // Barang
                // Jumlah Produksi
                $sheet->setCellValue('E32', $record['Jumlah BarangVolume']);
                $sheet->setCellValue('E34', '=SUM(E32)')->getStyle('E34')->getFont()->setBold(true);
                
                // Pendapatan Asuransi
                // $sheet->setCellValue('G10', $record["DewasaEksekutifTJP"] * $record['Jumlah BarangVolume']);
                // $sheet->setCellValue('G16', '=SUM(G10:G15)');
                
                // Pendapatan Pelayaran
                $sheet->setCellValue('F32', $record['Barang Pendapatan']);
                $sheet->setCellValue('F34', '=SUM(F32)')->getStyle('F34')->getFont()->setBold(true);

                // Total Penumpang
                $sheet->setCellValue('H32', '=F32 + G32');
                $sheet->setCellValue('H34', '=SUM(H32)')->getStyle('H34')->getFont()->setBold(true);

            //Suplesi
                //Jumlah Produksi
                $sheet->setCellValue('E36', $record['Jumlah Suplesi1Dewasa']);
                $sheet->setCellValue('E37', $record['Jumlah Suplesi1Anak']);
                $sheet->setCellValue('E38', $record['Jumlah Suplesi2Dewasa']);
                $sheet->setCellValue('E39', $record['Jumlah Suplesi2Anak']);
                $sheet->setCellValue('E40', '=SUM(E36:E39)')->getStyle('E40')->getFont()->setBold(true);
                
                //Pendapatan Pelayaran
                $sheet->setCellValue('F36', $record['Suplesi1 Dewasa']);
                $sheet->setCellValue('F37', $record['Suplesi1 Anak']);
                $sheet->setCellValue('F38', $record['Suplesi2 Dewasa']);
                $sheet->setCellValue('F39', $record['Suplesi2 Anak']);
                $sheet->setCellValue('F40', '=SUM(F36:F39)')->getStyle('F40')->getFont()->setBold(true);

                // Pendapatan Asuransi
                $sheet->setCellValue('H36', $record['Suplesi1 Dewasa']);
                $sheet->setCellValue('H37', $record['Suplesi1 Anak']);
                $sheet->setCellValue('H38', $record['Suplesi2 Dewasa']);
                $sheet->setCellValue('H39', $record['Suplesi2 Anak']);
                $sheet->setCellValue('H40', '=SUM(H36:H39)')->getStyle('H40')->getFont()->setBold(true);
                
            //Total Baris
            $sheet->setCellValue('E41', '=E16+E30+E34+E40')->getStyle('E41')->getFont()->setBold(true);
            $sheet->setCellValue('F41', '=F16+F30+F34+F40')->getStyle('F41')->getFont()->setBold(true);
            $sheet->setCellValue('G41', '=G16+G30+G34+G40')->getStyle('G41')->getFont()->setBold(true);
            $sheet->setCellValue('H41', '=H16+H30+H34+H40')->getStyle('H41')->getFont()->setBold(true);
        }


    // $sheet->getStyle('C10:J16')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_ACCOUNTING_EUR);
    // $sheet->getStyle('C18:J30')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_0);
    // $sheet->getStyle('C32:J34')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_0);

    $styleArray = array(
        'allBorders' => array(
            'outline' => array(
                'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => array('argb' => 'FFFF0000'),
            ),
        ),
    );

    $sheet = $sheet->getStyle('A1:J45')->applyFromArray($styleArray);
    

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'. urlencode($title." ".$lintasanReport." ".$tanggalAwalReport.".xlsx").'"');
        ob_end_clean();
        $writer->save('php://output');
        exit();
    }
}