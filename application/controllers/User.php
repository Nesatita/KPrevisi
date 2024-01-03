<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		is_logged_in();
		$this->load->model('User_model');
		$this->load->model('Permohonan_model');
		$this->load->model('Auth_model');
	}

	public function index(){
		$data['title'] = 'My Profile';
		$data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'));
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function edit(){
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->User_model->getUserEditByEmail($this->session->userdata('email'));

		$this->form_validation->set_rules('name', 'Full name', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');

			$upload_image = $_FILES['image']['name'];

			if($upload_image){
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '10000';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('image')){
					$old_image = $data['user']['image'];
					if($old_image != 'default.jpg'){
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$this->User_model->updateUser($email, $name);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Profile telah diubah! </div>');
			redirect('user');
		}
	}

	public function changePassword(){
		$data['title'] = 'Change Password';
		$data['user'] = $this->User_model->getchangePasswordByEmail($this->session->userdata('email'));

		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'New Password', 'required|trim|min_length[3]|matches[new_password1]');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if(!password_verify($current_password, $data['user']['password'])){
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password yang dimasukkan salah! </div>');
				redirect('user/changepassword');
			} else {
				if($current_password === $new_password){
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Masukkan password baru! </div>');
					redirect('user/changepassword');
				} else {
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password berhasil diubah! </div>');
					redirect('user/changepassword');
				}
			}
		}
	}

	public function permohonan() {
		$data['title'] = 'Permohonan';
		$data['user'] = $this->Permohonan_model->getUserByEmail($this->session->userdata('email'));
	
		$this->load->model('Permohonan_model');
	
		// Fetch 'permohonan' data to pass to the view
		$data['permohonan'] = $this->Permohonan_model->get_permohonan();
	
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('upt', 'UPT', 'required');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
	
		if ($this->form_validation->run()) {
			// If form validation passes, handle the form submission
			$new_permohonan = array(
				'title' => $this->input->post('title'),
				'upt' => $this->input->post('upt'),
				'konten' => $this->input->post('konten'),
				'tanggal' => $this->input->post('tanggal'),
				'status' => $this->input->post('status')
			);
	
			$this->Permohonan_model->add_permohonan($new_permohonan);
	
			// Redirect to prevent form resubmission
			redirect('user/permohonan');
		}
	
		// Load the view, passing data to it
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/permohonan', $data);
		$this->load->view('templates/footer', $data);
	}
	
	private function can_user_add_permohonan($user_id) {
        // Replace this with your actual logic to check if the user can add permohonan
        // For example, you might check the user's role, permissions, or any other criteria
        $user_role = $this->User_model->get_user_role($user_id);

        return ($user_role == 'user'); // Allow only users to add permohonan
    }
	
	public function edit_permohonan($permohonan_id){
		$data['title'] = 'Edit Permohonan';
		$data['user'] = $this->Permohonan_model->getUserByEmail($this->session->userdata('email'));
		$data['permohonan'] = $this->Permohonan_model->get_permohonan_by_id($permohonan_id);
		
		// Assuming 'user_menu' is related to your menu structure
		$data['menu'] = $this->db->get('user_menu')->result_array();
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('upt', 'UPT', 'required');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit_permohonan', $data); // Assuming the view name is 'edit_permohonan'
			$this->load->view('templates/footer', $data);
		} else {
			// Retrieve form data for updating
			$title = $this->input->post('title');
			$upt = $this->input->post('upt');
			$konten = $this->input->post('konten');
			$status = $this->input->post('status');
			
			// Update 'permohonan' data
			$this->Permohonan_model->update_permohonan($permohonan_id, [
				'title' => $title,
				'upt' => $upt,
				'konten' => $konten,
				'status' => $status
			]);
	
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Permohonan berhasil diupdate! </div>');
			redirect('user/permohonan');
		}
	}
	

	public function delete_permohonan($permohonan_id) {
		$this->Permohonan_model->delete_permohonan($permohonan_id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permohonan berhasil dihapus!</div>');
		redirect('user/permohonan');
	}
	
}
