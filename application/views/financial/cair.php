<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Fin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/css/scooter.css' ?> ">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/css/grid.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/font-awesome/css/font-awesome.min.css' ?>">
	<style type="text/css">
		a.fin-item{
		text-decoration: none;
		}
		ul.fin-nav-hr {
    		list-style-type: none;
    		margin: 0;
    		padding: 0;
    		overflow: hidden;

		}

ul.fin-nav-hr > li {
    float: left;
}

ul.fin-nav-hr > li a {
    display: block;
    text-align: center;
    padding-left: 16px;
}

.fin-dropdown {
    position: relative;
    display: inline-block;
}

.fin-dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1000;
}

.fin-dropdown-content .fin-dropdown-item {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.fin-dropdown-content .fin-dropdown-item:hover {background-color: #f1f1f1}

.fin-dropdown:hover .fin-dropdown-content {
    display: block;
}

.fin-dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
.f3{
	font-weight: bold;
}
.f3 small{
	font-weight: normal;
}
.fin-row{
	padding-left: 22px;
}

	</style>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4">

			</div>
			<div class="col-xs-12 col-md-8">
				<div style="float: right;">
					<div class="fin-dropdown">
						<?php 
							foreach ($username as $user) {
						?>

  <a href="#"><?php echo $user->username; ?></a>
  <?php
}
?>
  <div class="fin-dropdown-content">
    <a href="#" class="fin-dropdown-item">Link 1</a>
    <a href="#" class="fin-dropdown-item">Link 2</a>
    <a href="#" class="fin-dropdown-item">Link 3</a>
  </div>
</div>
				</div>
				<div style="float: right;margin-right: 25px;">
				<ul class="fin-nav-hr"> 
					
					<li><a href="#">Inbox <span class="c-badge">12</span></a></li>
				</ul>	
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<nav class="u-pad-m">
  <ul class="c-tab-nav" role="tablist">
    <li role="presentation" class="c-tab-nav__tab is-active">
      <button role="tab" aria-selected="true" tabindex="0">Everything</button>
    </li>
    <li role="presentation" class="c-tab-nav__tab">
      <button role="tab" aria-selected="false" tabindex="-1">Photos</button>
    </li>
    <li role="presentation" class="c-tab-nav__tab">
      <button role="tab" aria-selected="false" tabindex="-1">Documents</button>
    </li>
  </ul>
</nav>
			</div>
		</div>
<?php
	foreach ($item as $row) {
?>
<form action="<?php echo base_url(). 'members/update_item/' .$id_item; ?>" method="post">
		<div class="row fin-row">
			<div class="col-xs-12 col-md-8">
				<h3 class="f3" style="float: left;margin-right: 15px;">
					<small>Jenis Pengajuan</small><br/>
					<select name="jenis_pengajuan" class="c-input">
		    			<option value="1" selected="true">Barang</option>
		    			<option value="2">Dana</option>
		    		</select>
				</h3>
			</div>
			<div class="col-xs-12 col-md-4">
				<div style="text-align: right;">
					<button class="c-btn c-btn--tertiary" style="outline: none;" name="btn" value="Batal">
						<i class="fa fa-remove"></i>
						Batal
					</button>
					<button class="c-btn c-btn--primary" name="btn" value="Simpan">
						<i class="fa fa-send"></i>
						Simpan
					</button>
				</div>
			</div>
		</div>
		<div class="row fin-row">
			<div class="col-md-4">
				<h3 class="f3" style="float: left;margin-right: 15px;">
					<small>Nama Item</small>
				</h3>
					<input type="text" name="nama_item" class="c-input" value="<?php echo $row->nama_item ?>">
				
			</div>
			<div class="col-md-4">
				<h3 class="f3" style="float: left;margin-right: 15px;">
					<small>Jumlah</small>
				</h3>
					<input type="number" name="jumlah" class="c-input" value="<?php echo $row->jumlah; ?>">
				
			</div>
			<div class="col-md-4">
				<h3 class="f3" style="float: left;margin-right: 15px; ">
					<small>Satuan</small>
				</h3>
					<select name="Satuan" class="c-input">
						<option value="1" selected>Rp.</option>
						<option value="2">Unit</option>
						<option value="3">Pcs</option>
					</select>
			</div>
		</div>
		<div class=""></div>
		<div class="row fin-row">
			<div class="col-xs-12">
				<h3 class="f3" style="float: left;margin-right: 15px;">
					<small>Deskripsi</small>
				</h3>
				<textarea name="description" class="c-input"><?php echo $row->description ?></textarea>
				
			</div>
		</div>
</form>
<?php
}
?>
		

</body>
</html>