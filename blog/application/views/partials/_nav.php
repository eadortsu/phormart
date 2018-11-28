<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$active_page = uri_string();
if ($general_settings->site_lang != $selected_lang->id) {
    $active_page= $this->uri->segment(2);
}?>
<!--navigation-->
<div class="nav-desktop">
    <div class="collapse navbar-collapse navbar-left">
        <ul class="nav navbar-nav">
            <li class="">
                <a href="../">
                    <?php echo trans("home"); ?>
                </a>
            </li>
			<li class="<?php echo ($active_page == 'index' || $active_page == "") ? 'active' : ''; ?>">
                <a href="<?php echo lang_base_url(); ?>">
                   Blog
                </a>
            </li>
            <?php $total_item = 0; ?>
            <?php $menu_item_count = 1; ?>
            <?php foreach ($main_menu as $menu_item): ?>
                <?php if ($menu_item['visibility'] == 1 && $menu_item['location'] == "header" && $menu_item['parent_id'] == "0"): ?>
                    <?php if ($menu_item_count <= $general_settings->menu_limit && $menu_item['visibility'] == 1 && $menu_item['location'] == "header" && $menu_item['parent_id'] == "0"): ?>
                        <?php $sub_links = helper_get_sub_menu_links($menu_item['id'], $menu_item['type']); ?>
                        <?php if (!empty($sub_links)): ?>
                            <li class="dropdown <?php echo ($active_page == 'category/' . $menu_item['slug'] ||
                                $active_page == $menu_item['slug'] || ($active_page == "" && $menu_item['slug'] == "index")) ? 'active' : ''; ?>">
                                <a class="dropdown-toggle disabled" data-toggle="dropdown"
                                   href="<?php echo $menu_item['link']; ?>">
                                    <?php echo html_escape($menu_item['title']); ?>
                                    <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu-cnt">
                                    <ul class="dropdown-menu top-dropdown">
                                        <?php foreach ($sub_links as $sub_item): ?>
                                            <?php if ($sub_item["visibility"] == 1): ?>
                                                <li>
                                                    <a role="menuitem" href="<?php echo $sub_item['link']; ?>">
                                                        <?php echo html_escape($sub_item['title']); ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="<?php echo ($active_page == 'category/' . $menu_item['slug'] ||
                                $active_page == $menu_item['slug'] || ($active_page == "" && $menu_item['slug'] == "index")) ? 'active' : ''; ?>">
                                <a href="<?php echo $menu_item['link']; ?>">
                                    <?php echo html_escape($menu_item['title']); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php $menu_item_count++; ?>
                    <?php endif; ?>
                    <?php $total_item++; ?>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if ($total_item > $general_settings->menu_limit): ?>
                <li class="dropdown">
                    <a class="dropdown-toggle dropdown-more" data-toggle="dropdown" href="#">
                        <i class="fa fa-ellipsis-h more-sign"></i>
                    </a>
                    <div class="dropdown-menu-cnt-more">
                        <ul class="dropdown-menu top-dropdown">
                            <?php $menu_item_count = 1; ?>
                            <?php foreach ($main_menu as $menu_item): ?>
                                <?php if ($menu_item['visibility'] == 1 && $menu_item['location'] == "header" && $menu_item['parent_id'] == "0"): ?>
                                    <?php if ($menu_item_count > $general_settings->menu_limit): ?>
                                        <?php $sub_links = helper_get_sub_menu_links($menu_item['id'], $menu_item['type']); ?>
                                        <?php if (!empty($sub_links)): ?>
                                            <li class="li-sub-dropdown">
                                                <a class="dropdown-toggle disabled" data-toggle="dropdown"
                                                   href="<?php echo $menu_item['link']; ?>">
                                                    <?php echo html_escape($menu_item['title']); ?> <span
                                                            class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu sub-dropdown">
                                                    <?php foreach ($sub_links as $sub_item): ?>
                                                        <?php if ($sub_item["visibility"] == 1): ?>
                                                            <li>
                                                                <a role="menuitem" href="<?php echo $sub_item['link']; ?>">
                                                                    <?php echo html_escape($sub_item['title']); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <a href="<?php echo $menu_item['link']; ?>">
                                                    <?php echo html_escape($menu_item['title']); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php $menu_item_count++; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
        </ul>

        <ul class="nav navbar-nav nav-right">
            <?php if (auth_check()) : ?>
                <li class="dropdown profile-dropdown nav-item-right">
                    <a href="#" class="dropdown-toggle image-profile-drop" data-toggle="dropdown"
                       aria-expanded="false">
                        <?php if (!empty(user()->avatar)) : ?>
                            <img src="<?php echo base_url() . user()->avatar; ?>"
                                 alt="<?php echo html_escape(user()->username); ?>">
                        <?php else : ?>
                            <img src="<?php echo base_url(); ?>assets/img/user.png"
                                 alt="<?php echo html_escape(user()->username); ?>">
                        <?php endif; ?>
                        <?php echo html_escape(character_limiter(user()->username, 20, '...')); ?>&nbsp;<i
                                class="caret"></i>
                    </a>
                    <div class="dropdown-menu-cnt">
                        <ul class="dropdown-menu top-dropdown">
                            <?php if (is_admin() || is_author()): ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin">
                                        <i class="fa fa-cog"></i>&nbsp;
                                        <?php echo html_escape(trans("admin_panel")); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo lang_base_url(); ?>profile/<?php echo user()->slug; ?>">
                                        <i class="fa fa-bars"></i>&nbsp;
                                        <?php echo html_escape(trans("my_posts")); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo lang_base_url(); ?>reading-list">
                                    <i class="fa fa-star"></i>&nbsp;
                                    <?php echo html_escape(trans("reading_list")); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo lang_base_url(); ?>profile-update">
                                    <i class="fa fa-user"></i>&nbsp;
                                    <?php echo html_escape(trans("update_profile")); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo lang_base_url(); ?>change-password">
                                    <i class="fa fa-lock"></i>&nbsp;
                                    <?php echo html_escape(trans("change_password")); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo lang_base_url(); ?>logout"
                                   onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>&nbsp;
                                    <?php echo html_escape(trans("logout")); ?>
                                </a>

                                <?php echo form_open('logout', array('id' => 'logout-form', 'class' => 'hidden', 'method' => 'get')); ?>
                                <?php echo form_close(); ?>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php else : ?>
                <?php if ($general_settings->registration_system == 1): ?>
                    <li class="nav-item-right <?php echo ($active_page == 'login') ? 'active' : ''; ?>">
                        <a href="<?php echo lang_base_url(); ?>login">
                            <?php echo html_escape(trans("login")); ?>
                        </a>
                    </li>
                    <li class="nav-item-right <?php echo ($active_page == 'register') ? 'active' : ''; ?>">
                        <a href="<?php echo lang_base_url(); ?>register">
                            <?php echo html_escape(trans("register")); ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <li class="nav-item-right">
                <a href="#" data-toggle="modal-search" class="search-icon"><i class="fa fa-search"></i></a>
            </li>

            <?php if ($general_settings->multilingual_system == 1): ?>
                <li class="dropdown nav-item-right">
                    <a href="#" class="dropdown-toggle image-profile-drop" data-toggle="dropdown"
                       aria-expanded="false">
                        <?php echo html_escape($selected_lang->short_form); ?> <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu-cnt">
                        <ul class="dropdown-menu top-dropdown dropdown-lang">
                            <?php
                            foreach ($languages as $language):
                                $lang_url = base_url() . $language->short_form . "/";
                                if ($language->id == $this->general_settings->site_lang) {
                                    $lang_url = base_url();
                                } ?>
                                <li>
                                    <a href="<?php echo $lang_url; ?>" class="<?php echo ($language->id == $selected_lang->id) ? 'selected' : ''; ?> ">
                                        <?php echo $language->short_form; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<!--navigation-->
<div class="nav-mobile">
    <div class="collapse navbar-collapse navbar-left">
        <div class="row">
            <ul class="nav navbar-nav">
                <li class="<?php echo ($active_page == 'index' || $active_page == "") ? 'active' : ''; ?>">
                    <a href="<?php echo lang_base_url(); ?>">
                        <?php echo trans("home"); ?>
                    </a>
                </li>
                <?php foreach ($main_menu as $menu_item): ?>
                    <?php if ($menu_item['visibility'] == 1 && $menu_item['parent_id'] == "0" && ($menu_item['location'] == "header" || $menu_item['location'] == "footer")): ?>

                        <?php $sub_links = helper_get_sub_menu_links($menu_item['id'], $menu_item['type']); ?>

                        <?php if (!empty($sub_links)): ?>

                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $menu_item['link']; ?>">
                                    <?php echo html_escape($menu_item['title']); ?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if ($menu_item['type'] == "category"): ?>
                                        <li>
                                            <a role="menuitem" href="<?php echo $menu_item['link']; ?>">
                                                <?php echo trans("all"); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php foreach ($sub_links as $sub_item): ?>
                                        <?php if ($sub_item["visibility"] == 1): ?>
                                            <li>
                                                <a role="menuitem" href="<?php echo $sub_item['link']; ?>">
                                                    <?php echo html_escape($sub_item['title']); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </ul>
                            </li>

                        <?php else: ?>
                            <li>
                                <a href="<?php echo $menu_item['link']; ?>">
                                    <?php echo html_escape($menu_item['title']); ?>
                                </a>
                            </li>
                        <?php endif; ?>

                    <?php endif; ?>
                <?php endforeach; ?>


                <?php if (auth_check()) : ?>
                    <li class="dropdown profile-dropdown nav-item-right">
                        <a href="#" class="dropdown-toggle image-profile-drop" data-toggle="dropdown"
                           aria-expanded="false">
                            <?php if (!empty(user()->avatar)) : ?>
                                <img src="<?php echo base_url() . user()->avatar; ?>"
                                     alt="<?php echo html_escape(user()->username); ?>">
                            <?php else : ?>
                                <img src="<?php echo base_url(); ?>assets/img/user.png"
                                     alt="<?php echo html_escape(user()->username); ?>">
                            <?php endif; ?>
                            <?php echo html_escape(character_limiter(user()->username, 20, '...')); ?>&nbsp;<i
                                    class="caret"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <?php if (is_admin() || is_author()): ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin">
                                        <i class="fa fa-cog"></i>&nbsp;
                                        <?php echo html_escape(trans("admin_panel")); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo lang_base_url(); ?>profile/<?php echo user()->slug; ?>">
                                        <i class="fa fa-bars"></i>&nbsp;
                                        <?php echo html_escape(trans("my_posts")); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo lang_base_url(); ?>reading-list">
                                    <i class="fa fa-star"></i>&nbsp;
                                    <?php echo html_escape(trans("reading_list")); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo lang_base_url(); ?>profile-update">
                                    <i class="fa fa-user"></i>&nbsp;
                                    <?php echo html_escape(trans("update_profile")); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo lang_base_url(); ?>change-password">
                                    <i class="fa fa-lock"></i>&nbsp;
                                    <?php echo html_escape(trans("change_password")); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo lang_base_url(); ?>logout"
                                   onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>&nbsp;
                                    <?php echo html_escape(trans("logout")); ?>
                                </a>

                                <?php echo form_open('logout', array('id' => 'logout-form', 'class' => 'hidden', 'method' => 'get')); ?>
                                <?php echo form_close(); ?>
                            </li>
                        </ul>
                    </li>
                <?php else : ?>
                    <?php if ($general_settings->registration_system == 1): ?>
                        <li class="nav-item-right <?php echo ($active_page == 'login') ? 'active' : ''; ?>">
                            <a href="<?php echo lang_base_url(); ?>login">
                                <?php echo html_escape(trans("login")); ?>
                            </a>
                        </li>
                        <li class="nav-item-right <?php echo ($active_page == 'register') ? 'active' : ''; ?>">
                            <a href="<?php echo lang_base_url(); ?>register">
                                <?php echo html_escape(trans("register")); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($general_settings->multilingual_system == 1): ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <?php echo html_escape($selected_lang->short_form); ?> <span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-lang">
                            <?php
                            foreach ($languages as $language):
                                $lang_url = base_url() . $language->short_form . "/";
                                if ($language->id == $this->general_settings->site_lang) {
                                    $lang_url = base_url();
                                } ?>
                                <li>
                                    <a href="<?php echo $lang_url; ?>" class="<?php echo ($language->id == $selected_lang->id) ? 'selected' : ''; ?> ">
                                        <?php echo $language->short_form; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
