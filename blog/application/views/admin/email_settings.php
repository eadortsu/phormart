<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-5 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('email_settings'); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('admin/email_settings_post'); ?>
            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('protocol'); ?></label>

                    <select name="mail_protocol" class="form-control">
                        <option value="smtp" <?php echo ($general_settings->mail_protocol == "smtp") ? "selected" : ""; ?>><?php echo trans('smtp'); ?></option>
                        <option value="mail" <?php echo ($general_settings->mail_protocol == "mail") ? "selected" : ""; ?>><?php echo trans('mail'); ?></option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control" name="mail_title"
                           placeholder="<?php echo trans('title'); ?>" value="<?php echo html_escape($general_settings->mail_title); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('host'); ?></label>
                    <input type="text" class="form-control" name="mail_host"
                           placeholder="<?php echo trans('host'); ?>" value="<?php echo html_escape($general_settings->mail_host); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('port'); ?></label>
                    <input type="text" class="form-control" name="mail_port"
                           placeholder="<?php echo trans('port'); ?>" value="<?php echo html_escape($general_settings->mail_port); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('username'); ?></label>
                    <input type="text" class="form-control" name="mail_username"
                           placeholder="<?php echo trans('username'); ?>" value="<?php echo html_escape($general_settings->mail_username); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('password'); ?></label>
                    <input type="password" class="form-control" name="mail_password"
                           placeholder="<?php echo trans('password'); ?>" value="<?php echo html_escape($general_settings->mail_password); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="callout" style="max-width: 500px;margin-top: 30px;">
                    <h4><?php echo trans('gmail_smtp'); ?></h4>

                    <p><strong><?php echo trans('host'); ?>:&nbsp;&nbsp;</strong>ssl://smtp.googlemail.com</p>
                    <p><strong><?php echo trans('port'); ?>:&nbsp;&nbsp;</strong>465</p>
                </div>

                <!-- /.box-body -->
                <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                    <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
                </div>
                <!-- /.box-footer -->

                <?php echo form_close(); ?><!-- form end -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <style>
        h4 {
            color: #0d6aad;
            font-weight: 600;
            margin-bottom: 15px;
            margin-top: 30px;
        }
    </style>