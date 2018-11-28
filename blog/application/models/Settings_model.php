<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    //update settings
    public function update_settings()
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'application_name' => $this->input->post('application_name', true),
            'facebook_url' => $this->input->post('facebook_url', true),
            'twitter_url' => $this->input->post('twitter_url', true),
            'google_url' => $this->input->post('google_url', true),
            'instagram_url' => $this->input->post('instagram_url', true),
            'pinterest_url' => $this->input->post('pinterest_url', true),
            'linkedin_url' => $this->input->post('linkedin_url', true),
            'vk_url' => $this->input->post('vk_url', true),
            'optional_url_button_name' => $this->input->post('optional_url_button_name', true),
            'about_footer' => $this->input->post('about_footer', true),
            'copyright' => $this->input->post('copyright', true),
            'contact_text' => $this->input->post('contact_text', false),
            'contact_address' => $this->input->post('contact_address', true),
            'contact_email' => $this->input->post('contact_email', true),
            'contact_phone' => $this->input->post('contact_phone', true),
        );

        $this->db->where('lang_id', $data['lang_id']);
        return $this->db->update('settings', $data);
    }

    //update general settings
    public function update_general_settings()
    {
        $data = array(
            'multilingual_system' => $this->input->post('multilingual_system', true),
            'registration_system' => $this->input->post('registration_system', true),
            'comment_system' => $this->input->post('comment_system', true),
            'facebook_comment' => $this->input->post('facebook_comment', false),
            'slider_active' => $this->input->post('slider_active', true),
            'emoji_reactions' => $this->input->post('emoji_reactions', true),
            'show_pageviews' => $this->input->post('show_pageviews', true),
            'show_rss' => $this->input->post('show_rss', true),
            'pagination_per_page' => $this->input->post('pagination_per_page', true),
            'site_color' => $this->input->post('site_color', true),
            'head_code' => $this->input->post('head_code', false),
        );

        //get file
        $file = $_FILES['logo'];
        if (!empty($file['name'])) {
            //upload logo
            $data["logo_path"] = $this->upload_model->logo_upload($file);
        }

        //get file
        $file = $_FILES['favicon'];
        if (!empty($file['name'])) {
            //upload logo
            $data["favicon_path"] = $this->upload_model->favicon_upload($file);
        }

        $this->db->where('id', 1);
        return $this->db->update('general_settings', $data);
    }

    //get settings
    public function get_settings($lang_id)
    {
        $this->db->where('lang_id', $lang_id);
        $query = $this->db->get('settings');
        return $query->row();
    }

    //update layout
    public function update_layout()
    {
        $data = array(
            'layout' => $this->input->post('layout', true),
        );

        $this->db->where('id', 1);
        return $this->db->update('general_settings', $data);
    }


    //update recaptcha settings
    public function update_recaptcha_settings()
    {
        $data = array(
            'recaptcha_site_key' => $this->input->post('recaptcha_site_key', true),
            'recaptcha_secret_key' => $this->input->post('recaptcha_secret_key', true),
            'recaptcha_lang' => $this->input->post('recaptcha_lang', true),
        );

        $this->db->where('id', 1);
        return $this->db->update('general_settings', $data);
    }

    //get settings
    public function get_general_settings()
    {
        $this->db->where('id', 1);
        $query = $this->db->get('general_settings');
        return $query->row();
    }

    //update fonts
    public function update_fonts()
    {
        $data = array(
            'primary_font' => $this->input->post('primary_font', true),
            'secondary_font' => $this->input->post('secondary_font', true),
            'tertiary_font' => $this->input->post('tertiary_font', true),
        );
        $this->db->where('id', 1);
        return $this->db->update('general_settings', $data);
    }

    //update seo settings
    public function update_seo_settings()
    {
        $general = array(
            'google_analytics' => $this->input->post('google_analytics', false),
        );

        $this->db->where('id', 1);
        $this->db->update('general_settings', $general);

        $data = array(
            'site_title' => $this->input->post('site_title', true),
            'home_title' => $this->input->post('home_title', true),
            'site_description' => $this->input->post('site_description', true),
            'keywords' => $this->input->post('keywords', true),
        );

        $lang_id = $this->input->post('lang_id', true);

        $this->db->where('lang_id', $lang_id);
        return $this->db->update('settings', $data);
    }

    //update email settings
    public function update_email_settings()
    {
        $data = array(
            'mail_protocol' => $this->input->post('mail_protocol', true),
            'mail_title' => $this->input->post('mail_title', true),
            'mail_host' => $this->input->post('mail_host', true),
            'mail_port' => $this->input->post('mail_port', true),
            'mail_username' => $this->input->post('mail_username', true),
            'mail_password' => $this->input->post('mail_password', true),
        );

        //update
        $this->db->where('id', 1);
        return $this->db->update('general_settings', $data);
    }

}