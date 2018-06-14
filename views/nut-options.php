<div class="wrap">

<h2>Nuttify Email Nottify</h2>


 <form method="post" action="options.php">
	<?php settings_fields( 'nut-nottify-group' ); ?>
    <?php do_settings_sections( 'nut-nottify-group' ); ?>
	<table class="form-table">
		<tr valign="top">
		<th scope="row">Post to nottify:</th>
			<td>
				
				<select name="nut_post_value">
				<?php
					$post_types = get_post_types( '', 'names' ); 
					
					foreach ( $post_types as $post_type ) {
						$is_select = "";
						if(get_option('nut_post_value') == $post_type){
							$is_select = "selected";
						}
						echo '<option value="' . $post_type . '" ' . $is_select . '>' . $post_type . '</option>';
					}
					
				?>
				</select>
				
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row">From Email:</th>
			<td>
				
				<?php
					$email_from = "";
					if(get_option('nut_from_email') != ""){
						$email_from = get_option('nut_from_email');
					}
					else{
						$email_from = get_option('admin_email');
					}
				?>
			
				<input type="text" name="nut_from_email" value="<?php echo $email_from; ?>" placeholder="<?php echo get_option('admin_email'); ?>">
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Send to:</th>
			<td>
				<input type="text" name="nut_to" value="<?php echo get_option('nut_to'); ?>">
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">BCC:</th>
			<td>
				<input type="text" name="nut_bcc" value="<?php echo get_option('nut_bcc'); ?>">
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Subject:</th>
			<td>
				<input type="text" name="nut_subject" value="<?php echo get_option('nut_subject'); ?>">
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Message:</th>
			<td>
				
				<textarea name="nut_message"><?php echo get_option('nut_message'); ?></textarea>
				
			</td>
		</tr>
		
	</table>
	 <?php submit_button(); ?>
 </form>

 
 
 
</div>