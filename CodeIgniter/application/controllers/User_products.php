<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Products.php';

class User_products extends Products {
    public function __construct(){
        parent::__construct();
        $this->check_auth();
        $this->user_id = $this->session->userdata()['sv_amc']->id;
        if(isset($_POST['isAjax'])) {
            unset($_POST['isAjax']);
        }
    }
    
    public function index() {
        $data = $this->Products_model->current_user_products($this->user_id);
        $this->load->view('product/current_user/mpp', ['data' => $data]);
    }

    public function mpp() {
        $this->index();
    }

    public function add_form() {
        $this->load->model('Category_model');
        $data = $this->Category_model->list_category('all', 'cat_name, cat_slug');
        $this->load->view('product/current_user/add_form', ['page' => 'add', 'data' => $data]);
        $this->load_footer();
    }

    public function add($prodId = 0) {
        $this->load->model('Category_model');

        if($_FILES['product_image1']['size'] !== 0) {
            $this->load->library('upload');
            $this->upload->set_upload_path('./static/img/products/');
            $this->upload->set_allowed_types(['png','jpg','jpeg','gif']);
            $isUpload = $this->upload->do_upload('product_image1');
            $msg = $this->upload->data();
            if($isUpload && $msg['is_image']) {
                $_POST['product_image1'] = $msg['file_name'];
            } else {
                $data = [
                    'msg' => $this->upload->display_errors()[0],
                    'htmlClass' => 'alert alert-danger'
                ];
                $this->session->set_flashdata('msg', $data);
                redirect('user_products/add_form', 'refresh');
                return;
            }
        }
        
        $_POST['user_id'] = $this->user_id;
        $_POST['product_spec'] = json_encode(array_combine($this->input->post('attr_name'), $this->input->post('attr_value')));
        unset($_POST['attr_name']); unset($_POST['attr_value']); 

        $category_name = $_POST['product_cat'] = empty($_POST['product_cat'][0]) ? $_POST['product_cat'][1] : $_POST['product_cat'][0];
        $_POST['product_cat'] = $this->create_slug($_POST['product_cat']);
        $_POST['product_slug'] = $this->create_slug($_POST['product_name']);
        $category = $this->Category_model->list_category($_POST['product_cat'], 'cat_slug');

        if(count($category) <= 0) {
            $add_cat_data = [
                'cat_name' => $category_name,
                'cat_slug' => $_POST['product_cat'],
                'status' => 1,
                'cat_image' => $_POST['product_image1']
            ];
            $this->Category_model->add_category($add_cat_data);
        }

        $returnData = $this->Products_model->add_product($this->input->post(), $prodId);
        if($prodId) {
            return $returnData;
        }
        $data = [
            'msg' => 'Product added successfully.',
            'htmlClass' => 'alert alert-success'
        ];
        if(!$returnData) {
            $data = [
                'msg' => 'Product added is failed. Plaese try again.',
                'htmlClass' => 'alert alert-danger'
            ];
        }
        $this->session->set_flashdata('msg', $data);
        redirect('user_products/add_form', 'refresh');
        exit;
    }

    public function create_slug($string) {
        return str_replace([' ', '"', "'" ], '-', strtolower($string));
    }

    public function unique_check() {
        $_POST['user_id'] = $this->user_id;
        $return = $this->Products_model->unique_check($this->input->post());
        echo json_encode($return);
        return;
    }

    public function edit_form($cslug, $pslug) {
        $this->load->model('Category_model');
        $allCatData = $this->Category_model->list_category('all', 'cat_name, cat_slug');
        $cat_prod_data = $this->Products_model->view_product($cslug, $pslug, $this->current_user());

        if(!$cat_prod_data[0]) {
            redirect('user_products/mpp', 'refresh');
            exit;
        }
        #var_dump($cat_prod_data);exit;

        $this->load->view('product/current_user/add_form', ['page' => 'edit', 'overAllData' => [$allCatData, $cat_prod_data]]);
        $this->load_footer();
        $this->sess_update(['currentProdId', $cat_prod_data[0][0]->product_id]);
        return;
    }

    public function update() {
        $currentProdId = $this->session->userdata()['sv_amc']->currentProdId;
        $returnData = $this->add($currentProdId);
        $slugs = $this->Products_model->get_product(['product_id'=> $currentProdId]);
        $data = [
            'msg' => 'Product updated successfully.',
            'htmlClass' => 'alert alert-success'
        ];
        if(!$returnData) {
            $data = [
                'msg' => 'Product not updated. Plaese try again.',
                'htmlClass' => 'alert alert-danger'
            ];
        }

        $this->session->set_flashdata('msg', $data);
        redirect('user_products/edit/'.$slugs->product_cat.'/'.$slugs->product_slug, 'refresh');
        exit;
    }

    public function delete() {
        $postData = $this->input->post();
        $postData['user_id'] = $this->current_user();
        $returnData = $this->Products_model->delete_product($this->input->post());
        echo json_encode($returnData);
        return;
    }

}
?>
