<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        role_id();
        $this->load->model('LimbahModel');
    }

    public function index()
    {
        $data['judul'] = 'Recyloop.id';
        $data = [
            'limbah' => $this->LimbahModel->getLimbah(),
            'bp' => $this->LimbahModel->getLimbahById(1),
            'ka' => $this->LimbahModel->getLimbahById(2),
            'kk' => $this->LimbahModel->getLimbahById(3)
        ];
        // Menghitung total sampah
        $data['total'] = $data['bp']['total_sampah'] + $data['ka']['total_sampah'] + $data['kk']['total_sampah'];


        $this->load->view('templates/home_header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/home_footer');
    }
}
