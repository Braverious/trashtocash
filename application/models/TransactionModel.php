<?php

class TransactionModel extends CI_Model
{
    public function getTransaction()
    {
        $query = $this->db->get('transaction');
        return $query->result_array();
    }

    public function newTransaction($data)
    {
        return $this->db->insert('transaction', $data);
    }

    public function updatetransaction($id, $status, $tgl_validasi)
    {
        $data = [
            'status' => $status,
            'tgl_validasi' => $tgl_validasi
        ];
        $this->db->where('id', $id);
        $this->db->update('transaction', $data);
    }

    // public function delete_transaction($id)
    // {
    //     $transaction = $this->db->get_where('transaction', ['id' => $id])->row_array();
    //     if ($transaction) {
    //         $this->db->where('id', $id);
    //         $this->db->delete('transaction');
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function delete_transaction($id)
    {
        $transaction = $this->db->get_where('transaction', ['id' => $id])->row_array();
        if ($transaction) {
            $id_member = $transaction['id_member'];
            $user = $this->db->get_where('user', ['id_member' => $id_member])->row_array();

            if ($user) {
                $updated_koin = $user['koin'] - $transaction['totalkoin'];
                $this->db->where('id_member', $id_member);
                $this->db->update('user', ['koin' => $updated_koin]);
                $updated_sampah = $user['total_sampah'] - $transaction['total'];
                $this->db->where('id_member', $id_member);
                $this->db->update('user', ['total_sampah' => $updated_sampah]);
            }
            $this->db->where('id', $id);
            $this->db->delete('transaction');
            return true;
        } else {
            return false;
        }
    }

    public function editTransaction($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('transaction', $data);
    }

    public function getTransactionById($id)
    {
        $query = $this->db->get_where('transaction', ['id' => $id]);
        return $query->row_array();
    }
}
