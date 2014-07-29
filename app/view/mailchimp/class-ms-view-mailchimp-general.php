<?php

class MS_View_Mailchimp_General extends MS_View {

	protected $fields = array();
	
	protected $data;
	
	public function render_tab() {
		$this->prepare_fields();
		ob_start();
		?>
			<div class='ms-settings'>
				<h3><?php echo __( 'Mailchimp settings', MS_TEXT_DOMAIN ); ?></h3>
				<form action="" method="post">
					<?php wp_nonce_field( $this->fields['action']['value'] ); ?>
					<?php MS_Helper_Html::html_input( $this->fields['action'] ) ;?>
					<div class="postbox metabox-holder">
						<div class="inside">
							<?php 
								foreach( $this->fields as $field ) {
									MS_Helper_Html::html_input( $field );
								}
							?>
						</div>
					</div>
					<p>
						<?php MS_Helper_Html::html_submit( array( 'id' => 'submit_settings' ) );?>
					</p>
				</form>
			</div>
		<?php
		$html = ob_get_clean();
		echo $html;
	}
	
	public function prepare_fields() {
		$settings = $this->data['settings'];
		$this->fields = array(
				'mailchimp_api_key' => array(
						'id' => 'mailchimp_api_key',
						'name' => 'custom[mailchimp][api_key]',
						'type' => MS_Helper_Html::INPUT_TYPE_TEXT,
						'title' => __( 'Mailchimp API Key', MS_TEXT_DOMAIN ),
						'desc' => 'Visit your <a target="_blank" href="http://admin.mailchimp.com/account/api">your API dashboard</a> to create an API Key.',
						'value' => $settings->get_custom_settings( 'mailchimp', 'api_key' ),
						'class' => '',
				),
				'mailchimp_api_test' => array(
						'id' => 'mailchimp_api_test',
						'type' => MS_Helper_Html::INPUT_TYPE_TEXT,
						'title' => __( 'Mailchimp api test', MS_TEXT_DOMAIN ),
						'value' => MS_Integration_Mailchimp::get_api_status() ? __( 'Passed', MS_TEXT_DOMAIN ) : __( 'Failed', MS_TEXT_DOMAIN ),
						'class' => '',
				),
				'auto_opt_in' => array(
						'id' => 'auto_opt_in',
						'name' => 'custom[mailchimp][auto_opt_in]',
						'type' => MS_Helper_Html::INPUT_TYPE_CHECKBOX,
						'title' => __( 'Automatically opt-in new users to the mailing list. Users will not receive an email confirmation. Use at your own risk.', MS_TEXT_DOMAIN ),
						'value' => $settings->get_custom_settings( 'mailchimp', 'auto_opt_in' ),
						'field_options' => array( 'checkbox_position' => 'left' ),
						'class' => '',
				),
				'mail_list_registered' => array(
						'id' => 'mail_list_registered',
						'name' => 'custom[mailchimp][mail_list_registered]',
						'type' => MS_Helper_Html::INPUT_TYPE_SELECT,
						'title' => __( 'Registered users mailing list (not members)', MS_TEXT_DOMAIN ),
						'field_options' => MS_Integration_Mailchimp::get_mail_lists(),
						'value' => '',
						'class' => '',
				),
				'mail_list_members' => array(
						'id' => 'mail_list_members',
						'name' => 'custom[mailchimp][mail_list_members]',
						'type' => MS_Helper_Html::INPUT_TYPE_SELECT,
						'title' => __( 'Members mailing list', MS_TEXT_DOMAIN ),
						'field_options' => MS_Integration_Mailchimp::get_mail_lists(),
						'value' => '',
						'class' => '',
				),
				'mail_list_expired' => array(
						'id' => 'mail_list_expired',
						'name' => 'custom[mailchimp][mail_list_expired]',
						'type' => MS_Helper_Html::INPUT_TYPE_SELECT,
						'title' => __( 'Deactivated memberships mailing list', MS_TEXT_DOMAIN ),
						'field_options' => MS_Integration_Mailchimp::get_mail_lists(),
						'value' => '',
						'class' => '',
				),
				'action' => array(
						'id' => 'action',
						'type' => MS_Helper_Html::INPUT_TYPE_HIDDEN,
						'value' => 'save_mailchimp',
				),
		);
	}
}