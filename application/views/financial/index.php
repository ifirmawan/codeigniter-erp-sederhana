<div class="col-xs-12">
	<ul class="c-tab-nav" role="tablist">
			<li role="presentation" class="c-tab-nav__tab ">
				<a href="#tab-permintaan"><?php echo ucwords('daftar permintaan');?></a>
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
								$style = "c-banner c-banner--diajukan";
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
					<div class="fin-item tr" onclick="window.location='<?php echo base_url(). 'members/detail_permintaan/' .$row->id_permintaan ?>'">
						<div class="<?php echo $style; ?>">
							<strong><?php echo ucwords($row->judul_permintaan); ?></strong>&nbsp; 
							<small>Diajukan oleh : <a href="<?php echo base_url().'members/detail_user/'.$row->id_user;?>"><?php echo $row->username; ?></a></small>
						</div>
					</div>
					
		<?php } ?>
	</div>
</div>

<!-- permintaan end -->

		</div>
		<div id="tab-riwayat" class="tab-content">

<!-- history content start -->

			<div class="row">
				
				<div class="col-xs-12">
				<?php
				foreach ($riwayat as $his) {
					if ($his->status_permintaan=="Pending") {
						$style = "c-banner";
					}elseif ($his->status_permintaan=="Direview") {
						$style = "c-banner c-banner--direview";
					}elseif ($his->status_permintaan=="Diajukan") {
						$style = "c-banner c-banner--diajukan";
					}elseif ($his->status_permintaan=="Direvisi") {
						$style = "c-banner c-banner--warning";
					}elseif ($his->status_permintaan=="Diterima") {
						$style = "c-banner c-banner--diterima";
					}elseif ($his->status_permintaan=="Ditolak") {
						$style = "c-banner c-banner--ditolak";
					}elseif ($his->status_permintaan=="Cair") {
						$style = "c-banner c-banner--cair";
					}
				?>
				<div>
					<a href="<?php echo base_url(). 'members/detail_permintaan/'.$his->id_permintaan; ?>" class="fin-item">
						<div class="<?php echo $style; ?>"><?php echo $his->judul_permintaan; ?> &nbsp; | &nbsp; Diajukan pada : <?php echo $his->tgl_permintaan; ?></div>
					</a>
				</div>
				<?php 
			}
			?>
			</div>

			</div>

<!-- history content end -->

		</div>
	</div>

	</div>
	</div>
</div>