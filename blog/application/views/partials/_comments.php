<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="comments-body">
    <ul class="comment-lists">

        <?php foreach ($comments as $item) : ?>
            <?php if (!is_null(get_user($item->user_id))) : ?>
                <li>
                    <div class="comment-left">
                        <?php if (!empty(get_user($item->user_id)->avatar)): ?>
                            <img src="<?php echo base_url() . html_escape(get_user($item->user_id)->avatar); ?>"
                                 alt="user" class="img-responsive">
                        <?php else: ?>
                            <img src="<?php echo base_url(); ?>assets/img/user.png" alt="user"
                                 class="img-responsive">
                        <?php endif; ?>
                    </div><!--/comment-left -->

                    <div class="comment-right">
                        <h5 class="user-name"><?php echo html_escape($item->username); ?></h5>
                        <p class="comment-text"><?php echo html_escape($item->comment); ?></p>
                        <div class="comment-meta">
                            <small class="comment-date"><?php echo helper_comment_date_format($item->created_at); ?></small>

                            <!--Check login-->
                            <?php if (auth_check()): ?>
                                <button class="btn-comment-reply"
                                        onclick="return showSubCommentBox('<?php echo $item->id; ?>');">
                                    <i class="fa fa-reply"></i>&nbsp;<?php echo html_escape(trans("reply")); ?>
                                </button>

                                <?php if (user()->id == $item->user_id): ?>
                                    <button type="button"
                                            onclick="deleteComment('<?php echo html_escape(trans("warning")); ?>',
                                                    '<?php echo html_escape(trans("confirm_comment")); ?>',
                                                    '<?php echo $item->id; ?>' );"
                                            class="btn-comment-delete">
                                        <i class="fa fa-trash"></i>&nbsp;<?php echo html_escape(trans("delete")); ?>
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>


                        <!-- make sub comment block -->
                        <div id="sub_comment_<?php echo $item->id; ?>"
                             class="col-sm-12 leave-reply-body leave-reply-sub-body">
                            <div class="row">
                                <div class="sub-comment-loader-container">
                                    <div class="loader"></div>
                                </div>
                                <!-- form make  sub comment -->
                                <form method="post">
                                    <input type="hidden" id="comment_parent_id_<?php echo $item->id; ?>"
                                           value="<?php echo $item->id; ?>">
                                    <div class="form-group">
                                    <textarea class="form-control" name="comment" id="comment_text_<?php echo $item->id; ?>"
                                              placeholder="<?php echo html_escape(trans("comment")); ?>"
                                              maxlength="4999" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" onclick="return makeSubComment('<?php echo $item->id; ?>')"
                                                class="btn btn-default pull-right btn-action">
                                            <?php echo html_escape(trans("submit")); ?>
                                        </button>
                                    </div>

                                </form><!-- form end -->
                            </div>
                        </div> <!--/make sub comment block -->

                        <!--Print sub comments-->
                        <?php foreach (helper_get_subcomments($item->id) as $sub_comment) : ?>
                            <?php if (!is_null(get_user($sub_comment->user_id))): ?>
                                <div class="item-sub-comment">
                                    <div class="subcomment-left">
                                        <?php if (!empty(get_user($sub_comment->user_id)->avatar)): ?>
                                            <img src="<?php echo base_url() . html_escape(get_user($sub_comment->user_id)->avatar); ?>"
                                                 alt="user" class="img-responsive">
                                        <?php else: ?>
                                            <img src="<?php echo base_url(); ?>assets/img/user.png" alt="user"
                                                 class="img-responsive">
                                        <?php endif; ?>
                                    </div><!--/comment-left -->

                                    <div class="subcomment-right">
                                        <h5 class="user-name"><?php echo html_escape($sub_comment->username); ?></h5>
                                        <p class="comment-text"><?php echo html_escape($sub_comment->comment); ?></p>
                                        <div class="comment-meta">
                                            <small class="comment-date"><?php echo helper_comment_date_format($sub_comment->created_at); ?></small>

                                            <?php if (auth_check()): ?>
                                                <?php if (user()->id == $sub_comment->user_id): ?>
                                                    <button type="button"
                                                            onclick="deleteComment('<?php echo html_escape(trans("warning")); ?>',
                                                                    '<?php echo html_escape(trans("confirm_comment")); ?>',
                                                                    '<?php echo $sub_comment->id; ?>' );"
                                                            class="btn-comment-delete">
                                                        <i class="fa fa-trash"></i>&nbsp;<?php echo html_escape(trans("delete")); ?>
                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div><!--/comment-right -->

                                </div><!--/row -->
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>


<?php if ($vr_comment_limit < get_post_comment_count($post_id)): ?>

    <!--Comment loader-->
    <div class="col-sm-12 comment-loader">
        <div class="row">
            <img src="<?php echo base_url(); ?>assets/img/loader.gif" alt="comments">
        </div>
    </div>

    <div class="col-sm-12 col-xs-12">
        <div class="row">
            <button class="btn btn-load-more-comments"  onclick="load_more_comments('<?php echo $post_id; ?>');">
                <?php echo trans("load_more_comments"); ?>
            </button>
        </div>
    </div>

<?php endif; ?>




