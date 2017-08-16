<?php

$args = array(
	'post_type' => 'page',
	'post_status' => 'publish'
);
$posts = new WP_Query( $args );

/** Step 2 (from text above). */
add_action( 'admin_menu', 'frontpage_admin_menu' );

/** Step 1. */
function frontpage_admin_menu() {
	add_options_page(__('Front Page Admin Settings','menu-wpf-fpa'), __('Front Page Admin','menu-wpf-fpa'), 'manage_options', 'settings', 'wpf_fpa_settings_page');
}

/** Step 3. */
function wpf_fpa_settings_page() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	//echo '<div class="wrap">';
	//echo '<p>Here is where the form would go if I actually had options.</p>';
	//echo '</div>';

	// variables for the field and option names
    $opt_name = 'wpf_fpa_favorite_color';
    $hidden_field_name = 'wpf_fpa_submit_hidden';
    $data_field_name = 'wpf_fpa_favorite_color';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );

        // Put a "settings saved" message on the screen

?>
<div class="updated"><p><strong><?php _e('settings saved.', 'menu-wpf-fpa' ); ?></strong></p></div>
<?php

    }

    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Front Page Admin Settings', 'menu-wpf-fpa' ) . "</h2>";
    // settings form

    ?>

</p><hr />

<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Front page", 'menu-wpf-fpa' ); ?>
    <select name="files" id="files">
      <optgroup label="Scripts">
      <?php
	      if ($posts) {
	      foreach ($posts as $post) {
	      ?>
		  <option id="<?php $post->ID; ?>" value="jquery"><?php the_post_title(); ?></option>
        <?php
	        }/* Restore original Post Data */
			wp_reset_postdata();
			}
	        ?>
      </optgroup>
    </select>
</p><hr />
<p><?php _e("From", 'menu-wpf-fpa' ); ?>
<input type="text" id="from" name="from" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p><?php _e("To", 'menu-wpf-fpa' ); ?>
<input type="text" id="to" name="to" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>

</form>
</div>
<?php
}
?>