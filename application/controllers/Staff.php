<?php

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        ];

        $data['menu'] = $this->db->get('announcement')->result_array();
        $data['stat'] = $this->db->get('user')->result_array();
        $data['withdraw'] = $this->db->get('withdraw')->result_array();
        $data['sampah'] = $this->db->get('sampah')->result_array();
        $this->db->where('id_member IS NOT NULL', null, false);
        $data['jumlah_partisipan'] = $this->db->count_all_results('user');
        $this->db->where('id_staff IS NOT NULL', null, false);
        $data['jumlah_pegawai'] = $this->db->count_all_results('user');
        $this->db->where('id_admin IS NOT NULL', null, false);
        $data['jumlah_admin'] = $this->db->count_all_results('user');
        $this->db->where('is_active', 0);
        $data['jumlah_terblokir'] = $this->db->count_all_results('user');
        $data['finance'] = $this->db->select('id, rekening, saldo')->where_in('id', [1, 2])->get('finance')->result_array();

        $sampah_data = $this->db->get('sampah')->result_array();
        $jenis_sampah = [];
        $total_sampah = [];

        foreach ($sampah_data as $sampah) {
            $jenis_sampah[] = $sampah['jenis_sampah'];
            $total_sampah[] = $sampah['total_sampah'];
        }

        $data['jenis_sampah'] = json_encode($jenis_sampah);
        $data['total_sampah'] = json_encode($total_sampah);


        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view("staff/dashboard/index", $data);
        $this->load->view("templates/admin/footer");
    }

    public function blokirMember($id)
    {
        $data = [
            'user' => $this->UserModel->getMemberById($id),
            'judul' => 'Blokir Member'
        ];

        $this->form_validation->set_rules('alasan', 'Alasan', 'required', [
            'required'    => 'Masukkan alasan dengan Benar'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('staff/blokirMember', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $userData = [
                'is_active'  => 0,
                'alasan_ban' => htmlspecialchars($this->input->post('alasan'))
            ];

            $this->UserModel->editUser($id, $userData);

            $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-warning" role="alert">Pemblokiran Member Berhasil.</div>');
            redirect('member/listMember');
        }
    }

    public function lepasBlokirMember($id)
    {
        $user = $this->db->get_where('user', ['id_member' => $id])->row_array();

        if ($user) {
            $userData = [
                'is_active'     => 1,
                'alasan_ban'    => null
            ];

            $this->db->where('id_member', $id);
            $this->db->update('user', $userData);

            $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Berhasil melepas pemblokiran Member.</div>');

            redirect('member/listMember');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal melepas pemblokiran.</div>');
            redirect('member/listMember');
        }
    }

    public function memberInfo($id)
    {
        $data = [
            'judul' => 'Informasi Member',
            'user' => $this->db->get_where('user', ['id_member' => $id])->row_array()
        ];

        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view('admin/member/member_info', $data);
        $this->load->view("templates/admin/footer");
    }
}