<?php 

/**
* 
*/
class Model_Member extends CI_Model
{
	public function create() 
	{
		$data = array(
			'first_name' => $this->input->post('fname'),
			'last_name' => $this->input->post('lname'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'email' => $this->input->post('email')
		);

		$sql = $this->db->insert('user', $data);

		if($sql === true) {
			return true; 
		} else {
			return false;
		}
	} // /create function

	public function edit($id = null) 
	{
		if($id) {
			$data = array(
				'first_name' => $this->input->post('editFname'),
				'last_name' => $this->input->post('editLname'),
				'username' => $this->input->post('editUsername'),
				'password' => $this->input->post('editPassword'),
				'email' => $this->input->post('editEmail')
			);

			$this->db->where('id', $id);
			$sql = $this->db->update('user', $data);

			if($sql === true) {
				return true; 
			} else {
				return false;
			}
		}
			
	}

	public function fetchMemberData($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM user WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM user";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function remove($id = null) {
		if($id) {
			$sql = "DELETE FROM user WHERE id = ?";
			$query = $this->db->query($sql, array($id));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
	
}