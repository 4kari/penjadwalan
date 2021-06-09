<?php
class Jadwal_model extends CI_Model{
    public function getJadwal($id=null){
        if ($id === null){
            return $this->db->get('Jadwal')->result_array();
        } else {
            return $this->db->get_where('Jadwal', ['id' => $id])->row_array();
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