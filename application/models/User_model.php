<?php

class User_model extends CI_Model
{
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

    public function insertTrip($data)
    {
        $this->db->insert('trips', $data);
    }
    public function entry($data)
    {
        $this->db->insert('entry_data', $data);
    }
    public function tambahTarif($data)
    {
        $this->db->insert('rate', $data);
    }
}