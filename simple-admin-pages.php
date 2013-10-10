<?php

/**
 * Simple Admin Pages
 *
 * This is a very small utility library to easily add new admin pages to the
 * WordPress admin interface. It simply collects WordPress' useful Settings API
 * into reuseable classes.
 *
 * Created by Nate Wright
 *
 *
 * @since 1.0
 * @package Simple Admin Pages
 *
 * @todo license
 * @todo readme
 */

// Make sure we have access to WordPress's plugin functions
require_once(ABSPATH . '/wp-admin/includes/plugin.php');

// Load the library's classes
require_once('classes/AdminPage.class.php');