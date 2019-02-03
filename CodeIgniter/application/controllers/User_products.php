<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Products.php';

class User_products extends Products {
    public function __construct(){
        parent::__construct();
        $this->check_auth();
        $this->user_id = $this->session->userdata()['sv_amc']->id;
    }
    
    public function index() {
        $data = $this->Products_model->current_user_products($this->user_id);
        $this->load->view('product/current_user/mpp', ['data' => $data]);
    }

    public function mpp() {
        $this->index();
    }

    public function spp() {
        
    }

}
?>