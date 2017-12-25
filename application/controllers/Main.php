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
	private $user_access;
    public function __construct()
    {
        parent::__construct();
		$this->settings_model->get_settings();    
		if($this->session->userdata("USERID") == null)
        {   
            redirect(base_url()."login");
		}
		$this->user_access = $this->settings_model->get_user_access();
    }

	public function index()
	{
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/main_view',$module);
		$this->load->view('main/template/footer');
    }

    public function users()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$module["roles"] = $this->db->get("roles")->result();
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

	public function roles()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/roles_view',$module);
		$this->load->view('main/template/footer');
	}

	public function site_settings()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

	public function banners()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

	public function fuel_prices()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

	public function store_location()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

	public function news()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

	public function updates()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

	public function products()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

	public function logs()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

}
