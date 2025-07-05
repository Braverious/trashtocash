<?php

class StaffModel extends CI_Model
{
    public function tambahStaff($data)
    {
        return $this->db->insert('staff', $data);
    }
}
