<div class="row">
	<div class="col-xs-12">
		<form action="<?php echo site_url('roles/submit_permission');?>" method="post">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="text-center">
						<h4><?php echo strtoupper(str_replace('_', ' ', $this->uri->segment(2)));?></h4>
					</div>
				</div>
				<div class="panel-body">
					<?php 
					
					if (isset($modules) && isset($groups)) : ?>
					<div class="form-group">
						<label><?php echo ucwords('group user');?></label>
						<select class="form-control" name="group_id">
							<option value="0"><?php echo ucwords('pilih group user');?></option>
							<?php
								if ($groups) {
									$group_option ='';
									foreach ($groups as $key => $value) {
										
										$group_option .='<option value="'.$value['id'].'">'.ucwords($value['name']).'</option>';
									}
									echo $group_option;
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label><?php echo ucwords('modul');?></label>
						<select class="form-control" name="modul">
							<option value="0"><?php echo ucwords('pilih modul');?></option>
							<?php
								if ($modules) {
									$option ='';
									foreach ($modules as $key => $value) {
										$option .='<option value="'.$value.'">'.ucwords($value).'</option>';
									}
									echo $option;
								}
							?>
						</select>
					</div>	
					<div class="form-group">
						<label><?php echo ucwords('pilih aksi');?></label>
						<div id="select-aksi">
							
						</div>
					</div>
						
						
					
					<?php endif; ?>
					
				</div>
				<div class="panel-footer">
					<div class="text-right">
						<button type="submit" class="btn btn-primary"><?php echo ucwords('kirim');?></button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>