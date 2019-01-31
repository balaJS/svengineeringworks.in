<?php
class User extends CI_Model {

	public function __construct(){
		$this->table = 'users';
		parent::__construct();
	}

	public function do_register($post) {
		$data = [
			'uname' => $post['uname'],
			'email' => $post['email'],
			'pwd' => $post['pwd'],
		];
		return $this->db->insert($this->table, $data);
	}

	public function do_login($post) {
		$data = [
			'email' => $post['email'],
			'pwd' => $post['pwd'],
		];
		$query = $this->db->get_where($this->table, $data, 1);
		return $query->row();
	}

	public function get_data($id) {
		$data = ['id' => $id];
		$query = $this->db->get_where($this->table, $data, 1);
		return $query->row();
	}

	public function get_all_addr($ids) {
		$query = "select * from $this->table where id IN ($ids)";
		$rows = $this->db->query($query);
		return $rows->result();
	}
}

?>