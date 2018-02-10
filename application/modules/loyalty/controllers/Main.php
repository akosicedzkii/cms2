<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->settings_model->get_settings();  
	}
    
    public function index()
    {
       $data["page"] = $this->router->fetch_class();
       $query = "SELECT t2.file_name as banner_image,t1.link FROM loyalty_banners as t1 LEFT JOIN media as t2 on t2.id = t1.banner_image WHERE t1.status = 1";
       $data["banners"] = $this->db->query($query)->result();
       
	   $data["loyalty_settings"] = $this->db->get("loyalty_settings")->row();
       $this->load->view("template/header",$data);
       $this->load->view("main_view");
       $this->load->view("template/footer");
    }
}
