<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Users.php';

class Products extends Users {

	public function __construct(){
		parent::__construct();
		$this->load->model('Products_model', '', TRUE);
	}

	public function index()
	{
		$this->load->view('category');
		$this->load_footer();
	}

	public function list_products() {
		$uri = $this->uri->segment_array();
		$data = $this->Products_model->list_products($uri[3]);
		$this->load->view('product/mpp', ['data' => $data]);
		$this->load_footer();
	}

	public function view_product() {
		$uri = $this->uri->segment_array();
		$data = $this->Products_model->view_product($uri[3],$uri[4]);
		$this->load->view('product/spp', ['data' => $data]);
		$this->load_footer();
	}
}
