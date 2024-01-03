<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('role_model');
        $this->load->model('User_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->role_model->getUserByEmail($this->session->userdata('email'));
		$data['total_users'] = $this->User_model->countTotalUsers();
		$data['permohonan'] = $this->User_model->totalPermohonan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->role_model->getUserByEmail($this->session->userdata('email'));
        $data['role'] = $this->role_model->getAllRoles();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer', $data);
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->role_model->getUserByEmail($this->session->userdata('email'));
        $data['role'] = $this->role_model->getRoleById($role_id);
        $data['menu'] = $this->role_model->getAllMenus();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer', $data);
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $this->role_model->changeAccess($menu_id, $role_id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses telah diubah! </div>');
    }


}
