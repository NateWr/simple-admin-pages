<?php

/**
 * Register, display and save a setting on a custom admin menu
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

abstract class sapAdminPageSetting {

	// Page defaults
	public $id; // used in form fields and database to track and store setting
	public $title; // setting label
	public $description; // optional description of the setting
	public $value; // value of the setting, if a value exists

	/*
	 * Function to use when sanitizing the data
	 *
	 * We set this to null in this class to prevent it from being used to
	 * register a setting. $this->register_setting() will not be successful if
	 * no $sanitize_callback value is found.
	 *
	 * @since 1.0
	 */
	private $sanitize_callback = null; // sanitize the incoming data


	/**
	 * Initialize the setting
	 * @since 1.0
	 */
	public function __construct( $id, $title, $description ) {

		$this->id = esc_attr( $id );
		$this->title = $title;
		$this->description = $description;
		$this->value = $this->esc_value( get_option ( $this->id ) );

	}
	
	/**
	 * Escape the value to display it in text fields and other input fields
	 *
	 * We use esc_attr() here so that the default is quite strict, but other
	 * setting types should override this function with the appropriate escape
	 * function. See: http://codex.wordpress.org/Data_Validation
	 *
	 * @since 1.0
	 */
	public function esc_value( $val ) {
		return esc_attr( $val );
	}
	

	/**
	 * Display this setting
	 * @since 1.0
	 */
	abstract public function display_setting();
	
	/**
	 * Display a description for this setting
	 * @since 1.0
	 */
	public function display_description() {

		if ( trim( $this->description ) != '' ) {
		
		?>
		
			<p class="description"><?php echo $this->description; ?></p>

		<?php
		
		}
	}

	/**
	 * Register this setting
	 * @since 1.0
	 */
	public function register_setting() {

		/*
		 * If no sanitization callback exists, don't register the setting. This
		 * also prevents someone from accidentally trying to register a page
		 * setting using this class instead of a class which extends this class.
		 */
		if ( !isset( $this->sanitize_callback ) || !trim( $this->sanitize_callback ) ) {
			return;
		}

		register_setting( $this->slug, $option->id, $this->sanitize_callback );

	}

}
