<?php
class Jadwal_model extends CI_Model{
    public function getJadwal(){
        $jadwal = $this->db->get('Jadwal')->result_array();
        $jadwal = $this->olahJadwal($jadwal);
        return $jadwal;
    }
    public function getJadwalById($id=null){
            return $this->db->get_where('Jadwal', ['id' => $id])->result_array();
    }
    public function getJadwalBySkripsi($id=null){
        return $this->db->get_where('jadwal', ['id_skripsi' => $id])->result_array();
}
    public function deleteJadwal($id){
        $this->db->delete('Jadwal', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createJadwal($data){
        $this->db->insert('Jadwal',$data);
        return $this->db->affected_rows();
    }
    public function updateJadwal($data,$id){
        $this->db->update('Jadwal', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function olahJadwal($data){
        $hasil=[];
        foreach($data as $d){
            $ruangan = $this->db->get_where('Ruangan', ['id' => $d['ruangan']])->row_array();
            $periode = $this->db->get_where('Periode', ['id' => $d['periode']])->row_array();
            $waktu =  $this->db->get_where('Waktu', ['id' => $d['waktu']])->row_array();
            if($ruangan){$d['kruangan']=$ruangan['ruangan'];}else{$d['kruangan']=$ruangan;}
            if($periode){$d['kperiode']=$periode['periode'];}else{$d['kperiode']=$periode;}
            if($waktu){$d['kwaktu']=$waktu['waktu'];}else{$d['kwaktu']=$waktu;}
            array_push($hasil,$d);
        }
        return $hasil;
    }
}
?>