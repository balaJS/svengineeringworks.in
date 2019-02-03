<?php
class Products_model extends CI_Model {

	public function __construct(){
		$this->table = 'product';
		parent::__construct();
		$this->load->model('User');
	}

	public function list_products($slug) {
		
		$query = "SELECT * FROM product as p INNER JOIN users as u ON p.user_id = u.id where p.status = 1 && p.product_cat IN (select c.cat_id from categary as c where c.status=1 && c.cat_slug='$slug')";
		$rows = $this->db->query($query);
		return $rows->result();
	}

	public function view_product($slug) {
		$query = "SELECT * FROM product as p INNER JOIN users as u ON p.user_id = u.id where p.status = 1 && p.product_slug = '$slug'";
		$rows = $this->db->query($query);
		$cat_query = "SELECT cat_name, cat_slug FROM categary where cat_id IN (SELECT product_cat FROM product where status=1 && product_slug = '$slug')";
		$cat_row = $this->db->query($cat_query);
		return [$rows->result(), $cat_row->result()];
	}

	public function current_user_products($id = 0) {
		$query = "SELECT * FROM product as p INNER JOIN categary as c ON p.product_cat = c.cat_id where p.status = 1 && p.user_id = '$id'";
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
				
		}
		
		return $sorted;
	}
}

?>