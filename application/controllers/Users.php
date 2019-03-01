<?php 

class Users extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// loading the users model
		$this->load->model('model_users');

		// loading the form validation library
		$this->load->library('form_validation');		

	}

	public function login()
	{

		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {			
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$login = $this->model_users->login($username, $password);

			if($login) {
				//$this->load->library('session');

				$user_data = array(
					'id' => $login,
					'logged_in' => true
				);

				$this->session->set_userdata($user_data);

				$validator['success'] = true;
				$validator['messages'] = "home";		
			}	
			else {

				$validator['success'] = false;
				$validator['messages'] = "Aunthentication failed.";
			} // /else

		} 	
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}			
		} // /else

		echo json_encode($validator);
	} // /lgoin function

	public function logout()
	{
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}

}