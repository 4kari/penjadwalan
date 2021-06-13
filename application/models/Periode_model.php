<?php
class Periode_model extends CI_Model{
    public function getPeriode($id=null){
        if ($id === null){
            return $this->db->get('Periode')->result_array();
        } else {
            return $this->db->get_where('Periode', ['id' => $id])->row_array();
        }
    }
    public function deletePeriode($id){
        $this->db->delete('Periode', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createPeriode($data){
        $this->db->insert('Periode',$data);
        return $this->db->affected_rows();
    }
    public function updatePeriode($data,$id){
        $this->db->update('Periode', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>