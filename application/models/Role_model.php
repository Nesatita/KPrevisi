<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{
    public function getUserByEmail($email)
    {
        return $this->db->get_where('user', ['email' => $email])->row_array();
    }

    public function getAllRoles()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function getRoleById($role_id)
    {
        return $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    }

    public function getAllMenus()
    {
        $this->db->where('id !=', 1);
        return $this->db->get('user_menu')->result_array();
    }

    public function changeAccess($menu_id, $role_id)
    {
        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
    }
}
