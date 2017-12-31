<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_and_updates extends CI_Controller {

	public function index()
	{
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "NEWS &amp; UPDATES - Unioil";
		$this->load->view('template/header.php',$data);
		$this->load->view('news_and_updates_view');
		$this->load->view('template/footer.php',$data);
    }
}
