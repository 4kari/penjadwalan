<?php
class Kelola_Jadwal_model extends CI_Model{
    public function getJadwal($tipe){
        if($tipe){
            return $this->db->get_where('Jadwal',['tipe'=>$tipe])->result_array();
        }else{
            return $this->db->get('Jadwal')->result_array();
        }
    }
    public function deleteJadwal($id){
        $this->db->delete('Jadwal', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createJadwal($data){
        $this->db->insert('Jadwal',$data);
        return $this->db->affected_rows();
    }
    public function updateJadwal($data,$penguji,$id){
        $jadwal=$this->db->get_where('Jadwal',['id'=>$id])->row_array();
        if($jadwal['tipe']==1){
            // $skripsi = json_decode($this->curl->simple_get('http://10.5.12.21/skripsi/api/Skripsi/',array("id" => $id),array(CURLOPT_BUFFERSIZE => 10)),true)['data'][0];
            $skripsi = json_decode($this->curl->simple_get('http://localhost/microservice/skripsi/api/Skripsi/',array("id" => $jadwal['id_skripsi']),array(CURLOPT_BUFFERSIZE => 10)),true)['data'][0];
            $skripsi['penguji_1']=$penguji['penguji_1'];
            $skripsi['penguji_2']=$penguji['penguji_2'];
            $skripsi['penguji_3']=$penguji['penguji_3'];
            // json_decode($this->curl->simple_put('http://10.5.12.21/skripsi/api/Skripsi/',$skripsi,array(CURLOPT_BUFFERSIZE => 10)),true);
            json_decode($this->curl->simple_put('http://localhost/microservice/skripsi/api/Skripsi/',$skripsi,array(CURLOPT_BUFFERSIZE => 10)),true);
        }
        $this->db->update('Jadwal', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function olahJadwal($data){
        $hasil=[];
        foreach($data as $d){
            $id = $d['id'];
            $id_skripsi = $d['id_skripsi'];
            $validasi = $this->db->get_where('validasi',['id_jadwal'=>$id])->row_array();
            if(!$validasi){
                // $skripsi = json_decode($this->curl->simple_get('http://10.5.12.21/skripsi/api/Skripsi/',array("id" => $id_skripsi),array(CURLOPT_BUFFERSIZE => 10)),true);
                $skripsi = json_decode($this->curl->simple_get('http://localhost/microservice/skripsi/api/Skripsi/',array("id" => $id_skripsi),array(CURLOPT_BUFFERSIZE => 10)),true);
                $ruangan = $this->db->get_where('Ruangan', ['id' => $d['ruangan']])->row_array();
                $periode = $this->db->get_where('Periode', ['id' => $d['periode']])->row_array();
                $waktu =  $this->db->get_where('Waktu', ['id' => $d['waktu']])->row_array();
                $d['data_skripsi']=$skripsi['data'][0];
                if($ruangan){$d['kruangan']=$ruangan['ruangan'];}else{$d['kruangan']=$ruangan;}
                if($periode){$d['kperiode']=$periode['periode'];}else{$d['kperiode']=$periode;}
                if($waktu){$d['kwaktu']=$waktu['waktu'];}else{$d['kwaktu']=$waktu;}
                array_push($hasil,$d);
            }
        }
        return $hasil;
    }
}
?>