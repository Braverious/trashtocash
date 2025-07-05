<?php
class Review extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->language('form_validation', 'indonesian');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = [
            'judul' => "Data Komentar Member",
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'review' => $this->db->get('review')->result_array()
        ];

        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view("admin/review/index", $data);
        $this->load->view("templates/admin/footer");
    }

    public function updatereview($id)
    {
        $is_active = '1';
        $this->load->model('ReviewModel');
        $this->ReviewModel->updatereview($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Komentar telah dikonfirmasi!</div>');
        redirect('review');
    }
}
