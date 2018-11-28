<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Core_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();

        //check auth
        if (!is_admin() && !is_author()) {
            redirect('login');
        }
    }


    /**
     * Index Page
     */
    public function index()
    {
        $data['title'] = trans("index");

        $data['comment_count'] = $this->comment_model->get_comment_count();
        $data['user_count'] = $this->auth_model->get_user_count();
        $data['last_comments'] = $this->comment_model->get_last_comments(5);
        $data['last_contacts'] = $this->contact_model->get_last_contact_messages();
        $data['last_users'] = $this->auth_model->get_last_users();
        $data['pending_post_count'] = $this->post_admin_model->get_pending_posts_count();
        $data['post_count'] = $this->post_admin_model->get_posts_count();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Navigation
     */
    public function navigation()
    {
        prevent_author();

        $data['title'] = trans("navigation");
        $data['menu_links'] = $this->navigation_model->get_menu_links_by_lang($this->general_settings->site_lang);
        $data['lang_search_column'] = 3;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/navigation/navigation', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Menu Link Post
     */
    public function add_menu_link_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->navigation_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->navigation_model->add_link()) {
                $this->session->set_flashdata('success_form', trans("link") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->navigation_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Menu Link
     */
    public function update_menu_link()
    {
        prevent_author();

        $data['title'] = trans("navigation");

        $id = $this->input->get("id");
        $data['page'] = $this->page_model->get_page_by_id($id);
        $data['menu_links'] = $this->navigation_model->get_menu_links_by_lang($data['page']->lang_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/navigation/update_navigation', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Menü Link Post
     */
    public function update_menu_link_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->navigation_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $id = $this->input->post('id', true);

            if ($this->navigation_model->update_link($id)) {
                $this->session->set_flashdata('success', trans("link") . " " . trans("msg_suc_updated"));
                redirect("admin/navigation");
            } else {
                $this->session->set_flashdata('form_data', $this->navigation_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete Navigation Post
     */
    public function delete_navigation_post()
    {
        $id = $this->input->post('id', true);
        $data["page"] = $this->page_model->get_page_by_id($id);

        //check if exists
        if (empty($data['page'])) {
            redirect($this->agent->referrer());
        }

        if ($this->page_model->delete($id)) {
            $this->session->set_flashdata('success', trans("link") . " " . trans("msg_suc_deleted"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


    /**
     * Menu Limit Post
     */
    public function menu_limit_post()
    {
        if ($this->navigation_model->update_menu_limit()) {
            $this->session->set_flashdata('success_form', trans("menu_limit") . " " . trans("msg_suc_updated"));
            $this->session->set_flashdata("mes_menu_limit", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('form_data', $this->navigation_model->input_values());
            $this->session->set_flashdata("mes_menu_limit", 1);
            $this->session->set_flashdata('error_form', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }

    //get menu links by language
    public function get_menu_links_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $menu_links = $this->navigation_model->get_menu_links_by_lang($lang_id);
            foreach ($menu_links as $item):
                if ($item["type"] != "category" && $item["location"] == "header" && $item['parent_id'] == "0"):
                    echo ' <option value="' . $item["id"] . '">' . $item["title"] . '</option>';
                endif;
            endforeach;
        endif;
    }


    /**
     * Layout Options
     */
    public function layout_options()
    {
        $data['title'] = trans("layout_options");

        $data['general_settings'] = $this->settings_model->get_general_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/layout_options', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Layout Options Post
     */
    public function layout_options_post()
    {
        if ($this->settings_model->update_layout()) {
            $this->session->set_flashdata('success', trans("layout") . " " . trans("msg_suc_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Comments
     */
    public function comments()
    {
        $data['title'] = trans("comments");

        $data['comments'] = $this->comment_model->get_all_comments();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/comments', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Delete Comment Post
     */
    public function delete_comment_post()
    {
        $id = $this->input->post('id', true);

        if ($this->comment_model->delete_comment($id)) {
            $this->session->set_flashdata('success', trans("comment") . " " . trans("msg_suc_deleted"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


    /**
     * Contact Messages
     */
    public function contact_messages()
    {
        $data['title'] = trans("contact_messages");
        $data['messages'] = $this->contact_model->get_contact_messages();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/contact_messages', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Delete Contact Message Post
     */
    public function delete_contact_message_post()
    {
        $id = $this->input->post('id', true);

        if ($this->contact_model->delete_contact_message($id)) {
            $this->session->set_flashdata('success', trans("message") . " " . trans("msg_suc_deleted"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


    /**
     * Ads
     */
    public function ad_spaces()
    {
        prevent_author();

        $data['title'] = trans("ad_spaces");

        $data['ad_space'] = $this->input->get('ad_space', true);

        if (empty($data['ad_space'])) {
            redirect("admin/ad_spaces?ad_space=index_top");
        }

        $data['ad_codes'] = $this->ad_model->get_ad_codes($data['ad_space']);

        if (empty($data['ad_codes'])) {
            redirect("admin/ad_spaces");
        }
        $data["array_ad_spaces"] = array(
            "index_top" => trans("index_top_ad_space"),
            "index_bottom" => trans("index_bottom_ad_space"),
            "post_top" => trans("post_top_ad_space"),
            "post_bottom" => trans("post_bottom_ad_space"),
            "category_top" => trans("category_top_ad_space"),
            "category_bottom" => trans("category_bottom_ad_space"),
            "tag_top" => trans("tag_top_ad_space"),
            "tag_bottom" => trans("tag_bottom_ad_space"),
            "search_top" => trans("search_top_ad_space"),
            "search_bottom" => trans("search_bottom_ad_space"),
            "profile_top" => trans("profile_top_ad_space"),
            "profile_bottom" => trans("profile_bottom_ad_space"),
            "reading_list_top" => trans("reading_list_top_ad_space"),
            "reading_list_bottom" => trans("reading_list_bottom_ad_space"),
            "sidebar_top" => trans("sidebar_top_ad_space"),
            "sidebar_bottom" => trans("sidebar_bottom_ad_space"),
        );

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/ad_spaces', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Ads Post
     */
    public function ad_spaces_post()
    {
        prevent_author();

        $ad_space = $this->input->post('ad_space', true);

        if ($this->ad_model->update_ad_spaces($ad_space)) {
            $this->session->set_flashdata('success', trans("ad_spaces") . " " . trans("msg_suc_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }

        redirect("admin/ad_spaces?ad_space=" . $ad_space);
    }


    /**
     * Update Profile
     */
    public function update_profile($id)
    {
        $data['title'] = trans("update_profile");

        $data['user'] = $this->auth_model->get_user($id);

        //check admin
        if (!is_admin()) {
            if (user()->id != $id) {
                redirect('admin/users');
            }
        }

        //user not found
        if (empty($data['user'])) {
            redirect('admin');
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/update_profile', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Profile Post
     */
    public function update_profile_post()
    {
        $id = $this->input->post('id', true);
        $slug = $this->input->post('slug', true);

        $user = $this->auth_model->get_user($id);

        //user not found
        if (empty($user)) {
            redirect('admin');
        }

        //check admin
        if (!is_admin()) {
            if (user()->id != $id) {
                redirect('admin/users');
            }
        }

        //check slug
        $user_slug = $this->auth_model->get_user_by_slug($slug);
        if (!empty($user_slug)) {

            if ($user_slug->id != $user->id) {
                $this->session->set_flashdata('error', trans("message_slug_error"));
                redirect($this->agent->referrer());
            }
        }

        if ($this->auth_model->update_author($id)) {
            $this->session->set_flashdata('success', trans("profile") . " " . trans("msg_suc_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }

        redirect($this->agent->referrer());
    }

    /**
     * Settings
     */
    public function settings()
    {
        prevent_author();

        $data["selected_lang"] = $this->input->get("lang", true);

        if (empty($data["selected_lang"])) {
            $data["selected_lang"] = $this->general_settings->site_lang;
            redirect("admin/settings?lang=" . $data["selected_lang"]);
        }

        $data['title'] = trans("settings");
        $data['form_settings'] = $this->settings_model->get_settings($data["selected_lang"]);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Settings Post
     */
    public function settings_post()
    {
        prevent_author();
        if ($this->settings_model->update_settings()) {
            $this->settings_model->update_general_settings();
            $this->session->set_flashdata('success', trans("settings") . " " . trans("msg_suc_updated"));
            $this->session->set_flashdata("mes_settings", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata("mes_settings", 1);
            redirect($this->agent->referrer());
        }
    }

    /**
     * Recaptcha Settings Post
     */
    public function recaptcha_settings_post()
    {
        prevent_author();

        if ($this->settings_model->update_recaptcha_settings()) {
            $this->session->set_flashdata('success', trans("settings") . " " . trans("msg_suc_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


    /**
     * Seo Tools
     */
    public function seo_tools()
    {
        prevent_author();

        $data['title'] = trans("seo_tools");

        $data["selected_lang"] = $this->input->get("lang", true);

        if (empty($data["selected_lang"])) {
            $data["selected_lang"] = $this->general_settings->site_lang;
            redirect("admin/seo_tools?lang=" . $data["selected_lang"]);
        }

        $data['settings'] = $this->settings_model->get_settings($data["selected_lang"]);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/seo_tools', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Seo Tools Post
     */
    public function seo_tools_post()
    {
        prevent_author();

        if ($this->settings_model->update_seo_settings()) {
            $this->session->set_flashdata('success', trans("seo_options") . " " . trans("msg_suc_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Font Options
     */
    public function font_options()
    {
        $data['title'] = trans("font_options");
        $data['fonts'] = $this->config->item('fonts_array');

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/font_options', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Font Options Post
     */
    public function font_options_post()
    {
        if ($this->settings_model->update_fonts()) {
            $this->session->set_flashdata('success', trans("font_options") . " " . trans("msg_suc_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('form_data', $this->settings_model->input_values());
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Email Settings
     */
    public function email_settings()
    {
        prevent_author();

        $data['title'] = trans("email_settings");

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/email_settings', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Email Settings Post
     */
    public function email_settings_post()
    {
        if ($this->settings_model->update_email_settings()) {
            $this->session->set_flashdata('success', trans("email_settings") . " " . trans("msg_suc_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }


    /**
     * Users
     */
    public function users()
    {
        //check if admin
        if ($this->auth_model->is_admin() == false) {
            redirect('login');
        }

        $data['title'] = trans("users");
        $data['users'] = $this->auth_model->get_users();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Change User Role
     */
    public function change_user_role_post()
    {
        //check if admin
        if ($this->auth_model->is_admin() == false) {
            redirect('login');
        }

        $id = $this->input->post('user_id', true);
        $role = $this->input->post('role', true);

        $user = $this->auth_model->get_user($id);

        //check if exists
        if (empty($user)) {
            redirect($this->agent->referrer());
        } else {
            if ($this->auth_model->change_user_role($id, $role)) {
                $this->session->set_flashdata('success', trans("msg_role_changed"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * User Options Post
     */
    public function user_options_post()
    {
        prevent_author();

        //check if admin
        if (is_admin() == false) {
            redirect('login');
        }

        $option = $this->input->post('option', true);
        $id = $this->input->post('id', true);
        $logged_id = user()->id;

        //if option delete
        if ($option == 'delete') {
            if ($this->auth_model->delete_user($id)) {
                $this->session->set_flashdata('success', trans("user") . " " . trans("msg_suc_deleted"));

                if ($id == $logged_id) {
                    redirect("logout");
                } else {
                    redirect($this->agent->referrer());
                }

            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }

        //if option ban
        if ($option == 'ban') {
            if ($this->auth_model->ban_user($id)) {
                $this->session->set_flashdata('success', trans("msg_user_banned"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }

        //if option remove ban
        if ($option == 'remove_ban') {
            if ($this->auth_model->remove_user_ban($id)) {
                $this->session->set_flashdata('success', trans("msg_ban_removed"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Newsletter
     */
    public function newsletter()
    {
        $data['title'] = trans("newsletter");
        $data['newsletter'] = $this->newsletter_model->get_newsletters();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/newsletter', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Delete Newsletter Post
     */
    public function delete_newsletter_post()
    {
        $id = $this->input->post('id', true);

        $data['newsletter'] = $this->newsletter_model->get_newsletter_by_id($id);

        if (empty($data['newsletter'])) {
            redirect($this->agent->referrer());
        }

        if ($this->newsletter_model->delete_from_newsletter($id)) {
            $this->session->set_flashdata('success', trans("email") . " " . trans("msg_suc_deleted"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Newsletter Send Email Post
     */
    public function newsletter_send_email_post()
    {
        $subject = $this->input->post('subject', true);
        $message = $this->input->post('message', false);

        $data['newsletter'] = $this->newsletter_model->get_newsletters();

        foreach ($data['newsletter'] as $item) {
            //send email
            $this->email_model->send_email($item->email, $subject, $message);
        }

        $this->session->set_flashdata('success', trans("msg_email_sent"));
        redirect($this->agent->referrer());
    }

    /**
     * Delete Selected Comments
     */
    public function delete_selected_comments()
    {
        $comment_ids = $this->input->post('comment_ids', true);

        $this->comment_model->delete_multi_comments($comment_ids);
    }


}