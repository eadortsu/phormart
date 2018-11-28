<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Start Footer Section -->
<footer id="footer">
    <div class="container">
        <div class="row footer-widgets">
            <!-- footer widget about-->
            <div class="col-sm-4 col-xs-12">
                <div class="footer-widget f-widget-about">
                    <div class="col-sm-12">
                        <div class="row">
                            <h4 class="title"><?php echo html_escape(trans("about")); ?></h4>
                            <div class="title-line"></div>
                            <p>
                                <?php echo html_escape($settings->about_footer); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-sm-4 -->

            <!-- footer widget random posts-->
            <div class="col-sm-4 col-xs-12">
                <!--Include footer random posts partial-->
                <?php $this->load->view('partials/_footer_random_posts'); ?>
            </div><!-- /.col-sm-4 -->

            <!-- footer widget follow us-->
            <div class="col-sm-4 col-xs-12">
                <div class="footer-widget f-widget-follow">
                    <div class="col-sm-12">
                        <div class="row">
                            <h4 class="title"><?php echo html_escape(trans("social_media")); ?></h4>
                            <div class="title-line"></div>
                            <ul>

                                <?php $this->load->view("partials/_social_links"); ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- newsletter -->
                <div class="newsletter col-sm-12">
                    <div class="row">
                        <p><?php echo html_escape(trans("newsletter_exp")); ?></p>
                        <?php echo form_open('home/add_to_newsletter'); ?>
                        <input type="email" name="email" id="newsletter_email" maxlength="199"
                               placeholder="<?php echo html_escape(trans("email")); ?>"
                               required <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>

                        <input type="submit" value="<?php echo html_escape(trans("subscribe")); ?>"
                               class="newsletter-button">

                        <?php echo form_close(); ?>
                    </div>
                    <div class="row">
                        <p id="newsletter">
                            <?php
                            if ($this->session->flashdata('news_error')):
                                echo '<span class="text-danger">' . $this->session->flashdata('news_error') . '</span>';
                            endif;

                            if ($this->session->flashdata('news_success')):
                                echo '<span class="text-success">' . $this->session->flashdata('news_success') . '</span>';
                            endif;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- .col-md-3 -->
        </div>
        <!-- .row -->

        <!-- Copyright -->
        <div class="footer-bottom">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-bottom-left">
                        <p><?php echo $settings->copyright; ?></p>
                    </div>

                    <div class="footer-bottom-right">
                        <ul class="nav-footer">
                            <?php foreach ($main_menu as $menu_item): ?>
                                <?php if ($menu_item['visibility'] == 1 && $menu_item['location'] == "footer"): ?>
                                    <li>
                                        <a href="<?php echo $menu_item['link']; ?>"><?php echo html_escape($menu_item['title']); ?> </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- .row -->
        </div>
    </div>
</footer>
<!-- End Footer Section -->

<!-- Scroll Up Link -->
<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
<!-- Bootstrap js -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Owl-carousel js -->
<script src="<?php echo base_url(); ?>assets/plugins/owl-carousel/owl.carousel.min.js"></script>
<!-- Lazy js -->
<script src="<?php echo base_url(); ?>assets/js/lazysizes.min.js"></script>
<!-- iCheck js -->
<script src="<?php echo base_url(); ?>assets/plugins/icheck/icheck.min.js"></script>
<!-- Jquery Confirm js -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-confirm/jquery-confirm.min.js"></script>
<!-- Gallery js -->
<script src="<?php echo base_url(); ?>assets/js/imagesloaded.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/masonry-3.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/masonry.filter.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>
<!-- Cookie js -->
<script src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
<!-- Theme js -->
<script src="<?php echo base_url(); ?>assets/js/script.min.js"></script>
<?php if (isset($page_type)):
    echo $general_settings->facebook_comment;
endif; ?>
</body>
</html>
