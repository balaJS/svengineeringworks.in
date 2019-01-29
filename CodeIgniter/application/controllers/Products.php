<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->view('header');
		$this->load->model('Products_model', '', TRUE);
	}

	public function index()
	{
		$this->load->view('category');
	}

	public function list_products() {
		$uri = $this->uri->segment_array();
		$data = $this->Products_model->list_products($uri[3]);
		$this->load->view('product/mpp', ['data' => $data]);
	}

	public function view_product() {
		$this->load->view('product/spp');
		
	}
}
