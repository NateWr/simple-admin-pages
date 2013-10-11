<?php

/**
 * Register, display and save a selection with a drop-down list of any post type
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

class sapAdminPageSettingSelectPost extends sapAdminPageSetting {

	public $sanitize_callback = 'sanitize_text_field';

	// Whether or not to display a blank option
	public $blank_option = true;

	/**
	 * An array of arguments accepted by get_posts().
	 * See: http://codex.wordpress.org/Template_Tags/get_posts
	 */
	public $args = array();

	/**
	 * Initialize the setting
	 * @since 1.0
	 */
	public function __construct( $id, $title, $description, $args = array(), $blank_option = true ) {

		$this->id = esc_attr( $id );
		$this->title = $title;
		$this->description = $description;
		$this->blank_option = $blank_option;
		$this->args = $args;
		$this->value = $this->esc_value( get_option ( $this->id ) );

	}

	/**
	 * Display this setting
	 * @since 1.0
	 */
	public function display_setting() {

		$posts = get_posts( $this->args );

		?>

			<select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">

				<?php if ( $this->blank_option === true ) : ?>
					<option></option>
				<?php endif; ?>

				<?php foreach ( $posts as $post  ) : ?>
					<option value="<?php echo esc_attr( $post->ID ); ?>"<?php if( $this->value == $post->ID ) : ?> selected="selected"<?php endif; ?>><?php echo esc_html( $post->post_title ); ?></option>
				<?php endforeach; ?>

			</select>

		<?php

		$this->display_description();

	}

}
