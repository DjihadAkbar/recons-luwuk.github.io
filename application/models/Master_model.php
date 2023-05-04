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
        $this->db->where('is_displaying', 'Y');
        $this->db->where('is_aproved', 'Y');
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
        // $this->db->insert('rate', $data);
        $this->db->insert('aproval_rate', $data);
    }

    
    
    //Menampilkan Tarif yang diupload ataupun diedit
    public function aprovedTarif(){
        $this->db->select('*,aproval_rate.id as id_apr,count(IF(aprove_status = "P",1,NULL)) as count_pending');
        $this->db->join('routes', 'routes.id = aproval_rate.id_route');
        $this->db->order_by('post_date', 'DESC');
    
        
        return $this->db->get('aproval_rate')->result_array();    
    }
    
    public function countPendingTarif(){
        $this->db->select('count(aprove_status) as count_pending');
        $this->db->where('aprove_status','P');
    
        
        return $this->db->get('aproval_rate')->result_array();    

    }

    //Update data aprove yang telah disetujui
    public function updateAproveTarif($dataAprove, $dataRate, $id){
        
        $this->db->where('aproval_rate.id', $id);
        $this->db->update('aproval_rate', $dataAprove);


        $this->db->query('INSERT rate (is_displaying, is_aproved, uploader, act, id_route, start_date, rate_type, Gol1,Gol2,Gol3,Gol4Pen,Gol4Bar,
        Gol5Pen,Gol5Bar,Gol6Pen,Gol6Bar,Gol7,Gol8,Gol9,DewasaEksekutif,BayiEksekutif,DewasaBisnis,BayiBisnis,DewasaEkonomi,BayiEkonomi,Suplesi1Dewasa,
        Suplesi1Anak,Suplesi2Dewasa,Suplesi2Anak,Hewan,Gayor,Carter,BarangVolume,BarCur,
        Gol1TJP,Gol2TJP,Gol3TJP,Gol4PenTJP,Gol4BarTJP,Gol5PenTJP,Gol5BarTJP,Gol6PenTJP,Gol6BarTJP,Gol7TJP,Gol8TJP,Gol9TJP,DewasaEksekutifTJP,BayiEksekutifTJP,DewasaBisnisTJP,BayiBisnisTJP,DewasaEkonomiTJP,BayiEkonomiTJP,
        Gol1IW,Gol2IW,Gol3IW,Gol4PenIW,Gol4BarIW,Gol5PenIW,Gol5BarIW,Gol6PenIW,Gol6BarIW,Gol7IW,Gol8IW,Gol9IW,DewasaEksekutifIW,BayiEksekutifIW,DewasaBisnisIW,BayiBisnisIW,DewasaEkonomiIW,BayiEkonomiIW,
        Gol1Dermaga,Gol2Dermaga,Gol3Dermaga,Gol4PenDermaga,Gol4BarDermaga,Gol5PenDermaga,Gol5BarDermaga,Gol6PenDermaga,Gol6BarDermaga,Gol7Dermaga,Gol8Dermaga,Gol9Dermaga,DewasaEksekutifDermaga,BayiEksekutifDermaga,DewasaBisnisDermaga,BayiBisnisDermaga,DewasaEkonomiDermaga,BayiEkonomiDermaga,
        Gol1Terminal,Gol2Terminal,Gol3Terminal,Gol4PenTerminal,Gol4BarTerminal,Gol5PenTerminal,Gol5BarTerminal,Gol6PenTerminal,Gol6BarTerminal,Gol7Terminal,Gol8Terminal,Gol9Terminal,DewasaEksekutifTerminal,BayiEksekutifTerminal,DewasaBisnisTerminal,BayiBisnisTerminal,DewasaEkonomiTerminal,BayiEkonomiTerminal,
        Gol1PasMasuk,Gol2PasMasuk,Gol3PasMasuk,Gol4PenPasMasuk,Gol4BarPasMasuk,Gol5PenPasMasuk,Gol5BarPasMasuk,Gol6PenPasMasuk,Gol6BarPasMasuk,Gol7PasMasuk,Gol8PasMasuk,Gol9PasMasuk,DewasaEksekutifPasMasuk,BayiEksekutifPasMasuk,DewasaBisnisPasMasuk,BayiBisnisPasMasuk,DewasaEkonomiPasMasuk,BayiEkonomiPasMasuk)
        SELECT aprove_status, aprove_status, post_person, act, id_route, start_date, rate_type, Gol1,Gol2,Gol3,Gol4Pen,Gol4Bar,
        Gol5Pen,Gol5Bar,Gol6Pen,Gol6Bar,Gol7,Gol8,Gol9,DewasaEksekutif,BayiEksekutif,DewasaBisnis,BayiBisnis,DewasaEkonomi,BayiEkonomi,Suplesi1Dewasa,
        Suplesi1Anak,Suplesi2Dewasa,Suplesi2Anak,Hewan,Gayor,Carter,BarangVolume,BarCur,
        Gol1TJP,Gol2TJP,Gol3TJP,Gol4PenTJP,Gol4BarTJP,Gol5PenTJP,Gol5BarTJP,Gol6PenTJP,Gol6BarTJP,Gol7TJP,Gol8TJP,Gol9TJP,DewasaEksekutifTJP,BayiEksekutifTJP,DewasaBisnisTJP,BayiBisnisTJP,DewasaEkonomiTJP,BayiEkonomiTJP,
        Gol1IW,Gol2IW,Gol3IW,Gol4PenIW,Gol4BarIW,Gol5PenIW,Gol5BarIW,Gol6PenIW,Gol6BarIW,Gol7IW,Gol8IW,Gol9IW,DewasaEksekutifIW,BayiEksekutifIW,DewasaBisnisIW,BayiBisnisIW,DewasaEkonomiIW,BayiEkonomiIW,
        Gol1Dermaga,Gol2Dermaga,Gol3Dermaga,Gol4PenDermaga,Gol4BarDermaga,Gol5PenDermaga,Gol5BarDermaga,Gol6PenDermaga,Gol6BarDermaga,Gol7Dermaga,Gol8Dermaga,Gol9Dermaga,DewasaEksekutifDermaga,BayiEksekutifDermaga,DewasaBisnisDermaga,BayiBisnisDermaga,DewasaEkonomiDermaga,BayiEkonomiDermaga,
        Gol1Terminal,Gol2Terminal,Gol3Terminal,Gol4PenTerminal,Gol4BarTerminal,Gol5PenTerminal,Gol5BarTerminal,Gol6PenTerminal,Gol6BarTerminal,Gol7Terminal,Gol8Terminal,Gol9Terminal,DewasaEksekutifTerminal,BayiEksekutifTerminal,DewasaBisnisTerminal,BayiBisnisTerminal,DewasaEkonomiTerminal,BayiEkonomiTerminal,
        Gol1PasMasuk,Gol2PasMasuk,Gol3PasMasuk,Gol4PenPasMasuk,Gol4BarPasMasuk,Gol5PenPasMasuk,Gol5BarPasMasuk,Gol6PenPasMasuk,Gol6BarPasMasuk,Gol7PasMasuk,Gol8PasMasuk,Gol9PasMasuk,DewasaEksekutifPasMasuk,BayiEksekutifPasMasuk,DewasaBisnisPasMasuk,BayiBisnisPasMasuk,DewasaEkonomiPasMasuk,BayiEkonomiPasMasuk
        FROM aproval_rate
        WHERE aproval_rate.id ='.$id);
        
    }

    //update data disaprove yang telah tidak disetujui
    public function updateDisaproveTarif($dataAprove, $id){
        
        $this->db->where('aproval_rate.id', $id);
        $this->db->update('aproval_rate', $dataAprove);        
    }
    

    public function updateAproveEditTarif($dataAprove, $idAprove, $idRate){
        $this->db->where('aproval_rate.id', $idAprove);
        $this->db->update('aproval_rate', $dataAprove);
        
        $this->db->where('rate.id', $idRate);
        $this->db->delete('rate');

        $this->db->query('INSERT rate (is_displaying, is_aproved, uploader, act, id_route, start_date, rate_type, Gol1,Gol2,Gol3,Gol4Pen,Gol4Bar,
        Gol5Pen,Gol5Bar,Gol6Pen,Gol6Bar,Gol7,Gol8,Gol9,DewasaEksekutif,BayiEksekutif,DewasaBisnis,BayiBisnis,DewasaEkonomi,BayiEkonomi,Suplesi1Dewasa,
        Suplesi1Anak,Suplesi2Dewasa,Suplesi2Anak,Hewan,Gayor,Carter,BarangVolume,BarCur,
        Gol1TJP,Gol2TJP,Gol3TJP,Gol4PenTJP,Gol4BarTJP,Gol5PenTJP,Gol5BarTJP,Gol6PenTJP,Gol6BarTJP,Gol7TJP,Gol8TJP,Gol9TJP,DewasaEksekutifTJP,BayiEksekutifTJP,DewasaBisnisTJP,BayiBisnisTJP,DewasaEkonomiTJP,BayiEkonomiTJP,
        Gol1IW,Gol2IW,Gol3IW,Gol4PenIW,Gol4BarIW,Gol5PenIW,Gol5BarIW,Gol6PenIW,Gol6BarIW,Gol7IW,Gol8IW,Gol9IW,DewasaEksekutifIW,BayiEksekutifIW,DewasaBisnisIW,BayiBisnisIW,DewasaEkonomiIW,BayiEkonomiIW,
        Gol1Dermaga,Gol2Dermaga,Gol3Dermaga,Gol4PenDermaga,Gol4BarDermaga,Gol5PenDermaga,Gol5BarDermaga,Gol6PenDermaga,Gol6BarDermaga,Gol7Dermaga,Gol8Dermaga,Gol9Dermaga,DewasaEksekutifDermaga,BayiEksekutifDermaga,DewasaBisnisDermaga,BayiBisnisDermaga,DewasaEkonomiDermaga,BayiEkonomiDermaga,
        Gol1Terminal,Gol2Terminal,Gol3Terminal,Gol4PenTerminal,Gol4BarTerminal,Gol5PenTerminal,Gol5BarTerminal,Gol6PenTerminal,Gol6BarTerminal,Gol7Terminal,Gol8Terminal,Gol9Terminal,DewasaEksekutifTerminal,BayiEksekutifTerminal,DewasaBisnisTerminal,BayiBisnisTerminal,DewasaEkonomiTerminal,BayiEkonomiTerminal,
        Gol1PasMasuk,Gol2PasMasuk,Gol3PasMasuk,Gol4PenPasMasuk,Gol4BarPasMasuk,Gol5PenPasMasuk,Gol5BarPasMasuk,Gol6PenPasMasuk,Gol6BarPasMasuk,Gol7PasMasuk,Gol8PasMasuk,Gol9PasMasuk,DewasaEksekutifPasMasuk,BayiEksekutifPasMasuk,DewasaBisnisPasMasuk,BayiBisnisPasMasuk,DewasaEkonomiPasMasuk,BayiEkonomiPasMasuk)
        SELECT aprove_status, aprove_status, post_person, act, id_route, start_date, rate_type, Gol1,Gol2,Gol3,Gol4Pen,Gol4Bar,
        Gol5Pen,Gol5Bar,Gol6Pen,Gol6Bar,Gol7,Gol8,Gol9,DewasaEksekutif,BayiEksekutif,DewasaBisnis,BayiBisnis,DewasaEkonomi,BayiEkonomi,Suplesi1Dewasa,
        Suplesi1Anak,Suplesi2Dewasa,Suplesi2Anak,Hewan,Gayor,Carter,BarangVolume,BarCur,
        Gol1TJP,Gol2TJP,Gol3TJP,Gol4PenTJP,Gol4BarTJP,Gol5PenTJP,Gol5BarTJP,Gol6PenTJP,Gol6BarTJP,Gol7TJP,Gol8TJP,Gol9TJP,DewasaEksekutifTJP,BayiEksekutifTJP,DewasaBisnisTJP,BayiBisnisTJP,DewasaEkonomiTJP,BayiEkonomiTJP,
        Gol1IW,Gol2IW,Gol3IW,Gol4PenIW,Gol4BarIW,Gol5PenIW,Gol5BarIW,Gol6PenIW,Gol6BarIW,Gol7IW,Gol8IW,Gol9IW,DewasaEksekutifIW,BayiEksekutifIW,DewasaBisnisIW,BayiBisnisIW,DewasaEkonomiIW,BayiEkonomiIW,
        Gol1Dermaga,Gol2Dermaga,Gol3Dermaga,Gol4PenDermaga,Gol4BarDermaga,Gol5PenDermaga,Gol5BarDermaga,Gol6PenDermaga,Gol6BarDermaga,Gol7Dermaga,Gol8Dermaga,Gol9Dermaga,DewasaEksekutifDermaga,BayiEksekutifDermaga,DewasaBisnisDermaga,BayiBisnisDermaga,DewasaEkonomiDermaga,BayiEkonomiDermaga,
        Gol1Terminal,Gol2Terminal,Gol3Terminal,Gol4PenTerminal,Gol4BarTerminal,Gol5PenTerminal,Gol5BarTerminal,Gol6PenTerminal,Gol6BarTerminal,Gol7Terminal,Gol8Terminal,Gol9Terminal,DewasaEksekutifTerminal,BayiEksekutifTerminal,DewasaBisnisTerminal,BayiBisnisTerminal,DewasaEkonomiTerminal,BayiEkonomiTerminal,
        Gol1PasMasuk,Gol2PasMasuk,Gol3PasMasuk,Gol4PenPasMasuk,Gol4BarPasMasuk,Gol5PenPasMasuk,Gol5BarPasMasuk,Gol6PenPasMasuk,Gol6BarPasMasuk,Gol7PasMasuk,Gol8PasMasuk,Gol9PasMasuk,DewasaEksekutifPasMasuk,BayiEksekutifPasMasuk,DewasaBisnisPasMasuk,BayiBisnisPasMasuk,DewasaEkonomiPasMasuk,BayiEkonomiPasMasuk
        FROM aproval_rate
        WHERE aproval_rate.id ='.$idAprove);
    }

    public function updateDisaproveEditTarif($dataAprove, $id){
        
        $this->db->where('aproval_rate.id', $id);
        $this->db->update('aproval_rate', $dataAprove);        
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
<<<<<<< HEAD
    public function lintasanSpv(){
        $pelabuhan = $this->session->userdata['pelabuhan'];
        $this->db->select('route as lintasan');
        $this->db->where('routes.spv IS NOT NULL');
        $query = $this->db->get('routes')->result_array();

        return $query;
    }
=======

>>>>>>> ac529ab6ce9452b844389607085401db5948f94d
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
    public function lintasanWIthName($name,$id)
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