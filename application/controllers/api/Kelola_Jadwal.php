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
        $id_skripsi = $this->get('id_skripsi');
        $jadwal = $this->mJadwal->getJadwal($id_skripsi);
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
            'judul' => $this->post('Judul'),
            'tanggal' => $this->post('Tanggal'),
            'waktu' => $this->post('Waktu'),
            'ruangan' => $this->post('Ruangan'),
            'periode' => $this->post('Periode'),
            'penguji_1' => $this->post('Penguji_1'),
            'penguji_2' => $this->post('Penguji_2'),
            'penguji_3' => $this->post('Penguji_3'),
            'tipe' => $this->post('Tipe')
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
            'judul' => $this->put('Judul'),
            'tanggal' => $this->put('Tanggal'),
            'waktu' => $this->put('Waktu'),
            'ruangan' => $this->put('Ruangan'),
            'periode' => $this->put('Periode'),
            'penguji_1' => $this->put('Penguji_1'),
            'penguji_2' => $this->put('Penguji_2'),
            'penguji_3' => $this->put('Penguji_3'),
            'tipe' => $this->put('Tipe')
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