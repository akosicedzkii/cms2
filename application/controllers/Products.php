<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();  
	}
	public function fuel()
	{
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "FUEL - Unioil";
		$this->load->view('template/header.php',$data);
		$this->load->view('fuel_view');
		$this->load->view('template/footer.php',$data);
    }

    
	public function asphalt()
	{
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "ASPHALT - Unioil";
		$this->load->view('template/header.php',$data);
		$this->load->view('asphalt_view');
		$this->load->view('template/footer.php',$data);
    }

    
	public function lubricants()
	{
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "LUBRICANTS - Unioil";
		$this->load->view('template/header.php',$data);
		$this->load->view('lubricants_view');
		$this->load->view('template/footer.php',$data);
    }

}
