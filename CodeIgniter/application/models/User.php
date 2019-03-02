<?php
class User extends CI_Model {

	public function __construct(){
		$this->table = 'users';
		parent::__construct();
	}

	public function do_register($post) {
		if(empty($post['pwd'])) {
			return false;
		}
		$post['pwd'] = password_hash($post['pwd'], PASSWORD_DEFAULT);
		return $this->db->insert($this->table, $post);
	}

	public function do_login($post) {
		$emailOrMobile = isset($post['email']) ? 'email' : 'mobile';
		$emailOrMobileArr[$emailOrMobile] = $post[$emailOrMobile];
		$query = $this->db->select('id, pwd')->get_where($this->table, $emailOrMobileArr, 1);
		$semiUserData = $query->row();
		if($semiUserData->pwd && password_verify($post['pwd'], $semiUserData->pwd)) {
			$return = $this->get_data($semiUserData->id);
		} else {
			$return = [];
		}
		return $return;
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

	public function profile_update($data, $id) {
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return $this->get_data($id);
	}

	public function unique_check($post) {
		$isUnique = $this->db->get_where($this->table, $post)->num_rows() ? false : true;
		$criteria = $isUnique ? '' : 'This values already exists';
		return ['status'=> $isUnique, 'criteria'=> $criteria];
	}
}

?>
