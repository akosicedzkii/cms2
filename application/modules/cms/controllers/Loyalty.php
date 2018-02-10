<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loyalty extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

    public function update_settings()
    { 
        $page = $this->input->post("page");
        if($page == "loyalty_terms_and_conditions")
        {
            $data["loyalty_terms_and_conditions"] = $this->input->post("loyalty_terms_and_conditions");
        }

        if($page == "loyalty_privacy_policy")
        {
            $data["loyalty_privacy_policy"] = $this->input->post("loyalty_privacy_policy");
        }
        if($page == "loyalty_faqs")
        {
            $data["loyalty_faqs"] = $this->input->post("loyalty_faqs");
        }
        echo $this->db->update("loyalty_settings",$data);
        $this->logs->log = "Updated ".str_replace("_"," ",$page)."";
        $this->logs->details = json_encode($data);
        $this->logs->module = $page;
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
    }
}
