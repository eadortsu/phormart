<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //settings
        $global_data['general_settings'] = $this->settings_model->get_general_settings();
        $this->general_settings = $global_data['general_settings'];
        //lang base url
        $global_data['lang_base_url'] = base_url();
        //languages
        $global_data['languages'] = $this->language_model->get_active_languages();

        //site lang
        $global_data['site_lang'] = $this->language_model->get_language($this->general_settings->site_lang);
        if (empty($global_data['site_lang'])) {
            $global_data['site_lang'] = $this->language_model->get_language('1');
        }
        $global_data['selected_lang'] = $global_data['site_lang'];

        //set language
        $lang_segment = $this->uri->segment(1);
        foreach ($global_data['languages'] as $lang) {
            if ($lang_segment == $lang->short_form) {
                if ($this->general_settings->multilingual_system == 1):
                    $global_data['selected_lang'] = $lang;
                    $global_data['lang_base_url'] = base_url() . $lang->short_form . "/";
                else:
                    redirect(base_url());
                endif;
            }
        }

        $this->selected_lang = $global_data['selected_lang'];
        $this->lang_base_url = $global_data['lang_base_url'];

        $this->config->set_item('language', $global_data['selected_lang']->folder_name);
        $this->lang->load("site_lang", $global_data['selected_lang']->folder_name);

        $global_data['rtl'] = false;
        if ($global_data['selected_lang']->text_direction == "rtl") {
            $global_data['rtl'] = true;
        }
        $this->rtl = $global_data['rtl'];

        //set lang base url
        if ($this->general_settings->site_lang == $global_data['selected_lang']->id) {
            $global_data['lang_base_url'] = base_url();
        } else {
            $global_data['lang_base_url'] = base_url() . $global_data['selected_lang']->short_form . "/";
        }

        $global_data['settings'] = $this->settings_model->get_settings($global_data['selected_lang']->id);
        $this->settings = $global_data['settings'];

        //selected layout
        $global_data['layout'] = $global_data['general_settings']->layout;
        $this->layout = $global_data['general_settings']->layout;

        //get site primary font
        $this->config->load('fonts');
        $global_data['primary_font'] = $this->general_settings->primary_font;
        $global_data['primary_font_family'] = $this->config->item($global_data['primary_font'] . '_font_family');
        $global_data['primary_font_url'] = $this->config->item($global_data['primary_font'] . '_font_url');

        //get site secondary font
        $global_data['secondary_font'] = $this->general_settings->secondary_font;
        $global_data['secondary_font_family'] = $this->config->item($global_data['secondary_font'] . '_font_family');
        $global_data['secondary_font_url'] = $this->config->item($global_data['secondary_font'] . '_font_url');

        //get site tertiary font
        $global_data['tertiary_font'] = $this->general_settings->tertiary_font;
        $global_data['tertiary_font_family'] = $this->config->item($global_data['tertiary_font'] . '_font_family');
        $global_data['tertiary_font_url'] = $this->config->item($global_data['tertiary_font'] . '_font_url');

        //bg images
        $global_data["img_bg_mid"] = base_url() . "assets/img/bg_mid.jpg";
        $global_data["img_bg_sm"] = base_url() . "assets/img/img_bg_sm.jpg";
        $global_data["img_bg_sl"] = base_url() . "assets/img/bg_slider.jpg";

        $this->load->vars($global_data);
    }

}

class Home_Core_Controller extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();

        //main menu
        $global_data['main_menu'] = $this->navigation_model->get_menu_links();
        $global_data['popular_posts'] = $this->post_model->get_popular_posts(5);
        $global_data['our_picks'] = $this->post_model->get_our_picks(5);
        $global_data['random_slider_posts'] = $this->post_model->get_random_slider_posts(5);
        $global_data['categories'] = $this->category_model->get_categories();
        $global_data['tags'] = $this->tag_model->get_random_tags();
        $global_data['footer_random_posts'] = $this->post_model->get_footer_random_posts(3);
        $global_data['polls'] = $this->poll_model->get_polls();

        //Social Login
        $global_data['fb_login_state'] = 0;
        $global_data['google_login_state'] = 0;

        if (!empty($this->general_settings->facebook_app_id)) {
            $global_data['fb_login_state'] = 1;
        }
        if (!empty($this->general_settings->google_client_id)) {
            $global_data['google_login_state'] = 1;
        }

        //recaptcha status
        $global_data['recaptcha_status'] = true;
        if (empty($this->general_settings->recaptcha_site_key) || empty($this->general_settings->recaptcha_secret_key)) {
            $global_data['recaptcha_status'] = false;
        }
        $this->recaptcha_status = $global_data['recaptcha_status'];


        $this->load->vars($global_data);
    }

    //verify recaptcha
    public function recaptcha_verify_request()
    {
        if (!$this->recaptcha_status) {
            return true;
        }

        $this->load->library('recaptcha');
        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) && $response['success'] === true) {
                return true;
            }
        }
        return false;
    }

}

class Admin_Core_Controller extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();

        $global_data['images'] = $this->file_model->get_images(48);
        $this->load->vars($global_data);

    }

    public function paginate($url, $total_rows)
    {
        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        $per_page = $this->input->get('show', true);
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }

        if (empty($per_page)) {
            $per_page = 15;
        }

        $config['num_links'] = 4;
        $config['base_url'] = $url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);

        return array('per_page' => $per_page, 'offset' => $page * $per_page);
    }
}

