<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Waktu extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Waktu_model','mWaktu');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id == null) {
            $Waktu = $this->mWaktu->getWaktu();
        } else{
            $Waktu = $this->mWaktu->getWaktu($id);
        }
        if ($Waktu){
            $this->response([
                'status' => true,
                'data' =>$Waktu
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
            if ($this->mWaktu->deleteWaktu($id)>0){
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
            'Waktu' => $this->post('Waktu')
        ];
        
        if ($this->mWaktu->createWaktu($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Waktu baru ditambahkan'
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
            'Waktu' => $this->put('Waktu')
        ];

        if ($this->mWaktu->updateWaktu($data,$id)>0){
            $this->response([
                'status' => true,
                'message' => 'Waktu telah diperbarui'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal memperbarui Waktu'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}