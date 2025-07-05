<?php

class ReviewModel extends CI_Model
{
    public function tambahReview($data)
    {
        return $this->db->insert('review', $data);
    }

    public function updatereview($id)
    {
        $data = [
            'is_active' => "1",
        ];
        $this->db->where('id', $id);
        $this->db->update('review', $data);
    }
}
