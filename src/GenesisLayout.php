<?php
/**
 * Register and unregister Genesis layouts through configuration.
 *
 * @package   D2\Core
 * @author    Craig Simpson <craig@craigsimpson.scot>
 * @copyright 2018, Craig Simpson
 * @license   MIT
 */

namespace D2\Core;

/**
 * Register and unregister Genesis layouts through configuration.
 *
 * Example config (usually located at config/defaults.php):
 *
 * ```
 * use D2\Core\GenesisLayout;
 *
 * $d2_layouts = [
 *     GenesisLayout::REGISTER   => [
 *         'slim-content', [
 *             'label' => 'Slim Content Area',
 *             'image' => get_stylesheet_directory_uri() . '/images/slim-content-icon.png',
 *         ],
 *     ],
 *     GenesisLayout::UNREGISTER => [
 *         GenesisLayout::SIDEBAR_CONTENT,
 *         GenesisLayout::CONTENT_SIDEBAR_SIDEBAR,
 *         GenesisLayout::SIDEBAR_CONTENT_SIDEBAR,
 *         GenesisLayout::SIDEBAR_SIDEBAR_CONTENT,
 *     ],
 * ];
 *
 * return [
 *     GenesisLayout::class => $d2_layouts,
 * ];
 * ```
 *
 * @package D2\Core
 */
class GenesisLayout extends Core {

	const REGISTER                = 'register';
	const UNREGISTER              = 'unregister';
	const FULL_WIDTH_CONTENT      = 'full-width-content';
	const CONTENT_SIDEBAR         = 'content-sidebar';
	const SIDEBAR_CONTENT         = 'sidebar-content';
	const CONTENT_SIDEBAR_SIDEBAR = 'content-sidebar-sidebar';
	const SIDEBAR_CONTENT_SIDEBAR = 'sidebar-content-sidebar';
	const SIDEBAR_SIDEBAR_CONTENT = 'sidebar-sidebar-content';

	/**
	 * Register and unregister Genesis layouts through configuration.
	 *
	 * @return void
	 */
	public function init() {
		if ( array_key_exists( self::REGISTER, $this->config ) ) {
			array_map( 'genesis_register_layout', array_keys( $this->config[ self::REGISTER ] ), $this->config[ self::REGISTER ] );
		}

		if ( array_key_exists( self::UNREGISTER, $this->config ) ) {
			add_action( 'init', [ $this, 'unregister' ], 11 );
		}
	}
	
	/**
	 * Unregister Genesis layout.
	 *
	 * @since 0.1.1
	 *
	 * @return array
	 */
	public function unregister() {
		return array_map( 'genesis_unregister_layout', $this->config[ self::UNREGISTER ] );
	}
}
