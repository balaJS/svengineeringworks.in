<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->view('header');
		$this->load->model('User', '', TRUE);
	}

	public function index()
	{
		$this->load->view('product/category');
	}

	public function login()
	{
		$this->load->view('user/login');
	}

	public function do_login() {
		$user = $this->User->do_login($this->input->post());
		if(count($user) <= 0) {
			$data = [
				'error_login' => 'Your cretentials are wrong. Try again.',
			];
			$this->load->view('user/login', $data);
			return;
		}
		$this->session->set_userdata(['sv_amc'=> $user]);
		redirect('Products/list_category', 'refresh');
	}

	public function do_register() {
		$this->User->do_register($this->input->post());
		//$this->load->view('index');
		redirect('Products/list_category', 'refresh');
		
	}

	public function get_data($id) {
		return $this->User->get_data($id);
	}
}
