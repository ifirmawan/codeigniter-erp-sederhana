<div class="col-md-2">
	
</div>
<div class="col-md-6">
	<div style="text-align: center;">
			<h3>
				<?php echo lang('forgot_password_heading');?><br>
				
			</h3>
		</div>
		<small><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></small>

	<div id="infoMessage"><?php echo $message;?></div>

	<?php echo form_open("auth/forgot_password");?>
	    <p>
	    	<label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
	      	<?php echo form_input($identity);?>
	    </p>

	    <div style="text-align: right;">
	    	<p><?php echo form_submit('submit', lang('forgot_password_submit_btn'), array('class' => 'btn btn-primary'));?></p>
	    </div>
	      

	<?php echo form_close();?>	
</div>

