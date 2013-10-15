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

// Only load the library if it hasn't already been loaded. This will prevent#
// clashes if multiple plugins using the same library.
if ( !defined( 'SAP_TEXTDOMAIN' ) ) {

	// Set a textdomain for translation
	define( 'SAP_TEXTDOMAIN', 'sapdomain' );
	
	// Register the version of the library. This is not the public version
	// number (ie - 1.0), but an internal integer we can compare easily to
	// determine if an out-of-date version of the library is being used.
	define( 'SAP_VERSION', 1); // @version

	// Make sure we have access to WordPress's plugin functions
	require_once(ABSPATH . '/wp-admin/includes/plugin.php');

	// Load the library's classes
	require_once('classes/AdminPage.class.php');

} else {

	// Compare the versions to see if they need to be bumped.
	if ( SAP_VERSION < 1 ) { // @version
		// @todo I should display a notice that informs the user that an older
		// version of this library is being used.
		
		// @todo Maybe there is a better way. Maybe an abstract class like
		// sapLibrary which each plugin uses to declare the version they're
		// built against. Then the classes will only be declared if their
		// version matches the sapLibrary version. Something like:
		// $lib = new sapLibrary( '1.0' );
		// $lib->setup(); // loads necessary class files
		// 
		// then in the class definitions:
		//
		// if ($lib->version == '1.0') {
		// 	class sapAdminPage { }
		// }
		// 
		// maybe this would mean the proper version of the classes were loaded?
		// no i dont think it would, because each library is going to load its
		// own on every page load anyway.
	}
}
