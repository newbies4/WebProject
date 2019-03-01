<?php 

class Model_Users extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login($username = null, $password = null) 
	{
		if($username && $password) {
			$sql = "SELECT * FROM user WHERE username = ? AND password = ?";
			$query = $this->db->query($sql, array($username, $password));
			$result = $query->row_array();

			return ($query->num_rows() === 1 ? $result['id'] : false);
		}
		else {
			return false;
		}
	}

}