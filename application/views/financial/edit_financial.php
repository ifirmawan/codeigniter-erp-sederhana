

<?php if (isset($dana)) {
	foreach ($dana as $key => $value) { ?>
	<form action="<?php echo base_url(). 'members/update_item_financial/'.$value->id_item ?>" method="post">
		
		<div class="row fin-row">
			<div class="col-xs-12 col-md-2" style="text-align: right;">
				
			</div>
			<div class="col-xs-12 col-md-8 c-banner" style="text-align: right;">
				<div>
					<label>Edit Permintaan NO <?php echo $value->no_permintaan; ?></label>
				</div>
				
			</div>
		</div>
		<div class="row fin-row">
			<div class="col-xs-12 col-md-2" style="text-align: right;">
				
			</div>
			<div class="col-xs-12 col-md-8">
				<div>
					<label class="c-label">Nama Item
						<input type="text" name="nama_item" class="c-input" value="<?php echo ucwords($value->nama_item); ?>">
					</label>
				</div>
				
			</div>
		</div>
		<div class="row fin-row">
			<div class="col-xs-12 col-md-2" style="text-align: right;">
				
			</div>
			<div class="col-xs-12 col-md-8">
				<label class="c-label">Jumlah
					<input type="number" name="jumlah" class="c-input" value="<?php echo $value->jumlah ?>">
				</label>
			</div>
		</div>
		<div class="row fin-row">
			<div class="col-xs-12 col-md-2" style="text-align: right;">
				
			</div>
			<div class="col-xs-12 col-md-8">
				<label class="c-label">Satuan
				<input class="c-input" type="text" name="satuan" value="<?php echo $value->satuan; ?>" disabled>
				</label>
			</div>
		</div>
		<div class="row fin-row">
			<div class="col-xs-12 col-md-2" style="text-align: right;">
				
			</div>
			<div class="col-xs-12 col-md-8">
				<label class="c-label">Deskripsi
				<textarea class="c-input" name="description"><?php echo ucfirst($value->description); ?></textarea>
				</label>
			</div>
		</div>
		<div class="row fin-row">
			<div class="col-xs-12 col-md-2">
				
			</div>
			<div class="col-xs-12 col-md-8 c-banner" style="text-align: right;">
				<button class="c-btn c-btn--tertiary" style="outline: none;" name="btn_function" value="batal">
		            <i class="fa fa-remove"></i>
		            &nbsp;Batal
		        </button>
		        <button class="c-btn c-btn--tertiary" style="outline: none;" name="btn_function" value="simpan">
		            <i class="fa fa-send"></i>
		            &nbsp;Simpan
		        </button>
			</div>
		</div>
	</form>

<?php 		
	}
}
?>