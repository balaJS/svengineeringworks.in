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
}

?>