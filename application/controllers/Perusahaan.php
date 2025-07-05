<?php

class Perusahaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        role_id();
        $this->load->model('PerusahaanModel');
    }

    public function index()
    {
        $data = [
            'judul' => 'Manajemen Informasi Perusahaan',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'infoPerusahaan' => $this->PerusahaanModel->getInfoPerusahaan()
        ];

        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view('perusahaan/index', $data);
        $this->load->view("templates/admin/footer");
    }

    public function tambahInformasi()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required', [
            'required' => 'Masukkan judul dengan benar.'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', [
            'required' => 'Masukkan isi deskripsi dengan Benar.'
        ]);

        if($this->form_validation->run() == false)
        {
            $data = [
                'judul' => 'Tambah Deskripsi Perusahaan',
                'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            ];

            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('perusahaan/tambahInformasi', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $dataInformasi = [
                'nama' => 'Recyloop',
                'img_logo' => 'main-logo.png',
                'tagline' => '#Recyloop',
                'lokasi' => 'Krakatau',
                'judul' => htmlspecialchars($this->input->post('judul')),
                'deskripsi' => $this->input->post('deskripsi')
            ];

            $this->PerusahaanModel->tambahInformasi($dataInformasi);

            $this->session->set_flashdata('message', '<div class="alert alert-success text-dark" role="alert">Informasi perusahaan telah ditambah.</div>');
            redirect('perusahaan');
        }
    }

    public function ubahInformasi($id)
    {
        $data = [
            'judul' => 'Ubah Deskripsi Perusahaan',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'perusahaan' => $this->PerusahaanModel->getInfoPerusahaanById($id)
        ];

        $this->form_validation->set_rules('judul', 'Judul', 'required', [
            'required' => 'Masukkan Judul dengan Benar.'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', [
            'required' => 'Masukkan Deskripsi dengan Benar.'
        ]);

        if($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('perusahaan/ubahInformasi', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $dataInformasi = [
                'nama' => 'Recyloop',
                'img_logo' => 'main-logo.png',
                'tagline' => '#Recyloop',
                'lokasi' => 'Krakatau',
                'judul' => htmlspecialchars($this->input->post('judul')),
                'deskripsi' => $this->input->post('deskripsi')
            ];

            $this->PerusahaanModel->ubahInformasi($id, $dataInformasi);

            $this->session->set_flashdata('message', '<div class="alert alert-success text-dark" role="alert">Informasi perusahaan telah diubah.</div>');
            redirect('perusahaan');
        }
    }

    public function hapusInformasi($id)
    {
        $this->PerusahaanModel->hapusInformasi($id);
        redirect('perusahaan');
    }
}