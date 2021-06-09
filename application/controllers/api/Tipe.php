<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Tipe extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Tipe_model','mTipe');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id == null) {
            $Tipe = $this->mTipe->getTipe();
        } else{
            $Tipe = $this->mTipe->getTipe($id);
        }
        if ($Tipe){
            $this->response([
                'status' => true,
                'data' =>$Tipe
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
            if ($this->mTipe->deleteTipe($id)>0){
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
            'Tipe' => $this->post('Tipe'),
        ];
        
        if ($this->mTipe->createTipe($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Tipe baru ditambahkan'
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
            'Tipe' => $this->put('Tipe')
        ];

        if ($this->mTipe->updateTipe($data,$id)>0){
            $this->response([
                'status' => true,
                'message' => 'Tipe telah diperbarui'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal memperbarui Tipe'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}