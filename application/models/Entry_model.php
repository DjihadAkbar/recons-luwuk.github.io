<?php
class Entry_model extends CI_Model
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

    public function entryDestination()
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];

        $this->db->select('*, harbours.harbour as harbours,trips.trip as trip,day(date) as day,year(date) as year,entry_data.id as id_entry,  b.harbour as destination_harbour');
        $this->db->join('routes', 'routes.id = entry_data.id_route');
        $this->db->join('ferry', 'entry_data.id_ferry = ferry.id');
        $this->db->join('harbours', 'harbours.id_harbours = entry_data.id_harbour');
        $this->db->join('harbours AS b', 'b.id_harbours = routes.destination');
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        $this->db->where('departure_time', '00:00:00');
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('b.harbour', $pelabuhan);
        }
        // $this->db->order_by('entry_data.id DESC');
        $this->db->order_by('year(date) DESC, month(date) DESC, day(date) DESC');
        return $this->db->get('entry_data')->result_array();
    }

    public function entryData()
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];

        $this->db->select('*, harbours.harbour as harbour,trips.trip as trip,day(date) as day,year(date) as year,entry_data.id as id_entry, b.harbour as destination_harbour');
        $this->db->join('routes', 'routes.id = entry_data.id_route');
        $this->db->join('ferry', 'entry_data.id_ferry = ferry.id');
        $this->db->join('harbours', 'harbours.id_harbours = entry_data.id_harbour');
        $this->db->join('harbours AS b', 'b.id_harbours = routes.destination');
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        $this->db->join('spv_harbour', 'spv_harbour.route = routes.id');
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            // $this->db->where('routes.spv', $pelabuhan);
            $this->db->where('spv_harbour.spv', $pelabuhan);
        }
        // $this->db->order_by('entry_data.id DESC');
        $this->db->order_by('year(date) DESC, month(date) DESC, day(date) DESC');
        return $this->db->get('entry_data')->result_array();
    }

    public function editEntryDestination($id)
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('*,  harbours.harbour as harbours, b.harbour as destination_harbour');
        $this->db->join('routes', 'routes.id = entry_data.id_route');
        $this->db->join('ferry', 'entry_data.id_ferry = ferry.id');
        $this->db->join('harbours', 'harbours.id_harbours = entry_data.id_harbour');
        $this->db->join('harbours AS b', 'b.id_harbours = routes.destination');
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        $this->db->where('entry_data.id', $id);
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', 'b.harbour');
        }

        $this->db->order_by('date DESC', 'ferry ASC');
        return $this->db->get('entry_data')->result_array();
    }
    public function editEntryData($id)
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('*');
        $this->db->join('routes', 'routes.id = entry_data.id_route');
        $this->db->join('ferry', 'entry_data.id_ferry = ferry.id');
        $this->db->join('harbours', 'harbours.id_harbours = entry_data.id_harbour');
        $this->db->join('trips', 'trips.id = entry_data.id_trip');
        $this->db->where('entry_data.id', $id);
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->order_by('date DESC', 'ferry ASC');
        return $this->db->get('entry_data')->result_array();
    }

    public function editData($data, $id)
    {
        $this->db->where('entry_data.id', $id);
        $this->db->update('entry_data', $data);
    }

    public function deleteEntryData($id)
    {
        $this->db->where('entry_data.id', $id);
        $this->db->delete('entry_data');
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
        $this->db->select('*');
        return $this->db->get('trips')->result_array();
    }

    public function rate()
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('*,rate.id as id_rate');
        $this->db->join('routes', 'routes.id = rate.id_route');
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $query = $this->db->get('rate')->result_array();
        return $query;
    }

    public function produksi()
    {
        $this->db->select('id, id_production, production as produksi, type');
        $query = $this->db->get('productions')->result_array();
        return $query;
    }

    public function tarif()
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->distinct();
        $this->db->select('rate_type as tarif');
        $this->db->join('routes', 'rate.id_route = routes.id');
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $this->db->order_by('start_date ASC');
        $query = $this->db->get('rate')->result_array();
        return $query;
    }

    public function editTarif($data, $id)
    {
        $this->db->where('rate.id', $id);
        $this->db->update('rate', $data);
    }

    public function editDataTarif($id)
    {
        $this->db->select('*');
        $this->db->join('routes', 'routes.id = rate.id_route');
        $this->db->where('rate.id', $id);

        return $this->db->get('rate')->result_array();
    }

    public function deleteTarif($id)
    {
        $this->db->where('rate.id', $id);
        $this->db->delete('rate');
    }

    public function tambahTarif($data)
    {
        $this->db->insert('rate', $data);
    }

    public function kapal_spv()
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->distinct();
        $this->db->select('id_ferry, ferry as kapal');
        $this->db->join('ferry', 'spv_ferry.id_ferry = ferry.id');
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('spv', $pelabuhan);
        }
        $query = $this->db->get('spv_ferry')->result_array();

        return $query;
    }

    public function kapal()
    {
        $this->db->distinct();
        $this->db->select('id, ferry as kapal, code, company,grt,type,register_num,imo_num,id_card,mmsi,length_over_all,breadth,draft,gt,build_year,
        shipyard,registration_port,anchor_weight');
        $query = $this->db->get('ferry')->result_array();
        return $query;
    }
    public function lintasan()
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('route as lintasan, id');
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $query = $this->db->get('routes')->result_array();

        return $query;
    }
    public function semuaLintasan()
    {
        $this->db->select('id, route as lintasan, asal.harbour as asal, tujuan.harbour as tujuan, segment,distance,travel_time');
        $this->db->join('harbours as asal', 'asal.id_harbours = routes.origin');
        $this->db->join('harbours as tujuan', 'tujuan.id_harbours = routes.destination');
        $this->db->order_by('route');
        $query = $this->db->get('routes')->result_array();

        return $query;
    }

    public function semuaPelabuhan()
    {
        $this->db->distinct();
        $this->db->select('harbour as pelabuhan, id_harbours, code, timezone, name');
        $this->db->join('routes', 'harbours.id_harbours = routes.origin');
        return $this->db->get('harbours')->result_array();
    }

    public function pelabuhan()
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->distinct();
        $this->db->select('harbour as pelabuhan, id_harbours, code, timezone, name');
        $this->db->join('routes', 'harbours.id_harbours = routes.origin');
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        return $this->db->get('harbours')->result_array();
    }

    public function users()
    {
        $query = $this->db->select('*')->get('users');
        return $query->result_array();
    }
    public function lintasanWIthId($id)
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('route as lintasan');
        $this->db->where('id', $id);
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $query = $this->db->get('routes')->result_array();

        return $query;
    }
    public function harbourWIthId($id)
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('harbour as pelabuhan');
        $this->db->where('id_harbours', $id);
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $query = $this->db->get('harbours')->result_array();

        return $query;
    }
    public function lintasanWIthName($name, $id)
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('id');
        $this->db->where('route', $name);
        $this->db->where('origin', $id);
        if ($this->session->userdata['jabatan'] == 'SUPERVISOR') {
            $this->db->where('routes.spv', $pelabuhan);
        }
        $query = $this->db->get('routes')->result_array();

        return $query;
    }
}
