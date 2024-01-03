<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu_model extends CI_Model
{
    public function getSubMenuByMenuId($menuId)
    {
        $query = $this->db->query("SELECT *
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                    WHERE `user_sub_menu`.`menu_id` = $menuId 
                    AND `user_sub_menu`.`is_active` = 1");

        return $query->result_array();
    }

}
