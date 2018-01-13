<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Careers extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();  
		$this->v_counter->insert_visitor();   
	}
	public function index()
	{
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "CAREERS - Unioil";
		$data["jobs"] =$this->db->order_by("id","desc")->get("careers")->result();
		$this->load->view('template/header.php',$data);
		$this->load->view('careers_view');
		$this->load->view('template/footer.php',$data);
	}
	

	public function get_career_details()
	{
		$id = $this->input->post("id");
		$result =$this->db->select("job_description,job_title,id")->where("id",$id)->order_by("id","desc")->get("careers")->row();
		echo json_encode($result);
	}
}
