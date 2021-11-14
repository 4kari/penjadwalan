<?php
class Kelola_Jadwal_model extends CI_Model{
    public function getJadwal($id_skripsi){
        if($id_skripsi){
            return $this->db->get_where('Jadwal',['id_skripsi'=>$id_skripsi])->result_array();
        }else{
            return $this->db->get('Jadwal')->result_array();
        }
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