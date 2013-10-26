<?php

/**
 * Register, display and save an settings page in the WordPress admin menu.
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

require_once('AdminPageSection.class.php');
require_once('AdminPageSetting.class.php');
require_once('AdminPageSetting.Text.class.php');
require_once('AdminPageSetting.Textarea.class.php');
require_once('AdminPageSetting.Select.class.php');
require_once('AdminPageSetting.Checkbox.class.php');
require_once('AdminPageSetting.OpeningHours.class.php');
require_once('AdminPageSetting.SelectPost.class.php');
require_once('AdminPageSetting.SelectTaxonomy.class.php');

class sapAdminPage {

	public $title;
	public $title_menu;
	public $description; // optional description for this page
	public $capability; // user permissions needed to edit this panel
	public $slug; // id of this page
	public $lib_url; // url to this library
	public $icon = 'icon-options-general';
	public $sections = array(); // array of sections to display on this page
	
	private $section_class_name = 'sapAdminPageSection';


	/**
	 * Initialize the page
	 * @since 1.0
	 */
	public function __construct( $title, $title_menu, $description, $capability, $slug, $lib_url ) {

		$this->title = $title;
		$this->title_menu = $title_menu;
		$this->description = $description;
		$this->capability = $capability;
		$this->slug = esc_attr( $slug ); // id of this page
		$this->lib_url = esc_url( $lib_url ); // id of this page
		
		add_action( 'admin_print_styles', array( $this, 'enqueue_scripts' ) );

	}

	/**
	 * Add the page to the appropriate menu slot.
	 * @note The default will be to post to the options page, but other classes
	 *			should override this function.
	 * @since 1.0
	 */
	public function add_admin_menu() {
		add_options_page( $this->title, $this->title_menu, $this->capability, $this->slug, array( $this, 'display_admin_menu' ) );
	}

	/**
	 * Add a section to the page
	 * @since 1.0
	 */
	public function add_section( $section ) {
		if ( !$section || !get_class( $section ) == $this->section_class_name ) {
			return;
		}

		array_push( $this->sections, $section );
	}

	/**
	 * Register the settings and sanitization callbacks for each setting
	 * @since 1.0
	 */
	public function register_admin_menu() {

		// Loop over each section
		foreach ( $this->sections as $section ) {
			$section->add_settings_section( $this->slug );

			// Loop over each setting
			foreach ( $section->settings as $setting ) {
				$setting->add_register_setting( $this->slug, $section->id );
			}
		}
	}


	/**
	 * Output the settings passed to this page
	 * @todo the values of the fields should probably be fetched here
	 * @todo maybe here is where the fields should be registered as well?
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
					<?php settings_fields( $this->slug ); ?>
					<?php do_settings_sections( $this->slug ); ?>
					<?php submit_button(); ?>
				 </form>
			</div>

		<?php
	}

	/**
	 * Output the title of the page
	 * @since 1.0
	 */
	public function display_page_title() {

		if ( !$this->title ) {
			return;
		}
		?>
			<div id="<?php echo $this->icon; ?>" class="icon32"><br /></div>
			<h2><?php echo $this->title; ?></h2>
		<?php
	}

	/**
	 * Loop over the sections and call the display function for each
	 * @since 1.0
	 */
	public function display_sections() {
		foreach ( $this->sections as $setting ) {
			$section->display_section();
		}
	}

	/**
	 * Display the submit button
	 * @since 1.0
	 */
	public function display_submit_button() {
		?>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  /></p>
		<?php
	}

	/**
	 * Enqueue the CSS stylesheet
	 * @since 1.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'esp-admin-style', $this->lib_url . 'css/admin.css' );
		wp_enqueue_script( 'esp-admin-script', $this->lib_url . 'js/admin.js', array( 'jquery' ), '1.0', true );
	}

}
