<?php
class Acara_model extends CI_Model{
    // protected $ipSkripsi='http://10.5.12.21/skripsi/api/';
    // protected $ipPenjadwalan='http://10.5.12.47/penjadwalan/api/';
    // protected $ipDiskusi='http://10.5.12.56/diskusi/api/';
    // protected $ipUser='http://10.5.12.16/user/api/';

    protected $ipSkripsi='http://localhost/microservice/skripsi/api/';
    protected $ipPenjadwalan='http://localhost/microservice/penjadwalan/api/';
    protected $ipDiskusi='http://localhost/microservice/diskusi/api/';
    protected $ipUser='http://localhost/microservice/user/api/';
    
    public function createAcara($id){
        $jadwal = $this->db->get_where('Jadwal',['id'=>$id])->row_array();
        $skripsi = json_decode($this->curl->simple_get($this->ipSkripsi.'Skripsi/',array("id" => $jadwal['id_skripsi']),array(CURLOPT_BUFFERSIZE => 10)),true)['data'][0];
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
        json_decode($this->curl->simple_post($this->ipDiskusi.'posting/',$posting,array(CURLOPT_BUFFERSIZE => 10)),true);
        
        if($skripsi['status']==1 || $skripsi['status']==4){$skripsi['status']=$skripsi['status']+1;}
        json_decode($this->curl->simple_put($this->ipSkripsi.'Skripsi/',$skripsi, array(CURLOPT_BUFFERSIZE => 10)),true);
        return $this->db->affected_rows();
    }
}
?>