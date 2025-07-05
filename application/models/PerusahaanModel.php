<?php

class PerusahaanModel extends CI_Model
{
    public function getInfoPerusahaan()
    {
        return $this->db->get('company')->result_array();
    }

    public function getInfoPerusahaanById($id)
    {
        $query = $this->db->get_where('company', ['id' => $id]);
        return $query->row_array();
    }

    public function tambahInformasi($data)
    {
        return $this->db->insert('company', $data);
    }

    public function ubahInformasi($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('company', $data);
    }

    public function hapusInformasi($id)
    {
        return $this->db->delete('company', ['id' => $id]);
    }

}