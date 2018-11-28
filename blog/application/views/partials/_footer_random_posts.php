<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--Partial: Footer Random Posts-->
<div class="footer-widget f-widget-random">
    <div class="col-sm-12">
        <div class="row">
            <h4 class="title"><?php echo html_escape(trans("random_posts")); ?></h4>
            <div class="title-line"></div>
            <ul class="f-random-list">

                <!--List random posts-->
                <?php foreach($footer_random_posts as $item):?>
                    <li>
                        <a href="<?php echo lang_base_url() . 'post/' . html_escape($item->title_slug); ?>">
                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo base_url() . html_escape($item->image_small); ?>" alt="<?php echo html_escape($item->title); ?>" class="lazyload img-responsive"/>
                        </a>

                        <h5 class="title">
                            <a href="<?php echo lang_base_url() . 'post/' . html_escape($item->title_slug); ?>">
                                <?php echo html_escape(character_limiter($item->title, 55, '...')); ?>
                            </a>
                        </h5>
                    </li>
              <?php endforeach; ?>

            </ul>
        </div>
    </div>
</div>
