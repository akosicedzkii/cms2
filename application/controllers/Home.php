<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data["module_name"] = strtolower($this->router->fetch_class());
		$this->load->view('template/header.php',$data);
		$this->load->view('home_view');
		$this->load->view('template/footer.php',$data);
    }
}
