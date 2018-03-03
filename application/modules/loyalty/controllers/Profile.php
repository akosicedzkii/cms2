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
                    "state=state_retrieve_info&card_number=$card_number&random_key=$random_key&yyyymmdd=$date&vendor_key=$vendor_key");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $array_val = json_decode(str_replace("&","n",$server_output),true);
        echo json_encode($array_val["loyalty"]);
    }


    public function api_transaction()
    {
        $ch = curl_init();
        //$card_number = "1100000000090097";
        $card_number = $this->session->userdata("card_number");
        //$birthdate = "19800814";
        $startdate = str_replace("-","",$this->input->post("startdate"));
        $enddate = str_replace("-","",$this->input->post("enddate"));
        $date = date("Ymd");
        $random_key = rand(1001,5000);
        $vendor_key = md5("UNI".$random_key.$date.$card_number);
        curl_setopt($ch, CURLOPT_URL,$this->api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        $fields =  "state=state_trans_history&start_date=$startdate&end_date=$enddate&card_number=$card_number&random_key=$random_key&yyyymmdd=$date&vendor_key=$vendor_key";
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $array_val = json_decode(str_replace("SR#","sr_number",$server_output),true);
        //var_dump($array_val);
        if($array_val["loyalty"]["status"]["result"] == "ok")
        {
             if($array_val["loyalty"]["status"]["sql"] == "no records")
             {
                echo "<tr><td colspan=6>No Records</td>";
             }
             else
             {
                 $tbl = "";
                foreach($array_val["loyalty"]["data"] as $row)
                {
                    $tbl = '<tr>
                    <t>'.$row["store"].'</th>
                    <th>'.$row["date"]." ".$row["time"].'</th>
                    <th>'.$row["sr_number"].'</th>
                    <th>'.$row["Description"].'</th>
                    <th>'.$row["amount"].'</th>
                    <th>'.$row["total_points"].'</th>
                    </tr>';

                    $tbl .=$tbl;
                }
                echo $tbl;
             }
        }
        else
        {
            echo "Failed";
        }
    }
    /*address=street address text, required
    mobile=11 digit mobile in 09xxxxxxxxx format
    email=email text
    civil_status_code=refer to Civil Status, required
    gender_code=refer to Gender, required
    occupation_code=refer to Educational Attainment, required
    is_petron = optional (1-yes, 0-no)
    is_phoenix = optional (1-yes,0-no)
    is_shell = optional (1-yes, 0-no)
    is_flyingv = optional (1-yes, 0-no)
    is_caltex = optional (1-yes, 0-no)
    is_ptt = optional (1-yes, 0-no)
    is_total = optional (1-yes, 0-no)
    is_jetti = optional (1-yes, 0-no)
    is_seaoil = optional (1-yes, 0-no)
    is_sm = optional (1-yes, 0-no)
    is_robinson= optional (1-yes, 0-no)
    is_cebupacific= optional (1-yes, 0-no)
    is_petronv= optional (1-yes, 0-no)
    is_bdo= optional (1-yes, 0-no)
    is_mabuhay= optional (1-yes, 0-no)
    is_starbucks= optional (1-yes, 0-no)
    is_s&r= optional (1-yes, 0-no)
    is_national= optional (1-yes, 0-no)
    is_happy= optional (1-yes, 0-no)
    is_mercury= optional (1-yes, 0-no)*/
    public function api_update_info()
    {
        $ch = curl_init();
        //$card_number = "1100000000090097";
        $card_number = $this->session->userdata("card_number");
        //$birthdate = "19800814";
        $birthdate = $this->session->userdata("bday");
        $date = date("Ymd");
        $random_key = rand(1001,5000);
        $vendor_key = md5("UNI".$random_key.$date.$card_number);

        $address = $this->input->post("address");//street address text, required
        $mobile= $this->input->post("mobile");//11 digit mobile in 09xxxxxxxxx format
        $email= $this->input->post("email");//email text
        $civil_status_code= $this->input->post("civil_status_code");//refer to Civil Status, required
        $gender_code= $this->input->post("gender_code");//refer to Gender, required
        $occupation_code= $this->input->post("occupation_code");//refer to Educational Attainment, required
        $is_petron =  $this->input->post("is_petron") ? 1 : 0;//optional (1-yes, 0-no)
        $is_phoenix =  $this->input->post("is_phoenix") ? 1 : 0;//optional (1-yes,0-no)
        $is_shell =  $this->input->post("is_shell") ? 1 : 0;//optional (1-yes, 0-no)
        $is_flyingv =  $this->input->post("is_flyingv") ? 1 : 0;//optional (1-yes, 0-no)
        $is_caltex =  $this->input->post("is_caltex") ? 1 : 0;//optional (1-yes, 0-no)
        $is_ptt =  $this->input->post("is_ptt") ? 1 : 0;//optional (1-yes, 0-no)
        $is_total =  $this->input->post("is_total") ? 1 : 0;//optional (1-yes, 0-no)
        $is_jetti =  $this->input->post("is_jetti") ? 1 : 0;//optional (1-yes, 0-no)
        $is_seaoil =  $this->input->post("is_seaoil") ? 1 : 0;//optional (1-yes, 0-no)
        $is_sm =  $this->input->post("is_sm") ? 1 : 0;//optional (1-yes, 0-no)
        $is_robinson=  $this->input->post("is_robinson") ? 1 : 0;//optional (1-yes, 0-no)
        $is_cebupacific=  $this->input->post("is_cebupacific") ? 1 : 0;//optional (1-yes, 0-no)
        $is_petronv=  $this->input->post("is_petronv") ? 1 : 0;//optional (1-yes, 0-no)
        $is_bdo=  $this->input->post("is_bdo") ? 1 : 0;//optional (1-yes, 0-no)
        $is_mabuhay=  $this->input->post("is_mabuhay") ? 1 : 0;//optional (1-yes, 0-no)
        $is_starbucks=  $this->input->post("is_starbucks") ? 1 : 0;//optional (1-yes, 0-no)
        $is_snr=  $this->input->post("is_snr") ? 1 : 0;//optional (1-yes, 0-no)
        $is_national=  $this->input->post("is_national") ? 1 : 0;//optional (1-yes, 0-no)
        $is_happy=  $this->input->post("is_happy") ? 1 : 0;//optional (1-yes, 0-no)
        $is_mercury=  $this->input->post("is_mercury") ? 1 : 0;//optional (1-yes, 0-no)
        $number_cars=  $this->input->post("number_cars");//optional (1-yes, 0-no)
        $other_details = "&number_cars=$number_cars&address=$address&mobile=$mobile&email=$email&civil_status_code=$civil_status_code&gender_code=$gender_code&occupation_code=$occupation_code&is_petron=$is_petron&is_phoenix=$is_phoenix&is_shell=$is_shell&is_flyingv=$is_flyingv&is_caltex=$is_caltex&is_ptt=$is_ptt&is_total=$is_total&is_jetti=$is_jetti&is_seaoil=$is_seaoil&is_sm=$is_sm&is_robinson=$is_robinson&is_cebupacific=$is_cebupacific&is_petronv=$is_petronv&is_bdo=$is_bdo&is_mabuhay=$is_mabuhay&is_starbucks=$is_starbucks&is_snr=$is_snr&is_national=$is_national&is_happy=$is_happy&is_mercury=$is_mercury";
        curl_setopt($ch, CURLOPT_URL,$this->api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "state=state_update&card_number=$card_number&random_key=$random_key&yyyymmdd=$date&vendor_key=$vendor_key".$other_details);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $array_val = json_decode($server_output,true);
        echo json_encode($array_val["loyalty"]);
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
