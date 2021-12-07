<?php
class Validasi_model extends CI_Model{
    public function getValidasi(){
        return $this->db->get('Validasi')->result_array();
    }
    public function getValidasiById($id=null){
        return $this->db->get_where('Validasi', ['id' => $id])->result_array();
    }
    public function getValidasiByJadwal($id=null){
        return $this->db->get_where('Validasi', ['id_jadwal' => $id])->result_array();
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