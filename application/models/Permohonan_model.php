<?php
class Permohonan_model extends CI_Model {

    public function get_permohonan() {
        return $this->db->get('permohonan')->result_array();
    }

    public function add_permohonan($data) {
        $this->db->insert('permohonan', $data);
    }

	public function get_permohonan_by_id($permohonan_id) {
        return $this->db->get_where('permohonan', ['id' => $permohonan_id])->row_array();
    }
    
    public function update_permohonan($permohonan_id, $data) {
        $this->db->where('id', $permohonan_id);
        $this->db->update('permohonan', $data);
    }

	public function getUserByEmail($email)
    {
        // Assuming you have loaded the User_model in the constructor or autoloaded it.
        $this->load->model('User_model');

        return $this->User_model->getUserByEmail($email);
    }
	
	public function delete_permohonan($permohonan_id)
    {
        $this->db->where('id', $permohonan_id);
        $this->db->delete('permohonan');
    }	
	
}
