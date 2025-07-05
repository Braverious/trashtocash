<?php
class Secure extends CI_Controller
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
            'judul' => "Data Kamera Pengawas",
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        ];
        $data['menu'] = $this->db->get('secure')->result_array();

        $this->form_validation->set_rules('tittle', 'secure', 'required');
        $this->form_validation->set_rules('address', 'secure', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view("admin/secure/index", $data);
            $this->load->view("templates/admin/footer");
        } else {
            $this->db->insert('secure', [
                'tittle' => $this->input->post('tittle'),
                'address' => $this->input->post('address'),
            ]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamera baru telah ditambahkan!</div>');
            redirect('secure');
        }
    }

    public function update($sec_id)
    {
        $this->form_validation->set_rules('tittle', 'secure', 'required');
        $this->form_validation->set_rules('address', 'secure', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'judul' => "Edit Kamera Pengawas",
                'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            ];
            $data['secure'] = $this->db->get_where('secure', ['id' => $sec_id])->row_array();

            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view("admin/secure/editSecure", $data);
            $this->load->view("templates/admin/footer");
        } else {
            $data = [
                'tittle' => $this->input->post('tittle'),
                'address' => $this->input->post('address'),
            ];

            $this->db->where('id', $sec_id);
            $this->db->update('secure', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Detail kamera telah diperbarui!</div>');
            redirect('secure');
        }
    }

    public function delete($sec_id)
    {
        $secure = $this->db->get_where('secure', ['id' => $sec_id])->row_array();

        if ($secure) {
            $this->db->delete('secure', ['id' => $sec_id]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamera telah dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kamera tidak ditemukan!</div>');
        }
        redirect('secure');
    }
}
