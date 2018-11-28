<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_post extends Admin_Core_Controller
{

    public function __construct()
    {
        parent::__construct();

        //check auth
        if (!is_admin() && !is_author()) {
            redirect('login');
        }
    }


    /**
     * Add Post
     */
    public function add_post()
    {
        $data['title'] = trans("add_post");
        $data['top_categories'] = $this->category_model->get_categories();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/add_post', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Post Post
     */
    public function add_post_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');
        $this->form_validation->set_rules('summary', trans("summary"), 'xss_clean|max_length[5000]');
        $this->form_validation->set_rules('category_id', trans("category"), 'required');
        $this->form_validation->set_rules('optional_url', trans("optional_url"), 'xss_clean|max_length[1000]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->post_admin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //if post added
            if ($this->post_admin_model->add_post()) {
                //last id
                $last_id = $this->db->insert_id();
                //update slug
                $this->post_admin_model->update_slug($last_id);
                //insert post tags
                $this->tag_model->add_post_tags($last_id);

                $this->post_file_model->add_post_additional_images($last_id);

                $this->session->set_flashdata('success', trans("post") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->post_admin_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Posts
     */
    public function posts()
    {
        $data['title'] = trans('posts');
        $data['authors'] = $this->auth_model->get_authors();
        $data['form_action'] = "admin_post/posts";
        $data['list_type'] = "posts";
        //get paginated posts
        $pagination = $this->paginate(base_url() . 'admin_post/posts', $this->post_admin_model->get_paginated_posts_count('posts'));
        $data['posts'] = $this->post_admin_model->get_paginated_posts($pagination['per_page'], $pagination['offset'], 'posts');

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/posts', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Slider Posts
     */
    public function slider_posts()
    {
        prevent_author();

        $data['title'] = trans('slider_posts');
        $data['authors'] = $this->auth_model->get_authors();
        $data['form_action'] = "admin_post/slider_posts";
        $data['list_type'] = "slider_posts";

        //get paginated posts
        $pagination = $this->paginate(base_url() . 'admin_post/slider_posts', $this->post_admin_model->get_paginated_posts_count('slider_posts'));
        $data['posts'] = $this->post_admin_model->get_paginated_posts($pagination['per_page'], $pagination['offset'], 'slider_posts');

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/posts', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Our Picks
     */
    public function our_picks()
    {
        prevent_author();

        $data['title'] = trans('our_picks');
        $data['authors'] = $this->auth_model->get_authors();
        $data['form_action'] = "admin_post/our_picks";
        $data['list_type'] = "our_picks";

        //get paginated posts
        $pagination = $this->paginate(base_url() . 'admin_post/our_picks', $this->post_admin_model->get_paginated_posts_count('our_picks'));
        $data['posts'] = $this->post_admin_model->get_paginated_posts($pagination['per_page'], $pagination['offset'], 'our_picks');

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/posts', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Pending Posts
     */
    public function pending_posts()
    {
        $data['title'] = trans('pending_posts');
        $data['authors'] = $this->auth_model->get_authors();
        $data['form_action'] = "admin_post/pending_posts";
        $data['list_type'] = "pending_posts";

        //get paginated posts
        $pagination = $this->paginate(base_url() . 'admin_post/pending_posts', $this->post_admin_model->get_paginated_pending_posts_count());
        $data['posts'] = $this->post_admin_model->get_paginated_pending_posts($pagination['per_page'], $pagination['offset']);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/pending_posts', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Drafts
     */
    public function drafts()
    {
        $data['title'] = trans('drafts');
        $data['authors'] = $this->auth_model->get_authors();
        $data['form_action'] = "admin_post/drafts";

        //get paginated posts
        $pagination = $this->paginate(base_url() . 'admin_post/drafts', $this->post_admin_model->get_paginated_drafts_count());
        $data['posts'] = $this->post_admin_model->get_paginated_drafts($pagination['per_page'], $pagination['offset']);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/drafts', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Post
     */
    public function update_post($id)
    {
        $data['title'] = trans("update_post");

        //get post
        $data['post'] = $this->post_admin_model->get_post($id);

        if (empty($data['post'])) {
            redirect($this->agent->referrer());
        }

        //check if author
        if (is_author()) {
            //check owner
            if ($data['post']->user_id != user()->id):
                redirect("admin");
            endif;
        }

        //combine post tags
        $tags = "";
        $count = 0;
        $tags_array = $this->tag_model->get_post_tags($id);
        foreach ($tags_array as $item) {
            if ($count > 0) {
                $tags .= ",";
            }
            $tags .= $item->tag;
            $count++;
        }

        $data['tags'] = $tags;
        $data['post_images'] = $this->post_file_model->get_post_additional_images($id);
        $data['categories'] = $this->category_model->get_categories_by_lang($data['post']->lang_id);
        $data['subcategories'] = $this->category_model->get_subcategories_by_parent_id($data['post']->category_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/update_post', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Post Post
     */
    public function update_post_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');
        $this->form_validation->set_rules('summary', trans("summary"), 'xss_clean|max_length[5000]');
        $this->form_validation->set_rules('category_id', trans("category"), 'required');
        $this->form_validation->set_rules('optional_url', trans("optional_url"), 'xss_clean|max_length[1000]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->post_admin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //post id
            $post_id = $this->input->post('id', true);

            if ($this->post_admin_model->update_post($post_id)) {

                //update slug
                $this->post_admin_model->update_slug($post_id);

                //update post tags
                $this->tag_model->update_post_tags($post_id);

                $this->post_file_model->add_post_additional_images($post_id);

                $this->session->set_flashdata('success', trans("post") . " " . trans("msg_suc_updated"));

                $referrer = $this->input->post("referrer");
                if (!empty($referrer)) {
                    redirect($referrer);
                } else {
                    redirect('admin_post/posts');
                }

            } else {
                $this->session->set_flashdata('form_data', $this->post_admin_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Post Options Post
     */
    public function post_options_post()
    {
        $option = $this->input->post('option', true);
        $id = $this->input->post('id', true);

        $data["post"] = $this->post_admin_model->get_post($id);

        //check if exists
        if (empty($data['post'])) {
            redirect($this->agent->referrer());
        }

        //if option add remove from slider
        if ($option == 'add-remove-from-slider') {

            $result = $this->post_admin_model->post_add_remove_slider($id);

            if ($result == "removed") {
                $this->session->set_flashdata('success', trans("msg_remove_slider"));
                redirect($this->agent->referrer());
            }
            if ($result == "added") {
                $this->session->set_flashdata('success', trans("msg_add_slider"));
                redirect($this->agent->referrer());
            }

        }

        //if option add remove from picked
        if ($option == 'add-remove-from-picked') {

            $result = $this->post_admin_model->post_add_remove_picked($id);

            if ($result == "removed") {
                $this->session->set_flashdata('success', trans("msg_remove_recommended"));
                redirect($this->agent->referrer());
            }
            if ($result == "added") {
                $this->session->set_flashdata('success', trans("msg_add_recommended"));
                redirect($this->agent->referrer());
            }
        }


        //if option approve
        if ($option == 'approve') {
            if (is_admin()):
                if ($this->post_admin_model->approve_post($id)) {
                    $this->session->set_flashdata('success', trans("msg_post_approved"));
                } else {
                    $this->session->set_flashdata('error', trans("msg_error"));
                }
            endif;
            redirect($this->agent->referrer());
        }

        //if option publish
        if ($option == 'publish') {

            if ($this->post_admin_model->publish_post($id)) {
                $this->session->set_flashdata('success', trans("msg_published"));
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }

            redirect($this->agent->referrer());
        }

        //if option publish draft
        if ($option == 'publish_draft') {

            if ($this->post_admin_model->publish_draft($id)) {
                $this->session->set_flashdata('success', trans("msg_published"));
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }

            redirect($this->agent->referrer());
        }

        //if option delete
        if ($option == 'delete') {

            if ($this->post_admin_model->delete_post($id)) {
                //delete post tags
                $this->tag_model->delete_post_tags($id);

                $this->session->set_flashdata('success', trans("post") . " " . trans("msg_suc_deleted"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }

        }
    }

    /**
     * Delete Selected Posts
     */
    public function delete_selected_posts()
    {
        $post_ids = $this->input->post('post_ids', true);
        $this->post_admin_model->delete_multi_posts($post_ids);
    }


    /**
     * Save Home Slider Post Order
     */
    public function home_slider_posts_order_post()
    {
        $post_id = $this->input->post('id', true);
        $order = $this->input->post('slider_order', true);
        $this->post_admin_model->save_home_slider_post_order($post_id, $order);
        redirect($this->agent->referrer());
    }


    /**
     * Delete Additional Image
     */
    public function delete_post_additional_image()
    {
        $file_id = $this->input->post('file_id', true);
        $this->post_file_model->delete_post_additional_image($file_id);
    }


    public function set_pagination_per_page($count)
    {
        $_SESSION['pagination_per_page'] = $count;
        redirect($this->agent->referrer());
    }
}
