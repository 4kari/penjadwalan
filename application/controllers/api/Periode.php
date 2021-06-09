<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Periode extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Periode_model','mPeriode');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id == null) {
            $Periode = $this->mPeriode->getPeriode();
        } else{
            $Periode = $this->mPeriode->getPeriode($id);
        }
        if ($Periode){
            $this->response([
                'status' => true,
                'data' =>$Periode
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
            if ($this->mPeriode->deletePeriode($id)>0){
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
            'Periode' => $this->post('Periode'),
        ];
        
        if ($this->mPeriode->createPeriode($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Periode baru ditambahkan'
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
            'Periode' => $this->put('Periode')
        ];

        if ($this->mPeriode->updatePeriode($data,$id)>0){
            $this->response([
                'status' => true,
                'message' => 'Periode telah diperbarui'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal memperbarui Periode'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}