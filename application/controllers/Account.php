<?php

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('password');
    }
    public function index()
    {
        $data['title'] = 'Account';
        $data['contentView'] = 'pages/account/account';
        $data['account'] = $this->User_model->account();

        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }
    public function changeAccount()
    {
        $data['title'] = 'Change Password';
        $data['contentView'] = 'pages/account/change_account';
        $data['account'] = $this->User_model->account();

        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }
    public function changeDetail()
    {
        $data['title'] = 'Change Detail ';
        $data['contentView'] = 'pages/account/changeDetail';
        $data['account'] = $this->User_model->account();

        $this->load->view('template/dashboard/body', $data);
    }

    public function prosesChangeAccount(){
            $this->form_validation->set_rules('old-password', 'Password Lama', 'required|min_length[6]');
            $this->form_validation->set_rules('password', 'Password Baru', 'required|min_length[6]|differs[old-password]');
            $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]');
        
        if ($this->form_validation->run() == false) {
            $this->changeAccount();
        } else {
                $dataChangePassword = [
                    'password' => $this->password->hash($this->input->post('password')),
                ];
                $this->User_model->changePassword($dataChangePassword, $_GET['id']);

                $alert = [
                    'pesan' => 'Password anda berhasil diubah',
                    'alert' => 'alert-success'
                ];
                $this->session->set_flashdata($alert);
                redirect('account');
            
        }
    }
    public function prosesChangeDetail(){
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('pelabuhan', 'Pelabuhan', 'required');
            $this->form_validation->set_rules('email', 'Email', '');
            $this->form_validation->set_rules('telepon', 'No telepon', '');
        
        if ($this->form_validation->run() == false) {
            $this->changeDetail();
        } else {
                $dataChangeDetail = [
                    'name' => $this->input->post('nama'),
                    'username' => $this->input->post('username'),
                    'harbours' => ucwords($this->input->post('pelabuhan')),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('telepon'),
                ];
                $this->User_model->changeDetail($dataChangeDetail, $_GET['id']);

                $alert = [
                    'pesan' => 'Detail anda berhasil diubah',
                    'alert' => 'alert-success'
                ];
                $this->session->set_flashdata($alert);
                redirect('account');
            
        }
    }

}