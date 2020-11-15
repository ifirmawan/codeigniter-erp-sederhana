<div class="col-xs-12">
	<ul class="c-tab-nav" role="tablist">
			<li role="presentation" class="c-tab-nav__tab ">
				<a href="#tab-pengajuan"><?php echo ucwords('Pengajuan');?></a>
			</li>
			<li role="presentation" class="c-tab-nav__tab">
  				<a href="#tab-riwayat"><?php echo ucwords('Riwayat');?></a>
			</li>
	</ul>
	<div class="u-pad-s">
	<div class="row">
		
		<div class="col-xs-12 col-md-8 u-pad-s">
    		<input class="c-input" placeholder="search anything here"  />
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
	<!-- pengajuan barang start-->
				<table class="c-table c-table--zebra">
					<thead>
						<th>No Permintaan</th>
						<th>Keperluan</th>
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
							<td><?php echo ucfirst($value->nama_item); ?></td>
							<td><?php
							      if ($value->satuan == "Rupiah") {
							      echo show_currency_format($value->qty);
							      }else{
							        echo $value->qty.' '.ucfirst($value->satuan);
							      } ?></td>
							<td><?php echo ucfirst($value->description); ?></td>
							<td><?php echo ucfirst($value->catatan); ?></td>
							<td><button class="c-btn c-btn--tertiary" type="submit" name="ajukan" value="ajukan" onclick="window.location='<?php echo base_url().'finance/ajukan/'.$value->id_item; ?>'"><i class="fa fa-send-o"></i> &nbsp;Ajukan</button></td>
						</tr>
						<?php }}
						if (count($pengajuan)==0) { ?>
						<tr>
							<td colspan="6" style="text-align: center;">Tidak ada pengajuan</td>
						</tr>
						<?php } ?>
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
						<th id="pencairan">Pencairan</th>
					</thead>
					<tbody>
						<?php if (isset($riwayat)) {
							foreach ($riwayat as $key => $value) {
						?>
							<tr>
								<td><?php echo $value->no_permintaan; ?></td>
								<td><?php echo ucwords($value->nama_item); ?></td>
								<td><?php
								      if ($value->satuan == "Rupiah") {
								      echo show_currency_format($value->qty);
								      }else{
								        echo $value->jumlah.' '.ucfirst($value->satuan);
								      } ?></td>
								<td><?php echo ucfirst($value->description); ?></td>
								<td><?php echo ucfirst($value->catatan); ?></td>
								<td id="status"><?php echo ucfirst($value->status); ?></td>							
								<?php if ($value->status=="Diterima") { ?>
								<td style="text-align: right;">
									<form action="<?php echo base_url(). 'finance/cairkan/'.$value->id_item; ?>" method="post">
										<input type="hidden" name="id_permintaan" value="<?php echo $value->id_permintaan; ?>">
										<input class="c-input" type="number" name="amount">
										<button id="btn_cair" class="c-btn c-btn--secondary"><i class="fa fa-dollar"></i>&nbsp; Cairkan</button>
									</form>
								</td>
								<?php } ?> 
								<?php if ($value->status=="Cair") { ?>
								<td><?php echo $value->amount; ?></td>
								<?php } ?>
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



