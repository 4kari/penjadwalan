<?php
class Tipe_model extends CI_Model{
    public function getTipe($id=null){
        if ($id === null){
            return $this->db->get('Tipe')->result_array();
        } else {
            return $this->db->get_where('Tipe', ['id' => $id])->row_array();
        }
    }
    public function deleteTipe($id){
        $this->db->delete('Tipe', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createTipe($data){
        $this->db->insert('Tipe',$data);
        return $this->db->affected_rows();
    }
    public function updateTipe($data,$id){
        $this->db->update('Tipe', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>