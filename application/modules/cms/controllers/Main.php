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
            redirect(base_url()."cms/login");
		}
		$this->user_access = $this->settings_model->get_user_access();
    }

	public function index()
	{
		/*if (in_array("branches", $menu)) 
		{

		}*/
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

	public function banners()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/banners_view',$module);
		$this->load->view('main/template/footer');
	}

	public function fuels()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

	public function station_location()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$module["branches"] = $this->db->get("branches")->result();
		$module["fuel_list"] = $this->db->get("fuels")->result();
		$this->load->view('main/template/header',$module);
		$this->load->view('main/stations_view',$module);
		$this->load->view('main/template/footer');
	}

	public function branches()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$module["branches"] = $this->db->order_by("branch_name","ASC")->get("branches")->result();
		$this->load->view('main/template/header',$module);
		$this->load->view('main/branches_view',$module);
		$this->load->view('main/template/footer');
	}

	public function news()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/news_view',$module);
		$this->load->view('main/template/footer');
	}

	public function updates()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/updates_view',$module);
		$this->load->view('main/template/footer');
	}
	public function logs()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/logs_view',$module);
		$this->load->view('main/template/footer');
	}

	
	public function site_settings()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$module["site_settings"] = $this->db->get("site_settings")->row();
		$this->load->view('main/template/header',$module);
		$this->load->view('main/site_settings_view',$module);
		$this->load->view('main/template/footer');
	}


	public function products()
    {
		$module["product_categories"] = $this->db->order_by("category_name","ASC")->get("product_categories")->result();
		$module["product_vendors"] = $this->db->order_by("vendor_name","ASC")->get("product_vendors")->result();
		$module["product_series"] = $this->db->order_by("series_name","ASC")->get("product_series")->result();
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/products_view',$module);
		$this->load->view('main/template/footer');
	}

	public function product_categories()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/product_categories_view',$module);
		$this->load->view('main/template/footer');
	}

	public function product_vendors()
    {
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/product_vendors_view',$module);
		$this->load->view('main/template/footer');
	}

	public function product_series()
    {
		$module["product_categories"] = $this->db->order_by("category_name","ASC")->get("product_categories")->result();
		$module["product_vendors"] = $this->db->order_by("vendor_name","ASC")->get("product_vendors")->result();
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/product_series_view',$module);
		$this->load->view('main/template/footer');
	}
}
