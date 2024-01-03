<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function get_user_by_email($email)
    {
        return $this->db->get_where('user', ['email' => $email])->row_array();
    }

	public function role($role){
		return $this->db->get_where('user_role', ['role' => $role]);
	}

}
