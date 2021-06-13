<?php
class Ruangan_model extends CI_Model{
    public function getRuangan($id=null){
        if ($id === null){
            return $this->db->get('Ruangan')->result_array();
        } else {
            return $this->db->get_where('Ruangan', ['id' => $id])->row_array();
        }
    }
    public function deleteRuangan($id){
        $this->db->delete('Ruangan', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createRuangan($data){
        $this->db->insert('Ruangan',$data);
        return $this->db->affected_rows();
    }
    public function updateRuangan($data,$id){
        $this->db->update('Ruangan', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>