<?php

/**
 * Register, display and save a section on a custom admin menu
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

class sapAdminPageSection {

	// Page defaults
	public $id; // unique id for this section
	public $title; // optional title to display above this section
	public $description; // optional description of the section
	public $settings = array(); // Array of settings to display in this option set
	
	private $setting_class_name = 'sapAdminPageSetting';


	/**
	 * Initialize the section
	 * @since 1.0
	 */
	public function __construct( $id, $title, $description ) {

		$this->id = esc_attr( $id );
		$this->title = $title;
		$this->description = $description;

	}
	
	/**
	 * Add an setting to this section
	 * @since 1.0
	 */
	public function add_setting( $setting ) {
		if ( !$setting || !is_subclass_of( $setting, $this->setting_class_name ) ) {
			return;
		}
		
		array_push( $this->settings, $setting );
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
	
}
