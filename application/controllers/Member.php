<?php

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('LimbahModel');
        $this->load->model('MemberModel');
        $this->load->model('ReviewModel');
        $this->load->model('UserModel');
    }

    public function index()
    {
        $data = [
            'judul'  => 'Recyloop - Penukaran Limbah Daur Ulang',
            'user'   => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'limbah' => $this->LimbahModel->getLimbah(),
            'bp'     => $this->LimbahModel->getLimbahById(1),
            'ka'     => $this->LimbahModel->getLimbahById(2),
            'kk'     => $this->LimbahModel->getLimbahById(3)
        ];

        $data['total'] = $data['bp']['total_sampah'] + $data['ka']['total_sampah'] + $data['kk']['total_sampah'];

        $this->load->view('templates/member/header', $data);
        $this->load->view('templates/member/sidebar', $data);
        $this->load->view('member/index/member-section1', $data);
        $this->load->view('member/index/member-section2', $data);
        $this->load->view('member/index/member-section3', $data);
        $this->load->view('member/index/member-section4', $data);
        $this->load->view('member/index/member-section5', $data);
        $this->load->view('member/index/member-section6', $data);
        $this->load->view('templates/member/footer');
    }
    public function listMember()
    {
        $config['base_url'] = site_url('member/listMember/');
        $config['total_rows'] = $this->UserModel->countAllMember(3);
        $config['per_page'] = 5;
        $start = $this->uri->segment(3);

        $config['full_tag_open']  = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $data = [
            'judul' => 'Informasi Member',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'members' => $this->UserModel->getSomeUser(3, $config['per_page'], $start),
        ];

        $userCheck = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        if ($userCheck) {
            if ($userCheck['role_id'] == 3) {
                redirect('member');
                return;
            }
        }

        $this->pagination->initialize($config);

        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view("member/informasi_member/index", $data);
        $this->load->view("templates/admin/footer");
    }

    public function about()
    {
        $reviews = $this->MemberModel->getReview();
        $formatted_reviews = [];

        foreach ($reviews as $review) {
            if (isset($review['tanggal'])) {
                $date = new DateTime($review['tanggal']);
                $review['formatted_date'] = $date->format('d M, Y');
            } else {
                $review['formatted_date'] = 'Date not available';
            }
            $formatted_reviews[] = $review;
        }

        $data = [
            'judul' => 'Recyloop - Penukaran Limbah Daur Ulang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'company' => $this->db->get('company')->result_array(),
            'review' => $formatted_reviews,
        ];

        $this->load->view('templates/member/header', $data);
        $this->load->view('templates/member/sidebar', $data);
        $this->load->view('member/about/about-section1', $data);
        $this->load->view('member/about/about-section2', $data);
        $this->load->view('member/about/about-section3', $data);
        $this->load->view('member/about/about-section4', $data);
        $this->load->view('member/about/about-section5', $data);
        $this->load->view('member/about/about-section6', $data);
        $this->load->view('member/about/about-footer');
        $this->load->view('templates/member/footer');
    }


    public function profil()
    {
        $data = [
            'judul' => 'Profil Saya',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        ];

        $this->load->view('templates/member/header', $data);
        $this->load->view('templates/member/sidebar', $data);
        $this->load->view('member/profil/index', $data);
        $this->load->view('templates/member/footer');
    }

    public function ubahProfil()
    {
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Masukkan nama lengkap anda dengan benar.'
        ]);

        $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Masukkan email dengan benar.',
            'valid_email' => 'Masukkan format email dengan benar'
        ]);

        if ($this->input->post('email') != $user['email']) {
            $this->form_validation->set_rules('email', 'Email', 'is_unique[user.email]', [
                'is_unique' => 'Email sudah dipakai, mohon gunakan email yang lain.'
            ]);
        }

        $this->form_validation->set_rules('notelp', 'No. Telp', 'required|trim|integer', [
            'required' => 'Masukkan no. telp anda dengan benar.',
            'integer' => 'Nomor telepon hanya berisi angka'
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'Masukkan alamat anda dengan benar.'
        ]);

        if ($this->form_validation->run() == false) {
            $data = [
                'judul' => 'Profil Saya',
                'user' => $user,
            ];

            $this->load->view('templates/member/header', $data);
            $this->load->view('templates/member/sidebar', $data);
            $this->load->view('member/profil/ubahProfil', $data);
            $this->load->view('templates/member/footer');
        } else {
            $dataMember = [
                'nama' => htmlspecialchars($this->input->post('nama'), ENT_QUOTES, 'UTF-8'),
                'email' => htmlspecialchars($this->input->post('email'), ENT_QUOTES, 'UTF-8'),
                'no_telp' => htmlspecialchars($this->input->post('notelp'), ENT_QUOTES, 'UTF-8'),
                'alamat' => htmlspecialchars($this->input->post('alamat'), ENT_QUOTES, 'UTF-8')
            ];

            $uploadImage = $_FILES['photo']['name'];
            if ($uploadImage) {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '4096';
                $config['max_width'] = '3084';
                $config['max_height'] = '3084';
                $config['upload_path'] = './assets/images/user/profile/';
                $config['file_name'] = 'user_' . $user['username'];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('photo')) {
                    $gambarLama = $user['photo'];
                    if ($gambarLama != 'default.png') {
                        unlink(FCPATH . 'assets/images/user/profile/' . $gambarLama);
                    }

                    $gambarBaru = $this->upload->data('file_name');
                    $this->db->set('photo', $gambarBaru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->UserModel->editUser($user['id'], $dataMember);

            $this->session->set_flashdata('message', '<div id="successInput" class="alert alert-success" role="alert">Berhasil menerapkan perubahan.</div>');
            redirect('member/profil');
        }
    }

    public function histori()
    {
        $data = [
            'judul'           => 'Histori Saya',
            'user'            => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'detailTransaksi' => $this->db->get_where('transaction', ['username' => $this->session->userdata('username')])->result_array(),
        ];

        $this->load->view('templates/member/header', $data);
        $this->load->view('templates/member/sidebar', $data);
        $this->load->view('member/histori/index', $data);
        $this->load->view('templates/member/footer');
    }

    public function withdraw()
    {
        $data = [
            'judul'           => 'Histori Saya',
            'user'            => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'detailWithdraw' => $this->db->get_where('withdraw', ['username' => $this->session->userdata('username')])->result_array(),
        ];

        $this->load->view('templates/member/header', $data);
        $this->load->view('templates/member/sidebar', $data);
        $this->load->view('member/histori/withdraw', $data);
        $this->load->view('templates/member/footer');
    }

    public function review()
    {
        $data = [
            'judul' => 'Tambah Review',
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        ];

        $this->form_validation->set_rules('review', 'Review', 'required', [
            'required' => 'Masukkan format ulasan dengan benar.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/member/header', $data);
            $this->load->view('templates/member/sidebar', $data);
            $this->load->view('member/review/index', $data);
            $this->load->view('templates/member/footer');
        } else {
            $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

            $dataReview = [
                'id_member' => $user['id_member'],
                'nama' => $user['nama'],
                'photo' => $user['photo'],
                'tanggal' => date('Y-m-d'),
                'review' => $this->input->post('review')
            ];

            $this->ReviewModel->tambahReview($dataReview);
            redirect('member/about#rev');
        }
    }

    public function coupon()
    {
        $cinderamata = $this->db->get_where('cinderamata', ['id' => 1])->row_array();
        $cinderamata2 = $this->db->get_where('cinderamata', ['id' => 2])->row_array();
        $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $koin = $user['koin'] >= 5000;
        $koin2 = $user['koin'] >= 50000;
        $stok = $cinderamata['stok'];
        $stok2 = $cinderamata2['stok'];

        // Ambil nilai kupon1 dan kupon2 dari tabel user
        $kupon1_taken = $user['kupon1'] == 1;
        $kupon2_taken = $user['kupon2'] == 1;

        $data = [
            'judul' => 'Kupon Cinderamata',
            'user'  => $user,
            'gift' => $this->GiftModel->getGift(),
            'kupon1' => $koin,
            'kupon2' => $koin2,
            'stok' => $stok,
            'stok2' => $stok2,
            'kupon1_taken' => $kupon1_taken,
            'kupon2_taken' => $kupon2_taken
        ];

        $this->load->view('templates/member/header', $data);
        $this->load->view('templates/member/sidebar', $data);
        $this->load->view('member/coupon/coupon', $data);
        $this->load->view('templates/member/footer');
    }
}
