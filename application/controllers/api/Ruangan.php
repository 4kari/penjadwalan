<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Ruangan extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Ruangan_model','mRuangan');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id == null) {
            $Ruangan = $this->mRuangan->getRuangan();
        } else{
            $Ruangan = $this->mRuangan->getRuangan($id);
        }
        if ($Ruangan){
            $this->response([
                'status' => true,
                'data' =>$Ruangan
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // public function index_delete(){
    //     $id = $this->delete('id');
    //     if ($id == null){
    //         $this->response([
    //             'status' => false,
    //             'message' => 'tambahkan id'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     } else {
    //         if ($this->mRuangan->deleteRuangan($id)>0){
    //             //ok
    //             $this->response([
    //                 'status' => true,
    //                 'message' => 'terhapus'
    //             ], REST_Controller::HTTP_NO_CONTENT);
    //         }
    //         else{
    //             $this->response([
    //                 'status' => false,
    //                 'message' => 'id tidak ditemukan'
    //             ], REST_Controller::HTTP_BAD_REQUEST);
    //         }          
    //     }
    // }
    // public function index_post(){
    //     $data=[
    //         'Ruangan' => $this->post('Ruangan')
    //     ];
        
    //     if ($this->mRuangan->createRuangan($data)>0){
    //         $this->response([
    //             'status' => true,
    //             'message' => 'Ruangan baru ditambahkan'
    //         ], REST_Controller::HTTP_CREATED);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'gagal menambahkan data baru'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }
    // public function index_put(){
    //     $id=$this->put('id');
    //     $data=[
    //         'Ruangan' => $this->put('Ruangan')
    //     ];

    //     if ($this->mRuangan->updateRuangan($data,$id)>0){
    //         $this->response([
    //             'status' => true,
    //             'message' => 'Ruangan telah diperbarui'
    //         ], REST_Controller::HTTP_NO_CONTENT);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'gagal memperbarui Ruangan'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }
}