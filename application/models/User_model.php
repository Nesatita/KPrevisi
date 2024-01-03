<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getUserByEmail($email)
    {
        return $this->db->get_where('user', ['email' => $email])->row_array();
    }

	public function getUserEditByEmail($email)
	{
		return $this->db->get_where('user',['email' => $email])->row_array();
	}

	public function updateUser($email, $name)
    {
        $this->db->set('name', $name);
        $this->db->where('email', $email);
        $this->db->update('user');
    }

	public function getchangePasswordByEmail($email)
	{
		return $this->db->get_where('user',['email' => $email])->row_array();
	}

	public function countTotalUsers() {
        return $this->db->count_all_results('user'); 
    }
	public function totalPermohonan() {
        return $this->db->count_all_results('permohonan'); 
    }
	public function getUserRole($user_id) {
        // Assuming you have a 'role' column in your user table
        $this->db->select('role');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user'); // Change 'users' to your actual table name

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->role;
        } else {
            // Handle the case when user_role is not found
            return null;
        }
    }
	public function get_user_role($user_id) {
        // Example: Get user role from the database based on $user_id
        // Replace this with your actual logic to fetch the user role
        $query = $this->db->get_where('user', array('id' => $user_id));
        $user = $query->row();

        return $user->role; // Assuming 'role' is a field in your 'users' table
    }
}
