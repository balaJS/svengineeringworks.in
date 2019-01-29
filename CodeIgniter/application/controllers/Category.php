<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->view('header');
		$this->load->model('Category_model', '', TRUE);
	}

	public function index()
	{
		$this->load->view('product/category');
	}

	public function list_category()
	{
		$data = $this->Category_model->list_category('all');
		$this->load->view('product/category', ['data' => $data]);
	}
}
