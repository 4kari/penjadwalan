<?php
class Validasi_model extends CI_Model{
    public function getValidasi($id=null){
        if ($id === null){
            return $this->db->get('Validasi')->result_array();
        } else {
            return $this->db->get_where('Validasi', ['id' => $id])->row_array();
        }
    }
    public function deleteValidasi($id){
        $this->db->delete('Validasi', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createValidasi($data){
        $this->db->insert('Validasi',$data);
        return $this->db->affected_rows();
    }
    public function updateValidasi($data,$id){
        $this->db->update('Validasi', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>