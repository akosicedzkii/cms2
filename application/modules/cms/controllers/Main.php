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
	private $default_page;
    public function __construct()
    {
        parent::__construct();
		$this->settings_model->get_settings();    
        $this->load->model("cms/users_model"); 
		if($this->session->userdata("USERID") == null)
        {   
            redirect(base_url()."cms/login");
		}
		$this->user_access = $this->settings_model->get_user_access();
		$this->default_page = $this->settings_model->get_role_default_page();
    }

	public function index()
	{
		
		redirect(base_url()."cms/main/".$this->default_page);
    }
	public function dashboard()
	{
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->db->distinct();
		$this->db->select("ip_address");
		$module["unique_visitors"] = $this->db->get("visit_counts")->num_rows();
		$module["products"] = $this->db->get("products")->result();

		$this->db->order_by("user_accounts.id","desc");
		$this->db->select('*');
		$this->db->from('user_accounts');
		$this->db->join('user_profiles', 'user_profiles.user_id = user_accounts.id');
		$module["users"]= $this->db->get()->result();

		$module["month_visitors"] = $this->db->where("month(date_created)",date("m"))->where("year(date_created)",date("Y"))->get("visit_counts")->num_rows();
		
		$module["stations"] = $this->db->order_by("id","desc")->get("stations")->num_rows();
		
		$module["submissions_counter"] = $this->db->get("submissions_counter")->row();

		$module["today_visitors"] = $this->db->where("day(date_created)",date("d"))->where("month(date_created)",date("m"))->where("year(date_created)",date("Y"))->get("visit_counts")->num_rows();
		
		$module["all_visitors"] = $this->db->get("visit_counts")->num_rows();
		
		$this->load->view('main/template/header',$module);
		$this->load->view('main/main_view',$module);
		$this->load->view('main/template/footer');
	}
    public function users()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$module["roles"] = $this->db->get("roles")->result();
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

	public function roles()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/roles_view',$module);
		$this->load->view('main/template/footer');
	}

	public function banners()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/banners_view',$module);
		$this->load->view('main/template/footer');
	}

	public function mid_banners()
    {
		if (!in_array("banners", $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/mid_banners_view',$module);
		$this->load->view('main/template/footer');
	}

	public function fuels()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/users_view',$module);
		$this->load->view('main/template/footer');
	}

	public function station_location()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$module["branches"] = $this->db->get("branches")->result();
		$query = "SELECT * from products where product_category_id = 1 AND (visibility = 'price_only' OR visibility = 'price_and_promotion')";
		$module["fuel_list"] = $this->db->query($query)->result();
		$this->load->view('main/template/header',$module);
		$this->load->view('main/stations_view',$module);
		$this->load->view('main/template/footer');
	}

	public function branches()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$module["branches"] = $this->db->order_by("branch_name","ASC")->get("branches")->result();
		$this->load->view('main/template/header',$module);
		$this->load->view('main/branches_view',$module);
		$this->load->view('main/template/footer');
	}

	public function news()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/news_view',$module);
		$this->load->view('main/template/footer');
	}

	public function updates()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
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
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$module["site_settings"] = $this->db->get("site_settings")->row();
		$this->load->view('main/template/header',$module);
		$this->load->view('main/site_settings_view',$module);
		$this->load->view('main/template/footer');
	}


	public function products()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
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
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/product_categories_view',$module);
		$this->load->view('main/template/footer');
	}

	public function product_vendors()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/product_vendors_view',$module);
		$this->load->view('main/template/footer');
	}

	public function product_series()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["product_categories"] = $this->db->order_by("category_name","ASC")->get("product_categories")->result();
		$module["product_vendors"] = $this->db->order_by("vendor_name","ASC")->get("product_vendors")->result();
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/product_series_view',$module);
		$this->load->view('main/template/footer');
	}



	public function careers()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/careers_view',$module);
		$this->load->view('main/template/footer');
	}

	public function achievements()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/achievements_view',$module);
		$this->load->view('main/template/footer');
	}
	public function opportunities()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$module["site_settings"] = $this->db->get("site_settings")->row();
		$this->load->view('main/template/header',$module);
		$this->load->view('main/opportunities_view',$module);
		$this->load->view('main/template/footer');
	}
	public function loyalty()
    {
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."cms/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->load->view('main/template/header',$module);
		$this->load->view('main/loyalty_view',$module);
		$this->load->view('main/template/footer');
	}

	public function get_profile_data()
    {
        $this->db->where("user_id",$this->session->userdata("USERID"));
        $result = $this->db->get("user_profiles");
        $user_profile = $result->row();
        $this->db->select("id,username,role_id,date_created,date_modified,created_by,modified_by");
        $this->db->where("id",$this->session->userdata("USERID"));
        $result = $this->db->get("user_accounts");
        $user_account = $result->row();
        $return["user_profile"] = $user_profile;
        $return["user_account"] = $user_account;
        echo json_encode($return); 
    }
    
    public function update_profile()
	{   
		$upload_path = './uploads/profile_image/'; 
        if(isset($_FILES["profile_image"]["name"]))  
        {  
            
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 

            $this->db->where("id",$this->session->userdata("USERID"));
			$result = $this->db->get("user_profiles");
			if($result->row()->profile_image != null)
			{
				if($result->row()->profile_image != "default_dp.png")
				{
					unlink($upload_path.$result->row()->profile_image);
				}
			}
            $config['upload_path'] = $upload_path;  
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $new_filename = str_replace(" ","_","profile_".$this->input->post("username"))."_".date("YmdHisU");
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config); 
            if(!$this->upload->do_upload('profile_image',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
                
             
            $data = $this->upload->data();
            $this->users_model->profile_image = $data["file_name"];
		}
        $this->users_model->username = $this->input->post("username");
        $this->users_model->first_name = $this->input->post("first_name");
        $this->users_model->middle_name = $this->input->post("middle_name");
        $this->users_model->last_name = $this->input->post("last_name");
        $this->users_model->contact_number = $this->input->post("contact_number");
        $this->users_model->address = $this->input->post("address");
        $this->users_model->password = $this->input->post("password");
        $this->users_model->old_password = $this->input->post("old_password");
        $this->users_model->email_address = $this->input->post("email_address");
        $this->users_model->user_id = $this->session->userdata("USERID");
        $this->users_model->birthday = $this->input->post("birthday");
		echo $this->users_model->update_profile();
	}
	
	public function visitor_map()
	{
		$filter = $this->input->get("filter");
		$return = "";
		if($filter == "all")
		{
			$return = $this->db->get("visit_counts")->result();
		
		}
		else if($filter == "this_month")
		{
			$return = $this->db->where("month(date_created)",date("m"))->where("year(date_created)",date("Y"))->get("visit_counts")->result();
		}
		else
		{
			$return = $this->db->where("day(date_created)",date("d"))->where("month(date_created)",date("m"))->where("year(date_created)",date("Y"))->get("visit_counts")->result();
		}
		$result ="";
		if($return != null)
		{
			foreach($return as $row)
			{	
					$location = str_replace(", , ","",$row->city.", ".$row->region.", ".$row->country);
					$result .= '{"zoomLevel": 5,"scale": 0.5,"title": "'.$location.'","latitude": '.$row->lat.',"longitude": '.$row->long.'},';
			}
			$result = rtrim($result,",");
		}
		print_r($result);
	}

	public function test()
	{
		$query = "SELECT country,count(*) FROM visit_counts GROUP BY country";
		$result = $this->db->query($query)->result();
		var_dump($result);
	}
}
