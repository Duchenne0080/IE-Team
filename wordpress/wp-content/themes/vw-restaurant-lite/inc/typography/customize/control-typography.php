<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Restaurant_Lite_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-restaurant-lite' ),
				'family'      => esc_html__( 'Font Family', 'vw-restaurant-lite' ),
				'size'        => esc_html__( 'Font Size',   'vw-restaurant-lite' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-restaurant-lite' ),
				'style'       => esc_html__( 'Font Style',  'vw-restaurant-lite' ),
				'line_height' => esc_html__( 'Line Height', 'vw-restaurant-lite' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-restaurant-lite' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-restaurant-lite-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-restaurant-lite-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-restaurant-lite' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-restaurant-lite' ),
        'Acme' => __( 'Acme', 'vw-restaurant-lite' ),
        'Anton' => __( 'Anton', 'vw-restaurant-lite' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-restaurant-lite' ),
        'Arimo' => __( 'Arimo', 'vw-restaurant-lite' ),
        'Arsenal' => __( 'Arsenal', 'vw-restaurant-lite' ),
        'Arvo' => __( 'Arvo', 'vw-restaurant-lite' ),
        'Alegreya' => __( 'Alegreya', 'vw-restaurant-lite' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-restaurant-lite' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-restaurant-lite' ),
        'Bangers' => __( 'Bangers', 'vw-restaurant-lite' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-restaurant-lite' ),
        'Bad Script' => __( 'Bad Script', 'vw-restaurant-lite' ),
        'Bitter' => __( 'Bitter', 'vw-restaurant-lite' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-restaurant-lite' ),
        'BenchNine' => __( 'BenchNine', 'vw-restaurant-lite' ),
        'Cabin' => __( 'Cabin', 'vw-restaurant-lite' ),
        'Cardo' => __( 'Cardo', 'vw-restaurant-lite' ),
        'Courgette' => __( 'Courgette', 'vw-restaurant-lite' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-restaurant-lite' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-restaurant-lite' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-restaurant-lite' ),
        'Cuprum' => __( 'Cuprum', 'vw-restaurant-lite' ),
        'Cookie' => __( 'Cookie', 'vw-restaurant-lite' ),
        'Chewy' => __( 'Chewy', 'vw-restaurant-lite' ),
        'Days One' => __( 'Days One', 'vw-restaurant-lite' ),
        'Dosis' => __( 'Dosis', 'vw-restaurant-lite' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-restaurant-lite' ),
        'Economica' => __( 'Economica', 'vw-restaurant-lite' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-restaurant-lite' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-restaurant-lite' ),
        'Francois One' => __( 'Francois One', 'vw-restaurant-lite' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-restaurant-lite' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-restaurant-lite' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-restaurant-lite' ),
        'Handlee' => __( 'Handlee', 'vw-restaurant-lite' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-restaurant-lite' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-restaurant-lite' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-restaurant-lite' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-restaurant-lite' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-restaurant-lite' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-restaurant-lite' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-restaurant-lite' ),
        'Kanit' => __( 'Kanit', 'vw-restaurant-lite' ),
        'Lobster' => __( 'Lobster', 'vw-restaurant-lite' ),
        'Lato' => __( 'Lato', 'vw-restaurant-lite' ),
        'Lora' => __( 'Lora', 'vw-restaurant-lite' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-restaurant-lite' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-restaurant-lite' ),
        'Merriweather' => __( 'Merriweather', 'vw-restaurant-lite' ),
        'Monda' => __( 'Monda', 'vw-restaurant-lite' ),
        'Montserrat' => __( 'Montserrat', 'vw-restaurant-lite' ),
        'Muli' => __( 'Muli', 'vw-restaurant-lite' ),
        'Marck Script' => __( 'Marck Script', 'vw-restaurant-lite' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-restaurant-lite' ),
        'Open Sans' => __( 'Open Sans', 'vw-restaurant-lite' ),
        'Overpass' => __( 'Overpass', 'vw-restaurant-lite' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-restaurant-lite' ),
        'Oxygen' => __( 'Oxygen', 'vw-restaurant-lite' ),
        'Orbitron' => __( 'Orbitron', 'vw-restaurant-lite' ),
        'Patua One' => __( 'Patua One', 'vw-restaurant-lite' ),
        'Pacifico' => __( 'Pacifico', 'vw-restaurant-lite' ),
        'Padauk' => __( 'Padauk', 'vw-restaurant-lite' ),
        'Playball' => __( 'Playball', 'vw-restaurant-lite' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-restaurant-lite' ),
        'PT Sans' => __( 'PT Sans', 'vw-restaurant-lite' ),
        'Philosopher' => __( 'Philosopher', 'vw-restaurant-lite' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-restaurant-lite' ),
        'Poiret One' => __( 'Poiret One', 'vw-restaurant-lite' ),
        'Quicksand' => __( 'Quicksand', 'vw-restaurant-lite' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-restaurant-lite' ),
        'Raleway' => __( 'Raleway', 'vw-restaurant-lite' ),
        'Rubik' => __( 'Rubik', 'vw-restaurant-lite' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-restaurant-lite' ),
        'Russo One' => __( 'Russo One', 'vw-restaurant-lite' ),
        'Righteous' => __( 'Righteous', 'vw-restaurant-lite' ),
        'Slabo' => __( 'Slabo', 'vw-restaurant-lite' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-restaurant-lite' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-restaurant-lite'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-restaurant-lite' ),
        'Sacramento' => __( 'Sacramento', 'vw-restaurant-lite' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-restaurant-lite' ),
        'Tangerine' => __( 'Tangerine', 'vw-restaurant-lite' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-restaurant-lite' ),
        'VT323' => __( 'VT323', 'vw-restaurant-lite' ),
        'Varela Round' => __( 'Varela Round', 'vw-restaurant-lite' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-restaurant-lite' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-restaurant-lite' ),
        'Volkhov' => __( 'Volkhov', 'vw-restaurant-lite' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-restaurant-lite' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-restaurant-lite' ),
			'100' => esc_html__( 'Thin',       'vw-restaurant-lite' ),
			'300' => esc_html__( 'Light',      'vw-restaurant-lite' ),
			'400' => esc_html__( 'Normal',     'vw-restaurant-lite' ),
			'500' => esc_html__( 'Medium',     'vw-restaurant-lite' ),
			'700' => esc_html__( 'Bold',       'vw-restaurant-lite' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-restaurant-lite' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'normal'  => esc_html__( 'Normal', 'vw-restaurant-lite' ),
			'italic'  => esc_html__( 'Italic', 'vw-restaurant-lite' ),
			'oblique' => esc_html__( 'Oblique', 'vw-restaurant-lite' )
		);
	}
}