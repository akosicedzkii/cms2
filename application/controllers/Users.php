<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
		$this->load->model("users_model"); 
    }
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function test()
	{
		$plain_text = 'This is a plain-text message!';
		echo $ciphertext = $this->encryption->encrypt($plain_text);
		
		// Outputs: This is a plain-text message!
		echo $this->encryption->decrypt($ciphertext);
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

	}

	public function delete_user()
	{
        $this->db->where("user_id",$this->input->post("id"));
        $result = $this->db->delete("user_profile");
        if($result)
        {
            $this->db->where("id",$this->input->post("id"));
            echo $result = $this->db->delete("user_accounts");
        }
        
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
        $existing =  $this->users_model->check_username_exist("add");
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
        $this->dt_model->select_columns = array("t1.id","t1.username","t2.first_name","t2.middle_name","t2.last_name","t3.role_name");  
        $select_columns = array("id","username","first_name","middle_name","last_name","role_name");  
        $this->dt_model->table = "user_accounts as t1 inner join user_profiles as t2 on t2.user_id = t1.id  inner join roles as t3 on t3.id = t1.role_id";  
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
            
            $btns = '<a href="#" onclick="view('.$aRow['id'].')" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>
            <a href="#" onclick="edit('.$aRow['id'].')" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="delete('.$aRow['id'].')" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}
