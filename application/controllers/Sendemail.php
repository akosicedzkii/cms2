<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendemail extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->settings_model->get_settings();  
	}
	
	public function send_contact_us()
	{
		$to = CONTACT_US_EMAIL_ADDRESS;
		$body = $this->input->post("body");
		$subject = "Contact Us Response";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"to=$to&body=$body&subject=$subject&attachment=");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);
		
		$to = $this->input->post("to");
		$body = CONTACT_US_BODY_REPLY;
		$subject = CONTACT_US_SUBJECT_REPLY;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"to=$to&body=$body&subject=$subject&attachment=");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		echo $server_output = curl_exec ($ch);

		curl_close ($ch);

		$this->db->query("UPDATE submissions_counter SET contact_us = contact_us + 1");

	}

	public function send_franchise()
	{
		if ( 0 < $_FILES['file']['error'] ) {
			echo 'Error';
		}
		else {
			move_uploaded_file($_FILES['file']['tmp_name'], './emailer/attachment/' . $_FILES['file']['name']);
			
			$to = FRANCHISE_EMAIL_ADDRESS;
			$body = $this->input->post("body");
			$subject = $this->input->post("subject");
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"to=$to&body=$body&subject=$subject&attachment=".$_FILES['file']['name']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec ($ch);

			curl_close ($ch);

			$to = $this->input->post("to");
			$body = FRANCHISE_BODY_REPLY;
			$subject = FRANCHISE_SUBJECT_REPLY;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"to=$to&body=$body&subject=$subject&attachment=");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			echo $server_output = curl_exec ($ch);

			curl_close ($ch);
			$this->db->query("UPDATE submissions_counter SET franchise = franchise + 1");
		}

	}

	public function send_careers()
	{	
		if ( 0 < $_FILES['file']['error'] ) {
			echo 'Error';
		}
		else {
			move_uploaded_file($_FILES['file']['tmp_name'], './emailer/attachment/' . $_FILES['file']['name']);
			$to = CAREERS_EMAIL_ADDRESS;
			$body = $this->input->post("body");
			$subject = "Careers Response";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"to=$to&body=$body&subject=$subject&attachment=".$_FILES['file']['name']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
			$server_output = curl_exec ($ch);
	
			curl_close ($ch);
			
			$to = $this->input->post("to");
			$body = CAREERS_BODY_REPLY;
			$subject = CAREERS_SUBJECT_REPLY;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"to=$to&body=$body&subject=$subject&attachment=");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			echo $server_output = curl_exec ($ch);

			curl_close ($ch);

			$this->db->query("UPDATE submissions_counter SET careers = careers + 1");
		}

	}
	
}
