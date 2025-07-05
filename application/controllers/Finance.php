<?php
class Finance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('FinanceModel');
        $this->load->language('form_validation', 'indonesian');
    }

    public function index()
    {
        $finance1 = $this->FinanceModel->getFinanceById(1);
        $finance2 = $this->FinanceModel->getFinanceById(2);

        $menu = $this->db->get('deposit')->result_array();
        $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $transaksi = $this->FinanceModel->getFinance();

        $data = [
            'menu' => $menu,
            'user' => $user,
            'judul' => "Data Keuangan Internal",
            'transaksi' => $transaksi,
            'saldoModalAwal' => $finance1['saldo'],
            'tgl_update1' => $finance1['tgl_update'],
            'jam_update1' => $finance1['jam_update'],
            'username_update1' => $finance1['username'],
            'saldoKasSaatIni' => $finance2['saldo'],
            'tgl_update2' => $finance2['tgl_update'],
            'jam_update2' => $finance2['jam_update'],
            'username_update2' => $finance2['username']
        ];

        $this->form_validation->set_rules('saldo', 'Saldo', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view("admin/finance/index", $data);
            $this->load->view("templates/admin/footer");
        } else {
            $id = $this->input->post('id');
            $dataFinance = [
                'saldo' => htmlspecialchars($this->input->post('saldo'), ENT_QUOTES, 'UTF-8'),
                'tgl_update' => date('Y-m-d'),
                'jam_update' => date('H:i:s'),
                'username' => $this->session->userdata('username'),
            ];

            if ($this->FinanceModel->updateFinance($id, $dataFinance)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data keuangan telah diperbarui!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal memperbarui data keuangan!</div>');
            }
            redirect('finance');
        }
    }


    public function tambahSaldo()
    {
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|greater_than[0]', [
            'required' => 'Jumlah wajib diisi!',
            'numeric' => 'Jumlah harus berupa angka!',
            'greater_than' => 'Jumlah harus lebih dari 0!'
        ]);
        $this->form_validation->set_rules('metode', 'Metode', 'required', ['required' => 'Metode wajib diisi!']);
        $this->form_validation->set_rules('sumber', 'Sumber', 'required', ['required' => 'Sumber wajib diisi!']);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>');
            redirect('finance');
            return;
        }

        $dataPost = [
            'id' => $this->input->post('id'),
            'metode' => $this->input->post('metode'),
            'jumlah' => $this->input->post('jumlah'),
            'sumber' => $this->input->post('sumber'),
            'tanggal' => $this->input->post('tanggal')
        ];

        $config = [
            'upload_path' => './assets/finance',
            'allowed_types' => 'jpg|png|pdf|doc|docx',
            'max_size' => 2048
        ];
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $original_name = $upload_data['file_name'];
            $new_file_name = $this->generateFileName($config['upload_path'], $original_name);

            $dataDeposit = [
                'id_finance' => $dataPost['id'],
                'metode' => $dataPost['metode'],
                'tanggal' => $dataPost['tanggal'],
                'jumlah' => $dataPost['jumlah'],
                'sumber' => $dataPost['sumber'],
                'image' => $new_file_name
            ];

            rename($config['upload_path'] . '/' . $original_name, $config['upload_path'] . '/' . $new_file_name);
            $this->db->insert('deposit', $dataDeposit);

            $this->handleSaldo($dataPost);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah saldo! Wajib menambahkan bukti resi atau foto.</div>');
        }
        redirect('finance');
    }

    private function generateFileName($upload_path, $original_name)
    {
        $file_count = count(glob($upload_path . '/*')) + 1;
        $sequence_number = sprintf("%03d", $file_count);
        return 'logdeposit_' . $sequence_number . '_' . $original_name;
    }

    private function handleSaldo($dataPost)
    {
        $saldoKas = $this->FinanceModel->getSaldo(1);
        if ($dataPost['sumber'] == "Modal Kas") {
            if ($dataPost['jumlah'] > $saldoKas) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jumlah yang dimasukkan melebihi saldo Modal Kas yang tersedia!</div>');
                return; 
            } else {
                if ($this->FinanceModel->transferSaldo(1, 2, $dataPost['jumlah'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Saldo berhasil dipindahkan dari Modal Kas ke arus kas!</div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal memindahkan saldo!</div>');
                }
            }
        } else {
            if ($this->FinanceModel->tambahSaldo($dataPost['id'], $dataPost['jumlah'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Saldo berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan saldo!</div>');
            }
        }
    }


    // public function tambahSaldo()
    // {
    //     $this->form_validation->set_rules('jumlah', 'Jumlah', 'required', array('required' => 'Jumlah wajib diisi!'));
    //     $this->form_validation->set_message('required', 'Jumlah wajib diisi!');

    //     if ($this->form_validation->run() == false) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>');
    //         redirect('finance');
    //         return;
    //     }

    //     $id = $this->input->post('id');
    //     $jumlah = $this->input->post('jumlah');
    //     $config['upload_path']   = 'assets/finance';
    //     $config['allowed_types'] = 'jpg|png|pdf|doc|docx';
    //     $config['max_size'] = 2048; // 2MB

    //     $this->load->library('upload', $config);

    //     if ($this->upload->do_upload('file_deposit')) {
    //         $upload_data = $this->upload->data();
    //         $original_name = $upload_data['file_name'];
    //         $file_count = count(glob($config['upload_path'] . '/*'));
    //         $file_count++;
    //         $sequence_number = sprintf("%03d", $file_count);
    //         $new_file_name = 'log_' . $sequence_number . '_' . $original_name;
    //         rename($config['upload_path'] . '/' . $original_name, $config['upload_path'] . '/' . $new_file_name);

    //         $file_path = base_url('assets/finance/' . $new_file_name);

    //         $dataDeposit = [
    //             'id_finance' => $id,
    //             'file_path' => $file_path,
    //         ];

    //         $this->db->insert('deposit', $dataDeposit);

    //         if ($this->FinanceModel->tambahSaldo($id, $jumlah)) {
    //             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Saldo berhasil ditambahkan!</div>');
    //         } else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan saldo!</div>');
    //         }
    //     } else {
    //         $error = $this->upload->display_errors();
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengunggah bukti deposit! Error: ' . $error . '</div>');
    //     }
    //     redirect('finance');
    // }
}
