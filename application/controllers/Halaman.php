<?php

class Halaman extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	public function initial()
	{
		$data['title'] = 'ASDP Indonesia Ferry Cabang Luwuk';
		$data['usersData'] = $this->Karyawan_model->users();

		$this->load->view('template/header', $data);
		$this->load->view('tampilan_halaman', $data);
		$this->load->view('template/footer', $data);
	}
	// public function tampil()
	// {
	// 	$data['title'] = 'Ini title yang dinamis';
	// 	$data['dataKaryawan'] = $this->Karyawan_model->semua();

	// 	$this->load->view('template/header', $data);
	// 	$this->load->view('tampilan_halaman', $data);
	// 	$this->load->view('template/footer', $data);
	// }
	public function aku_kamu($anak = "")
	{
		$data['title'] = 'Ini Halaman aku kamu';
		$data['namaOrang'] = 'Djihad';
		$data['dataKaryawan'] = $this->Karyawan_model->semua()->row();
		$this->load->view('template/header', $data);
		$this->load->view('tes', $data);
		$this->load->view('template/footer', $data);
	}
}