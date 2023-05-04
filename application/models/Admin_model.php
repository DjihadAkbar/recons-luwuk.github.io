<?php

class Admin_model extends CI_Model
{
    public function user_accounts()
    {
        $this->db->select('*');
        return $this->db->get('users')->result_array();

    }
}