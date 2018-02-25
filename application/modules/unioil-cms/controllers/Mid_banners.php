<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mid_banners extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("unioil-cms/mid_banners_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_mid_banner()
	{
        $this->mid_banners_model->banner_image = $this->input->post("banner_image");
        $this->mid_banners_model->title = $this->input->post("title");
        $this->mid_banners_model->description = $this->input->post("description");
        $this->mid_banners_model->link = $this->input->post("link");
        $this->mid_banners_model->status = $this->input->post("status");
        echo $this->mid_banners_model->insert_mid_banners();
	} 

	public function edit_mid_banner()
	{
        $banners_id = $this->input->post("id");
        $this->mid_banners_model->banner_image = $this->input->post("banner_image");
        $this->mid_banners_model->title = $this->input->post("title");
        $this->mid_banners_model->description = $this->input->post("description");
        $this->mid_banners_model->link = $this->input->post("link");
        $this->mid_banners_model->status = $this->input->post("status");
        $this->mid_banners_model->id = $banners_id;
        echo $this->mid_banners_model->update_mid_banners();
	}

	public function delete_mid_banner()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        
        $this->db->select("id,title,description,banner_image,link,created_by,date_created,date_modified,modified_by,content,status");
         $data_banners = $this->db->get("mid_banners");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("mid_banners");
        $data = json_encode($data_banners->row());
        $this->logs->log = "Deleted Mid Banner: ". $id ;
        $this->logs->details = $data ;
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_banner_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("mid_banners");
        $banners = $result->row();
        if($banners->banner_image != null)
        {
            if(is_numeric( $banners->banner_image ))
            {
                $banners->banner_image_id = $banners->banner_image;
                $banners->banner_image = $this->db->where("id",$banners->banner_image)->get("media")->row()->file_name;
            }
        }
        $return["mid_banners"] = $banners;
        echo json_encode($return); 
    }

    public function get_mid_banners_list()
    {
        $this->load->model("unioil-cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.title","t4.file_name as banner_image","t1.link","IF(t1.status = 1,'Enabled','Disabled') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.title","t4.file_name","t1.link","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","title","banner_image","link","status","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "mid_banners AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by LEFT JOIN media as t4 on t4.id = t1.banner_image";  
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
                        if($aRow[$col] != null || $aRow[$col] != "")
                        {  
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/mid_banners/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\")'></a>";
                        }
                        else
                        {
                            $row[] = "None";
                        }
                     }else if($col == "link")
                     {
                         if($aRow[$col] != null || $aRow[$col] != "")
                         {  
                             $row[] = "<a href=\"$aRow[$col]\"  target='_blank'>Click to visit</a>";
                         }
                         else
                         {
                             $row[] = "None";
                         }
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
