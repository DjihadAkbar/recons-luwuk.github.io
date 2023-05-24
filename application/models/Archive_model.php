<?php

class Archive_model extends CI_Model
{
    public function index()
    {
        $this->db->select('*');
        // $this->db->from('daily_income');
        // $this->db->join('productions', 'productions.id = daily_income.id_production');
        // $this->db->join('routes', 'routes.id = daily_income.id_routes');
        // $this->db->join('rates', 'daily_income.id_production = rates.id_production AND daily_income.id_routes = rates.id_routes');
        // $this->db->join('ferry', 'routes.id_ferry = ferry.id');
        // $this->db->group_by('monthname(date), route');
        return $this->db->get('archive_list')->result_array();
    }

    public function editArchive($data, $id){
        $this->db->where('archive_list.id', $id);
        $this->db->update('archive_list', $data);
    }

    public function deleteArchive($id){
        $this->db->where('archive_list.id', $id);
        $this->db->delete('archive_list');
    }

    public function tambahArchive($data)
    {
        $this->db->insert('archive_list', $data);
    }
    
}