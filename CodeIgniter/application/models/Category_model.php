<?php
class Category_model extends CI_Model {

	public function __construct(){
		$this->table = 'categary';
		parent::__construct();
	}

	public function list_category($id = 'all') {
		$data = [
			'status' => 1
		];

		if($id !== 'all') $data['cat_id'] = $id;
		$query = $this->db->get_where($this->table, $data);
		return $query->result();
	}
}

?>