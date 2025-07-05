<?php

class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MemberModel');
    }

    public function index()
    {
        $data = [
            'judul' => 'Recyloop - Penukaran Limbah Daur Ulang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'company' => $this->db->get('company')->result_array(),
            'review' => $this->MemberModel->getReview()
        ];

        $this->load->view('templates/home_header', $data);
        $this->load->view('home/about/about', $data);
        $this->load->view('templates/home_footer');
    }
}
