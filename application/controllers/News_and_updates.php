<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_and_updates extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings(); 
	}
	
	public function index()
	{
		$this->v_counter->insert_visitor();    
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "NEWS &amp; UPDATES - Unioil";
		$query = "SELECT t1.description,t1.title,t2.file_name as cover_image,t1.date_created,t1.content_type,t1.id FROM news_and_updates as t1 LEFT JOIN media as t2 on t2.id = t1.cover_image WHERE status = 1 ORDER BY t1.date_created DESC";
		$result = $this->db->query($query);
		
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
		$prev = $this->db->query("select id,content_type from news_and_updates where id = (select min(id) from news_and_updates where id > $id)")->row();
		if($prev == null)
		{
			$prev = "none";
		}
		else
		{
			$prev = "get_more_details_prev_next(".$prev->id.",'$prev->content_type');return false;";
		}

		$next = $this->db->query("select id,content_type from news_and_updates where id = (select max(id) from news_and_updates where id < $id)")->row();
		if($next == null)
		{
			$next = "none";
		}
		else
		{
			$next = "get_more_details_prev_next(".$next->id.",'$next->content_type');return false;";
		}

		$return["buttons"] = array("prev" => $prev,"next" => $next); 
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
