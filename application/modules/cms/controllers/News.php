<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("cms/news_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_news()
	{
        if(isset($_FILES["cover_image"]["name"]))  
        {  
            
           $upload_path = './uploads/news/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 
            $config['upload_path'] = $upload_path;  
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $new_filename = str_replace(" ","_",$this->input->post("title"))."_".date("YmdHisU");
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config); 
            if(!$this->upload->do_upload('cover_image',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
            else  
            {  
                $data = $this->upload->data();
                $this->news_model->title = $this->input->post("title");
                $this->news_model->description = $this->input->post("description");
                $this->news_model->content = $this->input->post("content");
                $this->news_model->status = $this->input->post("status");
                $this->news_model->cover_image = $data["file_name"];
                echo $this->news_model->insert_news();
            }  
        }  
		
	}

	public function edit_news()
	{
        $news_id = $this->input->post("id");
        if(isset($_FILES["cover_image"]["name"]))  
        {  
            
           $upload_path = './uploads/news/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 

            $this->db->where("id",$news_id);
            $result = $this->db->get("news");
            unlink($upload_path.$result->row()->cover_image);
            $config['upload_path'] = $upload_path;  
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $new_filename = str_replace(" ","_",$this->input->post("title"))."_".date("YmdHisU");
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config); 
            if(!$this->upload->do_upload('cover_image',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
                
             
            $data = $this->upload->data();
            $this->news_model->cover_image = $data["file_name"];
        }  

        $this->news_model->title = $this->input->post("title");
        $this->news_model->description = $this->input->post("description");
        $this->news_model->content = $this->input->post("content");
        $this->news_model->status = $this->input->post("status");
        $this->news_model->id = $news_id;
        echo $this->news_model->update_news();
	}

	public function delete_news()
	{
        
        $dir = './uploads/news/'; 
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_news = $this->db->get("news");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("news");
        unlink($dir.$data_news->row()->cover_image);
        $data = json_encode($data_news->row());
        $this->logs->log = "Deleted User: ". $data ;
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_news_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("news");
        $news = $result->row();
        $return["news"] = $news;
        echo json_encode($return); 
    }

    public function get_news_list()
    {
        $this->load->model("cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.title","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.title","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","title","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "news AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by";  
        $this->dt_model->index_column = "t1.id";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "username" || $col == "created_by" || $col == "modified_by")
                    {
                        $row[] = $aRow[$col];
                    }
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].')" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
            <a href="#" onclick="_edit('.$aRow['id'].')" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["title"].'\')" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}