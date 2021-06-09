<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Validasi extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Validasi_model','mValidasi');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id == null) {
            $Validasi = $this->mValidasi->getValidasi();
        } else{
            $Validasi = $this->mValidasi->getValidasi($id);
        }
        if ($Validasi){
            $this->response([
                'status' => true,
                'data' =>$Validasi
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
            if ($this->mValidasi->deleteValidasi($id)>0){
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
            'Validasi' => $this->post('Validasi'),
        ];
        
        if ($this->mValidasi->createValidasi($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Validasi baru ditambahkan'
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
            'Validasi' => $this->put('Validasi')
        ];

        if ($this->mValidasi->updateValidasi($data,$id)>0){
            $this->response([
                'status' => true,
                'message' => 'Validasi telah diperbarui'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal memperbarui Validasi'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}