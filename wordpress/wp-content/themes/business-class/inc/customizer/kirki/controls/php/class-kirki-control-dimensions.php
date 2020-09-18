<?php
/**
 * Customizer Control: dimensions.
 *
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2019, Ari Stathopoulos (@aristath)
 * @license     https://opensource.org/licenses/MIT
 * @since       2.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Dimensions control.
 * multiple fields with CSS units validation.
 */
class Business_Class_Customizer_Control_Dimensions extends Business_Class_Customizer_Control_Base {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'kirki-dimensions';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		if ( is_array( $this->choices ) ) {
			foreach ( $this->choices as $choice => $value ) {
				if ( 'labels' !== $choice && true === $value ) {
					$this->json['choices'][ $choice ] = true;
				}
			}
		}
		if ( is_array( $this->json['default'] ) ) {
			foreach ( $this->json['default'] as $key => $value ) {
				if ( isset( $this->json['choices'][ $key ] ) && ! isset( $this->json['value'][ $key ] ) ) {
					$this->json['value'][ $key ] = $value;
				}
			}
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_style( 'kirki-styles', trailingslashit( Business_Class_Customizer::$url ) . 'controls/css/styles.css', array(), BUSINESS_CLASS_CUSTOMIZER_VERSION );
		wp_localize_script( 'kirki-script', 'dimensionskirkiL10n', $this->l10n() );
	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<label>
			<# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
			<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><# } #>
			<div class="wrapper">
				<div class="control">
					<# for ( choiceKey in data.default ) { #>
						<div class="{{ choiceKey }}">
							<h5>
								<# if ( ! _.isUndefined( data.choices.labels ) && ! _.isUndefined( data.choices.labels[ choiceKey ] ) ) { #>
									{{ data.choices.labels[ choiceKey ] }}
								<# } else if ( ! _.isUndefined( data.l10n[ choiceKey ] ) ) { #>
									{{ data.l10n[ choiceKey ] }}
								<# } else { #>
									{{ choiceKey }}
								<# } #>
							</h5>
							<div class="{{ choiceKey }} input-wrapper">
								<# var val = ( ! _.isUndefined( data.value ) && ! _.isUndefined( data.value[ choiceKey ] ) ) ? data.value[ choiceKey ].toString().replace( '%%', '%' ) : ''; #>
								<input {{{ data.inputAttrs }}} type="text" data-choice="{{ choiceKey }}" value="{{ val }}"/>
							</div>
						</div>
					<# } #>
				</div>
			</div>
		</label>
		<?php
	}

	/**
	 * Returns an array of translation strings.
	 *
	 * @access protected
	 * @since 3.0.0
	 * @return array
	 */
	protected function l10n() {
		return array(
			'left-top'       => esc_html__( 'Left Top', 'business-class' ),
			'left-center'    => esc_html__( 'Left Center', 'business-class' ),
			'left-bottom'    => esc_html__( 'Left Bottom', 'business-class' ),
			'right-top'      => esc_html__( 'Right Top', 'business-class' ),
			'right-center'   => esc_html__( 'Right Center', 'business-class' ),
			'right-bottom'   => esc_html__( 'Right Bottom', 'business-class' ),
			'center-top'     => esc_html__( 'Center Top', 'business-class' ),
			'center-center'  => esc_html__( 'Center Center', 'business-class' ),
			'center-bottom'  => esc_html__( 'Center Bottom', 'business-class' ),
			'font-size'      => esc_html__( 'Font Size', 'business-class' ),
			'font-weight'    => esc_html__( 'Font Weight', 'business-class' ),
			'line-height'    => esc_html__( 'Line Height', 'business-class' ),
			'font-style'     => esc_html__( 'Font Style', 'business-class' ),
			'letter-spacing' => esc_html__( 'Letter Spacing', 'business-class' ),
			'word-spacing'   => esc_html__( 'Word Spacing', 'business-class' ),
			'top'            => esc_html__( 'Top', 'business-class' ),
			'bottom'         => esc_html__( 'Bottom', 'business-class' ),
			'left'           => esc_html__( 'Left', 'business-class' ),
			'right'          => esc_html__( 'Right', 'business-class' ),
			'center'         => esc_html__( 'Center', 'business-class' ),
			'size'           => esc_html__( 'Size', 'business-class' ),
			'spacing'        => esc_html__( 'Spacing', 'business-class' ),
			'width'          => esc_html__( 'Width', 'business-class' ),
			'height'         => esc_html__( 'Height', 'business-class' ),
			'invalid-value'  => esc_html__( 'Invalid Value', 'business-class' ),
		);
	}
}
