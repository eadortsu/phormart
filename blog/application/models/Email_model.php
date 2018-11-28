<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model
{
    //send email
    public function send_email($to, $subject, $message)
    {
        $this->load->library('email');

        $general_settings = $this->settings_model->get_general_settings();
        $settings = $this->settings_model->get_settings($this->selected_lang->id);

        if ($general_settings->mail_protocol == "mail") {
            $config = Array(
                'protocol' => 'mail',
                'smtp_host' => $general_settings->mail_host,
                'smtp_port' => $general_settings->mail_port,
                'smtp_user' => $general_settings->mail_username,
                'smtp_pass' => $general_settings->mail_password,
                'smtp_timeout' => 100,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
        } else {
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => $general_settings->mail_host,
                'smtp_port' => $general_settings->mail_port,
                'smtp_user' => $general_settings->mail_username,
                'smtp_pass' => $general_settings->mail_password,
                'smtp_timeout' => 100,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
        }


        //initialize
        $this->email->initialize($config);

        //send email
        $this->email->from($general_settings->mail_username, $settings->application_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->set_newline("\r\n");

        return $this->email->send();
    }

}