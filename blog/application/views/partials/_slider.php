<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- owl-carousel -->
<div class="owl-carousel" id="home-slider">
    <?php foreach ($slider_posts as $item) : ?>
        <?php $post_category = get_post_category($item); ?>
        <!-- slider item -->
        <div class="home-slider-item">
            <a href="<?php echo lang_base_url() . 'post/' . html_escape($item->title_slug); ?>">
                <img src="<?php echo $img_bg_sl; ?>" data-src="<?php echo base_url() . $item->image_slider; ?>" class="owl-lazy"
                     alt="<?php echo html_escape($item->title); ?>" onerror="javascript:this.src='<?php echo $img_bg_sl; ?>'">
                <div class="item-overlay"></div>
                <div class="item-info">
                    <a href="<?php echo lang_base_url(); ?>category/<?php echo html_escape($post_category['slug']); ?>">
                        <label class="label label-danger label-slider-category cursor-pointer">
                            <?php echo html_escape($post_category['name']); ?>
                        </label>
                    </a>
                    <h2 class="title">
                        <a href="<?php echo lang_base_url() . 'post/' . html_escape($item->title_slug); ?>">
                            <?php echo html_escape(character_limiter($item->title, 70, '...')); ?>
                        </a>
                    </h2>
                    <?php $this->load->view("partials/_post_meta.php", ['item' => $item]); ?>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div><!-- /.owl-carousel -->