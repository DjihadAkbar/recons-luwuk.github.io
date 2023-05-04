<?php

class Daily_model extends CI_Model
{
    public function semua()
    {
        $this->db->select('monthname(DATE) AS bulan, ferry, daily_income.origin AS pelabuhan, route AS rute, SUM(transport * total) AS pendapatan_penyebrangan,
        SUM(total) AS jumlah_produksi');
        // $this->db->from('daily_income');
        $this->db->join('productions', 'productions.id = daily_income.id_production');
        $this->db->join('routes', 'routes.id = daily_income.id_routes');
        $this->db->join('rates', 'daily_income.id_production = rates.id_production AND daily_income.id_routes = rates.id_routes');
        $this->db->join('ferry', 'routes.id_ferry = ferry.id');
        $this->db->group_by('monthname(date), route');
        return $this->db->get('daily_income')->result_array();

    }
    public function entryData()
    {
        $this->db->select('*');
        $this->db->join('routes', 'routes.id = entry_data.id_route');
        $this->db->join('ferry', 'entry_data.id_ferry = ferry.id');
        $this->db->join('harbours', 'harbours.id_harbours = entry_data.id_harbour');
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        // $this->db->where('id_ferry', $data['nama_kapal']);
        $this->db->order_by('date DESC', 'ferry ASC');
        return $this->db->get('entry_data')->result_array();
    }

    public function perProduksiBulanan()
    {
        $this->db->select('monthname(DATE) AS bulan, production, SUM(transport * total) AS pendapatan_penyebrangan, SUM(tjp * total) AS tjp_total, SUM(iw * total) AS iw_total, SUM((transport+tjp+iw) * total) AS pendapatan_total,
        SUM(total) AS jumlah_produksi');
        // $this->db->from('daily_income');
        $this->db->join('productions', 'productions.id = daily_income.id_production');
        $this->db->join('routes', 'routes.id = daily_income.id_routes');
        $this->db->join('rates', 'daily_income.id_production = rates.id_production AND daily_income.id_routes = rates.id_routes');
        $this->db->join('ferry', 'routes.id_ferry = ferry.id');
        $this->db->where('year(date)', '2022');
        $this->db->group_by('monthname(date), production');
        $this->db->order_by('monthname(date), productions.id');
        return $this->db->get('daily_income')->result_array();

    }

    public function trip()
    {
        $this->db->select('ferry as kapal, route as lintasan, a.harbour as pelabuhan_asal, b.harbour as pelabuhan_tujuan, trip as jumlah_trip, operation as jenis_operation, trip_date as tanggal_operasi, note as catatan');
        $this->db->join('ferry', 'ferry.id = trips.id_ferry');
        $this->db->join('routes', 'routes.id = trips.id_route');
        $this->db->join('harbours as a', 'a.id_harbours = routes.origin');
        $this->db->join('harbours as b', 'b.id_harbours = routes.destination');
        $this->db->order_by('trip_date', 'DESC');
        return $this->db->get('trips')->result_array();
    }

    public function produksi()
    {
        $this->db->select('id, id_production, production as produksi');
        $query = $this->db->get('productions')->result_array();
        return $query;
    }
    public function kapal()
    {
        $this->db->select('id, ferry as kapal');
        $query = $this->db->get('ferry')->result_array();
        return $query;
    }
    public function lintasan()
    {
        $this->db->select('id, route as lintasan');
        $query = $this->db->get('routes')->result_array();
        return $query;
    }
    public function pelabuhan()
    {
        $this->db->select('harbour as pelabuhan, id_harbours');
        return $this->db->get('harbours')->result_array();
    }
    public function users()
    {
        $query = $this->db->select('*')->get('users');
        return $query->result_array();
    }
}