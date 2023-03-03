<?php

class User_model extends CI_Model
{

    public function changePassword($password, $id){
        
        $this->db->where('id',$id);
        $this->db->update('users',$password);

    }
    public function changeDetail($detail, $id){
        
        $this->db->where('id',$id);
        $this->db->update('users',$detail);

    }
    public function register($data)
    {
        $this->db->insert('users', $data);
    }

    public function login($username)
    {
        $query = $this->db->select('*')
            ->where('username', $username)
            ->get('users');
        $row = $query->row();
        return $row;
    }

    public function account(){
        if ($this->session->userdata('logged_in'))
            $username = $this->session->userdata['username'];
        $this->db->select('*');
        $this->db->where('username', $username);
        return $this->db->get('users')->result_array();
    }

    public function insertTrip($data)
    {
        $this->db->insert('trips', $data);
    }
    public function entry($data)
    {
        $this->db->insert('entry_data', $data);
    }
}