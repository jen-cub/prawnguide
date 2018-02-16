<?php
/**
 * Plugin Options Page
 * 
 */
 ?>
<div class="wrap">
    
    <h1><?php _e('Greenpeace API', 'gp_api'); ?></h1>
    	    	
	<div>
	
		<div id="post-body" class="columns-3">
			
			<!-- main content -->
			<div id="post-body-content">
				
				<div class="meta-box">
					
					<form method="post" action="options.php">

    					<?php settings_fields('gp_api_options'); ?>
    					<?php do_settings_sections('gp_api_options'); ?>

    					<h2><?php _e('Thankyou', 'gp_api'); ?></h2>

    					<table class="form-table">
    						<tbody>
    							<tr valign="top">
    								<th scope="row"><label for="gp_thankyou_id">Thankyou Page ID</label></th>
    								<td>
										<input type="text" class="regular-text" id="gp_thankyou_id" name="gp_thankyou_id" value="<?php echo esc_attr( get_option('gp_thankyou_id') ); ?>">
									</td>
    							</tr>
    						</tbody>
    					</table>

    					<?php submit_button(); ?>

					</form>
					
				</div><!-- .meta-box -->
				
			</div><!-- post-body-content -->
			
			
		</div><!-- #post-body .metabox-holder .columns-2 -->
		
		<br class="clear">
		
	</div><!-- #poststuff -->
			
</div> <!-- .wrap -->