<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("cms/banners_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_banner()
	{
        if(isset($_FILES["banner_image"]["name"]))  
        {  
            
           $upload_path = './uploads/banners/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 
            $config['upload_path'] = $upload_path;  
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $new_filename = str_replace(" ","_",$this->input->post("title"))."_".date("YmdHisU");
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config); 
            if(!$this->upload->do_upload('banner_image',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
            else  
            {  
                $data = $this->upload->data();
                $this->banners_model->title = $this->input->post("title");
                $this->banners_model->description = $this->input->post("description");
                $this->banners_model->content = $this->input->post("content");
                $this->banners_model->status = $this->input->post("status");
                $this->banners_model->banner_image = $data["file_name"];
                echo $this->banners_model->insert_banners();
            }  
        }  
		
	}

	public function edit_banner()
	{
        $banners_id = $this->input->post("id");
        if(isset($_FILES["banner_image"]["name"]))  
        {  
            
           $upload_path = './uploads/banners/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 

            $this->db->where("id",$banners_id);
            $result = $this->db->get("banners");
            unlink($upload_path.$result->row()->banner_image);
            $config['upload_path'] = $upload_path;  
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $new_filename = str_replace(" ","_",$this->input->post("title"))."_".date("YmdHisU");
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config); 
            if(!$this->upload->do_upload('banner_image',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
                
             
            $data = $this->upload->data();
            $this->banners_model->banner_image = $data["file_name"];
        }  

        $this->banners_model->title = $this->input->post("title");
        $this->banners_model->description = $this->input->post("description");
        $this->banners_model->content = $this->input->post("content");
        $this->banners_model->status = $this->input->post("status");
        $this->banners_model->id = $banners_id;
        echo $this->banners_model->update_banners();
	}

	public function delete_banner()
	{
        
        $dir = './uploads/banners/'; 
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_banners = $this->db->get("banners");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("banners");
        unlink($dir.$data_banners->row()->banner_image);
        $data = json_encode($data_banners->row());
        $this->logs->log = "Deleted User: ". $data ;
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_banner_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("banners");
        $banners = $result->row();
        $return["banners"] = $banners;
        echo json_encode($return); 
    }

    public function get_banners_list()
    {
        $this->load->model("cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.title","t1.banner_image","IF(t1.status = 1,'Enabled','Disabled') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.title","t1.banner_image","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","title","banner_image","status","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "banners AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by";  
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
                    else if($col == "banner_image")
                    {
                        $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/banners/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\")'></a>";
                    }
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
            <a href="" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="" onclick="_delete('.$aRow['id'].',\''.$aRow["title"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}
