<?php
class Products_model extends CI_Model {

	public function __construct(){
		$this->table = 'product';
		parent::__construct();
	}

	public function list_products($slug) {
		
		$query = "SELECT * FROM `product` where status = 1 && product_cat IN (select cat_id from `categary` where status=1 && cat_slug='$slug')";
		$rows = $this->db->query($query);
		return $rows->result();
	}
}

?>