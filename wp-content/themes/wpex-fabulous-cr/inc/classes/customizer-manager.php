<?php
/**
 * Creates the admin panel for the WordPress customizer
 *
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2014, Symple Workz LLC
 * @link		http://www.wpexplorer.com
 * @version		1.0.0
 */

// Only Needed in the admin
if ( ! is_admin() ) {
	return;
}

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// The class
if ( ! class_exists( 'WPEX_Customizer_Manager' ) ) {
	class WPEX_Customizer_Manager {

		 /**
         * Check if the class should run or not
         *
         * @since 1.0.0
         *
         * @var bool
         */
        public $run_class = true;

		/**
		 * Start things up
		 */
		public function __construct() {

			// Check if class should run or not, good for disabling via child themes
			$run_class = apply_filters( 'wpex_customizer_manager_init_class', $this->run_class );
            if ( ! $run_class ) {
                return;
            }

            /*WALTER*/

            /*

            // Add admin submenu page
			add_action( 'admin_menu', array( $this, 'add_submenu_page' ), 9999 );

			// Register admin settings
			add_action( 'admin_init', array( $this, 'register_settings' ) );

			// Display notices on admin save
			add_action( 'admin_notices', array( $this, 'settings_errors' ) );
            */
		}

		/**
		 * Add sub menu page to the Appearance menu.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_page
		 */
		public function add_submenu_page() {
			add_submenu_page(
				'themes.php',
				__( 'Customizer Manager', 'wpex' ),
				__( 'Customizer Manager', 'wpex' ),
				'manage_options',
				'wpex-customizer-manager',
				array( $this, 'options_page' )
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_setting
		 */
		public function register_settings() {
			register_setting(
				'wpex_customizer_options',
				'wpex_customizer_options',
				array( $this, 'sanitize' )
			);
		}

		/**
		 * Displays all messages registered to 'wpex-customizer-manager-notices'
		 *
		 * @link http://codex.wordpress.org/Function_Reference/settings_errors
		 */
		public function settings_errors() {
			settings_errors( 'wpex-customizer-manager-notices' );
		}

		/**
		 * Sanitization callback
		 */
		public function sanitize( $options ) {

			if ( ! isset( $options ) ) {
				return;
			}

			// Delete options if import set to -1
			if ( '-1' == $options['reset'] ) {

				// Get menu locations
				$locations = get_theme_mod( 'nav_menu_locations' );
				$save_menus = array();
				foreach( $locations as $key => $val ) {
					$save_menus[$key] = $val;
				}

				// Remove all mods
				remove_theme_mods();

				// Re-add the menus
				set_theme_mod( 'nav_menu_locations', array_map( 'absint', $save_menus ) );

				// Error messages
				$error_msg = __( 'All theme customizer settings have been reset.', 'wpex' );
				$error_type = 'updated';
			}

			// Set theme mods based on json data
			elseif( ! empty( $options['import'] ) ) {

				// Decode input data
				$theme_mods = json_decode( $options['import'], true );

				// Validate json file then set new theme options
				if ( '0' == json_last_error() ) {
					foreach ( $theme_mods as $theme_mod => $value ) {
						set_theme_mod( $theme_mod, $value );
					}
					$error_msg  = __( 'Theme customizer settings imported successfully.', 'wpex' );
					$error_type = 'updated';
				}

				// Display invalid json data error
				else {
					$error_msg  = __( 'Invalid Import Data.', 'wpex' );
					$error_type = 'error';
				}

			}
			// No json data entered
			else {
				$error_msg = __( 'No import data found.', 'wpex' );
				$error_type = 'error';
			}

			// Make sure the settings data is reset! 
			$options = array(
				'import'	=> '',
				'reset'		=> '',
			);

			// Display message
			add_settings_error(
				'wpex-customizer-manager-notices',
				esc_attr( 'settings_updated' ),
				$error_msg,
				$error_type
			);

			// Return options
			return $options;

		}

		/**
		 * Settings page output, renders the admin page
		 */	
		public function options_page() { ?>
			<div class="wrap">
				<h2><?php _e( 'Import, Export or Reset Customizer Settings', 'wpex' ); ?></h2>
				<?php
				// Default options
				$options = array(
						'import'	=> '',
						'reset'		=> '',
				); ?>
				<form method="post" action="options.php">
					<?php
					/**
					 * Output nonce, action, and option_page fields for a settings page
					 *
					 * @link http://codex.wordpress.org/Function_Reference/settings_fields
					 */
					$options = get_option( 'wpex_customizer_options', $options );
					settings_fields( 'wpex_customizer_options' ); ?>
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><?php _e( 'Export Customizer Options', 'wpex' ); ?></th>
							<td>
								<?php
								// Get an array of all the theme mods
								if ( $theme_mods = get_theme_mods() ) {
									$mods = array();
									foreach ( $theme_mods as $theme_mod => $value ) {
										$mods[$theme_mod] = maybe_unserialize( $value );
									}
									$json = json_encode( $mods );
									$disabled = '';
								} else {
									$json = __( 'No Options Found', 'wpex' );
									$disabled = 'disabled';
								}
								echo '<textarea rows="10" cols="50" readonly id="wpex-customizer-export" style="width:100%;">' . $json . '</textarea>'; ?>
								<p class="submit">
									<a href="#" class="button-primary wpex-highlight-options <?php echo $disabled; ?>"><?php _e( 'Highlight Options', 'wpex' ); ?></a>
								</p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php _e( 'Import Customizer Options', 'wpex' ); ?></th>
							<td>
								<?php
								// Get import data
								$import = isset( $options['import'] ) ? $options['import'] : ''; ?>
								<textarea name="wpex_customizer_options[import]" rows="10" cols="50" style="width:100%;"><?php echo stripslashes( $import ); ?></textarea>
								<input id="wpex-reset-hidden" name="wpex_customizer_options[reset]" type="hidden" value=""></input>
								<p class="submit">
									<input type="submit" class="button-primary wpex-submit-form" value="<?php esc_attr_e( 'Import Options', 'wpex' ) ?>" />
									<a href="#" class="button-secondary wpex-delete-options"><?php _e( 'Reset Options', 'wpex' ); ?></a>
									<a href="#" class="button-secondary wpex-cancel-delete-options" style="display:none;"><?php _e( 'Cancel Reset', 'wpex' ); ?></a>
								</p>
								<div class="wpex-delete-options-warning error inline" style="display:none;">
									<p style="margin:.5em 0;"><?php _e( 'Always make sure you have a backup of your settings before resetting, just incase!', 'wpex' ); ?></p>
								</div>
							</td>
						</tr>
					</table>
				</form>
				<script>
					(function($) {
						"use strict";
							$('.wpex-highlight-options').click( function() {
								$('#wpex-customizer-export').focus().select();
								return false;
							});
							$('.wpex-delete-options').click( function() {
								$(this).hide();
								$('.wpex-delete-options-warning, .wpex-cancel-delete-options').show();
								$('.wpex-submit-form').val( "<?php _e( 'Confirm Reset', 'wpex' ); ?>" );
								$('#wpex-reset-hidden').val('-1');
								return false;
							});
							$('.wpex-cancel-delete-options').click( function() {
								$(this).hide();
								$('.wpex-delete-options-warning').hide();
								$('.wpex-delete-options').show();
								$('.wpex-submit-form').val( "<?php _e( 'Import Options', 'wpex' ); ?>" );
								$('#wpex-reset-hidden').val('');
								return false;
							});
					})(jQuery);
				</script>
			</div><!-- .wrap -->
		<?php }

	}
}

// Start class
new WPEX_Customizer_Manager;