<?php

class MemberModel extends CI_Model
{
    public function getReview()
    {
        $query = $this->db->get('review');
        return $query->result_array();
    }
}