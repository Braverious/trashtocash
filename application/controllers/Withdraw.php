<?php
class Withdraw extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('WithdrawModel');
        $this->load->model('FinanceModel');
        $this->load->model('UserModel');
        $this->load->language('form_validation', 'indonesian');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index($start = 0)
    {
        $config = [
            'base_url' => site_url('withdraw/index'),
            'total_rows' => $this->WithdrawModel->countAllWithdraw(),
            'per_page' => 5,
            'uri_segment' => 3,
            'full_tag_open' => '<nav><ul class="pagination">',
            'full_tag_close' => '</ul></nav>',
            'first_link' => 'First',
            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',
            'last_link' => 'Last',
            'last_tag_open' => '<li class="page-item">',
            'last_tag_close' => '</li>',
            'next_link' => '&raquo;',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',
            'prev_link' => '&laquo;',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',
            'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="#">',
            'cur_tag_close' => '</a></li>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'attributes' => ['class' => 'page-link'],
        ];

        $this->pagination->initialize($config);

        $data = [
            'judul' => "Data Transaksi Penarikan Tunai",
            'withdraw' => $this->WithdrawModel->getSomeWithdraw($config['per_page'], $start),
            'finance' => $this->FinanceModel->getFinance(),
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        ];

        $this->form_validation->set_rules('id_member', 'ID Member', 'required', ['required' => 'ID Member wajib diisi!']);
        $this->form_validation->set_rules('nominal', 'Nominal', 'required', ['required' => 'Nominal wajib diisi!']);
        $this->form_validation->set_rules('metode', 'Metode', 'required', ['required' => 'Metode wajib diisi!']);

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view("admin/withdraw/index", $data);
            $this->load->view("templates/admin/footer");
        } else {
            $nominal = $this->input->post('nominal');
            $id_member = $this->input->post('id_member');
            $metode = $this->input->post('metode');
            $norek = $this->input->post('norek');

            if ($metode == 'Transfer' && empty($norek)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-dark" role="alert">Jika memilih transfer maka nomor rekening wajib dimasukan!</div>');
                redirect('withdraw');
            }

            $userData = $this->db->get_where('user', ['id_member' => $id_member])->row_array();
            if (!$userData) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">ID Member tidak ditemukan! Periksa kembali ID Member!</div>');
                redirect('withdraw');
            }

            $financeData = $this->db->get_where('finance', ['id' => 2])->row_array();

            $koinSekarang = $userData['koin'] - $nominal;

            if ($koinSekarang < 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Koin tidak mencukupi untuk melakukan transaksi!</div>');
                redirect('withdraw');
            }

            $this->db->where('id_member', $id_member);
            $this->db->update('user', ['koin' => $koinSekarang]);

            if ($metode !== 'Tunai') {
                $saldoSekarang = $financeData['saldo'] - $nominal;
                if ($saldoSekarang < 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Saldo arus kas perusahaan tidak mencukupi untuk melakukan transaksi!</div>');
                    redirect('withdraw');
                }

                $this->db->where('id', 2);
                $this->db->update('finance', ['saldo' => $saldoSekarang]);
            }

            $dataWithdraw = [
                'id_member' => $id_member,
                'username' => $userData['username'],
                'koin1' => $userData['koin'],
                'koin2' => $koinSekarang,
                'nominal' => $nominal,
                'jam' => date('H:i:s'),
                'tanggal' => date('Y-m-d'),
                'metode' => $metode,
                'lokasi' => $this->input->post('lokasi'),
                'norek' => $norek,
                'catatan' => $this->input->post('catatan'),
                'petugas' => $data['user']['username'],
                'status' => $metode == 'Tunai' ? 'Diberikan tunai' : 'Sudah ditransfer',
            ];

            $this->WithdrawModel->newWithdraw($dataWithdraw);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi tarik tunai telah berhasil ditambahkan!</div>');
            redirect('withdraw');
        }
    }



    public function getUserDataByIdMember()
    {
        $id_member = $this->input->post('id_member');
        $user = $this->db->get_where('user', ['id_member' => $id_member])->row_array();

        if ($user) {
            echo json_encode([
                'username' => $user['username'],
                'koin' => $user['koin']
            ]);
        } else {
            echo json_encode(['username' => '', 'koin' => '']);
        }
    }

    public function delete_withdraw($id)
    {
        $this->load->model('WithdrawModel');
        $deleted = $this->WithdrawModel->delete_withdraw($id);
        if ($deleted) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil dihilangkan</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Transaksi gagal dihilangkan!</div>');
        }
        redirect('withdraw');
    }

    public function info_withdraw($id)
    {
        $withdraw = $this->WithdrawModel->getwithdrawById($id);

        if ($withdraw) {
            $username = $withdraw['username'];
            $judul = 'Detail Transaksi milik ' . $username;

            $data = [
                'withdraw' => $withdraw,
                'user'  => $this->db->get_where('user', ['username' => $username])->row_array(),
                'judul' => $judul
            ];

            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/withdraw/info_withdraw', $data);
            $this->load->view("templates/admin/footer");
        } else {
            redirect('withdraw');
        }
    }
    public function receipt($id)
    {
        $withdraw = $this->WithdrawModel->getwithdrawById($id);
        $date = new DateTime($withdraw['tanggal']);
        $withdraw['formatted_tanggal'] = $date->format('d F Y');

        $data = [
            'withdraw' => $withdraw,
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        ];

        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/recyloop/application/third_party/dompdf/autoload.inc.php";
        $dompdf = new Dompdf\Dompdf();

        $html = $this->load->view('admin/withdraw/receipt', $data, TRUE);

        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);

        $paper_size = 'A4';
        $orientation = 'landscape';

        $dompdf->set_paper($paper_size, $orientation);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("receipt-withdraw-{$withdraw['username']}.pdf", array('Attachment' => 0));
    }
}
