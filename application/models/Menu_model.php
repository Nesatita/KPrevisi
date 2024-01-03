<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

	public function getSubMenu()
	{
		$query = "SELECT `user_sub_menu`.*, `user_menu`.`menu` 
					FROM `user_sub_menu` 
					JOIN `user_menu` ON `user_sub_menu`.`menu_id` =`user_menu`.`id`";
		return $this->db->query($query)->result_array();
	}

	public function getUserMenu($role_id)
	{
		$queryMenu = "SELECT `user_menu`.`id`, `menu`
                        FROM `user_menu` JOIN `user_access_menu`
                        ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                        WHERE `user_access_menu`.`role_id` = $role_id 
                        ORDER BY `user_access_menu`.`menu_id` ASC";
		return $this->db->query($queryMenu)->result_array();
	}

	public function getMenuByRoleId($role_id)
    {
        $query = $this->db->query("SELECT `user_menu`.`id`, `menu`
            FROM `user_menu` JOIN `user_access_menu`
            ON `user_menu`.`id` = `user_access_menu`.`menu_id`
            WHERE `user_access_menu`.`role_id` = $role_id 
            ORDER BY `user_access_menu`.`menu_id` ASC");

        return $query->result_array();
    }

    public function getSubMenuByMenuId($menuId)
    {
        $query = $this->db->query("SELECT *
            FROM `user_sub_menu` JOIN `user_menu`
            ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
            WHERE `user_sub_menu`.`menu_id` = $menuId 
            AND `user_sub_menu`. `is_active` = 1");
        return $query->result_array();
    }

	public function getMenuByEmail($email)
    {
        return $this->db->get_where('user', ['email' => $email])->row_array();
    }


	public function insertUserMenu($data)
    {
        $this->db->insert('user_menu', $data);
        return $this->db->insert_id();
    }

    
	
	public function getUserMenuRole($role_id)
    {
        $this->db->where('role_id', $role_id);
        return $this->db->get('user_menu')->result_array();
    }

    public function getMenuByRoleIdRole($role_id)
    {
        $this->db->where('role_id', $role_id);
        return $this->db->get('user_menu')->result_array();
    }

    public function getSubMenuByMenuIdRole($menuId)
    {
        $this->db->where('menu_id', $menuId);
        return $this->db->get('user_sub_menu')->result_array();
    }

	public function getUserMenuManagement()
    {
        return $this->db->get('user_menu')->result_array();
    }

	public function getMenuById($menu_id)
    {
        return $this->db->get_where('user_menu', ['id' => $menu_id])->row_array();
    }

	public function updateMenu($menu_id, $menu_name)
    {
        $this->db->where('id', $menu_id);
        $this->db->update('user_menu', ['menu' => $menu_name]);
    }

	public function deleteMenuById($menu_id)
    {
        $this->db->where('id', $menu_id);
        $this->db->delete('user_menu');
    }

	public function getSubMenuById($submenu_id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $submenu_id])->row_array();
    }

	public function insertSubMenu($data)
    {
        $this->db->insert('user_sub_menu', $data);
    }

	public function updateSubMenu($submenu_id, $data)
    {
        $this->db->where('id', $submenu_id);
        $this->db->update('user_sub_menu', $data);
    }

	public function deleteSubMenuById($submenu_id)
    {
        $this->db->where('id', $submenu_id);
        $this->db->delete('user_sub_menu');
    }

	
}
