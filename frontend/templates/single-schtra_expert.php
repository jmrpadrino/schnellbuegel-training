<?php get_header(); $prefix = 'schnell_'; the_post(); ?>
<style type="text/css" media="screen">
    body{font-family:'Nunito Sans',Helvetica,Arial,Lucida,sans-serif;font-size:100%;color:#666;font-weight:400;line-height:2em}a{text-decoration:none;color:#ce1719}.experten-content{position:relative;width:80%;max-width:1080px;margin:0 auto;padding:0 5%}.experten-detail{display:flex;flex-direction:row}.experten-profile{background-color:#f8f8f8;margin-right:3%;width:90%}.experten-img{display:block;float:none;width:auto;margin:0 0 12px;text-align:center}.experten-img img{max-width:100%;height:auto}.experten-kontakt{line-height:1.4em}.experten-kontakt h5{margin:0;color:#ce1719}.experten-number{margin-bottom:15px}.experten-kontakt a{color:#000;font-weight:800}.experten-description{width:100%}.experten-info{padding:20px}.experten-pdf{letter-spacing:1px;line-height:2em}.expeten-social-links{margin-top:20px;padding:0;list-style-type:none!important}.expeten-social-links li{display:inline-block;margin-right:15px}.expeten-social-links a{position:relative;color:#b2b2b2;font-size:20px;text-align:center;text-decoration:none;font-weight:400;transition:color .3s ease 0s}.expeten-social-links li a:hover{color:#ce1719}.expeten-social-links span{display:none}.experten-mail .fa.fa-envelope,.experten-number .fa.fa-phone{color:#fff;background-color:#ce1719}.experten-number .fa.fa-phone{padding:8px 10px}.circle-icon-bg{padding:8px;-webkit-border-radius:32px;-moz-border-radius:32px;border-radius:32px;font-size:12px}
</style>
<body>
    <div class="experten-content">
        <div class="experten-detail">
            <?php do_action('schnell_before_expert_profile') ?>
            <div class="experten-profile">
                <div class="experten-img">
                    <?php
                        if ( has_post_thumbnail() ){
                            the_post_thumbnail();
                        }else{
                            echo '<img src="'.SCHNELL_PLUGIN_URI.'/frontend/images/no-pic-expert-profile.png" alt="'.esc_html('Export no pic','schnell').'">';
                        }
                    ?>

                </div>
                <div class="experten-info">
                    <div class="experten-pdf">
                        <a href="<?= get_post_meta( get_the_ID(), $prefix . 'pdf', true) ?>">Trainerprofil als PDF</a>
                    </div>
                    <ul class="expeten-social-links">
                        <li><a href="<?= get_post_meta( get_the_ID(), $prefix . 'facebook', true) ?>"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="<?= get_post_meta( get_the_ID(), $prefix . 'linkedin', true) ?>"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="<?= get_post_meta( get_the_ID(), $prefix . 'xing', true) ?>"><i class="fab fa-xing"></i></a></li>
                        <li><a href="mailto:<?= get_post_meta( get_the_ID(), $prefix . 'mail', true) ?>"><i class="far fa-envelope"></i></a></li>
                    </ul>
                </div>
            </div>
            <?php do_action('schnell_after_expert_profile') ?>
            <?php do_action('schnell_before_expert_description') ?>
            <div class="experten-description">
                <div class="experten-name">
                    <h2><?= the_title() ?></h2>
                </div>
                <div class="experten-kontakt">
                    <div>
                        <h5><?= _e('Contact', 'schnell') ?></h5>
                    </div>
                    <div class="experten-number">
                        <i class="fa fa-phone circle-icon-bg" aria-hidden="true"></i>
                        <a href="tel:+<?= preg_replace('/[^A-Za-z0-9\-]/', '', get_post_meta( get_the_ID(), $prefix . 'phone', true)) ?>"><?= get_post_meta( get_the_ID(), $prefix . 'phone', true) ?></a>
                    </div>
                    <div class="experten-mail">
                        <i class="fa fa-envelope circle-icon-bg" aria-hidden="true"></i>
                        <a href="mailto:<?= get_post_meta( get_the_ID(), $prefix . 'mail', true) ?>?subject=feedback"><?= get_post_meta( get_the_ID(), $prefix . 'mail', true) ?></a>
                    </div>
                </div>
                <div class="experten-summary">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php do_action('schnell_after_expert_description') ?>
        </div>
        <?php do_action('schnell_before_expert_curriculum') ?>
        <div class="experten-curriculum">
            <?= get_post_meta( get_the_ID(), $prefix . 'curriculum', true) ?>
        </div>
        <?php do_action('schnell_before_expert_curriculum') ?>
    </div>
<?php

get_footer();
