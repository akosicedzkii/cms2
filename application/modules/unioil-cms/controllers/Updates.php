<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Updates extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("unioil-cms/updates_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_updates()
	{
        $this->updates_model->title = $this->input->post("title");
        $this->updates_model->description = $this->input->post("description");
        $this->updates_model->content = $this->input->post("content");
        $this->updates_model->status = $this->input->post("status");
        $this->updates_model->cover_image = $this->input->post("cover_image");
        echo $this->updates_model->insert_updates();
	}

	public function edit_updates()
	{
        $updates_id = $this->input->post("id");
        $this->updates_model->cover_image = $this->input->post("cover_image");
        $this->updates_model->title = $this->input->post("title");
        $this->updates_model->description = $this->input->post("description");
        $this->updates_model->content = $this->input->post("content");
        $this->updates_model->status = $this->input->post("status");
        $this->updates_model->id = $updates_id;
        echo $this->updates_model->update_updates();
	}

	public function delete_updates()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        
        $data_updates = $this->db->get("news_and_updates");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("news_and_updates");
        $data = json_encode($data_updates->row());
        $this->logs->log = "Deleted Updates - ID:". $data_updates->row()->id .", Updates Title: ".$data_updates->row()->title ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "updates";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_updates_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("news_and_updates");
        $updates = $result->row();
        if($updates->cover_image != null)
        {
            if(is_numeric( $updates->cover_image ))
            {
                $updates->cover_image_id = $updates->cover_image;
                $updates->cover_image = $this->db->where("id",$updates->cover_image)->get("media")->row()->file_name;
            }
        }
        $return["updates"] = $updates;
        echo json_encode($return); 
    }

    public function get_updates_list()
    {
        $this->load->model("unioil-cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.title","t4.file_name as cover_image","IF(t1.status=1,'Enabled','Disabled') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.title","t4.file_name","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","title","cover_image","status","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "news_and_updates AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by LEFT JOIN media as t4 on t4.id = t1.cover_image";  
        $this->dt_model->index_column = "t1.id";
        $this->dt_model->staticWhere = "t1.content_type = 'updates'";
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
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {    
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/updates/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a>";
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
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["title"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}
