<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_and_updates extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings(); 
		$this->v_counter->insert_visitor();    
	}
	
	public function index()
	{
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "NEWS &amp; UPDATES - Unioil";
		$this->db->where("status","1");
		$this->db->order_by("date_created","DESC");
		$result = $this->db->get("news_and_updates");
		
		$data["news_and_updates"] = $result->result();
		$this->load->view('template/header.php',$data);
		$this->load->view('news_and_updates_view',$data);
		$this->load->view('template/footer.php',$data);
	}

	public function get_news_and_updates_details()
	{
		$id = $this->input->post("id");
		$this->db->where("id",$id);
		$result = $this->db->get("news_and_updates");
		$return["return"] = $result->row();
		echo json_encode($return);
	}
	
	public function get_news_and_updates_details_next_prev()
	{
		$id = $this->input->post("id");
		$this->db->where("id",$id);
		$result = $this->db->get("news_and_updates");
		$return["return"] = $result->row();
		echo json_encode($return);
	}

}
