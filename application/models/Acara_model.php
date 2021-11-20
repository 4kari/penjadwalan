<?php
class Acara_model extends CI_Model{
    
    public function createAcara($id){
        $jadwal = $this->db->get_where('Jadwal',['id'=>$id])->row_array();
        // $skripsi = json_decode($this->curl->simple_get('http://10.5.12.21/skripsi/api/Skripsi/',array("id" => $jadwal['id_skripsi']),array(CURLOPT_BUFFERSIZE => 10)),true)['data'][0];
        $skripsi = json_decode($this->curl->simple_get('http://localhost/microservice/skripsi/api/Skripsi/',array("id" => $jadwal['id_skripsi']),array(CURLOPT_BUFFERSIZE => 10)),true)['data'][0];
        $validasi=['id_jadwal'=>$jadwal['id']];
        $dval = $this->db->get_where('validasi',['id_jadwal'=>$jadwal['id']])->row_array();
        if(!$dval){
            $this->db->insert('validasi',$validasi);
        }
        $posting=[
            'id_skripsi' => $jadwal['id_skripsi'],
            'tipe' => $jadwal['tipe']+1,
            'file' => "",
            'tanggal_dibuat' => time()
        ];
        // json_decode($this->curl->simple_post('http://10.5.12.56/diskusi/api/posting/',$posting,array(CURLOPT_BUFFERSIZE => 10)),true);
        json_decode($this->curl->simple_post('http://localhost/microservice/diskusi/api/posting/',$posting,array(CURLOPT_BUFFERSIZE => 10)),true);
        return $this->db->affected_rows();
    }
}
?>