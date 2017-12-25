<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("users_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_user()
	{
		$this->users_model->username = $this->input->post("username");
		$this->users_model->password = $this->input->post("password");
        $this->users_model->first_name = $this->input->post("first_name");
        $this->users_model->middle_name = $this->input->post("middle_name");
        $this->users_model->last_name = $this->input->post("last_name");
        $this->users_model->contact_number = $this->input->post("contact_number");
        $this->users_model->address = $this->input->post("address");
        $this->users_model->role = $this->input->post("role");
        $this->users_model->email_address = $this->input->post("email_address");
		$existing =  $this->users_model->check_username_exist("add");
		if(!$existing)
		{
			echo $this->users_model->insert_user();
		}
		else
		{
			echo "username is existing";
		}
	}

	public function edit_user()
	{
        $this->users_model->username = $this->input->post("username");
        $this->users_model->first_name = $this->input->post("first_name");
        $this->users_model->middle_name = $this->input->post("middle_name");
        $this->users_model->last_name = $this->input->post("last_name");
        $this->users_model->contact_number = $this->input->post("contact_number");
        $this->users_model->address = $this->input->post("address");
        $this->users_model->role = $this->input->post("role");
        $this->users_model->email_address = $this->input->post("email_address");
        $this->users_model->user_id = $this->input->post("user_id");
        $existing =  $this->users_model->check_username_exist("edit");
		if(!$existing)
		{
			echo $this->users_model->update_user();
		}
		else
		{
			echo "username is existing";
		}
	}

	public function delete_user()
	{
        
        $id = $this->input->post("id");
        $this->db->where("user_id",$id);
        $data_profile = $this->db->get("user_profiles");
        $this->db->where("user_id",$id);
        $result = $this->db->delete("user_profiles");
        if($result)
        {
            $this->db->where("id",$id);
            echo $result = $this->db->delete("user_accounts");
            $data = json_encode($data_profile->row());
            $this->logs->log = "Deleted User: ". $data ;
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
        }
	}

    public function get_user_data()
    {
        $id = $this->input->post("id");
        $this->db->where("user_id",$id);
        $result = $this->db->get("user_profiles");
        $user_profile = $result->row();
        $this->db->select("id,username,role_id,date_created,date_modified,created_by,modified_by");
        $this->db->where("id",$id);
        $result = $this->db->get("user_accounts");
        $user_account = $result->row();
        $return["user_profile"] = $user_profile;
        $return["user_account"] = $user_account;
        echo json_encode($return); 
    }
	public function deactivate_user()
	{

    }
    
    public function get_user_roles()
    {
        echo $this->users_model->get_user_roles($this->input->post("term"));
    }

    public function check_username_exist()
    {
        $method = $this->input->get("method");
        
        $this->users_model->username = $this->input->get("username");
        if($method == "edit")
        {
            $this->users_model->user_id = $this->input->get("user_id");
        }
        $existing =  $this->users_model->check_username_exist($method);
        if(!$existing)
        {
            header("Status: 200");
        }else{
            header("HTTP/1.0 400 Username is already used");
        }
    }

    public function get_user_list()
    {
        $this->load->model("data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.username","t2.first_name","t2.middle_name","t2.last_name","t3.role_name","t1.date_created","t4.username as created_by","t1.date_modified","t5.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.username","t2.first_name","t2.middle_name","t2.last_name","t3.role_name","t1.date_created","t4.username","t1.date_modified","t5.username");  
        $select_columns = array("id","username","first_name","middle_name","last_name","role_name","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "user_accounts AS t1 LEFT JOIN user_profiles AS t2 ON t2.user_id = t1.id  LEFT JOIN roles AS t3 ON t3.id = t1.role_id LEFT JOIN user_accounts AS t4 ON t4.id = t1.created_by LEFT JOIN user_accounts AS t5 ON t5.id = t1.modified_by";  
        $this->dt_model->index_column = "t1.id";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "username")
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
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow['username'].'\')" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}
