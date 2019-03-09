<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_REQUEST['isAjax'])) {
			$this->load->view('header');
		}
		$this->load->model('User', '', TRUE);
		$this->fields = array(
			'registration' => array('uname','email','pwd'),
			'login' => array('email','pwd'),
			'profile'=> array('email','mobile','company_name','address','city','state'),
			'products'=> array('product_cat','product_name','product_price','product_desc','attr_name','attr_value'),
			'productDelete'=> array('product_slug','product_cat')
		);
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

	public function do_login($isRedirect = false) {
		$isFormFiledValidate = $this->formFieldValidate('login');
		if(!$isFormFiledValidate && !$isRedirect) {
			$this->auth_fail(['error_login'=> 'Please refresh the page, then submit the form. Else contact us.']);
			return;
		}

		$user = $this->User->do_login($this->input->post());
		if(count($user) <= 0) {
			$this->auth_fail();
			return;
		}
		$this->session->set_userdata(['sv_amc'=> $user]);
		redirect('category/list_category', 'refresh');
	}

	public function do_register() {
		$isFormFiledValidate = $this->formFieldValidate('registration');
		if(!$isFormFiledValidate) {
			$this->auth_fail(['error_login'=> 'Please refresh the page, then submit the form. Else contact us.']);
			return;
		}

		$post = $this->input->post();
		$name = isset($post['email']) ? 'email' : 'mobile';
		$uniqueRes = $this->User->unique_check([$name=> $post[$name]]);

		if($uniqueRes['status']) {
			$return = $this->User->do_register($post);
			if(!$return) {
				$this->auth_fail('Your registration failed. Try again.');
				return;
			}
			return $this->do_login(true);
		}
		$this->auth_fail($uniqueRes['criteria']);
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
		$isFormFiledValidate = $this->formFieldValidate('profile');
		if(!$isFormFiledValidate) {
			$this->session->set_flashdata('error', 'Form fileds are mismatched. Please refresh the page, then try again.');
			redirect('users/after_login', 'refresh');
			return;
		}

		$user_data = $this->User->profile_update($this->input->post(), $this->current_user());
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

	public function check_auth($justStatus = false) {
		if(!isset($this->session->userdata()['sv_amc'])) {
			if(!$justStatus) {
				$this->index();
			}
            return false;
		}
		return true;
	}

	protected function current_user() {
		if(!isset($this->session->userdata()['sv_amc'])) {
			$this->auth_fail(['error_login'=> 'Please login first.']);
			return;
		}
		return $this->session->userdata()['sv_amc']->id;
	}

	public function sess_update($array) {
		$sessData = $this->session->userdata()['sv_amc'];
        $sessData->$array[0] = $array[1];
        $this->session->set_userdata(['sv_amc'=> $sessData]);
	}

	public function unique_check() {
		$post = [
			$this->input->post('name')=> $this->input->post('value')
		];
		$return = $this->User->unique_check($post);
        echo json_encode($return);
        return;
	}

	public function reset() {
		$isLogin = $this->check_auth(true);
		$title = $isLogin ? 'Change' : 'Reset';
		$this->load->view('user/reset_password', ['isLogin'=> $isLogin, 'title'=> $title]);
		$this->load_footer();
	}

	public function do_reset() {
		$oldPassword = $this->input->post('old_password');
		$newPassword = $this->input->post('new_password');
		$newPassword2 = $this->input->post('new_password2');

		$returnData = ['class'=> 'alert alert-success', 'msg'=> 'Password updated successfully.'];
		if($newPassword === $newPassword2) {
			$userData = $this->get_data($this->current_user());
			$isPasswordMatch = password_verify($oldPassword, $userData->pwd);

			if($isPasswordMatch) {
				$willBeUpdateData = ['pwd'=> password_hash($newPassword, PASSWORD_DEFAULT)];
				$this->User->profile_update($willBeUpdateData, $this->current_user());
			} else {
				$returnData = ['class'=> 'alert alert-danger', 'msg'=> 'Your old password is wrong. Please confirm.'];
			}
		} else {
			$returnData = ['class'=> 'alert alert-danger', 'msg'=> 'Your passwords were mismatched. Please confirm.'];
		}
		$this->session->set_flashdata($returnData);
		redirect('users/reset', 'refresh');
		return;
	}

	public function logout() {
		$this->session->unset_userdata('sv_amc');
		$this->auth_fail(['error_login' => 'You are logged out just now.']);
		return;
	}

	public function formFieldValidate($formname) {
		$fields = $this->fields[$formname];
		$post_fields = array_keys($this->input->post());

		if(count($fields) > count($post_fields)) {
			return false;
		}

		foreach($post_fields as $field) {
			if(!in_array($field, $fields)) {
				if($field !== 'mobile') {
					return false;
				}
			}
		}

		return true;
	}
}
