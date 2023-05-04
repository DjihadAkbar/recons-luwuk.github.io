<?php

class Karyawan_model extends CI_Model
{
    public function users()
    {
        $query = $this->db->select('*')->get('users');
        return $query->result_array();
    }
}