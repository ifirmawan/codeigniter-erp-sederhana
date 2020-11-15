<div class="col-xs-12">
	<ul class="c-tab-nav" role="tablist">
			<li role="presentation" class="c-tab-nav__tab ">
				<a href="#tab-barang"><?php echo ucwords('Pengajuan Barang');?></a>
			</li>
			<li role="presentation" class="c-tab-nav__tab">
  				<a href="#tab-dana"><?php echo ucwords('Pengajuan Dana');?></a>
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
			<div id="tab-barang" class="tab-content">
	<!-- pengajuan barang start-->
				<table class="c-table c-table--zebra">
					<thead>
						<th>No Permintaan</th>
						<th>Nama Item</th>
						<th>Jumlah</th>
						<th>Deskripsi</th>
						<th>Catatan</th>
					</thead>
					<tbody>
						<?php if (isset($barang)) {
							foreach ($barang as $key => $value) {?>
						<tr class="tr" onclick="window.location='<?php echo base_url().'direksi/detail_pengajuan/'.$value->id_item; ?>'">
							<td><?php echo $value->no_permintaan; ?></td>
							<td><?php echo ucwords($value->nama_item); ?></td>
							<td><?php echo $value->qty.' '.$value->satuan; ?></td>
							<td><?php echo ucfirst($value->description); ?></td>
							<td><?php echo ucfirst($value->catatan); ?></td>
						</tr>
						<?php }} ?>	
						<?php if (count($barang)==0) { ?> 
						<tr>
							<td colspan="6" style="text-align: center;">Tidak ada pengajuan</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
	<!-- permintaan end -->
			</div>
 
<!-- start riwayat -->
		<div id="tab-dana" class="tab-content">
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
						<?php if (isset($dana)) {
							foreach ($dana as $key => $value) {
						?>
							<tr>
								<td><?php echo $value->no_permintaan; ?></td>
								<td><?php echo ucwords($value->nama_item); ?></td>
								<td><?php echo show_currency_format($value->qty); ?></td>
								<td><?php echo ucfirst($value->description); ?></td>
								<td><?php echo ucfirst($value->status); ?></td>
								<td>						
						            <button id="btn_terima" class="c-btn c-btn--primary" name="btn_function" value="terima" onclick="window.location='<?php echo base_url(). 'direksi/terima_pengajuan/'.$value->id_item.'/'.$value->id_permintaan; ?>' ">Terima</button>
						            <button value="<?php echo $value->id_item; ?>" id="<?php echo $value->id_permintaan; ?>" name="tolak" class="c-btn c-btn--secondary" data-toggle="modal" data-target="#myModal">Tolak</button>
						            <button value="<?php echo $value->id_item; ?>" id="<?php echo $value->id_permintaan; ?>" name="revisi" class="c-btn c-btn--tertiary" data-toggle="modal" data-target="#myModal">Revisi</button>
								</td>
							</tr>					

						<?php
							}
						} 
						if (count($dana)==0) { ?>
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
 
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
    
        <div class="modal-body">
           <input type="text" name="id_permintaan" value="<?php echo $value->id_permintaan; ?>">
            <textarea class="c-input" name="catatan" placeholder="Masukan alasan anda"></textarea>
        </div>

        <div class="modal-footer">
          <button id="revisi" type="submit" class="btn btn-primary" name="btn_function" value="revisi">Simpan</button>
          <button id="tolak" type="submit" class="btn btn-primary"  name="btn_function" value="tolak">Simpan</button>
        </div>
      </form>
    </div>

  </div>
</div>

