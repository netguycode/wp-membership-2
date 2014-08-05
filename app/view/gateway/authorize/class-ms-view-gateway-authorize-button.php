<?php

class MS_View_Gateway_Authorize_Button extends MS_View {

	protected $fields = array();
	
	protected $data;
	
	public function to_html() {
		$this->prepare_fields();
		/** force ssl url */
		$action_url = apply_filters( 'ms_view_gateway_authorize_button_form_action_url', MS_Helper_Utility::get_current_page_url( true ) );
		ob_start();
		?>
			<tr>
				<td class='ms-buy-now-column' colspan='2' >
					<form action="<?php echo $action_url; ?>" method="post">
						<?php MS_Helper_Html::html_input( $this->fields['gateway'] ); ?>
						<?php MS_Helper_Html::html_input( $this->fields['ms_relationship_id'] ); ?>
						<?php MS_Helper_Html::html_input( $this->fields['step'] ); ?>
						<?php MS_Helper_Html::html_input( $this->fields['submit'] ); ?>
					</form>
				</td>
			</tr>
		<?php 
		$html = ob_get_clean();
		return $html;
	}
	
	private function prepare_fields() {
	
		$gateway = $this->data['gateway'];
		
		$this->fields = array(
				'_wpnonce' => array(
						'id' => '_wpnonce',
						'type' => MS_Helper_Html::INPUT_TYPE_HIDDEN,
						'value' => wp_create_nonce( "{$this->data['gateway']->id}_{$this->data['ms_relationship']->id}" ),
				),
				'gateway' => array(
						'id' => 'gateway',
						'type' => MS_Helper_Html::INPUT_TYPE_HIDDEN,
						'value' => $gateway->id,
				),
				'ms_relationship_id' => array(
						'id' => 'ms_relationship_id',
						'type' => MS_Helper_Html::INPUT_TYPE_HIDDEN,
						'value' => $this->data['ms_relationship']->id,
				),
				'step' => array(
						'id' => 'step',
						'type' => MS_Helper_Html::INPUT_TYPE_HIDDEN,
						'value' => $this->data['step'],
				),
		);
		if( strpos( $gateway->pay_button_url, 'http' ) === 0 ) {
			$this->fields['submit'] = array(
					'id' => 'submit',
					'type' => MS_Helper_Html::INPUT_TYPE_IMAGE,
					'value' =>  $gateway->pay_button_url,
			);
		}
		else {
			$this->fields['submit'] = array(
					'id' => 'submit',
					'type' => MS_Helper_Html::INPUT_TYPE_SUBMIT,
					'value' =>  $gateway->pay_button_url ? $gateway->pay_button_url : __( 'Signup', MS_TEXT_DOMAIN ),
			);
		}
	}
}