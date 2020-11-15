<div class="col-xs-12">
	<ul class="c-tab-nav" role="tablist">
			<li role="presentation" class="c-tab-nav__tab ">
				<a href="#tab-pengajuan"><?php echo ucwords('Pengajuan');?></a>
			</li>
			<li role="presentation" class="c-tab-nav__tab">
  				<a href="#tab-riwayat"><?php echo ucwords('riwayat');?></a>
			</li>
	</ul>
	<div class="u-pad-s">
	<div class="row">
		
		<div class="col-xs-12 col-md-8 u-pad-s">
				
    				<input class="c-input" placeholder="search anything here"  />
			</div>

			

	</div>
	<div class="row" style="margin-bottom: 20px;">
		<div class="col-xs-12 col-md-1" style="margin-top: 5px; margin-right: 10px;">
				<div class="c-kotak c-kotak--pending"></div>
				<div class="c-kotak">Pending</div>
			</div>
			<div class="col-xs-12 col-md-1" style="margin-top: 5px; margin-right: 10px;">
				<div class="c-kotak c-kotak--direview"></div>
				<div class="c-kotak">Direview</div>
			</div>
			<div class="col-xs-12 col-md-1" style="margin-top: 5px; margin-right: 10px;">
				<div class="c-kotak c-kotak--diajukan"></div>
				<div class="c-kotak">Diajukan</div>
			</div>
			<div class="col-xs-12 col-md-1" style="margin-top: 5px; margin-right: 10px;">
				<div class="c-kotak c-kotak--direvisi"></div>
				<div class="c-kotak">Direvisi</div>
			</div>
			<div class="col-xs-12 col-md-1" style="margin-top: 5px; margin-right: 10px;">
				<div class="c-kotak c-kotak--diterima"></div>
				<div class="c-kotak">Diterima</div>
			</div>
			<div class="col-xs-12 col-md-1" style="margin-top: 5px; margin-right: 10px;">
				<div class="c-kotak c-kotak--ditolak"></div>
				<div class="c-kotak">Ditolak</div>
			</div>
			<div class="col-xs-12 col-md-1" style="margin-top: 5px; margin-right: 10px;">
				<div class="c-kotak c-kotak--cair"></div>
				<div class="c-kotak">Cair</div>
			</div>
			<div class="col-xs-12 col-md-4">
						<div style="text-align: right;">
						
						<button onclick="window.location='<?php echo base_url(). 'members/tambah_permintaan' ?>'" class="c-btn c-btn--primary" >
							<i class="fa fa-plus"></i>
								Tambah permintaan
						</button>

					</div>
				 
			</div>
	</div>
	
	<div class="row">
		
		<div class="tab">

		<div id="tab-pengajuan" class="tab-content">
<!-- permintaan start-->
			<table class="c-table c-table--zebra">
				<thead>
					<th>No Permintaan</th>
					<th>Nama Item</th>
					<th>Jumlah</th>
					<th>Deskripsi</th>
					<th>Catatan</th>
					<th>Aksi</th>
				</thead>
				<tbody>
					<?php 
					if (isset($pengajuan)) {
						foreach ($pengajuan as $key => $value) {?>
					<tr>
						<td><?php echo $value->no_permintaan; ?></td>
						<td><?php echo $value->nama_item; ?></td>
						<td><?php echo $value->qty.' '.$value->satuan; ?></td>
						<td><?php echo $value->description; ?></td>
						<td><?php echo $value->catatan; ?></td>
						<td><button class="c-btn c-btn--tertiary" type="submit" name="ajukan" value="ajukan" onclick="window.location='<?php echo base_url().'general_affair/ajukan/'.$value->id_item; ?>'"><i class="fa fa-send-o"></i> &nbsp;Ajukan</button></td>
					</tr>
					<?php }} ?>
				</tbody>
			</table>
<!-- permintaan end -->

		</div>

<!-- start riwayat -->
		<div id="tab-riwayat" class="tab-content">
				<table class="c-table c-table--zebra">
					<thead>
						<th>No Permintaan</th>
						<th>Nama Item</th>
						<th>Jumlah</th>
						<th>Deskripsi</th>
						<th>Catatan</th>
						<th>Status</th>
					</thead>
					<tbody>
						<?php if (isset($riwayat)) {
							foreach ($riwayat as $key => $value) {
						?>
							<tr>
								<td><?php echo $value->no_permintaan; ?></td>
								<td><?php echo $value->nama_item; ?></td>
								<td><?php echo $value->qty.' '.$value->satuan ?></td>
								<td><?php echo $value->description; ?></td>
								<td><?php echo $value->catatan; ?></td>
								<td><?php echo $value->status; ?></td>
							</tr>
						<?php
							}
						} 
						if (count($riwayat)==0) { ?>
							<tr>
								<td colspan="6" style="text-align: center;">Tidak ada data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
<!-- end riwayat -->
			
		</div>

	</div>
	</div>
</div>