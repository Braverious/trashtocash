<?php

class SampahModel extends CI_Model
{
    public function getSampah()
    {
        $query = $this->db->get('sampah');
        return $query->result_array();
    }

    public function tambahSampah($data)
    {
        return $this->db->insert('sampah', $data);
    }

    public function editSampah($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('sampah', $data);
    }

    public function getSampahById($id)
    {
        $query = $this->db->get_where('sampah', ['id' => $id]);
        return $query->row_array();
    }

    public function getDistribution()
    {
        $query = $this->db->get('distribution');
        return $query->result_array();
    }

    public function getDistribution_Log()
    {
        $this->db->select('tanggal, nilai_tukar');
        $query = $this->db->get('distribution');
        return $query->result_array();
    }

    public function tambahDistribution($data)
    {
        return $this->db->insert('distribution', $data);
    }

    public function getDistributionById($id)
    {
        $query = $this->db->get_where('distribution', ['id' => $id]);
        return $query->row_array();
    }

    public function getSomeDistribution($limit, $start)
    {
        $this->db->limit($limit, $start); 
        return $this->db->get('distribution')->result_array();
    }

    public function countAllDistribution()
    {
        return $this->db->get('distribution')->num_rows();
    }


    public function editDistribution($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('distribution', $data);
    }
}
