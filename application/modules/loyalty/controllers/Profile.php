<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();
        if($this->session->userdata("card_number") == null)
        {
            redirect(base_url()."loyalty");
        }  
	}
    
    public $api_url = "http://13.229.0.154/cgi-bin/uni_web.cgi";

    public function index()
    {
        $data["page"] = $this->router->fetch_class();
        
        $data["loyalty_settings"] = $this->db->get("loyalty_settings")->row();
        $data["checked"] = $this->db->where("card_number",$this->session->userdata("card_number"))->get("loyalty_record")->row();
        $this->load->view("template/header",$data);
        $this->load->view("profile_view");
        $this->load->view("template/footer");
    }

    public function update_terms()
    {
        $card_number = $this->session->userdata("card_number");
        if($card_number != null )
        {
            $data["is_first_time"] = 1;
            $this->db->where("card_number",$card_number);
            echo $this->db->update("loyalty_record",$data);
        }
    }
    public function api_validate()
    {
        $ch = curl_init();
        //$card_number = "1100000000090097";
        $card_number = $this->session->userdata("card_number");
        //$birthdate = "19800814";
        $birthdate = $this->session->userdata("bday");
        $mobile = $this->session->userdata("mobile");
        $date = date("Ymd");
        $random_key = rand(1001,5000);
        $vendor_key = md5("UNI".$random_key.$date.$card_number);
        curl_setopt($ch, CURLOPT_URL,$this->api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "mobile=$mobile&state=state_validate&card_number=$card_number&birth_date=$birthdate&random_key=$random_key&yyyymmdd=$date&vendor_key=$vendor_key");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $array_val = json_decode($server_output,true);
        //var_dump($array_val);
        if($array_val["loyalty"]["status"]["result"] == "ok")
        {
             echo json_encode($array_val["loyalty"]["data"]);
        }
        else
        {
            echo "Failed";
        }
    }

    public function api_retrieve_info()
    {
        $ch = curl_init();
        //$card_number = "1100000000090097";
        $card_number = $this->session->userdata("card_number");
        //$birthdate = "19800814";
        $birthdate = $this->session->userdata("bday");
        $date = date("Ymd");
        $random_key = rand(1001,5000);
        $vendor_key = md5("UNI".$random_key.$date.$card_number);
        curl_setopt($ch, CURLOPT_URL,$this->api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "state=state_retrieve_info&card_number=$card_number&birth_date=$birthdate&random_key=$random_key&yyyymmdd=$date&vendor_key=$vendor_key");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $array_val = json_decode($server_output,true);
        echo json_encode($array_val["loyalty"]);
    }


    public function api_transaction()
    {
        $ch = curl_init();
        //$card_number = "1100000000090097";
        $card_number = $this->session->userdata("card_number");
        //$birthdate = "19800814";
        $startdate = $this->input->get("startdate");
        $enddate = $this->input->get("enddate");
        $date = date("Ymd");
        $random_key = rand(1001,5000);
        $vendor_key = md5("UNI".$random_key.$date.$card_number);
        curl_setopt($ch, CURLOPT_URL,$this->api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "state=state_trans_history&start_date=$startdate&end_date=$enddate&card_number=$card_number&random_key=$random_key&yyyymmdd=$date&vendor_key=$vendor_key");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $array_val = json_decode($server_output,true);
        var_dump($array_val);
        if($array_val["loyalty"]["status"]["rows"] == "ok")
        {
             if($array_val["loyalty"]["status"]["sql"] == "no records")
             {
                echo "No Records";
             }
             else
             {

             }
        }
        else
        {
            echo "Failed";
        }
    }
    public function image_upload()
    {
        $upload_path = './uploads/card_profile_images/'; 
        $this->db->where("card_number",$this->session->userdata("card_number"));
        $result = $this->db->get("loyalty_record")->row();
        if($result->image != null)
        {
            if(file_exists ( $upload_path.$result->image ))
            {
                unlink($upload_path.$result->image);
            }
        }
        if(isset($_FILES["my-files"]["name"]))  
        {  
            
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 
            $config['upload_path'] = $upload_path;  
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $new_filename = $this->session->userdata("card_number");
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config); 
            if(!$this->upload->do_upload('my-files',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
            else  
            {  
                $data = $this->upload->data();
                
                $data_image["image"] = $data["file_name"]; 
                $this->db->where("card_number",$this->session->userdata("card_number"));
                $this->db->update("loyalty_record",$data_image);
            }  
        }else{
            echo "Error". $upload_path . $data["file_name"];
            die();
        } 
    }
}
