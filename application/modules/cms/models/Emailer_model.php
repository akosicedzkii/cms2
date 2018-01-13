<?php

class Emailer_model extends CI_Model {
    public $from;
    public $to;
    public $subject;
    public $message;
    public $attachment;
    public function send_email()
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'xxx',
            'smtp_pass' => 'xxx',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        
        $this->email->from($this->from, 'Your Name');
        $this->email->to($this->to);

        $this->email->subject($this->subject);
        $this->email->message($this->message);
        if($this->attachment != null)
        {
            if(is_array($this->attachment))
            {
                foreach($this->attachment as $row)
                {
                    $this->email->attach($row);
                }
            }
            else
            {
                $this->email->attach($this->attachment);
            }
        }
        $this->email->send();
    }
}

?>