<?php
/**
 * EDDDA_Meta_Box class
 *
 * @since 1.0.0
 */
class EDDDA_Meta_Box {


	/**
	 * constructor for EDDDA_Meta_Box class
	 */
	public function __construct() {
	
		// add the meta box
		add_action( 'add_meta_boxes', array( $this, 'meta_box' ), 10, 2 );
		
		// save the settings
		add_action( 'save_post', array( $this, 'save_settings' ) );
	}


	/**
	 * create meta box
	 *
	 * @uses meta_box_output()
	 */
	public function meta_box() {	
		add_meta_box( 
			'eddda_meta_box', 
			'Download Add-ons ' . __( 'Configuration', 'eddda' ), 
			array( $this, 'meta_box_output' ), 
			'download', 
			'side' 
		);
	}
	

	/**
	 * assign download to a base download from edit download screen
	 *
	 * @callback_for meta_box()
	 * @uses retrieve_base_id()
	 */
	public function meta_box_output( $post ) {
		$eddda_meta = get_post_meta( $post->ID, 'base-add-on' );
		$checked = $eddda_meta;
		?>
		<div class="eddda-config">
			<div class="eddda-mb-section">
				<label for="base-add-on">
					<input type="checkbox" id="base-add-on" class="" name="base-add-on" value="is-base-add-on" <?php checked(); ?>>
					<?php _e( 'Enable Base/Add-on relationship', 'eddda' ); ?>
				</label>
			</div>
			
			<div class="eddda-mb-section">
				<span><?php _e( 'This download is a...', '' ) ?></span>
			</div>
			
			<div class="eddda-mb-section">
				<input type="radio" id="is-base" class="" name="is-base-add-on" value="base" <?php checked(); ?>>
				<label><?php _e( 'Base', 'eddda' ) ?></label>
			</div>
			
			<div class="eddda-mb-section">
				<input type="radio" id="is-add-on" class="" name="is-base-add-on" value="add-on" <?php checked(); ?>>
				<label><?php _e( 'Add-on', 'eddda' ) ?></label>
			</div>
				
			<div class="eddda-mb-section">
				<div class="eddda-is-base">
					<p><?php _e( 'That\'s it! Once saved, use these same options on other downloads to assign them as an add-on to this base download.', 'eddda' ); ?></p>
				</div>
				<div class="eddda-is-add-on">
					<label class="eddda-label"><?php _e( 'for the following download...', 'eddda' ) ?></label>
					<select id="" name="">
						<option>Select a download</option>
						<option>This download</option>
						<option>That download</option>
					</select>
				</div>
			</div>
		</div>
		<?php
	}


	/**
	 * save meta box settings
	 *
	 * @used_by meta_box_output()
	 */
	public function save_settings( $post_id ) {
	}
}
new EDDDA_Meta_Box();