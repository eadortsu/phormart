<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_model extends CI_Model
{
    //upload image
    public function upload_image()
    {
        if (isset($_FILES['img_file_input'])) {
            $file = $_FILES['img_file_input'];

            if (!empty($file['name'])) {

                $data = array(
                    'image_big' => $this->upload_model->post_big_image_upload($file),
                    'image_mid' => $this->upload_model->post_mid_image_upload($file),
                    'image_small' => $this->upload_model->post_small_image_upload($file),
                    'image_slider' => $this->upload_model->post_slider_image_upload($file),
                );

                if (!empty($data["image_mid"])) {
                    $this->db->insert('images', $data);
                }
            }
        }
    }

    //get image
    public function get_image($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('images');
        return $query->row();
    }

    //get images
    public function get_images($count)
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit($count);
        $query = $this->db->get('images');
        return $query->result();
    }

    //get more images
    public function get_more_images($last_id, $limit)
    {
        $this->db->where('id <', $last_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('images');
        return $query->result();
    }

    //delete image
    public function delete_image($id)
    {
        $image = $this->get_image($id);

        if (!empty($image)) {
            //delete image from server
            delete_file_from_server($image->image_big);
            delete_file_from_server($image->image_mid);
            delete_file_from_server($image->image_small);
            delete_file_from_server($image->image_slider);

            $this->db->where('id', $id);
            $this->db->delete('images');
        }
    }

}