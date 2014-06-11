<?php
/**
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
 * Communicataion model class.
 * 
 */
class MS_Model_Communication_Before_Finishes extends MS_Model_Communication {
	
	public static $POST_TYPE = 'ms_communication';
	
	protected static $CLASS_NAME = __CLASS__;
	
	protected $type = self::COMM_TYPE_BEFORE_FINISHES;
	
	public function __construct() {
		$this->comm_vars = array(
				'TODO' => 'configure before finish vars',
				'%blogname%' => 'Blog/site name',
				'%blogurl%' => 'Blog/site url',
				'%username%' => 'Username',
				'%usernicename%' => 'User nice name',
				'%userdisplayname%' => 'User display name',
				'%userfirstname%' => 'User first name',
				'%userlastname%' => 'User last name',
				'%networkname%' => 'Network name',
				'%networkurl%' => 'Network url',
				'%membershipname%' => 'Membership name',
		);
	}
	
	public function get_description() {
		return __( 'Sent a predefined numer of days before the membership finishes. You must decide how many days beforehand a message is to be sent', MS_TEXT_DOMAIN );
	}
	
	public static function create_default_communication() {
		$model = new self();
	
		$model->subject = __( 'Membership will finish soon', MS_TEXT_DOMAIN );
		$model->message = self::get_default_message();
		$model->enabled = false;
		$model->period_enabled = true;
		$model->save();
	
		return $model;
	}
	
	public static function get_default_message() {
		ob_start();
		?>
			<h1>MS_Model_Communication_Before_Finishes</h1>
		<?php 
		$html = ob_get_clean();
		return apply_filters( 'ms_model_communication_before_finishes_get_default_message', $html );
	}
}