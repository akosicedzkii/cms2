<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();
	}
    
    public function index()
    {
       $data["page"] = $this->router->fetch_class();
       $query = "SELECT t2.file_name as banner_image,t1.link FROM loyalty_banners as t1 LEFT JOIN media as t2 on t2.id = t1.banner_image WHERE t1.status = 1";
       $data["banners"] = $this->db->query($query)->result();
       
	   $data["loyalty_settings"] = $this->db->get("loyalty_settings")->row();
	   $data["loyalty_contents"] = $this->db->where("status","1")->get("loyalty_contents")->result();
       $this->load->view("template/header",$data);
       $this->load->view("main_view");
       $this->load->view("template/footer");
    }

   

    public $api_url = "http://13.229.0.154/cgi-bin/uni_web.cgi";
    public function api_login()
    {
        $ch = curl_init();
        //$card_number = "1100000000090097";
        $card_number = $this->input->post("card_number");
        //$birthdate = "19800814";
        $birthdate = $this->input->post("birthdate");
        $date = date("Ymd");
        $random_key = rand(1001,5000);
        $vendor_key = md5("UNI".$random_key.$date.$card_number);
        curl_setopt($ch, CURLOPT_URL,$this->api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "state=state_login&card_number=$card_number&birth_date=$birthdate&random_key=$random_key&yyyymmdd=$date&vendor_key=$vendor_key");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $array_val = json_decode($server_output,true);
        //var_dump($array_val);
        if($array_val["loyalty"]["status"]["result"] == "ok")
        {
            //var_dump($array_val["loyalty"]["data"]);
            $this->session->set_userdata($array_val["loyalty"]["data"][0]);
            $this->session->set_userdata("bday",$birthdate);
            $bday_long = substr($birthdate, 0, 4) . "-".substr($birthdate, 4, 2)."-".substr($birthdate, 6, 2);
            $this->session->set_userdata("bday_long",$bday_long);
            $this->load->model("api_login_model");
            $this->api_login_model->card_number = $card_number;
            $this->api_login_model->insert_loyalty_login();
            //var_dump($this->session->userdata);
            $this->loyalty_logs->log = "Logged in" ;
            $this->loyalty_logs->details = $card_number;
            $this->loyalty_logs->module = "loyalty_login";
            $this->loyalty_logs->created_by = $card_number;
            $this->loyalty_logs->insert_log();
            echo "true";
        }
        else
        {
            echo "false";
        }
    }

   

    public function session()
    {
        var_dump($this->session->userdata);
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url()."loyalty");
    }
}
