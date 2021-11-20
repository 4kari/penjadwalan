<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Acara extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Acara_model','mAcara');
    }
    // public function index_get(){
    //     $tipe = $this->get('tipe');
    //     $jadwal = $this->mAcara->getJadwal($tipe);
    //     $jadwal = $this->mAcara->olahJadwal($jadwal);
    //     if ($jadwal){
    //         $this->response([
    //             'status' => true,
    //             'data' =>$jadwal
    //         ], REST_Controller::HTTP_OK);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'data tidak ditemukan'
    //         ], REST_Controller::HTTP_NOT_FOUND);
    //     }
    // }

    // public function index_delete(){
    //     $id = $this->delete('id');
    //     if ($id == null){
    //         $this->response([
    //             'status' => false,
    //             'message' => 'tambahkan id'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     } else {
    //         if ($this->mAcara->deleteJadwal($id)>0){
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
    public function index_post(){
        $id=$this->post('id');
        if ($this->mAcara->createAcara($id)>0){
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
    // public function index_put(){
    //     $id=$this->put('id');
    //     $data=[
    //         'tanggal' => $this->put('tanggal'),
    //         'waktu' => $this->put('waktu'),
    //         'ruangan' => $this->put('ruangan'),
    //         'periode' => $this->put('periode')
    //     ];
    //     $penguji=[
	// 		'penguji_1' => $this->put('penguji_1'),
	// 		'penguji_2' => $this->put('penguji_2'),
	// 		'penguji_3' => $this->put('penguji_3')
    //     ];

    //     if ($this->mAcara->updateJadwal($data,$penguji,$id)>0){
    //         $this->response([
    //             'status' => true,
    //             'message' => 'Jadwal telah diperbarui'
    //         ], REST_Controller::HTTP_NO_CONTENT);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'gagal memperbarui Jadwal'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }
}