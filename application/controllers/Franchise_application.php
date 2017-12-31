<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Franchise_application extends CI_Controller {

	public function index()
	{
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "GAS STATION FRANCHISE &amp; LUBRICANT DISTRIBUTORSHIP - Unioil";
		$this->load->view('template/header.php',$data);
		$this->load->view('franchise_application_view');
		$this->load->view('template/footer.php',$data);
    }
}
