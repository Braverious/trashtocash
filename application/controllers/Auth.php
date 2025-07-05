<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->is_already_login()) {
            if ($this->session->userdata('role_id') == 1) {
                redirect('admin');
            } elseif ($this->session->userdata('role_id') == 2) {
                redirect('staff');
            } else {
                redirect('member');
            }
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Masuk';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
    }

    public function is_already_login()
    {
        return $this->session->userdata('username');
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Tambahkan kolom 'alasan_ban' dalam query
        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                    ];

                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 2) {
                        redirect('staff');
                    } else {
                        redirect('member');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password yang Anda masukkan salah.</div>');
                    redirect('auth');
                }
            } else {
                // Ambil nilai alasan_ban
                $alasan_ban = $user['alasan_ban'];
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun anda terkena blokir dengan alasan: <b>' . $alasan_ban . '.</b><br> Silakan hubungi Staff kami!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak ditemukan.</div>');
            redirect('auth');
        }
    }


    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Masukkan nama dengan benar.',
            'alpha'    => 'Nama hanya berisikan huruf abjad'
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Masukkan email dengan benar.',
            'valid_email' => 'Masukkan format email dengan benar',
            'is_unique' => 'Email sudah dipakai, mohon gunakan email yang lain.'
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'required' => 'Masukkan username dengan benar.',
            'is_unique' => 'Username sudah dipakai, mohon gunakan username yang lain.'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
            'required' => 'Masukkan password dengan benar.',
            'min_length' => 'Password terlalu pendek.'
        ]);

        $this->form_validation->set_rules('lahir', 'Tanggal Lahir', 'required|trim', [
            'required'    => 'Masukkan tanggal lahir anda dengan benar'
        ]);

        $this->form_validation->set_rules('notelp', 'No. Telp', 'required|trim|integer|is_unique[user.no_telp]', [
            'required'    => 'Masukkan No. Telp Member dengan Benar',
            'integer'     => 'Nomor Telepon hanya berisi angka',
            'is_unique'   => 'No. telp sudah dipakai, mohon gunakan no. telp yang lain.'
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'Masukkan alamat dengan benar.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Register';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $id_member = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            $data = [
                'id_member'    => htmlspecialchars($id_member),
                'nama'         => htmlspecialchars($this->input->post('nama', true)),
                'lahir'        => date('Y-m-d', strtotime($this->input->post('lahir'))),
                'email'        => htmlspecialchars($this->input->post('email', true)),
                'username'     => htmlspecialchars($this->input->post('username')),
                'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id'      => 3,
                'photo'        => 'default.jpg',
                'no_telp'      => $this->input->post('notelp'),
                'alamat'       => $this->input->post('alamat'),
                'total_sampah' => 0,
                'total_koin'   => 0,
                'date_created' => time(),
                'is_active'    => 1,
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil registrasi, silahkan login. </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil logout. </div>');

        redirect('auth');
    }

    public function blocked()
    {
        // echo 'access blocked';
        $this->load->view('auth/blocked');
    }
}
