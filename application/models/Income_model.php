<?php

class Income_model extends CI_Model
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
    public function entryData($data)
    {
        $array = array('ferry' => $data['nama_kapal'], 'route' => $data['lintasan'], 'harbour' => $data['pelabuhan_asal'], 'trips.id' => $data['trip'], 'date' => $data['tanggal']);
        $this->db->select('*');
        $this->db->join('routes', 'routes.id = entry_data.id_route');
        $this->db->join('ferry', 'entry_data.id_ferry = ferry.id');
        $this->db->join('harbours', 'harbours.id_harbours = entry_data.id_harbour');
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        $this->db->where($array);
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

    public function pendapatan()
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

    public function incomePerRoute()
    {
        $lastMonth = date("F", strtotime('-2 month'));
        $lastYear = date("Y") - 1;
        if ($this->session->userdata('logged_in'))
            $pelabuhan = $this->session->userdata['pelabuhan'];
        $textDepan = '(
            SELECT id_ferry, ferry, id_harbour, COUNT(case when trips.trip != 1 then 1 END) as trip, entry_data.id_route,
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
                AS total
                FROM entry_data
                JOIN routes ON routes.id = entry_data.id_route
                JOIN ferry ON ferry.id = entry_data.id_ferry
                JOIN harbours ON harbours.id_harbours = entry_data.id_harbour
                JOIN rate ON routes.id = rate.id_route AND entry_data.date >= rate.start_date AND entry_data.rate_type = rate.rate_type
                JOIN trips on trips.id = entry_data.id_trip';
                if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
                    $textTengah = ' WHERE routes.spv = "'.$pelabuhan. '" AND ';
                } else {
                    $textTengah =' WHERE ';
                }
                $textBelakang = 'MONTHNAME(entry_data.DATE) = "'.$lastMonth.'" AND YEAR(entry_data.DATE) = "'.$lastYear.'"
                GROUP BY entry_data.id_harbour,entry_data.id_route) as entry_d';
            $textAkhir = 'entry_a.id_route = entry_d.id_route AND entry_a.id_harbour = entry_d.id_harbour';
        
        $this->db->select('ferry.ferry,monthname(entry_a.date) as month_date,entry_a.date,harbour, entry_d.total as totalLastYear, entry_d.trip as tripLastYear,
        
        COUNT(case when trips.trip != 1 then 1 END) as "Jumlah Trip", route, routes.id, target, harbour_target.trip as target_trip,
                SUM(
                (rate.Gol1 * entry_a.Gol1) + 
                (rate.Gol2 * entry_a.Gol2) +
                (rate.Gol3 * entry_a.Gol3) +
                (rate.Gol4Pen * entry_a.Gol4Pen) +
                (rate.Gol4Bar * entry_a.Gol4Bar) +
                (rate.Gol5Pen * entry_a.Gol5Pen) +
                (rate.Gol5Bar * entry_a.Gol5Bar) +
                (rate.Gol6Pen * entry_a.Gol6Pen) +
                (rate.Gol6Bar * entry_a.Gol6Bar) +
                (rate.Gol7 * entry_a.Gol7) +
                (rate.Gol8 * entry_a.Gol8) +
                (rate.Gol9 * entry_a.Gol9) +
                (rate.DewasaEksekutif * entry_a.DewasaEksekutif) +
                (rate.BayiEksekutif * entry_a.BayiEksekutif) +
                (rate.DewasaBisnis * entry_a.DewasaBisnis) +
                (rate.BayiBisnis * entry_a.BayiBisnis) +
                (rate.DewasaEkonomi * entry_a.DewasaEkonomi) +
                (rate.BayiEkonomi * entry_a.BayiEkonomi) +
                (rate.Suplesi1Dewasa * entry_a.Suplesi1Dewasa) +
                (rate.Suplesi1Anak * entry_a.Suplesi1Anak) +
                (rate.Suplesi2Dewasa * entry_a.Suplesi2Dewasa) +
                (rate.Suplesi2Anak * entry_a.Suplesi2Anak) +
                (rate.Hewan * entry_a.Hewan) +
                (rate.Gayor * entry_a.Gayor) +
                (rate.Carter * entry_a.Carter) +
                (rate.BarCur * entry_a.BarangPendapatan))
                AS total,
                (
                    SELECT
                    SUM(
                        (rate.Gol1 * entry_b.Gol1) + 
                        (rate.Gol2 * entry_b.Gol2) +
                        (rate.Gol3 * entry_b.Gol3) +
                        (rate.Gol4Pen * entry_b.Gol4Pen) +
                        (rate.Gol4Bar * entry_b.Gol4Bar) +
                        (rate.Gol5Pen * entry_b.Gol5Pen) +
                        (rate.Gol5Bar * entry_b.Gol5Bar) +
                        (rate.Gol6Pen * entry_b.Gol6Pen) +
                        (rate.Gol6Bar * entry_b.Gol6Bar) +
                        (rate.Gol7 * entry_b.Gol7) +
                        (rate.Gol8 * entry_b.Gol8) +
                        (rate.Gol9 * entry_b.Gol9) +
                        (rate.DewasaEksekutif * entry_b.DewasaEksekutif) +
                        (rate.BayiEksekutif * entry_b.BayiEksekutif) +
                        (rate.DewasaBisnis * entry_b.DewasaBisnis) +
                        (rate.BayiBisnis * entry_b.BayiBisnis) +
                        (rate.DewasaEkonomi * entry_b.DewasaEkonomi) +
                        (rate.BayiEkonomi * entry_b.BayiEkonomi) +
                        (rate.Suplesi1Dewasa * entry_b.Suplesi1Dewasa) +
                        (rate.Suplesi1Anak * entry_b.Suplesi1Anak) +
                        (rate.Suplesi2Dewasa * entry_b.Suplesi2Dewasa) +
                        (rate.Suplesi2Anak * entry_b.Suplesi2Anak) +
                        (rate.Hewan * entry_b.Hewan) +
                        (rate.Gayor * entry_b.Gayor) +
                        (rate.Carter * entry_b.Carter) +
                        (rate.BarCur * entry_b.BarangPendapatan)
                        )
                        FROM entry_data as entry_b
                        JOIN rate ON routes.id = rate.id_route AND entry_b.date >= rate.start_date and entry_b.rate_type = rate.rate_type
                        WHERE MONTHNAME(entry_b.DATE) = "' . $lastMonth . '" AND YEAR(entry_b.DATE) = 2022 AND entry_a.id_route = entry_b.id_route and entry_a.id_ferry = entry_b.id_ferry
                        GROUP BY harbour,route
                    ) AS totalLastYear2,
                    (
                        SELECT COUNT(case when trip != 1 then 1 END)
                        FROM entry_data as entry_c
                        join trips on trips.id = entry_c.id_trip
                        WHERE MONTHNAME(entry_c.DATE) = "' . $lastMonth . '" AND YEAR(entry_c.DATE) = 2022 AND entry_a.id_route = entry_c.id_route and entry_a.id_ferry = entry_c.id_ferry
                        GROUP BY harbour,route 
                    ) as tripLastYear2');
        $this->db->join($textDepan.$textTengah.$textBelakang,$textAkhir);

        $this->db->join('routes', 'entry_a.id_route = routes.id');
        $this->db->join('ferry', 'entry_a.id_ferry = ferry.id');
        $this->db->join('harbour_target', 'entry_a.id_ferry = harbour_target.id_ferry AND entry_a.id_harbour = harbour_target.id_harbour AND entry_a.id_route = harbour_target.id_route AND monthname(entry_a.date) = harbour_target.month');
        $this->db->join('harbours', 'harbours.id_harbours = entry_a.id_harbour');
        $this->db->join('rate', 'routes.id = rate.id_route AND entry_a.date >= rate.start_date and entry_a.rate_type = rate.rate_type');
        $this->db->join('trips', 'trips.id = entry_a.id_trip');
        if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->where('monthname(entry_a.date)', date("F", strtotime('-2 month')));
        $this->db->where('year(entry_a.date)', date("Y"));
        // $this->db->where('entry_a.id_trip', 'REGULER');
        $this->db->group_by(' month(entry_a.date),ferry, route');
        $this->db->order_by('ferry');
        return $this->db->get('entry_data as entry_a')->result_array();
    }

    public function incomePerShip()
    {
        $lastMonth = date("F", strtotime('-2 month'));
        $lastYear = date("Y") - 1;
        if ($this->session->userdata('logged_in'))
            $pelabuhan = $this->session->userdata['pelabuhan'];
        $textDepan = '(
            SELECT entry_data.id_ferry, ferry, id_harbour, COUNT(case when trips.trip != 1 then 1 END) as trip,
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
                AS total
                FROM entry_data
                JOIN routes ON routes.id = entry_data.id_route
                JOIN ferry ON ferry.id = entry_data.id_ferry
                JOIN harbours ON harbours.id_harbours = entry_data.id_harbour
                JOIN rate ON routes.id = rate.id_route AND entry_data.date >= rate.start_date AND entry_data.rate_type = rate.rate_type
                JOIN trips on trips.id = entry_data.id_trip
                JOIN spv_ferry ON spv_ferry.id_ferry = entry_data.id_ferry
                ';
                if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
                    $textTengah = ' WHERE spv_ferry.spv = "'.$pelabuhan. '" AND ';
                } else {
                    $textTengah =' WHERE ';
                }
                $textBelakang = 'MONTHNAME(entry_data.DATE) = "'.$lastMonth.'" AND YEAR(entry_data.DATE) = "'.$lastYear.'"
                GROUP BY ferry) as entry_d';
            $textAkhir = 'entry_a.id_ferry = entry_d.id_ferry';
        
        $this->db->select('ferry.ferry,monthname(entry_a.date) as month_date,entry_a.date,harbour, entry_d.total as totalLastYear, entry_d.trip as tripLastYear,
        COUNT(case when trips.trip != 1 then 1 END) as "Jumlah Trip", route, routes.id,
                SUM(
                (rate.Gol1 * entry_a.Gol1) + 
                (rate.Gol2 * entry_a.Gol2) +
                (rate.Gol3 * entry_a.Gol3) +
                (rate.Gol4Pen * entry_a.Gol4Pen) +
                (rate.Gol4Bar * entry_a.Gol4Bar) +
                (rate.Gol5Pen * entry_a.Gol5Pen) +
                (rate.Gol5Bar * entry_a.Gol5Bar) +
                (rate.Gol6Pen * entry_a.Gol6Pen) +
                (rate.Gol6Bar * entry_a.Gol6Bar) +
                (rate.Gol7 * entry_a.Gol7) +
                (rate.Gol8 * entry_a.Gol8) +
                (rate.Gol9 * entry_a.Gol9) +
                (rate.DewasaEksekutif * entry_a.DewasaEksekutif) +
                (rate.BayiEksekutif * entry_a.BayiEksekutif) +
                (rate.DewasaBisnis * entry_a.DewasaBisnis) +
                (rate.BayiBisnis * entry_a.BayiBisnis) +
                (rate.DewasaEkonomi * entry_a.DewasaEkonomi) +
                (rate.BayiEkonomi * entry_a.BayiEkonomi) +
                (rate.Suplesi1Dewasa * entry_a.Suplesi1Dewasa) +
                (rate.Suplesi1Anak * entry_a.Suplesi1Anak) +
                (rate.Suplesi2Dewasa * entry_a.Suplesi2Dewasa) +
                (rate.Suplesi2Anak * entry_a.Suplesi2Anak) +
                (rate.Hewan * entry_a.Hewan) +
                (rate.Gayor * entry_a.Gayor) +
                (rate.Carter * entry_a.Carter) +
                (rate.BarCur * entry_a.BarangPendapatan))
                AS total,
                (
                    SELECT
                    SUM(
                        (rate.Gol1 * entry_b.Gol1) + 
                        (rate.Gol2 * entry_b.Gol2) +
                        (rate.Gol3 * entry_b.Gol3) +
                        (rate.Gol4Pen * entry_b.Gol4Pen) +
                        (rate.Gol4Bar * entry_b.Gol4Bar) +
                        (rate.Gol5Pen * entry_b.Gol5Pen) +
                        (rate.Gol5Bar * entry_b.Gol5Bar) +
                        (rate.Gol6Pen * entry_b.Gol6Pen) +
                        (rate.Gol6Bar * entry_b.Gol6Bar) +
                        (rate.Gol7 * entry_b.Gol7) +
                        (rate.Gol8 * entry_b.Gol8) +
                        (rate.Gol9 * entry_b.Gol9) +
                        (rate.DewasaEksekutif * entry_b.DewasaEksekutif) +
                        (rate.BayiEksekutif * entry_b.BayiEksekutif) +
                        (rate.DewasaBisnis * entry_b.DewasaBisnis) +
                        (rate.BayiBisnis * entry_b.BayiBisnis) +
                        (rate.DewasaEkonomi * entry_b.DewasaEkonomi) +
                        (rate.BayiEkonomi * entry_b.BayiEkonomi) +
                        (rate.Suplesi1Dewasa * entry_b.Suplesi1Dewasa) +
                        (rate.Suplesi1Anak * entry_b.Suplesi1Anak) +
                        (rate.Suplesi2Dewasa * entry_b.Suplesi2Dewasa) +
                        (rate.Suplesi2Anak * entry_b.Suplesi2Anak) +
                        (rate.Hewan * entry_b.Hewan) +
                        (rate.Gayor * entry_b.Gayor) +
                        (rate.Carter * entry_b.Carter) +
                        (rate.BarCur * entry_b.BarangPendapatan)
                        )
                        FROM entry_data as entry_b
                        JOIN rate ON routes.id = rate.id_route AND entry_b.date >= rate.start_date and entry_b.rate_type = rate.rate_type
                        WHERE MONTHNAME(entry_b.DATE) = "' . $lastMonth . '" AND YEAR(entry_b.DATE) = "' . $lastYear . '" and entry_b.id_ferry = entry_a.id_ferry
                    ) AS totalLastYear2,
                    (
                        SELECT COUNT(case when trips.trip != 1 then 1 END)
                        FROM entry_data as entry_c
                        join trips on trips.id = entry_c.id_trip
                        WHERE MONTHNAME(entry_c.DATE) = "' . $lastMonth . '" AND YEAR(entry_c.DATE) = "' . $lastYear . '"  AND entry_a.id_ferry = entry_c.id_ferry
                        GROUP BY entry_c.id_ferry     
                    ) as tripLastYear2,
                    (
                        SELECT sum(trip)
                        FROM harbour_target
                        where entry_a.id_ferry = harbour_target.id_ferry
                        GROUP BY entry_a.id_ferry
                    ) as target_trip,
                    (
                        SELECT sum(target)
                        FROM harbour_target
                        where entry_a.id_ferry = harbour_target.id_ferry
                        GROUP BY entry_a.id_ferry
                    ) as target');
        $this->db->join($textDepan.$textTengah.$textBelakang,$textAkhir);
        $this->db->join('routes', 'entry_a.id_route = routes.id');
        $this->db->join('ferry', 'entry_a.id_ferry = ferry.id');
        $this->db->join('harbour_target', 'entry_a.id_ferry = harbour_target.id_ferry AND entry_a.id_harbour = harbour_target.id_harbour AND entry_a.id_route = harbour_target.id_route AND monthname(entry_a.date) = harbour_target.month');
        $this->db->join('harbours', 'harbours.id_harbours = entry_a.id_harbour');
        $this->db->join('rate', 'routes.id = rate.id_route AND entry_a.date >= rate.start_date and entry_a.rate_type = rate.rate_type');
        $this->db->join('trips', 'trips.id = entry_a.id_trip');
        if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->where('monthname(entry_a.date)', date("F", strtotime('-2 month')));
        $this->db->where('year(entry_a.date)', date("Y"));
        $this->db->group_by(' month(entry_a.date),ferry');
        $this->db->order_by('ferry');
        return $this->db->get('entry_data as entry_a')->result_array();
    }

    public function incomePerHarbour()
    {
        $lastMonth = date("F", strtotime('-2 month'));
        $lastYear = date("Y") - 1;
        if ($this->session->userdata('logged_in'))
            $pelabuhan = $this->session->userdata['pelabuhan'];
        $textDepan = '(
            SELECT id_ferry, ferry, id_harbour, COUNT(case when trips.trip != 1 then 1 END) as trip,
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
                AS total
                FROM entry_data
                JOIN routes ON routes.id = entry_data.id_route
                JOIN ferry ON ferry.id = entry_data.id_ferry
                JOIN harbours ON harbours.id_harbours = entry_data.id_harbour
                JOIN rate ON routes.id = rate.id_route AND entry_data.date >= rate.start_date AND entry_data.rate_type = rate.rate_type
                JOIN trips on trips.id = entry_data.id_trip';
                if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
                    $textTengah = ' WHERE routes.spv = "'.$pelabuhan. '" AND ';
                } else {
                    $textTengah =' WHERE ';
                }
                $textBelakang = 'MONTHNAME(entry_data.DATE) = "'.$lastMonth.'" AND YEAR(entry_data.DATE) = "'.$lastYear.'"
                GROUP BY entry_data.id_harbour
            ) as entry_d';
            $textAkhir = 'entry_a.id_harbour = entry_d.id_harbour';
        $this->db->select('ferry.ferry,monthname(entry_a.date) as month_date,entry_a.date as date,harbour,entry_d.total as totalLastYear,  entry_d.trip as tripLastYear,
        COUNT(case when trips.trip != 1 then 1 END) as "Jumlah Trip", route, routes.id,
                SUM(
                (rate.Gol1 * entry_a.Gol1) + 
                (rate.Gol2 * entry_a.Gol2) +
                (rate.Gol3 * entry_a.Gol3) +
                (rate.Gol4Pen * entry_a.Gol4Pen) +
                (rate.Gol4Bar * entry_a.Gol4Bar) +
                (rate.Gol5Pen * entry_a.Gol5Pen) +
                (rate.Gol5Bar * entry_a.Gol5Bar) +
                (rate.Gol6Pen * entry_a.Gol6Pen) +
                (rate.Gol6Bar * entry_a.Gol6Bar) +
                (rate.Gol7 * entry_a.Gol7) +
                (rate.Gol8 * entry_a.Gol8) +
                (rate.Gol9 * entry_a.Gol9) +
                (rate.DewasaEksekutif * entry_a.DewasaEksekutif) +
                (rate.BayiEksekutif * entry_a.BayiEksekutif) +
                (rate.DewasaBisnis * entry_a.DewasaBisnis) +
                (rate.BayiBisnis * entry_a.BayiBisnis) +
                (rate.DewasaEkonomi * entry_a.DewasaEkonomi) +
                (rate.BayiEkonomi * entry_a.BayiEkonomi) +
                (rate.Suplesi1Dewasa * entry_a.Suplesi1Dewasa) +
                (rate.Suplesi1Anak * entry_a.Suplesi1Anak) +
                (rate.Suplesi2Dewasa * entry_a.Suplesi2Dewasa) +
                (rate.Suplesi2Anak * entry_a.Suplesi2Anak) +
                (rate.Hewan * entry_a.Hewan) +
                (rate.Gayor * entry_a.Gayor) +
                (rate.Carter * entry_a.Carter) +
                (rate.BarCur * entry_a.BarangPendapatan))
                AS total,
                (
                    SELECT
                    SUM(
                        (rate.Gol1 * entry_b.Gol1) + 
                        (rate.Gol2 * entry_b.Gol2) +
                        (rate.Gol3 * entry_b.Gol3) +
                        (rate.Gol4Pen * entry_b.Gol4Pen) +
                        (rate.Gol4Bar * entry_b.Gol4Bar) +
                        (rate.Gol5Pen * entry_b.Gol5Pen) +
                        (rate.Gol5Bar * entry_b.Gol5Bar) +
                        (rate.Gol6Pen * entry_b.Gol6Pen) +
                        (rate.Gol6Bar * entry_b.Gol6Bar) +
                        (rate.Gol7 * entry_b.Gol7) +
                        (rate.Gol8 * entry_b.Gol8) +
                        (rate.Gol9 * entry_b.Gol9) +
                        (rate.DewasaEksekutif * entry_b.DewasaEksekutif) +
                        (rate.BayiEksekutif * entry_b.BayiEksekutif) +
                        (rate.DewasaBisnis * entry_b.DewasaBisnis) +
                        (rate.BayiBisnis * entry_b.BayiBisnis) +
                        (rate.DewasaEkonomi * entry_b.DewasaEkonomi) +
                        (rate.BayiEkonomi * entry_b.BayiEkonomi) +
                        (rate.Suplesi1Dewasa * entry_b.Suplesi1Dewasa) +
                        (rate.Suplesi1Anak * entry_b.Suplesi1Anak) +
                        (rate.Suplesi2Dewasa * entry_b.Suplesi2Dewasa) +
                        (rate.Suplesi2Anak * entry_b.Suplesi2Anak) +
                        (rate.Hewan * entry_b.Hewan) +
                        (rate.Gayor * entry_b.Gayor) +
                        (rate.Carter * entry_b.Carter) +
                        (rate.BarCur * entry_b.BarangPendapatan)
                        )
                        FROM entry_data as entry_b
                        JOIN rate ON routes.id = rate.id_route AND entry_b.date >= rate.start_date and entry_b.rate_type = rate.rate_type
                        WHERE MONTHNAME(entry_b.DATE) = "' . $lastMonth . '" AND YEAR(entry_b.DATE) = "' . $lastYear . '"
                        GROUP BY harbour
                    ) AS totalLastYear2,
                    (
                        SELECT COUNT(case when trips.trip != 1 then 1 END)
                        FROM entry_data as entry_c
                        join trips on trips.id = entry_c.id_trip
                        WHERE MONTHNAME(entry_c.DATE) = "' . $lastMonth . '" AND YEAR(entry_c.DATE) = "' . $lastYear . '" AND entry_a.id_harbour = entry_c.id_harbour
                        GROUP BY harbour
                    ) as tripLastYear2,
                    (
                        SELECT sum(trip)
                        FROM harbour_target
                        where entry_a.id_harbour = harbour_target.id_harbour
                        GROUP BY id_harbour
                    ) as target_trip,
                    (
                        SELECT sum(target)
                        FROM harbour_target
                        where entry_a.id_harbour = harbour_target.id_harbour
                        GROUP BY id_harbour
                    ) as target'
        );
        $this->db->join($textDepan.$textTengah.$textBelakang,$textAkhir);
        $this->db->join('routes', 'entry_a.id_route = routes.id');
        $this->db->join('ferry', 'entry_a.id_ferry = ferry.id');
        $this->db->join('harbour_target', 'entry_a.id_ferry = harbour_target.id_ferry AND entry_a.id_harbour = harbour_target.id_harbour AND entry_a.id_route = harbour_target.id_route AND monthname(entry_a.date) = harbour_target.month');
        $this->db->join('harbours', 'harbours.id_harbours = entry_a.id_harbour');
        $this->db->join('rate', 'routes.id = rate.id_route AND entry_a.date >= rate.start_date and entry_a.rate_type = rate.rate_type');
        $this->db->join('trips', 'trips.id = entry_a.id_trip');
        if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->where('monthname(entry_a.date)', date("F", strtotime('-2 month')));
        $this->db->where('year(entry_a.date)', date("Y"));
        $this->db->group_by(' month(entry_a.date),harbour');
        $this->db->order_by('harbour');
        return $this->db->get('entry_data as entry_a')->result_array();
    }

    public function incomeDaily()
    {
        if ($this->session->userdata('logged_in'))
            $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('ferry, harbour,route,
                COUNT(case when trip != 1 then 1 END) AS "Jumlah Trip", id_trip as "Jenis Operasi",
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
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->where('day(date)', date("d"));
        $this->db->where('MONTHname(date)', date("F", strtotime('-2 month')));
        $this->db->where('year(date)', date("Y"));
        // $this->db->where('entry_data.id_trip', 'REGULER');
        $this->db->group_by('ferry, route');
        return $this->db->get('entry_data')->result_array();
    }

    public function incomeDailyPerShip()
    {
        if ($this->session->userdata('logged_in'))
            $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('ferry, harbour,route,
                COUNT(case when trip != 1 then 1 END) AS "Jumlah Trip", id_trip as "Jenis Operasi",
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
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->where('day(date)', date("d"));
        $this->db->where('MONTHname(date)', date("F", strtotime('-2 month')));
        $this->db->where('year(date)', date("Y"));
        // $this->db->where('entry_data.id_trip', 'REGULER');
        $this->db->group_by(' ferry');
        return $this->db->get('entry_data')->result_array();
    }

    public function incomeDailyPerHarbour()
    {
        if ($this->session->userdata('logged_in'))
            $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('ferry, harbour,route,
                COUNT(case when trip != 1 then 1 END) AS "Jumlah Trip", id_trip as "Jenis Operasi",
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
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->where('day(date)', date("d"));
        $this->db->where('MONTHname(date)', date("F", strtotime('-2 month')));
        $this->db->where('year(date)', date("Y"));
        // $this->db->where('entry_data.id_trip', 'REGULER');
        $this->db->group_by(' harbour');
        return $this->db->get('entry_data')->result_array();
    }

    public function totalDaily()
    {
        if ($this->session->userdata('logged_in'))
            $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('ferry,COUNT(case when trip != 1 then 1 END) AS trip,
        
        route AS rute,
        harbour,
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
        SUM((rate.Gol1 * entry_data.Gol1) + 
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
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->where('day(date) <=', date("d"));
        // $this->db->where('monthname(date)', date("F"));
        $this->db->where('monthname(date)', date("F", strtotime('-2 month')));
        $this->db->where('year(date)', date("Y"));
        $this->db->group_by(' month(date), ferry,route');
        return $this->db->get('entry_data')->result_array();
    }

    public function totalDailyPerShip()
    {
        if ($this->session->userdata('logged_in'))
            $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('ferry,COUNT(case when trip != 1 then 1 END) AS trip,
        
        route AS rute,
        harbour,
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
        SUM((rate.Gol1 * entry_data.Gol1) + 
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
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->where('day(date) <=', date("d"));
        // $this->db->where('monthname(date)', date("F"));
        $this->db->where('monthname(date)', date("F", strtotime('-2 month')));
        $this->db->where('year(date)', date("Y"));
        $this->db->group_by(' month(date), ferry');
        return $this->db->get('entry_data')->result_array();
    }

    public function totalDailyPerHarbour()
    {
        if ($this->session->userdata('logged_in'))
            $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('ferry,COUNT(case when trip != 1 then 1 END) AS trip,
        
        route AS rute,
        harbour,
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
        SUM((rate.Gol1 * entry_data.Gol1) + 
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
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        if ($this->session->userdata('logged_in') && $this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->where('day(date) <=', date("d"));
        // $this->db->where('monthname(date)', date("F"));
        $this->db->where('monthname(date)', date("F", strtotime('-2 month')));
        $this->db->where('year(date)', date("Y"));
        $this->db->group_by(' month(date), harbour');
        return $this->db->get('entry_data')->result_array();
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