<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Kelola_Jadwal extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Kelola_Jadwal_model','mJadwal');
    }
    public function index_get(){
        $tipe = $this->get('tipe');
        $jadwal = $this->mJadwal->getJadwal($tipe);
        $jadwal = $this->mJadwal->olahJadwal($jadwal);
        if ($jadwal){
            $this->response([
                'status' => true,
                'data' =>$jadwal
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete(){
        $id = $this->delete('id');
        if ($id == null){
            $this->response([
                'status' => false,
                'message' => 'tambahkan id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mJadwal->deleteJadwal($id)>0){
                //ok
                $this->response([
                    'status' => true,
                    'message' => 'terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }
            else{
                $this->response([
                    'status' => false,
                    'message' => 'id tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }          
        }
    }
    public function index_post(){
        $data=[
            'id_skripsi'=>$this->post('id_skripsi'),
            'tipe' => $this->post('tipe')
        ];
        
        if ($this->mJadwal->createJadwal($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Jadwal baru ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan data baru'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function index_put(){
        $id=$this->put('id');
        $data=[
            'tanggal' => $this->put('Tanggal'),
            'waktu' => $this->put('Waktu'),
            'ruangan' => $this->put('Ruangan'),
            'periode' => $this->put('Periode')
        ];

        if ($this->mJadwal->updateJadwal($data,$id)>0){
            $this->response([
                'status' => true,
                'message' => 'Jadwal telah diperbarui'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal memperbarui Jadwal'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}