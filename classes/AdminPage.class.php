<?php

/**
 * Register, display and save a settings page in the WordPress admin menu.
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

class sapAdminPage_2_0_a_1 {

	public $title;
	public $menu_title;
	public $description; // optional description for this page
	public $capability; // user permissions needed to edit this panel
	public $id; // id of this page
	public $sections = array(); // array of sections to display on this page
	public $show_button = true; // whether or not to show the Save Changes button

	public $setup_function = 'add_options_page'; // WP function to register the page


	/**
	 * Initialize the page
	 * @since 1.0
	 */
	public function __construct( $args ) {

		// Parse the values passed
		$this->parse_args( $args );

	}

	/**
	 * Parse the arguments passed in the construction and assign them to
	 * internal variables.
	 * @since 1.1
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
	 * Add the page to the appropriate menu slot.
	 * @note The default will be to post to the options page, but other classes
	 *			should override this function.
	 * @since 1.0
	 */
	public function add_admin_menu() {
		call_user_func( $this->setup_function, $this->title, $this->menu_title, $this->capability, $this->id, array( $this, 'display_admin_menu' ) );
	}

	/**
	 * Add a section to the page
	 * @since 1.0
	 */
	public function add_section( $section ) {

		if ( !$section ) {
			return;
		}

		$this->sections[ $section->id ] = $section;

	}

	/**
	 * Register the settings and sanitization callbacks for each setting
	 * @since 1.0
	 */
	public function register_admin_menu() {

		foreach ( $this->sections as $section ) {
			$section->add_settings_section( $this->id ); // @todo tab: settings should use their tab slug if needed. can i put this into the section class?

			foreach ( $section->settings as $setting ) {
				$setting->add_settings_field( $this->id, $section->id );
			}
		}

		register_setting( $this->id, $this->id, array( $this, 'sanitize_callback' ) );
	}

	/**
	 * Loop through the settings and sanitize the data
	 * @since 2.0
	 */
	public function sanitize_callback( $value ) {

		foreach ( $this->sections as $section ) {
			foreach ( $section->settings as $setting ) {
				if ( isset( $value[$this->id] ) ) {
					$value[$this->id] = $setting->sanitize_callback_wrapper( $value[$this->id] );
				} else {
					unset( $value[$this->id] );
				}
			}
		}
		
		return $value;

	}

	/**
	 * Output the settings passed to this page
	 * @since 1.0
	 */
	public function display_admin_menu() {

		if ( !$this->title && !count( $this->settings ) ) {
			return;
		}
		?>

			<div class="wrap">

				<?php $this->display_page_title(); ?>

				<form method="post" action="options.php">
					<?php settings_fields( $this->id ); ?>
					<?php do_settings_sections( $this->id ); ?>
					<?php if ( $this->show_button ) { submit_button(); } ?>
				 </form>
			</div>

		<?php
	}

	/**
	 * Output the title of the page
	 * @since 1.0
	 */
	public function display_page_title() {

		if ( empty( $this->title ) ) {
			return;
		}
		?>
			<h2><?php echo $this->title; ?></h2>
		<?php
	}

}
