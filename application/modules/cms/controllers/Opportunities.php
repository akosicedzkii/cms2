<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunities extends CI_Controller {
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

    public function update_opportunities_settings()
    {
        if(isset($_FILES["franchise_video"]["name"]))  
        {
            $upload_path = './uploads/franchise_video/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 

            $result = $this->db->get("site_settings");
            $ext = pathinfo($_FILES["franchise_video"]["name"], PATHINFO_EXTENSION); 
            $allowed =  array('mp4','flv','ogg','3gp','webm');
            if(!in_array($ext,$allowed) ) 
            {
                echo 'Invalid Video type';
                die();
            }
            if(file_exists ( $upload_path.$result->row()->franchise_video ))
            {
                unlink($upload_path.$result->row()->franchise_video);
            }
            $config['upload_path'] = $upload_path;  
            $config['allowed_types'] = 'mp4|flv|ogg|3gp|webm';  
            $new_filename = "franchise_video";
            $config['file_name'] = $new_filename ;
            $this->load->library('upload', $config); 
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('franchise_video',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
            $data_upload = $this->upload->data();
           
            $data["franchise_video"] = $data_upload["file_name"];
        }
        if(isset($_FILES["franchise_video_poster"]["name"]))  
        {
            unset($config);
            $upload_path = './uploads/franchise_video/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 

            $result = $this->db->get("site_settings");
            $ext = pathinfo($_FILES["franchise_video_poster"]["name"], PATHINFO_EXTENSION); 
            $allowed =  array('png','jpg');
            if(!in_array($ext,$allowed) ) 
            {
                echo 'Invalid Poster Image type';
                die();
            }
            if(file_exists ( $upload_path.$result->row()->franchise_video_poster ))
            {
                unlink($upload_path.$result->row()->franchise_video_poster);
            }
            $config_poster['upload_path'] = $upload_path;  
            $config_poster['allowed_types'] = 'png|jpg';  
            $new_filename = "franchise_video_poster";
            $config_poster['file_name'] = $new_filename ;
            $this->load->library('upload', $config_poster); 
            $this->upload->initialize($config_poster);
            if(!$this->upload->do_upload('franchise_video_poster',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
            $data_upload = $this->upload->data();
           
            $data["franchise_video_poster"] = $data_upload["file_name"];
        }

        $data["franchise_email_address"] = $this->input->post("franchise_email_address");
        $data["careers_email_address"] = $this->input->post("careers_email_address");
        $data["franchise_body_reply"] =$this->input->post("franchise_body_reply");
        $data["careers_body_reply"] = $this->input->post("careers_body_reply");
        $data["franchise_subject_reply"] = $this->input->post("franchise_subject_reply");
        $data["careers_subject_reply"] = $this->input->post("careers_subject_reply");

        echo $this->db->update("site_settings",$data);
        $this->logs->log = "Updated Opportunities Settings";
        $this->logs->details = json_encode($data);
        $this->logs->module = "opportunities";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
    }
}
