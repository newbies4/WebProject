<?php 

class Pages extends MY_Controller
{
	public function view($page = 'home')
	{
        if (!file_exists(APPPATH.'views/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view($page, $data);
        $this->load->view('templates/footer', $data);
        // if($page == 'login') {
        //     $this->isLoggedIn();
        //     $this->load->view($page, $data);
        // } 
        // else{
        //     $this->isNotLoggedIn();

        //     $this->load->view($page, $data);
        // }
	}

    public function index()
    {   
        $this->load->helper('url');
        $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');
    }

    public function login()
    {
        $this->load->view('login');
    }
    
}