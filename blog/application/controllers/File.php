<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();

        //check auth
        if (!is_admin() && !is_author()) {
            redirect('login');
        }

        $this->file_count = 48;
        $this->file_per_page = 12;
    }

    /**
     * Select Image File
     */
    public function select_image_file()
    {
        $file_id = $this->input->post('file_id', true);

        $file = $this->file_model->get_image($file_id);
        if (!empty($file)) {
            echo base_url() . $file->image_mid;
        }
    }


    /**
     * Upload Image File
     */
    public function upload_image_file()
    {
        $this->file_model->upload_image();

        $images = $this->file_model->get_images($this->file_count);
        foreach ($images as $image):
            echo '<div class="col-sm-2 col-file-manager" id="img_col_id_' . $image->id . '">';
            echo '<div class="file-box" data-file-id="' . $image->id . '">';
            echo '<img src="' . base_url() . $image->image_mid . '" alt="" class="img-responsive">';
            echo '</div> </div>';
            $_SESSION["fm_last_img_id"] = $image->id;
        endforeach;
    }

    /**
     * Upload CKImage File
     */
    public function upload_ckimage_file()
    {
        $this->file_model->upload_image();

        $images = $this->file_model->get_images($this->file_count);

        foreach ($images as $image):
            echo '<div class="col-sm-2 col-file-manager" id="ckimg_col_id_' . $image->id . '">';
            echo '<div class="file-box" data-file-id="' . $image->id . '" data-file-path="' . $image->image_mid . '">';
            echo '<img src="' . base_url() . $image->image_mid . '" alt="" class="img-responsive">';
            echo '</div> </div>';
            $_SESSION["fm_last_ckimg_id"] = $image->id;
        endforeach;
    }

    /**
     * Laod More Images
     */
    public function load_more_images()
    {
        $images = $this->file_model->get_more_images($_SESSION["fm_last_img_id"], $this->file_per_page);

        foreach ($images as $image):
            echo '<div class="col-sm-2 col-file-manager" id="img_col_id_' . $image->id . '">';
            echo '<div class="file-box" data-file-id="' . $image->id . '">';
            echo '<img src="' . base_url() . $image->image_mid . '" alt="" class="img-responsive">';
            echo '</div> </div>';
            $_SESSION["fm_last_img_id"] = $image->id;
        endforeach;
    }


    /**
     * Laod More CKImages
     */
    public function load_more_ckimages()
    {
        $images = $this->file_model->get_more_images($_SESSION["fm_last_ckimg_id"], $this->file_per_page);

        foreach ($images as $image):
            echo '<div class="col-sm-2 col-file-manager" id="ckimg_col_id_' . $image->id . '">';
            echo '<div class="file-box" data-file-id="' . $image->id . '" data-file-path="' . $image->image_default . '">';
            echo '<img src="' . base_url() . $image->image_mid . '" alt="" class="img-responsive">';
            echo '</div> </div>';
            $_SESSION["fm_last_ckimg_id"] = $image->id;
        endforeach;
    }

    /**
     * Delete File
     */
    public function delete_image_file()
    {
        $file_id = $this->input->post('file_id', true);
        $this->file_model->delete_image($file_id);
    }


    /**
     * Delete CK File
     */
    public function delete_ckimage_file()
    {
        $file_id = $this->input->post('file_id', true);
        $this->file_model->delete_image($file_id);
    }

}
