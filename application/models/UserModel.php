<?php

class UserModel extends CI_Model
{
    public function getUserByRole($role_id)
    {
        $query = $this->db->get_where('user', ['role_id' => $role_id]);

        return $query->result_array();
    }

    public function getInfoByRoleId($role_id)
    {
        $query = $this->db->get_where('user', ['role_id' => $role_id]);
        return $query->result_array();
    }

    public function getUser()
    {
        return $this->db->get('user')->result_array();
    }

    public function getUserById($id)
    {
        $query = $this->db->get_where(['user', ['id' => $id]]);
        return $query->row_array();
    }

    public function getSomeUser($role_id, $limit, $start)
    {
        $this->db->where('role_id', $role_id);
        $this->db->limit($limit, $start);
        return $this->db->get('user')->result_array();
    }

    public function countAllStaff($role_id)
    {
        $this->db->where('role_id', $role_id);
        return $this->db->get('user')->num_rows();
    }

    public function countAllMember($role_id)
    {
        $this->db->where('role_id', $role_id);
        return $this->db->get('user')->num_rows();
    }

    public function tambahUser($data)
    {
        return $this->db->insert('user', $data);
    }

    public function editUser($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    public function getStaffById($id)
    {
        $query = $this->db->get_where('user', ['id_staff' => $id]);
        return $query->row_array();
    }

    public function getMemberById($id)
    {
        $query = $this->db->get_where('user', ['id_member' => $id]);
        return $query->row_array();
    }
}