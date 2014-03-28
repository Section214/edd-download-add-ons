<?php
/**
 * EDDDA_Meta_Box class
 *
 * @since 1.0.0
 */
class EDDDA_Meta_Box {


	/**
	 * constructor for EDDDA_Meta_Box class
	 *
	 * @since 1.0.0
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
	 * @since 1.0.0
	 */
	public function meta_box() {	
		add_meta_box( 
			'eddda_meta_box', 
			__( 'Download Add-ons Configuration', 'eddda' ), 
			array( $this, 'meta_box_output' ), 
			'download', 
			'side' 
		);
	}


	/**
	 * meta box form output
	 *
	 * @callback_for meta_box()
	 * @since 1.0.0
	 */
	public function meta_box_output( $post ) {
		$is_add_on = get_post_meta( $post->ID, 'is_add_on', true );
		
		wp_nonce_field( 'meta_box_nonce', 'eddda_meta_box_nonce' );
		
		// Is this download an add-on for another download?
		echo '<input name="is_add_on" id="is_add_on" type="checkbox" value="1" ' . checked( 1, $is_add_on, false ) . '>';
		echo '<label for="is_add_on">' . __( ' This download is an add-on for another download.', 'eddda' ) . '</label>';
		
		// If so, which download?
		echo '<input style="display: none;" name="is_add_on_for" id="is_add_on_for" type="checkbox" value="1" ' . checked( 1, $is_add_on, false ) . ' >';
	}


	/**
	 * save meta box settings
	 *
	 * @param int $post_id The ID of the post being saved
	 * @used_by meta_box_output()
	 * @since 1.0.0
	 */
	public function save_settings( $post_id ) {
		
		// check if nonce is set
		if ( ! isset( $_POST['eddda_meta_box_nonce'] ) ) {
			return $post_id;
		}
		$nonce = $_POST['eddda_meta_box_nonce'];
		
		// is nonce valid?
		if ( ! wp_verify_nonce( $nonce, 'meta_box_nonce' ) ) {
			return $post_id;
		}
		
		// chill with the auto save stuff...
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		
		// update the settings
		update_post_meta( $post_id, 'is_add_on', $_POST['is_add_on'] );
	}
}
new EDDDA_Meta_Box();