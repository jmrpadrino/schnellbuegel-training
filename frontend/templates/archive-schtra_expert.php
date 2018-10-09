<?php get_header(); $prefix = 'schnell_';?>
<style>
    body{font-family:'Nunito Sans',Helvetica,Arial,Lucida,sans-serif;font-size:.9rem;color:#666;font-weight:400;line-height:140%}.event-description .event-name,.event-headline,.event-location .place{font-weight:700}a{text-decoration:none}.event-description:nth-child(even){background-color:#fff}.event-description:nth-child(odd){background-color:#f8f8f8}.events-search{padding-bottom:15px}.events-search select{padding:5px 40px 5px 5px;margin-bottom:5px;border-radius:0;border-color:#a9a9a9}.events-search input[type=submit]{line-height:31px;margin-bottom:5px;color:#fff;display:inline-block;padding:0 15px;text-decoration:none;cursor:pointer;position:relative;width:auto;font-size:.9rem;border:0;background-color:#ce1719}.event-button .button:hover,.events-search input[type=submit]:hover{background-color:#fff;color:#ce1719}.event-headline{background:#606060;color:#fff;font-size:1.2rem;padding:10px;text-align:center}.event-button,.event-detail,.event-time{padding:5px}.event-time{color:#ce171a;width:25%}.event-detail a{color:#ce1719}.event-trainer{font-style:italic}.event-button .button{line-height:30px;line-height:1.667rem;font-size:.9rem;padding:0 35px 0 15px;display:inline-block;margin-bottom:5px;background-color:#ce1719;color:#fff}.event-location{font-size:.75rem}.events-content{max-width:1080px;margin:0 auto;padding:0 5%}.event-description{display:flex;flex-direction:row;padding:5px 0}.event-detail{width:55%}.event-button{display:flex;flex-direction:column}
</style>
<div id="main-content">
    <div class="container">
        <div id="content-area" class="clearfix">
            <div class="events-content">
                <?php if( have_posts() ){ $month = 0;?>
                <!-- objeto bucle principal -->
                <?php while (have_posts() ){ the_post(); ?>                
                <!-- objeto bucle posts -->
                <div class="et_pb_column et_pb_column_1_4 et_pb_column_18    et_pb_css_mix_blend_mode_passthrough">
                    <div class="et_pb_module et_pb_team_member et_pb_team_member_1 et_pb_bg_layout_light clearfix et_pb_text_align_left">
                        <div class="et_pb_team_member_image et-waypoint et_pb_animation_off">
                            <?php
                                if ( has_post_thumbnail() ){
                                    the_post_thumbnail();
                                }else{
                                    echo '<img src="'.SCHNELL_PLUGIN_URI.'/frontend/images/no-pic-expert-profile.png" alt="'.esc_html('Export no pic','schnell').'">';
                                }
                            ?>
                        </div>
                        <div class="et_pb_team_member_description">
                            <h4 class="et_pb_module_header"><?= the_title() ?></h4>

                            <div class="link-expert-profile"><a href="<?= get_post_permalink( get_the_ID() ) ?>"><?= _e('Zum Profil', 'schnell') ?></a></div>
                            <p style="text-align: right;">
                            <ul class="et_pb_member_social_links">
                                <li><a href="<?= get_post_meta( get_the_ID(), $prefix . 'facebook', true) ?>"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="<?= get_post_meta( get_the_ID(), $prefix . 'linkedin', true) ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="<?= get_post_meta( get_the_ID(), $prefix . 'xing', true) ?>"><i class="fab fa-xing"></i></a></li>
                                <li><a href="mailto:<?= get_post_meta( get_the_ID(), $prefix . 'mail', true) ?>"><i class="far fa-envelope"></i></a></li>
                            </ul>
                        </div>
                        <!-- .et_pb_team_member_description -->
                    </div>
                    <!-- .et_pb_team_member -->
                </div>
                <!-- -->
                <?php } // END WHILE
                     the_posts_pagination( 
                         array(
                             'mid_size'  => 2,
                             'prev_text' => __( 'Back', 'textdomain' ),
                             'next_text' => __( 'Onward', 'textdomain' ),
                         )
                     );
                    }else{ 
                ?>
                <div class="events-months-content">
                    <p><?= _e('There is no events published yet','schnell') ?></p>
                </div>
                <?php } // END IF ?>
                <!-- -->
            </div>
        </div> <!-- #content-area -->
    </div> <!-- .container -->
</div> <!-- #main-content -->
<?php

get_footer();
