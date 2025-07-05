<?php

class LimbahModel extends CI_Model
{
    public function getLimbah()
    {
        return $this->db->get('sampah')->result_array();
    }

    public function getLimbahById($id)
    {
        return $this->db->get_where('sampah', ['id' => $id])->row_array();
    }
}
