<?php
class Category_model extends CI_Model {

	public function __construct(){
		$this->table = 'categary';
		parent::__construct();
	}

	public function list_category($slug = 'all', $filter = '*') {
		$data = [
			'status' => 1
		];
		if($slug !== 'all') $data['cat_slug'] = $slug;
		$this->db->select($filter);
		$query = $this->db->get_where($this->table, $data);
		return $query->result();
	}

	public function add_category($formData) {
		return $this->db->insert($this->table, $formData);
	}

}

?>