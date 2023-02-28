<?php
use PharIo\Manifest\Library;

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('password');
        $this->load->helper('url');
        $this->load->model('User_model');
    }

    public function index(){
        $data['title'] = "Revenue Controlling System - Luwuk";
        $this->load->view('landingPage', $data);
    }

    public function entry()
    {
        $data['title'] = "Entry Data";
        $data['entry_data'] = $this->Daily_model->entryData();
        $data['produksi'] = $this->Daily_model->produksi();
        $data['lintasan'] = $this->Daily_model->lintasan();
        $data['pelabuhan'] = $this->Daily_model->pelabuhan();
        $data['kapal'] = $this->Daily_model->kapal();
        $this->load->view('template/home/header', $data);
        $this->load->view('entry_data', $data);

    }

    public function trip()
    {
        $data['title'] = "Trip";
        $data['trip'] = $this->Daily_model->trip();
        $data['kapal'] = $this->Daily_model->kapal();
        $data['lintasan'] = $this->Daily_model->lintasan();
        $this->load->view('template/home/header', $data);
        $this->load->view('trips', $data);
        $this->load->view('template/home/footer', $data);
    }

    public function dailyInput()
    {
        $data['title'] = "Daily Income";
        $data['dataPendapatan'] = $this->Daily_model->semua();
        $data['produksi'] = $this->Daily_model->produksi();
        $data['lintasan'] = $this->Daily_model->lintasan();
        $data['pelabuhan'] = $this->Daily_model->pelabuhan();
        $data['trip'] = $this->Daily_model->trip();
        $data['produksi_bulanan'] = $this->Daily_model->perProduksiBulanan();
        $this->load->view('template/home/header', $data);
        $this->load->view('daily_input', $data);
        $this->load->view('template/home/footer', $data);
    }

    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $data['title'] = "Register";
        $data['userData'] = $this->Daily_model->users();
        $data['pelabuhan'] = $this->Daily_model->pelabuhan();
        $this->load->view('pages/register', $data);
    }

    public function prosesInput()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('pelabuhan', 'Pelabuhan', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', '');
        $this->form_validation->set_rules('phone', 'Phone', '');

        if ($this->form_validation->run() == false) {
            $this->register();
        } else {
            $dataInput = [
                'harbours' => $this->input->post('pelabuhan'),
                'type' => $this->input->post('type'),
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' => $this->password->hash($this->input->post('password')),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('telepon'),
            ];
            $this->User_model->register($dataInput);
            $alert = [
                'pesan' => 'Akun anda berhasil dibuat',
                'alert' => 'alert-success'
            ];
            $this->session->set_flashdata($alert);
            redirect('login');
        }
    }

    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $data['title'] = "Login";
        $this->load->view('pages/login', $data);
    }
    public function prosesLogin()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }


        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == false) {
            $this->login();
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->User_model->login($username);

            $passwordHash = isset($user->password) ? $user->password : false;

            if ($this->password->verify($password, $passwordHash)) {
                $dataLogin = [
                    'logged_in' => true,
                    'pelabuhan' => $user->harbours,
                    'user_id' => $user->id,
                    'type' => $user->type,
                    'name' => $user->name,
                    'username' => $user->username,
                    'jabatan' => $user->jabatan,
                ];
                $this->session->set_userdata($dataLogin);
                redirect('dashboard');
            } else {
                $alert = [
                    'pesan' => 'Gagal Melakukan Login',
                    'alert' => 'alert-danger'
                ];
                $this->session->set_flashdata($alert);
                redirect('login');
            }
        }
    }

    public function logout()
    {
        $dataLogin = ['logged_in', 'user_id', 'username', 'name'];

        $this->session->unset_userdata($dataLogin);
        redirect('login');
    }
    public function inputTrip()
    {
        $this->form_validation->set_rules('jumlah_trip', 'Jumlah Trip', 'required');
        $this->form_validation->set_rules('jenis_operasi', 'Jenis Operasi', 'required');
        if ($this->form_validation->run() == false) {
            $this->inputTrip();
        } else {
            $dataInput = [
                'id_ferry' => $this->input->post('nama_kapal'),
                'id_route' => $this->input->post('lintasan'),
                'trip' => $this->input->post('jumlah_trip'),
                'operation' => $this->input->post('jenis_operasi'),
                'trip_date' => $this->input->post('tanggal_berangkat'),
                'note' => $this->input->post('catatan'),
            ];
            $this->User_model->insertTrip($dataInput);
        }
    }
    public function entryData()
    {
        $dataInput = [
            'date' => $this->input->post('tanggal_berangkat'),
            'id_ferry' => $this->input->post('nama_kapal'),
            'id_route' => $this->input->post('lintasan'),
            'id_harbour' => $this->input->post('pelabuhan_asal'),
            'id_trip' => $this->input->post('trip'),
            'Gol1' => $this->input->post('GOL1'),
            'Gol2' => $this->input->post('GOL2'),
            'Gol3' => $this->input->post('GOL3'),
            'Gol4Pen' => $this->input->post('GOL4PEN'),
            'Gol4Bar' => $this->input->post('GOL4BAR'),
            'Gol5Pen' => $this->input->post('GOL5PEN'),
            'Gol5Bar' => $this->input->post('GOL5BAR'),
            'Gol6Pen' => $this->input->post('GOL6PEN'),
            'Gol6Bar' => $this->input->post('GOL6BAR'),
            'Gol7' => $this->input->post('GOL7'),
            'Gol8' => $this->input->post('GOL8'),
            'Gol9' => $this->input->post('GOL9'),
            'DewasaEksekutif' => $this->input->post('DEKS'),
            'BayiEksekutif' => $this->input->post('ANEKS'),
            'DewasaBisnis' => $this->input->post('DEBIS'),
            'BayiBisnis' => $this->input->post('ANBIS'),
            'DewasaEkonomi' => $this->input->post('DEKO'),
            'BayiEkonomi' => $this->input->post('ANEKO'),
            'BarangVolume' => $this->input->post('barang_volume'),
            'BarangPendapatan' => $this->input->post('barang_pendapatan'),
        ];
        $this->User_model->entry($dataInput);
        redirect('entry');
    }
}