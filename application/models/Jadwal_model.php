<?php
class Jadwal_model extends CI_Model{
    public function getJadwal(){
        return $this->db->get('Jadwal')->result_array();
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
}
?>