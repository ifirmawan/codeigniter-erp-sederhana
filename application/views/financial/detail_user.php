<?php foreach ($user_data as $key => $value) { ?>

<div class="row fin-row">
	<div class="col-xs-12 col-md-7">
		<h3 class="f3">
			<?php foreach ($group as $key => $val) { ?>
				<label class="c-label-footer c-label-footer--direvisi"><i class="fa fa-tag"></i> <?php echo $val->description; ?></label>
			<?php } ?>
		</h3>
	</div>
	<div class="col-xs-12 col-md-5" style="text-align: right;">
		<small>Last Login : <?php echo show_date_human_format($value->last_login, true); ?></small>
	</div>
<div class="row fin-row">
	<div class="col-xs-12">
		<div class="col-xs-12 col-md-4">
			<div class="o-media__img">
				<i class="fa fa-user" style="font-size: 140px; color: #007ee5;"></i>
			</div>
				
			<div class="o-media__body">
				<div>
					<label><?php echo $value->username; ?></label><br>
					<p><i class="fa fa-envelope"></i> &nbsp;<?php echo $value->email; ?></p>
					<p><i class="fa fa-phone-square"></i>&nbsp; <?php echo $value->phone; ?></p>
					<p><i class="fa fa-map-marker"></i>&nbsp; Position</p>
					<p><i class="fa fa-institution"></i>&nbsp; CV. JAVA MULTI MANDIRI</p>
				</div>
			</div>
		</div>
	</div>
</div> 
<hr>
<div class="row fin-row">

	<div class="col-xs-12 col-md-3">
		<div class="c-label-footer c-label-footer--pengajuan">
			<div class="o-media__img">
				<i class="fa fa-file-text" style="font-size: 50px;"></i>
			</div>
			<div class="o-media__body">
				<label><?php echo count($permintaan); ?></label>
				<p>Permintaan</p>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-md-3 ">
		<div class="c-label-footer c-label-footer--direvisi">
			<div class="o-media__img">
				<i class="fa fa-edit" style="font-size: 50px;"></i>
			</div>
			<div class="o-media__body">
				<label><?php echo count($direvisi); ?></label>
				<p>Direvisi</p>
			</div>
		</div>
		
	</div>

	<div class="col-xs-12 col-md-3 ">
		<div class="c-label-footer c-label-footer--diterima">
			<div class="o-media__img">
				<i class="fa fa-check-square" style="font-size: 50px;"></i>
			</div>
			<div class="o-media__body">
				<label><?php echo count($diterima); ?></label>
				<p>Diterima</p>
			</div>
		</div>
		
	</div>

	<div class="col-xs-12 col-md-3 ">
		<div class="c-label-footer c-label-footer--ditolak">
			<div class="o-media__img">
				<i class="fa fa-warning" style="font-size: 50px;"></i>
			</div>
			<div class="o-media__body">
				<label><?php echo count($ditolak); ?></label>
				<p>Ditolak</p>
			</div>
		</div>
	</div>

</div>

<?php } ?>