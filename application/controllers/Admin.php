<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('StaffModel', 'SampahModel', 'GiftModel');
        is_login();
        role_id();
        $this->load->language('form_validation', 'indonesian');
    }

    public function index()
    {
        $data = [
            'judul' => "Dashboard",
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
        $this->load->view("admin/dashboard/index", $data);
        $this->load->view("templates/admin/footer");
    }

    // -> ! LIST STAFF ! <-
    // INFORMASI TABEL STAFF
    public function staff()
    {
        //Ini code lama coeggg
        // $data = [
        //     'judul' => 'Manajemen Staff',
        //     'members' => $this->UserModel->getUserByRole(2),
        //     'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        // ];

        $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        if (!$user) {
            redirect('home');
            return;
        }

        $config['base_url'] = 'http://localhost/recyloop/admin/staff/staff';
        $config['total_rows'] = $this->UserModel->countAllStaff(2);
        $config['per_page'] = 5;
        $start = $this->uri->segment(4);

        // STYLING PAGINATION
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
            'judul' => 'Manajemen Staff',
            // 'members' => $this->UserModel->getUserByRole(2),
            'staff' => $this->UserModel->getSomeUser(2, $config['per_page'], $start),
            'user' => $user
        ];
        $this->pagination->initialize($config);
        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view('admin/staff/staff', $data);
        $this->load->view("templates/admin/footer");
    }

    // public function generateUniqueIdStaff() {
    //     $this->load->database();
    //     do {
    //         // Generate a unique 11-digit staff ID
    //         $id_staff = str_pad(mt_rand(0, 99999999999), 11, '0', STR_PAD_LEFT);

    //         // Check if the generated ID already exists in the database
    //         $this->db->where('id_staff', $id_staff);
    //         $query = $this->db->get('staff');
    //     } while ($query->num_rows() > 0);

    //     return $id_staff;
    // } 

    // TAMBAH STAFF
    public function add_staff()
    {
        // ID Staff
        // $this->form_validation->set_rules('idstaff', 'ID Staff', 'required|trim|max_length[16]|is_unique[user.id_staff]|integer', [
        //     'required'    => 'Masukkan ID Staff dengan Benar!',
        //     'max_length'  => 'Maksimal 16 Karakter',
        //     'is_unique'   => 'ID Staff sudah ada di dalam database',
        //     'integer'     => 'ID Staff hanya berisi angka'
        // ]);
        // Nama
        $this->form_validation->set_rules('nama', 'Nama', 'required|alpha', [
            'required'    => 'Masukkan nama lengkap dengan benar',
            'alpha'       => 'Nama hanya berisikan huruf abjad.'
        ]);
        // Tanggal Lahir
        $this->form_validation->set_rules('lahir', 'Tanggal Lahir', 'required', [
            'required'    => 'Masukkan tanggal lahir dengan benar'
        ]);
        // Email
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required'    => 'Masukkan email dengan benar',
            'valid_email' => 'Masukkan email sesuai dengan format email'
        ]);
        // Username
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required'    => 'Masukkan username staff dengan benar'
        ]);
        // password
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required'    => 'Masukkan password staff dengan benar'
        ]);
        // No_telp
        $this->form_validation->set_rules('no_telp', 'No. Telp', 'required|integer', [
            'required'    => 'Masukkan no. telp staff dengan benar',
            'integer'     => 'Nomor telepon hanya berisi angka'
        ]);
        // Alamat
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required'    => 'Masukkan alamat staff dengan benar',
        ]);

        if ($this->form_validation->run() == false) {
            $data = [
                'judul' => 'Tambah Staff',
                'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
            ];

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/staff/add_staff', $data);
            $this->load->view('templates/admin/footer');
        } else {
            $id_staff = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            $dataUser = [
                // 'id_staff'  => htmlspecialchars($this->input->post('idstaff')),
                'id_staff'      => htmlspecialchars($id_staff),
                'nama'          => htmlspecialchars($this->input->post('nama')),
                'lahir'         => date('Y-m-d', strtotime($this->input->post('lahir'))),
                'email'         => htmlspecialchars($this->input->post('email')),
                'username'      => htmlspecialchars($this->input->post('username')),
                'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id'       => 2,
                'photo'         => 'default.jpg',
                'no_telp'       => htmlspecialchars($this->input->post('no_telp')),
                'alamat'        => htmlspecialchars($this->input->post('alamat')),
                'koin'          => 0,
                'date_created'  => time(),
                'is_active'     => 1,
            ];

            $id_staff = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            $dataStaff = [
                'id_staff'  => htmlspecialchars($id_staff),
                'nama'      => htmlspecialchars($this->input->post('nama')),
                'email'     => htmlspecialchars($this->input->post('email')),
                'username'  => htmlspecialchars($this->input->post('username')),
                'alamat'    => htmlspecialchars($this->input->post('alamat')),
                'no_telp'   => htmlspecialchars($this->input->post('no_telp')),
                'photo'     => 'default.jpg',
                'role_id'   => 2,
                'is_active' => 1,
            ];

            $this->db->trans_begin();

            $this->load->model('UserModel');
            $userSaved = $this->UserModel->tambahUser($dataUser);

            $this->load->model('StaffModel');
            $staffSaved = $this->StaffModel->tambahStaff($dataStaff);

            if ($userSaved && $staffSaved) {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Staff Berhasil Ditambahkan</div>');
                redirect('admin/staff');
            } else {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-danger" role="alert">Gagal menambahkan Staff</div>');
                redirect('admin/add_staff');
            }
        }
    }

    public function staff_info($id)
    {
        $user = $this->db->get_where('user', ['id_staff' => $id])->row_array();
        $username = $user['username'];

        $this->db->where('petugas', $username);
        $this->db->from('transaction');
        $totalTransaksi = $this->db->count_all_results();

        $this->db->where('petugas', $username);
        $this->db->from('withdraw');
        $totalTarikTunai = $this->db->count_all_results();

        $data = [
            'judul' => 'Informasi Staff',
            'user' => $user,
            'totalTransaksi' => $totalTransaksi,
            'totalTarikTunai' => $totalTarikTunai
        ];

        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view('admin/staff/staff_info', $data);
        $this->load->view("templates/admin/footer");
    }


    public function staff_edit($id)
    {
        $data['user'] = $this->UserModel->getStaffById($id);
        $data['judul'] = 'Ubah Informasi Staff';

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/staff/staff_edit', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $userData = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'email' => htmlspecialchars($this->input->post('email')),
                'no_telp' => htmlspecialchars($this->input->post('no_telp')),
                'alamat' => htmlspecialchars($this->input->post('alamat')),
            ];

            $this->UserModel->editUser($id, $userData);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil Staff telah Diubah</div>');
            redirect('admin/staff');
        }
    }

    public function staff_delete($id)
    {
        $user = $this->db->get_where('user', ['id_staff' => $id])->row_array();

        if ($user) {
            $this->db->delete('user', ['id_staff' => $id]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Staff berhasil dihapus</div>');
            redirect('admin/staff');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anggota gagal dihapus!</div>');
        }
    }

    public function blokir($id)
    {
        $data['user'] = $this->UserModel->getStaffById($id);
        $data['judul'] = 'Blokir';

        $this->form_validation->set_rules('alasan', 'Alasan', 'required', [
            'required'    => 'Masukkan Username Staff dengan Benar'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/staff/ban', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $userData = [
                'is_active'  => 0,
                'alasan_ban' => htmlspecialchars($this->input->post('alasan'))
            ];

            $this->UserModel->editUser($id, $userData);

            $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-warning" role="alert">Pemblokiran Staff Berhasil.</div>');
            redirect('admin/staff');
        }
    }

    public function lepas_blokir($id)
    {
        $user = $this->db->get_where('user', ['id_staff' => $id])->row_array();

        if ($user) {
            $userData = [
                'is_active'     => 1,
                'alasan_ban'    => null
            ];

            $this->db->where('id_staff', $id);
            $this->db->update('user', $userData);

            $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Berhasil melepas pemblokiran Staff.</div>');

            redirect('admin/staff');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal melepas pemblokiran.</div>');
            redirect('admin/staff');
        }
    }



    // -> ! LIST MEMBER ! <-
    // INFORMASI TABEL MEMBER
    public function member()
    {
        $config['base_url'] = site_url('admin/member/');
        $config['total_rows'] = $this->UserModel->countAllMember(3);
        $config['per_page'] = 5;
        $start = $this->uri->segment(3);

        $data = [
            'judul' => 'Manajemen Member',
            'members' => $this->UserModel->getSomeUser(3, $config['per_page'], $start),
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        ];

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

        $this->pagination->initialize($config);

        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view('admin/member/member', $data);
        $this->load->view("templates/admin/footer");
    }

    // TAMBAH STAFF
    public function add_member()
    {
        // // ID Member
        // $this->form_validation->set_rules('idmember', 'ID Member', 'required|trim|max_length[16]|is_unique[user.id_member]|integer', [
        //     'required'    => 'Masukkan ID Member dengan Benar!',
        //     'max_length'  => 'Maksimal 16 Karakter',
        //     'is_unique'   => 'ID Member sudah ada di dalam database',
        //     'integer'     => 'ID Member hanya berisi angka'
        // ]);
        // Nama
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required'    => 'Masukkan Nama Lengkap Member dengan Benar',
        ]);
        // Tanggal Lahir
        $this->form_validation->set_rules('lahir', 'Tanggal Lahir', 'required', [
            'required'    => 'Masukkan Tanggal Lahir Member dengan Benar'
        ]);
        // Email
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required'    => 'Masukkan Email Member dengan Benar!',
            'valid_email' => 'Masukkan Email Member dengan Sesuai'
        ]);
        // Username
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required'    => 'Masukkan Username Member dengan Benar'
        ]);
        // No_telp
        $this->form_validation->set_rules('no_telp', 'No. Telp', 'required|integer', [
            'required'    => 'Masukkan No. Telp Member dengan Benar',
            'integer'     => 'Nomor Telepon hanya berisi angka'
        ]);
        // Alamat
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required'    => 'Masukkan Alamat Member dengan Benar',
        ]);

        if ($this->form_validation->run() == false) {
            $data = [
                'judul' => 'Tambah Member',
                'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
            ];

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/member/add_member', $data);
            $this->load->view('templates/admin/footer');
        } else {
            $id_staff = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            $dataUser = [
                'id_member'    => htmlspecialchars($id_staff),
                'nama'         => htmlspecialchars($this->input->post('nama')),
                'lahir'        => date('Y-m-d', strtotime($this->input->post('lahir'))),
                'email'        => htmlspecialchars($this->input->post('email')),
                'username'     => htmlspecialchars($this->input->post('username')),
                'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id'      => 3,
                'photo'        => 'default.jpg',
                'no_telp'      => htmlspecialchars($this->input->post('no_telp')),
                'alamat'       => htmlspecialchars($this->input->post('alamat')),
                'total_sampah' => 0,
                'koin'         => 0,
                'date_created' => time(),
                'is_active'    => 1,
            ];

            $this->load->model('UserModel');
            $userSaved = $this->UserModel->tambahUser($dataUser);

            if ($userSaved) {
                $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Member Berhasil Ditambahkan</div>');
                redirect('admin/member');
            } else {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-danger" role="alert">Gagal menambahkan Member</div>');
                redirect('admin/add_member');
            }
        }
    }

    public function member_info($id)
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

    public function member_edit($id)
    {
        $data['user'] = $this->UserModel->getMemberById($id);
        $data['judul'] = 'Ubah Informasi Member';

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            // $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/member/member_edit', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $userData = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'email' => htmlspecialchars($this->input->post('email')),
                'no_telp' => htmlspecialchars($this->input->post('no_telp')),
                'alamat' => htmlspecialchars($this->input->post('alamat')),
            ];

            $this->UserModel->editUser($id, $userData);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil Member telah Diubah</div>');
            redirect('admin/member');
        }
    }

    public function member_delete($id)
    {
        $user = $this->db->get_where('user', ['id_member' => $id])->row_array();

        if ($user) {
            $this->db->delete('user', ['id_member' => $id]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" background: #1f283E;" role="alert">Member berhasil dihapus</div>');
            redirect('admin/member');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" background: #1f283E;" role="alert">Member gagal dihapus!</div>');
        }
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
            $this->load->view('admin/member/ban', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $userData = [
                'is_active'  => 0,
                'alasan_ban' => htmlspecialchars($this->input->post('alasan'))
            ];

            $this->UserModel->editUser($id, $userData);

            $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-warning" role="alert">Pemblokiran Member Berhasil.</div>');
            redirect('admin/member');
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

            redirect('admin/member');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal melepas pemblokiran.</div>');
            redirect('admin/member');
        }
    }

    // -> ! LIST SAMPAH ! <-
    // INFORMASI TABEL MEMBER
    public function sampah()
    {
        $config['base_url'] = site_url('admin/sampah/');
        $config['total_rows'] = $this->SampahModel->countAllDistribution();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;

        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $botol = $this->SampahModel->getSampahById(1);
        $kaleng = $this->SampahModel->getSampahById(2);
        $kardus = $this->SampahModel->getSampahById(3);

        $data = [
            'judul' => 'Manajemen Sampah',
            'sampah' => $this->SampahModel->getSampah(),
            'distribution' => $this->SampahModel->getSomeDistribution($config['per_page'], $start),
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'botol' => $botol,
            'kaleng' => $kaleng,
            'kardus' => $kardus
        ];

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

        $this->pagination->initialize($config);

        $pengepuls = ['TLP', 'KSA', 'DPR'];
        foreach ($pengepuls as $pengepul) {
            $total_sampah = $this->db->select_sum('total')
                ->where('pengepul', $pengepul)
                ->get('distribution')
                ->row()->total;
            $this->session->set_userdata('total_sampah_' . strtolower($pengepul), $total_sampah);
        }

        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view('admin/sampah/sampah', $data);
        $this->load->view("templates/admin/footer");
    }


    public function tambah_sampah()
    {
        $this->form_validation->set_rules('jenis_sampah', 'Jenis Sampah', 'required', [
            'required' => 'Masukkan Jenis Sampah dengan benar',
        ]);
        $this->form_validation->set_rules('nilai_tukar', 'Nilai Tukar', 'required|integer', [
            'required' => 'Masukkan Nilai Tukar dengan benar',
            'integer'  => 'Nilai Tukar Sampah hanya bernilai angka',
        ]);


        if ($this->form_validation->run() == false) {
            $data = [
                'judul' => 'Tambah Sampah',
                'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            ];

            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/sampah/tambah_sampah', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $dataSampah = [
                'icon'         => 'waste.png',
                'jenis_sampah' => $this->input->post('jenis_sampah'),
                'nilai_tukar'  => $this->input->post('nilai_tukar'),
                'kode'  => $this->input->post('kode'),
                'total_sampah'  => $this->input->post('total_sampah'),
            ];

            $this->load->model('SampahModel');
            $this->SampahModel->tambahSampah($dataSampah);

            $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Sampah Berhasil Ditambahkan</div>');
            redirect('admin/sampah');
        }
    }

    public function ubah_sampah($id)
    {
        $data['sampah'] = $this->SampahModel->getSampahById($id);

        $data = array_merge($data, [
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'judul' => 'Ubah Informasi Sampah'
        ]);


        $this->form_validation->set_rules('jenis_sampah', 'Jenis Sampah', 'required', [
            'required' => 'Masukkan Jenis Sampah dengan benar',
        ]);
        $this->form_validation->set_rules('nilai_tukar', 'Nilai Tukar', 'required|integer', [
            'required' => 'Masukkan Nilai Tukar dengan benar',
            'integer'  => 'Nilai Tukar Sampah hanya bernilai angka',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/sampah/ubah_sampah', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $sampahData = [
                'jenis_sampah' => htmlspecialchars($this->input->post('jenis_sampah')),
                'nilai_tukar'  => htmlspecialchars($this->input->post('nilai_tukar')),
                'kode'  => htmlspecialchars($this->input->post('kode')),
                'nilai_tukar'  => htmlspecialchars($this->input->post('nilai_tukar'))
            ];

            if (!empty($_FILES['icon']['name'])) {
                $config['upload_path'] = './assets/images/svg/member-section2/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 10240;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('icon')) {
                    if ($data['sampah']['icon'] != 'default_gift.jpg') {
                        unlink('./assets/images/svg/member-section2/' . $data['sampah']['icon']);
                    }

                    $gambarGiftBaru = $this->upload->data('file_name');
                    $sampahData['icon'] = $gambarGiftBaru;
                } else {
                    $upload_error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $upload_error . '</div>');
                    redirect('admin/ubah_gift/' . $id);
                }
            }

            $this->SampahModel->editSampah($id, $sampahData);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Informasi Sampah telah diubah</div>');
            redirect('admin/sampah');
        }
    }

    public function hapus_sampah($id)
    {
        $sampah = $this->db->get_where('sampah', ['id' => $id])->row_array();

        if ($sampah) {
            $this->db->delete('sampah', ['id' => $id]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sampah berhasil dihapus</div>');
            redirect('admin/sampah');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anggota gagal dihapus!</div>');
        }
    }

    public function tambah_distribusi()
    {
        $this->form_validation->set_rules('pengepul', 'Pengepul', 'required', [
            'required' => 'Nama pengepul wajib diisi!',
        ]);
        $this->form_validation->set_rules('driver', 'Driver', 'required', [
            'required' => 'Nama pengendara wajib diisi!',
        ]);

        $harga_bp = $this->db->get_where('sampah', ['id' => 1])->row()->nilai_tukar;
        $harga_ka = $this->db->get_where('sampah', ['id' => 2])->row()->nilai_tukar;
        $harga_kk = $this->db->get_where('sampah', ['id' => 3])->row()->nilai_tukar;

        if ($this->form_validation->run() == false) {
            $errors = validation_errors('<div style="color: #FFF; background: #ff0000;" class="alert alert-danger" role="alert">', '</div>');
            $this->session->set_flashdata('message', $errors);

            $data = [
                'judul' => 'Tambah Pengiriman',
                'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
                'harga_bp' => $harga_bp,
                'harga_ka' => $harga_ka,
                'harga_kk' => $harga_kk
            ];

            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/sampah/tambah_distribution', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $data = [
                'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            ];

            $harga_bp = $this->db->get_where('sampah', ['id' => 1])->row()->nilai_tukar;
            $harga_ka = $this->db->get_where('sampah', ['id' => 2])->row()->nilai_tukar;
            $harga_kk = $this->db->get_where('sampah', ['id' => 3])->row()->nilai_tukar;

            $bp = $this->input->post('bp');
            $ka = $this->input->post('ka');
            $kk = $this->input->post('kk');

            $total_bp = $this->db->get_where('sampah', ['id' => 1])->row()->total_sampah;
            $total_ka = $this->db->get_where('sampah', ['id' => 2])->row()->total_sampah;
            $total_kk = $this->db->get_where('sampah', ['id' => 3])->row()->total_sampah;

            if ($bp > $total_bp || $ka > $total_ka || $kk > $total_kk) {
                $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-danger" role="alert">Sampah tidak dapat dikirim</div>');
                redirect('admin/sampah/tambah_distribusi');
            } else {
                $harga_bp = $this->db->get_where('sampah', ['id' => 1])->row()->nilai_tukar;
                $harga_ka = $this->db->get_where('sampah', ['id' => 2])->row()->nilai_tukar;
                $harga_kk = $this->db->get_where('sampah', ['id' => 3])->row()->nilai_tukar;

                $bp = $this->input->post('bp');
                $ka = $this->input->post('ka');
                $kk = $this->input->post('kk');

                if ($bp == 0 && $ka == 0 && $kk == 0) {
                    $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-danger" role="alert">Salah satu jenis sampah harus diisi lebih dari 0</div>');
                    redirect('admin/sampah/tambah_distribusi');
                }

                if ($bp >= 0 && $ka >= 0 && $kk >= 0) {
                    $nilai_tukar = ($bp * (float)$harga_bp) + ($ka * (float)$harga_ka) + ($kk * (float)$harga_kk);
                    $this->db->query("UPDATE finance SET saldo = saldo + $nilai_tukar WHERE id = 1");
                    $this->db->query("UPDATE sampah SET total_sampah = total_sampah - $bp WHERE id = 1");
                    $this->db->query("UPDATE sampah SET total_sampah = total_sampah - $ka WHERE id = 2");
                    $this->db->query("UPDATE sampah SET total_sampah = total_sampah - $kk WHERE id = 3");

                    $dataDistribution = [
                        'pengepul' => $this->input->post('pengepul'),
                        'tanggal' => date('Y-m-d'),
                        'bp' => $bp,
                        'ka' => $ka,
                        'kk' => $kk,
                        'nilai_tukar' => ($bp * $harga_bp) + ($ka * $harga_ka) + ($kk * $harga_kk),
                        'driver'  => $this->input->post('driver'),
                        'petugas' => $data['user']['username'],
                        'total' => $bp + $ka + $kk,
                    ];

                    $this->load->model('SampahModel');
                    $this->SampahModel->tambahDistribution($dataDistribution);

                    $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Pengiriman sampah telah terdata</div>');
                    redirect('admin/sampah');
                } else {
                    $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-danger" role="alert">Penambahan sampah gagal.</div>');
                    redirect('admin/sampah');
                }
            }
        }
    }

    public function ubah_distribusi($id)
    {
        $data['distribution'] = $this->SampahModel->getDistributionById($id);

        $data = array_merge($data, [
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'judul' => 'Ubah Pengiriman Sampah'
        ]);

        $this->form_validation->set_rules('driver', 'Driver', 'required', 'is_unique', [
            'required' => 'Lah ya kalo ga dirubah ngapain klik submit bre',
            'is_unique' => 'Lay ya kalo ga dirubah ngapain klik submit bre'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/sampah/ubah_distribution', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $dataDistribution = [
                'pengepul' => $this->input->post('pengepul'),
                'tanggal' =>  $this->input->post('tanggal'),
                'driver'  => $this->input->post('driver'),
            ];

            $this->SampahModel->editDistribution($id, $dataDistribution);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Informasi pengiriman telah diubah</div>');
            redirect('admin/sampah');
        }
    }




    public function cinderamata()
    {
        $data = [
            'judul' => 'Manajemen Cinderamata',
            'cinderamata' => $this->GiftModel->getGift(),
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        ];

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id_member = $this->input->post('id_member');
            $id_gift = $this->input->post('id_gift'); // Pastikan form mengirimkan id_gift

            // Validasi ID Member
            $member = $this->db->get_where('user', ['id_member' => $id_member])->row_array();
            if (!$member) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">ID Member tidak valid</div>');
                redirect('admin/cinderamata');
            }

            // Validasi Stok Cinderamata
            $gift = $this->db->get_where('cinderamata', ['id' => $id_gift])->row_array();
            if (!$gift || $gift['stok'] <= 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cinderamata tidak tersedia atau stok habis</div>');
                redirect('admin/cinderamata');
            }

            // Pengendalian Koin untuk id_gift = 1
            if ($id_gift == 1 && $member['koin'] <= 50000) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Koin member tidak lebih dari 50000</div>');
                redirect('admin/cinderamata');
            }

            // Pengendalian Koin untuk id_gift = 2
            if ($id_gift == 2 && $member['koin'] <= 5000) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Koin member tidak lebih dari 5000</div>');
                redirect('admin/cinderamata');
            }

            // Pengendalian jika kupon sudah diambil
            if (($id_gift == 1 && $member['kupon1'] == 1) || ($id_gift == 2 && $member['kupon2'] == 1)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Member telah mengambil cinderamata</div>');
                redirect('admin/cinderamata');
            }

            // Mengurangi stok cinderamata
            $this->db->set('stok', 'stok-1', FALSE);
            $this->db->where('id', $id_gift);
            $this->db->update('cinderamata');

            // Mengupdate kolom kupon pada tabel user
            if ($id_gift == 1) {
                $this->db->set('kupon1', 1);
            } elseif ($id_gift == 2) {
                $this->db->set('kupon2', 1);
            }
            $this->db->where('id_member', $id_member);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengambilan kupon berhasil</div>');
            redirect('admin/cinderamata');
        }

        // Memuat view
        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view('admin/cinderamata/cinderamata', $data);
        $this->load->view("templates/admin/footer");
    }




    public function give_gift($id)
    {
        $cinderamata = $this->db->get_where('cinderamata', ['id' => $id])->row_array();
        if ($cinderamata && $cinderamata['stok'] > 0) {
            $this->db->set('stok', 'stok-1', FALSE);
            $this->db->where('id', $id);
            $this->db->update('cinderamata');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Stok cinderamata berhasil dikurangi!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok cinderamata tidak mencukupi!</div>');
        }
        redirect('admin/cinderamata');
    }


    public function tambah_gift()
    {
        $this->form_validation->set_rules('nama_gift', 'Nama Cinderamata', 'required', [
            'required' => 'Masukkan Nama Cinderamata dengan benar',
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|integer', [
            'required' => 'Masukkan Harga Cinderamata dengan benar',
            'integer'  => 'Harga Cinderamata hanya bernilai angka',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Cinderamata', 'required', [
            'required' => 'Masukkan Deskripsi Cinderamata dengan benar',
        ]);

        if ($this->form_validation->run() == false) {
            $data = [
                'judul' => 'Tambah Cinderamata',
                'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            ];

            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/cinderamata/tambah_gift', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $dataGift = [
                'nama_gift' => htmlspecialchars($this->input->post('nama_gift')),
                'harga'     => htmlspecialchars($this->input->post('harga')),
                'photo'     => 'default_gift.jpg',
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi'))
            ];

            $this->load->model('GiftModel');
            $this->GiftModel->tambahGift($dataGift);

            $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Cinderamata Berhasil Ditambahkan</div>');
            redirect('admin/cinderamata');
        }
    }

    // UBAH CINDERAMATA
    public function ubah_gift($id)
    {
        $data['cinderamata'] = $this->GiftModel->getGiftById($id);

        $data = array_merge($data, [
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'judul' => 'Ubah Informasi Cinderamata'
        ]);

        $this->form_validation->set_rules('nama_gift', 'Nama Cinderamata', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|integer');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Cinderamata', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/cinderamata/ubah_gift', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $nama_gift = $this->input->post('nama_gift');
            $harga = $this->input->post('harga');
            $deskripsi = $this->input->post('deskripsi');

            $dataGift = [
                'nama_gift' => $nama_gift,
                'harga' => $harga,
                'deskripsi' => $deskripsi
            ];

            if (!empty($_FILES['photo']['name'])) {
                $config['upload_path'] = './assets/images/cinderamata/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 10240;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('photo')) {
                    if ($data['cinderamata']['photo'] != 'default_gift.jpg') {
                        unlink('./assets/images/cinderamata/' . $data['cinderamata']['photo']);
                    }

                    $gambarGiftBaru = $this->upload->data('file_name');
                    $dataGift['photo'] = $gambarGiftBaru;
                } else {
                    $upload_error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $upload_error . '</div>');
                    redirect('admin/ubah_gift/' . $id);
                }
            }

            $this->GiftModel->editGift($id, $dataGift);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Informasi Cinderamata telah diubah</div>');

            redirect('admin/cinderamata');
        }
    }

    public function hapus_gift($id)
    {
        $gift = $this->db->get_where('cinderamata', ['id' => $id])->row_array();

        if ($gift) {
            $this->db->delete('cinderamata', ['id' => $id]);

            $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Cinderamata berhasil dihapus</div>');
            redirect('admin/cinderamata');
        } else {
            $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-danger" role="alert">Cinderamata gagal dihapus!</div>');
        }
    }

    public function tambah_stok($id)
    {
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|integer', [
            'required' => 'Masukkan jumlah dengan benar.',
            'integer' => 'Jumlah harus dengan format integer'
        ]);

        if ($this->form_validation->run() == false) {
            $data = [
                'judul' => 'Tambah Stok',
                'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
                'cinderamata' => $this->GiftModel->getGiftById($id)
            ];

            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/cinderamata/tambah_stok', $data);
            $this->load->view("templates/admin/footer");
        } else {
            $jumlahTambah = $this->input->post('jumlah');
            $cinderamata = $this->GiftModel->getGiftById($id);
            $jumlahBaru = $cinderamata['stok'] + $jumlahTambah;
            $dataStock = [
                'stok' => $jumlahBaru
            ];
            $this->GiftModel->editGift($id, $dataStock);

            $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Stok cinderamata berhasil ditambah.</div>');
            redirect('admin/cinderamata');
        }
    }
}
