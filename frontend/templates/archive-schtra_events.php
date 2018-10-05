<?php get_header(); $prefix = 'schnell_';?>
<style>
    body{font-family:'Nunito Sans',Helvetica,Arial,Lucida,sans-serif;font-size:.9rem;color:#666;font-weight:400;line-height:140%}.event-description .event-name,.event-headline,.event-location .place{font-weight:700}a{text-decoration:none}.event-description:nth-child(even){background-color:#fff}.event-description:nth-child(odd){background-color:#f8f8f8}.events-search{padding-bottom:15px}.events-search select{padding:5px 40px 5px 5px;margin-bottom:5px;border-radius:0;border-color:#a9a9a9}.events-search input[type=submit]{line-height:31px;margin-bottom:5px;color:#fff;display:inline-block;padding:0 15px;text-decoration:none;cursor:pointer;position:relative;width:auto;font-size:.9rem;border:0;background-color:#ce1719}.event-button .button:hover,.events-search input[type=submit]:hover{background-color:#fff;color:#ce1719}.event-headline{background:#606060;color:#fff;font-size:1.2rem;padding:10px;text-align:center}.event-button,.event-detail,.event-time{padding:5px}.event-time{color:#ce171a;width:25%}.event-detail a{color:#ce1719}.event-trainer{font-style:italic}.event-button .button{line-height:30px;line-height:1.667rem;font-size:.9rem;padding:0 35px 0 15px;display:inline-block;margin-bottom:5px;background-color:#ce1719;color:#fff}.event-location{font-size:.75rem}.events-content{max-width:1080px;margin:0 auto;padding:0 5%}.event-description{display:flex;flex-direction:row;padding:5px 0}.event-detail{width:55%}.event-button{display:flex;flex-direction:column}
</style>
<div id="main-content">
    <div class="container">
        <div id="content-area" class="clearfix">
            <div class="events-content">
                VIENE DEL PLUGIN
                <?php if( have_posts() ){ $month = 0;?>
                <div class="events-search">
                    <select name="tx_webxseminar_calendar[trainer]"><option value="">alle Trainer</option>
                        <option value="">MANFRED SCHNELLBÜGEL</option>
                        <option value="">BIRGIT SCHULER</option>
                        <option value="">FRANK NEGRETTI</option>
                        <option value="">FRANK NEGRETTI</option>
                        <option value="">GABRIELE KURZ</option>
                        <option value="">THOMAS KURZ</option>
                        <option value="">ANTJE KLIMEK</option>
                    </select>
                    <select name="tx_webxseminar_calendar[product]"><option value="">alle Seminare</option>
                        <option value="">Mein Unternehmensaufbau als Coach!</option>
                        <option value="">Reich beschenkt durch die Konflikte meines Lebens!</option>
                        <option value="">Resilienz meets Innovation</option>
                        <option value="">Team Coaching</option>
                        <option value="">Wahrnehmende Pädagogik</option>
                        <option value="">Wahrnehmende Pflege und Betreuung</option>
                        <option value="">web-crossing Testseminar</option>
                    </select>
                    <input type="submit" value="Suchen »"/>
                </div>
                <!-- objeto bucle principal -->
                <?php while (have_posts() ){ the_post();?>
                <div class="events-months-content">
                    <?php
                        // TRAINING METADATA
                        $training_ID            = get_post_meta(get_the_id(), $prefix . 'training', true );
                        $training_title         = get_the_title( $training_ID );
                        $training_startdate     = get_post_meta(get_the_id(), $prefix . 'startdate', true );
                        $training_enddate       = get_post_meta(get_the_id(), $prefix . 'enddate', true );
                        $training_permalink     = get_post_permalink( $training_ID );
                        $training_pdf_file_url  = get_post_meta($training_ID, $prefix . 'pdf', true );
                                            
                        // EXPERT METADATA
                        $expert_ID              = get_post_meta(get_the_id(), $prefix . 'mainexpert', true );
                        $expert_name            = get_the_title( $expert_ID );
                        $expert_permalink       = get_post_permalink( $expert_ID );
                                            
                        // LOCATION METADATA
                        $location_ID            = get_post_meta(get_the_id(), $prefix . 'mainlocation', true );
                        $location_name          = get_the_title( $location_ID );
                        $location_address       = get_post_meta( $location_ID, $prefix . 'address', true);
                        $location_city          = get_post_meta( $location_ID, $prefix . 'city', true);
                                            
                        $split_date = explode('-',$training_startdate);

                        if ( $month != $split_date[1] ){
                    ?>
                    <div class="event-headline"><?= schnell_show_month($split_date[1]) .' '. $split_date[2]?></div>
                    <?php
                        }
                    ?>
                    <?php $month = $split_date[1]; ?>
                    <!-- objeto bucle posts -->
                    <div class="event-description">
                        <div class="event-time"><?= str_replace('-', '.', $training_startdate) . ' - ' . str_replace('-', '.',  $training_enddate ) ?></div>
                        <div class="event-detail">
                            <div class="event-name">
                                <a href="<?= $training_permalink ?>" target="_blank"><?= $training_title ?></a>
                            </div>	 
                            <div class="event-trainer">
                                mit <a href="<?= $expert_permalink ?>" target="_blank"><?= $expert_name ?></a>
                            </div>
                            <div class="event-location">
                                <div class="place"><?= $location_name ?></div>
                                <div class="place-datail"><?= $location_address ?></div>
                                <div class="place-province"><?= $location_city ?></div>
                            </div>
                        </div>
                        <div class="event-button">
                            <?php if ( $training_pdf_file_url ) { ?>
                            <a class="button btn-download" target="_blank" href="<?= $training_pdf_file_url ?>">PDF Download</a>
                            <?php } ?>
                            <a class="button btn-detail" target="_blank" href="#">Anmeldung »</a>	
                        </div>
                    </div>
                    <!-- -->
                </div>
                <?php } // END WHILE ?>
                <?php }else{ ?>
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
