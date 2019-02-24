<?php
class Category_model extends CI_Model {

	public function __construct(){
		$this->table = 'categary';
		parent::__construct();
	}

	public function list_category($slug = 'all', $filter = '*') {
		$this->load->model('Products_model');

		$data = ['status' => 1];

		if($slug !== 'all') $data['cat_slug'] = $slug;
		
		$this->db->select($filter);
		$query = $this->db->get_where($this->table, $data);
		$catRows = $query->result();
		$i = 0;

		foreach($catRows as $row) {
			$catRows[$i++]->hadProducts = $this->Products_model->list_products($row->cat_slug, 1);
		}

		return $catRows;
	}

	public function add_category($formData) {
		return $this->db->insert($this->table, $formData);
	}

	public function auto_complete($search_term) {
		return $this->db->select('cat_name, cat_slug')->from($this->table)->where("cat_name like '%$search_term%'")->get();
	}

}

?>
