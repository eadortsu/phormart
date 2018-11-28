<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_file_model extends CI_Model
{
    //add post additional images
    public function add_post_additional_images($post_id)
    {
        $image_ids = $this->input->post('additional_post_image_id', true);

        if (!empty($image_ids)) {
            foreach ($image_ids as $image_id) {
                $image = $this->file_model->get_image($image_id);

                if (!empty($image)) {
                    $item = array(
                        'post_id' => $post_id,
                        'image_path' => $image->image_big,
                    );

                    if (!empty($item["image_path"])) {
                        $this->db->insert('post_images', $item);
                    }
                }
            }
        }
    }

    //delete additional image
    public function delete_post_additional_image($file_id)
    {
        $image = $this->get_post_additional_image($file_id);

        if (!empty($image)) {
            $this->db->where('id', $file_id);
            $this->db->delete('post_images');
        }
    }

    //delete additional images
    public function delete_post_additional_images($post_id)
    {
        $images = $this->get_post_additional_images($post_id);

        if (!empty($images)):
            foreach ($images as $image) {
                $this->db->where('id', $image->id);
                $this->db->delete('post_images');
            }
        endif;
    }

    //get post additional images
    public function get_post_additional_images($post_id)
    {
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('post_images');
        return $query->result();
    }

    //get post additional image
    public function get_post_additional_image($file_id)
    {
        $this->db->where('id', $file_id);
        $query = $this->db->get('post_images');
        return $query->row();
    }

    //get post additional image count
    public function get_post_additional_image_count($post_id)
    {
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('post_images');
        return $query->num_rows();
    }


    //delete post main image
    public function delete_post_main_image($post_id)
    {
        $post = $this->post_admin_model->get_post($post_id);

        if (!empty($post)) {
            $data = array(
                'image_big' => "",
                'image_slider' => "",
                'image_mid' => "",
                'image_small' => "",
            );

            $this->db->where('id', $post_id);
            $this->db->update('posts', $data);
        }
    }

}