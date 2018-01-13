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
                        $franchise_email_address = "";
                        $careers_email_address = "";
                        $contact_us_subject_reply ="";
                        $contact_us_body_reply = "";
                        $franchise_body_reply = "";
                        $careers_body_reply = "";
                        $franchise_subject_reply = "";
                        $careers_subject_reply = "";
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
                        $franchise_email_address = $query->row()->franchise_email_address;
                        $careers_email_address = $query->row()->careers_email_address;
                        $contact_us_subject_reply = $query->row()->contact_us_subject_reply;
                        $contact_us_body_reply = $query->row()->contact_us_body_reply;
                        $franchise_body_reply = $query->row()->franchise_body_reply;
                        $careers_body_reply = $query->row()->careers_body_reply;
                        $franchise_subject_reply = $query->row()->franchise_subject_reply;
                        $careers_subject_reply = $query->row()->careers_subject_reply;

                }
                define("SITE_NAME", $site_name);
                define("SITE_LOGO", $site_logo);
                define("COMPANY_ADDRESS", $company_address);
                define("CONTACT_NUMBER", $contact_number);
                define("FAX_NUMBER", $fax_number);
                define("FACEBOOK_URL", $facebook_url);
                define("TWITTER_URL", $twitter_url);
                define("INSTAGRAM_URL", $instagram_url);
                define("CONTACT_US_EMAIL_ADDRESS", $contact_us_email_address);
                define("FRANCHISE_EMAIL_ADDRESS", $franchise_email_address);
                define("CAREERS_EMAIL_ADDRESS", $careers_email_address);
                define("CONTACT_US_BODY_REPLY", $contact_us_body_reply);
                define("FRANCHISE_BODY_REPLY", $franchise_body_reply);
                define("CAREERS_BODY_REPLY", $careers_body_reply);
                define("CONTACT_US_SUBJECT_REPLY", $contact_us_subject_reply);
                define("FRANCHISE_SUBJECT_REPLY", $franchise_subject_reply);
                define("CAREERS_SUBJECT_REPLY", $careers_subject_reply);
                
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

