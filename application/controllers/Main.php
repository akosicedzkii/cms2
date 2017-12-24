<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
        parent::__construct();
		$this->settings_model->get_settings();    
		if($this->session->userdata("USERID") == null)
        {   
            $this->load->view('login');
        }
    }

	public function index()
	{
		$this->load->view('main/template/header');
		$this->load->view('main/main_view');
		$this->load->view('main/template/footer');
    }

    public function users()
    {
		$module["module_name"] = $this->router->fetch_method();
		$this->load->view('main/template/header');
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}
}
