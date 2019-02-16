<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!isset($_REQUEST['isAjax'])) {
			$this->load->view('header');
		}
		$this->load->model('User', '', TRUE);
	}

	public function index()
	{
		$this->login();
	}

	public function login()
	{
		if(isset($this->session->userdata()['sv_amc'])) {
			$this->after_login();
			return;
		}
		$this->load->view('user/login');
		$this->load_footer();
	}

	public function do_login() {
		
		$user = $this->User->do_login($this->input->post());
		if(count($user) <= 0) {
			$this->auth_fail();
			return;
		}
		$this->session->set_userdata(['sv_amc'=> $user]);
		redirect('category/list_category', 'refresh');
	}

	public function do_register() {
		$this->User->do_register($this->input->post());
		redirect('category/list_category', 'refresh');
		return;
	}

	public function get_data($id) {
		return $this->User->get_data($id);
	}

	public function after_login() {
		$this->load->view('user/profile', ['data' => $this->session->userdata()['sv_amc']]);
		$this->load_footer();
		return;
	}

	public function profile_update() {
		if(!isset($this->session->userdata()['sv_amc'])) {
			$this->auth_fail();
			return;
		}
		$id = $this->session->userdata()['sv_amc']->id;
		$user_data = $this->User->profile_update($this->input->post(), $id);
		$this->session->set_flashdata('msg', 'Your profile updated.');
		$this->session->set_flashdata('data', $user_data);
		$this->session->set_userdata(['sv_amc'=> $user_data]);
		redirect('users/login', 'refresh');
	}

	public function auth_fail($data = false) {
		$error_data = $data ? $data : ['error_login' => 'Your cretentials are wrong. Try again.'];
		$this->load->view('user/login', $error_data);
		$this->load_footer();
		return;
	}

	public function load_footer() {
		$this->load->view('footer');
	}

	public function check_auth() {
		if(!isset($this->session->userdata()['sv_amc'])) {
            $this->index();
            return false;
		}
		return true;
	}

	public function logout() {
		$this->session->unset_userdata('sv_amc');
		$this->auth_fail(['error_login' => 'You are logged out just now.']);
		return;
	}
}
