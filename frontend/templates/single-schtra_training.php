<?php get_header(); $prefix = 'schnell_'; the_post() ?>
<style type="text/css" media="screen">
.cost-title,.description-btn,.duration-title{text-transform:uppercase}body{font-family:'Nunito Sans',Helvetica,Arial,Lucida,sans-serif;font-size:100%;color:#666;font-weight:400}.training-title h1,a{color:#ce1719}.description-btn,.in-house-link a,.info-cost p,.info-description.training-pdf a,.info-title,.toogle-title{font-weight:700}a{text-decoration:none}.training-content{position:relative;width:100%;max-width:1080px;margin:0 auto;padding:0;line-height:140%}.training-subtitle h2{color:#000}.training-subtitle,.training-summary,.training-title{text-align:left;margin-bottom:1.667rem}.training-summary{padding-bottom:30px}.training-summary p{line-height:140%}.training-toogle{margin:1.111rem 0}.toogle-title{font-size:20px;font-size:1.111rem;background-color:#f8f8f8;cursor:pointer;}.toogle-title h4{padding: 15px 42px;;margin:0}.toogle-title .toogle-open h4:after,.toogle-title h4:after{font-size:20px;position:absolute;right:76px;padding:0 15px;color:#ce1719;font-family:FontAwesome}.toogle-title h4:after{content:"\f103"}.toogle-title .toogle-open h4:after{content:"\f102";}.toogle-description p{padding:0}
    .info-description,.info-title{position:relative;padding:1.667rem 42px;}.info-title{
        padding:1.667rem 0px;
    }
    .toogle-description{display:none;padding: 10px 0px;}.training-info,.training-related-event{margin:5% 0}.info-description{border:1px solid #f4f4f4}.info-cost p{color:#ce1719}.related-event-date{line-height:2em}.fa{padding:10px}.training-related-event .info-description{display:flex;flex-direction:row}.description-btn,.description-detail{width:100%}.description-btn{text-align:end}.description-btn a{background-color:#ce1719;color:#fff;line-height:1.667rem;font-size:1rem;padding:15px}.description-btn a:after{font-family:FontAwesome;content:"\f101";padding:5px}.description-btn a:hover{background-color:#fff;color:#ce1719}.info-cost p,.info-duration p{margin:0}.info-cost,.info-duration{margin-bottom:1rem}.info-description.more-courses-inf{display:flex;flex-direction:column}.info-description.more-courses-inf a{font-size:1rem;font-weight:700;line-height:2em}.in-house-link{width:70%;margin:5% auto;padding:2% 0 2% 5%;background-color:#ce1719;display:flex;justify-content: space-around; align-items: center;}a > .in-house-link{color:#fff}.in-house-link img{padding:0 2%;vertical-align:middle}.info-description.training-pdf{margin:5% 0;border-block-end:1px #dadada solid;border-block-start:1px #dadada solid;border-left:0;border-right:0}.info-description.training-pdf a:before{font-family:FontAwesome;content:"\f1c1";font-size:3rem;height:auto;vertical-align:middle;padding-right:2%;font-weight:400}
    .single-schtra_training .toogle-title .toogle-open h4:after,
    .single-schtra_training .toogle-title h4:after{
        right: 0;
    }
    @media only screen and (max-width: 690px){
        .in-house-link{
            text-align: center;
            padding: 2%;
        }
        .in-house-link img{
            display: block;
            margin: 18px auto;
        }
    }
</style>
<div id="main-content">
    <div class="container">
        <div id="content-area" class="clearfix">
		<div class="training-content">
			<div class="training-title">
				<h1><?= the_title() ?></h1>
			</div>
            <?php
                $slogan = get_post_meta( get_the_ID(), $prefix . 'slogan', true);
                if ( $slogan ){
            ?>
			<div class="training-subtitle">
				<h2><?= $slogan ?></h2>
			</div>
            <?php } ?>
			<?php
                $resume = get_post_meta( get_the_ID(), $prefix . 'resume', true);
                if ( $resume ){
            ?>
			<div class="training-summary">
				<?= $resume ?>
			</div>
            <?php } ?>
			<div class="training-toogle">
				<div class="toogle-title">
					<h4>DIE ZIELGRUPPE</h4>
				</div>
				<div class="toogle-description" >
					<?= get_post_meta( get_the_ID(), $prefix . 'target', true); ?>
				</div>
			</div>
			<div class="training-toogle">
				<div class="toogle-title">
					<h4>DAS ZIEL</h4>
				</div>
				<div class="toogle-description" >
					<?= get_post_meta( get_the_ID(), $prefix . 'goal', true); ?>
				</div>
			</div>
			<div class="training-toogle">
				<div class="toogle-title">
					<h4>DER NUTZEN</h4>
				</div>
				<div class="toogle-description" >
					<?= get_post_meta( get_the_ID(), $prefix . 'benefits', true); ?>
				</div>
			</div>
			<div class="training-toogle">
				<div class="toogle-title">
					<h4>DIE INHALTE</h4>
				</div>
				<div class="toogle-description" >
					<?= get_post_meta( get_the_ID(), $prefix . 'contents', true); ?>
				</div>
			</div>
			<div class="training-info">
				<div class="info-title">INFORMATIONEN</div>
				<div class="info-description">
				<div class="info-duration">
					<div class="duration-title">Die Dauer</div>
					<p><?= get_post_meta( get_the_ID(), $prefix . 'duration', true); ?></p>
				</div>
				<div class="info-cost">
					<div class="cost-title">Die Kosten</div>
					<p>Euro <?= get_post_meta( get_the_ID(), $prefix . 'cost', true); ?></p>
				</div>
				<div class="info-aditional">
					<?= get_post_meta( get_the_ID(), $prefix . 'moreinformation', true); ?>
				</div>
			</div>
			</div>
			<div class="training-info">
				<div class="info-title">WEITERE INFORMATIONEN</div>
				<div class="info-description">
						<?= get_post_meta( get_the_ID(), $prefix . 'furtherinformation', true); ?>
				</div>
			</div>
			<?php 
                schnell_show_events_by_training( get_the_ID() ) 
            ?>    
			
			<!--div class="training-related-event">
				<div class="info-description">
					<div class="description-detail">
						<div class="related-event-date"><i class="fa fa-calendar-o" aria-hidden="true"></i>10.10.2018 - 27.03.2019</div>
						<div class="related-event-address"><i class="fa fa-map-marker" aria-hidden="true"></i>Posthotel Hofherr, D-82549 Königsdorf</div>
						<div class="related-event-trainer">
						<i class="fa fa-user" aria-hidden="true"></i>Trainer: <a href="#">Birgit Schuler</a>
						</div>
					</div>
					<div class="description-btn">
						<a href="#">Mehr Info / Anmelden</a>
					</div>
				</div>
			</div-->
			<?php
                /*
                * GET FURTHER TRAININGS 
                */
            ?>
            <?php
                /**
                * COMMENTED BY CLIENT REQUEST
                */

                /*
			<div class="training-info more-courses">
				<div class="info-title more-courses-title">WEITERFÜHRENDE AUSBILDUNGEN</div>
				<div class="info-description more-courses-inf">
					<a href="#">Ausbildung Interner Coach für Unternehmenskultur und Leadership</a>
					<a href="#">FUTURE-Coaching-Ausbildung 4.0</a>
				</div>
			</div>
            */ ?>
            <a href="<?= home_url('kontakt')?>">
                <div class="in-house-link">
                    <img src="<?= SCHNELL_PLUGIN_URI ?>/frontend/images/home-map-location-1.png"><span>Dieses Angebot können Sie auch als Inhouse-Seminar buchen!</span>
                </div>
			</a>
			<?php
                /**
                * COMMENTED BY CLIENT REQUEST
                */

                /*
			<div class="info-description pdf-link">
				<a href="<?= get_post_meta( get_the_ID(), $prefix . 'pdf', true) ?>" target="_blank"><i class="far fa-file-pdf"></i> <?= _e('Weitere Informationen finden Sie in diesem PDF','schell') ?></a>
			</div>
            */ ?>
		</div>
        </div>
		<?php
			if (shortcode_exists( 'et_social_share' ) )
				echo do_shortcode('[et_social_share]');
		?>
    </div>
</div> <!-- #main-content -->
<script>
	jQuery(document).ready(function(){
		jQuery('.toogle-title').click( function(){
			jQuery(this).parents('.training-toogle').find('.toogle-description').slideToggle();
		})
	})
</script>
<?php

get_footer();
