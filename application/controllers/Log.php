<?php
class Log extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('WithdrawModel');
        $this->load->model('TransactionModel');
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID.UTF-8');
    }

    public function transaction()
    {
        $data = [
            'judul' => "Log Transaksi Penyerahan Sampah",
            'transaction' => $this->TransactionModel->getTransaction(),
            'withdraw' => $this->WithdrawModel->getWithdraw(),
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        ];

        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view("admin/log/transaction", $data);
        $this->load->view("templates/admin/footer", $data);
    }

    public function info_transaction($id)
    {
        $transaction = $this->TransactionModel->getTransactionById($id);

        if ($transaction) {
            $username = $transaction['username'];
            $judul = 'Detail Transaksi milik ' . $username;

            $data = [
                'transaction' => $transaction,
                'user'  => $this->db->get_where('user', ['username' => $username])->row_array(),
                'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
                'judul' => $judul
            ];

            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/log/info_transaction', $data);
            $this->load->view("templates/admin/footer", $data);
        } else {
            redirect('log/transaction');
        }
    }

    public function withdraw()
    {
        $data = [
            'judul' => "Log Tarik Tunai",
            'transaction' => $this->TransactionModel->getTransaction(),
            'withdraw' => $this->WithdrawModel->getWithdraw(),
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        ];

        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view("admin/log/withdraw", $data);
        $this->load->view("templates/admin/footer", $data);
    }

    public function info_withdraw($id)
    {
        $withdraw = $this->WithdrawModel->getWithdrawById($id);

        if ($withdraw) {
            $username = $withdraw['username'];
            $judul = 'Detail Transaksi milik ' . $username;

            $data = [
                'withdraw' => $withdraw,
                'user'  => $this->db->get_where('user', ['username' => $username])->row_array(),
                'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
                'judul' => $judul
            ];

            $this->load->view("templates/admin/header", $data);
            $this->load->view("templates/admin/sidebar", $data);
            $this->load->view("templates/admin/topbar", $data);
            $this->load->view('admin/log/info_withdraw', $data);
            $this->load->view("templates/admin/footer", $data);
        } else {
            redirect('log/withdraw');
        }
    }

    public function reports()
    {
        $data = [
            'judul' => "Log Laporan Masalah",
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'menu' => $this->db->get('reports')->result_array()
        ];

        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view("admin/log/reports", $data);
        $this->load->view("templates/admin/footer");
    }

    public function info_reports()
    {
        $laporan_id = $this->input->get('id');
        $data = [
            'judul' => "Informasi Laporan Pegawai",
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'menu' => $this->db->get('reports')->result_array()
        ];

        if ($laporan_id) {
            $data['laporan'] = $this->db->get_where('reports', ['id' => $laporan_id])->row_array();
        } else {
            $data['laporan'] = $this->db->get('reports')->result_array();
        }
        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view("admin/log/info_reports", $data);
        $this->load->view("templates/admin/footer");
    }

    public function pdf_withdraw()
    {
        $date = $this->input->get('date');
        $user = $this->input->get('user');

        if ($date) {
            $this->db->where('DATE(tanggal)', $date);
        }
        if ($user) {
            $this->db->like('username', $user);
        }

        $withdraw = $this->WithdrawModel->getWithdraw();

        $data = [
            'judul' => "Unduh Tarik Tunai",
            'transaction' => $this->TransactionModel->getTransaction(),
            'withdraw' => $withdraw,
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        ];

        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/recyloop/application/third_party/dompdf/autoload.inc.php";
        $dompdf = new Dompdf\Dompdf();

        $html = $this->load->view("admin/log/pdf_withdraw", $data, TRUE);

        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);

        $paper_size = 'A4';
        $orientation = 'landscape';

        $dompdf->set_paper($paper_size, $orientation);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("withdraw-annual-report.pdf", array('Attachment' => 0));
    }


    public function pdf_transaction()
    {
        $date = $this->input->get('date');
        $user = $this->input->get('user');

        if ($date) {
            $this->db->where('DATE(tanggal)', $date);
        }
        if ($user) {
            $this->db->like('username', $user);
        }

        $transaction = $this->TransactionModel->getTransaction();

        $data = [
            'judul' => "Unduh Tarik Tunai",
            'transaction' => $transaction,
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        ];

        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/recyloop/application/third_party/dompdf/autoload.inc.php";
        $dompdf = new Dompdf\Dompdf();

        $html = $this->load->view("admin/log/pdf_transaction", $data, TRUE);

        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);

        $paper_size = 'A4';
        $orientation = 'landscape';

        $dompdf->set_paper($paper_size, $orientation);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("transaction-annual-report.pdf", array('Attachment' => 0));
    }

    public function accounting()
    {
        $withdraw = $this->WithdrawModel->getWithdraw_Log();
        $sampah = $this->SampahModel->getDistribution_Log();
        $deposit = $this->FinanceModel->getDeposit_Log();

        $mergedData = array_merge($withdraw, $sampah, $deposit);

        usort($mergedData, function ($a, $b) {
            return strtotime($a['tanggal']) - strtotime($b['tanggal']);
        });

        $data = [
            'judul' => "Log Transaksi Penyerahan Sampah",
            'transactions' => $mergedData,
            'user'  => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        ];

        $this->load->view("templates/admin/header", $data);
        $this->load->view("templates/admin/sidebar", $data);
        $this->load->view("templates/admin/topbar", $data);
        $this->load->view("admin/log/accounting", $data);
        $this->load->view("templates/admin/footer", $data);
    }

    public function exportToExcel()
    {
        $withdraw = $this->WithdrawModel->getWithdraw_Log();
        $sampah = $this->SampahModel->getDistribution_Log();
        $deposit = $this->FinanceModel->getDeposit_Log();

        // Menggabungkan data ke dalam satu array
        $mergedData = array_merge($withdraw, $sampah, $deposit);

        // Mengurutkan data berdasarkan kolom 'tanggal'
        usort($mergedData, function ($a, $b) {
            return strtotime($a['tanggal']) - strtotime($b['tanggal']);
        });

        $data = [
            'transactions' => $mergedData,
        ];

        $this->load->view("admin/log/export_excel", $data);
    }

    public function pdf_accounting()
    {
        $withdraw = $this->WithdrawModel->getWithdraw_Log();
        $sampah = $this->SampahModel->getDistribution_Log();
        $deposit = $this->FinanceModel->getDeposit_Log();

        $mergedData = array_merge($withdraw, $sampah, $deposit);

        usort($mergedData, function ($a, $b) {
            return strtotime($a['tanggal']) - strtotime($b['tanggal']);
        });

        $data = [
            'transactions' => $mergedData,
        ];

        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/recyloop/application/third_party/dompdf/autoload.inc.php";
        $dompdf = new Dompdf\Dompdf();

        $html = $this->load->view("admin/log/pdf_accounting", $data, TRUE);

        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);

        $paper_size = 'A4';
        $orientation = 'landscape';

        $dompdf->set_paper($paper_size, $orientation);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("transaction-accountant.pdf", array('Attachment' => 0));
    }
}
