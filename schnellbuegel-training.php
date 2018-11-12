<?php
/*
 * Plugin Name: Schnellbuegel Training
 * Plugin URI: https://palacios-online.de/
 * Version: 0.1
 * Description: Plugin für Trainingsplanung
 * Author: José Rodriguez and The Palacios Online Team
 * Author URI: https://palacios-online.de/
 * Text Domain: schnell
 * Domain Path: /languages
 * License: GPLv2 or later
 */
/*
    Schnellbuegel Training is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 2 of the License, or
    any later version.

    Schnellbuegel Training is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Schnellbuegel Training.
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'SCHNELL_PLUGIN_DIR', trailingslashit( dirname(__FILE__) ) );
define( 'SCHNELL_PLUGIN_URI', plugins_url('', __FILE__) );

require_once 'schnell-setup.php';

/* BACKEND DEPENDENCIES */
require_once 'backend/schnell-training-cpt.php';
require_once 'backend/schnell-training-tax.php';
require_once 'backend/schnell-training-metaboxes-experts.php';
require_once 'backend/schnell-training-metaboxes-locations.php';
require_once 'backend/schnell-training-metaboxes-trainings.php';
require_once 'backend/schnell-training-metaboxes-events.php';


/* EMAIL */
require_once 'emails/schnell-emails.php';

/* FRONTEND DEPENDENCIES */
require_once 'frontend/schnell-divi-cpt-support.php';
require_once 'frontend/schnell-show-posts-functions.php';


