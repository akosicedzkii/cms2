<?php

class Settings_model extends CI_Model {
    
        public function get_settings()
        {
                $query = $this->db->get('site_settings');
                if($query->row() == null)
                {
                        $site_name = "";
                        $site_logo = "";
                        $company_address = "";
                        $contact_number = "";
                        $fax_number = "";
                        $contact_us_email_address = "";
                        $facebook_url = "";
                        $twitter_url = "";
                        $instagram_url = "";
                }
                else
                {
                        $site_name = $query->row()->site_name;
                        $site_logo = $query->row()->site_logo;
                        $company_address = $query->row()->company_address;
                        $contact_number = $query->row()->contact_number;
                        $fax_number = $query->row()->fax_number;
                        $contact_us_email_address = $query->row()->contact_us_email_address;
                        $facebook_url = $query->row()->facebook_url;
                        $twitter_url = $query->row()->twitter_url;
                        $instagram_url = $query->row()->instagram_url;
                }
                define("SITE_NAME", $site_name);
                define("SITE_LOGO", $site_logo);
                define("COMPANY_ADDRESS", $company_address);
                define("CONTACT_NUMBER", $contact_number);
                define("FAX_NUMBER", $fax_number);
                define("CONTACT_US_EMAIL_ADDRESS", $contact_us_email_address);
                define("FACEBOOK_URL", $facebook_url);
                define("TWITTER_URL", $twitter_url);
                define("INSTAGRAM_URL", $instagram_url);
        }
        
        public function get_user_access()
        {
            $id = $this->session->userdata("USERID");
            $this->db->where("id",$id);
            $user_account = $this->db->get("user_accounts");

            $this->db->where("role_id",$user_account->row()->role_id);
            $this->db->select("module");
            $role_modules = $this->db->get("role_modules");
            $return = array();
            foreach($role_modules->result() as $row)
            {
                array_push($return,$row->module);
            }
            return $return;
        }
}

