<?php
/**
 * This file defines the MS_Helper_Debug class.
 * 
 * @copyright Incsub (http://incsub.com/)
 *
 * @license http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 * 
 * This program is free software; you can redistribute it and/or modify 
 * it under the terms of the GNU General Public License, version 2, as  
 * published by the Free Software Foundation.                           
 *
 * This program is distributed in the hope that it will be useful,      
 * but WITHOUT ANY WARRANTY; without even the implied warranty of       
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        
 * GNU General Public License for more details.                         
 *
 * You should have received a copy of the GNU General Public License    
 * along with this program; if not, write to the Free Software          
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston,               
 * MA 02110-1301 USA                                                    
 *
 */

/**
 * This Helper creates utility functions for debugging.
 *
 * @since 4.0.0
 * @package Membership
 * @subpackage Controller
 */
class MS_Helper_Debug extends MS_Helper {
	
	/**
	 * Logs errors to WordPress debug log.
	 *
	 * The following constants ned to be set in wp-config.php
	 * or elsewhere where turning on and off debugging makes sense.
	 *
	 *     // Essential
	 *     define('WP_DEBUG', true);  
	 *     // Enables logging to /wp-content/debug.log
	 *     define('WP_DEBUG_LOG', true);  
	 *     // Force debug messages in WordPress to be turned off (using logs instead)
	 *     define('WP_DEBUG_DISPLAY', false);  
	 *
	 * @since 4.0.0
	 * @param  mixed $message Array, object or text to output to log.
	 */
	public static function log( $message ) {
		$trace = debug_backtrace();
		$debug = array_shift($trace);
		$caller = array_shift($trace);
		
		if ( true === WP_DEBUG ) {
			if ( is_array( $message ) || is_object( $message ) ) {
				$class = isset( $caller['class'] ) ? '[' . $caller['class'] . ']\n' : '';
				error_log( $class . print_r( $message, true ) );
			} else {
				$class = isset( $caller['class'] ) ? $caller['class'] . ': ' : '';
				error_log( $class . $message );
			}
		}
	}
	
}
