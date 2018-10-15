<?php get_header(); $prefix = 'schnell_'; the_post() ?>
<?php
    // TRAINING METADATA
    $training_ID            = get_post_meta(get_the_id(), $prefix . 'training', true );
    $training_title         = get_the_title( $training_ID );
    $training_startdate     = get_post_meta(get_the_id(), $prefix . 'startdate', true );
    $training_enddate       = get_post_meta(get_the_id(), $prefix . 'enddate', true );
    $training_permalink     = get_post_permalink( $training_ID );
    $training_pdf_file_url  = get_post_meta($training_ID, $prefix . 'pdf', true );
?>
<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">
		    <div class="single-event-title-area">
		        <h1><?= $training_title ?></h1>
		        <a href="#buchung"><?= _e('Direkt zur Buchung','schnell') ?></a>
		    </div>
            <?php
                $modules = get_post_meta( get_the_ID(), 'modulegroup', false);
                if( $modules ){ $i = 1;
            ?>
		    <div class="single-event-module-list-placeholder">
		        <ul class="single-event-module-list">    
                <?php
                    foreach( $modules[0] as $module ){
                        echo '<li class="single-event-module-item">';
                        echo '<strong class="single-event-module-number">' . esc_html('Modul', 'schnell') . ' ' . $i . '</strong>';
                        echo '<h3>' . get_the_title($module['schnell_moduleid']) . '</h3>';
                        echo '<p><strong>' . get_the_title($module['schnell_moduleexpert']) . '</strong></p>';
                        echo '<p>' . get_the_title($module['schnell_modulelocation']) . '</p>';
                        echo '<p>' . $module['schnell_moduledate'] . '</p>';
                        echo '<hr />';
                        echo '</li>';
                        $expert_profile[] = $module['schnell_moduleexpert'];
                        $locations[] = $module['schnell_modulelocation'];
                        $i++;
                    }
                ?>
		        </ul>
		    </div>
		    <?php } ?>
		    <?php
                if ( is_array($expert_profile) ){
                $expert_profile = array_reverse($expert_profile, false);
                $args = array(
                    'post_type' => 'schtra_expert',
                    'posts_per_page' => -1,
                    'post__in' => $expert_profile
                );
                $experts = get_posts( $args );
                }
                if( $experts ){
            ?>
		    <div class="single-event-trainer-placeholder">
                <h2><?= _e('Ihr Trainer', 'schnell')?></h2>
                <?php foreach ( $experts as $expert ){ ?>
		        <div class="single-event-trainer-features">
		            <img src="<?= get_the_post_thumbnail_url($expert->ID) ?>" alt="<?= get_the_title($expert->ID) ?>">
		            <h3><?= $expert->post_title ?></h3>
		            <ul>
		                <li><i class="fas fa-phone"></i> <?= get_post_meta( $expert->ID, $prefix . 'phone', true) ?></li>
		                <li><i class="far fa-envelope"></i> <?= get_post_meta( $expert->ID, $prefix . 'mail', true) ?></li>
		            </ul>
		        </div>
		        <?php } ?>
		    </div>
		    <?php } ?>
		    <?php
                $locations = array_reverse($locations, false);
                $args = array(
                    'post_type' => 'schtra_location',
                    'posts_per_page' => -1,
                    'post__in' => $locations
                );
                $locations = get_posts( $args );
                if( $locations ){
            ?>
		    <div class="single-event-location-placeholder">
                <h2><?= _e('Ort', 'schnell')?></h2>
                <?php foreach ( $locations as $location ){ ?>
		        <div class="single-event-location-features">
		            <div class="single-event-location-map">
                        <?php
                            $args = array(
                                'width'        => '640px',
                                'height'       => '480px',
                                'zoom'         => 14,
                                'marker'       => true,
                                'marker_icon'  => 'https://url_to_icon.png',
                                'marker_title' => 'Click me',
                                'info_window'  => '<h3>Title</h3><p>Content</p>.',
                            );
                            echo rwmb_meta( 'google_address', $args );
                        ?>
		            </div>
		            <div class="single-event-location-info">
                        <h3><?= $location->post_title ?></h3>
                        <ul>
                            <li><i class="fas fa-map-marker"></i> <?= get_post_meta( $location->ID, $prefix . 'address', true) ?></li>
                            <li><?= get_post_meta( $location->ID, $prefix . 'postal', true) ?>, <?= get_post_meta( $location->ID, $prefix . 'city', true) ?></li>
                            <li><i class="fas fa-phone"></i> <?= get_post_meta( $location->ID, $prefix . 'phone', true) ?></li>
                            <li><i class="fas fa-link"></i> <?= get_post_meta( $location->ID, $prefix . 'mail', true) ?></li>
                        </ul>
		            </div>
		        </div>
		        <?php } ?>
		    </div>
		    <?php } ?>
		    <div class="single-event-moreinfo-placeholder">
                <h2><?= _e('Wichtige Information', 'schnell')?></h2>
                <ul>
                    <li>
                       <strong><?= _e('Kosten pro Teilnehmer', 'schnell') ?></strong>
                       <p>Euro <?= get_post_meta( get_the_ID(), $prefix . 'cost', true)?></p>
                    </li>
                    <li>
                       <strong><?= _e('Dauer: ', 'schnell') ?></strong>
                       <p><?= get_post_meta( get_the_ID(), $prefix . 'duration', true)?></p>
                    </li>
                    <li>
                       <p><?= get_post_meta( get_the_ID(), $prefix . 'moreinformation', true)?></p>
                    </li>
                </ul>
		    </div>
		    <div class="single-event-pdf-placeholder">
                <p><a href="<?= $training_pdf_file_url ?>"><i class="far fa-file-pdf"></i> <?= _e('Weitere Informationen finden Sie in diesem PDF', 'schnell')?></a></p>
		    </div>
		    <div id="buchung" class="single-event-registerform-placeholder">
		        <div class="single-event-registerform-title">
		            <h2><?= _e('Anmeldung für Neukunden','schnell')?></h2>
		            <form>
		                <h3><?= _e('Anmeldung', 'schnell') ?>: <?= $training_title ?></h3>
		                <p><?= _e('Vom', 'schnell') ?> <?= $training_startdate ?>  <?= _e('Bis', 'schnell') ?> <?= $training_enddate ?></p>
		                <div class="form-group">
		                    <strong><?= _e('Anmeldung', 'schnell') ?></strong>
		                    <label for="register-type"><input type="radio" name="register-type" value="1"> Privat</label>
		                    <label for="register-type"><input type="radio" name="register-type" value="2"> Geschäftlich</label>
		                </div>
		                
		            </form>
		        </div>
		    </div>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->
<?php

get_footer();
