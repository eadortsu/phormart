<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="post-meta">
    <p class="post-meta-inner">
    <span>
        <a href="<?php echo lang_base_url(); ?>profile/<?php echo html_escape($item->user_slug); ?>">
        <?php echo html_escape($item->username); ?>
        </a>
    </span>
        <span>
        <i class="fa fa-calendar"></i>&nbsp;
            <?php echo helper_date_format($item->created_at); ?>
    </span>
        <?php if ($general_settings->comment_system == 1) : ?>
            <span>
        <i class="fa fa-comments"></i>&nbsp;
                <?php echo helper_get_comment_count($item->id); ?>
    </span>
        <?php endif; ?>
        <!--Show if enabled-->
        <?php if ($general_settings->show_pageviews == 1) : ?>
            <span>
        <i class="fa fa-eye"></i>&nbsp;
                <?php echo $item->hit; ?>
    </span>
        <?php endif; ?>
    </p>
</div>