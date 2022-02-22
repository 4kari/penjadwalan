<?php
class Jadwal_model extends CI_Model{
    // protected $ipSkripsi='http://10.5.12.24/skripsi/api/';
    // protected $ipPenjadwalan='http://10.5.12.82/penjadwalan/api/';
    // protected $ipDiskusi='http://10.5.12.56/diskusi/api/';
    // protected $ipUser='http://10.5.12.18/user/api/';

    protected $ipSkripsi='http://localhost:8080/microservice/skripsi/api/';
    protected $ipPenjadwalan='http://localhost:8080/microservice/penjadwalan/api/';
    protected $ipDiskusi='http://localhost:8080/microservice/diskusi/api/';
    protected $ipUser='http://localhost:8080/microservice/user/api/';
    
    public function getJadwal(){
        $jadwal = $this->db->get('Jadwal')->result_array();
        $jadwal = $this->olahJadwal($jadwal);
        return $jadwal;
    }
    public function getJadwalById($id=null){
        $jadwal = $this->db->get_where('Jadwal', ['id' => $id])->result_array();
        $jadwal = $this->olahJadwal($jadwal);
        return $jadwal;
    }
    public function getJadwalBySkripsi($id=null){
        $jadwal = $this->db->get_where('jadwal', ['id_skripsi' => $id])->result_array();
        $jadwal = $this->olahJadwal($jadwal);
        return $jadwal;
}
    public function deleteJadwal($id){
        $this->db->delete('Jadwal', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createJadwal($data){
        $this->db->insert('Jadwal',$data);
        return $this->db->affected_rows();
    }
    public function updateJadwal($data,$id){
        $this->db->update('Jadwal', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function olahJadwal($data){
        $hasil=[];
        foreach($data as $d){
            $id_skripsi = $d['id_skripsi'];
            $skripsi = json_decode($this->curl->simple_get($this->ipSkripsi.'Skripsi/',array("id" => $id_skripsi),array(CURLOPT_BUFFERSIZE => 10)),true);
            $d['data_skripsi']=$skripsi['data'][0];
            $ruangan = $this->db->get_where('Ruangan', ['id' => $d['ruangan']])->row_array();
            $periode = $this->db->get_where('Periode', ['id' => $d['periode']])->row_array();
            $waktu =  $this->db->get_where('Waktu', ['id' => $d['waktu']])->row_array();
            if($ruangan){$d['kruangan']=$ruangan['ruangan'];}else{$d['kruangan']=$ruangan;}
            if($periode){$d['kperiode']=$periode['periode'];}else{$d['kperiode']=$periode;}
            if($waktu){$d['kwaktu']=$waktu['waktu'];}else{$d['kwaktu']=$waktu;}
            array_push($hasil,$d);
        }
        return $hasil;
    }
}
?>