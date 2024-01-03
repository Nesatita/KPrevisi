<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		is_logged_in();

		$this->load->model('menu_model');
		
	}

	public function index(){
		$data['title'] = 'Menu Management';
		$data['user'] = $this->menu_model->getMenuByEmail($this->session->userdata('email'));
		
		$data['menu'] = $this->menu_model->getUserMenuManagement();

		$this->form_validation->set_rules('menu','Menu','required');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer', $data);
		} else{
			
			$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
			
			$role_id = $this->session->userdata('role_id');
            $data['menu'] = $this->menu_model->getMenuByRoleId($role_id);

            // Use the Menu_model to get submenus for the newly added menu
            $menuId = $this->db->insert_id(); 
            $data['subMenu'] = $this->menu_model->getSubMenuByMenuId($menuId);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Menu berhasil ditambahkan! </div>');
			redirect('menu');
		}

		$role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->menu_model->getUserMenu($role_id);

        $this->load->view('menu/index', $data);
	}

	public function edit_menu($menu_id){
		$data['title'] = 'Edit Menu';
		$data['user'] = $this->menu_model->getMenuByEmail($this->session->userdata('email'));
		$data['menu'] = $this->menu_model->getMenuById($menu_id);
	
		$this->form_validation->set_rules('menu', 'Menu', 'required');
	
		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/edit_menu', $data); 
			$this->load->view('templates/footer', $data);
		} else {
			$menu_name = $this->input->post('menu');
			$this->menu_model->updateMenu($menu_id, $menu_name);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Menu berhasil diupdate! </div>');
			redirect('menu');
		}
	}
	

	public function delete_menu($menu_id){
		$this->menu_model->deleteMenuById($menu_id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil dihapus!</div>');
		redirect('menu');
	}

	public function submenu(){
		$data['title'] = 'SubMenu Management';
		$data['user'] = $this->menu_model->getMenuByEmail($this->session->userdata('email'));


		$this->load->model('Menu_model','menu');

		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->menu_model->getUserMenuManagement();

		$this->form_validation->set_rules('title','Title','required');
		$this->form_validation->set_rules('menu_id','Menu','required');
		$this->form_validation->set_rules('url','URL','required');
		$this->form_validation->set_rules('icon','icon','required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];
			
			$this->menu_model->insertSubMenu($data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Sub Menu berhasil ditambahkan! </div>');
			redirect('menu/submenu');
		}
	}

	public function edit_submenu($submenu_id){
		$data['title'] = 'Edit SubMenu';
		$data['user'] = $this->menu_model->getMenuByEmail($this->session->userdata('email'));
		$data['submenu'] = $this->menu_model->getSubMenuById($submenu_id);
		$data['menu'] = $this->menu_model->getUserMenuManagement();
	
		$this->form_validation->set_rules('title','Title','required');
		$this->form_validation->set_rules('menu_id','Menu','required');
		$this->form_validation->set_rules('url','URL','required');
		$this->form_validation->set_rules('icon','Icon','required');
	
		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/edit_submenu', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$title = $this->input->post('title');
			$menu_id = $this->input->post('menu_id');
			$url = $this->input->post('url');
			$icon = $this->input->post('icon');
			$is_active = $this->input->post('is_active');
	
			$data = [
				'title' => $title,
				'menu_id' => $menu_id,
				'url' => $url,
				'icon' => $icon,
				'is_active' => $is_active
			];
			
			$this->menu_model->updateSubMenu($submenu_id, $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Submenu berhasil diupdate! </div>');
			redirect('menu/submenu');
		}
	}

	public function delete_submenu($submenu_id){
		$this->menu_model->deleteSubMenuById($submenu_id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu berhasil dihapus!</div>');
		redirect('menu/submenu');
	}
}
