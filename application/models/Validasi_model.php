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
        $val=$this->db->get_where('Validasi', ['id' => $id])->row_array();

        if($val['pembimbing_1'] && $val['pembimbing_2'] && $val['penguji_1'] && $val['penguji_2'] && $val['penguji_3']){
            $jadwal = $this->db->get_where('jadwal',['id'=>$val['id_jadwal']])->row_array();
            $skripsi = json_decode($this->curl->simple_get('http://localhost/microservice/skripsi/api/Skripsi/',array("id" => $jadwal['id_skripsi']),array(CURLOPT_BUFFERSIZE => 10)),true)['data'][0];
            if($skripsi['status']==2 || $skripsi['status']==5){$skripsi['status']=$skripsi['status']+1;}
            json_decode($this->curl->simple_put('http://localhost/microservice/skripsi/api/Skripsi/',$skripsi, array(CURLOPT_BUFFERSIZE => 10)),true);
            // json_decode($this->curl->simple_put('http://10.5.12.21/skripsi/api/skripsi/',$skripsi, array(CURLOPT_BUFFERSIZE => 10)),true);
        }
        return $this->db->affected_rows();
    }
}
?>