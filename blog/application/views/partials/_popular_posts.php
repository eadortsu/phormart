<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--Partial: Popular Posts-->
<div class="widget-title widget-popular-posts-title">
    <h4 class="title"><?php echo html_escape(trans("popular_posts")); ?></h4>
</div>

<div class="col-sm-12 widget-body">
    <div class="row">
        <ul class="widget-list w-popular-list">

            <!--List  popular posts-->
            <?php foreach ($popular_posts as $item): ?>
                <li>
                    <a href="<?php echo lang_base_url() . 'post/' . html_escape($item->title_slug); ?>">
                        <img src="<?php echo $img_bg_sl; ?>" data-src="<?php echo base_url() . html_escape($item->image_slider); ?>" alt="<?php echo html_escape($item->title); ?>"
                             class="lazyload img-responsive" onerror="javascript:this.src='<?php echo $img_bg_sl; ?>'"/>
                    </a>
                    <h3 class="title">
                        <a href="<?php echo lang_base_url() . 'post/' . html_escape($item->title_slug); ?>">
                            <?php echo html_escape(character_limiter($item->title, 55, '...')); ?>
                        </a>
                    </h3>
                    <?php $this->load->view("partials/_post_meta.php", ['item' => $item]); ?>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
</div>