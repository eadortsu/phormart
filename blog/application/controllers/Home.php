<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Home_Core_Controller
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
    }


    /**
     * Index Page
     */
    public function index()
    {
        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }
        $config['base_url'] = lang_base_url();
        $config['total_rows'] = $this->post_model->get_post_count();
        $config['per_page'] = $this->general_settings->pagination_per_page;
        $this->pagination->initialize($config);

        $data['page'] = $this->page_model->get_page('index');

        //check page auth
        $this->checkPageAuth($data['page']);

        $data['title'] = $this->settings->home_title;
        $data['description'] = $this->settings->site_description;
        $data['keywords'] = $this->settings->keywords;
        $data['home_title'] = $this->settings->home_title;

        $data['slider_posts'] = $this->post_model->get_slider_posts();
        $data['posts'] = $this->post_model->get_paginated_posts($config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('index', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Gallery Page
     */
    public function gallery()
    {
        $data['page'] = $this->page_model->get_page('gallery');
        //check page auth
        $this->checkPageAuth($data['page']);

        if ($data['page']->page_active == 0) {
            $this->error_404();
        } else {
            $data['title'] = get_page_title($data['page']);
            $data['description'] = get_page_description($data['page']);
            $data['keywords'] = get_page_keywords($data['page']);
            //get gallery categories
            $data['gallery_categories'] = $this->gallery_category_model->get_categories();
            //get gallery images
            $data['gallery_images'] = $this->gallery_model->get_images();

            $this->load->view('partials/_header', $data);
            $this->load->view('gallery', $data);
            $this->load->view('partials/_footer');
        }
    }


    /**
     * Contact Page
     */
    public function contact()
    {
        $data['page'] = $this->page_model->get_page('contact');
        //check page auth
        $this->checkPageAuth($data['page']);

        if ($data['page']->page_active == 0) {
            $this->error_404();
        } else {
            if ($this->recaptcha_status) {
                $this->load->library('recaptcha');
                $data['recaptcha_widget'] = $this->recaptcha->getWidget();
                $data['recaptcha_script'] = $this->recaptcha->getScriptTag();
            }
            $data['title'] = get_page_title($data['page']);
            $data['description'] = get_page_description($data['page']);
            $data['keywords'] = get_page_keywords($data['page']);

            $this->load->view('partials/_header', $data);
            $this->load->view('contact', $data);
            $this->load->view('partials/_footer');
        }
    }


    /**
     * Contact Page Post
     */
    public function contact_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('email', trans("email"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('message', trans("message"), 'required|xss_clean|max_length[5000]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->contact_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if (!$this->recaptcha_verify_request()) {
                $this->session->set_flashdata('form_data', $this->contact_model->input_values());
                $this->session->set_flashdata('error', trans("msg_recaptcha"));
                redirect($this->agent->referrer());
            } else {

                if ($this->contact_model->add_contact_message()) {
                    $this->session->set_flashdata('success', trans("message_contact_success"));
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('form_data', $this->contact_model->input_values());
                    $this->session->set_flashdata('error', trans("message_contact_error"));
                    redirect($this->agent->referrer());
                }
            }
        }
    }


    /**
     * Rss Page
     */
    public function rss_feeds()
    {
        $data['page'] = $this->page_model->get_page('rss-feeds');

        //check page auth
        $this->checkPageAuth($data['page']);

        if ($this->general_settings->show_rss == 0 || $data['page']->page_active == 0) {
            $this->error_404();
        } else {

            $data['title'] = get_page_title($data['page']);
            $data['description'] = get_page_description($data['page']);
            $data['keywords'] = get_page_keywords($data['page']);

            $this->load->view('partials/_header', $data);
            $this->load->view('rss_channels', $data);
            $this->load->view('partials/_footer');

        }
    }


    /**
     * Category Page
     */
    public function category($slug)
    {
        $slug = $this->security->xss_clean($slug);

        $data['category'] = $this->category_model->get_category_by_slug($slug);

        //check category exists
        if (empty($data['category'])) {
            redirect(lang_base_url());
        }

        $category_id = $data['category']->id;

        $data['title'] = html_escape($data['category']->name);
        $data['description'] = html_escape($data['category']->description);
        $data['keywords'] = html_escape($data['category']->keywords);

        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }

        $config['base_url'] = lang_base_url() . '/category/' . $slug;
        $config['total_rows'] = $this->post_model->get_category_post_count($category_id);
        $config['per_page'] = $this->general_settings->pagination_per_page;
        $this->pagination->initialize($config);

        //get posts
        if ($data['category']->parent_id == 0) {
            $data['posts'] = $this->post_model->get_paginated_category_posts($category_id, $config['per_page'], $page * $config['per_page']);
        } else {
            $data['posts'] = $this->post_model->get_paginated_subcategory_posts($category_id, $config['per_page'], $page * $config['per_page']);
        }
        $this->load->view('partials/_header', $data);
        $this->load->view('category', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Tag Page
     */
    public function tag($tag_slug)
    {
        $tag_slug = $this->security->xss_clean($tag_slug);

        $data['tag'] = $this->tag_model->get_tag($tag_slug);

        //check tag exists
        if (empty($data['tag'])) {
            redirect(lang_base_url());
        }

        $data['title'] = html_escape($data['tag']->tag);
        $data['description'] = trans("tag") . ': ' . $data['tag']->tag;
        $data['keywords'] = trans("tag") . ', ' . $data['tag']->tag;


        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }

        $config['base_url'] = lang_base_url() . '/tag/' . $tag_slug;
        $config['total_rows'] = $this->post_model->get_tag_post_count($tag_slug);
        $config['per_page'] = $this->general_settings->pagination_per_page;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->post_model->get_paginated_tag_posts($tag_slug, $config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('tag', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Profile Page
     */
    public function profile($slug)
    {
        $slug = $this->security->xss_clean($slug);

        $data['author'] = $this->auth_model->get_user_by_slug($slug);

        //check author exists
        if (empty($data['author'])) {
            redirect(lang_base_url());
        }

        if ($data['author']->role == "user") {
            redirect(lang_base_url());
        }

        $data['title'] = $data['author']->username;
        $data['description'] = trans("author") . ': ' . $data['author']->username;
        $data['keywords'] = trans("author") . ', ' . $data['author']->username;


        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }

        $config['base_url'] = lang_base_url() . '/profile/' . $slug;
        $config['total_rows'] = $this->post_model->get_post_count_by_user($data['author']->id);
        $config['per_page'] = $this->general_settings->pagination_per_page;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->post_model->get_paginated_user_posts($data['author']->id, $config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('profile', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Reading List Page
     */
    public function reading_list()
    {
        $data["page"] = $this->page_model->get_page("reading-list");

        $data['title'] = get_page_title($data['page']);
        $data['description'] = get_page_description($data['page']);
        $data['keywords'] = get_page_keywords($data['page']);

        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }
        $data['post_count'] = $this->reading_list_model->get_reading_list_count();

        $config['base_url'] = lang_base_url() . '/reading-list';
        $config['total_rows'] = $data['post_count'];
        $config['per_page'] = $this->general_settings->pagination_per_page;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->reading_list_model->get_paginated_reading_list($config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('reading_list', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Search Page
     */
    public function search()
    {
        $q = $this->input->get('q', TRUE);

        $data['q'] = $q;
        $data['title'] = html_escape(trans("search")) . ': ' . $q;
        $data['description'] = html_escape(trans("search")) . ': ' . $q;
        $data['keywords'] = html_escape(trans("search")) . ', ' . $q;

        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }
        $data['post_count'] = $this->post_model->get_search_post_count($q);

        $config['base_url'] = lang_base_url() . '/search?q=' . $q;
        $config['total_rows'] = $data['post_count'];
        $config['per_page'] = $this->general_settings->pagination_per_page;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->post_model->get_paginated_search_posts($q, $config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('search', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Post Page
     */
    public function post($slug)
    {
        $slug = $this->security->xss_clean($slug);

        $data['post'] = $this->post_model->get_post($slug);

        //check if post exists
        if (empty($data['post'])) {
            redirect(lang_base_url());
        }

        $id = $data['post']->id;

        if (!auth_check() && $data['post']->need_auth == 1) {
            $this->session->set_flashdata('error', trans("message_post_auth"));
            redirect(lang_base_url() . 'login');
        }

        //check visibility
        if ($data['post']->visibility != 1) {
            redirect(lang_base_url());
        }

        $data['post_image_count'] = $this->post_file_model->get_post_additional_image_count($id);
        $data['post_images'] = $this->post_file_model->get_post_additional_images($id);
        $data['post_tags'] = $this->tag_model->get_post_tags($id);
        $data['post_user'] = $this->auth_model->get_user($data['post']->user_id);
        $data['related_posts'] = $this->post_model->get_related_posts($data['post']->category_id, $id);
        $data['comments'] = $this->comment_model->get_comments($id, 5);
        $data['vr_comment_limit'] = 5;

        $data['is_reading_list'] = $this->reading_list_model->is_post_in_reading_list($id);

        $data['page_type'] = "post";
        //set og tags
        $data['og_type'] = "article";
        $data['og_url'] = lang_base_url() . "post/" . html_escape($data['post']->title_slug);
        $data['og_image'] = base_url() . $data['post']->image_mid;
        $data['og_tags'] = $data['post_tags'];

        $data['title'] = html_escape($data['post']->title);
        $data['description'] = html_escape($data['post']->title);
        $data['keywords'] = html_escape($data['post']->keywords);

        $this->reaction_model->set_voted_reactions_session($id);
        $data["reactions"] = $this->reaction_model->get_reaction($id);
        $data["emoji_lang"] = $this->selected_lang->folder_name;

        $this->load->view('partials/_header', $data);
        $this->load->view('post', $data);
        $this->load->view('partials/_footer', $data);

        //increase post hit
        $this->post_model->increase_post_hit($data['post']);

    }


    /**
     * Dynamic Page by Name Slug
     */
    public function get_page($slug)
    {
        $slug = $this->security->xss_clean($slug);
        //index page
        if (empty($slug)) {
            redirect(lang_base_url());
        }

        $data['page'] = $this->page_model->get_page($slug);
        //check page auth
        $this->checkPageAuth($data['page']);

        //if not exists
        if (empty($data['page']) || $data['page'] == null) {
            $this->error_404();
        } //check if page disable
        else if ($data['page']->page_active == 0 || $data['page']->link != '') {
            $this->error_404();
        } else {
            $data['title'] = get_page_title($data['page']);
            $data['description'] = get_page_description($data['page']);
            $data['keywords'] = get_page_keywords($data['page']);

            $this->load->view('partials/_header', $data);
            $this->load->view('page', $data);
            $this->load->view('partials/_footer');

        }
    }


    /**
     * Add or Delete from Reading List
     */
    public function add_delete_from_reading_list_post()
    {
        $post_id = $this->input->post('post_id');

        if (empty($post_id)) {
            redirect($this->agent->referrer());
        }

        $is_post_in_reading_list = $this->reading_list_model->is_post_in_reading_list($post_id);

        //delete from list
        if ($is_post_in_reading_list == true) {
            $this->reading_list_model->delete_from_reading_list($post_id);
        } else {
            //add to list
            $this->reading_list_model->add_to_reading_list($post_id);
        }

        redirect($this->agent->referrer());
    }


    /**
     * Add Comment
     */
    public function add_comment_post()
    {
        //input values
        $data = $this->comment_model->input_values();

        if ($data['post_id'] && $data['user_id'] && trim($data['comment'])) {
            $this->comment_model->add_comment();
        }

        $limit = $this->input->post('limit', true);

        $data["vr_comment_limit"] = $limit;

        $data['comments'] = $this->comment_model->get_comments($data['post_id'], $limit);
        $this->load->view('partials/_comments', $data);
    }


    /**
     * Delete Comment
     */
    public function delete_comment_post()
    {
        $id = $this->input->post('id', true);

        $comment = $this->comment_model->get_comment($id);
        $post_id = 0;
        //if comment exists
        if (!empty($comment)) {
            $post_id = $comment->post_id;
            $this->comment_model->delete_comment($id);
        }

        $limit = $this->input->post('limit', true);

        $data["post_id"] = $post_id;
        $data["vr_comment_limit"] = $limit;

        $data['comments'] = $this->comment_model->get_comments($post_id, $limit);
        $data['comment_count'] = $this->comment_model->get_post_comment_count($post_id);
        $this->load->view('partials/_comments', $data);
    }


    /**
     * Load More Comments
     */
    public function load_more_comments()
    {
        //input values
        $id = $this->input->post('post_id', true);
        $limit = $this->input->post('limit', true);

        $limit = $limit + 5;
        $data["post_id"] = $id;
        $data["vr_comment_limit"] = $limit;

        $data['comments'] = $this->comment_model->get_comments($id, $limit);
        $data['comment_count'] = $this->comment_model->get_post_comment_count($id);

        $this->load->view('partials/_comments', $data);
    }


    /**
     * Add to Newsletter
     */
    public function add_to_newsletter()
    {
        //input values
        $email = $this->input->post('email', true);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('news_error', trans("message_invalid_email"));
        } else {
            if ($email) {
                //check if email exists
                if (empty($this->newsletter_model->get_newsletter($email))) {
                    //addd
                    if ($this->newsletter_model->add_to_newsletter($email)) {
                        $this->session->set_flashdata('news_success', trans("message_newsletter_success"));
                    }
                } else {
                    $this->session->set_flashdata('news_error', trans("message_newsletter_error"));
                }
            }

        }

        redirect($this->agent->referrer() . "#newsletter");
    }

    /**
     * Make Reaction
     */
    public function save_reaction()
    {
        $post_id = $this->input->post('post_id');
        $reaction = $this->input->post('reaction');
        $data["emoji_lang"] = $this->input->post('lang');

        $this->config->set_item('language', $data["emoji_lang"]);
        $this->lang->load("site_lang", $data["emoji_lang"]);

        $data["post"] = $this->post_admin_model->get_post($post_id);

        if (!empty($data["post"])) {
            $this->reaction_model->save_reaction($post_id, $reaction);
        }

        $data["reactions"] = $this->reaction_model->get_reaction($post_id);
        $this->load->view('partials/_emoji_reactions', $data);
    }

    /**
     * Add Poll Vote
     */
    public function add_vote()
    {
        $poll_id = $this->input->post('poll_id', true);
        $option = $this->input->post('option', true);

        $result = $this->poll_model->add_unregistered_vote($poll_id, $option);
        if ($result == "success") {
            $data["poll"] = $this->poll_model->get_poll($poll_id);
            $this->load->view('partials/_poll_results', $data);
        } else {
            echo "voted";
        }
    }

    public function checkPageAuth($page)
    {
        if (!empty($page)) {
            if (!auth_check() && $page->need_auth == 1) {
                $this->session->set_flashdata('error', trans("message_page_auth"));
                redirect(lang_base_url() . 'login');
            }
        }
    }

    public function error_404()
    {
        $data['title'] = "Error 404";
        $data['description'] = "Error 404";
        $data['keywords'] = "error,404";

        $this->load->view('partials/_header', $data);
        $this->load->view('errors/error_404');
        $this->load->view('partials/_footer');
    }


}
