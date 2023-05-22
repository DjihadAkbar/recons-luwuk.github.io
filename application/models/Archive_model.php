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