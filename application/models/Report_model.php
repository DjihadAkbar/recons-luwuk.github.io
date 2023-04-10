<?php

class Report_model extends CI_Model
{
    public function supervisorName(){
        if ($this->session->userdata('logged_in'))
            $pelabuhan = $this->session->userdata['pelabuhan'];

        $this->db->select('*');
        $this->db->where('region', $pelabuhan);
        $this->db->where('position','SUPERVISOR');
        $query = $this->db->get('employee')->result_array();
        header("Content-type: " . $query['qr_type']);
        return $query;
    }
    public function employee(){
        $this->db->select('*');
        return $this->db->get('employee')->result_array();
    }


    public function report1()
    {
        if ($this->session->userdata('logged_in'))
            $pelabuhan = $this->session->userdata['pelabuhan'];

        $this->db->select('date,ferry, route AS rute,harbour,
                SUM((rate.Gol1 + rate.Gol1TJP + rate.Gol1IW) * entry_data.Gol1) AS "Golongan I",
                SUM((rate.Gol2 + rate.Gol2TJP + rate.Gol2IW)* entry_data.Gol2) AS "Golongan II", 
                SUM((rate.Gol3 + rate.Gol3TJP + rate.Gol3IW)* entry_data.Gol3) AS "Golongan III", 
                SUM((rate.Gol4Pen + rate.Gol4PenTJP + rate.Gol4PenIW)* entry_data.Gol4Pen) AS "Golongan IV - Penumpang", 
                SUM((rate.Gol4Bar + rate.Gol4BarTJP + rate.Gol4BarIW)* entry_data.Gol4Bar) AS "Golongan IV - Barang", 
                SUM((rate.Gol5Pen + rate.Gol5PenTJP + rate.Gol5PenIW)* entry_data.Gol5Pen) AS "Golongan V - Penumpang", 
                SUM((rate.Gol5Bar + rate.Gol5BarTJP + rate.Gol5BarIW)* entry_data.Gol5Bar) AS "Golongan V - Barang", 
                SUM((rate.Gol6Pen + rate.Gol6PenTJP + rate.Gol6PenIW)* entry_data.Gol6Pen) AS "Golongan VI - Penumpang", 
                SUM((rate.Gol6Bar + rate.Gol6BarTJP + rate.Gol6BarIW)* entry_data.Gol6Bar) AS "Golongan VI - Barang", 
                SUM((rate.Gol7 + rate.Gol7TJP + rate.Gol7IW)* entry_data.Gol7) AS "Golongan VII", 
                SUM((rate.Gol8 + rate.Gol8TJP + rate.Gol8IW)* entry_data.Gol8) AS "Golongan VIII", 
                SUM((rate.Gol9 + rate.Gol9TJP + rate.Gol9IW)* entry_data.Gol9) AS "Golongan IX", 
                SUM((rate.DewasaEksekutif  + rate.DewasaEksekutifTJP + rate.DewasaEksekutifIW)* entry_data.DewasaEksekutif) AS "Dewasa Eksekutif", 
                SUM((rate.BayiEksekutif  + rate.BayiEksekutifTJP + rate.BayiEksekutifIW)* entry_data.BayiEksekutif) AS "Bayi Eksekutif", 
                SUM((rate.DewasaBisnis  + rate.DewasaBisnisTJP + rate.DewasaBisnisIW)* entry_data.DewasaBisnis) AS "Dewasa Bisnis", 
                SUM((rate.BayiBisnis  + rate.BayiBisnisTJP + rate.BayiBisnisIW)* entry_data.BayiBisnis) AS "Bayi Bisnis", 
                SUM((rate.DewasaEkonomi  + rate.DewasaEkonomiTJP + rate.DewasaEkonomiIW)* entry_data.DewasaEkonomi) AS "Dewasa Ekonomi", 
                SUM((rate.BayiEkonomi  + rate.BayiEkonomiTJP + rate.BayiEkonomiIW)* entry_data.BayiEkonomi) AS "Bayi Ekonomi", 
                SUM(rate.Suplesi1Dewasa * entry_data.Suplesi1Dewasa) AS "Suplesi Ekonomi I Dewasa", 
                SUM(rate.Suplesi1Anak * entry_data.Suplesi1Anak) AS "Suplesi Ekonomi I Anak", 
                SUM(rate.Suplesi2Dewasa * entry_data.Suplesi2Dewasa) AS "Suplesi Ekonomi II Dewasa", 
                SUM(rate.Suplesi2Anak * entry_data.Suplesi2Anak) AS "Suplesi Ekonomi II Anak", 
                SUM(rate.Hewan * entry_data.Hewan) AS "Hewan", 
                SUM(rate.Gayor * entry_data.Gayor) AS "Gayor", 
                SUM(rate.Carter * entry_data.Carter) AS "Carter", 
                SUM(rate.BarCur * entry_data.BarangPendapatan) AS "Barang Curah", 
                SUM(
                (rate.Gol1 * entry_data.Gol1) + 
                (rate.Gol2 * entry_data.Gol2) +
                (rate.Gol3 * entry_data.Gol3) +
                (rate.Gol4Pen * entry_data.Gol4Pen) +
                (rate.Gol4Bar * entry_data.Gol4Bar) +
                (rate.Gol5Pen * entry_data.Gol5Pen) +
                (rate.Gol5Bar * entry_data.Gol5Bar) +
                (rate.Gol6Pen * entry_data.Gol6Pen) +
                (rate.Gol6Bar * entry_data.Gol6Bar) +
                (rate.Gol7 * entry_data.Gol7) +
                (rate.Gol8 * entry_data.Gol8) +
                (rate.Gol9 * entry_data.Gol9) +
                (rate.DewasaEksekutif * entry_data.DewasaEksekutif) +
                (rate.BayiEksekutif * entry_data.BayiEksekutif) +
                (rate.DewasaBisnis * entry_data.DewasaBisnis) +
                (rate.BayiBisnis * entry_data.BayiBisnis) +
                (rate.DewasaEkonomi * entry_data.DewasaEkonomi) +
                (rate.BayiEkonomi * entry_data.BayiEkonomi) +
                (rate.Suplesi1Dewasa * entry_data.Suplesi1Dewasa) +
                (rate.Suplesi1Anak * entry_data.Suplesi1Anak) +
                (rate.Suplesi2Dewasa * entry_data.Suplesi2Dewasa) +
                (rate.Suplesi2Anak * entry_data.Suplesi2Anak) +
                (rate.Hewan * entry_data.Hewan) +
                (rate.Gayor * entry_data.Gayor) +
                (rate.Carter * entry_data.Carter) +
                (rate.BarCur * entry_data.BarangPendapatan))
                AS total');
        $this->db->join('ferry', 'entry_data.id_ferry = ferry.id');
        $this->db->join('routes', 'entry_data.id_route = routes.id');
        $this->db->join('harbours', 'harbours.id_harbours = entry_data.id_harbour');
        $this->db->join('rate', 'routes.id = rate.id_route AND entry_data.date >= rate.start_date and entry_data.rate_type = rate.rate_type');
        if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->group_by('entry_data.id');
        $this->db->order_by('entry_data.id DESC');
        return $this->db->get('entry_data')->result_array();
    }
}