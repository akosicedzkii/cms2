<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_settings extends CI_Controller {
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

    public function update_settings()
    {
        if(isset($_FILES["site_logo"]["name"]))  
        {
            $upload_path = './uploads/site_logo/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 

            $result = $this->db->get("site_settings");
            unlink($upload_path.$result->row()->site_logo);
            $config['upload_path'] = $upload_path;  
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $new_filename = "site_logo";
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config); 
            if(!$this->upload->do_upload('site_logo',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
            $data_upload = $this->upload->data();
           
            $data["site_logo"] = $data_upload["file_name"];
        }
        $data["site_name"] = $this->input->post("site_name");
        $data["company_address"] = $this->input->post("company_address");
        $data["contact_number"] = $this->input->post("contact_number");
        $data["fax_number"] = $this->input->post("fax_number");
        $data["contact_us_email_address"] = $this->input->post("contact_us_email_address");
        $data["franchise_email_address"] = $this->input->post("franchise_email_address");
        $data["careers_email_address"] = $this->input->post("careers_email_address");
        $data["facebook_url"] = $this->input->post("facebook_url");
        $data["twitter_url"] = $this->input->post("twitter_url");
        $data["instagram_url"] = $this->input->post("instagram_url");
        echo $this->db->update("site_settings",$data);
        $this->logs->log = "Updated Site Settings";
        $this->logs->details = json_encode($data);
        $this->logs->module = "site_settings";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
    }
}
