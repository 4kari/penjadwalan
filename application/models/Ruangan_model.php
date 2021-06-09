<?php
class Waktu_model extends CI_Model{
    public function getWaktu($id=null){
        if ($id === null){
            return $this->db->get('Waktu')->result_array();
        } else {
            return $this->db->get_where('Waktu', ['id' => $id])->row_array();
        }
    }
    public function deleteWaktu($id){
        $this->db->delete('Waktu', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createWaktu($data){
        $this->db->insert('Waktu',$data);
        return $this->db->affected_rows();
    }
    public function updateWaktu($data,$id){
        $this->db->update('Waktu', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>