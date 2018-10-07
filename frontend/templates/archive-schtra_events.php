<?php get_header(); $prefix = 'schnell_';?>
<style>
    body{font-family:'Nunito Sans',Helvetica,Arial,Lucida,sans-serif;font-size:.9rem;color:#666;font-weight:400;line-height:140%}.event-description .event-name,.event-headline,.event-location .place{font-weight:700}a{text-decoration:none}.event-description:nth-child(even){background-color:#fff}.event-description:nth-child(odd){background-color:#f8f8f8}.events-search{padding-bottom:15px}.events-search select{padding:5px 40px 5px 5px;margin-bottom:5px;border-radius:0;border-color:#a9a9a9}.events-search input[type=submit]{line-height:31px;margin-bottom:5px;color:#fff;display:inline-block;padding:0 15px;text-decoration:none;cursor:pointer;position:relative;width:auto;font-size:.9rem;border:0;background-color:#ce1719}.event-button .button:hover,.events-search input[type=submit]:hover{background-color:#fff;color:#ce1719}.event-headline{background:#606060;color:#fff;font-size:1.2rem;padding:10px;text-align:center}.event-button,.event-detail,.event-time{padding:5px}.event-time{color:#ce171a;width:25%}.event-detail a{color:#ce1719}.event-trainer{font-style:italic}.event-button .button{line-height:30px;line-height:1.667rem;font-size:.9rem;padding:0 35px 0 15px;display:inline-block;margin-bottom:5px;background-color:#ce1719;color:#fff}.event-location{font-size:.75rem}.events-content{max-width:1080px;margin:0 auto;padding:0 5%}.event-description{display:flex;flex-direction:row;padding:5px 0}.event-detail{width:55%}.event-button{display:flex;flex-direction:column}
</style>
<div id="main-content">
    <div class="container">
        <div id="content-area" class="clearfix">
            <div class="events-content">
                <div class="events-search">
                    <form id="events-filter" role="form">
                        <?php
                            $experts = get_posts( array( 'post_type' => 'schtra_expert' ) );
                            //mostrar_arreglo($experts);
                            if( $experts ){
                        ?>
                        <select name="trainer">
                            <option value=""><?= _e('alle Trainer','schnell') ?></option>
                            <?php
                                foreach ( $experts as $expert ){

                                    $selected = '';

                                    ( isset ( $_GET['trainer'] ) && !empty ( $_GET['trainer'] ) && $_GET['trainer'] == $expert->ID ) ? $selected = 'selected' : '';

                                    echo '<option value="' . $expert->ID . '" ' . $selected . '>' . $expert->post_title . '</option>';
                                }
                            ?>
                        </select>
                        <?php } ?>
                        <?php
                            $trainings = get_posts( array( 'post_type' => 'schtra_training' ) );
                            if ( $trainings ){
                        ?>
                        <select name="training">
                            <option value=""><?= _e('alle Seminare','schnell') ?></option>
                            <?php
                                foreach ( $trainings as $training ){

                                    $selected = '';

                                    ( isset ( $_GET['training'] ) && !empty ( $_GET['training'] ) && $_GET['training'] == $training->ID ) ? $selected = 'selected' : '';

                                    echo '<option value="' . $training->ID . '" ' . $selected . '>' . $training->post_title . '</option>';
                                }
                            ?>
                        </select>
                        <?php } ?>
                        <button type="submit"><?= _e('Suchen','schnell') ?> <i class="fas fa-angle-double-right"></i></button>
                    </form>
                </div>
                <?php if( have_posts() ){ $month = 0;?>
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
                        <div class="event-time"><i class="far fa-calendar-alt"></i> <?= str_replace('-', '.', $training_startdate) . ' - ' . str_replace('-', '.',  $training_enddate ) ?></div>
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
                            <a class="button btn-download" target="_blank" href="<?= $training_pdf_file_url ?>"><i class="far fa-file-pdf"></i> PDF Download</a>
                            <?php } ?>
                            <a class="button btn-detail" target="_blank" href="#"><?= _e('Anmeldung','schnell') ?> <i class="fas fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <!-- -->
                </div>
                <?php } // END WHILE
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => __( 'Back', 'textdomain' ),
                        'next_text' => __( 'Onward', 'textdomain' ),
                    ) );
                }else{ ?>
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
