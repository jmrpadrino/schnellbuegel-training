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
                            $terms = get_terms( array(
                                'taxonomy' => 'schnell-training-cat',
                                'hide_empty' => false,
                            ) );

                            if ( $terms ){
                        ?>
                        <select name="training-category">
                            <option value=""><?= _e('alle Kategorien','schnell') ?></option>
                            <?php
                                foreach ( $terms as $term ){

                                    $selected = '';

                                    ( isset ( $_GET['training-category'] ) && !empty ( $_GET['training-category'] ) && $_GET['training-category'] == $term->term_id ) ? $selected = 'selected' : '';

                                    echo '<option value="' . $term->term_id . '" ' . $selected . '>' . $term->name . '</option>';
                                }
                            ?>
                        </select>
                        <button type="submit"><?= _e('Filtern','schnell') ?> <i class="fas fa-angle-double-right"></i></button>
                        <?php } ?>
                    </form>
                </div>
                <?php if( have_posts() ){ $month = 0;?>
                <!-- objeto bucle principal -->
                <?php while (have_posts() ){ the_post();?>
                <div class="training-list-content">
                    <!-- objeto bucle posts -->
                    <div class="event-description">
                        <div class="event-detail">
                            <div class="event-name">
                                <a href="<?= get_the_permalink() ?>" target="_blank"><?= the_title() ?></a>
                            </div>	 
                            <div class="event-trainer">
                                <?= get_post_meta( get_the_ID(), $prefix . 'slogan', true) ?>
                            </div>
                            <div class="event-location">
                                <div class="place"><?= $location_name ?></div>
                                <div class="place-datail"><?= $location_address ?></div>
                                <div class="place-province"><?= $location_city ?></div>
                            </div>
                        </div>
                        <div class="event-button">
                            <a class="button btn-download" target="_blank" href="<?= get_post_meta( get_the_ID(), $prefix . 'pdf', true) ?>"><i class="far fa-file-pdf"></i> PDF Download</a>
                            <a class="button btn-detail" target="_blank" href="<?= get_the_permalink() ?>"><?= _e('Anmeldung','schnell') ?> <i class="fas fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <!-- -->
                </div>
                <?php } // END WHILE
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => __( 'zurückgehen', 'schnell' ),
                        'next_text' => __( 'vorwärts gehen', 'schnell' ),
                    ) );
                }else{ ?>
                <div class="events-months-content">
                    <p><?= _e('Es sind noch keine Trainings veröffentlicht.','schnell') ?></p>
                </div>
                <?php } // END IF ?>
                <!-- -->
            </div>
        </div> <!-- #content-area -->
    </div> <!-- .container -->
</div> <!-- #main-content -->
<?php

get_footer();
