<?php
	foreach ($revisi as $row) {
?>
<form action="<?php echo base_url(). 'direksi/tanggapi_pengajuan/' .$row->id_item; ?>" method="post">
	<input type="hidden" name="no_revisi" value="<?php echo $no_revisi; ?>">
	<input type="hidden" name="id_permintaan" value="<?php echo $row->id_permintaan; ?>">
	<input type="hidden" name="id_item" value="<?php echo $row->id_item; ?>">
	<input type="hidden" name="no_revisi" value="<?php echo $no_revisi ?>">
	<input type="hidden" name="tanggal_revisi" value="<?php echo $tgl_revisi ?>">

		<div class="row fin-row">
			<div class="col-xs-12 col-md-8">
				<h3 class="f3" style="float: left;margin-right: 15px;">
					<small>No Revisi</small><br/>
					<?php echo $no_revisi; ?>
				</h3>
			</div>
			<div class="col-xs-12 col-md-4">
				<div style="text-align: right;">
					<button class="c-btn c-btn--tertiary" style="outline: none;" name="btn_function" value="Batal">
						<i class="fa fa-remove"></i>
						Batal
					</button>
					<button class="c-btn c-btn--primary" name="btn_function" value="revisi">
						<i class="fa fa-send"></i>
						Simpan
					</button>
				</div>
			</div>
		</div>
		<div class="row fin-row">
			<div class="col-md-4">
				<h3 class="f3" style="float: left;margin-right: 15px;">
					<small>No Permintaan</small><br/>
					<?php echo ucwords($row->no_permintaan); ?>
				</h3>
			</div>
			<div class="col-md-4">
				<h3 class="f3" style="float: left;margin-right: 15px;">
					<small>Nama Item</small><br/>
					<?php echo ucwords($row->nama_item); ?>
				</h3>
			</div>
			<div class="col-md-4">
				<h3 class="f3" style="float: left;margin-right: 15px; ">
					<small>Tanggal Revisi</small><br/>
					<?php echo $tgl_revisi; ?>
				</h3>
			</div>
		</div>
		<div class="row fin-row">
			<div class="col-xs-12">
				<h3 class="f3" style="float: left;margin-right: 15px;">
					<small>Alasan Direvisi</small>
				</h3>
				<textarea name="catatan" class="c-input" placeholder="Tulis alasan pengajuan ini direvisi"></textarea>
				
			</div>
		</div>
</form>
<?php
}
?>