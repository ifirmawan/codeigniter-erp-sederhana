<div class="col-xs-12">
	<ul class="c-tab-nav" role="tablist">
			<li role="presentation" class="c-tab-nav__tab ">
				<a href="#tab-permintaan"><?php echo ucwords('review permintaan');?></a>
			</li>

			<li role="presentation" class="c-tab-nav__tab ">
				<a href="#tab-direview"><?php echo ucwords('Buat Pengajuan');?></a>
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

		<div id="tab-permintaan" class="tab-content">
<!-- permintaan start-->

<div class="row">
	<div class="col-xs-12">

		<?php
						foreach ($permintaan as $row) {
							if ($row->status_permintaan=="Pending") {
								$style = "c-banner";
							}elseif ($row->status_permintaan=="Direview") {
								$style = "c-banner c-banner--direview";
							}elseif ($row->status_permintaan=="Diajukan") {
								$style = "c-banner c-banner--success";
							}elseif ($row->status_permintaan=="Direvisi") {
								$style = "c-banner c-banner--warning";
							}elseif ($row->status_permintaan=="Diterima") {
								$style = "c-banner c-banner--diterima";
							}elseif ($row->status_permintaan=="Ditolak") {
								$style = "c-banner c-banner--ditolak";
							}elseif ($row->status_permintaan=="Cair") {
								$style = "c-banner c-banner--cair";
							}
					?>
					<a href="<?php echo base_url(). 'members/detail_permintaan/' .$row->id_permintaan ?>" class="fin-item">
						<div class="<?php echo $style; ?>"><?php echo ucwords($row->judul_permintaan); ?> &nbsp; | &nbsp; Diajukan oleh : <?php echo $row->username; ?></div></a>
		<?php } ?>
	</div><!-- col end -->
</div><!-- row end -->

<!-- permintaan end -->
		</div>

<!-- get direview -->
		
		<div id="tab-direview" class="tab-content">
			<?php 
			if (isset($pengajuan)) {
			if (count($pengajuan)==0) {
				echo "Tidak ada data";
			}else{ ?>
			<table class="c-table c-table--zebra">
			  <thead>
			    <th>Number</th>
			    <th>Name</th>
			    <th>Amount</th>
			    <th>Description</th>
			    <th>Action</th>
			  </thead>
			  <tbody>
			    <?php
			    foreach ($pengajuan as $row) { 
			    ?>
			    <form action="<?php echo base_url(). 'kepala_departement/post_pengajuan'; ?>" method="post">
			      <input type="hidden" name="id_item" value="<?php echo $row->id_item; ?>">
			      <input type="hidden" name="nama_item" value="<?php echo $row->nama_item ?>">
			      <input type="hidden" name="jumlah" value="<?php echo $row->jumlah ?>">
			      <input type="hidden" name="satuan" value="<?php echo $row->satuan ?>">
			      <input type="hidden" name="description" value="<?php echo $row->description; ?>">
			      <input type="hidden" name="id_permintaan" value="<?php echo $row->id_permintaan; ?>" >
			    <tr>
			      <td><?php echo ucfirst($row->no_permintaan); ?></td>
			      <td><?php echo ucfirst($row->nama_item); ?></td>
			      <td><?php
				      if ($row->satuan == "Rupiah") {
				      echo show_currency_format($row->jumlah);
				      }else{
				        echo $row->jumlah.' '.ucfirst($row->satuan);
				      } ?></td>
			      <td><?php echo ucfirst($row->description); ?></td>
			            
			      <td><button type="Submit" name="btn_function" value="ajukan" class="c-btn c-btn--secondary" <?php $btn_dept; ?> ><i class="fa fa-paper-plane"></i>&nbsp; Ajukan</button>
			      </td>     
			    </tr>
			    </form>

			    <?php
			    }
			    ?>    
			  </tbody>
			</table>
			<?php } }?>
		</div>
		<!-- end review -->
		
	</div> 

	</div>
	</div>
</div>