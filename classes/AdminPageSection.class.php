<?php

/**
 * Register, display and save a section on a custom admin menu
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

class sapAdminPageSection_1_1 {

	// Page defaults
	public $id; // unique id for this section
	public $title; // optional title to display above this section
	public $description; // optional description of the section
	public $settings = array(); // Array of settings to display in this option set
	
	// Array to store errors
	public $errors = array();

	/**
	 * Initialize the section
	 * @since 1.0
	 */
	public function __construct( $args ) {

		// Parse the values passed
		$this->parse_args( $args );

		// Set an error if there is no id for this section
		if ( !isset( $this->id ) ) {
			$this->set_error(
				array( 
					'type'		=> 'missing_data',
					'data'		=> 'id'
				)
			);
		}

	}

	/**
	 * Parse the arguments passed in the construction and assign them to
	 * internal variables.
	 * @since 1.0
	 */
	private function parse_args( $args ) {
		foreach ( $args as $key => $val ) {
			switch ( $key ) {

				case 'id' :
					$this->{$key} = esc_attr( $val );
				
				default :
					$this->{$key} = $val;
					
			}
		}
	}
	
	/**
	 * Add an setting to this section
	 * @since 1.0
	 */
	public function add_setting( $setting ) {
		if ( !$setting ) {
			return;
		}
		
		$this->settings[ $setting->id ] = $setting;
	}

	/**
	 * Display the description for this section
	 * @since 1.0
	 */
	public function display_section() {
	
		if ( !count( $this->settings ) ) {
			return;
		}
		
		if ( trim( $this->description ) != '' ) :
		?>
		
			<p class="description"><?php echo $this->description; ?></p>

		<?php
		endif;
	}
	
	/**
	 * Add the settings section to the page in WordPress
	 * @since 1.0
	 */
	public function add_settings_section( $page_slug ) {
		add_settings_section( $this->id, $this->title, array( $this, 'display_section' ), $page_slug );
	}
	
	/**
	 * Set an error
	 * @since 1.0
	 */
	public function set_error( $error ) {
		$this->errors[] = array_merge(
			$error,
			array(
				'class'		=> get_class( $this ),
				'id'		=> $this->id,
				'backtrace'	=> debug_backtrace()
			)
		);
	}
	
}
