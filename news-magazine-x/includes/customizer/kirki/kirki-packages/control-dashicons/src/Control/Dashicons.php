<?php
/**
 * Customizer Control: dashicons.
 *
 * @package   kirki-framework/control-dashicons
 * @copyright Copyright (c) 2023, Themeum
 * @license   https://opensource.org/licenses/MIT
 * @since     1.0
 */

namespace Kirki\Control;

use Kirki\URL;
use Kirki\Control\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Dashicons control (modified radio).
 *
 * @since 1.0
 */
class Dashicons extends Base {

	/**
	 * The control type.
	 *
	 * @access public
	 * @since 1.0
	 * @var string
	 */
	public $type = 'kirki-dashicons';

	/**
	 * The version. Used in scripts & styles for cache-busting.
	 *
	 * @static
	 * @access public
	 * @since 1.0.2
	 * @var string
	 */
	public static $control_ver = '1.0';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function enqueue() {
		parent::enqueue();

		// Enqueue the script.
		wp_enqueue_script( 'kirki-control-dashicons', URL::get_from_path( dirname(dirname( __DIR__ )) . '/dist/control.js' ), [ 'jquery', 'customize-base', 'kirki-control-base' ], self::$control_ver, false );

		// Enqueue the style.
		wp_enqueue_style( 'kirki-control-dashicons-style', URL::get_from_path( dirname(dirname( __DIR__ )) . '/dist/control.css' ), [ 'dashicons' ], self::$control_ver );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['icons'] = \Kirki\Util\Dashicons::get_icons();
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
	 * @since 1.0
	 * @return void
	 */
	protected function content_template() {
		?>
		<# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
		<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><# } #>
		<div class="icons-wrapper">
			<# if ( ! _.isUndefined( data.choices ) && 1 < _.size( data.choices ) ) { #>
				<# for ( key in data.choices ) { #>
					<input {{{ data.inputAttrs }}} class="dashicons-select" type="radio" value="{{ key }}" name="_customize-dashicons-radio-{{ data.id }}" id="{{ data.id }}{{ key }}" {{{ data.link }}}<# if ( data.value === key ) { #> checked="checked"<# } #>>
						<label for="{{ data.id }}{{ key }}"><span class="dashicons dashicons-{{ data.choices[ key ] }}"></span></label>
					</input>
				<# } #>
			<# } else { #>
				<#
				var dashiconSections = {
					'admin-menu': '<?php esc_html_e( 'Admin Menu', 'news-magazine-x' ); ?>',
					'welcome-screen': '<?php esc_html_e( 'Welcome Screen', 'news-magazine-x' ); ?>',
					'post-formats': '<?php esc_html_e( 'Post Formats', 'news-magazine-x' ); ?>',
					'media': '<?php esc_html_e( 'Media', 'news-magazine-x' ); ?>',
					'image-editing': '<?php esc_html_e( 'Image Editing', 'news-magazine-x' ); ?>',
					'tinymce': 'TinyMCE',
					'posts': '<?php esc_html_e( 'Posts', 'news-magazine-x' ); ?>',
					'sorting': '<?php esc_html_e( 'Sorting', 'news-magazine-x' ); ?>',
					'social': '<?php esc_html_e( 'Social', 'news-magazine-x' ); ?>',
					'wordpress_org': 'WordPress',
					'products': '<?php esc_html_e( 'Products', 'news-magazine-x' ); ?>',
					'taxonomies': '<?php esc_html_e( 'Taxonomies', 'news-magazine-x' ); ?>',
					'widgets': '<?php esc_html_e( 'Widgets', 'news-magazine-x' ); ?>',
					'notifications': '<?php esc_html_e( 'Notifications', 'news-magazine-x' ); ?>',
					'misc': '<?php esc_html_e( 'Miscelaneous', 'news-magazine-x' ); ?>'
				};
				#>
				<# _.each( dashiconSections, function( sectionLabel, sectionKey ) { #>
					<h4>{{ sectionLabel }}</h4>
					<# for ( key in data.icons[ sectionKey ] ) { #>
						<input {{{ data.inputAttrs }}}
							class="dashicons-select"
							type="radio"
							value="{{ data.icons[ sectionKey ][ key ] }}"
							name="_customize-dashicons-radio-{{ data.id }}"
							id="{{ data.id }}{{ data.icons[ sectionKey ][ key ] }}"
							{{{ data.link }}}
							<# if ( data.value === data.icons[ sectionKey ][ key ] ) { #> checked="checked"<# } #>>
							<label for="{{ data.id }}{{ data.icons[ sectionKey ][ key ] }}">
								<span class="dashicons dashicons-{{ data.icons[ sectionKey ][ key ] }}"></span>
							</label>
						</input>
					<# } #>
				<# }); #>
			<# } #>
		</div>
		<?php
	}
}
