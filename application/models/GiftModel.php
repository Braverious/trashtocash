<?php

class GiftModel extends CI_Model
{
    public function getGift()
    {
        $query = $this->db->get('cinderamata');
        return $query->result_array();
    }

    public function tambahGift($data)
    {
        return $this->db->insert('cinderamata', $data);
    }

    public function editGift($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('cinderamata', $data);
    }

    public function getGiftBy_Id($gift_id)
    {
        $query = $this->db->get_where('cinderamata', ['id' => $gift_id]);
        return $query->row_array();
    }

    public function getGiftById($id)
    {
        $query = $this->db->get_where('cinderamata', ['id' => $id]);
        return $query->row_array();
    }

    public function reduceStock($gift_id)
    {
        $gift = $this->db->get_where('cinderamata', ['id' => $gift_id])->row_array();
        $new_stock = $gift['stok'] - 1;
        $this->db->set('stok', $new_stock);
        $this->db->where('id', $gift_id);
        $this->db->update('cinderamata');
    }
}