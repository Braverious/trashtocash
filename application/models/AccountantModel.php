<?php
class AccountantModel extends CI_Model
{
    public function countWithdraw_Log()
    {
        return $this->db->count_all('withdraw');
    }

    public function getWithdraw_Log($limit, $offset)
    {
        $this->db->select('tanggal, nominal');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('withdraw');
        return $query->result_array();
    }

    public function countDistribution_Log()
    {
        return $this->db->count_all('distribution');
    }

    public function getDistribution_Log($limit, $offset)
    {
        $this->db->select('tanggal, nilai_tukar');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('distribution');
        return $query->result_array();
    }

    public function countDeposit_Log()
    {
        return $this->db->count_all('deposit');
    }

    public function getDeposit_Log($limit, $offset)
    {
        $this->db->select('tanggal, jumlah');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('deposit');
        return $query->result_array();
    }
}
