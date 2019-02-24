<?php
class Products_model extends CI_Model {

	public function __construct(){
		$this->table = 'product';
		parent::__construct();
		$this->load->model('User');
	}

	public function list_products($cat_slug, $internal = 0) {
		$selecter = $internal ? 'product_id' : '*';
		$query = "SELECT $selecter FROM product as p INNER JOIN users as u ON p.user_id = u.id where p.status = 1 && p.product_cat = '$cat_slug'";
		$rows = $this->db->query($query);
		if($internal) return $rows->num_rows();
		return $rows->result();
	}

	public function view_product($cslug, $pslug, $userid = 0) {
		#fix me(resorce drop here)
		$userWhere = $userid === 0 ? '' :  "&& u.id = '$userid'";
		$query = "SELECT * FROM product as p INNER JOIN users as u ON p.user_id = u.id where p.status = 1 && p.product_slug = '$pslug' && p.product_cat = '$cslug' $userWhere";
		$rows = $this->db->query($query);
		$cat_query = "SELECT cat_name, cat_slug FROM categary where cat_slug = '$cslug'";
		$cat_row = $this->db->query($cat_query);
		return [$rows->result(), $cat_row->result()];
	}

	public function get_product($where) {
		$this->db->select('product_cat, product_slug');
		return $this->db->get_where($this->table, $where)->result()[0];
	}

	public function current_user_products($id = 0) {
		$query = "SELECT * FROM product as p INNER JOIN categary as c ON p.product_cat = c.cat_slug where p.status = 1 && p.user_id = '$id'";
		$rows = $this->db->query($query)->result();
		$sorted = [];
		$temp = [];
		foreach($rows as $data) {
			if(isset($temp['cat_id']) && in_array( $data->cat_id, $temp['cat_id'])) {
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_id'] = $data->product_id;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_name'] = $data->product_name;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_slug'] = $data->product_slug;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_desc'] = $data->product_desc;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_spec'] = $data->product_spec;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_price'] = $data->product_price;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_image1'] = $data->product_image1;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['status'] = $data->status;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['prod_create_date'] = $data->prod_create_date;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['prod_last_modify'] = $data->prod_last_modify;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_cat'] = $data->product_cat;
				continue;
			}
				$temp['cat_id'][] = $data->cat_id;
				$sorted['category'][$data->cat_slug]['cat_id'] = $data->cat_id;
				$sorted['category'][$data->cat_slug]['cat_name'] = $data->cat_name;
				$sorted['category'][$data->cat_slug]['cat_image'] = $data->cat_image;
				$sorted['category'][$data->cat_slug]['cat_create_date'] = $data->cat_create_date;
				$sorted['category'][$data->cat_slug]['cat_last_modify'] = $data->cat_last_modify;
				$sorted['category'][$data->cat_slug]['cat_slug'] = $data->cat_slug;

				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_id'] = $data->product_id;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_name'] = $data->product_name;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_slug'] = $data->product_slug;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_desc'] = $data->product_desc;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_spec'] = $data->product_spec;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_price'] = $data->product_price;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_image1'] = $data->product_image1;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['status'] = $data->status;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['prod_create_date'] = $data->prod_create_date;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['prod_last_modify'] = $data->prod_last_modify;
				$sorted['cat_id-'.$data->cat_id]['prod_id-'.$data->product_id]['product_cat'] = $data->product_cat;
		}
		return $sorted;
	}

	public function add_product($formData, $id) {

		if(!$id) {
			return $this->db->insert($this->table, $formData);
		} else {
			$this->db->where('product_id', $id);
			return $this->db->update($this->table, $formData);
		}
	}

	public function unique_check($formData) {
		$formData['status'] = 1;
		$query = $this->db->get_where($this->table, $formData);
		$name = $query->num_rows() ? $query->result()[0]->product_name : '';
		return [
			'count'=> $query->num_rows(),
			'name' => $name
		];
	}

	public function delete_product($formData) {
		$query = $this->db->get_where($this->table, $formData);

		$data = ['status'=> false, 'criteria'=> "Sorry, You are trying to delete another user's product"];
		if($query->num_rows()) {
			$this->db->delete($this->table, $formData);
			$data = ['status'=> 0, 'criteria'=> "Your product was deteled."];
		}
		return $data;
	}

	public function auto_complete($search_term) {
		$productsQuery = $this->db->select('product_slug, product_name, product_cat')->from($this->table)->where("product_name like '%$search_term%'")->get();
		if($productsQuery->num_rows()) {
			return $productsQuery->result_array();
		}
		
		$this->load->model('Category_model');
		$categoriesQuery = $this->Category_model->auto_complete($search_term);

		if($categoriesQuery->num_rows()) {
			return $categoriesQuery->result_array();
		}

		return ['status'=> false, 'data'=> []];
	}
}

?>