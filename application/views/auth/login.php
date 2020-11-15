<div class="col-md-3">
  
</div>
<div class="col-md-6">
  <div class="text-center">
    <h3><?php echo lang('login_heading');?><br/>
      <small><i><?php echo lang('login_subheading');?></i></small>
    </h3>
  </div>
  <p></p>

  <div id="infoMessage"><?php echo $message;?></div>

  <?php echo form_open("auth/login");?>

    <p>
      <?php echo lang('login_identity_label', 'identity');?>
      <?php echo form_input($identity);?>
    </p>

    <p>
      <?php echo lang('login_password_label', 'password');?>
      <?php echo form_input($password);?>
    </p>

    <div class="text-right">
        <?php echo lang('login_remember_label', 'remember');?>
        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
        <?php echo form_submit('submit', lang('login_submit_btn'), array('class'=>'btn btn-primary'));?>
    </div>

  <?php echo form_close();?>

  <p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
</div>
<div class="col-md-4">
  
</div>

