<?php
class Announcement extends CI_Controller
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
            'judul' => "Data Pengumuman Pegawai",
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        ];
        $data['menu'] = $this->db->get('announcement')->result_array();

        $this->form_validation->set_rules('judul', 'announcement', 'required');
        $this->form_validation->set_rules('deskripsi', 'announcement', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view("admin/announcement/index", $data);
            $this->load->view("templates/admin/footer");
        } else {
            $this->db->insert('announcement', [
                'judul' => htmlspecialchars($this->input->post('judul'), ENT_QUOTES, 'UTF-8'),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi'), ENT_QUOTES, 'UTF-8'),
                'tanggal' => date('Y-m-d')
            ]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengumuman telah ditambahkan!</div>');
            redirect('announcement');
        }
    }

    public function update($ann_id)
    {
        $this->form_validation->set_rules('judul', 'announcement', 'required');
        $this->form_validation->set_rules('deskripsi', 'announcement', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'judul' => "Edit Pengumuman Pegawai",
                'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            ];
            $data['announcement'] = $this->db->get_where('announcement', ['id' => $ann_id])->row_array();

            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view("admin/announcement/editAnnouncement", $data);
            $this->load->view("templates/admin/footer");
        } else {
            $data = [
                'judul' => htmlspecialchars($this->input->post('judul'), ENT_QUOTES, 'UTF-8'),
                'tanggal' => htmlspecialchars($this->input->post('tanggal'), ENT_QUOTES, 'UTF-8'),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi'), ENT_QUOTES, 'UTF-8')
            ];


            $this->db->where('id', $ann_id);
            $this->db->update('announcement', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengumuman telah diperbarui!</div>');
            redirect('announcement');
        }
    }

    public function delete($ann_id)
    {
        $event = $this->db->get_where('announcement', ['id' => $ann_id])->row_array();

        if ($event) {
            $this->db->delete('announcement', ['id' => $ann_id]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengumuman telah dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Event tidak ditemukan!</div>');
        }
        redirect('announcement');
    }
}
