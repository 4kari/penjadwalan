<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Jadwal extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Jadwal_model','mJadwal');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id == null) {
            $Jadwal = $this->mJadwal->getJadwal();
        } else{
            $Jadwal = $this->mJadwal->getJadwal($id);
        }
        if ($Jadwal){
            $this->response([
                'status' => true,
                'data' =>$Jadwal
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
            'Jadwal' => $this->post('Jadwal'),
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
            'Jadwal' => $this->put('Jadwal')
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