<?php

class WithdrawModel extends CI_Model
{
    public function getWithdraw()
    {
        $query = $this->db->get('withdraw');
        return $query->result_array();
    }

    public function getWithdraw_Log()
    {
        $this->db->select('tanggal, nominal');
        $query = $this->db->get('withdraw');
        return $query->result_array();
    }

    public function newWithdraw($data)
    {
        return $this->db->insert('withdraw', $data);
    }

    public function delete_withdraw($id)
    {
        $withdraw = $this->db->get_where('withdraw', ['id' => $id])->row_array();
        if ($withdraw) {
            $this->db->where('id', $id);
            $this->db->delete('withdraw');
            return true;
        } else {
            return false;
        }
    }

    public function getWithdrawById($id)
    {
        $query = $this->db->get_where('withdraw', ['id' => $id]);
        return $query->row_array();
    }

    public function getSomeWithdraw($limit, $start)
    {
        $this->db->limit($limit, $start);
        return $this->db->get('withdraw')->result_array();
    }

    public function countAllWithdraw()
    {
        return $this->db->get('withdraw')->num_rows();
    }
}
