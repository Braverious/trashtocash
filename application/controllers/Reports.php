<?php
class Reports extends CI_Controller
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
            'judul' => "Data Laporan Masalah",
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        ];

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim', [
            'required' => 'Masukkan judul dengan benar!'
        ]);
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', [
            'required' => 'Masukkan tanggal dengan benar!'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
            'required' => 'Masukkan keterangan dengan jelas!',
            'min_length' => 'Masukan laporan dengan detail!'
        ]);

        if ($this->form_validation->run() == false) {
            $data = [
                'judul' => "Data Laporan Masalah",
                'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
            ];
            $error_message = validation_errors();
            if (!empty($error_message)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error_message . '</div>');
            }
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view("admin/reports/add_reports", $data);
            $this->load->view("templates/admin/footer");
        } else {
            $this->db->insert('reports', [
                'id_account' => htmlspecialchars($this->input->post('id_account'), ENT_QUOTES, 'UTF-8'),
                'nama' => htmlspecialchars($this->input->post('nama'), ENT_QUOTES, 'UTF-8'),
                'judul' => htmlspecialchars($this->input->post('judul'), ENT_QUOTES, 'UTF-8'),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi'), ENT_QUOTES, 'UTF-8'),
                'tanggal' => htmlspecialchars($this->input->post('tanggal'), ENT_QUOTES, 'UTF-8'),
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Laporan harian berhasil dikirim!</div>');
            redirect('reports');
        }
    }
}
