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
       $this->load->view("template/header",$data);
       $this->load->view("main_view");
       $this->load->view("template/footer");
    }
}
