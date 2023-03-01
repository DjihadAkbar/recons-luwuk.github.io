<?php
class Master_model extends CI_Model
{

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
    public function editDataPelabuhan($id){
        $this->db->select('*');
        $this->db->where('id_harbours', $id);
        
        return $this->db->get('harbours')->result_array();
    }
    public function editPelabuhan($data, $id){
        $this->db->where('harbours.id_harbours', $id);
        $this->db->update('harbours', $data);
    }

    public function deletePelabuhan($id){
        $this->db->where('harbours.id_harbours', $id);
        $this->db->delete('harbours');
    }

    public function tambahPelabuhan($data)
    {
        $this->db->insert('harbours', $data);
    }

    public function editDataLintasan($id){
        $this->db->select('*, asal.harbour as asal, tujuan.harbour as tujuan');
        $this->db->join('harbours as asal', 'asal.id_harbours = routes.origin');
        $this->db->join('harbours as tujuan', 'tujuan.id_harbours = routes.destination');
        $this->db->where('id', $id);
        
        return $this->db->get('routes')->result_array();
    }
    public function editLintasan($data, $id){
        $this->db->where('routes.id', $id);
        $this->db->update('routes', $data);
    }

    public function deleteLintasan($id){
        $this->db->where('routes.id', $id);
        $this->db->delete('routes');
    }

    public function tambahLintasan($data)
    {
        $this->db->insert('routes', $data);
    }

    public function kapal()
    {
        $this->db->distinct();
        $this->db->select('id, ferry as kapal, code, company,grt,type,register_num,imo_num,id_card,mmsi,length_over_all,breadth,draft,gt,build_year,
        shipyard,registration_port,anchor_weight');
        $query = $this->db->get('ferry')->result_array();
        return $query;
    }
    public function tambahKapal($data)
    {
        $this->db->insert('ferry', $data);
    }
    public function editDataKapal($id){
        $this->db->select('*');
        $this->db->where('id', $id);
        
        return $this->db->get('ferry')->result_array();
    }
    public function editKapal($data, $id){
        $this->db->where('ferry.id', $id);
        $this->db->update('ferry', $data);
    }

    public function deleteKapal($id){
        $this->db->where('ferry.id', $id);
        $this->db->delete('ferry');
    }

    public function editTarif($data, $id){
        $this->db->where('rate.id', $id);
        $this->db->update('rate', $data);
    }

    public function editDataTarif($id){
        $this->db->select('*');
        $this->db->join('routes', 'routes.id = rate.id_route');
        $this->db->where('rate.id', $id);
        
        return $this->db->get('rate')->result_array();
    }

    public function deleteTarif($id){
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

    
    public function lintasan()
    {
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('id, route as lintasan');
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

    public function semuaPelabuhan(){
        $this->db->distinct();
        $this->db->select('harbour as pelabuhan, id_harbours, code, timezone, name');
        $this->db->join('routes', 'harbours.id_harbours = routes.origin');
        return $this->db->get('harbours')->result_array();
    }

    public function harbourAll(){
        $this->db->select('harbour as pelabuhan, id_harbours, code, timezone, name');
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
}