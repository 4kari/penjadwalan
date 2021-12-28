<?php
class Validasi_model extends CI_Model{
    protected $ipSkripsi='http://10.5.12.24/skripsi/api/';
    protected $ipPenjadwalan='http://10.5.12.82/penjadwalan/api/';
    protected $ipDiskusi='http://10.5.12.56/diskusi/api/';
    protected $ipUser='http://10.5.12.16/user/api/';

    // protected $ipSkripsi='http://localhost/microservice/skripsi/api/';
    // protected $ipPenjadwalan='http://localhost/microservice/penjadwalan/api/';
    // protected $ipDiskusi='http://localhost/microservice/diskusi/api/';
    // protected $ipUser='http://localhost/microservice/user/api/';
    
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
            $skripsi = json_decode($this->curl->simple_get($this->ipSkripsi.'Skripsi/',array("id" => $jadwal['id_skripsi']),array(CURLOPT_BUFFERSIZE => 10)),true)['data'][0];

            if($skripsi['status']==2 || $skripsi['status']==5){$skripsi['status']=$skripsi['status']+1;}
            json_decode($this->curl->simple_put($this->ipSkripsi.'Skripsi/',$skripsi, array(CURLOPT_BUFFERSIZE => 10)),true);
        }
        return $this->db->affected_rows();
    }
}
?>