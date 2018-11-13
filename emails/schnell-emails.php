<?php
/**
 * SENDING MAIL VIA AJAX
 */
add_action('wp_ajax_nopriv_schnell_send_form','schnell_send_event_form');
add_action('wp_ajax_schnell_send_form','schnell_send_event_form');

function schnell_send_event_form()
{
    $email_address = get_option( 'schnell_email_for_event_forms', '' );
    $array_values = $_POST['values'];
    $text = '';

	parse_str($array_values, $new_array);

//	echo '<pre>';
//	print_r($new_array);
//	echo '</pre>';
	//die;
    ob_start();

	/**
     * IF USER SUBMITED Privat FORM
     */

    if ($new_array['anmeldung'] == 'privat'){
        $emailto = $new_array['anmeldung_privat']['email'];
    ?>
        <h1>Anmeldung - <?= $new_array['anmeldung'] ?></h1>
        <p><strong>Fur: </strong> <?= $new_array['anmeldung_training_name'] ?></p>
        <p>Vom <?= $new_array['anmeldung_training_start'] ?> Bis <?= $new_array['anmeldung_training_end'] ?></p>
        <p><strong>Datum der Anwendung</strong> <?= $new_array['anmeldung_privat']['privat-date-or-application'] ?></p>
        <ul>
			<li><strong><?= $new_array['anmeldung_privat']['anrede'] ?></strong></li>
            <li><strong><?= $new_array['anmeldung_privat']['title'] ?> <?= $new_array['anmeldung_privat']['vorname'] ?> <?= $new_array['anmeldung_privat']['nachname'] ?></strong></li>
            <li>
                <strong>E-Mail</strong>
                <span><a href="mailto:<?= $new_array['anmeldung_privat']['email'] ?>"><?= $new_array['anmeldung_privat']['email'] ?></a></span>
            </li>
            <li>
                <strong>Telefonnummer</strong>
                <span><?= $new_array['anmeldung_privat']['phone'] ?></span>
            </li>
            <li>
                <strong>Straße/Hausnr.</strong>
                <span><?= $new_array['anmeldung_privat']['strabe'] ?></span>
            </li>
            <li>
                <strong>Ort</strong>
                <span><?= $new_array['anmeldung_privat']['ort'] ?></span>
            </li>
            <li>
                <strong>PLZs</strong>
                <span><?= $new_array['anmeldung_privat']['plz'] ?></span>
            </li>
            <?php
				if (!empty($$new_array['anmeldung_privat']['brith-date'])) {
			?>
            <li>
            	<strong>Geburtsdatum</strong>
            	<span><?= $new_array['anmeldung_privat']['brith-date'] ?></span>
            </li>
            <?php
				} //endif
				// allow personal information at hotel
				echo '<li>';
				switch ($new_array['anmeldung_privat']['hotel-registration-data']['allowdatause']){
					case 0:
						echo 'Der Nutzer verpflichtet sich, die Anmeldedaten an das angegebene Seminarhaus zum Zwecke der Hotelbuchung und -abrechnung weiterzugeben.';
						break;
					case 2:
						echo 'Der Nutzer möchte nicht, dass die FUTURE-Die Unternehmensentwickler GmbH die Daten an das Hotel weitergibt, der Nutzer macht die Hotelbuchung selbst.';
						break;
				}
				echo '</li>';
				// room needed
				echo '<li>';
				echo '<strong>GERNE RESERVIEREN WIR FÜR SIE EIN ZIMMER:</strong>';
				switch ($new_array['anmeldung_privat']['room_needed']){
					case 0:
						echo 'ab dem Vortag.';
						break;
					case 1:
						echo 'ab dem ersten Seminartag.';
						break;
					case 2:
						echo 'es wird kein Zimmer benötigt.';
						break;
				}
				echo '</li>';
				// validate message
				if (!empty($new_array['anmeldung_privat']['room_needed'])) {
			?>
            <li>
            	<strong>MEINE NACHRICHT AN DIE MITARBEITER VON FUTURE</strong>
            	<p><?= $new_array['anmeldung_privat']['message_to_staff'] ?></p>
            </li>
            <?php } ?>
        </ul>
        <?php
			if ($new_array['anmeldung_privat']['dif-billing-address']['status'] == 'on'){
                echo '<div style="border: 1px solid gray; padding: 10px">';
				echo '<h2>Rechnungsinformationen</h2>';
				echo '<ul>';
				echo '<li><strong>Andere</strong> ' . $new_array['anmeldung_privat']['dif-billing-address']['andere'] . '</li>';
				echo '<li><strong>Title</strong> ' . $new_array['anmeldung_privat']['dif-billing-address']['title'] . '</li>';
				echo '<li><strong>Vorname</strong> ' . $new_array['anmeldung_privat']['dif-billing-address']['vorname'] . '</li>';
				echo '<li><strong>Nachname</strong> ' . $new_array['anmeldung_privat']['dif-billing-address']['nachname'] . '</li>';
				echo '<li><strong>Strabe</strong> ' . $new_array['anmeldung_privat']['dif-billing-address']['strabe'] . '</li>';
				echo '<li><strong>PLZ</strong> ' . $new_array['anmeldung_privat']['dif-billing-address']['plz'] . '</li>';
				echo '<li><strong>Ort</strong> ' . $new_array['anmeldung_privat']['dif-billing-address']['ort'] . '</li>';
				echo '</ul>';
				echo '</div>';
			}
		?>
    <?php
    } // END Privat FORM

	/**
     * IF USER SUBMITED Geschaftlich FORM
     */
	if ($new_array['anmeldung'] == 'geschaftlich'){

        $emailto = $new_array['anmeldung_geschaftlich']['email'];
	?>
		<h1>Anmeldung - <?= $new_array['anmeldung'] ?></h1>
        <p><strong>Fur: </strong> <?= $new_array['anmeldung_training_name'] ?></p>
        <p>Vom <?= $new_array['anmeldung_training_start'] ?> Bis <?= $new_array['anmeldung_training_end'] ?></p>
        <p><strong>Datum der Anwendung</strong> <?= $new_array['anmeldung_geschaftlich']['geschaftlich-date-or-application'] ?></p>
        <ul>
           	<li>
           		<strong>Firma</strong>
           		<span><?= $new_array['anmeldung_geschaftlich']['firma'] ?></span>
           	</li>
           	<li>
           		<strong>UID Nummer</strong>
           		<span><?= $new_array['anmeldung_geschaftlich']['uidnumber'] ?></span>
           	</li>
            <li><strong><?= $new_array['anmeldung_geschaftlich']['anrede'] ?> <?= $new_array['anmeldung_geschaftlich']['title'] ?> <?= $new_array['anmeldung_geschaftlich']['vorname'] ?> <?= $new_array['anmeldung_geschaftlich']['nachname'] ?></strong></li>
            <li>
                <strong>E-Mail</strong>
                <span><a href="mailto:<?= $new_array['anmeldung_geschaftlich']['email'] ?>"><?= $new_array['anmeldung_geschaftlich']['email'] ?></a></span>
            </li>
            <li>
                <strong>Telefonnummer</strong>
                <span><?= $new_array['anmeldung_geschaftlich']['phone'] ?></span>
            </li>
            <li>
                <strong>Straße/Hausnr.</strong>
                <span><?= $new_array['anmeldung_geschaftlich']['strabe'] ?></span>
            </li>
            <li>
                <strong>Ort</strong>
                <span><?= $new_array['anmeldung_geschaftlich']['ort'] ?></span>
            </li>
            <li>
                <strong>PLZs</strong>
                <span><?= $new_array['anmeldung_geschaftlich']['plz'] ?></span>
            </li>
            <?php
				if (!empty($new_array['anmeldung_geschaftlich']['brith-date'])) {
			?>
            <li>
            	<strong>Geburtsdatum</strong>
            	<span><?= $new_array['anmeldung_geschaftlich']['brith-date'] ?></span>
            </li>
            <?php } ?>
            <li>
                <strong>Teilnehmer</strong>
                <ol style="list-style-type:decimal">

            <?php
				/**
				 * PRINT ARRAY FOR ADITTIONAL PERSON DATA
				 */
                foreach($new_array['anmeldung_geschaftlich_plusgest'] as $person){
                    echo '<li>';
                    echo '<ul>';
                    foreach($person as $key => $value){
                        echo '<li>';

                        switch($key){
                            case 'anrede':
                                echo 'Anrede: ' . $value;
                                break;
                            case 'title':
                                echo 'Title: ' . $value;
                                break;
                            case 'vorname':
                                echo 'Vorname: ' . $value;
                                break;
                            case 'nachname':
                                echo 'Nachname: ' . $value;
                                break;
                            case 'strabe':
                                echo 'Strabe: ' . $value;
                                break;
                            case 'plz':
                                echo 'Plz: ' . $value;
                                break;
                            case 'ort':
                                echo 'Ort: ' . $value;
                                break;
                            case 'email':
                                echo 'Email: ' . $value;
                                break;
                            case 'phone':
                                echo 'Telefonnummer: ' . $value;
                                break;
                            case 'brith-date':
                                echo 'Geburtsdatum: ' . $value;
                                break;
                        }

                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '</li>';
                }
			?>
                </ol>
            </li>
            <?php
				// allow personal information at hotel
				echo '<li>';
				switch ($new_array['anmeldung_geschaftlich']['hotel-registration-data']['allowdatause']){
					case 0:
						echo 'Der Nutzer verpflichtet sich, die Anmeldedaten an das angegebene Seminarhaus zum Zwecke der Hotelbuchung und -abrechnung weiterzugeben.';
						break;
					case 2:
						echo 'Der Nutzer möchte nicht, dass die FUTURE-Die Unternehmensentwickler GmbH die Daten an das Hotel weitergibt, der Nutzer macht die Hotelbuchung selbst.';
						break;
				}
				echo '</li>';
				// room needed
				echo '<li>';
				echo '<strong>GERNE RESERVIEREN WIR FÜR SIE EIN ZIMMER:</strong>';
				switch ($new_array['anmeldung_geschaftlich']['room_needed']){
					case 0:
						echo 'ab dem Vortag.';
						break;
					case 1:
						echo 'ab dem ersten Seminartag.';
						break;
					case 2:
						echo 'es wird kein Zimmer benötigt.';
						break;
				}
				echo '</li>';
				// validate message
				if (!empty($new_array['anmeldung_geschaftlich']['room_needed'])) {
			?>
            <li>
            	<strong>MEINE NACHRICHT AN DIE MITARBEITER VON FUTURE</strong>
            	<p><?= $new_array['anmeldung_geschaftlich']['message_to_staff'] ?></p>
            </li>
            <?php } ?>
            <?php
                if ($new_array['anmeldung_geschaftlich']['dif-billing-address']['status'] == 'on'){
                    echo '<div style="border: 1px solid gray; padding: 10px">';
                    echo '<h2>Rechnungsinformationen</h2>';
                    echo '<ul>';
                    echo '<li><strong>Andere</strong> ' . $new_array['anmeldung_geschaftlich']['dif-billing-address']['andere'] . '</li>';
                    echo '<li><strong>Title</strong> ' . $new_array['anmeldung_geschaftlich']['dif-billing-address']['title'] . '</li>';
                    echo '<li><strong>Vorname</strong> ' . $new_array['anmeldung_geschaftlich']['dif-billing-address']['vorname'] . '</li>';
                    echo '<li><strong>Nachname</strong> ' . $new_array['anmeldung_geschaftlich']['dif-billing-address']['nachname'] . '</li>';
                    echo '<li><strong>Strabe</strong> ' . $new_array['anmeldung_geschaftlich']['dif-billing-address']['strabe'] . '</li>';
                    echo '<li><strong>PLZ</strong> ' . $new_array['anmeldung_geschaftlich']['dif-billing-address']['plz'] . '</li>';
                    echo '<li><strong>Ort</strong> ' . $new_array['anmeldung_geschaftlich']['dif-billing-address']['ort'] . '</li>';
                    echo '</ul>';
                    echo '</div>';
                }
            ?>
        </ul>
	<?php
	} // END Geschaftlich FORM

	$html = ob_get_contents();
    ob_end_clean();
	echo $html;
	//die;

    add_filter( 'wp_mail_content_type', 'schnell_set_html_mail_content_type' );

    $subject = 'Neuanmeldung - '
        . $new_array['anmeldung_training_name'] . ' - '
        . $new_array['anmeldung_training_start'];

    $headers = array(
        //'Content-Type: text/html; charset=UTF-8' . "\r\n",
        'From: Veranstaltungsregistrierung <info@future.at>' . "\r\n",
    );

    $body = $html;
    $mail = wp_mail($email_address, $subject, $body, $headers);

    $subjectAlt = 'Anmeldung - '
        . $new_array['anmeldung_training_name'] . ' - '
        . $new_array['anmeldung_training_start'];

    $headersAlt = array(
        //'Content-Type: text/html; charset=UTF-8' . "\r\n",
        'From: FUTURE-Die Unternehmensentwickler GmbH <info@future.at>' . "\r\n",
        'Reply-To: Anmeldungen <kontakt@future.at>' . "\r\n"
    );
    $bodyUser = 'Du hast dich erfolgreich registriert.';
    $mailtoUser = wp_mail($emailto, $subjectAlt, $bodyUser, $headersAlt);

    remove_filter( 'wp_mail_content_type', 'schnell_set_html_mail_content_type' );

	wp_die();
}
function schnell_set_html_mail_content_type() {
    return 'text/html';
}
