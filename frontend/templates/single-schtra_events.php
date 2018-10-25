<?php get_header(); $prefix = 'schnell_'; the_post() ?>
<style>
    html{
        font-size: 16px;
    }
    .single-event-container{
        font-family: inherit;
    }
    .single-event-header-placeholder{
        text-align: center;
    }
    .single-event-header-placeholder h1{
        color: #CE171A;
        font-weight: 700;
    }
    .single-event-header-placeholder a{
        color: white;
        padding: 14px 17px;
        background: #CE171A;
    }
    .single-event-module-list{
        list-style: none;
        margin: 0;
        padding: 0;
        margin: 36px 0;
    }
    .single-event-module-item{
        margin-bottom: 18px;
        border: 1px solid lightgray;
        padding: 14px;
        line-height: 1;
    }
    .single-event-module-item p{
        padding-bottom: .3em;
    }
    .single-event-module-item .row{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .single-event-module-item .row .text-center{
        text-align: center;
    }
    .single-event-module-item .text-center,
    .far,
    .fas{
        color: #CE171A;
    }

</style>
<?php
    // TRAINING METADATA
    $training_ID            = get_post_meta(get_the_id(), $prefix . 'training', true );
$training_title         = get_the_title( $training_ID );
$training_startdate     = get_post_meta(get_the_id(), $prefix . 'startdate', true );
$training_enddate       = get_post_meta(get_the_id(), $prefix . 'enddate', true );
$training_permalink     = get_post_permalink( $training_ID );
$training_pdf_file_url  = get_post_meta($training_ID, $prefix . 'pdf', true );
$training_locations      = get_post_meta(get_the_id(), $prefix . 'mainlocation', true );
?>
<div class="container single-event-container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 single-event-header-placeholder">
            <h1><?= $training_title ?></h1>
            <?php do_action('schnell-luego-titulo') ?>
            <a href="#buchung"><?= _e('Direkt zur Buchung','schnell') ?></a>
        </div>
    </div>
    <?php
    $modules = get_post_meta( get_the_ID(), 'modulegroup', false);
                if( $modules ){
                    $i = 1;
                    $expert_profile = $training_locations = array();
    ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 single-event-module-list-placeholder">
            <ul class="single-event-module-list">
                <?php
                    foreach( $modules[0] as $module ){
                ?>
                <li class="single-event-module-item">
                    <div class="row">
                        <div class="col-xs-2 text-center"><?= '<strong class="single-event-module-number">' . esc_html('Modul', 'schnell') . ' ' . $i . '</strong>' ?></div>
                        <div class="col-xs-10">
                            <h3><?= get_the_title($module['schnell_moduleid']) ?></h3>
                            <hr />
                            <p><i class="far fa-user"></i> <?= get_the_title($module['schnell_moduleexpert']) ?></p>
                            <p><i class="fas fa-map-marker"></i> <?= get_the_title($module['schnell_modulelocation']) ?></p>
                            <p><i class="far fa-calendar-alt"></i> <?= str_replace('-','.',$module['schnell_moduledate']) ?></p>
                        </div>
                    </div>
                </li>
                <?php
                    if (!in_array( $module['schnell_moduleexpert'], $expert_profile))
                        $expert_profile[] = $module['schnell_moduleexpert'];
                        $training_locations[] = $module['schnell_modulelocation'];
                        $i++;
                    }
                ?>
            </ul>
        </div>
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
    <div class="row">
        <div class="col-md-10 col-md-offset-1 single-event-trainer-placeholder">
            <h2><?= _e('Ihr Trainer', 'schnell')?></h2>
            <?php foreach ( $experts as $expert ){ ?>
            <div class="single-event-trainer-features">
                <div class="row">
                    <div class="col-sm-4">
                        <img src="<?= get_the_post_thumbnail_url($expert->ID) ?>" alt="<?= get_the_title($expert->ID) ?>">
                    </div>
                    <div class="col-sm-8">
                        <h3><?= $expert->post_title ?></h3>
                        <ul>
                            <li><i class="fas fa-phone"></i> <?= get_post_meta( $expert->ID, $prefix . 'phone', true) ?></li>
                            <li><i class="far fa-envelope"></i> <?= get_post_meta( $expert->ID, $prefix . 'mail', true) ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php
    if ( is_array($training_locations) ){
        $training_locations = array_reverse($training_locations, false);
    }
    $args = array(
        'post_type' => 'schtra_location',
        'posts_per_page' => -1,
        'post__in' => $training_locations
    );
    $locations = get_posts( $args );
    if( $locations ){
    ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 single-event-location-placeholder">
            <h2><?= _e('Ort', 'schnell')?></h2>
            <?php foreach ( $locations as $location ){ ?>
            <div class="single-event-location-features">
                <div class="row">
                    <div class="col-sm-4">
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
                    </div>
                    <div class="col-sm-8">
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
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 single-event-moreinfo-placeholder">
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
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 single-event-pdf-placeholder">
            <p><a href="<?= $training_pdf_file_url ?>"><i class="far fa-file-pdf"></i> <?= _e('Weitere Informationen finden Sie in diesem PDF', 'schnell')?></a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div id="buchung" class="single-event-registerform-placeholder">
                <div class="single-event-registerform-title">
                    <h2><?= _e('Anmeldung für Neukunden','schnell')?></h2>
                    <h3><?= _e('Anmeldung', 'schnell') ?>: <?= $training_title ?></h3>
                    <p><?= _e('Vom', 'schnell') ?> <?= $training_startdate ?>  <?= _e('Bis', 'schnell') ?> <?= $training_enddate ?></p>
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#privat" aria-controls="privat" role="tab" data-toggle="tab">Anmeldung Privat</a></li>
                            <li role="presentation"><a href="#geschaftlich" aria-controls="geschaftlich" role="tab" data-toggle="tab">Anmeldung Geschäftlich</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="privat">
                                <form id="anmendung-privat" role="form" method="post">
                                    <input type="hidden" name="anmeldung_privat[privat-date-or-application]" value="<?= date('d.m.Y')?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Anrede</h4>
                                            <label class="radio-inline">
                                                <input type="radio" name="anmeldung_privat[anrede]" value="herr"> Herr
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="anmeldung_privat[anrede]" value="frau"> Frau
                                            </label>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4>Titel</h4>
                                            <input type="text" name="anmeldung_privat[title]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Vorname *</h4>
                                            <input type="text" name="anmeldung_privat[vorname]">
                                        </div>
                                        <div class="col-sm-6">
                                            <h4>Nachname *</h4>
                                            <input type="text" name="anmeldung_privat[nachname]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Straße/Hausnr. *</h4>
                                            <input type="text" name="anmeldung_privat[strabe]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>PLZ *</h4>
                                            <input type="text" name="anmeldung_privat[plz]">
                                        </div>
                                        <div class="col-sm-6">
                                            <h4>Ort *</h4>
                                            <input type="text" name="anmeldung_privat[ort]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>E-Mail *</h4>
                                            <input type="text" name="anmeldung_privat[email]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Telefonnummer</h4>
                                            <input type="text" name="anmeldung_privat[phone]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Geburtsdatum (Optional für das Abschluss-Zertifikat)</h4>
                                            <input type="text" name="anmeldung_privat[brith-date]">
                                        </div>
                                    </div>
                                    <!--div class="row">
<div class="col-sm-12">
<h4>Bitte wählen Sie Ihren gewünschten Starttermin</h4>
<label class="radio-inline">
<input type="radio" name="anmeldung_privat[anrede]" value="herr"> Präsenzmodul 1 - Einstieg und Ankommen in der Ausbildung 28.09.2018 - Fußenegger und Partner, 1090 Wien - Angelika Fußenegger
</label>
<label class="radio-inline">
<input type="radio" name="anmeldung_privat[anrede]" value="frau"> Präsenzmodul 1 - Einstieg und Ankommen in der Ausbildung 08.11.2018 - Fußenegger und Partner, 1090 Wien - Angelika Fußenegger
</label>
</div>
</div-->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Kosten</h4>
                                            <p>Die angegebenen Kosten sind exklusive der gesetzlichen MwSt.
                                                Bitte beachten Sie: Unterkunft und Verpflegung sind im Preis nicht inkludiert und direkt mit dem Hotel abzurechnen.
                                                Die Rechnung erhalten Sie rechtzeitig vor Beginn der Veranstaltung.</p>
                                            <div class="row">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="anmeldung_privat[dif-billing-address][status]"> Abweichende Rechnungsadresse
                                                </label>
                                            </div>
                                            <div id="dif-billing-address" class="row" style="*display: none;">
                                                <div class="col-xs-12">
                                                    <h5>Andere</h5>
                                                    <select name="anmeldung_privat[dif-billing-address][andere]">
                                                        <option value="herr">Herr</option>
                                                        <option value="frau">Frau</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-12">
                                                    <h5>Titel</h5>
                                                    <input type="text" name="anmeldung_privat[dif-billing-address][title]">
                                                </div>
                                                <div class="col-xs-12">
                                                    <h5>Vorname *</h5>
                                                    <input type="text" name="anmeldung_privat[dif-billing-address][vorname]">
                                                </div>
                                                <div class="col-xs-12">
                                                    <h5>Nachname *</h5>
                                                    <input type="text" name="anmeldung_privat[dif-billing-address][nachname]">
                                                </div>
                                                <div class="col-xs-12">
                                                    <h5>Straße/Hausnr. *</h5>
                                                    <input type="text" name="anmeldung_privat[dif-billing-address][strabe]">
                                                </div>
                                                <div class="col-xs-12">
                                                    <h5>PLZ *</h5>
                                                    <input type="text" name="anmeldung_privat[dif-billing-address][plz]">
                                                </div>
                                                <div class="col-xs-12">
                                                    <h5>Ort *</h5>
                                                    <input type="text" name="anmeldung_privat[dif-billing-address][ort]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Hotelreservierung</h4>
                                            <div class="row">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="anmeldung_privat[hotel-registration-data][yes]">Ich bin damit einverstanden, dass die FUTURE GmbH meine Anmeldedaten zum Zweck der Hotelbuchung und -abrechnung an das angegebene Seminarhaus weitergibt. (Mit dem Hotel besteht eine Vereinbarung, dass die Daten nur für diese Zwecke und im Rahmen der DSGVO behandelt werden.)
                                                </label>
                                            </div>
                                            <div class="row">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="anmeldung_privat[hotel-registration-data][no]">Ich möchte nicht, dass die FUTURE GmbH meine Daten an das Hotel weitergibt, ich führe die entsprechende Hotelreservierung selbst durch.
                                                </label>
                                            </div>
                                            <h5>Gerne reservieren wir für Sie ein Zimmer:</h5>
                                            <select id="room_needed" name="anmeldung_privat[hotel-registration-data][room_needed]">
                                                <option value="0">ab dem Vortag</option>
                                                <option value="1">ab dem ersten Seminartag</option>
                                                <option value="2">es wird kein Zimmer benötigt</option>
                                            </select>
                                            <h5>MEINE NACHRICHT AN DIE MITARBEITER VON FUTURE</h5>
                                            <textarea name="anmeldung_privat[hotel-registration-data][message_to_staff]" rows="6"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4>Stornobedingungen</h4>
                                            <p>Sollten Sie nach verbindlicher Anmeldung absagen, entstehen bis 30 Tage vor Beginn der Ausbildung keine Kosten. Danach verrechnen wir bis zum Beginn des zweiten Präsenzmoduls Euro 800,- netto. Bei Stornierung nach dem 2. Präsenzmodul sind 80 % der Gesamtkosten zu bezahlen.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4>Konditionen *</h4>
                                            <div class="row">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="anmeldung_privat[cancelation-read]">Ja, ich bestätige, dass ich die Stornobedingungen und die Allgemeinen Geschäftsbedingungen von FUTURE zur Kenntnis genommen habe.
                                                </label>
                                            </div>
                                            <div class="row">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="anmeldung_privat[accept-data-protection]">Ja, ich akzeptiere die Datenschutzbestimmungen und stimme der Verarbeitung meiner personenbezogenen Daten zu.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>Hinweis: Mit * gekennzeichnete Felder sind Pflichtfelder!</p>
                                            <button type="submit" name="anmeldung_privat[submit]"><?= _e('Anmeldung absenden', 'schnel')?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="geschaftlich">...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

    get_footer();
